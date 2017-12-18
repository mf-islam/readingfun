<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{

	}

	public function getBookInfoDb ($data) {
		$this->db->select('*');
		$this->db->from('books');
		$where = 'title="' . $data['title'] . '" or author="' . $data['author'] . '" or isbn="' . $data['isbn'] . '"';
		$this->db->where($where);
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
   
        return $query->row();
	}

	public function getLatestBooks($count, $order_by = 'id', $userid = false, $current_year = false) {
		$this->db->select('books.*, users.id, concat(users.first_name, " ", users.last_name) as name, users.email, readers_books.*, sum(duration) as duration');
		$this->db->from('books');
		$this->db->join('readers_books', 'readers_books.book_id = books.id');
		$this->db->join('users', 'readers_books.user_id = users.id');

		// Get books only for this library
		if(isset($_SESSION['in_sub_domain']['lib_id'])){
			$this->db->join('school_library_relation', 'school_library_relation.school_id = users.school_id');
			$this->db->join('libraries', 'libraries.library_id = school_library_relation.library_id');
		}
		
		
		
		if ($userid) 
		{
			$where = 'readers_books.user_id = "' . $userid . '"';
			$this->db->where($where);
		}
		
		if($this->session->userdata('is_admin') == TRUE){
            if($this->session->userdata('admin_group_id') == 3){
				$this->db->where('books.library_id = '.$this->session->userdata('library_id'));
			}
			
			if($current_year){
				$this->db->where('YEAR(users.created_on) = '.$current_year);
			}else{
				$this->db->where('YEAR(users.created_on) = YEAR(CURDATE())');
			}
        }else{
        	if(isset($_SESSION['in_sub_domain']['lib_id'])){
				$this->db->where('libraries.library_slug = "'.$_SESSION['in_sub_domain']['lib_id'] . '"');
			}
			
			$this->db->where('YEAR(users.created_on) = YEAR(CURDATE())');
		}
		
		$this->db->limit($count);
		$this->db->group_by('books.id');
		$this->db->order_by('readers_books.'.$order_by, 'DESC');

		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
   
   		
        return $query->result();
	}

	public function getReadersCountPerBook($book_id) {
		$this->db->select('count(distinct(readers_books.user_id)) as count');
		$this->db->from('readers_books');
		$this->db->where('book_id', $book_id);
		
		if($this->session->userdata('is_admin') == TRUE){
            if($this->session->userdata('admin_group_id') == 3){
				$this->db->where('books.library_id = '.$this->session->userdata('library_id'));
			}
        }
		
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
   
   		
        return $query->row()->count;
	}

	public function getTotalBooksCount($userid = false) {
		$user_id = (isset($userid) ? $userid : false);
		$this->db->select('count(distinct(books.id)) as count');
		$this->db->from('books');
		if ($user_id) {
			$this->db->join('readers_books', 'readers_books.book_id = books.id');
			$where = 'readers_books.user_id = "' . $user_id . '"';
			$this->db->where($where);
		}
		
		if($this->session->userdata('is_admin') == TRUE){
            if($this->session->userdata('admin_group_id') == 3){
				$this->db->where('books.library_id = '.$this->session->userdata('library_id'));
			}
        }
		
		$query = $this->db->get();

		return $query->row()->count;
	}

	public function getApi() {
		$this->db->select('*');
		$this->db->from('api');
		$query = $this->db->get();

		if($query->num_rows() < 1)
			return false;
                
        return $query->result_array();
	}
}