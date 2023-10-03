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
.line-wrap {
	white-space: normal !important;
	word-wrap: break-word;
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
               <h3 class="mb-1">Contact Enquiry List</h3>
            </div>
         </div>
      </div>
      <!-- page content -->
      <div class="page-content-wrapper mt--45 all_orders_page">
         <div class="container-fluid">

            <div class="card">
               <div class="card-body">
                  <div class="">
                     <table style='width:100% !important' id="enquiry-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
                              <th>SL.NO.</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Mobile no</th>
							  <th>Country</th>
							  <th>Message</th>
							  <th>Enquiry date</th>
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
   var Dtable = $('#enquiry-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         'scrollX': !0,
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'tickets/get_enquiry_list',
            data: function (d) {
            
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
            { data: 's_no' },
            { data: 'name' },
			{ data: 'email' },
			{ data: 'mobile' },
			{ data: 'country_name' },
			{ data: 'message' },
			{ data: 'enq_date' },
			{ data: 'action' },           		
         ],
		 columnDefs: [
		{ 
		  targets: 5,  // Targeting the third column (index starts from 0)
		  render: function(data, type, row) {
			return '<div class="line-wrap">' + data + '</div>';
		  }
		}
	  ]
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

					setTimeout(window.location.reload(),1000);

}
});

}
</script>