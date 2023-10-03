<style>
          .check_box,.seat_category_check_box {
    max-height: 250px;
    overflow-y: auto;
}

.sort_filters ul li:nth-last-child(1)
{
   background:#f2f6f7!important;
}

   </style>

<?php $this->load->view(THEME.'common/header');?>


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
                     <h3 class="mb-1">Partner List</h3>
                  </div>
               </div>
            </div>
            <!-- page content -->
            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">
                  <div class="card">
                     <div class="card-body">

                        <div class="section_all customer_list filter_new">
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
        <button class="btn btn-light dropdown-toggle name_filter" type="button" id="dropdownMenuButton"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <input type="hidden" name="customer_name_filterValue"  id="customer_name_filterValue" value="<?php echo $this->session->userdata('customer_name_filterValue'); ?>">
        <input type="hidden" name="status_type_filterValue" id="status_type_filterValue" value="<?php echo $this->session->userdata('status_type_filterValue'); ?>">
        <input type="hidden" name="country_filterValue" id="country_filterValue" value="<?php echo $this->session->userdata('country_filterValue'); ?>">
        Name<i class="mdi mdi-chevron-down"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
            <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" id="customer_name" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
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
            <button class="btn btn-light dropdown-toggle country_name_btn" type="button" id="dropdownMenuButton"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Country<i class="mdi mdi-chevron-down"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="country"></label></div>
            </div>
            <div class="check_box">
                
                <?php 
                    echo $this->data['country'];
                ?>
                </div>
                <div class="reset_btn">
                <div class="reset_txt"><button class="btn btn-info country_reset" >Reset</button></div>
                <div class="reset_ok"><button class="btn btn-info country_search">Search</button></div>
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
    <li class="sort_list">
     <!-- <a class="report_sts" href="">Search</a> -->
  </li>                                      
    </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="">
                           <table style='width:100% !important' id="api-partner-datatable" class="table table-hover table-nowrap mb-0">
                              <thead class="thead-light">
                              <tr>
                                    <th>S.No</th>
                                    <th>Image</th>
                                    <th>Partner Name</th>
                                    <th>Location</th>
                                    <th>Contact</th>
                                    <th>Role</th>
                                    <th>Status </th>
                                    <th>&nbsp;</th>                                  
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
                var Dtable = $('#api-partner-datatable').DataTable(
                    {
        'info': false,
        'scrollX': !0,
        'processing': true,
        'serverSide': true,
        "pageLength" : 50,
        'serverMethod': 'post',
        "ajax": {
            url: base_url + 'api/get_partner_list',
            data: function (d) {
                var customer_name = $("#customer_name").val();
                var statusIds = [];
               $(".status_check input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("status", "");     

                  statusIds.push(newID);
               });


               var countryIds = [];
               $(".check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("country", "");     

                  countryIds.push(newID);
               });

                d.customer_name = customer_name;
                d.status_type = statusIds;
                d.country = countryIds;

            },
            beforeSend: function() {
      // Show the overlay before the AJAX call
      overlay.show();
    },
    complete: function(d) {
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
            $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
         },
        'columns': [
            { data: 'i' },          
            { data: 'user_image' },  
            { data: 'name' },       
            { data: 'location' },
            { data: 'mobile' },
            { data: 'role' },
            { data: 'status' },
            { data: 'action' },
           
        ]
    });
    // { data: 'navigation' },

             $('.search_ok').on('click', function (e) {
               $('.name_filter').addClass("filter_active");
                Dtable.draw();
            });

            $('.clear_all').click(function () {
               $('.name_filter').removeClass("filter_active");
               $('.country_name_btn').removeClass("filter_active");
               $('.status_type_btn').removeClass("filter_active");

                $("#customer_name").val('');
                $('.status_reset').trigger('click');
                $('.country_reset').trigger('click');
                Dtable.draw();
            });

            $('.status_reset').click(function () {
               $('.status_type_btn').removeClass("filter_active");
                $('.status_type_btn').text("Status");  
                $("#status_type").val('');
             //   $('.status_check input:checked').removeAttr('checked');
                $('.status_check input[type="checkbox"]').prop('checked', false);
               // $('#status_type').trigger('keyup');   
               Dtable.draw(); 
             });

             $('.country_reset').click(function () {
               $('.country_name_btn').removeClass("filter_active");
                $('.country_name_btn').text("Country");  
                $("#country").val('');
                $('.checkbox input:checked').removeAttr('checked');
                $('#country').trigger('keyup');    
             });


    $(".status_check").change(function() { 
         var checkedCount = $('.status_check input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.status_type_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.status_type_btn').text("Status");  
            
         }); 


         $(".check_box").change(function() { 
         var checkedCount = $('.check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.country_name_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.country_name_btn').text("Country");  
            
         }); 

         

            $("#status_type").keyup(function() { // Bind to the keyup event of the textbox
                var searchText = $(this).val(); // Get the text entered in the textbox
                $.ajax({
                    url: base_url + 'settings/get_status_type',
                    type: "POST",
                    data: { search_text: searchText }, // Pass the search text to the PHP script
                    success: function(response) {
                    $(".status_check").html(response); // Bind the response data to the checkbox container
                    Dtable.draw();
                    }
                });     
             });

             $("#country").keyup(function() { // Bind to the keyup event of the textbox
                var searchText = $(this).val(); // Get the text entered in the textbox
                $.ajax({
                    url: base_url + 'settings/get_country_name',
                    type: "POST",
                    data: { search_text: searchText }, // Pass the search text to the PHP script
                    success: function(response) {
                    $(".check_box").html(response); // Bind the response data to the checkbox container
                    Dtable.draw();
                    }
                });     
             });

             $('.status_type_search').on('click', function (e) {
               $('.status_type_btn').addClass("filter_active");
               
                Dtable.draw();
                });

                $('.country_search').on('click', function (e) {
                  
                  $('.country_name_btn').addClass("filter_active");
                Dtable.draw();
                });


                $("#country").keyup(function() { // Bind to the keyup event of the textbox
                var searchText = $(this).val(); // Get the text entered in the textbox
                    $.ajax({
                        url: base_url + 'settings/get_country_name',
                        type: "POST",
                        data: { search_text: searchText }, // Pass the search text to the PHP script
                        success: function(response) {
                        $(".check_box").html(response); // Bind the response data to the checkbox container
                        Dtable.draw();
                        }
                    });     
                });


            });
        </script>

<?php exit;?>