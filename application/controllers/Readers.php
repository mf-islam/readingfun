<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Readers extends Public_Controller
{   
    function __construct()
    {
        parent::__construct();
        
        if($this->session->userdata('is_admin') == TRUE){
             redirect('admin');
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->database();
        // get account details from database
        $this->load->model('readers_model');
        
        ob_start();
    }
    
    public function index()
    {
        $this->sub_domain_check->subDomainCheck();
        
        if (!$this->ion_auth->logged_in()) {
            redirect('readers/login'.$_SESSION['in_sub_domain']['get_param_subdomain']);
        } else {
            redirect('readers/account'.$_SESSION['in_sub_domain']['get_param_subdomain']);
        }
    }
    
    public function account()
    {
        $this->sub_domain_check->subDomainCheck();
        if (!$this->ion_auth->logged_in()) {
            redirect('readers/login'.$_SESSION['in_sub_domain']['get_param_subdomain']);
        }
        $data['page_title'] = 'Readers / Account panel';
        $data['menu_title'] = 'my account';

        // Get readers information
        $data['reader_info'] = $this->getReaderInfo();
        
        $data['form_action']     = "readers/account".$_SESSION['in_sub_domain']['get_param_subdomain'];
        $data['form_attributes'] = array(
            'onsubmit' => 'return false;',
            'class' => 'account_form',
            'name' => 'readers_account'
        );
        
        // Get School list
        $this->load->model('admin_model');
        $data['schools'] = $this->admin_model->getSchools();

        // Get profile avatars from the avatar folder
        $data['avatars'] = array_diff( scandir(FCPATH . '/assets/avatar'), array(".", ".."));

        $this->form_validation->set_rules('email', 'first_name', 'trim|required');
        
        if ($this->input->post()) {
            // Update reader's account information
            if ($this->form_validation->run() == FALSE) {
                // set the form validation message in flashdata
                $message = array();
                
                if (form_error('email')) {
                    $message['email'] = form_error('email');
                }
                
                // load message information in sessoin
                $this->session->set_flashdata('message', $message);
                
                redirect ('readers/account'.$_SESSION['in_sub_domain']['get_param_subdomain']);
            } else {
                // process update

                $info = array(
                    'email' => $this->input->post('email'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'birthdate' =>  nice_date($this->input->post('birthdate'), 'Y-m-d'),
                    'gender'    =>  $this->input->post('gender'),
                    'address_id'    => $this->input->post('placeID'),
                    'address'    => $this->input->post('address'),
                    'apt'       =>  $this->input->post('apt'),
                    'city'       =>  $this->input->post('city'),
                    'state'       =>  $this->input->post('state'),
                    'zip'       =>  $this->input->post('zip'),
                    'in_city'   => $this->input->post('i_am_in_city'),
                    'phone' => $this->input->post('phone'),
                    'library_id' => $this->input->post('library_id'),
                    'school_id' => $this->input->post('school_id')
                );
                
                if ($this->readers_model->updateReader($info)) {
                    $this->session->set_flashdata('success', "Readers account information changed successfully");
                }
                
                redirect('readers/account'.$_SESSION['in_sub_domain']['get_param_subdomain']);
            }
        }
        
        $this->load->view('new/template/header', $data);
        //$this->load->view('new/template/top_nav', $data);
        $this->load->view('account', $data);
        $this->load->view('new/template/footer', $data);
    }

    public function addNewReadLog() {
        $this->sub_domain_check->subDomainCheck();
        if (!$this->ion_auth->logged_in()) {
            redirect('readers/login'.$_SESSION['in_sub_domain']['get_param_subdomain']);
        }

        // Login form validation
        $this->form_validation->set_rules('title', 'Book Title', 'trim|required');
        $this->form_validation->set_rules('duration', 'How long you read', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            // set the form validation message in flashdata
            $message = array();
            
            if (form_error('title')) {
                $message['title'] = form_error('title');
            }
            
            if (form_error('duration')) {
                $message['duration'] = form_error('duration');
            }

            // load message information in sessoin
            $this->session->set_flashdata('message', $message);
            
            redirect ('readers/read_logs'.$_SESSION['in_sub_domain']['get_param_subdomain']);
        } else {
            
            // Getting form values
            //$username = $this->input->post('username');
            $data['title']    = $this->input->post('title');
            $data['author']    = $this->input->post('author');
            $data['isbn'] = $this->input->post('isbn');
            $data['date'] = nice_date($this->input->post('date'), 'Y-m-d');//date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('date'))));
            $data['duration'] = $this->input->post('duration');
            
            if ($this->readers_model->addNewReadLog($data)) {
                $this->session->set_flashdata('success', 'New read logs added successfully');
                redirect('readers/read_logs'.$_SESSION['in_sub_domain']['get_param_subdomain']);
            } else {
                $this->session->set_flashdata('error', 'Something went wrong, please try agin');
                redirect('readers/read_logs'.$_SESSION['in_sub_domain']['get_param_subdomain']);
            }
        } 
    }

    /**
     * Show lits of all books read by reader
     * @return array
     * @author Md Fakhrul Islam <fimaruf@gmail.com>
     */ 
    public function read_Logs() {
        $this->sub_domain_check->subDomainCheck();
        if (!$this->ion_auth->logged_in()) {
            redirect('readers/login'.$_SESSION['in_sub_domain']['get_param_subdomain']);
        }
        
        $data['page_title'] = 'Read Logs';
        $data['menu_title'] = 'read logs';

        $data['reader_info'] = $this->getReaderInfo();

        // Get profile avatars from the avatar folder
        $data['avatars'] = array_diff( scandir(FCPATH . '/assets/avatar'), array(".", ".."));

        // get readers books log 
        if ($readers_books = $this->readers_model->getReaderBooks($this->ion_auth->get_user_id())) {
            $data['readers_books'] = $readers_books;
        }

        

        $this->load->view('new/template/header', $data);
        //$this->load->view('new/template/top_nav', $data);
        $this->load->view('read_logs', $data);
        $this->load->view('new/template/footer', $data);
    }

    /**
     * Show lits of all books read by reader
     * @return array
     * @author Md Fakhrul Islam <fimaruf@gmail.com>
     */ 
    public function changeAvatar() {
        $this->sub_domain_check->subDomainCheck();
        if (!$this->ion_auth->logged_in()) {
            redirect('readers/login'.$_SESSION['in_sub_domain']['get_param_subdomain']);
        }
        
        $avatar = str_replace(base_url().'assets/avatar/', '', $this->input->get('avatar'));
        if ($this->readers_model->changeAvatar($avatar))
            $this->session->set_flashdata('success', 'Avatar changed successfully');
        redirect("readers/account".$_SESSION['in_sub_domain']['get_param_subdomain']);
    }
    
    public function change_password()
    {
        $this->sub_domain_check->subDomainCheck();
        if (!$this->ion_auth->logged_in()) {
            redirect('readers/login'.$_SESSION['in_sub_domain']['get_param_subdomain']);
        }
        $data['page_title'] = 'Readers / Change Password';
        
        $data['reader_info'] = $this->getReaderInfo();
        
        // Login form validation
        $this->form_validation->set_rules('old_password', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
        
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
            $this->load->view('new/template/header', $data);
            //$this->load->view('main/top_nav', $data);
            $this->load->view('change_password', $data);
            $this->load->view('new/template/footer');
        } else {
            $identity = $this->session->identity;
            
            // Get form values
            $current_password = $this->input->post('old_password');
            $password         = $this->input->post('password');
            
            
            // Change password for identity
            if ($this->ion_auth->change_password($identity, $current_password, $password)) {
                // check if email needs to be changed
                if ($identity != $this->input->post('email')) {
                    // Get user id
                    $user_id       = $this->ion_auth->get_user_id();
                    $data['email'] = $this->input->post('email');
                    
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
                redirect('readers/account'.$_SESSION['in_sub_domain']['get_param_subdomain']);
            } else {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
                redirect('readers/change_password'.$_SESSION['in_sub_domain']['get_param_subdomain']);
            }
        }   
    }
    
    public function signup()
    {
        $this->sub_domain_check->subDomainCheck();
        
        if ($this->ion_auth->logged_in()) {
            redirect('readers/account'.$_SESSION['in_sub_domain']['get_param_subdomain']);
        }
        $data                    = array();
        $data['page_title']      = "Signup";
        $data['form_action']     = "readers/signup".$_SESSION['in_sub_domain']['get_param_subdomain'];
        $data['form_attributes'] = array(
            'id' => 'signupFormValidation'
        );
        $identity_column         = $this->config->item('identity', 'ion_auth');

        // Get School list
        $this->load->model('admin_model');
        $data['schools'] = $this->admin_model->getSchools();
        
        if ($this->input->post()) {
            // add some form validation
            $this->form_validation->set_rules('firstName', 'First Name', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('password', 'New Password', 'trim|required');
            $this->form_validation->set_rules('passwordConfirm', 'Confirm Password', 'trim|required|matches[password]');
            
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
                
                redirect ('readers/signup'.$_SESSION['in_sub_domain']['get_param_subdomain']);
            } else {
                
                // Getting form values
                //$username = $this->input->post('username');
                $email    = $this->input->post('email');
                $password = $this->input->post('password');
                
                $identity = ($identity_column === 'email') ? $email : $this->input->post('username');
                
                $s_data               = array();
                $s_data['first_name'] = $this->input->post('firstName');
                $s_data['last_name']  = $this->input->post('lastName');
                $school_id = $this->input->post('school_id');
                
                if ($this->ion_auth->register($identity, $password, $email, $s_data)) {
                    // Update signup point if active from admin
                    // Update School ID
                    $this->load->model('readers_model');
                    
                    if($school_id != ''){
                        $this->readers_model->updateUserSchool($email, $school_id);
                    }
                    
                    if($_SESSION['in_sub_domain']['original_library_id']){
                        $this->readers_model->updateUserLibrary($email, $_SESSION['in_sub_domain']['original_library_id']);
                    }
                    
                    
                    // send email 
                    $this->load->library('email');

                    $this->email->from($this->config->item('admin_email'), $this->config->item('site_title'));
                    $this->email->to($email);

                    $this->email->subject('Thanks for Signing up at' . $this->config->item('site_title'));
                    $this->email->message('Testing the email class.');

                    // Signup email
                    $this->email->send();

                    $this->session->set_flashdata('success', $this->ion_auth->messages());
                    redirect('readers/login'.$_SESSION['in_sub_domain']['get_param_subdomain']);
                } else {
                    $this->session->set_flashdata('error', $this->ion_auth->errors());
                    redirect('readers/signup'.$_SESSION['in_sub_domain']['get_param_subdomain']);
                }
                //redirect('readers/login');
            } 
        }

        // Load view files
        $this->load->view('new/template/header', $data);
        //$this->load->view('main/top_nav', $data);
        $this->load->view('signup', $data);
        $this->load->view('new/template/footer');
    }
    
    public function forgot()
    {
        $this->sub_domain_check->subDomainCheck();
        // redirect users if logged in
        if($this->ion_auth->logged_in()) {
          redirect('readers/account'.$_SESSION['in_sub_domain']['get_param_subdomain']);
        }

        $data['page_title'] = 'Forgot Password';

        $data['form_action']     = "readers/forgot".$_SESSION['in_sub_domain']['get_param_subdomain'];
        $data['form_attributes'] = array(
            'id' => 'forgotPassword'
        );

        // Get current identity type and set things
        $this->form_validation->set_rules('email', 'Email', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
          $message = array();
          if (form_error('identity')) {
              $message['identity'] = form_error('identity');
          }
          // load message information in sessoin
          $this->session->set_flashdata('message', $message);
        } else {
          $email = $this->input->post('email');

          //call forgot password function from ion_auth
          if ($this->ion_auth->forgotten_password($email)) {
            $this->session->set_flashdata('success', $this->ion_auth->messages());
            redirect('readers/login'.$_SESSION['in_sub_domain']['get_param_subdomain']);
          } else {
            $this->session->set_flashdata('error', $this->ion_auth->errors());
            redirect('readers/forgot'.$_SESSION['in_sub_domain']['get_param_subdomain']);
          }
        }

        $this->load->view('new/template/header', $data);
        //$this->load->view('main/top_nav', $data);
        $this->load->view('forgot', $data);
        $this->load->view('new/template/footer');
    }

    private function getReaderInfo() {
        // Get reader's information from database
        $reader_info = $this->readers_model->getReader($this->ion_auth->get_user_id());

        // get total user points 
        $readers_total_point = $this->readers_model->getReadersTotalPoint($this->ion_auth->get_user_id());
        $reader_info->total_points = $readers_total_point;

        // get total user books 
        $readers_total_books = $this->books_model->getTotalBooksCount($this->ion_auth->get_user_id());
        $reader_info->total_books = $readers_total_books;

        // get total duration
        $readers_total_duration = $this->readers_model->getTotalReadDuration($this->ion_auth->get_user_id());
        $reader_info->total_duration = $readers_total_duration;

        // get user badges
        
        $reader_badges = $this->readers_model->getReaderBadges($this->ion_auth->get_user_id(), $readers_total_point);
        $reader_info->badges = $reader_badges;

        if ($reader_info) {
            return $reader_info;
        } else return false;
    }
    
    public function login()
    {
        $this->sub_domain_check->subDomainCheck();
        if ($this->ion_auth->logged_in()) {
            redirect('readers/account'.$_SESSION['in_sub_domain']['get_param_subdomain']);
        }
        
        // Data to be passed to views
        $data['page_title']      = 'Login';
        $data['form_action']     = "readers/login".$_SESSION['in_sub_domain']['get_param_subdomain'];
        $data['form_attributes'] = array(
            'id' => 'loginFormValidation'
        );
        $identity_column         = $this->config->item('identity', 'ion_auth');
        //$data['menu_item'] = 'Account';
        
        // all message to show as notification
        
        
        // Get current identity type and set things
        $this->form_validation->set_rules('email', 'Username', 'trim|required');
        
        
        // Login form validation, identity is username or email
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        
        
        // Loading views or redirecting
        if ($this->form_validation->run() == FALSE) {
            // set the form validation message in flashdata
            $message = array();
            
            if (form_error('identity')) {
                $message['identity'] = form_error('identity');
            }
            
            if (form_error('password')) {
                $message['password'] = form_error('password');
            }
            
            // load message information in sessoin
            $this->session->set_flashdata('message', $message);
            
            
        } else {
            $email    = $this->input->post('email');
            $password = $this->input->post('password');
            $remember = (bool)$this->input->post('remember');

           

            // check if admin
            // Admin user supposed not to enter into readers login panel
            // however from admin login panel it works as usual
            //if ($this->readers_model->getUserType($email) == 0) // 0 = admin 
            //{
            //    $this->session->set_flashdata('error', 'Ahh! something went wrong, probably user is not allowed');
            //    redirect('readers/login');
            //}

            
            // Try to login
            // login() - Logs the user into the system, returns true if the user was successfully logged
            if ($this->ion_auth->login($email, $password, $remember)) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                
                redirect('readers/account'.$_SESSION['in_sub_domain']['get_param_subdomain']);
            } else {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
                redirect('readers/login'.$_SESSION['in_sub_domain']['get_param_subdomain']);
            }
        }

        $this->load->view('new/template/header', $data);
        //$this->load->view('main/top_nav', $data);
        $this->load->view('login', $data);
        $this->load->view('new/template/footer', $data);
    }
    
    /**
     * Account logout
     */
    public function logout()
    {
        $this->sub_domain_check->subDomainCheck();
        $data['page_title'] = 'Logout';
        
        $this->ion_auth->logout();
        $this->session->set_flashdata('isLoggedOut', 1);
        redirect('readers/login'.$_SESSION['in_sub_domain']['get_param_subdomain']);
    }
    
    
}