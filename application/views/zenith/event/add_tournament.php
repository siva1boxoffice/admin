<style>
   .choices__inner{ height : auto  !important;}
   </style>
<?php $tab = @$_GET['tab'] ? $_GET['tab'] : "home";
; ?>

<?php $this->load->view(THEME . 'common/header'); ?>

<!-- Begin main content -->
<div class="main-content">
   <!-- content -->
   <div class="page-content">
      <!-- page header -->
      <div class="page-title-box tick_details">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-8">
                  <h5 class="card-title">Tournaments</h5>
               </div>
               <div class="col-sm-4">
                  <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                     <!-- <a href="#" data-toggle="modal" data-target="#add-board-modal" class="btn btn-primary mb-2"><i class="bx bx-list-ol bx-flashing mr-1"></i> Go Back</a>  -->
                     <!-- <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2">Save</a> -->
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
                                 Add or Edit Tournament
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="#profile-b1" data-id="content" data-toggle="tab" aria-expanded="true"
                                 class="nav-link  <?php echo $tab == "content" ? "active" : ""; ?>"
                                 id="profile-b1-link">
                                 Content Info
                              </a>
                           </li>

                        </ul>
                        <!--  -->
                        <div class="tab-content">
                           <div class="tab-pane show <?php echo $tab == "home" ? "active" : ""; ?>" id="home-b1">
                           <form id="match-form" method="post"
                                          class="<?php echo (isset($tournaments->t_id)) ? 'validate_form_edit' : 'validate_form_v1'; ?> login-wrapper"
                                          action="<?php echo base_url(); ?>settings/tournaments/save"
                                          class="match-form-class">
                                          <input type="hidden" name="tournamentId" value="<?php if (isset($tournaments->t_id)) {
                                             echo $tournaments->t_id;
                                          } ?>">
                              <div class="row">                              
                                 <div class="col-12">
                                    <div class="card">
                                       <div class="">
                                          <h5 class="card-title">Tournaments</h5>
                                          <p>Fill the following Tournaments information</p>
                                       </div>
                                       
                                       <div class="row">
                                       <div class="col-8">

                                          <div class="">
                                             <div class="row column_modified">
                                             <div class="col-lg-4">
                                                   <div class="form-group">
                                                      <label for="tournament_name">Tournament Name <span
                                                            class="text-danger">*</span> </label>
                                                      <input required type="text" name="name" id="tournament_name"
                                                         class="form-control" placeholder="Enter Tournament Name" value="<?php if (isset($tournaments->tournament)) {
                                                            echo $tournaments->tournament;
                                                         } ?>">
                                                   </div>
                                                </div>
                                                <div class="col-lg-4">
                                          <div class="form-group">
                                              <label for="example-select">Event Category <span class="text-danger">*</span></label>
                                                 <select class="custom-select" id="gamecategory" name="gamecategory" required>
                                                      <option value="">Select Category</option>
                                                      <?php foreach ($gcategory as $category) { ?>
                                                            <option value="<?php echo $category->id; ?>" <?php if (isset($tournaments->category)) {
                                                               if ($tournaments->category == $category->id) {
                                                                  echo ' selected  ';
                                                               }
                                                               } ?>><?php echo $category->category_name; ?></option>
                                                            <?php
                                                               } ?>                                                        
                                                 </select>
                                          </div> 
                                       </div> 

                                                <div class="col-lg-4">
                                                   <div class="form-group">
                                                      <label for="simpleinput">Sort Order <span
                                                            class="text-danger">*</span> </label>
                                                      <input required type="text" name="sortby" id="sortby"
                                                         class="form-control" placeholder="Enter Sort Order" value="<?php if (isset($tournaments->sort_by)) {
                                                            echo $tournaments->sort_by;
                                                         } else {
                                                            echo 1000;
                                                         } ?>">
                                                   </div>
                                                </div>

                                                <div class="col-lg-4">
                                                   <div class="form-group">
                                                      <label for="simpleinput">Search Keywords</label>
                                                      <input type="text" name="search_keywords" id="search_keywords"
                                                         class="form-control" placeholder="Enter Search Keywords" value="<?php if (isset($tournaments->search_keywords)) {
                                                            echo $tournaments->search_keywords;
                                                         } ?>">
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <?php //echo "<pre>";print_r($ban_arr);?>
                                                      <label for="example-multiselect">Countries That Are Denied
                                                         Access</label>
                                                      <select name='bcountry[]' id="selectize-maximum"
                                                         class="form-control" multiple="multiple">
                                                         <option value="">-Select denied Countries-</option>
                                                         <?php foreach ($countries as $country) { ?>
                                                            <option <?php
                                                            if (isset($ban_arr)) {
                                                               if (in_array($country->id, $ban_arr)) {
                                                                  echo 'selected="selected"';
                                                               }
                                                            }
                                                            ?> value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                                                         <?php } ?>
                                                      </select>

                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="url_key">Url Key <span class="text-danger">*</span>
                                                      </label>
                                                      <input required type="text" name="url_key" id="url_key"
                                                         class="form-control" placeholder="Enter URL Key" value="<?php if (isset($tournaments->url_key)) {
                                                            echo $tournaments->url_key;
                                                         } ?>">
                                                   </div>
                                                </div>

                                               
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="example-select">Tournament Image (40x40) <span
                                                            class="text-danger">*</label>
                                                      <div class="prev_back_img">
                                                         <label class="custom-upload mb-0"><input type="hidden"
                                                               name="exs_file" value="<?php if (isset($tournaments->tournament_image)) {
                                                                  echo $tournaments->tournament_image;
                                                               } ?>"><input type="file" class="form-control-file input"
                                                               name="tournament_image" id="tournament_image" value=""
                                                               onchange="loadFiles(event,'blog_img_file')"  <?php if($tournaments->t_id==""){?> required <?php } ?> accept="image/*"> Upload JPEG
                                                            File</label>
                                                         <p>Preview Tournament Image </p>
      <a id="blog_img_file_link" target="_blank"
         href="javascript:void(0);" onclick="return popitup('<?php if (isset($tournaments->tournament_image)) { echo UPLOAD_PATH . 'uploads/tournaments/' . $tournaments->tournament_image; } ?>')" class="view_bg">
         <img width="30" height="30" src="<?php if (isset($tournaments->tournament_image)) {
            echo UPLOAD_PATH . 'uploads/tournaments/' . $tournaments->tournament_image;
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
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch18"  value="1"  <?php if($tournaments->t_status== '1' || $tournaments->t_id==""){?> checked <?php } ?> name="is_active">
                                                            <label class="custom-control-label" for="customSwitch18"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>

                                                <tr>
                                                   <td><label for="sellers" class="mb-0">Popular Tournament </label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" name="is_popular" id="customSwitch19" name="show_tournament"  value="1"  <?php if($tournaments->popular_tournament == '1' || $tournaments->t_id==""){?> checked <?php } ?> >
                                                            <label class="custom-control-label" for="customSwitch19"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>

                                                <tr>
                                                   <td><label for="sellers" class="mb-0">Show Tournament in List</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch20"  value="1"  <?php if($tournaments->show_in_list == '1' || $tournaments->t_id==""){?> checked <?php } ?> name="show_tournament">
                                                            
                                                            <label class="custom-control-label" for="customSwitch20"></label>
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

                                          <div class="team_info_details mt-3">
                                             <h5 class="card-title">API Share</h5>
                                          </div>

                                          <div class="row">
                                             <div class="col-12">
                                                <div class="card">
                                                   <div class="row column_modified">
                                                      <div class="col-lg-4">
                                                         <div class="data_edit">
                                                            <table style="width: 100%;">
                                                               <?php foreach ($partners as $partner) { ?>
                                                                  <tr>
                                                                     <td><label for="sellers" class="mb-0">
                                                                           <?php echo $partner->company_name; ?>
                                                                        </label></td>
                                                                     <td>
                                                                        <div class="form-group mb-1 cust-switch">
                                                                           Disable / Enable
                                                                           <div class="custom-control custom-switch">
                                                                              <input type="checkbox"
                                                                                 class="custom-control-input"
                                                                                 name="partner[]"
                                                                                 id="partner_<?php echo $partner->admin_id; ?>"
                                                                                 value="<?php echo $partner->admin_id; ?>"
                                                                                 <?php
                                                                                 $partner_ids = explode(',', $tournaments->partners);
                                                                                 if ($tournaments->t_id == "" || in_array($partner->admin_id, $partner_ids)) {
                                                                                    echo 'checked';
                                                                                 }
                                                                                 ?>>
                                          <label class="custom-control-label" for="partner_<?php echo $partner->admin_id; ?>"></label>
                                                                           </div>
                                                                        </div>
                                                                     </td>
                                                                  </tr>
                                                               <?php } ?>


                                                               <?php foreach ($partners_api as $partner_api) { ?>
                                                                  <tr>
                                                                     <td><label for="sellers" class="mb-0">
                                                                           <?php echo $partner_api->api_name; ?>
                                                                        </label></td>
                                                                     <td>
                                                                        <div class="form-group mb-1 cust-switch">
                                                                           Disable / Enable
                                                                           <div class="custom-control custom-switch">
                                                                              <input type="checkbox"
                                                                                 class="custom-control-input"
                                                                                 name="partner_api[]"
                                                                                 id="partner_api_<?php echo $partner_api->api_id; ?>"
                                                                                 value="<?php echo $partner_api->api_id; ?>"
                                                                                 <?php
                                                                                 $inpt_status = ($partner_api->api_id == 1) ? "tixstock_status" : "oneclicket_status";

                                                                                 if ($tournaments->t_id == "" || $tournaments->$inpt_status == 1) {
                                                                                    echo 'checked';
                                                                                 } ?>>
                                                                              <label class="custom-control-label"
                                                                                 for="partner_api_<?php echo $partner_api->api_id; ?>"></label>
                                                                           </div>
                                                                        </div>
                                                                     </td>
                                                                  </tr>
                                                               <?php } ?>

                                                            </table>
                                                         </div>
                                                      </div>

                                                      <div class="col-lg-4">
                                                         <div class="data_edit">
                                                            <table style="width: 100%;">
                                                               <?php $afiliate_ids = explode(',', $tournaments->afiliates);
                                                               foreach ($afiliates as $afiliate) { ?>
                                                                  <tr>
                                                                     <td><label for="sellers" class="mb-0">
                                                                           <?php
                                                                           // $afiliate->admin_name . ' ' . $afiliate->admin_last_name .
                                                                           echo $afiliate->company_name; ?>
                                                                        </label></td>
                                                                     <td>
                                                                        <div class="form-group mb-1 cust-switch">
                                                                           Disable / Enable
                                                                           <div class="custom-control custom-switch">
                                                                              <input type="checkbox"
                                                                                 class="custom-control-input"
                                                                                 id="afiliate_<?php echo $afiliate->admin_id; ?>"
                                                                                 name="afiliate[]"
                                                                                 value="<?php echo $afiliate->admin_id; ?>" <?php

                                                                                    if ($tournaments->t_id == "" || in_array($afiliate->admin_id, $afiliate_ids)) {
                                                                                       echo 'checked';
                                                                                    }
                                                                                    ?>>
                                              <label class="custom-control-label"
                                                                                 for="afiliate_<?php echo $afiliate->admin_id; ?>"></label>
                                                                           </div>
                                                                        </div>
                                                                     </td>
                                                                  </tr>
                                                               <?php } ?>

                                                            </table>
                                                         </div>
                                                      </div>

                                                      <div class="col-lg-4">
                                                         <div class="data_edit">
                                                            <table style="width: 100%;">


                                                               <?php
                                                               $storefront_ids = explode(',', $tournaments->storefronts);
                                                               //echo $storefront_ids;
                                                               foreach ($storefronts as $storefront) {
                                                                  ?>
                                                                  <tr>
                                                                     <td><label for="sellers" class="mb-0">
                                                                           <?php echo $storefront->site_value; ?>
                                                                        </label></td>
                                                                     <td>
                                                                        <div class="form-group mb-1 cust-switch">
                                                                           Disable / Enable
                                                                           <div class="custom-control custom-switch">
                                                                              <input type="checkbox"
                                                                                 class="custom-control-input"
                                                                                 id="store_<?php echo $storefront->store_id; ?>"
                                                                                 name="store[]"
                                                                                 value="<?php echo $storefront->store_id; ?>" <?php
                                                                                    if ($tournaments->t_id == "" || in_array($storefront->store_id, $storefront_ids)) {
                                                                                       echo 'checked';
                                                                                    } ?>>
                                                                              <label class="custom-control-label"
                                                                                 for="store_<?php echo $storefront->store_id; ?>"></label>
                                                                           </div>
                                                                        </div>
                                                                     </td>
                                                                  </tr>
                                                                  <?php
                                                               } ?>


                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>

                                          <div class="clearfix"></div>
                                          <div class="team_info_details mt-3">
                                             <h5 class="card-title">User Restrictions</h5>
                                          </div>

                                          <div class="row">
                                             <div class="col-12">
                                                <div class="card">
                                                   <div class="row column_modified">
                                                      <div class="col-lg-12 mb-5">

                                                         <div class="form-group">
                                                            <label for="example-select">Select Sellers</span> </label>
                                                            <select class="actionpayout roleuser form-control" multiple
                                                               name="seller[]" id="sellers">

                                                               <?php foreach ($sellers as $seller) { ?>
                                                                  <option <?php $seller_ids = explode(',', $tournaments->sellers);
                                                                  if (in_array($seller->admin_id, $seller_ids)) {
                                                                     echo 'selected';
                                                                  } ?> value="<?php echo $seller->admin_id; ?>"> <?php echo $seller->admin_name; ?>    <?php echo $seller->admin_last_name; ?> (<?php echo $seller->company_name; ?>)</option>
                                                               <?php } ?>
                                                            </select>

                                                            <div class="sort_filters">

                                                            </div>
                                                         </div>

                                                      </div>
                                                   </div>
                                                </div>
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
                                                         <a href="<?php echo base_url(); ?>settings/tournaments/"
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
                                          <h5 class="card-title">Tournament Content Info</h5>
                                          <p>Fill the Tournament Content Information</p>
                                       </div>
                                       <div class="">
                                          <form id="branch-form" method="post"
                                             
                                             action="<?php echo base_url(); ?>settings/tournaments/save">
                                             <input type="hidden" name="tournamentId" value="<?php if (isset($tournaments->t_id)) {
                                                echo $tournaments->t_id;
                                             } ?>">
                                             <input type="hidden" name="flag" value="content">
                                             <div class="row column_modified">
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput">Tournament Name *</label>
                                                      <input disabled type="text" id="" name="" class="form-control"
                                                         placeholder="Enter Tournament Name"
                                                         value="<?php
                                                         echo isset($tournaments->tournament) ? $tournaments->tournament : ''; ?>">

                                                   </div>
                                                </div>
                                                <?php if ($this->session->userdata('role') != 7) { ?>
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="simpleinput">Title *</label>
                                                         <input type="text" id="title" name="title" class="form-control"
                                                            placeholder="Enter Title" value="<?php if (isset($tournaments->title)) {
                                                               echo $tournaments_lang->title;
                                                            } ?>">
                                                      </div>
                                                   </div>

                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="example-textarea">Meta Description *</label>
                                                         <textarea class="form-control height_auto " id="example-textarea"
                                                            rows="5" name="metadescription"
                                                            placeholder="Enter Meta Description"><?php echo isset($tournaments_lang->metdes) ? $tournaments_lang->metdes : ''; ?></textarea>
                                                      </div>
                                                   </div>

                                                <?php } else { ?>
                                                   <input type="hidden" id="title" name="title" class="input"
                                                      placeholder="Enter Title" value="<?php if (isset($tournaments_lang->title)) {
                                                         echo $tournaments_lang->title;
                                                      } ?>">
                                                   <textarea style="display:none;" class="textarea" rows="4"
                                                      placeholder="Meta Description" name="metadescription"><?php if (isset($tournaments_lang->metdes)) {
                                                         echo $tournaments_lang->metdes;
                                                      } ?></textarea>
                                                <?php } ?>

                                                <div class="col-lg-12">
                                                   <div class="form-group">
                                                      <label for="example-textarea">Tournament Content</label>
                                                      <textarea id="editor-5" name="tournament_content"
                                                         placeholder="Enter Tournament Content"><?php if (isset($tournaments_lang->pcontent)) {
                                                            echo $tournaments_lang->pcontent;
                                                         } ?></textarea>
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput">Keywords</label>
                                                      <input type="text" id="seo_keywords" name="seo_keywords"
                                                         class="form-control" placeholder="Enter Keywords" value="<?php if (isset($tournaments_lang->seo_keywords)) {
                                                            echo $tournaments_lang->seo_keywords;
                                                         } ?>">
                                                   </div>
                                                </div>

                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput">URL Key</label>
                                                      <input type="text" id="url_key" name="url_key"
                                                         class="form-control" placeholder="Enter URL Key" value="<?php if (isset($tournaments_lang->url_key)) {
                                                            echo $tournaments_lang->url_key;
                                                         } ?>">
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
                                                               <a href="<?php echo base_url(); ?>settings/tournaments/"
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


            });


// window.addEventListener('load', function() {
//     // Get the current URL
//     var currentUrl = window.location.href;

//     // Check if the URL contains "tab-2"
//     if (currentUrl.includes("tab-2")) {
//       // Simulate a click event on the tab link with the "profile-b1-link" id
//       document.getElementById('profile-b1-link').click();
//     }
//   });
   <?php if (empty($tournaments->t_id)) { ?>
               $("body").on("keyup", "#tournament_name", function () {
                  var val = $("#tournament_name").val();
                  var slug = "";
                  if (val) {
                     slug = slugfly(val+"-tickets");
                     $("#url_key").val(slug);
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
      <?php if (empty($tournaments->t_id)) { ?>
         if (href != "home") {
                     swal('Attention!', ' Please Fill The Tournament Details', 'error');
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