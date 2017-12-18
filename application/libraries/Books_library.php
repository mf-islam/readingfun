<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Books_library {
	public function __construct() {
		// Load default CI instances
		$this->ci = & get_instance();
	}

	public function searchBook($data = array()) {
		/*if (null !== $data['isbn']) {
			$key = $data['isbn'];
		} elseif (null !== $data['title']) {
			$key = str_replace(' ', '_', $data['title']);
		} else {
			return false;
		}*/

		if (null !== $data['title']) {
			$key = $data['title'];
		} elseif (null !== $data['isbn']) {
			$key = $data['isbn'];
		} else {
			return false;
		}

		

		// when searching to get book details during read log
		// it will search in database and file and then api
		/*if (isset($data['source']) and $data['source'] == 'input') {
			if (null !== $key) {
				return $this->doSearch($key, $data);
			} 
		} else {
			return $this->doSearch($key, $data);
		}*/

		return $this->doSearch($key, $data);
	}

	private function doSearch($key, $data = array()) {
		
		if ($bookDetails = $this->searchFromFile(str_replace(' ', '_', $key))) { // information found in text file
			$bookInfo  = array();
			$bookInfo['title'] = $bookDetails['volumeInfo']['title'];
			$bookInfo['author'] = $bookDetails['volumeInfo']['authors'][0];

			foreach ($bookDetails['volumeInfo']['industryIdentifiers'] as $isbn) {
				$bookInfo[strtolower($isbn['type'])] = $isbn['identifier'];
			}
			
			$bookInfo['isbn'] = (null !== $data['isbn'] ? $data['isbn'] : (sizeof($bookDetails['volumeInfo']['industryIdentifiers']) > 1 ? $bookDetails['volumeInfo']['industryIdentifiers'][1]['identifier'] : $bookDetails['volumeInfo']['industryIdentifiers'][0]['identifier']));
			$bookInfo['thumb'] = $bookDetails['volumeInfo']['imageLinks']['thumbnail'];

			return $bookInfo;
		} elseif ($bookDetails = $this->searchFromApi($data)) {
			$bookInfo  = array();
			$bookInfo['title'] = $bookDetails['volumeInfo']['title'];
			$bookInfo['author'] = $bookDetails['volumeInfo']['authors'][0];
			$bookInfo['isbn'] = (null !== $data['isbn'] ? $data['isbn'] : (sizeof($bookDetails['volumeInfo']['industryIdentifiers']) > 1 ? $bookDetails['volumeInfo']['industryIdentifiers'][1]['identifier'] : $bookDetails['volumeInfo']['industryIdentifiers'][0]['identifier']));
			$bookInfo['thumb'] = $bookDetails['volumeInfo']['imageLinks']['thumbnail'];

			// Save file
			$bookDetails['source'] = '';

			// by ISBN
			$fileName = 'files/'. $bookInfo['isbn'].".txt";
			$fh = fopen($fileName, 'w') or die("can't open file");
			fwrite($fh, json_encode($bookDetails));

			// by Title
			$fileName = 'files/'. str_replace(" ", "_", $bookInfo['title'] .".txt");
			$fh = fopen($fileName, 'w') or die("can't open file");
			fwrite($fh, json_encode($bookDetails));
			fclose($fh);

			return $bookInfo;
		}
	}

	

	private function searchFromFile( $key ) {
		if (file_exists('files/' . $key .'.txt')) {
			$json_data = file_get_contents('files/'. $key. '.txt');
			$bookDetails = json_decode($json_data, true);
			$bookDetails['source'] = 'text_file';

			return $bookDetails;
		} else return false;
	}

	private function searchFromApi($param) {

		// right now we will be using only google API
		$this->ci->load->library('google');
		if ($bookDetails = $this->ci->google->getBookDetails($param)) {
			$bookDetails['source'] = 'google';
		}

		return $bookDetails;
		/*switch ($this->config->item('default_api')) {
			case 'google':
				if ($this->google->getBookDetails($param)) {
					$bookDetails = $this->google->getBookDetails($param);
					$bookDetails['source'] = 'google';
				}

				return $bookDetails;
				break;
			
			case 'openlibrary':
				if ($this->openlibrary->getBookData($param)) {
					$bookDetails = $this->openlibrary->getBookDetails($param);
					$bookDetails['source'] = 'openlibrary';
				}

				return $bookDetails;
				break;

			default:
				$bookDetails = false;
				return $bookDetails;
				break;
		}*/
	}
}