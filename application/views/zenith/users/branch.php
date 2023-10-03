        <?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                    <div class="page-content-inner">
                        <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">Branches</h2>
                                </div>
                                <div class="right">
                                    <a href="<?php echo base_url();?>home/branch/add_branch" class="button h-button is-primary is-elevated">Create New Branch</a>
                                </div>
                            </div>
                        <div class="flex-list-wrapper">

                        

                           <div class="flex-table">

                                    <!--Table header-->
                                    <div class="flex-table-header">
                                        <span>Branch name</span>
                                        <span>Status</span>
                                         <span class="cell-end">Actions</span>
                                    </div>
                                    <?php foreach($branches as $branch){ //echo "<pre>";print_r($role); ?>
                                    <div class="flex-table-item">
                                        <div class="flex-table-cell is-bold" data-th="Company">
                                            <span class="dark-text"><?php echo $branch->branch_name;?></span>
                                        </div>
                                        <div class="flex-table-cell" data-th="Status">
                                            <?php if($branch->status == '1'){ ?>
                                            <span class="tag is-success is-rounded">Active</span>
                                            <?php }else if($branch->status == '0'){ ?>
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
                                                        <a href="<?php echo base_url();?>home/branch/add_branch/<?php echo base64_encode(json_encode($branch->branch_id));?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit Branch Details</span>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">
                                                        <a id="branch_<?php echo $branch->branch_id;?>" href="javascript:void(0);" data-href="<?php echo base_url();?>home/branch/delete_branch/<?php echo $branch->branch_id;?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $branch->branch_id;?>');">
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

                                   

                                </div>

                          
                        </div>

                    </div>

                <?php $this->load->view('common/footer');?>
                <?php exit;?>