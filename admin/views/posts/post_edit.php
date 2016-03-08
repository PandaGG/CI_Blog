<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
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
                    <div class="input-group w400">
                        <input type="text" class="form-control" name="slug" placeholder="Slug" value="<?php echo $post['post_slug']; ?>" required="required">
                    </div>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">摘要:</div>
                <div class="row-item">
                    <div class="input-group w800">
                        <textarea class="form-control" name="description" placeholder="摘要" required="required"><?php echo $post['post_excerpt']; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">内容:</div>
                <div class="row-item">
                    <div class="w800">
                        <div id="editor"></div>
                        <textarea name="context" style="display: none;"><?php echo $post['post_content']; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label"></div>
                <div class="row-item">
                    <button class="btn btn-default" onclick="submitPost();">添加</button>
                </div>
            </div>
        <?php echo form_close(); ?>
	</div>
    <script type="text/javascript">
        $(function(){
            $('#editor').summernote({
                height: 300,
                minHeight: null,
                maxHeight: null,
                lang:'zh-CN'
            });
            var sHTML = $('textarea[name="context"]').val();
            $('#editor').summernote('code', sHTML);
        });

        function submitPost(){
            var sHTML = $('#editor').summernote('code');
            $('textarea[name="context"]').val(sHTML);
            $('#postForm').submit();
        }

    </script>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>