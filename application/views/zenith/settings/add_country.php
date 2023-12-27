<?php  $this->load->view(THEME.'common/header'); ?>

<!-- Begin main content -->
<div class="main-content">
      <!-- content -->
      <div class="page-content">
        <!-- page header -->
        <div class="page-title-box tick_details">
          <div class="container-fluid">
            <div class="row">
                     <div class="col-sm-8">
                        <h5 class="card-title">Add Country</h5>
                     </div>
                     <div class="col-sm-4">
                        <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                        </div>
                     </div>
                  </div>
          </div>
        </div>
        <!-- page content -->
        <div class="page-content-wrapper mt--45 box-details">
          <div class="container-fluid">
            <div class="card">
               <div class="card-body">            
                  <div class="row">
                     <div class="col-lg-12">
                        <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                              <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Add or Edit Country
                              </a>
                            </li>  
                                                 
                        </ul>
                        <div class="tab-content">
                           <div class="tab-pane show active" id="home-b1">
                              <div class="row">
                                <div class="col-12">
                                  <div class="card">
                                    <div class="">
                                      <h5 class="card-title">Country</h5>
                                      <p>Fill the following Country information</p>
                                    </div>
                                    <form id="add-team-form" enctype='multipart/form-data' method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>settings/countries/save">
									<input type="hidden" name="country_id" value="<?php if (isset($country_details->id)) {
																							echo $country_details->id;
																						} ?>">
                                    <div class="">
                                      <div class="row column_modified">   
                                      <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Country Name </label>
                                           <input required type="text" name="cname" id="cname" class="form-control" placeholder="Enter Country Name" value="<?php  if (isset($country_details->name)) { echo $country_details->name; } ?>">
                                          </div> 
                                       </div>

									   <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Sort Name </label>
                                           <input required type="text" name="sname" id="sname" class="form-control" placeholder="Enter Sort Name" value="<?php  if (isset($country_details->sortname)) { echo $country_details->sortname; } ?>">
                                          </div> 
                                       </div>

									   <div class="col-lg-3">
                                          <div class="form-group">
                                           <label for="simpleinput">Phone Code</label>
                                           <input required type="text" name="pcode" id="pcode" class="form-control" placeholder="Enter Phone Code" value="<?php  if (isset($country_details->phonecode)) { echo $country_details->phonecode; } ?>">
                                          </div> 
                                       </div>

									   <div class="col-lg-12">
                                          <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2 tick_details ">
                                                <a href="<?php echo base_url();?>settings/countries" class="btn btn-primary mb-2">Back</a> 

                                                <button type="submit" id="branch-form-btn" class="btn btn-success mb-2 submit_match button h-button is-primary is-raised">Save
                                                </button>
                                          </div>
                                       </div>

                                    </div> <!-- end col -->                                    
                                    </div> <!-- end card-body -->                                    
                                  </div> <!-- end card -->
                                </div><!-- end col -->
                              </div>
                              <!-- end row -->
                           </form>
                           </div>
                     </div> 
                  </div>
               </div>
            </div>
           
        </div>
      </div>
      <!-- main content End -->
<?php  $this->load->view(THEME.'common/footer'); ?>
<script>
      $(document).ready(function(){
               $('.validate_form_v1').validate({
            submitHandler: function(form) {
               
               var myform = $('#'+$(form).attr('id'))[0];
              
               var formData = new FormData(myform);
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
                  if(data.status == 1) {                     
                     
                     swal('Updated !', data.msg, 'success');
                     setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
                  }else if(data.status == 0) {                    
                     
                     swal('Updation Failed !', data.msg, 'error');
                     setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);  

                  }
                  }
               })
               return false;
            }
            });

            $('.validate_form_v3').validate({
             
            submitHandler: function(form) {
               
               var myform = $('#'+$(form).attr('id'))[0];
              
               var formData = new FormData(myform);
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
                  if(data.status == 1) {                     
                     
                     swal('Updated !', data.msg, 'success');
                     setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
                  }else if(data.status == 0) {                    
                     
                     swal('Updation Failed !', data.msg, 'error');
                     setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);  

                  }
                  }
               })
               return false;
            }
            });
});
</script>