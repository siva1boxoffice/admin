 <?php $this->load->view('common/header'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>myassets/css/style.css" />
        <div id="app-lists" class="view-wrapper is-webapp" data-page-title="List View" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="all-projects page-content is-relative tabs-wrapper is-slider is-squared is-inverted">

                    <?php //echo "<pre>";print_r($instruction_files);?>


                      <div class="page-content-inner">

                        <!--User profile-->
                        <div class="profile-wrapper">
                            <form method="post" id="upload_ticket" enctype="multipart/form-data" class="" action="<?php echo base_url()."Tickets/index/upload_ticket";?>">
                                <input type="hidden" name="ticketid" value="<?php echo $this->uri->segment(4);?>">
                            <div class="profile-header">
                                <h3 class="title is-4 is-narrow is-thin">Upload Your Tickets Now</h3>
                            </div>

                            <div class="profile-body">
                                <div class="columns">
                                    <div class="column is-8">
                                        <div class="profile-card">
                                            <div class="profile-card-section">
                                                <!-- <div class="section-title">
                                                    <h4>About Me</h4>
                                                    <a href="/admin-profile-edit-1.html"><i class="lnil lnil-pencil"></i></a>
                                                </div> -->
                                                <div class="section-content">
                                                    <p class="description">Tickets are more likely to sell if ready for 'Instant Download'.Keep your tickets listed right up until the event you can retrive your tickets at any time.</p>
                                                </div>
                                                <?php if($instruction_files[0]->file_name == ''){ ?>
                                                <div class="section-upload-ticket">
                                                    <div class="control">
                                                          <div class="file is-primary">
                                                              <label class="file-label">
                                                                  <input class="file-input" id="ticket_instruction" type="file" name="ticket_instruction" onchange="loadNote(event)" accept=".pdf">
                                                                  <span class="file-cta">
                                                                      <span class="file-icon">
                                                                          <i data-feather="upload"></i>
                                                                      </span>
                                                                      <span class="file-label">
                                                                          Upload Tickets Instructions Letter
                                                                      </span>
                                                                  </span>

                                                              </label>

                                                          </div>
                                                <div class="l-card" id="upload_ticket_note" style="    display: none;padding: 6px;
    margin-top: 10px;
    width: 369px;
    margin-left: 107px;">
                                                <div class="media-flex-center">
                                                <div class="flex-meta">
                                                <span id="upload_ticket_name"></span>
                                                </div>
                                                <div class="flex-end" style="cursor: pointer;" onclick="removeNote()">
                                                <i data-feather="trash"></i>
                                                </div>
                                                </div>
                                                </div>
                                                      </div>
                                                      <div class="section-ticket-content">
                                                            <p>Please upload your ticket instructions page if you have special instructions to the buyer,how to use the E-ticket</p>
                                                       </div>
                                                </div>
                                            <?php }else{ ?>

                                                <div class="section-upload-ticket">
                                                    <div class="control">
                                                        
                                                <div class="l-card" id="upload_ticket_note" style="padding: 6px;
    margin-top: 10px;
    width: 369px;
    margin-left: 107px;">
                                                <div class="media-flex-center">
                                                <div class="flex-meta">
                                                <span id="upload_ticket_name">
                                                    <a target="_blank" href="<?php echo UPLOAD_PATH;?>uploads/tickets/<?php echo $instruction_files[0]->file_name;?>" ><?php echo $instruction_files[0]->file_name;?></a></span>
                                                </div>
                                                <div class="flex-end" style="cursor: pointer;" onclick="remove_ticket(<?php echo $instruction_files[0]->id;?>)">
                                                <i data-feather="trash"></i>
                                                </div>
                                                </div>
                                                </div>
                                                      </div>
                                                      <div class="section-ticket-content">
                                                            <p>Please upload your ticket instructions page if you have special instructions to the buyer,how to use the E-ticket</p>
                                                       </div>
                                                </div>

                                            <?php } ?>


                                            </div>
                                        </div>

                                        <div class="profile-header">
                                            <h3 class="title is-4 is-narrow is-thin">Upload Your E-Tickets</h3>
                                            <div class="header-right">

                                                <div class="control">
                                                          <div class="file is-primary">
                                                              <label class="file-label">
                                                                <!--   <input class="file-input" type="file" name="resume"> -->
                                                                  <span class="file-cta">
                                                                      <span class="file-label">
                                                                          Upload multiple pdf with E-tickets 
                                                                      </span>
                                                                  </span>

                                                              </label>
                                                          </div>
                                                      </div>
                                            </div>
                                        </div>

                                        <?php if($e_ticket_files[0]->file_name == ''){ ?>

                                             <div class="profile-card">
                                            <div class="profile-card-section">
                                                <div class="section-upload-E-ticket">
                                                    <div class="columns">
                                                        <div class="column is-12">
                                                            <div class="columns is-multiline">
                                                        <?php for($t = 1;$t<=$ticket_data->quantity;$t++){ ?>
                                                        <div class="control column is-4">
                                                          <div class="file is-primary">
                                                              <label class="file-label">
    <input class="file-input" id="ticket_file_<?php echo $t;?>" type="file" name="tikcet_pdf[]" accept=".pdf" onchange="loadTicket(event,<?php echo $t;?>)">
                                                                  <span class="file-cta">
                                                                      <span class="file-label">
                                                                          Upload file for ticket - #<?php echo $t;?>
                                                                      </span>
                                                                  </span>
                                                              </label>
                                                          </div>

                                                        <div class="l-card" id="ticket_file_div_<?php echo $t;?>" style="padding:6px;margin-top:10px;display:none;">
                                                        <div class="media-flex-center">
                                                        <div class="flex-meta">
                                                        <span id="ticket_display_<?php echo $t;?>"></span>
                                                        </div>
        <div class="flex-end" style="cursor: pointer;" onclick="removeFile(event,<?php echo $t;?>)">
                                                        <i data-feather="trash"></i>
                                                        </div>
                                                        </div>
                                                        </div>

                                                          </div>

                                             
                                           
                                                        <?php } ?>
                                                      </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php } else{  ?>

                                             <div class="profile-card">
                                            <div class="profile-card-section">
                                                <div class="section-upload-E-ticket">
                                                    <div class="columns">
                                                        <div class="column is-12">
                                                            <div class="columns is-multiline">
                                                        <?php 
                                                         $count_upload_files = count($e_ticket_files);
                                                        foreach($e_ticket_files as $key => $e_ticket_file){ ?>
                                                        <div class="control column is-8">

                                                        <div class="l-card" id="ticket_file_div_<?php echo $key;?>" style="padding:6px;margin-top:10px;">
                                                        <div class="media-flex-center">
                                                        <div class="flex-meta">
                                                        <span id="ticket_display_<?php echo $key;?>">
                                                <a target="_blank" href="<?php echo base_url();?>uploads/tickets/<?php echo $e_ticket_file->file_name;?>" ><?php echo $e_ticket_file->file_name;?></a>
                                                                
                                                            </span>
                                                        </div>
        <div class="flex-end" style="cursor: pointer;" onclick="remove_ticket(<?php echo $e_ticket_file->id;?>)">
                                                        <i data-feather="trash"></i>
                                                        </div>
                                                        </div>
                                                        </div>

                                                          </div>

                                             
                                           
                                                        <?php } 
                                                        if($count_upload_files < $ticket_data->quantity){ 
                                                        $remaining_files = ($ticket_data->quantity - $count_upload_files);
                                                        for($k = 1;$k<=$remaining_files;$k++){
                                                            ?>
                                                             <div class="control column is-4">
                                                          <div class="file is-primary">
                                                              <label class="file-label">
    <input class="file-input" id="ticket_file_<?php echo $count_upload_files+$k;?>" type="file" name="tikcet_pdf[]" accept=".pdf" onchange="loadTicket(event,<?php echo $count_upload_files+$k;?>)">
                                                                  <span class="file-cta">
                                                                      <span class="file-label">
                                                                          Upload file for ticket - #<?php echo $count_upload_files+$k;?>
                                                                      </span>
                                                                  </span>
                                                              </label>
                                                          </div>

                                                        <div class="l-card" id="ticket_file_div_<?php echo $count_upload_files+$k;?>" style="padding:6px;margin-top:10px;display:none;">
                                                        <div class="media-flex-center">
                                                        <div class="flex-meta">
                                                        <span id="ticket_display_<?php echo $count_upload_files+$k;?>"></span>
                                                        </div>
        <div class="flex-end" style="cursor: pointer;" onclick="removeFile(event,<?php echo $count_upload_files+$k;?>)">
                                                        <i data-feather="trash"></i>
                                                        </div>
                                                        </div>
                                                        </div>

                                                          </div>

                                                       <?php }} ?>
                                                      </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php } ?>

        <!--                                 <div class="profile-card">
                                            <div class="profile-card-section">
                                                <div class="section-upload-E-ticket">
                                                    <div class="columns">
                                                        <div class="column is-12">
                                                            <div class="columns is-multiline">
                                                        <?php for($t = 1;$t<=$ticket_data->quantity;$t++){ ?>
                                                        <div class="control column is-4">
                                                          <div class="file is-primary">
                                                              <label class="file-label">
    <input class="file-input" id="ticket_file_<?php echo $t;?>" type="file" name="tikcet_pdf[]" accept=".pdf" onchange="loadTicket(event,<?php echo $t;?>)">
                                                                  <span class="file-cta">
                                                                      <span class="file-label">
                                                                          Upload file for ticket - #<?php echo $t;?>
                                                                      </span>
                                                                  </span>
                                                              </label>
                                                          </div>

                                                        <div class="l-card" id="ticket_file_div_<?php echo $t;?>" style="padding:6px;margin-top:10px;display:none;">
                                                        <div class="media-flex-center">
                                                        <div class="flex-meta">
                                                        <span id="ticket_display_<?php echo $t;?>"></span>
                                                        </div>
        <div class="flex-end" style="cursor: pointer;" onclick="removeFile(event,<?php echo $t;?>)">
                                                        <i data-feather="trash"></i>
                                                        </div>
                                                        </div>
                                                        </div>

                                                          </div>

                                             
                                           
                                                        <?php } ?>
                                                      </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="upload_button">    
                                        <a class="button h-button" onclick="window.close();">Upload Later</a>                                    
                                        <button type="submit" class="button h-button">Finish</button>

                                    </div>
                                    </div>
                                    <div class="column is-4">

                                        <!--Notifications-->
                                        <div class="profile-card">
                                            <div class="profile-card-section no-padding">
                                                <div class="details">
                                          <div class="event_img">
                                            <img src="<?php echo UPLOAD_PATH.'uploads/stadium'.$ticket_data->stadium_image;?>">
                                          </div>
                                          
                                          <h5><?php echo $ticket_data->match_name;?></h5>
                                          <p><?php echo $ticket_data->stadium_name;?>,<?php echo $ticket_data->city_name;?>,<?php echo $ticket_data->country_name;?></p>
                                          <p>
                                            <span class="tr_date">
                                              <b><?php echo date("Y-m-d",strtotime($ticket_data->match_date));?> </b>
                                            </span>
                                            <span class="tr_date">
                                              <b><?php echo $ticket_data->match_time;?></b>
                                            </span>
                                          </p>
                                          <p>
                                            No Of Tickets : <?php echo $ticket_data->quantity;?>
                                          </p>
                                        </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            </form>
                        </div>
                    

                    </div>
               
                </div>
            </div>
        </div>


  <?php $this->load->view('common/footer'); ?>
  <script type="text/javascript">

    function remove_ticket(id){

initConfirm('Delete E-Ticket Alert', "Are you sure to Delete E-Ticket?", false, false, 'Delete','Cancel', function (closeEvent) {
 
    
    var action = "<?php echo base_url();?>"+"Tickets/index/delete_e_ticket";
    $.ajax({
      type: "POST",
      url: action,
      data: {"id" : id},
      dataType: "json",

      success: function(data) {

        window.location.reload();
      }
    })

});

    }

      var loadTicket = function(event,i) { 
    var output = document.getElementById('ticket_display_'+i);
    $("#ticket_file_div_"+i).show();
    output.innerHTML =event.target.files[0].name;
  };

   var removeFile = function(event,i) { 
    var output = document.getElementById('ticket_display_'+i);
    $("#ticket_file_div_"+i).hide();
    output.innerHTML = "";
    document.getElementById("ticket_file_"+i).value = "";
  };

  

  var loadNote = function(event) { 
    var output = document.getElementById('upload_ticket_name');
    $("#upload_ticket_note").show();
    output.innerHTML =event.target.files[0].name;
  };

  var removeNote = function(event) { 
    var output = document.getElementById('upload_ticket_name');
    $("#upload_ticket_note").hide();
    output.innerHTML = "";
    document.getElementById("ticket_instruction").value = "";
  };



  </script>