<?php $this->load->view('header');?>
<meta http-equiv="refresh" content="<?php echo $refreshTime?>;url=<?php echo site_url($url);?>"/>
<!-- main Begin -->
<div class="main">
	<div class="page-tips-panel panel panel-<?php echo $type; ?>">
		<div class="panel-heading">
			<h4 class="panel-title">信息提示</h4>
		</div>
		<div class="panel-body text-center">
			<h3><?php echo $tips; ?></h3>
			<p><?php echo $refreshTime?>秒后系统将自动跳转</p>
			<p>您可以点击<a href="<?php echo site_url($url);?>">这里</a>返回</p>
		</div>
	</div>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>