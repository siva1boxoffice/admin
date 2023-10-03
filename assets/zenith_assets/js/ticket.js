function filter_search(filter="",pageno=""){

    
    var action = base_url + "tickets/index/filter_search/"+pageno;
    

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


function oe_filter_search(filter="",pageno=""){

    
    var action = base_url + "tickets/index/oe_filter_search/"+pageno;
    

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

  $(".auto_disable").on("change", function(evt) {

               var match_id = $(this).attr('match-id');
               var hours = $(this).val();
                var action = base_url + "tickets/update_auto_disable/";
                $.ajax({
                type: "POST",
                dataType: "json",
                url: action,
                data: {"match_id":match_id,"auto_disable":hours},
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
                setTimeout(window.location.reload(), 100);

                }
                });

            });


function update_enquiry_status(id,status,flag){


    var action = base_url + "tickets/index/update_enquiry_status/";
    

     $.ajax({
      type: "POST",
      dataType: "json",
       url: action,
      data: {"id":id,"status":status,"flag":flag},
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
    });

}

function load_tickets_v1(match_id="",pageno="",seller_id='',last_ticket_id=''){


  
    $.ajax({
      type: "POST",
      dataType: "json",
      url: base_url + 'tickets/index/load_tickets/'+pageno+'/',
      data: {'match_id' : match_id,'seller_id' : seller_id,'last_ticket_id' : last_ticket_id},
      success: function(list) {

       
        $('#list_body').html("");
        $('#list_body').html(list.tickets);
      }
    })

}


function load_tickets(match_id="",pageno="",seller_id='',last_ticket_id=''){

  var only_ticket ="";

    if(  $("#source_type").data('id') != ""){
        only_ticket ="?only=" + $("#source_type").data('id');
    }
    $.ajax({
      type: "POST",
      dataType: "json",
      url: base_url + 'tickets/index/load_tickets/'+pageno+'/' + only_ticket,
      data: {'match_id' : match_id,'seller_id' : seller_id,'last_ticket_id' : last_ticket_id},
      success: function(list) {

       
        $('#list_body').html("");
        $('#list_body').html(list.tickets);
      }
    })

}

function load_oe_tickets(match_id="",pageno="",seller_id='',last_ticket_id=''){

  
    $.ajax({
      type: "POST",
      dataType: "json",
      url: base_url + 'tickets/index/load_oe_tickets/'+pageno+'/',
      data: {'match_id' : match_id,'seller_id' : seller_id,'last_ticket_id' : last_ticket_id},
      success: function(list) {

       
        $('#list_body').html("");
        $('#list_body').html(list.tickets);
      }
    })

}

function load_tickets_details(match_id="",pageno="",seller_id='',last_ticket_id=''){

  
   var only_ticket="";

    if(  $("#source_type").data('id') != ""){
        only_ticket ="?only=" + $("#source_type").data('id');
    }
    //alert(only_ticket);
    $.ajax({
      type: "POST",
      dataType: "json",
      url: base_url + 'tickets/index/load_tickets_details/'+pageno+'/' + only_ticket ,
      data: {'match_id' : match_id,'seller_id' : seller_id,'last_ticket_id' : last_ticket_id},
      success: function(list) {

       
        $('#list_body').html("");
        $('#list_body').html(list.tickets);
      }
    })

}


function oe_load_tickets_details(match_id="",pageno="",seller_id='',last_ticket_id=''){

  
    $.ajax({
      type: "POST",
      dataType: "json",
      url: base_url + 'tickets/index/oe_load_tickets_details/'+pageno+'/',
      data: {'match_id' : match_id,'seller_id' : seller_id,'last_ticket_id' : last_ticket_id},
      success: function(list) {

       
        $('#list_body').html("");
        $('#list_body').html(list.tickets);
      }
    })

}


function load_filter(pageno=""){

   

    var only_ticket="";

    if(  $("#source_type").data('id') != ""){
        only_ticket ="?only=" + $("#source_type").data('id');
    }
    $.ajax({
      type: "POST",
      dataType: "json",
      url: base_url + 'tickets/index/filter_tickets/'+pageno + only_ticket,
      data:  $('#filter-form').serialize(),
      success: function(list) {

       
        $('#list_body').html("");
        $('#list_body').html(list.tickets);
        
        
        //$('#state').val(state_city.state);
      }
    })

}


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

if(ticket_price == '' || ticket_price <= 0){ 
return false;
}
if(ticket_quantity == '' || ticket_quantity <= 0){ 
return false;
}

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
                        load_tickets_details(match_id,0);

                           /* if(search_flag == "listing"){
                                load_tickets(match_id);
                            }
                            else{
                                $("#match_id").val(match_id);
                                $("#filter-form").submit();
                            }*/
                            

                        }
                    });
});
 

$(document).on('click', ".oe_ticket_save", function(e) {
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

if(ticket_price == '' || ticket_price <= 0){ 
return false;
}
if(ticket_quantity == '' || ticket_quantity <= 0){ 
return false;
}

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
                        oe_load_tickets_details(match_id,0);

                           /* if(search_flag == "listing"){
                                load_tickets(match_id);
                            }
                            else{
                                $("#match_id").val(match_id);
                                $("#filter-form").submit();
                            }*/
                            

                        }
                    });
});


$(document).on('change', ".all_ticket_status", function(e) {
 e.stopImmediatePropagation();
var ticket_status   = $(this).is(":checked");
var flag = $(this).attr("data-flag");

                    $.ajax({
                        type: 'POST',
                        url: base_url + 'tickets/index/ticket_update_status',
                        data: {
                            'match_id' : $(this).attr("match-id"),
                            'ticket_status'   : ticket_status,
                            'flag' : flag
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
                        if(data.flag == 'details'){
                        load_tickets_details(data.match_id,0);
                        }
                        

                         //load_tickets();

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

         $('.notes_cancel').trigger('click');
        if(data.status == 1) {

          notyf.success(data.msg, "Success", {
          timeOut: "1800"
          });
        }else if(data.status == 0) {
           notyf.error(data.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          
        }
        load_tickets_details(data.match_id,0);
        /*if(search_flag == "listing"){
        load_tickets(match_id);
        }
        else{
        $("#match_id").val(match_id);
        $("#filter-form").submit();
        }*/

      }
    })
    return false;
  

})

$(document).on('click', ".oe_save_ticket_details_btn", function(e) {
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

         $('.notes_cancel').trigger('click');
        if(data.status == 1) {

          notyf.success(data.msg, "Success", {
          timeOut: "1800"
          });
        }else if(data.status == 0) {
           notyf.error(data.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          
        }
        oe_load_tickets_details(data.match_id,0);
        /*if(search_flag == "listing"){
        load_tickets(match_id);
        }
        else{
        $("#match_id").val(match_id);
        $("#filter-form").submit();
        }*/

      }
    })
    return false;
  

})


$(document).on('click', ".save_mass_duplicates", function(e) {
     e.stopImmediatePropagation();
     
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

         $('.notes_cancel').trigger('click');
        if(data.status == 1) {

          notyf.success(data.msg, "Success", {
          timeOut: "1800"
          });
        }else if(data.status == 0) {
           notyf.error(data.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          
        }
        load_tickets_details(data.match_id,0,'',data.ticket_last_id);
        /*if(search_flag == "listing"){
        load_tickets(match_id);
        }
        else{
        $("#match_id").val(match_id);
        $("#filter-form").submit();
        }*/

      }
    })
    return false;
  

})

$(document).on('click', ".oe_save_mass_duplicates", function(e) {
     e.stopImmediatePropagation();
     
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

         $('.notes_cancel').trigger('click');
        if(data.status == 1) {

          notyf.success(data.msg, "Success", {
          timeOut: "1800"
          });
        }else if(data.status == 0) {
           notyf.error(data.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          
        }
        oe_load_tickets_details(data.match_id,0,'',data.ticket_last_id);
        /*if(search_flag == "listing"){
        load_tickets(match_id);
        }
        else{
        $("#match_id").val(match_id);
        $("#filter-form").submit();
        }*/

      }
    })
    return false;
  

})


$(document).on('click', ".mass_duplicate", function(e) {
    e.stopImmediatePropagation();
    var ticketid   = $(this).attr("data-s_no");
    var match_id   = $(this).attr("data-match");
    $("#duplication_part").html('<span class="text-center loading_img"><img src="'+base_url +'assets/img/loader.gif" width="50px" alt="Loading..." ></span>');
    

     $.ajax({
                        type: 'POST',
                        url: base_url + 'tickets/index/mass_duplicate',
                        data: {
                            'ticketid' : ticketid,
                            'match_id' : match_id
                        },
                        dataType: "json",
                        success: function(data) {
                            $("#duplication_part").html(data.tickets);
                        }
                    });
})

$(document).on('click', ".oe_mass_duplicate", function(e) {
    e.stopImmediatePropagation();
    var ticketid   = $(this).attr("data-s_no");
    var match_id   = $(this).attr("data-match");
    $("#duplication_part").html('<span class="text-center loading_img"><img src="'+base_url +'assets/img/loader.gif" width="50px" alt="Loading..." ></span>');
    

     $.ajax({
                        type: 'POST',
                        url: base_url + 'tickets/index/oe_mass_duplicate',
                        data: {
                            'ticketid' : ticketid,
                            'match_id' : match_id
                        },
                        dataType: "json",
                        success: function(data) {
                            $("#duplication_part").html(data.tickets);
                        }
                    });
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
                           // console.log(data);
                        if(data.status == 1) {

                        notyf.success(data.msg, "Success", {
                        timeOut: "1800"
                        });
                        }else if(data.status == 0) {
                        notyf.error(data.msg, "Failed", "Oops!", {
                        timeOut: "1800"
                        });
                        } 
                        load_tickets_details(match_id,0,'',data.ticket_last_id);

                         

                        }
                    });
});
             

$(document).on('click', ".oe_ticket_copy", function(e) {
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
                           // console.log(data);
                        if(data.status == 1) {

                        notyf.success(data.msg, "Success", {
                        timeOut: "1800"
                        });
                        }else if(data.status == 0) {
                        notyf.error(data.msg, "Failed", "Oops!", {
                        timeOut: "1800"
                        });
                        } 
                        oe_load_tickets_details(match_id,0,'',data.ticket_last_id);

                         

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
                             load_tickets_details(match_id,0);
                            /*if(search_flag == "listing"){
                                load_tickets(match_id);
                            }
                            else{
                                $("#match_id").val(match_id);
                                $("#filter-form").submit();
                            }*/

                        }
                    });
});
                });


$(document).on('click', ".oe_ticket_delete", function() {

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
                             oe_load_tickets_details(match_id,0);
                            /*if(search_flag == "listing"){
                                load_tickets(match_id);
                            }
                            else{
                                $("#match_id").val(match_id);
                                $("#filter-form").submit();
                            }*/

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
