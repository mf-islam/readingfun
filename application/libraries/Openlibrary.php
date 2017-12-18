<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
set_include_path(APPPATH . 'third_party/' . PATH_SEPARATOR . get_include_path());

class Openlibrary extends Public_Controller {
	#@var string Version of this class
	const VERSION = '0.0.2';

	#@var string API KEY
	private $_apikey;

	public function  __construct() {
		$this->ci = & get_instance();

		$this->config = $this->ci->config;

	}

	public function getBookDetails($param)
	{

		if (count(array_filter($param)) > 0) {
			if ($param['isbn'] != '') {
				$text = 'ISBN:' . $param['isbn'];
				$_api_url = 'https://openlibrary.org/api/books';
			} elseif ($param['title'] != '') {
				$_api_url = 'http://openlibrary.org/search.json?q=';
				$text = $param['title'];
			} elseif ($param['author'] != '') {
				$_api_url = 'http://openlibrary.org/search.json?author=';
				$text = $param['author'];
			}

			$url= Openlibrary::$_api_url."?bibkeys=" . $text . "&jscmd=details&format=json";
			if ($details = $this->_call($text, $url)) {
				return $details['ISBN:' . $param['isbn'] ];
			}
		} else {
			return false;
		}

		return false;
	}

	public function getBookData($param)
	{
		if (count(array_filter($param)) > 0) {
			if ($param['isbn'] != '') {
				$text = '?bibkeys=ISBN:' . $param['isbn'];
				$_api_url = 'https://openlibrary.org/api/books';
			} elseif ($param['title'] != '') {
				$_api_url = 'http://openlibrary.org/search.json?q=';
				$text = $param['title'];
			} elseif ($param['author'] != '') {
				$_api_url = 'http://openlibrary.org/search.json?author=';
				$text = $param['author'];
			}

			$url= $_api_url . $text . "&jscmd=data&format=json";
			if ($details = $this->_call($text, $url)) {
				return $details['ISBN:' . $param['isbn']];
			}
		} else {
			return false;
		}

		return false;
	}

	
	/**
	 * Makes the call to the API
	 *
	 * @param string $action	API specific function name for in the URL
	 * @param string $text		Unencoded paramter for in the URL
	 * @return string
	 */
		private function _call($text, $url){
			
			$url = preg_replace("/ /", "%20", $url);

			$json_response = file_get_contents($url);
			$object_response = json_decode($json_response, true);



			return (array) $object_response;
		}//end of _call
} //end of class