<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
	<div class="dashboard-title">
		<span>修改密码</span>
	</div>
	<div class="dashboard-section dashboard-small-label">
		<?php echo form_open('user/set_password');?>
		<div class="dashboard-row">
			<div class="row-label">旧密码:</div>
			<div class="row-item">
				<div class="input-group w200">
					<input type="password" class="form-control" name="old_password" placeholder="旧密码" value="">
				</div>
			</div>
		</div>

		<div class="dashboard-row">
			<div class="row-label">新密码:</div>
			<div class="row-item">
				<div class="input-group w200">
					<input type="password" class="form-control" name="new_password" placeholder="新密码" value="">
				</div>
			</div>
		</div>

		<div class="dashboard-row">
			<div class="row-label">重输新密码:</div>
			<div class="row-item">
				<div class="input-group w200">
					<input type="password" class="form-control" name="new_password_again" placeholder="重输新密码" value="">
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