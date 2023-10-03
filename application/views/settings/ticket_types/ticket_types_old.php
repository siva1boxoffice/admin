        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Ticket Type List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
        	<div class="page-content-wrapper">
        		<div class="page-content is-relative business-dashboard course-dashboard">
        			
                    <div class="dashboard-title is-main">
                        <div class="left">
                            <h2 class="dark-inverted">Ticket Type Lists</h2>
                        </div>
                        <div class="right">
                            <div class="list-flex-toolbar is-reversed ">
                        <a title="Add New City" class="button is-circle is-primary" href="<?php echo base_url(); ?>settings/ticket_types/add" class="button h-button is-primary is-elevated">
                            <span class="icon is-small">
                                <i data-feather="plus"></i>
                            </span>
                        </a>
                        &nbsp;
                        <div class="control has-icon">
                            <form method='post' action="<?= base_url() ?>/settings/ticket_types">
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
        				<div class="flex-list-wrapper">
        					<div class="flex-table">

        						<!--Table header-->
        						<div class="flex-table-header" data-filter-hide>
        							<span>Ticket type</span>
        							<span>Status</span>
        							<span class="cell-end">Actions</span>
        						</div>
        						<?php
								foreach ($ticket_types as $ticket) {
								?>
        							<div class="flex-table-item">
        								<div class="flex-table-cell is-bold" data-th="country">
        									<span class="dark-text" data-filter-match><?php echo $ticket->tickettype; ?></span>
        								</div>
										<div class="flex-table-cell" data-th="Status">
                                            <?php if ($ticket->status == '1') { ?>
                                                <span class="tag is-success is-rounded">Active</span>
                                            <?php } else if ($ticket->status == '0') { ?>
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
        												<a href="<?php echo base_url(); ?>settings/ticket_types/edit/<?php echo $ticket->id; ?>" class="dropdown-item is-media">
        													<div class="icon">
        														<i class='fa fa-edit'></i>
        													</div>
        													<div class="meta">
        														<span>Edit</span>
        														<span>Edit Ticket Type Details</span>
        													</div>
        												</a>
        												<hr class="dropdown-divider">
        												<a id="branch_<?php echo $ticket->id; ?>" href="javascript:void(0);" data-href="<?php echo base_url(); ?>settings/ticket_types/delete/<?php echo $ticket->id; ?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $ticket->id; ?>');">
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
        			<?php exit; ?>
