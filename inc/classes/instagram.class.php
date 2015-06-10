<?php

class Instagram {
	// public $id;
	public $name;
	public $photo;
	public $text;
	public $profilePic;
	public $tags;
	public $date;


	public function __construct($name,$photo,$text,$profilePic,$tags,$date) {
		$this->name = $name;
		$this->photo = $photo;
		$this->text = $text;
		$this->profilePic = $profilePic;
		$this->tags = $tags;
		$this->date = $date;
	}


}



?>