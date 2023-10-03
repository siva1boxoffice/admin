<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>event/other_events_category/save_category">
                            <input type="hidden" name="categoryId" value="<?php echo $category->id;?>">
                         <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">Other Event Categories</h2>
                                </div>
                            </div>
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Create New Category</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>event/other_events_category" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Other Events category</span>
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
                                    <div class="form-fieldset" style="max-width: 580px;">
                                         <div class="fieldset-heading">
                                            <h4>Category Info</h4>
                                            <p>Fill the following Category information</p>
                                        </div>
                                        <div class="columns is-multiline">
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Parent Category</label>
                                                    <div class="control">
                                                        <select class="form-control select2" id="parent" name="parent" required>
                                                            <option value="">- Select Parent Category -</option>
                                                            <?php foreach($categories as $parent){ if($parent->category_name!=''): ?>
                                                            <option value="<?php echo $parent->id;?>" <?php if($category->parent_id == $parent->id){?> selected <?php } ?>><?php echo $parent->category_name;?></option>
                                                            <?php endif; } ?>
                                                        </select> 
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Category Name</label>
                                                    <div class="control">
                                                        <input type="text" id="categoryname" name="categoryname" class="input" placeholder="Enter Category Name" required value="<?php echo $category->category_name;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Category Status </label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
<input type="checkbox" class="is-switch" name="is_active" value="1" 
<?php if($category->status == '1'){?> checked <?php } ?>>
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Enable / disable Category Status</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Sort No.</label>
                                                    <div class="control">
                                                        <input type="text" id="sortno" name="sortno" class="input" placeholder="Enter Sort No." required value="<?php echo $category->sort;?>">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--Fieldset-->
                                    <div class="form-fieldset" style="max-width: 580px;">
                                        <div class="fieldset-heading">
                                            <h4>Category Content Info</h4>
                                            <p>Fill the Category Content Information</p>
                                        </div>

                                        <div class="columns is-multiline">
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Category Description </label>
                                                    <div class="control">
                                                         <textarea id="category_description" name="category_description"><?php echo $category->category_desc;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>

                      
                    </form>
                    </div>

                <?php $this->load->view('common/footer');?>
                <script type="text/javascript">

                      $('#category_description').summernote({
          placeholder: 'Category Description',
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
                </script>
                
<?php exit;?>