<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
	<div class="dashboard-title">
		<span>用户设置</span>
		<a href="javascript:void(0);"><i class="fa fa-key"></i> 修改管理密码</a>
	</div>
	<div class="dashboard-section dashboard-small-label">
		<?php echo form_open('user/update');?>
		<div class="dashboard-row">
			<div class="row-label">用户名:</div>
			<div class="row-item">
				<div class="input-group w200">
					<input type="text" class="form-control" name="username" placeholder="用户名" value="<?php echo $user_name; ?>" disabled="disabled">
				</div>
			</div>
		</div>

		<div class="dashboard-row">
			<div class="row-label">邮箱:</div>
			<div class="row-item">
				<div class="input-group w200">
					<input type="email" class="form-control" name="email" placeholder="邮箱" value="<?php echo $email; ?>">
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