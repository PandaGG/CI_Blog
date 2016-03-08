<?php
class Upload extends MY_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		error_log(print_r($_FILES,true));
		error_log(print_r($_POST,true));

	}
}