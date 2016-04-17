<div class="">
    <?php if(isset($archives)): ?>
	<div class="vertical-timeline">
		<ul>
        <?php foreach($archives as $year => $month_posts): ?>
            <li class="vt-year" data-value="<?php echo $year; ?>">
                <div class="vt-label"><?php echo $year; ?></div>
                <div class="vt-circle"></div>
                <div class="clearfix"></div>
            </li>
            <?php foreach($month_posts as $month => $date_posts): ?>
                <li class="vt-month" data-value="<?php echo $year.'-'.$month; ?>">
                    <div class="vt-label"><?php echo $month; ?>月</div>
                    <div class="vt-circle"></div>
                    <div class="clearfix"></div>
                </li>

                <?php foreach($date_posts as $date_post): ?>
                    <li class="vt-date">
                        <div class="vt-label"><?php echo $date_post['display_date']; ?><span class="vt-time"><?php echo $date_post['display_time']; ?></span></div>
                        <div class="vt-circle"></div>
                        <div class="vt-content">
                            <h4><a href="<?php echo site_url('posts/'.$date_post['post_slug']); ?>"><?php echo $date_post['post_title']; ?></a></h4>
                            <p><?php echo $date_post['post_excerpt']; ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                <?php endforeach; ?>

            <?php endforeach; ?>

        <?php endforeach; ?>
		</ul>
	</div>
    <div class="timeline-loading-msg">数据加载中……</div>
    <script src="<?php echo site_url();?>assets/js/archives.js"></script>
    <?php endif; ?>
</div>