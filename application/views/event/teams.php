        <?php $this->load->view('common/header'); ?>
          <style type="text/css">
            .myactive {
                background-color: #272357 !important;
                color: #fff !important;
            }
        </style>
        <!-- Content Wrapper -->
        <div id="app-project" class="view-wrapper is-webapp" data-page-title="Flex Lists" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
        	<div class="page-content-wrapper">
        		  <div class="page-content is-relative business-dashboard course-dashboard">
        			<div class="list-flex-toolbar is-reversed flex-list-v2">
        				<a class="button is-circle is-primary" href="<?php echo base_url(); ?>settings/teams/add_team">
        					<span class="icon is-small">
        						<i data-feather="plus"></i>
        					</span>
        				</a>
        				&nbsp;
        				<div class="control has-icon">
						<form method='post' action="<?= base_url() ?>/settings/teams">
        						<input type='text' class="input serchText" name='search' value='<?= $search ?>' placeholder="Search...">
        						<div class="form-icon">
        							<i data-feather="search"></i>
        						</div>
        						<input type='submit' class="button h-button is-primary is-raised" name='submit' value='Search'>
        					</form>
        				</div>
        				 <div class="tab_head">
                        <div class="list_button order_inf">
                        <a href="<?php echo base_url();?>settings/teams/untrashed" class="user_buts <?php if($this->uri->segment(3) == "untrashed" || $this->uri->segment(3) == ""){?>myactive<?php } ?>">ACTIVE</a>
                         <a href="<?php echo base_url();?>settings/teams/top" class="user_buts <?php if($this->uri->segment(3) == "top"){?>myactive<?php } ?>">TOP TEAMS</a>
                         <a href="<?php echo base_url();?>settings/teams/trashed" class="user_buts <?php if($this->uri->segment(3) == "trashed"){?>myactive<?php } ?>">TRASHED</a>
                        </div>
                        </div>
        				<!-- <div class="dashboard-title is-main">
        					<div class="left">
        						<h2 class="dark-inverted">Team List</h2>
        					</div>
        				</div> -->
        			</div>

        			<div class="page-content-inner">
        				<div class="flex-list-wrapper flex-list-v2">
        					<div class="flex-table">

        						<!--Table header-->
        						<div class="flex-table-header" data-filter-hide>
        							<span class="is-grow">Team Name</span>
        							<span class="is-grow">&nbsp;Team Image</span>
        							<span class="is-grow">&nbsp;&nbsp;Category</span>
        							<!-- <span class="is-grow">&nbsp;&nbsp;Popular Team</span> -->
                      <span class="is-grow">&nbsp;&nbsp;Ticket Listed</span>
        							<span class="Status">Status</span>
                      <span class="is-grow">SEO Status</span>
                      <span class="is-grow">SEO Preview</span>
        							<span class="cell-end">Actions</span>
        						</div>
        						<div class="flex-list-inner">
        							<?php
									foreach ($teams as $team) {
									?>
        								<!--Table item-->
        								<div class="flex-table-item">
        									<div class="flex-table-cell is-media is-grow">
        										<div>
        											<span class="item-name dark-inverted" data-filter-match><?php echo $team->team; ?></span>
        										</div>
        									</div>
        									<div class="flex-table-cell is-media is-grow">
        										<div>
        											<span class="light-text" data-filter-match>
        												<?php 
														if (UPLOAD_PATH . 'uploads/teams/' . $team->team_image) {
															$image = UPLOAD_PATH . 'uploads/teams/' . $team->team_image;
														} else {
															$image = base_url('assets/img/placeholders/placeholder.png');
														}
														?>
        												<img class="imgTbl" src="<?= $image; ?>"></span>
        										</div>
        									</div>
        									<div class="flex-table-cell is-media is-grow">
        										<div>
        											<span class="light-text" data-filter-match><?php echo $team->category_name; ?></span>
        										</div>
        									</div>
        									<!-- <div class="flex-table-cell" data-th="Status">
        										<?php if ($team->popular_team == '1') {  ?>
        											<span class="tag is-success is-rounded">Yes</span>
        										<?php } else if ($team->popular_team != '1') { ?>
        											<span class="tag is-danger is-rounded">No</span>
        										<?php } ?>
        									</div> -->
                          <div class="flex-table-cell" data-th="Status">
                            <?php if ($team->s_no != '') {  ?>
                              <span class="tag is-success is-rounded">Yes</span>
                            <?php } else if ($team->s_no == '') { ?>
                              <span class="tag is-danger is-rounded">No</span>
                            <?php } ?>
                          </div>
        									<div class="flex-table-cell" data-th="Status">
        										<?php if ($team->status == '1') { ?>
        											<span class="tag is-success is-rounded">Active</span>
        										<?php } else if ($team->status != '1') { ?>
        											<span class="tag is-danger is-rounded">Inactive</span>
        										<?php } ?>
        									</div>
                          <div class="flex-table-cell" data-th="SEO Status">
                            <?php if ($team->seo_status == 1) { ?>

                              <span class="tag is-success is-rounded"><i aria-hidden="true" class="fas fa-check"></i></span>
                            <?php } else if ($team->seo_status != 1) { ?>
                              <span class="tag is-warning is-rounded"><i aria-hidden="true" class="fas fa-times "></i></span>
                            <?php } ?>
                          </div>
                          <div class="flex-table-cell is-media is-grow" data-th="SEO Preview">
                                      <a target="_blank" href="<?php echo FRONT_END_URL; ?>/<?php echo $this->session->userdata('language_code');?>/<?php echo $team->url_key; ?>" class="dropdown-item is-media"><i class='fa fa-eye'></i></a>
                          </div>
        									<div class="flex-table-cell cell-end" data-th="Actions">
        										<div class="dropdown is-spaced is-dots is-right dropdown-trigger is-pushed-mobile">
        											<div class="is-trigger" aria-haspopup="true">
        												<i data-feather="more-vertical"></i>
        											</div>
        											<div class="dropdown-menu" role="menu">
        												<div class="dropdown-content">
                                  <?php if($this->session->userdata('role') != 9){?>
        													<a href="<?php echo base_url(); ?>settings/teams/add_team/<?php echo $team->id; ?>" class="dropdown-item is-media">
        														<div class="icon">
        															<i class='fa fa-edit'></i>
        														</div>
        														<div class="meta">
        															<span>Edit</span>
        															<span>Edit Team Details</span>
        														</div>
        													</a>
                                <?php } ?>
                                  <hr class="dropdown-divider">
                                  <a href="<?php echo base_url(); ?>settings/teams/add_team_content/<?php echo $team->id; ?>" class="dropdown-item is-media">
                                    <div class="icon">
                                      <i class='fa fa-edit'></i>
                                    </div>
                                    <div class="meta">
                                      <span>Content</span>
                                      <span>Edit Content Details</span>
                                    </div>
                                  </a>
                                  <?php if($this->session->userdata('role') != 9){?>
        													<hr class="dropdown-divider">
        													 <?php if($team->status != 2){?>
                                     <?php if ($team->s_no == '') {  ?>
        													<a id="branch_<?php echo $team->id; ?>" href="javascript:void(0);" data-href="<?php echo base_url(); ?>settings/teams/delete_team/<?php echo $team->id; ?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $team->id; ?>');">
        														<div class="icon">
        															<i class="lnil lnil-trash-can-alt"></i>
        														</div>
        														<div class="meta">
        															<span>Remove</span>
        															<span>Remove from list</span>
        														</div>
        													</a>
                                <?php } ?>
        													 <?php } else {?>
        													<a id="branch_<?php echo $team->id; ?>" href="javascript:void(0);" data-href="<?php echo base_url(); ?>settings/teams/delete_trash_team/<?php echo $team->id; ?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $team->id; ?>');">
        														<div class="icon">
        															<i class="lnil lnil-trash-can-alt"></i>
        														</div>
        														<div class="meta">
        															    <span>Undo</span>
                                                                <span>Undo from trash</span>
        														</div>
        													</a>
        												<?php } ?>
                                <?php } ?>
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
        			</div>
        		</div>
        	</div>
        </div>
        <?php $this->load->view('common/footer'); ?>
