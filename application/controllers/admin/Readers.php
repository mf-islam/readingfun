<?php defined('BASEPATH') OR ext('No direct script access allowed');

class Readers extends Admin_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
      	$this->load->library('form_validation');
      	if (!$this->ion_auth->logged_in())
	    {
	        redirect('admin/users/login');
	    }
		
		if (!$this->is_admin_validate()) {
            redirect('readers/signup');
        }

	    $this->load->model('readers_model');
	    $this->load->model('books_model');
	    $this->load->model('admin_model');
	}

	public function index()
	{
		if (!$this->ion_auth->logged_in())
	    {
	        redirect('admin/users/login');
	    }

		$data = array();
		$data['page_title'] = "List all readers";
		$data['menu_title'] = "Readers";

		//get readers from Database
		$this->load->model('admin_model');
		
		if(@$_GET['s']){
			if(is_numeric ($_GET['s'])){
				$currentYear = $_GET['s'];
			}else{
				$currentYear = false;
			}
		}else{
			$currentYear = false;
		}
		
		$readers = $this->admin_model->getReaders(false,$currentYear);

		if($readers){
			foreach ($readers as $key => $value) {
				$readers[$key]->points = $this->readers_model->getReadersTotalPoint($value->id);
				$readers[$key]->duration = $this->readers_model->getTotalReadDuration($value->id);
			}
		}
		

		if ($readers) {
			$data['readers'] = $readers;
		}

		// add user points
		$this->form_validation->set_rules('points', 'How many points', 'trim|required');

		if ($this->input->post()) {
			if ($this->form_validation->run() == FALSE) {
	            // set the form validation message in flashdata
	            $message = array();
	            
	            if (form_error('points')) {
	                $message['points'] = form_error('points');
	            }
	            
	            // load message information in sessoin
	            $this->session->set_flashdata('message', $message);
	            redirect('admin/readers');
	        } else {
	        	$uid = $this->input->post('uid');
	        	$points = $this->input->post('points');

	        	if ($this->admin_model->addPointsToReader($uid, $points)) {
	        		$this->session->set_flashdata('success', 'Points added successfully');
	        		redirect('admin/readers');
	        	}
	        }
		}  

		// Load view files
		$this->load->view('admin/main/header', $data);
        $this->load->view('admin/main/left', $data);
        $this->load->view('admin/main/top_nav', $data);
        $this->load->view('admin/readers', $data);
        $this->load->view('admin/main/footer');
	}

	public function getReaderDetails($userid = false) {
		$readerDetails = array();
		$user_id = (($userid) ? $userid : $this->input->get('userid'));

		// Get Reader details
		$readerDetails['details'] = $this->readers_model->getReader($user_id);

		// get readers total point
		$readerDetails['TotalPoint'] = $this->readers_model->getReadersTotalPoint($user_id);

		// get readers total point
		$readerDetails['TotalDuration'] = $this->readers_model->getTotalReadDuration($user_id);

		// get readers total point
		$readerDetails['TotalBooks'] = $this->books_model->getTotalBooksCount($user_id);

		// get readers books
		//$readerDetails['books'] = $this->readers_model->getReaderBooks($user_id);
		
		print json_encode($readerDetails);

	}
	
	function is_admin_validate(){
        if($this->session->userdata('is_admin') == TRUE){
            return true;
        }else{
            return false;
        }
    }
}