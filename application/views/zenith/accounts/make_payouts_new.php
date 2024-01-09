<style>
   .view_bg{
   color: #ffffff !important;
   }
</style>
<?php $this->load->view(THEME.'common/header');

?>
  <!-- Begin main content -->
      <!-- Begin main content -->
    <div class="main-content">
      <!-- content -->
      <div class="page-content">
        <!-- page header -->
        <div class="page-title-box tick_details">
          <div class="container-fluid">
            <div class="row">
               <div class="col-sm-8">
                  <h5 class="card-title">New Payout</h5>
               </div>
               <div class="col-sm-4">
                  <!-- <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                     <a href="#" data-toggle="modal" data-target="#add-board-modal" class="btn btn-primary mb-2">Back</a>
                        <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2 ml-2">Save</a>
                  </div> -->
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
                        <div class="team_info_details mt-3">
                                <h5 class="card-title">Payout Info</h5>
                                <p>Fill the following Seller and Order information</p>
                              </div>
                              <div class="row">
                                  <form id="search-form" method="post" enctype='multipart/form-data' class="" action="<?php echo base_url();?>accounts/get_payout_data">
                                <div class="col-12">
                                  <div class="card">
                                      <div class="row column_modified">
                                        
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="example-select">Choose Sellers<span class="text-danger">*</span></label>
                                             
                                                 <select class="actionpayout roleuser custom-select" required name="seller" id="seller">
                                            <option value="">-Choose Sellers-</option>
                                            <?php foreach($sellers as $seller){ ?>
                                            <option <?php if (in_array($seller->admin_id, explode(',',$match_settings->sellers)))
                                            { ?> selected <?php } ?> value="<?php echo $seller->admin_id;?>"><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?> (<?php echo $seller->company_name;?>)</option>
                                            <?php } ?>
                                            </select>
                                            </div> 
                                        </div> 
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="example-select">Currency <span class="text-danger">*</span></label>
                                              
                                                <select class="custom-select" id="currency" name="currency">
                                        <option value="">-Choose Currency-</option>
                                        <option value="GBP">GBP</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="AED">AED</option>
                                        </select>

                                            </div> 
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group calander">
                                               <label for="example-date">Event From <span class="text-danger">*</span></label>
                                               <input class="form-control" type="text" name="event_from" id="event_from" placeholder="DD-MM-YYYY" value="" autocomplete="off" required="">
                                                <i class="bx bx-calendar-week"></i>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <div class="form-group calander">
                                               <label for="example-date">Event to <span class="text-danger">*</span></label>
                                               <input class="form-control" type="text" name="event_to" id="event_to" placeholder="DD-MM-YYYY" value="" autocomplete="off" required="">
                                                <i class="bx bx-calendar-week"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                              <label for="simpleinput">&nbsp;</label>
                                              <div class="buttons">
                                                <button id="search" type="submit" class="btn btn-primary mb-2">Search</button>
                                              </div>
                                            </div>
                                        </div>
                                     
                                      </div>
                                    </div> <!-- end card -->
                                </div>
                             </form>
                              </div>
                               <form id="payout-form" method="post" enctype='multipart/form-data' class="validate_form_payout login-wrapper" action="<?php echo base_url();?>accounts/save_payout_v1">
                              <div class="row">
                                <div class="col-12">
                                  <div class="" id="">
                                             <div class="table-responsive" id="payout_orders">
                                                <h3>0 Orders Found</h3>
                                                <table id="basic-datatable" class="table  table-hover table-nowrap mb-0">
                                                   <thead class="thead-light">
                                                      <tr>
                                                         <th>Select</th>
                                                         <th>Order ID</th>
                                                         <th>Event Name</th>
                                                         <th>Buyer</th>
                                                         <th>Ticket Type</th>
                                                         <th>Tickets</th>
                                                         <th>Total Price</th>
                                                         <th>Order Status</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                    
                                                      
                                                     
                                                   </tbody>
                                                </table>
                                             </div>
                                       </div>
                                </div>
                              </div>
                              <!-- end row -->
                              <div class="clearfix"></div>

                              <div class="row">
                                       <div class="col-lg-3">
                                          <div class="file_uplo mt-3">
                                             <p class="mb-2">Upload Payout or Bank Deposit Receipt</p>
                                             <div class="form-group mb-0">
                                                <div class="input-group">
                                                  <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="payout_receipt" name="payout_receipt" onchange="loadFile_receipt(event)">
                                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                  </div>
                                                  <a id="preview" style="text-decoration: underline;display: none;" href="" target="_blank">preview payment receipt</a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-3">
                                          <div class="form-group mt-3 mb-0 seller_info">
                                              <label for="simpleinput">Seller Account</label>
                                       <select class="custom-select" id="seller_account" name="seller_account">
                                        <option value="">-Choose Account-</option>
                                        </select>
                                        </div>
                                       </div>
                                       <div class="col-lg-2">
                                          <div class="form-group mt-3 mb-0 seller_info">
                                              <label for="simpleinput">Payment Reference *</label>
                                              <input type="text" name="payment_reference" class="form-control" placeholder="Reference#" required>
                                          </div>
                                       </div>
                                       <div class="col-lg-2" id="afiliates_div">
                                          <div class="total_amt mt-3">
                                             <p class="mb-3">Total Payable</p>
                                             <h5 id="payable_amount">0.00</h5>
                                          </div>
                                       </div>
                                       <div class="col-lg-2">
                                          <div class="confirm_payout mt-3">
                                             <p class="mb-1">&nbsp;</p>
                                             <button type="submit" id="payout-form-btn" class="btn btn-primary waves-effect waves-light" data-effect="wave">Confirm Payout</button>
                                          </div>
                                       </div>
                              </div>
                           </form>
                        
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

function popitup(url,temp='')
   {

      newwindow=window.open(url,'name','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,,height=500,width=700');

      if (window.focus) {newwindow.focus()}
      return false;
   }


     var loadFile_receipt = function(event) {
                   
                     document.getElementById('preview').style.display = 'block';
                   


  var formData = new FormData();
formData.append('file', event.target.files[0]);

$.ajax({
       url : "<?php echo base_url();?>event/upload_files",
       type : 'POST',
       data : formData,
       processData: false,  // tell jQuery not to process the data
       contentType: false,  // tell jQuery not to set contentType
       dataType: 'json',
       success : function(data) {

          if(data.uploaded_file){
            var src = "<?php echo UPLOAD_PATH;?>uploads/temp/"+data.uploaded_file;
           
            $("#preview").attr("onclick", "return popitup('"+src+"');");
          }
           
     

       }
});

                    };

   $(document).ready(function() {

  if ($('#sellers').length) new Choices('#sellers', { removeItemButton: !0 });

  $("#event_from").datepicker({

          dateFormat: 'dd-mm-yy',
          changeMonth:true,
         changeYear:true,
      }
      );
      $("#event_to").datepicker(
         { dateFormat: 'dd-mm-yy',
         changeMonth:true,
         changeYear:true,}
      );


 $('#search-form').validate({

  submitHandler: function(form) {
    
    var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
    var formData = new FormData(myform);
    var d1= $("#pickaday-datepicker-one").val();
    var d2= $("#pickaday-datepicker-two").val();
   /*  formData.append('payout_date_from',d1);
     formData.append('payout_date_to', d2);console.log(formData);*/
    $('#search').addClass("is-loading no-click");

    $('.has-loader').addClass('has-loader-active');
    
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

        $('#search').removeClass("is-loading no-click");

        $('.has-loader').removeClass('has-loader-active');

             if(data.status == 1){
                            $('#payout_orders').html(data.response.list_orders);
                            $('#payable_amount').text(data.response.base_currency+' '+ data.response.payable_amount);
                        }
      }
    })
    return false;
  }
});

             
    
$('body').on('click', '.payable_order', function() {
    var payable_orders = [];
    $('.payable_order').each(function(index, value) {
        if($(this).is(':checked'))
        {
            payable_orders.push($(this).val());
        }
    });

    if (payable_orders.length >= 1){

    var action = "<?php echo base_url();?>accounts/calculate_payable_orders";
    $.ajax({
      type: "POST",
      url: action,
      data: {'payable_orders' : payable_orders},
      cache: false,
      dataType: "json",

      success: function(data) {
        if(data.status == 1){
        $('#payable_amount').text(data.response.base_currency+' '+ data.response.payable_amount);
        }
        else{
            alert(data.response);
        }

      }
    })

    }
})



$('body').on('change', '#currency', function() {
   
   
  var seller_id = $("#seller").val();
  var currency  = $(this).val();
  
   if (seller_id != "" && seller_id != null){

    var action = "<?php echo base_url();?>accounts/get_seller_bank_accounts";
    $.ajax({
      type: "POST",
      url: action,
      data: {'seller_id' : seller_id,'currency' : currency},
      cache: false,
      dataType: "json",

      success: function(data) {
        $("#seller_account").html("");
        if(data.status == 1){
                $("#seller_account").attr('disabled', false);
                $.each(data.bank_accounts, function(index, value) {
  $("#seller_account").append('<option value=' + value.bank_id + ' selected>Currency : ' + value.currency + ',Beneficiary name : ' + value.beneficiary_name + ',Account Number : ' + value.account_number + ',Bank Name : ' + value.bank_name + '</option>');
});
               
               /* $.each(bank_accounts,function(key, value)
                {  console.log(value);
                  
                    //$("#seller_account").append('<option value=' + key + '>' + value + '</option>');
                });
*/
        
        }
        else{
            $("#seller_account").attr('disabled', false);
            $('#seller_account').html("");
        }

      }
    })

    }

})



});
   </script>
