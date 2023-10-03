
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
.sort_filters ul li:nth-last-child(1)
{

border: none;
    background: #00A3ED !important;
    padding: 10px 15px;
    color: #fff;
    text-align: center;

   
   }
</style>
<?php $this->load->view(THEME . '/common/header'); ?>


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
            <div class="page-title dflex-between-center">
               <h3 class="mb-1">Booking Api Orders</h3>
            </div>
         </div>
      </div>
      <!-- page content -->
      <div class="page-content-wrapper mt--45 all_orders_page">
         <div class="container-fluid">
            <div class="card">
               <div class="card-body">

                  <div class="section_all all_orders filter_new">
                     <div class="">
                        <!-- cta -->
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
                                                   <button class="btn btn-light dropdown-toggle date_search_filter" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Date <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom sedate" aria-labelledby="dropdownMenuButton">                                                  
                                                   <form class="px-3 py-2">
                                                            <div class="row">
                                                               <div class="col-md-6">
                                                                  <div class="form-group datemark">
                                                                     <input class="form-control" id="MyTextbox3" type="text" name="MyTextbox3" placeholder="From">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-6">
                                                                  <div class="form-group datemark_to">
                                                                     <input class="form-control" id="MyTextbox2" type="text" name="MyTextbox2" placeholder="To">
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
                                    <!-- <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">

                                             <button class="btn btn-light dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Order ID <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom"
                                                aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper"
                                                   class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label
                                                         class="search-box d-inline-flex position-relative">Search:<input
                                                            type="search" name="ticket_id" id="booking_no"
                                                            class="form-control form-control-sm "
                                                            placeholder="Search in Filters..."
                                                            aria-controls="view_project_list"></label></div>
                                                </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt">Reset</div>
                                                   <div class="reset_ok"><button type="button"
                                                         class="search_ok">Submit</button></div>

                                                </div>
                                             </div>

                                          </div>
                                       </div>
                                    </li> -->

                                    <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle order_id_search_filter" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Order ID <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" name="booking_no" id="booking_no" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
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
                                                   <button class="btn btn-light dropdown-toggle seller_name_btn" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Seller Name <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom " aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="seller_name"></label></div>
                                                   </div>
                                                   <div class="check_box">
                                                       
                                                        <?php 
                                                            echo $this->data['html'];
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
                                             <button class="btn btn-light dropdown-toggle event_name_filter" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Event Name <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom"
                                                aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper"
                                                   class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter"><label
                                                         class="search-box d-inline-flex position-relative">Search:<input
                                                            type="search" class="form-control form-control-sm"
                                                            id="event_name" name="event_name" placeholder="Search in Filters..."
                                                            aria-controls="view_project_list"></label></div>
                                                </div>
                                                <!-- <div class="reset_btn">
                                                   <div class="reset_txt">Reset</div>
                                                   <div class="reset_ok"><button class="search_ok">Submit</button></div>
                                                </div> -->

                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all" >Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info event_search_ok">Search</button></div>
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
                                                    Shipping Status<i class="mdi mdi-chevron-down"></i>
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
                                                    Order Status<i class="mdi mdi-chevron-down"></i>
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
                                                         <div class="reset_txt"><button class="btn btn-info order_status_reset clear_all" >Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info order_status_search">Search</button></div>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </li>
                                    <!-- <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Order Status <i class="mdi mdi-chevron-down"></i>
                                                <div id="order_status" class="dropdown-menu dropdown-menu-custom"
                                                   aria-labelledby="dropdownMenuButton">
                                                   <div id="order-status-hidden" data-status-hidden=""></div>
                                                   <a data-order-status="2" class="dropdown-item" href="#">Pending</a>
                                                   <a data-order-status="1" class="dropdown-item" href="#">Confirmed</a>
                                                   <a data-order-status="0" class="dropdown-item" href="#">Failed</a>
                                                   <a data-order-status="3" class="dropdown-item" href="#">Cancelled</a>
                                                   <a data-order-status="4" class="dropdown-item" href="#">Shipped</a>
                                                   <a data-order-status="5" class="dropdown-item" href="#">Delivered</a>
                                                   <a data-order-status="6" class="dropdown-item"
                                                      href="#">Downloaded</a>
                                                </div>
                                          </div>
                                       </div>
                                    </li> -->
                                    <li class="sort_list">
                                       <a class="clear_all reset_txt" href="javascript:void(0)">Clear All</a>
                                       
                                    </li>
                                    <li class="sort_list">
                                       <a href=""class="button h-button is-primary download_orders report_sts">Reports</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="">
                     <table style='width:100% !important' id="all-orders" class="table table-hover table-nowrap mb-0 all_orders">
                        <thead class="thead-light">
                           <tr>
                              <th>Order ID</th>
                              <th>Event Name</th>
                              <th>Date</th>
                              <th>Qty</th>
                              <th>Category</th>
                              <th>Block</th>
                              <th>Buyer name</th>
                              <th>Partner name</th>
                              <th>Payment Status</th>
                              <th>Delivery Status</th>
                              <th>price</th>
                              <th>Order Total</th>
                              <th>&nbsp;</th>
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
<?php $this->load->view(THEME . '/common/footer'); ?>

<script type="text/javascript">
   function load_my_orders(seller_id) {
      window.location.href = "<?php echo base_url() . THEME; ?>/game/orders/list_order/all/" + seller_id;
   }

   $('.dropdown-menu-custom .check_box').click(function (e) {
      e.stopPropagation();
   });


</script>
<script type="text/javascript">
   $(document).ready(function () {


      $('.report_sts').click(function(event) {
    event.preventDefault();
       var sellerIds = [];
       var shippingIds = [];
       var orderIds = [];

    var baseUrl = '<?php echo base_url(); ?>';
    var eventStartDate = encodeURIComponent($('input[name="MyTextbox3"]').val());
    var eventEndDate = encodeURIComponent($('input[name="MyTextbox2"]').val());
    var event_name = encodeURIComponent($('input[name="event_name"]').val() || '');
    var booking_no = encodeURIComponent($('input[name="booking_no"]').val() || '');

   $('.check_box input:checked').each(function() {
         var ID = $(this).attr('id');
         var newID = ID.replace("customCheck", "");     
         sellerIds.push(encodeURIComponent(newID));
    });

    $('.seat_category_check_box input:checked').each(function() {
         var shipping_status_ID = $(this).attr('id');
         var shipping_status_newID = shipping_status_ID.replace("shipping_status", "");     
         shippingIds.push(encodeURIComponent(shipping_status_newID));
         //shippingIds.push(encodeURIComponent($(this).val()));
    });

    $('.order_select_status input:checked').each(function() {
         orderIds.push(encodeURIComponent($(this).val()));
    });
    
    //console.log(stadiumIds);

    var url = baseUrl + 'game/order_reports?' + 'event_start_date=' + eventStartDate + '&event_end_date=' + eventEndDate + '&event_name=' + event_name + '&booking_no=' + booking_no + '&sellerIds=' + sellerIds.join(',') + '&shippingIds=' + shippingIds.join(',') + '&orderIds=' + orderIds.join(',') ;
    window.location.href = url;
  });


      $("body").on('click','.seat_category_check_box,.order_status_check_box',function(e){
    //    alert('dd');
    e.stopPropagation();
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

         var overlay = $('#overlay');


      var Dtable = $('#all-orders').DataTable({
         'info': false,
         scrollX: !0,
       //  'processing': false,
         'serverSide': true,
         'serverMethod': 'post',
         "pageLength" : 50,
         "ajax": {
            url: base_url + 'game/get_items',
            data: function (d) {
               var page = "api";
               var booking_no = $("#booking_no").val();
               var seller_name = $("#seller_name").val();
               var event_name = $("#event_name").val();
               var order_status = $('#order-status-hidden').data('status-hidden');
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
               
               d.page = page;
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
            beforeSend: function () {
            // Show the loader before the request is sent
            overlay.show();
         },
         complete: function () {
            // Hide the loader after the request is completed
            overlay.hide();
         },

         },
        
         "targets": 'no-sort',
         "bSort": false,
         language: {
            paginate: {
               previous: "<i class='mdi mdi-chevron-left'>",
               next: "<i class='mdi mdi-chevron-right'>"
            },
         //   loadingRecords: '&nbsp;',
           // processing: 'Loading...'
         },
         drawCallback: function () {

            $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
         },
         'columns': [
            { data: 'booking_no' },
            { data: 'event_name' },
            { data: 'purchase_date' },
            { data: 'qty' },
            { data: 'category' },
            { data: 'block' },
            { data: 'buyer' },
            { data: 'partner' },
            { data: 'payment_status' },
            { data: 'shipping_status' },
            { data: 'price' },
            { data: 'total' },
             { data: 'view' }
         ],
         createdRow: function(row, data, dataIndex) {
      $('td', row).each(function(colIndex) {
       // $(this).attr('title', data + dataIndex + '-' + colIndex);
      //  var columnData = data[Object.keys(data)[colIndex]];
      //   $(this).attr('title', columnData);
      // var fourthTD = $(row).find('td:eq(3)');
      // var columnData = data.column4; // Assuming column4 contains the data for the fourth column

      // fourthTD.attr('title', columnData);

      });
    }
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

          dateFormat: 'dd-mm-yy'
      }
      );
      $(to_datepicker).datepicker(
         { dateFormat: 'dd-mm-yy'}
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
      $('.seller_name_btn').removeClass("filter_active");
         $('.seller_name_btn').text("Seller Name");  
         $("#seller_name").val('');
         $('.check_box input:checked').removeAttr('checked');
         $('#seller_name').trigger('keyup');
     // 
    });

    $('.shipping_status_reset').click(function () {
         $('.shipping_status_name_btn').text("Shipping Status"); 
         $('.shipping_status_name_btn').removeClass("filter_active"); 
         $("#shipping_status").val('');
        // $('.seat_category_check_box input:checked').removeAttr('checked');
         $('.seat_category_check_box input:checked').prop('checked', false);

         $('#shipping_status').trigger('keyup');
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

            $('.date_search_filter').removeClass("filter_active");
            $('.order_id_search_filter').removeClass("filter_active");
            $('.seller_name_btn').removeClass("filter_active");
            $('.event_name_filter').removeClass("filter_active");
            $('.shipping_status_name_btn').removeClass("filter_active"); 
            $('.order_status_btn').removeClass("filter_active");  

         $("#booking_no").val('');
       //$("#seller_name").val('');
         $("#event_name").val('');        
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         $('.order_status_check_box input:checked').prop('checked', false);
         $('.seller_reset').trigger('click');
         $('.shipping_status_reset').trigger('click');         
         $('.category_reset').trigger('click');
        
        // $('.seat_category_check_box input:checked').removeAttr('checked');
         
         // trigger your desired action here
       // Dtable.draw();

      });


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
         


   });
</script>
<?php exit; ?>
