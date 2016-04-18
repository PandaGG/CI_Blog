<?php
class Archives extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('date');
		$this->load->model('post_model');
	}

	public function get_posts($offset = NULL, $num = NULL){
		if($offset === NULL || $num === NULL){
			$archives = array();
		}else{
			$offset = (int)$offset;
			$num = (int)$num;
			$posts = $this->post_model->get_posts($offset, $num);
			if(empty($posts)){
				$archives = array();
			}else{
				$year = 0;
				$month = 0;
				$archives = array();
				foreach($posts as $post){
					$post_time = strtotime($post['post_date']);
					$post_year = date('Y', $post_time);
					$post_month = date('m', $post_time);
					$post_day = date('d', $post_time);
					$post['display_date'] = $post_month.'月'.$post_day.'日';
					$post['display_time'] = date('H:i', $post_time);
					if($post_year != $year){
						$year = $post_year;
						$archives[] = array('type'=>'year', 'data'=>$year);
						$month = $post_month;
						$archives[] = array('type'=>'month', 'data'=>$month);

					}
					if($post_month != $month){
						$month = $post_month;
						$archives[] = array('type'=>'month', 'data'=>$month);
					}
					$archives[] = array('type'=>'day', 'data'=>$post);
				}
			}
		}
		if($archives){
			$response = array(
				'code' => 200,
				'response' => $archives
			);
		}else{
			$response = array(
				'code' => 400,
				'response' => $archives
			);
		}
		echo json_encode($response);
	}
}