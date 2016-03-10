<?php
class Post extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->load->model('Post_model');
        $this->load->model('Category_model');
	}
	
	public function index(){
        $status = $this->input->get('status') ? $this->input->get('status') : 'all';
        $cid = $this->input->get('cid') ? $this->input->get('cid') : 0;
        $data['info']['status'] = $status;
        $data['info']['cid'] = $cid;
        $data['status'] = $status;
        $data['posts'] = $this->Post_model->get_posts();
        $data['categories'] = $this->Category_model->get_category();
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
        $status = $this->input->post('status');

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
        $status = $this->input->post('status');
        $result = $this->Post_model->update_post($pid, $cid, $title, $slug, $description, $context, $status);
        if($result){
            $this->pageTips('更新文章成功','post', 2);
        }else{
            $this->pageTips('更新文章失败','post', 2, 'fail');
        }
    }


	public function group_operation(){
        $ids = $this->input->post('ids');
        //批量移动类别
        if($this->input->post('group-move')){
            $cid = $this->input->post('group_cid');
            $result = $this->Post_model->updateCategory($ids, $cid);
            if($result){
                $this->pageTips('批量移动成功','post', 2);
            }else{
                $this->pageTips('批量移动失败','post', 2, 'fail');
            }
            return;
        }

        //批量移动至垃圾箱
		if($this->input->post('group-trash')){
            $result = $this->Post_model->updateStatus($ids, 'trash');
            if($result){
                $this->pageTips('批量移动至垃圾箱成功','post', 2);
            }else{
                $this->pageTips('批量移动至垃圾箱失败','post', 2, 'fail');
            }
            return;
        }

        //批量永久删除
        if($this->input->post('group-delete')){

            return;
        }

        //批量移出垃圾箱
        if($this->input->post('group-draft')){

            return;
        }
	}

    public function category(){
        $status = $this->input->get('status');
        $cid = $this->input->get('cid');
        if($cid == 0){
            redirect('post?status='.$status.'&cid='.$cid);
            return;
        }
        $data['info']['status'] = $status;
        $data['info']['cid'] = $cid;
        $data['status'] = $status;
        $data['posts'] = $this->Post_model->get_posts();
        $data['categories'] = $this->Category_model->get_category();
        $this->load->view('posts/post_list',$data);
    }


}
