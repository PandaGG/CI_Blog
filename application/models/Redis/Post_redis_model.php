<?php
class Post_redis_model extends CI_Model{
	protected $redis;
	public function __construct(){
		$this->load->driver('rediscli');
		$this->redis = $this->rediscli->phpredis->redis;
		$this->redis->select(2);
	}

	public function cachePost($id = NULL, $slug = NULL, $title = NULL){
		if($id === NULL || $slug === NULL || $title === NULL){
			return FALSE;
		}
		$result = $this->redis->hmset('post:'.$id, array('slug' => $slug, 'title' => $title) );
        if($result){
            $this->redis->expire('post:'.$id, 60*60*24*30*6);
            return TRUE;
        }
        return FALSE;
	}

	public function checkPost($id = NULL){
		if($id === NULL){
			return FALSE;
		}
        $result =  $this->redis->exists('post:'.$id);
        if($result){
            $this->redis->expire('post:'.$id, 60*60*24*30*6);
            return TRUE;
        }
        return FALSE;
	}

	public function markRecentPost($id = NULL){
		if($id === NULL){
			return;
		}
		$pipe = $this->redis->multi(Redis::PIPELINE);
		$pipe->lrem('recent-posts', $id, 0);
		$pipe->lpush('recent-posts', $id);
		$replies = $pipe->exec();
	}

	public function trimRecentPosts($limit_len = NULL, $max_len = NULL){
		if($limit_len === NULL || $max_len === NULL){
			return FALSE;
		}
		$recentPost_len = $this->redis->llen('recent-posts');
		if($recentPost_len AND $recentPost_len >= $max_len){
			$this->redis->ltrim('recent-posts', 0, $limit_len-1);
		}
	}

}