<html>
    <head>
	    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php echo $_SESSION['site_info']['site_description']; ?>">
		<meta name="keywords" content="<?php echo $_SESSION['site_info']['site_keywords']; ?>">
		<meta name="author" content="Josh">
		<title><?php echo $page_title; ?></title>
		<link rel="stylesheet" href="<?php echo site_url();?>assets/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo site_url();?>assets/css/font-awesome.css">
	    <link rel="stylesheet" href="<?php echo site_url();?>assets/css/main.css" />
	    <script src="<?php echo site_url();?>assets/js/jquery.min.js"></script>
	    <script src="<?php echo site_url();?>assets/js/bootstrap.min.js"></script>
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
							<li><a href="/">首页</a></li>
							<li><a href="/categories">类别</a></li>
							<li><a href="/about">关于</a></li>
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
	    			
	   			
	   				
    		
