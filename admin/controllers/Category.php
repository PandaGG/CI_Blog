<?php
class Category extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Category_model');
	}
	public function index(){
		$paged = $this->input->get('paged') ? $this->input->get('paged') : 1;
		/*分页 开始*/
		$this->load->library('pagination');
		$pagination_base_url = site_url('category').'?paged=';

		$per_page = 10;
		$config = array(
			'base_url' => $pagination_base_url,
			'total_rows' => $this->Category_model->get_category_count(),
			'per_page' => $per_page,
			'num_links' => 3,
			'cur_page' => $paged
		);
		$this->pagination->initialize($config);
		$pagination_link = $this->pagination->create_links();
		$data['pagination_link'] = $pagination_link;
		/*分页 结束*/
		$offset = (int)($per_page*($paged-1));
		$data['categories'] = $this->Category_model->get_categories($offset, $per_page);
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