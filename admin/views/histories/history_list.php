<?php $this->load->view('header');?>
    <!-- main Begin -->
    <div class="main">
        <div class="dashboard-title">
            <span>访问记录</span>
        </div>
        <div class="dashboard-section">
            <table class="table table-hover dashboard-table">
                <thead>
                <tr>
                    <th>IP</th>
                    <th>访问时间</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($records as $record):?>
                    <tr>
                        <td><?php echo $record['ip'] ?></td>
                        <td><?php echo $record['datetime'] ?></td>
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