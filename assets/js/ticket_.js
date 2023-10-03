function filter_search(filter){

    
    var action = base_url + "tickets/index/filter_search";
    

     $.ajax({
      type: "POST",
      dataType: "json",
       url: action,
      data: {"filter":filter},
      success: function(list) {

       
       $('#search_flag').val(filter);
         $('#list_body').html("");
        $('#list_body').html(list.tickets);
        
        //$('#state').val(state_city.state);
      }
    });
}


function load_tickets(match_id=""){

   

    $.ajax({
      type: "POST",
      dataType: "json",
      url: base_url + 'tickets/index/load_tickets',
      data: {'match_id' : match_id},
      success: function(list) {

       
        $('#list_body').html("");
        $('#list_body').html(list.tickets);
        
        
        //$('#state').val(state_city.state);
      }
    })

}

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



$(document).on('click', ".ticket_save", function(e) {
    e.stopImmediatePropagation();



var ticketid        = $(this).attr("data-s_no");
var match_id        = $(this).attr("data-match");
var ticket          = $(this).attr("data-ticket");
var ticket_status   = $("#ticket-status-"+ticket).is(":checked");
var ticket_type     = $("#ticket-type-"+ticket).val();
var ticket_category = $("#ticket-category-"+ticket).val();
var ticket_block    = $("#ticket-block-"+ticket).val();
var home_down       = $("#ticket-home-down-"+ticket).val();
var ticket_row      = $("#ticket-row-"+ticket).val();
var ticket_seat     = $("#ticket-seat-"+ticket).val();
var ticket_quantity = $("#ticket-quantity-"+ticket).val();
var ticket_split    = $("#ticket-split-"+ticket).val();
var ticket_price    = $("#ticket-price-"+ticket).val();
var sell_type       = $("#sell-type-"+ticket).val();
var ticket_track    = $("#ticket-track-"+ticket).val();

var search_flag     = $("#search_flag").val();
                    $.ajax({
                        type: 'POST',
                        url: base_url + 'tickets/index/ticket_update',
                        data: {
                            'ticketid' : ticketid,
                            'match_id' : match_id,
                            'ticket'   : ticket,
                            'ticket_status'   : ticket_status,
                            'ticket_type'   : ticket_type,
                            'ticket_category'   : ticket_category,
                            'ticket_block'   : ticket_block,
                            'home_down'   : home_down,
                            'ticket_row'   : ticket_row,
                            'ticket_seat'   : ticket_seat,
                            'ticket_quantity'   : ticket_quantity,
                            'ticket_split'   : ticket_split,
                            'ticket_price' : ticket_price,
                            'sell_type' : sell_type,
                            'ticket_track' : ticket_track
                        },
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

                            if(search_flag == "listing"){
                                load_tickets(match_id);
                            }
                            else{
                                $("#match_id").val(match_id);
                                $("#filter-form").submit();
                            }
                            

                        }
                    });
});


$(document).on('click', ".save_ticket_details_btn", function(e) {
     e.stopImmediatePropagation();
     var search_flag     = $("#search_flag").val();

    var myid   = $(this).attr("data-url");
   
    var myform = $("#"+myid)[0];
    var formData = new FormData(myform);
    var action = $("#"+myid).attr('action');
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
        if(search_flag == "listing"){
        load_tickets(match_id);
        }
        else{
        $("#match_id").val(match_id);
        $("#filter-form").submit();
        }
      }
    })
    return false;
  

})
$(document).on('click', ".ticket_copy", function(e) {
    e.stopImmediatePropagation();

var ticketid   = $(this).attr("data-s_no");
var match_id   = $(this).attr("data-match");
var search_flag     = $("#search_flag").val();


                    $.ajax({
                        type: 'POST',
                        url: base_url + 'tickets/index/ticket_duplicate',
                        data: {
                            'ticketid' : ticketid,
                            'match_id' : match_id
                        },
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

                           if(search_flag == "listing"){
                                load_tickets(match_id);
                            }
                            else{
                                $("#match_id").val(match_id);
                                $("#filter-form").submit();
                            }

                        }
                    });
});
             



$(document).on('click', ".ticket_delete", function() {

var ticketid   = $(this).attr("data-s_no");
var match_id   = $(this).attr("data-match");   
var search_flag     = $("#search_flag").val();


initConfirm('Delete Ticket Alert', "Are you sure to Delete Ticket?", false, false, 'Delete','Cancel', function (closeEvent) {
 
    

                    $.ajax({
                        type: 'POST',
                        url: base_url + 'tickets/index/ticket_delete',
                        data: {
                            'ticketid' : ticketid,
                            'match_id' : match_id
                        },
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

                            if(search_flag == "listing"){
                                load_tickets(match_id);
                            }
                            else{
                                $("#match_id").val(match_id);
                                $("#filter-form").submit();
                            }

                        }
                    });
});
                });

$(document).on('change', ".ticket_category", function() {

    var match_id        = $(this).attr("data-match");
    var ticketid        = $(this).attr("data-ticket");
    var ticket_category = $(this).val();

                    $.ajax({
                        type: 'POST',
                        url: base_url + 'Tickets/get_block_by_stadium_id',
                        data: {
                            'match_id': match_id,
                            'ticketid' : ticketid,
                            'category_id': ticket_category
                        },
                        dataType: "json",
                        success: function(data) {
                           
                          //  $("#ticket-block-"+ticketid).empty().html('<option value="" selected>--Ticket Block--</option>');
                            if (data) {
                                $.each(data, function(index, item) {

                                    $("#ticket-block-"+ticketid).append('<option value="' + index + '">' + index + '</option>');

                                })

                            }
                        }
                    });

                });