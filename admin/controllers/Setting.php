<?php
class Setting extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Setting_model');
	}
	public function index(){
		$data = $this->Setting_model->get_site_info();
		$this->load->view('setting', $data);
	}

	public function update(){
		$site_name = $this->input->post('site_name');
		$site_description = $this->input->post('site_description');
		$site_keywords = $this->input->post('site_keywords');
		$copyright = $this->input->post('copyright');
		$result = $this->Setting_model->update_site_info($site_name, $site_description, $site_keywords, $copyright);
		if($result){
			$this->pageTips('设置成功','setting', 2);
		}else{
			$this->pageTips('设置失败','setting', 2, 'fail');
		}
	}
}