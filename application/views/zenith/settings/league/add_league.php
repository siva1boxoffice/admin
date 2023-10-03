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
                           <h3 class="mb-1 font-weight-bold"><?php echo $message = isset($top_league->id) ? "Edit League" : "Create New League"; ?> </h3>
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
                          <h5 class="card-title">Top League Info</h5>
                          <p>Fill the following Top League information</p>
                        </div>

						<form id="top-league-form" method="post" class="validate_form_v1 login-wrapper validate_form_v1" action="<?php echo base_url(); ?>settings/league/save">
        								<input type="hidden" name="match_type" value="league">
        								<input type="hidden" name="top_league_id" value="<?php if (isset($top_league->id)) {
																								echo $top_league->id;
																							} ?>">
                         <div class="row column_modified">                            
                            <div class="col-lg-3">
                                 <div class="form-group">
                                 <label for="name" >Team</label>
                                 <select class="custom-select" id="tournament" name="tournament" required>
								 <option value="">-Select Tournment -</option>
									<?php foreach ($tournments as $tournment) { ?>
										<option value="<?php echo $tournment->t_id; ?>" 
											<?php if (isset($top_league->tournament_id)) {
											if ($tournment->t_id == $top_league->tournament_id) {
												echo ' selected  ';
											}
										} ?>><?php echo $tournment->tournament_name; ?></option>
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
                                            <a href="<?php echo base_url() . 'settings/league';?>" class="btn btn-primary mb-2 mt-3">Back</a>
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
