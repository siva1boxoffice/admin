        <?php $this->load->view(THEME.'common/header');?>

        <!-- Content Wrapper -->
         <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Currency List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative business-dashboard course-dashboard">

                    <div class="dashboard-title is-main">
                            <div class="left">
                                <h2 class="dark-inverted">Email Templates</h2>
                            </div>
                            <div class="right">
                                <div class="list-flex-toolbar is-reversed ">
                        <a class="button is-circle is-primary" href="<?php echo base_url();?>settings/email_templates/add_email_template">
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
                                    <span class="is-grow">Template Type</span>
                                  
                                    <span class="is-grow">&nbsp;&nbsp;CC Email</span>
                                    <span class="is-grow">&nbsp;&nbsp;Subject</span>
                                    <span>Status</span>
                                    <span class="cell-end">Actions</span>
                                    </div>

                                    <div class="flex-list-inner">
                                        <?php foreach($emails as $email){
                                           // echo "<pre>";print_r($match);
                                         ?>
                                        <!--Table item-->
                                        <div class="flex-table-item">
                                            <div class="flex-table-cell is-media is-grow">
                                               
                                                <div>
                                                    <span class="item-name dark-inverted" data-filter-match><?php echo $email->template_key;?></span>
                                                </div>
                                            </div>
                                            <div class="flex-table-cell is-media is-grow">
                                               
                                                <div>
                                                    <span class="light-text" data-filter-match><?php echo $email->cc_email;?></span>
                                                </div>
                                            </div>

                                             

                                            

                                            <div class="flex-table-cell is-grow" data-th="Industry">
                                                <span class="light-text" data-filter-match><?= $email->subject_english; ?></span>
                                            </div>

                                            
                                              <div class="flex-table-cell" data-th="Status">
                                            <?php if($email->status == '1'){ ?>
                                            <span class="tag is-success is-rounded">Active</span>
                                            <?php }else if($email->status != '1'){ ?>
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
                                                        <a href="<?php echo base_url();?>settings/email_templates/add_email_template/<?php echo base64_encode(json_encode($email->id));?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit Template Details</span>
                                                            </div>
                                                        </a>
                                                        
                                                        <hr class="dropdown-divider">
                                                        <a id="branch_<?php echo $email->id;?>" href="javascript:void(0);" data-href="<?php echo base_url();?>settings/email_templates/delete_email_templates/<?php echo $email->id;?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $email->id;?>');">
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
                                        </div>                                        </div>

                                         <?php } ?>

                                          <!-- Paginate -->
                                <div class="pagination datatable-pagination pagination-datatables flex-column">
                                        <?php echo $pagination; ?>
                                </div>

                                    </div>

                                </div>


                        </div>

                    </div>

                </div>
            </div>
        </div>

                <?php $this->load->view(THEME.'common/footer');?>
                <?php exit;?>
