<?php if(isset($page_title)): ?>
<div class="list-caption page-title"><h3><?php echo $page_title; ?></h3></div>
<?php endif; ?>
<?php foreach($posts as $post): ?>
<div class="list-caption">
	<h3 class="list-caption-title">
		<a href="<?php echo site_url('posts/'.$post['post_slug']); ?>"><?php echo $post['post_title']; ?></a>
	</h3>
	<div class="info">
		<span>
            <i class="fa fa-list"></i>
            <a href="<?php echo site_url('categories/'.$post['category_slug']); ?>"><?php echo $post['category_name']; ?></a>
        </span>
		<span>
            <i class="fa fa-clock-o"></i>
            <?php echo $post['post_date']; ?>
        </span>
        <span>
            <i class="fa fa-eye"></i>
            <?php echo $post['post_hit']?> &#8451;
        </span>
	</div>
	<br>
	<p class="excrept"><?php echo $post['post_excerpt']; ?></p>
</div>
<?php endforeach;?>
<div class="pagination_contain"><?php echo $pagination_link ?></div>
