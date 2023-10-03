        <?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
         <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Currency List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative business-dashboard course-dashboard">

                    

                    <div class="dashboard-title is-main">
                            <div class="left">
                                <h2 class="dark-inverted">SiteFee Markup</h2>
                            </div>
                            <div class="right">
                                <div class="list-flex-toolbar is-reversed ">
                            
                        <a class="button is-circle is-primary" href="<?php echo base_url();?>settings/sitefee_settings/add_sitefee_settings">
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
                                    <span class="">Tournament</span>
                                    <span class="">Match</span>
                                    <span class="">Store</span>
                                    <!-- <span>Markup Type</span> -->
                                    <span>Markup</span>
                                    <span class="">Status</span>
                                    <span class="cell-end">Actions</span>
                                    </div>

                                    <div class="flex-list-inner">
                                        <?php
                                         foreach($markups as $markup){
                                         ?>
                                        <!--Table item-->
                                        <div class="flex-table-item">
                                            <div class="flex-table-cell is-media " data-th="Name">
                                               
                                                <div>
                                                    <span class="item-name dark-inverted" data-filter-match><?php echo $markup->team_name;?></span>
                                                </div>
                                            </div>
                                            <div class="flex-table-cell is-media " data-th="Name">
                                               
                                                <div>
                                                    <span class="item-name dark-inverted" data-filter-match><?php echo $markup->match_name;?></span>
                                                </div>
                                            </div>
                                            <!-- <div class="flex-table-cell " data-th="Verified">
                                                <span class="light-text" data-filter-match="">
                                                    <img class="imgTbl" src="https://phplaravel-775269-2637193.cloudwaysapps.com/dev/uploads/tournaments/<?=$markup->team_image?>">
                                                </span>
                                            </div> -->
                                            <div class="flex-table-cell is-media " data-th="Mobile No.">
                                                <div>
                                                    <span class="light-text" data-filter-match><?php echo $this->session->userdata('storefront')->company_name;?> </span>
                                                </div>
                                            </div>
                                            <div class="flex-table-cell is-media " data-th="Mobile No.">
                                                <div>
                                                    <span class="light-text" data-filter-match><?php echo $markup->markup;?> %</span>
                                                </div>
                                            </div>
                                          <div class="flex-table-cell" data-th="Status">
                                             <?php if($markup->status == '1'){ ?>
                                            <span class="tag is-success is-rounded">Active</span>
                                            <?php }else if($markup->status != '1'){ ?>
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

                                                    
                                                        <a href="<?php echo base_url();?>settings/sitefee_settings/add_sitefee_settings/<?php echo base64_encode(json_encode($markup->id));?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit Seller Markup</span>
                                                            </div>
                                                        </a>                    
                                                        <hr class="dropdown-divider">
                                                        <a id="branch_<?php echo $markup->id;?>" href="javascript:void(0);" data-href="<?php echo base_url();?>settings/sitefee_settings/delete_sitefee_markup/<?php echo $markup->id;?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $markup->id;?>');">
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