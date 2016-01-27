<?php
Class MY_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	protected function widget($name = '')
	{
		if (isset($name) && $name != '')
		{
			require_once APPPATH.'widgets/'.$name.'.php';
		}
	}
}