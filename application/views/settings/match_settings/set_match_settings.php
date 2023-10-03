<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>settings/match_settings/save_match_settings">
                            <?php
                            $match_id = json_decode(base64_decode($this->uri->segment(4)));
                            ?>
                            <input type="hidden" name="matchId" value="<?php echo $match_id;?>">
                         <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">Match Settings</h2>
                                </div>
                            </div>
                           
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Create Match Settings</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>settings/match_settings/match_settings" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Matches</span>
                                                </a>
                                                <button type="submit" id="branch-form-btn" class="button h-button is-primary is-raised">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body has-loader">

                                      <!--Loader-->
                                            <div class="h-loader-wrapper">
                                                <div class="loader is-small is-loading"></div>
                                            </div>
                                  
                                    <!--Fieldset-->
                                    <div class="form-fieldset" style="max-width: 580px;">
                                        <div class="fieldset-heading">
                                            <h4>User Info</h4>
                                            <p>Fill the following User information</p>
                                        </div>

                                        <div class="columns is-multiline">
                                           
                                             <!-- <div class="column is-12">
                                                <div class="field">
                                                    <label>User Role*</label>
                                                    <div class="control">
                                                       <select class="form-control" id="role" name="role" onchange="get_users();">
                                                    <option value="" selected>-Choose User Role-</option>
                                                    <option value="1">Seller</option>
                                                    <option value="2">Partners</option>
                                                    <option value="3">Afiliate</option>
                                                    <option value="4">Storefronts</option>
                                                </select>
                                                            </div>
                                                </div>
                                            </div> -->

                                              <div class="column is-12">
                                                <div class="field">
                                                    <label>Choose Sellers *</label>
                                                    <div class="control" id="sellers_div">
                                                     <select class="roleuser form-control" required name="sellers[]" id="sellers" multiple>
                                                    <!-- <option value="">-Choose Sellers-</option> -->
                                                    <?php foreach($sellers as $seller){ ?>
                                                    <option <?php if (in_array($seller->admin_id, explode(',',$match_settings->sellers)))
  { ?> selected <?php } ?> value="<?php echo $seller->admin_id;?>"><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?> (<?php echo $seller->company_name;?>)</option>
                                                <?php } ?>
                                                </select>
                                                            </div>
                                                </div>
                                            </div>

                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Choose Partners *</label>
                                                    <div class="control" id="partners_div">
                                                     <select class="roleuser form-control" name="partners[]" id="partners" multiple required>
                                                   <!--  <option value="">-Choose Partners-</option> -->
                                                    <?php foreach($partners as $partner){ ?>
                                                    <option <?php if (in_array($partner->admin_id, explode(',',$match_settings->partners)))
  { ?> selected <?php } ?> value="<?php echo $partner->admin_id;?>"><?php echo $partner->admin_name;?> <?php echo $partner->admin_last_name;?> (<?php echo $partner->company_name;?>)</option>
                                                <?php } ?>
                                                </select>
                                                            </div>
                                                </div>
                                            </div>

                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Choose Afiliate *</label>
                                                    <div class="control" id="afiliates_div">
                                                     <select class="roleuser form-control" name="afiliates[]" id="afiliates" multiple required>
                                                   <!--  <option value="">-Choose Afiliate-</option> -->
                                                     <?php foreach($afiliates as $afiliate){ ?>
                                                    <option <?php if (in_array($afiliate->admin_id, explode(',',$match_settings->afiliates)))
  { ?> selected <?php } ?> value="<?php echo $afiliate->admin_id;?>"><?php echo $afiliate->admin_name;?> <?php echo $afiliate->admin_last_name;?> (<?php echo $afiliate->company_name;?>)</option>
                                                <?php } ?>
                                                </select>
                                                            </div>
                                                </div>
                                            </div>

                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Choose Storefronts *</label>
                                                    <div class="control" id="storefronts_div">
                                                     <select class="roleuser form-control" name="storefronts[]" id="storefronts" multiple required>
                                                   <!--  <option value="">-Choose Storefronts-</option> -->
                                                    <?php foreach($storefronts as $storefront){ ?>
                                                    <option <?php if (in_array($storefront->admin_id, explode(',',$match_settings->storefronts)))
  { ?> selected <?php } ?>  value="<?php echo $storefront->admin_id;?>"><?php echo $storefront->admin_name;?> <?php echo $storefront->admin_last_name;?> (<?php echo $storefront->company_name;?>)</option>
                                                <?php } ?>
                                                </select>
                                                            </div>
                                                </div>
                                            </div>
                                          
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Match Settings Status *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
<input type="checkbox" class="is-switch" name="status" value="1" 
<?php if($match_settings->status == '1'){?> checked <?php } ?>>
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Enable / disable Match Settings Status</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <!--Fieldset-->
                                    
                                </div>
                            </div>
                        </div>

                      
                    </form>
                    </div>

                <?php $this->load->view('common/footer');?>
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
<?php exit;?>
