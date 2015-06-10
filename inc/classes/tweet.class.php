<?php

class Tweet {
	// public $id;
	public $name;
	public $tweet;
	public $date;

	public function __construct($name,$tweet,$date) {
		$this->name = $name;
		$this->tweet = $tweet;
		$this->date = $date;
	}

}



?>