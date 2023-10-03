<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative business-dashboard course-dashboard">

                  <div class="dashboard-title is-main">
                        <div class="left">
                            <h2 class="dark-inverted">Users List</h2>
                        </div>
                        <div class="right">
                            <div class="list-flex-toolbar is-reversed ">
                        <a title="Create New User" class="button is-circle is-primary" href="<?php echo base_url();?>api/api_partners/add_partner/1">
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
                                    <span class="is-grow">User</span>
                                    <span>Location</span>
                                    <span>Contact</span>
                                    <span>Status</span>
                                    <span class="cell-end">Actions</span>
                                </div>
                                <?php foreach ($users as $user) { //echo "<pre>";print_r($role); 
                                ?>

                                    <div class="flex-table-item">
                                        <div class="flex-table-cell is-media is-grow">
                                            <div class="h-avatar is-medium">
                                                <img class="avatar" src="<?php echo $user->admin_profile_pic; ?>" data-demo-src="<?php echo $user->admin_profile_pic; ?>" alt="" data-user-popover="3">
                                            </div>
                                            <div>
                                                <span class="item-name dark-inverted" data-filter-match><?php echo $user->admin_name; ?> <?php echo $user->admin_last_name; ?></span>
                                                <span class="item-meta">
                                                    <span data-filter-match><?php echo $user->company_name; ?></span>

                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-table-cell is-bold" data-th="Company">
                                            <span class="light-text"><?php echo $user->city_name; ?>,<?php echo $user->country_name; ?></span>
                                        </div>
                                        <div class="flex-table-cell is-bold" data-th="Company">
                                            <span class="light-text"><?php echo $user->admin_cell_phone; ?></span>
                                        </div>
                                        <div class="flex-table-cell" data-th="Status">
                                            <?php if ($user->admin_status == 'ACTIVE') { ?>
                                                <span class="tag is-success is-rounded">Active</span>
                                            <?php } else if ($user->admin_status != 'ACTIVE') { ?>
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
                                                        <a href="<?php echo base_url(); ?>api/api_partners/add_partner/1/<?php echo base64_encode(json_encode($user->admin_id)); ?>" class="dropdown-item is-media">

                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit Partner Details</span>
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