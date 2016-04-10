<?php
class History extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->load->model('Redis/Access_history_model');
	}
	
	public function index(){
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

		$pagination_base_url = site_url('history');
		if($query_string){
			$pagination_base_url .= '?'.$query_string.'&paged=';
		}else{
			$pagination_base_url .= '?paged=';
		}
		$per_page = 30;
		$config = array(
			'base_url' => $pagination_base_url,
			'total_rows' => $this->Access_history_model->count_records(),
			'per_page' => $per_page,
			'num_links' => 3,
			'cur_page' => $paged
		);
		$this->pagination->initialize($config);
		$pagination_link = $this->pagination->create_links();
		$data['pagination_link'] = $pagination_link;
		/*分页 结束*/
		$offset = (int)($per_page*($paged-1));
        $end = $offset + $per_page - 1;

        $origin_records = $this->Access_history_model->get_records($offset, $end);
        $records = array();
        if($origin_records){
            foreach($origin_records as $origin_record){
                $temp_record_arr = explode(',', $origin_record);
                $record_ip = $temp_record_arr[0];
                $record_datetime = $temp_record_arr[1];
                $records[] = array('ip'=>$record_ip, 'datetime' => $record_datetime);
            }
        }
		$data['records'] = $records;
		$this->load->view('histories/history_list',$data);
	}


}
