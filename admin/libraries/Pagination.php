<?php
class CI_Pagination {
	protected $CI;
	protected $base_url = '';
	protected $total_rows = 0;
	protected $num_links = 3;
	public $per_page = 10;
	public $cur_page = 0;
	/*
	protected $first_link = '&lsaquo; First';
	protected $next_link = '&gt;';
	protected $prev_link = '&lt;';
	protected $last_link = 'Last &rsaquo;';
	*/
	
	public function __construct($params = array())
	{
		$this->CI =& get_instance();
		$this->initialize($params);
	}
	
	public function initialize($params = array())
	{
		foreach ($params as $key => $val)
		{
			if (property_exists($this, $key))
			{
				$this->$key = $val;
			}
		}
	}
	
	public function create_links()
	{
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
			return '';
		}
		
		$num_pages = (int) ceil($this->total_rows / $this->per_page);
		
		if ($num_pages === 1)
		{
			return '';
		}
		
		$base_url = trim($this->base_url);
		
		$cur_page = $this->cur_page;
		$num_links = $this->num_links;
		
		$start = ($cur_page - $num_links > 0) ? $cur_page - $num_links : 1;
		$end = ($cur_page + $num_links < $num_pages) ? $cur_page + $num_links : $num_pages;
		
		$output = '<ul class="pagination">';
		
		if($start < $cur_page){
			$output .= '<li><a href="'.$base_url.'1'.'">首页</a></li>';
			$output .= '<li><a href="'.$base_url.($cur_page-1).'">上一页</a></li>';
		}else{
			$output .= '<li class="disabled"><a href="javascript:void(0);">首页</a></li>';
			$output .= '<li class="disabled"><a href="javascript:void(0);">上一页</a></li>';
		}
		
		for($loop = $start; $loop <= $end; $loop++)
		{
			if($loop == $cur_page){
				$output .= '<li class="active"><a href="javascript:void(0);">'.$loop.'</a></li>';
			}else{
				$output .= '<li><a href="'.$base_url.$loop.'">'.$loop.'</a></li>';
			}
		}

		if($end > $cur_page){
			$output .= '<li><a href="'.$base_url.($cur_page+1).'">下一页</a></li>';
			$output .= '<li><a href="'.$base_url.$num_pages.'">尾页</a></li>';
		}else{
			$output .= '<li class="disabled"><a href="javascript:void(0);">下一页</a></li>';
			$output .= '<li class="disabled"><a href="javascript:void(0);">尾页</a></li>';
		}
		
		$output .= '</ul>';
		return $output;
	}
}