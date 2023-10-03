<?php 
 //$min_price =0; $max_price =0; $total_qty =0; $total_sold =0; $final_status =0;
//if (!empty($tickets)) {
   $min_price = min(array_column($tickets, 'price'));
   $max_price = max(array_column($tickets, 'price'));
   $total_qty = array_sum(array_column($tickets,'quantity'));
   $total_sold = array_sum(array_column($tickets,'sold'));   
   $final_status = array_sum(array_column($tickets,'status'));
//} 

foreach ($listings as $list_ticket) {
   $tkt_category_arr = $list_ticket->tkt_category;
   $teams = explode('vs', $list_ticket->match_name);
   if ($teams[1] == '') {
      $teams = explode('Vs', $list_ticket->match_name);
   }

   $input = $list_ticket->match_name;
      $vsPosition = stripos($input, "vs"); // Find the position of "vs" case-insensitive
      if ($vsPosition === false) {
         $vsPosition = stripos($input, "Vs"); // Find the position of "Vs" case-insensitive
      }
      if ($vsPosition !== false) {
         $team1 = trim(substr($input, 0, $vsPosition));
         $team2 = trim(substr($input, $vsPosition + 2));
         $match_name = $team1 . " Vs <br/>". $team2;
      } else {
         $match_name = $input;
      }

      $encode_id = base64_encode(json_encode($list_ticket->match_id));
    //  $match_time="22 January 2023<br/>".date('H:i A',strtotime($list_ticket->match_time));	
      $event='<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.'</a>';
      $stadium_name='<a href="'.base_url().'game/stadium/get_stadium/'.$list_ticket->s_id.'" >'.$list_ticket->stadium_name.'</a>';
      $tournament_name='<a href="'.base_url().'settings/tournaments/edit/'.$list_ticket->tournament_id.'" >'.$list_ticket->tournament_name.'</a>';// settings/tournaments/edit/50
      $match_time=date('j F Y',strtotime($list_ticket->match_date))."<br/>".date('H:i',strtotime($list_ticket->match_time));
   ?>
   <tr class="nested">
      <td>
         <div class="custom-control custom-switch">
            <input type="checkbox" match-id="<?php echo $list_ticket->m_id; ?>" class="custom-control-input all_ticket_status_detail" id="customSwitch1" name="all_ticket_status" <?php if ($final_status >= 1) { ?> checked="checked" <?php } ?> value="1" data-flag="details" data-match="<?php echo $list_ticket->m_id; ?>">
            <label class="custom-control-label" for="customSwitch1"></label>
         </div>
      </td>
      <td><?php echo $match_time; ?></td>
      <td><?php echo $event; ?></td>
      <td><?php echo $tournament_name; ?></td>
      <td><?php echo $stadium_name; ?></td>
      <td><?php echo $list_ticket->city_name; ?></td>
      <td><?php echo $list_ticket->country_name; ?></td>
      <td><?php echo $total_qty; ?></td>
      <td><?php echo $total_sold; ?></td>
      <td><?php echo $min_price." - ".$max_price; ?></td>
      <td><i class="mdi mdi-chevron-down float-right toggle-icon fs-md"></i></td>
   </tr>

   <?php foreach ($tickets as $ticket) {
     
    $listing_notes = explode(',', $ticket->listing_note);   
    $comaring_tickets = $this->General_Model->get_tickets_v1($ticket->s_no,$ticket->match_id,$ticket->ticket_category)->result();
      // Generate the nested table rows for each ticket
      ?>
       
      <tr class="nested">
                  <td colspan="12" class="pl-0 pr-0 pt-0 pb-0">
                     <table class="nest_tab">                     
                        <tbody>                        
                           <!-- Table rows for ticket details -->
                           <tr>
                              <th>Active</th>
                              <th>ID</th>
                              <th>Ticket Type</th>
                              <th>Section</th>
                              <th>Block</th>
                              <th>Home / Away</th>
                              <th>Row</th>
                              <th>QTY</th>
                              <th>Split Type</th>
                              <th>Price</th>
                           </tr>
                           <tr>                          
                              <!-- Table data for ticket details -->
                              <td>
                                 <div class="custom-control custom-switch">
                                    <!-- <input type="checkbox" class="custom-control-input" id="customSwitch"> -->
                                    <input type="checkbox"  data-s_no="<?php echo $ticket->s_no; ?>"  data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket_status_details_<?php echo $ticket->ticketid; ?>" class="custom-control-input ticket_status_details_<?php echo $ticket->ticketid; ?> ticket_status_details" name="status" <?php if ($ticket->status == 1) { ?> checked="checked" <?php } ?> value="1" data-match="<?php echo $ticket->match_id; ?>">
                                    <label class="custom-control-label" for="ticket_status_details_<?= $ticket->ticketid ?>"></label>
                                 </div>
                              </td>
                              <td data-priority="1">
                                 <span class="bg_clr_id">
                                    <?= $ticket->ticketid ?><br>(Seller:
                                    <?= $ticket->admin_name . " " . $ticket->admin_last_name ?>)
                                 </span>
                              </td>
                              <td class="widd_150">
                                 <div class="form-group">
                                    <select data-ticket="<?= $ticket->ticketid ?>" id="ticket-type-<?= $ticket->ticketid ?>"
                                       class="custom-select" name="ticket_type">
                                       <?php foreach ($ticket_types as $ticket_type): ?>
                                          <option value="<?= $ticket_type->id ?>" <?= $ticket->ticket_type == $ticket_type->id ? 'selected="selected"' : '' ?>>
                                             <?= $ticket_type->tickettype ?>
                                          </option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </td>
                              <td class="widd_200">
                                 <div class="form-group">
                                    <select name="ticket_category" class="custom-select ticket_category" data-ticket="<?= $ticket->ticketid ?>"
                                       id="ticket-category-<?= $ticket->ticketid ?>" data-match="<?= $ticket->match_id ?>">
                                       <?php foreach ($tkt_category_arr as $tktkey => $tkt_category): ?>
                                          <option value="<?= $tktkey ?>" <?= $ticket->ticket_category == $tktkey ? 'selected="selected"' : '' ?>>
                                             <?= $tkt_category ?>
                                          </option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </td>
                              <td class="widd_150">
                                 <div class="form-group">
                                    <select name="ticket_block" class="custom-select" data-ticket="<?= $ticket->ticketid ?>"
                                       id="ticket-block-<?= $ticket->ticketid ?>">
                                       <option value="0" <?php if ($ticket->ticket_block=='') { ?> selected="selected" <?php } ?>>Any</option>
                                       <?php

                                       $ticket_data = $this->Tickets_Model->getListing_v4($ticket->ticketid);
                                       $condition['stadium_id'] = $ticket_data->venue;
                                       $condition['category'] = $ticket_data->ticket_category;
                                       $blocks_data = $this->General_Model->getAllItemTable('stadium_details', $condition)->result();
                                       
                                       foreach ($blocks_data as $blkkey => $block_data):
                                          $block = explode('-', $block_data->block_id);
                                          ?>
                                          <option value="<?= $block_data->id ?>" <?= $block_data->id == $ticket->ticket_block ? 'selected="selected"' : '' ?>>
                                          <?php echo strtoupper(end($block)); ?>
                                          </option>
                                       <?php endforeach; ?>
                                    </select>

                                 </div>
                              </td>
                              <td class="widd_100" data-label="Home/Away">
                                 <div class="form-group">
                                    <select name="home_town" class="custom-select" data-ticket="<?= $ticket->ticketid ?>"
                                       id="ticket-home-down-<?= $ticket->ticketid ?>">

                                       <option value="0" <?php if ($ticket->home_town == 0) { ?> selected="selected" <?php } ?>>Any</option>
                                       <option value="1" <?php if ($ticket->home_town == 1) { ?> selected="selected" <?php } ?>>Home</option>
                                       <option value="2" <?php if ($ticket->home_town == 2) { ?> selected="selected" <?php } ?>>Away</option>
                                       <option value="<?php echo $teams[0];?>" <?php if ($ticket->home_town == $teams[0]) { ?> selected="selected" <?php } ?>><?php echo $teams[0];?></option>
                                       <option value="<?php echo $teams[1];?>" <?php if ($ticket->home_town == $teams[1]) { ?> selected="selected" <?php } ?>><?php echo $teams[1];?></option>


                                    </select>
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input type="text" name="row" id="ticket-row-<?php echo $ticket->ticketid; ?>"  class="form-control1" value="<?= $ticket->row ?>">
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input type="text" name="quantity" id="ticket-quantity-<?php echo $ticket->ticketid; ?>" class="form-control1" value="<?= $ticket->quantity ?>">
                                 </div>
                              </td>
                              <td class="widd_200">
                                 <div class="form-group">
                                    <select name="split" class="custom-select" data-ticket="<?= $ticket->ticketid ?>"
                                       id="ticket-split-<?= $ticket->ticketid ?>">
                                       <?php foreach ($split_types as $split_type): ?>
                                          <option value="<?= $split_type->id ?>" <?= $ticket->split == $split_type->id ? 'selected="selected"' : '' ?>>
                                             <?= $split_type->name ?>
                                          </option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </td>
                              <td class="widd_150">
                                 <div class="form-group">
                                    <input type="text" id="ticket-price-<?php echo $ticket->ticketid; ?>" class="form-control" value="<?= $ticket->price ?>">
                                 </div>
                              </td>

                           </tr>
                           <!-- Table rows for additional options -->
                           <tr>
                                 <td colspan="12" class="pl-0 pt-0">
                                    <div class="img_icon" style="float: left;">
                                    </div>
                                    <div class="all_btns" style="float: right;">
                                       <div class="button-list">
                                       <!-- <button type="button" class="btn btn-light btn-compare_active" id="ticket-compare-<?php //echo $ticket->ticketid; ?>">Compare</button> -->
                                       <div class="btn compare_btn">
                                          <div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle compare_bttns" data-toggle="dropdown" id="ticket-compare-<?php echo $ticket->ticketid; ?>">
      Compare
    </button>
    <div class="dropdown-menu">
         <p><span class="compare_price">Ticket Price :  <?php if (strtoupper($ticket->price_type) == "GBP") { ?>
                                                         £
                                                         <?php } ?>
                                                         <?php if (strtoupper($ticket->price_type) == "EUR") { ?>
                                                         €
                                                         <?php } ?> <?php echo $ticket->price; ?></span></p>

                                                   <table>
                                                      <tbody>
                                                      <?php if(isset($comaring_tickets[0])){
                                                   foreach($comaring_tickets as $comaring_ticket){
                                                ?>
                                                         <tr>
                                                         <th><span class="list_head">Other Listed Tickets</span></th>
                                                         <th>&nbsp;</th>
                                                         </tr>
                                                         <tr>
                                                         <th><?php echo $comaring_ticket->seat_category;?></th>
                                                         <td>
                                                         <span>
                                                               <?php if (strtoupper($comaring_ticket->price_type) == "GBP") { ?>
                                                               <i class="fas fa-pound-sign"></i>
                                                               <?php } ?>
                                                               <?php if (strtoupper($comaring_ticket->price_type) == "EUR") { ?>
                                                               <i class="fas fa-euro-sign"></i>
                                                               <?php } ?>
                                                                  <?php echo $comaring_ticket->price;?> × <?php echo $comaring_ticket->quantity;?>
                                                         </span>
                                                         </td>
                                                         </tr>
                                                         
                                                         <?php } } else{ ?>
                                    <tr>
                                   <th> <span class="list_head">No List to Compare.</span></th>
                                    </tr>
                                   <?php } ?>
                                                      </tbody>
                                                   </table>
    </div>
  </div>







                                          <!-- <div class="dropdown">
                                             <button type="button" class=" btn-light btn-compare_active" id="ticket-compare-<?php echo $ticket->ticketid; ?>">Compare</button>
                                             <div class="dropdown-content">
                                               
                                             
                                             </div>
                                          </div> -->
                                       </div>

                                             <button type="button" class="btn btn-light btn-compare h-modal-trigger seller_note_btn" data-toggle="tooltip" data-placement="top" title="Seller Notes" data-modal="modal" data-bs-target="#bs-example-modal-lg-<?php echo $ticket->ticketid; ?>"  id="ticket-seller-<?php echo $ticket->ticketid; ?>" data-id="<?php echo $ticket->ticketid; ?>" >Seller Notes</button>       
                                             
                                            
                                                 <div class="edit_modal_popup modal fade" id="bs-example-modal-lg-<?php echo $ticket->ticketid; ?>" tabindex="-1"     aria-labelledby="myLargeModalLabel" style="display: none;"       aria-hidden="true">
                                                   <div class="modal-dialog modal-lg">
                                                      <div class="modal-content">
                                                      <div class="modal-header">
                                                         <h4 class="modal-title notes_seller" id="myLargeModalLabel">Seller Notes</h4>
                                                         <button type="button" class="close close_modal" data-bs-dismiss="modal" aria-hidden="true" data-id="<?php echo $ticket->ticketid; ?>" >×</button>
                                                      </div>
                                                      <div class="modal-body">
                                                      <form id="save_ticket_details_<?php echo $ticket->ticketid; ?>" action="<?php echo base_url(); ?>tickets/index/save_ticket_details" class="save_ticket_details form-horizontal validate_form_v2" method="post" novalidate="novalidate">
                                                         <input type="hidden" id="s_no_<?php echo $ticket->ticketid; ?>" name="s_no" value="<?php echo $ticket->s_no; ?>">
                                                         <input type="hidden" id="match_id_<?php echo $ticket->ticketid; ?>" value="<?php echo $ticket->match_id; ?>">

                                                      
                                                            <div class="sellers_note_lists">
                                                               <ul class="">
                                                               <?php
                                                      $ticket_key = 0;
                                                      foreach ($ticket_details as $ticket_detail) { ?>
                                                                  <li class="">
                                                                  <input class="tdcheckbox ticket_label" type="checkbox" name="ticket_details[]" value="<?php echo $ticket_detail->id; ?>" <?php if (in_array($ticket_detail->id, $listing_notes)) { ?> checked <?php } ?> ><span><?php echo $ticket_detail->ticket_det_name; ?></span>
                                                                  </li>  
                                                                <?php  $ticket_key++; } ?>                                                               
                                                               </ul>
                                                            </div>
                                                            
                                                      </div>
                                                      <div class="modal-footer">
                                                         <div class="seller_note_save">
                                                            <div class="row">
                                                               <div class="col-sm-12">
                                                                  <div class="text-center mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                                                     <a href="javascript:void(0);"  class="btn btn-primary mb-2 mt-3 cancel" data-id="<?php echo $ticket->ticketid; ?>">Cancel</a>
                                                                        <a href="javascript:void(0);"  data-url="save_ticket_details_<?php echo $ticket->ticketid; ?>" class="save_ticket_details_btn btn btn-success mb-2 ml-2 mt-3">Save</a>                 
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      </form>
                                                      </div><!-- /.modal-content -->
                                                   </div><!-- /.modal-dialog -->
                                                </div>
                                             

                                             <button type="button" data-match="<?php echo $ticket->match_id; ?>" data-s_no="<?php echo $ticket->s_no; ?>" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-save-<?php echo $ticket->ticketid; ?>" class="btn btn-light btn-compare ticket_save_details" data-hint="Save Ticket">Save</button>

                                             <button type="button" data-match="<?php echo $ticket->match_id; ?>" data-s_no="<?php echo $ticket->s_no; ?>" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-copy-<?php echo $ticket->ticketid; ?>" class="ticket_copy btn btn-light btn-compare" data-hint="Duplicate Ticket">Duplicate</button>

                                             <button type="button" class="btn btn-light btn-compare ticket_clone" id="ticket-duplicates-<?php echo $ticket->ticketid; ?>" data-ticket-id="<?php echo $ticket->s_no; ?>" data-redirect='ticket_details_list' data-match="<?php echo $ticket->match_id; ?>">Mass Duplicate</button>


                                             


                                             <button type="button" class="btn btn-light btn-delete ticket_delete_detail" data-match="<?php echo $ticket->match_id; ?>" data-s_no="<?php echo $ticket->s_no; ?>" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-delete-<?php echo $ticket->ticketid; ?>" >Delete</button>
                                       
                                    </div>
                                    </div>
                                 </td>
                           </tr>
                          </tbody>
                     </table>
                  </td>
            </tr>
     
       
      <tr>
         <td colspan="12" class="pl-0 pr-0 pt-0 pb-0">
            <hr>
         </td>
      </tr>
   <?php } ?>
<?php } ?>
<script type="text/javascript">

      $(".seller_note_btn").click(function(){
        id= $(this).attr("data-id");
             $('#bs-example-modal-lg-'+id).modal();
      });
      $(".close_modal").click(function(){
         id= $(this).attr("data-id");
             $('#bs-example-modal-lg-'+id).modal('hide');

      });

      $(".cancel").click(function(){
         id= $(this).attr("data-id");
             $('#bs-example-modal-lg-'+id).modal('hide');

      });


      $(document).on('click', '.ticket_clone', function(){
      var ticket_id = $(this).attr('data-ticket-id');
      //$('#clone-listing-modal').modal();  

      $('.edit_ticket_close').trigger('click');  
      
      setTimeout(
      function() 
      {
      $('#clone-listing-modal').modal({
      backdrop: 'static',
      keyboard: false
      })

      $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>tickets/index/get_ticket_details_ajax',
            data: {
               'ticket_id': ticket_id,
               'type': 'clone'
            },
            dataType: "json",
            success: function(data) {

                if(data.status == 1){
                  $('#ticket_clone_body').html(data.html);
                }

            }
         });
      }, 500);

    })
        
</script>