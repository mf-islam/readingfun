<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Libraries extends Public_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		if(@$_GET['lib_id']){
			$this->sub_domain_check->subDomainCheck();
		}else{
			unset($_SESSION['in_sub_domain']);
		}
		
		if(!isset($_SESSION['in_sub_domain']['get_param_subdomain'])){
			$_SESSION['in_sub_domain']['get_param_subdomain'] = '';
		}
		
		$this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->database();
        // Load model 
        $this->load->model('Libraries_model');
	}

	public function index() {
		echo 1;die;
	}

	/**
	 * Library sign up for the first time
	 * @return [type] [description]
	 */
	public function signup() {
		/* if users is already signed in then she should be redirected to account
		not be allowed to signup */
		if ($this->ion_auth->logged_in())
	    {
	        redirect('admin');
	    }
		
		$data 						= array();
		$data['page_title'] 		= 'Libraries | Signup';
		$data['form_action']     	= "libraries/signup";
        $data['form_attributes'] 	= array(
            'id' => 'signupFormValidation',
            'class' => 'form-group'
        );

        $identity_column = $this->config->item('identity', 'ion_auth');
		
		if ($this->input->post()) {
            // add some form validation
            $this->form_validation->set_rules('firstName', 'First Name', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('password', 'New Password', 'trim|required');
            $this->form_validation->set_rules('passwordConfirm', 'Confirm Password', 'trim|required|matches[password]');
			
			if($this->input->post('installation_type') == 1){
				if(!$this->Libraries_model->checkSubDomain($this->input->get('library_slug'))){
					redirect('admin');
				}
			}
            
			// redirect if there is successful singup
            if ($this->form_validation->run() == FALSE) {
                // set the form validation message in flashdata
                $message = array();
                
                if (form_error('firstName')) {
                    $message['firstName'] = form_error('firstName');
                }
                
                if (form_error('email')) {
                    $message['email'] = form_error('email');
                }
				
                if (form_error('password')) {
                    $message['password'] = form_error('password');
                }

                if (form_error('passwordConfirm')) {
                    $message['passwordConfirm'] = form_error('passwordConfirm');
                }
				
                // load message information in sessoin
                $this->session->set_flashdata('message', $message);
                
                redirect ('libraries/signup');
            }else{
				// Getting form values
                $email    = $this->input->post('email');
                $password = $this->input->post('password');
                
                $identity = ($identity_column === 'email') ? $email : $this->input->post('username');
                
                $s_data               = array();
                $s_data['first_name'] = $this->input->post('firstName');
                $s_data['last_name']  = $this->input->post('lastName');

                if ($user = $this->ion_auth->register($identity, $password, $email, $s_data)) {
					$updateUserType = array(
											'group_id' => 3
											);
					
					$this->Libraries_model->updateUserGroup($updateUserType,$user);
					
                    $l_data = array(
						'library_name' 	=> $this->input->post('library_name'),
						'library_slug' 	=> str_replace(' ', '', $this->input->post('library_slug')),
						'email' 		=> $this->input->post('email'),
						'address' 		=> $this->input->post('address'),
						'city' 			=> $this->input->post('city'),
						'state' 		=> $this->input->post('state'),
						'zip' 			=> $this->input->post('zip'),
						'type' 			=> $this->input->post('installation_type'),
						'created_by' 	=> $user,
						'created_on' 	=> @date('y-m-d h:i:s'),
						'status' 		=> '1',
					);
					
					if($library = $this->Libraries_model->registerLibrary($l_data)){
						$library_setting = array(
												'library_id' => $library
												);
						
						$this->Libraries_model->saveLibraryData($library_setting);
						
						redirect('admin');
					}else{
						redirect('libraries/signup');
					}
                } else {
                    $this->session->set_flashdata('error', $this->ion_auth->errors());
                    redirect('libraries/signup');
                }
			}
		}

		$this->load->view('new/template/header', $data);
		$this->load->view('libraries/signup', $data);
		$this->load->view('new/template/footer', $data);	
	}

	public function checkSubDomain() {
		// check in database if the subdomain available
		if($this->input->get('subdomain') && $this->Libraries_model->checkSubDomain($this->input->get('subdomain'))) {
			$result = 1;
		} else $result = 0;
		print json_encode($result);
	}
}
