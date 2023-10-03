<?php $this->load->view('common/header'); ?>

<!-- Content Wrapper -->
<div id="app-project" class="view-wrapper is-webapp" data-page-title="Flex Lists" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
	<div class="page-content-wrapper">
		<div class="page-content is-relative tabs-wrapper is-slider is-squared is-inverted">
			<div class="list-flex-toolbar is-reversed flex-list-v2">
				<a class="button is-circle is-primary" href="<?php echo base_url(); ?>game/seat_category/add">
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
				<div class="dashboard-title is-main">
					<div class="left">
						<h2 class="dark-inverted">Seat Position List</h2>
					</div>
				</div>
			</div>

			<div class="page-content-inner">
				<div class="flex-list-wrapper flex-list-v2">
					<div class="flex-table">

						<!--Table header-->
						<div class="flex-table-header" data-filter-hide>
							<span class="is-grow">Seat Position</span>
							<span class="is-grow">&nbsp;Event For</span>
							<span class="is-grow">&nbsp;&nbsp;Status</span>
							<span class="cell-end">Actions</span>
						</div>
						<div class="flex-list-inner">
							<?php
							foreach ($categories as $category) {
							?>
								<!--Table item-->
								<div class="flex-table-item">
									<div class="flex-table-cell is-media is-grow">
										<div>
											<span class="item-name dark-inverted" data-filter-match><?php echo $category->seat; ?></span>
										</div>
									</div>
									<div class="flex-table-cell is-media is-grow">
										<div>
											<span class="item-name dark-inverted" data-filter-match><?php echo $category->event_type; ?></span>
										</div>
									</div>
									

									<div class="flex-table-cell" data-th="Status">
										<?php if ($category->status == '1') {  ?>
											<span class="tag is-success is-rounded">Active</span>
										<?php } else if ($category->status != '1') { ?>
											<span class="tag is-danger is-rounded">Inactive</span>
										<?php } ?>
									</div>
									
									<div class="flex-table-cell cell-end" data-th="Actions">
										<div class="dropdown is-spaced is-dots is-right dropdown-trigger is-pushed-mobile">
											<div class="is-trigger" aria-haspopup="true">
												<i data-feather="more-vertical"></i>
											</div>
											<div class="dropdown-menu" role="menu">
												<div class="dropdown-content">
													<a href="<?php echo base_url(); ?>game/seat_category/edit/<?php echo $category->id; ?>" class="dropdown-item is-media">
														<div class="icon">
															<i class='fa fa-edit'></i>
														</div>
														<div class="meta">
															<span>Edit</span>
															<span>Edit Seat Position</span>
														</div>
													</a>

													<hr class="dropdown-divider">
													<a id="branch_<?php echo $category->id; ?>" href="javascript:void(0);" data-href="<?php echo base_url(); ?>game/seat_category/delete/<?php echo $category->id; ?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $category->id; ?>');">
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
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('common/footer'); ?>
