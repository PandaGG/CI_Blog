<?php
class Post extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->load->model('Post_model');
        $this->load->model('Category_model');
	}
	
	public function index(){
        $data['posts'] = $this->Post_model->get_posts();
		$this->load->view('posts/post_list',$data);
	}

    public function create(){
        $data['categories'] = $this->Category_model->get_category();
        $this->load->view('posts/post_create',$data);
    }

    public function insert(){
        $cid = $this->input->post('cid');
    }

	public function group_operation(){
        $ids = $this->input->post('ids');
        if($this->input->post('group-move')){

            return;
        }

		if($this->input->post('group-trash')){

            return;
        }

	}


}
