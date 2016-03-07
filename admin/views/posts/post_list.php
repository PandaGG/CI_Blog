<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
	<div class="dashboard-title">
		<span>文章管理</span>
		<a href="<?php echo site_url('post/create'); ?>"><i class="fa fa-plus"></i></a>
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
					<td><?php echo $post['post_status']; ?></td>
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
                        <button class="btn btn-default disabled" type="submit" name="group-trash" value="group-trash">批量删除</button>
                        <button class="btn btn-default disabled" type="submit" name="group-move" value="group-move">批量移动</button>
                    </td>
				</tr>
			</tfoot>
		</table>
        <?php echo form_close(); ?>
	</div>
	<script type="text/javascript">
		$(function(){

		});
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
                $('button[name="group-trash"]').removeClass('disabled');
                $('button[name="group-move"]').removeClass('disabled');
            }else{
                $('button[name="group-trash"]').addClass('disabled');
                $('button[name="group-move"]').addClass('disabled');
            }
        }
	</script>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>