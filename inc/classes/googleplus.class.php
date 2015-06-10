<?php

class GooglePlus {
	// public $id;
	public $name;
	public $message;
	public $userLink;
	public $postLink;
	public $date;

	public function __construct($name,$message,$userLink,$postLink,$date) {
		$this->name = $name;
		$this->message = $message;
		$this->userLink = $userLink;
		$this->postLink = $postLink;
		$this->date = $date;
	}

}

?>