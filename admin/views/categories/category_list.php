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
					<th><input type="checkbox"></th>
					<th>ID</th>
					<th>类别</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="checkbox"></td>
					<td>1</td>
					<td>1</td>
					<td>1</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4"><button class="btn btn-default">批量删除</button></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>