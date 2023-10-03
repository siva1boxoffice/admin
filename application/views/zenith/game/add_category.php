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
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($category_details->id) ? "Edit Match Category" : "Create New Match Category"; ?> </h3>
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
                          <h5 class="card-title">Match Category Info</h5>
                          <p>Fill the following Match Category information</p>
                        </div>

                        <form id="category-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>game/category/save_category">
                        <input type="hidden" name="category_id" value="<?php if (isset($category_details->id)) {
                                                                            echo $category_details->id;
                                                                        } ?>">
                         <div class="row column_modified">                            
                            <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="category_name" >Category Name</label>
                                    <div class="control">
                                        <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Enter Category Name" required value="<?php echo $category_details->category;?>">
                                    </div>
                                </div>
                               </div>                              

                               <div class="col-lg-3">
                                <div class="form-group">
                                   <label for="sellers">Category Status</label>
                                   <div class="custom-control custom-switch">
                                     <input name="status" type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($category_details->status == '1'){?> checked <?php } ?> name="is_status">
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
                                            <a href="<?php echo base_url() . 'game/category/list_category';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
