<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
	<div class="dashboard-title">
		<span>文章管理</span>
		<a href="<?php echo site_url('post/create'); ?>" title="添加文章"><i class="fa fa-plus"></i></a>
        <div class="input-group w400 float-right">
            <input type="text" class="form-control" placeholder="搜索内容">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">搜索</button>
            </span>
        </div>
	</div>

	<div class="dashboard-section">
        <form method="get" accept-charset="utf-8" action="<?php echo site_url('post/category'); ?>" id="navForm">
		<ul class="nav nav-tabs">
			<li role="presentation" <?php echo $info['status'] == 'all' ?  'class="active"' : ''?>><a href="javascript:gotoStatus('all');">全部 (10)</a></li>
			<li role="presentation" <?php echo $info['status'] == 'publish' ?  'class="active"' : ''?>><a href="javascript:gotoStatus('publish');">已发布 (6)</a></li>
			<li role="presentation"<?php echo $info['status'] == 'draft' ?  'class="active"' : ''?>><a href="javascript:gotoStatus('draft');">草稿 (3)</a></li>
			<li role="presentation"<?php echo $info['status'] == 'trash' ?  'class="active"' : ''?>><a href="javascript:gotoStatus('trash');">垃圾箱 (1)</a></li>
            <li style="float:right;">
                <select class="selectpicker" name="cid">
                    <option value="0">全部类别</option>
                    <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>" <?php echo $category['category_id'] == $info['cid'] ? 'selected' : ''; ?>><?php echo $category['category_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="btn btn-default" type="submit">筛选</button>
            </li>
		</ul>
        <input type="hidden" name="status" value="<?php echo $info['status']; ?>" />
        </form>
	</div>

	<div class="dashboard-section">
        <?php echo form_open('post/group_operation'); ?>
		<table class="table table-hover dashboard-table">
			<thead>
				<tr>
					<th width="30px"><input type="checkbox" id="check-all" name="check-all" onclick="toggleAllChecbox();"></th>
					<th width="80px">ID</th>
					<th>文章标题</th>
					<th>Slug</th>
					<th width="100px">状态</th>
					<th width="180px">修改时间</th>
					<th width="180px">发布时间</th>
					<th width="100px">热度</th>
					<th width="80px" class="text-right">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($posts as $post): ?>
				<tr>
					<td><input type="checkbox" class="post-check" name="ids[]" value="<?php echo $post['post_id']; ?>" onclick="toggleEachCheckbox(this);"></td>
					<td><?php echo $post['post_id']; ?></td>
					<td><?php echo $post['post_title']; ?></td>
					<td><?php echo $post['post_slug']; ?></td>
					<td>
						<?php
							switch($post['post_status']){
								case 'draft':
									echo '草稿';
									break;
								case 'publish':
									echo '已发布';
									break;
                                case 'trash':
                                    echo '垃圾箱';
                                    break;
							}
						?>
					</td>
					<td><?php echo $post['post_modified']; ?></td>
					<td><?php echo $post['post_date']; ?></td>
					<td><?php echo $post['post_hit']; ?></td>
					<td class="text-right">
						<a href="<?php echo site_url('post/edit/'.$post['post_id']); ?>" title="编辑"><i class="fa fa-pencil"></i></a>
						<span>|</span>
						<a href="<?php echo site_url('post/delete/'.$post['post_id']); ?>" title="垃圾箱"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="9">
                        <?php if($info['status'] == 'trash'): ?>
                            <button class="btn btn-default group-operation-btn" type="submit" name="group-delete" value="group-delete" disabled="disabled">批量永久删除</button>
                            <button class="btn btn-default group-operation-btn" type="submit" name="group-draft" value="group-draft" disabled="disabled">批量移出垃圾箱</button>
                        <?php else: ?>
                            <button class="btn btn-default group-operation-btn" type="submit" name="group-trash" value="group-trash" disabled="disabled" style="margin-right:20px;">批量垃圾箱</button>
                            <select class="selectpicker" name="group_cid">
                                <?php foreach($categories as $category): ?>
                                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button class="btn btn-default group-operation-btn" type="submit" name="group-move" value="group-move" disabled="disabled">批量移动</button>
                        <?php endif; ?>
                    </td>
				</tr>
			</tfoot>
		</table>
        <?php echo form_close(); ?>
	</div>
	<script type="text/javascript">
		$(function(){

		});
        function gotoStatus(status){
            $('#navForm input[name="status"]').val(status);
            $('#navForm').submit();
        }

        function toggleAllChecbox(){
            if($('#check-all').prop('checked')){
                $('input:checkbox[name="ids[]"]').prop('checked',true);
            }else{
                $('input:checkbox[name="ids[]"]').prop('checked',false);
            }
            checkGroupSelected();
        }
        function toggleEachCheckbox(obj){
            if($(obj).prop('checked') == false){
                $('#check-all').prop('checked', false);
            }else{
                var allCheckbox = $('input:checkbox[name="ids[]"]').length;
                var selectedCheckbox = $('input:checkbox[name="ids[]"]:checked').length;
                if(selectedCheckbox == allCheckbox){
                    $('#check-all').prop('checked', true);
                }
            }
            checkGroupSelected();
        }
        function checkGroupSelected(){
            if($('input:checkbox[name="ids[]"]:checked').length > 0){
                $('button.group-operation-btn').prop('disabled', false);
                $('button.group-operation-btn').prop('disabled', false);
            }else{
                $('button.group-operation-btn').prop('disabled', true);
                $('button.group-operation-btn').prop('disabled', true);
            }
        }
	</script>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>