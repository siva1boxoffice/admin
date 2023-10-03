<?php 
$tournments   = $this->General_Model->get_tournments()->result();
$this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>settings/discount_coupons/save_coupon">
                            <input type="hidden" name="id" value="<?php echo $coupons->c_id;?>">
                         
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Create New Coupon</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>settings/discount_coupons/discount_coupon_list" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Coupons</span>
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
                                            <h4>Coupon Info</h4>
                                            <p>Fill the Coupon information</p>
                                        </div>
                                        <div class="columns is-multiline">
                                            
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Tournments *</label>
                                                    <div class="control">
                                                        <select class="form-control choose_tournment"id="t_id" name="t_id" onchange="call_defined(this.value)">
                                                            <option value="">Please Choose Tournment</option>
                                                            <?php foreach ($tournments as $tournment) { ?>
                                                            <option value="<?php echo $tournment->t_id;?>" <?php if($tournment->t_id == $coupons->t_id){?> selected <?php } ?>><?php echo $tournment->tournament_name;?></option>
                                                             <?php } ?>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Matches *</label>
                                                    <div class="control">
                                                        <select class="form-control choose_match" id="m_id" name="m_id">
                                                            <option value="">Please Choose Tournment</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Coupon Code *</label>
                                                    <div class="control">
                                                        <input type="text" id="coupon_code" name="coupon_code" class="input" placeholder="Enter Coupon Code" required value="<?php echo $coupons->coupon_code;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Start Date *</label>
                                                    <div class="control">
                                                        <input type="text" id="create_date" name="create_date" class="input" placeholder="mm/dd/yyyy" required value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Expiry Date *</label>
                                                    <div class="">
                                                    	 <input name="expiry_date" id="expiry_date" class="input" type="date" placeholder="mm/dd/yyyy" required  value="">

                                                    </div>
                                                </div>
                                            </div>
                                              <div class="column is-6">
                                                <div class="field">
                                                    <label>Coupon Type *</label>
                                                   <select class="form-control"  name="coupon_type" id="coupon_type">
                                                   	<option value="">-Choose Coupon Type-</option>
													<option value="1" <?php if('1' == $coupons->coupon_type){?> selected <?php } ?>>Amount</option>
													<option value="2" <?php if('2' == $coupons->coupon_type){?> selected <?php } ?>>Percentage</option>
													</select>
                                                </div>
                                            </div>


                                                <div class="column is-6">
                                                    <div class="field">
                                                        <label>Min Price Range *</label>
                                                        <div class="control">
                                                            <input type="number" id="min_price" name="min_price" class="input" placeholder="Enter Min Price" required value="<?php echo $coupons->min_price;?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column is-6">
                                                    <div class="field">
                                                        <label>Max Price Range *</label>
                                                        <div class="control">
                                                            <input type="text" id="max_price" name="max_price" class="input" placeholder="Enter Max Price" required value="<?php echo $coupons->max_price;?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Coupon Value *</label>
                                                    <div class="control">
                                                        <input type="text" id="coupon_value" name="coupon_value" class="input" placeholder="Enter Coupon Value" required value="<?php echo $coupons->coupon_value;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Coupon Status *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
<input type="checkbox" class="is-switch" name="status" value="1" 
<?php if($coupons->status == 1){?> checked <?php } ?>>
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Enable / disable Coupon Status</span>
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
                        	
                        	<?php if (strtotime($coupons->expiry_date)){ ?>

                         bulmaCalendar.attach("#expiry_date", {startDate: new Date('<?php echo date('m/d/Y', strtotime($coupons->expiry_date));?>'), color: themeColors.primary, lang: "en",showHeader: false,
    showButtons: false,
    showFooter: false });

                    <?php } else { ?>

                        bulmaCalendar.attach("#expiry_date", {startDate: new Date('<?php echo date('m/d/Y');?>'), color: themeColors.primary, lang: "en",showHeader: false,
                            showButtons: false,
                            showFooter: false });

                    <?php } ?>  
                    <?php if (strtotime($coupons->create_date)){ ?>

                         bulmaCalendar.attach("#create_date", {startDate: new Date('<?php echo date('m/d/Y', strtotime($coupons->create_date));?>'), color: themeColors.primary, type:"date", lang: "en",showHeader: false,
                             showButtons: false,
                             showFooter: false });

                    <?php } else {?>

                        bulmaCalendar.attach("#create_date", {startDate: new Date('<?php echo date('m/d/Y');?>'), type:"date", color: themeColors.primary, lang: "en",showHeader: false,
                            showButtons: false,
                            showFooter: false });

                    <?php } ?>  
                        var w='';
                    <?php if ($coupons->m_id){ ?>
                            var w="<?php echo $coupons->m_id?>";
                            var t="<?php echo $coupons->t_id?>";
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
                                            $('.choose_match').html("<option value=''>change tournment</option>");
                                        }
                                      }
                                    });  
                            }
                        </script>
                
				<?php exit;?>