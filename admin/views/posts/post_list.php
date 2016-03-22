<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
	<div class="dashboard-title">
        <form method="get" accept-charset="utf-8" action="<?php echo site_url('post/search'); ?>"">
        <span>文章管理</span>
        <a href="<?php echo site_url('post/create'); ?>" title="添加文章"><i class="fa fa-plus"></i></a>
        <div class="input-group w200 float-right">
            <?php if(isset($keywords)): ?>
                <input type="text" class="form-control" name="keywords" value="<?php echo $keywords; ?>" placeholder="搜索标题">
            <?php else: ?>
                <input type="text" class="form-control" name="keywords" placeholder="搜索标题">
            <?php endif; ?>
            <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">搜索</button>
                </span>
        </div>
        <?php echo form_close(); ?>
	</div>

    <?php if(isset($keywords)): ?>
        <div class="dashboard-section">
            <span>搜索关键词 <b><?php echo $keywords; ?></b> 结果</span>
        </div>
    <?php else: ?>
        <div class="dashboard-section">
            <form method="get" accept-charset="utf-8" action="<?php echo site_url('post'); ?>" id="navForm">
            <ul class="nav nav-tabs">
                <li role="presentation" <?php echo $info['status'] == 'all' ?  'class="active"' : ''?>><a href="javascript:gotoStatus('all');">全部 (<?php echo $status_count['all']; ?>)</a></li>
                <li role="presentation" <?php echo $info['status'] == 'publish' ?  'class="active"' : ''?>><a href="javascript:gotoStatus('publish');">已发布 (<?php echo $status_count['publish']; ?>)</a></li>
                <li role="presentation"<?php echo $info['status'] == 'draft' ?  'class="active"' : ''?>><a href="javascript:gotoStatus('draft');">草稿 (<?php echo $status_count['draft']; ?>)</a></li>
                <li role="presentation"<?php echo $info['status'] == 'trash' ?  'class="active"' : ''?>><a href="javascript:gotoStatus('trash');">垃圾箱 (<?php echo $status_count['trash']; ?>)</a></li>
                <li style="float:right;">
                    <select class="selectpicker" name="cid" onchange="submitNavForm();">
                        <option value="0">全部类别</option>
                        <?php foreach($categories as $category): ?>
                            <option value="<?php echo $category['category_id']; ?>" <?php echo $category['category_id'] == $info['cid'] ? 'selected' : ''; ?>><?php echo $category['category_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
            </ul>
            <input type="hidden" name="status" value="<?php echo $info['status']; ?>" />
            </form>
        </div>
    <?php endif; ?>

	<div class="dashboard-section">
        <?php echo form_open('post/group_operation', array('id' => 'mainform')); ?>
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
					<td><input type="checkbox" class="item-check" name="ids[]" value="<?php echo $post['post_id']; ?>" onclick="toggleEachCheckbox(this);"></td>
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
                        <?php if($post['post_status'] == 'publish' || $post['post_status'] == 'trash'): ?>
                            <a href="<?php echo site_url('post/draft/'.$post['post_id']); ?>" title="转为草稿"><i class="fa fa-eye-slash"></i></a>
                            <span>|</span>
                        <?php endif; ?>

                        <?php if($post['post_status'] == 'draft'): ?>
                            <a href="<?php echo site_url('post/publish/'.$post['post_id']); ?>" title="发布"><i class="fa fa-eye"></i></a>
                            <span>|</span>
                        <?php endif; ?>
						<a href="<?php echo site_url('post/edit/'.$post['post_id']); ?>" title="编辑"><i class="fa fa-pencil"></i></a>
						<span>|</span>

                        <?php if($post['post_status'] == 'trash'): ?>
                            <a href="javascript:void(0);" title="永久删除"  data-url="<?php echo site_url('post/delete/'.$post['post_id']); ?>" data-name="<?php echo $post['post_title'] ?>" onclick="confirmDelete(this);"><i class="fa fa-times"></i></a>
                        <?php else: ?>
                            <a href="<?php echo site_url('post/trash/'.$post['post_id']); ?>" title="垃圾箱"><i class="fa fa-trash"></i></a>
                        <?php endif; ?>

					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="9">
                        <?php if(isset($keywords)): ?>
                            <button class="btn btn-default group-operation-btn" type="submit" name="group-trash" value="group-trash" disabled="disabled">批量垃圾箱</button>
                            <select class="selectpicker" name="group_cid">
                                <?php foreach($categories as $category): ?>
                                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button class="btn btn-default group-operation-btn" type="submit" name="group-move" value="group-move" disabled="disabled">批量移动</button>
                        <?php else: ?>
                            <?php if($info['status'] == 'trash'): ?>
                                <button class="btn btn-danger group-operation-btn" type="button" disabled="disabled" onclick="confirmGroupDelete();">批量永久删除</button><!-- 显示、触发确认框 -->
                                <button type="submit" name="group-delete" value="group-delete" style="display: none;">批量永久删除</button><!-- 确定确认框后，触发此按钮的submit -->
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
                        <?php endif; ?>
                    </td>
				</tr>
			</tfoot>
		</table>
        <div class="text-right">
            <?php echo $pagination_link ?>
        </div>

        <?php echo form_close(); ?>
	</div>
	<script type="text/javascript">
		$(function(){

		});
        function gotoStatus(status){
            $('#navForm input[name="status"]').val(status);
            submitNavForm();
        }

        function submitNavForm(){
            $('#navForm').submit();
        }

        function confirmDelete(obj){
            var $obj = $(obj);
            var name = $obj.attr('data-name');
            var url = $obj.attr('data-url');
            var result = confirm('确定永久删除文章"'+name+'"?');
            if(result){
                window.location.href = url;
            }
        }

        function confirmGroupDelete(){
            var result = confirm('确定批量永久删除文章?');
            if(result){
                $('button[name="group-delete"]').click();
            }
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