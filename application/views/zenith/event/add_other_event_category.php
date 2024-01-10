<?php $this->load->view(THEME.'common/header'); ?>
    
     <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-sm-12 col-xl-12">
                        <div class="page-title">
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($category->id) ? "Edit Other Event Category" : "Create New Other Event Category"; ?> </h3>
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
                          <h5 class="card-title">Other Event Category Info</h5>
                          <p>Fill the following Category information</p>
                        </div>

                        <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>event/other_events_category/save_category">
                        <input type="hidden" name="categoryId" value="<?php echo $category->id;?>">
                         <div class="row column_modified">
                            <div class="col-lg-4">
                                  <div class="form-group">
                                   <label for="parent_category">Parent Category</label>     
                                        <div class="control">
                                            <select class="custom-select valid" id="parent" name="parent" required>
                                                <option value="">Select Parent Category</option>
                                                <?php foreach($categories as $parent){ if($parent->category_name!=''): ?>
                                                <option value="<?php echo $parent->id;?>" <?php if($category->parent_id == $parent->id){?> selected <?php } ?>><?php echo $parent->category_name;?></option>
                                                <?php endif; } ?>
                                            </select> 
                                        </div>
                                 </div>
                            </div>
                            <div class="col-lg-4">
                                 <div class="form-group">
                                 <label for="category_name" >Category Name</label>
                                    <div class="control">
                                        <input type="text" id="categoryname" name="categoryname" class="form-control" placeholder="Enter Category Name" required value="<?php echo $category->category_name;?>">
                                    </div>
                                </div>
                               </div>

                               <div class="col-lg-4">
                                           <div class="form-group">
                                              <label for="simpleinput">Url Key <span class="text-danger">*</span></label>
                                              <input type="text" id="event_url" name="event_url" value="<?php echo $category->slug;?>" class="form-control" placeholder="Enter Url Key" required>
                                            </div>
                                       </div>

                               <div class="col-lg-4">
                                <div class="form-group">
                                   <label for="sellers">Category Status</label>
                                   <div class="custom-control custom-switch">
                                     <input name="is_active" type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($category->status == '1'){?> checked <?php } ?> name="is_status">
                                     <label class="custom-control-label" for="customSwitch18">Enable / disable Category Status</label>
                                   </div>
                                </div>
                             </div> 
                             
                             <div class="col-lg-4">
                                <div class="form-group">
                                   <label for="artist">Is this Artist</label>
                                   <div class="custom-control custom-switch">
                                     <input name="artist" type="checkbox" class="custom-control-input" id="customSwitch19"  value="1" <?php if($category->artist == '1'){?> checked <?php } ?> >
                                     <label class="custom-control-label" for="customSwitch19">Enable / disable Artist</label>
                                   </div>
                                </div>
                             </div> 
                             
                             <div class="col-lg-4">
                                 <div class="form-group">
                                 <label for="category_name" >Sort No.</label>
                                    <div class="control">
                                        <input type="text" id="sortno" name="sortno" class="form-control" placeholder="Enter Category Sort No." required value="<?php echo $category->sort;?>">
                                    </div>
                                </div>
                               </div>

                           </div>
                           <!--  -->
                            <div class="tick_details border-top">
                                <div class="row">
                                    <div class="col-sm-8">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                            <a href="<?php echo base_url() . 'event/other_events_category';?>" class="btn btn-primary mb-2 mt-3">Back</a>
                                            <button type="submit" class="btn btn-success mb-2 ml-2 mt-3" >Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          <!--  -->
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
    $(document).ready(function(){ 
        $("body").on("focusout","#categoryname",function(){
        var val = $(this).val();
        slug = slugfly(val );
        $("#event_url").val(slug );
console.log('focusout');
        create_slug();
    });

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

   function create_slug(){
      var val = $("#categoryname").val();
    
      var slug ="";
      if(val){
         slug = slugfly(val + "-tickets");
         $("#event_url").val(slug );
      }
    
   }

   });
    </script>