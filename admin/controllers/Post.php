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

    public function edit($pid = NULL){
        if($pid === NULL){
            show_404();
        }else {
            $data['categories'] = $this->Category_model->get_category();
            $data['post'] = $this->Post_model->get_post_info($pid);
            $this->load->view('posts/post_edit', $data);
        }
    }

    public function insert(){
        $cid = $this->input->post('cid');
        $title = $this->input->post('title');
        $slug = $this->input->post('slug');
        $description = $this->input->post('description');
        $context = $this->input->post('context');
        $html_context = html_escape(strip_slashes($context));
        $status = 'draft';

        $result = $this->Post_model->insert_post($cid, $title, $slug, $description, $context, $status);
        if($result){
            $this->pageTips('添加文章成功','post', 2);
        }else{
            $this->pageTips('添加文章失败','post', 2, 'fail');
        }

    }

    public function update(){
        $pid = $this->input->post('pid');
        $cid = $this->input->post('cid');
        $title = $this->input->post('title');
        $slug = $this->input->post('slug');
        $description = $this->input->post('description');
        $context = $this->input->post('context');
        $html_context = html_escape(strip_slashes($context));
        $status = 'draft';
        $result = $this->Post_model->update_post($pid, $cid, $title, $slug, $description, $context, $status);
        if($result){
            $this->pageTips('更新文章成功','post', 2);
        }else{
            $this->pageTips('更新文章失败','post', 2, 'fail');
        }
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
