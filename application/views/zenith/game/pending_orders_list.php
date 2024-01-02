<style>
   span.tr_src_type {
    color: #898F99;
    font-size: 12px;
    margin-left: 10px;
}
.approve_all_select
{
   margin-top: 22px;
}
</style>
<?php $this
   ->load
   ->view(THEME.'common/header'); ?>

<div class="main-content">
   <!-- content -->
   <div class="page-content">
      <!-- page header -->
      <div class="page-title-box">
         <div class="container-fluid">
            <div class="page-title dflex-between-center">
               <h3 class="mb-1">Order Pending Approval</h3>
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
                              <div class="sort_filters last-field">
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
                                                   <button class="btn btn-light dropdown-toggle order_id_search_filter" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Order ID <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" name="booking_no" id="booking_no" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
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
                                             <button class="btn btn-light dropdown-toggle seller_name_btn" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Seller Name <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom " aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id="seller_name"></label></div>
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
                                                         <div class="reset_txt"><button class="btn btn-info event_reset" >Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info event_search_ok">Search</button></div>
                                                      </div>

                                             </div>
                                          </div>
                                       </div>
                                    </li>   
                                    
                                    <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle ticket_category_btn" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Ticket Category  <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id="ticket_category"></label></div>
                                                   </div>
                                                   <div class="seat_category_check_box">
                                                        

                                                        <?php 
                                                            echo $this->data['seat_category'];
                                                        ?>
                                                      </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info category_reset" >Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info ticket_ctgry">Search</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                    <li class="sort_list">
                                       <a class="clear_all reset_txt" href="javascript:void(0)">Clear All</a>
                                       
                                    </li>
                                    <li class="sort_list ">
                                       <a href=""class="button h-button is-primary download_orders report_sts">Reports</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="">
                     <table style='width:100% !important' id="all_pending_orders" class="table table-hover table-nowrap mb-0">
                        <thead class="thead-light">
                           <tr>
                           <th tabindex="0" class="dt-checkboxes-cell" style=""><div class="form-check custom-checkbox"><input type="checkbox" class="form-check-input dt-checkboxes" id="check-all"><label class="form-check-label">&nbsp;</label></div></th>
                              <th>Order ID</th>
                              <th>Customer Name</th>
                              <th>Event</th>
                              <th>Ticket Category</th>
                              <th>Qty</th>
                              <th>Notes</th>
                              <th>Total</th>
                              <th>Customer <br/>Country</th>
                              <th>Seller Name</th>
                              <th>Approve/Reject</th>
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
<div id="modal_content_ajax">
            <!-- modal content here -->
            </div>
<?php $this
   ->load
   ->view(THEME.'common/footer'); ?>
   <script type="text/javascript">
   $(document).ready(function () {

      $("body").on('click',' #approve_reject',function(e){

   $(this).attr("disabled",true);
   $(this).text("Please wait...");

      var bg_id = $(this).attr('data-bg-id');
      var status = $(this).attr('data-ticket-status');
      var data_close_modal = $(this).attr('data-close-modal');
      //var ticket_type =$(this).attr('data-ticket-type');
      var reason = "";

      var reject_org_order_id = [];
      reject_org_order_id.push(bg_id);


         if (status == 3) {
            reason = prompt("Please Enter the reason for Rejection ", "Invalid File Format.");
         }
         $.ajax({
            url: base_url + 'game/orders/ajax_update_pending_orders',
            method: "POST",
        //   data : {"ticket_id" : bg_id,"status" : status,"ticket_type" : ticket_type,"reason" : reason}, 
           data: {
                    "org_order_id": reject_org_order_id,
                    "status": status,
                    "reason": reason
                },         
              dataType: 'json',
             success: function(result) {

                 if (result) {

                     swal('Updated !', result.msg, 'success');

                 } else {
                     swal('Updation Failed !', result.msg, 'error');

                 }               
            $('#'+data_close_modal).modal("hide");  

             setTimeout(function () {
               $("#approve_reject").text("Yes, Change it!");
               $("#approve_reject").attr("disabled",false);
                window.location.reload();
              }, 2000);

             },
              error: function(xhr) {
             $("#approve_reject").text("Yes, Change it!");
             $("#approve_reject").attr("disabled",false);
            // Handle the error here
         }
         });
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
//$('.seller_reset').trigger('click');

$('.seller_name_btn').removeClass("filter_active");
$('.seller_name_btn').text("Seller Name");  
$("#seller_name").val('');
$('.check_box input:checked').prop('checked', false);        
//$('.category_reset').trigger('click');

$('.ticket_category_btn').removeClass("filter_active");
$('.ticket_category_btn').text("Ticket Category");  
$("#ticket_category").val('');
$('.seat_category_check_box input:checked').prop('checked', false);

$('.search_box').trigger('keyup');
// trigger your desired action here
Dtable.draw();

});

      
      $(".search_box").on('keyup', function(){
              var value = $(this).val().toLowerCase();               

           $(this).parents(".dropdown-menu").find(".custom-checkbox").each(function () {
                 if ($(this).find("label").text().toLowerCase().search(value) > -1) {
                    $(this).show();
                
                 } else {
                    $(this).hide();
                 }
              });
           });


           $("body").on('click',' #approve_all_orders',function(e){

             $(this).attr("disabled",true);
             $(this).text("Please wait...");
         const order_id = [];
const org_order_id = [];

$('table tbody input[type="checkbox"]').each(function() {
   if($(this).is(":checked")) {
      var ID = $(this).attr('data-order-id');
      order_id.push(ID);
      var org_id = $(this).attr('data-org-order-id');
      org_order_id.push(org_id);
      
   }
});
if(org_order_id.length >0)
{

            $.ajax({
         url: base_url + 'game/orders/ajax_update_pending_orders',
         method: "POST",
         data : {"order_id" : order_id,"status" : 1,"org_order_id" : org_order_id},
         dataType: 'json',
         beforeSend: function() {
      // Show loader before sending the request
      $("body").append("<div id='overlay'></div>");
   },

   complete: function() {
      // Hide loader after receiving the response
      //$("#loader").hide();
      // console.log('dddddddddd');
   },
         success: function (result) {
            $("#overlay").remove();

                     if (result) {

           swal('Updated !', result.msg+" <br/>"+result.update_cnt+" <br/>"+result.failed_update_cnt, 'success');
          //  swal('Updated !', result.msg, 'success');

            }
            else {
            swal('Updation Failed !', result.msg+" <br/>"+result.update_cnt+" <br/>"+result.failed_update_cnt, 'error');
          //  swal('Updation Failed !', result.msg, 'error');

            }

            setTimeout(function () {
               $("#approve_all_orders").text("Yes, Change it!");
               $("#approve_all_orders").attr("disabled",false);
             window.location.reload(); }, 2000);
         
         },
         error: function(xhr) {
             $("#approve_all_orders").text("Yes, Change it!");
             $("#approve_all_orders").attr("disabled",false);
            // Remove overlay if the AJAX request fails
            $("#overlay").remove();
            // Handle the error here
         }
      });
   }
   else{
       $("#approve_all_orders").text("Yes, Change it!");
       $("#approve_all_orders").attr("disabled",false);
      swal('Updation Failed !', "Please Choose any one of the Order", 'error');
   }
      });
      $(document).on('click', '#all_pending_orders_approve', function() {

         const inpt_order_id = [];
            const inpt_org_order_id = [];
            $('table tbody input[type="checkbox"]').each(function() {
   if($(this).is(":checked")) {
      var inpt_order_id = $(this).attr('data-org-order-id');
      inpt_org_order_id.push(inpt_order_id);
      
   }
});
         if(inpt_org_order_id.length >0)
         {

         var data_title = "Are you sure want to Approve All Orders ?";
      var data_sub_title = "Approve Orders !";
      var data_yes = "Yes, Change it!";
      var data_no = "No, cancel!";
      var data_btn = "approve_all_orders";
      var data_target = "approve_orders_target";
      var data_bg_id = "";
      var data_status = "";
      var data_ticket_type = "";
   $.ajax({
         url: '<?php echo base_url();?>game/call_modal',
         type: "POST",
         data: {  "data_title": data_title ,"data_sub_title":data_sub_title, "data_yes":data_yes,"data_no":data_no,"data_btn":data_btn,"data_target":data_target ,"data_bg_id":data_bg_id,"data_status":data_status,"data_ticket_type":data_ticket_type},
         success: function (response) {  
            $("#modal_content_ajax").html(response); 
             $('#'+data_target).modal("show");  
            //$("#").modal('show');
         },
         error: function () {
         }
      });
   }
         else
         {
            swal('Updation Failed !', "Please Choose any one of the Order", 'error');
         }
      
/*const order_id = [];
const org_order_id = [];

$('table tbody input[type="checkbox"]').each(function() {
   if($(this).is(":checked")) {
      var ID = $(this).attr('data-order-id');
      order_id.push(ID);
      var org_id = $(this).attr('data-org-order-id');
      org_order_id.push(org_id);
      
   }
});
if(org_order_id.length >0)
{


            $.ajax({
         url: base_url + 'game/orders/ajax_update_pending_orders',
         method: "POST",
         data : {"order_id" : order_id,"status" : 1,"org_order_id" : org_order_id},
         dataType: 'json',
         beforeSend: function() {
      // Show loader before sending the request
      $("body").append("<div id='overlay'></div>");
   },

   complete: function() {
      // Hide loader after receiving the response
      //$("#loader").hide();
      // console.log('dddddddddd');
   },
         success: function (result) {
            $("#overlay").remove();

                     if (result) {

           swal('Updated !', result.msg+" <br/>"+result.update_cnt+" <br/>"+result.failed_update_cnt, 'success');
          //  swal('Updated !', result.msg, 'success');

            }
            else {
            swal('Updation Failed !', result.msg+" <br/>"+result.update_cnt+" <br/>"+result.failed_update_cnt, 'error');
          //  swal('Updation Failed !', result.msg, 'error');

            }

            setTimeout(function () { window.location.reload(); }, 2000);
         
         },
         error: function(xhr) {
            // Remove overlay if the AJAX request fails
            $("#overlay").remove();
            // Handle the error here
         }
      });
   }
   else{
      swal('Updation Failed !', "Please Choose any one of the Order", 'error');
   }*/
});

   $("body").on('click','.seat_category_check_box,.order_status_check_box,.check_box',function(e){
    //    alert('dd');
    e.stopPropagation();
});


$('.event_search_ok').on('click', function (e) {
         $('.event_name_filter').addClass("filter_active");
         Dtable.draw();
      });

      $('.seller_search').on('click', function (e) {  
         $('.seller_name_btn').addClass("filter_active");  
                Dtable.draw();
            });

            $('.ticket_ctgry').on('click', function (e) {
         $('.ticket_category_btn').addClass("filter_active");
         Dtable.draw();
      });

      $('.category_reset').click(function () {
         $('.ticket_category_btn').removeClass("filter_active");
         $('.ticket_category_btn').text("Ticket Category");  
         $("#ticket_category").val('');
        // $('.seat_category_check_box input:checked').removeAttr('checked');
         $('.seat_category_check_box input:checked').prop('checked', false);
         Dtable.draw();
         // $('#ticket_category').trigger('keyup');
// 
   });

            $('.seller_reset').click(function () {
      $('.seller_name_btn').removeClass("filter_active");
         $('.seller_name_btn').text("Seller Name");  
         $("#seller_name").val('');
    //     $('.check_box input:checked').removeAttr('checked');
         $('.check_box input:checked').prop('checked', false);
       //  $('#seller_name').trigger('keyup');
       Dtable.draw();
     // 
    });

      $('.search_ok').on('click', function (e) { 
         $('.order_id_search_filter').addClass("filter_active");
         Dtable.draw();
      // applyFilters();
      });

      $('.order_reset').click(function () {          
         $('.order_id_search_filter').removeClass("filter_active");
         $("#booking_no").val(''); // clear selected date value
         //updateFilters("booking_no");
         Dtable.ajax.reload(); 
      });

      $('.event_reset').click(function () {          
         $('.event_name_filter').removeClass("filter_active");
         $("#event_name").val(''); // clear selected date value
         //updateFilters("booking_no");
         Dtable.ajax.reload(); 
      });

      // Get the datepicker input element
      const datepicker = document.getElementById('MyTextbox2');
      const to_datepicker = document.getElementById('MyTextbox3');

      // Initialize the datepicker
      $(datepicker).datepicker({

          dateFormat: 'dd-mm-yy' ,
         changeMonth:true,
         changeYear:true,
      }
      );
      $(to_datepicker).datepicker(
         { dateFormat: 'dd-mm-yy' ,
         changeMonth:true,
         changeYear:true,}
      );


      $('.reset_date').click(function () { 
         $('.date_search_filter').removeClass("filter_active");
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         // updateFilters("fromDate");
         // updateFilters("toDate");
         Dtable.ajax.reload();
         $('.dropdown-menu-custom').removeClass('show');
         $('.dropdown').removeClass('show');         
      });

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

   

      $("#check-all").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });

  $('#all_pending_orders').on('change', 'input[type="checkbox"]', function() {

var allChecked = true;
  $('table tbody input[type="checkbox"]').each(function() {
    if(!$(this).is(":checked")) {
      allChecked = false;
    }
  });
  $("#check-all").prop('checked', allChecked);

});

       var Dtable = $('#all_pending_orders').DataTable({
         'info': false,
         scrollX: !0,
       //  'processing': false,
         'serverSide': true,
         'serverMethod': 'post',
         "pageLength" : 50,
         "ajax": {
            url: base_url + 'game/get_pending_items',
            data: function (d) {

               var fromDate = document.getElementById('MyTextbox3').value;
               var toDate = document.getElementById('MyTextbox2').value;
               var booking_no = $("#booking_no").val();
               
               var checkedIds = [];
               $(".check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  checkedIds.push(newID);
               });

               var event_name = $("#event_name").val();

               var seatIds = [];
               $(".seat_category_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("seatCheck", "");     

                  seatIds.push(newID);
               });

               d.event_name = event_name;
               d.seller_name = checkedIds;               
               d.event_start_date = fromDate;
               d.event_end_date = toDate;
               d.booking_no = booking_no;
               d.seat = seatIds;
              
            },
            complete: function(d) {
    bind_record='<div class="float-left pagination-detail"><div class="approve_all_select"><button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave" id="all_pending_orders_approve"><a id="approve_all_btn" class="button is-success" href="javascript:void(0);">Approve All Selected</a> </button> </div></div>';

    var targetRow = $('#all_pending_orders_wrapper').find('.row').eq(2);
    var colMd5Element = targetRow.find('.col-md-5');

         if (colMd5Element.find('.float-left.pagination-detail').length === 0) {
         // Append bind_record to colMd5Element
         colMd5Element.append(bind_record);
         } 

  },
         },
       
  
         "targets": 'no-sort',
         "bSort": false,
         language: {
            paginate: {
               previous: "<i class='mdi mdi-chevron-left'>",
               next: "<i class='mdi mdi-chevron-right'>"
            },
         },
         drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
            toolTipShow(); 
         },
         'columns': [
            { data: 'checkbox_inpt' },
            { data: 'booking_no' },
            { data: 'buyer' },
            { data: 'event_name' },           
            { data: 'category' },           
            { data: 'qty' },
            { data: 'notes' },
            { data: 'total' },
            { data: 'customer_country_name' },
            { data: 'seller' },
            { data: 'approve_or_reject' }
         ]
      });
      });

      function ajax_update_pending_orders(id,status){

var data_title = "Are you sure want to change Status ?";
var data_sub_title = "Approve or Reject !";
var data_yes = "Yes, Change it!";
var data_no = "No, cancel!";
var data_btn = "approve_reject";
var data_target = "approve_reject_target";
var data_bg_id = id;
var data_status = status;
var data_ticket_type = "";
$.ajax({
   url: '<?php echo base_url();?>game/call_modal',
   type: "POST",
   data: {  "data_title": data_title ,"data_sub_title":data_sub_title, "data_yes":data_yes,"data_no":data_no,"data_btn":data_btn,"data_target":data_target ,"data_bg_id":data_bg_id,"data_status":data_status,"data_ticket_type":data_ticket_type},
   success: function (response) {  
      $("#modal_content_ajax").html(response); 
       $('#'+data_target).modal("show");  
      //$("#").modal('show');
   },
   error: function () {
   }
});
      }
      

      function toolTipShow()
   {
         var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
         var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
         return new bootstrap.Tooltip(tooltipTriggerEl)
         })
   }
      </script>