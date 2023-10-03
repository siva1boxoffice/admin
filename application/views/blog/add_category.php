<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>blog/category/save">
                            <input type="hidden" name="id" value="<?php echo $result->id;?>">
                          
                         <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">Blog Category</h2>
                                </div>
                            </div>
                            <?php //echo "<pre>";print_r($result);?>
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Blog Category</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                


                                                <a href="<?php echo base_url();?>blog/category/lists" class="button h-button is-light is-dark-outlined">
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
                                       
                                        <div class="columns is-multiline">
                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Category Name *</label>
                                                    <div class="control">
                                                        <input  type="text" id="" name="category_name" class="input" placeholder="Category Name" value="<?php echo $result->category_name;?>">
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                             <?php if($this->session->userdata('role') != 7){?>
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Meta Title *</label>
                                                    <div class="control">
                                                        <textarea class="textarea" rows="4" placeholder="Meta Title" name="meta_title" required><?php echo $result->meta_title;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Meta Description *</label>
                                                    <div class="control">
                                                        <textarea class="textarea" rows="4" placeholder="Meta Description" name="meta_description" required><?php echo $result->meta_description;?></textarea>
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
                                                     <select class="input" name="status" required>
                                                        <option value="" >Select Status</option>
                                                        <option value="1" <?php echo $result->category_status == 1 ? "selected"  : "" ;?>  >Active</option>
                                                        <option value="0" <?php echo $result->category_status == 2 ? "selected"  : "" ;?> >Deactivated</option>
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

                      $('#match_description').summernote({
          placeholder: 'Match Description',
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

                    <?php if (strtotime($result->match_date)){ ?>

                         bulmaCalendar.attach("#bulma-datepicker-1", {startDate: new Date('<?php echo date('m/d/Y', strtotime($result->match_date));?>'), color: themeColors.primary, lang: "en",showHeader: false,
    showButtons: false,
    showFooter: false });

                    <?php } else {?>

                        bulmaCalendar.attach("#bulma-datepicker-1", {startDate: new Date('<?php echo date('m/d/Y');?>'), color: themeColors.primary, lang: "en",showHeader: false,
    showButtons: false,
    showFooter: false });

                    <?php } ?>  

                      <?php if (strtotime($result->match_time)){ ?>
                        var now = new Date()
  console.log(moment(now).format('HH:mm'))
                         bulmaCalendar.attach("#bulma-datepicker-5", {startTime: moment(now).format('HH:mm'), color: themeColors.primary, lang: "en" });

                    <?php } else {?>

                        bulmaCalendar.attach("#bulma-datepicker-5", {startTime: '<?php echo date('h:m');?>', color: themeColors.primary, lang: "en" });

                    <?php } ?>       
                </script>
                
<?php exit;?>