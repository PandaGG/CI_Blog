<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
<body>
	<header>
		<div class="topbar">
		<a class="logo" href="<?php echo site_url('home/index');?>"><i class="iconfont">&#xe613;</i></a>
		<a class="name">管理控制台</a>
		<a class="login-out" href="<?php echo site_url('login/login_out');?>"><i class="iconfont">&#xe76c;</i></a>
		<a class="user">Hi,<?php echo 'Admin';?></a>
		</div>
	</header>
	<!-- wrapper Begin -->
	<div class="wrapper">
		<nav>
			<ul>
				<li>栏目管理</li>
				<li>文章管理</li>
				<li>用户设置</li>
				<li>网站设置</li>
			</ul>
		</nav>