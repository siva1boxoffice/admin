<?php $this->load->view('common/header'); ?>
<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Add Ticket Details" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
<div class="page-content-wrapper">
<div class="page-content is-relative business-dashboard course-dashboard">
<div class="page-content-inner">
   <div class="flex-list-wrapper">
      <!--Form Layout 1-->
      <div class="form-layout">
         <div class="form-outer">
            <form id="split-type-form" method="post" class=" login-wrapper form_req_validation validate_form_v1" action="<?php echo base_url(); ?>settings/delivery_settings/save">
               <input type="hidden" name="ticket_cat_id" value="<?php if (isset($delivery_types->ticket_cat_id)) {
                  echo $delivery_types->ticket_cat_id;
                  } ?>">
               <div class="form-header stuck-header">
                  <div class="form-header-inner">
                     <?php if (!empty($id)) { ?>
                     <div class="left">
                        <h3>Edit Delivery Details</h3>
                     </div>
                     <?php	} else { ?>
                     <div class="left">
                        <h3>Add Delivery Details</h3>
                     </div>
                     <?php } ?>
                     <div class="right">
                        <div class="buttons">
                           <a href="<?php echo base_url(); ?>settings/delivery_settings" class="button h-button is-light is-dark-outlined">
                           <span class="icon">
                           <i class="lnir lnir-arrow-left rem-100"></i>
                           </span>
                           <span>Cancel</span>
                           </a>
                           <button id="save-button" class="button h-button is-primary is-raised">Save</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-body">
                  <!--Fieldset-->
                  <div class="form-fieldset">
                     <div class="fieldset-heading">
                        <h4>Delivery Details Info</h4>
                     </div>
                     <div class="columns is-multiline">
                        <div class="column is-6">
                           <div class="field">
                              <label>Delivery Name *</label>
                              <div class="control "><input type="text" class="input" placeholder="Delivery Name" id="category" name="category" required value="<?php if (isset($delivery_types->category)) {
                                 echo $delivery_types->category;
                                 } ?>">
                              </div>
                           </div>
                        </div>
                        <div class="column is-6">
                           <div class="field">
                              <label>Delivery Company *</label>
                              <div class="control "><input type="text" class="input" placeholder="Delivery Company" id="company" name="company" required value="<?php if (isset($delivery_types->company)) {
                                 echo $delivery_types->company;
                                 } ?>">
                              </div>
                           </div>
                        </div>
                        <div class="column is-6">
                           <div class="field">
                              <label>Delivery Cost *</label>
                              <div class="control "><input type="text" class="input" minlength="2" placeholder="Delivery Cost" id="delivery_cost" name="delivery_cost" required value="<?php if (isset($delivery_types->delivery_cost)) {
                                 echo $delivery_types->delivery_cost;
                                 } ?>">
                              </div>
                           </div>
                        </div>
                        <div class="column is-6">
                           <div class="field">
                              <label>Delivery Currency *</label>
                              <div class="control ">
									<select class="form-control" name="currency" id="currency" required="">
									<option value="">--Choose Currency--</option>
									<option value="GBP" <?php if ($delivery_types->currency == "GBP") {
                                ?>
                                selected
                                 <?php } ?>>GBP</option>
									<option value="EUR" <?php if ($delivery_types->currency == "EUR") {
                                ?>
                                selected
                                 <?php } ?>>EUR</option>

									</select>
                              </div>
                           </div>
                        </div>
                        <div class="column is-6">
                           <div class="field">
                              <label>Status</label>
                              <div class="control has-icon">
                                 <div class="switch-block no-padding-all">
                                    <label class="form-switch is-primary">
                                    <input type="checkbox" class="is-switch" name="status" value="1" <?php if (isset($delivery_types->status)) {
                                       if ($delivery_types->status == 1) { ?> checked <?php }
                                       } ?>>
                                    <i></i>
                                    </label>
                                    <div class="text">
                                       <span>Inactive / Active</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                      
                     </div>
                  </div>
                  <!--Fieldset-->
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script></script>
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
   $("#tdetails_image").change(function() {
   	filePreview(this);
   })
   
   function filePreview(input) {
   	if (input.files && input.files[0]) {
   		var reader = new FileReader();
   		reader.onload = function(e) {
   			$('#previewImage + img').remove();
   			$('#imageFile').remove();
   			$('#previewImage').append('<img class="imgTbl" id="imageFile" src="' + e.target.result + '" />');
   		}
   		reader.readAsDataURL(input.files[0]);
   	}
   }
</script>