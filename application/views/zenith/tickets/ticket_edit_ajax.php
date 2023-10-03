
<style type="text/css">
  .clone-btn-listing {
    color: #0037D5;
    border: 1px solid #0037D5;
    border-radius: 0px;
    padding: 7px 40px;
    font-weight: 600;
    padding: 7px 40px;
}
</style>
<?php
$teams = explode('vs',$list_ticket->match_name);
if($teams[1] == ''){
$teams = explode('Vs',$list_ticket->match_name);
}
 $listing_notes = explode(',', $list_ticket->listing_note);
?>
 
                <form id="save_ticket_details_<?php echo $list_ticket->s_no; ?>" action="<?php echo base_url(); ?>tickets/index/ticket_update" class="save_ticket_details form-horizontal ticket_edit_form" method="post" novalidate="novalidate">
                  <input type="hidden" name="ticketid" value="<?php echo $list_ticket->s_no; ?>">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="section_left" id="content_1">

                        <div class="team_name">
                           <h3><?php echo $list_ticket->match_name; ?> - <?php echo $list_ticket->tournament_name; ?></h3>
                           <p><?php echo date('D d M Y', strtotime($list_ticket->match_date));?> <?php echo $list_ticket->match_time; ?></p>
                           <p><span><?php echo $list_ticket->stadium_name . ', ' .$list_ticket->country_name . ', ' . $list_ticket->city_name; ?></span></p>
                        </div>

                        <div class="">
                            <div class="row">
                              <div class="col-md-6"> 
                                <label>Available Tickets <span>*</span></label>
                                <div class="input-group">
                                  <input type="text" name="ticket_quantity" class="ticket_price form-control" placeholder="" aria-label="Available Tickets" aria-describedby="basic-addon2" value="<?php echo $list_ticket->quantity;?>">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label>Quantity Sold</label>
                                <div class="input-group">
                                  <input type="text" readonly class="form-control" placeholder="0" aria-label="Available Tickets" aria-describedby="basic-addon2" value="<?php echo $list_ticket->sold;?>">
                                </div>
                              </div>

                            </div>
                        </div>


                        <div class="section">
                           <div class="row">
                             <div class="col-md-6">
                               <label>Section <span>*</span></label>
                                  <select name="ticket_category" data-flag="orderinfo" data-ticket="<?php echo $list_ticket->ticketid; ?>" id="ticket-category-<?php echo $list_ticket->ticketid; ?>" data-match="<?php echo $list_ticket->match_id; ?>" class="ticket_category custom-select">
                                 <?php foreach ($tkt_categories as $tktkey => $tkt_category) {
                                 if(($list_ticket->tournament != 41 && $list_ticket->tournament != 19 && $list_ticket->tournament != 8) && ($tktkey == 13 || $tktkey == 14 || $tktkey == 15 || $tktkey == 16)) {
                        //echo $get_mtch[0]->tournament.'='.$std->category;exit;
                        continue;
                        }
                                 ?>
                                  <option value="<?php echo $tktkey; ?>" <?php if ($tktkey == $list_ticket->ticket_category) { ?> selected="selected" <?php } ?>><?php echo $tkt_category; ?></option>
                              <?php } ?>
                               </select>
                             </div>
                              <div class="col-md-6">
                               <label>Ticket Block<span>*</span></label>
                                   <select name="ticket_block" data-ticket="<?php echo $list_ticket->ticketid; ?>" id="ticket-blocks-<?php echo $list_ticket->ticketid; ?>" class="ticket_block custom-select">
                                  <option value="0" <?php if ($list_ticket->ticket_block=='') { ?> selected="selected" <?php } ?>>Any</option>
                                  <?php foreach ($blocks_data as $blkkey => $block_data) {
                                     $block = explode('-',$block_data->block_id);
                                     ?>
                                  <option value="<?php echo $block_data->id; ?>" <?php if ($block_data->id == $list_ticket->ticket_block) { ?> selected="selected" <?php } ?>><?php echo strtoupper(end($block)); ?></option>
                                  <?php } ?>
                               </select>
                             </div>
                           </div>
                        </div>



                        <div class="section">
                           <div class="row">

                             <div class="col-md-4">
                               <label>Row</label>
                              <div class="input-group">
                                <input type="text" class="form-control" placeholder="" aria-label="Available Tickets" aria-describedby="basic-addon2" name="ticket_row" data-ticket="<?php echo $list_ticket->ticketid; ?>" id="ticket-row-<?php echo $list_ticket->ticketid; ?>" value="<?php echo $list_ticket->row; ?>">
                              </div>
                             </div>
                             <div class="col-md-4">
                               <label>Home or Away ? <span>*</span></label>
                                 <select name="home_down" data-ticket="<?php echo $list_ticket->ticketid; ?>" id="ticket-home-down-<?php echo $list_ticket->ticketid; ?>" class="ticket_home_down custom-select">
                                  <option value="0" <?php if ($list_ticket->home_town == 0) { ?> selected="selected" <?php } ?>>Any</option>
                                  <option value="1" <?php if ($list_ticket->home_town == 1) { ?> selected="selected" <?php } ?>>Home</option>
                                  <option value="2" <?php if ($list_ticket->home_town == 2) { ?> selected="selected" <?php } ?>>Away</option>
                                  <option value="<?php echo $list_ticket->team1_name;?>" <?php if ($list_ticket->home_town == $list_ticket->team1_name) { ?> selected="selected" <?php } ?>><?php echo $list_ticket->team1_name;?></option>
                                  <option value="<?php echo $list_ticket->team2_name;?>" <?php if ($list_ticket->home_town == $list_ticket->team2_name) { ?> selected="selected" <?php } ?>><?php echo $list_ticket->team2_name;?></option>
                               </select>

                             </div>
                              <div class="col-md-4">
                               <label>Split type <span>*</span></label>
                                <select name="ticket_split" data-ticket="<?php echo $list_ticket->ticketid; ?>" id="ticket-split-<?php echo $list_ticket->ticketid; ?>" class="ticket_split custom-select">
                                  <?php foreach ($split_types as $split_type) { ?>
                                  <option value="<?php echo $split_type->id; ?>" <?php if ($list_ticket->split == $split_type->id) { ?> selected="selected" <?php } ?>><?php echo $split_type->name; ?></option>
                                  <?php } ?>
                               </select>

                             </div>
                          </div>
                        </div>

                        <div class="web_price">
                          <div class="row">
                            <div class="col-md-4">
                              <label>Price <span>*</span></label>

                              <div class="currency_symbol">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                   <?php if (strtoupper($list_ticket->price_type) == "GBP") { ?>
             <img src="<?php echo base_url();?>assets/img/pound.svg"></span>
               <?php } ?>
               <?php if (strtoupper($list_ticket->price_type) == "EUR") { ?>
               <img src="<?php echo base_url();?>assets/img/euro.svg"></span>
               <?php } ?>
                <?php if (strtoupper($list_ticket->price_type) == "USD") { ?>
               <img src="<?php echo base_url();?>assets/img/usd.png"></span>
               <?php } ?>
                <?php if (strtoupper($list_ticket->price_type) == "AED") { ?>
               <img src="<?php echo base_url();?>assets/img/aed.png"></span>
               <?php } ?>
             </span>
                              </div>
                              <input type="text" name="ticket_price" data-ticket="<?php echo $list_ticket->ticketid; ?>" id="ticket-price-<?php echo $list_ticket->ticketid; ?>" class="ticket_price form-control" value="<?php echo $list_ticket->price; ?>"  placeholder="900" aria-label="" aria-describedby="basic-addon1">
                            </div>
                          </div>



                            
                            </div>
                            <div class="col-md-4">
                              <label>Currency</label>
                              <select class="custom-select">
                                  <option selected value="<?php echo strtoupper($list_ticket->price_type);?>"><?php echo strtoupper($list_ticket->price_type);?></option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="select_restrictions">
                          <div class="row">
                            
                            <div class="col-md-12">
                                      
                                      <div id="general2" class="custom-accordion">
                                         <div class="card shadow-none mb-3">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseSix" aria-expanded="true"
                                              aria-controls="collapseSix">
                                              <div class="card-header py-3" id="headingSix">
                                                <h6 class="mb-0">Restrictions on Use
                                                  <i class="mdi mdi-chevron-up float-right toggle-icon fs-sm"></i>
                                                </h6>
                                              </div>
                                            </a>

                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#general2">
                                  <div class="card-body">
                                    <div class="select_option">
                                       <p><i class="fas fa-info-circle"></i> If any of the following conditions apply to your tickets, please select them from the list below. If there is a restriction on the use of your ticket not shown here, please stop listing and contact us</p>
                                         <ul class="select_detail_chk">
                                            <?php 
                                            $ticket_key = 0;
                                            foreach ($restrictions as $ticket_detail) { 
                                            ?>
                                            <li><input class="tdcheckbox ticket_label" type="checkbox" name="ticket_details[]" value="<?php echo $ticket_detail->id; ?>" <?php if (in_array($ticket_detail->id, $listing_notes)) { ?> checked <?php } ?>> <?php echo $ticket_detail->ticket_det_name; ?></li>
                                            <?php $ticket_key++;} ?>
                                          </ul>
                                        </div>
                                  </div>
                                </div>
                              </div>

                              <div class="card shadow-none mb-3">
                                <a class="collapsed" data-toggle="collapse" href="#collapseSeven" aria-expanded="true"
                                  aria-controls="collapseSeven">
                                  <div class="card-header py-3" id="headingSeven">
                                    <h6 class="mb-0">Listing Notes
                                      <i class="mdi mdi-chevron-up float-right toggle-icon fs-sm"></i>
                                    </h6>
                                  </div>
                                </a>

                                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#general2">
                                  <div class="card-body">
                                    <div class="select_option">
                                          <!-- <h6>Listing Notes</h6> -->
                                         <ul class="select_detail_chk">
                                            <?php 
                                            $ticket_key = 0;
                                            foreach ($notes as $ticket_detail) { 
                                            ?>
                                            <li><input class="tdcheckbox ticket_label" type="checkbox" name="ticket_details[]" value="<?php echo $ticket_detail->id; ?>" <?php if (in_array($ticket_detail->id, $listing_notes)) { ?> checked <?php } ?>> <?php echo $ticket_detail->ticket_det_name; ?></li>
                                            <?php $ticket_key++;} ?>
                                          </ul>
                                        </div>
                                  </div>
                                </div>
                              </div>

                               <div class="card shadow-none mb-3">
                                <a class="collapsed" data-toggle="collapse" href="#collapseSeven1" aria-expanded="true"
                                  aria-controls="collapseSeven1">
                                  <div class="card-header py-3" id="headingSeven">
                                    <h6 class="mb-0">Seating
                                      <i class="mdi mdi-chevron-up float-right toggle-icon fs-sm"></i>
                                    </h6>
                                  </div>
                                </a>

                                <div id="collapseSeven1" class="collapse" aria-labelledby="headingSeven" data-parent="#general2">
                                  <div class="card-body">
                                    <div class="select_option">
                                          <!-- <h6>Listing Notes</h6> -->
                                         <ul class="select_detail_chk">
                                            <?php 
                                            $ticket_key = 0;
                                            foreach ($split_details as $ticket_detail) { 
                                            ?>
                                            <li><input class="tdcheckbox ticket_label seat_type" type="checkbox" name="ticket_details[]" value="<?php echo $ticket_detail->id; ?>" <?php if (in_array($ticket_detail->id, $listing_notes)) { ?> checked <?php } ?>> <?php echo $ticket_detail->ticket_det_name; ?></li>
                                            <?php $ticket_key++;} ?>
                                          </ul>
                                        </div>
                                  </div>
                                </div>
                              </div>

                                      </div>
                                      </div>

                              <div class="col-md-12">
                                <div class="clone_btn">
                                  <button id="ticket_clone" data-ticket-id="<?php echo $list_ticket->s_no; ?>" type="button" class="btn clone-btn-listing ticket_clone">Clone</button>

                               <!--    <button id="main_submit"  type="submit" class="btn btn-primary save_ticket_form" form-id="save_ticket_details_<?php echo $list_ticket->s_no; ?>">Save</button> -->

                                  <button type="button" data-match="<?php echo $list_ticket->match_id; ?>" data-s_no="<?php echo $list_ticket->s_no; ?>" data-ticket="<?php echo $list_ticket->ticketid; ?>" id="ticket-delete-<?php echo $list_ticket->ticketid; ?>" class="btn btn-outline-danger ticket_delete">Delete</button>
                                </div>
                              </div>
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="section_right">
                        <div class="publish_sec">
                          <div class="content">

                             <div class="custom-control custom-switch">
                                                              <input type="checkbox" class="custom-control-input" id="customSwitch35_<?php echo $list_ticket->s_no; ?>" ticket_id="<?php echo $list_ticket->s_no; ?>"  name="ticket_status" <?php if($list_ticket->ticket_status == 1){ ?> checked="checked" <?php } ?> value="1">
                                                              <label class="custom-control-label" for="customSwitch35_<?php echo $list_ticket->s_no; ?>"><span class="align">Publish</span></label>
                                                            </div>

                      
                          </div>
                        </div>

                       <!--  <div class="active_listing">
                          <input class="tdcheckbox" type="checkbox" name=""> <span class="align">Active listing</span>
                        </div> -->

                        <div class="ticket_type">
                          <h6>Ticket Type</h6>
                          <p><?php foreach ($ticket_types as $ticket_type) { ?>
                          <?php if ($list_ticket->ticket_type == $ticket_type->id) { ?> 
                            <?php echo $ticket_type->tickettype; ?> <?php } ?>
                          <?php } ?>
                          </p> 
                          <a href="javascript:void(0);" class="expander">Change</a>
                        </div>

                        <div id="ticket_type_div" class="active_listing" style="display: none;">
                          <div class="row">
                          <div class="col-md-12">
                           <select data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-type-<?php echo $ticket->ticketid; ?>" name="ticket_type" id="ticket" class="custom-select">
                          <?php foreach ($ticket_types as $ticket_type) { ?>
                          <option value="<?php echo $ticket_type->id; ?>" <?php if ($list_ticket->ticket_type == $ticket_type->id) { ?> selected="selected" <?php } ?>><?php echo $ticket_type->tickettype; ?></option>
                          <?php } ?>
                          </select>
                        </div>
                      </div>
                        </div>
                      
                        <div class="listing_id">
                          <h6>Listing ID</h6>
                          <p><?php echo $list_ticket->ticket_group_id; ?></p>
                        </div>

                        <div class="btn_save">

                          <button id="sub_submit" type="submit" form-id="save_ticket_details_<?php echo $ticket->ticketid; ?>" class="btn btn-primary save_ticket_form">Save</button>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-cancel">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
              </form>
              
              <script type="text/javascript">
                 $(document).ready(function() {

              $('body').on("click",".ticket_label",function() { 

              var that = $(this);
              var ischecked= $(this).is(':checked');


              if(!ischecked){
              //alert('not');
              $(this).prop('checked', true);
              }else{ 
              $(this).prop('checked', false);

              }

              });

                   $('body').on("click",".select_detail_chk li",function() { 


                     if($(this).find(".seat_type").length){
                       $(".seat_type").each(function() {
             $(this).removeAttr('checked');
          });
          $(this).attr('checked','checked');
          
          }
      

        var that = $(this);
        var ischecked= $(this).find('[type=checkbox]').is(':checked');

       
         if(!ischecked){
         $(this).find('[type=checkbox]').prop('checked', true);
         }else{ 
          $(this).find('[type=checkbox]').prop('checked', false);
           
         }

    });


$(".ticket_price").on("keyup", function(evt) {
            var self = $(this);
            if (/*self.val().length == 1 || */parseInt(self.val()) <= 0) {
                 self.val('');
                $(this).focus();
                evt.preventDefault();
            }
            self.val(self.val().replace(/[^0-9\.]/g, ''));
            if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
            {
             evt.preventDefault();
            }
            });


$(".seat_type").on("change",function(){

  /*var seat_type_length  = $(".seat_type:checked").length;

  if(seat_type_length > 0){
    $(".seat_type").each(function() {
             $(this).removeAttr('checked');
          });
          $(this).attr('checked','checked');
  }*/
  /*if(seat_type_length > 0){
    $(".seat_type").attr("disabled", true);
    $(".seat_type").parents("li").css("pointer-events","none") ;
  }
  else{
    $(".seat_type").attr("disabled", false);
    $(".seat_type").parents("li").css("pointer-events","auto") ;
  }
   $(".seat_type:checked").parents("li").css("pointer-events","auto") ;
   $(".seat_type:checked").attr("disabled", false);*/
});


$('.save_ticket_details').validate({
  submitHandler: function(form) {
  

    $(".seat_error").html("");
    var quantity =  $("input[name='ticket_quantity']").val();
   // alert(quantity);
     if(quantity > 1 ){

        var seat_type = $(".seat_type:checked").length;

        if(seat_type == 0) {
       
          $(".seat_error").html("Please The Choose Seat Type");
          $(".seat_error").show();
          return false;
        }
        else if(seat_type >  1) {
       
          $(".seat_error").html("Please Choose Only One Seat Type");
          $(".seat_error").show();
          return false;
        }
      }

 // return false;
  var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
  var formData = new FormData(myform);
  
  var submit = $('#'+$(form).attr('id')).find(':submit');
  console.log($(this));
  var btnid = submit.attr('id');
  var btn_text = $('#'+btnid).text();
  $('#'+btnid).attr("disabled", true);
  $('#'+btnid).html('<i class="fa fa-spinner fa-spin" style="color:#fff;"></i>&nbsp;Please Wait ...');
  
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
        $('#'+btnid).html(btn_text);
        $('.close').trigger('click');

      setTimeout(function(){

        if(data.status == 1) {

          
          load_tickets_details(data.match_id,0);
        }else if(data.status == 0) {
          $('#'+btnid).attr("disabled", false); 
          
          setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
          
        }
        
      }, 500);

        

      }
    })
    return false;
  }
});

                $('.expander').on('click', function () {
                $('#ticket_type_div').slideToggle();
                });

                  $("#content_1").mCustomScrollbar({
                  scrollButtons:{
                  enable:true
                  }
                  });
                  });
              </script>