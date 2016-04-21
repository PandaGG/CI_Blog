<?php
class Post_redis_model extends CI_Model{
	protected $redis;
	public function __construct(){
		$this->load->driver('rediscli');
		$this->redis = $this->rediscli->phpredis->redis;
		$this->redis->select(2);
	}
	public function removeFromRecentPost($id = NULL){
		if($id === NULL){
			return;
		}
		return $this->redis->lrem('recent-posts', $id, 0);
	}
	public function removeFromCachePost($id = NULL){
		if($id === NULL){
			return;
		}
		return $this->redis->del('post:'.$id);
	}

}