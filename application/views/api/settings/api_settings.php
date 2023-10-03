<?php $this->load->view('common/header');?>
<style type="text/css">
	.profile-wrapper .profile-body .settings-section .settings-box{
	width: calc(30% - 16px);
}
</style>
        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

           <div class="page-content-wrapper">
                <div class="page-content is-relative">

                   

                    <div class="page-content-inner">

                        <!--Profile Settings-->
                        <div class="profile-wrapper">
                            <div class="profile-header has-text-centered">
                                <!-- <h3 class="title is-4 is-narrow">
                            <?php echo $this->session->userdata('storefront')->company_name;?></h3> -->
                            </div>

                            <div class="profile-body">

                                <div class="settings-section">
                                    <a class="settings-box" href="<?php echo base_url();?>api/api_key_settings">
                                        <div class="icon-wrap">
                                            <i class="lnil lnil-control-panel"></i>
                                        </div>
                                        <span>API</span>
                                        <h3>Key Settings</h3>
                                    </a>
                                    <a class="settings-box" href="<?php echo base_url();?>api/api_key_settings">
                                        <div class="icon-wrap">
                                            <i class="lnil lnil-control-panel"></i>
                                        </div>
                                        <span>IP</span>
                                        <h3>Patching</h3>
                                    </a>
                                    
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
                <?php $this->load->view('common/footer');?>
                
				<?php exit;?>
