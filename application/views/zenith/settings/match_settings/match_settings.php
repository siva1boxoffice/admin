        <?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-project" class="view-wrapper is-webapp" data-page-title="Flex Lists" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative tabs-wrapper is-slider is-squared is-inverted">

                    <div class="list-flex-toolbar is-reversed flex-list-v2">
                        &nbsp;
                         <div class="control has-icon">

                            <input class="input custom-text-filter" placeholder="Search..." data-filter-target=".flex-table-item">
                            <div class="form-icon">
                                <i data-feather="search"></i>
                            </div>
                            
                        </div>

                        <div class="">

                            
                        </div>
                    </div>

                    <div class="page-content-inner">


                        <div class="flex-list-wrapper flex-list-v2">

                          
                            <!--Active Tab-->
                            <div id="active-items-tab" class="tab-content is-active">

                                <div class="flex-table">

                                    <!--Table header-->
                                    <div class="flex-table-header" data-filter-hide>
                                    <span class="is-grow">Match Name</span>
                                    <span class="is-grow">&nbsp;Home Team</span>
                                    <span class="is-grow">&nbsp;&nbsp;Match Date</span>
                                    <span class="is-grow">&nbsp;&nbsp;Tournament</span>
                                    <span class="is-grow">&nbsp;&nbsp;Top games</span>
                                    <span class="is-grow"> Created By</span>
                                    <span>Status</span>
                                    <span class="cell-end">Actions</span>
                                    </div>

                                    <div class="flex-list-inner">
                                        <?php foreach($matches as $match){
                                           // echo "<pre>";print_r($match);
                                         ?>
                                        <!--Table item-->
                                        <div class="flex-table-item">
                                            <div class="flex-table-cell is-media is-grow">
                                               
                                                <div>
                                                    <span class="item-name dark-inverted" data-filter-match><?php echo $match->match_name;?></span>
                                                </div>
                                            </div>
                                            <div class="flex-table-cell is-media is-grow">
                                               
                                                <div>
                                                    <span class="light-text" data-filter-match><?php echo $match->team_name;?></span>
                                                </div>
                                            </div>

                                             <div class="flex-table-cell is-media is-grow">
                                               
                                                <div>
                                                    <span class="light-text" data-filter-match><?php echo date('d-m-Y H:i',strtotime($match->match_date)); ?></span>
                                                </div>
                                            </div>

                                            

                                            <div class="flex-table-cell is-grow" data-th="Industry">
                                                <span class="light-text" data-filter-match><?= $match->tournament_name; ?></span>
                                            </div>

                                            <div class="flex-table-cell" data-th="Status">
                                                <?php if($match->top_games == '1'){  ?>
                                            <span class="tag is-success is-rounded">Yes</span>
                                            <?php }else if($match->top_games != '1'){ ?>
                                            <span class="tag is-danger is-rounded">No</span>
                                            <?php } ?>
                                            </div>
                                            <div class="flex-table-cell is-grow" data-th="Industry">
                                                <span class="light-text" data-filter-match><?= $match->admin_name; ?> <?= $match->admin_last_name; ?></span>
                                            </div>
                                              <div class="flex-table-cell" data-th="Status">
                                            <?php if($match->match_status == '1'){ ?>
                                            <span class="tag is-success is-rounded">Active</span>
                                            <?php }else if($match->match_status != '1'){ ?>
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
                                                        <a href="<?php echo base_url();?>settings/match_settings/set_match_settings/<?php echo base64_encode(json_encode($match->m_id));?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-cog'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Match Settings</span>
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