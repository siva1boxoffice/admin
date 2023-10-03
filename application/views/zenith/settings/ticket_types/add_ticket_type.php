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
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($ticket_details->id) ? "Edit Ticket Types" : "Create New Ticket Types"; ?> </h3>
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
                          <h5 class="card-title">Ticket Types Info</h5>
                          <p>Fill the following Ticket Types information</p>
                        </div>

						<form id="ticket-type-form" method="post" class=" login-wrapper form_req_validation validate_form_v1" action="<?php echo base_url(); ?>settings/ticket_types/save">
        								<input type="hidden" name="ticket_type_id" value="<?php if (isset($ticket_details->id)) {
																								echo $ticket_details->id;
																							} ?>">
                         <div class="row column_modified">                            
                            <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >Ticket Type</label>
                                    <div class="control">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Ticket Type" required value="<?php echo $ticket_details->tickettype;?>">
                                    </div>
                                </div>
                               </div>                              

                               <div class="col-lg-3">
                                <div class="form-group">
                                   <label for="sellers">Status</label>
                                   <div class="custom-control custom-switch">
                                     <input name="status" type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($ticket_details->status == '1'){?> checked <?php } ?> name="is_status">
                                     <label class="custom-control-label" for="customSwitch18">Active / InActive</label>
                                   </div>
                                </div>
                             </div>    

							 <div class="col-lg-12">
								<div class="form-group">
									<label for="simpleinput">Ticket Description <span class="text-danger"></span></label>
									<input type="text" id="t_description" class="form-control height_auto" placeholder="Enter Ticket Description" name="t_description" required value="<?php echo isset($ticket_details->t_description) ? $ticket_details->t_description : '';?>">
								</div>
                             </div>
							 
							 <div class="col-lg-3">
								 <div class="form-group">
									<label for="example-select">Ticket Image (40x40)</label>
									<div class="prev_back_img">
										<label class="custom-upload mb-0"><input type="hidden" name="exs_file" value="<?php if (isset($ticket_details->ticket_image)) {
									echo $ticket_details->ticket_image;
									} ?>"><input type="file"  class="form-control-file input"  name="blog_image" id="blog_image" value="" onchange="loadFiles(event,'blog_img_file')"> Upload JPEG File</label>
										<p>Ticket Image</p>
										<a id="blog_img_file_link" target="_blank" href="javascript:void(0);" onclick="return popitup('<?php if (isset($ticket_details->ticket_image)) { echo UPLOAD_PATH.'uploads/blog_image/'.$ticket_details->ticket_image;	} ?>')" class="view_bg">
									<img width="30" height="30" src="<?php if (isset($ticket_details->ticket_image)) {
									echo UPLOAD_PATH.'/uploads/ticket_image/'.$ticket_details->ticket_image;
									}else { echo UPLOAD_PATH.'/uploads/general_settings/no-image.png';} ?>" id="blog_img_file">
									</a>
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
                                            <a href="<?php echo base_url() . 'settings/ticket_types';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
