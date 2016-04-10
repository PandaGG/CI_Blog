<?php
class Online_manage_redis_model extends CI_Model{
    protected $redis;
	public function __construct(){
		parent:: __construct();
        $this->load->driver('rediscli');
        $this->redis = $this->rediscli->phpredis->redis;
        $this->redis->select(1);
	}

    public function setOnline($id, $min_users_key, $user_key, $now, $expire_timestamp){
        $pipe = $this->redis->multi(Redis::PIPELINE);
        $pipe->sadd($min_users_key, $id);
        $pipe->set($user_key, $now);
        $pipe->expireat($min_users_key, $expire_timestamp);
        $pipe->expireat($user_key, $expire_timestamp);
        $replies = $pipe->exec();
    }

    public function getLastActTime($id){
        return $this->redis->get('user-activity:'.$id);
    }

    public function addAccessRecord($id){
        $this->redis->lpush('access-history',$id.','.date('Y-m-d H:i:s'));
    }

    public function trimAccessHistory($limit_len = NULL, $max_len = NULL){
        if($limit_len === NULL || $max_len === NULL){
            return FALSE;
        }
        $hisstory_len = $this->redis->llen('access-history');
        if($hisstory_len AND $hisstory_len >= $max_len){
            $this->redis->ltrim('access-history', 0, $limit_len-1);
        }
    }

    public function getUnionOnlineMinSet($minute_keys_arr = array()){
        $result = $this->redis->sunion($minute_keys_arr);
        return $result;
    }

}