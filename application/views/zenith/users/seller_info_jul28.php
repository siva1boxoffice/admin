<style>
    .check_box {
    max-height: 250px;
    overflow-y: auto;
}
.sort_filters ul li:nth-last-child(1)
{
   background:#f2f6f7!important;
}
</style>

<?php $this->load->view(THEME.'/common/header'); ?>
 <!-- Begin main content -->
 <div class="main-content">
      <!-- content -->
      <div class="page-content">
        <!-- page header -->
        <div class="page-title-box tick_details">
          <div class="container-fluid">
            <div class="row">
                     <div class="col-sm-8">
                        <!-- <h5 class="card-title">Sellers Info</h5> -->
                        <h5 class="card-title"><div class="go_back_btn"><a href="<?php echo base_url(); ?>home/users/seller"><i class="fas fa-arrow-left"></i></a></div>Sellers Info</h5>
                     </div>
                     <div class="col-sm-4">
                        <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                           <!-- <a href="#" data-toggle="modal" data-target="#add-board-modal" class="btn btn-primary mb-2"><i class="bx bx-list-ol bx-flashing mr-1"></i> Go Back</a>  -->
                              <!-- <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2">Save</a> -->
                        </div>
                     </div>
                  </div>
          </div>
        </div>
        <!-- page content -->
        <div class="page-content-wrapper mt--45 seller_info">
          <div class="container-fluid">

            <div class="row">
                     <div class="col-md-6 col-xl-2">
                        <div class="card rounded-0">
                           <div class="card-body">
                              <div class="media align-items-center">
                                 <div class="media-body currency_status">
                                    <p class="mb-2 font-weight-normal color_main">Orders in Total</p>
                                    <h4 class="mb-0 font-weight-bold"><?php echo count($seller_sales_data_count); ?> </h4>
                                 </div>
                                 <div class="text-center currency_symb pound">
                                    <span class="pound font-weight-normal"><i class="fe-shopping-cart"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
<?php
 $currency_type='£';
 $total_order_value=' 0';
if(!empty($seller_sales_data_count))
{
   $currency=$seller_sales_data_count[0]->currency_type;
  
   if($currency == "USD"){ 
      $currency_type='$';   
   } else if($currency == "GBP"){ 
      $currency_type='£'; 
   } else if($currency == "EUR"){    
      $currency_type='€'; 
   }   
  

   foreach($seller_sales_data_count as $seller_order_data)    
      $total_order_value+=$seller_order_data->total_amount;
   
} 
  //  echo number_format($seller_data->ticket_amount,2);

?>

                     <div class="col-md-6 col-xl-2">
                        <div class="card rounded-0">
                           <div class="card-body">
                              <div class="media align-items-center">
                                 <div class="media-body currency_status">
                                    <p class="mb-2 font-weight-normal color_main">Orders Value</p>
                                    <h4 class="mb-0 font-weight-bold"><span class="font-weight-bold mr-1"><?php echo $currency_type; ?></span><?php echo $total_order_value; ?></h4>
                                 </div>
                                 <div class="text-center currency_symb euro">
                                    <span class="euro font-weight-normal">€</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-2">
                        <div class="card rounded-0">
                           <div class="card-body">
                              <div class="media align-items-center">
                                 <div class="media-body currency_status">
                                    <p class="mb-2 font-weight-normal color_main">Pending Fulfilment</p>
                                    <h4 class="mb-0 font-weight-bold"><?php echo $fulfilment_data->fulfilment;?> </h4>
                                 </div>
                                 <div class="text-center currency_symb dollar">
                                    <span class="dollar font-weight-normal">$</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-2">
                        <div class="card rounded-0">
                           <div class="card-body">
                              <div class="media align-items-center">
                                 <div class="media-body currency_status">
                                    <p class="mb-2 font-weight-normal color_main">Payments Recieved</p>
                                    <h4 class="mb-0 font-weight-bold"><span class="font-weight-bold mr-1"><?php echo $currency_type; ?></span> <?php echo $total_order_value; ?></h4>
                                 </div>
                                 <div class="text-center currency_symb pounds">
                                    <span class="pounds font-weight-normal">£</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-2">
                        <div class="card rounded-0">
                           <div class="card-body">
                              <div class="media align-items-center">
                                 <div class="media-body currency_status">
                                    <p class="mb-2 font-weight-normal color_main">Outstanding <br>Amount Due</p>
                                    <h4 class="mb-0 font-weight-bold"><span class="font-weight-bold mr-1"><?php echo $currency_type; ?></span> <?php echo $total_order_value; ?></h4>
                                 </div>
                                 <div class="text-center currency_symb pounds">
                                    <span class="pounds font-weight-normal">£</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>



            <div class="row">
               <div class="col-lg-8 col-xl-8">
                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="tab-content customer_info_page pt-0" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel"
                                      aria-labelledby="v-pills-gen-ques-tab">
                                      <div class="accordion custom-accordion" id="general">
                                        <div class="card shadow-none mb-0 rounded-0 remove_accordin">
                                          <a data-toggle="collapse" href="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <div class="pb-0" id="headingOne">
                                              <h4 class="mb-0">
                                                Sales
                                                <i class="mdi mdi-chevron-up float-right toggle-icon fs-sm"></i>
                                              </h4>
                                            </div>
                                          </a>

                                          <div id="collapseOne" class="collapse show mt-3" aria-labelledby="headingOne"
                                            data-parent="#general">
                                             <div class="table-responsive">
                                                <table id="basic-datatable" class="sales_table table  table-hover table-nowrap mb-0">
                                                   <thead class="thead-light">
                                                      <tr>
                                                         <th>Order</th>
                                                         <th>Date & Time</th>
                                                         <th>Event</th>
                                                         <th>Qty</th>
                                                         <th>Category</th>
                                                         <th>Total</th>
                                                         <th>Status</th>
                                                         <th>&nbsp;</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>                                                      
                                                      <?php foreach($seller_sales_data as $data)  { ?>
                                                            <tr>
                                                            <td> 
                                                               
                                                            <?php 
                                                              echo  $booking_no='<a href="'.base_url()."game/orders/details/". md5($data->booking_no).'">#'.$data->booking_no.'</a>';
                                                            ?>
                                                         
                                                            </td>
                                                            <td>  <?php 
                                                                  $match_date=$data->match_date.$data->match_time ; 
                                                                  echo date("d F Y H:i", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $match_date))) . ' ' . @$_COOKIE["time_zone"];
													
                                                                  ?>
                                                            </td>
                                                            <td><?php echo $data->match_name ; ?> <br>
                                                               <span class="chmp_league"><?php echo $data->tournament_name ; ?></span>
                                                            </td>
                                                            <td><?php echo $data->quantity ; ?></td>                                 
                                                            <td><?php echo $data->seat_category ; ?></td>
                                                            <td><?php if($data->currency_type == "USD"){ ?>
                                                                           $
                                                                           <?php } else if($data->currency_type == "GBP"){ ?>
                                                                           £
                                                                           <?php } else if($data->currency_type == "EUR"){ ?>
                                                                           €
                                                                           <?php } ?> <?php echo number_format($data->ticket_amount,2);?></td>
                                                            <td>
                                                               <div class="bttns">
                                                                 <!-- <span class="badge badge-success">Completed</span> -->
                                                                  <?php if($data->booking_status == '1'){?><span class="badge badge-success">Confirmed</span><?php } ?>
                                                                  <?php if($data->booking_status == '2'){?><span class="badge badge-cancel">Pending</span><?php } ?>
                                                                  <?php if($data->booking_status == '3'){?><span class="badge badge-cancel">Cancelled</span><?php } ?>
                                                                  <?php if($data->booking_status == '4'){?><span class="badge badge-success">Shipped</span><?php } ?>
                                                                  <?php if($data->booking_status == '5'){?><span class="badge badge-success">Delivered</span><?php } ?>
                                                                  <?php if($data->booking_status == '6'){?><span class="badge badge-success">Downloaded</span><?php } ?>  
                                                               </div>
                                                            </td>
                                                            <td>
                                                               <div class="dropdown">
                                                                  <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
                                                                     <i class="mdi mdi-dots-vertical fs-sm"></i>
                                                                  </a>
                                                                  <div class="dropdown-menu dropdown-menu-right">
                                                                     <a href="javascript:void(0)" class="dropdown-item" >View</a>
                                                                     <a href="#" class="dropdown-item">Edit</a>
                                                                  </div>
                                                               </div>
                                                            </td>
                                                         </tr> 

                                                    <?php  } ?>
                                                     
                                                   </tbody>
                                                </table>
                                             </div>
                                             <div class="pt-3 float-right">
                                                <?php  $url=base_url()."game/orders/list_order/all"; ?>
                                                <a href="<?php echo $url;?> " class="ms-1 waves-effect waves-light" data-effect="wave" type="submit">View All</a>
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
                  <div class="clearfix"></div>

                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="tab-content customer_info_page pt-0" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel"
                                      aria-labelledby="v-pills-gen-ques-tab">
                                      <div class="accordion custom-accordion" id="general">
                                        <div class="card shadow-none mb-0 rounded-0">
                                          <a data-toggle="collapse" href="#collapseTwo" aria-expanded="true"
                                            aria-controls="collapseTwo">
                                            <div class="pb-0" id="headingTwo">
                                              <h4 class="mb-0">
                                                Purchases
                                                <i class="mdi mdi-chevron-up float-right toggle-icon fs-sm"></i>
                                              </h4>
                                            </div>
                                          </a>

                                          <div id="collapseTwo" class="collapse show mt-3" aria-labelledby="headingOne"
                                            data-parent="#general">
                                             <div class="">
                                                <table style='width:100% !important' id="basic-datatable" class="table sales_table table-hover table-nowrap mb-0 table-responsive">
                                               
                                                   <thead class="thead-light">
                                                      <tr>
                                                         <th>Order</th>
                                                         <th>Date & Time</th>
                                                         <th>Event</th>
                                                         <th>Qty</th>
                                                         <th>Category</th>
                                                         <th>Total</th>
                                                         <th>Status</th>
                                                         <th>&nbsp;</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                   <?php foreach($seller_sales_data as $data)  { ?>

                                                      <tr>
                                                         <td> <?php 
                                                              echo  $booking_no='<a href="'.base_url()."game/orders/details/". md5($data->booking_no).'">#'.$data->booking_no.'</a>';
                                                            ?></td>
                                                         <td> <?php 
                                                                  $match_date=$data->match_date.$data->match_time ; 
                                                                  echo date("d F Y H:i", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $match_date))) . ' ' . @$_COOKIE["time_zone"];
													
                                                                  ?></td>
                                                         <td><?php echo $data->match_name ; ?> <br>
                                                            <span class="chmp_league"><?php echo $data->tournament_name ; ?></span>
                                                         </td>
                                                         <td><?php echo $data->quantity ; ?></td>                                 
                                                         <td><?php echo $data->seat_category ; ?></td>
                                                         <td><?php if($data->currency_type == "USD"){ ?>
                                                                           $
                                                                           <?php } else if($data->currency_type == "GBP"){ ?>
                                                                           £
                                                                           <?php } else if($data->currency_type == "EUR"){ ?>
                                                                           €
                                                                           <?php } ?> <?php echo number_format($data->ticket_amount,2);?></td>
                                                         <td>
                                                            <div class="bttns">
                                                            <?php if($data->booking_status == '1'){?><span class="badge badge-success">Confirmed</span><?php } ?>
                                                                  <?php if($data->booking_status == '2'){?><span class="badge badge-cancel">Pending</span><?php } ?>
                                                                  <?php if($data->booking_status == '3'){?><span class="badge badge-cancel">Cancelled</span><?php } ?>
                                                                  <?php if($data->booking_status == '4'){?><span class="badge badge-success">Shipped</span><?php } ?>
                                                                  <?php if($data->booking_status == '5'){?><span class="badge badge-success">Delivered</span><?php } ?>
                                                                  <?php if($data->booking_status == '6'){?><span class="badge badge-success">Downloaded</span><?php } ?> 
                                                            </div>
                                                         </td>
                                                         <td>
                                                            <div class="dropdown">
                                                               <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
                                                                  <i class="mdi mdi-dots-vertical fs-sm"></i>
                                                               </a>
                                                               <div class="dropdown-menu dropdown-menu-right">
                                                                  <a href="#" class="dropdown-item">View</a>
                                                                  <a href="#" class="dropdown-item">Edit</a>
                                                               </div>
                                                            </div>
                                                         </td>
                                                      </tr>

                                                      <?php  } ?>
                                                     
                                                     
                                                   </tbody>
                                                </table>
                                             </div>
                                             <div class="pt-3 float-right">
                                             <?php  $url=base_url()."game/orders/list_order/all"; ?>
                                                <a href="<?php echo $url; ?>" class="ms-1 waves-effect waves-light" data-effect="wave" type="submit">View All</a>
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
                  <div class="clearfix"></div>

                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="tab-content customer_info_page pt-0" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel"
                                      aria-labelledby="v-pills-gen-ques-tab">
                                      <div class="accordion custom-accordion" id="general">
                                        <div class="card shadow-none mb-0 rounded-0">
                                          <a data-toggle="collapse" href="#collapseThree" aria-expanded="true"
                                            aria-controls="collapseThree">
                                            <div class="pb-0" id="headingThree">
                                              <h4 class="mb-0">
                                                Previous Payments
                                                <i class="mdi mdi-chevron-up float-right toggle-icon fs-sm"></i>
                                              </h4>
                                            </div>
                                          </a>

                                          <div id="collapseThree" class="collapse show mt-3" aria-labelledby="headingThree"
                                            data-parent="#general">
                                             <div class="table-responsive">
                                                <table id="basic-datatable" class="table  table-hover table-nowrap mb-0">
                                                   <thead class="thead-light">
                                                      <tr>
                                                         <th>Payment Ref</th>
                                                         <th>Amount</th>
                                                         <th>Currency</th>
                                                         <th>Payment Date</th>
                                                         <th>Payment Method</th>
                                                         <th>&nbsp;</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php foreach($payout_histories as $data)  { ?>
                                                      <tr>
                                                         <td><?php echo $data->payout_no; ?> </td>
                                                         <td><?php echo $data->total_payable; ?></td>
                                                         <td><?php echo $data->currency; ?></td>
                                                         <td><?php  echo date("d F Y", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $data->paid_date_time))) . ' ' . @$_COOKIE["time_zone"]; ?></td>                                 
                                                         <td>CASH</td>
                                                         <td><a class="payment_vw" href=" <?php echo base_url()."/accounts/payout_details/".$data->payout_id;?>">View payment</td>
                                                        
                                                      </tr>
                                                     <?php } ?>
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
                  </div>
                  <div class="clearfix"></div>

                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="tab-content customer_info_page pt-0" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel"
                                      aria-labelledby="v-pills-gen-ques-tab">
                                      <div class="accordion custom-accordion" id="general">
                                        <div class="card shadow-none mb-0 rounded-0">
                                          <a data-toggle="collapse" href="#collapseTwo" aria-expanded="true"
                                            aria-controls="collapseTwo">
                                            <div class="pb-0" id="headingTwo">
                                              <h4 class="mb-0">
                                                Payouts
                                                <i class="mdi mdi-chevron-up float-right toggle-icon fs-sm"></i>
                                              </h4>
                                            </div>
                                          </a>

                                          <div id="collapseTwo" class="collapse show mt-3" aria-labelledby="headingOne"
                                            data-parent="#general">
                                            <div class="section_all filter_new">
                                                <div class="row">
                                                   <div class="col-md-2 nopadds">
                                                      <div class="sort_by">
                                                         <span>Sort By:</span>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-10">
                                                      <div class="sort_filters">
                                                         <ul>
                                                            <li class="sort_list">
                                                               <div class="btn-group">
                                                                  <div class="dropdown">
                                                                     <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                                                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                     Date <i class="mdi mdi-chevron-down"></i>
                                                                     </button>
                                                                     <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                                     <form class="px-3 py-2">
                                                                        <div class="row">
                                                                           <div class="col-md-6">
                                                                              <div class="form-group datemark">
                                                                                 <input class="form-control" id="MyTextbox3" type="text" name="MyTextbox" placeholder="From">
                                                                              </div>
                                                                           </div>
                                                                           <div class="col-md-6">
                                                                              <div class="form-group datemark_to">
                                                                                 <input class="form-control" id="MyTextbox2" type="text" name="MyTextbox1" placeholder="To">
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                      </form>                                     
                                                                        <div class="reset_btn">
                                                                           <div class="reset_txt clear_all"><button class="btn btn-info">Reset</button></div>
                                                                           <div class="reset_ok"><button class="btn btn-info date_search">Search</button></div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </li>
         <li class="sort_list">
            <div class="btn-group">
               <div class="dropdown">
                  <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Currency <i class="mdi mdi-chevron-down"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                     <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                     <div id="view_project_list_filter" class="dataTables_filter">
                        <!-- <label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label> -->
                     </div>
                  </div>
                     <div class="check_box">
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" id="customCheck1" value='GBP'>
                           <label class="custom-control-label" for="customCheck1">GBP</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" id="customCheck2" value='EUR'>
                           <label class="custom-control-label" for="customCheck2">EUR</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" id="customCheck3" value='USD'>
                           <label class="custom-control-label" for="customCheck3">USD</label>
                        </div>
                     </div>
                     <div class="reset_btn">
                        <div class="reset_txt clear_all"><button class="btn btn-info">Reset</button></div>
                        <div class="reset_ok"><button class="btn btn-info currency_submit_btn">Search</button></div>
                     </div>
                  </div>
               </div>
            </div>
         </li>
                                                            <!-- <li class="sort_list">
                                                               <div class="btn-group">
                                                                  <div class="dropdown">
                                                                     <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                                                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                     Event Name <i class="mdi mdi-chevron-down"></i>
                                                                     </button>
                                                                     <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                                        <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                                        <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                                     </div>
                                                                     <div class="reset_btn">
                                                                        <div class="reset_txt"><button class="btn btn-info">Save</button></div>
                                                                        <div class="reset_ok"><button class="btn btn-info">Search</button></div>
                                                                     </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </li> -->

                                                            <li class="sort_list">
            <div class="btn-group">
               <div class="dropdown">
                  <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Event Name <i class="mdi mdi-chevron-down"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                     <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                     <div id="view_project_list_filter" class="dataTables_filter">
                        <label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id='event_name'></label>
                     </div>
                  </div>
                    
                     <div class="reset_btn">
                        <div class="reset_txt clear_all"><button class="btn btn-info">Reset</button></div>
                        <div class="reset_ok"><button class="btn btn-info event_name_submit">Search</button></div>
                     </div>
                  </div>
               </div>
            </div>
         </li>
                                                            <li class="sort_list">
                                                               <!-- <a class="clear_all" href="">Clear All</a> -->
                                                               <a class="clear_all" href="javascript:void(0)">Clear All</a>
                                                            </li>
                                                            <!-- <li class="sort_list">
                                                               <a class="report_sts" href="javascript:void(0)">Search</a>
                                                            </li> -->
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="section_left_scroll" id="content_1">
                                                   <div class="table-responsive" style="width: 100%; !important">
                                                      <table id="payout_table"  class="table  table-hover table-nowrap mb-0">
                                                         <thead class="thead-light">
                                                            <tr>
                                                               <th>Select</th>
                                                               <th>Order ID</th>
                                                               <th>Event Name</th>
                                                               <th>Buyer</th>
                                                               <th>Ticket Type</th>
                                                               <th>Tickets</th>
                                                               <th>Total Price</th>
                                                               <th>Status</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
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
                         <div class="row">
                           <div class="col-lg-4">
                              <form >
                              <div class="file_uplo mt-3">
                                 <p class="mb-2">Upload Payout or Bank Deposit Receipt</p>
                                 <div class="form-group mb-0">
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile04">
                                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                      </div>
                                    </div>
                                 </div>
                              </div>
                                       </form>
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group mt-3 mb-0">
                                  <label for="simpleinput">Payment Receipt</label>
                                  <input type="text" id="simpleinput" class="form-control reference"  placeholder="Reference#">
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="total_amt mt-3">
                                 <p class="mb-3">Total Payable</p>
                                 <h5 class="total_payable" data-currency='<?php echo $ticket_amount_cur_type; ?>' data-amount='<?php echo $seller_ticket_amount; ?>' ><?php echo $ticket_amount_cur_type." ".$seller_ticket_amount; ?></h5>
                                
                                 <h5  style="display:none" class="total_payable_hidden" data-currency='<?php echo $ticket_amount_cur_type; ?>' data-amount='<?php echo $seller_ticket_amount; ?>' ><?php echo $ticket_amount_cur_type." ".$seller_ticket_amount; ?></h5>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="confirm_payout mt-3">
                                 <p class="mb-1">&nbsp;</p>
                                 <button type="button" class="btn btn-primary  confirm_payout_btn" >Confirm Payout</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="clearfix"></div>                  
               </div>
               <div class="col-lg-4 col-xl-4">
                  <div class="card rounded-0">
                     <div class="card-body">
                        <div class="profile_details mt-3 pt-2">
                           <img src="<?php 
                         
                                          $img = empty($seller_profile_info[0]->admin_profile_pic) 
                                          ? 'https://www.listmyticket.com/uploads/users/202204261458276850931.png' 
                                          : $seller_profile_info[0]->admin_profile_pic;
                                          echo $img;
                           ?>" alt="<?php echo $seller_profile_info[0]->admin_name." ".$seller_profile_info[0]->admin_last_name; ?>" title="<?php echo $seller_profile_info[0]->admin_name." ".$seller_profile_info[0]->admin_last_name; ?>" class="img-fluid rounded-circle" width="120">
                           <h5 class="mb-3 pt-2 fw-semibold"><?php echo $seller_profile_info[0]->admin_name." ".$seller_profile_info[0]->admin_last_name; ?> </h5>
                              <div class="table-responsive">
                                 <table class="table table-borderless mb-0 table-sm">
                                    <tbody>
                                       <tr>
                                          <th>Birth Date :</th>
                                          <td>20 November 1998</td>
                                       </tr>
                                       <tr>
                                          <th>Registration :</th>
                                          <td><?php  echo date("d F Y h:i A", strtotime($seller_profile_info[0]->admin_creation_date_time));?></td>
                                       </tr>
                                       <tr>
                                          <th>Last Visit :</th>
                                          <td>10 January 2023 1:25 PM</td>
                                       </tr>
                                       <tr>
                                          <th>Language :</th>
                                          <td>English</td>
                                       </tr>
                                       <tr>
                                          <th>Signed Contract :</th>
                                          <td>                                   
                                             <div class="signed_contract mt-0">
                                             <div class="bttns">
                           <!-- <button type="button" class=" badge badge-success" data-toggle="modal"
                           data-target="#centermodal_new">Signed Contract</button> -->
                           <span class="badge badge-success" data-toggle="modal"
                           data-target="#centermodal_new"> <?php echo $lable = ($seller_profile_info[0]->signed_contract != "") ? "Received" : "Not Received"; ?></span>
                           <div>
                           <!-- Center modal content -->
                          <div class="modal fade" id="centermodal_new" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myCenterModalLabel">Signed Contract</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                 <div class="signed_cnct">
                                     <?php if ($seller_profile_info[0]->signed_contract!="")
                                     {
                                        echo "<p>".$seller_profile_info[0]->signed_contract."</p>"; 
                                        echo  '<button class="btn mb-4 mt-4 download_contract">Download</button>';
                                     } ?>
                                     <div class="signed_upload mt-3 mb-4">
                                       <div class="form-group mb-0">
                                          <div class="input-group">
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input signed_contract_file" id="inputGroupFile04" data-id="<?php echo $seller_profile_info[0]->admin_id; ?>">
                                              <label class="custom-file-label" for="inputGroupFile04">Upload New</label>
                                            </div>
                                          </div>
                                       </div>
                                    </div>
                                  </div>
                                </div>
                              </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                        </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <th>Photo ID :</th>
                                          <td>
                                             <!-- <div class="bttns">
                                                <span class="badge badge-danger">Pending</span>
                                             </div> -->

                                             <div class="signed_contract mt-0">
                                             <div class="bttns">
                                                <span class="badge <?php  echo $lable = ($seller_profile_info[0]->admin_profile_pic != "") ? "badge-success" : "badge-danger"; ?>" data-toggle="modal"
                                                data-target="#user_img_upload_modal"> <?php echo $lable = ($seller_profile_info[0]->admin_profile_pic != "") ? "Confirmed" : "Pending"; ?></span>
                                                <div>
                                                <!-- Center modal content -->
                                             <div class="modal fade" id="user_img_upload_modal" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                   <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h4 class="modal-title" id="myCenterModalLabel">Profile Picture</h4>
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <div class="signed_cnct">
                                                         <?php if ($seller_profile_info[0]->admin_profile_pic!="")
                                                         {
                                                           
                                                            $filename = basename($seller_profile_info[0]->admin_profile_pic);
                                                            echo "<p>".$filename."</p>"; 
                                                            echo  '<button class="btn mb-4 mt-4 download_admin_profile_pic">Download</button>';
                                                         } ?>
                                                         <div class="signed_upload mt-3 mb-4">
                                                            <div class="form-group mb-0">
                                                               <div class="input-group">
                                                               <div class="custom-file">
                                                                  <input type="file" class="custom-file-input admin_profile_file" id="admin_profile_img" data-id="<?php echo $seller_profile_info[0]->admin_id; ?>">
                                                                  <label class="custom-file-label" for="inputGroupFile04">Upload New</label>
                                                               </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                             </div><!-- /.modal -->
                                             </div>
                                             
                                          </td>
                                       </tr>
                                       <tr>
                                          <th>Credit Limit:</th>
                                          <td class="value_hide"><?php echo  $seller_profile_info[0]->credit_limit." ". $seller_profile_info[0]->credit_limit_currency;?> <span class="ml-3 editt" href="#">Edit</span></td>
                                          <td class="value_show" style="display: none;">
                                             <input type="text" id="simpleinput" class="credit_limit form-control widdh_30" value="<?php echo  $seller_profile_info[0]->credit_limit;?>" placeholder="5000">
                                             <!-- <input type="text" id="simpleinput" class="form-control widdh_30" placeholder="GBP">  -->
                                             <select name="select_currency_type" id="select_currency_type" class="form-control widdh_50">                                              
                                                     <option value="">Select Currency</option>
                                                     <option value="GBP" <?= $seller_profile_info[0]->credit_limit_currency == "GBP" ? "selected" : "" ?>>GBP</option>
                                                     <option value="EUR" <?= $seller_profile_info[0]->credit_limit_currency == "EUR" ? "selected" : "" ?>>Euro</option>
                                                     <option value="USD" <?= $seller_profile_info[0]->credit_limit_currency == "USD" ? "selected" : "" ?>>USD</option>
                                                     <option value="AED" <?= $seller_profile_info[0]->credit_limit_currency == "AED" ? "selected" : "" ?>>AED</option>
                                             </select>
                                             <span class="ml-3 editt_save" href="#">Save</span>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                        </div>
                     </div>
                  </div>

                  <div class="card rounded-0">
                     <div class="card-body">
                        <h5 class="mb-4 font-weight-600">Sellers Address</h5>
                        <div class="">
                           <p class="blk_clr font-weight-600">Billing Address</p>
                           <ul class="list-unstyled activity-widget mb-0">
                              <li class="activity-list">
                                 <div class="media pb-3">
                                    <div class="text-center mr-3 bg-clr">
                                       <div class="avatar-sm">
                                          <span class="avatar-title rounded-circle text-primary">
                                             <!-- <i class="bx bx-server fs-sm"></i> -->
                                             <img class="bx" src="<?php echo base_url(); ?>assets/zenith_assets/img/maps_ic.png">
                                          </span>
                                       </div>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                       <h5 class="font-size-15 mb-1 font-weight-600"><a href="#" class="gr_clr"><?php echo $seller_profile_info[0]->address; ?></a></h5>
                                       
                                    </div>
                                 </div>
                              </li>
                              <li class="activity-list">
                                 <div class="media pb-3">
                                    <div class="text-center mr-3 bg-clr">
                                       <div class="avatar-sm">
                                          <span class="avatar-title rounded-circle text-primary"><img class="bx" src="<?php echo base_url(); ?>assets/zenith_assets/img/phone_ic.png">
                                             <!-- <i class="bx bx-code fs-sm"></i> -->
                                          </span>
                                       </div>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                       <h5 class="font-size-15 mb-1 font-weight-600"><a href="#" class="gr_clr"><?php echo $seller_profile_info[0]->admin_cell_phone; ?></a></h5>
                                       
                                    </div>
                                 </div>
                              </li>
                              <li class="activity-list">
                                 <div class="media pb-3">
                                    <div class="text-center mr-3 bg-clr">
                                       <div class="avatar-sm">
                                          <span class="avatar-title rounded-circle text-primary">
                                             <img class="bx" src="<?php echo base_url(); ?>assets/zenith_assets/img/email_ic.png">
                                             <!-- <i class="bx bx-photo-album fs-sm"></i> -->
                                          </span>
                                       </div>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                       <h5 class="font-size-15 mb-1 font-weight-600"><a href="#" class="gr_clr"><?php echo $seller_profile_info[0]->admin_email; ?></a></h5>
                                       
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>

                     <div class="card-body">
                        <!-- <h5 class="mb-4 font-weight-600"></h5> -->
                        <div class="">
                           <p class="blk_clr font-weight-600">Shipping Address</p>
                           <ul class="list-unstyled activity-widget mb-0">
                              <li class="activity-list">
                                 <div class="media pb-3">
                                    <div class="text-center mr-3 bg-clr">
                                       <div class="avatar-sm">
                                          <span class="avatar-title rounded-circle text-primary">
                                             <!-- <i class="bx bx-server fs-sm"></i> -->
                                             <img class="bx" src="<?php echo base_url(); ?>assets/zenith_assets/img/maps_ic.png">
                                          </span>
                                       </div>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                       <h5 class="font-size-15 mb-1 font-weight-600"><a href="#" class="gr_clr"><?php echo $seller_profile_info[0]->address; ?></a></h5>
                                       
                                    </div>
                                 </div>
                              </li>
                              <li class="activity-list">
                                 <div class="media pb-3">
                                    <div class="text-center mr-3 bg-clr">
                                       <div class="avatar-sm">
                                          <span class="avatar-title rounded-circle text-primary"><img class="bx" src="<?php echo base_url(); ?>assets/zenith_assets/img/phone_ic.png">
                                             <!-- <i class="bx bx-code fs-sm"></i> -->
                                          </span>
                                       </div>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                       <h5 class="font-size-15 mb-1 font-weight-600"><a href="#" class="gr_clr"><?php echo $seller_profile_info[0]->admin_cell_phone; ?></a></h5>
                                       
                                    </div>
                                 </div>
                              </li>
                              <li class="activity-list">
                                 <div class="media pb-3">
                                    <div class="text-center mr-3 bg-clr">
                                       <div class="avatar-sm">
                                          <span class="avatar-title rounded-circle text-primary">
                                             <img class="bx" src="<?php echo base_url(); ?>assets/zenith_assets/img/email_ic.png">
                                             <!-- <i class="bx bx-photo-album fs-sm"></i> -->
                                          </span>
                                       </div>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                       <h5 class="font-size-15 mb-1 font-weight-600"><a href="#" class="gr_clr"><?php echo $seller_profile_info[0]->admin_email; ?></a></h5>
                                       
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>

                  <div class="card rounded-0">
                     <div class="card-body">
                        <h5 class="mb-4 font-weight-600">Private Notes</h5>
                        <div class="private_note">
                           <div class="para">
                           <i class="fas fa-info-circle"></i> 
                           <p class="gr_clr font-weight-600">This note will be displayed to all employees but not to customers.</p>
                           </div>
                           <ul class="list-unstyled activity-widget mb-0">
                             
                              <?php 
                              if(!empty($seller_private_notes))
                              {
                                 foreach ($seller_private_notes as $private_note) { ?>
                                  <li class="activity-list private_notes mb-3">
                                 <div class="media pb-0">
                                    <div class="parag_text">
                                      <p class="mb-0 blk_clr"><?php echo $private_note->private_note; ?></p>
                                    </div>
                                    <div class="media-body text-right">
                                      <div class="dropdown">
                                          <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown" aria-expanded="true">
                                             <i class="mdi mdi-dots-vertical fs-sm"></i>
                                          </a>
                                          <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-135px, 32px, 0px); top: 0px; left: 0px; will-change: transform;">
                                             <a href="javascript:void(0);" class="dropdown-item viewButton "  data-orderid='<?php echo $private_note->booking_id; ?>' data-notes='<?php echo $private_note->private_note; ?>'  data-effect="wave" data-toggle="modal" data-target="#centermodal_edit" >View</a>
                                           
                                             <a href="#" class="dropdown-item editButton" data-edit-orderid='<?php echo $private_note->booking_id; ?>' data-edit-notes='<?php echo $private_note->private_note; ?>'  data-effect="wave" data-toggle="modal" data-target="#centermodal_edit" data-id='<?php echo $private_note->id; ?>'>Edit</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="order_val mt-2">
                                    <div class="order_ids"><p class="mb-0">
                                       <?php
                                         echo  $booking_no='<a href="'.base_url()."game/orders/details/". md5($private_note->booking_id).'">#'.$private_note->booking_id.'</a>';
                                      //  echo $private_note->booking_id;
                                         ?>
                                    </p></div>
                                    <div class="order_date_time"><?php 
                                    $dateTime = new DateTime($private_note->created_date);
                                    $formattedDateTime = $dateTime->format('d F Y H:i');
                                    echo $formattedDateTime; ?></div>
                                 </div>
                              </li>
                                    <?php   } } ?>
                              <!-- <li class="activity-list private_notes mb-3">
                                 <div class="media pb-0">
                                    <div class="parag_text">
                                       <p class="mb-0 blk_clr">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                    </div>
                                    <div class="media-body">
                                      <div class="dropdown">
                                          <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown" aria-expanded="true">
                                             <i class="mdi mdi-dots-vertical fs-sm"></i>
                                          </a>
                                          <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-135px, 32px, 0px); top: 0px; left: 0px; will-change: transform;">
                                             <a href="#" class="dropdown-item">View</a>
                                             <a href="#" class="dropdown-item">Edit</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="order_val mt-2">
                                    <div class="order_ids"><p class="mb-0">#12565A</p></div>
                                    <div class="order_date_time">12 June 2019 13.45</div>
                                 </div>
                              </li> -->
                           </ul>

                           <div class="add_private_btn mt-5 float-right">
                              <button type="button" class="add_note btn btn_currency btn-primary waves-effect waves-light rounded-0" data-effect="wave" data-toggle="modal" data-target="#centermodal_edit">Add</button>

                              <!-- //////////////////////////////////////////////////////////////////////////// -->
                              <div class="modal fade" id="centermodal_edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">Add Private Notes</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
            <div class="edit_email">
               <form>
                   <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group check_box">
                              <label for="simpleinput">Order ID</label>
                              <select name="select_order_id" id="select_order_id" class="form-control">
													<option value="">Selec Order ID</option>
													<?php foreach($seller_sales_data_count as $seller_order_data) {?>
                                          <option value="<?php echo $seller_order_data->booking_no;?>"><?php echo $seller_order_data->booking_no;?></option>
                                       <?php } ?>
										</select>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                               <label for="example-textarea">Notes</label>
                               <textarea id="editor-4"></textarea>
                             </div>
                        </div>   

                        <div class="col-lg-12" style="display:none">
                          <input type='hidden' name='hidden_note_id' value='' class='hidden_note_id' />
                        </div> 

                     </div>
               </form>
               <div class="coupon_btn_save">
                <button type="button" class="btn btn-cancel close_btn">Cancel</button>
                <button type="button" class="btn btn-primary save_notes">Save</button>
              </div>
            </div>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div>
                              <!-- //////////////////////////////////////////////////////////////////////////// -->

                           </div>
                        </div>
                     </div>
                  </div>
<?php  
if(strtolower($seller_profile_info[0]->currency)=="eur")
   $active="active";
   else 
   $active="";

   echo $active;
?>
                  <div class="card rounded-0">
                     <div class="card-body">
                        <h5 class="mb-4 font-weight-600">Currency</h5>
                        <div class="">
                           <ul class="list-unstyled activity-widget mb-0">
                              <li class="activity-list mb-3 change_curreny">
                                 <button type="button" class='btn btn_currency btn-primary waves-effect waves-light rounded-0 <?php echo $active = (strtolower($seller_profile_info[0]->currency) == "gbp") ? "active" : ""; ?>' dta-effect="wave">GBP</button>
                              </li>                              
                              <li class="activity-list mb-3 change_curreny change_curreny">
                                 <button type="button" class="btn btn_currency btn-primary waves-effect waves-light rounded-0 <?php echo $active = (strtolower($seller_profile_info[0]->currency) == "usd") ? "active" : ""; ?>" data-effect="wave">USD</button>
                              </li>
                              <li class="activity-list mb-3 change_curreny">
                                 <button type="button" class='btn btn_currency btn-primary waves-effect waves-light rounded-0 <?php echo $active = (strtolower($seller_profile_info[0]->currency) == "eur") ? "active" : ""; ?>' data-effect="wave">EURO</button>
                              </li>
                              <!-- <li class="activity-list mb-3 change_curreny">
                                 <button type="button" class="btn btn_currency btn-primary waves-effect waves-light rounded-0 <?php //echo $active = (strtolower($seller_profile_info[0]->currency) == "aed") ? "active" : ""; ?>" data-effect="wave">AED</button>
                              </li> -->
                           </ul>
                        </div>
                     </div>
                  </div>

                  <div class="card rounded-0">
                     <div class="card-body">
                        <h4 class="pb-2">Log Messages</h4>
                        <div class="table-responsive log_messg">
                           <table class="table table-hover table-nowrap mb-0">
                              <thead class="thead-light">
                                 <tr>
                                    <th>Status</th>
                                    <th>Order ID</th>
                                    <th>Date &amp; Time</th>
                                    <th>Type</th>
                                 </tr>
                              </thead>
                              <tbody>
                                <?php foreach($notify_orders_seller as $data) { ?>
                                 <tr>
                                    <td>
                                       <div class="bttns">
                                         <span class="badge badge-success">Order</span>
                                       </div>
                                    </td>
                                    <td><?php 
                                      echo  $booking_no='<a href="'.base_url()."game/orders/details/". md5($data->booking_no).'">#'.$data->booking_no.'</a>';
                                  //  echo $data->booking_no;
                                     ?> </td>
                                    <td>
                                       <?php echo date("d F Y",strtotime($data->match_date)).'<br/>'.date("H:i",strtotime($data->match_time));
                                   
                                       ?>
                                    </td>
                                    <td>                                       
                                       <?php if($data->booking_status == '1'){?>Confirmed<?php } ?>
                                       <?php if($data->booking_status == '2'){?>Pending<?php } ?>
                                       <?php if($data->booking_status == '3'){?>Cancelled<?php } ?>
                                       <?php if($data->booking_status == '4'){?>Shipped<?php } ?>
                                       <?php if($data->booking_status == '5'){?>Delivered<?php } ?>
                                       <?php if($data->booking_status == '6'){?>Downloaded<?php } ?> 
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
          </div>
        </div>
      </div>
      <!-- main content End -->
<?php $this->load->view(THEME.'/common/footer'); ?>
<script>

$(document).ready(function() {

   $('.credit_limit').keypress(function(event) {
    var keyCode = event.which;
    
    // Allow only numbers (0-9) or specific control keys (e.g., backspace, delete)
    if (keyCode < 48 || keyCode > 57) {
      event.preventDefault(); // Prevent the input of non-numeric characters
    }
  });


   $(".editt").click(function() {
    $(".value_hide").hide();
    $(".value_show").show();
  });
  $(".editt_save").click(function() {

   var selectedValue = $("#select_currency_type").val();
  // $(".currency").addClass('is-invalid');
   var credit_limit = $(".credit_limit").val();
   var user_id = '<?php echo $seller_profile_info[0]->admin_id; ?>';
if(selectedValue!="" && credit_limit!="")
{

   swal({
						title: 'Are you sure you want to add the credit limit.',
						text: "Yes or No",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#0CC27E',
						cancelButtonColor: '#FF586B',
						confirmButtonText: 'Yes',
						cancelButtonText: 'No',
						confirmButtonClass: 'button h-button is-primary btn btn-primary ',
						cancelButtonClass: 'button h-button is-danger btn btn-danger',
						buttonsStyling: false
					}).then(function (res) {


				if (res.value == true) {    
							$.ajax({
						url: '<?php echo base_url();?>home/add_credit_limit ',
						type: 'POST',
						dataType: "json",
						data: {  selectedValue: selectedValue ,credit_limit:credit_limit,user_id:user_id },
						success: function (response) {               
							
							// 
								if(response.status==0)
								{
									swal('Updation Failed !', response.msg, 'error');
								}
								else
								{
									swal('Updated !', response.msg, 'success');
								}
								setTimeout(window.location.reload(),300);
						},
						error: function () {
						console.log('Failed');
						}
					});
				}   
			}, function (dismiss) {

			});

   $(".value_hide").show();
   $(".value_show").hide();
}
else 
{
   swal('Updation Failed!', 'Please provide the necessary details and click the save button.', 'error');
}
  
  });

   $('ul.list-unstyled.activity-widget li.change_curreny').click(function() {
   var buttonText = $(this).find('button').text();
   if(buttonText=="EURO")
            buttonText="EUR";
  
         // Perform AJAX call

         ////////////////////////////////////
         var user_id = '<?php echo $seller_profile_info[0]->admin_id; ?>';
         swal({
						title: 'Are you sure you want to change the currency type.',
						text: "Yes or No",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#0CC27E',
						cancelButtonColor: '#FF586B',
						confirmButtonText: 'Yes',
						cancelButtonText: 'No',
						confirmButtonClass: 'button h-button is-primary btn btn-primary ',
						cancelButtonClass: 'button h-button is-danger btn btn-danger',
						buttonsStyling: false
					}).then(function (res) {


				if (res.value == true) {    
							$.ajax({
						url: '<?php echo base_url();?>home/change_currency_type ',
						type: 'POST',
						dataType: "json",
						data: {  currency: buttonText ,user_id:user_id },
						success: function (response) {               
							
							// 
								if(response.status==0)
								{
									swal('Updation Failed !', response.msg, 'error');
								}
								else
								{
									swal('Updated !', response.msg, 'success');
								}
								setTimeout(window.location.reload(),300);
						},
						error: function () {
						console.log('Failed');
						}
					});
				}   
			}, function (dismiss) {

			});
         ////////////////////////////////////
        
         });

      $('.download_contract').click(function() {
      var fileUrl = '<?php echo TICKET_UPLOAD_PATH.'uploads/signed_contract/'.$seller_profile_info[0]->signed_contract;?>';
      downloadFile(fileUrl);
      });

      $('.download_admin_profile_pic').click(function() {
      var fileUrl = '<?php echo TICKET_UPLOAD_PATH.'uploads/users/'.basename($seller_profile_info[0]->admin_profile_pic);?>';
      downloadFile(fileUrl);
      });

 /*  $('.download_contract').click(function() {  
     
    var fileUrl =  '<?php //echo TICKET_UPLOAD_PATH.'uploads/signed_contract/'.$seller_profile_info[0]->signed_contract;?>';
     // Replace with the actual file URL
    
    // Create a temporary <a> element
    var link = document.createElement('a');
    link.href = fileUrl;
    link.download = fileUrl.split('/').pop(); // Set the downloaded file name
    
    // Append the <a> element to the document and simulate a click event
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  });

  $('.download_admin_profile_pic').click(function() {  

     var fileUrl =  '<?php //echo TICKET_UPLOAD_PATH.'uploads/users/'.basename($seller_profile_info[0]->admin_profile_pic);?>';
      // Replace with the actual file URL
     
     // Create a temporary <a> element
     var link = document.createElement('a');
     link.href = fileUrl;
     link.download = fileUrl.split('/').pop(); // Set the downloaded file name
     
     // Append the <a> element to the document and simulate a click event
     document.body.appendChild(link);
     link.click();
     document.body.removeChild(link);
   });*/

    $('.signed_contract_file').on('change', function() {
    var file_data = $('.signed_contract_file').prop('files')[0];
    var allowed_types = ['application/pdf', 'image/jpeg', 'image/png'];
    if (allowed_types.indexOf(file_data.type) === -1) {
      swal('Error!', "File type not allowed. Please select a PDF, JPEG, or PNG file.", 'error');
      return;
    }
	
	var user_id = $(this).attr('data-id');
   var form_data = new FormData();
    form_data.append('file', file_data);
	form_data.append('user_id', user_id);

    $.ajax({
	  url: '<?php echo base_url();?>home/save_signed_contract',
      type: 'POST',
	  async: false,
	  cache: false,
	  contentType: false,
	  enctype: 'multipart/form-data',
	  dataType: "json",           
      data: form_data,
      contentType: false,
      processData: false,
      success: function(response) {
        // Handle the response from the server
        console.log(response);
		swal('Updated !', response.msg, 'success');
        setTimeout(window.location.reload(),200);
      },
      error: function(xhr, status, error) {
        // Handle the error
        console.log(error);
      }
    });
  });



  $('.admin_profile_file').on('change', function() {
    var file_data = $('.admin_profile_file').prop('files')[0];
    var allowed_types = ['image/jpeg', 'image/png'];
    if (allowed_types.indexOf(file_data.type) === -1) {
      swal('Error!', "File type not allowed. Please select a JPEG, or PNG file.", 'error');
      return;
    }
	
	var user_id = $(this).attr('data-id');
   var form_data = new FormData();
    form_data.append('file', file_data);
	form_data.append('user_id', user_id);

    $.ajax({
	  url: '<?php echo base_url();?>home/save_user_profile_img',
      type: 'POST',
	  async: false,
	  cache: false,
	  contentType: false,
	  enctype: 'multipart/form-data',
	  dataType: "json",           
      data: form_data,
      contentType: false,
      processData: false,
      success: function(response) {
        // Handle the response from the server
        console.log(response);
		swal('Updated !', response.msg, 'success');
        setTimeout(window.location.reload(),200);
      },
      error: function(xhr, status, error) {
        // Handle the error
        console.log(error);
      }
    });
  });


   
   $("body").on('click','.check_box',function(e){
    //    alert('dd');
    e.stopPropagation();
});

   $("#content_1").mCustomScrollbar({
          scrollButtons:{
            enable:true
          }
        });

        const datepicker = document.getElementById('MyTextbox2');
      const to_datepicker = document.getElementById('MyTextbox3');

      // Initialize the datepicker
      $(datepicker).datepicker({
         // onSelect: function (datesel) {
         //    $('#MyTextbox2').trigger('change')
         // }, maxDate: new Date()
          dateFormat: 'yy-mm-dd' 
      }
      );
      $(to_datepicker).datepicker(
         { dateFormat: 'yy-mm-dd' }
      );

      ////////////////////////////////////////////////////////////////
      var Dtable = $('#payout_table').DataTable({
   'info': false,
   'processing': true,
   'serverSide': true,
   'serverMethod': 'post',
   "scrollX": true,
   "scrollCollapse": true,
  "fixedColumns": {
    "leftColumns": 3,  // Adjust the number of fixed columns if needed
    "rightColumns": 2
  },
   "ajax": {
      url: base_url + 'home/search_payouts',
      data: function (d) {
               d.seller_id='<?php echo $seller_id; ?>';  
               
      const fromDate = document.getElementById('MyTextbox3').value;
      const toDate = document.getElementById('MyTextbox2').value;
         d.fromDate=fromDate;
         d.toDate=toDate;
       // Get the values of the checked checkboxes
       var checkboxValues = [];
        $('.custom-control-input:checked').each(function() {
          checkboxValues.push($(this).val());
        });
        d.checkboxValues=checkboxValues;

        var event_name = $("#event_name").val();
        d.event_name=event_name;

      }

   },
   
   "targets": 'no-sort',
   "bSort": false,
   "paging":false,
   'columns': [
    { data: 'bg_id' },
    { data: 'booking_no' },
    { data: 'match_name' },
    { data: 'buyer' },
    { data: 'ticket_type' },
    { data: 'quantity' },
    { data: 'cur_type' },
    { data: 'admin_status' },
        
   ],
   "drawCallback": function(settings) {
   console.log(settings.json.seller_ticket_amount);
   var amount = settings.json.seller_ticket_amount;
    $('.total_payable').html(settings.json.ticket_amount_cur_type+amount);  
    $('.total_payable_hidden').html(settings.json.ticket_amount_cur_type+amount);

},
   
});
      ////////////////////////////////////////////////////////////////
  $('.report_sts').click(function() {

    
        Dtable.draw();

  });


  $('.clear_all').click(function () {
         $("#event_name").val('');        
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         $('.check_box input[type="checkbox"]').prop('checked', false);
         Dtable.draw();
      });

  $('.date_search').click(function (event) {

      const fromDate = document.getElementById('MyTextbox3').value;
      const toDate = document.getElementById('MyTextbox2').value;
      
      // Validate the from date
      if (!fromDate) {
        // alert('From date cannot be empty!');
         swal('Updation Failed !', 'From date cannot be empty!', 'error');
         return;
      }

      // Validate the to date
      if (!toDate) {
        // alert('To date cannot be empty!');
        swal('Updation Failed !', 'To date cannot be empty!', 'error');
         return;
      }

      if (new Date(toDate) <= new Date(fromDate)) {
        // alert('To date must be greater than From date!');
        swal('Updation Failed !', 'To date must be greater than From date!', 'error');
         return;
      }

     // Dtable.draw();
     $('.report_sts').trigger('click');
     

      });

      $('.currency_submit_btn, .event_name_submit').click(function() {
        // Call the report_sts function
        $('.report_sts').trigger('click');
        
      });

   ///////////////////////////
         //   var sum = 0; // Variable to hold the sum of values
         //$(document).on('change', '.checkbox_input', function() {
         // $('.dt-checkboxes').change(function() {
           
         //    //alert('dddddddddddddd');
         //    var value = parseFloat($(this).data('id')); // Get the value from the data attribute as an integer

         //    if ($(this).is(':checked')) {
         //       // Checkbox is checked, add the value to the sum
         //       sum += value;
         //    } else {
         //       // Checkbox is unchecked, subtract the value from the sum
         //       sum -= value;
         //    }

         //    // Print the sum (for demonstration purposes)
         //    console.log(sum);
         //    var currency = $('.total_payable').data("currency");
         //    if(sum==0)         
         //          sum = $('.total_payable').data("amount");
                  
         //    $('.total_payable').html(currency+" "+sum);
         // });


         var selectedValues = []; // Initialize an empty array to store selected values
         $(document).on('change', '.dt-checkboxes', function() {
        // $('.dt-checkboxes').change(function() {
         var value = $(this).data('bg-id'); // Get the value of the checkbox
        // var value = parseFloat($(this).data('id'));

         if ($(this).is(':checked')) {
            selectedValues.push(value); // Add the value to the array if the checkbox is checked
         } else {
            var index = selectedValues.indexOf(value);
            if (index > -1) {
               selectedValues.splice(index, 1); // Remove the value from the array if the checkbox is unchecked
            }
         }

         console.log(selectedValues); // Output the updated array
            if (selectedValues.length > 0) 
            {
               $.ajax({
                     url: base_url + 'accounts/total_payable',
                     method: "POST",
                     data: { "selectedValues": selectedValues },
                     dataType: 'json',
                     success: function (result) {
                        $('.total_payable').html(result.msg);
                     
                     }
                  });
            }
            else{
               // amount = $('.total_payable').data("amount");
               // var currency = $('.total_payable').data("currency");
               total_payable_hidden= $('.total_payable_hidden').html();
               $('.total_payable').html(total_payable_hidden);
            }
         });
   ///////////////////////////


  
   $('.btn-cancel').click(function (e){
 
      $('.close').trigger('click');

   });

   //$('.save_notes').on('click',function (e){
      $(document).on('click', '.save_notes', function() {

      var selectedValue = $("#select_order_id").val();
     
      var editorData = CKEDITOR.instances['editor-4'].getData();   
      var seller_id= '<?php echo $seller_id; ?>';
     
if(editorData!="" && selectedValue!="" )
{

   $.ajax({
			url: base_url + 'home/private_notes',
			method: "POST",
			data: { "notes": editorData , "order_id":selectedValue,"seller_id":seller_id ,"user_id":""},
			dataType: 'json',
			success: function (result) {
            
				if (result) {
               $('.close').trigger('click');
					swal('Updated !', result.msg, 'success');

				}
				else {
               $('.close').trigger('click');
					swal('Updation Failed !', result.msg, 'error');

				}

				setTimeout(function () { window.location.reload(); }, 1000);
			}
		});
   }
   else{
      
      swal('Updation Failed!', 'Please provide the necessary details and click the submit button.', 'error');
   }
   });

   $(".viewButton").click(function() {
     
        var orderId = $(this).data("orderid");
        var notes = $(this).data("notes");
      
        // Set data in the modal

        $("#select_order_id").val(orderId);
        CKEDITOR.instances['editor-4'].setData(notes);
        
       // $("#select_order_id").prop("readonly", true);
       $("#select_order_id").prop("disabled", true);
         CKEDITOR.instances['editor-4'].setReadOnly(true);
        $('.save_notes').hide();
       
        
    });

    $(".add_note").click(function() {   
     
     $("#select_order_id").val("");
     CKEDITOR.instances['editor-4'].setData("");
     
    $("#select_order_id").prop("disabled", false);
    CKEDITOR.instances['editor-4'].setReadOnly(false);
    $('.save_notes').show();
    $('.save_notes').text('Save');
    $('.save_notes').removeClass('update_notes').addClass('save_notes');
     
 });


 $(".editButton").click(function() {   
     
         var orderId = $(this).data("edit-orderid");
        var notes = $(this).data("edit-notes");
        var id=$(this).data("id");
       
      
        console.log(orderId);
        console.log(notes);

        // Set data in the modal
        $("#select_order_id").val(orderId);
        CKEDITOR.instances['editor-4'].setData(notes);

        $(".hidden_note_id").val(id);

       $("#select_order_id").prop("disabled", false);
         CKEDITOR.instances['editor-4'].setReadOnly(false);
        $('.save_notes').show();
        $('.save_notes').text('Update');
        $('.save_notes').removeClass('save_notes').addClass('update_notes');
      
     
 });

 
// Trigger the click event of update_notes button with parameters
$(document).on('click', '.update_notes', function() {
    // Handle the click event for updating notes
    var selectedValue = $("#select_order_id").val();
    var editorData = CKEDITOR.instances['editor-4'].getData();   
    var seller_id= '<?php echo $seller_id; ?>';
    var hidden_note_id = $(".hidden_note_id").val();

    // AJAX request
    $.ajax({
        url: base_url + 'home/update_notes',
        method: "POST",
        data: { "notes": editorData , "order_id": selectedValue, "seller_id": seller_id ,"hidden_note_id":hidden_note_id},
        dataType: 'json',
        success: function(result) {
            if (result) {
                $('.close').trigger('click');
                swal('Updated!', result.msg, 'success');
            } else {
                $('.close').trigger('click');
                swal('Updation Failed!', result.msg, 'error');
            }
           setTimeout(function() { window.location.reload(); }, 1000);
        }
    });
});
 




//$(document).on('click', '.confirm_payout', function() {
   $('.confirm_payout_btn').click(function() {
    //  $(this).prop("disabled", true);
   simpleinput=$('.reference').val();

     var file = $('.custom-file-input')[0].files[0];

      var file_val = $('.custom-file-input').val();
      // console.log(file_val);
      // if (file_val === "") {
      // alert("Please select a file.");
      // }


// Check if none of the checkboxes are checked
if ($('.dt-checkboxes:checked').length === 0 || simpleinput=="" || file_val === "") {
 
   swal('Updation Failed!', 'Please fill the mandatory fields.', 'error');
//   $(".confirm_payout_btn").prop("disabled", false);

}
else{
   //$(".confirm_payout").prop("disabled", false);
         var payable_orders = [];
         $('.dt-checkboxes').each(function(index, value) {
         if ($(this).is(':checked')) {
           payable_orders.push($(this).data("bg-id"));
         }
      });
      
      payment_reference=$('.reference').val();
      var seller_id= '<?php echo $seller_id; ?>';
      console.log(seller_id);
      if (payable_orders.length >= 1){
         var action = "<?php echo base_url();?>accounts/payable_orders";

         var formData = new FormData();
   	formData.append('payable_orders', payable_orders);
   	formData.append('payment_reference', payment_reference);
      formData.append('seller_id', seller_id);
      formData.append('file', file);

    $.ajax({
      type: "POST",
      url: action,
     // data: {'payable_orders' : payable_orders ,'payment_reference' : payment_reference,'seller_id' : seller_id,"file":file},
     data: formData,
      async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            dataType: "json",
            processData: false,
      success: function(data) {
      
       //  $(".confirm_payout_btn").prop("disabled", false);
console.log(data);
       if(data.status==0)
       {
         swal('Updation Failed!', 'Payout details failed to upload.', 'error');
       }
      else
      {
         swal('Updated!', 'Payout Created Successfully.', 'success');
      }
      setTimeout(function() { window.location.reload(); }, 1000);

      }
    })
      }
}



});

});


function downloadFile(fileUrl) {
  var link = document.createElement('a');
  link.href = fileUrl;
  link.download = fileUrl.split('/').pop();
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}



        
   </script>