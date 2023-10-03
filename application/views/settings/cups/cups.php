        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Top Cup List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
        	<div class="page-content-wrapper">
        		<div class="page-content is-relative business-dashboard course-dashboard">
        			<div class="list-flex-toolbar is-reversed ">
        				<a title="Add Top League" class="button is-circle is-primary" href="<?php echo base_url(); ?>settings/cups/add" class="button h-button is-primary is-elevated">
        					<span class="icon is-small">
        						<i data-feather="plus"></i>
        					</span>
        				</a>
        				&nbsp;
        				<div class="control has-icon">
        					<form method='post' action="<?= base_url() ?>/settings/cups">
        						<input type='text' class="input serchText" name='search' value='<?= $search ?>' placeholder="Search...">
        						<div class="form-icon">
        							<i data-feather="search"></i>
        						</div>
        						<input type='submit' class="button h-button is-primary is-raised" name='submit' value='Search'>
        					</form>
        				</div>
        				<div class="">
        					<div class="dashboard-title is-main">
        						<div class="">
        							<h2 class="dark-inverted">Top Cup Lists</h2>
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="page-content-inner">
        				<div class="flex-list-wrapper">
        					<div class="flex-table">

        						<!--Table header-->
        						<div class="flex-table-header" data-filter-hide>
        							<span>Tournament</span>
        							<span class="cell-end">Actions</span>
        						</div>
        						<?php
								foreach ($topcups as $topcup) {
								?>
        							<div class="flex-table-item">
        								<div class="flex-table-cell is-bold" data-th="country">
        									<span class="dark-text" data-filter-match><?php echo $topcup->tournament_name; ?></span>
        								</div>
        								

        								<div class="flex-table-cell cell-end" data-th="Actions">
        									<div class="dropdown is-spaced is-dots is-right dropdown-trigger is-pushed-mobile">
        										<div class="is-trigger" aria-haspopup="true">
        											<i data-feather="more-vertical"></i>
        										</div>
        										<div class="dropdown-menu" role="menu">
        											<div class="dropdown-content">
        												<a href="<?php echo base_url(); ?>settings/cups/edit/<?php echo $topcup->id; ?>" class="dropdown-item is-media">
        													<div class="icon">
        														<i class='fa fa-edit'></i>
        													</div>
        													<div class="meta">
        														<span>Edit</span>
        														<span>Edit Details</span>
        													</div>
        												</a>
        												<hr class="dropdown-divider">
        												<a id="branch_<?php echo $topcup->id; ?>" href="javascript:void(0);" data-href="<?php echo base_url(); ?>settings/cups/delete/<?php echo $topcup->id; ?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $topcup->id; ?>');">
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
