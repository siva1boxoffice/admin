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
                           <h3 class="mb-1 font-weight-bold">Create / Edit Blog Tags</h3>
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
                          <h5 class="card-title">Blog Tags Info</h5>
                          <p>Fill the following Blog Tags information</p>
                        </div>

                      <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>blog/blog_tags/save" enctype="multipart/form-data" >
                            <input type="hidden" name="id" value="<?php echo $result->blog_tag_id;?>">

                         <div class="row column_modified">
                               <div class="col-lg-6">
                                  <div class="form-group">
                                   <label for="simpleinput">Blog Tags (EN)<span class="text-danger">*</span></label>
                                    <input  required  type="text" id="blog_tag_name_en" name="blog_tag_name_en" class="form-control" placeholder="Blog Tags English" value="<?php echo $result->blog_tag_name_en;?>">
                                  </div>
                               </div>


                                <div class="col-lg-6">
                                  <div class="form-group">
                                   <label for="simpleinput">Blog Tags (AR) <span class="text-danger">*</span></label>
                                  <input  required  type="text" id="blog_tag_name_ar" name="blog_tag_name_ar" class="form-control" placeholder="Blog Tags Arabic" value="<?php echo $result->blog_tag_name_ar;?>">
                                  </div>
                               </div>


                                  <div class="col-lg-6">
                                  <div class="form-group">
                                   <label for="simpleinput">Blog Tags URL</label>
                                   <input class="form-control" value="<?php echo $result->blog_tag_url;?>" id="blog_tag_url" name="blog_tag_url" placeholder="Enter Blog Tags URL">
                                  </div>
                               </div>

                               <div class="col-lg-6">
                                          <div class="form-group">
                                             <label for="sellers">Status <span class="text-danger">*</span></label>
                                             <div class="custom-control custom-switch">
                                               <input type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($result->status == '1' || $result->status == ''){?> checked <?php } ?> name="status">
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
                                          <a href="<?php echo base_url() . 'blog/blog_tags';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
  function slugfly(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
        var to   = "aaaaaeeeeeiiiiooooouuuunc------";
        for (var i = 0, l = from.length; i < l; i++) {
          str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                 .replace(/\s+/g, '-') // collapse whitespace and replace by -
                 .replace(/-+/g, '-'); // collapse dashes

        return str;
   }

   $("body").on("keyup","#blog_tag_name_en",function(){
       var val = $(this).val();
       $("#blog_tag_url").val(slugfly(val));
   });
       
</script>
