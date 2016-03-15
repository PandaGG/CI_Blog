<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
	<div class="dashboard-title">
		<span>添加文章</span>
	</div>
	<div class="dashboard-section dashboard-small-label">
        <?php echo form_open('post/insert', 'id="postForm"');?>
            <div class="dashboard-row">
                <div class="row-label">状态:</div>
                <div class="row-item">
                    <select class="selectpicker" name="status">
                        <option value="draft">草稿</option>
                        <option value="publish">已发布</option>
                    </select>

                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">类别:</div>
                <div class="row-item">
                    <select class="selectpicker" name="cid">
                        <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">文章标题:</div>
                <div class="row-item">
                    <div class="input-group w400">
                        <input type="text" class="form-control" name="title" placeholder="文章标题" value="" required="required">
                    </div>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">Slug:</div>
                <div class="row-item">
                    <div class="input-group w400">
                        <input type="text" class="form-control" name="slug" placeholder="Slug" value="" required="required">
                    </div>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">摘要:</div>
                <div class="row-item">
                    <div class="input-group w800">
                        <textarea class="form-control" name="excerpt" placeholder="摘要" required="required"></textarea>
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
                    <div class="w800">
                        <div id="editor"></div>
                        <textarea name="context" style="display: none;"></textarea>
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
                lang:'zh-CN',
                callbacks: {
                    onImageUpload: function(files) {
                        // upload image to server and create imgNode...
                        uploadImage(files[0]);
                    }
                }

            });
        });

        function uploadImage(file){
            var data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                dataType: 'json',
                url: "<?php echo site_url('upload'); ?>",
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    if(res.message == 'success'){
                        var path = res.path;
                        $('#editor').summernote('insertImage', path);
                    }else{
                        var error_msg = res.error_msg;
                        alert(error_msg);
                    }
                }
            });

        }

        function submitPost(){
            var sHTML = $('#editor').summernote('code');
            $('textarea[name="context"]').val(sHTML);
            $('#postForm').submit();
        }

        function toggleRequireExcerpt(){
            if($('input:checkbox[name="auto_excerpt"]').prop('checked')){
                $('textarea[name="excerpt"]').prop('required',false);
            }else{
                $('textarea[name="excerpt"]').prop('required',true);
            }
        }

    </script>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>