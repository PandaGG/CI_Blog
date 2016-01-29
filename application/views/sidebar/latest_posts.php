<div class="sidebar_package">
	<h3>最新文章</h3>
	<ul class="sidebar-list">
	<?php foreach ($sb_posts as $sb_post):?>
		<li><a href="<?php echo site_url('posts/'.$sb_post['post_slug']); ?>" title="<?php echo $sb_post['post_title']; ?>"><?php echo $sb_post['post_title']; ?></a></li>
	<?php endforeach;?>
	</ul>
</div>