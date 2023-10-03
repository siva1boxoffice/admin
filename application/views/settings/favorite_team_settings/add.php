<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" enctype='multipart/form-data' class="validate_form_v2 login-wrapper" action="<?php echo base_url();?>settings/favorite_team_settings/save">
                            <input type="hidden" name="id" value="<?php echo $setting->id;?>">
                         <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">Favorite Team Settings</h2>
                                </div>
                            </div>
                           
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Create New Favorite Team</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>settings/favorite_team_settings" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Favorite Team Settings</span>
                                                </a>
                                                <button type="submit" id="branch-form-btn" class="button h-button is-primary is-raised">Confirm</button>
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

                                        <div class="columns is-multiline">

                                              <div class="column is-12">
                                                <div class="field">
                                                    <label>Choose Sellers *</label>
                                                    <div class="control" id="sellers_div">
                                                     <select class="actionpayout roleuser form-control" required name="seller" id="sellers">
                                                    <option value="">-Choose Sellers-</option>
                                                    <?php foreach($sellers as $seller){ ?>
                                                    <option <?php if ($seller->admin_id == $setting->seller_id)
  { ?> selected <?php } ?> value="<?php echo $seller->admin_id;?>"><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?> (<?php echo $seller->company_name;?>)</option>
                                                <?php } ?>
                                                </select>
                                                            </div>
                                                </div>
                                            </div>
 
                                            
                                          

                                            <div class="column is-12" id="order_element">
                                           
                                            </div>
                                        <div class="column is-6">
                                        <div class="field">
                                        <label>Status</label>
                                        <div class="control has-icon">
                                        <div class="switch-block no-padding-all">
                                        <label class="form-switch is-primary">
                                        <input type="checkbox" class="is-switch" name="status" value="1" <?php if (isset($setting->status)) {
                                        if ($setting->status == 1) { ?> checked <?php }
                                        } ?>>
                                        <i></i>
                                        </label>
                                        <div class="text">
                                        <span>Inactive / Active</span>
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
                      
                      
                      new Pikaday({ field: document.getElementById("pickaday-datepicker-one"), format: "D MMM YYYY", onSelect: function () {$('.actionpayout').trigger('change');} });
                      new Pikaday({ field: document.getElementById("pickaday-datepicker-two"), format: "D MMM YYYY", onSelect: function () {$('.actionpayout').trigger('change');} });

                    get_teams();
                   function get_teams(){

					var action = "<?php echo base_url();?>settings/favorite_team_settings/get_teams";
					$.ajax({
					type: "POST",
					url: action,
					cache: false,
					dataType: "json",
                    data : {'teams' : "<?php echo $setting->teams;?>"},
					success: function(data) {

					$('#order_element').html(data.response);


					}
					})


                   }


                    })


                    
                   

   

                </script>
<?php exit;?>
