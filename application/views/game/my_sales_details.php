<?php $this->load->view('common/header'); ?>
<style type="text/css">
   .order_inf a.active {
   background: #272357 !important;
   color: #fff !important;
   }
</style>
<!-- Content Wrapper -->
<?php 

//echo "<pre>";print_r($event);exit;
$future = strtotime($event->match_date);
$now = time();
$timeleft = $future-$now;
$daysleft = round((($timeleft/24)/60)/60); 

$dateDiff = intval(($future-$now)/60);
$hours = intval($dateDiff/60);
$minutes = $dateDiff%60;

$userTimezone = "Europe/London";
$timezone = new DateTimeZone( $userTimezone );

$crrentSysDate = new DateTime(date('m/d/y h:i:s a'),$timezone);
$userDefineDate = $crrentSysDate->format('m/d/y h:i:s a');

$start = date_create($userDefineDate,$timezone);
$end = date_create(date('m/d/y h:i:s a', $future),$timezone);
$diff=date_diff($start,$end);

?>
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Order List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
   <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">
         <div class="my_listings">
            <div class="container_new">
               <div class="tab_head">                 


                  <div class="dashboard-title is-main">
                      <div class="left">
                        <h2 class="dark-inverted">Events</h2>
                      </div>
                      <div class="right">
                          <div class="list_button">
                     <a href="" class="user_buts">
                     <i class="far fa-filter"></i>Advanced Filter </a>
                  </div>
                      </div>
                  </div>




                  <div class="clearfix"></div>



                  <div class="columns is-multiline is-flex-tablet-p">
                      <div class="column is-4">
                          <div class="sec_left_event">
                     <div class="select_resti">
                        <div class="selec_head">
                           <h4>Event Information</h4>
                        </div>
                        <div class="selec_img">
                           <img src="<?php echo base_url().$event->stadium_image;?>">
                        </div>
                        <div class="details">
                           <h5><?php
                            echo $event->match_name;?></h5>
                           <p><?php echo $event->stadium_name;?>,<?php echo $event->city_name;?>,<?php echo $event->country_name;?></p>
                           <span class="tr_date"><i class="fa fa-calendar"></i><?php echo date("d-m-Y",strtotime($event->match_date));?> </span><span class="tr_date"><i class="fas fa-clock"></i><?php echo $event->match_time;?></span>
                        </div>
                        <div class="cheoutdv">
                           <div class="chkdatetacell">
                              <span class="chkin">Tickets QTY:</span>
                              <span class="chkdate"><?php echo $event->ticket_quantity;?></span>
                           </div>
                           <div class="chkdatetacell">
                              <span class="chkin">End Time:</span>
                             <span class="bg_clr1"><strong style="padding: 5px;">
                      <i class="fa fa-calendar"></i>
                      <?php if($diff->d <= 0){ 
                        echo str_replace("-","",$diff->d).' Days';
                        }
                        else{ echo $diff->d.' Days';;}
                      ?></strong></span>&nbsp;

                      <span class="bg_clr1"><strong style="padding: 5px;">
                        <i class="fas fa-clock"></i>
                      <?php echo $diff->h.':'.$diff->i;
                      ?></strong></span>
                           </div>
                           <div class="chkdatetacell">
                              <span class="chkin">Order QTY:</span>
                              <span class="chkdate">  <?php  if($event->sold_quantity > 0){ 
                      echo $event->sold_quantity;
                    } else { echo 0;}?> </span>
                           </div>
                        </div>
                     </div>
                  </div>
                      </div>
                      <div class="column is-8">
                          <div class="sec_right_event">
                     <div class="details" id="no-more-tables">
                        <table class="toptable">
                           <tbody>
                              <tr class="accordion">
                                 <th>Ticket<br> QTY</th>
                                 <th>Category</th>
                                 <th class="bg_clr">Not sent /not uploaded</th>
                                 <th class="bg_clr1">Sent / Uploaded</th>
                                 <th class="bg_clr2">Delivered /Downloaded</th>
                              </tr>
                              <?php if(isset($ticket_categories)){
                                 foreach($ticket_categories as $ticket_category){
                                    //echo "<pre>";print_r($ticket_category);
                               ?>
                              <tr>
                                 <td data-label="Tickets Qty:"><strong><?php echo $ticket_category->order_quantity;?></strong></td>
                                 <td data-label="Category:"><?php echo $ticket_category->seat_category;?></td>
                                 <td data-label="Not sent / not uploaded:" class="bg_clr"><strong><?php echo $ticket_category->pending_tickets;?>(<?php echo $ticket_category->order_quantity;?>)</strong></td>
                                 <td data-label="Sent / Uploaded:" class="bg_clr1"><strong><?php echo $ticket_category->available_tickets;?> (<?php echo $ticket_category->order_quantity;?>)</strong></td>
                                 <td data-label="Delivered / Downloaded:" class="bg_clr2"><strong><?php echo $ticket_category->download_tickets;?> (<?php echo $ticket_category->available_tickets;?>)</strong></td>
                              </tr>
                             <?php } } else { ?>
                              <td rowspan="4">No ticket list</td>
                             <?php } ?> 
                           </tbody>
                        </table>
                     </div>
                  </div>
                      </div>
                  </div>


               </div>
            </div>
            <div class="container_new">
               <div class="tab_head">
                  <h2>Your Orders</h2>
                  <div class="list_button">
                  </div>
               </div>
              <div class="tab_sec orders" id="no-more-tables">
                  <table class="toptable res_table_new table-responsive">
                    <tbody>
                      <tr class="accordion">
                        <th>Order</th>
                        <th>Event</th>
                        <th>Ticket Format</th>
                        <th>Ticket Type</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Transaction Date</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                      </tr>
                      <?php if ($getMySalesData) {
                        foreach ($getMySalesData as $getMySalesDa) {
                      ?>
                          <tr>
                            <td data-label="Order:"><span class="order"><?php echo $getMySalesDa->booking_no; ?></span></td>
                            <td data-label="Event:"><?php echo $getMySalesDa->match_name; ?><br>
                              <p><?php echo $getMySalesDa->country_name . ', ' . $getMySalesDa->city_name; ?></p>
                              <span class="tr_date"><i class="fas fa-calendar"></i> <?php echo $getMySalesDa->match_date; ?></span> <span class="tr_date"><i class="fas fa-clock"></i><?php echo $getMySalesDa->match_time; ?></span>
                            </td>
                            <td data-label="Ticket Format:">
                              <?php
                              if ($getMySalesDa->ticket_type == 1) {
                                echo 'Season cards';
                              } else
                          if ($getMySalesDa->ticket_type == 2) {
                                echo "E-Tickets";
                              } else
                          if ($getMySalesDa->ticket_type == 3) {
                                echo "Paper";
                              } else  if ($getMySalesDa->ticket_type == 4) {
                                echo "Mobile";
                              } ?>
                            </td>
                            <td data-label="Tickets Type:">
                              <?php echo $getMySalesDa->seat_category;
                              ?>
                            </td>
                            <td data-label="Tickets Qty:">
                              <?php echo $getMySalesDa->quantity;
                              ?>
                            </td>
                            <?php  if ($this->session->userdata('role') != 1) { ?>
                            <td data-label="Price:"><b>
                                
                        <?php if (strtoupper($getMySalesDa->currency_type) == "GBP") { ?>
                              <i class="fas fa-pound-sign"></i>
                              <?php } ?>
                        <?php if (strtoupper($getMySalesDa->currency_type) == "EUR") { ?>
                              <i class="fas fa-euro-sign"></i>
                        <?php } 
                          if (strtoupper($getMySalesDa->currency_type) != "GBP" && strtoupper($getMySalesDa->currency_type) != "EUR"){
                         echo strtoupper($getMySalesDa->currency_type); 
                        }
                        ?>
                        <?= number_format($getMySalesDa->total_amount,2) ?> 
                         </b></td>
                     <?php } ?>
                     <?php  if ($this->session->userdata('role') == 1) { ?>
                            <td data-label="Price:"><b>
                                
                        <?php if (strtoupper($getMySalesDa->currency_type) == "GBP") { ?>
                              <i class="fas fa-pound-sign"></i>
                              <?php } ?>
                        <?php if (strtoupper($getMySalesDa->currency_type) == "EUR") { ?>
                              <i class="fas fa-euro-sign"></i>
                        <?php } 
                          if (strtoupper($getMySalesDa->currency_type) != "GBP" && strtoupper($getMySalesDa->currency_type) != "EUR"){
                         echo strtoupper($getMySalesDa->currency_type); 
                        }
                        ?>
                        <?= number_format($getMySalesDa->ticket_amount,2) ?> 
                         </b></td>
                     <?php } ?>
                            <td data-label="Transaction date:"><span class="tr_date">
                                <?php
                                echo  $getMySalesDa->updated_at;
                                ?>
                              </span> </td>
                            <td data-label="Status:">
                              <?php
                              if ($getMySalesDa->booking_status == 0) {
                                echo "FAILED";
                              }
                              if ($getMySalesDa->booking_status == 1) {
                                echo "CONFIRMED";
                              }
                              if ($getMySalesDa->booking_status == 2) {
                                echo "PENDING";
                              }
                              if ($getMySalesDa->booking_status == 3) {
                                echo "CANCELLED";
                              }
                              if ($getMySalesDa->booking_status == 4) {
                                echo "SHIPPED";
                              }
                              if ($getMySalesDa->booking_status == 5) {
                                echo "DELIVERED";
                              }
                              if ($getMySalesDa->booking_status == 6) {
                                echo "DOWNLOADED";
                              }
                              ?>

                            </td>
                            <td data-label="Total:"><a href="<?php echo base_url(); ?>game/orders/details/<?php echo md5($getMySalesDa->booking_no); ?>"><i class="fas fa-angle-double-right"></i></a></td>
                          </tr>
                      <?php
                        }
                      } else{
                      ?>
                      <td rowspan="8">
                      <h1 class="center;">No Orders in this event.</h1>
                   </td>
                   <?php } ?>
                    </tbody>
                  </table>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view('common/footer'); ?>
<?php exit; ?>