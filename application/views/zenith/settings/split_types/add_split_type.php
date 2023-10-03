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
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($ticket_details->id) ? "Edit Split Types" : "Create New Split Types"; ?> </h3>
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
                          <h5 class="card-title">Split Types Info</h5>
                          <p>Fill the following Split Types information</p>
                        </div>

						<form id="split-type-form" enctype='multipart/form-data' method="post" class=" login-wrapper form_req_validation validate_form_v1" action="<?php echo base_url(); ?>settings/split_types/save">
        								<input type="hidden" name="split_type_id" value="<?php if (isset($split_details->id)) {
																								echo $split_details->id;
																							} ?>">
                         <div class="row column_modified">                            
                            <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >Split Type</label>
                                    <div class="control">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Split Type" required value="<?php echo $split_details->splittype;?>">
                                    </div>
                                </div>
                               </div>                              

                               <div class="col-lg-3">
                                <div class="form-group">
                                   <label for="sellers">Status</label>
                                   <div class="custom-control custom-switch">
                                     <input name="status" type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($split_details->status == '1'){?> checked <?php } ?> name="is_status">
                                     <label class="custom-control-label" for="customSwitch18">Active / InActive</label>
                                   </div>
                                </div>
                             </div>    

							 <div class="col-lg-12">
								<div class="form-group">
									<label for="simpleinput">Split Description <span class="text-danger"></span></label>
									<input type="text" id="s_description" class="form-control height_auto" placeholder="Enter Split Description" name="s_description" required value="<?php echo isset($split_details->s_description) ? $split_details->s_description : '';?>">
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
                                            <a href="<?php echo base_url() . 'settings/split_types';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
