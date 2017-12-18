<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Libraries_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->database();
	}

	public function index()
	{

	}
	
	public function registerLibrary($l_data){
		if($this->db->insert('libraries', $l_data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	public function saveLibraryData($l_data){
		if($this->db->insert('library_settings', $l_data)){
			return true;
		}else{
			return false;
		}
	}
	
	public function checkLibraryExists($libraryId){
		$this->db->select('*');
		$this->db->from('libraries');
		$this->db->where('library_slug', $libraryId); 
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	
	public function getLibraryDetails($libraryId){
		$this->db->select('*');
		$this->db->from('libraries');
		$this->db->where('library_id', $libraryId); 
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	
	public function getLibraryDetailsByAdmin($adminId){
		$this->db->select('*');
		$this->db->from('libraries');
		$this->db->where('created_by', $adminId); 
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	
	public function getLibrary(){
		$this->db->select('libraries.*,users.first_name,users.last_name');
		$this->db->from('libraries');
		$this->db->join('users', 'libraries.created_by = users.id');

		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function updateUserGroup($data,$userId){
		return $this->db->update('users_groups', $data, array('user_id' => $userId));
	}

	public function checkSubDomain($subdomain) {
		
		$subdomain = str_replace(' ', '', $subdomain);
		
		$this->db->select('library_slug');
		$this->db->from('libraries');
		$this->db->where('library_slug', $subdomain); 
		$query = $this->db->get();

		if($query->num_rows() > 0){
			return false;
		}else{
			return true;
		}
	}
}