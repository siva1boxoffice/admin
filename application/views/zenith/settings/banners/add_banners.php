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
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($banner_details->id) ? "Edit Banner" : "Create New Banner"; ?> </h3>
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
                          <h5 class="card-title">Banner Info</h5>
                          <p>Fill the following Banner information</p>
                        </div>

						<form id="banner-form" method="post" class="validate_form_v1 login-wrapper validate_form_v1" action="<?php echo base_url(); ?>settings/banners/save">
        								<input type="hidden" name="banner_id" value="<?php if (isset($banner_details->id)) {
																							echo $banner_details->id;
																						} ?>">
                         <div class="row column_modified">                            
                            <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >Banner Title</label>
                                    <div class="control">
                                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter Banner Ttitle" required value="<?php echo $banner_details->title;?>">
                                    </div>
                                </div>
                               </div>   
							   
							   <div class="col-lg-12">
								<div class="form-group">
									<label for="simpleinput">Banner Description <span class="text-danger"></span></label>
									<input type="text" id="banner_description" class="form-control height_auto" rows="4" placeholder="Enter Ticket Description" name="banner_description" required value="<?php echo isset($banner_details->t_description) ? $banner_details->t_description : '';?>">
								</div>
                             </div>
							 
							 <div class="col-lg-3">
								 <div class="form-group">
									<label for="example-select">Banner Image (40x40)</label>
									<div class="prev_back_img">
										<label class="custom-upload mb-0"><input type="hidden" name="exs_file" value="<?php if (isset($banner_details->banner_image)) {
									echo $banner_details->banner_image;
									} ?>"><input type="file"  class="form-control-file input"  name="banner_image" id="banner_image" value="" > Upload JPEG File</label>
										<p>Banner Image</p>
										<a id="banner_image" target="_blank" href="javascript:void(0);" onclick="return popitup('<?php if (isset($banner_details->banner_image)) { echo UPLOAD_PATH.'uploads/banners/'.$banner_details->banner_image;	} ?>')" class="view_bg">
									<img width="30" height="30" src="<?php if (isset($banner_details->banner_image)) {
									echo UPLOAD_PATH.'/uploads/banners/'.$banner_details->banner_image;
									}else { echo UPLOAD_PATH.'/uploads/general_settings/no-image.png';} ?>" id="blog_img_file">
									</a>
									</div>
                                </div> 
							 </div>


							 <div class="col-lg-3">
                                <div class="form-group">
                                   <label for="sellers">Status</label>
                                   <div class="custom-control custom-switch">
                                     <input name="status" type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($banner_details->status == '1'){?> checked <?php } ?> name="is_status">
                                     <label class="custom-control-label" for="customSwitch18">Active / InActive</label>
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
                                            <a href="<?php echo base_url() . 'settings/banners';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
