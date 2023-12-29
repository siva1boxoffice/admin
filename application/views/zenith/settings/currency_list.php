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
               <h3 class="mb-1">Currency Lists</h3>
               <div class="float-sm-right mt-3 mt-sm-0 add_team_s">
                   <a href="<?php echo base_url();?>settings/currency/add_currency"  class="btn btn-success mb-2">Add Currency</a>
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
                                             <button class="btn btn-light dropdown-toggle event_name_filter" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Currency Code <i class="mdi mdi-chevron-down"></i>
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
                                                    <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info code_reset" >Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info event_search_ok">Search</button></div>
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
                                                Status <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                   <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                   <div id="view_project_list_filter" class="dataTables_filter">
                                                      <!-- <label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="status_type"></label> -->
                                                   </div>
                                                </div>
                                                   
                                                   <!-- <div class="seat_category_check_box"> -->
                                                   <div class="status_check" style="padding: 0 15px; margin-top: 15px; margin-bottom: 15px;">
                                                      <div class="custom-control custom-checkbox">
                                                         <input type="checkbox" class="custom-control-input" id="status1">
                                                         <label class="custom-control-label" for="status1">Active</label>
                                                      </div>
                                                      <div class="custom-control custom-checkbox">
                                                         <input type="checkbox" class="custom-control-input" id="status0">
                                                         <label class="custom-control-label" for="status0">InActive</label>
                                                      </div>
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
                                       <a class="clear_all" href="javascript:void(0)">Clear All</a>
                                    </li>

                                  </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                   </div> 

                  <div class="">
                     <table style='width:100% !important' id="currency-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
                              <th>Currency Type</th>
                              <th>Currency Code</th>
                              <th>Currency Symbol</th>
                              <th>Price Difference</th>
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

      $("body").on('click','.dropdown-menu-custom .check_box, .status_check',function(e){
                    e.stopPropagation();
                });

    var overlay = $('#overlay');
   var Dtable = $('#currency-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         // 'scrollX': !0,
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'settings/get_currency_list',
            data: function (d) {

               var statusIds = [];
               $(".status_check input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("status", "");     

                  statusIds.push(newID);
               });

               var event_name = $("#event_name").val();
               d.currency_code = event_name;
               d.status_type = statusIds;
            
            
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
            { data: 'name' },
            { data: 'currency_code' },
            { data: 'symbol' },
			{ data: 'price_difference' },	
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
          $('.event_name_filter').removeClass("filter_active");
          $('.status_type_btn').removeClass("filter_active");
          $('.country_search_filter ').text("Country Name");
          $('.status_search_filter ').text("Status"); 
          $('#event_name').val(''); 
          //$(".check_box").prop('checked', false);
          $('.check_box input:checked').prop('checked', false);
          $('input:checked').prop('checked', false);
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

         $('.status_type_search').on('click', function (e) {
               $('.status_type_btn').addClass("filter_active");
               
                Dtable.draw();
                });

                $('.event_search_ok').on('click', function (e) {
         $('.event_name_filter').addClass("filter_active");
         Dtable.draw();
      });

      $('.code_reset').click(function () {          
         $('.event_name_filter').removeClass("filter_active");
         $("#event_name").val(''); // clear selected date value
       
         Dtable.ajax.reload(); 
      });

      $('.status_reset').click(function () {          
         $('.status_type_btn').removeClass("filter_active");
         $('input:checked').prop('checked', false);       
         Dtable.ajax.reload(); 
      });


});
</script>