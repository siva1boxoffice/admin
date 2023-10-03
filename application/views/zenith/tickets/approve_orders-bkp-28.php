
<style>
  .dataTables_processing {
  /* ../images/clear.png */
  background-image: url('../images/clear.png');
  background-position: center center;
  background-repeat: no-repeat;
}

</style>



<?php $this->load->view(THEME.'/common/header'); ?>

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

                        <div class="section_all ticket_sort_approval">
                           <div class="">
                              <!-- cta -->
                              <div class="row">
                                 <div class="col-md-1 nopadds">
                                    <div class="sort_by">
                                       <span>Filter By:</span>
                                    </div>
                                 </div>
                                 <div class="col-md-11">
                                    <div class="sort_filters">
                                       <ul>

                                          <li class="sort_list">Date</li>
                                          <li class="sort_list">
                                             <div class="form-group datemark">
                                                <input class="form-control" id="MyTextbox3" type="text" name="MyTextbox" placeholder="From">
                                             </div>
                                          </li>
                                          <li class="sort_list">
                                             <div class="form-group datemark_to">
                                                <input class="form-control" id="MyTextbox2" type="text" name="MyTextbox1" placeholder="To">
                                             </div>
                                          </li>
                                          <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Order ID <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="booking_no"></label></div>
                                                   </div>
                                                      
                                                      <div class="reset_btn">
                                                         <div class="reset_txt">Reset</div>
                                                         <div class="reset_ok" ><button class="search_ok">SubmitSS</button></div>
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
                                                   Seller Name <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
                                                    
                                                      <div class="reset_btn">
                                                         <div class="reset_txt">Reset</div>
                                                         <div class="reset_ok"><button>Ok</button></div>
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
                                                   Event Name <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
                                                      
                                                      <div class="check_box">
                                                        <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                          <label class="custom-control-label" for="customCheck1">Arnab Gupta</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                          <label class="custom-control-label" for="customCheck2">Ali Wikilins</label>
                                                        </div>
                                                      </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt">Reset</div>
                                                         <div class="reset_ok"><button>Ok</button></div>
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
                                                   Ticket Category <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <!-- <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <a class="dropdown-item" href="#">Supercopa De Italia</a>
                                                      <a class="dropdown-item" href="#">Super Lig</a>
                                                      <a class="dropdown-item" href="#">Test Tournament English2</a>
                                                   </div> -->
                                                </div>
                                             </div>
                                          </li>
                                          <li class="sort_list">
                                             <a class="clear_all" href="">Clear All</a>
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
                           <table id="approve_orders" class="table  table-hover table-nowrap mb-0">
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
                           <div class="float-left pagination-detail">
                              <div class="approve_all_select">
                                 <button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave">
                                    <a class="button is-success" href="javascript:void(0);" onclick="">Approve All Selected</a>
                                 </button>
                              </div>
                           </div>


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
<?php $this->load->view(THEME.'/common/footer'); ?>

<script type="text/javascript">
	$(document).ready(function() {

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

	var Dtable =  $('#approve_orders').DataTable({
		 'info' : false,		 
          'processing': true,
          "targets": 'no-sort',
		"bSort": false,
          "language": {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            loadingRecords: '&nbsp;',
            processing: 'Loading...'
  },
          'serverSide': true,
          'serverMethod': 'post',
        "ajax": {
            url : base_url + 'tickets/get_items/approve_reject/pending',
			data: function (d) {
            var booking_no = $("#booking_no").val();

            d.booking_no = booking_no;
                }
          
        },

        beforeSend: function() {
    // Show loader before sending the request
    $("#loader").show();
  },
  complete: function() {
    // Hide loader after receiving the response
    //$("#loader").hide();
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

      // Start Datepicker functionality

      // Get the datepicker input element
      const datepicker = document.getElementById('MyTextbox2');
      const to_datepicker = document.getElementById('MyTextbox3');

      // Initialize the datepicker
      $(datepicker).datepicker({
         onSelect: function (datesel) {
            $('#MyTextbox2').trigger('change')
         }, maxDate: new Date()
      }
      );
      $(to_datepicker).datepicker();

      $('#MyTextbox2').change(function (event) {

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

	});



   


	function update_ticket_status(id,status,ticket_type){

swal({
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

 });

}

</script>
<?php exit; ?>
