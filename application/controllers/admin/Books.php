<?php defined('BASEPATH') OR ext('No direct script access allowed');

class Books extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
      	$this->load->helper('form');
      	$this->load->library('form_validation', 'google');
      	$this->load->database();

      	$this->load->model('books_model');
	}

	public function index($userid = NULL)
	{
		if (!$this->ion_auth->logged_in())
	    {
	        redirect('admin/users/login');
	    }

		$data = array();
		$data['page_title'] = "Readers Books";
		$data['menu_title'] = "readers";

		if(@$_GET['s']){
			if(is_numeric ($_GET['s'])){
				$currentYear = $_GET['s'];
			}else{
				$currentYear = false;
			}
		}else{
			$currentYear = false;
		}
		
		
		// get latest books
        // /* Get recent books from Database */
        $data['books_count'] = 50;
        if ($userid !== NULL) {
            $books = $this->books_model->getLatestBooks($data['books_count'], 'id', $userid,$currentYear);
            //$this->my_library->print_r($books
               $data['page_title'] = "All books read by " . $books[0]->name . " <span class='text-success'>[ <a href='" . base_url() . "admin/readers' class='text-success'>back to readers list</a> ]</span>";
        } else {
            $books = $this->books_model->getLatestBooks($data['books_count'],'id',false,$currentYear);
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

        //$this->my_library->print_r($books);
        $latest_books[] = array();

		if($books){
			foreach ($books as $key => $book) {
				if($book->id == 38){
					continue;
				}
				$duration[$key] = $book->duration;
				$param = array(
					'title' => $book->title,
					'isbn'  => $book->isbn,
					'author'=> $book->author
				);
	
				// load books library
				$this->load->library('books_library');
				$book_details = $this->books_library->searchBook($param);
	
				/*$latest_books[$key] = array(
					'book_id' => $books->book_id,
					'title' => $books->title,
					'author' => $books->author,
					'isbn' => $books->isbn,
					'readerName' => $books->name,
					'readerEmail' => $books->email,
					'duration'	=> $books->duration
				);*/
	
				$book_details = $this->books_library->searchBook($param);
				$book_details['duration'] = $book->duration;
				$book_details['id'] = $book->book_id;
				$book_details['readers_count'] = $this->books_model->getReadersCountPerBook($book->book_id);
				$book_details['amazon_url'] = (isset($book_details['isbn_10']) ? $data['amazon_url'] . $book_details['isbn_10'] . '/?tag=' . $data['amazon_key'] : false);
	
				//$this->my_library->print_r($book_details);
	
				$latest_books[$key] = $book_details;
			}
		}
        

        $data['books_reading'] = $latest_books;

		// Load view files
		$this->load->view('admin/main/header', $data);
        $this->load->view('admin/main/left', $data);
        $this->load->view('admin/main/top_nav', $data);
        $this->load->view('admin/books', $data);
        $this->load->view('admin/main/footer');
	}

	public function new_book()
	{

		$data = array();
		$data['page_title'] = 'Add new book';
		$data['menu_title'] = 'New Book';
		
		// Load view files
		$this->load->view('admin/main/header', $data);
        $this->load->view('admin/main/left', $data);
        $this->load->view('admin/main/top_nav', $data);
        $this->load->view('admin/new_book', $data);
        $this->load->view('admin/main/footer');
	}
}