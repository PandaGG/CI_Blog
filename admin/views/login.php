<!DOCTYPE html>
<html lang="en">
<head>
<title>内容管理系统</title>
<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo site_url();?>../assets/css/login.css">
</head>
<body>
	<div class="login-body">
		<form method="post" action="login/check">
			<div class="login-form">
				<h1 class="login-title">内容管理系统</h1>
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