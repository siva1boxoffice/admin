<style>
	.height_auto {
    height: auto !important;
}
	</style>
<?php $this->load->view(THEME.'common/header'); 
  $api_id = $this->uri->segment(4);
?>
    
     <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-sm-12 col-xl-12">
                        <div class="page-title">
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($api_id) ? "Edit API" : "Create API"; ?> </h3>
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
                          <h5 class="card-title">API Info</h5>
                          <p>Fill the following API information</p>
                        </div>

                        <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>api/api_key_settings/save" name="api_settings">
                            <?php
                          
                            ?>
                            <input type="hidden" name="settings_id" value="<?php echo $api_id;?>">
                         <div class="dashboard-title is-main">
                         <div class="row column_modified">    
                            
                         <div class="col-lg-6">
                                 <div class="form-group">
                                 <label for="name" >Choose User</label>
                                 <select class="form-control" id="users" name="users" required>
                                    <option value="" selected>-Select User-</option>                                    
                                    <option value="1" <?php echo $settings->partner_id == "0" ? 'selected' : ''; ?>>Seller</option>
    <option value="2" <?php echo $settings->seller_id == "0" ? 'selected' : ''; ?>>Partner</option>
                                </select>
                                </div>
                               </div> 


                            <div class="col-lg-6 seller">
                                 <div class="form-group">
                                 <label for="name" >Choose Seller</label>
                                 <select class="form-control" id="seller" name="seller" required>
                                    <option value="">-Select Seller-</option>
                                    <?php 
                                        if(!empty($sellers)){
                                         foreach($sellers as $seller){ ?>
                                            <option <?php if (in_array($seller->admin_id, explode(',',$settings->seller_id)))
                                                { ?> selected <?php } ?> value="<?php echo $seller->admin_id;?>"><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?> (<?php echo $seller->admin_email;?>)
                                            </option>
                                            <?php } }?>
                                </select>
                                </div>
                               </div>   


                               <div class="col-lg-6 partner">
                                 <div class="form-group">
                                 <label for="name" >Choose Partner</label>
                                 <select class="form-control" id="partners" name="partners" required>
                                    <option value="">-Select Partner-</option>
                                    <?php 
                                        if(!empty($partners)){
                                         foreach($partners as $partner){ ?>
                                            <option <?php if (in_array($partner->admin_id, explode(',',$settings->partner_id)))
                                                { ?> selected <?php } ?> value="<?php echo $partner->admin_id;?>"><?php echo $partner->admin_name;?> <?php echo $partner->admin_last_name;?> (<?php echo $partner->admin_email;?>)
                                            </option>
                                            <?php } }?>
                                </select>
                                </div>
                               </div> 
                               
                               <div class="col-lg-6">
                                    <div class="form-group">
                                    <label for="simpleinput">API Key </label>
                                    <input type="text" value="<?=$settings->api_key?>"id="api_key" onKeyress="return false" readonly name="api_key" class="form-control" required>
                                    <button type="button" class="btn btn-primary mb-2 mt-3" onClick="generateAPIkey()">Generate</button>
                                    </div> 
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <label for="simpleinput">Mode</label>
                                    <select class="form-control" id="api_type" name="api_type" required>
                                    <option value="">-Select Mode-</option>                                       
                                    <option value="TEST" <?php if($settings->api_type =="TEST"){ echo "selected";}?>>TEST</option>
                                    <option value="LIVE"<?php if($settings->api_type =="LIVE"){ echo "selected";}?>>LIVE</option>
                                            
                                </select>                                  
                                    </div> 
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <label for="simpleinput">End Point </label>
                                    <input type="text" value="<?=$settings->api_url?>" id="api_url" name="api_url" class="form-control" required placeholder="Enter End Point">
                                    </div> 
                                </div>

                               <div class="col-lg-6">
                                <div class="form-group">
                                   <label for="sellers">Status</label>
                                   <div class="custom-control custom-switch">
                                     <input name="status" type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($settings->status == '1'){?> checked <?php } ?> name="is_status">
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
                                            <a href="<?php echo base_url() . 'api/api_key_settings';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
<script type="text/javascript">
 $(document).ready(function () {
    
    $('.seller,.partner').css('display','none');

    var selectedValue = parseInt($('#users').val());
    if (selectedValue === 1) {
        $('.seller').css('display', 'block');
        $('.partner').css('display', 'none');
    } else if (selectedValue === 2) {
        $('.partner').css('display', 'block');
        $('.seller').css('display', 'none');
    }

    $('#users').change(function() {
        var selectedValue = $(this).val();
        switch (selectedValue) {
            case '1':
                $('.seller').css('display', 'block');
                $('.partner').css('display', 'none');
                $("#partners").prop("selected", false);
                $('#partners').val('');
                break;
            case '2':
                $('.partner').css('display', 'block');
                $('.seller').css('display', 'none');
                $("#seller").prop("selected", false);
                $('#seller').val('');
                break;
            default:
                break;
            }
        });

     });
    function generateAPIkey() {
                        var keylist="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
                        temp=''
                        for (i=0;i<15;i++)
                        temp+=keylist.charAt(Math.floor(Math.random()*keylist.length))
                        $('#api_key').val(temp);
                    }
    </script>