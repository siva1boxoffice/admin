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
                           <h3 class="mb-1 font-weight-bold">Affilate Events Settings</h3>
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
                          <h5 class="card-title">Create / Edit Affilate Events </h5>
                          <p>Fill the following Team information</p>
                        </div>

                     <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>settings/match_settings/save_affiliate_settings">


                      <?php
                            $link_id = json_decode(base64_decode($this->uri->segment(4)));
                            ?>
                            <input type="hidden" name="link_id" value="<?php echo $link_id;?>">
                         <div class="row column_modified ">
                            <div class="col-lg-4">
                                  <div class="form-group">
                                   <label for="seat_position">Choose Afiliate </label>
                                   <select class="custom-select " name="afiliates_id" id="afiliates_id"  required>
                                                   <!--  <option value="">-Choose Afiliate-</option> -->
                                                     <?php foreach($afiliates as $afiliate){ ?>

                                            <option  <?php echo $afiliate->admin_id == $affiliate_mathes_edit->affiliate_id ?  "selected" : "" ;?> value="<?php echo $afiliate->admin_id;?>"><?php echo $afiliate->admin_name;?> <?php echo $afiliate->admin_last_name;?> (<?php echo $afiliate->company_name;?>)</option>

                                                <?php } ?>
                                                </select>
                                  </div>
                               </div>
                         
                               <div class="col-lg-4">
                                 <div class="form-group">
                                   <label for="event">Choose Matches</label>

                                <select class="roleuser custom-select" name="match_id" id="match_id"  required>
                                                   <!--  <option value="">-Choose Afiliate-</option> -->
                                                     <?php foreach($matches as $match){ ?>

                                                <option <?php if($match->m_id == $affiliate_mathes_edit->match_id ) 
                                                  { ?> selected <?php } ?> value="<?php echo $match->m_id;?>">
                                                 <?php echo $match->match_name;?> -  <?php echo $match->match_date;?>  - <?php echo $match->tournament_name;?>
                                                </option>

                                                <?php } ?>
                                                </select>
                                </div>
                               </div>

                               <div class="col-lg-4">
                                 <div class="form-group">
                                   <label for="event">Select Language</label>

                                <select class="roleuser form-control" name="affiliate_language" id="affiliate_language"  required>
                                                 

                                                    <option  value="en" <?php echo $affiliate_mathes_edit->affiliate_language == "en" ? "selected" : "" ;?> >English</option>
                                                    <option  value="ar" <?php echo $affiliate_mathes_edit->affiliate_language == "ar" ? "selected" : "" ;?> >Arabic</option>
                                                </select>
                                </div>
                               </div>
                        

                             <div class="col-lg-8">
                                 <div class="form-group">
                                   <label for="event">Token</label>

                                <input class="form-control" required id="token" name="token" value="<?php echo $affiliate_mathes_edit->token ;?>" />
                                </div>
                               </div>


                                <div class="col-lg-4">
                                 <div class="form-group">
                                   <label for="event">Select Status</label>

                                  <select class="roleuser form-control" name="links_status" id="links_status"  required>
                                                 

                                <option  value="1" <?php echo $affiliate_mathes_edit->links_status == 1? "selected" : "" ;?> >Active</option>
                                <option  value="0" <?php echo $affiliate_mathes_edit->links_status == 0 ? "selected" : "" ;?> >InActive</option>

                                             
                                                </select>
                                </div>
                               </div>
                           </div>

                        

                        <div class="tick_details border-top">
                                 <div class="row">
                                    <div class="col-sm-8">
                                       <!-- <h5 class="card-title">Matches</h5> -->
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                          <a href="<?php echo base_url();?>settings/match_settings/affiliate_mathes_settings" class="btn btn-primary mb-2 mt-3">Back</a>
                                             <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Save</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
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
                    $(document).ready(function(){
                        // if ($('#sellers').length) new Choices('#sellers', { removeItemButton: !0 });
                        // if ($('#partners').length) new Choices('#partners', { removeItemButton: !0 });
                       // if ($('#afiliates_id').length) new Choices('#afiliates_id', { removeItemButton: !0 });
                       // if ($('#match_id').length) new Choices('#match_id', { removeItemButton: !0 });
                       /* get_users(1,'sellers');
                        get_users(2,'partners');
                        get_users(3,'afiliates');
                        get_users(4,'storefronts');*/
                    })
                    

                    function generate_token(length){
    //edit the token allowed characters
    var a = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890".split("");
    var b = [];  
    for (var i=0; i<length; i++) {
        var j = (Math.random() * (a.length-1)).toFixed(0);
        b[i] = a[j];
    }
    return b.join("");
}
    <?php if($link_id == ""){

        ?>
    $("#token").val(generate_token(50));
<?php } ?>
                </script>
