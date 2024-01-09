<?php  $this->load->view(THEME.'common/header'); ?>
   <!-- Begin main content -->
   <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box welcome_text">
               <div class="container-fluid">
                  <div class="row">
               <div class="col-sm-8">
                  <div class="head_title">
                     <h4 class="card-title">Welcome <?php echo $this->session->userdata('storefront')->company_name; ?>!</h4>
                     <p>We’re happy to see you again on your dashboard! </p>
                  </div>
               </div>
               <?php if($this->session->userdata('role')!=13 && $this->session->userdata('role')!=14){ ?>
               <div class="col-sm-4">
                  <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                     <!-- <a href="#" data-toggle="modal" data-target="#add-board-modal" class="btn btn-primary mb-2"><i class="bx bx-list-ol bx-flashing mr-1"></i> Go Back</a>  -->
                        <a href="<?php echo base_url(); ?>tickets/index/create_ticket" class="btn btn-sell-ticket rounded-0 mb-2"><img src="<?php echo base_url(); ?>assets/zenith_assets/img/sell_tick.png">Sell Tickets</a>
                       
                  </div>
               </div>
               <?php } ?>
            </div>
               </div>
            </div>
            <!-- page content -->
            <?php if($this->session->userdata('role')!=13 && $this->session->userdata('role')!=14){ ?>
            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">
                  <!-- Widget  -->
                  <div class="row">
                     <div class="col-md-6 col-xl-3">
                        <div class="card rounded-0">
                           <div class="card-body">
                              <div class="media align-items-center">
                                 <div class="media-body currency_status">
                                    <p class="mb-2 font-weight-normal color_main">Total Sales</p>
                                    <h4 class="mb-0 font-weight-bold">£ <?php echo number_format($confirmed_sales[0]->total_sales,2);?></h4>
                                 </div>
                                 <div class="text-center currency_symb pounds">
                                    <span class="pounds font-weight-normal">£</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-3">
                        <div class="card rounded-0">
                           <div class="card-body">
                              <div class="media align-items-center">
                                 <div class="media-body currency_status">
                                    <p class="mb-2 font-weight-normal color_main">Tickets Listed</p>
                                    <h4 class="mb-0 font-weight-bold"><?php echo $listed_tickets;?></h4>
                                 </div>
                                 <div class="text-center currency_symb euro">
                                    <span class="euro font-weight-normal"><img src="<?php echo base_url(); ?>assets/zenith_assets/img/tickets_list.png"> </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-3">
                        <div class="card rounded-0">
                           <div class="card-body">
                              <div class="media align-items-center">
                                 <div class="media-body currency_status">
                                    <p class="mb-2 font-weight-normal color_main">Total Orders</p>
                                    <h4 class="mb-0 font-weight-bold"><?php echo $orders;?></h4>
                                 </div>
                                 <div class="text-center currency_symb carts">
                                    <span class="carts font-weight-normal"><i class="fe-shopping-cart"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-3">
                        <div class="card rounded-0">
                           <div class="card-body">
                              <div class="media align-items-center">
                                 <div class="media-body currency_status">
                                    <p class="mb-2 font-weight-normal color_main">Confirmed Orders</p>
                                    <h4 class="mb-0 font-weight-bold"><?php echo $confirmed_orders;?></h4>
                                 </div>
                                 <div class="text-center currency_symb carts-check">
                                    <span class="carts-check font-weight-normal"><img src="<?php echo base_url(); ?>assets/zenith_assets/img/confirmed_orders.png"> </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Row 3-->
                  <div class="row">
                     <!-- Begin recent orders -->
                     <div class="col-12 col-lg-12">
                        <div class="card rounded-0">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="tab-content customer_info_page pt-0" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel" aria-labelledby="v-pills-gen-ques-tab">
                                      <div class="accordion custom-accordion" id="general">
                                        <div class="card shadow-none mb-0 rounded-0">
                                          <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="">
                                            <div class="pb-0" id="headingOne">
                                              <h4 class="mb-0">
                                                Recent Orders
                                                <i class="mdi mdi-chevron-up float-right toggle-icon fs-sm"></i>
                                              </h4>
                                            </div>
                                          </a>

                                          <div id="collapseOne" class="mt-3 collapse show" aria-labelledby="headingOne" data-parent="#general" style="">
                                             <div class="table-responsive">
                                                <table id="basic-datatable" class="sales_table table  table-hover table-nowrap mb-0">
                                                   <thead class="thead-light">
                                                      <tr>
                                                         <th>Order</th>
                                                         <th>Event</th>
                                                         <th>Seller Name</th>
                                                         <th>Ticket Type</th>
                                                         <th>Qty</th>
                                                         <th>Price</th>
                                                         <th>Transaction Date</th>
                                                         <th>Status</th>
                                                         <th>&nbsp;</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>

                                                   <?php if ($getMySalesData) {
                                                foreach ($getMySalesData as $getMySalesDa) {
                                                   $booking_no='<a href="'.base_url()."game/orders/details/". md5($getMySalesDa->booking_no).'">#'.$getMySalesDa->booking_no.'</a>';
                                                   ?>
                                                      <tr>
                                                         <td><b><?php echo $booking_no; ?></b></td>
                                                         <td><b><?php echo $getMySalesDa->match_name; ?></b><br>
                                                            <span class="chmp_league"><?php echo $getMySalesDa->country_name.", ".$getMySalesDa->city_name;?> </span><br>
                                                            <b><?php 
                                                                  $formattedDate=date('D j F Y',strtotime($getMySalesDa->match_date))."<br/>".date('H:i',strtotime($getMySalesDa->match_time));
                                                                  
                                                                  // $date = new DateTime($getMySalesDa->match_date);
                                                                  // $formattedDate = $date->format('d-m-Y');
                                                            
                                                            echo $formattedDate; 
                                                            
                                                            ?></b>
                                                         </td>
                                                         <td><?php echo $getMySalesDa->seller_first_name." ".$getMySalesDa->seller_last_name; ?> Admin</td>                                 
                                                         <td><?php echo $getMySalesDa->seat_category; ?></td>
                                                         <td><?php echo $getMySalesDa->quantity; ?></td>

                                                         <?php  if ($this->session->userdata('role') == 1) { ?>
                                                         <?php if (strtoupper($getMySalesDa->currency_type) == "GBP") { 
                                                               $cur_type='£ ';
                                                                     } 
                                                         if (strtoupper($getMySalesDa->currency_type) == "EUR") { 
                                                               $cur_type='€ ';
                                                         } 
                                                            $ticket_amnt= number_format($getMySalesDa->ticket_amount,2) ; 
                                                      } 
                                                      if ($this->session->userdata('role') != 1) { 
                                                         if (strtoupper($getMySalesDa->currency_type) == "GBP") { 
                                                            $cur_type='£ ';
                                                                     } 
                                                         if (strtoupper($getMySalesDa->currency_type) == "EUR") { 
                                                            $cur_type='€ ';
                                                         } 
                                                         
                                                         $ticket_amnt= number_format($getMySalesDa->total_amount,2) ;
                                                      } ?>
                                                         <td><b><?php echo $cur_type." ".$ticket_amnt; ?></b></td>
                                                         <td>  
                                                            
                                                         <?php
                                                         
                                                         
                                                         //echo date("Y-m-d H:i",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$getMySalesDa->payment_date))).' '.@$_COOKIE["time_zone"];

                                                         $dateFormatted = date("d F Y", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $getMySalesDa->payment_date)));

                                                         $timeFormatted = date("H:i:s", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $getMySalesDa->payment_date)));

                                                         $gmtFormatted = @$_COOKIE["time_zone"];

                                                         echo	$payment_date= $dateFormatted . "<br>".$timeFormatted . " " . $gmtFormatted;
                                                         
                                                         
                                                         ?>
                                                      
                                                      </td>
                                                         <td>
                                                            <div class="bttns">
                                                              <!-- <span class="badge badge-success">Completed</span> -->
                                                              <?php
                                                            if ($getMySalesDa->booking_status == 0) {
                                                                echo '<span class="badge badge-danger">Failed</span>';
                                                            }
                                                            else if ($getMySalesDa->booking_status == 1) {
                                                                //echo "Confirmed";
                                                                echo '<span class="badge badge-success">Confirmed</span>';
                                                            }
                                                            else if ($getMySalesDa->booking_status == 2) {
                                                              //  echo "Pending";
                                                                echo '<span class="badge bg-primary">Pending</span>';
                                                            }
                                                            else if ($getMySalesDa->booking_status == 3) {
                                                              //  echo "Cancelled";
                                                              echo '<span class="badge badge-danger">Cancelled</span>';
                                                            }
                                                            else if ($getMySalesDa->booking_status == 4) {
                                                                //echo "Shipped";
                                                                echo '<span class="badge badge-warning">Shipped</span>';
                                                            }
                                                            else if ($getMySalesDa->booking_status == 5) {
                                                               // echo "Delivered";
                                                               echo '<span class="badge badge-warning">Delivered</span>';
                                                            }
                                                            else if ($getMySalesDa->booking_status == 6) {
                                                               // echo "Downloaded";
                                                               echo '<span class="badge badge-warning">Downloaded</span>';
                                                            }
                                                            ?>
                                                            </div>
                                                         </td>
                                                         <td>
                                                            <div class="dropdown">
                                                               <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
                                                                  <i class="mdi mdi-dots-vertical fs-sm"></i>
                                                               </a>
                                                               <div class="dropdown-menu dropdown-menu-right">
                                                                  <a href="<?php echo base_url(); ?>game/orders/details/<?php echo md5($getMySalesDa->booking_no); ?>" class="dropdown-item">View</a>
                                                                  <a href="#" class="dropdown-item">Edit</a>
                                                               </div>
                                                            </div>
                                                         </td>
                                                      </tr>
                                                      
                                                      <?php
                                                                     }
                                                               }
                                                               else{ ?>
                                                               <tr><td colspan="9"><h3>No Recent Orders.</h3></td></tr>
                                                               <?php }
                                                         ?>

                                                     
                                                   </tbody>
                                                </table>
                                             </div>
                                             <div class="pt-3 float-right">
                                                <a href="<?php echo base_url(); ?>game/orders/list_order/all" class="ms-1 waves-effect waves-light" data-effect="wave">View All</a>
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
                     </div><!-- End recent orders -->
                  </div>
               </div>
            </div>
            <?php } ?>
         </div>
      </div>
      <!-- main content End -->
<?php $this->load->view(THEME.'common/footer'); ?>
