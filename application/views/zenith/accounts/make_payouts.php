<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" enctype='multipart/form-data' class="validate_form_v2 login-wrapper" action="<?php echo base_url();?>accounts/save_payout">
                         <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">New Payout</h2>
                                </div>
                            </div>
                           
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Create New Payout</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>accounts/save_payout" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Payout</span>
                                                </a>
                                                <button type="submit" id="branch-form-btn" class="button h-button is-primary is-raised">Confirm Payout</button>
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
                                            <h4>Payout Info</h4>
                                            <p>Fill the following Seller and Order information</p>
                                        </div>

                                        <div class="columns is-multiline">

                                              <div class="column is-12">
                                                <div class="field">
                                                    <label>Choose Sellers *</label>
                                                    <div class="control" id="sellers_div">
                                                     <select class="actionpayout roleuser form-control" required name="seller" id="sellers">
                                                    <option value="">-Choose Sellers-</option>
                                                    <?php foreach($sellers as $seller){ ?>
                                                    <option <?php if (in_array($seller->admin_id, explode(',',$match_settings->sellers)))
  { ?> selected <?php } ?> value="<?php echo $seller->admin_id;?>"><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?> (<?php echo $seller->company_name;?>)</option>
                                                <?php } ?>
                                                </select>
                                                            </div>
                                                </div>
                                            </div>
 
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Order From *</label>
                                                    <div class="control">
                                                       <input name="order_from" id="pickaday-datepicker-one" class="input actionpayout" type="text" placeholder="dd/mm/yyy" required  value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Order To *</label>
                                                    <div class="control">
                                                        <input name="order_to" id="pickaday-datepicker-two" class="input actionpayout" type="text" placeholder="dd/mm/yyy" required  value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="column is-12" id="order_element">
                                               
                                            </div>

                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Total Payable *</label>
                                                    <div class="control" id="afiliates_div">
                                                     <span id="payable_amount">0.00</span>
                                                </select>
                                                            </div>
                                                </div>
                                            </div>

                                            <div class="column is-6">
											<div class="field">
												<label>Upload Payout Or Bank Deposit Receipt *</label>
												<div class="control has-icon">
													<div class="file has-name is-fullwidth">
														<label class="file-label">
															<input class="file-input" type="file" id="payout_receipt" name="payout_receipt" required accept="pdf" >
															<span class="file-cta">
																<span class="file-icon">
																	<i class="lnil lnil-lg lnil-cloud-upload"></i>
																</span>
																<span class="file-label">
																	Choose a file…
																</span>
															</span>
														</label>
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


                   $('.actionpayout').on('change',function(){

					$('#orders').val('');
					var seller_id   = $('#sellers').val();
					var order_from  = $('#pickaday-datepicker-one').val();
					var order_to 	= $('#pickaday-datepicker-two').val();
					var orders 	= $('#orders').val();
					var action = "<?php echo base_url();?>accounts/get_unpayable_orders";
					$.ajax({
					type: "POST",
					url: action,
					data: {"seller_id" : seller_id,"order_from" : order_from,"order_to" : order_to,"orders" : orders},
					cache: false,
					dataType: "json",

					success: function(data) {

					$('#order_element').html(data.response.list_orders);
					$('#payable_amount').text(data.response.base_currency+' '+ data.response.payable_amount);


					}
					})


                   })


                    })


                    
                </script>
<?php exit;?>
