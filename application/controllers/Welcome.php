<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Public_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('is_admin') == TRUE){
			redirect('admin');
		}
		
		if(@$_GET['lib_id']){
			$this->sub_domain_check->subDomainCheck();
		}else{
			unset($_SESSION['in_sub_domain']);
		}
		
		if(!isset($_SESSION['in_sub_domain']['get_param_subdomain'])){
			$_SESSION['in_sub_domain']['get_param_subdomain'] = false;
		}
	}
	 
	public function index()
	{
		$this->load->helper(array('url', 'installer'));
		$this->load->model('books_model');
		$this->load->model('readers_model');
		
		if(! is_installed()){
			redirect('install');
		}

		$data = array();
		$data['page_title'] = 'Home';

		// get settings
		if ($settings = $this->readers_model->getSettings()) {
            $settings_info = array();

			if(isset($_SESSION['in_sub_domain']['lib_id'])){
				$settings = json_decode($settings[0]->general_settings);
				
				if($settings){
					foreach ($settings as $key => $value) {
						$settings_info[$value->name] = $value->is_active;
					}
				}else{
					$settings_info = false;
				}
				
				
			}else{
				foreach ($settings as $key => $value) {
					$settings_info[$value->name] = $value->value;
				}
			}
			
            
        }

        // get Amazon API details
		$api_info = $this->books_model->getApi();

		// return is an multidimentional array
		// search if there is any value named google in value
		$key = array_search('amazon', array_column($api_info, 'name'));

		if (null !== $key) {
			$data['amazon_url'] = $api_info[$key]['url'];
			$data['amazon_key'] = $api_info[$key]['key'];
		} else {
			$data['amazon_url'] = "https://www.amazon.com/dp/";
			$data['amazon_key'] = "readi01c-20";
		}

        $data['settings'] = $settings_info;
		
		

        //$this->my_library->print_r($settings_info);

		/* Get recent books from Database */
		$books = $this->books_model->getLatestBooks($settings_info['no_of_latest_books']);

		// echo '<pre>';
		// if(isset($_SESSION['in_sub_domain']['get_param_subdomain'])){
		// 	print_r($_SESSION['in_sub_domain']['lib_id']);
		// }
	
		// echo '</pre>';
		// exit;

				//array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $data);
		$latest_books[] = array();

		
		if($books){
			foreach ($books as $key => $book) {
			
				if($book->id == 38){
					continue;
				}
				
				$duration[$key] = $book->duration;
				$param = array(
					'title' => $book->title,
					'isbn'	=> $book->isbn,
					'author'=> $book->author
				);
	
				// load books library
				$this->load->library('books_library');
	
				$book_details = $this->books_library->searchBook($param);
				$book_details['duration'] = $book->duration;
				$book_details['id'] = $book->book_id;
				$book_details['readers_count'] = $this->books_model->getReadersCountPerBook($book->book_id);
				$book_details['amazon_url'] = (isset($book_details['isbn_10']) ? $data['amazon_url'] . $book_details['isbn_10'] . '/?tag=' . $data['amazon_key'] : false);
	
				//$this->my_library->print_r($book_details);
				
	
				$latest_books[$key] = $book_details;
			}
		}
		



		//$this->my_library->print_r($latest_books);
		$data['latest_books'] = $latest_books;

		// Top books
		// sort array based on duration

		if($latest_books[0]){
			array_multisort($duration, SORT_DESC, $latest_books);
		}
		
		$data['top_books'] = $latest_books;

		//$this->my_library->print_r($settings_info);

		// Get top readers
		$data['number_of_readers'] = $settings_info['no_of_readers'];
		$this->load->model('Readers_model');
		$data['top_readers'] = $this->readers_model->getTopReaders($data['number_of_readers']);

		// get Top School
		$this->load->model('admin_model');
		$data['top_schools'] = $this->admin_model->getSchools('points', $settings_info['no_of_schools']);
		//$this->my_library->print_r($data['top_schools']);

		$this->load->view('new/template/header', $data);
        //$this->load->view('main/top_nav', $data);
        $this->load->view('home', $data);
        $this->load->view('new/template/footer');
	}

	public function disclaimer() {
		$this->subDomainCheck();
		$data = array();
		$data['page_title'] = 'Disclaimer';

		$this->load->view('new/template/header', $data);
        //$this->load->view('main/top_nav', $data);
        $this->load->view('disclaimer', $data);
        $this->load->view('new/template/footer');
	}

	public function events() {
		$data = array();
		$data['page_title'] = 'Events';

		$this->load->view('new/template/header', $data);
        //$this->load->view('main/top_nav', $data);
        $this->load->view('events', $data);
        $this->load->view('new/template/footer');
	}

	public function programs() {
		$data = array();
		$data['page_title'] = 'Programs';

		$this->load->view('new/template/header', $data);
        //$this->load->view('main/top_nav', $data);
        $this->load->view('programs', $data);
        $this->load->view('new/template/footer');
	}

	/**
	 * call this function with cron to delete all files from Google API
	 * @return void
	 * @last_modified March 4, 2017
	 * @by Md Fakhrul Islam
	 */
	public function deleteSavedFiles() {
		$path = FCPATH. '/files/';

		if (file_exists($path . 'index.html')) {
			$time = filemtime($path); // 1380387841

			array_map('unlink', glob( "$path*.txt"));
		}
	}
}
