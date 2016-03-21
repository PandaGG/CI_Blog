<?php $this->load->view('header');?>
    <!-- main Begin -->
    <div class="main">
        <div class="dashboard-title">
            <span>图片管理</span>
        </div>
        <div class="dashboard-section">
            <table class="table table-hover dashboard-table">
                <thead>
                <tr>
                    <th width="30px"><input type="checkbox" id="check-all" name="check-all"></th>
                    <th width="100px">ID</th>
                    <th>名称</th>
                    <th>相关文章</th>
                    <th>状态</th>
                    <th>路径</th>
                    <th>上传时间</th>
                    <th width="120px" class="text-right">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($medias as $media):?>
                    <tr>
                        <td><input type="checkbox" class="item-check" name="ids[]" value="<?php echo $media['media_id']; ?>"></td>
                        <td><?php echo $media['media_id'] ?></td>
                        <td><?php echo $media['media_name'] ?></td>
                        <td><?php echo $media['post_name'] ?></td>
                        <td><?php echo $media['media_status'] ?></td>
                        <td><?php echo $media['media_path'] ?></td>
                        <td><?php echo $media['media_datetime'] ?></td>
                        <td class="text-right">

                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <div class="text-right">
                <?php echo $pagination_link ?>
            </div>
        </div>

    </div>
    <!-- main End -->
<?php $this->load->view('footer');?>