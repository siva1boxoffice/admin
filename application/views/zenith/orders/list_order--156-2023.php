<style>
.order_status_check_box {
    padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
}
.check_box, .seat_category_check_box, .order_status_check_box {
    max-height: 250px;
    overflow-y: auto;
}
</style>
<?php  $this->load->view('zenith/common/header'); ?>
<div id="overlay">
  <div id="loader">
    <!-- Add your loading spinner HTML or image here -->
    <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
  </div>
</div>
    <!-- Begin main content -->
      <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
         <div class="page-title-box">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-sm-4 col-xl-4">
                        <div class="page-title">
                           <h3 class="mb-1 font-weight-bold">Orders All</h3>
                        </div>
                     </div>
                     <div class="col-sm-8 col-xl-8 text-sm-right mt-2 mt-sm-0">

                     </div>
                  </div>
               </div>
            </div>

                        <!-- page content -->

            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">               
                  <div class="card">
                     <div class="card-body">
                        
                        <div class="section_all filter_new">
                           <div class="row">
                              <div class="col-md-1 nopadds">
                                 <div class="sort_by">
                                    <span>Sort By:</span>
                                 </div>
                              </div>
                              <div class="col-md-11">
                                 <div class="sort_filters">
                                    <ul>
                                       <li class="sort_list">
                                          <div class="btn-group">
                                             <div class="dropdown">
                                                <button class="btn btn-light dropdown-toggle order_id_search_filter" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Order ID <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                   <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" id="booking_no" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                </div>
                                                   <!-- <a class="dropdown-item" href="#">Supercopa De Italia</a>
                                                   <a class="dropdown-item" href="#">Super Lig</a>
                                                   <a class="dropdown-item" href="#">Test Tournament English2</a> -->
                                                   <!-- <div class="check_box">
                                                     <div class="custom-control custom-checkbox">
                                                       <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                       <label class="custom-control-label" for="customCheck1">Arnab Gupta</label>
                                                     </div>
                                                     <div class="custom-control custom-checkbox">
                                                       <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                       <label class="custom-control-label" for="customCheck2">Ali Wikilins</label>
                                                     </div>
                                                   </div> -->
                                                   <div class="reset_btn">
                                                      <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
                                                      <div class="reset_ok"><button class="btn btn-info search_ok">Search</button></div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </li>
                                       <li class="sort_list">
                                          <div class="btn-group">
                                             <div class="dropdown">
                                                <button class="btn btn-light dropdown-toggle event_name_filter" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Event Name <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                   <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." id="event_name" aria-controls="view_project_list"></label></div>
                                                </div>
                                                   <!-- <a class="dropdown-item" href="#">Supercopa De Italia</a>
                                                   <a class="dropdown-item" href="#">Super Lig</a>
                                                   <a class="dropdown-item" href="#">Test Tournament English2</a> -->
                                                  <!--  <div class="check_box">
                                                     <div class="custom-control custom-checkbox">
                                                       <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                       <label class="custom-control-label" for="customCheck1">Arnab Gupta</label>
                                                     </div>
                                                     <div class="custom-control custom-checkbox">
                                                       <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                       <label class="custom-control-label" for="customCheck2">Ali Wikilins</label>
                                                     </div>
                                                   </div> -->
                                                   <div class="reset_btn">
                                                      <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
                                                      <div class="reset_ok"><button class="btn btn-info event_search_ok">Search</button></div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </li>
                                       <li class="sort_list">
                                          <div class="btn-group">
                                             <div class="dropdown">
                                                <button class="btn btn-light dropdown-toggle date_search_filter" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Event Date <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                   <!-- <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                </div> -->
                                                <form class="px-3 py-2">
                                                   <div class="row">
                                                      <div class="col-md-6">
                                                         <div class="form-group datemark">
                                                            <input class="form-control" id="MyTextbox3" type="text" name="MyTextbox" placeholder="From" autocomplete="off">
                                                         </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                         <div class="form-group datemark_to">
                                                            <input class="form-control" id="MyTextbox2" type="text" name="MyTextbox1" placeholder="To" autocomplete="off">
                                                         </div>
                                                      </div>
                                                   </div>
                                                 </form>
                         
                                                   <div class="reset_btn">
                                                      <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
                                                      <div class="reset_ok"><button class="btn btn-info date_search">Search</button></div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </li>
                                         <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle seller_name_btn" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Seller Name <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="seller_name"></label></div>
                                                   </div>
                                                   <div class="check_box">
                                                       
                                                        <?php 
                                                            echo $this->data['seller_html'];
                                                        ?>
                                                      </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info seller_reset" >Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info seller_search">Search</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                      <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle shipping_status_name_btn" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Shipping status <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="shipping_status"></label></div>
                                                   </div>
                                                   <div class="seat_category_check_box">
                                                       
                                                        <?php 
                                                            echo $this->data['shipping_status'];
                                                        ?>
                                                      </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info shipping_status_reset" >Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info shipping_status_search">Search</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                       <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle order_status_btn" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Order status <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="order_status"></label></div>
                                                   </div>
                                                   <div class="order_status_check_box">
                                                       
                                                        <?php 
                                                            echo $this->data['order_status'];
                                                        ?>
                                                      </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info order_status_reset" >Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info order_status_search">Search</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                       <li class="sort_list">
                                          <a class="clear_all reset_txt" href="javascript:void(0)">Clear All</a>
                                       </li>
                                       <li class="sort_list">
                                          <a class="report_sts" href="">Reports</a>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="table-responsive">
                              <table style='width:100% !important' id="all-orders" class="table table-responsive bo-table w-100 dataTable no-footer">
                                 <thead class="thead-light">
                                    <tr>
                                       <th>&nbsp;</th>
                                       <th>Order ID</th>
                                       <th>Event name</th>
                                       <th>Event date</th>
                                       <th>Buyer</th>
                                       <th>Ticket type</th>
                                       <th>Tickets</th>
                                       <th>Category</th>
                                       <th>Total Ticket(s) Price</th>
                                       <th>Total Buyer Value</th>
                                       <th>Purchase date</th>
                                       <th>Seller</th>
                                       <th>Delivery date</th>
                                       <th>Shipping status</th>
                                       <th>Admin status</th>
                                     
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
      <!-- main content End -->
<?php $this->load->view('zenith/common/footer'); ?>
    <script src="<?php echo base_url(); ?>assets/zenith_assets/v1/js/rome.js"></script>
 <script type="text/javascript">
      $(document).ready(function () {


       //  $('.status_change').on('change', function() {
            $(document).on("change", ".status_change", function() {
    var bookingId = $(this).data('status-booking-id');
    var selectedValue = $(this).val();

    $.ajax({
						url: '<?php echo base_url();?>game/get_encrpty_id ',
						type: 'POST',
						dataType: "json",
						data: {  booking_id: bookingId  },
						success: function (response) {        
                   //  window.location.href = '<?php //echo base_url(); ?>game/orders/upload_e_ticket/'+response.msg
                       update_booking_status(response.msg, selectedValue);
						},
						error: function () {
						console.log('Failed');
						}
					});
    
    // Call your JavaScript function here and pass the bookingId and selectedValue
    
});

     
         $(document).on("click", ".upload_ticket", function() {
    var booking_id = "1BX"+$(this).data("booking");
    console.log(booking_id);
    $.ajax({
						url: '<?php echo base_url();?>game/get_encrpty_id ',
						type: 'POST',
						dataType: "json",
						data: {  booking_id: booking_id  },
						success: function (response) {        
                     window.location.href = '<?php echo base_url(); ?>game/orders/upload_e_ticket/'+response.msg
						},
						error: function () {
						console.log('Failed');
						}
					});
  });


   ///////////////////////////////////////
   //download ticket

 //  $(document).ready(function() {
   $(document).on("click", ".download_e_ticket", function() {
  //$(".download_ticket").click(function() {
    var orderId = $(this).data("booking-id");
    
    $.ajax({
						url: '<?php echo base_url();?>game/get_encrpty_id ',
						type: 'POST',
						dataType: "json",
						data: {  booking_id: orderId  },
						success: function (response) {        
                     window.location.href = '<?php echo base_url(); ?>game/get_download_record/'+orderId
						},
						error: function () {
						console.log('Failed');
						}
					});

    


    // AJAX request to fetch the record set based on order_id
  
  
  });

//});
   //////////////////////////////////////


   $("#MyTextbox4").datepicker();
   $("#MyTextbox5").datepicker();
}); 

      $('.dropdown-menu-custom .check_box').click(function(e){
    e.stopPropagation();
});


      $('.tbl-toggle-row').on('click', function(){
                if ($(this).hasClass('show')) {
                    $(this).removeClass('show');
                    $(this).parent('tr').next('.tbl-collapsed-row').removeClass('show');
                }else{
                    $('.tbl-toggle-row').removeClass('show');
                    $('.tbl-collapsed-row').removeClass('show');
                    $(this).addClass('show');
                    $(this).parent('tr').next('.tbl-collapsed-row').addClass('show');
                }
            });
   </script>

     <script>
    

     function setFilter(elem,flag){
    if(flag == 1){

        $(".shipping_status").each(function() {
            $(this).removeClass('active');
        });
        $(elem).addClass('active');

    }
    else if(flag == 2){

         $(".order_status").each(function() {
            $(this).removeClass('active');
        });
        $(elem).addClass('active');

    }
    //OrderFilter();
}

 
      function format(d) { 
      console.log('xxxxxxxxxxxxx');
       var order = d.order_data;console.log(order);
       var order_seller_notes = '';
       var order_block_row = '';
       var discount_amount = '0.00';
       var partner_amount = '0.00';
       var delivery_status = "";
       var ticket_status = "";
       var order_nominees = "";

       if(order.seller_notes != ""){

        if(order.seller_notes?.length !== 0){
            $.each(order.seller_notes, function (key, val) {
                order_seller_notes += val.ticket_name+'<br>';
            });
        }
        else{
        order_seller_notes = 'NA';
        }
        }
        else{
        order_seller_notes = 'NA';
        }

        if(order.ticket_block != ""){
            order_block_row = order.ticket_block;
            if(order.row != ""){
                order_block_row += order_block_row+','+order.row;
            }
        }
        else{
        order_block_row = 'NA';
        }

        if(order.discount_amount != "" && order.discount_amount != null){
            discount_amount = order.discount_amount;
        }
        if(order.partner_fee != "" && order.partner_fee != 0){
            partner_amount = order.partner_fee;
        }
            
        if (order.delivery_status == 0 || order.delivery_status == '') {
        delivery_status = "Tickets Not Uploaded";
        }
        else if (order.delivery_status == 1) {
        delivery_status = "Tickets In-Review";
        }
        else if (order.delivery_status == 2) {
        delivery_status = "Tickets Approved";
        }
        else if (order.delivery_status == 3) {
        delivery_status = "Tickets Rejected";
         } 
        else if (order.delivery_status == 4) { 
        delivery_status = "Tickets Downloaded";
         } 
        else if (order.delivery_status == 5) { 
        delivery_status = "Tickets Shipped";
         } 
        else if (order.delivery_status == 6) { 
        delivery_status = "Tickets Delivered";
        } 

        if (order.ticket_status == 1) { 
        ticket_status = "Approve Pending";
        }
        else if (order.ticket_status == 2) { 
        ticket_status = "Approved";
        }
        else if (order.ticket_status == 3) { 
        ticket_status = "Downloaded";
        }
        else{
         ticket_status = "Pending";   
        }

    if(order.nominees != ""){
      console.log('xxxxxxxxxxxxxxxxxx');
      console.log(order);
      console.log('xxxxxxxxxxxxxxxxxx');
        //if(order.nominees.length > 0){
            if(order.nominees?.length !== 0){
            $.each(order.nominees, function (key, val) {
               
                if(val.first_name != null){
                    order_nominees += '<tr>'+
                    '<td>'+val.first_name+' '+val.last_name+'</td>'+
                    '<td>'+val.dob+'</td>'+
                    '<td>'+val.email+'</td>'+
                    '</tr>';
                }
                else{
                    order_nominees = '<tr><td colspan="3">NA</td></tr>';
                }
                
            });
        }
        else{
        order_nominees = '<tr><td colspan="3">NA</td></tr>';
        }
    }
    else{
         order_nominees = '<tr><td colspan="3">NA</td></tr>';
        }
       


    // `d` is the original data object for the row
    return (
'<div class="row ms-0">'+
'<div class="col-md-8">'+
'<div class="row">'+
'<div class="col mr-3 card">'+
'<div class="card-body">'+
'<h5>Buyer Info</h5>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Buyer Name:'+
'</label>'+
'<div class="col-md-7">'+
order.customer_first_name+" "+order.customer_last_name+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Buyer Email:'+
'</label>'+
'<div class="col-md-7">'+
order.email+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Phone Number:'+
'</label>'+
'<div class="col-md-7">'+
order.customer_mobile_no+" "+order.dialing_code+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Alternative Phone:'+
'</label>'+
'<div class="col-md-7">'+
order.customer_mobile_no+" "+order.dialing_code+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Billing Address:'+
'</label>'+
'<div class="col-md-7">'+
order.billing_first_name+" "+order.billing_last_name+"<br>"+
order.billing_postal_code+","+order.billing_address+"<br>"+
order.city_name+","+order.country_name+"<br>"+
'</div>'+
'</div>'+
'<div class="row mt-3">'+
'<label class="col-md-5">'+
'Partners:'+
'</label>'+
'<div class="col-md-7">'+
order.source_type+
'</div>'+
'</div>'+
'</div>'+
'</div>'+
'<div class="col me-3 card">'+
'<div class="card-body">'+
'<h5>Payment Details</h5>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Price/Ticket:'+
'</label>'+
'<div class="col-md-7">'+
order.price+' '+order.currency_type+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Quantity:'+
'</label>'+
'<div class="col-md-6">'+
order.quantity+' '+order.ticket_type_name+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Sub Total:'+
'</label>'+
'<div class="col-md-7">'+
order.ticket_amount+' '+order.currency_type+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Partner Fee:'+
'</label>'+
'<div class="col-md-7">'+
partner_amount+' '+order.currency_type+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Store Fee:'+
'</label>'+
'<div class="col-md-7">'+
order.store_fee+' '+order.currency_type+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Delivery Fee:'+
'</label>'+
'<div class="col-md-7">'+
order.delivery_fee+' '+order.currency_type+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Booking Protect Fee:'+
'</label>'+
'<div class="col-md-7">'+
order.premium_price+' '+order.currency_type+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Total Discount:'+
'</label>'+
'<div class="col-md-7">'+
discount_amount+' '+order.currency_type+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Total Selling Amount:'+
'</label>'+
'<div class="col-md-7">'+
order.total_amount+' '+order.currency_type+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Buyer Currency:'+
'</label>'+
'<div class="col-md-7">'+
order.currency_type+
'</div>'+
'</div>'+
'</div>'+
'</div>'+
'</div>'+
'<div class="row">'+
/*'<div class="col me-3 mb-0 card">'+
'<div class="card-body">'+
'<h5>Delivery Details</h5>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Ticket Type:'+
'</label>'+
'<div class="col-md-7">'+
order.ticket_type_name+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Delivery Fee:'+
'</label>'+
'<div class="col-md-7">'+
order.delivery_fee+' '+order.currency_type+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Ticket Upload Status:'+
'</label>'+
'<div class="col-md-7">'+
delivery_status+' '+order.ticket_upload_date+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Ticket Approve Status:'+
'</label>'+
'<div class="col-md-7">'+
ticket_status+' '+order.ticket_approve_date+
'</div>'+
'</div>'+
'</div>'+
'</div>'+*/
'<div class="col mr-3 mb-0 card">'+
'<div class="card-body">'+
'<h5>Delivery Details</h5>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Method:'+
'</label>'+
'<div class="col-md-7">'+
'Pickup'+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Delivery Deadline:'+
'</label>'+
'<div class="col-md-7">'+
'Sun 26 March 2023, 3:35 PM'+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Name:'+
'</label>'+
'<div class="col-md-7">'+
order.billing_first_name+" "+order.billing_last_name+"<br>"+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Address:'+
'</label>'+
'<div class="col-md-7">'+
order.billing_postal_code+","+order.billing_address+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'City:'+
'</label>'+
'<div class="col-md-7">'+
order.city_name+"<br>"+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Postal/Zip Code:'+
'</label>'+
'<div class="col-md-7">'+
order.billing_postal_code+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Country:'+
'</label>'+
'<div class="col-md-7">'+
order.country_name+
'</div>'+
'</div>'+
'</div>'+
'</div>'+
'<div class="col me-3 mb-0 card">'+
'<div class="card-body">'+
'<h5>Ticket Holder Details</h5>'+
'<table class="bo-table w-100 mb-0">'+
'<thead>'+
'<tr>'+
'<th>NAME:</th>'+
'<th>DOB:</th>'+
'<th>EMAIL:</th>'+
'</tr>'+
'</thead>'+
'<tbody>'+
order_nominees+
'</tbody>'+
'</table>'+
'</div>'+
'</div>'+
'</div>'+
'</div>'+
'<div class="col-md-4 ps-0 d-flex flex-column justify-content-between">'+
'<div class="card">'+
'<div class="card-body">'+
'<h5>Event and Ticket Info</h5>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Event Name: '+
'</label>'+
'<div class="col-md-7">'+
order.match_name+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Event Date &amp; Time:'+
'</label>'+
'<div class="col-md-7">'+
order.formated_match_time+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Tournament:'+
'</label>'+
'<div class="col-md-7">'+
order.tournament_name+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Venue:'+
'</label>'+
'<div class="col-md-7">'+
order.stadium_name+','+order.city_name+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Ticket Type:'+
'</label>'+
'<div class="col-md-7">'+
order.ticket_type_name+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Category:'+
'</label>'+
'<div class="col-md-7">'+
order.seat_category+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Quantity:'+
'</label>'+
'<div class="col-md-7">'+
order.quantity+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Block &amp; Row:'+
'</label>'+
'<div class="col-md-7">'+
order_block_row+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Sellers Notes:'+
'</label>'+
'<div class="col-md-7">'+
order_seller_notes+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Seller Name:'+
'</label>'+
'<div class="col-md-7">'+
order.seller_first_name+' '+order.seller_last_name+
'</div>'+
'</div>'+
'<div class="d-flex justify-content-end mt-5">'+
'<button type="button" class="btn btn-primary-outline me-3 mr-2 upload_ticket" data-booking="'+order.bg_id+'" data-org-id='+order.bg_id+' >Upload E-Ticket</button>'
+
'<button type="button" class="btn btn-primary-outline me-3 mr-2 download_e_ticket"  data-booking-id="'+order.bg_id+'" >Download</button>'+
'</div>'+
'</div>'+
'</div>'+
'<div class="card mb-0">'+
'<div class="card-body">'+
'<h5>Booking Status</h5>'+
'<div class="d-flex justify-content-between align-items-center mt-4">'+
'<select class="form-select me-2 status_change" style="width: 40%;" data-status-booking-id='+order.bg_id+'>'+
'<option ' + (2 == order.booking_status ? 'selected ' : '') + 'value="2">Pending</option>'+
'<option ' + (1 == order.booking_status ? 'selected ' : '') + 'value="1">Confirmed</option>'+
'<option ' + (0 == order.booking_status ? 'selected ' : '') + 'value="0">Failed</option>'+
'<option ' + (4 == order.booking_status ? 'selected ' : '') + 'value="4">Shipped</option>'+
'<option ' + (5 == order.booking_status ? 'selected ' : '') + 'value="5">Delivered</option>'+
'<option ' + (6 == order.booking_status ? 'selected ' : '') + 'value="6">Downloaded</option>'+
'</select>'+
'<div class="bo-checkbox">'+
'<input type="checkbox" class="bo-checkbox-input" checked="checked" id="checkbox-sendmail">'+
'<label class="bo-checkbox-label" for="checkbox-sendmail">Send Mail</label>'+
'</div>'+
'<button type="button" class="btn btn-tbl-card-action">Need to Receive ('+order.quantity+')</button>'+
'</div>'+
'</div>'+
'</div>'+
'</div>'+
'</div>'+
'</td>'+
'<td style="display: none;"></td>'+
'<td style="display: none;"></td>'+
'<td style="display: none;"></td>'+
'<td style="display: none;"></td>'+
'<td style="display: none;"></td>'+
'<td style="display: none;"></td>'+
'<td style="display: none;"></td>'+
'<td style="display: none;"></td>'+
'<td style="display: none;"></td>'+
'<td style="display: none;"></td>'+
'<td style="display: none;"></td>'+
'<td style="display: none;"></td>'+
'<td style="display: none;"></td>'+
'<td style="display: none;"></td>'
    );
}

        $(document).ready(function() {

    $("body").on('click','.seat_category_check_box,.order_status_check_box',function(e){
    //    alert('dd');
    e.stopPropagation();
});



$(".order_status_check_box").change(function() {  
         var checkedCount = $('.order_status_check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.order_status_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.order_status_btn').text("Order Status");  
            
         });

$(".seat_category_check_box").change(function() {  
         var checkedCount = $('.seat_category_check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.shipping_status_name_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.shipping_status_name_btn').text("Shipping Status");  
            
         });




           $('#all-orders').on('click', 'tbody td.order-control', function () { 
        var tr = $(this).closest('tr');

        var row = Dtable.row(tr);
  // tr.closest('tr').addClass("tbl-collapsed-row child even");
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
        } else {
            // Open this row
            row.child(format(row.data())).show();
        }
        tr.closest('tr').next('tr').addClass("tbl-collapsed-row child even");
    });

         $('#all-orders').on('requestChild.dt', function (e, row) { 
            console.log(row.data());
        //row.child(format(row.data())).show();
    });

         
            $(document).on("click",".tbl-toggle-row",function() { 
                
            /*  $(".tbl-toggle-row").each(function() {
                  $(this).removeClass('show');
                  });
              $(this).toggleClass("show");
              $(this).parent('tr').next('.tbl-collapsed-row').toggleClass("show");*/

        /*         $(".tbl-toggle-row").each(function() {
                  $(this).removeClass('show');
                  });
                  $(".tbl-collapsed-row").each(function() {
                     if ($(this).hasClass('show')) {
                        $(this).hide();
                     }
                  
                  });*/
                  console.log('length = '+$(this).parent('tr').next('.tbl-collapsed-row').children('td').children('table').children('tbody').children('tr').length);
                if ($(this).hasClass('show')) { 

                    $(this).removeClass('show');
                     $(".tbl-collapsed-rows").each(function() {
                     if ($(this).hasClass('show')) {
                        $(this).hide();
                     }
                      $(".tbl-collapsed-row").each(function() {
                  $(this).removeClass('show');
                  });
                  $(this).parent('tr').next('.tbl-collapsed-row').removeClass('show');
                  //$(this).parent('tr').next('.tbl-collapsed-row').children('td').children('table').children('tbody').children('tr').removeClass('show');
                  });
                 /*   $(this).parent('tr').next('.tbl-collapsed-row').removeClass('show');
                     $('.tbl-collapsed-row').addClass('show');*/
                }else{ 

                  $(".tbl-toggle-row").each(function() {
                  $(this).removeClass('show');
                  });
                  $(this).addClass('show');

                  $(".tbl-collapsed-rows").each(function() {
                  $(this).removeClass('show');
                  });

                  $(".tbl-collapsed-row").each(function() {
                  $(this).removeClass('show');
                  });
                  $(this).parent('tr').next('.tbl-collapsed-row').addClass('show');
                  // $(this).parent('tr').next('.tbl-collapsed-row').next('.tbl-collapsed-rows').addClass('show');
                   // $(this).parent('tr').next('.tbl-collapsed-row').children('td').children('table').children('tbody').children('tr').addClass('show');
                   /*console.log('else');
                    $('.tbl-toggle-row').removeClass('show');
                    $('.tbl-collapsed-row').addClass('show');
                    $(this).addClass('show');
                    $(this).parent('tr').next('.tbl-collapsed-row').addClass('show');*/
                }


            });

            
      var overlay = $('#overlay');
              var Dtable =  $('#all-orders').DataTable({

          'info' : false,
      //    'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          "pageLength" : 50,
        "ajax": {
            url : "<?php echo base_url();?>" + 'game/booking_get_items',
         data: function (d) {

               var booking_no = $("#booking_no").val();
               var seller_name = $("#seller_name").val();
               var event_name = $("#event_name").val();
              // var shipping_status = $('#shipping-status-hidden').data('shipping-status-hidden');
               var fromDate = document.getElementById('MyTextbox3').value;
               var toDate = document.getElementById('MyTextbox2').value;


               var checkedIds = [];
               $(".check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  checkedIds.push(newID);
               });

               d.seller_name = checkedIds;


               var shippingID = [];
               $(".seat_category_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("shipping_status", "");     

                  shippingID.push(newID);
               });

               var orderStatusID = [];
               $(".order_status_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("order_status", "");     

                  orderStatusID.push(newID);
               });
               

               d.booking_no = booking_no;
             //  d.seller_name = seller_name;
          //   d.shipping = shippingID;
               d.event = event_name;
             //  d.order_status = order_status;
               d.shipping_status = shippingID;
               d.order_status = orderStatusID;
               d.event_start_date = fromDate;
               d.event_end_date = toDate;
            
         },
         beforeSend: function() {
      // Show the overlay before the AJAX call
      overlay.show();
    },

    complete: function() {
      // Hide the overlay after the AJAX call is complete (regardless of success or error)
      overlay.hide();
    }
         
         /*
            dataSrc: function ( json ) {
            
        }*/
          
        },
      "targets": 'no-sort',
      "bSort": false,
      //"paging": false,
          
      language: {/*
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        */},

        drawCallback: function() {/*
            $(".dataTables_paginate > .paginate_button").addClass("flat-rounded-pagination"), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
        */},
      'columns': [
             { className: 'tbl-toggle-row order-control',data: 'toggle' },
             { className: 'order_number',data: 'booking_no' },
             { data: 'match_name' },
             { data: 'match_date' },
             { data: 'buyer' },
             { data: 'ticket_type' },
             { data: 'tickets' },
             { data: 'category' },
             { data: 'total_ticket_price' },
             { data: 'buyer_value' },
             { data: 'purchase_date' },
             { data: 'seller' },
             { data: 'delivery_date' },
            { data: 'shipping_status' },
            { data: 'order_status' },
          ]
    });

      $('.search_ok').on('click', function (e) { 
         $('.order_id_search_filter').addClass("filter_active");
         Dtable.draw();
      });

      $('.event_search_ok').on('click', function (e) {
         $('.event_name_filter').addClass("filter_active");
         Dtable.draw();
      });

      $('#order_status a').on('click', function (e) {
         $('#order-status-hidden').data('status-hidden', $(this).data('order-status'));
         Dtable.draw();
      });

      $('#shipping_status a').on('click', function (e) {
         $('#shipping-status-hidden').data('shipping-status-hidden', $(this).data('shipping-status'));
         Dtable.draw();
      });

      $('.shipping_status_search').on('click', function (e) {  
         $('.shipping_status_name_btn').addClass("filter_active");

                Dtable.draw();
            });

      $('.reset_txt').click(function () {
         $("#booking_no").val('');
         $("#seller_name").val('');
         $("#event_name").val('');
         $('#order-status-hidden').data('status-hidden', "");
         $('#shipping-status-hidden').data('shipping-status-hidden', "");
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         // trigger your desired action here
         Dtable.draw();

      });



       // Get the datepicker input element
       const datepicker = document.getElementById('MyTextbox2');
      const to_datepicker = document.getElementById('MyTextbox3');

      // Initialize the datepicker
      $(datepicker).datepicker({
         // onSelect: function (datesel) {
         //    $('#MyTextbox2').trigger('change')
         // }, maxDate: new Date()
          dateFormat: 'dd-mm-yy' 
      }
      );
      $(to_datepicker).datepicker(
         { dateFormat: 'dd-mm-yy' }
      );

      $('.date_search').click(function (event) {

         $('.date_search_filter').addClass("filter_active");

         const fromDate = document.getElementById('MyTextbox3').value;
         const toDate = document.getElementById('MyTextbox2').value;
         console.log('Chosen date:', toDate);

         // Validate the from date
         if (!fromDate) {
            alert('From date cannot be empty!');
            return;
         }

         // Validate the to date
         if (!toDate) {
            alert('To date cannot be empty!');
            return;
         }

         if (new Date(toDate) <= new Date(fromDate)) {
            alert('To date must be greater than From date!');
            return;
         }

         Dtable.draw();

      });

      $('.seller_search').on('click', function (e) {    
         $('.seller_name_btn').addClass("filter_active");
                Dtable.draw();
            });
      $('.order_status_search').on('click', function (e) { 
         $('.order_status_btn').addClass("filter_active");   
            Dtable.draw();
      });
            $("#seller_name").keyup(function() { // Bind to the keyup event of the textbox
      var searchText = $(this).val(); // Get the text entered in the textbox
      $.ajax({
        url: base_url + 'accounts/get_seller_name',
        type: "POST",
        data: { search_text: searchText }, // Pass the search text to the PHP script
        success: function(response) {
          $(".check_box").html(response); // Bind the response data to the checkbox container
          Dtable.draw();
        }
      });     
    });

    $('.seller_reset').click(function () {
      $('.seller_name_btn ').removeClass("filter_active");
         $('.seller_name_btn').text("Seller Name");  
         $("#seller_name").val('');
         $('.check_box input:checked').removeAttr('checked');
         $('#seller_name').trigger('keyup');
     // 
    });

    $('.shipping_status_reset').click(function () {
      $('.shipping_status_name_btn').removeClass("filter_active");
         $('.shipping_status_name_btn').text("Shipping Status");  
         $("#shipping_status").val('');
        // $('.seat_category_check_box input:checked').removeAttr('checked');
         $('.seat_category_check_box input:checked').prop('checked', false);

      //   $('#shipping_status').trigger('keyup');
      // Dtable.draw();
     // 
    });

        $('.order_status_reset').click(function () {
         $('.order_status_btn').removeClass("filter_active");   
         $('.order_status_btn').text("Order Status");  
         $("#order_status").val('');
        // $('.seat_category_check_box input:checked').removeAttr('checked');
         $('.order_status_check_box input:checked').prop('checked', false);

      //   $('#order_status').trigger('keyup');
      // Dtable.draw();
     // 
    });

    $("#shipping_status").keyup(function() { // Bind to the keyup event of the textbox
      var searchText = $(this).val(); // Get the text entered in the textbox
      $.ajax({
        url: base_url + 'game/get_shipping_status',
        type: "POST",
        data: { search_text: searchText }, // Pass the search text to the PHP script
        success: function(response) {
          $(".seat_category_check_box").html(response); // Bind the response data to the checkbox container
        //  Dtable.draw();
        }
      });     
    });

    $("#seller_name").keyup(function() { // Bind to the keyup event of the textbox
      var searchText = $(this).val(); // Get the text entered in the textbox
      $.ajax({
        url: base_url + 'game/get_shipping_status',
        type: "POST",
        data: { search_text: searchText }, // Pass the search text to the PHP script
        success: function(response) {
          $(".seat_category_check_box").html(response); // Bind the response data to the checkbox container
        //  Dtable.draw();
        }
      });     
    });


    $("#order_status").keyup(function() { // Bind to the keyup event of the textbox
      var searchText = $(this).val(); // Get the text entered in the textbox
      $.ajax({
        url: base_url + 'game/get_order_status',
        type: "POST",
        data: { search_text: searchText }, // Pass the search text to the PHP script
        success: function(response) {
          $(".order_status_check_box").html(response); // Bind the response data to the checkbox container
          Dtable.draw();
        }
      });     
    });

    

    $(".check_box").change(function() { 
         var checkedCount = $('.check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.seller_name_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.seller_name_btn').text("Seller Name");  
            
         });  

         

         $('.clear_all').click(function () {
            $('.order_id_search_filter').removeClass("filter_active");
            $('.event_name_filter').removeClass("filter_active");
            $('.seller_name_btn').removeClass("filter_active");
            $('.date_search_filter').removeClass("filter_active");
            $('.shipping_status_name_btn').removeClass("filter_active");
            $('.order_status_btn').removeClass("filter_active");   


         $("#booking_no").val('');
       //$("#seller_name").val('');
         $("#event_name").val('');        
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         $('.order_status_check_box input:checked').prop('checked', false);
       
       
         // $('.seller_reset').trigger('click');
         // $('.shipping_status_reset').trigger('click');         
         // $('.category_reset').trigger('click');
         // $('.order_status_reset').trigger('click');
         
        
        // $('.seat_category_check_box input:checked').removeAttr('checked');
         
         // trigger your desired action here
       // Dtable.draw();

      });

        });
    

function OrderFilter(){ alert();
        

     }
     function md5(string) {
  var hexDigits = "0123456789abcdef";
  var message = "";

  for (var i = 0; i < string.length; i++) {
    var charCode = string.charCodeAt(i);
    message += String.fromCharCode(charCode & 0xff, (charCode >> 8) & 0xff);
  }

  var wordArray = [];
  for (var j = 0; j < message.length * 8; j += 8) {
    wordArray[j >> 5] |= (message.charCodeAt(j / 8) & 0xff) << (j % 32);
  }

  var md5Hash = "";
  for (var k = 0; k < wordArray.length; k++) {
    var word = wordArray[k];
    for (var l = 0; l < 4; l++) {
      md5Hash +=
        hexDigits.charAt((word >> (l * 8 + 4)) & 0x0f) +
        hexDigits.charAt((word >> (l * 8)) & 0x0f);
    }
  }

  return md5Hash;
}

//'<button type="button" class="btn btn-tbl-card-action">Save</button>'+
       </script>
