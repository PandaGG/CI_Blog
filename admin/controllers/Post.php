<?php
class Post extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		
	}
	
	public function index(){
		$this->load->view('posts/post_list');
	}
}
