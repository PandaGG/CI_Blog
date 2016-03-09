<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
	<div class="dashboard-title">
		<span>后台首页</span>
		<a href="<?php echo site_url('post/create'); ?>" title="添加文章"><i class="fa fa-plus"></i> 添加文章 </a>
		<a href="<?php echo site_url('category/create');?>" title="添加类别"><i class="fa fa-plus"></i> 添加类别 </a>
	</div>
    <div class="dashboard-section">
        <div class="page-tips-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">环境配置信息</h3>
            </div>
            <div class="panel-body">
                <p>PHP版本：<?php echo PHP_VERSION;?></p>
                <p>Mysql类型：<?php echo $this->db->platform();?> /<?php echo $this->db->version();?></p>
                <p>服务器端信息：<?PHP echo $_SERVER['SERVER_SOFTWARE']; ?></p>
                <p>服务器操作系统： <?PHP echo PHP_OS; ?></p>
                <p>运行环境：<?php echo $_SERVER['SERVER_SOFTWARE'];?></p>
                <p>上传限制：<?php $max_upload = ini_get("file_uploads") ? ini_get("upload_max_filesize") : "Disabled"; echo $max_upload;?></p>
                <p>服务器时间：<?php echo date("Y-m-d H:i:s",time());?></p>
            </div>
        </div>
    </div>

</div>
<!-- main End -->
<?php $this->load->view('footer');?>