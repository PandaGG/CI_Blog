<h1><?php echo $title; ?></h1>
<ul>
<?php foreach($posts as $post): ?>	
	<li><a href="<?php echo site_url('posts/'.$post['slug']); ?>"><?php echo $post['title']; ?></a></li>
<?php endforeach;?>
</ul>