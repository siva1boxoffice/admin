<?php
//echo md5("1BX".$eticketDatas[0]->booking_id);
// echo '<pre/>';
// print_r($eticketDatas);
//  exit; 
// echo '<pre/>';
// print_r($eticketDatas[0]->ticket_file);
// print_r($eticketDatas);
// exit;


?>
<style>
   .save_ticket_btnn a , .save_tracking_btnn a{
      color: #D80027 !important;
      text-decoration: underline;
   }

   .highlighted_ticket {
color: #0037D5 !important;
}
   </style>
<div class="card">
               <div class="card-body all_height_down">
                  <h5>Tickets Uploaded</h5>
                  <div class="new_tabs">
                     <div class="row">
                        <div class="col-sm-8">
                           <div class="tab-content pt-0" id="v-pills-tabContent">
                              <div class="tab-pane fade active show" id="v-pills-home2_<?php echo $eticketDatas[0]->booking_id; ?>" role="tabpanel"
                              aria-labelledby="v-pills-home-tab2">
                                 <div class="ticket_scroll" id="content_<?php echo $eticketDatas[0]->booking_id; ?>">
                                    <div class="row">
                                       <div class="col-lg-8">
                                          <div class="tick_upload_form">
                                             <div class="form-group mt-2 mb-0">
                                                <label for="simpleinput" class="mb-1">Delivery Provider</label>
                                                <input type="text" class="form-control" name="qr_link" placeholder="Enter Delivery Provider" value="<?php echo trim($tracking_details->delivery_provider);?>" id="tracking_provider_<?php echo $eticketDatas[0]->booking_id;?>" autocomplete="off">                       
                                             </div>
                                          </div>
                                          <div class="tick_upload_form">
                                             <div class="form-group mt-2 mb-0">
                                                <label for="simpleinput" class="mb-1">Tracking Link</label>
                                                <input type="text" class="form-control" name="qr_link" placeholder="Enter Tracking Link" value="<?php echo trim($tracking_details->tracking_link);?>" id="tracking_link_<?php echo $eticketDatas[0]->booking_id;?>" autocomplete="off">                       
                                             </div>
                                          </div>
                                          <div class="tick_upload_form">
                                             <div class="form-group mt-2 mb-0">
                                                <label for="simpleinput" class="mb-1">Tracking Number</label>
                                                <input type="text" class="form-control" name="qr_link" placeholder="Enter Tracking Number" value="<?php echo trim($tracking_details->tracking_number);?>" id="tracking_number_<?php echo $eticketDatas[0]->booking_id;?>" autocomplete="off">                       
                                             </div>
                                          </div>
                                           <div class="tick_upload_form">
                                             &nbsp;
                                           </div>
                                          <div class="btn_instructions">
                                          <div class="form-group mb-20">
                                             <div class="input-group">
                                               <div class="custom-file">
                                               <form id="fileUploadForm_<?php echo $eticketDatas[0]->booking_id;?>"  enctype="multipart/form-data">
                                               
                                               <input type="file" name="fileInput_<?php echo $eticketDatas[0]->booking_id;?>" class="custom-file-input  fileInput" id="fileInput_<?php echo $eticketDatas[0]->booking_id;?>" data-id="<?php echo $eticketDatas[0]->booking_id;?>" data-pod-id="tracking_pod_file_<?php echo $eticketDatas[0]->booking_id;?>" accept="image/jpeg,image/png,application/pdf" >

                                                 <label class="custom-file-label uploadButton" for="fileInput_<?php echo $eticketDatas[0]->booking_id;?>">Upload POD Attachment</label>
                                                 </form>
                                               </div>
                                             </div>
                                          </div>
                                           <div class="upload_inst_trash" id="pod_file_instrn_<?php echo $eticketDatas[0]->booking_id;?>">
                                 <p><span style="color:#00A3ED;"><?php echo $tracking_details->pod; ?></span></p>
                                 </div>
                                 </div>
                                       
                                         
                                       </div>
                                       <div class="col-lg-4 padfive">
                                          <div class="tick_upload_lists">
                                             <label for="simpleinput">&nbsp;</label>
                                             <ul>
                                                <li><span class="save_tracking_btnn" style="display: inline;" data-tracking="provider" data-booking-id="<?php echo $eticketDatas[0]->booking_id;?>"> <a href="javascript:void(0)" >Save</a></span></li>  
                                                <li><div class="copy_icon"><a href="javascript:void(0);"><i class="far fa-copy copy_tracking" data-tracking="provider" data-tracking-id="<?php echo $eticketDatas[0]->booking_id;?>"></i></a></div></li>  
                                                <li><div class="trash_icon tracking_trash" data-tracking="provider" data-booking-id="<?php echo $eticketDatas[0]->booking_id;?>"><a href="javascript:void(0);"><i class="far fa-trash-alt"></i></a></div></li>
                                             </ul>
                                          </div>
                                          <div class="tick_upload_lists">
                                             <label for="simpleinput">&nbsp;</label>
                                             <ul>
                                                <li><span class="save_tracking_btnn"  style="display: inline;" data-tracking="link" data-booking-id="<?php echo $eticketDatas[0]->booking_id;?>"><a href="javascript:void(0);" >Save</a></span></li>  
                                                <li><div class="copy_icon"><a href="javascript:void(0);"><i class="far fa-copy copy_tracking" data-tracking-id="<?php echo $eticketDatas[0]->booking_id;?>" data-tracking="link"></i></a></div></li>  
                                                <li><div class="trash_icon tracking_trash" data-tracking="link" data-booking-id="<?php echo $eticketDatas[0]->booking_id;?>"><a href="javascript:void(0);"><i class="far fa-trash-alt"></i></a></div></li>
                                             </ul>
                                          </div>
                                          <div class="tick_upload_lists">
                                             <label for="simpleinput">&nbsp;</label>
                                             <ul>
                                                <li><span class="save_tracking_btnn"  style="display: inline;" data-tracking="number" data-booking-id="<?php echo $eticketDatas[0]->booking_id;?>"><a href="javascript:void(0)" >Save</a></span></li>  
                                                <li><div class="copy_icon"><a href="javascript:void(0);"><i class="far fa-copy copy_tracking" data-tracking-id="<?php echo $eticketDatas[0]->booking_id;?>" data-tracking="number"></i></a></div></li>  
                                                <li><div class="trash_icon tracking_trash" data-tracking="number" data-booking-id="<?php echo $eticketDatas[0]->booking_id;?>"><a href="javascript:void(0);"><i class="far fa-trash-alt"></i></a></div></li>
                                             </ul>
                                          </div>
                                          <div class="tick_upload_lists">
                                             <label for="simpleinput">&nbsp;</label>
                                             <ul>
                                               &nbsp;
                                             </ul>
                                          </div>
                                           <div class="tick_upload_lists">
                                           <?php if($tracking_details->pod!=""){ ?>
                                             <label for="simpleinput">&nbsp;</label>
                                             <ul>
                                                <li>&nbsp;</li>
                                                <li><div class="copy_icon" id="view_pod_instrn_<?php echo $eticketDatas[0]->booking_id;?>"><a target="_blank" href="javascript:void(0);" onclick="return popitup('<?php echo TICKET_UPLOAD_PATH.'uploads/pod/'.$tracking_details->pod;?>')"><i class="far fa-eye"></i></a></div></li>                                                
                                                <li>
                                                <div class="trash_icon delete_pod_ticket" id="delete_pod_instrn_<?php echo $eticketDatas[0]->booking_id;?>" data-tracking="delete_pod" data-booking-id="<?php echo $eticketDatas[0]->booking_id;?>"><a href="javascript:void(0);"><i class="far fa-trash-alt"></i></a></div>
                                             </li>
                                             </ul>
                                             <?php } ?>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade " id="v-pills-profile2_<?php echo $eticketDatas[0]->booking_id; ?>" role="tabpanel"
                              aria-labelledby="v-pills-profile-tab2">
                                    <div class="ticket_scroll" id="content_ticket_upload_<?php echo $eticketDatas[0]->booking_id; ?>">
                                       <div class="row">
                                          <div class="col-lg-8">
                                          <?php //if ($quantity > 0) {
                                          
                                             $j=1;
                                             //for (   $i=0; $i < $quantity; $i++) {
                                                foreach($eticketDatas as $ticket_key=>$ticket_value){
                                                ?>
                                                <div class="tick_upload_form">
                                                   <div class="form-group mt-2 mb-0">
                                                      <label for="simpleinput" class="mb-1">Ticket <?=$j?> Link Android</label>
                                                      <input type="text" class="form-control" name="qr_link" placeholder="Enter Delivery Provider" value="<?php echo $ticket_value->qr_link;?>" id="ANDROID_<?php echo $ticket_value->id;?>" autocomplete="off">
                                                   </div>
                                                </div>
                                          
                                          
                                                <div class="tick_upload_form">
                                                   <div class="form-group mt-2 mb-0">
                                                      <label for="simpleinput" class="mb-1">Ticket <?=$j?> Link Apple</label>
                                                      <input type="text" class="form-control" name="qr_link_ios" placeholder="Enter Delivery Provider" value="<?php echo $ticket_value->qr_link_ios;?>" id="IOS_<?php echo $ticket_value->id;?>" autocomplete="off">
                                                   </div>
                                                </div>
                                             <?php $j++; }
                                       // } ?>
                                          </div>

                                          <div class="col-lg-4 padfive">
                                          <?php //if ($quantity > 0) {
                                                //for ($i = 0; $i < $quantity; $i++) {
                                                   foreach($eticketDatas as $ticket_save__key=>$ticket_save_value){ ?>
                                                   <div class="tick_upload_lists">
                                                      <label for="simpleinput">&nbsp;</label>                                                
                                                      <ul>
                                                         <li><span class="save_ticket_btnn" data-os="ANDROID" data-ticket-id="<?php echo $ticket_save_value->id;?>" style="display: inline;"><a
                                                                  href="javascript:void(0)">Save</a></span></li>
                                                         <li>
                                                            <div class="copy_icon " ><a href="javascript:void(0);"><i class="far fa-copy copy_ticket" data-os="ANDROID" data-ticket-id="<?php echo $ticket_save_value->id;?>"></i></a></div>
                                                         </li>
                                                         <li>
                                                            <div class="trash_icon ticket_trash" data-os="ANDROID" data-ticket-id="<?php echo $ticket_save_value->id;?>"><a href="javascript:void(0);"><i class="far fa-trash-alt"></i></a></div>
                                                         </li>
                                                      </ul>
                                                   </div>
                                                   <div class="tick_upload_lists">
                                                      <label for="simpleinput">&nbsp;</label>
                                                      <ul>
                                                         <li><span class="save_ticket_btnn" data-os="IOS" data-ticket-id="<?php echo $ticket_save_value->id;?>" style="display: inline;"><a
                                                                  href="javascript:void(0);">Save</a></span></li>
                                                         <li>
                                                            <div class="copy_icon " ><i class="far fa-copy copy_ticket" data-os="IOS" data-ticket-id="<?php echo $ticket_save_value->id;?>"><a href="javascript:void(0)"></i></a></div>
                                                         </li>
                                                         <li>
                                                            <div class="trash_icon ticket_trash" data-os="IOS" data-ticket-id="<?php echo $ticket_save_value->id;?>"><a href="javascript:void(0);"><i class="far fa-trash-alt"></i></a></div>
                                                         </li>
                                                      </ul>
                                                   </div>
                                                <?php }
                                          // } ?>
                                          </div>
                                       </div>
                                    </div>
                              </div>
                              <div class="tab-pane fade" id="v-pills-messages2_<?php echo $eticketDatas[0]->booking_id; ?>" role="tabpanel"
                              aria-labelledby="v-pills-messages-tab2">
                              <div class="row">
                              <div class="col-lg-10">
                              <?php if($eticketDatas[0]->ticket_file!=""){ ?>
                              <button type="button" class="btn btn-primary-outline download_e_ticket"  data-booking-id="<?php echo $eticketDatas[0]->booking_id;?>" >Download E-Tickets</button>
                              <?php } else{ ?>
                                 No tickets available to Download.
                              <?php } ?>
                              </div>
                              </div>
                              </div>
                              <div class="tab-pane fade" id="v-pills-settings2_<?php echo $eticketDatas[0]->booking_id; ?>" role="tabpanel"
                              aria-labelledby="v-pills-settings-tab2">
                                 <div class="row">
                                 <div class="col-sm-8">

                                  <div class="btn_instructions">
                                          <div class="form-group mb-20">
                                             <div class="input-group">
                                               <div class="custom-file">
                                                 <input type="file" name="ticket_instruction" class="custom-file-input ticket-instruction" id="inputGroupFile_<?php echo $eticketDatas[0]->booking_id; ?>" data-id="1BX<?php echo $eticketDatas[0]->booking_id; ?>" accept="image/jpeg,image/png,application/pdf">
                                                 <label class="custom-file-label" for="inputGroupFile_<?php echo $eticketDatas[0]->booking_id; ?>">Upload Ticket Instruction</label>
                                               </div>
                                             </div>
                                          </div>
                                           <div class="upload_inst_trash" id="upload_inst_trash_<?php echo $eticketDatas[0]->booking_id; ?>">
                                 <p><span style="color:#00A3ED;"><?php if($booking_global->instruction_file!="") 
                                 echo $booking_global->instruction_file; ?></span></p>
                                 <ul>
                                 <?php if($booking_global->instruction_file!="")  { ?>
                                    <li><div class="remove_ico"><i class=" far fa-trash-alt delete_ticket_instruction" data-delete-id='<?php echo $eticketDatas[0]->booking_id; ?>' ></i></div></li>  
                      
                      <li><div class="view_ico"><a target="_blank" href="javascript:void(0);" onclick="return popitup('<?php echo TICKET_UPLOAD_PATH.'uploads/e_tickets/'.$booking_global->instruction_file;?>')" class="view_bg"><i class=" far fa-eye"></i></a></div></li>

                                    <?php } ?>
                                 </ul>
                                 </div>
                                 </div>

                               <!--   <div class="upload_inst_trash">
                                 <p><span style="color:#00A3ED;"></span></p>
                                 <ul>
                                 <li><div class="remove_ico"><i class=" far fa-trash-alt"></i></div></li>
                                 <li><div class="view_ico"><i class=" far fa-eye"></i></div></li>
                                 </ul>
                                 </div> -->
                                 </div>
                                 </div>
                              </div>
                             
                              <div class="tab-pane fade" id="v-pills-sett2_<?php echo $eticketDatas[0]->booking_id; ?>" role="tabpanel"
                              aria-labelledby="v-pills-sett-tab2">

                              
                                 <?php 
                                 if($eticketDatas[0]->ticket_file!=""){ ?>
                                 <div id="TopAirLine_new" class="topAirSlider_new owl-carousel owl-theme">

                                    <?php 
                                    $i=1;
                                    foreach ($eticketDatas as $eticketData) {
                                      // echo "<pre>";print_r($eticketData);
                                      if($eticketData->ticket_file!=""){
                                     ?>
                                    <div class="item" id="upload_eticket_<?php echo $eticketDatas[$i-1]->ticketid; ?>" >
                                       <div class="uploads_imgg mt-5">
                                          <div class="imag_view">
                                          <embed  class="d-block img-fluid embed_file" src="<?php echo TICKET_UPLOAD_PATH."uploads/e_tickets/".$eticketData->ticket_file;?>"  />
                                             
                                          <p><?php echo $eticketData->ticket_file;?></p>
                                       </div>

                                       <div class="icon_hover">
                                          <ul>
                                            <li><div class="remove_ico"><i class=" far fa-trash-alt delete_ticket" data-delete-id='<?php echo $eticketDatas[$i-1]->ticketid; ?>' data-bg-id="<?php echo $eticketDatas[0]->booking_id; ?>" ></i></div></li>  
                      
                                                   <li><div class="view_ico"><a target="_blank" href="javascript:void(0);" onclick="return popitup('<?php echo TICKET_UPLOAD_PATH.'uploads/e_tickets/'.$eticketData->ticket_file;?>')" class="view_bg"><i class=" far fa-eye"></i></a></div></li>
                                          </ul>
                                       </div>
                                       </div>
                                    </div>
                                    <?php } $i++;} ?>
                                   
                                 </div>
                                     <?php }else{
                                     echo "<p> E Tickets not available. </p>"; ?>
                                     <a style="color: #D80027 !important;text-decoration: underline;" target="_blank" href="<?php echo base_url();?>game/orders/upload_e_ticket/<?php echo md5('1BX'.$orderData->booking_id);?>" >Upload E-Ticket</a>
                                 <?php  }?>
                              </div>
                              
                           </div>
                        </div> <!-- end col -->
                        <div class="col-sm-4">
                           <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab2" role="tablist"
                           aria-orientation="vertical">
                           <a class="nav-link active show mb-1" id="v-pills-home-tab2" data-toggle="pill"
                           href="#v-pills-home2_<?php echo $eticketDatas[0]->booking_id; ?>" role="tab" aria-controls="v-pills-home2" aria-selected="true">
                           POD Upload</a>
                           <?php //if($eticketDatas[0]->ticket_file!=""){ ?>
                              
                           <a class="nav-link mb-1" id="v-pills-sett-tab2" data-toggle="pill"
                           href="#v-pills-sett2_<?php echo $eticketDatas[0]->booking_id; ?>" role="tab" aria-controls="v-pills-sett2"
                           aria-selected="false">
                           Upload E-ticket</a>
                           
                           <a class="nav-link mb-1" id="v-pills-messages-tab2" data-toggle="pill"
                           href="#v-pills-messages2_<?php echo $eticketDatas[0]->booking_id; ?>" role="tab" aria-controls="v-pills-messages2"
                           aria-selected="false">
                           Download</a>
                           <?php //}?>
                           <a class="nav-link mb-1" id="v-pills-settings-tab2" data-toggle="pill"
                           href="#v-pills-settings2_<?php echo $eticketDatas[0]->booking_id; ?>" role="tab" aria-controls="v-pills-settings2"
                           aria-selected="false">
                           Ticket Instructions</a>

                           <a class="nav-link mb-1" id="v-pills-profile-tab2" data-toggle="pill" href="#v-pills-profile2_<?php echo $eticketDatas[0]->booking_id; ?>"
                           role="tab" aria-controls="v-pills-profile2" aria-selected="false">
                           Upload Url Links</a>

                           
                           </div>
                        </div> <!-- end col -->
                     </div> <!-- end row-->
                  </div>
                  <div class="ins_upload">
                     <div class="row">
                        <div class="col-sm-8">
                           <!-- <div class="upload_inst_trash">
                              <p><span style="color:#00A3ED;">Instructions File Name.pdf</span></p>
                              <ul>
                                 <li><div class="remove_ico"><i class=" far fa-trash-alt"></i></div></li>
                                 <li><div class="view_ico"><i class=" far fa-eye"></i></div></li>
                              </ul>
                           </div> -->
                        </div>
                        <div class="col-sm-4">
                          <!--  <div class="approve_reject">
                              <button class="reject_bttns">Reject</button>
                              <button class="aprove_bttns">Approve</button>
                           </div> -->
                           <div class="file_s mt-2">
                              <div class="input-icons">
                                  <i class="">
                                     <img src="<?php echo base_url(); ?>assets/zenith_assets/img/file_green.png" class="email_submit">
                                  </i>
                                  <input class="input-field resend_email" type="text" data-booking-id="<?php echo $eticketDatas[0]->booking_id;?>" placeholder="Resend Ticket" value="<?php echo $orderData->email;?>" id="send_mail_<?php echo $eticketDatas[0]->booking_id;?>">

                              </div>
                           </div>
                        </div>
                     </div>  
                  </div>
               </div>
            </div>

       <script>
         $(document).ready(function() {


         $("#content_1").mCustomScrollbar({
            scrollButtons:{
            enable:true
            }
         });

         $("#content_2").mCustomScrollbar({
            scrollButtons:{
            enable:true
            }
         });


         $('body').on('click', '.delete_ticket', function(e) {
//$(".delete_ticket").click(function () {   
   var data_id = $(this).attr('data-delete-id');
   var bg_id = $(this).attr('data-bg-id');
   swal({
          title: 'Are you sure you want to delete this ticket?',
          text: "Yes or No",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0CC27E',
          cancelButtonColor: '#FF586B',
          confirmButtonText: 'Yes!',
          cancelButtonText: 'No!',
          confirmButtonClass: 'button h-button is-primary btn btn-primary ',
          cancelButtonClass: 'button h-button is-danger btn btn-danger',
          buttonsStyling: false
        }).then(function (res) {


    if (res.value == true) {    
      $.ajax({
         url: '<?php echo base_url();?>game/delete_upload_single_ticket',
         type: 'POST',
         dataType: "json",
         data: {  ticket_id: data_id   },
         success: function (response) {               
               swal('Updated !', response.msg, 'success');
               $('#upload_eticket_'+data_id).remove();
               reload_upload_area(bg_id);
              // setTimeout(window.location.reload(),300);
         },
         error: function () {
         console.log('Failed');
         }
      });
    }   
  }, function (dismiss) {

  });

   });

            //$("body").on("click", ".copy_ticket", function () {
               $(".copy_ticket").on("click",  function (e) {
               var ticket_id = $(this).data('ticket-id');
               var os = $(this).data('os'); 
               var qr_link=$('#'+os+"_"+ticket_id).val();    
               $(this).addClass('highlighted_ticket');
               var textArea = document.createElement("textarea");
               textArea.value = qr_link.trim();
               document.body.appendChild(textArea);
               textArea.select();
               document.execCommand("Copy");
               textArea.remove();
            });

          //  $("body").on("click", ".copy_tracking", function () {
               $(".copy_tracking").on("click",  function (e) {
               var tracking_id = $(this).data('tracking-id');
               var tracking = $(this).data('tracking'); 
               var qr_link=$('#tracking_'+tracking+"_"+tracking_id).val();    
               $(this).addClass('highlighted_ticket');
               var textArea = document.createElement("textarea");
               textArea.value = qr_link.trim();
               document.body.appendChild(textArea);
               textArea.select();
               document.execCommand("Copy");
               textArea.remove();
            });

            function updateQRLink(ticket_id, os, qr_link, delete_flag) {
    $.ajax({
        url: '<?php echo base_url(); ?>game/update_qr_link_orders',
                  type: 'POST',
                  dataType: 'json',
                  data: { "ticket_id": ticket_id, "os": os, "qr_link": qr_link, "delete_flag": delete_flag },
                  success: function (response) {
                     if (response.status == 0) {
                        swal('Updation Failed !', response.msg, 'error');
                     } else {
                        swal('Updated !', "Success", 'success');
                        if (delete_flag === 1) {
                           $('#' + os + '_' + ticket_id).val('');
                        }
                     }
                  },
                  error: function () {
                     console.log('Failed');
                  }
               });
            }

            //$("body").on("click", ".save_ticket_btnn", function () {
            $(".save_ticket_btnn").on("click",  function (e) {
               var ticket_id = $(this).data('ticket-id');
               var os = $(this).data('os');
               var qr_link = $('#' + os + '_' + ticket_id).val();
               if (qr_link !== "") {
                  updateQRLink(ticket_id, os, qr_link, 0);
               } else {
                  swal('Updation Failed !', "Fill the Mandatory fields.", 'error');
               }
            });

            //$("body").on("click", ".ticket_trash", function () {
            $(".ticket_trash").on("click",  function (e) {
               var ticket_id = $(this).data('ticket-id');
               var os = $(this).data('os');
               updateQRLink(ticket_id, os, '', 1);
            });

            //$("body").on("click", ".tracking_trash", function () {
            $(".tracking_trash").on("click",  function (e) {
               var tracking = $(this).data('tracking');
               var booking_id = $(this).data('booking-id');
               var inpt_tracking_value = $('#tracking_' + tracking + '_' + booking_id).val();
               var inpt_tracking="tracking_"+tracking;
               if(inpt_tracking_value!=""){
               $.ajax({
        url: '<?php echo base_url(); ?>game/update_tracking_data_orders_delete',
                     type: 'POST',
                     dataType: 'json',
                     data: { "bg_id": booking_id, ["tracking_" + tracking]: inpt_tracking_value, "delete":1 },
                     success: function (response) {
                        if (response.status == 0) {
                           swal('Updation Failed !', response.msg, 'error');
                        } else {
                           swal('Updated !', response.msg, 'success');
                           $('#tracking_' + tracking + '_' + booking_id).val('');
                        }
                     },
                     error: function () {
                        console.log('Failed');
                     }
                  });
               }
               else{
                  swal('Updation Failed !', "Empty Vaue Cannot be delete.", 'error');
               }
                              
            });
            

           
               $("body").on("change", ".fileInput", function (e) {
                 e.preventDefault();
               
    // Create a FormData object to store the file

    var form_data = new FormData();

    var pod_id = $(this).data('id');
    var file_data = $('.fileInput').prop('files')[0];
    //var formData = new FormData($("#fileUploadForm_"+pod_id)[0]);

    form_data.append('file', file_data);
  form_data.append('bg_id', pod_id);

//console.log(formData);
//return false;
   //  Make an AJAX request
    $.ajax({
      type: 'POST',
      async: false,
    cache: false,
    contentType: false,
    enctype: 'multipart/form-data',
    dataType: "json",           
      data: form_data,
      contentType: false,
      processData: false,
      url: '<?php echo base_url(); ?>game/update_tracking_data_orders',
      success: function(response) {
        // Handle the server's response
        if(response.status == 1){ 
         reload_upload_area(response.bg_id);
        }
        
        $("#response").html(response);
        swal('Updated', response.msg, 'success');
      //   setTimeout(window.location.reload(),200);
      $('#all-orders').trigger('click');
      },
      error: function(xhr, status, error) {
        console.log("Upload failed: " + error);
      }
    });
  });

            //$("body").on("click", ".save_tracking_btnn", function (e) {
               $(".save_tracking_btnn").on("click",  function (e) {
               var tracking = $(this).data('tracking');
               var booking_id = $(this).data('booking-id');
               var inpt_tracking_value = $('#tracking_' + tracking + '_' + booking_id).val();
               var inpt_tracking="tracking_"+tracking;
               if(inpt_tracking_value!=""){
               $.ajax({
        url: '<?php echo base_url(); ?>game/update_tracking_data_orders',
                     type: 'POST',
                     dataType: 'json',
                     data: { "bg_id": booking_id, ["tracking_" + tracking]: inpt_tracking_value },
                     success: function (response) {
                        if (response.status == 0) {
                           swal('Updation Failed !', response.msg, 'error');
                        } else {
                           swal('Updated !', "Success", 'success');
                        }
                     },
                     error: function () {
                        console.log('Failed');
                     }
                  });
               }
               else {
                  swal('Updation Failed !', "Fill the Mandatory fields.", 'error');
               }

            });


            $('.ticket-instruction').on('change', function() {
    var file_data = $('.ticket-instruction').prop('files')[0];
    var allowed_types = ['application/pdf', 'image/jpeg', 'image/png'];
    if (allowed_types.indexOf(file_data.type) === -1) {
      alert('File type not allowed. Please select a PDF, JPEG, or PNG file.');
      return;
    }
    
  var booking_id = $(this).attr('data-id');
   var form_data = new FormData();
    form_data.append('file', file_data);
  form_data.append('booking_id', booking_id);

    $.ajax({
    url: '<?php echo base_url();?>game/save_ticket_instruction',
      type: 'POST',
    async: false,
    cache: false,
    contentType: false,
    enctype: 'multipart/form-data',
    dataType: "json",           
      data: form_data,
      contentType: false,
      processData: false,
      success: function(response) {
        // Handle the response from the server
       
        if(response.status == 1){ 
            reload_upload_area(response.bg_id);
        }
        

    swal('Updated !', response.msg, 'success');
      $('#all-orders').trigger('click');
                    //  setTimeout(window.location.reload(),200);
      },
      error: function(xhr, status, error) {
        // Handle the error
        console.log(error);
      }
    });
  });

           

  $(".delete_ticket_instruction").click(function () {
var data_id = $(this).attr('data-delete-id');
$.ajax({
         url: '<?php echo base_url();?>game/delete_uploaded_instructions',
         type: 'POST',
         dataType: "json",
         data: {  ticket_id: data_id   },
         success: function (response) {

               if(response.status == 1){ 
               reload_upload_area(response.bg_id);
              //$('#upload_inst_trash_'+data_id).remove();
               }               
               swal('Updated !', response.msg, 'success');
             //  setTimeout(window.location.reload(),300);
             $('#all-orders').trigger('click');
         },
         error: function () {
         console.log('Failed');
         }
      });
   });

   $(".delete_pod_ticket").click(function () {
     
      var booking_id = $(this).attr('data-booking-id');
      $('#view_pod_instrn_'+booking_id).hide();
      $('#delete_pod_instrn_'+booking_id).hide();
      $('#pod_file_instrn_'+booking_id).hide();
$.ajax({
         url: '<?php echo base_url();?>game/delete_pod_instructions',
         type: 'POST',
         dataType: "json",
         data: {  booking_id: booking_id   },
         success: function (response) { 
               if(response.status == 1){ 
               reload_upload_area(response.bg_id);
               }                
               swal('Updated !', response.msg, 'success');
               $('#all-orders').trigger('click');
              // $("#updateNominee").hide();
             //  setTimeout(window.location.reload(),300);
         },
         error: function () {
         console.log('Failed');
         }
      });
   });

   //$("body").on("click", ".email_submit", function () {
   $(".email_submit").on("click",  function (e) {

var ticket_id = '<?php echo $eticketDatas[0]->booking_id; ?>';
var Email = $('#send_mail_'+ticket_id).val(); // Get the value of the textbox

if (Email == "") {
   swal('Error!', "Emai ID Cannot be empty.", 'error');
   return false;
}

swal({
  title: 'Are you sure you want to Send a email ?',
  text: "Send or Cancel",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#0CC27E',
  cancelButtonColor: '#FF586B',
  confirmButtonText: 'Yes, Send!',
  cancelButtonText: 'No, cancel!',
  confirmButtonClass: 'button h-button is-primary btn btn-primary ',
  cancelButtonClass: 'button h-button is-danger btn btn-danger',
  buttonsStyling: false
}).then(function (res) {
   if (res.value == true) {

      $.ajax({
         url: '<?php echo base_url();?>game/resend_email',
         type: 'POST',
         dataType: "json",
         data: { email: Email, ticket_id: ticket_id },
         success: function (response) {

            // 
            if (response.status == 0) {
               swal('Updation Failed !', response.msg, 'error');
            }
            else {
               swal('Updated !', response.msg, 'success');
               $('.close').trigger('click');
               $('#all-orders').trigger('click');
            }
            //setTimeout(window.location.reload(),300);
         },
         error: function () {
            console.log('Failed');
         }
      });
   }
}, function (dismiss) {

});
});  

 

         });

         function popitup(url,temp='')
   {
      if(temp!="")
            var url='<?php echo base_url()."/uploads/e_tickets/temp/";?>'+url; 

      newwindow=window.open(url,'name','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,,height=500,width=700');

      if (window.focus) {newwindow.focus()}
      return false;
   }


   function reload_upload_area(bg_id){

       var file_upload_area = "";
        $.ajax({
         
          url: '<?php echo base_url(); ?>game/booking_ticket_items',
          type: 'POST',
          data: { 'bg_id': bg_id }, 
          dataType : 'JSON',
          async: false,  
          success:function(data) {
            if(data.response != ""){
               $("#file_upload_area").html(data.response);              
            }
            $("#content_"+bg_id).mCustomScrollbar({
                scrollButtons:{
                  enable:true
                }
              });
      $("#content_ticket_upload_"+bg_id).mCustomScrollbar({
                scrollButtons:{
                  enable:true
                }
              });
 $("#ticket_holder_"+bg_id).mCustomScrollbar({
                scrollButtons:{
                  enable:true
                }
              });
              $('.owl-carousel').css('display', 'block');

             //file_upload_area = data.response; 
              
          }
       });

   }
 
       </script>     