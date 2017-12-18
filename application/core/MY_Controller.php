<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class MY_Controller extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();

			$this->load->model('readers_model');
			$this->load->library('google');
      		$this->load->library('openlibrary');
      		$this->load->model('books_model');

      		// grab API information
			$api_info = $this->books_model->getApi();

			// return is an multidimentional array
			// search if there is any value named google in value
			$key = array_search('google', array_column($api_info, 'name'));

			if (null !== $key) {
				// check if this API is Default
				if ($api_info[$key]['isDefault'] == "1") {
					$this->config->set_item('default_api', $api_info[$key]['name']);
				}
			}

			$key = array_search('google', array_column($api_info, 'name'));
			if (null !== $key) {
				$this->config->set_item('google_api', $api_info[$key]['key']);
			}

		}
	}

	class Admin_Controller extends MY_Controller
	{
		function __construct()
		{
			parent::__construct();

			//protect from unauthorised login
			$this->load->library('ion_auth');

			if (!$this->ion_auth->logged_in())
			{
				redirect('admin/login', 'refresh');
			}
		}
	}

	class Public_Controller extends MY_Controller
	{
		function __construct()
		{
			parent::__construct();

			if ($this->ion_auth->logged_in()) {
				// get account details from database
		        $this->load->model('readers_model');
		        
		        // Get reader's information from database
		        $reader_info = $this->readers_model->getReader($this->ion_auth->get_user_id());

		        $this->config->set_item('reader_name', $reader_info->first_name.' '.$reader_info->last_name);
			}
		}

		
	}
?>