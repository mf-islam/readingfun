<?php
defined('BASEPATH') OR ext('No direct script access allowed');

class Admin extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        
        if (!$this->is_admin_validate()) {
            redirect('readers/signup');
        }
        
        $this->load->helper('form', 'installer');
        $this->load->library('form_validation');
        $this->load->database();

        $this->load->model('admin_model');
        $this->load->model('readers_model');
        $this->load->model('books_model');
        $this->load->model('Libraries_model');
    }
    
    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/login');
        }
        
        $data               = array();
        $data['page_title'] = "Dashboard";
        $data['menu_title'] = "Dashboard";

        //get readers from Database
        $this->load->model('admin_model');
        
        $data['readers_count'] = 10;
        $readers = $this->readers_model->getReaders($data['readers_count']);

        if($readers){
            foreach ($readers as $key => $value) {
                $readers[$key]->points = $this->readers_model->getReadersTotalPoint($value->id);
                $readers[$key]->duration = $this->readers_model->getTotalReadDuration($value->id);
            }
        }
        

        if ($readers) {
            $data['readers'] = $readers;
        }

        // get latest books
        // /* Get recent books from Database */
        $data['books_count'] = 12;
        $books = $this->books_model->getLatestBooks($data['books_count']);

        $latest_books[] = array();

        if($books){
            foreach ($books as $key => $books) {
                if($books->id == 38){
                    continue;
                }
                $param = array(
                    'title' => $books->title,
                    'isbn'  => $books->isbn,
                    'author'=> $books->author
                );
    
                // load books library
                $this->load->library('books_library');
    
                $book_details = $this->books_library->searchBook($param);
    
                $latest_books[$key] = $book_details;
            }
        }
        

        $data['latest_books'] = $latest_books;

        // get total books added
        $data['total_books_added']  = $this->books_model->getTotalBooksCount();

        // get total readers
        $data['total_readers']  = $this->readers_model->getTotalReadersCount();

        // get total duration
        $data['total_read_duration']  = $this->readers_model->getTotalReadDuration();

        // Load view files
        $this->load->view('admin/main/header', $data);
        $this->load->view('admin/main/left', $data);
        $this->load->view('admin/main/top_nav', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/main/footer');
        
    }
    
    public function edit_profile()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/login');
        }
        
        $this->installer =& get_installer();
        
        $data               = array();
        $data['page_title'] = "Change settings";
        $data['menu_title'] = "Settings";
        
        if ($this->config->item('site_title')) {
            $data['site_title'] = $this->config->item('site_title');
        } else {
            $data['site_title'] = "";
        }
        
        $this->form_validation->set_rules('site_title', 'Site title', 'required');
        
        if ($this->config->item('site_slogan')) {
            $data['site_slogan'] = $this->config->item('site_slogan');
            //$this->form_validation->set_rules('settings', 'app_slogan', 'trim|required');
        }
        
        if ($this->config->item('first_name')) {
            $data['first_name'] = $this->config->item('first_name');
            //$this->form_validation->set_rules('settings', 'app_slogan', 'trim|required');
        }
        
        if ($this->config->item('last_name')) {
            $data['last_name'] = $this->config->item('last_name');
            //$this->form_validation->set_rules('settings', 'app_slogan', 'trim|required');
        }
        
        if ($this->config->item('admin_email')) {
            $data['admin_email'] = $this->config->item('admin_email');
            //$this->form_validation->set_rules('settings', 'app_slogan', 'trim|required');
        }
        
        if ($this->config->item('admin_phone')) {
            $data['admin_phone'] = $this->config->item('admin_phone');
            //$this->form_validation->set_rules('settings', 'app_slogan', 'trim|required');
        }
        
        if ($this->config->item('address')) {
            $data['address'] = $this->config->item('address');
            //$this->form_validation->set_rules('settings', 'app_slogan', 'trim|required');
        }
        
        if ($this->config->item('city')) {
            $data['city'] = $this->config->item('city');
            //$this->form_validation->set_rules('settings', 'app_slogan', 'trim|required');
        }
        
        if ($this->config->item('state')) {
            $data['state'] = $this->config->item('state');
            //$this->form_validation->set_rules('settings', 'app_slogan', 'trim|required');
        }
        
        if ($this->config->item('zip')) {
            $data['zip'] = $this->config->item('zip');
            //$this->form_validation->set_rules('settings', 'app_slogan', 'trim|required');
        }
        
        if ($this->config->item('country')) {
            $data['country'] = $this->config->item('country');
            //$this->form_validation->set_rules('settings', 'app_slogan', 'trim|required');
        }
        
        // 
        if ($this->form_validation->run() == FALSE) {
            // set the form validation message in flashdata
            $message = array();
            
            if (form_error('site_title')) {
                $message['app_title'] = form_error('site_title');
            }
            
            // load message information in sessoin
            $this->session->set_flashdata('message', $message);
            
            // Load view files
            $this->load->view('admin/main/header', $data);
            $this->load->view('admin/main/left', $data);
            $this->load->view('admin/main/top_nav', $data);
            $this->load->view('admin/edit_profile', $data);
            $this->load->view('admin/main/footer');
        } else {
            $content = array();
            
            foreach ($this->input->post() as $key => $value) {
                $content[$key] = $value;
            }
            
            if ($this->installer->createCustomConfig('app_config.php', 'config', $this->input->post(), true)) {
                $this->session->set_flashdata('success', "Admin profile changed successfully");
            }
            
            redirect('admin/edit_profile');
        }
        
    }
    
    
    
    public function edit_my_profile()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/login');
        }
        
        $this->installer =& get_installer();
        
        $data               = array();
        $data['page_title'] = "Change settings";
        $data['menu_title'] = "Settings";
        
        if ($this->config->item('site_title')) {
            $data['site_title'] = $this->config->item('site_title');
        } else {
            $data['site_title'] = "";
        }
        
        $this->form_validation->set_rules('library_name', 'Site title', 'required');
        
        $data['libraryDetails'] = $this->Libraries_model->getLibraryDetailsByAdmin($this->session->userdata('user_id'));
        $data['userDetails'] = $this->admin_model->getAdmin($this->session->userdata('user_id'));

        if ($this->form_validation->run() == FALSE) {
            // set the form validation message in flashdata
            $message = array();
            
            if (form_error('library_name')) {
                $message['app_title'] = form_error('library_name');
            }
            
            if (form_error('email')) {
                $message['app_title'] = form_error('email');
            }
            
            // load message information in sessoin
            $this->session->set_flashdata('message', $message);
            
            // Load view files
            $this->load->view('admin/main/header', $data);
            $this->load->view('admin/main/left', $data);
            $this->load->view('admin/main/top_nav', $data);
            $this->load->view('admin/edit_my_profile', $data);
            $this->load->view('admin/main/footer');
        } else {
            $l_data = array(
                            'library_name'  => $this->input->post('library_name'),
                            'email'         => $this->input->post('email'),
                            'address'       => $this->input->post('address'),
                            'city'          => $this->input->post('city'),
                            'state'         => $this->input->post('state'),
                            'zip'           => $this->input->post('zip'),
                            );
            
            $this->admin_model->updateLibraryByAdmin($l_data,$this->session->userdata('library_id'));
            
            $u_data = array(
                            'first_name'    => $this->input->post('first_name'),
                            'last_name'     => $this->input->post('last_name'),
                            );
            
            $this->admin_model->updateAdminDetails($u_data,$this->session->userdata('user_id'));
            
            redirect('admin/edit_my_profile');
        }
        
    }
    
    public function library()
	{
		if (!$this->ion_auth->logged_in())
	    {
	        redirect('admin/users/login');
	    }

		$data = array();
		$data['page_title'] = "List all libraries";
		$data['menu_title'] = "Library";

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
		
		$library = $this->Libraries_model->getLibrary();
        
		if ($library) {
			$data['library'] = $library;
		}

		// Load view files
		$this->load->view('admin/main/header', $data);
        $this->load->view('admin/main/left', $data);
        $this->load->view('admin/main/top_nav', $data);
        $this->load->view('admin/library', $data);
        $this->load->view('admin/main/footer');
	}
    
    public function getLibraryDetails(){
        if(@$_GET['id']){
			$libraryId = $_GET['id'];
            
            $library = $this->Libraries_model->getLibraryDetails($libraryId);
            
            if($library){
                echo json_encode(array('status' => 1,'details' => $library));
            }else{
                echo json_encode(array('status' => 0));
            }
            
		}else{
			echo json_encode(array('status' => 0));
		}
        
        die;
    }
    
    public function api()
    {
        // Data to be passed to views
        $data = array();
        $data['page_title'] = 'API Settings';
        $data['menu_title'] = "Settings";
            

        if ($this->input->post()) {
              
            foreach ($this->input->post() as $array_key => $value) {
                if(isset($value['active']) && $value['active'] == 1) {
                    if ($array_key == 'google') {
                        $this->form_validation->set_rules($array_key.'[url]', $array_key . ' URL', 'trim|required');
                        $this->form_validation->set_rules($array_key.'[key]', $array_key . ' API Key', 'trim|required');

                        if ($this->form_validation->run() == FALSE) {
                            $message = array();
                    
                            if (form_error($array_key.'[url]')) {
                                $message['url'] = form_error($array_key.'[url]');
                            }
                            
                            if (form_error($array_key.'[key]')) {
                                $message['key'] = form_error($array_key.'[key]');
                            }
                            
                            // load message information in sessoin
                            $this->session->set_flashdata('message', $message);
                            redirect('admin/api');
                        }
                    }

                  

                $value['name'] = $array_key;
                $this->admin_model->setApi($value);

                } 
            }

            $this->session->set_flashdata('success', 'API Settings saved successfully');
            redirect('admin/settings/api');
        }

        // Get APi information 
        $api_info = $this->admin_model->getApi();

        foreach ($api_info as $key => $value) {
            switch ($value->name) {
                case 'google':
                    $google_data = array();
                    $google_data['name'] = $value->name;
                    $google_data['active'] = $value->active;
                    $google_data['isDefault'] = $value->isDefault;
                    $google_data['url'] = $value->url;
                    $google_data['key'] = $value->key;

                    $data['google'] = $google_data;
                    break;
                
                case 'openlibrary':
                    $openlibrary_data = array();
                    $openlibrary_data['name'] = $value->name;
                    $openlibrary_data['active'] = $value->active;
                    $openlibrary_data['isDefault'] = $value->isDefault;
                    $openlibrary_data['url'] = $value->url;
                    $openlibrary_data['key'] = $value->key;

                    $data['openlibrary'] = $openlibrary_data;
                    break;

                case 'amazon':
                    $amazon_data = array();
                    $amazon_data['name'] = $value->name;
                    $amazon_data['active'] = $value->active;
                    $amazon_data['isDefault'] = $value->isDefault;
                    $amazon_data['url'] = $value->url;
                    $amazon_data['key'] = $value->key;

                    $data['amazon'] = $amazon_data;
                    break;
                default:
                    # code...
                    break;
            }
        }
        
        // Loading views
        $this->load->view('admin/main/header', $data);
        $this->load->view('admin/main/left', $data);
        $this->load->view('admin/main/top_nav', $data);
        $this->load->view('admin/api', $data);
        $this->load->view('admin/main/footer');
    }
    
    
    /**
     * Change password
     */
    public function change_password()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/login');
        }
        
        $data = array();
        
        // Data to be passed to views
        $data['page_title'] = 'Change admin password';
        $data['menu_title'] = "Settings";
        
        // Login form validation
        $this->form_validation->set_rules('old_password', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
        
        if ($this->ion_auth->is_admin()) {
            $data['admin_email'] = $this->session->identity;
        } else {
            $data['admin_email'] = "";
        }
        
        
        
        if ($this->form_validation->run() == FALSE) {
            // set the form validation message in flashdata
            $message = array();
            
            if (form_error('old_password')) {
                $message['old_password'] = form_error('old_password');
            }
            
            if (form_error('password')) {
                $message['password'] = form_error('password');
            }
            
            if (form_error('confirm_password')) {
                $message['confirm_password'] = form_error('confirm_password');
            }
            
            // load message information in sessoin
            $this->session->set_flashdata('message', $message);
            
            // Loading views
            $this->load->view('admin/main/header', $data);
            $this->load->view('admin/main/left', $data);
            $this->load->view('admin/main/top_nav', $data);
            $this->load->view('admin/change_password', $data);
            $this->load->view('admin/main/footer');
        } else {
            // $this->session->identity - get user identity from session
            $identity = $this->session->identity;
            
            // Get form values
            $current_password = $this->input->post('old_password');
            $password         = $this->input->post('password');
            
            
            // Change password for identity
            if ($this->ion_auth->change_password($identity, $current_password, $password)) {
                // check if email needs to be changed
                if ($identity != $this->input->post('admin_email')) {
                    // Get user id
                    $user_id       = $this->ion_auth->user()->row()->id;
                    $data['email'] = $this->input->post('admin_email');
                    
                    // Check if password matches
                    if ($this->ion_auth->hash_password_db($user_id, $password)) {
                        // update() - Update a user
                        if ($this->ion_auth->update($user_id, $data)) {
                            // logout
                            $this->session->set_flashdata('success', $this->ion_auth->messages());
                            $this->ion_auth->login($data['email'], $password);
                        }
                    }
                }
                
                
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
                redirect('admin/change_password');
            }
        }
    }

    public function points() {
        $data = array();
        $data['page_title']     =   'Point items';
        $data['menu_title']     = "Settings";
            
        /*$point_item = array(
            'signup' => 'Signup',
            'per_minute' => 'Per Minute'
        );*/

        // get points from database
        $points = $this->admin_model->get_points();

        $data['library_point_settings']  = false;
        
        if($this->session->userdata('admin_group_id') == 3){
            $libraryId       = $this->session->userdata('library_id');
            $getLibraryPoint =  $this->admin_model->get_library_points($libraryId);
            
            if($getLibraryPoint){
                $data['library_point_settings'] = json_decode($getLibraryPoint->point_settings);
            }
        }
        
        $data['point_item']         = $points;
        $data['form_action']        = "admin/settings/points";
        $data['form_attributes']    = array(
            'id' => 'points'
        );

        if ($this->input->post()) {
            $pointJSON = array();
            foreach ($points as $k => $points) {
                foreach($_POST as $key => $point_post){
                    if($points->id == $key){
                        $pointJSON[$k]['id'] = $points->id;
                        
                        if(!empty($point_post['name'])){
                            $pointJSON[$k]['is_active'] = 1;
                        }else{
                            $pointJSON[$k]['is_active'] = 0;
                        }
                        
                        $pointJSON[$k]['point'] = $point_post['point'];
                    }
                }
            }
            
            
            $pointJSONArray = array('point_settings' => json_encode($pointJSON));
            
            if($this->session->userdata('admin_group_id') == 3){
                $libraryId = $this->session->userdata('library_id');
                
                if ($this->admin_model->update_settings($libraryId, $pointJSONArray)) {
                    $this->session->set_flashdata('success', "Point updated successfully");
                } else {
                    $this->session->set_flashdata('error', "Point information update unsuccessful ");
                }
            }
            
            

            

            redirect('admin/settings/points');
        }

        // load message information in sessoin                        
        $this->load->view('admin/main/header', $data);
        $this->load->view('admin/main/left', $data);
        $this->load->view('admin/main/top_nav', $data);
        $this->load->view('admin/points', $data);
        $this->load->view('admin/main/footer');
    }

    public function badges() {
        $data = array();
        $data['page_title']     =   'Badge items';
        $data['menu_title']     = "Settings";
            
        /*$point_item = array(
            'signup' => 'Signup',
            'per_minute' => 'Per Minute'
        );*/

        //get points from database
        $badges = $this->admin_model->get_badges();
        
        $data['badge_item'] = $badges;
        
        
        $data['badges_point_settings']  = false;
        
        if($this->session->userdata('admin_group_id') == 3){
            $libraryId       = $this->session->userdata('library_id');
            $getLibraryBadges =  $this->admin_model->get_library_badges($libraryId);
            
            if($getLibraryBadges){
                $data['badges_point_settings'] = json_decode($getLibraryBadges->badges_settings);
            }
        }
        
        $data['form_action']     = "admin/settings/badges";
        $data['form_attributes'] = array(
            'id' => 'badges'
        );

        if ($this->input->post()) {
            $badgesJSON = array();
            foreach ($badges as $k => $badges) {
                foreach($_POST as $key => $badges_post){
                    if($badges->id == $key){
                        $badgesJSON[$k]['id'] = $badges->id;
                        
                        if(!empty($badges_post['name'])){
                            $badgesJSON[$k]['is_active'] = 1;
                        }else{
                            $badgesJSON[$k]['is_active'] = 0;
                        }
                        
                        $badgesJSON[$k]['point'] = $badges_post['points'];
                    }
                }
            }
            
            $badgesJSONArray = array('badges_settings' => json_encode($badgesJSON));
            
            if($this->session->userdata('admin_group_id') == 3){
                $libraryId = $this->session->userdata('library_id');
                
                if ($this->admin_model->update_settings($libraryId, $badgesJSONArray)) {
                    $this->session->set_flashdata('success', "Badges updated successfully");
                } else {
                    $this->session->set_flashdata('error', "Badges information update unsuccessful ");
                }
            }

            redirect('admin/settings/badges');
        }

        // load message information in sessoin                        
        $this->load->view('admin/main/header', $data);
        $this->load->view('admin/main/left', $data);
        $this->load->view('admin/main/top_nav', $data);
        $this->load->view('admin/badges', $data);
        $this->load->view('admin/main/footer');
    }

    public function upload() {
        $ext = explode('.', $_FILES['userfile']['name']);
        $ext = $ext[1];

        if (!file_exists(FCPATH . 'assets/new/video/library_video/'.$this->session->userdata('library_id'))) {
            mkdir(FCPATH . 'assets/new/video/library_video/'.$this->session->userdata('library_id'), 0777, true);
        }
        
        $config['upload_path']          =  FCPATH . 'assets/new/video/library_video/'.$this->session->userdata('library_id').'/';
        $config['allowed_types']        = 'jpeg|jpg|png|gif|mp4';
        $config['file_name']            = 'video_'.md5(@date('Y-m-d h:i:s'));
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', $error);
            redirect ('admin/settings/general');    
        } else {
            switch ($ext) {
                case 'mp4':
                    $files = glob(FCPATH . 'assets/new/video/nursery.{jpg,jpeg,gif,png}', GLOB_BRACE);

                    foreach ($files as $key => $value) {
                        if (file_exists($value)) {
                            rename($value, str_replace('.', '_'.time().'_', $value));
                        }
                    }
                    break;
                
                case 'jpeg':
                    $files = glob(FCPATH . 'assets/new/video/nursery.{jpg,mp4,gif,png}', GLOB_BRACE);

                    foreach ($files as $key => $value) {
                        if (file_exists($value)) {
                            rename($value, str_replace('.', '_'.time().'_', $value));
                        }
                    }
                    break;

                case 'jpg':
                    $files = glob(FCPATH . 'assets/new/video/nursery.{mp4,jpeg,gif,png}', GLOB_BRACE);

                    foreach ($files as $key => $value) {
                        if (file_exists($value)) {
                            rename($value, str_replace('.', '_'.time().'_', $value));
                        }
                    }
                    break;

                case 'png':
                    $files = glob(FCPATH . 'assets/new/video/nursery.{jpg,jpeg,gif,mp4}', GLOB_BRACE);

                    foreach ($files as $key => $value) {
                        if (file_exists($value)) {
                            rename($value, str_replace('.', '_'.time().'_', $value));
                        }
                    }
                    break;

                case 'gif':
                    $files = glob(FCPATH . 'assets/new/video/nursery.{jpg,jpeg,mp4,png}', GLOB_BRACE);

                    foreach ($files as $key => $value) {
                        if (file_exists($value)) {
                            rename($value, str_replace('.', '_'.time().'_', $value));
                        }
                    }
                    break;

                default:
                    # code...
                    break;
            }
            // if there exist then uploader already created a new file with 1 like nurser1.<ext>
            // delete that first
            if (file_exists(FCPATH . 'assets/new/video/nursery1.'.$ext)) {
                rename(FCPATH . 'assets/new/video/nursery1.'.$ext, FCPATH . 'assets/new/video/nursery.'.$ext);
            }

            $data = array('upload_data' => $this->upload->data());
            
            $logo_data = array(
                            'current_video'   => 'assets/new/video/library_video/'.$this->session->userdata('library_id').'/'.$config['file_name'].'.'.$ext
                            );
            
            $this->admin_model->update_settings($this->session->userdata('library_id'), $logo_data);
            
            $this->session->set_flashdata('success', "File uploaded successfully");
            redirect ('admin/settings/general');
        }
    }

    public function upload_logo() {
        $ext = explode('.', $_FILES['logo']['name']);
        $ext = $ext[1];
        
        if (!file_exists(FCPATH . 'assets/new/images/library_icon/'.$this->session->userdata('library_id'))) {
            mkdir(FCPATH . 'assets/new/images/library_icon/'.$this->session->userdata('library_id'), 0777, true);
        }

        $config['upload_path']          =  FCPATH . 'assets/new/images/library_icon/'.$this->session->userdata('library_id');
        $config['allowed_types']        = 'png';
        $config['file_name']            = 'logo_'.md5(@date('Y-m-d h:i:s'));
        $config['max_size']             = 1000;
        $config['max_width']            = 187;
        $config['max_height']           = 104;

        $this->load->library('upload', $config);


        if ( ! $this->upload->do_upload('logo')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', $error);
            redirect ('admin/settings/general');    
        } else {
            if (file_exists(FCPATH . 'assets/new/images/logo.'.$ext)) {
                rename(FCPATH . 'assets/new/images/logo.'.$ext, str_replace('.', '_'.time().'_', FCPATH . 'assets/new/images/logo.'.$ext));
            }
            // if there exist then uploader already created a new file with 1 like nurser1.<ext>
            // delete that first
            if (file_exists(FCPATH . 'assets/new/images/logo1.'.$ext)) {
                rename(FCPATH . 'assets/new/images/logo1.'.$ext, FCPATH . 'assets/new/images/logo.'.$ext);
            }

            $data = array('upload_data' => $this->upload->data());
            
            $logo_data = array(
                            'current_logo'   => 'assets/new/images/library_icon/'.$this->session->userdata('library_id').'/'.$config['file_name'].'.'.$ext
                            );
            
            $this->admin_model->update_settings($this->session->userdata('library_id'), $logo_data);
            
            $this->session->set_flashdata('success', "Logo uploaded successfully");
            redirect ('admin/settings/general');
        }
    }
    
    
    public function upload_profile_picture() {
        $ext = explode('.', $_FILES['logo']['name']);
        
        $ext = $ext[1];
        
        $config['upload_path']          =  FCPATH . 'assets/new/profile_image/'.$this->session->userdata('library_id');
        $config['allowed_types']        = 'png';
        $config['file_name']            = 'logo_'.md5(@date('Y-m-d h:i:s'));
        $config['max_size']             = 1000;
        $config['max_width']            = 64;
        $config['max_height']           = 64;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('logo')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', $error);
            redirect ('admin/settings/profilepicture');    
        } else {
            $this->session->set_flashdata('success', "Image uploaded successfully");
            redirect ('admin/settings/profilepicture');
        }
    }

    public function general() {
        $data = array();
        $data['page_title']     =   'General Settings';
        $data['menu_title']     = "Settings";

        // general settings 
        $data['form_action']     = "admin/settings/general";
        $data['form_attributes'] = array(
            'id' => 'general'
        );

        // home banner
        $data['form_upload_action']     = "admin/admin/upload";
        $data['form_upload_attributes'] = array(
            'id' => 'upload'
        );

        // logo
        $data['form_logo_upload_action']     = "admin/admin/upload_logo";
        $data['form_logo_upload_attributes'] = array(
            'id' => 'upload_logo'
        );

        

        if ($settings = $this->admin_model->getSettings()) {
            $settings_info = array();

            foreach ($settings as $key => $value) {
                $settings_info[$value->name] = $value->value;
            }
        }
        
        
        
        if ($this->input->post()) {
            $generalJSON = array();
            foreach ($settings as $k => $setting) {
                foreach($_POST as $key => $general_post){
                    
                    if($key == $setting->name){
                        $generalJSON[$k]['id'] = $setting->id;
                        $generalJSON[$k]['name'] = $setting->name;
                        $generalJSON[$k]['is_active'] = $general_post;
                    }
                }
            }

            $generalJSONArray = array('general_settings' => json_encode($generalJSON));
            
            if($this->session->userdata('admin_group_id') == 3){
                $libraryId = $this->session->userdata('library_id');
                
                if ($this->admin_model->update_settings($libraryId, $generalJSONArray)) {
                    $this->session->set_flashdata('success', "Settings information saved successfully");
                } else {
                    $this->session->set_flashdata('error', "Settings information update unsuccessful ");
                }
            }
        }
        
        $data['settings'] = $settings_info;
        
        $data['general_settings']  = false;
        
        if($this->session->userdata('admin_group_id') == 3){
            $libraryId       = $this->session->userdata('library_id');
            $getGeneralSettings =  $this->admin_model->get_general_settings($libraryId);
            
            if($getGeneralSettings){
                $data['general_settings'] = json_decode($getGeneralSettings->general_settings);
            }
        }

        // load message information in sessoin                        
        $this->load->view('admin/main/header', $data);
        $this->load->view('admin/main/left', $data);
        $this->load->view('admin/main/top_nav', $data);
        $this->load->view('admin/general', $data);
        $this->load->view('admin/main/footer');
    }
    
    public function setstyle(){
        $data = array();
        $data['page_title']     = 'Set Style';
        $data['menu_title']     = "Settings";

        // get points from database
        $points = $this->admin_model->get_points();

        $data['library_style_settings']  = false;
        
        if($this->session->userdata('admin_group_id') == 3){
            $libraryId       = $this->session->userdata('library_id');
            $getStyleSetting =  $this->admin_model->get_style_setting($libraryId);
            
            if($getStyleSetting){
                $data['library_style_settings'] = json_decode($getStyleSetting->style_settings);
            }
        }
        
        $data['form_action']        = "admin/settings/setstyle";
        $data['form_attributes']    = array(
            'id' => 'style'
        );

        if ($this->input->post()) {
            $styleJSON = array();
            
            $styleJSON['menu_color']        = $this->input->post('menu_color');
            $styleJSON['menu_color_hover']  = $this->input->post('menu_color_hover');
            $styleJSON['body_font_size']    = $this->input->post('body_font_size');
            $styleJSON['title_font_size']   = $this->input->post('title_font_size');
            $styleJSON['body_link_color']   = $this->input->post('body_link_color');
            
            $styleJSONArray = array('style_settings' => json_encode($styleJSON));
            
            if($this->session->userdata('admin_group_id') == 3){
                $libraryId = $this->session->userdata('library_id');
                
                if ($this->admin_model->update_settings($libraryId, $styleJSONArray)) {
                    $this->session->set_flashdata('success', "Style updated successfully");
                } else {
                    $this->session->set_flashdata('error', "Style information update unsuccessful ");
                }
            }

            redirect('admin/settings/setstyle');
        }

        // load message information in sessoin                        
        $this->load->view('admin/main/header', $data);
        $this->load->view('admin/main/left', $data);
        $this->load->view('admin/main/top_nav', $data);
        $this->load->view('admin/setstyle', $data);
        $this->load->view('admin/main/footer');
    }

    public function schools() {
        $data = array();
        $data['page_title']     =   'Schools';
        $data['menu_title']     = "Settings";

        $data['form_action']     = "admin/settings/schools";
        $data['form_attributes'] = array(
            'id' => 'schools'
        );

        
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'School Name', 'trim|required');
            $this->form_validation->set_rules('street', 'School Address', 'trim|required');
            $this->form_validation->set_rules('city', 'School City', 'trim|required');
            $this->form_validation->set_rules('state', 'School State', 'trim|required');
            $this->form_validation->set_rules('zip', 'School Zip', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                // set the form validation message in flashdata
                $message = array();
                
                if (form_error('school_name')) {
                    $message['school_name'] = form_error('school_name');
                }
                
                if (form_error('address')) {
                    $message['address'] = form_error('address');
                }
                
                if (form_error('city')) {
                    $message['city'] = form_error('city');
                }

                if (form_error('state')) {
                    $message['state'] = form_error('state');
                }
                
                if (form_error('zip')) {
                    $message['zip'] = form_error('zip');
                }
                
                // load message information in sessoin
                $this->session->set_flashdata('message', $message);
                redirect('admin/settings/schools');
            } else { // save in database
                if ($schoolId = $this->admin_model->setSchool($this->input->post())) {
                    
                    if($this->session->userdata('admin_group_id') == 3){
                        $schoolLibraryRelationData = array(
                                                       'school_id'  => $schoolId,
                                                       'library_id' => $this->session->userdata('library_id') 
                                                       );
                    
                        $this->admin_model->setSchoolLibrary($schoolLibraryRelationData);
                    }
                    
                    $this->session->set_flashdata('success', 'Schoool informaton saved successfully!');
                    redirect('admin/settings/schools');
                } else {
                    $this->session->set_flashdata('error', 'School information already available');
                    redirect('admin/settings/schools');
                }
            }
            
        }

        // get Schools
        $data['schools'] = $this->admin_model->getSchools();

        //$this->my_library->print_r($data['schools']);
        // load message information in sessoin                        
        $this->load->view('admin/main/header', $data);
        $this->load->view('admin/main/left', $data);
        $this->load->view('admin/main/top_nav', $data);
        $this->load->view('admin/schools', $data);
        $this->load->view('admin/main/footer');
    }

    
    public function profilepicture(){
        $data = array();
        $data['page_title']     =   'Profile Pictures';
        $data['menu_title']     = "Settings";
        
        if (!file_exists(FCPATH . 'assets/new/profile_image/'.$this->session->userdata('library_id'))) {
            mkdir(FCPATH . 'assets/new/profile_image/'.$this->session->userdata('library_id'), 0777, true);
            
            $src = FCPATH . 'assets/avatar/';
            $dir = opendir(FCPATH . 'assets/avatar/'); 
            
            $dst = FCPATH . 'assets/new/profile_image/'.$this->session->userdata('library_id');
            
            while(false !== ( $file = readdir($dir)) ) { 
                if (( $file != '.' ) && ( $file != '..' )) { 
                    if ( is_dir($src . '/' . $file) ) { 
                        recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                    } 
                    else { 
                        copy($src . '/' . $file,$dst . '/' . $file); 
                    } 
                } 
            } 
            closedir($dir); 
        }
        
        $dirname    = 'assets/new/profile_image/'.$this->session->userdata('library_id');        
        $files      = glob($dirname."/*.*");

        for ($i=0; $i<count($files); $i++) {
            $image = $files[$i];
            $data['images'][] = $image;
        }
        
        $this->load->view('admin/main/header', $data);
        $this->load->view('admin/main/left', $data);
        $this->load->view('admin/main/top_nav', $data);
        $this->load->view('admin/profilepicture', $data);
        $this->load->view('admin/main/footer');
    }
    
    public function removepicture(){
        $link = $_POST['link'];
        
        if(unlink($link)){
            echo json_encode(array('status'=> 1));
        }else{
            echo json_encode(array('status'=> 2));
        }
        die;
        
    }
    
    
    public function cronJobs () {
        $data = array();
        $data['page_title']     =   'Cron job';
        $data['menu_title']     = "Settings";

        $data['form_action']     = "admin/settings/cron";
        $data['form_attributes'] = array(
            'id' => 'cron'
        );

        // setup some default settings
        $output = shell_exec('crontab -l');
        $cron_file = "/tmp/crontab.txt";

        // add new cron job
        if ($this->input->post() and !empty($this->input->post('add_cron'))) {
            file_put_contents($cron_file, $output.$this->input->post('add_cron').PHP_EOL);
            echo exec("crontab $cron_file");
            $this->session->set_flashdata('success', "Cron added successfully");
        }

        // remove cron job
        if ($this->input->post() and !empty($this->input->post('remove_cron'))) {
            $remove_cron = str_replace($this->input->post('remove_cron')."\n", "", $output);
            file_put_contents($cron_file, $remove_cron.PHP_EOL);
            echo exec("crontab $cron_file");
            $this->session->set_flashdata('success', "Cron removed successfully");
        }

        // remove cron job
        if ($this->input->post() and !empty($this->input->post('remove_all_cron'))) {
        	$handle = fopen ($cron_file, "w+");
			fclose($handle);
            echo exec("crontab -r");
            $this->session->set_flashdata('success', "All Crons removed successfully");
        }

        // current cron jobs
        $data['current_cron'] = nl2br($output);

        $this->load->view('admin/main/header', $data);
        $this->load->view('admin/main/left', $data);
        $this->load->view('admin/main/top_nav', $data);
        $this->load->view('admin/cronjobs', $data);
        $this->load->view('admin/main/footer');
    }
    
    function is_admin_validate(){
        if($this->session->userdata('is_admin') == TRUE){
            return true;
        }else{
            return false;
        }
    }
}