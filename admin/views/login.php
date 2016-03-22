<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="<?php echo site_url();?>../favicon.ico"/>
<link rel="bookmark" href="<?php echo site_url();?>../favicon.ico"/>
<title>博客管理系统</title>

<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/font-awesome.css">
<!--
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css">
-->
<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/login.css">

<script type="text/javascript" src="<?php echo site_url();?>../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo site_url();?>../assets/js/bootstrap.min.js"></script>
<!--
<script type="text/javascript" src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
-->
</head>
<body>
	<div class="login-body">
		<form method="post" action="<?php echo site_url('login/check'); ?>">
			<div class="login-form">
				<h1 class="login-title">博客管理系统</h1>
				<div class="login-box">
					<div class="form-group">
						<input type="text" class="form-control login-element" name="username" placeholder="用户名" value="" />
						<i class="fa fa-user"></i>
					</div>
					<div class="form-group">
						<input type="password" class="form-control login-element" name="password" placeholder="密码"  value="" />
						<i class="fa fa-lock"></i>
					</div>
					<div><button type="submit" class="btn btn-default btn-block login-element">登录</button></div>
				</div>
			</div>
		</form>
	</div>
</body>
</html>