        <?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
         <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Currency List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative business-dashboard course-dashboard">

                    

                    <div class="dashboard-title is-main">
                            <div class="left">
                            <?php if($role == 1){ ?>
                                <h2 class="dark-inverted">Seller Markup</h2>
                            <?php } ?>
                            <?php if($role == 2){ ?>
                                <h2 class="dark-inverted">Partner Markup</h2>
                            <?php } ?>
                            <?php if($role == 3){ ?>
                                <h2 class="dark-inverted">Afliliate Markup</h2>
                            <?php } ?>
                            </div>
                            <div class="right">
                                <div class="list-flex-toolbar is-reversed ">
                            <?php if($role == 1){ ?>
                        <a class="button is-circle is-primary" href="<?php echo base_url();?>settings/seller_settings/add_seller_settings">
                        <span class="icon is-small">
                        <i data-feather="plus"></i>
                        </span>
                        </a>
                        <?php } ?>
                          <?php if($role == 2){ ?>
                        <a class="button is-circle is-primary" href="<?php echo base_url();?>settings/seller_settings/add_partner_settings">
                        <span class="icon is-small">
                        <i data-feather="plus"></i>
                        </span>
                        </a>
                        <?php } ?>
                         <?php if($role == 3){ ?>
                        <a class="button is-circle is-primary" href="<?php echo base_url();?>settings/seller_settings/add_afliliate_settings">
                        <span class="icon is-small">
                        <i data-feather="plus"></i>
                        </span>
                        </a>
                        <?php } ?>
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
                                    <span class="">User</span>
                                    <span>Markup Type</span>
                                    <span>Markup</span>
                                    <span class="">Status</span>
                                    <span class="cell-end">Actions</span>
                                    </div>

                                    <div class="flex-list-inner">
                                        <?php
                                        //echo "<pre>";print_r($markups);
                                         foreach($markups as $markup){
                                           // echo "<pre>";print_r($match);
                                         ?>
                                        <!--Table item-->
                                        <div class="flex-table-item">
                                            <div class="flex-table-cell is-media " data-th="Name">
                                               
                                                <div>
                                                    <span class="item-name dark-inverted" data-filter-match><?php echo $markup->admin_name;?> <?php echo $markup->admin_last_name;?></span>
                                                </div>
                                            </div>
                                            <div class="flex-table-cell " data-th="Verified">
                                            <?php if($markup->markup_type == 'TO_CUSTOMER'){ ?>
                                            <span class="tag is-success is-rounded">To Customer</span>
                                            <?php }else if($markup->markup_type == 'TO_SELLER'){ ?>
                                            <span class="tag is-info is-rounded">To Seller</span>
                                           <?php }else if($markup->markup_type == 'TO_PARTNER'){ ?>
                                            <span class="tag is-info is-rounded">To Partner</span>
                                            <?php } ?>
                                        </div>

                                              <div class="flex-table-cell is-media " data-th="Mobile No.">
                                               
                                                <div>
                                                    <span class="light-text" data-filter-match><?php echo $markup->markup;?> %</span>
                                                </div>
                                            </div>

                                            

                                          <div class="flex-table-cell" data-th="Status">
                                             <?php if($markup->tickets_markup_status == '1'){ ?>
                                            <span class="tag is-success is-rounded">Active</span>
                                            <?php }else if($markup->tickets_markup_status != '1'){ ?>
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

                                                    <?php if($role == 1){ ?>
                                                        <a href="<?php echo base_url();?>settings/seller_settings/add_seller_settings/<?php echo base64_encode(json_encode($markup->id));?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit Seller Markup</span>
                                                            </div>
                                                        </a>
                                                        <?php } ?>

                                                        <?php if($role == 2){ ?>
                                                        <a href="<?php echo base_url();?>settings/seller_settings/add_partner_settings/<?php echo base64_encode(json_encode($markup->id));?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit Partner Markup</span>
                                                            </div>
                                                        </a>
                                                        <?php } ?>    
                                                        <?php if($role == 3){ ?>
                                                        <a href="<?php echo base_url();?>settings/seller_settings/add_afliliate_settings/<?php echo base64_encode(json_encode($markup->id));?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit afliliate Markup</span>
                                                            </div>
                                                        </a>
                                                        <?php } ?>                                                       
                                                        <hr class="dropdown-divider">
                                                        <a id="branch_<?php echo $markup->id;?>" href="javascript:void(0);" data-href="<?php echo base_url();?>settings/seller_settings/delete_seller_markup/<?php echo $markup->id;?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $markup->id;?>');">
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

                <?php $this->load->view('common/footer');?>
                <?php exit;?>