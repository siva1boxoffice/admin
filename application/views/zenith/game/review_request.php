
<style>
.request_review_check_box {
    padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
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
                     <h3 class="mb-1">Order Review Request</h3>
                     <!-- <ol class="breadcrumb mb-0 mt-1">
                        <li class="breadcrumb-item">
                           <a href="../index.html">
                              <i class="bx bx-home fs-xs"></i>
                           </a>
                        </li>
                        <li class="breadcrumb-item">
                           <a href="calender.html">
                              Tickets
                           </a>
                        </li>
                        <li class="breadcrumb-item active">Ticket approval</li>
                     </ol> -->
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
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">                                                  
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
                                                   <button class="btn btn-light dropdown-toggle order_id_search_filter" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Order ID <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" id="booking_no" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
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
                                                   <button class="btn btn-light dropdown-toggle status_type_btn" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Order Status <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="status_type"></label></div>
                                                   </div>
                                                   <div class="seat_category_check_box">
                                                     <?php echo  $this->data['delivery_status']; ?>
                                                     </div>                                                     
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info status_reset">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info status_type_search">Search</button></div>
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
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" id="event_name" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
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
                                                   <button class="btn btn-light dropdown-toggle request_status_type_btn" type="button" id="dropdownMenuButton11"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Request Sent<i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="status_type"></label></div>
                                                   </div>
                                                      
                                                   <div class="request_review_check_box">
                                                     <?php echo  $this->data['request_status']; ?>
                                                     </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info request_reset">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info request_search">Search</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                          <li class="sort_list">
                                             <a class="clear_all" href="javascript:void(0)">Clear All</a>
                                          </li>
                                          <!-- <li class="sort_list">
                                             <a class="report_sts" href="">Reports</a>
                                          </li> -->
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="table-responsive">
                           <table style='width:100% !important' id="review-request-datatable" class="table table-responsive table-hover table-nowrap mb-0">
                              <thead class="thead-light">
                                 <tr>
                                    <th tabindex="0" class="dt-checkboxes-cell" style=""><div class="form-check custom-checkbox"><input type="checkbox" class="form-check-input dt-checkboxes" id="check-all"><label class="form-check-label">&nbsp;</label></div></th>
                                    <th>Order</th>
                                    <th>Order Status</th>
                                    <th>Event</th>
                                    <th>Ticket Category</th>
                                    <th>Qty</th>
                                    <th>Review Status</th>
                                    <th>Ticket Type</th>
                                    <th>Request Sent Date</th>
                                    <th>Send Review Request</th>
                                    <th>&nbsp;</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 
                                 
                              </tbody>
                           </table>
                        </div>

                        <div class="fixed-table-pagination arrow_pos">
                           <div class="float-left pagination-detail">
                              <div class="approve_all_select">
                                 <button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave">
                                    <a class="button is-success send_review_request_mail" href="javascript:void(0);" >Send Request To All Selected</a>
                                 </button>
                              </div>
                           </div>                        
                       </div>
                     </div>                 
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- main content End -->

      <div id="modal_content_ajax">
				<!-- modal content here -->
				</div>

<?php $this->load->view(THEME . '/common/footer'); ?>
<script type="text/javascript">
   $(document).ready(function () {

      $("body").on('click','.dropdown-menu-custom .check_box, .seat_category_check_box,.request_review_check_box',function(e){
    //    alert('dd');
    e.stopPropagation();
});

       $("#check-all").click(function() {

         var checkedCount = $('#check-all:checkbox:checked').length;
         if(checkedCount>0) 
         {
            $('.custom-checkbox input:checkbox').prop('checked', true);
         }
         else{
            $('.custom-checkbox input:checkbox').prop('checked', false);
         }
   // $('.request_order input:checkbox').not(this).prop('checked', this.checked);


  });


 

  var overlay = $('#overlay');
      var Dtable = $('#review-request-datatable').DataTable({
         'info': false,
         // 'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         "ajax": {
            url: base_url + 'game/get_review_request',
            data: function (d) {
               var booking_no = $("#booking_no").val();
               var event_name = $("#event_name").val();
               var statusIds = [];
               var requestIds = [];
               $(".seat_category_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  statusIds.push(newID);
               });

                $(".request_review_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customChecks", "");     

                  requestIds.push(newID);
               });

               var fromDate = document.getElementById('MyTextbox3').value;
               var toDate = document.getElementById('MyTextbox2').value;
               d.request_status = requestIds;
               d.status_type = statusIds;
               d.booking_no = booking_no;
               d.event_name = event_name;
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
         },        
         "targets": 'no-sort',
         "bSort": false,
         language: {
            paginate: {
               previous: "<i class='mdi mdi-chevron-left'>",
               next: "<i class='mdi mdi-chevron-right'>"
            },
            loadingRecords: '&nbsp;',
            processing: 'Loading...'
         },
         drawCallback: function () {
            // $(".dataTables_paginate").addClass("page-link"),
            // $(".dataTables_paginate  .paginate_button").addClass("page-link")
            $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
         },
         'columns': [
            { data: 'total' },
            { data: 'booking_no' },
            { data: 'order_status' },
            { data: 'event' },            
            { data: 'category' },
            { data: 'quantity' },
            { data: 'review_status' },
            { data: 'ticket_type' },
            { data: 'request_sent_date' },
            { data: 'request' },
            { data: 'action' },
           
         ]
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

      $('.clear_all').click(function () {
         $('.date_search_filter').removeClass("filter_active");
         $('.order_id_search_filter').removeClass("filter_active");
         $('.status_type_btn').removeClass("filter_active");
         $('.event_name_filter').removeClass("filter_active");
         $('.request_status_type_btn').removeClass("filter_active");

         $('.status_reset').trigger('click');
         $("#booking_no").val('');
         $("#event_name").val('');  
         $("#status_type").val('');                 
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         // $('.seller_reset').trigger('click');
         // $('.category_reset').trigger('click');
         $('.request_reset').trigger('click');
         Dtable.draw();

      });



      $('.request_search').on('click', function (e) {
         $('.request_status_type_btn').addClass("filter_active");
          Dtable.draw();
      });

      $('.event_search_ok').on('click', function (e) {
         $('.event_name_filter').addClass("filter_active");
         Dtable.draw();
      });

      $('.search_ok').on('click', function (e) {
         $('.order_id_search_filter').addClass("filter_active");
                Dtable.draw();
            });
            $('.status_type_search').on('click', function (e) {
               $('.status_type_btn').addClass("filter_active");
               
                Dtable.draw();
            });

            $("#status_type").keyup(function() { // Bind to the keyup event of the textbox
                var searchText = $(this).val(); // Get the text entered in the textbox
                    $.ajax({
                        url: base_url + 'game/get_review_request_status',
                        type: "POST",
                        data: { search_text: searchText }, // Pass the search text to the PHP script
                        success: function(response) {
                        $(".seat_category_check_box").html(response); // Bind the response data to the checkbox container
                        Dtable.draw();
                        }
                    });     
                });

                $('.status_reset').click(function () {
                  $('.status_type_btn').removeClass("filter_active");
                $('.status_type_btn').text("Order Status");  
                $("#status_type").val('');
                $('.seat_category_check_box input:checked').removeAttr('checked');
                $('#status_type').trigger('keyup');    
             });

              //  status_reset

              $(".seat_category_check_box").change(function() { 
                  var checkedCount = $('.seat_category_check_box input:checked').length;
               
                  if(checkedCount>0) 
                  {
                     $('.status_type_btn').text(checkedCount+" Selected");
                  } 
                  else 
                     $('.status_type_btn').text("Order Status");  
            
         });

              $('.request_reset').click(function () { 
               $('.request_status_type_btn').removeClass("filter_active");
                $('.request_status_type_btn').text("Request Sent");  
               // $('.request_review_check_box input:checked').attr('checked', false);
               $(".request_check").each(function(){
               $(this).prop("checked", false)
               });

             });

               $(".request_review_check_box").change(function() { 
                  var checkedCount = $('.request_review_check_box input:checked').length;
               
                  if(checkedCount>0) 
                  {
                     $('.request_status_type_btn').text(checkedCount+" Selected");
                  } 
                  else 
                     $('.request_status_type_btn').text("Request Sent");  
            
         });

         $("body").on('click',' #approve_all_orders',function(e){
            count=0;
         $('table tbody input[type="checkbox"]').each(function() {
            if($(this).is(":checked")) {
              count++;               
            }
         });
         ///////////////////

      var checkedCount = $('.request_order:checkbox:checked').length;
      
         if(count>0) 
         {
            var requestIds = [];
            // $(".request_order:checkbox:checked").each(function() {
            //    requestIds.push($(this).val());
            // });


            $('table tbody input[type="checkbox"]').each(function() {
            if($(this).is(":checked")) {
               requestIds.push($(this).val());
               
            }
         });

               if(requestIds.length>0) 
            { 
                $.ajax({
                        url: base_url + 'game/send_review_request',
                        type: "POST",
                        dataType:'json',
                        data: { requestIds: requestIds }, // Pass the search text to the PHP script
                        success: function(response) {
                        Dtable.draw();
                        if (response.status == 1) {

                        swal('Updated !', response.msg, 'success');

                        }
                        else {
                        swal('Updation Failed !', response.msg, 'error');

                        }
                        }
                    });   
            }
           
         } 
         else 
            swal('Failed !', 'Please choose any one of the order list', 'error');
            return false;
         });
   // $(".send_review_request_mail").click(function() { 
      $(document).on('click', '.send_review_request_mail', function() {

         count=0;
         $('table tbody input[type="checkbox"]').each(function() {
            if($(this).is(":checked")) {
              count++;               
            }
         });      
         if(count>0) 
         {
            var data_title = "Are you sure you want to semd a email ?";
		var data_sub_title = "Send or Cancel";
		var data_yes = "Yes";
		var data_no = "No";
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
            swal('Failed !', 'Please choose any one of the order list', 'error');
            return false;
         }
         ///////////////////
      
     /*  count=0;
         $('table tbody input[type="checkbox"]').each(function() {
            if($(this).is(":checked")) {
              count++;               
            }
         });
         ///////////////////

      var checkedCount = $('.request_order:checkbox:checked').length;
      
         if(count>0) 
         {
            var requestIds = [];
            // $(".request_order:checkbox:checked").each(function() {
            //    requestIds.push($(this).val());
            // });


            $('table tbody input[type="checkbox"]').each(function() {
            if($(this).is(":checked")) {
               requestIds.push($(this).val());
               
            }
         });

               if(requestIds.length>0) 
            { 
                $.ajax({
                        url: base_url + 'game/send_review_request',
                        type: "POST",
                        dataType:'json',
                        data: { requestIds: requestIds }, // Pass the search text to the PHP script
                        success: function(response) {
                        Dtable.draw();
                        if (response.status == 1) {

                        swal('Updated !', response.msg, 'success');

                        }
                        else {
                        swal('Updation Failed !', response.msg, 'error');

                        }
                        }
                    });   
            }
           
         } 
         else 
            swal('Failed !', 'Please choose any one of the order list', 'error');
            return false;*/
      
    }); 

   });
</script>
<?php exit; ?>

