<?php
class Access_history_redis_model extends CI_Model{
    protected $redis;
	public function __construct(){
		parent:: __construct();
        $this->load->driver('rediscli');
        $this->redis = $this->rediscli->phpredis->redis;
        $this->redis->select(1);
	}
    public function get_records($start = 0, $end = -1){
        return $this->redis->lrange('access-history', $start, $end);
    }

    public function count_records(){
        return $this->redis->llen('access-history');
    }
}