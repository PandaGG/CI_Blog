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
            <?php echo $post['post_excerpt']; ?>
        </div>
        <div class="article-content">
            <?php echo $post['post_content']; ?>
        </div>


    </article>
</div>
