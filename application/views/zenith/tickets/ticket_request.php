<style>
.check_box_status {
    padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
}
.ticket_check_box {
    padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
}
.form-group
{
	width:100px !important;
}
	</style>
<?php $this->load->view(THEME.'common/header');
  $tournments   = $this->General_Model->get_tournments()->result();
   ?>
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
               <h3 class="mb-1">Ticket Request List</h3>
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
                                                   <button class="btn btn-light dropdown-toggle event_name_filter" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Event Name <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" id="event_name" name="event_name" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info match_id_rest">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info event_search_ok">Search</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>

										  <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle tournament_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Tournaments <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id='tournament_search_box'></label></div>
                                             </div>
                                                <div class="check_box">
                                                     <?php if($tournments){
                                                        foreach ($tournments as $key => $value) {
                                                          ?>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input tournament_id" id="tournament_id<?php echo $key;?>" name="tournament[]" value="<?php echo $value->t_id;?>">
                                                    <label class="custom-control-label" for="tournament_id<?php echo $key;?>"><?php echo $value->tournament_name;?></label>
                                                  </div>
                                              <?php } }  ?>


                                                </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
                                                   <div class="reset_ok"><button class="btn btn-info tournament_search">Search</button></div>
                                                </div>                                               

                                             </div>
                                          </div>
                                       </div>
                                    </li>

								<!-- 	<li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle status_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Ticket Status <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div class="check_box">
                                                 
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status0" name="status[]" value="0">
                                                    <label class="custom-control-label" for="status0">Open</label>
                                                  </div>
                                                  
                                                    <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status1" name="status[]" value="1">
                                                    <label class="custom-control-label" for="status1">Closed</label>
                                                  </div>
                                                </div>
                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info status_search">Search</button></div>
                                                      </div>
                                                
                                             </div>
                                          </div>
                                       </div>
                                    </li> -->

									<li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle ticket_status_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Status <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div class="ticket_check_box">
                                                 
                                                  <!-- <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input ticket_status" id="ticket_status0" name="ticket_status[]" value="all">
                                                    <label class="custom-control-label" for="ticket_status0">All</label>
                                                  </div>
                                                  
                                                    <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input ticket_status" id="ticket_status1" name="ticket_status[]" value="upcoming">
                                                    <label class="custom-control-label" for="ticket_status1">Upcoming</label>
                                                  </div>
                                                

												<div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input ticket_status" id="ticket_status2" name="ticket_status[]" value="expired">
                                                    <label class="custom-control-label" for="ticket_status2">Expired</label>
                                                  </div>
                                                  
                                                    <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input ticket_status" id="ticket_status3" name="ticket_status[]" value="open">
                                                    <label class="custom-control-label" for="ticket_status3">Open</label>
                                                  </div>
                                                

												<div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input ticket_status" id="ticket_status4" name="ticket_status[]" value="closed">
                                                    <label class="custom-control-label" for="ticket_status4">Closed</label>
                                                  </div>
												  </div> -->


												<div class="custom-control radio radio-primary ">
													<input type="radio" name="ticket_status" class="custom-control-input" id="all" value="all">
													<label class="custom-control-label" for="ticket_status0">All</label>
													</div>
													<div class="custom-control radio radio-primary ">
													<input type="radio" name="ticket_status" class="custom-control-input" id="upcoming" value="upcoming">
													<label class="custom-control-label" for="ticket_status1">Upcoming</label>
													</div>
													<div class="custom-control radio radio-primary ">
													<input type="radio" name="ticket_status" class="custom-control-input" id="expired" value="expired">
													<label class="custom-control-label" for="ticket_status2">Expired</label>
													</div>
													<div class="custom-control radio radio-primary ">
													<input type="radio" name="ticket_status" class="custom-control-input" id="open" value="open">
													<label class="custom-control-label" for="ticket_status3">Open</label>
													</div>
													<div class="custom-control radio radio-primary ">
													<input type="radio" name="ticket_status" class="custom-control-input" id="closed" value="closed">
													<label class="custom-control-label" for="ticket_status4">Closed</label>
												</div>
                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info ticket_status_search">Search</button></div>
                                                      </div>
                                                
                                             </div>
                                          </div>
                                       </div>
                                    </li>

                                    <li class="sort_list">
                                       <a class="clear_all" href="javascript:void(0)">Clear All</a>
                                    </li>

                                  </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="">
                     <table style='width:100% !important' id="ticket-request-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
                              <th>Request ID</th>
                              <th>Event</th>
                              <th>Tournment</th>
                              <th>Quantity</th>
							  <th>Request By</th>
							  <th>Request On</th>
							  <th>Ticket Status</th>
							  <th>Action</th>
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

<?php $this->load->view(THEME.'common/footer'); ?>
<script>
	 $(document).ready(function () {
    var overlay = $('#overlay');
   var Dtable = $('#ticket-request-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         'scrollX': !0,
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'tickets/get_ticket_request_list',
            data: function (d) {
				var event_name = $("#event_name").val();

				var tournament_ids= '';
                     $('.tournament_id').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = tournament_ids.length===0?'':',';
                                 tournament_ids += (comma+e.value);
                        }
                     });


					 var statuss= '';
                     $('.status').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = statuss.length===0?'':',';
                                 statuss += (comma+e.value);
                        }
					});

					// var ticket_statuss= '';
                    //  $('.ticket_check_box').each(function(i,e) {
                    //     if ($(e).is(':checked')) {
                    //              var comma = ticket_statuss.length===0?'':',';

                    //           //   if(e.value == 0 ) e.value = 2
					// 		  ticket_statuss += (comma+e.value);
                    //     }
					// });

					var ticketStatusIds;
               $(".ticket_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("ticket_status", "");     

                  ticketStatusIds = newID;
               });


				d.event_name = event_name;
				d.tournament_ids = tournament_ids;
				d.statuss = statuss;
				d.ticket_statuss = ticketStatusIds;
            
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
            { data: 'request_id' },
            { data: 'event_name' },
			{ data: 'tournament_name' },
			{ data: 'quantity' },
			{ data: 'full_name' },
			{ data: 'request_on' },
			{ data: 'status' },
			{ data: 'action' },           		
         ],
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

        // $('.dropdown-menu-custom .check_box').click(function(e){
        //     e.stopPropagation();
        // });
        // $('.dropdown-menu-custom .check_box_status').click(function(e){
        //     e.stopPropagation();
        // });
		// $('.dropdown-menu-custom .ticket_check_box').click(function(e){
        //     e.stopPropagation();
        // });
		$('.dropdown-menu-custom .check_box, .dropdown-menu-custom .check_box_status, .dropdown-menu-custom .ticket_check_box').click(function(e){
    			e.stopPropagation();
		});


        $('.country_search').on('click', function (e) {
         $('.country_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
      });


      $(".clear_all").on('click', function(){
		$('.event_name_filter').removeClass("filter_active");
		$('.tournament_search_filter').removeClass("filter_active");
		$('.status_search_filter').removeClass("filter_active");
		$('.ticket_status_search_filter').removeClass("filter_active");
          $('.status_search_filter').removeClass("filter_active");
          $('.country_search_filter ').text("Country Name");
          $('.status_search_filter ').text("Ticket Status");  
		  $('.ticket_status_search_filter').text("Status");
          //$(".check_box").prop('checked', false);
          $('.check_box input:checked').prop('checked', false);
		  $('.ticket_check_box input:checked').prop('checked', false);
          $(".status").prop('checked', false);
		  $("#tournament_search_box").val("");     
		  $('.search_box').trigger('keyup');
          Dtable.ajax.reload();
    });

    $('.status_search').on('click', function (e) {
         $('.status_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
      });

	  $('.ticket_status_search').on('click', function (e) {
         $('.ticket_status_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
      });	  

      $(".ticket_check_box").change(function() { 
		var checkedCount = $('.ticket_check_box input:checked').length;
       
	   if(checkedCount>0) 
	   {
		  $('.ticket_status_search_filter').text(checkedCount+" Selected");
	   } 
	   else 
		  $('.ticket_status_search_filter').text("Status");  
            
         });  

         $(".check_box_status").change(function() { 
         var checkedCount = $('.check_box_status input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.status_search_filter ').text(checkedCount+" Selected");
         } 
         else 
            $('.status_search_filter ').text("Status");  
            
         });

		 $('.event_search_ok').on('click', function (e) {
         $('.event_name_filter').addClass("filter_active");
         Dtable.ajax.reload();
      });

	  $('.tournament_search').on('click', function (e) {
         $('.tournament_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
      });

	  $('.status_search').on('click', function (e) {
         $('.status_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
      });

});

function update_enquiry_status_new(id,status,flag){

var action = base_url + "tickets/index/update_enquiry_status/";
$.ajax({
type: "POST",
dataType: "json",
url: action,
data: {"id":id,"status":status,"flag":flag},
success: function(data) {

					if(data.status == 1) {
						swal('Updated !', data.msg, 'success');
					}else if(data.status == 0) {
						swal('Updation Failed !', data.msg, 'error');
					
					}

					setTimeout(window.location.reload(),300);

}
});

}
</script>