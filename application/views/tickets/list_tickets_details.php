 <?php $this->load->view('common/header'); ?>
 <style type="text/css">
 	.datetimepicker-dummy .datetimepicker-dummy-wrapper .datetimepicker-dummy-input {
 		max-width: 100% !important;
 	}
 </style>
 <link rel="stylesheet" href="<?php echo base_url(); ?>myassets/css/style.css?v=?v=3.4.2" />
 <div id="app-lists" class="view-wrapper is-webapp" data-page-title="List View" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

 	<div class="page-content-wrapper">
 		<div class="all-projects page-content is-relative tabs-wrapper is-slider is-squared is-inverted">

 			

 			<div class="page-content-inner">

             <div class="project-minimal-grid list-view-toolbar is-reversed list_filter filter_button_list">
                <div class="control has-icon listing_filter">
                   &nbsp;
                </div>
                 <div class="grid-header"  id="source_type" data-id="<?php echo @$_GET['only'] ;?>">
                    <a style="cursor: pointer;" href="<?php echo base_url();?>tickets/index/listing">
                    <div class="filter">
                        <i data-feather="arrow-left"></i>
                        <span>&nbsp;Back to all events</span>
                        <div class="control">
                            
                        </div>
                    </div>
                </a>
                </div>

            </div>

 				<!--List-->
 				<div class="list-view list-view-v3">



 					<!--Active Tab-->
 					<div id="active-items-tab" class="tab-content is-active">
 						<div class="list-view-inner" id="list_body">




 								

 						</div>


 					</div>

 					

 				</div>

 			</div>

 		</div>
 	</div>
 </div>

 

 <?php $this->load->view('common/footer'); ?>
  <script src="<?php echo base_url(); ?>assets/js/validate/jquery.validate.js" async></script>
         <script src="<?php echo base_url(); ?>assets/js/validate/custom.js" async></script>
         <script src="<?php echo base_url(); ?>assets/js/ticket.js?v=1.3"></script>
<script type="text/javascript">
     $(document).ready(function() {
               initHModals();
    load_tickets_details('<?php echo $match_id;?>',0);
});
</script>
