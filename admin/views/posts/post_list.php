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
					<th><input type="checkbox"></th>
					<th>ID</th>
					<th>文章标题</th>
					<th>修改时间</th>
					<th>发布时间</th>
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
					<td>1</td>
					<td>1</td>
					<td>1</td>
				</tr>
				<tr>
					<td><input type="checkbox"></td>
					<td>2</td>
					<td>2</td>
					<td>2</td>
					<td>2</td>
					<td>2</td>
					<td>2</td>
				</tr>
				<tr>
					<td><input type="checkbox"></td>
					<td>3</td>
					<td>3</td>
					<td>3</td>
					<td>3</td>
					<td>3</td>
					<td>3</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td><input type="checkbox"></td>
					<td>tfoot</td>
					<td>tfoot</td>
					<td>tfoot</td>
					<td>tfoot</td>
					<td>tfoot</td>
					<td>tfoot</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>