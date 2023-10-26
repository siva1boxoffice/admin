<style>
   .choices__inner{ height : auto  !important;}
   .cust-switch {
    display: flex;
    align-items: center;
    justify-content: left !important;
    color: #96B0B7;
    font-weight: 400;
    font-size: 12px;
    margin: 5px 0;
}
   </style>
<?php $tab = @$_GET['tab'] ? $_GET['tab'] : "home";
; ?>

<?php 
$this->load->view(THEME . 'common/header'); ?>


<!-- Begin main content -->
<div class="main-content">
   <!-- content -->
   <div class="page-content">
      <!-- page header -->
      <div class="page-title-box tick_details">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-8">
                  <h5 class="card-title">Promotion Banner </h5>
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
                              <a href="#home-b1" data-id="home" data-toggle="tab" aria-expanded="false"
                                 class="nav-link <?php echo $tab == "home" ? "active" : ""; ?>">
                                 Add or Edit Promotion Banner
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="#profile-b1" data-id="content" data-toggle="tab" aria-expanded="true"
                                 class="nav-link  <?php echo $tab == "content" ? "active" : ""; ?>"
                                 id="profile-b1-link">
                                 Section Content 
                              </a>
                           </li>
                        </ul>
                        <!--  -->
                        <div class="tab-content">
                           <div class="tab-pane show <?php echo $tab == "home" ? "active" : ""; ?>" id="home-b1">
                           <form id="match-form" method="post"
                                          class="<?php echo (isset($tournaments->v_id)) ? 'validate_form_edit' : 'validate_form_v1'; ?> login-wrapper"
                                          action="<?php echo base_url(); ?>settings/promotion_banner/save"
                                          class="match-form-class">
                                          <input type="hidden" name="promotionId" value="<?php if (isset($tournaments->p_id)) {
                                             echo $tournaments->p_id;
                                          } ?>">
                              <div class="row">                              
                                 <div class="col-12">
                                    <div class="card">
                                       <div class="">
                                          <h5 class="card-title">Promotion Banner</h5>
                                          <p>Fill the following Promotion Banner information</p>
                                       </div>
                                       <div class="row">
                                       <div class="col-8">
                                       <div class="">
                                                   <div class="row column_modified">
                                                      <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label for="banner_name">Banner Name <span
                                                                  class="text-danger">*</span> </label>
                                                            <input required type="text" name="banner_name" id="banner_name" class="form-control" placeholder="Enter Banner Name" value="<?php if (isset($tournaments->banner_name)) {
                                                                  echo $tournaments->banner_name;
                                                               } ?>">
                                                         </div>
                                                      </div>
                                                     
                                                          <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label for="simpleinput">Banner URL</label>
                                                            <input  type="text" id="banner_url" name="banner_url"
                                                               class="form-control" placeholder="Enter Banner URL" value="<?php
                                                               echo isset($tournaments->banner_url) ? $tournaments->banner_url : ''; ?>">
                                                         </div>
                                                      </div>                                                      

                                                      <!-- <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label for="simpleinput">Section Title</label>
                                                            <input  type="text" id="section_title" name="long_descrption_title"
                                                               class="form-control" placeholder="Enter Title" value="<?php
                                                              // echo isset($tournaments->long_descrption_title) ? $tournaments->long_descrption_title : ''; ?>" required> 
                                                         </div>
                                                      </div>

                                                      <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="example-textarea">Section Description *</label>
                                                         <textarea class="form-control height_auto " id="long_descrption"
                                                            rows="5" name="long_descrption"
                                                            placeholder="Enter Section Description" required><?php //echo isset($tournaments->long_descrption) ? $tournaments->long_descrption : ''; ?></textarea>
                                                      </div>
                                                   </div> -->


                                                   <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label for="example-select">Banner Image<span
                                                                  class="text-danger">*</label>
                                                            <div class="prev_back_img">
                                                               <label class="custom-upload mb-0"><input type="hidden"
                                                                     name="exs_file" value="<?php if (isset($tournaments->banner_image)) {
                                                                        echo $tournaments->banner_image;
                                                                     } ?>"><input type="file" class="form-control-file input"
                                                                     name="tournament_image" id="tournament_image" value=""
                                                                     onchange="loadFiles(event,'blog_img_file')"  <?php if($tournaments->p_id==""){?> required <?php } ?> accept="image/*"> Upload JPEG
                                                                  File</label>
                                                               <p>Preview Banner Image </p>
            <a id="blog_img_file_link" target="_blank"
               href="javascript:void(0);" onclick="return popitup('<?php if (isset($tournaments->banner_image)) { echo UPLOAD_PATH . 'uploads/banner_image/' . $tournaments->banner_image; } ?>')" class="view_bg">
               <img width="30" height="30" src="<?php if (isset($tournaments->banner_image)) {
                  echo UPLOAD_PATH . 'uploads/banner_image/' . $tournaments->banner_image;
               } else {
                  echo UPLOAD_PATH . 'uploads/general_settings/no-image.png';
               } ?>" id="blog_img_file">
                                                               </a>
                                                            </div>
                                                         </div>
                                                      </div>
                                                     

                                                   </div> <!-- end col -->
                                                </div> <!-- end card-body -->
                                       </div>

                                       <div class="col-4">
                                       <div class="card">
                                    <div class="row column_modified">
                                       <div class="col-lg-12">
                                          <div class="data_edit">
                                             <table style="width: 100%;"> 
                                                <tr>
                                                   <td><label for="sellers" class="mb-0">Status</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch19" name="status" value="1" <?php if ($tournaments->status==1 ) { echo 'checked';  }?> ><label class="custom-control-label" for="customSwitch19"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>

                                             </table>
                                            </div>
                                            </div></div>
                                                         </div>
                                       </div>
                                       </div>



                                          <div class="clearfix"></div>
                                          <div class="col-lg-12">
                                             <div class="tick_details border-top">
                                                <div class="row">
                                                   <div class="col-sm-8">
                                                      <!-- <h5 class="card-title">Matches</h5> -->
                                                   </div>
                                                   <div class="col-sm-4">
                                                      <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                                         <a href="<?php echo base_url(); ?>settings/promotion_banner/"
                                                            class="btn btn-primary mb-2 mt-3">Back</a>
                                                         <button type="submit"
                                                            class="btn btn-success mb-2 ml-2 mt-3">Save</button>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>

                                    </div> <!-- end card -->
                                 </div><!-- end col -->
                              </div>
                              <!-- end row -->
                              </form>
                           </div>

                           <div class="tab-pane <?php echo $tab == "content" ? "active" : ""; ?>" id="profile-b1">
                              <div class="row">
                                 <div class="col-12">
                                    <div class="card">
                                       <div class="">
                                          <h5 class="card-title">Section Content Info</h5>
                                          <p>Fill the Section Content Information</p>
                                       </div>
                                       <div class="">
                                          <form id="seo_tab" method="post"
                                             class="<?php echo (isset($tournaments->c_id)) ? 'validate_edit_v2' : 'validate_form_v2'; ?>  login-wrapper"
                                             action="<?php echo base_url(); ?>settings/promotion_banner/save_section">
                                             <input type="hidden" name="promotionId" value="<?php if (isset($tournaments->p_id)) {
                                                echo $tournaments->p_id;
                                             } ?>">
                                             <input type="hidden" name="flag" value="content">
                                             <div class="row column_modified"> 
                                             
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="simpleinput">Section Title</label>
                                                <input  type="text" id="section_title" name="long_descrption_title"
                                                   class="form-control" placeholder="Enter Title" value="<?php
                                                   echo isset($tournaments->long_descrption_title) ? $tournaments->long_descrption_title : ''; ?>" required> 
                                             </div>
                                          </div>

                                          <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="example-textarea">Section Description *</label>
                                             <textarea class="form-control height_auto " id="long_descrption"
                                                rows="5" name="long_descrption"
                                                placeholder="Enter Section Description" required><?php echo isset($tournaments->long_descrption) ? $tournaments->long_descrption : ''; ?></textarea>
                                          </div>
                                       </div>

                                       <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="example-textarea">Banner Description *</label>
                                                         <textarea class="form-control height_auto " id="example-textarea"
                                                            rows="5" name="banner_description"
                                                            placeholder="Enter Description" required><?php echo isset($tournaments->banner_description) ? $tournaments->banner_description : ''; ?></textarea>
                                                      </div>
                                                   </div>
                                             
                                                <div class="col-lg-12">
                                                   <div class="tick_details border-top">
                                                      <div class="row">
                                                         <div class="col-sm-8">
                                                            <!-- <h5 class="card-title">Matches</h5> -->
                                                         </div>
                                                         <div class="col-sm-4">
                                                            <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                                               <a href="<?php echo base_url(); ?>settings/promotion_banner/"
                                                                  class="btn btn-primary mb-2 mt-3">Back</a>
                                                               <button type="submit"
                                                                  class="btn btn-success mb-2 ml-2 mt-3">Save</button>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>



                                             </div> <!-- end col -->
                                          </form>
                                       </div> <!-- end card-body -->
                                    </div> <!-- end card -->
                                 </div><!-- end col -->
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
         <!-- main content End -->
         <?php $this->load->view(THEME . 'common/footer'); ?>
         <script>
            $(document).ready(function () {
            
               if ($('#sellers').length) new Choices('#sellers', { removeItemButton: !0, searchFields: ['label', 'value'], allowSearch: true });
               $('.validate_form_v1').validate({
                  submitHandler: function (form) {

                     var myform = $('#' + $(form).attr('id'))[0];

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

                        success: function (data) {
                           if (data.status == 1) {

                              swal('Updated !', data.msg, 'success');
                              setTimeout(function () { window.location.href = data.redirect_url; }, 2000);
                           } else if (data.status == 0) {

                              swal('Updation Failed !', data.msg, 'error');
                              setTimeout(function () { window.location.href = data.redirect_url; }, 2000);

                           }
                        }
                     })
                     return false;
                  }
               });


               $('.validate_form_v2').validate({
                  submitHandler: function (form) {

                     var myform = $('#' + $(form).attr('id'))[0];

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

                        success: function (data) {
                           if (data.status == 1) {

                              swal('Updated !', data.msg, 'success');
                              setTimeout(function () { window.location.href = data.redirect_url; }, 2000);
                           } else if (data.status == 0) {

                              swal('Updation Failed !', data.msg, 'error');
                              setTimeout(function () { window.location.href = data.redirect_url; }, 2000);

                           }
                        }
                     })
                     return false;
                  }
               });

               // <ul class="nav nav-tabs nav-bordered">

               // Execute this code when the page finishes loading

               <?php if (empty($tournaments->v_id)) { ?>
                     $(".change_stadium").change(function() {
                        selected_text= $(".change_stadium option:selected").text();
                        $('#country_name').val(selected_text);
                        var val = selected_text;
                        var slug = "";
                        if (val) {
                           slug = slugfly(val);
                           $("#url_key").val(slug+'-tickets');
                           $("#seo_url_key").val(slug+'-tickets');                
                        }
                     });
               <?php  } ?>     

            });


   <?php if (empty($tournaments->v_id)) { ?>
               $("body").on("keyup", "#country_name", function () {
                  var val = $("#country_name").val();
                  var slug = "";
                  if (val) {
                     slug = slugfly(val);
                     $("#url_key").val(slug+'-tickets');
                     $("#seo_url_key").val(slug+'-tickets');
                     
                  }

               });
 <?php } ?>

               function slugfly(str) {
                  str = str.replace(/^\s+|\s+$/g, ''); // trim
                  str = str.toLowerCase();

                  // remove accents, swap ñ for n, etc
                  var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
                  var to = "aaaaaeeeeeiiiiooooouuuunc------";
                  for (var i = 0, l = from.length; i < l; i++) {
                     str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                  }

                  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                     .replace(/\s+/g, '-') // collapse whitespace and replace by -
                     .replace(/-+/g, '-'); // collapse dashes

                  return str;
               }


            $(".nav-tabs a[data-toggle=tab]").on("click", function (e) {
               var href = $(this).data("id");
      <?php if (empty($tournaments->p_id)) { ?>
         if (href != "home") {
                     swal('Attention!', ' Please Fill The Banner Details', 'error');
                     return false;
                  }
     <?php } else {
         ?>

             // Get current URL parts
             const path = window.location.pathname;
                     const params = new URLSearchParams(window.location.search);
                     const hash = window.location.hash;
                     // Update query string values
                     params.set('tab', href);

                     window.history.replaceState({}, '', `${path}?${params.toString()}${hash}`);
      <?php } ?>
   });

            function popitup(url, temp = '') {

               newwindow = window.open(url, 'name', 'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,,height=500,width=700');

               if (window.focus) { newwindow.focus() }
               return false;
            }

            var loadFiles = function(event,team_bg_file) {

var formData = new FormData();
formData.append('file', event.target.files[0]);

$.ajax({
     url : "<?php echo base_url();?>settings/upload_files",
     type : 'POST',
     data : formData,
     processData: false,  // tell jQuery not to process the data
     contentType: false,  // tell jQuery not to set contentType
     dataType: 'json',
     success : function(data) {

        if(data.uploaded_file){
          var src = "<?php echo UPLOAD_PATH;?>uploads/temp/"+data.uploaded_file;
          var output = document.getElementById(team_bg_file);
          output.src = src;
          $("#"+team_bg_file+"_link").attr("onclick", "return popitup('"+src+"');");          
        }
     }
});
};

</script>