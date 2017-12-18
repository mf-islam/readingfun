<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{

	}

	public function getReaders($count = false,$current_year = false) {
		$this->db->select('users.id, username, email, created_on, active, first_name,last_name, users.library_id, phone');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id = users.id');
		$where = "active='1' AND users_groups.group_id = 2";
		
		if($current_year){
			$this->db->where('YEAR(users.created_on) = '.$current_year);
		}else{
			$this->db->where('YEAR(users.created_on) = YEAR(CURDATE())');
		}
		
		
		if($this->session->userdata('is_admin') == TRUE){
            if($this->session->userdata('admin_group_id') == 3){
				$this->db->join('schools', 'schools.id = users.school_id');
				$this->db->join('school_library_relation', 'school_library_relation.school_id = schools.id');
				$this->db->where('school_library_relation.library_id = '.$this->session->userdata('library_id'));
			}
        }
		
		$this->db->where($where);
		if ($count) {
			$this->db->limit($count);
		}

		$this->db->order_by('users.id', 'ASC');
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
                
        return $query->result();
	}

	public function update_point($point_id, $data) {
		$this->db->where('id', $point_id);
		$this->db->update('points', $data);

		return true;
	}

	public function get_points() {
		$this->db->select('*');
		$this->db->from('points');
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
                
        return $query->result();
	}

	public function get_badges() {
		$this->db->select('*');
		$this->db->from('badges');
		$this->db->order_by('points', 'ASC');
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
                
        return $query->result();
	}

	public function setApi($data) {
		//$this->my_library->print_r($data);
		$this->db->select('*');
		$this->db->from('api');
		$this->db->where('name', $data['name']);
		$query = $this->db->get();

		if($query->num_rows() > 0) {

			$this->db->where('name', $data['name']);
			$this->db->update('api', $data);
		} else {

			$this->db->insert('api', $data);
		}

		return true;
	}

	public function saveSettings($data) {
		foreach ($data as $key => $value) {
			$this->db->select('*');
			$this->db->from('settings');
			$this->db->where('name', $key);
			$query = $this->db->get();

			if($query->num_rows() > 0) {
				$this->db->set('value', $value);
				$this->db->where('name', $key);
				$this->db->update('settings');
			} else {
				$data = array(
					'name' => $key,
					'value' => $value
				);
				$this->db->insert('settings', $data);
			}
		}

		return true;
	}

	public function getSettings() {
		$this->db->select('*');
		$this->db->from('settings');
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
                
        return $query->result();
	}

	public function getApi() {
		$this->db->select('*');
		$this->db->from('api');
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
                
        return $query->result();
	}

	public function update_badge($badge_id, $data) {
		$this->db->where('id', $badge_id);
		$this->db->update('badges', $data);

		return true;
	}
	
	public function updateAdminDetails($data,$user_id) {
		$this->db->where('id', $user_id);
		$this->db->update('users', $data);

		return true;
	}
	
	public function updateLibraryByAdmin($data,$l_id) {
		$this->db->where('library_id', $l_id);
		$this->db->update('libraries', $data);

		return true;
	}

	public function addPointsToReader($uid, $points) {
		$data  = array(
			'user_id' => $uid,
			'points' => $points
		);

		if ($this->db->insert('readers_points', $data))
			return true;

		return false;
	}

	public function setSchool($data) {
		// check if there is available school
		$this->db->select('*');
		$this->db->from('schools');
		$where = 'name = "' . $data['name'] . '" AND city = "' . $data['city'] . '" AND zip = "' . $data['zip'] . '"';
		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return false;
		} else {
			if ($this->db->insert('schools', $data))
			return $this->db->insert_id();
		}
	}
	
	public function setSchoolLibrary($data){
		return $this->db->insert('school_library_relation', $data);
	}
	
	public function update_settings($libraryId,$data){
		$this->db->where('library_id', $libraryId);
		$this->db->update('library_settings', $data);

		return true;
	}
	
	public function get_library_badges($libraryId){
		$this->db->select('badges_settings');
		$this->db->from('library_settings');
		$where = 'library_id = "'.$libraryId.'"';
		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
                
        return $query->row();
	}
	
	public function get_general_settings($libraryId){
		$this->db->select('general_settings');
		$this->db->from('library_settings');
		$where = 'library_id = "'.$libraryId.'"';
		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
                
        return $query->row();
	}
	
	public function get_all_setting($libraryId){
		$this->db->select('*');
		$this->db->from('library_settings');
		$this->db->join('libraries', 'libraries.library_id = library_settings.library_id');
		$where = 'libraries.library_slug = "'.$libraryId.'"';
		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
                
        return $query->row();
	}
	
	public function get_style_setting($libraryId){
		$this->db->select('style_settings');
		$this->db->from('library_settings');
		$this->db->join('libraries', 'libraries.library_id = library_settings.library_id');
		$where = 'libraries.library_slug = "'.$libraryId.'"';
		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
                
        return $query->row();
	}
	
	public function get_library_points($libraryId){
		$this->db->select('point_settings');
		$this->db->from('library_settings');
		$this->db->join('libraries', 'libraries.library_id = library_settings.library_id');
		$where = 'libraries.library_slug = "'.$libraryId.'"';
		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
                
        return $query->row();
	}

	public function getSchools($order_by = false, $limit = false) {
		$this->db->select('schools.*, count(distinct(users.id)) as no_of_students, count(distinct(readers_books.book_id)) as no_of_books, IFNULL(sum(readers_books.duration), 0) as duration');
		$this->db->from('schools');
		$this->db->join('users', 'users.school_id = schools.id', 'left');
		$this->db->join('readers_books', 'readers_books.user_id = users.id', 'left');
		
		if($this->session->userdata('is_admin') == TRUE){
            if($this->session->userdata('admin_group_id') == 3){
				$this->db->join('school_library_relation', 'school_library_relation.school_id = schools.id', 'inner');
				$this->db->where('school_library_relation.library_id = '.$this->session->userdata('library_id'));
			}
        }
		
		if(!empty($_SESSION['in_sub_domain']['lib_id'])){
            if($this->session->userdata('admin_group_id') != 3 OR $this->session->userdata('admin_group_id') != 1){
				$this->db->join('school_library_relation', 'school_library_relation.school_id = schools.id', 'inner');
				$this->db->join('libraries', 'libraries.library_id = school_library_relation.library_id');
				$this->db->where('libraries.library_slug = "'.$_SESSION['in_sub_domain']['lib_id'].'"');
			}
        }
		
		
		$this->db->group_by('schools.id');
		$this->db->order_by('name', 'ASC');
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;

		$school_data = $query->result();
		
		foreach ($school_data as $key => $value) {
			$school_data[$key]->points = $points = $this->getSchoolTotalPoint($value->id, 'users.school_id');
			if ($order_by == 'points') {
				$point[$key] = $points;
			}
		}

		// sort according to order
        if ($order_by == 'points') {
        	array_multisort($point, SORT_DESC, $school_data);
        }

        //$this->my_library->print_r($school_data);

        return $school_data;
	}

	public function getSchoolTotalPoint($school_id, $group_by = false)
	{
		/*$this->db->select('(IFNULL(SUM(readers_books.duration*points.points), 0) + IFNULL(SUM(readers_points.points), 0)) as total_points');
		$this->db->from('readers_points');
		$this->db->join('points', 'points.id = readers_points.point_id', 'left');
		$this->db->join('readers_books', 'readers_books.id = readers_points.readers_book_id', 'left');
		$this->db->join('users', 'readers_books.user_id = users.id', 'left');
		$where = "users.school_id = '" . $school_id . "'";
		$this->db->where($where);
		if ($group_by) {
			$this->db->group_by($group_by, 'ASC');
		}*/
		
		$total_points = 0;
		
		// get users per school
		$this->db->select('users.id as userid');
		$this->db->from('users');
		$this->db->where('users.school_id', $school_id);
		$user_query = $this->db->get();
		
		if($user_query->num_rows() < 1) {
			return 0;
		}
		
		$arr = array_map (function($value){
			return $value['userid'];
		}, $user_query->result_array());

		if(sizeof($arr > 0)) {
			$this->load->model('readers_model');
			foreach($arr as $userid) {
				$total_points += $this->readers_model->getReadersTotalPoint($userid, false);
			}
		}
        
      	return $total_points; 
	}

	/*public function addPointsToReader($uid, $points) {

		// check if user exists
		$this->db->select('*');
		$this->db->from('readers_points');
		$where  = 'user_id = "' . $uid . '"';
		$query = $this->db->get();

		if($query->num_rows() < 1) { // no readers point available
			$data = array(
				'user_id' => $uid,
				'points' => $points
			);

			//$this->db->set('points', $points);
			$this->db->where('user_id', $uid);
			$this->db->insert('readers_points', $data);
		} else {
			$this->db->set('points', $points);
			$this->db->where('user_id', $uid);
			$this->db->update('readers_points');
		}

		return true;
	}*/
	
	
	public function getAdmin($adminId){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $adminId); 
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}
}