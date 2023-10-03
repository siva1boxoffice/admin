        <?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
           <div class="view-wrapper is-webapp" data-page-title="Dashboard" data-naver-offset="150" data-menu-item="#dashboards-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative">

                    <div class="page-title has-text-centered is-webapp hide_content">

                        <div class="title-wrap">
                            <h1 class="title is-4">Recent Orders</h1>
                        </div>

                       
                    </div>

                    <div class="page-content-inner">

                        <!--Ecommerce Dashboard V1-->
                        <div class="ecommerce-dashboard ecommerce-dashboard-v1 dash_title">

                         
                             <?php  if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 10) { ?>
                            <div class="columns is-multiline">

                                
                                  <!--Table-->
                                <div class="column is-12">

                                    <!--Header-->
                                    <div class="table-header">
                                        <h3 class="dark-inverted">Recent Orders</h3>
                                        
                                    </div>
                                    <div class="flex-table orders list_odd">

                                      <table class="toptable res_table_new table-responsive">
                                        <tbody>
                                            <tr class="accordion">
                                                <th>Order</th>
                                                <th>Event</th>
                                                <th>Seller Name</th>
                                                <th>Customer Country</th>
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
                                                        <td data-label="Seller Name:">
                                                            <?php echo $getMySalesDa->seller_first_name; ?> <?php echo $getMySalesDa->seller_last_name; ?>
                                                        </td>
                                                         <td data-label="Customer Country:">
                                                            <?php echo $getMySalesDa->customer_country_name; ?>
                                                        </td>
                                                      <!--   <td data-label="Ticket Format:">
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
                                                        </td> -->
                                                        <td data-label="Tickets Type:">
                                                            <?php echo $getMySalesDa->seat_category;
                                                            ?>
                                                        </td>
                                                        <td data-label="Tickets Qty:">
                                                            <?php echo $getMySalesDa->quantity;
                                                            ?>
                                                        </td>
                                                        <td data-label="Price:"><b>
                                                        <?php  if ($this->session->userdata('role') == 1) { ?>
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
                                            <?php } ?>
                                              <?php  if ($this->session->userdata('role') != 1) { ?>
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
                                            <?php } ?>
                                                 </b></td>
                                                        <td data-label="Transaction date:"><span class="tr_date">
                                                                <?php
                                                               // echo  $getMySalesDa->updated_at;
                                                                ?>
                                                                

                                           
                                                            <?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$getMySalesDa->payment_date))).' '.@$_COOKIE["time_zone"];
                                                            ?>
                                                            </span> </td>
                                                        <td data-label="Status:">
                                                            <?php
                                                            if ($getMySalesDa->booking_status == 0) {
                                                                echo "FAILED";
                                                            }
                                                            else if ($getMySalesDa->booking_status == 1) {
                                                                echo "CONFIRMED";
                                                            }
                                                            else if ($getMySalesDa->booking_status == 2) {
                                                                echo "PENDING";
                                                            }
                                                            else if ($getMySalesDa->booking_status == 3) {
                                                                echo "CANCELLED";
                                                            }
                                                            else if ($getMySalesDa->booking_status == 4) {
                                                                echo "SHIPPED";
                                                            }
                                                            else if ($getMySalesDa->booking_status == 5) {
                                                                echo "DELIVERED";
                                                            }
                                                            else if ($getMySalesDa->booking_status == 6) {
                                                                echo "DOWNLOADED";
                                                            }
                                                            ?>

                                                        </td>
                                                        <td data-label="View Details:"><a href="<?php echo base_url(); ?>game/orders/details/<?php echo md5($getMySalesDa->booking_no); ?>"><i class="fas fa-angle-double-right"></i><button class="btn_mobile">Click Here</button></a></td>
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
                                     <div class="pagination datatable-pagination pagination-datatables flex-column">
                                        <?php echo $pagination; ?>
                                </div>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                        </div>

                    </div>

                <?php $this->load->view('common/footer');?>