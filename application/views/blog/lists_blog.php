<?php $this->load->view('common/header'); ?>
<style type="text/css">
	.active{
    background-color:  #272357 !important;
    color : #fff !important;
	}
</style>
<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Order List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
	<div class="page-content-wrapper">
		<div class="page-content is-relative business-dashboard course-dashboard">
			<div class="page-content-inner">
				<div class="flex-list-wrapper">
					<div class="flex-table-item">
						<div class="">
							<div class="container_new">
							
							 <div class="control has-icon listing_filter">
							 	<div class="tab_head">
			
							
						
								<div class="tab_sec orders list_odd" id="no-more-tables">
							<style type="text/css">
								.events{
									list-style: none;
									width: 100%;
									float: left;
								}
								.events li {
									float: left;
									padding: 10px 20px;
								}
								.events li:first-child {
									padding-left: 0;
								}
							</style>		 
						

						<!-- <h2>Blog Blog</h2> -->
						<div class="page-content-wrapper">
			        		  <div class="page-content is-relative business-dashboard course-dashboard">
			        			<div class="list-flex-toolbar is-reversed flex-list-v2">
			        				<a class="button is-circle is-primary" href="<?php echo base_url();?>blog/index/add">
			        					<span class="icon is-small">
			        						<i data-feather="plus"></i>
			        					</span>
			        				</a>
			        			</div>
			        		</div>
			        	</div>
						
									<table class="toptable res_table_new table-responsive">
										<tbody>
											<tr class="accordion">
												<th>Sno</th>
												<th>Blog Title</th>
												<th>Slug</th>
												<th>Status</th>
												<th>Date</th>
												<th>Action</th>
												
											</tr>
											
										</tbody>
										
											<?php $s = 1 ; if ($results) {
												foreach ($results as $row) {
											?>
											<tr>
												<td><?php echo $s++;?></td>
												<td><?php echo $row->blog_title;?> </td>
												<td><?php echo $row->blog_slug;?></td>
												<td><?php echo $row->blog_status == 1? '<span class="tag is-success is-rounded">Active</span>'  : '<span class="tag is-danger is-rounded">Inactive</span>';?></td>
												<td><?php echo $row->updated_at;?></td>
												<td><div class="flex-table-cell cell-end" data-th="Actions">
                                            <div class="dropdown is-spaced is-dots is-right dropdown-trigger is-pushed-mobile">
                                                <div class="is-trigger" aria-haspopup="true">
                                                    <i data-feather="more-vertical"></i>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                        <a href="<?php echo base_url();?>blog/index/edit/<?php echo $row->id ;?>" class="dropdown-item is-media">

                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit Blog Details</span>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">

                                                        <a  href="<?php echo base_url();?>blog/index/delete/<?php echo $row->id ;?>" class="dropdown-item is-media " >
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
                                            </div></td>
											</tr>
											<?php } ?>
											</tr>
											<?php
											
											}else{ ?>
												<tr><td colspan="11">No Order list.</td></tr>
											<?php }
											?>

										</tbody>
									</table>
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
</div>

<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
	function load_my_orders(seller_id) {
		window.location.href = "<?php echo base_url();?>game/orders/list_order/all/"+seller_id;
	}
</script>
<?php exit; ?>
