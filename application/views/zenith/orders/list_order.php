<style>
   .ticket_table {color:#1A1919 !important;display: block;overflow-x: auto;}
   .delivery_inpt_error {border-color: #ff5c75 !important;}
   .edit_hide,.edit_hide_nominee{display: none;}
   .save_btnn {display: none;}
   .order_status_check_box {padding: 0 15px;margin-top: 15px;margin-bottom: 15px;}
   .seller_status_check_box {padding: 0 15px;margin-top: 15px;margin-bottom: 15px;}
   .check_box, .seat_category_check_box, .order_status_check_box, .seller_status_check_box {max-height: 250px;overflow-y: auto;}
   .highlighted {color: #0037D5 !important;}
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
                                                      <div class="reset_txt"><button class="btn btn-info order_reset">Reset</button></div>
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
                                                      <div class="reset_txt"><button class="btn btn-info event_reset">Reset</button></div>
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
                                                      <div class="reset_txt"><button class="btn btn-info reset_date">Reset</button></div>
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
                                              <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle seller_status_btn" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Seller status <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="seller_status"></label></div>
                                                   </div>
                                                   <div class="seller_status_check_box">
                                                       
                                                        <?php 
                                                            echo $this->data['seller_status'];
                                                        ?>
                                                      </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info seller_status_reset" >Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info seller_status_search">Search</button></div>
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
                        <div class="table-responsive booking_file_page">
                              <table style='width:100% !important' id="all-orders" class="table bo-table w-100 dataTable no-footer">
                                 <thead class="thead-light">
                                    <tr>
                                       <th>&nbsp;</th>
                                       <th>Order ID</th>
                                       <th class="wid_50">Event Name</th>
                                       <th class="wid_50">Event Date</th>
                                       <th class="wid_50">Buyer</th>
                                       <th>Ticket Type</th>
                                       <th>Tickets</th>
                                       <th>Category</th>
                                       <th>Total Ticket(s) Price</th>
                                       <th>Total Buyer Value</th>
                                       <th>Purchase Date</th>
                                       <th>Seller Name</th>
                                       <th class="wid_50">Delivery Date</th>
                                       <th class="wid_50">Shipping Status</th>
                                       <th class="wid_50">Admin Status</th>
                                     
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
    <!-- <script src="<?php //echo base_url(); ?>assets/zenith_assets/v1/js/rome.js"></script> -->
 <script type="text/javascript">
      $(document).ready(function () {

         $("body").on("change",".seller_order_status",function(e){
         // $('.seller_order_status').on('click',function (e){
  e.preventDefault();
      var bg_id = $(this).data('bg-id');
    var seller_status = $("#seller_order_status_"+bg_id+" option:selected").val();

    $.ajax({
      url: base_url + 'game/orders/update_seller_status',
      method: "POST",
      data: { "bg_id": bg_id, "seller_status": seller_status },
      dataType: 'json',
      success: function (result) {

        if (result) {

          swal('Updated !', result.msg, 'success');

        }
        else {
          swal('Updation Failed !', result.msg, 'error');

        }

        
      }
    });


  });

       //  $('.status_change').on('change', function() {
            $(document).on("change", ".status_change", function() {
            //   alert('entered');
    var bookingId = $(this).data('status-booking-id');
    var selectedValue = $(this).val();

    $.ajax({
            url: '<?php echo base_url();?>game/get_encrpty_id ',
            type: 'POST',
            dataType: "json",
            data: {  booking_id: bookingId  },
            success: function (response) {        
                   //  window.location.href = '<?php //echo base_url(); ?>game/orders/upload_e_ticket/'+response.msg
                   update_booking_all_order_status(response.msg, selectedValue,bookingId);
                  
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
    if(orderId=="")
              {
               swal('Error!', "No tickets found", 'error');
              }
              else
              {
    
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
            }

    


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


/*      $('.tbl-toggle-row').on('click', function(){
                if ($(this).hasClass('show')) {
                    $(this).removeClass('show');
                    $(this).parent('tr').next('.tbl-collapsed-row').removeClass('show');
                }else{
                    $('.tbl-toggle-row').removeClass('show');
                    $('.tbl-collapsed-row').removeClass('show');
                    $(this).addClass('show');
                    $(this).parent('tr').next('.tbl-collapsed-row').addClass('show');
                }
            });*/
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
      
     

       var order = d.order_data;
       countries=d.countries;
       encrpty_bg_id=d.encrpty_bg_id;
       cities=d.cities;

       var order_seller_notes = '';
       var order_block_row = '';
       var discount_amount = '0.00';
       var partner_amount = '0.00';
       var delivery_status = "";
       var ticket_status = "";
       var order_nominees = "";

       var file_upload_area = "";
        $.ajax({
         
          url: '<?php echo base_url(); ?>game/booking_ticket_items',
          type: 'POST',
          data: { 'bg_id': d.order_data.bg_id }, 
          dataType : 'JSON',
          async: false,  
          success:function(data) {
             file_upload_area = data.response; 
              
          }
       });


       if(order.seller_notes != ""){

        if(order.seller_notes?.length !== 0){
            $.each(order.seller_notes, function (key, val) {
                order_seller_notes += val.ticket_name+', ';
            });
        }
        else{
        order_seller_notes = 'NA';
        }
        }
        else{
        order_seller_notes = 'NA';
        }
        
        if(order_seller_notes!='NA')
          order_seller_notes = order_seller_notes.replace(/,\s*$/, '.');

        if(order.ticket_block != ""){
            order_block_row = order.ticket_block;
            if(order.row != ""){
                order_block_row += ','+order.row;
            }
        }
        else{
        order_block_row = 'Any';
        }

        if(order.discount_amount != "" && order.discount_amount != null){
            discount_amount = order.discount_amount;
        }
        if(order.partner_fee != "" && order.partner_fee != 0){
            partner_amount = order.partner_fee;
        }
            
         order.check_in_out = order.check_in_out == null ? "" : order.check_in_out;
         order.hotel_ref = order.hotel_ref == null ? "" : order.hotel_ref;
         order.delivery_method = order.delivery_method == null ? "" : order.delivery_method;
   
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
        download_id="";
        if(order.delivery_status != 0)
         {
            download_id=order.bg_id;
         }

         var selectBox = '';

         if (<?php echo $this->session->userdata("role") == 6 ? 'true' : 'false'; ?>) {
         selectBox += '<select class="form-select me-2 status_change" style="width: 40%;" data-status-booking-id=' + order.bg_id + '>';

         if (order.booking_status != 0 && order.booking_status != 7 && order.booking_status != 3) {
            selectBox += '<option ' + (2 == order.booking_status ? 'selected ' : '') + 'value="2">Pending</option>';
            selectBox += '<option ' + (1 == order.booking_status ? 'selected ' : '') + 'value="1">Confirmed</option>';
         }

         if (<?php echo $this->session->userdata("role") == 6 ? 'true' : 'false'; ?>) {
            selectBox += '<option ' + (0 == order.booking_status ? 'selected ' : '') + 'value="0">Failed</option>';
            selectBox += '<option value="3" ' + (3 == order.booking_status ? 'selected' : '') + '>Cancelled</option>';

            if ( order.booking_status != 0 && order.booking_status != 7 && order.booking_status != 3 ) {
               selectBox += '<option ' + (4 == order.booking_status ? 'selected ' : '') + 'value="4">Shipped</option>';
               selectBox += '<option ' + (5 == order.booking_status ? 'selected ' : '') + 'value="5">Delivered</option>';
               selectBox += '<option ' + (6 == order.booking_status ? 'selected ' : '') + 'value="6">Downloaded</option>';
            }
         }

         selectBox += '</select>';
         }


         var booking_selectBox = '';

        // if (<?php echo $this->session->userdata("role") == 6 ? 'true' : 'false'; ?>) {
         booking_selectBox += '<select name="delivery_status" class="custom-select me-2 status_change" data-status-booking-id=' + order.bg_id + '>';

         if (order.booking_status != 0 && order.booking_status != 7 && order.booking_status != 3) {
            booking_selectBox += '<option ' + (2 == order.booking_status ? 'selected ' : '') + 'value="2">Pending</option>';
            booking_selectBox += '<option ' + (1 == order.booking_status ? 'selected ' : '') + 'value="1">Confirmed</option>';
         }

        // if (<?php echo $this->session->userdata("role") == 6 ? 'true' : 'false'; ?>) {
            booking_selectBox += '<option ' + (0 == order.booking_status ? 'selected ' : '') + 'value="0">Failed</option>';
            booking_selectBox += '<option value="3" ' + (3 == order.booking_status ? 'selected' : '') + '>Cancelled</option>';

            if ( order.booking_status != 0 && order.booking_status != 7 && order.booking_status != 3 ) {
               booking_selectBox += '<option ' + (4 == order.booking_status ? 'selected ' : '') + 'value="4">Shipped</option>';
               booking_selectBox += '<option ' + (5 == order.booking_status ? 'selected ' : '') + 'value="5">Delivered</option>';
               booking_selectBox += '<option ' + (6 == order.booking_status ? 'selected ' : '') + 'value="6">Downloaded</option>';
            }
         //}

         booking_selectBox += '</select>';
         //}


         //console.log(selectBox);

            var Country_selectBox = '';        
            var city_id="";
            Country_selectBox += '<select class="custom-select" id="country_' + order.bg_id + '" name="country" onchange="get_booking_state_city(this.value, \'\', ' + order.bg_id + ');" required>';

           for (var i = 0; i < countries.length; i++) {
            var option = countries[i];
            Country_selectBox += '<option  ' + (option.name == order.country_name ? 'selected ' : '') + 'value="' + option.id + '">' + option.name + '</option>';
            }

            Country_selectBox += '</select>';


            var City_selectBox = '';        
            City_selectBox += '<select class="custom-select" id="city_'+ order.bg_id +'" name="city"  required>';
          for (var i = 0; i < cities.length; i++) {
            var option = cities[i];
            City_selectBox += '<option  ' + (option.name == order.city_name ? 'selected ' : '') + 'value="' + option.id + '">' + option.name + '</option>';
            }

            City_selectBox += '</select>';


            var Delivery_Status_selectBox = '<select class="custom-select" id="delivery_status_order_' + order.bg_id + '" name="delivery_status" required>';

            Delivery_Status_selectBox += '<option value="0" ' + (order.delivery_status === "0" ? 'selected' : '') + '>Tickets Not Uploaded </option>';
            Delivery_Status_selectBox += '<option value="1" ' + (order.delivery_status === "1" ? 'selected' : '') + '>Tickets In-Review </option>';
            Delivery_Status_selectBox += '<option value="2" ' + (order.delivery_status === "2" ? 'selected' : '') + '>Tickets Approved </option>';
            Delivery_Status_selectBox += '<option value="3" ' + (order.delivery_status === "3" ? 'selected' : '') + '>Tickets Rejected </option>';
            Delivery_Status_selectBox += '<option value="4" ' + (order.delivery_status === "4" ? 'selected' : '') + '>Tickets Downloaded </option>';
            Delivery_Status_selectBox += '<option value="5" ' + (order.delivery_status === "5" ? 'selected' : '') + '>Tickets Shipped </option>';
            Delivery_Status_selectBox += '<option value="6" ' + (order.delivery_status === "6" ? 'selected' : '') + '>Tickets Delivered </option>';

            Delivery_Status_selectBox += '</select>';

            var seller_selectBox = '<select class="custom-select seller_order_status" id="seller_order_status_' + order.bg_id + '"  required data-bg-id="'+order.bg_id+'">';
            seller_selectBox += '<option value="0" ' + (order.seller_status === "0" ? 'selected' : '') + '>Processing </option>';
            seller_selectBox += '<option value="1" ' + (order.seller_status === "1" ? 'selected' : '') + '>Completed </option>';
            seller_selectBox += '<option value="2" ' + (order.seller_status === "2" ? 'selected' : '') + '>Issue </option>';
            seller_selectBox += '<option value="3" ' + (order.seller_status === "3" ? 'selected' : '') + '>Get Paid </option>';
            seller_selectBox += '</select>';


    if(order.nominees != ""){

     
        //if(order.nominees.length > 0){
            if(order.nominees?.length !== 0){
            $.each(order.nominees, function (key, val) {
               
                //if(val.first_name != null){
                  var email = val.email != null ? val.email : 'N/A';
                  var nationality = val.nationality != null ? val.nationality : 'N/A';
                  var fullname = val.first_name != null ? val.first_name+' '+val.last_name : 'N/A';
                  var dob = val.dob != null ? val.dob.replace(/-/g, '/') : 'N/A';
                  var nominee_action_edit = '<span class="edit_btnn" data-bg-id="'+val.id+'"><a href="javascript:void(0)" id="edit_nominee_'+val.id+'">Edit</a></span>';
                  var nominee_action_save = '<span class="save_btnn" data-bg-id="'+val.id+'" id="save_nominee_'+val.id+'"><a href="javascript:void(0)">Save</a></span>';
                  /*var nominee_action_edit = val.first_name != null ? '<span class="edit_btnn" data-bg-id="'+val.id+'"><a href="javascript:void(0)" id="edit_nominee_'+val.id+'">Edit</a></span>' : 'N/A';
                  var nominee_action_save = val.first_name != null ? '<span class="save_btnn" data-bg-id="'+val.id+'" id="save_nominee_'+val.id+'"><a href="javascript:void(0)">Save</a></span>' : 'N/A';*/
 
                  
                    order_nominees += '<tr class="edit_tr">'+
                    '<td><span class="edit_text" id="nominee_name_show_'+val.id+'">'+fullname+'</span> <span class="edit_box edit_hide" ><input type="text" class="form-control"  value="'+fullname+'" placeholder="Name" id="nominee_name_'+val.id+'"></span>'+
                    '<td><span class="edit_text" id="nominee_dob_show_'+val.id+'">'+dob+'</span> <span class="edit_box edit_hide" ><input type="text" class="form-control attendee_date"  value="'+dob+'" placeholder="Date of Birth" id="nominee_dob_'+val.id+'"></span>  </td>'+
                    '<td><span class="edit_text" id="nominee_nationality_show_'+val.id+'">'+nationality+'</span>  <span class="edit_box edit_hide" ><input type="text" class="form-control"  value="'+nationality+'" placeholder="Nationality" id="nominee_nationality_'+val.id+'"></span></td>'+
                    '<td>'+nominee_action_edit+'</td><td>'+nominee_action_save+'</td></tr>';

                  //   order_nominees += '<tr class="edit_tr">'+
                  //   '<td>'+val.first_name+' '+val.last_name+'<span class="edit_box edit_hide_nominee" ><input type="text" class="form-control"  value="" placeholder="18/12/1992"></span></td>'+
                  //   '<td>'+dob+'</td>'+
                  //   '<td>'+email+'</td>'+
                  //   '<td>'+nominee_action_edit+'</td>'+
                  //   '<td>'+nominee_action_save+'</td>'+
                  //   '</tr>';
                /*}
                else{
                    order_nominees = '<tr><td colspan="3">NA</td></tr>';
                }*/
                
            });
        }
        else{
        order_nominees = '<tr><td colspan="3">NA</td></tr>';
        }
    }
    else{
         order_nominees = '<tr><td colspan="3">NA</td></tr>';
        }
       

        //delivery_dealine_date=order.delivery_date
var currency_icon = "";
if(order.currency_type == "GBP"){
 currency_icon = "<i class='mdi mdi-currency-gbp'></i>";
}
else if(order.currency_type == "EUR"){
  currency_icon = "<i class='mdi mdi-currency-eur'></i>";
}
else if(order.currency_type == "USD"){
  currency_icon = "<i class='mdi mdi-currency-usd'></i>";
}
else{
  currency_icon = "AED"
}

var team_array = (order.match_name).split(' vs ');
var team_area  = "";
if(team_array[0] != null){
  team_area = team_array[0];
}
   
    // `d` is the original data object for the row
    return (
'<div class="row ml-0">'+
'<div class="col-md-8">'+
'<div class="row">'+
'<div class="col mr-3 card">'+
'<div class="card-body all_height">'+
'<h5>Buyer Info</h5>'+
'<div class="copy_all">'+
'   <div class="copy_icons">'+
'      <a href="javascript:void(0);"><i class="far fa-copy copyBuyerButton" data-bg-id="'+order.bg_id+'"></i></a>'+
'   </div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-6">'+
'Buyer Name:'+
'</label>'+
'<div class="col-md-5 nopad" id="buyer_name_' + order.bg_id + '"><span class="buyer_infor">' +order.customer_first_name + ' ' + order.customer_last_name +'</span></div>'+
'<div class="col-md-1 nopad">'+
   '<a href="javascript:void(0);"><i class="far fa-copy" onclick="copy_data(\'buyer_name_' + order.bg_id + '\', this)"></i></a>'+
'</div>'+                              
'</div>'+
'<div class="row">'+
'<label class="col-md-6">'+
'Buyer Email:'+
'</label>'+
'<div class="col-md-5 nopad" id="buyer_email_' + order.bg_id + '"><span class="buyer_infor">'+order.email+'</span></div>'+
'<div class="col-md-1 nopad">'+
   '<a href="javascript:void(0);"><i class="far fa-copy" onclick="copy_data(\'buyer_email_' + order.bg_id + '\', this)"></i></a>'+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-6">'+
'Phone Number:'+
'</label>'+
'<div class="col-md-5 nopad" id="buyer_mobile_' + order.bg_id + '"><span class="buyer_infor">'+order.dialing_code+" "+order.mobile_no+'</span></div>'+
'<div class="col-md-1 nopad">'+
   '<a href="javascript:void(0);"><i class="far fa-copy" onclick="copy_data(\'buyer_mobile_' + order.bg_id + '\', this)"></i></a>'+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-6">'+
'Alternative Phone:'+
'</label>'+
'<div class="col-md-5 nopad" id="buyer_mobile_alter_' + order.bg_id + '"><span class="buyer_infor">'+order.dialing_code+" "+order.mobile_no+'</span></div>'+
'<div class="col-md-1 nopad">'+
   '<a href="javascript:void(0);"><i class="far fa-copy" onclick="copy_data(\'buyer_mobile_alter_' + order.bg_id + '\', this)"></i></a>'+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-6">'+
'Billing Address:'+
'</label>'+
'<div class="col-md-5 nopad" id="buyer_billing_' + order.bg_id + '"><span class="buyer_infor">'/*+
order.billing_first_name+" "+order.billing_last_name+"<br>"*/+order.billing_address+"<br>"+'</span></div>'+
'<div class="col-md-1 nopad">'+
   '<a href="javascript:void(0);"><i class="far fa-copy" onclick="copy_data(\'buyer_billing_' + order.bg_id + '\', this)"></i></a>'+
'</div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-6">'+
'City:'+
'</label>'+
'<div class="col-md-6 nopad" id="buyer_city_' + order.bg_id + '"><span class="buyer_infor">'+
order.city_name+'</span></div>'+
/*'<div class="col-md-2">'+
   '<a href="javascript:void(0);"><i class="far fa-copy" onclick="copy_data(\'buyer_city_' + order.bg_id + '\', this)"></i></a>'+
'</div>'+*/
'</div>'+
'<div class="row">'+
'<label class="col-md-6">'+
'Post / Zip Code:'+
'</label>'+
'<div class="col-md-6 nopad" id="buyer_postal_' + order.bg_id + '"><span class="buyer_infor">'+
order.billing_postal_code+'</span></div>'+
/*'<div class="col-md-2">'+
   '<a href="javascript:void(0);"><i class="far fa-copy" onclick="copy_data(\'buyer_postal_' + order.bg_id + '\', this)"></i></a>'+
'</div>'+*/
'</div>'+
'<div class="row">'+
'<label class="col-md-6">'+
'Country:'+
'</label>'+
'<div class="col-md-6 nopad" id="buyer_country_' + order.bg_id + '"><span class="buyer_infor">'+
order.country_name+'</span></div>'+
/*'<div class="col-md-2">'+
   '<a href="javascript:void(0);"><i class="far fa-copy" onclick="copy_data(\'buyer_country_' + order.bg_id + '\', this)"></i></a>'+
'</div>'+*/
'</div>'+
'<div class="row">'+
'<label class="col-md-6">'+
'Partners:'+
'</label>'+
'<div class="col-md-6 nopad" id="buyer_source_' + order.bg_id + '"><span class="buyer_infor">'+
order.source_type+'</span></div>'+
/*'<div class="col-md-2">'+
   '<a href="javascript:void(0);"><i class="far fa-copy" onclick="copy_data(\'buyer_source_' + order.bg_id + '\', this)"></i></a>'+
'</div>'+*/
'</div>'+
'</div>'+
'</div>'+
'<div class="col mr-3 card">'+
'<div class="card-body all_height">'+
'<h5>Payment Details</h5>'+
'<div class="row">'+
'<label class="col-md-7">'+
'Price/Ticket:'+
'</label>'+
'<div class="col-md-5"><span class="buyer_infor">'+currency_icon+' '+
order.price+/*' '+order.currency_type+*/
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-7">'+
'Quantity:'+
'</label>'+
'<div class="col-md-5"><span class="buyer_infor">'+
order.quantity+
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-7">'+
'Sub Total:'+
'</label>'+
'<div class="col-md-5"><span class="buyer_infor">'+currency_icon+' '+
order.ticket_amount+/*' '+order.currency_type+*/
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-7">'+
'Partner Fee:'+
'</label>'+
'<div class="col-md-5"><span class="buyer_infor">'+currency_icon+' '+
partner_amount+/*' '+order.currency_type+*/
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-7">'+
'Store Fee:'+
'</label>'+
'<div class="col-md-5"><span class="buyer_infor">'+currency_icon+' '+
order.store_fee+/*+' '+order.currency_type+*/
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-7">'+
'Delivery Fee:'+
'</label>'+
'<div class="col-md-5"><span class="buyer_infor">'+currency_icon+' '+
order.delivery_fee+/*+' '+order.currency_type+*/
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-7">'+
'Booking Protect Fee:'+
'</label>'+
'<div class="col-md-5"><span class="buyer_infor">'+currency_icon+' '+
order.premium_price+/*+' '+order.currency_type+*/
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-7">'+
'Total Discount:'+
'</label>'+
'<div class="col-md-5"><span class="buyer_infor">'+currency_icon+' '+
discount_amount+/*+' '+order.currency_type+*/
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-7">'+
'Total Selling Amount:'+
'</label>'+
'<div class="col-md-5"><span class="buyer_infor">'+currency_icon+' '+
order.total_amount+/*+' '+order.currency_type+*/
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-7">'+
'Buyer Currency:'+
'</label>'+
'<div class="col-md-5"><span class="buyer_infor">'+
order.currency_type+
'</span></div>'+
'</div>'+
'</div>'+
'</div>'+
'<div class="col-md-3 mr-3 card">'+
                     '<div class="card-body all_height">'+
                        '<div class="row">'+
                        ' <div class="col-md-12 delivery-select">'+
                        '     <h5>Delivery Status</h5>'+Delivery_Status_selectBox+
                        '  </div>'+
                        '</div>'+
                        '<div class="row">'+
                        '  <div class="col-md-12 delivery-select">'+
                        '     <h5 class="mt-3">Booking Status</h5>'+booking_selectBox+
                        '  </div>'+
                        '</div>'+
                        '<div class="row">'+
                        '  <div class="col-md-12 delivery-select">'+
                        '     <h5 class="mt-3">Seller Order Status</h5>'+seller_selectBox+
                        '  </div>'+
                        '</div>'+
                        '<div class="row">'+
                        '  <div class="col-md-12 delivery-select">'+
                        '     <div class="bo-checkbox mt-3 ml-2">'+
                        '     <input type="checkbox" class="bo-checkbox-input send_email_'+order.booking_id+'" checked="checked" id="checkbox-signin" >'+
                        '     <label class="bo-checkbox-label" for="checkbox-sendmail">Send Mail</label>'+
                        ' </div>'+
                        '  </div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
'</div>'+
'</div>'+
'<div class="col-md-4 ps-0 d-flex flex-column justify-content-between">'+
'<div class="card">'+
'<div class="card-body all_height">'+
'<h5>Event and Ticket Info</h5>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Event Name: '+
'</label>'+
'<div class="col-md-7"><span class="buyer_infor">'+
order.match_name+
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Event Date &amp; Time:'+
'</label>'+
'<div class="col-md-7"><span class="buyer_infor">'+
order.formated_match_time+
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Tournament:'+
'</label>'+
'<div class="col-md-7"><span class="buyer_infor">'+
order.tournament_name+
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Venue:'+
'</label>'+
'<div class="col-md-7"><span class="buyer_infor">'+
order.stadium_name+','+order.city_name+
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Ticket Type:'+
'</label>'+
'<div class="col-md-7"><span class="buyer_infor">'+
order.ticket_type+
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Category:'+
'</label>'+
'<div class="col-md-7"><span class="buyer_infor">'+
order.seat_category+
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Quantity:'+
'</label>'+
'<div class="col-md-7"><span class="buyer_infor">'+
order.quantity+
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Block &amp; Row:'+
'</label>'+
'<div class="col-md-7"><span class="buyer_infor">'+
order_block_row+
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Sellers Notes:'+
'</label>'+
'<div class="col-md-7"><span class="buyer_infor">'+
order_seller_notes+
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'Team Area:'+
'</label>'+
'<div class="col-md-7"><span class="buyer_infor">'+
team_area+
'</span></div>'+
'</div>'+
'<div class="row">'+
'<label class="col-md-5">'+
'<span class="sell_name">Seller Name:</span>'+
'</label>'+
'<div class="col-md-7"><span class="sell_name">'+
order.seller_first_name+' '+order.seller_last_name+
'</span></div>'+
'</div>'+
// '<div class="d-flex justify-content-end mt-5">'+
/*'<button type="button" class="btn btn-primary-outline me-3 mr-2 upload_ticket" data-booking="'+order.bg_id+'" data-org-id='+order.bg_id+' >Upload E-Ticket</button>'
+
'<button type="button" class="btn btn-primary-outline me-3 mr-2 download_e_ticket"  data-booking-id="'+download_id+'" >Download</button>'+*/
'</div>'+
'</div>'+
'</div>'+
'</div>'+
'</div>'+
'</div>'+
'<div class="row ml-0">'+
 '        <div class="col-md-7">'+
'<div class="row">'+
 '<div class="col mr-3 mb-0 card">'+
'<div class="card-body edit_tr_new all_height_down">'+'<h5>Delivery Details</h5>'+
   '<div class="edit_save "> <span class="edit_btnn_new" data-bg-id="'+order.booking_id+'"><a href="javascript:void(0)"   id="edit_'+order.booking_id+'">Edit</a></span> <span class="save_btnn_new" data-bg-id="'+order.booking_id+'" id="save_'+order.booking_id+'"><a href="javascript:void(0)">Save</a></span> </div>'+
   /*'<div class="copy_arrow">'+
   '<div class="arrow_up">'+
   '<div class="image-upload" style="margin-bottom:8px;"> <label for="file-input" class="send_email" id="send_email_'+order.booking_id+'" data-bg-id="'+order.booking_id+'" data-bg-encrpty-id="'+encrpty_bg_id+'"> <img src="<?php //echo base_url(); ?>assets/zenith_assets/img/file_ipload.png"> </label>  </div>'+
   '<a href="javascript:void(0);" class="copyDetails"><i class="far fa-copy copyDeliveryDetails" data-bg-id="'+order.bg_id+'"></i></a> '+
   '</div>'+
   '</div>'+*/
   '<div class="row mt-1">'+
   '<label class="col-md-5"> Method: </label> '+
   '<div class="col-md-6 "> <span class="edit_text_new" id="show_method_'+order.booking_id+'">'+ order.ticket_type+'</span> <span class="edit_box_new edit_hide" > <input id="method_'+order.booking_id+'" type="text" class="form-control" value="'+ order.ticket_type+'" placeholder="Pickup" required></span> </div>'+
   '<div class="col-md-1"></div>'+
   '</div>'+
   '<div class="row mt-1">'+
   '<label class="col-md-5"> <span style="color:#B00505;display: block;">Delivery Deadline:</span> </label>'+'<div class="col-md-6"> <span class="edit_text_new" style="color:#B00505;display: block;" id="inpt_delivery_date_'+order.booking_id+'">'+ order.details_tab_delivery_date+'</span>'+ '<span class="edit_box_new edit_hide" >'+
   
   
   // <span class="edit_box_new edit_hide" style="color:#B00505;" id="delivery_'+order.booking_id+'">'+ order.delivery_date+'</span>

   '<input type="text" class="form-control deadline"  value="'+order.inpt_delivery_dead_line+'" placeholder="Delivery Deadline" id="deadline_'+order.booking_id+'"></span>'+
   
   '</div>'+
    '<div class="col-md-1"></div>'+
   '</div>'+
   '<div class="row mt-1">'+
   '<label class="col-md-5"> Email: </label> '+
   '<div class="col-md-6"> <span class="edit_text_new" id="show_email_'+order.booking_id+'">'+ order.email+'</span> <span class="edit_box_new edit_hide" > <input type="text" id="email_'+order.booking_id+'" class="form-control" value="'+ order.email+'" placeholder="Email"></span> </div>'+
        '<div class="col-md-1 nopad">'+        
          ' <div class="image-upload">'+
               ' <label for="file-input" class="send_email" id="send_email_'+order.booking_id+'" data-bg-id="'+order.booking_id+'" data-bg-encrpty-id="'+encrpty_bg_id+'">'+
' <img src="<?php echo base_url(); ?>assets/zenith_assets/img/file_ipload.png">'+
'</label>'+
       ' </div>'+
       '</div>'+
         '</div>'+
         '<div class="row mt-1">'+
         '<label class="col-md-5"> Name: </label> '+
         '<div class="col-md-6"> <span class="edit_text_new" id="show_name_'+order.booking_id+'"> '+ order.billing_first_name+" "+order.billing_last_name+'</span> <span class="edit_box_new edit_hide" > <input id="name_'+order.booking_id+'" type="text" class="form-control" value="'+ order.billing_first_name+" "+order.billing_last_name+'" placeholder=" Name"></span> </div>'+
         '<div class="col-md-1 nopad">'+
         '<div class="details_copy">'+
         '<a href="javascript:void(0);" class="copyDetails"><i class="far fa-copy copyDeliveryDetails" data-bg-id="'+order.bg_id+'"></i></a>'+
         '</div>'+
         '</div>'+
         '</div>'+
         '<div class="row mt-1">'+
         '<label class="col-md-5"> Address: </label> '+
         '<div class="col-md-6"> <span class="edit_text_new" id="show_address_'+order.booking_id+'">'+order.billing_postal_code+","+order.billing_address+'</span> <span class="edit_box_new edit_hide" > <input id="address_'+order.booking_id+'" type="text" class="form-control" value="'+order.billing_postal_code+","+order.billing_address+'" placeholder="Address"></span> </div>'+
         '<div class="col-md-1"></div>'+
         '</div>'+
         '<div class="row mt-1">'+
         '<label class="col-md-5"> City: </label> '+
         '<div class="col-md-6"> <span class="edit_text_new" id="show_city_'+order.booking_id+'">'+order.city_name+'</span> <span class="edit_box_new edit_hide" >'+City_selectBox+'</span> </div>'+
         '<div class="col-md-1"></div>'+
         '</div>'+
         '<div class="row mt-1">'+
         '<label class="col-md-5"> Postal/Zip Code: </label> '+
         '<div class="col-md-6"> <span class="edit_text_new" id="show_postal_'+order.booking_id+'">'+order.billing_postal_code+'</span> <span class="edit_box_new edit_hide" > <input  id="postal_'+order.booking_id+'" type="text" class="form-control" value="'+order.billing_postal_code+'" placeholder="Postal Code"></span> </div>'+
         '<div class="col-md-1"></div>'+
         '</div>'+
         '<div class="row mt-1">'+
         '<label class="col-md-5"> Country: </label> '+
         '<div class="col-md-6"> <span class="edit_text_new" id="show_country_'+order.booking_id+'">'+order.country_name+'</span> <span class="edit_box_new edit_hide" >'+Country_selectBox+'</span> </div>'+
         '<div class="col-md-1"></div>'+
         '</div>'+
         '<div class="row mt-1">'+
         '<label class="col-md-5"> Check In / Out: </label> '+
         '<div class="col-md-6"> <span class="edit_text_new" id="show_check_in_'+order.booking_id+'">'+order.check_in_out+'</span> <span class="edit_box_new edit_hide" > <input type="text" id="check_in_out_'+order.booking_id+'" class="form-control" value="'+order.check_in_out+'" placeholder="Check In / Out"></span> </div>'+
         '<div class="col-md-1"></div>'+
         '</div>'+
         '<div class="row mt-1">'+
         '<label class="col-md-5"> Hotel Ref: </label> '+
         '<div class="col-md-6"> <span class="edit_text_new" id="show_hotel_ref_'+order.booking_id+'">'+order.hotel_ref+'</span> <span class="edit_box_new edit_hide" > <input type="text" id="hotel_ref_'+order.booking_id+'" class="form-control" value="'+order.hotel_ref+'" placeholder="Hotel Ref"></span> </div>'+
         '<div class="col-md-1"></div>'+
         '</div>'+
         '</div>'+
         '</div><div class="col me-3 mb-0 card all_height_down">'+
'<div class="card-body all_height_down">'+
'<h5>Ticket Holder Details</h5>'+
'<div class="copy_all">'+
' <div class="copy_icons">'+
'    <a href="javascript:void(0);"><i class="far fa-copy copyTicketHolder" data-bg-id="'+order.bg_id+'" ></i></a>'+
' </div>'+
'</div>'+
'<div class="table-responsive ticket_holder " id="ticket_holder_' + order.bg_id + '">'+
'<table class="ticket_table" >'+
'<thead>'+
'<tr>'+
'<th class="wid_60" style="color:#000 !important;font-weight:600;">Name:</th>'+
'<th class="wid_60" style="color:#000 !important;font-weight:600;">DOB:</th>'+
'<th class="wid_60" style="color:#000 !important;font-weight:600;">Nationality:</th>'+
'<th class="wid_60"></th>'+
'<th class="wid_60"></th>'+
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
'</div>'+
'<div class="col-md-5 d-flex flex-column justify-content-between" id="file_upload_area">'+
file_upload_area+
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


    $("body").on('click','.seat_category_check_box,.order_status_check_box,.seller_status_check_box',function(e){
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
$(".seller_status_check_box").change(function() {  
         var checkedCount = $('.seller_status_check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.seller_status_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.seller_status_btn').text("Seller Status");  
            
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
        
        var that = $(this);
        $(that).toggleClass("show");
        $(".tbl-toggle-row.show").not(that).removeClass('show');

        var tr = $(this).closest('tr');

        var tr_parents = $(this).parents('tr');

        var row = Dtable.row(tr);
  // tr.closest('tr').addClass("tbl-collapsed-row child even");
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
        } else {
            // Open this row
            row.child(format(row.data()),'').show();

              scroll_bg_id=row.data().order_data.bg_id;
           console.log("scroll_bg_id : "+scroll_bg_id);
              $("#content_"+scroll_bg_id).mCustomScrollbar({
                scrollButtons:{
                  enable:true
                }
              });
      $("#content_ticket_upload_"+scroll_bg_id).mCustomScrollbar({
                scrollButtons:{
                  enable:true
                }
              });

        $("#TopAirLine_new").owlCarousel({
 
                        autoPlay: 500, //Set AutoPlay to 3 seconds
                   
                        items : 3,
                        itemsDesktop : [1199,2],
                        itemsDesktopSmall : [979,2],
                        nav:true,
                        pagination:false,
                        dots: false
                    });
                   $( ".owl-prev").html('<i class="fas fa-arrow-left"></i>');
                   $( ".owl-next").html('<i class=" fas fa-arrow-right"></i>');

            tr_parents.next().addClass("tbl-collapsed-row child even show");
            scroll_bg_id=row.data().order_data.bg_id;
            $("#ticket_holder_"+scroll_bg_id).mCustomScrollbar({
                scrollButtons:{
                  enable:true
                }
              });

        } 
         $(".tbl-collapsed-row.show").not(that.parent('tr').next()).removeClass('show');
    });
          

            
          var overlay = $('#overlay');
          var Dtable =  $('#all-orders').DataTable({

         //scrollX: !0,

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

               var sellerStatus = [];
               $(".seller_status_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("seller_status", "");     

                  sellerStatus.push(newID);
               });
               

               d.booking_no = booking_no;
             //  d.seller_name = seller_name;
          //   d.shipping = shippingID;
               d.event = event_name;
             //  d.order_status = order_status;
               d.shipping_status = shippingID;
               d.order_status = orderStatusID;
               d.seller_status = sellerStatus;
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
          
      language: {
            paginate: {
               previous: "<i class='mdi mdi-chevron-left'>",
               next: "<i class='mdi mdi-chevron-right'>"
            },
        
         },

        drawCallback: function () {

$(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
},
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
       //  Dtable.draw();
       applyFilters();
      });

      $('.event_search_ok').on('click', function (e) {
         $('.event_name_filter').addClass("filter_active");
         //Dtable.draw();
         applyFilters();
      });

      $('#order_status a').on('click', function (e) {
         $('#order-status-hidden').data('status-hidden', $(this).data('order-status'));
       //  Dtable.draw();
       applyFilters();
      });

      $('#seller_status a').on('click', function (e) {
         $('#seller-status-hidden').data('status-hidden', $(this).data('seller-status'));
       //  Dtable.draw();
       applyFilters();
      });

      $('#shipping_status a').on('click', function (e) {
         $('#shipping-status-hidden').data('shipping-status-hidden', $(this).data('shipping-status'));
        // Dtable.draw();
        applyFilters();
      });

      $('.shipping_status_search').on('click', function (e) {  
         $('.shipping_status_name_btn').addClass("filter_active");

              //  Dtable.draw();
              applyFilters();
            });

      // $('.reset_txt').click(function () {
      //    $("#booking_no").val('');
      //    $("#seller_name").val('');
      //    $("#event_name").val('');
      //    $('#order-status-hidden').data('status-hidden', "");
      //    $('#shipping-status-hidden').data('shipping-status-hidden', "");
      //    $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
      //    $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
      //    // trigger your desired action here
      //    Dtable.draw();

      // });



       // Get the datepicker input element
       const datepicker = document.getElementById('MyTextbox2');
      const to_datepicker = document.getElementById('MyTextbox3');

      // Initialize the datepicker
      $(datepicker).datepicker({
         // onSelect: function (datesel) {
         //    $('#MyTextbox2').trigger('change')
         // }, maxDate: new Date()
          dateFormat: 'dd/mm/yy' ,
         changeMonth:true,
         changeYear:true,
      }
      );
      $(to_datepicker).datepicker(
         { dateFormat: 'dd/mm/yy' ,
         changeMonth:true,
         changeYear:true,}
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

         //Dtable.draw();
         applyFilters();

      });

      $('.seller_search').on('click', function (e) {    
         $('.seller_name_btn').addClass("filter_active");
               // Dtable.draw();
               applyFilters();
            });
      $('.order_status_search').on('click', function (e) { 
         $('.order_status_btn').addClass("filter_active");   
          //  Dtable.draw();
          applyFilters();
      });
      $('.seller_status_search').on('click', function (e) { 
         $('.seller_status_btn').addClass("filter_active");   
          //  Dtable.draw();
          applyFilters();
      });
       $('.seller_status_search').on('click', function (e) { 
         $('.seller_status_search').addClass("filter_active");   
          //  Dtable.draw();
          applyFilters();
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
      updateFilters("seller_name");
      $('.seller_name_btn ').removeClass("filter_active");
         $('.seller_name_btn').text("Seller Name");  
         $("#seller_name").val('');
         $('.check_box input:checked').removeAttr('checked');
         $('#seller_name').trigger('keyup');
         $('.dropdown-menu-custom, .dropdown').each(function() {
            $(this).removeClass('show');
         });
     // 
    });

    $('.shipping_status_reset').click(function () {
      updateFilters("seller_name");
      $('.shipping_status_name_btn').removeClass("filter_active");
         $('.shipping_status_name_btn').text("Shipping Status");  
         $("#shipping_status").val('');
        // $('.seat_category_check_box input:checked').removeAttr('checked');
         $('.seat_category_check_box input:checked').prop('checked', false);

      //   $('#shipping_status').trigger('keyup');
      // Dtable.draw();
     // 
     $('.dropdown-menu-custom, .dropdown').each(function() {
         $(this).removeClass('show');
      });
    });

        $('.order_status_reset').click(function () {
         updateFilters("order");
         $('.order_status_btn').removeClass("filter_active");   
         $('.order_status_btn').text("Order Status");  
         $("#order_status").val('');
        // $('.seat_category_check_box input:checked').removeAttr('checked');
         $('.order_status_check_box input:checked').prop('checked', false);

      //   $('#order_status').trigger('keyup');
      // Dtable.draw();
      $('.dropdown-menu-custom, .dropdown').each(function() {
         $(this).removeClass('show');
      });
     // 
    });

        $('.seller_status_reset').click(function () {
         updateFilters("sellerstatus");
         $('.seller_status_btn').removeClass("filter_active");   
         $('.seller_status_btn').text("Order Status");  
         $("#seller_status").val('');
        // $('.seat_category_check_box input:checked').removeAttr('checked');
         $('.seller_status_check_box input:checked').prop('checked', false);

      //   $('#order_status').trigger('keyup');
      // Dtable.draw();
      $('.dropdown-menu-custom, .dropdown').each(function() {
         $(this).removeClass('show');
      });
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

    
    $("#seller_status").keyup(function() { // Bind to the keyup event of the textbox
      var searchText = $(this).val(); // Get the text entered in the textbox
      $.ajax({
        url: base_url + 'game/get_seller_status',
        type: "POST",
        data: { search_text: searchText }, // Pass the search text to the PHP script
        success: function(response) {
          $(".seller_status_check_box").html(response); // Bind the response data to the checkbox container
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
            resetFilters();

            $('.dropdown-menu-custom, .dropdown').each(function() {
            $(this).removeClass('show');
         });

         $('.seller_name_btn').text("Seller Name");
         $('.shipping_status_name_btn').text("Shipping Status"); 
         $('.order_status_btn').text("Order Status"); 
         $('.seller_status_btn').text("Seller Status");  

            $('.order_id_search_filter').removeClass("filter_active");
            $('.event_name_filter').removeClass("filter_active");
            $('.seller_name_btn').removeClass("filter_active");
            $('.date_search_filter').removeClass("filter_active");
            $('.shipping_status_name_btn').removeClass("filter_active");
            $('.order_status_btn').removeClass("filter_active"); 
            $('.seller_status_btn').removeClass("filter_active");   


         $("#booking_no").val('');
       //$("#seller_name").val('');
         $("#event_name").val('');        
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         $('input:checked').prop('checked', false);
        Dtable.draw();

      });

      $('.reset_date').click(function () { 
         $('.date_search_filter').removeClass("filter_active");
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         updateFilters("fromDate");
         updateFilters("toDate");
         Dtable.ajax.reload();
         $('.dropdown-menu-custom').removeClass('show');
         $('.dropdown').removeClass('show');         
      });


      $('.order_reset').click(function () {          
         $('.order_id_search_filter').removeClass("filter_active");
         $("#booking_no").val(''); // clear selected date value
         updateFilters("booking_no");
         Dtable.ajax.reload(); 
      });

      $('.event_reset').click(function () {          
         $('.event_name_filter').removeClass("filter_active");
         $("#event_name").val(''); // clear selected date value
         updateFilters("event_name");
         Dtable.ajax.reload(); 
      });    


      function applyFilters() {
         var checkedIds = [];
               $(".check_box input:checked").each(function () {
                  checkedIds.push($(this).attr('id'));
               });
               var shippingIds = [];
               $(".seat_category_check_box input:checked").each(function () {
                  shippingIds.push( $(this).attr('id'));
               });
               var orderIds = [];
               $(".order_status_check_box input:checked").each(function () {
                  orderIds.push($(this).attr('id'));
               });
               var sellerStatus = [];
               $(".seller_status_check_box input:checked").each(function () {
                  sellerStatus.push($(this).attr('id'));
               });
            const fromDate = document.getElementById('MyTextbox3').value;
            const toDate = document.getElementById('MyTextbox2').value;
            const booking_no=document.getElementById('booking_no').value;
            const event_name=document.getElementById('event_name').value;            
            const seller_name=checkedIds;
            const shipping=shippingIds;
            const order=orderIds;
            const seller=sellerStatus;

            var filters = {
               booking_orders_fromDate: fromDate,
               booking_orders_toDate: toDate,
               booking_orders_booking_no: booking_no,
               booking_orders_event_name: event_name,
               booking_orders_seller_name: seller_name,
               booking_orders_shipping: shipping,
               booking_orders_order: order,
               booking_orders_seller_status: seller
            // ... Add other filters
            };
            sessionStorage.setItem('booking_orders', JSON.stringify(filters));
          Dtable.draw();        
         
}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
                        booking_orders_fromDate: "",
                        booking_orders_toDate: "",
                        booking_orders_booking_no: "",
                        booking_orders_event_name: "",
                        booking_orders_seller_name: "",
                        booking_orders_shipping: "",
                        booking_orders_order: "",
                        booking_orders_seller_status: ""
                     // ... Add other filters
                     };
                     sessionStorage.setItem('booking_orders', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('booking_orders');
   
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
      var fromDateValue = filters.booking_orders_fromDate;
      var toDateValue = filters.booking_orders_toDate;
      var booking_no = filters.booking_orders_booking_no;
      var event_name = filters.booking_orders_event_name;
      var seller_name =filters.booking_orders_seller_name;
      var shipping =filters.booking_orders_shipping;
      var order =filters.booking_orders_order;
      var seller =filters.booking_orders_seller_status;

      
$(".seat_category_check_box input[type='checkbox'], .check_box input[type='checkbox'] ,.order_status_check_box input[type='checkbox'], .seller_status_check_box input[type='checkbox']").each(function() {
  var ID = $(this).attr('id');
  
  if ($(this).closest('.seat_category_check_box').length) {
    // Checkbox belongs to the seat category group
    if (shipping.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  } else if ($(this).closest('.check_box').length) {
    // Checkbox belongs to the seller name group
    if (seller_name.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  }
  else if ($(this).closest('.order_status_check_box').length) {
    // Checkbox belongs to the seller name group
    if (order.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  }
  else if ($(this).closest('.seller_status_check_box').length) {
    // Checkbox belongs to the seller name group
    if (seller.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  }
});

      $('#MyTextbox3').val(fromDateValue);
      $('#MyTextbox2').val(toDateValue);
      $('#booking_no').val(booking_no);
      $('#event_name').val(event_name);

      if ((fromDateValue && toDateValue)) {
         $('.date_search_filter').addClass("filter_active");
      }
      if(booking_no)
      {
         $('.order_id_search_filter ').addClass("filter_active");
      }
      if(event_name)
      {
         $('.event_name_filter ').addClass("filter_active");
      }      
      if (seller_name && seller_name.length > 0) {
         $('.seller_name_btn').addClass("filter_active");
         $('.seller_name_btn').text(seller_name.length + " Selected");
      }
      if (shipping && shipping.length > 0) {
         $('.shipping_status_name_btn').addClass("filter_active");
         $('.shipping_status_name_btn').text(shipping.length + " Selected");
      }

      if (order && order.length > 0) {
         $('.order_status_btn').addClass("filter_active");
         $('.order_status_btn').text(order.length + " Selected");
      }
      if (seller && seller.length > 0) {
         $('.seller_status_btn').addClass("filter_active");
         $('.seller_status_btn').text(seller.length + " Selected");
      }

//Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('booking_orders'));

  // Check if sales_summary_seller_name has a value
  if (filters["booking_orders_" + argName] && filters["booking_orders_" + argName] !== "") {
    // Clear the remaining values while keeping the existing booking_orders_seller_name value
    filters["booking_orders_" + argName] = "";
    filters = {
      booking_orders_fromDate: filters.booking_orders_fromDate,
      booking_orders_toDate: filters.booking_orders_toDate,
      booking_orders_booking_no: filters.booking_orders_booking_no,
      booking_orders_event_name: filters.booking_orders_event_name,
      booking_orders_seller_name: filters.booking_orders_seller_name,
      booking_orders_shipping: filters.booking_orders_shipping,
      booking_orders_order: filters.booking_orders_order,
       booking_orders_seller_status: filters.booking_orders_seller_status,
    };
  }

  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('booking_orders', JSON.stringify(filters));
}


        });
    

function OrderFilter(){ 
        

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

function copy_data(id, element){
   console.log(id);
   console.log(element);
    element.classList.add('highlighted');
   var copyText = document.getElementById(id);
   var textArea = document.createElement("textarea");
  textArea.value = ((copyText.textContent).trim());
  document.body.appendChild(textArea);
  textArea.select();
  document.execCommand("Copy");
  textArea.remove();
  //alert("Copied Successfully.");

  }
//


$("body").on("click",".edit_btnn_new",function(){

   const datepicker = document.getElementsByClassName('deadline');
  $(datepicker).datepicker({
          dateFormat: 'dd/mm/yy' ,
           changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
      // maxDate:0

      }
      );

         /*$(this).parents(".edit_tr_new").find(".edit_box_new").show();
         $(this).parents(".edit_tr_new").find(".edit_text_new").hide();*/

         var order_id = $(this).attr('data-bg-id');
         // $('#save_'+order_id).toggle();
         $(this).parents(".edit_tr_new").find(".edit_box_new").toggle();
         $(this).parents(".edit_tr_new").find(".edit_text_new").toggle();
      });

$("body").on("click",".edit_btnn",function(){

   const datepicker = document.getElementsByClassName('attendee_date');
  $(datepicker).datepicker({
          dateFormat: 'dd/mm/yy' ,
           changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
      maxDate:0

      }
      );
      
          $(this).parents(".edit_tr").find(".edit_box").toggle();
        $(this).parents(".edit_tr").find(".edit_text").toggle();

         var order_id = $(this).attr('data-bg-id');
        $('#save_nominee_'+order_id).toggle();
      });

      $("body").on("click", ".save_btnn", function () {
  var order_id = $(this).data('bg-id');
  var fields = ["name", "dob", "nationality"];
  var errorMessage = "";

  function validateField(field) {
    var value = $("#nominee_" + field + "_" + order_id).val();
    if (value === "") {
      errorMessage += field + " is empty.\n";
      $("#nominee_" + field + "_" + order_id).addClass('delivery_inpt_error');
    } else {
      $("#nominee_" + field + "_" + order_id).removeClass('delivery_inpt_error');
    }
  }

  fields.forEach(validateField);

  if (errorMessage !== "") {
    return false;
  }

  var data = {
    nominee_id: order_id,
    nominee_name: $("#nominee_name_" + order_id).val(),
    nominee_dob: $("#nominee_dob_" + order_id).val(),
    nominee_nationality: $("#nominee_nationality_" + order_id).val()
  };

  $.ajax({
    url: '<?php echo base_url(); ?>game/update_nominee',
         type: 'POST',
         dataType: "json",
         data: data,
         success: function (response) {
            if (response.status == 0) {
               swal('Updation Failed !', response.msg, 'error');
            } else {
               $('#nominee_name_show_' + order_id).text(data.nominee_name);
               $('#nominee_dob_show_' + order_id).text(data.nominee_dob);
               $('#nominee_nationality_show_' + order_id).text(data.nominee_nationality);
               swal('Updated !', response.msg, 'success');
            }
         },
         
         error: function () {
            console.log('Failed');
         }
      });

        $(this).parents(".edit_tr").find(".edit_box").toggle();
      $(this).parents(".edit_tr").find(".edit_text").toggle();
      $('#save_nominee_' + order_id).hide();
   });
      

$("body").on("click", ".send_email", function () {
var order_id = $(this).data('bg-id');
var Email = $('#email_'+order_id).val();
var ticket_id =$(this).data('bg-encrpty-id');
if (Email == "") {
  swal('Error!', "Emai ID Cannot be empty.", 'error');
  return false;
}
swal({
  title: 'Are you sure you want to Send a email ?',
  text: "Send or Cancel",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#0CC27E',
  cancelButtonColor: '#FF586B',
  confirmButtonText: 'Yes, Send!',
  cancelButtonText: 'No, cancel!',
  confirmButtonClass: 'button h-button is-primary btn btn-primary ',
  cancelButtonClass: 'button h-button is-danger btn btn-danger',
  buttonsStyling: false
}).then(function (res) {


  if (res.value == true) {
    $.ajax({
      url: '<?php echo base_url();?>game/send_email',
      type: 'POST',
      dataType: "json",
      data: { email: Email, ticket_id: ticket_id },
      success: function (response) {

        // 
        if (response.status == 0) {
          swal('Updation Failed !', response.msg, 'error');
        }
        else {
          swal('Updated !', response.msg, 'success');
        }
      },
      error: function () {
        console.log('Failed');
      }
    });
  }
}, function (dismiss) {

});
});


     
$("body").on("click", ".save_btnn_new", function () {
  var order_id = $(this).data('bg-id');
  var fields = ["method", "email", "name", "address", "postal", "deadline"];
  var errorMessage = "";

  function validateField(field) {
    var value = $("#" + field + "_" + order_id).val();
    if (value === "") {
      errorMessage += field + " is empty.\n";
      $("#" + field + "_" + order_id).addClass('delivery_inpt_error');
    } else {
      $("#" + field + "_" + order_id).removeClass('delivery_inpt_error');
    }
  }

  fields.forEach(validateField);

  var country = $("#country_" + order_id + " option:selected");
  var city = $("#city_" + order_id + " option:selected");

  validateField('country_' + order_id);
  validateField('city_' + order_id);

  if (errorMessage !== "") {
    return false;
  }

  var data = {
    order_id: order_id,
    delivery_method: $("#method_" + order_id).val(),
    delivery_deadline: $("#deadline_" + order_id).val(),
    email: $("#email_" + order_id).val(),
    address: $("#address_" + order_id).val(),
    name: $("#name_" + order_id).val(),
    postal: $("#postal_" + order_id).val(),
    check_in_out: $("#check_in_out_" + order_id).val(),
    hotel_ref: $("#hotel_ref_" + order_id).val(),
    country: country.val(),
    city: city.val(),
  };

  $.ajax({
    url: '<?php echo base_url(); ?>game/save_billing_information',
         type: 'POST',
         dataType: "json",
         data: data,
         success: function (response) {
            if (response.status == 0) {
               swal('Updation Failed !', response.msg, 'error');
            } else {
               $('#show_method_' + order_id).text(data.delivery_method);
               $('#show_email_' + order_id).text(data.email);
               $('#show_name_' + order_id).text(data.name);
               $('#show_address_' + order_id).text(data.address);
               $('#show_postal_' + order_id).text(data.postal);
               $('#show_city_' + order_id).text(city.text());
               $('#show_country_' + order_id).text(country.text());
               $('#show_check_in_' + order_id).text(data.check_in_out);
               $('#show_hotel_ref_' + order_id).text(data.hotel_ref);
               $('#inpt_delivery_date_' + order_id).text(response.deadline);

               swal('Updated !', response.msg, 'success');
            }
         },
         error: function () {
            console.log('Failed');
         }
      });

      $(this).parents(".edit_tr_new").find(".edit_box_new").hide();
      $(this).parents(".edit_tr_new").find(".edit_text_new").show();
      // $('#save_' + order_id).hide();
   });
      
$(document).on('click', '.copyTicketHolder', function () {
    $(this).addClass('highlighted');

    var bg_id = $(this).attr('data-bg-id');
    var table = $("#ticket_holder_" + bg_id);

    // Create a textarea element
    var textarea = document.createElement("textarea");

    // Extract and format the table data for copying
    var tableData = "";
    table.find('tbody tr').each(function () {
        var rowData = [];
        //$(this).find('td').each(function () {
         $(this).find('td:lt(3)').each(function () {
            rowData.push($(this).text());
        });
        tableData += rowData.join('\t\t\t') + '\n';
    });

    // Set the textarea's value to the table data
    textarea.value = tableData;

    // Append the textarea to the document body
    document.body.appendChild(textarea);

    // Select the textarea content
    textarea.select();

    try {
        // Execute the "Copy" command to copy the selected text to the clipboard
        document.execCommand("Copy");
        console.log('Table data copied to clipboard');
    } catch (e) {
        console.error('Unable to copy table data to clipboard');
    } finally {
        // Remove the dynamically created textarea from the document's body
        document.body.removeChild(textarea);
    }
});
//
$(document).on('click', '.copyDeliveryDetails', function () {
   $(this).addClass('highlighted');
   var bg_id = $(this).attr('data-bg-id');
   var deliveryDetails = [
       'method', 'inpt_delivery_date', 'email', 'name', 'address','city',
       'postal', 'country','check_in_out', 'hotel_ref'
   ];
   var copiedText = "";

   deliveryDetails.forEach(function (detail) {
       var element = $('#' + detail + '_' + bg_id);
       var value;

       if (element.is('select')) {
           value = element.find('option:selected').text();
       } else {
           value = element.val() || element.text();
       }

       if (detail === 'check_in_out') {
            detail = 'Check In/Out';
        } else if (detail === 'hotel_ref') {
            detail = 'Hotel Ref';
        } else if (detail === 'postal') {
            detail = 'Postal/Zip Code';
        } else if (detail === 'inpt_delivery_date') {
            detail = 'Delivery Deadline';
        }

       copiedText += detail.charAt(0).toUpperCase() + detail.slice(1) + ": " + value + "\n";
   });

   var textarea = document.createElement("textarea");
   textarea.value = copiedText;

   document.body.appendChild(textarea);
   textarea.select();
   document.execCommand("Copy");
   document.body.removeChild(textarea);
});

$(document).on('click', '.copyBuyerButton', function(){ 
      
      $(this).addClass('highlighted');
      var bg_id = $(this).attr('data-bg-id');

      // Select the elements whose text you want to copy
      var buyer_name_ip=$("#buyer_name_"+bg_id).text();
      var buyer_name = "Buyer Name : "+buyer_name_ip;
      var buyer_email_ip=$("#buyer_email_"+bg_id).text();
      var buyer_email = "Buyer Email : "+buyer_email_ip;
      var buyer_mobile_ip=$("#buyer_mobile_"+bg_id).text();
      var buyer_mobile = "Phone Number : "+buyer_mobile_ip;
      var buyer_mobile_alter_ip=$("#buyer_mobile_alter_"+bg_id).text();
      var buyer_mobile_alter = "Alternative Phone : "+buyer_mobile_alter_ip;
      var buyer_billing_ip=$("#buyer_billing_"+bg_id).text();
      var buyer_billing = "Billing Address : "+buyer_billing_ip;
      
      var buyer_city_ip=$("#buyer_city_"+bg_id).text();
      var buyer_city = "City : "+buyer_city_ip;

      var buyer_postal_ip=$("#buyer_postal_"+bg_id).text();
      var buyer_postal = "Post / Zip Code : "+buyer_postal_ip;

      var buyer_country_ip=$("#buyer_country_"+bg_id).text();
      var buyer_country = "Country : "+buyer_country_ip;

      var buyer_source_ip=$("#buyer_source_"+bg_id).text();
      var buyer_source = "Partners : "+buyer_source_ip;
         
      var textarea = document.createElement("textarea");
      textarea.value = buyer_name + "\n" + buyer_email+ "\n" + buyer_mobile+ "\n" + buyer_mobile_alter+ "\n" + buyer_billing+ "\n"  + buyer_city+ "\n" + buyer_postal+ "\n" + buyer_country+ "\n"+ buyer_source;
   
      // Append the textarea element to the body
      document.body.appendChild(textarea);

      // Select the text in the textarea
      textarea.select();

      // Execute the copy command
      document.execCommand("Copy");

      // Remove the textarea element
      document.body.removeChild(textarea);
    });

//'<button type="button" class="btn btn-tbl-card-action">Save</button>'+
       </script>
   <script>

      $(document).ready(function(){
    

    //     $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    // e.target // newly activated tab
    // e.relatedTarget // previous active tab
    // $(".owl-carousel").trigger('refresh.owl.carousel');
    // });
  
             
                  });

            
   </script>