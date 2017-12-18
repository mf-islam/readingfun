<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends Public_Controller {
	/**
    * Class constructor
    */
   public function __construct()
   {
      parent::__construct();

      
      // load book model
      $this->load->model('Books_model');

   }

	public function index()
	{
		exit('No direct script access allowed');
		/*if ($this->ion_auth->logged_in()) {
            redirect('readers/read_logs');
        } else {
        	redirect('/');
        }*/
       // $this->my_library->print_r($_SERVER);
        //exit;
	}

	/**
	 * [bookSearch description]
	 * @return [json_data] [description]
	 * @author [Md Fakhrul Islam]
	 */
	public function getAddressByPlaceid()
	{
		if ($this->input->get('place_id') != "") {
			$place_id = $this->input->get('place_id');
		}

		$url = 'https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $place_id .'&key=' . $this->config->item('google_api');

	  	$json_response = file_get_contents($url);
	  	$object_response = json_decode($json_response);
	  
		if($object_response->status == 'OK') {
			$address_array = explode(', ', $object_response->result->formatted_address);
			$state_zip = explode(' ', $address_array[2]);
			$address = array(
				'street' => $address_array[0],
				'city' => $address_array[1],
				'state' => $state_zip[0],
				'zip' => $state_zip[1],
			);
			print json_encode($address);
		}
	}

	/**
	 * [bookSearch description]
	 * @return [json_data] [description]
	 * @author [Md Fakhrul Islam]
	 */
	public function bookSearch($data = array())
	{
		$param = array();
		$param['title'] = (isset($data['title']) && null !== $data['title'] ? $data['title'] : $this->input->get('title'));
		$param['isbn'] = (isset($data['isbn']) && null !== $data['title'] ? $data['isbn'] : $this->input->get('isbn'));
		$param['author'] = (isset($data['author']) && null !== $data['title'] ? $data['author'] : $this->input->get('author'));

		if (!isset($data) or empty($data)) {
			$param['source'] = 'input';
		}

		$this->load->library('books_library');
		
		if ($book_details = $this->books_library->searchBook($param)) {
			if ($param['source'] == 'input') {
				print json_encode($book_details);
			} else {
				return $book_details;
			}
		} else {
			return false;
		}
	}
}