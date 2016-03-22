<?php $this->load->view('header');?>
    <!-- main Begin -->
    <div class="main">
        <div class="dashboard-title">
            <span>图片管理</span>
        </div>
        <div class="dashboard-section">
            <form method="get" accept-charset="utf-8" action="<?php echo site_url('media'); ?>" id="navForm">
                <ul class="nav nav-tabs">
                    <li role="presentation" <?php echo $info['status'] == 'all' ?  'class="active"' : ''?>><a href="javascript:gotoStatus('all');">全部 (<?php echo $status_count['all']; ?>)</a></li>
                    <li role="presentation" <?php echo $info['status'] == 'related' ?  'class="active"' : ''?>><a href="javascript:gotoStatus('related');">已关联 (<?php echo $status_count['related']; ?>)</a></li>
                    <li role="presentation" <?php echo $info['status'] == 'unrelated' ?  'class="active"' : ''?>><a href="javascript:gotoStatus('unrelated');">未关联 (<?php echo $status_count['unrelated']; ?>)</a></li>
                    <li style="float:right;">
                        <button class="btn btn-default" type="button" onclick="window.location.href= '<?php echo site_url('media/clear') ?>'">清除无效图片</button>
                    </li>
                </ul>
                <input type="hidden" name="status" value="<?php echo $info['status']; ?>" />
            </form>
        </div>
        <div class="dashboard-section">
            <?php echo form_open('media/group_operation', array('id' => 'mainform'));  ?>
            <table class="table table-hover dashboard-table">
                <thead>
                <tr>
                    <th width="30px"><input type="checkbox" id="check-all" name="check-all" onclick="toggleAllChecbox();"></th>
                    <th></th>
                    <th>名称</th>
                    <th>相关文章</th>
                    <th>路径</th>
                    <th>上传时间</th>
                    <th width="120px" class="text-right">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($medias as $media):?>
                    <tr>
                        <td><input type="checkbox" class="item-check" name="ids[]" value="<?php echo $media['media_id']; ?>" onclick="toggleEachCheckbox(this);"></td>
                        <td><div class="thumb-container"><img src="<?php echo $media['media_thumb']; ?>"></div></td>
                        <td><?php echo $media['media_name']; ?></td>
                        <td>
                            <?php if($media['post_id']): ?>
                                <a href="<?php echo site_url('post/edit/'.$media['post_id']); ?>"><?php echo $media['post_name']; ?></a>
                            <?php else: ?>
                                <?php echo $media['post_name']; ?>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $media['media_path']; ?></td>
                        <td><?php echo $media['media_datetime']; ?></td>
                        <td class="text-right">
                            <a href="<?php echo $media['media_path']; ?>" title="查看图片" target="_blank"><i class="fa fa-picture-o"></i></a>
                            <span>|</span>
                            <a href="javascript:void(0);" title="删除" data-url="<?php echo site_url('media/delete/'.$media['media_id']); ?>" data-name="<?php echo $media['media_name'] ?>" onclick="confirmDelete(this);"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="7">
                        <button class="btn btn-danger group-operation-btn" type="button" disabled="disabled" onclick="confirmGroupDelete();">批量永久删除</button><!-- 显示、触发确认框 -->
                        <button type="submit" name="group-delete" value="group-delete" style="display: none;">批量永久删除</button><!-- 确定确认框后，触发此按钮的submit -->
                    </td>
                </tr>
            </table>
            <div class="text-right">
                <?php echo $pagination_link ?>
            </div>
            <?php echo form_close(); ?>
        </div>
        <script type="text/javascript">
            function gotoStatus(status){
                $('#navForm input[name="status"]').val(status);
                submitNavForm();
            }
            function submitNavForm(){
                $('#navForm').submit();
            }

            function confirmDelete(obj){
                var $obj = $(obj);
                var name = $obj.attr('data-name');
                var url = $obj.attr('data-url');
                var result = confirm('确定永久删除图片"'+name+'"?');
                if(result){
                    window.location.href = url;
                }
            }

            function confirmGroupDelete(){
                var result = confirm('确定批量永久删除图片?');
                if(result){
                    $('button[name="group-delete"]').click();
                }
            }

            function toggleAllChecbox(){
                if($('#check-all').prop('checked')){
                    $('input:checkbox[name="ids[]"]').prop('checked',true);
                }else{
                    $('input:checkbox[name="ids[]"]').prop('checked',false);
                }
                checkGroupSelected();
            }
            function toggleEachCheckbox(obj){
                if($(obj).prop('checked') == false){
                    $('#check-all').prop('checked', false);
                }else{
                    var allCheckbox = $('input:checkbox[name="ids[]"]').length;
                    var selectedCheckbox = $('input:checkbox[name="ids[]"]:checked').length;
                    if(selectedCheckbox == allCheckbox){
                        $('#check-all').prop('checked', true);
                    }
                }
                checkGroupSelected();
            }
            function checkGroupSelected(){
                if($('input:checkbox[name="ids[]"]:checked').length > 0){
                    $('button.group-operation-btn').prop('disabled', false);
                    $('button.group-operation-btn').prop('disabled', false);
                }else{
                    $('button.group-operation-btn').prop('disabled', true);
                    $('button.group-operation-btn').prop('disabled', true);
                }
            }
        </script>
    </div>
    <!-- main End -->
<?php $this->load->view('footer');?>