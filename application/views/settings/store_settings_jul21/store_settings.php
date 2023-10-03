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
                                <h3 class="title is-4 is-narrow">
                            <?php echo $this->session->userdata('storefront')->company_name;?></h3>
                            </div>

                            <div class="profile-body">

                                <div class="settings-section">
                                    <a class="settings-box" href="<?php echo base_url();?>settings/add_store_settings/add_store_settings">
                                        <div class="icon-wrap">
                                            <i class="lnil lnil-user"></i>
                                        </div>
                                        <span>Profile</span>
                                        <h3>Manage Profile</h3>
                                    </a>
                                    <a class="settings-box" href="<?php echo base_url();?>settings/gateway_settings/add_gateway_settings">
                                        <div class="icon-wrap">
                                            <i class="fa fa-cc-mastercard"></i>
                                        </div>
                                        <span>Payment Gateway</span>
                                        <h3>Manage Payment Gateway</h3>
                                    </a>
                                    <a class="settings-box" href="<?php echo base_url();?>settings/api_settings/add_api_settings">
                                        <div class="icon-wrap">
                                           <i class="fa fa-facebook-square"></i>
                                        </div>
                                        <span>Social Login</span>
                                        <h3>Manage Social Login</h3>
                                    </a>
                                   
                                    <a class="settings-box" href="<?php echo base_url();?>home/geo_ip_settings/add">
                                        <div class="icon-wrap">
                                            <i class="fa fa-gbp"></i>
                                        </div>
                                        <span>GEO IP</span>
                                        <h3>Manage GEO IP</h3>
                                    </a>
                                    <a class="settings-box" target="_blank" href="<?php echo base_url();?>settings/static_pages">
                                        <div class="edit-icon">
                                            <i class="lnil lnil-pencil"></i>
                                        </div>
                                        <div class="icon-wrap">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                        </div>
                                        <span>Pages</span>
                                        <h3>Static Pages</h3>
                                    </a>
                                   
                                    <a class="settings-box" href="<?php echo base_url();?>settings/league">
                                        <div class="icon-wrap">
                                            <i class="lnil lnil-shield"></i>
                                        </div>
                                        <span>Top League</span>
                                        <h3>Manage Top League</h3>
                                    </a>
                                    <a class="settings-box" href="<?php echo base_url();?>settings/cups">
                                        <div class="icon-wrap">
                                            <i class="lnil lnil-cup"></i>
                                        </div>
                                        <span>Top Cups</span>
                                        <h3>Manage Top Cups</h3>
                                    </a>
									<a class="settings-box" href="<?php echo base_url();?>settings/upcoming_events">
                                        <div class="icon-wrap">
                                            <i class="lnil lnil-calendar"></i>
                                        </div>
                                        <span>Upcoming Events</span>
                                        <h3>Manage Upcoming Events</h3>
                                    </a>
									<a class="settings-box" href="<?php echo base_url();?>settings/banners">
                                        <div class="icon-wrap">
                                            <i class="lnil lnil-banner"></i>
                                        </div>
                                        <span>Banners</span>
                                        <h3>Manage Banners</h3>
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
                <?php $this->load->view('common/footer');?>
                
				<?php exit;?>
