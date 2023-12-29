<?php $this->load->view(THEME.'common/header'); ?>
<div id="overlay">
  <div id="loader">
    <!-- Add your loading spinner HTML or image here -->
    <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
  </div>
</div>

<div class="main-content">
      <!-- content -->
      <div class="page-content">
        <!-- page header -->
        <div class="page-title-box tick_details">
          <div class="container-fluid">
            <div class="row">
               <div class="col-sm-8">
                  <h5 class="card-title">Event Logs</h5>
               </div>
               <div class="col-sm-4">
                  <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">                     
					 <a href="<?php echo base_url() . 'home/index';?>" class="btn btn-primary mb-2 mt-3">Back</a>
                        <!-- <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2 ml-2">Save</a> -->
                  </div>
               </div>
            </div>
          </div>
        </div>
        <!-- page content -->
        <div class="page-content-wrapper mt--45 box-details">
          <div class="container-fluid">
            <div class="card">
               <div class="card-body">            
                  <div class="row">
                     <div class="col-lg-12">
                        <ul class="nav nav-tabs nav-bordered tabs">
                            <li class="nav-item">
                              <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Events
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                Search Events
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#messages-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Events Details
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#messages-b2" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Block Ticket
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#messages-b3" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Block Details
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#messages-b4" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Reservation
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#messages-b5" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Orders
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="#messages-b6" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Orders Details
                              </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                           <div class="tab-pane show active" id="home-b1">
                              <div class="row">
                                <div class="col-12">
                                  <div class="card listing_details">
                                    <div class="">
                                          <table style='width:100% !important' class="table table-hover table-nowrap table_details_new home-b1" data-tabname='Events'>
                                             <thead class="thead-light">
                                                <tr>
                                                   <th data-priority="1">Events</th>
                                                   <th data-priority="1">Partner Name</th>
                                                   <th data-priority="1">Request</th>
                                                   <th data-priority="3">Response</th>
                                                   <th data-priority="1">Date</th>
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
                           <div class="tab-pane" id="profile-b1">
						   <div class="row">
                                <div class="col-12">
                                  <div class="card listing_details">
                                    <div class="">
                                          <table style='width:100% !important' class="table table-hover table-nowrap table_details_new profile-b1" data-tabname='Search Events'>
                                             <thead class="thead-light">
                                                <tr>
                                                   <th data-priority="1">Events</th>
                                                   <th data-priority="1">Partner Name</th>
                                                   <th data-priority="1">Request</th>
                                                   <th data-priority="3">Response</th>
                                                   <th data-priority="1">Date</th>
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
                           <div class="tab-pane" id="messages-b1">
						   <div class="row">
                                <div class="col-12">
                                  <div class="card listing_details">
                                    <div class="">
                                          <table style='width:100% !important' class="table table-hover table-nowrap table_details_new messages-b1" data-tabname='Events Details'>
                                             <thead class="thead-light">
                                                <tr>
                                                   <th data-priority="1">Events</th>
                                                   <th data-priority="1">Partner Name</th>
                                                   <th data-priority="1">Request</th>
                                                   <th data-priority="3">Response</th>
                                                   <th data-priority="1">Date</th>
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
                           <div class="tab-pane" id="messages-b2">
						   <div class="row">
                                <div class="col-12">
                                  <div class="card listing_details">
                                    <div class="">
                                          <table style='width:100% !important' class="table table-hover table-nowrap table_details_new messages-b2" data-tabname='Block Ticket'>
                                             <thead class="thead-light">
                                                <tr>
                                                   <th data-priority="1">Events</th>
                                                   <th data-priority="1">Partner Name</th>
                                                   <th data-priority="1">Request</th>
                                                   <th data-priority="3">Response</th>
                                                   <th data-priority="1">Date</th>
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
                           <div class="tab-pane" id="messages-b3">
						   <div class="row">
                                <div class="col-12">
                                  <div class="card listing_details">
                                    <div class="">
                                          <table style='width:100% !important' class="table table-hover table-nowrap table_details_new messages-b3" data-tabname='Block Details'>
                                             <thead class="thead-light">
                                                <tr>
                                                   <th data-priority="1">Events</th>
                                                   <th data-priority="1">Partner Name</th>
                                                   <th data-priority="1">Request</th>
                                                   <th data-priority="3">Response</th>
                                                   <th data-priority="1">Date</th>
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
                           <div class="tab-pane" id="messages-b4">
                             <div class="row">
                                <div class="col-12">
                                  <div class="card listing_details">
                                    <div class="">
                                          <table style='width:100% !important' class="table table-hover table-nowrap table_details_new messages-b4" data-tabname='Reservation'>
                                             <thead class="thead-light">
                                                <tr>
                                                   <th data-priority="1">Events</th>
                                                   <th data-priority="1">Partner Name</th>
                                                   <th data-priority="1">Request</th>
                                                   <th data-priority="3">Response</th>
                                                   <th data-priority="1">Date</th>
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
                           <div class="tab-pane" id="messages-b5">
						   <div class="row">
                                <div class="col-12">
                                  <div class="card listing_details">
                                    <div class="">
                                          <table style='width:100% !important' class="table table-hover table-nowrap table_details_new messages-b5" data-tabname='Orders'>
                                             <thead class="thead-light">
                                                <tr>
                                                   <th data-priority="1">Events</th>
                                                   <th data-priority="1">Partner Name</th>
                                                   <th data-priority="1">Request</th>
                                                   <th data-priority="3">Response</th>
                                                   <th data-priority="1">Date</th>
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
                           <div class="tab-pane" id="messages-b6">
						   <div class="row">
                                <div class="col-12">
                                  <div class="card listing_details">
                                    <div class="">
                                          <table style='width:100% !important' class="table table-hover table-nowrap table_details_new messages-b6" data-tabname='Orders Details'>
                                             <thead class="thead-light">
                                                <tr>
                                                   <th data-priority="1">Events</th>
                                                   <th data-priority="1">Partner Name</th>
                                                   <th data-priority="1">Request</th>
                                                   <th data-priority="3">Response</th>
                                                   <th data-priority="1">Date</th>
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
            </div>
          </div>
        </div>
      </div>
      <!-- main content End -->
    </div>
<?php $this->load->view(THEME.'common/footer'); ?>
<script>
	
$(document).ready(function() {

	
  $('.tabs a').click(function(e) {
    e.preventDefault();
    var target = $(this).attr('href');
	var avoid = "#";
	var table_name=target.replace(avoid, '');    
	var overlay = $('#overlay');
	var name = $('.'+table_name).data('tabname');

	var table = $('.'+table_name);
	if ($.fn.DataTable.isDataTable(table)) {
	table.DataTable().destroy();
	}

	var Dtable = $('.'+table_name).DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         // 'scrollX': !0,
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'partner/get_event_log_list',
            data: function (d) {	
				d.query=name			
            
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
            { data: 'request_type' },
            { data: 'partner' },
			{ data: 'request' },
			{ data: 'response' },            
			{ data: 'date' },			
         ],
  	 });
  });
  $('.tabs li:first-child a').get(0).click();
});

</script>