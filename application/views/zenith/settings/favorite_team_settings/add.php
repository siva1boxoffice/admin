<style>
	.height_auto {
    height: auto !important;
}

.choose_team .choices__inner {
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
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($setting->id) ? "Edit Favorite Team" : "Create New Favorite Team"; ?> </h3>
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
                          <h5 class="card-title">Favorite Team Info</h5>
                          <p>Fill the following Favorite Team information</p>
                        </div>

                        <form id="branch-form" method="post" enctype='multipart/form-data' class="login-wrapper form_req_validation validate_form_v1" action="<?php echo base_url();?>settings/favorite_team_settings/save">
                            <input type="hidden" name="id" value="<?php echo $setting->id;?>">
                         <div class="row column_modified">                            
                                                 
                         <div class="col-lg-3">
								<div class="form-group">
								<label for="simpleinput">Seller Name </label>
                                <select class="form-control"  required name="seller" id="sellers">
                                                    <option value="">Choose Seller</option>
                                                    <?php foreach($sellers as $seller){ ?>
                                                    <option <?php if ($seller->admin_id == $setting->seller_id)
  { ?> selected <?php } ?> value="<?php echo $seller->admin_id;?>"><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?> (<?php echo $seller->company_name;?>)</option>
                                                <?php } ?>
                                                </select>
								</div> 
							</div> 


                            <div class="col-lg-6">
								<div class="form-group choose_team">
								<label for="simpleinput" >Choose Team </label>
                                <select class="form-control" multiple required name="teams[]" id="teams">
                                    <option value="">Choose Team</option>
                                    <?php
                                    $seller_ids = explode(',', $setting->teams);
                                    $seller_ids = array_map('trim', $seller_ids); // Remove whitespace from IDs

                                    foreach ($fav_teams as $fav_team) {
                                        $selected = (in_array($fav_team->team_id, $seller_ids)) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $fav_team->team_id; ?>" <?php echo $selected; ?>>
                                        <?php echo $fav_team->team_name; ?> (<?php echo $seller->company_name; ?>)
                                        </option>
                                    <?php } ?>
                                    </select>

                                               
								</div> 
							</div>

                               <div class="col-lg-3">
                                <div class="form-group">
                                   <label for="sellers">Status</label>
                                   <div class="custom-control custom-switch">
                                     <input name="status" type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($setting->status == '1'){?> checked <?php } ?> name="is_status">
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
                                            <a href="<?php echo base_url() . 'settings/favorite_team_settings/';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
                        if ($('#teams').length) new Choices('#teams', { removeItemButton: !0 });
     });
    </script>