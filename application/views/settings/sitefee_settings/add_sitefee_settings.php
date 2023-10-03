<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>settings/sitefee_settings/save_markup">
                            <input type="hidden" name="id" value="<?php echo $markup->id;?>">
                        <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Create New SiteFeeMarkup</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>settings/sitefee_settings/sitefee_settings_list" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Markup</span>
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
                                            <h4>Markup Info</h4>
                                            <p>Fill the Markup information</p>
                                        </div>
                                        <div class="columns is-multiline">
                                             <div class="column is-6">
                                                <div class="field">	
                                                    <label>StoreFront *</label>
                                                   <select class="form-control select2"  name="store_id" id="store_id">
                                                   	<?php foreach($storefronts as $store){ ?>
                                                        <option <?php if($this->session->userdata('storefront')->admin_id==$store->admin_id){ echo 'selected'; }else{ echo 'disabled';} ?> value="<?=$store->admin_id?>"><?=$store->company_name?></option>
                                                    <?php } ?>
													</select>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field"> 
                                                    <label>Tournment *</label>
                                                   <select class="form-control select2"  name="t_id" id="t_id" onchange="call_defined(this.value)">
                                                    <?php foreach($tournments as $tournment){ ?>
                                                        <option <?php if($markup->t_id==$tournment->tournament_id){ echo 'selected'; } ?> value="<?=$tournment->tournament_id?>"><?=$tournment->tournament_name?></option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>Matches </label>
                                                    <div class="control">
                                                        <select class="form-control choose_match" id="m_id" name="m_id">
                                                            <option value="">Please Choose Match</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Markup in % *</label>
                                                    <div class="control">
                                                        <input type="text" id="markup" name="markup" class="input" placeholder="Enter Markup" required value="<?php echo $markup->markup;?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Markup Status *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
<input type="checkbox" class="is-switch" name="status" value="1" 
<?php if($markup->status == 1){?> checked <?php } ?>>
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Enable / disable Markup Status</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>

                                            
                                                    </div>
                                                </div>
                                            </div>
                                            
                                           
                                            
                                        </div>
                                    </div>
                                   
                                    
                                                                   </div>
                            </div>
                        </div>

                      
                    </form>
                    </div>
                <?php $this->load->view('common/footer');?>
                       
                <script type="text/javascript">
                    
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
				<?php exit;?>