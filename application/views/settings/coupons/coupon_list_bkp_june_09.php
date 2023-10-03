<?php $tournments   = $this->General_Model->get_tournments()->result();?>

<?php $this->load->view(THEME.'common/header');?>

<style>

.seat_category_check_box{
   padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;

}
label.error{
   font-size: 12px !important;
   color: RED;
       transform: unset !important;
}
   
   </style>
        <!-- Begin main content -->
      <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="page-title dflex-between-center mb-2">
                     <h3 class="mb-1">Coupon List</h3>
                     <div class="add_new_btn">
                        <a href="#" class="btn btn-primary waves-effect waves-light" data-effect="wave"  data-toggle="modal"
                              data-target="#centermodal" >
                            <i class="bx bx-plus bx-flashing"></i>
                            Add New
                         </a>
                      </div>
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

                        <div class="section_all coupon_list filter_new">
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

                                       <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Date <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                     
                                                   <form class="px-3 py-2">
                                                      <div class="row">
                                                         <div class="col-md-6">
                                                            <div class="form-group datemark">
                                                               <input class="form-control" id="MyTextbox3" type="text" name="MyTextbox" placeholder="From">
                                                            </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                            <div class="form-group datemark_to">
                                                               <input class="form-control" id="MyTextbox2" type="text" name="MyTextbox1" placeholder="To">
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </form>
                                                     
                                                   <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info date_search">Search</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                          <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle coupon_type_btn" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Coupon Type <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="coupon_type"></label></div>
                                                   </div>
                                                      <!-- <a class="dropdown-item" href="#">Supercopa De Italia</a>
                                                      <a class="dropdown-item" href="#">Super Lig</a>
                                                      <a class="dropdown-item" href="#">Test Tournament English2</a> -->
                                                      <div class="check_box">
                                                        <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                          <label class="custom-control-label" for="customCheck2">Percentage</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                          <label class="custom-control-label" for="customCheck1">Amount</label>
                                                        </div>
                                                      </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info coupon_reset">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info coupon_type_search">Search</button></div>
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
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="status_type"></label></div>
                                                   </div>
                                                      <!-- <a class="dropdown-item" href="#">Supercopa De Italia</a>
                                                      <a class="dropdown-item" href="#">Super Lig</a>
                                                      <a class="dropdown-item" href="#">Test Tournament English2</a> -->
                                                      <div class="seat_category_check_box">
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
                                             <a class="report_sts" href="">Search</a>
                                          </li>
                                       </ul>



                                      
                              
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="table-responsive coupon_list_tab">
                           <table style='width:100% !important' id="coupon-datatable" class="table table-responsive table-hover table-nowrap mb-0">
                              <thead class="thead-light">
                                 <tr>
                                    <th>S. No</th>
                                    <th>Coupon Code</th>
                                    <th>Used Count</th>
                                    <th>Remaining Count</th>
                                    <th>Coupon Type</th>
                                    <th>Currency</th>
                                    <th>Coupon Value</th>
                                    <th>Expiry Date</th>
                                    <th>Status </th>
                                    <th>&nbsp;</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <!-- <tr>
                                    <td>1</td>
                                    <td>WC2022</td>                                 
                                    <td>20</td>
                                    <td>5</td>
                                    <td>Amount </td>
                                    <td>USD</td>                               
                                    <td>200</td>
                                    <td>5 Mar 2023 to 15 Apr 2023</td>
                                    <td>
                                       <div class="bttns">
                                         <span class="badge badge-success">Active</span>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="dropdown">
                                          <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
                                             <i class="mdi mdi-dots-vertical fs-sm"></i>
                                          </a>
                                          <div class="dropdown-menu dropdown-menu-right">
                                             <a href="#" class="dropdown-item">View</a>
                                             <a href="#" class="dropdown-item">Edit </a>
                                             <a href="#" class="dropdown-item">Delete </a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr> -->
                              </tbody>
                           </table>
                        </div>
                     </div>                 
                  </div>
               </div>
            </div>
         </div>
      </div>


       <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered">
                                 <div class="modal-content">
                                   <div class="modal-header">
                                     <h4 class="modal-title" id="myCenterModalLabel">Create Coupon</h4>
                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                   </div>
                                   <div class="modal-body">
                                       <div class="create_coupon">
                                          <form id="coupon_form" method="post" class="coupon_form" action="<?php echo base_url();?>settings/discount_coupons/save_coupon" >
                                          <input type="hidden" name="id" id="c_id"  value="<?php echo $coupons->c_id;?>"> 

                                             <div class="row">
                                                   <div class="col-md-6">
                                                      <div class="form-group">
                                                         <label for="simpleinput">Tournaments</label>
                                                         <select class="form-control" name="t_id" id="t_id" onchange="call_defined(this.value)" >
                                                               <option value="">Please Choose Tournament</option>
                                                               <?php foreach ($tournments as $tournment) { ?>
                                                               <option value="<?php echo $tournment->t_id;?>" <?php if($tournment->t_id == $coupons->t_id){?> selected <?php } ?>><?php echo $tournment->tournament_name;?></option>
                                                                <?php } ?>
                                                         </select>
                                                      </div>
                                                   </div>

                                                     <div class="col-md-6">
                                                      <div class="form-group">
                                                         <label for="simpleinput">Matches</label>
                                                         <select class="form-control choose_match" id="m_id" name="m_id">
                                                               <option value="">Please Choose Tournament</option></select>
                                                      </div>
                                                   </div>
                                            </div>

                                             <div class="row">
                                                <div class="col-md-12">
                                                   <div class="form-group">
                                                      <label for="simpleinput">Coupon Code</label>
                                                      <input type="text" id="coupon_code" name="coupon_code"  class="form-control" placeholder="Enter coupon code here" placeholder="Enter Coupon Code" required value="<?php echo $coupons->coupon_code;?>" >
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput">Validity date</label>
                                                      <input type="text" id="create_date" name="create_date"  class="form-control"  autocomplete="off" placeholder="From" required>
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput">&nbsp;</label>
                                                      <input type="text" name="expiry_date" id="expiry_date" class="form-control" autocomplete="off"  placeholder="To" required>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput">Coupon Type * </label>
                                                      <select class="custom-select form-control" name="coupon_type" id="coupon_type" >
                                                        <option value="1" <?php if('1' == $coupons->coupon_type){?> selected <?php } ?>>Amount</option>
                                                      <option value="2" <?php if('2' == $coupons->coupon_type){?> selected <?php } ?>>Percentage</option>
                                                   </select>
                                                   </div>
                                                </div>


                                                 <div class="col-md-6">
                                                   <div class="form-group">
                                                      <label>Coupon Value</label>
                                                      <div class="input-group">
                                                         <div class="input-group-prepend">
                                                            <span class="input-group-text rounded-0" id="basic-addon1"><img src="<?php echo base_url();?>assets/zenith_assets/images/dollar.svg" class="mCS_img_loaded"></span>
                                                         </div>
                                                         <input type="text" id="coupon_value" name="coupon_value" class="form-control" placeholder="Enter Coupon Value" required value="<?php echo $coupons->coupon_value;?>">
                                                      </div>
                                                      <label id="coupon_value-error" class="error" for="coupon_value"></label>
                                                   </div>
                                                </div>

                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput">Min Price Range *</label>
                                                      <input type="text" id="min_price" name="min_price" class="form-control" placeholder="Enter Min Price" required value="<?php echo $coupons->min_price;?>">
                                                   </div>
                                                </div>

                                                 <div class="col-md-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput">Max Price Range *</label>
                                                      <input type="text" id="max_price" name="max_price" class="form-control" placeholder="Enter Max Price" required value="<?php echo $coupons->max_price;?>">
                                                   </div>
                                                </div>

                                               
                                             </div>


                                                <div class="coupon_btn_save">
                                              <button type="button" class="btn btn-cancel" data-dismiss="modal" >Cancel</button>
                                              <button type="submit" class="btn btn-primary">Submit</button>

                                          </form>
                                          
                                         </div>
                                       </div>
                                   </div>
                                 </div><!-- /.modal-content -->
                               </div><!-- /.modal-dialog -->
      <!-- main content End -->
        <?php $this->load->view(THEME.'common/footer');?>
<script>
     $(document).ready(function () {

      $("body").on('click','.dropdown-menu-custom .check_box, .seat_category_check_box',function(e){
    //    alert('dd');
    e.stopPropagation();
});

var Dtable = $('#coupon-datatable').DataTable(
    {
        'info': false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "ajax": {
            url: base_url + 'settings/get_item',
            data: function (d) {
               var fromDate = document.getElementById('MyTextbox3').value;
               var toDate = document.getElementById('MyTextbox2').value;

               var checkedIds = [];
               $(".check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("customCheck", "");     

                  checkedIds.push(newID);
               });


               var statusIds = [];
               $(".seat_category_check_box input:checked").each(function() {
                  
                  var ID = $(this).attr('id');
                  var newID = ID.replace("status", "");     

                  statusIds.push(newID);
               });

               d.coupon_type = checkedIds;
               d.status_type = statusIds;
               d.event_start_date = fromDate;
               d.event_end_date = toDate;
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
            { data: 'coupon_code' },

            { data: 'c_id' },
            { data: 'c_id' },

            { data: 'c_type' },
            { data: 'currency' },
            { data: 'coupon_value' },   
            { data: 'expiry_date' },         
            { data: 'status' },            
            { data: 'action' },    
            
                 
           
        ]
    });

    $('.clear_all').click(function () {
              
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         $('.coupon_reset').trigger('click');
         $('.status_reset').trigger('click');
         //Dtable.draw();

      });

      $('.coupon_reset').click(function () {
         $('.coupon_type_btn').text("Coupon Type");  
         $("#coupon_type").val('');
         $('.check_box input:checked').removeAttr('checked');
         $('#coupon_type').trigger('keyup');
     // 
    });

    $("#coupon_type").keyup(function() { // Bind to the keyup event of the textbox
      var searchText = $(this).val(); // Get the text entered in the textbox
      $.ajax({
        url: base_url + 'settings/get_coupon_type',
        type: "POST",
        data: { search_text: searchText }, // Pass the search text to the PHP script
        success: function(response) {
          $(".check_box").html(response); // Bind the response data to the checkbox container
          Dtable.draw();
        }
      });     
    });

    $('.status_reset').click(function () {
         $('.status_type_btn').text("Status");  
         $("#status_type").val('');
         $('.seat_category_check_box input:checked').removeAttr('checked');
         $('#status_type').trigger('keyup');
     // 
    });


    $("#status_type").keyup(function() { // Bind to the keyup event of the textbox
      var searchText = $(this).val(); // Get the text entered in the textbox
      $.ajax({
         url: base_url + 'settings/get_status_type',
        type: "POST",
        data: { search_text: searchText }, // Pass the search text to the PHP script
        success: function(response) {
          $(".seat_category_check_box").html(response); // Bind the response data to the checkbox container
          Dtable.draw();
        }
      });     
    });



    const datepicker = document.getElementById('MyTextbox2');
      const to_datepicker = document.getElementById('MyTextbox3');

      // Initialize the datepicker
      $(datepicker).datepicker({
        
          dateFormat: 'yy-mm-dd' 
      }
      );
      $(to_datepicker).datepicker(
         { dateFormat: 'yy-mm-dd' }
      );

      $('.date_search').click(function (event) {

         const fromDate = document.getElementById('MyTextbox3').value;
         const toDate = document.getElementById('MyTextbox2').value;
         console.log('Chosen date:', toDate);

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

      $(".check_box").change(function() { 
         var checkedCount = $('.check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.coupon_type_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.coupon_type_btn').text("Coupon Type");  
            
         }); 
         
         $(".seat_category_check_box").change(function() { 
         var checkedCount = $('.seat_category_check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.status_type_btn').text(checkedCount+" Selected");
         } 
         else 
            $('.status_type_btn').text("Status");  
            
         }); 

         
         $('.coupon_type_search').on('click', function (e) {
         Dtable.draw();
         });

         $('.status_type_search').on('click', function (e) {
         Dtable.draw();
         });

        


         
});



          function call_defined(t,w=''){
            console.log(t +" "+ w);
                    $.ajax({
                          type: "POST",
                          url: "<?php echo base_url();?>settings/discount_coupons/change_tournment",
                          data: {
                            t_id: t,
                            m_id: w,
                          },
                          success: function(odata) {
                            data=jQuery.parseJSON(odata);
                            if (data.status==1) {
                                $('.choose_match').html(data.val);
                            }else{
                                $('.choose_match').html("<option value=''>Change Tournament</option>");
                            }
                          }
                        });  
                }


               
               // Initialize the datepicker
               $("#create_date").datepicker({
                 
                   dateFormat: 'yy-mm-dd' ,
                    minDate: 0,

              onSelect: function () {


                  var expiry_date = $('#expiry_date');
                  var startDate = $(this).datepicker('getDate');
                  //add 30 days to selected date
                  startDate.setDate(startDate.getDate() + 30);
                  var minDate = $(this).datepicker('getDate');
                  var expiry_dateDate = expiry_date.datepicker('getDate');
                  //difference in days. 86400 seconds in day, 1000 ms in second
                  var dateDiff = (expiry_dateDate - minDate)/(86400 * 1000);

                  //expiry_date not set or dt1 date is greater than expiry_date date
                  if (expiry_dateDate == null || dateDiff < 0) {
                          expiry_date.datepicker('setDate', minDate);
                  }
                  //dt1 date is 30 days under expiry_date date
                  else if (dateDiff > 30){
                          expiry_date.datepicker('setDate', startDate);
                  }
                  //sets expiry_date maxDate to the last day of 30 days window
                  expiry_date.datepicker('option', 'maxDate', startDate);
                  //first day which can be selected in expiry_date is selected date in dt1
                  expiry_date.datepicker('option', 'minDate', minDate);

              },

             onClose: function(dateText, inst) {
                $("#expiry_date").focus();
            }
               
               }
               );
               $("#expiry_date").datepicker(
                  { dateFormat: 'yy-mm-dd' }
               );

        $('.coupon_form').validate({
           submitHandler: function(form) {
            
            var myform = $('#'+$(form).attr('id'))[0];
             //is-loading no-click
            // branch-form-btn
            var formData = new FormData(myform);

            // $('#'+$(form).attr('id')+'-btn').addClass("is-loading no-click");

            // $('.has-loader').addClass('has-loader-active');
             
            var action = $(form).attr('action');
             $.ajax({
               type: "POST",
               enctype: 'multipart/form-data',
               url: action,
               data: formData,
               processData: false,
               contentType: false,
               cache: false,
               dataType: "json",

               success: function(data) { 

              //   $('#'+$(form).attr('id')+'-btn').removeClass("is-loading no-click");

                 if(data.status == 1) {
                  
                     swal('Updated !', data.msg, 'success').then(function() {
                         window.location.reload();
                     });
                     // setTimeout(function(){ window.location.reload();  }, 2000);
                   // notyf.success(data.msg, "Success", {
                   // timeOut: "1800"
                   // });
                  // setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
                 }else if(data.status == 0) {

                   swal('Updation Failed !', data.msg, 'error');

                   //  notyf.error(data.msg, "Failed", "Oops!", {
                   // timeOut: "1800"
                   // });
                   //setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
                   
                 }
               }
             })
             return false;
           }
         });


        $("body").on("click",".load_coupon_edit",function(){
            var id  = $(this).data('id');
           $.ajax({
               url: base_url + 'settings/discount_coupons/coupon_by_id/' + id,
              type: "GET",// Pass the search text to the PHP script
              success: function(response) {
              
                   data=jQuery.parseJSON(response);
                    //   alert(data);
                  $(".coupon_form #c_id").val(data.c_id);
                  if(data.t_id){
                     $(".coupon_form #t_id").val(data.t_id);

                  }

                  call_defined(data.t_id,data.m_id);
                 
                  $(".coupon_form #coupon_code").val(data.coupon_code);
                  $(".coupon_form #create_date").val(data.create_date);
                  $(".coupon_form #coupon_type").val(data.coupon_type);
                  $(".coupon_form #coupon_value").val(data.coupon_value);
                  $(".coupon_form #expiry_date").val(data.expiry_date);
                  $(".coupon_form #min_price").val(data.min_price);
                  $(".coupon_form #max_price").val(data.max_price);
                   //$(".coupon_form #m_id").val(data.m_id);
                   event.preventDefault();
                   jQuery.noConflict();

                   $("#centermodal").modal('show');
              }
            });
        });
</script>