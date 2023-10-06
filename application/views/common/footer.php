</div>
 </div>
 </div>

 <!--Huro Scripts-->
 <!--Load Mapbox-->
 <?php $segment = $this->uri->segment(3); ?>
 <?php $stadium_segment = $this->uri->segment(2); ?>
 <?php $order_segment = $this->uri->segment(2); ?>
 <!-- Concatenated plugins -->
 <script type="text/javascript">
 	var base_url = "<?php echo base_url(); ?>";
 </script>
 <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/functions.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/main.js" async></script>
 <script src="<?php echo base_url(); ?>assets/js/components.js?v=1.1" async></script>
 <script src="<?php echo base_url(); ?>assets/js/popover.js" async></script>
 <script src="<?php echo base_url(); ?>assets/js/widgets.js" async></script>
 <script src="<?php echo base_url(); ?>assets/js/touch.js" async></script>
 <script src="<?php echo base_url(); ?>assets/js/syntax.js" async></script>
 <script src="<?php echo base_url(); ?>assets/js/custom.js?ver=2.4.8" async></script>
 <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/validate_v1/jquery.validate.js"></script> -->
<!--  <script src="<?php echo base_url(); ?>assets/js/validate/jquery.validate.js?ver=2.4.9" async></script>
 <script src="<?php echo base_url(); ?>assets/js/validate/custom.js?ver=2.4.9" async></script> -->
 <script src="<?php echo base_url(); ?>assets/js/select2.min.js" async></script>
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script> -->
 <script src="<?php echo base_url();?>assets/js/validate_v1/jquery.validate.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/validate/custom.js?ver=2.4.9.336" async></script>
 <script src="<?php echo base_url(); ?>assets/js/ticket.js?v=12.3.1"></script>
 <script>
 	var map_url = "<?php echo UPLOAD_PATH; ?>uploads/stadium";
    var map_url = "<?php echo UPLOAD_PATH; ?>uploads/stadium";
   document.addEventListener("click", () => { 
    const div = document.querySelector('div.webapp-subnavbar');
  if (div.classList.contains("is-active")) {
    div.classList.remove("is-active")
     }
  }, true);
 </script>
 <?php if ($order_segment == 'orders') { ?>
		<script src="<?php echo base_url() ?>assets/js/mapsvg-new.js?ver=2.4.8.1"></script>
		<script src="<?php echo base_url() ?>assets/js/svg/mousewheel.js?ver=2.4.8"></script>
		<!-- <script src="<?php echo base_url() ?>assets/js/svg/nanoscrollbar.js?ver=2.4.8"></script> -->
	<?php } ?>
 <?php if ($stadium_segment == 'stadium') { ?>
 	<script src="<?php echo base_url() ?>assets/js/svg/settings.js?ver=2.4.8"></script>
 	<script src="<?php echo base_url() ?>assets/js/svg/jquery.js"></script>
 	<script src="<?php echo base_url() ?>assets/js/svg/jquery.mousewheel.min.js?ver=3.0.6"></script>
	<?php if (isset($getStadium->s_id)) : ?>
		<script src="<?php echo base_url() ?>assets/js/svg/edit_mapsvg.js?ver=2.4.8.42111"></script>
		<script src="<?php echo base_url() ?>assets/js/svg/edit_admin.js?ver=2.4.8.533dd"></script>
	  <script type="text/javascript">console.log("edit_admin");</script>
  <?php else : ?>
		<script src="<?php echo base_url() ?>assets/js/svg/mapsvg.js?ver=2.4.8.2.22"></script>
		<script src="<?php echo base_url() ?>assets/js/svg/add_admin.js?ver=2.5.1128dd"></script>
	<?php endif; ?>
<?php } 

if ($stadium_segment == 'stadium') {
	?>
  <script type="text/javascript">console.log("stadium");</script>
 	<script src="<?php echo base_url() ?>assets/js/svg/bootstrap.min.js?ver=3.3.6"></script>
 	<script src="<?php echo base_url() ?>assets/js/svg/bootstrap-colorpicker.min.js"></script>
 	<script src="<?php echo base_url() ?>assets/js/svg/jquery.message.js"></script>
 	<script src="<?php echo base_url() ?>assets/js/svg/ion.rangeSlider.min.js?ver=2.1.2"></script> <script type="text/javascript">console.log("stadium center");</script>
 	<script src="<?php echo base_url() ?>assets/js/svg/handlebars.js?ver=4.0.2"></script>
 	<script src="<?php echo base_url() ?>assets/js/svg/jquery.nanoscroller.min.js?ver=0.8.7"></script>
 	<script src="<?php echo base_url() ?>assets/js/svg/codemirror.js?ver=1.0"></script>
 	<script src="<?php echo base_url() ?>assets/js/svg/codemirror.javascript.js?ver=1.0"></script>
 	<script src="<?php echo base_url() ?>assets/js/svg/htmlmixed.js?ver=1.0"></script>
 	<script type='text/javascript' src='<?php echo base_url() ?>assets/js/svg/xml.js?ver=1.0'></script>
 	<script src="<?php echo base_url() ?>assets/js/svg/css.js?ver=1.1"></script>
 	<script src="<?php echo base_url() ?>assets/js/svg/formatting.js?ver=1.0"></script>
 	<script src="<?php echo base_url() ?>assets/js/svg/typeahead.bundle.min.js?ver=1.0"></script>
 	<script src="<?php echo base_url() ?>assets/js/svg/select2.min.js?ver=4.0"></script>
   <script type="text/javascript">console.log("stadium end");</script>
 	<script type="text/javascript">
    $( document ).ready(function() {
    console.log( "document ready!" );
     $tableRegion = $('#table-regions');
      var madmin = jQuery().mapsvgadmin('init', {});
});
 		jQuery(document).ready(function() {
 			/*$tableRegion = $('#table-regions');
 			var madmin = jQuery().mapsvgadmin('init', {});*/
 			<?php if (isset($getStadium->s_id)) : ?>
 				var stadiumId = '<?= $getStadium->s_id ?>';
 				$.ajax({
 					type: 'POST',
 					url: '<?= base_url('game/getStadiumByid') ?>',
 					data: {
 						'stadiumid': stadiumId
 					},
 					success: function(response) {
 						var jsonObject = $.parseJSON(response);
 						var status = jsonObject['Status'];
 						var getJsonArray = jsonObject['Json'];
 						var object = getJsonArray[0];
 						var mapcode = $.parseJSON(object['map_code']);
 						if (mapcode != '') {
 							if (mapcode.colors) {
 								$('input[name="colors[base]"]').val(mapcode.colors.base);
 								$(".mapsvg-region").each(function() {
 									$(this).css({
 										fill: mapcode.colors.base
 									});
 								});
 							}

 							$.each(mapcode.regions, function(key, value) {
 								$(".mapsvg-region").each(function() {
 									$('#' + key).css({
 										fill: value.fill
 									});
 								});
 							});
 						}
 						existing_json_data = mapcode;
 					}
 				});
 			<?php endif; ?>
 		});
 	</script>
 <?php
	}
	if ($this->uri->segment(1) == 'tickets') { ?>
 	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" /> -->
 	<!--Mapbox styles-->
 	<style>
 	/*	.search-details .choices {
 			float: left;
 			width: 77%;
 		}
*/
 		

 /*		.centDivsearch {
 			margin: auto;
 			width: 60%;
 		}*/

 		/* .project-grid .column a:nth-of-type(1){border: 1px solid #000;} */
 		/* .radio-toolbar input[type="radio"] {
 			opacity: 0;
 			position: fixed;
 			width: 0;
 		}

 		.radio-toolbar label {
 			display: inline-block;
 			background-color: #fff;
 			border-radius: 10px;
 			cursor: pointer;
 			padding: 19px;
 			width: 100%;
 			height: 100%;
 		}

 		.radio-toolbar input[type="radio"]:checked+label {
 			background-color: #fff;
 			border-color: #ddd;
 		}

 		.radio-toolbar input[type="radio"]:focus+label {
 			border: 1px solid #ff0000;
 		}

 		.radio-toolbar label:hover {
 			background-color: #fff;
 		}

 		.add_details {
 			background: #fff;
 			padding: 30px 0;
 			float: left;
 			width: 100%;
 		} */
 	</style>
 	<script src="<?php echo base_url() ?>assets/js/apps-1.js"></script>

 <?php } ?>
 <script type="text/javascript">
    jQuery(document).ready(function() {
      /*$tableRegion = $('#table-regions');console.log("DOWN");
      var madmin = jQuery().mapsvgadmin('init', {});*/
    });
 </script>
 </div>
 </body>

 </html>
