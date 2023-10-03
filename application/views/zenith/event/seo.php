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
               <h3 class="mb-1">SEO List</h3>
            </div>
         </div>
      </div>
      <!-- page content -->
      <div class="page-content-wrapper mt--45 all_orders_page">
         <div class="container-fluid">

            <div class="card">
               <div class="card-body">
                  <div class="">
                     <table style='width:100% !important' id="seo-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
                              <th>Match Name</th>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Status</th>
							  <th>View</th>
							  <th>Lasted updated</th>
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
   var Dtable = $('#seo-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         'scrollX': !0,
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'event/get_seo_list',
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
            { data: 'match_name' },
            { data: 'meta_title' },
			{ data: 'meta_description' },
			{ data: 'status' },
			{ data: 'view' },
			{ data: 'enq_date' },       		
         ],
		 columnDefs: [
		{ 
		  targets: 2,  // Targeting the third column (index starts from 0)
		  render: function(data, type, row) {
			return '<div class="line-wrap">' + data + '</div>';
		  }
		},
        { 
		  targets: 1,  // Targeting the third column (index starts from 0)
		  render: function(data, type, row) {
			return '<div class="line-wrap">' + data + '</div>';
		  }
		}
	  ]
   });

  

});
</script>