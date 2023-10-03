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
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($result->id) ? "Edit Blog Category" : "Create New Blog Category"; ?> </h3>
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
                          <h5 class="card-title">Blog Category Info</h5>
                          <p>Fill the following Blog Category information</p>
                        </div>
                        <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>blog/category/save">
                            <input type="hidden" name="id" value="<?php echo $result->id;?>">
                         <div class="row column_modified">                            
                            <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >Category Name</label>
                                    <div class="control">
                                        <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Enter Category Name" required value="<?php echo $result->category_name;?>">
                                    </div>
                                </div>
                               </div> 
                               
                               <div class="col-lg-3">
                                <div class="form-group">
                                   <label for="sellers">Status</label>
                                   <div class="custom-control custom-switch">
                                     <input name="status" type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($result->category_status == '1'){?> checked <?php } ?>>
                                     <label class="custom-control-label" for="customSwitch18">Active / InActive</label>
                                   </div>
                                </div>
                             </div>   
                               <?php if($this->session->userdata('role') != 7){?>

                                <div class="col-lg-12">
								<div class="form-group">
									<label for="simpleinput">Meta Title <span class="text-danger"></span></label>
									<input type="text" id="t_description" class="form-control height_auto" placeholder="Meta Title" name="meta_title"  required value="<?php echo isset($result->meta_title) ? $result->meta_title : '';?>">
								</div>
                             </div>

                               <div class="col-lg-12">
								<div class="form-group">
									<label for="simpleinput">Meta Description <span class="text-danger"></span></label>
									<input type="text" id="t_description" class="form-control height_auto" placeholder="Meta Description" name="meta_description"  required value="<?php echo isset($result->meta_description) ? $result->meta_description : '';?>">
								</div>
                             </div>
                             <?php }else{ ?>

                                <textarea class="textarea" rows="4" placeholder="Meta Title" name="meta_title" style="display: none;"><?php echo $result->meta_title;?></textarea>
                                <textarea class="textarea" rows="4" placeholder="Meta Description" name="meta_description" style="display: none;"><?php echo $result->meta_description;?></textarea>

                                <?php } ?>

                                <div class="col-lg-12">
                                 <div class="form-group">
                                 <label for="name" >Seo Keywords</label>
                                    <div class="control">
                                        <input type="text" id="category_name" name="seo_keywords" class="form-control" placeholder="Enter Seo Keywords" required value="<?php echo $result->seo_keywords;?>">
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
                                            <a href="<?php echo base_url() . 'blog/category/lists';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
