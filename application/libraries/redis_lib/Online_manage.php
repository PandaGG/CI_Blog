<?php
class Online_manage {
    protected $CI;
    protected $online_minutes = 3;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('redis/online_manage_redis_model');
    }

    public function setOnline($id){
        $now = time();
        $now_min = floor($now/60);
        $expire_timestamp = $now + $this->online_minutes * 60 + 10;
        $min_users_key = 'online-users-minute:'.$now_min;
        $user_key = 'user-activity:'.$id;
        if( ! $this->CI->online_manage_redis_model->getLastActTime($id) ){
            $this->CI->online_manage_redis_model->addAccessRecord($id);

            $limit_len = 500;
            $max_len = 600;
            $this->CI->online_manage_redis_model->trimAccessHistory($limit_len, $max_len);
        }

        $this->CI->online_manage_redis_model->setOnline($id, $min_users_key, $user_key, $now, $expire_timestamp);
    }

    public function getAllOnline(){
        $now = time();
        $now_min = floor($now/60);
        $minute_keys_arr = array();
        for ($i = 0; $i <= $this->online_minutes; $i++){
            $minute_keys_arr[] = 'online-users-minute:'.($now_min-$i);
        }
        $result = $this->CI->online_manage_redis_model->getUnionOnlineMinSet($minute_keys_arr);
        return $result;
    }

}