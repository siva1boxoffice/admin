
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
                     <h3 class="mb-1">Credit Note List</h3>
                     <div class="add_new_btn">
                        <a href="#" class="btn btn-primary add_coupon" >
                            <!-- <i class="bx bx-plus bx-flashing"></i> -->
                            Add New
                         </a>
                      </div>
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
                                             <button class="btn btn-light dropdown-toggle event_name_filter" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Credit Note <i class="mdi mdi-chevron-down"></i>
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
                                                   <button class="btn btn-light dropdown-toggle date_search_filter" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Date <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                     
                                                   <form class="px-3 py-2">
                                                      <div class="row">
                                                         <div class="col-md-6">
                                                            <div class="form-group datemark">
                                                               <input class="form-control" id="MyTextbox3" type="text" name="MyTextbox" placeholder="From" autocomplete='off'>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                            <div class="form-group datemark_to">
                                                               <input class="form-control" id="MyTextbox2" type="text" name="MyTextbox1" placeholder="To" autocomplete='off'>
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
                                                   <button class="btn btn-light dropdown-toggle status_type_btn" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Status <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list" id="status_type"></label></div>
                                                   </div>
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
                           <table style='width:100% !important' id="coupon-datatable" class="table  table-hover table-nowrap mb-0">
                              <thead class="thead-light">
                                 <tr>
                              
                                    <th>Credit Note Code</th>
                                    <th>Coupon Type</th>
                                    <th>Currency</th>
                                    <th>Coupon Value</th>
                                    <th>Remaining Balance</th>
                                    <th>Expiry Date</th>
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


       <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="myCenterModalLabel">Create Credit Note</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                  <div class="create_coupon coupon_popup">
                     <form id="coupon_form" method="post" class="coupon_form" action="<?php echo base_url();?>settings/credit_note_coupons/save_coupon" >
                     <input type="hidden" name="id" id="c_id"  value="<?php echo $coupons->c_id;?>"> 
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="simpleinput">Credit Note Code*</label>
                                 <input type="text" id="coupon_code" name="coupon_code"  class="form-control" placeholder="Enter coupon code here" placeholder="Enter Coupon Code" required value="<?php echo $coupons->coupon_code;?>" >
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="simpleinput">Validity Date*</label>
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
                           <div class="col-md-4" style="display:none;">
                              <div class="form-group">
                                 <label for="simpleinput">Coupon Type * </label>                                 
                                 <select class="custom-select check_credit_note" name="coupon_type" id="coupon_type" required >
                                    <option value="1">Amount</option>
                              </select>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="simpleinput">Currency</label>
                                 
                                 <select class="custom-select" name="coupon_currency" id="coupon_currency" required >
                                 <option value="" >Choose</option>
                                 <?php if($currency){
                                    foreach ($currency as $key => $value) {
                                       ?>  
                                    <option value="<?php echo $value->id;?>"><?php echo $value->currency_code;?></option>                                                        
                                    <?php } }  ?>
                                 </select>
                              </div>
                           </div>


                              <div class="col-md-4" id="dollar" >
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

                           <div class="col-md-5" id="coupon_balance_div" >
                              <div class="form-group">
                                 <label>Remaining Balance</label>
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text rounded-0" id="basic-addon1"><img src="<?php echo base_url();?>assets/zenith_assets/images/dollar.svg" class="mCS_img_loaded"></span>
                                    </div>
                                    <input type="text" id="coupon_balance"  class="form-control" placeholder="Remaining Balance" required value="" disabled style="background:#f3f7f9;">
                                 </div>                                                    
                                 <label id="coupon_value-error" class="error" for="coupon_balance"></label>
                              </div>
                           </div>   

                        </div>
                        <div class="row">
                           <div class="col-md-6" style="display:none;">
                              <div class="form-group">
                                 <label for="simpleinput">Limit</label>
                                 <input type="text" id="usage_limit" name="usage_limit" class="form-control" placeholder="Enter Limit" required value="1" autocomplete="off">
                              </div>
                           </div>  
                                                                     
                        </div>
                        <div class="row">
                           <div class="col-md-6" style="display:none;">
                        <div class="form-check">
                                      
                                                  <input class="form-check-input check_credit_note" type="checkbox" id="credit_note" name="credit_note" value="1" >
                                         <label class="form-check-label" for="credit_note">
                                          Mark as to use in Credit Note
                                         </label></div>
                          </div>
                        </div>

                           <div class="coupon_btn_save">
                           <button type="button" class="btn btn-cancel" data-dismiss="modal" >Cancel</button>
                           <button type="submit" id="coupon_submit" class="btn btn-primary">Submit</button>

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

      $("#coupon_value").keyup(function() {   
         var inputValue = $(this).val();     
         /*inputValue = inputValue.replace(/[^0-9]/g, '');*/
         $(this).val(inputValue);
         $('#coupon_balance').val(inputValue);
      });

      $("#usage_limit").keyup(function() {  
         var inputValue = $(this).val();     
         inputValue = inputValue.replace(/[^0-9]/g, '');
         $(this).val(inputValue);
         });

      $(document).on('change', '.check_credit_note', function() {
        if ($('#credit_note').prop('checked')==true){ 
          var coupon_type = $("#coupon_type").val();
          if(coupon_type != 1){
            //alert("Coupon type percentage not applicable for credit note.You can Choose only Fixed amount.");
            swal('Updation Failed !', "Coupon type percentage not applicable for credit note.You can Choose only Fixed amount.", 'error');
            $("#coupon_submit").attr('disabled', 'disabled');
          }
          else{
            $("#coupon_submit").removeAttr('disabled');
          }
          
      }
      else{
         $("#coupon_submit").removeAttr('disabled');
      }
      });

      $(document).on('change', '#coupon_type', function() {
         var selectedVal = $(this).val();
         console.log(selectedVal);
         if (selectedVal == 1) {
            $('#coupon_currency').css('pointer-events','visible');
            $('#coupon_currency').attr('required', 'required');
            $('#dollar').show();
            $('#percent').hide();
            
         } else {
            $('#coupon_currency').css('pointer-events','none');
            $('#coupon_currency').removeAttr('required', 'required');
            $('#percent').show();
            $('#dollar').hide();
         }       
      });

      $("body").on('click','.dropdown-menu-custom .check_box, .seat_category_check_box',function(e){
    //    alert('dd');
    e.stopPropagation();
});

var Dtable = $('#coupon-datatable').DataTable(
    {
        'info': false,
        'processing': true,
        'serverSide': true,
        // 'scrollX': !0,
        'serverMethod': 'post',
        "ajax": {
            url: base_url + 'settings/get_credit_note_item',
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

               var credit_note = $("#event_name").val();

               d.coupon_type = checkedIds;
               d.status_type = statusIds;
               d.event_start_date = fromDate;
               d.event_end_date = toDate;               
               d.credit_note = credit_note;
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
            { data: 'coupon_code' },
            { data: 'c_type' },
            { data: 'currency' },
            { data: 'coupon_value' },   
            { data: 'remaining_coupon_value' },   
            { data: 'expiry_date' },         
            { data: 'status' },            
            { data: 'action' },              
        ]
    });

    $('.clear_all').click(function () {
      $('.event_name_filter').removeClass("filter_active");
      $('.date_search_filter').removeClass("filter_active");
      $('.coupon_type_btn').removeClass("filter_active");
      $('.status_type_btn').removeClass("filter_active");
      
         $("#MyTextbox2").datepicker("setDate", null); // clear selected date value
         $("#MyTextbox3").datepicker("setDate", null); // clear selected date value
         $('#event_name').val(''); 
         $('.coupon_reset').trigger('click');
         $('.status_reset').trigger('click');
        // Dtable.draw();

      });


      $('.event_search_ok').on('click', function (e) {
         $('.event_name_filter').addClass("filter_active");
         Dtable.draw();
      });

      $('.code_reset').click(function () {          
         $('.event_name_filter').removeClass("filter_active");
         $("#event_name").val(''); 
         Dtable.ajax.reload(); 
      });

      $('.coupon_reset').click(function () {
         $('.coupon_type_btn').removeClass("filter_active");
         $('.coupon_type_btn').text("Coupon Type");  
         $("#coupon_type").val('');
         $('.check_box input:checked').removeAttr('checked');
         $('#coupon_types').trigger('keyup');
     // 
    });

    $("#coupon_types").keyup(function() { // Bind to the keyup event of the textbox
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
      $('.status_type_btn').removeClass("filter_active");
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
      const create_date = document.getElementById('create_date');

      // Initialize the datepicker
      $(datepicker).datepicker({
        
          dateFormat: 'dd-mm-yy' ,
          changeMonth:true,
         changeYear:true,
      }
      );
      $(to_datepicker).datepicker(
         { dateFormat: 'dd-mm-yy',
            changeMonth:true,
         changeYear:true,}
      );


      $(create_date).datepicker( { dateFormat: 'dd-mm-yy',minDate: 0 ,   changeMonth:true,
         changeYear:true,});
     $(create_date).datepicker({
            onSelect: function () {

                var expiry_date = $('#expiry_date');
                var startDate = $('#create_date').datepicker('getDate');
                //add 30 days to selected date
                startDate.setDate(startDate.getDate() + 30);
                var minDate = $('#create_date').datepicker('getDate');
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
             
             });

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
         $('.date_search_filter').addClass("filter_active");

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
            $('.coupon_type_btn').addClass("filter_active");
         Dtable.draw();
         });

         $('.status_type_search').on('click', function (e) {
            $('.status_type_btn').addClass("filter_active");
            
         Dtable.draw();
         });

        // Initialize the datepicker
       


         
});



          function call_defined(t,w=''){
            console.log(t +" "+ w);
                  //   $.ajax({
                  //         type: "POST",
                  //         url: "<?php //echo base_url();?>settings/credit_note_coupons/change_tournment",
                  //         data: {
                  //           t_id: t,
                  //           m_id: w,
                  //         },
                  //         success: function(odata) {
                  //           data=jQuery.parseJSON(odata);
                  //           if (data.status==1) {
                  //               $('.choose_match').html(data.val);
                  //           }else{
                  //               $('.choose_match').html("<option value=''>Change Tournament</option>");
                  //           }
                  //         }
                  //       });  
                }


               
               
               $("#expiry_date").datepicker(
                  { dateFormat: 'dd-mm-yy',
                     minDate: 0,
                     changeMonth:true,
         changeYear:true, }
               );

        $('.coupon_form').validate({
           submitHandler: function(form) {
            
            var myform = $('#'+$(form).attr('id'))[0];
            var formData = new FormData(myform);
            if ($('#credit_note').prop('checked')==true){ 
            formData.append('credit_note', 1);
            }
             
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
                 if(data.status == 1) {
                  
                     swal('Updated !', data.msg, 'success').then(function() {
                         window.location.reload();
                     });
                     
                 }else if(data.status == 0) {

                   swal('Updation Failed !', data.msg, 'error');                   
                 }
               }
             })
             return false;
           }
         });

        $("body").on("click",".add_coupon",function(){
         
         
         $(".coupon_form select, .coupon_form input").val("");

                  event.preventDefault();
                 

                   $("#centermodal").modal('show');
                   $('#myCenterModalLabel').text('Create Credit Note');
                   $(".coupon_form #coupon_type").val(1);
                   $(".coupon_form #usage_limit").val(1);
                   $(".coupon_form #credit_note").attr('checked','checked');
        });
        $("body").on("click",".load_coupon_edit",function(){
            var id  = $(this).data('id');
           $.ajax({
               url: base_url + 'settings/credit_note_coupons/coupon_by_id/' + id,
              type: "GET",// Pass the search text to the PHP script
              success: function(response) {            
                   data=jQuery.parseJSON(response);     
                  // console.log("Coupon Type"+data.coupon_type);              
                  $(".coupon_form #c_id").val(data.c_id);
                  if(data.coupon_type==1)
                  {
                     $('#dollar').show();
                     $('#percent').hide();
                     $('#coupon_currency').css('pointer-events','visible');
                      $('#coupon_currency').attr('required', 'required');            
                  }
                  else if(data.coupon_type==2)
                  {
                     $('#dollar').hide();
                     $('#percent').show();
                     $('#coupon_currency').css('pointer-events','none');
                     $('#coupon_currency').removeAttr('required', 'required');
                  }
                  if(data.t_id){
                     $(".coupon_form #t_id").val(data.t_id);

                  }

                  call_defined(data.t_id,data.m_id);

                  $('#myCenterModalLabel').text('Edit Credit Note');                 
                  $(".coupon_form #coupon_code").val(data.coupon_code);
                  $(".coupon_form #create_date").val(data.create_date);
                  $(".coupon_form #coupon_type").val(data.coupon_type);
                  $(".coupon_form #usage_limit").val(data.usage_limit);
                  $(".coupon_form #coupon_balance").val(data.remaining_coupon_value);
                  
                  $(".coupon_form #coupon_currency").val(data.currency_type);
                  $(".coupon_form #coupon_value").val(data.coupon_value);
                  $(".coupon_form #coupon_value_percent").val(data.coupon_value);
                  $(".coupon_form #expiry_date").val(data.expiry_date);
                  $(".coupon_form #min_price").val(data.min_price);
                  $(".coupon_form #max_price").val(data.max_price);
                 
                  if(data.credit_note == 1){ 
                     $("#coupon_balance_div").show();
                     $(".coupon_form #credit_note").attr('checked','checked');
                  }
                  else{
                    $("#coupon_balance_div").hide();
                  }
                   event.preventDefault();
                   $("#centermodal").modal('show');
              }
            });
        });
</script>