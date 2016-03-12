<?php
class Post extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->load->model('Post_model');
        $this->load->model('Category_model');
	}
	
	public function index(){
        $this->saveUri();
        $status = $this->input->get('status') ? $this->input->get('status') : 'all';
        $cid = $this->input->get('cid') ? $this->input->get('cid') : 0;
        $paged = $this->input->get('paged') ? $this->input->get('paged') : 1;

        $data['info']['status'] = $status;
        $data['info']['cid'] = $cid;
        $data['status_count'] = array(
            'all' => $this->Post_model->count_condition_posts('all', $cid),
            'publish' => $this->Post_model->count_condition_posts('publish', $cid),
            'draft' => $this->Post_model->count_condition_posts('draft', $cid),
            'trash' => $this->Post_model->count_condition_posts('trash', $cid)
        );

        /*分页 开始*/
        $this->load->library('pagination');
        $query_string = $_SERVER["QUERY_STRING"];
        if($query_string){
            $query_parm = explode('&', $query_string);
            for($i=0; $i<count($query_parm); $i++){
                if(strpos($query_parm[$i], 'paged') !== FALSE){
                    unset($query_parm[$i]);
                    break;
                }
            }
            $query_string = implode('&', $query_parm);
        }

        $pagination_base_url = site_url('post');
        if($query_string){
            $pagination_base_url .= '?'.$query_string.'&paged=';
        }else{
            $pagination_base_url .= '?paged=';
        }
        $per_page = 10;
        $config = array(
            'base_url' => $pagination_base_url,
            'total_rows' => $data['status_count'][$status],
            'per_page' => $per_page,
            '$num_links' => 3,
            'cur_page' => $paged
        );
        $this->pagination->initialize($config);
        $pagination_link = $this->pagination->create_links();
        $data['pagination_link'] = $pagination_link;
        /*分页 结束*/
        $offset = (int)($per_page*($paged-1));

        $data['posts'] = $this->Post_model->get_posts($status, $cid, $offset, $per_page);
        $data['categories'] = $this->Category_model->get_categories();
		$this->load->view('posts/post_list',$data);
	}

    public function search(){
        $this->saveUri();
        $keywords = $this->input->get('keywords');
        if($keywords == NULL){
            redirect('post');
        }
        $data['keywords'] = $keywords;
        $paged = $this->input->get('paged') ? $this->input->get('paged') : 1;
        /*分页 开始*/
        $this->load->library('pagination');
        $query_string = $_SERVER["QUERY_STRING"];
        if($query_string){
            $query_parm = explode('&', $query_string);
            for($i=0; $i<count($query_parm); $i++){
                if(strpos($query_parm[$i], 'paged') !== FALSE){
                    unset($query_parm[$i]);
                    break;
                }
            }
            $query_string = implode('&', $query_parm);
        }

        $pagination_base_url = site_url('post/search');
        if($query_string){
            $pagination_base_url .= '?'.$query_string.'&paged=';
        }else{
            $pagination_base_url .= '?paged=';
        }
        $per_page = 10;
        $config = array(
            'base_url' => $pagination_base_url,
            'total_rows' => $this->Post_model->count_search_posts($keywords),
            'per_page' => $per_page,
            '$num_links' => 3,
            'cur_page' => $paged
        );
        $this->pagination->initialize($config);
        $pagination_link = $this->pagination->create_links();
        $data['pagination_link'] = $pagination_link;
        /*分页 结束*/
        $offset = (int)($per_page*($paged-1));

        $data['posts'] = $this->Post_model->get_search_posts($keywords, $offset, $per_page);
        $data['categories'] = $this->Category_model->get_categories();
        $this->load->view('posts/post_list',$data);
    }

    public function create(){
        $data['categories'] = $this->Category_model->get_categories();
        $this->load->view('posts/post_create',$data);
    }

    public function edit($pid = NULL){
        if($pid === NULL){
            show_404();
        }else {
            $data['categories'] = $this->Category_model->get_categories();
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

    public function publish($pid = NULL){
        if($pid === NULL){
            show_404();
        }else{
            $result = $this->Post_model->updateStatus(array($pid), 'publish');
            if($result){
                $this->pageTips('发布成功',$this->session->lastUri, 2);
            }else{
                $this->pageTips('发布成功失败',$this->session->lastUri, 2, 'fail');
            }
            return;
        }
    }

    public function draft($pid = NULL){
        if($pid === NULL){
            show_404();
        }else{
            $result = $this->Post_model->updateStatus(array($pid), 'draft');
            if($result){
                $this->pageTips('转为草稿成功',$this->session->lastUri, 2);
            }else{
                $this->pageTips('转为草稿失败',$this->session->lastUri, 2, 'fail');
            }
            return;
        }
    }

    public function trash($pid = NULL){
        if($pid === NULL){
            show_404();
        }else{
            $result = $this->Post_model->updateStatus(array($pid), 'trash');
            if($result){
                $this->pageTips('移动至垃圾箱成功',$this->session->lastUri, 2);
            }else{
                $this->pageTips('移动至垃圾箱失败',$this->session->lastUri, 2, 'fail');
            }
            return;
        }
    }

    public function delete($pid = NULL){
        if($pid === NULL){
            show_404();
        }else{
            $result = $this->Post_model->deletePost(array($pid));
            if($result){
                $this->pageTips('永久删除成功',$this->session->lastUri, 2);
            }else{
                $this->pageTips('永久删除失败',$this->session->lastUri, 2, 'fail');
            }
            return;
        }
    }

	public function group_operation(){
        $ids = $this->input->post('ids');
        //批量移动类别
        if($this->input->post('group-move')){
            $cid = $this->input->post('group_cid');
            $result = $this->Post_model->updateCategory($ids, $cid);
            if($result){
                $this->pageTips('批量移动成功',$this->session->lastUri, 2);
            }else{
                $this->pageTips('批量移动失败',$this->session->lastUri, 2, 'fail');
            }
            return;
        }

        //批量移动至垃圾箱
		if($this->input->post('group-trash')){
            $result = $this->Post_model->updateStatus($ids, 'trash');
            if($result){
                $this->pageTips('批量移动至垃圾箱成功',$this->session->lastUri, 2);
            }else{
                $this->pageTips('批量移动至垃圾箱失败',$this->session->lastUri, 2, 'fail');
            }
            return;
        }

        //批量永久删除
        if($this->input->post('group-delete')){
            $result = $this->Post_model->deletePost($ids);
            if($result){
                $this->pageTips('批量永久删除成功',$this->session->lastUri, 2);
            }else{
                $this->pageTips('批量永久删除失败',$this->session->lastUri, 2, 'fail');
            }
            return;
            return;
        }

        //批量移出垃圾箱
        if($this->input->post('group-draft')){
            $result = $this->Post_model->updateStatus($ids, 'draft');
            if($result){
                $this->pageTips('批量移出垃圾箱成功',$this->session->lastUri, 2);
            }else{
                $this->pageTips('批量移出垃圾箱失败',$this->session->lastUri, 2, 'fail');
            }
            return;
        }
	}

}
