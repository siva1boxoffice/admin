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
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($email_access->id) ? "Edit Email Access" : "Create New Email Access"; ?> </h3>
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
                          <h5 class="card-title">Email Access Info</h5>
                          <p>Fill the following Email Access information</p>
                        </div>

                        <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>settings/email_settings/save_email_settings">
                            <input type="hidden" name="id" value="<?php echo $email_access->id;?>">
                         <div class="row column_modified">                            
                            <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >SMTP</label>
                                    <div class="control">
                                        <input type="text" id="smtp" name="smtp" class="form-control" placeholder="Enter SMPT" required value="<?php echo $email_access->smtp;?>">
                                    </div>
                                </div>
                               </div>  
                               
                               <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >Host</label>
                                    <div class="control">
                                        <input type="text" id="host" name="host" class="form-control" placeholder="Enter Host" required value="<?php echo $email_access->host;?>">
                                    </div>
                                </div>
                               </div>    

                               <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >Port</label>
                                    <div class="control">
                                        <input type="text" id="port" name="port" class="form-control" placeholder="Enter Port" required value="<?php echo $email_access->port;?>">
                                    </div>
                                </div>
                               </div>   

                               
                               <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >User Name</label>
                                    <div class="control">
                                        <input type="text" id="topic" name="username" class="form-control" placeholder="Enter User Name" required value="<?php echo $email_access->username;?>">
                                    </div>
                                </div>
                               </div>   
                               
                               <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >Password</label>
                                    <div class="control">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required value="<?php echo $email_access->password;?>">
                                    </div>
                                </div>
                               </div> 

                               <div class="col-lg-3">
                                <div class="form-group">
                                   <label for="sellers">Email Access Status</label>
                                   <div class="custom-control custom-switch">
                                     <input name="status" type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($email_access->status == '1'){?> checked <?php } ?> name="is_status">
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
                                            <a href="<?php echo base_url() . 'settings/email_settings/email_list';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
