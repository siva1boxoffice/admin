
var notyf = new Notyf({
	duration: 2e3,
	position: { x: "right", y: "bottom" },
	types: [
		{ type: "warning", background: themeColors.warning, icon: { className: "fas fa-hand-paper", tagName: "i", text: "" } },
		{ type: "info", background: themeColors.info, icon: { className: "fas fa-info-circle", tagName: "i", text: "" } },
		{ type: "primary", background: themeColors.primary, icon: { className: "fas fa-car-crash", tagName: "i", text: "" } },
		{ type: "accent", background: themeColors.accent, icon: { className: "fas fa-car-crash", tagName: "i", text: "" } },
		{ type: "purple", background: themeColors.purple, icon: { className: "fas fa-check", tagName: "i", text: "" } },
		{ type: "blue", background: themeColors.blue, icon: { className: "fas fa-check", tagName: "i", text: "" } },
		{ type: "green", background: themeColors.green, icon: { className: "fas fa-check", tagName: "i", text: "" } },
		{ type: "orange", background: themeColors.orange, icon: { className: "fas fa-check", tagName: "i", text: "" } },
	],
});


// $('#update_password_submit').on('click', function (e) {


$('#filter-form').validate({

  submitHandler: function(form) {
    
    var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
    var formData = new FormData(myform);

    $('#'+$(form).attr('id')+'-btn').addClass("is-loading no-click");

    $('.has-loader').addClass('has-loader-active');
    
    var action = $(form).attr('action');
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",

      success: function(list) {

        $('#search_flag').val("filter");
         $('#list_body').html("");
        $('#list_body').html(list.tickets);
         $('.close-panel').trigger("click");

      }
    })
    return false;
  }
});


$('.validate_form_v3').validate({
	  errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    },
    onfocusout: false,
    invalidHandler: function(form, validator) { 
        var errors = validator.numberOfInvalids();
        if (errors) {  // console.log(validator.errorList[0].element.focus());                 
           // validator.errorList[0].element.focus();
           var errorid = validator.errorList[0].element.getAttribute('id');
          // console.log(errorid);
            $('html, body').animate({
            scrollTop: ($('#'+errorid).offset().top)
            },500);
        }
    } ,
     rules: {
        "ticket_types[]": "required",
        "add_qty_addlist[]": "required",
        "split_type[]": "required",
        "add_price_addlist[]": "required",
        "add_pricetype_addlist[]" : "required",
        "ticket_category[]": "required",
        "home_town": "required",
        "ticket_details[]": "required",
        "add_eventname_addlist[]": "required",
    },
    messages: {
        "ticket_types[]": "Ticket Type is Required.",
        "add_qty_addlist[]": "Ticket Quantity is Required.",
        "split_type[]": "Split Type is Required.",
        "add_price_addlist[]": "Ticket Price is Required.",
        "ticket_category[]": "Ticket Category is Required.",
        "home_town": "Home/Down is Required.",
        "ticket_details[]": "Ticket Details is Required.",
        "add_pricetype_addlist[]" : "Ticket Currency is Required.",
         "add_eventname_addlist[]": "Match Event is Required."
    },
  submitHandler: function(form) {
  	
	var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
	var formData = new FormData(myform);

    $('#'+$(form).attr('id')+'-btn').addClass("is-loading no-click");

    $('.has-loader').addClass('has-loader-active');
    
	var action = $(form).attr('action');
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",

      success: function(data) { 

        $('#'+$(form).attr('id')+'-btn').removeClass("is-loading no-click");

        if(data.status == 1) {

          notyf.success(data.msg, "Success", {
          timeOut: "1800"
          });
          setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
        }else if(data.status == 0) {
           notyf.error(data.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
          
        }
      }
    })
    return false;
  }
});


$('.validate_event_form').validate({

  submitHandler: function(form) {
  
  var duplicate_check_action = $(form).attr('duplicate-check');

  var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
  var formData = new FormData(myform);

   // $('#'+$(form).attr('id')+'-btn').addClass("is-loading no-click");

   // $('.has-loader').addClass('has-loader-active');

   var action = $(form).attr('action');
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: duplicate_check_action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",

      success: function(data) {
            if(data.status == 0){

               swal({
    title: 'Events URL was used',
    text: data.msg,
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#0CC27E',
    cancelButtonColor: '#FF586B',
    confirmButtonText: 'Yes, Update it!',
    cancelButtonText: 'No, cancel!',
    confirmButtonClass: 'button h-button is-primary',
    cancelButtonClass: 'button h-button is-danger',
    buttonsStyling: false
  }).then(function (res) {

    var update_url = 0;

    if (res.value == true) {
       update_url = 1
    }
    formData.append("update_url", update_url);
    var action = $(form).attr('action');
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",

      success: function(data) { 

        if(data.status == 1) {

          notyf.success(data.msg, "Success", {
          timeOut: "1800"
          });
        }else if(data.status == 0) {
           notyf.error(data.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          
        }
      }
    })


  }, function (dismiss) {

  });


            }
            else{

var update_url = 0;
    formData.append("update_url", update_url);
var action = $(form).attr('action');
               $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",

      success: function(data) { 

        if(data.status == 1) {

          notyf.success(data.msg, "Success", {
          timeOut: "1800"
          });
        }else if(data.status == 0) {
           notyf.error(data.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          
        }
      }
    })

            }
        }
    })
    return false;
  }
});

$('.validate_form_v1').validate({
  submitHandler: function(form) {
  	
	var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
	var formData = new FormData(myform);

   // $('#'+$(form).attr('id')+'-btn').addClass("is-loading no-click");

   // $('.has-loader').addClass('has-loader-active');
    
	var action = $(form).attr('action');
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",

      success: function(data) { 

     //   $('#'+$(form).attr('id')+'-btn').removeClass("is-loading no-click");

        if(data.status == 1) {

          notyf.success(data.msg, "Success", {
          timeOut: "1800"
          });
         // setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
        }else if(data.status == 0) {
           notyf.error(data.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          //setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
          
        }
      }
    })
    return false;
  }
});


$('.validate_form_v2').validate({
  submitHandler: function(form) {
    
  var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
  var formData = new FormData(myform);

   // $('#'+$(form).attr('id')+'-btn').addClass("is-loading no-click");

   // $('.has-loader').addClass('has-loader-active');
    
  var action = $(form).attr('action');
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",

      success: function(data) { 

     //   $('#'+$(form).attr('id')+'-btn').removeClass("is-loading no-click");

        if(data.status == 1) {

          notyf.success(data.msg, "Success", {
          timeOut: "1800"
          });
          setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
        }else if(data.status == 0) {
           notyf.error(data.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
          
        }
      }
    })
    return false;
  }
});




function update_ticket_status(id,status,ticket_type){

 swal({
    title: 'Are you sure want to change E-Ticket Status ?',
    text: "Approve or Reject E-Ticket !",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#0CC27E',
    cancelButtonColor: '#FF586B',
    confirmButtonText: 'Yes, Change it!',
    cancelButtonText: 'No, cancel!',
    confirmButtonClass: 'button h-button is-primary',
    cancelButtonClass: 'button h-button is-danger',
    buttonsStyling: false
  }).then(function (res) {


    if (res.value == true) {
      var reason = "";
      if(status == 6){
       reason = prompt("Please Enter the reason for Rejection ", "Invalid File Format.");
      }
      


      $.ajax({
        url: base_url + 'game/orders/update_ticket_status',
        method: "POST",
        data : {"ticket_id" : id,"status" : status,"ticket_type" : ticket_type,"reason" : reason},
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

function update_partner_payment(bg_id,status){

  var title ="";
  if(status == 1){
    title = "Are you sure want to confirm  the paid status?";
  }
  else if(status == 0){
    title = "Are you sure want to cancel the paid status ?";
  }

 swal({
    title: title,
    text: "",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#0CC27E',
    cancelButtonColor: '#FF586B',
    confirmButtonText: 'Yes, Change it!',
    cancelButtonText: 'No, cancel!',
    confirmButtonClass: 'button h-button is-primary',
    cancelButtonClass: 'button h-button is-danger',
    buttonsStyling: false
  }).then(function (res) {

    if (res.value == true) {
      $.ajax({
        url: base_url + 'game/orders/update_payment_seller_status',
        method: "POST",
        data : {"bg_id" : bg_id,"status" : status},
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

function update_booking_status(bg_id,status){

var sendmail = $('#sendmail').is(":checked");
var mail_enable = 0;
if(sendmail == true){
 mail_enable = 1;
}
var title ="";
if(status == 1){
title = "Are you sure want to Confirm this Booking ?";
}
else if(status == 0){
title = "Are you sure want to Confirm Failed ?";
}
else if(status == 2){
title = "Are you sure want to Confirm Pending ?";
}
else if(status == 3){
title = "Are you sure want to Confirm Cancelling ?";
}
else if(status == 4){
title = "Are you sure want to Confirm Shipping ?";
}
else if(status == 5){
title = "Are you sure want to Confirm Delivering ?";
}
else if(status == 6){
title = "Are you sure want to Confirm Downloading ?";
}
else if(status == 7){
title = "Are you sure want to Confirm Failed booking ?";
}

 swal({
    title: title,
    text: "Email will go to user if status change !",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#0CC27E',
    cancelButtonColor: '#FF586B',
    confirmButtonText: 'Yes, Change it!',
    cancelButtonText: 'No, cancel!',
    confirmButtonClass: 'button h-button is-primary',
    cancelButtonClass: 'button h-button is-danger',
    buttonsStyling: false
  }).then(function (res) {


    if (res.value == true) {
      var reason = "";
      if(status == 3){
       reason = prompt("Please Enter the reason for Cancel ", "");
      }
      $.ajax({
        url: base_url + 'game/orders/update_booking_status',
        method: "POST",
        data : {"bg_id" : bg_id,"status" : status,"mail_enable" : mail_enable,"reason" : reason},
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
function delete_data(id) {


	var action = $("#branch_" + id).attr("data-href");
   

	swal({
		title: 'Are you sure?',
		text: "Are you sure want to do the changes!"   ,
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#0CC27E',
		cancelButtonColor: '#FF586B',
		confirmButtonText: 'Yes, Proceed!',
		cancelButtonText: 'No, Cancel!',
		confirmButtonClass: 'button h-button is-primary btn btn-primary ',
   cancelButtonClass: 'button h-button is-danger btn btn-danger',
		buttonsStyling: false
	}).then(function (res) {


		if (res.value == true) {

			$.ajax({
				url: action,
				method: "POST",
				dataType: 'json',
				success: function (result) {

					if (result) {

						swal('Deleted!', result.msg, 'success');

					}
					else {
						swal('Cancelled', result.msg, 'error');

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

function remove_ticket_file(action) {

  swal({
    title: 'Are you sure?',
    text: "You won't be able to remove this ticket!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#0CC27E',
    cancelButtonColor: '#FF586B',
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
    confirmButtonClass: 'button h-button is-primary',
    cancelButtonClass: 'button h-button is-danger',
    buttonsStyling: false
  }).then(function (res) {


    if (res.value == true) {

      $.ajax({
        url: action,
        method: "POST",
        dataType: 'json',
        success: function (result) {

          if (result) {

            swal('Deleted!', result.msg, 'success');

          }
          else {
            swal('Cancelled', result.msg, 'error');

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

jQuery().ready(function () {

  $('#upload_ticket').validate({

  submitHandler: function(form) { 
    
    var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
    var formData = new FormData(myform);
    
    var action = $(form).attr('action');
    $.ajax({
      type: "POST",
      url: action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",

      success: function(data) {

         if(data.status == 1) {

          notyf.success(data.msg, "Success", {
          timeOut: "1800"
          });
        }else if(data.status == 0) {
           notyf.error(data.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          
          
        }
        setTimeout(function(){ window.location.reload(); }, 2000);

      }
    })
    return false;
  }
});


	jQuery.validator.addMethod("alphas", function (value, element) {
		return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
	}, "Letters only please");
	jQuery.validator.addMethod("alphanums", function (value, element) {
		return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
	}, "Letters and numbers only please");
	jQuery("#category-form").validate({
		rules: {
			category_name: {
				required: !0,
				minlength: 2,
				alphanums: !0
			},
			status: {
				required: !0
			}
		},
		messages: {
			category_name: {
				required: "Please enter category name",
			},
			status: {
				required: "Please select status",
			},

		}
	});
	$('.form_req_validation').find('.required').each(function() {
    $(this).rules('add', {
        required: true,
        minlength: 2,
        messages: {
            required: "Required input",
            minlength: jQuery.format("At least {0} characters are necessary")
        }
    });
});



$('.validate_form_payout').validate({
  submitHandler: function(form) {
    
  var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
  var formData = new FormData(myform);

    $('#'+$(form).attr('id')+'-btn').addClass("is-loading no-click");

   // $('.has-loader').addClass('has-loader-active');
    
  var action = $(form).attr('action');
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",

      success: function(data) { 

     //   $('#'+$(form).attr('id')+'-btn').removeClass("is-loading no-click");

        if(data.status == 1) {

          notyf.success(data.msg, "Success", {
          timeOut: "1800"
          });
          setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
        }else if(data.status == 0) {
           notyf.error(data.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
          
        }
      }
    })
    return false;
  }
});




 $(".seo_status").change(function() {

  var action = $(this).attr("data-href");
  var status = $(this).is(":checked");
  var seo_status = 0;
  if(status == true){
    seo_status = 1;
  }
      $.ajax({
        url: action,
        method: "POST",
        data : {"seo_status" : seo_status},
        dataType: 'json',
        success: function (result) {

         if(result.status == 1) {

          notyf.success(result.msg, "Success", {
          timeOut: "1800"
          });
        }else if(result.status == 0) {
           notyf.error(result.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          
          
        }
        
        }
      });
  
    
});




});
