<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/dashboard.css">
</head>
<body>
	<header class="topbar">
		<a class="logo float-left" href="<?php echo site_url('home/index');?>"><i class="fa fa-home"></i></a>
		<a class="topbar-btn float-left" href="<?php echo site_url('home/index');?>">管理控制台</a>
		<a class="login-out topbar-btn float-right" href="<?php echo site_url('login/login_out');?>"><i class="fa fa-power-off"></i></a>
		<a class="topbar-text float-right">Hi,<?php echo 'Admin';?></a>
	</header>
	<!-- dashboard-body Begin -->
	<div class="dashboard-body">
		<nav class="sidebar">

			<ul class="menu">
				<li title="类别管理"><a href="javascript:void(0);"><i class="fa fa-list"></i></a></li>
				<li title="文章管理"><a href="javascript:void(0);"><i class="fa fa-file-text "></i></a></li>
				<li title="用户设置"><a href="javascript:void(0);"><i class="fa fa fa-user"></i></a></li>
				<li title="网站设置"><a href="javascript:void(0);"><i class="fa fa-cog"></i></a></li>
			</ul>
		</nav>