s<?php $this->load->view('common/header'); ?>

<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Login Report" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
    <div class="page-content-wrapper">
        <div class="page-content is-relative business-dashboard course-dashboard">


                    
                    <div class="dashboard-title is-main">
                            <div class="left">
                                <h2 class="dark-inverted">Login Report</h2>
                            </div>
                            <div class="right">
                                <div class="list-flex-toolbar is-reversed ">
                       
                         <div class="control has-icon">

                            <input class="input custom-text-filter" placeholder="Search..." data-filter-target=".flex-table-item">
                            <div class="form-icon">
                                <i data-feather="search"></i>
                            </div>
                            
                        </div>

                        
                    </div>
                           
                        </div>
                        </div>

            <div class="page-content-inner">
               
                <div class="flex-list-wrapper"> 
                    <div class="flex-table">

                        <!--Table header-->
                        <div class="flex-table-header data-filter-hide">
                            <span>Login Tracking IP</span>
                            <span>System Info</span>
                            <span>Login Attempt</span>
                            <span>Status</span>
                            <span class="cell-end">Time</span>
                        </div>
                        <?php foreach ($login_details as $data) {
                        ?>
                            <div class="flex-table-item">
                                <div class="flex-table-cell is-bold" data-th="IP">
                                    <span class="dark-text" data-filter-match><?php echo $data->login_track_details_ip; ?></span>
                                </div>
                                <div class="flex-table-cell is-bold" data-th="IP">
                                    <span class="dark-text" data-filter-match><?php echo $data->login_track_details_system_info; ?></span>
                                </div>
                                <div class="flex-table-cell is-bold" data-th="IP">
                                    <span class="dark-text" data-filter-match><?php echo $data->attempt; ?></span>
                                </div>
                                <div class="flex-table-cell is-bold" data-th="IP">
                                    <span class="dark-text" data-filter-match><?php echo $data->login_track_status_info; ?></span>
                                </div>
                                <div class="flex-table-cell is-bold" data-th="IP">
                                    <span class="dark-text" data-filter-match><!-- <?php echo $data->login_tracking_details_time_stamp; ?> -->
                                    <?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$data->login_tracking_details_time_stamp))).' '.@$_COOKIE["time_zone"];?>
                                    </span>
                                </div>                               
                            </div>
                        <?php } ?>
                        <!-- Paginate -->
                        <div class="pagination datatable-pagination pagination-datatables flex-column">
                            <?php echo $pagination; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('common/footer'); ?>
            <?php exit;?>