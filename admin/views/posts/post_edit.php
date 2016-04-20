<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main" xmlns:width="http://www.w3.org/1999/xhtml">
	<div class="dashboard-title">
		<span>编辑文章</span>
	</div>
	<div class="dashboard-section dashboard-small-label">
        <?php echo form_open('post/update', 'id="postForm"');?>

            <div class="dashboard-row">
                <div class="row-label">文章编号:</div>
                <div class="row-item">
                    <div class="input-group w200">
                        <input type="text" class="form-control" name="pid" placeholder="文章编号" value="<?php echo $post['post_id']; ?>" required="required" readonly="readonly">
                    </div>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">状态:</div>
                <div class="row-item">
                    <select class="selectpicker" name="status">
                        <option value="draft" <?php echo $post['post_status'] == 'draft' ? 'selected' : ''; ?>>草稿</option>
                        <option value="publish" <?php echo $post['post_status'] == 'publish' ? 'selected' : ''; ?>>已发布</option>
                        <option value="publish" <?php echo $post['post_status'] == 'trash' ? 'selected' : ''; ?>>垃圾箱</option>
                    </select>

                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">类别:</div>
                <div class="row-item">
                    <select class="selectpicker" name="cid">
                        <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>" <?php echo $category['category_id'] == $post['post_category'] ? 'selected' : ''; ?>><?php echo $category['category_name']; ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">文章标题:</div>
                <div class="row-item">
                    <div class="input-group w400">
                        <input type="text" class="form-control" name="title" placeholder="文章标题" value="<?php echo $post['post_title']; ?>" required="required">
                    </div>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">Slug:</div>
                <div class="row-item">
                    <div class="input-group w400 float-left">
                        <input type="text" class="form-control" name="slug" placeholder="Slug" value="<?php echo $post['post_slug']; ?>" required="required" >
                    </div>
                    <div id="slug-error" class="row-error_msg float-left">该Slug不可用</div>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">摘要:</div>
                <div class="row-item">
                    <div class="input-group w800">
                        <textarea class="form-control" name="excerpt" placeholder="摘要" required="required"><?php echo $post['post_excerpt']; ?></textarea>
                    </div>
                    <div class="checkbox">
                        <label onclick="toggleRequireExcerpt();">
                            <input type="checkbox" name="auto_excerpt"> 自动生成摘要
                        </label>
                    </div>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">内容:</div>
                <div class="row-item">
                    <div class="editor-container">
                        <div id="editor"><?php echo $post['post_content']; ?></div>
                        <textarea name="context" style="display: none;"></textarea>
                        <input type="text" name="timestamp" value="<?php echo time(); ?>" style="display:none;">
                        <div class="editor-cover">
                            <div class="editor-cover-bg"></div>
                            <div class="editor-msg"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label"></div>
                <div class="row-item">
                    <button class="btn btn-default" type="button" onclick="submitPost();">保存</button>
                </div>
            </div>
        <?php echo form_close(); ?>
	</div>
    <script type="text/javascript" src="<?php echo site_url();?>../assets/js/dashboard/post-edit.js"></script>
    <script type="text/javascript">
        var post_api_url = "<?php echo site_url('api/post'); ?>";
        var upload_url = "<?php echo site_url('api/upload/post_image'); ?>";
        $(function(){
            initPostId();
            initTimestamp();
            initSummernote();
            bindCheckSlug();
        });

    </script>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>