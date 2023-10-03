<?php $this->load->view('common/header'); ?>

<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Order List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
	<div class="page-content-wrapper">
		<div class="page-content is-relative business-dashboard course-dashboard">
			<div class="page-content-inner">
				<div class="flex-list-wrapper">
					<div class="flex-table-item">
						  <div class="" >
        <div class="container_new">
          <div class="tab_head">

             <div class="dashboard-title is-main">
               <div class="left">
                 <h2 class="dark-inverted">Ticket Delivery</h2>
               </div>
               <div class="right">
                 <div class="list_button order_inf">
                  <a href="<?php echo base_url();?>game/orders/ticket_delivery/1" class="user_buts" <?php if($this->uri->segment(4) == 1){?> style="background-color:#272357 !important;color:#e5eff9 !important;" <?php } ?>>Future Events</a>
                  <a href="<?php echo base_url();?>game/orders/ticket_delivery/2" class="user_buts" <?php if($this->uri->segment(4) == 2){?> style="background-color:#272357 !important;color:#e5eff9 !important;" <?php } ?>>Past Events</a>
                <!-- <a href="" class="user_buts">
                  <i class="far fa-filter"></i>Advanced Filter </a> -->

                </div>
               </div>
             </div>
              
          </div>
          <div class="tab_sec" id="no-more-tables">
            <table class="toptable res_table_new table-responsive">
              <tbody>
                <tr class="accordion bor_der">
                  <th>Order Id</th>
                  <th>Customer</th>
                  <th>Event</th>
                  <th>Tickets <br>Qty</th>
                  <th class="bg_clr">Pending</th>
                  <th class="bg_clr1">Uploaded</th>
                  <th class="bg_clr2">Downloaded</th>
                </tr>
				<?php if ($getMySalesData) {
				foreach ($getMySalesData as $getMySalesDa) {
				?>
                <tr class="bor_der">
                    <td data-label="Order Id:">#<?php echo $getMySalesDa->booking_no; ?></td>
                    <td data-label="Customer:"><?php echo $getMySalesDa->title; ?>.<?php echo $getMySalesDa->first_name; ?> <?php echo $getMySalesDa->last_name; ?></td>
                  	<td data-label="Event:"><?php echo $getMySalesDa->match_name; ?><br>
															<p><?php echo $getMySalesDa->country_name . ', ' . $getMySalesDa->city_name; ?></p>
															<span class="tr_date"><i class="fas fa-calendar"></i> <?php echo $getMySalesDa->match_date; ?></span> <span class="tr_date"><i class="fas fa-clock"></i><?php echo $getMySalesDa->match_time; ?></span>
														</td>
                  <td data-label="Tickets Qty:"><strong><?php echo $getMySalesDa->quantity; ?></strong></td>
                  <td data-label="Not sent / not uploaded:" class="bg_clr"><strong><?php echo $getMySalesDa->tickets_data['pending']; ?></strong></td>
                  <td data-label="Not sent / not uploaded:" class="bg_clr1"><strong><?php echo $getMySalesDa->tickets_data['uploaded']; ?></strong></td>

                  <td data-label="Not sent / not uploaded:" class="bg_clr2"><strong>
                    <?php if($getMySalesDa->delivery_status == 4){ ?>
                    <?php echo $getMySalesDa->tickets_data['uploaded']; ?>
                      <?php } else{ ?>
                        0
                      <?php } ?>
                    </strong>

                  </td>
                </tr>
				<?php
				}
				}
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
<?php exit; ?>
