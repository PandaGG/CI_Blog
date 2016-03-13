<div class="sidebar_package">
	<h3>文章归类</h3>
	<ul class="sidebar-list">
	<?php foreach ($sb_archives as $archives):?>
		<li>
			<a href="javascript:void(0);" title="<?php echo $archives['publish_date']; ?>"><?php echo $archives['publish_date']; ?></a>
			<span>(<?php echo $archives['cnt']; ?>)</span>
		</li>
	<?php endforeach;?>
	</ul>
</div>