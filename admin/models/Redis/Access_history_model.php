<?php
class Access_history_model extends CI_Model{
    protected $redis;
	public function __construct(){
		parent:: __construct();
        $this->load->driver('rediscli');
        $this->redis = $this->rediscli->phpredis->redis;
        $this->redis->select(1);
	}
    public function get_records($start, $end){
        return $this->redis->lrange('access-history', $start, $end);
    }

    public function count_records(){
        return $this->redis->llen('access-history');
    }
}