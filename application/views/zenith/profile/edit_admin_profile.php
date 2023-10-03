        <?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative">

                  

                    <div class="page-content-inner">

                        <!--Profile Settings-->
                        <div class="profile-wrapper">
                            <div class="profile-header has-text-centered">
                                <div class="h-avatar is-xl">
                                    <img class="avatar" src="<?php echo $this->session->userdata('profile_pic'); ?>" alt="" data-user-popover="3">
                                </div>
                                <h3 class="title is-4 is-narrow"><?php echo $this->session->userdata('admin_name'); ?></h3>
                            </div>

                            <div class="profile-body">

                                <div class="settings-section">
                                    <a class="settings-box" href="<?php echo base_url();?>home/profile/manage_profile/1">
                                        <div class="edit-icon">
                                            <i class="lnil lnil-pencil"></i>
                                        </div>
                                        <div class="icon-wrap">
                                            <i class="lnil lnil-user-alt"></i>
                                        </div>
                                        <span>Profile</span>
                                        <h3>Profile Settings</h3>
                                    </a>
                                    <a class="settings-box" href="<?php echo base_url();?>home/profile/manage_profile/4">
                                        <div class="edit-icon">
                                            <i class="lnil lnil-pencil"></i>
                                        </div>
                                        <div class="icon-wrap">
                                          <i class="fa fa-university" aria-hidden="true"></i>
                                        </div>
                                        <span>Bank Details</span>
                                        <h3>Manage Bank Details</h3>
                                    </a>
                                   <!--  <a class="settings-box" href="<?php echo base_url();?>home/profile/permissions">
                                        <div class="edit-icon">
                                            <i class="lnil lnil-pencil"></i>
                                        </div>
                                        <div class="icon-wrap">
                                            <i class="fa fa-money" aria-hidden="true"></i>
                                        </div>
                                        <span>Balance</span>
                                        <h3>Manage Balance</h3>
                                    </a> -->
                                    <a class="settings-box" href="<?php echo base_url();?>accounts/payouts">
                                        <div class="edit-icon">
                                            <i class="lnil lnil-pencil"></i>
                                        </div>
                                        <div class="icon-wrap">
                                           <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                        </div>
                                        <span>Payouts</span>
                                        <h3>Manage Payouts</h3>
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>

                <?php $this->load->view('common/footer');?>