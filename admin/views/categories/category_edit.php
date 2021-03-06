<?php $this->load->view('header');?>
<!-- main Begin -->
<div class="main">
	<div class="dashboard-title">
		<span>编辑类别</span>
	</div>
	<div class="dashboard-section dashboard-small-label">
        <?php echo form_open('category/update');?>
            <div class="dashboard-row">
                <div class="row-label">类别编号:</div>
                <div class="row-item">
                    <div class="input-group w200">
                        <input type="text" class="form-control" name="cid" placeholder="类别编号" value="<?php echo $category['category_id']; ?>" readonly="readonly">
                    </div>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">类别名称:</div>
                <div class="row-item">
                    <div class="input-group w200">
                        <input type="text" class="form-control" name="cname" placeholder="类别名称" value="<?php echo $category['category_name']; ?>" required="required">
                    </div>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label">Slug:</div>
                <div class="row-item">
                    <div class="input-group w200">
                        <input type="text" class="form-control" name="cslug" placeholder="Slug"  value="<?php echo $category['category_slug']; ?>" required="required">
                    </div>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="row-label"></div>
                <div class="row-item">
                    <button class="btn btn-default" type="submit">更新</button>
                </div>
            </div>
        <?php echo form_close(); ?>
	</div>
</div>
<!-- main End -->
<?php $this->load->view('footer');?>