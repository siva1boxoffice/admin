<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative business-dashboard course-dashboard">

                  <div class="dashboard-title is-main">
                        <div class="left">
                            <h2 class="dark-inverted">API List</h2>
                        </div>
                        <div class="right">
                            <div class="list-flex-toolbar is-reversed ">
                        <a title="Create New API" class="button is-circle is-primary" href="<?php echo base_url();?>api/api_key_settings/add_setting">
                        <span class="icon is-small">
                        <i data-feather="plus"></i>
                        </span>
                        </a>
                        &nbsp;
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
                                    <span class="is-grow">Partner</span>
                                    <span>API Key</span>
                                    <span>Status</span>
                                    <span class="cell-end">Actions</span>
                                </div>
                                <?php foreach ($api_settings as $list) { //echo "<pre>";print_r($list); 
                                ?>

                                    <div class="flex-table-item">
                                        <div class="flex-table-cell is-media is-grow is-bold">
                                            <span class="light-text"><?php echo $list->admin_name.' '.$list->admin_last_name; ?></span>
                                        </div>
                                        <div class="flex-table-cell is-bold" data-th="Company">
                                            <span class="light-text"><?php echo $list->api_key; ?></span>
                                        </div>
                                        <div class="flex-table-cell" data-th="Status">
                                            <?php if ($list->status == 1) { ?>
                                                <span class="tag is-success is-rounded">Active</span>
                                            <?php } else if ($list->status == 0) { ?>
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
                                                       
                                                        <a href="<?php echo base_url(); ?>api/api_key_settings/add_setting/<?php echo base64_encode(json_encode($list->id)); ?>" class="dropdown-item is-media">

                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit API Details</span>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">

                                                        <a id="branch_<?php echo $user->admin_id;?>" href="javascript:void(0);" data-href="<?php echo base_url();?>home/users/delete_user/<?php echo $user->admin_id;?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $user->admin_id;?>');">
                                                            <div class="icon">
                                                                <i class="lnil lnil-trash-can-alt"></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Remove</span>
                                                                <span>Remove from list</span>
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