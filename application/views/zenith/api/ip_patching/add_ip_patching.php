<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>api/ip_patching/save" name="api_settings">
                            <?php
                            $api_id = json_decode(base64_decode($this->uri->segment(4)));
                            ?>
                            <input type="hidden" name="settings_id" value="<?php echo $api_id;?>">
                         <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">IP Patching</h2>
                                </div>
                            </div>
                           
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>IP Patching</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>api/ip_patching" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to list</span>
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
                                        <!-- <div class="fieldset-heading">
                                            <h4>User Info</h4>
                                            <p>Fill the following User information</p>
                                        </div> -->

                                        <div class="columns is-multiline">
                                           
                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Choose Partners *</label>
                                                    <div class="control" id="partners_div">
                                                         <select class="roleuser form-control" name="partners" id="partners" required>

                                                            <?php foreach($partners as $partner){ ?>
                                                            <option <?php if (in_array($partner->admin_id, explode(',',$settings->partner_id)))
                                                                { ?> selected <?php } ?> value="<?php echo $partner->admin_id;?>"><?php echo $partner->admin_name;?> <?php echo $partner->admin_last_name;?> (<?php echo $partner->admin_email;?>)
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>IP Address *</label>
                                                    <div class="control" id="storefronts_div">
                                                        <input type="text" value="<?=$settings->ip_address?>"id="ip_address" name="ip_address" class="form-control" pattern=".{5,30}" required>
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

                    $('#branch-form').submit(function(e) {
                        e.preventDefault();
                        // var ip = $('#ip_address').val();
                        // ip = ip.split(',');
                        // ip.forEach(function(v,k){
                        //     var ips = v.split('.');
                        //     if(ips.length == 4){
                        //         var flagip = 0;
                        //         ips.forEach(function(v,k){
                        //             if(isNaN(parseInt(v)) || parseInt(v) < 0 || parseInt(v) > 255){
                        //                 flagip = 1;
                        //             }
                        //         });
                        //         if(flagip == 1){
                        //             alert('Invalid IP Address format ');
                        //             return false;
                        //         }else{
                        //             return true;
                        //         }
                        //     }else{
                        //         alert('Invalid IP Address format ');
                        //         return false;
                        //     }
                        // });
                    });
                </script>
<?php exit;?>
