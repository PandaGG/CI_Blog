<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
	<div class="dashboard-title">
		<span>后台首页</span>
		<a href="javascript:void(0);"><i class="fa fa-plus"></i> 添加文章 </a>
		<a href="javascript:void(0);"><i class="fa fa-plus"></i> 添加栏目 </a>
	</div>
	<div class="dashboard-section">
		<div class="">
			<dl>
				<dt>环境配置信息</dt>
				<dd>PHP版本：<?php echo PHP_VERSION;?></dd>
				<dd>Mysql类型：<?php echo $this->db->platform();?> /<?php echo $this->db->version();?></dd>
				<dd>服务器端信息：<?PHP echo $_SERVER['SERVER_SOFTWARE']; ?></dd>
				<dd>服务器操作系统： <?PHP echo PHP_OS; ?></dd>
				<dd>运行环境：<?php echo $_SERVER['SERVER_SOFTWARE'];?></dd>
				<dd>上传限制：<?php $max_upload = ini_get("file_uploads") ? ini_get("upload_max_filesize") : "Disabled"; echo $max_upload;?></dd>
				<dd>服务器时间：<?php echo date("Y-m-d H:i:s",time());?></dd>
			</dl>
		</div>
	</div>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>