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
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($markup->id) ? "Edit SiteFee Markup" : "Create New  SiteFee Markup"; ?> </h3>
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
                          <h5 class="card-title">SiteFee Markup Info</h5>
                          <p>Fill the following SiteFee Markup information</p>
                        </div>

<form id="branch-form" method="post" class="login-wrapper form_req_validation validate_form_v1" action="<?php echo base_url();?>settings/sitefee_settings/save_markup">
                            <input type="hidden" name="id" value="<?php echo $markup->id;?>">
                         <div class="row column_modified">                            
                            <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >StoreFront</label>
                                 <select class="form-control" id="store_id" name="store_id" required>
                                    <option value="">Select StoreFront</option>
                                    <?php foreach ($storefronts as $store) { ?>
                                        <option <?php if($this->session->userdata('storefront')->admin_id==$store->admin_id){ echo 'selected'; }else{ echo 'disabled';} ?> value="<?=$store->admin_id?>"><?=$store->company_name?></option>
                                    <?php } ?>
								</select>
                                </div>
                               </div>                              

                               <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >Tournment</label>
                                 <select class="form-control" id="t_id" name="t_id" required onchange="call_defined(this.value)">
                                    <option value="">Select StoreFront</option>
                                    <?php foreach($tournments as $tournment){ ?>
                                        <option <?php if($markup->t_id==$tournment->tournament_id){ echo 'selected'; } ?> value="<?=$tournment->tournament_id?>"><?=$tournment->tournament_name?></option>
                                    <?php } ?>
								</select>
                                </div>
                               </div>   
                               
                               
                               <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >Matches</label>
                                 <select class="form-control choose_match" id="m_id" name="m_id">
                                                            <option value="">Please Choose Match</option>
                                                            </select>
                                </div>
                               </div>  

                               <div class="col-lg-3">
                                    <div class="form-group">
                                    <label for="simpleinput">Markup in % </label>
                                    <input required type="text" name="markup" id="markup" class="form-control" placeholder="Enter Markup" value="<?php  if (isset($markup->markup)) { echo $markup->markup; } ?>">
                                    </div> 
                                 </div>

                                 <div class="col-lg-3">
                                <div class="form-group">
                                   <label for="sellers">Status</label>
                                   <div class="custom-control custom-switch">
                                     <input name="status" type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($markup->status == '1'){?> checked <?php } ?> >
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
                                            <a href="<?php echo base_url() . 'settings/sitefee_settings/sitefee_settings_list';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
       var w='';
                    <?php if ($markup->match_id){ ?>
                            var w="<?php echo $markup->match_id?>";
                            var t="<?php echo $markup->t_id?>";
                            call_defined(t,w);
                    <?php } ?>   
     function call_defined(t,w=''){
                                $.ajax({
                                      type: "POST",
                                      url: "<?php echo base_url();?>settings/discount_coupons/change_tournment",
                                      data: {
                                        t_id: t,
                                        m_id: w,
                                      },
                                      success: function(odata) {
                                        data=jQuery.parseJSON(odata);
                                        if (data.status==1) {
                                            $('.choose_match').html(data.val);
                                        }else{
                                            $('.choose_match').html("<option value=''>change Match</option>");
                                        }
                                      }
                                    });  
                            }
</script>