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
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($page_details->id) ? "Edit Page" : "Create New Page"; ?> </h3>
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
                          <h5 class="card-title">Page Info</h5>
                          <p>Fill the following Page information</p>
                        </div>

						<form id="static-page-form" method="post" class="validate_form_v1 login-wrapper validate_form_v1" action="<?php echo base_url(); ?>settings/static_pages/save">
        								<input type="hidden" name="page_id" value="<?php if (isset($page_details->id)) {
																						echo $page_details->id;
																					} ?>">
                         <div class="row column_modified">                            
                            <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >Page Type</label>
								 <select class="form-control " id="ptype" name="ptype" required>
									<option value="">-Select Page Type-</option>
									<?php foreach ($page_types as $page_type) { ?>
										<option value="<?php echo $page_type->page_type_id; ?>" <?php if (isset($page_details->page_type)) {
									if ($page_type->page_type_id == $page_details->page_type) {
										echo ' selected  ';
									}
								} ?>><?php echo $page_type->page_type_name; ?></option>
									<?php } ?>
								</select>
                                </div>
                               </div>                              

                               <div class="col-lg-3">
                                <div class="form-group">
                                   <label for="sellers">Status</label>
                                   <div class="custom-control custom-switch">
                                     <input name="status" type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($page_details->status == '1'){?> checked <?php } ?> name="is_status">
                                     <label class="custom-control-label" for="customSwitch18">Active / InActive</label>
                                   </div>
                                </div>
                             </div>    

							 <div class="col-lg-3">
								<div class="form-group">
								<label for="simpleinput"> Page Title</label>
								<input required type="text" name="title" id="title" class="form-control" placeholder="Enter Page Title" value="<?php if (isset($page_details->title)) { echo $page_details->title; } ?>">
								</div> 
							</div>							

							 <div class="col-lg-12">
								<div class="form-group">
									<label for="simpleinput">Page Content <span class="text-danger"></span></label>
									<input type="text" id="page_content" class="form-control height_auto" placeholder="Enter Ticket Description" name="page_content" required value="<?php echo isset($page_details->description) ? $page_details->description : '';?>">
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
                                            <a href="<?php echo base_url() . 'settings/static_pages';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
