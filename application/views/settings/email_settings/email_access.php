        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Currency List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
            <div class="page-content-wrapper">
                <div class="page-content is-relative business-dashboard course-dashboard">
                    

                    <div class="dashboard-title is-main">
                            <div class="left">
                                <h2 class="dark-inverted">Email Access</h2>
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
                                <div class="flex-table-header" data-filter-hide>
                                    <span>Smtp</span>
                                    <span>Host</span>
                                    <span>Port</span>
                                    <span>Username</span>
                                    <span>password</span>
                                    <span>Status</span>
                                    <span class="cell-end">Actions</span>
                                </div>
                                <?php
                                foreach ($email_access as $email_acc) {
                                ?>
                                    <div class="flex-table-item">                                       
                                        <div class="flex-table-cell is-bold" data-th="currency">
                                            <span class="dark-text" data-filter-match><?php echo $email_acc->smtp; ?></span>
                                        </div>
                                        <div class="flex-table-cell is-bold" data-th="code">
                                            <span class="dark-text" data-filter-match><?php echo $email_acc->host; ?></span>
                                        </div>
                                        <div class="flex-table-cell is-bold" data-th="symbol">
                                            <span class="dark-text" data-filter-match><?php echo $email_acc->port; ?></span>
                                        </div>
                                        <div class="flex-table-cell is-bold" data-th="Category">
                                            <span class="dark-text" data-filter-match><?php echo $email_acc->username; ?></span>
                                        </div>
                                         <div class="flex-table-cell is-bold" data-th="Category">
                                            <span class="dark-text" data-filter-match><?php echo $email_acc->password; ?></span>
                                        </div>

                                        <div class="flex-table-cell" data-th="Status">
                                            <?php if ($email_acc->status == '1') { ?>
                                                <span class="tag is-success is-rounded">Active</span>
                                            <?php } else if ($email_acc->status != '1') { ?>
                                                <span class="tag is-danger is-rounded">InActive</span>
                                            <?php } ?>
                                        </div>
                                        <div class="flex-table-cell cell-end" data-th="Actions">
                                            <div class="dropdown is-spaced is-dots is-right dropdown-trigger is-pushed-mobile">
                                                <div class="is-trigger" aria-haspopup="true">
                                                    <i data-feather="more-vertical"></i>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                         <a href="<?php echo base_url(); ?>settings/email_settings/edit_email_access/<?php echo base64_encode(json_encode($email_acc->id)); ?>" class="dropdown-item is-media">

                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit Access Details</span>
                                                            </div>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
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