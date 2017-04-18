<?php

/**
* SimpleCache
*/
class SimpleCache {

	private $_path;
	private $_ext;
	public $data;
	public $headers;
	
	public function __construct($_path = "./cache", $_ext = "ch", $data = [], $headers = []){

		$this->_path = rtrim($_path, "/") . "/";
		$this->_ext = "." . ltrim($_ext, ".");
		$this->data = $data;
		$this->headers = $headers;

	}

	public function get($url){

		$filename = $this->_getfilename($url, "get");

		if(file_exists($filename)){
			return file_get_contents($filename);
		}

		$ch = curl_init();

		if(!empty($this->data)){
			$data = http_build_query($this->data);
			$url .= (strpos($url, "?") !== false)? "&" . $data : "?" . $data;
		}

		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_HEADER, false);

		if(!empty($this->headers)){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3);

		$response = curl_exec($ch);
		
		$this->_writetofile($filename, $response);

		return $response;
	}

	public function post($url){

		$filename = $this->_getfilename($url, "post");

		if(file_exists($filename)){
			return file_get_contents($filename);
		}

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);

		if(!empty($this->data)){
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
		}

		if(!empty($this->headers)){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3);

		$response = curl_exec($ch);
		
		$this->_writetofile($filename, $response);

		return $response;
	}

	private function _getfilename($url, $method = "get"){

		$_filename = "";

		if(!empty($this->headers)){
			$_filename .= json_encode($this->headers);
		}

		if(!empty($this->data)){

			if($method == "get"){
				$data = http_build_query($this->data);
				$url .= (strpos($url, "?") !== false)? "&" . $data : "?" . $data;
			}else{
				$_filename .= json_encode($this->data);
			}
		}

		$_filename .= $url;

		return $this->_path . md5($_filename) . $this->_ext;
	}

	private function _writetofile($filename, $data){
		file_put_contents($filename, $data);
	}

}