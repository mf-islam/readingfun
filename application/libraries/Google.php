<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Google extends Public_Controller {
    /*
    set api url and api key as private to set later time
     */
	private $_api_url;
	private $_apikey;

	/**
	 * __constructor for the class
	 * @author Md fakhrul Islam
	 */
	public function  __construct() {
		// Load default CI instances
		$this->ci = & get_instance();

		// load books model 
		$this->ci->load->model('books_model');

		// grab API information
		$api_info = $this->ci->books_model->getApi();

		// return is an multidimentional array
		// search if there is any value named google in value
		$key = array_search('google', array_column($api_info, 'name'));
		
		if(null !== $key) {
			$apiUrl = $api_info[$key]['url'];
			$this->setApiurl($apiUrl);

			$apikey = $api_info[$key]['key'];
			$this->setApikey($apikey);
		}
	}


	private function setApikey($apikey) {
		$this->_apikey = (string) $apikey;
	}

	private function getApikey() {
		return $this->_apikey;
	}

	private function setApiUrl ($apiUrl) {
		$this->_api_url = (string) $apiUrl;
	}

	private function getApiUrl() {
		return $this->_api_url;
	}

	public function getBookDetails($param)
	{
		if (count(array_filter($param)) > 0) {
			if ($param['title'] != '') {
				$text = $param['title'];
			} elseif ($param['isbn'] != '') {
				$text = $param['isbn'];
			} elseif ($param['author'] != '') {
				$text = 'author:' . $param['author'];
			}

			if ($details = $this->_call($text)) {
				return $details['items'][0];
			}
		} else {
			return false;
		}

		return fasle;
	}

	public function getBookIsbnByTitle($title)
	{
		$details = $this->getBookDetails($title);
		$isbn = $details['items'][0]['volumeInfo']['industryIdentifiers'][0]['identifier'];

		return $isbn;
	}

	private function _call($text){
		$url= $this->getApiUrl()."?q=" . $text . "&key=".$this->getApikey();

		$url = preg_replace("/ /", "%20", $url);

		//$json_response = file_get_contents($url);
		
		// open the file using the HTTP headers set
		try{
			$json_response = file_get_contents($url, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false)))); 
		} catch (Exception $e) {
			// print some messages
		}
		
		$object_response = json_decode($json_response, true);

		return (array) $object_response;
	}


} //end of class