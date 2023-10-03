<?php $this->load->view(THEME.'common/header'); ?>
        <style type="text/css">
            .choices__inner{
                height: auto;
            }
            .cust-switch{
                justify-content: flex-start;
            }
            
        </style>
     <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-sm-12 col-xl-12">
                        <div class="page-title">
                           <h3 class="mb-1 font-weight-bold">Create / Edit Match Settings</h3>
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
                          <h5 class="card-title">USER INFO</h5>
                          <p>Fill the following Match Settings information</p>
                        </div>

                      <form id="branch-form" method="post" class="validate_form_v2 login-wrapper" action="<?php echo base_url();?>settings/match_settings/save_match_settings">
                            <?php
                            $match_id = json_decode(base64_decode($this->uri->segment(4)));


                            $event = $this->General_Model->getOtherEvents('', '', $row_no = '', $row_per_page = '', $orderColumn = '', $orderby = '', array('match_info.m_id' => $match_id))->row();

                         
                            ?>
                            <input type="hidden" name="matchId" value="<?php echo $match_id;?>">
                             <input type="hidden" name="event_type" value="<?php echo $event->event_type;?>">


                      <?php
                            $link_id = json_decode(base64_decode($this->uri->segment(4)));
                            ?>
                            <input type="hidden" name="link_id" value="<?php echo $link_id;?>">
                         <div class="row column_modified ">
                            <div class="col-lg-12">
                                  <div class="form-group">
                                   <label for="seat_position">Choose Sellers *</label>
                                     <select class="custom-select" required name="sellers[]" id="sellers"  multiple>
                                                    <!-- <option value="">-Choose Sellers-</option> -->
                                                    <?php foreach($sellers as $seller){ ?>
                                                    <option <?php if (in_array($seller->admin_id, explode(',',$match_settings->sellers)))
  { ?> selected <?php } ?> value="<?php echo $seller->admin_id;?>"><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?> (<?php echo $seller->company_name;?>)</option>
                                                <?php } ?>
                                                </select>
                                  </div>
                               </div>
                         
                               <div class="col-lg-12">
                                 <div class="form-group">
                                   <label for="event">Choose Partners</label>

                                <select class="roleuser form-control" name="partners[]" id="partners" multiple required>
                                                   <!--  <option value="">-Choose Partners-</option> -->
                                                    <?php foreach($partners as $partner){ ?>
                                                    <option <?php if (in_array($partner->admin_id, explode(',',$match_settings->partners)))
  { ?> selected <?php } ?> value="<?php echo $partner->admin_id;?>"><?php echo $partner->admin_name;?> <?php echo $partner->admin_last_name;?> (<?php echo $partner->company_name;?>)</option>
                                                <?php } ?>
                                                </select>
                                </div>
                               </div>

                               <div class="col-lg-12">
                                 <div class="form-group">
                                   <label for="event">Choose Afiliate *</label>

                                <select class="roleuser form-control" name="afiliates[]" id="afiliates" multiple required>
                                                   <!--  <option value="">-Choose Afiliate-</option> -->
                                                     <?php foreach($afiliates as $afiliate){ ?>
                                                    <option <?php if (in_array($afiliate->admin_id, explode(',',$match_settings->afiliates)))
  { ?> selected <?php } ?> value="<?php echo $afiliate->admin_id;?>"><?php echo $afiliate->admin_name;?> <?php echo $afiliate->admin_last_name;?> (<?php echo $afiliate->company_name;?>)</option>
                                                <?php } ?>
                                                </select>
                                </div>
                               </div>
                        

                             <div class="col-lg-12">
                                 <div class="form-group">
                                   <label for="event">Choose Storefronts *</label>

                                <select class="roleuser form-control" name="storefronts[]" id="storefronts" multiple required>
                                                   <!--  <option value="">-Choose Storefronts-</option> -->
                                                    <?php foreach($storefronts as $storefront){ ?>
                                                    <option <?php if (in_array($storefront->admin_id, explode(',',$match_settings->storefronts)))
  { ?> selected <?php } ?>  value="<?php echo $storefront->admin_id;?>"><?php echo $storefront->admin_name;?> <?php echo $storefront->admin_last_name;?> (<?php echo $storefront->company_name;?>)</option>
                                                <?php } ?>
                                                </select>
                                </div>
                               </div>


                                <div class="col-lg-4">
                                 <div class="form-group">
                                   <label for="event">Status</label>

                                  <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                         <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch18" value="1" name="status" value="1" 
<?php if($match_settings->status == '1'){?> checked <?php } ?>> 
                                            <label class="custom-control-label" for="customSwitch18"></label>
                                         </div>
                                      </div>
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
                                          <a href="<?php echo base_url();?>event/matches/upcoming" class="btn btn-primary mb-2 mt-3">Back</a>
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
                        if ($('#sellers').length) new Choices('#sellers', { removeItemButton: !0 });
                        if ($('#partners').length) new Choices('#partners', { removeItemButton: !0 });
                        if ($('#afiliates').length) new Choices('#afiliates', { removeItemButton: !0 });
                        if ($('#storefronts').length) new Choices('#storefronts', { removeItemButton: !0 });
                       /* get_users(1,'sellers');
                        get_users(2,'partners');
                        get_users(3,'afiliates');
                        get_users(4,'storefronts');*/
                    })
                    
                </script>
