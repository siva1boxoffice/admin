        <?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                    <div class="page-content-inner">
                       
                        <div class="flex-list-wrapper">

                             <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                               <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>home/branch/save_branch">
                                <input type="hidden" name="branch_id" value="<?php echo $branch->branch_id;?>">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Create New branch</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>home/branch/list_branch" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Cancel</span>
                                                </a>
                                                <button id="save-button" class="button h-button is-primary is-raised">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body">
                                    <!--Fieldset-->
                                    <div class="form-fieldset">
                                        <div class="fieldset-heading">
                                            <h4>Branch Info</h4>
                                        </div>

                                        <div class="columns is-multiline">
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Branch Name</label>
                                                    <div class="control has-icon">
                                                        <input type="text" class="input" placeholder="Branch Name" id="branch_name" name="branch_name" value="<?php echo $branch->branch_name;?>">
                                                        <div class="form-icon">
                                                           <i class="fa fa-code-branch"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Branch Status</label>
                                                    <div class="control">
                                                        <div class="h-select">
                                                            <div class="select-box">
                                                                <span>Select Status</span>
                                                            </div>
                                                            <div class="select-icon">
                                                                <i data-feather="chevron-down"></i>
                                                            </div>
                                                            <div class="select-drop has-slimscroll-sm">
                                                                <div class="drop-inner">
                                                                    <div class="option-row">
                                                                        <input type="radio" name="status" value="0" <?php if($branch->status == '0'){ echo "checked";}?>>
                                                                        <div class="option-meta">
                                                                            <span>Inactive</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="option-row">
                                                                        <input type="radio" name="status" value="1" <?php if($branch->status == '1'){ echo "checked";}?>>
                                                                        <div class="option-meta">
                                                                            <span>Active</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Fieldset-->
                                </div>
                            </form>
                            </div>
                        </div>

                         

                          
                        </div>

                    </div>

                <?php $this->load->view('common/footer');?>
                <?php exit;?>