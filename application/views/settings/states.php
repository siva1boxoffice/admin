        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="State List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
            <div class="page-content-wrapper">
                <div class="page-content is-relative business-dashboard course-dashboard">
                   

                    <div class="dashboard-title is-main">
                            <div class="left">
                                <h2 class="dark-inverted">State Lists</h2>
                            </div>
                            <div class="right">
                            <div class="list-flex-toolbar is-reversed ">
                        <a title="Add New State" class="button is-circle is-primary" href="<?php echo base_url(); ?>settings/states/add" class="button h-button is-primary is-elevated">
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
                                    <span>Country Name</span>
                                    <span>State Name</span>
                                    <span class="cell-end">Actions</span>
                                </div>
                                <?php
                                foreach ($states as $state) {
                                ?>
                                    <div class="flex-table-item">                                       
                                        <div class="flex-table-cell is-bold" data-th="country">
                                            <span class="dark-text" data-filter-match><?php echo $state->country; ?></span>
                                        </div>
                                        <div class="flex-table-cell is-bold" data-th="code">
                                            <span class="dark-text" data-filter-match><?php echo $state->name; ?></span>
                                        </div>                                       
                                        <div class="flex-table-cell cell-end" data-th="Actions">
                                            <div class="dropdown is-spaced is-dots is-right dropdown-trigger is-pushed-mobile">
                                                <div class="is-trigger" aria-haspopup="true">
                                                    <i data-feather="more-vertical"></i>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                        <a href="<?php echo base_url(); ?>settings/states/edit/<?php echo $state->id; ?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit State Details</span>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">
                                                        <a id="branch_<?php echo $state->id; ?>" href="javascript:void(0);" data-href="<?php echo base_url(); ?>settings/states/delete/<?php echo $state->id; ?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $state->id; ?>');">
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
