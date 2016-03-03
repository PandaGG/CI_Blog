<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
	<div class="dashboard-title">
		<span>类别管理</span>
		<a href="javascript:void(0);"><i class="fa fa-plus"></i></a>
	</div>
	<div class="dashboard-section">
		<table class="table table-hover dashboard-table">
			<thead>
				<tr>
					<th width="30px"><input type="checkbox"></th>
					<th width="100px">ID</th>
					<th>类别</th>
					<th width="180px">Slug</th>
					<th width="120px" class="text-right">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($categories as $category):?>
				<tr>
					<td><input type="checkbox"></td>
					<td><?php echo $category['category_id'] ?></td>
					<td><?php echo $category['category_name'] ?></td>
					<td><?php echo $category['category_slug'] ?></td>
					<td class="text-right">
						<a href="javascript:void(0);"><i class="fa fa-pencil"></i></a>
						<span>|</span>
						<a href="javascript:void(0);"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5"><button class="btn btn-default">批量删除</button></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>