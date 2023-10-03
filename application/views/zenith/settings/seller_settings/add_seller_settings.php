<style>
	.height_auto {
    height: auto !important;
}
	</style>
<?php $this->load->view(THEME.'common/header'); ?>
    
     <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-sm-12 col-xl-12">
                        <div class="page-title">
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($markup->id) ? "Edit ".$heading." Markup" : "Create New ".$heading." Markup"; ?> </h3>
                        </div>
                     </div>
                    
                  </div>
               </div>
            </div>
            <!-- page content -->

            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">

            
                    <div class="card">
                     <div class="card-body">
                         <div class="col-sm-12 col-xl-12  mt-2 mt-sm-0">
                        <div class="">
                          <h5 class="card-title"><?php echo $heading;?> Markup Info</h5>
                          <p>Fill the following <?php echo $heading;?> Markup information</p>
                        </div>

                        <form id="add-team-form" enctype='multipart/form-data' method="post" class="validate_form_v11 login-wrapper" action="<?php echo base_url(); ?>settings/seller_settings/save_markup">
									<input type="hidden" name="id" value="<?php echo $markup->id;?>">
                           <input type="hidden" name="role" value="<?php echo $role;?>">
                         <div class="row column_modified">                            
                         <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Seller </label>
										   <select class="custom-select" id="user_id" name="user_id" required>
												<option value="">-Choose Seller-</option>
												<?php foreach ($sellers as $seller) { ?>
													<option value="<?php echo $seller->admin_id; ?>" <?php 
														if ($markup->user_id == $seller->admin_id) {
															echo ' selected  ';
														}
													 ?>><?php echo $seller->admin_name." ".$seller->admin_last_name; ?></option>
												<?php } ?>
											</select>
                                          </div> 
                                       </div>                             

                                       <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Markup in % * </label>
                                           <input required type="text" name="markup" id="markup" class="form-control" placeholder="Enter Markup" value="<?php  if (isset($markup->markup)) { echo $markup->markup; } ?>">
                                          </div> 
                                       </div>

                                       <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Markup Status</label>
                                           <div class="custom-control custom-switch">
                                               <input type="checkbox" class="custom-control-input is-switch" id="customSwitch19"  value="1" <?php if($markup->status == '1'){?> checked <?php } ?> name="status">
                                               <label class="custom-control-label" for="customSwitch19">Disable Markup Status / Enable</label>
                                             </div>
                                          </div> 
                                       </div>
							 

                           </div>
                           <!--  -->
                            <div class="tick_details border-top">
                                <div class="row">
                                    <div class="col-sm-8">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                            <a href="<?php echo base_url() . 'settings/seller_settings/'.strtolower($heading).'_settings_list';?>" class="btn btn-primary mb-2 mt-3">Back</a>
                                            <button type="submit" class="btn btn-success mb-2 ml-2 mt-3" >Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          <!--  -->
                       </form>
                     </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

<?php $this->load->view(THEME.'common/footer'); ?>

<script>
      $(document).ready(function(){
               $('.validate_form_v11').validate({
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
            });
         });
         </script>
