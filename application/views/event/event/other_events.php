        <?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-project" class="view-wrapper is-webapp" data-page-title="Flex Lists" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative tabs-wrapper is-slider is-squared is-inverted">

                    <div class="list-flex-toolbar is-reversed flex-list-v2">
                        <a class="button is-circle is-primary" href="<?php echo base_url();?>event/other_events/add_event">
                            <span class="icon is-small">
                                <i data-feather="plus"></i>
                            </span>
                        </a>
                        &nbsp;
                        <div class="control has-icon">
						<form method='post' action="<?= base_url() ?>event/other_events/upcoming">
        						<input type='text' class="input serchText" name='search' value='<?= $search ?>' placeholder="Search...">
        						<div class="form-icon">
        							<i data-feather="search"></i>
        						</div>
        						<input type='submit' class="button h-button is-primary is-raised" name='submit' value='Search'>
        					</form>
                            
                        </div>

                        <div class="">

                            <div class="tabs">
                                <ul>
                                    <li <?php if(($status_flag == "upcoming" && $status_flag != "expired" )){ ?> class="is-active" <?php } ?>><a href="<?php echo base_url();?>event/other_events/upcoming"><span>Upcoming</span></a></li>
                                    <li <?php if($status_flag == "expired"){ ?> class="is-active" <?php } ?>><a href="<?php echo base_url();?>event/other_events/expired"><span>Expired</span></a></li>
                                    <li class="tab-naver"></li>
                                </ul>
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
                                        <span class="is-grow">ID</span>
                                        <span class="is-grow">&nbsp;Event Name</span>
                                        <span class="is-grow">&nbsp;&nbsp;Event Date</span>
                                        <span class="is-grow">&nbsp;&nbsp;Category</span>
                                        <span class="is-grow">Status</span>
                                        <span class="is-grow">SEO Status</span>
                                        <span class="is-grow">Seo Preview</span>
                                        <span class="cell-end">Actions</span>
                                    </div>

                                    <div class="flex-list-inner">
                                        <?php foreach($other_events as $event){ ?>
                                            <!--Table item-->
                                            <div class="flex-table-item">
                                                <div class="flex-table-cell is-media is-grow">

                                                    <div>
                                                        <span class="item-name dark-inverted" data-filter-match><?php echo $event->m_id;?></span>
                                                    </div>
                                                </div>
                                                <div class="flex-table-cell is-media is-grow">

                                                    <div>
                                                        <span class="light-text" data-filter-match><?php echo $event->match_name;?></span>
                                                    </div>
                                                </div>
                                                 <div class="flex-table-cell is-media is-grow">

                                                    <div>
                                                        <span class="light-text" data-filter-match><?php echo $event->match_date;?> <?php echo $event->match_time;?></span>
                                                    </div>
                                                </div>
                                                <div class="flex-table-cell is-media is-grow">

                                                    <div>
                                                        <span class="light-text" data-filter-match><?php echo $event->category_name; ?></span>
                                                    </div>
                                                </div>

                                                <div class="flex-table-cell" data-th="Status">
                                                    <?php if($event->status == '1'){ ?>
                                                        <span class="tag is-success is-rounded">Active</span>
                                                    <?php }else if($event->status != '1'){ ?>
                                                        <span class="tag is-danger is-rounded">InActive</span>
                                                    <?php } ?>
                                                </div>
                                                 <div class="flex-table-cell" data-th="SEO Status">
                            <?php if ($event->seo_status == 1) { ?>

                              <span class="tag is-success is-rounded"><i aria-hidden="true" class="fas fa-check"></i></span>
                            <?php } else if ($event->seo_status != 1) { ?>
                              <span class="tag is-warning is-rounded"><i aria-hidden="true" class="fas fa-times "></i></span>
                            <?php } ?>
                          </div>
                                                <div class="flex-table-cell is-media is-grow">
                                        <a target="_blank" href="<?php echo FRONT_END_URL; ?>/<?php echo $this->session->userdata('language_code');?>/<?php echo $event->slug; ?>" class="dropdown-item is-media"><i class='fa fa-eye'></i></a>
                                        </div>
                                                <div class="flex-table-cell cell-end" data-th="Actions">
                                                    <div class="dropdown is-spaced is-dots is-right dropdown-trigger is-pushed-mobile">
                                                        <div class="is-trigger" aria-haspopup="true">
                                                            <i data-feather="more-vertical"></i>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                               <?php if($this->session->userdata('role') != 9){?>
                                                                <a href="<?php echo base_url();?>event/other_events/add_event/<?php echo base64_encode(json_encode($event->m_id));?>" class="dropdown-item is-media">
                                                                    <div class="icon">
                                                                        <i class='fa fa-edit'></i>
                                                                    </div>
                                                                    <div class="meta">
                                                                        <span>Edit</span>
                                                                        <span>Edit Event Details</span>
                                                                    </div>
                                                                </a>
                                                            <?php } ?>
                                                                     <hr class="dropdown-divider">
                                                                   <a href="<?php echo base_url();?>event/other_events/add_event_content/<?php echo base64_encode(json_encode($event->m_id));?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-cog'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Content</span>
                                                                <span>Edit Content</span>
                                                            </div>
                                                        </a>
                                                        <?php if($this->session->userdata('role') != 9){?>
                                                                 <hr class="dropdown-divider">
                                                                 <a href="<?php echo base_url();?>settings/match_settings/set_match_settings/<?php echo base64_encode(json_encode($event->m_id));?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-cog'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Match Settings</span>
                                                            </div>
                                                        </a>
                                                                <hr class="dropdown-divider">
                                                                <a id="branch_<?php echo $event->m_id;?>" href="javascript:void(0);" data-href="<?php echo base_url();?>event/other_events/delete_event/<?php echo $event->m_id;?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $event->m_id;?>');">
                                                                    <div class="icon">
                                                                        <i class="lnil lnil-trash-can-alt"></i>
                                                                    </div>
                                                                    <div class="meta">
                                                                        <span>Remove</span>
                                                                        <span>Remove from list</span>
                                                                    </div>
                                                                </a>
                                                            <?php } ?>
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
