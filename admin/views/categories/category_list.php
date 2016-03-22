<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
	<div class="dashboard-title">
		<span>类别管理</span>
		<a href="<?php echo site_url('category/create');?>" title="添加类别"><i class="fa fa-plus"></i></a>
	</div>
	<div class="dashboard-section">
		<table class="table table-hover dashboard-table">
			<thead>
				<tr>
					<th width="100px">ID</th>
					<th>类别</th>
					<th width="180px">Slug</th>
					<th width="100px">篇数</th>
					<th width="120px" class="text-right">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($categories as $category):?>
				<tr>
					<td><?php echo $category['category_id'] ?></td>
					<td><?php echo $category['category_name'] ?></td>
					<td><?php echo $category['category_slug'] ?></td>
					<td><?php echo $category['post_num'] ?></td>
					<td class="text-right">
						<a href="<?php echo site_url('category/edit/'.$category['category_id']); ?>" title="编辑"><i class="fa fa-pencil"></i></a>
						<span>|</span>
						<?php if($category['post_num']): ?>
							<span class="disabled" title="无法删除有文章的栏目"><i class="fa fa-times"></i></span>
						<?php else: ?>
							<a href="javascript:void(0);" title="删除" data-url="<?php echo site_url('category/delete/'.$category['category_id']); ?>" data-name="<?php echo $category['category_name'] ?>" onclick="confirmDelete(this);"><i class="fa fa-times"></i></a>
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<div class="text-right">
			<?php echo $pagination_link ?>
		</div>
	</div>
    <script type="text/javascript">
        function confirmDelete(obj){
            var $obj = $(obj);
            var name = $obj.attr('data-name');
            var url = $obj.attr('data-url');
            var result = confirm('确定永久删除类别"'+name+'"?');
            if(result){
                window.location.href = url;
            }
        }
    </script>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>