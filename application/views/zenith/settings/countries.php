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
               <h3 class="mb-1">Country Lists</h3>
                <div class="float-sm-right mt-3 mt-sm-0 add_team_s">
                   <a href="<?php echo base_url();?>settings/countries/add"  class="btn btn-success mb-2">Add Country</a>
                 </div>
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
                                             <button class="btn btn-light dropdown-toggle country_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Country Name <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id='country_search_box'></label></div>
                                             </div>
                                                <div class="check_box">
                                                     <?php if($countries){
                                                        foreach ($countries as $key => $value) {
                                                          ?>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input country_id" id="country_id_<?php echo $value->id;?>" name="country[]" value="<?php echo $value->id;?>">
                                                    <label class="custom-control-label" for="country_id_<?php echo $value->id;?>"><?php echo $value->name;?></label>
                                                  </div>
                                              <?php } }  ?>


                                                </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
                                                   <div class="reset_ok"><button class="btn btn-info country_search">Search</button></div>
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
                     <table style='width:100% !important' id="country-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
                              <th>Country Name</th>
                              <th>Sort Name</th>
                              <th>Phone Code</th>
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
   var Dtable = $('#country-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         'scrollX': !0,
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'settings/get_country_list',
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
            { data: 'country_name' },
            { data: 'sortname' },
            { data: 'phonecode' },
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