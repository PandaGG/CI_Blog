<?php
class Online_manage {

    protected $CI;
    protected $redis;
    protected $online_minutes = 3;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->driver('rediscli');
        $this->redis = $this->CI->rediscli->phpredis->redis;
    }

    public function setOnline($id){
        $now = time();
        $now_min = floor($now/60);
        $expire_timestamp = $now + $this->online_minutes * 60 + 10;
        $min_users_key = 'online-users-minute:'.$now_min;
        $user_key = 'user-activity:'.$id;
        $pipe = $this->redis->multi(Redis::PIPELINE);
        $pipe->sadd($min_users_key, $id);
        $pipe->set($user_key, $now);
        $pipe->expireat($min_users_key, $expire_timestamp);
        $pipe->expireat($user_key, $expire_timestamp);
        $replies = $pipe->exec();
    }

    public function getLastActTime($id){

    }

    public function getAllOnline(){
        $now = time();
        $now_min = floor($now/60);
        $set_keys_arr = array();
        for ($i = 0; $i <= $this->online_minutes; $i++){
            $set_keys_arr[] = 'online-users-minute:'.($now_min-$i);
        }
        $result = $this->redis->sunion($set_keys_arr);
        return $result;
    }

}