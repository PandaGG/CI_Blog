<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="<?php echo site_url();?>../favicon.ico"/>
<link rel="bookmark" href="<?php echo site_url();?>../favicon.ico"/>
<title>管理控制台</title>

<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo site_url();?>../assets/js/jquery-plugin/bootstrap-select/bootstrap-select.css">
<link rel="stylesheet" href="<?php echo site_url();?>../assets/js/jquery-plugin/summernote/summernote.css">

<!--
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/summernote/0.8.1/summernote.css">
-->
<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/dashboard.css">

<script type="text/javascript" src="<?php echo site_url();?>../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo site_url();?>../assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo site_url();?>../assets/js/jquery-plugin/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo site_url();?>../assets/js/jquery-plugin/summernote/summernote.min.js"></script>
<script type="text/javascript" src="<?php echo site_url();?>../assets/js/jquery-plugin/summernote/lang/summernote-zh-CN.js"></script>

<!--
<script type="text/javascript" src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdn.bootcss.com/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="//cdn.bootcss.com/summernote/0.8.1/summernote.min.js"></script>
<script type="text/javascript" src="//cdn.bootcss.com/summernote/0.8.1/lang/summernote-zh-CN.min.js"></script>
-->

<script type="text/javascript" src="<?php echo site_url();?>../assets/js/dashboard/dashboard.js"></script>

<script>
	var site_url = "<?php echo site_url();?>";
</script>
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
				<li <?php if($this->uri->segment(1)=='post'){echo "class='on'";}?> title="文章管理"><a href="<?php echo site_url('post');?>"><i class="fa fa-file-text"></i><span>文章管理</span></a></li>
				<li <?php if($this->uri->segment(1)=='media'){echo "class='on'";}?> title="图片管理"><a href="<?php echo site_url('media');?>"><i class="fa fa-picture-o"></i><span>图片管理</span></a></li>
				<li <?php if($this->uri->segment(1)=='history'){echo "class='on'";}?> title="访问记录"><a href="<?php echo site_url('history');?>"><i class="fa fa-history"></i><span>访问记录</span></a></li>
				<li <?php if($this->uri->segment(1)=='user'){echo "class='on'";}?> title="用户设置"><a href="<?php echo site_url('user');?>"><i class="fa fa fa-user"></i><span>用户设置</span></a></li>
				<li <?php if($this->uri->segment(1)=='setting'){echo "class='on'";}?> title="网站设置"><a href="<?php echo site_url('setting');?>"><i class="fa fa-cog"></i><span>网站设置</span></a></li>
			</ul>
		</nav>