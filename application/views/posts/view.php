<div class="main_wrapper">
    <article id="article-<?php echo $post['post_id'] ?>">
        <h3 class="article-title"><?php echo $post['post_title'] ?></h3>
        <div class="article-info">
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
            <span>
                <i class="fa fa-comments"></i>
                0
            </span>
        </div>
        <div class="article-excerpt">
            <b>摘要:</b>
            <?php echo $post['post_excerpt']; ?>
        </div>
        <div class="article-content">
            <?php echo $post['post_content']; ?>
        </div>
        <div class="article-control">
            <div class="article-prev">
                上一篇:
                <?php if($post_prev): ?>
                    <a href="<?php echo site_url('posts/'.$post_prev['post_slug']); ?>" title="<?php echo $post_prev['post_title']; ?>"><?php echo $post_prev['post_title']; ?></a>
                <?php else: ?>
                    <span>没有了</span>
                <?php endif; ?>
            </div>
            <div class="article-next">
                下一篇:
                <?php if($post_next): ?>
                    <a href="<?php echo site_url('posts/'.$post_next['post_slug']); ?>" title="<?php echo $post_next['post_title']; ?>"><?php echo $post_next['post_title']; ?></a>
                <?php else: ?>
                    <span>没有了</span>
                <?php endif; ?>
            </div>
        </div>

    </article>
</div>
