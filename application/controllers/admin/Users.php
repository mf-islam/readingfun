<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{
    
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->database();
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }
    
    /**
     * Index Page for this controller
     */
    public function index()
    {
        // Data to be passed to views
        $data['page_title'] = 'List of Users';
        $data['menu_item']  = 'Users';
        
        // List of users
        // get_all_users_with_group() added to library by me
        $data['users'] = $this->ion_auth->get_all_users_with_group()->result_array();
        
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/login');
        } else {
            if ($this->ion_auth->is_admin()) {
                // Loading views
                $this->load->view('template/header', $data);
                $this->load->view('users_list_view', $data);
                $this->load->view('template/footer');
            } else {
                redirect('unauthorized');
            }
        }
    }
    
    /**
     * Account login
     */
    public function login()
    {
        if ($this->ion_auth->logged_in()) {
            redirect('admin/dashboard');
        }
        
        // Data to be passed to views
        $data['page_title'] = 'Admin panel login';
        //$data['menu_item'] = 'Account';
        
        // all message to show as notification
        
        
        // Get current identity type and set things
        if ($this->config->item('identity', 'ion_auth') == 'email') {
            $data['identity_label'] = 'Email';
            $this->form_validation->set_rules('identity', 'Email', 'trim|required|valid_email');
        } else if ($this->config->item('identity', 'ion_auth') == 'username') {
            $data['identity_label'] = 'Username';
            $this->form_validation->set_rules('identity', 'Username', 'trim|required');
        }
        
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
            
            $this->load->view('admin/main/header', $data);
            //$this->load->view('home/left', $data);
            $this->load->view('admin/login', $data);
            $this->load->view('admin/main/footer');
        } else {
            // Get form values
            $identity = $this->input->post('identity');
            $password = $this->input->post('password');
            $remember = (bool) $this->input->post('remember');
            
            // Try to login
            // login() - Logs the user into the system, returns true if the user was successfully logged
            if ($this->ion_auth->adminLogin($identity, $password, $remember)) {
                
                
                if ($validate_admin = $this->ion_auth->is_admin_validate($this->session->userdata('user_id'))) {
                    
                    if($validate_admin->group_id == 1 || $validate_admin->group_id == 3){
                        $getLibraryId = $this->ion_auth->getLibraryId($this->session->userdata('user_id'));

                        if($validate_admin->group_id == 3){
                            $this->session->set_userdata('library_id', $getLibraryId->library_id);
                        }
                        
                        $this->session->set_userdata('admin_group_id', $validate_admin->group_id);
                        $this->session->set_userdata('is_admin', true);
                        
                        redirect('admin/dashboard');
                    }else {
                        $this->session->set_flashdata('error', "You are not allowed");
                        redirect('readers/login');
                    }
                } else {
                    $this->session->set_flashdata('error', "You are not allowed");
                    redirect('readers/login');
                }
            } else {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
                
                redirect('admin/users/login');
            }
        }
    }
    
    /**
     * Account logout
     */
    public function logout()
    {
        
        $data['page_title'] = 'Logout';
        $data['menu_item']  = 'Account';
        
        $this->ion_auth->logout();
        $this->session->set_flashdata('isLoggedOut', 1);
        redirect('admin/login');
    }
    
    /**
     * Add a new user
     */
    public function add()
    {
        // Data to be passed to views
        $data['page_title'] = 'Add new user';
        $data['menu_item']  = 'Users';
        
        // Data for edit form, here are empty to avoid error
        $data['edit_admin_values']  = array(
            'username' => '',
            'email' => ''
        );
        $data['edit_admin_values2'] = array(
            'name' => ''
        );
        
        if (!$this->ion_auth->is_admin()) {
            redirect('unauthorized');
        } else {
            // 'Add new user' form validation
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[20]|is_unique[users.username]', array(
                'is_unique' => 'Sorry, that username is already taken.'
            ));
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array(
                'is_unique' => 'Sorry, that email address is already taken.'
            ));
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[20]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[6]|max_length[20]|matches[password]');
            
            // Getting form values
            $username = $this->input->post('username');
            $email    = $this->input->post('email');
            $password = $this->input->post('password');
            $group    = $this->input->post('group');
            $group_id = array(
                $group
            );
            
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data);
                $this->load->view('users_add_edit_view', $data);
                $this->load->view('template/footer');
            } else {
                // register() - Register (create) a new user
                if ($this->ion_auth->register($username, $password, $email, '', $group_id)) {
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect('users');
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect('users/add');
                }
            }
        }
    }
    
    /**
     * Edit user
     */
    public function edit($id = NULL)
    {
        // Data to be passed to views
        $data['page_title'] = 'Edit user';
        $data['menu_item']  = 'Users';
        
        if (!$id) {
            show_404();
        }
        
        if (!$this->ion_auth->is_admin()) {
            redirect('unauthorized');
        } else {
            // 'Edit user' form validation
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[20]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            
            // Getting form values
            $username = $this->input->post('username');
            $email    = $this->input->post('email');
            $password = $this->input->post('password');
            $group    = $this->input->post('group');
            $group_id = array(
                $group
            );
            
            if ($this->form_validation->run() == FALSE) {
                // Get current user data. Will be shown in the form
                $data['edit_admin_values']  = $this->ion_auth->user($id)->row_array();
                $data['edit_admin_values2'] = $this->ion_auth->get_users_groups($id)->row_array();
                
                // Loading views
                $this->load->view('template/header', $data);
                $this->load->view('users_add_edit_view', $data);
                $this->load->view('template/footer');
            } else {
                // New user data
                $data = array(
                    'username' => $username,
                    'email' => $email,
                    'password' => $password
                );
                
                // Update user
                $this->ion_auth->update($id, $data);
                // Update user's group
                $this->ion_auth->remove_from_group('', $id);
                $this->ion_auth->add_to_group($group_id, $id);
                
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('users');
            }
        }
    }
    
    /**
     * Activate user with provided id number
     */
    public function activate($id = NULL)
    {
        
        if (!$id) {
            show_404();
        }
        
        if (!$this->ion_auth->is_admin()) {
            redirect('unauthorized');
        } else {
            if ($this->ion_auth->activate($id)) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('users');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('users');
            }
        }
    }
    
    /**
     * Deactivate user with provided id number
     */
    public function deactivate($id = NULL)
    {
        
        if (!$id) {
            show_404();
        }
        
        if (!$this->ion_auth->is_admin()) {
            redirect('unauthorized');
        } else {
            if ($this->ion_auth->deactivate($id)) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('users');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('users');
            }
        }
    }
    
    /**
     * Delete user with provided id number
     */
    public function delete($id = NULL)
    {
        
        if (!$id) {
            show_404();
        }
        
        if (!$this->ion_auth->is_admin()) {
            redirect('unauthorized');
        } else {
            if ($this->ion_auth->delete_user($id)) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('users');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('users');
            }
        }
    }    
}
