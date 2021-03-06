<html>
    <head>
	    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php echo $_SESSION['site_info']['site_description']; ?>">
		<meta name="keywords" content="<?php echo $_SESSION['site_info']['site_keywords']; ?>">
		<meta name="author" content="Josh">
		<link rel="shortcut icon" href="<?php echo site_url();?>favicon.ico"/>
		<link rel="bookmark" href="<?php echo site_url();?>favicon.ico"/>
		<title><?php echo $page_title; ?></title>

		<?php if(ENVIRONMENT === 'production'): ?>
			<!-- CDN加速 Style-->
			<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" />
			<link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<?php else: ?>
			<!-- 本地获取 Style-->
			<link rel="stylesheet" href="<?php echo site_url();?>assets/css/bootstrap.css" />
			<link rel="stylesheet" href="<?php echo site_url();?>assets/css/font-awesome.css">
		<?php endif; ?>

		<link rel="stylesheet" href="<?php echo site_url();?>assets/css/main.css" />

		<?php if(ENVIRONMENT === 'production'): ?>
		<!-- CDN加速 Script-->
			<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
			<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<?php else: ?>
			<!-- 本地获取 Script-->
			<script src="<?php echo site_url();?>assets/js/jquery.min.js"></script>
			<script src="<?php echo site_url();?>assets/js/bootstrap.min.js"></script>
		<?php endif; ?>

		<script>
			var site_url = '<?php echo site_url();?>';
		</script>
    </head>
    <body>
    	<header id="header" role="banner">
			<div class="sub-header">
				<div class="container">
					<h2><?php echo $_SESSION['site_info']['site_name']; ?></h2>
					<p><?php echo $_SESSION['site_info']['site_description']; ?></p>
				</div>
			</div>
    		<nav class="navbar navbar-default" role="navigation">
	    		<div class="container">
		    		<div class="navbar-header">
						<button data-target=".navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
                            <i class="fa fa-bars"></i>
                        </button>
		    			<a href="/" class="navbar-brand">PanWiki</a>
		    		</div>
					<div class="navbar-collapse collapse">
						<ul id="ul-navbar" class="nav navbar-nav ">
							<li><a href="<?php echo site_url();?>">首页</a></li>
							<li><a href="<?php echo site_url('categories');?>">类别</a></li>
							<li><a href="<?php echo site_url('archives');?>">归档</a></li>
							<li><a href="<?php echo site_url('about');?>">关于</a></li>
						</ul>
						<div class="clearfix"></div>
					</div>

	    		</div>
    		</nav>
    	</header>
    	
    	<section class="wrapper">
	    	<!-- container begin -->
	    	<div class="container">
	    		<!-- row begin -->
	    		<div class="row">
	    			
	   			
	   				
    		
