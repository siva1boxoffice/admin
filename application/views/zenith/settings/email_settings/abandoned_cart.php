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
                         <form id="branch-form" method="post" class="validate_form_manaul login-wrapper" action="<?php echo base_url();?>settings/abandoned_cart/send_email">
                       
                         
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Abandoned Cart</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <!-- <a href="<?php echo base_url();?>settings/email_settings/email_list" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Email Access</span>
                                                </a> -->
                                                <button type="submit" id="branch-form-btn" class="button h-button is-primary is-raised">Send Email</button>
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
                                                    <label>Tournament</label>
                                                    <div class="control">
                                                       <select class="roleuser form-control" required name="tournament" id="tournament" > 
                                                      
                                                        <option value="">Select Tournament</option>
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
                                             
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Abandoned List<span class="abandoned_list"></span></label>
                                                    <div class="control">
                                                       <select class="user_list form-control"  required name="user_list" id="user_list" > 
                                                      
                                                       
                                                    
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- <div class="column is-12">
                                                <div class="field">
                                                    <label>Select Type</label>
                                                    <div class="control">
                                                        <select class="roleuser form-control" required name="type" id="type" > 
                                                        <option value="">Select Type </option>
                                                        <option value="1">Abondaned Cart </option>
                                                        <option value="1">Request Ticket</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Subject *</label>
                                                    <div class="control">
                                                        <input type="text" id="subject" name="subject" class="input" placeholder="Subject" required value="">
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Message *</label>
                                                    <div class="control">
                                                        <textarea id="message" name="message" class="input" cols="10" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
 -->
                                        
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
                        // if ($('#tournament').length) {
                        //      new Choices('#tournament', { 
                        //         removeItemButton: !0 
                        //     });
                        // }
                           
                        $("#tournament").on("change",function(){

                            load_ajax();
                        });

                        function load_ajax(){
                            var tournament_id = $("#tournament").val();
                            var from_date = $("#bulma-datepicker-1").val();
                            var to_date = $("#bulma-datepicker-10").val();
                            var action = base_url + "settings/abandoned_cart/ajax_checkout/" ;
                            $.ajax({
                                type: "GET",
                                dataType: "json",
                                data :{ "tournament" :  tournament_id , "start_date" : from_date , "end_date" : to_date},
                                url: action,
                                success: function(data) {
                                    var html = "";
                                    $(".abandoned_list").html(" (" +data.count +")");
                                    if(data.status == 1) {

                                    $.each(data.html, function (key, val) {
                                       html +="<option value='"+val.bg_id+"'>"+val.customer_name+ " - "+ val.customer_email +  " - "+ val.match_name +  " - "+ val.tournament +"</option>";
                                    });
                                    
                                    }
                                    $("#user_list").html(html);
                                }
                             });
                        }

                         $('#message').summernote({
                          placeholder: 'Message',
                          tabsize: 2,
                          height: 250,                 // set editor height
                          minHeight: null,             // set minimum height of editor
                          maxHeight: null,             // set maximum height of editor
                          focus: true, 
                          toolbar: [
                              ['style', ['style']],
                              ['font', ['bold', 'underline', 'clear']],
                              ['para', ['ul', 'ol', 'paragraph']],
                              ['table', ['table']],
                              ['insert', ['link', 'picture', 'video']],
                              ['view', ['codeview', 'help']]
                          ]
                      });

                    });

         bulmaCalendar.attach("#bulma-datepicker-1", { dateFormat: "YYYY-MM-DD" ,startDate: new Date('<?php echo date('Y-m-d' ,strtotime("-30 days"));?>'), color: themeColors.primary, lang: "en",showHeader: false,
    showButtons: false,
    showFooter: false });

          bulmaCalendar.attach("#bulma-datepicker-10", {dateFormat: "YYYY-MM-DD" ,startDate: new Date('<?php echo date('Y-m-d');?>'), color: themeColors.primary, lang: "en",showHeader: false,
    showButtons: false,
    showFooter: false });



          $('.validate_form_manaul').validate({


            submitHandler: function(form) {

                swal({
                    title: "Are your sure send email to customer ?",
                    text: "",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Yes, Change it!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'button h-button is-primary',
                    cancelButtonClass: 'button h-button is-danger',
                    buttonsStyling: false
                  }).then(function (res) {

                    if (res.value == true) {
                     
                    $("#branch-form-btn").html("Please Wait..");
                        
                      var myform = $('#'+$(form).attr('id'))[0];
                        //is-loading no-click
                       // branch-form-btn
                      var formData = new FormData(myform);

                       // $('#'+$(form).attr('id')+'-btn').addClass("is-loading no-click");

                       // $('.has-loader').addClass('has-loader-active');
                        
                      var action = $(form).attr('action');
                        $.ajax({
                          type: "POST",
                          enctype: 'multipart/form-data',
                          url: action,
                          data: formData,
                          processData: false,
                          contentType: false,
                          cache: false,
                          dataType: "json",

                          success: function(data) { 

                         //   $('#'+$(form).attr('id')+'-btn').removeClass("is-loading no-click");

                            if(data.status == 1) {

                              notyf.success(data.msg, "Success", {
                              timeOut: "1800"
                              });
                              setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
                            }else if(data.status == 0) {
                               notyf.error(data.msg, "Failed", "Oops!", {
                              timeOut: "1800"
                              });
                              setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
                              
                            }
                             $("#branch-form-btn").html("Send Email");
                          }
                        })

                        return false;
                 
                 }
                       
                      }, function (dismiss) {

                      });
              }
                   
       

                    });
                </script>
				<?php exit;?>