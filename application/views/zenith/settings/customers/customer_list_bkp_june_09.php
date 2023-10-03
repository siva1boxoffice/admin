
<style>
       .check_box,.seat_category_check_box {
    max-height: 250px;
    overflow-y: auto;
}
.page-title-box {
   color: #000!important;
}
.coupon_btn_save {
    background: #F6F8FA;
    padding: 15px 0;
    margin: 0 auto;
    text-align: center;
}
.add_new_customer .modal-header {
    padding: 30px 30px !important;
}
.add_new_customer .modal-title {
    color: #0037D5;
    font-size: 18px;
    font-weight: 700;
}
.basic_info {
    font-size: 16px;
    color: #000;
    font-weight: 700;
    margin: 0 0 7px 0;
}
.add_new_customer label {
    color: #4C5271;
    font-size: 14px;
    font-weight: 700;
    margin: 0px;
}
.add_new_customer .form-control {
    font-size: 15px;
    border-radius: 0px;
    height: 40px;
    border-color: #E8EAEF;
}
.add_new_customer .modal-body {
    padding: 0 30px 30px;
}

.sort_filters ul li:nth-last-child(1)
{
   background:#f2f6f7!important;
}
/* 
body {
      
      overflow-y: auto;
   }

   .table-responsive {
      overflow-y: hidden !important;
   }

   .pagination {
      position: fixed;
      bottom: 0;
      width: 100%;
   }

   a.paginate_button.current.page-link {
      color: #edf1f3;
      background-color: #00a3ed;
   }
    */
   </style>
<?php $this->load->view(THEME.'common/header');?>
         <!-- Begin main content -->
      <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="page-title dflex-between-center">
                     <h3 class="mb-1">Customer List</h3>

                     <!-- add customer -->
    <div class="add_new_customer mt-3">
<button type="button" class="btn btn-secondary add_customer" data-toggle="modal" data-target="#centermodal_add" fdprocessedid="1invro">Add New Customer</button>
      <div class="modal fade" id="centermodal_add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">Add New Customer</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
            <div class="create_coupon">
               <form>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="basic_info">Basic Info</div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="firstName">First Name</label>
                           <input type="text" id="firstName" class="form-control" placeholder="Enter First Name">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="lastNames">Last Name</label>
                           <input type="text" id="lastNames" class="form-control" placeholder="Enter Last Name">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="emailId">Email ID</label>
                           <input type="email" id="emailId" name="example-email" class="form-control" placeholder="Enter Email ID">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="PhoneNumber">Phone Number</label>
                           <input class="form-control" id="PhoneNumber" type="number" name="number" placeholder="Enter phone number">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="basic_info">Contact Info</div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="address">Street Address</label>
                           <input type="text" id="address" class="form-control" placeholder="Enter Street Address">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="zipCode">Zip Code</label>
                           <input type="text" id="zipCode" class="form-control" placeholder="Enter Zip Code">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="country">Country</label>
                            <select class="custom-select" id="add_customer_country" name="add_customer_country" onchange="get_state_city(this.value);" required>
                                 <option value="">Select Country</option>
                                    <?php foreach($countries as $country){ ?>
                                 <option <?php if($matches->country == $country->id){?> selected <?php } ?> value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                 <?php } ?>
                           </select> 
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="city">City</label>
                            <?php $cityArray = $this->General_Model->get_state_cities($matches->country); ?>   
                           <!-- id="add_customer_city" -->
                            <select class="custom-select" id="city" name="add_customer_city"  required>
                              <!-- <option value="">Select City</option> -->
                              <option value="">-Select City-</option>
                                 <?php 
                                       foreach ($cityArray as $cityArr) {
                                          ?>
                                          <option value="<?= $cityArr->id; ?>" <?php
                                          if ($matches->city): if ($matches->city == $cityArr->id) {
                                                   echo 'selected';
                                             } endif;
                                          ?>><?= $cityArr->name; ?></option>
                                                   <?php
                                             }
                                    ?>
                              
                            </select> 
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="customerStatus">Customer Status</label>
                           <div class="custom-control custom-switch">
                             <input type="checkbox" checked class="custom-control-input" id="customerStatus">
                             <label class="custom-control-label" for="customerStatus">Inactive / Active Customer Status </label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="Booking">Allow Offline Booking</label>
                           <div class="custom-control custom-switch">
                             <input type="checkbox" class="custom-control-input" id="Booking">
                             <label class="custom-control-label" for="Booking">No / Yes Offline Booking</label>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="basic_info">Login Info</div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="password">Password</label>
                           <input type="text" id="password" id="password" class="form-control" placeholder="Enter password">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="confirmPassword">Confirm Password</label>
                           <input type="text" id="confirmPassword" class="form-control" placeholder="Re-enter Password">
                        </div>
                     </div>
                  </div>
               </form>
               <div class="coupon_btn_save">
                <button type="button" class="btn btn-cancel">Cancel</button>
                <button type="button" class="btn btn-primary createCustomer" id="">Create</button>
              </div>
            </div>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div>
</div>
<!-- end add customer -->


                     <!-- <ol class="breadcrumb mb-0 mt-1">
                        <li class="breadcrumb-item">
                           <a href="../index.html">
                              <i class="bx bx-home fs-xs"></i>
                           </a>
                        </li>
                        <li class="breadcrumb-item">
                           <a href="calender.html">
                              Tickets
                           </a>
                        </li>
                        <li class="breadcrumb-item active">Ticket approval</li>
                     </ol> -->
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
                                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                            <li class="">
                                             <!-- <a class="report_sts" href="">Search</a> -->
                                             </li>                                      
                                            </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="table-responsive">
                           <table id="customer-datatable" class="table  table-hover table-nowrap mb-0 cust_lists">
                              <thead class="thead-light">
                                 <tr>
                                    <th>S.No</th>
                                    <th>Image</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
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
      </div>
      <!-- main content End -->
        <?php $this->load->view(THEME.'common/footer');?>
        <script>
            $(document).ready(function () {

$(document).on('click', '.add_customer', function() {
   $('.modal-title').text('Add New Customer');
   $('.updateCustomer').removeClass('updateCustomer').addClass('createCustomer');
      $('.createCustomer').text('Create');
});
               //////////////////////// Edit customer
               // Assuming you have a click event handler for the button that triggers the AJAX request
 $(document).on('click', '.edit_customer', function() {
   
  var customerId = $(this).data('cust-id'); // Retrieve the customer ID from the data attribute
 
  // Make the AJAX request to retrieve customer details
  $.ajax({
   url: base_url + 'settings/edit_customer_details',
   type: "POST",
   dataType: "json",
    data: { customerId: customerId },
    success: function(response) {
      // Open the modal
      //$('#centermodal_add').modal('show');

      

      // Change the modal title and update button text
      $('.modal-title').text('Edit Customer');
      $('.createCustomer').text('Update');
      $('.createCustomer').removeClass('createCustomer').addClass('updateCustomer');

      // Bind the values to the input fields
      $('#firstName').val(response.firstName);
      $('#lastNames').val(response.lastName);
      $('#emailId').val(response.email);
      $('#PhoneNumber').val(response.phoneNumber);
      $('#address').val(response.address);
      $('#zipCode').val(response.zipCode);

      // Select the corresponding country and city options
      $('#add_customer_country').val(response.country);
     // $('#add_customer_country').val(response.country).trigger('change');
     get_new_city(response.country,response.city);

      // Set the customer status and offline booking switches
      $('#customerStatus').prop('checked', parseInt(response.status));
     
      $('#Booking').prop('checked', parseInt(response.allow_offline));

      // Hide or disable any irrelevant fields based on your logic

      // Add event handlers or perform additional tasks if needed
    },
    error: function() {
      // Handle error case
    }
  });
});

               //////////////////////// Edit customer

               $('.btn-cancel').click(function (e){                     
                    $('#centermodal_add')
                              .find("input,textarea,select")
                                 .val('')
                                 .end()
                              .find("input[type=checkbox], input[type=radio]")
                                 .prop("checked", "")
                                 .end();
                    $('.close').trigger('click');
                 });

                 $('.close').click(function (e){                     
                    $('#centermodal_add')
                              .find("input,textarea,select")
                                 .val('')
                                 .end()
                              .find("input[type=checkbox], input[type=radio]")
                                 .prop("checked", "")
                                 .end();                   
                 });

                $("body").on('click','.dropdown-menu-custom .check_box, .status_check',function(e){
    //    alert('dd');
    e.stopPropagation();
});

                var Dtable = $('#customer-datatable').DataTable(
                    {
        'info': false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "ajax": {
            url: base_url + 'settings/get_customer_list',
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
            // $(".dataTables_paginate").addClass("page-link"),
            // $(".dataTables_paginate  .paginate_button").addClass("page-link")
            $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
         },
        'columns': [
            { data: 'i' },
            { data: 'user_image' },
            { data: 'customer_name' },
            { data: 'email' },
            { data: 'location' },
            { data: 'mobile' },
            { data: 'role' },
            { data: 'status' },
            { data: 'action' },
            
        ],
   //      createdRow: function(row, data, dataIndex) {
   //    $('td', row).each(function(colIndex) {
   //     // $(this).attr('title', data + dataIndex + '-' + colIndex);
   //     var columnData = data[Object.keys(data)[colIndex]];
   //      $(this).attr('title', columnData);
   //    });
   //  }
    });

    //{ data: 'navigation' },

             $('.search_ok').on('click', function (e) {
                Dtable.draw();
            });

            $('.clear_all').click(function () {
                $("#customer_name").val('');
                $('.status_reset').trigger('click');
                $('.country_reset').trigger('click');
                Dtable.draw();
            });

            $('.status_reset').click(function () {
                $('.status_type_btn').text("Status");  
                $("#status_type").val('');
                $('.status_check input:checked').removeAttr('checked');
                $('#status_type').trigger('keyup');    
             });

             $('.country_reset').click(function () {
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
                   // Dtable.draw();
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
                   // Dtable.draw();
                    }
                });     
             });

             $('.status_type_search').on('click', function (e) {
                Dtable.draw();
                });

                $('.country_search').on('click', function (e) {
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

             


                //$('.createCustomer').click(function() {
                  $(document).on('click', '.createCustomer', function() {
                  // Validate form fields
                  var firstName = $('#firstName').val();
                  var lastNames = $('#lastNames').val();
                  var emailId = $('#emailId').val();

                  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                  var PhoneNumber = $('#PhoneNumber').val();
                  var address = $('#address').val();
                  var zipCode = $('#zipCode').val();
                  add_customer_country
                  var country = $('#add_customer_country').val();
                //  var state = $('#add_customer_state').val();
                  var city = $('#city').val();
                  var password = $('#password').val();
                  var confirmPassword = $('#confirmPassword').val();
                  var dialing_code =$("#dialing_code").val();
                  var allow_offline =0;
                  if ($("#Booking").is(':checked')) 
                      allow_offline=1;                
                  
                  var status =0;
                  if ($("#customerStatus").is(':checked')) 
                     status=1;  

                  // Clear previous error messages
                  $('.form-control').removeClass('is-invalid');
               
                  // Check if any field is empty
                  if (firstName === '') {
                     $('#firstName').addClass('form-control is-invalid');
                  }
                  if (lastNames === '') {
                     $('#lastNames').addClass('form-control is-invalid');
                  }
                  // Check if email field is empty or does not match the pattern
                  if (emailId === '' || !emailPattern.test(emailId)) {                     
                     $('#emailId').addClass('form-control is-invalid');
                  }
                  
                  if (PhoneNumber === '') {
                     $('#PhoneNumber').addClass('form-control is-invalid');
                  }
                  if (address === '') {
                     $('#address').addClass('form-control is-invalid');
                  }
                  if (zipCode === '') {
                     $('#zipCode').addClass('form-control is-invalid');
                  }
                  if (country === '') {
                     $('#add_customer_country').addClass('form-control is-invalid');
                  }
                  // if (state === '') {
                  //    $('#add_customer_state').addClass('form-control is-invalid');
                  // }
                  if (city === '') {
                     $('#city').addClass('form-control is-invalid');
                  }
                  if (password === '') {
                     $('#password').addClass('form-control is-invalid');
                  }
                  if (confirmPassword === '') {
                     $('#confirmPassword').addClass('form-control is-invalid');
                  } 
                  if (password !== confirmPassword) {
                     $('#confirmPassword').addClass('form-control is-invalid');
                  }
               
                  // If there are any error messages, stop further processing
                  if ($('.is-invalid').length > 0) {
                     return;
                  }

                  $.ajax({
                           url: base_url + 'settings/customers/save_customer',
                           method: 'POST',
                           data: {
                           firstName: firstName,
                           lastNames: lastNames,
                           emailId: emailId,
                           PhoneNumber: PhoneNumber,
                           address: address,
                           zipCode: zipCode,
                           country: country,
                         //  state: state,
                           city: city,
                           password: password,
                           phonecode: "+91",
                           allow_offline: allow_offline,
                           status: status,
                           },
                           success: function(response) {
                           // Handle success response
                            swal('Updated !', response.msg, 'success');
                          setTimeout(window.location.reload(),300);

                           },
                           error: function(error) {
                           // Handle error response
                           }
                  });
               
                  });
                  ////////////////////// update customer
                  $(document).on('click', '.updateCustomer', function() {
                  // $('.updateCustomer').on('click',function() {
                     //alert('dfdfdf');
                  // Validate form fields
                  $('.form-control').removeClass('is-invalid');
                  var customerId = $('.edit_customer').data('cust-id');
                  var firstName = $('#firstName').val();
                  var lastNames = $('#lastNames').val();
                  var emailId = $('#emailId').val();

                  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                  var PhoneNumber = $('#PhoneNumber').val();
                  var address = $('#address').val();
                  var zipCode = $('#zipCode').val();
                  add_customer_country
                  var country = $('#add_customer_country').val();
                //  var state = $('#add_customer_state').val();
                  var city = $('#city').val();
                  var password = $('#password').val();
                  var confirmPassword = $('#confirmPassword').val();
                  var dialing_code =$("#dialing_code").val();
                  var allow_offline =0;
                  if ($("#Booking").is(':checked')) 
                      allow_offline=1;                
                  
                  var status =0;
                  if ($("#customerStatus").is(':checked')) 
                     status=1;  

                  // Clear previous error messages
                  $('.form-control').removeClass('is-invalid');
               
                  // Check if any field is empty
                  if (firstName === '') {
                     $('#firstName').addClass('form-control is-invalid');
                  }
                  if (lastNames === '') {
                     $('#lastNames').addClass('form-control is-invalid');
                  }
                  // Check if email field is empty or does not match the pattern
                  if (emailId === '' || !emailPattern.test(emailId)) {                     
                     $('#emailId').addClass('form-control is-invalid');
                  }
                  
                  if (PhoneNumber === '') {
                     $('#PhoneNumber').addClass('form-control is-invalid');
                  }
                  if (address === '') {
                     $('#address').addClass('form-control is-invalid');
                  }
                  if (zipCode === '') {
                     $('#zipCode').addClass('form-control is-invalid');
                  }
                  if (country === '') {
                     $('#add_customer_country').addClass('form-control is-invalid');
                  }
                  // if (state === '') {
                  //    $('#add_customer_state').addClass('form-control is-invalid');
                  // }
                  if (city === '') {
                     $('#city').addClass('form-control is-invalid');
                  }
                  // if (password === '') {
                  //    $('#password').addClass('form-control is-invalid');
                  // }
                  // if (confirmPassword === '') {
                  //    $('#confirmPassword').addClass('form-control is-invalid');
                  // } 
                  // if (password !== confirmPassword) {
                  //    $('#confirmPassword').addClass('form-control is-invalid');
                  // }
               
                  // If there are any error messages, stop further processing
                  if ($('.is-invalid').length > 0) {
                     return;
                  }

                  $.ajax({
                           url: base_url + 'settings/update_customer_details',
                           method: 'POST',
                           dataType: "json",
                           data: {
                           firstName: firstName,
                           lastNames: lastNames,
                           emailId: emailId,
                           PhoneNumber: PhoneNumber,
                           address: address,
                           zipCode: zipCode,
                           country: country,
                         //  state: state,
                           city: city,
                           password: password,
                           phonecode: "+91",
                           allow_offline: allow_offline,
                           status: status,
                           customerId:customerId
                           },
                           success: function(response) {
                           // Handle success response
                           console.log(response.msg);
                            swal('Updated !', response.msg, 'success');
                        setTimeout(window.location.reload(),300);

                           },
                           error: function(error) {
                           // Handle error response
                           }
                  });
               
                  });
                  /////////////////////  update customer
                     


            });

        </script>
                <?php exit;?>

