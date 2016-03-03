<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>管理控制台</title>
<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/dashboard.css">
<script type="text/javascript" src="<?php echo site_url();?>../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo site_url();?>../assets/js/dashboard/dashboard.js"></script>
</head>
<body>
	<header class="topbar">
		<a class="logo float-left" href="<?php echo site_url('home');?>"><i class="fa fa-home"></i></a>
		<a class="topbar-btn float-left" href="<?php echo site_url('home');?>">管理控制台</a>
		<a class="login-out topbar-btn float-right" href="<?php echo site_url('login/login_out');?>"><i class="fa fa-power-off"></i></a>
		<a class="topbar-text float-right">Hi, <?php echo $_SESSION['username'];?></a>
	</header>
	<!-- dashboard-body Begin -->
	<div class="dashboard-body">
		<nav class="sidebar">
			<div class="menu-header"><i class="mini-header fa fa-ellipsis-v"></i><i class="full-header fa fa-ellipsis-h"></i></div>
			<ul class="menu">
				<li <?php if($this->uri->segment(1)=='category'){echo "class='on'";}?> title="类别管理"><a href="<?php echo site_url('category');?>"><i class="fa fa-list"></i><span>类别管理</span></a></li>
				<li <?php if($this->uri->segment(1)=='post'){echo "class='on'";}?> title="文章管理"><a href="<?php echo site_url('post');?>"><i class="fa fa-file-text "></i><span>文章管理</span></a></li>
				<li <?php if($this->uri->segment(1)=='user'){echo "class='on'";}?> title="用户设置"><a href="<?php echo site_url('user');?>"><i class="fa fa fa-user"></i><span>用户设置</span></a></li>
				<li <?php if($this->uri->segment(1)=='setting'){echo "class='on'";}?> title="网站设置"><a href="<?php echo site_url('setting');?>"><i class="fa fa-cog"></i><span>网站设置</span></a></li>
			</ul>
		</nav>