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
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($delivery_types->ticket_cat_id) ? "Edit Delivery Details" : "Create New Delivery Details"; ?> </h3>
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
                          <h5 class="card-title">Delivery Details Info</h5>
                          <p>Fill the following Delivery Details information</p>
                        </div>

                        <form id="add-team-form" enctype='multipart/form-data' method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>settings/delivery_settings/save">
                                    <input type="hidden" name="ticket_cat_id" value="<?php if (isset($delivery_types->ticket_cat_id)) {
                                             echo $delivery_types->ticket_cat_id;
                                             } ?>">
                         <div class="row column_modified">                            
                         <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Delivery Name </label>
                                           <input required type="text" name="category" id="category" class="form-control" placeholder="Enter Delivery Name" value="<?php  if (isset($delivery_types->category)) { echo $delivery_types->category; } ?>">
                                          </div> 
                                       </div>                           

                                       <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Delivery Company </label>
                                           <input required type="text" name="company" id="company" class="form-control" placeholder="Enter Delivery Company Name" value="<?php  if (isset($delivery_types->company)) { echo $delivery_types->company; } ?>">
                                          </div> 
                                      </div>

                                      <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Delivery Cost</label>
                                           <input required type="text" minlength="2"  name="delivery_cost" id="delivery_cost" class="form-control" placeholder="Enter Delivery Cost" value="<?php  if (isset($delivery_types->delivery_cost)) { echo $delivery_types->delivery_cost; } ?>">
                                          </div> 
                                      </div>

                                      <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Delivery Currency</label>
                                           <select class="custom-select" name="currency" id="currency" required="">
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

                                      <div class="col-lg-2">
                                          <div class="form-group">
                                             <label for="Status">Status</label>
                                             <div class="custom-control custom-switch">
                                               <input type="checkbox" class="custom-control-input" name='status' id="customSwitch118"  value="1" <?php if($delivery_types->status == '1'){?> checked <?php } ?> name="is_active">
                                               <label class="custom-control-label" for="customSwitch118">Inactive / Active</label>
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
                                          
                                            <a href="<?php echo base_url() . 'settings/delivery_settings';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
