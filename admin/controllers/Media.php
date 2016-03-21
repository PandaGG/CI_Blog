<?php
class Media extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Media_model');
    }
    public function index(){
        $paged = $this->input->get('paged') ? $this->input->get('paged') : 1;
        /*分页 开始*/
        $this->load->library('pagination');
        $pagination_base_url = site_url('media').'?paged=';

        $per_page = 10;
        $config = array(
            'base_url' => $pagination_base_url,
            'total_rows' => $this->Media_model->get_medias_count(),
            'per_page' => $per_page,
            'num_links' => 3,
            'cur_page' => $paged
        );
        $this->pagination->initialize($config);
        $pagination_link = $this->pagination->create_links();
        $data['pagination_link'] = $pagination_link;
        /*分页 结束*/
        $offset = (int)($per_page*($paged-1));
        $data['medias'] = $this->Media_model->get_medias($offset, $per_page);
        $this->load->view('media/media_list', $data);
    }

}