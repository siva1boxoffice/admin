<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/app.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/main.css?v=1.1" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_huro/css/style.css?v=1.7" />
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Order List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
   <div id="huro-app" class="app-wrapper">
      <!-- Content Wrapper -->
      <div id="app-projects" class="view-wrapper" data-naver-offset="214" data-menu-item="#layouts-sidebar-menu" data-mobile-item="#home-sidebar-menu-mobile">
         <div class="page-content-wrapper">
            <div class="page-content is-relative">
               <div class=" onebox-order-info">
                  <div class="container_new">
                     <div class="row">
                        <div class="sub_heading">
                           <div class="onebox-order-heading">
                              <h2>Abondanned Order <span>Info</span></h2>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="table_section ordr_info" id="no-more-tables">
                           <table>
                              <tbody>
                                 <tr class="accordion">
                                    <th>Order ID</th>
                                    <th>Order Status</th>
                                    <th>Order Date and Time</th>
                                    <th>Ticket Format</th>
                                    <th>E-Ticket</th>
                                 </tr>
                                 <tr>
                                    <td data-label="Order:">
                                       <span class="order_id"><?php echo $orderData->booking_no; ?></span>
                                    </td>
                                    <?php if ($orderData->booking_status == 1) { ?>
                                    <td data-label="Order:">
                                       <span class="">CONFIRMED</span>
                                    </td>
                                    <?php  } ?>
                                    <?php if ($orderData->booking_status == 0) { ?>
                                    <td data-label="Order:">
                                       <span class="">FAILED</span>
                                    </td>
                                    <?php  } ?>
                                    <?php if ($orderData->booking_status == 2) { ?>
                                    <td data-label="Order:">
                                       <span class="">PENDING</span>
                                    </td>
                                    <?php  } ?>
                                    <?php if ($orderData->booking_status == 7) { ?>
                                    <td data-label="Order:">
                                       <span class="">ABONDANNED</span>
                                    </td>
                                    <?php  } ?>
                                    <td data-label="Transaction date:">
                                       <span class="tr_date">
                                       <i class="fas fa-calendar-week"></i> 
                                       <?php echo date("d F Y",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$orderData->updated_at))).' '.@$_COOKIE["time_zone"];?>
                                       <!-- <?php
                                          $date = strtotime($orderData->updated_at);
                                          $dat = date('d/m/Y', $date);
                                          $tme = date('h:m:s', $date);
                                          ?><?php echo $dat; ?>  -->
                                       </span>
                                       <span class="tr_date">
                                       <i class="fas fa-clock"></i><?php echo date("H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$orderData->updated_at)));?> </span>
                                    </td>
                                    <?php if ($orderData->ticket_type == 1) { ?>
                                    <td data-label="Payment Status:">Season cards</td>
                                    <?php } ?>
                                    <?php if ($orderData->ticket_type == 2) { ?>
                                    <td data-label="Payment Status:">E-Tickets</td>
                                    <?php } ?>
                                    <?php if ($orderData->ticket_type == 3) { ?>
                                    <td data-label="Payment Status:">Paper</td>
                                    <?php } ?>
                                    <?php if ($orderData->ticket_type == 4) { ?>
                                    <td data-label="Payment Status:">Mobile</td>
                                    <?php } ?>
                                    <?php
                                       $etickets = $this->General_Model->getAllItemTable_array('booking_etickets', array('booking_id' => $orderData->bg_id))->result();
                                       if ($etickets[0]->ticket_file == '') { ?>
                                    <td data-label="Payment Status:">Not Available</td>
                                    <?php }
                                       if ($etickets[0]->ticket_file != '') { ?>
                                    <td style="cursor: pointer;"><span class="clrb">Download (<?php echo $orderData->quantity; ?> Tickets)</span></td>
                                    <?php } ?>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <h3>Ticket Information</h3>
                     <div class="row">
                        <div class="table_section ordr_info" id="no-more-tables">
                           <table>
                              <tbody>
                                 <tr class="accordion">
                                    <th>STATDIUM</th>
                                    <th>SECTION</th>
                                    <th>ROW</th>
                                    <th>BLOCK</th>
                                    <th>PRICE</th>
                                    <th>QUANTITY</th>
                                    <th>SUB TOTAL</th>
                                 </tr>
                                 <tr>
                                    <td data-label="Order:">
                                       <?php echo $orderData->stadium_name; ?>
                                    </td>
                                    <td data-label="Order:">
                                       <?php echo $orderData->seat_category; ?>
                                    </td>
                                    <td data-label="Order:">
                                       <?php echo $orderData->row; ?>
                                    </td>
                                    <td data-label="Order:">
                                       <?php echo $orderData->block_id; ?>
                                    </td>
                                    <td data-label="Order:">
                                       <?php if (strtoupper($orderData->currency_type) == "GBP") { ?>
                                       <i class="fas fa-pound-sign"></i>
                                       <?php } ?>
                                       <?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
                                       <i class="fas fa-euro-sign"></i>
                                       <?php } 
                                          if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
                                          echo strtoupper($orderData->currency_type); 
                                          }
                                          
                                          ?>
                                       <?php echo $orderData->price// . ' ' . $orderData->currency_type; ?>
                                    </td>
                                    <td data-label="Order:">
                                       <?php echo $orderData->quantity; ?>
                                    </td>
                                    <td data-label="Order:">
                                       <?php if (strtoupper($orderData->currency_type) == "GBP") { ?>
                                       <i class="fas fa-pound-sign"></i>
                                       <?php } ?>
                                       <?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
                                       <i class="fas fa-euro-sign"></i>
                                       <?php } 
                                          if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
                                          echo strtoupper($orderData->currency_type); 
                                          }
                                          ?>
                                       <?php echo $orderData->sub_total// . ' ' . $orderData->currency_type; ?>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="account-wrapper">
                        <div class="columns">
                           <div class="column is-6">
                              <h3>Ticket Information</h3>
                              <div class="status_item">
                                 <div class="details">
                                    <div class="columns">
                                       <div class="column is-5">
                                          <div class="img">
                                             <img src="<?php echo UPLOAD_PATH; ?>uploads/stadium<?php echo $orderData->stadium_image; ?>">
                                          </div>
                                       </div>
                                       <div class="column is-7">
                                          <h4><?php echo $orderData->match_name; ?></h4>
                                          <p><?php echo $orderData->country_name . ',' . $orderData->city_name; ?></p>
                                          <p>
                                             <span class="tr_date">
                                             <i class="fas fa-calendar"></i><?php echo $orderData->match_date; ?> </span>
                                             <span class="tr_date">
                                             <i class="fas fa-clock"></i><?php echo $orderData->match_time; ?> </span>
                                          </p>
                                          <p>
                                             <span class="">Category: <?php echo $orderData->seat_category; ?></span>
                                          </p>
                                          <table>
                                             <tbody>
                                                <tr>
                                                   <td>Price</td>
                                                   <td>
                                                      <?php 
                                                         if (strtoupper($orderData->currency_type) == "GBP") { ?>
                                                      <i class="fas fa-pound-sign"></i>
                                                      <?php } ?>
                                                      <?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
                                                      <i class="fas fa-euro-sign"></i>
                                                      <?php } 
                                                         if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
                                                         echo strtoupper($orderData->currency_type); 
                                                         }
                                                          ?>
                                                      <?php echo $orderData->price;?>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>Quantity</td>
                                                   <td><?php echo $orderData->quantity; ?></td>
                                                </tr>
                                                <tr>
                                                   <td>Sub Total</td>
                                                   <td>
                                                      <?php 
                                                         if (strtoupper($orderData->currency_type) == "GBP") { ?>
                                                      <i class="fas fa-pound-sign"></i>
                                                      <?php } ?>
                                                      <?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
                                                      <i class="fas fa-euro-sign"></i>
                                                      <?php } 
                                                         if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
                                                         echo strtoupper($orderData->currency_type); 
                                                         }
                                                          ?>
                                                      <?php echo $orderData->ticket_amount; ?>
                                                   </td>
                                                </tr>
                                                <?php  if ($this->session->userdata('role') != 1) { ?>
                                                <tr>
                                                   <td>Seller Fee</td>
                                                   <td>
                                                      <?php 
                                                         if (strtoupper($orderData->currency_type) == "GBP") { ?>
                                                      <i class="fas fa-pound-sign"></i>
                                                      <?php } ?>
                                                      <?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
                                                      <i class="fas fa-euro-sign"></i>
                                                      <?php } 
                                                         if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
                                                         echo strtoupper($orderData->currency_type); 
                                                         }
                                                          ?>
                                                      <?php echo round($orderData->seller_fee,2); ?>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>Store Fee/Tax</td>
                                                   <td>
                                                      <?php 
                                                         if (strtoupper($orderData->currency_type) == "GBP") { ?>
                                                      <i class="fas fa-pound-sign"></i>
                                                      <?php } ?>
                                                      <?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
                                                      <i class="fas fa-euro-sign"></i>
                                                      <?php } 
                                                         if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
                                                         echo strtoupper($orderData->currency_type); 
                                                         }
                                                          ?>
                                                      <?php echo $orderData->store_fee; ?>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>Total</td>
                                                   <td>
                                                      <?php 
                                                         if (strtoupper($orderData->currency_type) == "GBP") { ?>
                                                      <i class="fas fa-pound-sign"></i>
                                                      <?php } ?>
                                                      <?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
                                                      <i class="fas fa-euro-sign"></i>
                                                      <?php } 
                                                         if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
                                                         echo strtoupper($orderData->currency_type); 
                                                         }
                                                          ?>
                                                      <?php echo $orderData->total_amount; ?>
                                                   </td>
                                                </tr>
                                                <?php } ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="column is-6">
                              <h3>Billing & Payment Information</h3>
                              <div class="tick_info">
                                 <div class="details">
                                    <table>
                                       <tbody>
                                          <tr>
                                             <td>Customer Name</td>
                                             <td>
                                                <a target="_blank" href="<?php echo base_url();?>settings/customers/add_customer/<?php echo base64_encode(json_encode($orderData->user_id)) ; ?>">
                                                <?php echo $orderData->customer_first_name ; ?> <?php echo $orderData->customer_last_name ; ?>
                                                </a>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>Billing Name</td>
                                             <td><?php echo $orderData->title ; ?> <?php echo $orderData->first_name ; ?> <?php echo $orderData->last_name ; ?></td>
                                          </tr>
                                          <tr>
                                             <td>Billing Contact</td>
                                             <td><?php echo $orderData->dialing_code ; ?> <?php echo $orderData->mobile_no ; ?> / <?php echo $orderData->email ; ?></td>
                                          </tr>
                                          <tr>
                                             <td>Billing Address</td>
                                             <td><?php echo $orderData->address ; ?>,<?php echo $orderData->customer_city_name; ?>,<?php echo $orderData->customer_country_name ; ?>, <?php echo $orderData->postal_code ; ?></td>
                                          </tr>
                                          <tr>
                                             <td>Payment Status</td>
                                             <td>
                                                NOT ATTEMPTED
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <h3>More Information</h3>
                     <div class="row">
                        <div class="table_section ordr_info" id="no-more-tables">
                           <table>
                              <tbody>
                                 <tr class="accordion">
                                    <th>Date</th>
                                    <th>Ticket ID</th>
                                    <th>Event ID</th>
                                    <th>Seller Name</th>
                                    <th>Seller ID</th>
                                    <th>Seller Notes</th>
                                    <th>Ticket Type</th>
                                    <th>Ticket Source</th>
                                    <th>Tournament</th>
                                    <th>User Name</th>
                                    <th>User Country</th>
                                    <th>User Email</th>
                                 </tr>
                                 <tr>
                                    <td data-label="Order:">
                                       <?php echo $orderData->created_at; ?>
                                    </td>
                                    <td data-label="Order:">
                                       <?php echo $orderData->ticketid; ?>
                                    </td>
                                    <td data-label="Order:">
                                       <?php echo $orderData->match_id; ?>
                                    </td>
                                    <td data-label="Order:">
                                       <?php echo $orderData->seller_first_name; ?>
                                       <?php echo $orderData->seller_last_name; ?>
                                    </td>
                                    <td data-label="Order:">
                                       <?php echo $orderData->seller_id; ?>
                                    </td>
                                    <td data-label="Order:">
                                       <?php foreach($seller_notes as $seller_note){?>
                                       <?php echo $seller_note->ticket_name; ?>,
                                       <?php } ?>
                                    </td>
                                    <td data-label="Payment Status:">
                                       <?php if ($orderData->ticket_type == 1) { ?>
                                       Season cards
                                       <?php } ?>
                                       <?php if ($orderData->ticket_type == 2) { ?>
                                       E-Tickets
                                       <?php } ?>
                                       <?php if ($orderData->ticket_type == 3) { ?>
                                       Paper
                                       <?php } ?>
                                       <?php if ($orderData->ticket_type == 4) { ?>
                                       Mobile
                                       <?php } ?>
                                    </td>
                                    <td>
                                       Store Front A
                                    </td>
                                    <td>
                                       <?php echo $orderData->tournament_name;?>
                                    </td>
                                    <td>
                                       <?php echo $orderData->customer_first_name;?>
                                       <?php echo $orderData->customer_last_name;?>
                                    </td>
                                    <td>
                                       <?php echo $orderData->customer_country_name;?>
                                    </td>
                                    <td>
                                       <?php echo $orderData->customer_email;?>
                                    </td>
                                 </tr>
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
<?php $this->load->view('common/footer');
   ?>
<?php exit; ?>