        <?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-project" class="view-wrapper is-webapp" data-page-title="Flex Lists" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
             <div class="page-content is-relative business-dashboard course-dashboard">

                    
                    <div class="dashboard-title is-main">
                            <div class="left">
                                <h2 class="dark-inverted">Other Events Category</h2>
                            </div>
                            <div class="right">
                                <div class="list-flex-toolbar is-reversed flex-list-v2">
                        <a class="button is-circle is-primary" href="<?php echo base_url(); ?>event/other_events_category/add_category">
                            <span class="icon is-small">
                                <i data-feather="plus"></i>
                            </span>
                        </a>
                        &nbsp;
                        <div class="control has-icon">
                        <form method='post' action="<?= base_url() ?>event/other_events_category">
                                <input type='text' class="input serchText" name='search' value='<?= $search ?>' placeholder="Search...">
                                <div class="form-icon">
                                    <i data-feather="search"></i>
                                </div>
                                <input type='submit' class="button h-button is-primary is-raised" name='submit' value='Search'>
                            </form>
                        </div>
                        
                    </div>
                            </div>
                        </div>

                  

                    <div class="page-content-inner">


                        <div class="flex-list-wrapper flex-list-v2">
                          <!--Active Tab-->
                          <div id="active-items-tab" class="tab-content is-active">

                            <div class="flex-table">

                                <!--Table header-->
                                <div class="flex-table-header" data-filter-hide>
                                    <span class="is-grow">Category Name</span>
                                    <span class="is-grow">Parent Category</span>
                                    <span class="is-grow">Sort</span>
                                    <span>Status</span>
                                    <span class="cell-end">Actions</span>
                                </div>

                                <div class="flex-list-inner">
                                    <?php foreach($other_events_categories as $event){                                      ?>
                                       <!--Table item-->
                                       <div class="flex-table-item">
                                        <div class="flex-table-cell is-media is-grow">

                                            <div>
                                                <span class="item-name dark-inverted" data-filter-match><?php echo $event->category_name;?></span>
                                            </div>
                                        </div>
                                        <div class="flex-table-cell is-media is-grow">

                                            <div>
                                                <span class="light-text" data-filter-match><?php echo $event->PARENT;?></span>
                                            </div>
                                        </div>

                                        <div class="flex-table-cell is-media is-grow">

                                            <div>
                                                <span class="light-text" data-filter-match><?php echo $event->sort; ?></span>
                                            </div>
                                        </div>                                            
                                        <div class="flex-table-cell" data-th="Status">
                                            <?php if($event->status == '1'){ ?>
                                                <span class="tag is-success is-rounded">Active</span>
                                            <?php }else if($event->status != '1'){ ?>
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
                                                        <a href="<?php echo base_url();?>event/other_events_category/add_category/<?php echo base64_encode(json_encode($event->id));?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit Category Details</span>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">
                                                        <a id="branch_<?php echo $event->id;?>" href="javascript:void(0);" data-href="<?php echo base_url();?>event/other_events_category/delete_category/<?php echo $event->id;?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $event->id;?>');">
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
    </div>

    <?php $this->load->view('common/footer');?>
    <?php exit;?>
