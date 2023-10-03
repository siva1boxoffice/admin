<style>

.view_bg{
	color: #ffffff !important;
	}
   .etickets::-webkit-file-upload-button {
  visibility: hidden;
}

.etickets::before {
  content: 'Select File';
  display: inline-block;
  background: #f1f1f1;
  border: 1px solid #ccc;
  padding: 6px 10px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  font-size: 16px;
}

.etickets:hover::before {
  background-color: #e9e9e9;
}

.etickets:active::before {
  background-color: #ccc;
}


</style>

<?php $this->load->view(THEME . '/common/header'); ?>
 <!-- Begin main content -->
 <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="page-title dflex-between-center side_arrow">
                     <h3 class="mb-1"> <div class="go_back_btn"><a href="<?php echo base_url(); ?>game/orders/details/<?php echo md5($orderData->booking_no); ?>"><i class="fas fa-arrow-left"></i></a></div>Upload E-Ticket</h3>
                  </div>
               </div>
            </div>
            <!-- page content -->
            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">
                  <div class="row">
                           <div class="col-md-2"></div>
                           <div class="col-md-9">
                              <div class="card">
                                 <div class="card-body">
                                    <div class="">
                                       <div class="team_name_ticket">
                                         <h3><?php echo $orderData->match_name; ?></h3>
                                         <p> <?php echo $orderData->stadium_name . ',' . $orderData->stadium_city_name . ',' . $orderData->stadium_country_name; ?></p>
                                         <p><span><?php echo date('l j F Y', strtotime($orderData->match_date)); ?> - <?php echo $orderData->match_time; ?></span></p>
                                         <a href=""><?php echo $orderData->quantity; ?> Tickets</a>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-6">
                                             <div class="block_type_sec">
                                                <table style="width:100%">
                                                    <tbody>
                                                      <tr>
                                                        <td>Block:</td>
                                                        <td><?php
                                                               if ($orderData->ticket_block != '') {
                                                                  echo $orderData->ticket_block;
                                                               } else {
                                                                  echo "Any";
                                                               }
                                                               ?>
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                        <td>Section:</td>
                                                        <td><?php echo $orderData->seat_category; ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td>Ticket Section:</td>
                                                        <td><?php
                                                            if ($orderData->section == '0') {
                                                               echo  $section = "Any";
                                                            } else if ($orderData->section == '1') {
                                                               echo  $section = "Home";
                                                            } else if ($orderData->section == '2') {
                                                               echo  $section = "Away";
                                                            } else {
                                                               echo $section = $orderData->section;
                                                            }
                                                            ?>
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                        <td>Ticket Type:</td>
                                                        <td><?php echo $orderData->ticket_type_name; ?></td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="block_type_sec">
                                                <table style="width:100%">
                                                    <tbody>
                                                      <tr>
                                                        <td>Order ID:</td>
                                                        <td>#<?php echo $orderData->booking_no; ?></b></td>
                                                      </tr>
                                                      <tr>
                                                        <td>Listing ID:</td>
                                                        <td><?php echo $orderData->ticketid; ?></td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>                 
                              </div>

                              <div class="card">
                                 <div class="card-header drag_drop">
                                   <h6 class="card-subtitle">Drag and drop your tickets into consecutive seat number order</h6>
                                 </div>
                                 <div class="card-body">
                                       <div class="file_upload_slider">
                                       <div id="TopAirLine_newww" class="topAirSlider owl-carousel owl-theme owl-loaded owl-drag">
                                       
                                                   <?php for ($i = 1; $i <= $orderData->quantity; $i++) { ?>
                                                      <div class="item">
                                                         <div class ="dropzone" id="drop-zone_<?php echo $i; ?>" id="myAwesomeDropzone_<?php echo $i; ?>" data-plugin="dropzone"
                                                            data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                                                               <div class="fallback" style="display:none">
                                                                  <input class='etickets' name="eticket[]" type="file"   id="<?php echo $i; ?>" data-id="<?php echo $i; ?>" data-ticket-id="<?php echo $eticketData[$i - 1]->ticketid;?>"  accept="image/jpeg,image/png,application/pdf"  />
                                                               </div>
                                                               <div class="dz-message needsclick">
                                                                  <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                                  <h3 class="drag_ticket" id="drag_ticket_<?php echo $i; ?>">Drag Ticket <?php echo $i; ?>  Here</h3>
                                                               </div>
                                                            </div>        
                                                            </div>                                                  
                                                      <?php } ?>
                                                </div>
                                             </div>
               <div id="TopAirLine" class="topAirSlider owl-carousel owl-theme">
                  <?php for ($i = 1; $i <= $orderData->quantity; $i++) { 
                     $show="none";
                     ?>
                     <?php if(!empty($eticketData[$i - 1]->ticket_file)) { $show="block";} ?>
                        <?php //} ?>
                     <div class="item">   
                      
                     <div class="imag_view show_preview_file_<?php echo $i; ?>"> 
                     <?php if(!empty($eticketData[$i - 1]->ticket_file)) {  ?>
                           <embed  class="d-block img-fluid embed_file" src="<?php echo TICKET_UPLOAD_PATH."uploads/e_tickets/".$eticketData[$i - 1]->ticket_file;?>"  style="overflow: hidden !important;" scrolling="no" />
                        <?php } ?>

                            <!-- <img class="d-block img-fluid" src="<?php //echo TICKET_UPLOAD_PATH."uploads/e_tickets/".$eticketData[$i - 1]->ticket_file;?>" alt="<?php //echo $eticketData[$i - 1]->ticket_file;?>"> -->
                            <p class="show_file_name" id="show_file_name_<?php echo $i; ?>"><?php echo $eticketData[$i - 1]->ticket_file;?></p>
                        </div>   
                        <!-- style="display:none" -->
                        <div  class="icon_hover ticket_action_<?php echo $i; ?>" style="display:<?php echo $show; ?>" >
                        <ul> 
                           <li><div class="remove_ico"><i class=" far fa-trash-alt delete_ticket" data-delete-id='<?php echo $eticketData[$i - 1]->ticketid; ?>' ></i></div></li>  
                           <!-- \'''\' -->
                           <li><div class="view_ico"><a target="_blank" href="javascript:void(0);" onclick="return popitup('<?php echo TICKET_UPLOAD_PATH.'uploads/e_tickets/'.$eticketData[$i - 1]->ticket_file;?>')" class="view_bg"><i class=" far fa-eye"></i></a></div></li>
                        </ul>
                        </div>
                     </div>
                        

                  <?php } ?>
               </div>

<div class="button-list files_btn mt-2">
   <button type="button" class="btn btn-primary waves-effect waves-light" data-effect="wave">Cancel</button>
   <button type="button" class="btn btn-success waves-effect waves-light" data-effect="wave">Add More Files</button>
   <button type="button" class="btn btn-info waves-effect waves-light" id='validateBtn' data-effect="wave">Continue</button>
</div>

                                 </div> <!-- end card-body-->
                               </div> <!-- end card-->

                           </div>
                           <!-- <div class="col-md-2"></div> -->
                        </div>
                  
               </div>
            </div>
         </div>
      </div>
      <!-- main content End -->
<?php $this->load->view(THEME . '/common/footer'); ?>
<script>
    let  ticket_arr= [];
    
   $(document).ready(function() {
     
      $("body").on("change",".etickets",function(){     
       //  console.log(input_file); 
   	var id = $(this).attr('id');
      var dataId = $(this).attr("data-id");
      var data_ticket_id = $(this).attr("data-ticket-id");
      
   	var file = $(this)[0].files[0];
      console.log(file);
   	var formData = new FormData();
   	formData.append('eticket', file);
   	formData.append('ticketid', id);
      formData.append('data_ticket_id', data_ticket_id);
   	console.log(formData);
   	 $.ajax({
            url: '<?php echo base_url();?>game/upload_single_ticket_temp',
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
                 
                        var temp="temp";
                        $('.show_preview_file_'+dataId).html('<embed type="application/pdf" class="d-block img-fluid embed_file" src="'+data.temp_file_name+'"   style="overflow: hidden !important;" scrolling="no"/> <p class="show_file_name" id="show_file_name_'+id+'">'+data.show_file_name+'</p> ');
                        $('.ticket_action_'+dataId).html('<ul> <li><div class="remove_ico"><i class=" far fa-trash-alt delete_ticket" data-delete-id=\''+data.delete_ticket_id+'\'></i></div></li>  <li><div class="view_ico"><a target="_blank" href="javascript:void(0);" onclick="return popitup(\''+data.show_file_name+'\',\''+temp+'\')" class="view_bg"><i class="far fa-eye"></i></a></div></li></ul>');              
                        $('.ticket_action_'+id).css("display", "block");
                        $('#drag_ticket_'+id).html(data.show_file_name);
                        ticket_arr.push({id: data.show_file_name});
                      //  ticket_arr.push(data.show_file_name);
                        //
                       
                  }else if(data.status == 0) {
                     console.log('failed');
                  }
                  
            }
         });
   	});
$("#TopAirLine").owlCarousel({
 
 autoPlay: 500, //Set AutoPlay to 3 seconds

 items : 4,
 itemsDesktop : [1199,5],
 itemsDesktopSmall : [979,5],
 nav:true,
 pagination:false,
 dots: false,
 margin:10
});
$( ".owl-prev").html('<i class="fas fa-arrow-left"></i>');
$( ".owl-next").html('<i class=" fas fa-arrow-right"></i>');

$("#TopAirLine_newww").owlCarousel({
 
 autoPlay: 500, //Set AutoPlay to 3 seconds

 items : 4,
 itemsDesktop : [1199,5],
 itemsDesktopSmall : [979,5],
 nav:true,
 pagination:false,
 dots: false
});
$( ".owl-prev").html('<i class="fas fa-arrow-left"></i>');
$( ".owl-next").html('<i class=" fas fa-arrow-right"></i>');


$("#validateBtn").click(function () {

//////////////////////////////////////////


//////////////////////////////////////////



   $flag=0;
   var formData = new FormData();

   $('.show_file_name').each(function(index) {
   
      if ($(this).html() == '') {        
      // alert("Please select a file for Ticket "+(index + 1));
       swal('Updation Failed !', 'Please select a file for Ticket '+(index + 1), 'error');
       
         $flag=1;
          return false;
      }


      dropZoneId='drop-zone_'+(index + 1);
const fileInput = document.getElementById(dropZoneId).querySelector('.etickets');
 //  fileInput.files = files;
 files=fileInput.files;
    const acceptedFileTypes = ['application/pdf', 'image/jpeg', 'image/png'];

       /////////////////////////////////////////////////

    const inpt_dropZoneId = document.getElementById(dropZoneId);
      const inpt_fileInput = inpt_dropZoneId.querySelector('.etickets');

      var id = inpt_fileInput.getAttribute('id');
      var dataId = inpt_fileInput.getAttribute('data-id');
      var data_ticket_id = inpt_fileInput.getAttribute('data-ticket-id');
   
   	var file = files[0];
      //const file = files[i];
    if (!acceptedFileTypes.includes(file.type)) {
    //  alert('File type not supported. Please upload a PDF or an image (JPEG or PNG).');
      swal('Updation Failed !', 'File type not supported. Please upload a PDF or an image (JPEG or PNG).', 'error');
      $flag=1;
      return;
    }
    

   });     
      if($flag==0)
      {
     $('.etickets').each(function() {
      var id = $(this).attr('id');
      var data_id = $(this).attr('data-id');
      var data_ticket_id = $(this).attr("data-ticket-id");

            //if(ticket_arr[id-1]!="")
              //formData.append('file'+id, ticket_arr[id-1]);
             // console.log(files[0]);
             
             console.log(this);
              inpt_ticket_id=$('#show_file_name_'+id).html();
              formData.append('file'+id,inpt_ticket_id );
      });
         $.ajax({
                    url: '<?php echo base_url();?>game/save_upload_single_ticket',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (response) {
                     console.log(response.msg);
                     // console.log('Success');
                      swal('Updated !', response.msg, 'success');
                      setTimeout(window.location.reload(),200);
                    },
                    error: function () {
                       console.log('Failed');
                    }
                });
      }
});

$(".delete_ticket").click(function () {   
   var data_id = $(this).attr('data-delete-id');
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
               setTimeout(window.location.reload(),300);
         },
         error: function () {
         console.log('Failed');
         }
      });
    }   
  }, function (dismiss) {

  });

   });
   $(".drag_ticket").click(function (){
    
      let text = this.id; 
      console.log(text);
     var drag_ticket_id= text.replace("drag_ticket_", "");    
      $('#'+drag_ticket_id).trigger('click');
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

function setupDropZone(dropZoneId) {
  const dropZone = document.getElementById(dropZoneId);

  // Prevent default drag behaviors
  ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
    document.body.addEventListener(eventName, preventDefaults, false);
  });

  // Highlight drop zone when item is dragged over it
  ['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, highlight, false);
  });

  ['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, unhighlight, false);
  });

  // Handle dropped files
  dropZone.addEventListener('drop', handleDrop, false);

  function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
  }

  function highlight(e) {
    dropZone.classList.add('active');
  }

  function unhighlight(e) {
    dropZone.classList.remove('active');
  }

  function handleDrop(e) {
    const files = e.dataTransfer.files;
    const dropZoneId = e.target.id;
    handleFiles(files, dropZoneId);
  }

  function handleFiles(files, dropZoneId) {
   console.log(dropZoneId);
    const fileInput = document.getElementById(dropZoneId).querySelector('.etickets');
   // fileInput.files = files;

    const acceptedFileTypes = ['application/pdf', 'image/jpeg', 'image/png'];

       /////////////////////////////////////////////////

    const inpt_dropZoneId = document.getElementById(dropZoneId);
      const inpt_fileInput = inpt_dropZoneId.querySelector('.etickets');

      var id = inpt_fileInput.getAttribute('id');
      var dataId = inpt_fileInput.getAttribute('data-id');
      var data_ticket_id = inpt_fileInput.getAttribute('data-ticket-id');
   
   	var file = files[0];
      //const file = files[i];
    if (!acceptedFileTypes.includes(file.type)) {
    //  alert('File type not supported. Please upload a PDF or an image (JPEG or PNG).');
      swal('Updation Failed !', 'File type not supported. Please upload a PDF or an image (JPEG or PNG).', 'error');
      return;
    }
   	var formData = new FormData();
   	formData.append('eticket', file);
   	formData.append('ticketid', id);
      formData.append('data_ticket_id', data_ticket_id);
   	console.log(formData);
   	 $.ajax({
            url: '<?php echo base_url();?>game/upload_single_ticket_temp',
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
                 
                        var temp="temp";
                        $('.show_preview_file_'+dataId).html('<embed  class="d-block img-fluid embed_file" src="'+data.temp_file_name+'"   style="overflow: hidden !important;" scrolling="no"/> <p class="show_file_name">'+data.show_file_name+'</p> ');
                        $('.ticket_action_'+dataId).html('<ul> <li><div class="remove_ico"><i class=" far fa-trash-alt delete_ticket" data-delete-id=\''+data.delete_ticket_id+'\'></i></div></li>  <li><div class="view_ico"><a target="_blank" href="javascript:void(0);" onclick="return popitup(\''+data.show_file_name+'\',\''+temp+'\')" class="view_bg"><i class="far fa-eye"></i></a></div></li></ul>');              
                        $('.ticket_action_'+id).css("display", "block");
                        $('#drag_ticket_'+id).html(data.show_file_name);
                       // ticket_arr.push(data.show_file_name);
                        ticket_arr.push({id: data.show_file_name});
                        console.log(ticket_arr);
                       
                  }else if(data.status == 0) {
                     console.log('failed');
                  }
                  
            }
         });
    ////////////////////////////////////////////////
  }
}

// Call the function for each drop zone on the page
const dropZones = document.querySelectorAll('.dropzone');
dropZones.forEach(dropZone => {
  setupDropZone(dropZone.id);
});


   </script>