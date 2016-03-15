<div class="sidebar_package">
	<h3>文章归类</h3>
	<ul class="sidebar-list">
	<?php foreach ($sb_archives as $archives):?>
		<li>
			<a href="<?php echo site_url('archives/view/'.$archives['publish_date']); ?>" title="<?php echo $archives['publish_date']; ?>"><?php echo $archives['display_date']; ?></a>
			<span>(<?php echo $archives['cnt']; ?>)</span>
		</li>
	<?php endforeach;?>
	</ul>
</div>