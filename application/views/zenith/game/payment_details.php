<style>
	.view_bg{
	color: #ffffff !important;
	}
</style>
<?php $this->load->view(THEME.'/common/header'); ?>

 <!-- Begin main content -->
 <div class="main-content">
		 <!-- content -->
		 <div class="page-content">
			<!-- page header -->
			<div class="page-title-box">
			   <div class="container-fluid">
				  <div class="page-title dflex-between-center side_arrow">
					 <h3 class="mb-1"> <div class="go_back_btn"><a href="<?php
					 // echo base_url();
					 echo $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
					  
					  ?>"><i class="fas fa-arrow-left"></i></a></div>Payment Info</h3>
					 
				  </div>
			   </div>
			</div>
			<!-- page content -->
			<div class="page-content-wrapper mt--45 order_info">
			   <div class="container-fluid">
				  <div class="row">
					 <div class="col-md-12 col-lg-12">
						<div class="card card-body">
						   <!-- <div class="col-md-12 col-lg-12">
							  <h4>Order Info</h4>
						   </div> -->
						   <div class="table-responsive">
							  <table class="table table-hover table-nowrap mb-0 form-drp-btn">
								 <thead class="thead-light">
									<tr>
									   <th class="fs-16">Order ID</th>
									   <th class="fs-16">Confirmation ID</th>
									   <th class="fs-16">Order Status</th>
									   <th class="fs-16">Order Date And Time</th>									
									</tr>
								 </thead>
								 <tbody>								   
								 <td data-label="Order:">
									<span class="order_id"><?php echo $booking_no='<a href="'.base_url()."game/orders/details/". md5($orderData->booking_no).'">#'.$orderData->booking_no.'</a>'; ?></a></span>
									
								 </td>
									<td><span class="order_id">#<?php echo $orderData->booking_confirmation_no; ?></a></span></td>
									
									<td data-label="Order:">
									<select name="seller_status" id="seller_status" class="custom-select" required="false">
										<option value="">-Selec Status-</option>
										<option <?php if ($orderData->booking_status == 1) { ?> selected <?php } ?> value="1">Confirmed</option>
										<option <?php if ($orderData->booking_status == 2) { ?> selected <?php } ?> value="2">Pending</option>
										<option <?php if ($orderData->booking_status == 3) { ?> selected <?php } ?> value="3">Cancelled</option>
										<option <?php if ($orderData->booking_status == 4) { ?> selected <?php } ?> value="4">Shipped</option>
										<option <?php if ($orderData->booking_status == 5) { ?> selected <?php } ?> value="5">Delivered</option>
										<option <?php if ($orderData->booking_status == 6) { ?> selected <?php } ?> value="5">Downloaded</option>
										<option <?php if ($orderData->booking_status == 7) { ?> selected <?php } ?> value="5">Payment Not Initiated</option>
										<option <?php if ($orderData->booking_status == 0) { ?> selected <?php } ?> value="5">Failed</option>
									</select>
									</td>
									<td> <?php echo date("D j F Y", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $orderData->payment_date))) . ' ' . @$_COOKIE["time_zone"];
										  ?></span><br>
										  <span class="tr_date">
										  <!-- <i class="fas fa-clock"></i>--><?php echo date("H:i", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $orderData->payment_date)));
										  ?></td>
								 </tbody>
							  </table>
						   </div>                  
						</div>
					 </div>

					 <div class="col-md-9 col-lg-12">
						<div class="card">
						   <div class="card-body">
							  <h3>Payment  Information</h3>
							  <div class="row">								 
								 <div class="col-md-12">
									  <h4><?php echo $orderData->match_name; ?></h4>
									  <p style="color:#a2a5b9;">
										<span>
											<?php echo $orderData->stadium_name . ',' . $orderData->stadium_city_name . ',' . $orderData->stadium_country_name; ?>
										</span>
									  </p>
									  <p>
										<span class="tr_date"><?php echo date('d F Y', strtotime($orderData->match_date)); ?> </span> &nbsp; <span class="tr_date"><?php echo $orderData->match_time; ?></span>
									  </p>
									  <table style="width:100%;" class="blk_sect">
										 <tbody>
											<tr>
											   <td>Customer Name:</td>
											   <td>
											   <?php echo $orderData->customer_first_name ; ?> <?php echo $orderData->customer_last_name ;
											   ?></td>
											 </tr>
											 <tr>
											   <td>Billing Name:</td>
											   <td><?php echo $orderData->title ; ?> <?php echo $orderData->first_name ; ?> <?php echo $orderData->last_name ; ?></td>
											 </tr>
											 <tr>
											   <td>Billing Contact:</td>
											   <td>
											   <?php echo $orderData->dialing_code ; ?> <?php echo $orderData->mobile_no ; ?> / <?php echo $orderData->email ; ?>
											   </td>
											 </tr>
											 <tr>
											   <td>Billing Address:</td>
											   <td><?php echo $orderData->address ; ?>,<?php echo $orderData->city_name ; ?>,<?php echo $orderData->country_name ; ?>, <?php echo $orderData->postal_code ; ?></td>
											 </tr>
											 <tr>
											   <td>Payment Status:</td>
											   <td>													
											   <?php
															if ($orderData->payment_status == 0) {
																echo "Failed";
															}
															if ($orderData->payment_status == 1) {
																echo "Success";
															}
															if ($orderData->payment_status == 2) {
																echo "Pending";
															}
															?>
												</td>
											 </tr>

											 <tr>
											   <td>Transaction ID:</td>
											   <td>													
											   <?php echo $orderData->transcation_id ; ?>
												</td>
											 </tr>
											 <tr>
											   <td>Transaction Amount:</td>
											   <td>													
											   <?php if (strtoupper($orderData->currency_type) == "GBP") { ?>
												£
															<?php } ?>
												<?php if (strtoupper($orderData->currency_type) == "EUR") { ?>
													€
												<?php } 
													if (strtoupper($orderData->currency_type) != "GBP" && strtoupper($orderData->currency_type) != "EUR"){
												 echo strtoupper($orderData->currency_type); 
												}
												?><?php echo $orderData->total_payment//.' '.$orderData->currency_type; ?>
												</td>
											 </tr>
											 <tr>
											   <td>Payment Date & Time:</td>
											   <td>													
											   <?php echo date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$orderData->payment_date))).' '.@$_COOKIE["time_zone"];?>
												</td>
											 </tr>

											 <tr>
											   <td>Paymented IP:</td>
											   <td>													
											   <?php echo $orderData->ip_address ; ?>
												</td>
											 </tr>

											 <tr>
											   <td>Response Logs:</td>
											   <td>													
											   <textarea class="form-control" style="height:130px;" id="exampleFormControlTextarea1" rows="13"><?php echo $orderData->payment_response ; ?></textarea>
												</td>
											 </tr>

											 <tr>
											   <td>Booking Logs:</td>
											   <td>													
											   <a target="_blank" href="https://1boxoffice.com/storage/booking_logs/<?php echo $orderData->booking_no ; ?>/<?php echo $orderData->booking_no; ?>.txt">View Booking Logs</a>
												</td>
											 </tr>

										 </tbody>
									  </table>									  
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
<!-- main content End -->
<?php $this->load->view(THEME.'/common/footer'); ?>

<script>

$(document).ready(function() {

	//const datepicker = document.getElementById('MyTextbox2');
	const datepicker = document.getElementsByClassName('attendee_date');
	$(datepicker).datepicker({
          dateFormat: 'dd-mm-yy' 
      }
      );


	$('#contact_number').keypress(function(event) {
    var keyCode = event.which;
    
    // Allow only numbers (0-9) or specific control keys (e.g., backspace, delete)
    if (keyCode < 48 || keyCode > 57) {
      event.preventDefault(); // Prevent the input of non-numeric characters
    }
  });

	$('#mobile-icon').click(function() {

				var contact_number = $('#contact_number').val(); // Get the value of the textbox
				if(contact_number=="")
				{	
					swal('Error!', "Contact Number Cannot be empty.", 'error');
					return false;
				}
				var ticket_id='<?php echo md5($orderData->bg_id); ?>';
							swal({
						title: 'Are you sure you want to save this Contact Number.',
						text: "Yes or No",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#0CC27E',
						cancelButtonColor: '#FF586B',
						confirmButtonText: 'Yes',
						cancelButtonText: 'No',
						confirmButtonClass: 'button h-button is-primary btn btn-primary ',
						cancelButtonClass: 'button h-button is-danger btn btn-danger',
						buttonsStyling: false
					}).then(function (res) {


				if (res.value == true) {    
							$.ajax({
						url: '<?php echo base_url();?>game/save_delivery_information ',
						type: 'POST',
						dataType: "json",
						data: {  contact_number: contact_number ,ticket_id:ticket_id  },
						success: function (response) {               
							
							// 
								if(response.status==0)
								{
									swal('Updation Failed !', response.msg, 'error');
								}
								else
								{
									swal('Updated !', response.msg, 'success');
								}
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

//
$('#emailIcon, #emailIcon_need_to_receive').click(function() {

    var Email = $('#email_address').val(); // Get the value of the textbox
	var email_status= '<?php echo $orderData->ticket_email_status == 1 ? "Resend" : "Send"; ?>';
	var ticket_id='<?php echo md5($orderData->bg_id); ?>';
	if(Email=="")
				{	
					swal('Error!', "Emai ID Cannot be empty.", 'error');
					return false;
				}
					swal({
						title: 'Are you sure you want to '+email_status+' a email ?',
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
						url: '<?php echo base_url();?>game/send_email',
						type: 'POST',
						dataType: "json",
						data: {  email: Email ,ticket_id:ticket_id  },
						success: function (response) {               
							
							// 
								if(response.status==0)
								{
									swal('Updation Failed !', response.msg, 'error');
								}
								else
								{
									swal('Updated !', response.msg, 'success');
								}
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

  $(".owl-prev").html('<i class="fas fa-arrow-left"></i>');
  $( ".owl-next").html('<i class=" fas fa-arrow-right"></i>');

  $(".delete_ticket").click(function () {
var data_id = $(this).attr('data-delete-id');
   swal({
			title: 'Are you sure you want to delete this ticket?',
		    text: "Yes or No",
		    type: 'warning',
		    showCancelButton: true,
		    confirmButtonColor: '#0CC27E',
		    cancelButtonColor: '#FF586B',
		    confirmButtonText: 'Yes',
		    cancelButtonText: 'No',
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



   $(".delete_ticket_instruction").click(function () {
var data_id = $(this).attr('data-delete-id');
   swal({
			title: 'Are you sure you want to delete this Uploaded Instructions?',
		    text: "Yes or No",
		    type: 'warning',
		    showCancelButton: true,
		    confirmButtonColor: '#0CC27E',
		    cancelButtonColor: '#FF586B',
		    confirmButtonText: 'Yes',
		    cancelButtonText: 'No',
		    confirmButtonClass: 'button h-button is-primary btn btn-primary ',
            cancelButtonClass: 'button h-button is-danger btn btn-danger',
		    buttonsStyling: false
		  }).then(function (res) {


    if (res.value == true) {    
		$.ajax({
         url: '<?php echo base_url();?>game/delete_uploaded_instructions',
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

});
//$(document).ready(function() {
//$( ".owl-prev").html('<i class="fas fa-arrow-left"></i>');
 //$( ".owl-next").html('<i class=" fas fa-arrow-right"></i>');

 $("#TopAirLine_new").owlCarousel({
 
 autoPlay: 500, //Set AutoPlay to 3 seconds

 items : 2,
 itemsDesktop : [1199,2],
 itemsDesktopSmall : [979,2],
 nav:true,
 pagination:false,
 dots: false
});
//});

	function copy_data(id){
	 var copyText = document.getElementById(id);
	 var textArea = document.createElement("textarea");
	textArea.value = copyText.textContent;
	document.body.appendChild(textArea);
	textArea.select();
	document.execCommand("Copy");
	textArea.remove();
	alert("Copied Successfully.");

	}

		function resend_email(id,status,ticket_type){

		 swal({
		    title: 'Are you sure you want to resend a email ?',
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
       var email = $("#email_address").val();
      $.ajax({
		url: '<?php echo base_url();?>game/send_email',
        method: "POST",
        data : {"ticket_id" : id,"status" : status,"ticket_type" : ticket_type,"email" : email},
        dataType: 'json',
        success: function (result) {

           if (result) {

            swal('Updated !', result.msg, 'success');

          }
          else {
            swal('Updation Failed !', result.msg, 'error');

          }

          setTimeout(function () { window.location.reload(); }, 2000);
        }
      });
    }
    else {

    }



  }, function (dismiss) {

  });

}

$('#seller_order_status').on('click',function (e){
	e.preventDefault();
		var bg_id = "<?php echo $orderData->bg_id; ?>";
		var seller_status = $("#seller_status option:selected").val();

		$.ajax({
			url: base_url + 'game/orders/update_seller_status',
			method: "POST",
			data: { "bg_id": bg_id, "seller_status": seller_status },
			dataType: 'json',
			success: function (result) {

				if (result) {

					swal('Updated !', result.msg, 'success');

				}
				else {
					swal('Updation Failed !', result.msg, 'error');

				}

				setTimeout(function () { window.location.reload(); }, 2000);
			}
		});


	});


	//$('.ticket-instruction').on('change', function() {
	$('.ticket-instruction').on('change', function() {
    var file_data = $('.ticket-instruction').prop('files')[0];
    var allowed_types = ['application/pdf', 'image/jpeg', 'image/png'];
    if (allowed_types.indexOf(file_data.type) === -1) {
      alert('File type not allowed. Please select a PDF, JPEG, or PNG file.');
      return;
    }
	// const inpt_fileInput = inpt_dropZoneId.querySelector('.etickets');

    //   var id = inpt_fileInput.getAttribute('id');
	
	var booking_id = $(this).attr('data-id');
	//var booking_id_param= booking_id.replace("1BX", "");   
	//var booking_id = inpt_fileInput.getAttribute('id');

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
        console.log(response);
		swal('Updated !', response.msg, 'success');
                      setTimeout(window.location.reload(),200);
      },
      error: function(xhr, status, error) {
        // Handle the error
        console.log(error);
      }
    });
  });
  


	$('#savenominee').on('click',function (e){
		e.preventDefault();
		var valid = true;
		$('#nomaini input[type=text], input[type=email]').each(function() {
			console.log(this.type);
		if (!$(this).val()) {
			$(this).addClass('is-invalid');
			valid = false;
		} 
		else if (this.type=="email" )
		{
			var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!regex.test($(this).val())) {
				$(this).addClass('is-invalid');
				valid = false;
			}
			else {
				$(this).removeClass('is-invalid');
			}
		}
		else {
			$(this).removeClass('is-invalid');
		}
		});
		
		if (!valid) {
		return;
		}

		var formData = $('#nomaini').serialize();

		$.ajax({
			url: base_url + 'game/saveNominee',
			method: "POST",
			data: formData,
			dataType: 'json',
			success: function (result) {

				if (result) {

					swal('Updated !', result.msg, 'success');

				}
				else {
					swal('Updation Failed !', result.msg, 'error');

				}

				setTimeout(function () { window.location.reload(); }, 2000);
			}
		});


	});

	function upload_ticket(id)
	{
		
		var url='<?php echo base_url()."/game/orders/upload_e_ticket/";?>'+id; 
			window.open(url,"_self");
	}

	function popitup(url,temp='')
   {
      if(temp!="")
            var url='<?php echo base_url()."/uploads/e_tickets/temp/";?>'+url; 

      newwindow=window.open(url,'name','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,,height=500,width=700');

      if (window.focus) {newwindow.focus()}
      return false;
   }
	</script>
