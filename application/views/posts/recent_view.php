<div class="article-recent-view">
    <b>大家正在读</b>
    <ul>
        <?php foreach ($rv_posts as $rv_post):?>
            <li><a href="<?php echo site_url('posts/'.$rv_post['post_slug']); ?>" title="<?php echo $rv_post['post_title']; ?>"><?php echo $rv_post['post_title']; ?></a></li>
        <?php endforeach;?>
    </ul>
</div>