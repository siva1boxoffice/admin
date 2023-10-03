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
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($city_details->id) ? "Edit City" : "Create New City"; ?> </h3>
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
                          <h5 class="card-title">City Info</h5>
                          <p>Fill the following City information</p>
                        </div>

						<form id="city-form" method="post" class="login-wrapper form_req_validation validate_form_v1" action="<?php echo base_url(); ?>settings/cities/save">
						<input type="hidden" name="city_id" value="<?php if (isset($city_details->id)) {
																		echo $city_details->id;
																	} ?>">
                         <div class="row column_modified">                            
						 <div class="col-lg-3">
								<div class="form-group">
								<label for="simpleinput">Country Name </label>
								<select class="form-control " id="cname" name="cname" required>
									<option value="">-Select Country-</option>
									<?php foreach ($countries as $country) { ?>
										<option value="<?php echo $country->id; ?>" <?php if (isset($selected_country)) {
																						if ($country->id == $selected_country) {
																							echo ' selected  ';
																						}
																					} ?>><?php echo $country->name; ?></option>
									<?php } ?>
								</select>
								</div> 
							</div> 
							
							<div class="col-lg-3">
								<div class="form-group">
								<label for="simpleinput">State Name </label>
								<select class="form-control" id="sname" name="sname" required>
								<option value="">-Select State-</option>
								<?php
								if (isset($states)) {
									foreach ($states as $state) { ?>
										<option value="<?php echo $state->id; ?>"
										 <?php if (isset($city_details->state_id)) {
												if ($state->id == $city_details->state_id) {
													echo ' selected  ';
												}
											} ?>><?php echo $state->name; ?></option>
										<?php }
										} ?>
									</select>
								</div>
								</div> 

								<div class="col-lg-3">
								<div class="form-group">
								<label for="simpleinput">Country Name </label>
								<input required type="text" name="cityname" id="cityname" class="form-control" placeholder="Enter Country Name" value="<?php  if (isset($city_details->name)) { echo $city_details->name; } ?>">
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
                                            <a href="<?php echo base_url() . 'settings/cities';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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