<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
	<div class="dashboard-title">
		<span>文章管理</span>
		<a href="javascript:void(0);"><i class="fa fa-plus"></i></a>
	</div>
	<div class="dashboard-section">
		<table class="table table-hover dashboard-table">
			<thead>
				<tr>
					<th width="30px"><input type="checkbox"></th>
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
					<td><input type="checkbox" name="ids" value="<?php echo $post['post_id']; ?>"></td>
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
					<td colspan="9"><button class="btn btn-default">批量移动到垃圾箱</button></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>