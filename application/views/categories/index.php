<div class="list-caption text-center">
	<ul class="categories_list">
		<?php foreach($categories as $category): ?>
			<li>
				<a href="<?php echo site_url('categories/'.$category['category_slug']); ?>"><?php echo $category['category_name']; ?></a> (<?php echo $category['post_num']; ?>)
			</li>
		<?php endforeach;?>
	</ul>
</div>