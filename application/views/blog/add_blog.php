<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>blog/index/save" enctype="multipart/form-data" >
                            <input type="hidden" name="id" value="<?php echo $result->id;?>">
                          
                         <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">Blog </h2>
                                </div>
                            </div>
                            <?php //echo "<pre>";print_r($result);?>
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Blog </h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                


                                                <a href="<?php echo base_url();?>blog/index/lists" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Blog</span>
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
                                    
                                    <!--Fieldset-->
                                    <div class="form-fieldset" style="max-width: 580px;">
                                        <dv class="columns is-multiline">
                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Blog Category *</label>
                                                    <div class="control">
                                                        <select class="input" name="blog_category" required>
                                                            
                                                             
                                                        <option value="" >Select Category</option>

                                                    <?php if($category){
                                                                foreach ($category as $key => $value) {
                                                                    ?>
                                                <option value="<?php echo $value->id ;?>" <?php echo $value->id == $result->blog_category ? "selected" : "" ; ?> > <?php echo $value->category_name ;?></option>
                                                    <?php }  } ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="column is-12">
                                                <div class="field">
                                                    <label>Blog Small *</label>
                                                    <div class="control">
                                                        <input  type="file" id="blog_small" name="blog_small" class="input" placeholder="Blog Name"   <?php echo @$result->id == "" ?  "required" : "" ;?> >
                                                         
                                                    </div>
                                                </div>
                                            <p>Image size  Width 280 *  Height 180</p>
                                            <?php if(@$result->id) { ?>

                                            <img src="<?php echo 'https://www.listmyticket.com/uploads/blog/'.$result->blog_small;?>" Width="150px" >
                                        <?php } ?>
                                            </div>

                                                <div class="column is-12">
                                                <div class="field">
                                                    <label>Blog Medium *</label>
                                                    <div class="control">
                                                        <input  type="file" id="blog_medium" name="blog_medium" class="input" placeholder="Blog Name" <?php echo @$result->id == "" ?  "required" : "" ;?> >
                                                         
                                                    </div>
                                                </div>
                                                 <p>Image size  Width 580 *  Height 255</p>

                                                 <?php if(@$result->id) { ?>

                                            <img src="<?php echo 'https://www.listmyticket.com/uploads/blog/'.$result->blog_medium;?>" Width="150px" >
                                        <?php } ?>
                                            </div>


                                                <div class="column is-12">
                                                <div class="field">
                                                    <label>Blog Large *</label>
                                                    <div class="control">
                                                        <input  type="file" id="blog_large" name="blog_large" class="input" placeholder="Blog Name" <?php echo @$result->id == "" ?  "required" : "" ;?>  >
                                                         
                                                    </div>
                                                </div>
                                                 <p>Image size  Width 580 *  Height 530</p>

                                                 <?php if(@$result->id) { ?>

                                            <img src="<?php echo 'https://www.listmyticket.com/uploads/blog/'.$result->blog_large;?>" Width="150px" >
                                        <?php } ?>
                                            </div>


                                                  <?php if($result->id ==""){?>
                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Blog Name English*</label>
                                                    <div class="control">
                                                        <input  required  type="text" id="blog_slug" name="blog_slug" class="input" placeholder="Blog Name English" value="<?php echo $result->blog_slug;?>">
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        
                                        

                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Blog Name *</label>
                                                    <div class="control">
                                                        <input  required  type="text" id="blog_name" name="blog_name" class="input" placeholder="Blog Name" value="<?php echo $result->blog_title;?>">
                                                         
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Blog Short Description *</label>
                                                    <div class="control">
                                                        <textarea class="textarea" rows="4" placeholder="Blog Short Description" id="blog_short_description" name="blog_short_description" required><?php echo $result->blog_short_description;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Blog Description *</label>
                                                    <div class="control">
                                                        <textarea class="textarea" rows="4" placeholder="Blog Description" id="blog_description" name="blog_description" required><?php echo $result->blog_description;?></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                             <?php if($this->session->userdata('role') != 7){?>
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Meta Title *</label>
                                                    <div class="control">
                                                        <textarea class="textarea" rows="4" placeholder="Meta Title" name="meta_title" ><?php echo $result->meta_title;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Meta Description *</label>
                                                    <div class="control">
                                                        <textarea class="textarea" rows="4" placeholder="Meta Description" name="meta_description" ><?php echo $result->meta_description;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }else{ ?>
                                             <textarea class="textarea" rows="4" placeholder="Meta Title" name="meta_title" style="display: none;"><?php echo $result->meta_title;?></textarea>
                                              <textarea class="textarea" rows="4" placeholder="Meta Description" name="meta_description" style="display: none;"><?php echo $result->meta_description;?></textarea>
                                        <?php } ?>
                                            
                                        <div class="column is-12">
                                            <div class="field">
                                                <label>Seo Keywords</label>
                                                <div class="control">
                                                     <input id="choices-text-remove-button" class="input" value="<?php echo $result->seo_keywords;?>" name="seo_keywords" placeholder="Enter Keywords">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="column is-12">
                                            <div class="field">
                                                <label>Status</label>
                                                <div class="control">
                                                     <select class="input" name="blog_status" required>
                                                        <option value="" >Select Status</option>
                                                        <option value="1" <?php echo $result->blog_status == 1 ? "selected"  : "" ;?>  >Active</option>
                                                        <option value="0" <?php echo $result->blog_status == 2 ? "selected"  : "" ;?> >Deactivated</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                       <div class="column is-12">
                                                <div class="field">
                                                    <label>Blog Published Date *</label>
                                                     <div class="control">
                                                         <input name="blogdate" id="bulma-datepicker-1" class="input" type="date" placeholder="dd/mm/yyy" required  value="<?php echo date('d/m/Y',strtotime($result->created_at));?>">
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

                      $('#blog_description').summernote({
                          placeholder: 'Blog Description',
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

                      
                    var match_date =  "<?php echo date('m/d/Y', strtotime($result->created_at));?>";

                    <?php if (strtotime($result->created_at)){ ?>

                         bulmaCalendar.attach("#bulma-datepicker-1", {startDate: new Date('<?php echo date('m/d/Y', strtotime($result->created_at));?>'), color: themeColors.primary, lang: "en",showHeader: false,
                        showButtons: false,
                        showFooter: false });

                             var element = document.querySelector('#bulma-datepicker-1');
                        if (element) {
                            // bulmaCalendar instance is available as element.bulmaCalendar
                            element.bulmaCalendar.on('select', function(datepicker) {
                                // console.log(datepicker.data.value());
                                // console.log(datepicker.data.value() +"--"+ match_date);

                                if(datepicker.data.value() !=  match_date){
                                    $(".match_date_change").show();
                                }
                                else{
                                    $(".match_date_change").hide();
                                    $(".match_date_change input").prop('checked',false);
                                }
                            });
                        }

                    <?php } else {?>

                        bulmaCalendar.attach("#bulma-datepicker-1", {startDate: new Date('<?php echo date('m/d/Y');?>'), color: themeColors.primary, lang: "en",showHeader: false,
                    showButtons: false,
                    showFooter: false });

                    


                    <?php } ?>  

                      
                </script>
                
<?php exit;?>