<style>
.check_box_status {
    padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
}
	</style>
<?php $this->load->view(THEME.'common/header'); ?>
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
               <h3 class="mb-1">Seller Markup Lists</h3>

               <div class="float-sm-right mt-3 mt-sm-0 team_lists_bttn">
                  <a href="<?php echo base_url();?>settings/seller_settings/add_seller_settings"  class="btn btn-success mb-2">Add Seller Markup</a>
                </div>
            </div>
         </div>
      </div>
      <!-- page content -->
      <div class="page-content-wrapper mt--45 all_orders_page">
         <div class="container-fluid">

         <!-- <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-sm-9 col-md-4">
                      
                  </div>
                  <div class="col-sm-3 col-md-8">
                      <div class="float-sm-right mt-3 mt-sm-0">                               
                      
                      <div class="float-sm-right mt-3 mt-sm-0">
                        <a href="<?php echo base_url();?>settings/seller_settings/add_seller_settings"  class="btn btn-success mb-2">Add Seller Markup</a>
                      </div>
                      </div>
                  </div>
                </div>
            </div>
          </div> -->

            <div class="card">
               <div class="card-body">

                 <!-- <filter code> -->

                  <div class="">
                     <table style='width:100% !important' id="seller-markup-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
                              <th>User</th>
                              <th>Markup Type</th>
                              <th>Markup</th>
                              <th>Status</th>
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
   var Dtable = $('#seller-markup-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         'scrollX': !0,
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'settings/get_seller_markup_list',
            data: function (d) {

                var country_id = [];
               $(".check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("country_id_", "");     

                  country_id.push(newID);
               });

               d.country = country_id;
              
            
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
            { data: 'user_id' },
            { data: 'markup_type' },
            { data: 'markup' },
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

        $('.dropdown-menu-custom .check_box').click(function(e){
            e.stopPropagation();
        });
        $('.dropdown-menu-custom .check_box_status').click(function(e){
            e.stopPropagation();
        });

        $('.country_search').on('click', function (e) {
         $('.country_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
      });


      $(".clear_all").on('click', function(){
          $('.country_search_filter').removeClass("filter_active");
          $('.status_search_filter').removeClass("filter_active");
          $('.country_search_filter ').text("Country Name");
          $('.status_search_filter ').text("Status");  
          //$(".check_box").prop('checked', false);
          $('.check_box input:checked').prop('checked', false);
          $(".status").prop('checked', false);
          Dtable.ajax.reload();
    });

    $('.status_search').on('click', function (e) {
         $('.status_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
      });

      $(".check_box").change(function() { 
         var checkedCount = $('.check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.country_search_filter ').text(checkedCount+" Selected");
         } 
         else 
            $('.country_search_filter ').text("Country Name");  
            
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

});
</script>