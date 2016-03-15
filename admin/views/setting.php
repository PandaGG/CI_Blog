<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
	<div class="dashboard-title">
		<span>网站设置</span>
	</div>
	<div class="dashboard-section dashboard-small-label">
		<?php echo form_open('setting/update');?>
		<div class="dashboard-row">
			<div class="row-label">网站名称:</div>
			<div class="row-item">
				<div class="input-group w600">
					<input type="text" class="form-control" name="site_name" placeholder="网站名称" value="<?php echo $site_name; ?>">
				</div>
			</div>
		</div>

		<div class="dashboard-row">
			<div class="row-label">网站描述:</div>
			<div class="row-item">
				<div class="input-group w600">
					<input type="text" class="form-control" name="site_description" placeholder="网站描述" value="<?php echo $site_description; ?>">
				</div>
			</div>
		</div>

		<div class="dashboard-row">
			<div class="row-label">关键词:</div>
			<div class="row-item">
				<div class="input-group w600">
					<input type="text" class="form-control" name="site_keywords" placeholder="关键词" value="<?php echo $site_keywords; ?>">
				</div>
			</div>
		</div>

		<div class="dashboard-row">
			<div class="row-label">页脚版权:</div>
			<div class="row-item">
				<div class="input-group w600">
					<input type="text" class="form-control" name="copyright" placeholder="版权名称" value="<?php echo $copyright; ?>">
				</div>
			</div>
		</div>

		<div class="dashboard-row">
			<div class="row-label"></div>
			<div class="row-item">
				<button class="btn btn-default" type="submit">保存</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>