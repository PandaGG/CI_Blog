<?php
class Category extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Category_model');
	}
	public function index(){
		$data['categories'] = $this->Category_model->get_category();
		$this->load->view('categories/category_list', $data);
	}
	public function create(){
		$this->load->view('categories/category_create');
	}
	public function edit($cid = NULL){
		if($cid === NULL){
			show_404();
		}else{
			$category = $this->Category_model->get_category($cid);
			if($category){
				$data['category'] = $category;
				$this->load->view('categories/category_edit',$data);
			}else{
				show_404();
			}
		}
	}
	public function insert(){
		$cname = $this->input->post('cname');
		$cslug = $this->input->post('cslug');
		$result = $this->Category_model->add_category($cname, $cslug);
		if($result){
			$this->pageTips('新建类别成功','category', 2);
		}else{
			$this->pageTips('新建类别失败','category', 2, 'fail');
		}
	}

    public function update(){
        $cid = $this->input->post('cid');
        $cname = $this->input->post('cname');
        $cslug = $this->input->post('cslug');
        $result = $this->Category_model->update_category($cid, $cname, $cslug);
        if($result){
            $this->pageTips('更新类别成功','category', 2);
        }else{
            $this->pageTips('更新类别失败','category', 2, 'fail');
        }
    }

    public function delete($cid = FALSE){
        if($cid === FALSE){
            $this->pageTips('删除类别失败','category', 2, 'fail');
            return;
        }
        $result = $this->Category_model->delete_category($cid);
        if($result){
            $this->pageTips('删除类别成功','category', 2);
        }else{
            $this->pageTips('删除类别失败','category', 2, 'fail');
        }
    }

}