<?php  $this->load->view(THEME.'common/header'); ?>

<!-- Begin main content -->
<div class="main-content">
      <!-- content -->
      <div class="page-content">
        <!-- page header -->
        <div class="page-title-box tick_details">
          <div class="container-fluid">
            <div class="row">
                     <div class="col-sm-8">
                        <h5 class="card-title">Add Currency</h5>
                     </div>
                     <div class="col-sm-4">
                        <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                        </div>
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
                        <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                              <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Add or Edit Currency
                              </a>
                            </li>  
                                                 
                        </ul>
                        <div class="tab-content">
                           <div class="tab-pane show active" id="home-b1">
                              <div class="row">
                                <div class="col-12">
                                  <div class="card">
                                    <div class="">
                                      <h5 class="card-title">Currency</h5>
                                      <p>Fill the following Currency information</p>
                                    </div>
                                    <form id="add-team-form" enctype='multipart/form-data' method="post" class="validate_form_currency_v1 login-wrapper" action="<?php echo base_url(); ?>settings/currency/save_currency">
                                    <input type="hidden" name="currency_id" value="<?php if (isset($currency_details->id)) {
                                                                                            echo $currency_details->id;
                                                                                        } ?>">
                                    <div class="">
                                      <div class="row ">   
                                      <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Currency Name </label>
                                           <input required type="text" name="currency_name" id="currency_name" class="form-control" placeholder="Enter Currency Name" value="<?php  if (isset($currency_details->name)) { echo $currency_details->name; } ?>">
                                          </div> 
                                       </div>

									   <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Currency Code </label>
                                           <input required type="text" name="currency_code" id="currency_code" class="form-control" placeholder="Currency code. Ex: USD, EUR, GBP" value="<?php  if (isset($currency_details->currency_code)) { echo $currency_details->currency_code; } ?>">
                                          </div> 
                                       </div>

									   <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Currency Symbol</label>
                                           <input required type="text" name="currency_symbol" id="currency_symbol" class="form-control" placeholder="Enter Currency symbol" value="<?php  if (isset($currency_details->symbol)) { echo $currency_details->symbol; } ?>">
                                          </div> 
                                       </div>

                                       <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Price diffence between Pound £</label>
                                           <input required type="text" name="difference" id="difference" class="form-control" placeholder="Price diffence between Pound £" value="<?php  if (isset($currency_details->price_difference)) { echo $currency_details->price_difference; } ?>">
                                          </div> 
                                       </div>


                                       <div class="col-lg-2">
                                          <div class="form-group">
                                             <label for="Status">Status</label>
                                             <div class="custom-control custom-switch">
                                               <input type="checkbox" class="custom-control-input" name='status' id="customSwitch118"  value="1" <?php if($currency_details->status == '1'){?> checked <?php } ?> name="is_active">
                                               <label class="custom-control-label" for="customSwitch118">Inactive / Active</label>
                                             </div>
                                          </div>
                                       </div>

									   <div class="col-lg-12">
                                          <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                                <a href="<?php echo base_url();?>settings/currency/list_currency" class="btn btn-primary mb-2">
                                                <i class="bx bx-list-ol bx-flashing mr-1"></i> Go Back</a> 

                                                <button type="submit" id="branch-form-btn" class="btn btn-success mb-2 submit_match button h-button is-primary is-raised"><i class=" bx bx-list-ol bx-flashing mr-1 save_match"></i>Save
                                                </button>
                                          </div>
                                       </div>

                                    </div> <!-- end col -->                                    
                                    </div> <!-- end card-body -->                                    
                                  </div> <!-- end card -->
                                </div><!-- end col -->
                              </div>
                              <!-- end row -->
                           </form>
                           </div>
                     </div> 
                  </div>
               </div>
            </div>
           
        </div>
      </div>
      <!-- main content End -->
<?php  $this->load->view(THEME.'common/footer'); ?>
<script>
      $(document).ready(function(){
               $('.validate_form_currency_v1').validate({
            submitHandler: function(form) {
               
               var myform = $('#'+$(form).attr('id'))[0];
              
               var formData = new FormData(myform);
               var action = $(form).attr('action');
               $('.error-message').remove();
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
                     
                     swal('Updated !', data.msg, 'success');
                     setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
                  }else if(data.status == 0) {                    
                     
                     swal('Updation Failed !', data.msg, 'error');
                   //  setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);  
                    swal('Validation Failed!', data.msg, 'error');
                    displayErrors(data.errors);

                  }
                  }
               })
               return false;
            }
            });

         /*   $('.validate_form_v3').validate({
             
            submitHandler: function(form) {
               
               var myform = $('#'+$(form).attr('id'))[0];
              
               var formData = new FormData(myform);
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
                     
                     swal('Updated !', data.msg, 'success');
                     setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
                  }else if(data.status == 0) {                    
                     
                     swal('Updation Failed !', data.msg, 'error');
                     setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);  

                  }
                  }
               })
               return false;
            }
            });*/

            function displayErrors(errors) {
   // $('.error-messages').remove();
    for (var field in errors) {
        if (errors.hasOwnProperty(field)) {
         if ($('#' + field).next('.error-message').length === 0) {
            var errorElement = $('<div>').addClass('error-message').css('color', 'red').html(errors[field]);
            $('#' + field).after(errorElement);
           // $('#' + fieldId).addClass('error-input');
         }
        }
    }
}
});
</script>