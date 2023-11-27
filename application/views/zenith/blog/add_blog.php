<?php $this->load->view(THEME.'common/header'); ?>
    <style type="text/css">
        .column_modified textarea.form-control{
            height: auto;
        }
    </style>
     <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-sm-12 col-xl-12">
                        <div class="page-title">
                           <h3 class="mb-1 font-weight-bold">Create / Edit Blog</h3>
                        </div>
                     </div>
                    
                  </div>
               </div>
            </div>
            <!-- page content -->

            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">

            
                    <div class="card">
                     <div class="card-body">
                         <div class="col-sm-12 col-xl-12  mt-2 mt-sm-0">
                        <div class="">
                          <h5 class="card-title">Blog Info</h5>
                          <p>Fill the following Blog information</p>
                        </div>

                      <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>blog/index/save" enctype="multipart/form-data" >
                            <input type="hidden" name="id" value="<?php echo $result->id;?>">

                         <div class="row column_modified">

                         <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="example-select">Country <span class="text-danger">*</span></label>
                                 <select class="custom-select change_country" id="country" name="country" onchange="get_state_city(this.value);" required>
                                                <option value="">Select Country</option>
                                                <?php foreach($countries as $country){ ?>
                                                <option <?php if($result->country == $country->id){?> selected <?php } ?> value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                                <?php } ?>
                                          </select> 
                              </div> 
                           </div> 

                            
                           <div class="col-lg-6">
                                  <div class="form-group">
                                   <label for="seat_position">Blog Type<span class="text-danger">*</span></label>
                                   <select class="custom-select" name="blog_type" required>
                                    <option value="">Select Type</option>
                                    <option value="1" <?= ($result->blog_type == '1') ? 'selected' : '' ?>>Blogs</option>
                                    <option value="3" <?= ($result->blog_type == '3') ? 'selected' : '' ?>>Articles</option>
                                    <option value="2" <?= ($result->blog_type == '2') ? 'selected' : '' ?>>News</option>
                                  </select>
                                  </div>
                               </div>

                            <div class="col-lg-6">
                                  <div class="form-group">
                                   <label for="seat_position">Blog Category<span class="text-danger">*</span></label>
                                   <select class="custom-select" name="blog_category" required>
                                     <option value="" >Select Category</option>

                                        <?php if($category){
                                                    foreach ($category as $key => $value) {
                                                        ?>
                                    <option value="<?php echo $value->id ;?>" <?php echo $value->id == $result->blog_category ? "selected" : "" ; ?> > <?php echo $value->category_name ;?></option>
                                        <?php }  } ?>
                                            
                                        </select>
                                  </div>
                               </div>
                       
                        
                                    <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="example-select">Blog Small <span class="text-danger">*</span></label>
                                                <div class="prev_back_img">
                                                  <label class="custom-upload mb-0"><input type="hidden" name="exs_file" value="<?php if (isset($result->blog_small)) {
                                                echo $result->blog_small;
                                                } ?>"><input type="file"  class="form-control-file input"  name="blog_small" id="blog_small" value="" onchange="loadFiles(event,'blog_small_file')"> Upload JPEG File</label>
                                                  <p>Previous Blog Image</p>
                                                  <a id="blog_small_file_link" target="_blank" href="javascript:void(0);" onclick="return popitup('<?php if (isset($result->blog_small)) {
                                                echo UPLOAD_PATH.'uploads/blog/'.$result->blog_small;
                                                } ?>')" class="view_bg">
                                                <img width="30" height="30" src="<?php if (isset($result->blog_small)) {
                                                echo UPLOAD_PATH.'uploads/blog/'.$result->blog_small;
                                                }else { echo UPLOAD_PATH.'uploads/general_settings/no-image.png';} ?>" id="blog_small_file">
                                            </a>
                                                </div>
                                                <p>Image size  Width 280 *  Height 180</p>
                                            </div> 
                                   </div>



                               <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="example-select">Blog Medium <span class="text-danger">*</span></label>
                                                <div class="prev_back_img">
                                                  <label class="custom-upload mb-0"><input type="hidden" name="exs_file" value="<?php if (isset($result->blog_medium)) {
                                                echo $result->blog_medium;
                                                } ?>"><input type="file"  class="form-control-file input"  name="blog_medium" id="blog_medium" value="" onchange="loadFiles(event,'blog_medium_file')"> Upload JPEG File</label>
                                                  <p>Previous Blog Image</p>
                                                  <a id="blog_medium_file_link" target="_blank" href="javascript:void(0);" onclick="return popitup('<?php if (isset($result->blog_medium)) {
                                                echo UPLOAD_PATH.'uploads/blog/'.$result->blog_medium;
                                                } ?>')" class="view_bg">
                                                <img width="30" height="30" src="<?php if (isset($result->blog_medium)) {
                                                echo UPLOAD_PATH.'uploads/blog/'.$result->blog_medium;
                                                }else { echo UPLOAD_PATH.'uploads/general_settings/no-image.png';} ?>" id="blog_medium_file">
                                            </a>
                                                </div>
                                            </div> 
                                            <p>Image size  Width 580 *  Height 255</p>
                                   </div>



                               <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="example-select">Blog Large <span class="text-danger">*</span></label>
                                                <div class="prev_back_img">
                                                  <label class="custom-upload mb-0"><input type="hidden" name="exs_file" value="<?php if (isset($result->blog_large)) {
                                                echo $result->blog_large;
                                                } ?>"><input type="file"  class="form-control-file input"  name="blog_large" id="blog_large" value="" onchange="loadFiles(event,'blog_large_file')"> Upload JPEG File</label>
                                                  <p>Previous Blog Image</p>
                                                  <a id="blog_large_file_link" target="_blank" href="javascript:void(0);" onclick="return popitup('<?php if (isset($result->blog_large)) {
                                                echo UPLOAD_PATH.'uploads/blog/'.$result->blog_large;
                                                } ?>')" class="view_bg">
                                                <img width="30" height="30" src="<?php if (isset($result->blog_large)) {
                                                echo UPLOAD_PATH.'uploads/blog/'.$result->blog_large;
                                                }else { echo UPLOAD_PATH.'uploads/general_settings/no-image.png';} ?>" id="blog_large_file">
                                            </a>
                                                </div>
                                                <p>Image size  Width 580 *  Height 530</p>
                                            </div> 
                                   </div>

                               <div class="col-lg-6">
                                  <div class="form-group">
                                   <label for="simpleinput">Blog Name English<span class="text-danger">*</span></label>
                                    <input  required  type="text" id="blog_slug" name="blog_slug" class="form-control" placeholder="Blog Name English" value="<?php echo $result->blog_slug;?>">
                                  </div>
                               </div>


                                <div class="col-lg-6">
                                  <div class="form-group">
                                   <label for="simpleinput">Blog Name <span class="text-danger">*</span></label>
                                  <input  required  type="text" id="blog_name" name="blog_name" class="form-control" placeholder="Blog Name" value="<?php echo $blog_lang->blog_title;?>">
                                  </div>
                               </div>

                               <div class="col-lg-12">
                                  <div class="form-group">
                                   <label for="simpleinput">Blog Short Description <span class="text-danger">*</span></label>
                                  <textarea class="form-control" rows="4" placeholder="Blog Short Description" id="blog_short_description" name="blog_short_description" required><?php echo $blog_lang->blog_short_description;?></textarea>
                                  </div>
                               </div>

                               <div class="col-lg-12">
                                  <div class="form-group">
                                   <label for="simpleinput">Blog Description <span class="text-danger">*</span></label>
                                   <textarea class="form-control" rows="4" placeholder="Blog Description" id="editor-5" name="blog_description" required><?php echo $blog_lang->blog_description;?></textarea>
                                  </div>
                               </div>

                            


                             <?php if($this->session->userdata('role') != 7){?>


                                <div class="col-lg-12">
                                  <div class="form-group">
                                   <label for="simpleinput">Meta Title <span class="text-danger">*</span></label>
                                   <textarea class="form-control" rows="4" placeholder="Meta Title" name="meta_title" ><?php echo $blog_lang->meta_title;?></textarea>
                                  </div>
                               </div>


                               <div class="col-lg-12">
                                  <div class="form-group">
                                   <label for="simpleinput">Meta Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="4" placeholder="Meta Description" name="meta_description" ><?php echo $blog_lang->meta_description;?></textarea>
                                  </div>
                               </div>


                                  <?php }else{ ?>
                                             <textarea class="form-control" rows="4" placeholder="Meta Title" name="meta_title" style="display: none;"><?php echo $blog_lang->meta_title;?></textarea>
                                              <textarea class="form-control" rows="4" placeholder="Meta Description" name="meta_description" style="display: none;"><?php echo $blog_lang->meta_description;?></textarea>
                                        <?php } ?>

                                  <div class="col-lg-6">
                                  <div class="form-group">
                                   <label for="simpleinput">Seo Keywords</label>
                                   <input id="choices-text-remove-button" class="form-control" value="<?php echo $blog_lang->seo_keywords;?>" name="seo_keywords" placeholder="Enter Keywords">
                                  </div>
                               </div>


                               <div class="col-lg-6">
                                  <div class="form-group">
                                   <!-- <label for="simpleinput">Blog Tags</label>
                                   <input id="" class="form-control" value="<?php //echo $blog_lang->seo_keywords;?>" name="blog_tags" placeholder="Enter Blog Tags"> -->

                                   <label for="example-select">Select Blog Tags</label>
                                       <select multiple class="custom-select" id="blog_tags" name="blog_tags[]"  >
                                       <option value="">Select Blog Tags</option>
                                       <?php foreach($blog_tags as $blog_tag){?>
                                          <option value="<?php echo $blog_tag->blog_tag_id;?>" <?php
                                             $blog_tag_id = explode(',', $result->blog_tag_id);
                                                if (in_array($blog_tag->blog_tag_id, $blog_tag_id)) {
                                                   echo 'selected';
                                                } ?>>
                                          <?php 
                                             echo ($this->session->userdata('language_code') == 'en') ? $blog_tag->blog_tag_name_en : $blog_tag->blog_tag_name_ar; ?>
                                       </option>
                                       <?php } ?>
                                    </select>
                                  </div>
                               </div>



                           </div>

                           <div class="row column_modified">
                            <div class="col-lg-6">
                                  <div class="form-group">
                                   <label for="simpleinput">Blog Date<span class="text-danger">*</span></label>
                                  <input name="blogdate" id="" class="form-control" type="date" placeholder="dd/mm/yyy" required  value="<?php echo $result->created_at 
                                  ?  date('Y-m-d',strtotime($result->created_at)) : "";?>">
                                  </div>
                               </div>
                            <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="sellers">Status <span class="text-danger">*</span></label>
                                             <div class="custom-control custom-switch">
                                               <input type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($result->blog_status == '1'){?> checked <?php } ?> name="blog_status">
                                               <label class="custom-control-label" for="customSwitch18">In Active / Active</label>
                                             </div>
                                          </div>
                                       </div>

                                   </div>

                       <!-- end row -->
                              <div class="tick_details border-top">
                                 <div class="row">
                                    <div class="col-sm-8">
                                       <!-- <h5 class="card-title">Matches</h5> -->
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                          <a href="<?php echo base_url() . 'blog/index/lists';?>" class="btn btn-primary mb-2 mt-3">Back</a>
                                             <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Save</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                                </form>
                     </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

<?php $this->load->view(THEME.'common/footer'); ?>
<script>

         function popitup(url,temp='')
       {

          newwindow=window.open(url,'name','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,,height=500,width=700');

          if (window.focus) {newwindow.focus()}
          return false;
       }


        var loadFiles = function(event,team_bg_file) {

            var formData = new FormData();
            formData.append('file', event.target.files[0]);

            $.ajax({
                url : "<?php echo base_url();?>event/upload_files",
               type : 'POST',
               data : formData,
               processData: false,  // tell jQuery not to process the data
               contentType: false,  // tell jQuery not to set contentType
               dataType: 'json',
               success : function(data) {
                  if(data.uploaded_file){
                    var src = "<?php echo base_url();?>uploads/temp/"+data.uploaded_file;
                    var output = document.getElementById(team_bg_file);
                    output.src = src;
                    $("#"+team_bg_file+"_link").attr("onclick", "return popitup('"+src+"');");
                  }
               }
            });
      };
   
       new Choices(document.getElementById("choices-text-remove-button"), { delimiter: ",", editItems: !0, removeItemButton: !0 });
       const blog_tags = new Choices('#blog_tags', { delimiter: ",",editItems: !0,removeItemButton: !0,   searchFields: ['label', 'value'] ,allowSearch: true});
</script>
