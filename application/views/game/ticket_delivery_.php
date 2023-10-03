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
                  <a href="<?php echo base_url();?>game/orders/ticket_delivery/1" class="user_buts">Future Events</a>
                  <a href="<?php echo base_url();?>game/orders/ticket_delivery/2" class="user_buts">Past Events</a>
                <a href="" class="user_buts">
                  <i class="far fa-filter"></i>Advanced Filter </a>

                </div>
               </div>
             </div>
              
          </div>
          <div class="tab_sec" id="no-more-tables">
            <table class="toptable res_table_new table-responsive">
              <tbody>
                <tr class="accordion bor_der">
                  <th>Event</th>
                  <th>Remaining <br>Time</th>
                  <th>Tickets <br>Qty</th>
                  <th>Orders <br>QTY</th>
                  <th class="bg_clr">Not sent / <br>not uploaded</th>
                  <th class="bg_clr1">Sent / <br>Uploaded</th>
                  <th class="bg_clr2">Delivered / <br>Downloaded</th>
                </tr>
				<?php if ($getMySalesData) {
				foreach ($getMySalesData as $getMySalesDa) {
				?>
                <tr class="bor_der">
                  	<td data-label="Event:"><?php echo $getMySalesDa->match_name; ?><br>
															<p><?php echo $getMySalesDa->country_name . ', ' . $getMySalesDa->city_name; ?></p>
															<span class="tr_date"><i class="fas fa-calendar"></i> <?php echo $getMySalesDa->match_date; ?></span> <span class="tr_date"><i class="fas fa-clock"></i><?php echo $getMySalesDa->match_time; ?></span>
														</td>
                  <td data-label="Remaining Time:"><span class="chkdate2"> 15 days ago</span> </td>
                  <td data-label="Tickets Qty:"><strong>20</strong></td>
                  <td data-label="Orders QTY:">2</td>
                  <td data-label="Not sent / not uploaded:" class="bg_clr"><strong>0(0)</strong></td>
                  <td data-label="Not sent / not uploaded:" class="bg_clr1"><strong>0(0)</strong></td>
                  <td data-label="Not sent / not uploaded:" class="bg_clr2"><strong>0(0)</strong></td>
                </tr>
				<?php
				}
				}
				?>

              </tbody>
            </table>
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
