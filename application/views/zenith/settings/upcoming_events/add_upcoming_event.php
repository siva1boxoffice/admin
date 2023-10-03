<style>
	.height_auto {
    height: auto !important;
}
	</style>
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
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($upcoming_events->id) ? "Edit Upcoming Event" : "Create Upcoming Event"; ?> </h3>
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
                          <h5 class="card-title">Upcoming Event Info</h5>
                          <p>Fill the following Upcoming Event information</p>
                        </div>
						<form id="top-league-form" method="post" class="validate_form_v1 login-wrapper validate_form_v1" action="<?php echo base_url(); ?>settings/upcoming_events/save">
        								<input type="hidden" name="upcoming_event_id" value="<?php if (isset($upcoming_events->id)) {
																									echo $upcoming_events->id;
																								} ?>">
                         <div class="row column_modified">                            
						 <div class="col-lg-3">
								<div class="form-group">
								<label for="simpleinput">Match </label>
								<select class="form-control" id="match" name="match" required>
									<option value="">-Select Match -</option>
									<?php foreach ($matches as $match) { ?>
										<option value="<?php echo $match->m_id; ?>"
										 <?php if (isset($upcoming_events->match_id)) {
											if ($match->m_id == $upcoming_events->match_id) {
												echo ' selected  ';
											}
										} ?>><?php echo $match->match_name; ?></option>
									<?php } ?>
								</select>
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
                                            <a href="<?php echo base_url() . 'settings/upcoming_events';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
$("#cname").change(function() {

	var url = '<?php echo base_url(); ?>' + 'settings/getStates';
	var data = {
		country_id: $("#cname").val()
	};
	$.ajax({
		url: url,
		data: data,
		type: "POST",
		dataType: 'json',
		success: function(data) {
			if (data != '') {
				var fil = data;
				$('#sname').empty();
				$('#sname').append("<option value='' selected disabled='disabled'>-Select State-</option>");
				for (var i = 0; i < fil.length; i++) {
					console.log(fil[i].name);
					$('#sname').append("<option value=" + fil[i].id + ">" + fil[i].name + "</option>");
				}
			}
		}
	});
});
</script>