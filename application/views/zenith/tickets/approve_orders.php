

<style>
  /* .dataTables_processing {
  /* ../images/clear.png 
  background-image: url('../images/clear.png');
  background-position: center center;
  background-repeat: no-repeat;
} */
.check_box {
    max-height: 250px;
    overflow-y: auto;
}
#overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 9999;
    }
</style>



<?php $this->load->view(THEME.'/common/header'); ?>
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
                     <h3 class="mb-1">Ticket approval</h3>
                  </div>
               </div>
            </div>
            <!-- page content -->
            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">
                  <div class="card">
                     <div class="card-body">

                        <div class="section_all ticket_sort_approval filter_new">
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
                                                         <div class="reset_txt"><button class="btn btn-info date_reset">Reset</button></div>
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
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id='booking_no'></label></div>
                                                   </div>
                                                   
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info order_reset">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info order_id_search">Search</button></div>
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
                                                            echo $this->mydatas['html'];
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
                                                   <button class="btn btn-light dropdown-toggle event_search_btn event_name_filter" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Event Name <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" id="event_name" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
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
                                                   <button class="btn btn-light dropdown-toggle ticket_category_btn" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Ticket Category  <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="ticket_category"></label></div>
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
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle ticket_status_btn" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Ticket Status  <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                     
                                                   <div class="ticket_status_check_box">
                                                        

                                                        <?php 
                                                            echo $this->data['ticket_status'];
                                                        ?>
                                                      </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info ticket_status_reset" >Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info ticket_status">Search</button></div>
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
                           <table style='width:100% !important' id="approve_orders" class="table table-responsive table-hover table-nowrap mb-0">
                              <thead class="thead-light">
                                 <tr>
                                    <th tabindex="0" class="dt-checkboxes-cell" style=""><div class="form-check custom-checkbox"><input type="checkbox" class="form-check-input dt-checkboxes" id="check-all"><label class="form-check-label">&nbsp;</label></div></th>
                                    <th>Order</th>
                                    <th>Seller Name</th>
                                    <th>Event</th>
                                    <th>Ticket Category</th>
                                    <th>Qty</th>
                                    <th>Notes</th>
                                    <th>Ticket Type</th>
                                    <th>Ticket File</th>
                                    <th class="w-10">Approve / Reject</th>
                                    <th>&nbsp;</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <!-- <tr>
                                    <td tabindex="0" class="dt-checkboxes-cell" style="">
										<div class="form-check custom-checkbox"><input type="checkbox" class="form-check-input dt-checkboxes"><label class="form-check-label">&nbsp;</label></div>
									</td>
                                    <td>1BX04012</td>                                 
                                    <td>Rajveer</td>
                                    <td>Manchester United Vs <br>Manchester City<br>
                                       <span class="tr_date"> 14/05/2023</span>  <span class="tr_date">15:00 PM</span>
                                    </td>
                                    <td>Longside Central <br>Lower </td>
                                    <td>2</td>
                                    <td>
                                       <a class="tooltip_texts" data-toggle="tooltip" data-placement="right" title="" data-original-title="Meet Up with Seller" aria-describedby="tooltip173041"><i class="fas fa-comment-dots"></i></a>
                                    </td>                                 
                                    <td>E-Tickets</td>
                                    <td>Ticket 1</td>
                                    <td>
                                       <div class="reject_btn">
                                          <button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave">
                                          <a class="button is-danger" href="javascript:void(0);" onclick="">
                                          Reject
                                          </a>
                                          </button>
                                       </div>
                                       <div class="approve_btn">
                                          <button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave"><a class="button is-success" href="javascript:void(0);" onclick="">
                                          Approve
                                          </a>
                                          </button>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="dropdown">
                                          <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
                                             <i class="mdi mdi-dots-vertical fs-sm"></i>
                                          </a>
                                          <div class="dropdown-menu dropdown-menu-right">
                                             <a href="#" class="dropdown-item">View</a>
                                             <a href="#" class="dropdown-item">Download </a>
                                             <a href="#" class="dropdown-item">Upload </a>
                                             <a href="#" class="dropdown-item">Replace </a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>                                  -->

                              </tbody>
                           </table>
                        </div>

                        <div class="fixed-table-pagination arrow_pos">
                           <!-- <div class="float-left pagination-detail">
                              <div class="approve_all_select">
                                 <button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave" id="approve_all_order">
                                    <a class="button is-success" href="javascript:void(0);">Approve All Selected</a>
                                 </button>
                              </div>
                           </div> -->


                        <!-- <div class="float-right pagination">
                           <ul class="pagination">
                              <li class="page-item page-pre">
                                 <a class="page-link" aria-label="previous page" href="javascript:void(0)"><i class="fas fa-angle-left"></i></a>
                              </li>
                              <li class="page-item active">
                                 <a class="page-link" aria-label="to page 1" href="javascript:void(0)">1</a>
                              </li>
                              <li class="page-item">
                                 <a class="page-link" aria-label="to page 2" href="javascript:void(0)">2</a>
                              </li>
                              <li class="page-item">
                                 <a class="page-link" aria-label="to page 3" href="javascript:void(0)">3</a>
                              </li>
                              <li class="page-item">
                                 <a class="page-link" aria-label="to page 4" href="javascript:void(0)">4</a>
                              </li>
                              <li class="page-item"><a class="page-link" aria-label="to page 5" href="javascript:void(0)">5</a>
                              </li>
                              <li class="page-item"><a class="page-link" aria-label="to page 6" href="javascript:void(0)">6</a>
                              </li>
                              <li class="page-item page-next">
                                 <a class="page-link" aria-label="next page" href="javascript:void(0)"><i class="fas fa-angle-right"></i></a>
                              </li>
                           </ul>
                        </div>
                       </div> -->
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
<?php 

$this->load->view(THEME.'/common/footer'); ?>

<script type="text/javascript">
	$(document).ready(function() {


      $(document).on("click", ".download_e_ticket", function() {
  //$(".download_ticket").click(function() {
    var orderId = $(this).data("booking-id");
    window.location.href = '<?php echo base_url(); ?>tickets/get_download_record/'+orderId
   //  $.ajax({
	// 					url: '<?php //echo base_url();?>game/get_encrpty_id ',
	// 					type: 'POST',
	// 					dataType: "json",
	// 					data: {  booking_id: orderId  },
	// 					success: function (response) {        
   //                   window.location.href = '<?php //echo base_url(); ?>game/get_download_record/'+orderId
	// 					},
	// 					error: function () {
	// 					console.log('Failed');
	// 					}
	// 				});
  
  });
    
      $("body").on('click','.dropdown-menu-custom .check_box, .seat_category_check_box',function(e){
    //    alert('dd');
    e.stopPropagation();
});

      $("body").on('click','.dropdown-menu-custom .check_box, .ticket_status_check_box',function(e){
    //    alert('dd');
    e.stopPropagation();
});

         $("#check-all").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });

  // Add an onchange event to the checkbox
  $('#approve_orders').on('change', 'input[type="checkbox"]', function() {

  var allChecked = true;
    $('table tbody input[type="checkbox"]').each(function() {
      if(!$(this).is(":checked")) {
        allChecked = false;
      }
    });
    $("#check-all").prop('checked', allChecked);

  });

  // Populate the data table with dynamic data
  //Dtable.ajax.reload();
  var overlay = $('#overlay');
	var Dtable =  $('#approve_orders').DataTable({
		 'info' : false,		 
          'processing': false,
          "targets": 'no-sort',
		"bSort": false,
      "pageLength" : 50,
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
            toolTipShow(); 
         },
          'serverSide': true,
          'serverMethod': 'post',
        "ajax": {
            url : base_url + 'tickets/get_items/approve_reject/pending',
			data: function (d) {
            var booking_no = $("#booking_no").val();
            var fromDate = document.getElementById('MyTextbox3').value;
		   	var toDate = document.getElementById('MyTextbox2').value;
            var event_name = $("#event_name").val();
            var checkedIds = [];
               $(".check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  checkedIds.push(newID);
               });

               var seatIds = [];
               $(".seat_category_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("seatCheck", "");     

                  seatIds.push(newID);
               });

               var ticketStatusIds;
               $(".ticket_status_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("tstatusCheck", "");     

                  ticketStatusIds = newID;
               });

            d.seller_name = checkedIds;
            d.seat = seatIds;
            d.ticket_status = ticketStatusIds;
            d.booking_no = booking_no;
            d.start_date = fromDate;
			   d.end_date = toDate;
            d.event_name = event_name;
                },
                beforeSend: function() {
      // Show the overlay before the AJAX call
      overlay.show();
    },
  complete: function() {
    // Hide loader after receiving the response
    overlay.hide();
    bind_record='<div class="float-left pagination-detail"><div class="approve_all_select"><button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave" id="approve_all_order"><a id="approve_all_btn" class="button is-success" href="javascript:void(0);">Approve All Selected</a> </button> </div></div>';
   
   //var targetRow = $('#approve_orders_wrapper').find('.row').eq(2);                            
// Append bind_record to the element with class "col-md-5"
    //targetRow.find('.col-md-5').append(bind_record);

    var targetRow = $('#approve_orders_wrapper').find('.row').eq(2);
var colMd5Element = targetRow.find('.col-md-5');

// Check if bind_record is already present in the colMd5Element
if (colMd5Element.find('.float-left.pagination-detail').length === 0) {
  // Append bind_record to colMd5Element
  colMd5Element.append(bind_record);
} 

  },
          
        },

        
		"targets": 'no-sort',
		"bSort": false,
		'columns': [
			 { data: 'total' },
             { data: 'booking_no' },
			 { data: 'seller' },
			 { data: 'match_name' },
			 { data: 'seat_category' },
			 { data: 'quantity' },
			 { data: 'notes' },
			 { data: 'ticket_type' },
			 { data: 'ticket_instruction' },
			 { data: 'approve_or_reject' },
			 { data: 'action' },
          ]
		
		});

      $('.search_ok').on('click', function (e) {
         Dtable.draw();
      })

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

             $('.ticket_status').on('click', function (e) {
               
               var ticket_status = $("input[name=ticket_status]:checked").val();

               if(ticket_status == 1){
                  $('#approve_all_order').removeClass("disabled");

               }
               else{
                  $('#approve_all_order').addClass("disabled");
               }
            
             
         $('.ticket_status_btn').addClass("filter_active");
         Dtable.draw();
      });

             $('.seller_reset').click(function () {
               $('.seller_name_btn').removeClass("filter_active");
         $('.seller_name_btn').text("Seller Name");  
         $("#seller_name").val('');
         $('.check_box input:checked').removeAttr('checked');
         $('#seller_name').trigger('keyup');
     // 
    });

             $('.order_reset').click(function () {
               $('.order_id_search_filter').removeClass("filter_active");
               $("#booking_no").val("");
               Dtable.draw();
               });

      $('.event_reset').click(function () {
               $('.event_search_btn').removeClass("filter_active");
               $("#event_name").val("");
               Dtable.draw();
               });
      $('.date_reset').click(function () {
               $('.date_search_filter').removeClass("filter_active");
               $("#MyTextbox2").val("");
               $("#MyTextbox3").val("");
               Dtable.draw();
               });

    $(".seat_category_check_box").change(function() { 
         var checkedCount = $('.seat_category_check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.ticket_category_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.ticket_category_btn').text("Ticket Category");  
            
         });

    $(".ticket_status_check_box").change(function() { 
         var checkedCount = $('.ticket_status_check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.ticket_status_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.ticket_status_btn').text("Ticket Status");  
            
         });

         $("#ticket_category").keyup(function() { // Bind to the keyup event of the textbox
     
     var searchText = $(this).val(); // Get the text entered in the textbox
     $.ajax({
       url: base_url + 'accounts/get_ticket_category',
       type: "POST",
       cache: false,
       data: { search_text: searchText }, // Pass the search text to the PHP script
       success: function(response) {
         $(".seat_category_check_box").html(response); // Bind the response data to the checkbox container
         Dtable.draw();
       }
     });     
   });

      // Start Datepicker functionality


     // Get the datepicker input element
      const datepicker = document.getElementById('MyTextbox2');
      const to_datepicker = document.getElementById('MyTextbox3');

      // Initialize the datepicker
      $(datepicker).datepicker({
         dateFormat: 'dd-mm-yy',
         changeMonth: true, changeYear: true
         
      }
      );
      $(to_datepicker).datepicker({
         dateFormat: 'dd-mm-yy',
         changeMonth: true, changeYear: true,
      });



      $('.date_search').click(function (event) {
         $('.date_search_filter').addClass("filter_active");

         const fromDate = document.getElementById('MyTextbox3').value;
         const toDate = document.getElementById('MyTextbox2').value;

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

      // End of Datepicker functionality

      $('.clear_all').click(function () {
        
         $('.date_search_filter').removeClass("filter_active");
         $('.order_id_search_filter').removeClass("filter_active");
         $('.seller_name_btn').removeClass("filter_active");
         $('.event_name_filter').removeClass("filter_active");
         $('.ticket_category_btn').removeClass("filter_active");
         $('.ticket_status_btn').removeClass("filter_active");

         $("#booking_no").val('');
         $("#seller_name").val('');
         $("#event_name").val('');
         $('.seller_reset').trigger('click');
         $('.seat_category_check_box input:checked').removeAttr('checked');
          $('.ticket_status_check_box input:radio').removeAttr('checked');
          $('#approve_all_order').removeClass("disabled");
          $('.ticket_category_btn').text("Ticket Category"); 
          $('.ticket_status_btn').text("Ticket Status"); 
         $('.ticket_status_check_box input[type="radio"]').each(function(i, v){
         if($(v).prop('checked')) { 
         $(this).prop('checked', false); 
         }

         })
         $('.seat_category_check_box input[type="checkbox"]').each(function(i, v){
         if($(v).prop('checked')) { 
         $(this).prop('checked', false); 
         }

         })
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         // trigger your desired action here
         Dtable.draw();

      });

      $('.category_reset').click(function () {
         $('.ticket_category_btn').removeClass("filter_active");
         $('.ticket_category_btn').text("Ticket Category");  
         $("#ticket_category").val('');
         $('.seat_category_check_box input:checked').removeAttr('checked');
         $('#ticket_category').trigger('keyup');
// 
   });


      $('.ticket_status_reset').click(function () {
         $('.ticket_status_btn').removeClass("filter_active");
         $('.ticket_status_btn').text("Ticket Status");  
         $('.ticket_status_check_box input:radio').removeAttr('checked');
         $('#approve_all_order').removeClass("disabled");
          $('.ticket_status_check_box input[type="radio"]').each(function(i, v){
   if($(v).prop('checked')) { 
      $(this).prop('checked', false); 
    }
     
  })
          Dtable.draw();
// 
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

      $('.order_id_search').click(function () {
         $('.order_id_search_filter').addClass("filter_active");
         Dtable.draw();
      });

      
      $("body").on('click',' #approve_tkt_orders',function(e){

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
                  url: base_url + 'game/orders/ajax_update_ticket_status',
                  method: "POST",
                  data : {"ticket_id" : order_id,"status" : 2,"org_order_id" : org_order_id},
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

                     }
                     else {
                     swal('Updation Failed !', result.msg+" <br/>"+result.update_cnt+" <br/>"+result.failed_update_cnt, 'error');

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
            }
      });
    //  $('#approve_all_order').click(function (event) {
         $(document).on('click', '#approve_all_order', function() {
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
		var data_btn = "approve_tkt_orders";
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

        /* const order_id = [];
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
                  url: base_url + 'game/orders/ajax_update_ticket_status',
                  method: "POST",
                  data : {"ticket_id" : order_id,"status" : 2,"org_order_id" : org_order_id},
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

                     }
                     else {
                     swal('Updation Failed !', result.msg+" <br/>"+result.update_cnt+" <br/>"+result.failed_update_cnt, 'error');

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
      

	});

   $("body").on('click',' #approve_reject',function(e){

var bg_id = $(this).attr('data-bg-id');
var status = $(this).attr('data-ticket-status');
var data_close_modal = $(this).attr('data-close-modal');
var ticket_type =$(this).attr('data-ticket-type');
var reason = "";
         if (status == 6) {
            reason = prompt("Please Enter the reason for Rejection ", "Invalid File Format.");
         }
         $.ajax({
            url: base_url + 'game/orders/update_ticket_status',
	         method: "POST",
	        data : {"ticket_id" : bg_id,"status" : status,"ticket_type" : ticket_type,"reason" : reason},          
              dataType: 'json',
             success: function(result) {

                 if (result) {

                     swal('Updated !', result.msg, 'success');

                 } else {
                     swal('Updation Failed !', result.msg, 'error');

                 }					
            $('#'+data_close_modal).modal("hide");  
            setTimeout(function () { window.location.reload(); }, 2000);
             }
         });
});

	function update_ticket_status(id,status,ticket_type){

      var data_title = "Are you sure want to change Ticket Status ?";
		var data_sub_title = "Approve or Reject Ticket !";
		var data_yes = "Yes, Change it!";
		var data_no = "No, cancel!";
		var data_btn = "approve_reject";
		var data_target = "approve_reject_target";
		var data_bg_id = id;
		var data_status = status;
		var data_ticket_type = ticket_type;
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
/*swal({
   title: 'Are you sure want to change E-Ticket Status ?',
   text: "Approve or Reject E-Ticket !",
   type: 'warning',
   showCancelButton: true,  
   confirmButtonText: 'Yes, Change it!',
   cancelButtonText: 'No, cancel!',
   confirmButtonClass: 'button h-button is-primary btn btn-primary ',
   cancelButtonClass: 'button h-button is-danger btn btn-danger',
   buttonsStyling: false
 }).then(function (res) {


   if (res.value == true) {
	 var reason = "";
	 if(status == 6){
	  reason = prompt("Please Enter the reason for Rejection ", "Invalid File Format.");
	 }
	 


	 $.ajax({
	   url: base_url + 'game/orders/update_ticket_status',
	   method: "POST",
	   data : {"ticket_id" : id,"status" : status,"ticket_type" : ticket_type,"reason" : reason},
	   dataType: 'json',
	   success: function (result) {

		  if (result) {

		   swal('Updated !', result.msg, 'success');

		 }
		 else {
		   swal('Updation Failed !', result.msg, 'error');

		 }

		 setTimeout(function () { window.location.reload(); }, 2000);
	   }
	 });
   }
   else {

   }



 }, function (dismiss) {

 });*/


 


}
// $(document).ajaxSend(function() {
       
//       });

function popitup(url)
{
  // url='https://phplaravel-871000-3013214.cloudwaysapps.com/seller_v1/uploads/e_tickets/1662181951.png';
   newwindow=window.open(url,'name','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,,height=500,width=700');
if (window.focus) {newwindow.focus()}
return false;

}

function toolTipShow()
{
   //$('[data-toggle="tooltip"]').tooltip();

   var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})


}

</script>
<?php exit; ?>
