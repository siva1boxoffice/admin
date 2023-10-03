<?php $this
   ->load
   ->view('common/header'); ?>
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
   <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">
         <div class="page-content-inner">
            <!--User profile-->
            <div class="profile-wrapper upload_e_ticket">
               <div class="profile-body">
                  <div class="profile-header ">
                     <h3 class="title is-4 is-narrow is-thin">Upload E-Tickets - Ticket Quantity (<?php echo $orderData->quantity;?>)</h3>
                  </div>
                  <div class="columns">
                     <div class="column is-8">
                        <div class="border-left-line">
                           <form id="add-eticket" enctype='multipart/form-data' method="post" class="login-wrapper validate_form_v2" action="<?php echo base_url(); ?>game/saveEticket">
                              <!-- <input type="hidden" name="booking_id" value="<?php echo $orderData->bg_id; ?>">
                                 <input type="hidden" name="booking_no" value="<?php echo $orderData->booking_no; ?>"> -->
                              <!-- <input type="hidden" name="ticketid" value="<?php echo $orderData->ticketid; ?>" id="ticketid"> -->
                              <div class="table_section orders" id="no-more-tables-v1">
                                 <table class="toptable res_table_new table-responsive table_padd">
                                    <tbody>
                                       <tr class="accordion ui-accordion ui-widget ui-helper-reset">
                                          <th>Ticket No</th>
                                          <th>Ticket ID</th>
                                          <th>Upload Ticket</th>
                                          <th>Uploaded Date</th>
                                          <th>Download Date</th>
                                          <th>View Ticket</th>
                                          <th>Action</th>
                                       </tr>
                                       <?php
                                          if ($orderData->quantity > 0 && $orderData->quantity != '') {
                                          	for ($i = 1; $i <= $orderData->quantity; $i++) {
                                          ?>
                                       <tr>
                                          <td data-label="sl.No"><?php echo $i;?></td>
                                          <td data-label="Ticket Id"><?php echo $eticketData[$i - 1]->ticketid;?></td>
                                          <?php if ($eticketData[$i - 1]->ticket_file != "") { ?>
                                          <td data-label="Ticket File"><label class="file-label mr-1">
                                             <span class="upFileName">
                                             <span class="">
                                             <?php 
                                                if ($eticketData[$i - 1]->ticket_file != "") {
                                                	echo $eticketData[$i - 1]->ticket_file;
                                                	$action =  base_url().'game/deleteEticket/'.$eticketData[$i - 1]->id;
                                                } else { ?>
                                             Upload for file ticket - #<?php echo $i;
                                                } ?>
                                             </span>
                                             </span>																	
                                             </label>
                                          </td>
                                          <?php } else{ ?>
                                          <td data-label="Ticket File">
                                             <div class="control">
                                                <div class="file is-default">
                                                   <label class="file-label">
                                                   <input class="eticket file-input" type="file"  multiple accept="pdf" name="eticket[]" id="<?php echo $eticketData[$i - 1]->ticketid;?>">
                                                   <span class="file-cta upFileName">
                                                   <span class="file-icon">
                                                   <i aria-hidden="true" class="fas fa-cloud-upload-alt"></i>
                                                   </span>
                                                   <span class="file-label">
                                                   Choose a file…
                                                   </span>
                                                   </span>
                                                   </label>
                                                </div>
                                             </div>
                                          </td>
                                          <?php } ?>
                                          <td data-label="Upload Date"><?php if ($eticketData[$i - 1]->ticket_file != "") { 

                                          			if($eticketData[$i - 1]->ticket_upload_date != ""){

														echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$eticketData[$i - 1]->ticket_upload_date))).' '.@$_COOKIE["time_zone"];
														}


                                          } else{?> &nbsp; <?php } ?></td>
                                          <td data-label="Download Date"><?php if ($eticketData[$i - 1]->ticket_file != "") { 

                                          	if($eticketData[$i - 1]->ticket_download_date != ""){

														echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$eticketData[$i - 1]->ticket_download_date))).' '.@$_COOKIE["time_zone"];
														}


                                          } else{?> &nbsp; <?php } ?></td>
                                          <?php if ($eticketData[$i - 1]->ticket_file != "") { ?>
                                          <td data-label="View"><a download target="_blank" href="<?php echo UPLOAD_PATH.'uploads/e_tickets/'.$eticketData[$i - 1]->ticket_file;?>">
                                             <span title="View Ticket" class="ticket_cancel" style="cursor: pointer;">
                                             <i class="fa fa-file-pdf"></i>
                                             </span>
                                             </a>
                                          </td>
                                          <?php } else{ ?>
                                          <td data-label="View">No Tickets Uploaded</td>
                                          <?php } ?>
                                          <td data-label="Action"><?php if ($eticketData[$i - 1]->ticket_file != "") { ?>
                                             <span title="Delete Ticket" class="ticket_cancel" style="cursor: pointer;" onclick="remove_ticket_file('<?php echo $action;?>');">
                                             Delete
                                             </span>
                                             <?php } else{ ?>&nbsp;<?php } ?>
                                          </td>
                                          <!-- <td colspan="3">NO ATTENDEES DETAILS UPDATED.</td>  -->
                                       </tr>
                                       <?php } } ?>
                                    </tbody>
                                 </table>
                              </div>
                           </form>
                           <!-- 	<form id="add-eticket" enctype='multipart/form-data' method="post" class="login-wrapper validate_form_v2" action="<?php echo base_url(); ?>game/saveEticket">
                              <input type="hidden" name="booking_id" value="<?php echo $orderData->bg_id; ?>">
                              <input type="hidden" name="booking_no" value="<?php echo $orderData->booking_no; ?>">
                              <input type="hidden" name="ticket_id" value="<?php echo $orderData->bt_id; ?>">
                              <div class="profile-card border_left_radius">
                              	<div class="profile-card-section">
                              		<div class="section-upload-E-ticket">
                              			<div class="control">
                              				<div class="file is-primary">
                              					<?php
                                 if ($orderData->quantity > 0 && $orderData->quantity != '') {
                                 	for ($i = 1; $i <= $orderData->quantity; $i++) {
                                 ?>
                              							<label class="file-label mr-1">
                              								<input class="file-input" type="file"  multiple accept="pdf" name="eticket[]">
                              								<span class="file-cta upFileName">
                              									<span class="file-label ">
                              										<?php 
                                 if ($eticketData[$i - 1]->ticket_file != "") {
                                 	echo $eticketData[$i - 1]->ticket_file;
                                 	$action =  base_url().'game/deleteEticket/'.$eticketData[$i - 1]->id;
                                 } else { ?>
                              											Upload for file ticket - #<?php echo $i;
                                 } ?>
                              									</span>
                              
                              								</span>																	
                              							</label>
                              							<?php if ($eticketData[$i - 1]->ticket_file != "") { ?>
                              							<span title="Delete Ticket" class="ticket_cancel" style="cursor: pointer;" onclick="remove_ticket_file('<?php echo $action;?>');">
                              							<i class="lnil lnil-trash-can-alt"></i>
                              							</span>
                              							<a download target="_blank" href="<?php echo base_url().'uploads/e_tickets/'.$eticketData[$i - 1]->ticket_file;?>">
                              							<span title="View Ticket" class="ticket_cancel" style="cursor: pointer;">
                              							<i class="fa fa-file-pdf"></i>
                              							</span>
                              						</a>
                              						<?php } ?>
                              					<?php }
                                 } ?>
                              				</div>
                              				
                              			</div>
                              		</div>
                              	</div>
                              </div>
                              <div class="upload_button">
                              	<a href="<?php echo base_url(); ?>game/orders/details/<?php echo md5($orderData->booking_no); ?>" class="button h-button is-primary is-raised">Upload Later</a>
                              	<button type="submit" id="branch-form-btn" class="button h-button is-primary is-raised">Finish</button>
                              </div>
                              </form> -->
                        </div>
                     </div>
                     <div class="column is-4">
                        <!--Notifications-->
                        <div class="profile-card border-top-line">
                           <div class="profile-card-section no-padding">
                              <!-- <div class="details">
                                 <h5><?php echo $orderData->match_name; ?></h5>
                                 <p><?php echo $orderData->country_name . ',' . $orderData->city_name; ?></p>
                                 <div class="event_img">
                                 	<img src="<?php echo base_url(); ?><?php echo $orderData->stadium_image; ?>">
                                 </div>
                                 <p>
                                 	<span class="tr_date">
                                 		<i class="fas fa-calendar"></i><?php echo $orderData->match_date; ?> </span>
                                 	<span class="tr_date">
                                 		<i class="fas fa-clock"></i><?php echo $orderData->match_time; ?> </span>
                                 </p>
                                 </div> -->
                              <div class="event_info">
                                 <div class="selec_head">
                                    <h4>Event Information</h4>
                                 </div>
                                 <div class="selec_img" id="selec_img" style="display: block;">
                                    <img id="team1_image" src="<?php echo $orderData->team1_image; ?>" style="width:60px;">
                                    <img id="team2_image" src="<?php echo $orderData->team2_image; ?>" style="width:60px;">
                                 </div>
                              </div>
                              <div class="details">
                                 <h5 id="res-match-name"><?php echo $orderData->match_name; ?></h5>
                                 <!--   <p><span id="res-match-place"><?php echo $orderData->stadium_name;?></span></p> -->
                                 <p><span id="res-match-place"><?php echo $orderData->stadium_country_name . ',' . $orderData->stadium_city_name; ?></span></p>
                                 <!--  <div class="event_img">
                                    <img id="res-stadium-image" src="<?php echo base_url(); ?><?php echo $orderData->stadium_image; ?>">
                                    </div> -->
                                 <div class="event_time">
                                    <span class="res-match-date">
                                    <b><span id="res-match-date">
                                    <?php echo date('d l Y',strtotime($orderData->match_date)); ?></span> </b>
                                    </span>
                                    <span class="tr_date">
                                    <b><span id="res-match-time"><?php echo $orderData->match_time; ?></span></b>
                                    </span>
                                 </div>
                                 <br>
                                 <p>
                                    <span class="">Block: <?php 
                                       if($orderData->ticket_block != 0){
                                       echo $orderData->block_id;
                                       }
                                       else{
                                       echo "Any";
                                       }
                                       ?></span>
                                 </p>
                                 <p>
                                    <span class="">Section: <?php echo $orderData->seat_category; ?></span>
                                 </p>
                                 <?php if(isset($seller_notes)){ ?>
                                 <p>
                                    <span class="">Seller Note: </span><br>
                                    <?php foreach($seller_notes as $seller_note){?>
                                    <img src="<?php echo UPLOAD_PATH.'uploads/ticket_details/'.$seller_note->ticket_image;?>" width="14px" height="14px">
                                    <?php echo $seller_note->ticket_name; ?><br>
                                    <?php } ?>
                                 </p>
                                 <?php } ?>
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
</div>
<?php $this
   ->load
   ->view('common/footer'); ?>
<script type="text/javascript">
   $(function() {
   
   	$(".eticket").on("change", function (e) {
   	var id = $(this).attr('id');
   	var file = $(this)[0].files[0];
   	var formData = new FormData();
   	formData.append('eticket', file);
   	formData.append('ticketid', id);
   	//console.log(formData);
   	 $.ajax({
            url: '<?php echo base_url();?>game/upload_single_ticket',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            dataType: "json",
            processData: false,
            success: function (data) { 
           	
           	 if(data.status == 1) {
   
                  notyf.success(data.msg, "Success", {
                  timeOut: "1800"
                  });
                  }else if(data.status == 0) {
                  notyf.error(data.msg, "Failed", "Oops!", {
                  timeOut: "1800"
                  });
                  }
                   setTimeout(window.location.reload(), 100);
              // alert(response);
            }
         });
   
   	//upload.doUpload();
   	});
   
   	$("input:file").change(function() {
   		var fileName = $(this).val();
   		$(this).next(".upFileName").html('<span class="file-label">Uploading...</span>');
   
   	});
   });
</script>
<style>
   .section-upload-E-ticket .file.is-primary .file-cta {
   width: 192px;
   }
</style>