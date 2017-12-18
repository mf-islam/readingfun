<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Readers_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{

	}

	public function getReaders($limit = 0, $order_by = 'users.id') {
		$this->db->select('users.id, username, email, created_on, active, first_name,last_name, library_id, phone');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id = users.id');
		
		if($this->session->userdata('is_admin') == TRUE){
            if($this->session->userdata('admin_group_id') == 3){
				$this->db->where('library_id = '.$this->session->userdata('library_id'));
			}
        }
		
		
		$where = "active='1' AND users_groups.group_id = 2";
		$this->db->where($where);
		
		$this->db->where('YEAR(users.created_on) = YEAR(CURDATE())');
		
		$this->db->limit($limit);
		$this->db->order_by($order_by, 'DESC');
		
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
                
        return $query->result();
	}

	public function getTopReaders($limit) {
		$this->db->select('concat(users.first_name, " ", users.last_name) as name, users.email as email, users.created_on, (IFNULL(SUM(readers_books.duration*points.points), 0) + IFNULL(SUM(readers_points.points), 0)) as total_points, count(distinct(book_id)) as total_books, SUM(readers_books.duration) as total_duration');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id = users.id', 'left');
		$this->db->join('readers_points', 'readers_points.user_id = users.id', 'left');
		$this->db->join('readers_books', 'readers_books.id = readers_points.readers_book_id', 'left');
		$this->db->join('points', 'points.id = readers_points.point_id', 'left');
		// Get books only for this library
		if(isset($_SESSION['in_sub_domain']['get_param_subdomain'])){
			$this->db->join('school_library_relation', 'school_library_relation.school_id = users.school_id');
			$this->db->join('libraries', 'libraries.library_id = school_library_relation.library_id');
		}
		$where = "users.active = '1' AND users_groups.group_id != 1";
		
		$this->db->where($where);
		if(isset($_SESSION['in_sub_domain']['lib_id'])){
			$this->db->where('libraries.library_slug = "'.$_SESSION['in_sub_domain']['lib_id'] . '"');
		}
		$this->db->where('YEAR(users.created_on) = YEAR(CURDATE())');
		$this->db->limit($limit);
		$this->db->order_by('total_points', 'DESC');
		$this->db->group_by('users.id');
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return 0;
			
		return $query->result();
	}

	public function getReader($userid) {
		$user_id = (($userid) && !empty($userid) ? $userid : $this->ion_auth->get_user_id());

		$this->db->select('*');
		$this->db->from('users');
		$where = "active='1' AND id = '" . $user_id . "'";
		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
		// exclude some fields
        unset($query->row()->password);  
        unset($query->row()->forgotten_password_code);  
        unset($query->row()->forgotten_password_time);  
        unset($query->row()->activation_code);  
        return $query->row();
	}

	public function getReaderBooks($userid) {
		$user_id = (($userid) ? $userid : $this->ion_auth->get_user_id());
		$this->db->select('*, books.title as book_title, (points.points * readers_books.duration) as reading_point');
		$this->db->from('readers_books');
		$this->db->join('books', 'readers_books.book_id = books.id');
		$this->db->join('readers_points', 'readers_points.user_id = readers_books.user_id');
		$this->db->join('points', 'readers_points.point_id = points.id');
		$this->db->where('readers_books.user_id', $user_id);
		$this->db->order_by('readers_books.date', 'DESC');
		$this->db->group_by("books.id"); 
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
   		
        return $query->result();
	}

	public function updateReader($data) {
		$user_id = $this->ion_auth->get_user_id();

		$this->db->where('id', $user_id);
		$this->db->update('users', $data);

		/*$this->db->select('username, email, created_on, active, first_name,last_name, library_id, phone');
		$this->db->from('users');
		$where = "active='1' AND id = '" . $user_id . "'";
		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;*/
                
        return true;
	}

	public function getReadersTotalPoint($userid, $group_by = false)
	{
		$user_id = (isset($userid) ? $userid : $this->ion_auth->get_user_id());
		$this->db->select('(IFNULL(SUM(readers_books.duration*points.points), 0) + IFNULL(SUM(readers_points.points), 0)) as total_points');
		$this->db->from('readers_points');
		$this->db->join('points', 'points.id = readers_points.point_id', 'left');
		$this->db->join('readers_books', 'readers_books.id = readers_points.readers_book_id', 'left');
		$this->db->join('users', 'readers_books.user_id = users.id', 'left');
		$where = "readers_points.user_id = '" . $user_id . "'";
		$this->db->where($where);
		if ($group_by) {
			$this->db->group_by($group_by);
		}
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return 0;
        
      	return $query->row()->total_points;
	}

	public function getReaderBadges($user_id, $total_points) {
		if(!isset($_SESSION['in_sub_domain']['lib_id'])){
			$user_id = (isset($userid) ? $userid : $this->ion_auth->get_user_id());
	
			$this->db->select('*');
			$this->db->from('badges');
			$where = 'active = "1" AND points <= ' . (int)$total_points;
			$this->db->order_by('badges.points', 'DESC'); // get the latest one first
	
			$this->db->where($where);
			$query = $this->db->get();
	
			if($query->num_rows() < 1)
				return 0;
			
			return $query->result();
		}else{
			$this->db->select('badges_settings');
			$this->db->from('library_settings');
			$where = 'library_id = '.$_SESSION['in_sub_domain']['original_library_id'];
			$this->db->where($where);
			$query = $this->db->get();
	
			if($query->num_rows() > 0){
				$result = $query->row();
				
				$result = json_decode($result->badges_settings);
				
				$resultArray = array();
				$resultArrayObj = array();
				
				foreach($result as $k=>$r){
					$resultArrayObj['id'] 		= $r->id;
					$resultArrayObj['points'] 	= $r->point;
					$resultArrayObj['active'] 	= $r->is_active;

					
					
					
					if($r->is_active == 1 && $r->point <= (int)$total_points){
						$resultArray[] = (object) $resultArrayObj;
					}					
				}
				
				if(count($resultArray) < 1){
					return 0;
				}else{
					return $resultArray;
				}
			}else{
				return 0;
			}
		}
	}

	public function addNewReadLog($data) {
		$user_id = $this->ion_auth->get_user_id();

		// check if there is already same book with same isbn
		$this->db->select('*');
		$this->db->from('books');
		$where = 'isbn = "' . $data['isbn'] . '" or LOWER(\'title\') = "' . strtolower($data['title']) . '"';
		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$book_id = $query->row()->id;
		} else {
			// save book information into database
			$book_info = array(
				'title' => $data['title'],
				'author' => $data['author'],
				'isbn' => $data['isbn'],
				'active' => 1
			);

			$this->db->insert('books', $book_info);

			// Save book read into reader_books table
			$book_id = $this->db->insert_id();
		}

		$reader_books_data = array(
			'user_id' => $user_id,
			'book_id' => $book_id,
			'duration' => $data['duration'],
			'date' => ((($data['date']) && !empty($data['date'])) ? $data['date'] : date(DATE_W3C, time()))
		);

		$this->db->insert('readers_books', $reader_books_data);
		$readers_book_id = $this->db->insert_id();

		// update readers point table
		$reader_points_data = array(
			'user_id' => $user_id,
			'point_id' => $this->getPointId('read'),
			'readers_book_id' => $readers_book_id,
			'added_on' => ((($data['date']) && !empty($data['date'])) ? $data['date'] : date(DATE_W3C, time()))
		);

		$this->db->insert('readers_points', $reader_points_data);

		return true;
	}

	private function getPointId($name) {
		$this->db->select('id');
		$this->db->from('points');
		$where = 'name = "' . $name . '"';
		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return 0;
        
      	return $query->row()->id;
			
	}

	public function getTotalReadersCount() {
		$this->db->select('count(*) as count');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id = users.id');
		$where = 'users_groups.group_id != "1"';
		$this->db->where($where);
		
		if($this->session->userdata('is_admin') == TRUE){
            if($this->session->userdata('admin_group_id') == 3){
				$this->db->where('library_id = '.$this->session->userdata('library_id'));
			}
        }
		
		$query = $this->db->get();

		return $query->row()->count;
	}

	public function getTotalReadDuration($userid = false) {
		$user_id = (isset($userid) ? $userid : false);
		$this->db->select('IFNULL(SUM(duration), 0) as duration');
		$this->db->from('readers_books');
		
		if($this->session->userdata('is_admin') == TRUE){
            if($this->session->userdata('admin_group_id') == 3){
				$this->db->join('users', 'readers_books.user_id = users.id', 'left');
				$this->db->where('library_id = '.$this->session->userdata('library_id'));
			}
        }
		
		if ($user_id) {
			$where = 'readers_books.user_id = "' . $user_id . '"';
			$this->db->where($where);
		}
		$query = $this->db->get();

		return $query->row()->duration;
	}

	public function changeAvatar($avatar) {
        $user_id = $this->ion_auth->get_user_id();
        $this->db->set('avatar', $avatar);
		$this->db->where('id', $user_id);
		if ($this->db->update('users')) {
			return true;
		} else return false;
    }

    public function getSettings() {
		$this->db->select('*');
		
		if(isset($_SESSION['in_sub_domain']['lib_id'])){
			$this->db->from('library_settings');
			$this->db->join('libraries', 'libraries.library_id = library_settings.library_id');
			$this->db->where('library_slug', $_SESSION['in_sub_domain']['lib_id']);
		}else{
			$this->db->from('settings');
		}
		
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
                
        return $query->result();
	}

	public function updateUserSchool($email, $school_id) {
		$this->db->set('school_id', $school_id);
		$this->db->where('email', $email);
		if ($this->db->update('users')) {
			return true;
		} else return false;
	}
	
	public function updateUserLibrary($email, $library_id) {
		$this->db->set('library_id', $library_id);
		$this->db->where('email', $email);
		if ($this->db->update('users')) {
			return true;
		} else return false;
	}

	/**
	 * Return user type 0 = admin, 1 = reader
	 * @param  [type] $email [description]
	 * @return [int][0 = admin, 1 = reader, -1 = error]
	 */
	public function getUserType($email) {
		//$this->db->select('type');
		$this->db->from('users');
		$this->db->where('email', $email);
		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->row()->type;

		return -1;
	}
}