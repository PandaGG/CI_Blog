<?php foreach($posts as $post): ?>	
<div class="list-caption">
	<h3>
		<a href="<?php echo site_url('posts/'.$post['post_id']); ?>"><?php echo $post['post_title']; ?></a>
	</h3>
	<div class="info">
		<span>分类：<a href="<?php echo site_url('categories/'.$post['category_slug']); ?>"><?php echo $post['category_name']; ?></a></span>
		<span>|</span>
		<span>发布：<?php echo $post['post_date']; ?></span>
		<span>|</span>
		<span class="glyphicon glyphicon-eye-open"></span> <span><?php echo $post['post_hit']?></span>
	</div>
	<br>
	<p class="excrept"><?php echo $post['post_excerpt']; ?></p>
</div>
<?php endforeach;?>