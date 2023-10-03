<?php $this->load->view('common/header');?>
<style type="text/css">
    .datetimepicker-dummy .datetimepicker-dummy-wrapper .datetimepicker-dummy-input{
        max-width: 100%;
    }
</style>
        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="export_data" method="get" class="validate_form_manaul login-wrapper" action="<?php echo base_url();?>settings/export/request_tickets">
                       
                         
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Export Data</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <!-- <a href="<?php echo base_url();?>settings/email_settings/email_list" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Email Access</span>
                                                </a> -->
                                                <button type="submit" id="branch-form-btn" class="button h-button is-primary is-raised">Export</button>
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
                                                    <label>Export </label>
                                                    <div class="control">
                                                       <select class="roleuser form-control" required name="export" id="export" > 
                                                      
                                                        <option value="request_tickets">Request Ticket</option>
                                                        <option value="abondaned_cart"> Abandoned Cart</option>
                                                        <option value="customer">Customer</option>

                                                   
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="column is-12 tournaments_list">
                                                <div class="field">
                                                    <label>Tournament</label>
                                                    <div class="control">
                                                       <select class="roleuser form-control"  name="tournament" id="tournament" > 
                                                      
                                                        <option value="">All Tournament</option>
                                                    <?php if($tournaments){

                                                        foreach ($tournaments as $key => $value) {
                                                           ?>

                                                           <option value="<?php echo $value->t_id ;?>"><?php echo $value->tournament_name ;?></option>
                                                           <?php 
                                                        }
                                                       
                                                    } ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>

                                              <div class="column is-6">
                                                <div class="field">
                                                    <label>From Date *</label>
                                                    <div class="control">
                                                        <input type="date" id="bulma-datepicker-1" name="from_date" class="input" placeholder="From Date" required value="">
                                                    </div>
                                                </div>
                                            </div>

                                              <div class="column is-6">
                                                <div class="field">
                                                    <label>To Date *</label>
                                                    <div class="control">
                                                        <input type="date" id="bulma-datepicker-10" name="to_date" class="input" placeholder="To Date" required value="">
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
    
         bulmaCalendar.attach("#bulma-datepicker-1", { dateFormat: "YYYY-MM-DD" ,startDate: new Date('<?php echo "2022-01-01";?>'), color: themeColors.primary, lang: "en",showHeader: false,
            showButtons: false,
            showFooter: false });

                  bulmaCalendar.attach("#bulma-datepicker-10", {dateFormat: "YYYY-MM-DD" ,startDate: new Date('<?php echo date('Y-m-d');?>'), color: themeColors.primary, lang: "en",showHeader: false,
            showButtons: false,
            showFooter: false });


          $("#export").on("change",function(){
            var val = $(this).val();

            if(val == "customer"){
                $(".tournaments_list").hide();
            }
            else{
                $(".tournaments_list").show();
            }

                $("#export_data").attr("action", "<?php echo base_url();?>settings/export/" +val);     
            
            });
    });
</script>
<?php exit;?>