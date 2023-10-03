<table class="toptable res_table_new table-responsive">
   <tbody>
      <tr class="nested" style="display: table-row;">
         <td colspan="12">
            <table class="nest_tab" id="">
               <thead>
                  <tr>
                     <th>Active</th>
                     <th>Ticket Type</th>
                     <th>Section</th>
                     <th>Block</th>
                     <th>Home / Away</th>
                     <th>Row</th>
                     <th>QTY</th>
                     <th>Split Type</th>
                     <th>Price</th>
                     <th>&nbsp;</th>
                  </tr>
               </thead>
               <tbody>
                <?php 
                //echo "<pre>";print_r($listings);
                foreach ($listings as $list_ticket) { 
                    $tickets = $list_ticket->tickets;
                    $teams = explode('vs',$list_ticket->match_name);
                    if($teams[1] == ''){
                    $teams = explode('Vs',$list_ticket->match_name);
                    }
                  ?>
                  <?php if (!empty($tickets)) { ?>
                     <?php
                        $CI = &get_instance();
                        //echo "<pre>";print_r($tickets);
                        $i = 0;
                        foreach ($tickets as $ticket) {
                           $condition['stadium_id'] = $list_ticket->venue;
                           $condition['category'] = $ticket->ticket_category;
                           $blocks_data = $CI->General_Model->getAllItemTable('stadium_details', $condition)->result();
                           $listing_notes = explode(',', $ticket->listing_note);
                           $comaring_tickets = $CI->General_Model->get_tickets_v1($ticket->s_no,$ticket->match_id,$ticket->ticket_category)->result();
                           //echo "<pre>";print_r($blocks_data);
                        ?>
                     <tr class="tr_clone">
                        <td  data-label="Active">
                           <div class="content">
                              <label class="switch">
                              <input type="checkbox" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-status-<?php echo $ticket->ticketid; ?>" class="ticket_status" name="status[]" <?php if ($ticket->status == 1) { ?> checked="checked" <?php } ?> value="1">
                              <span class="slider round"></span>
                              </label>
                           </div>
                        </td>
                        <td data-label="Ticket type" class="select">
                           <select data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-type-<?php echo $ticket->ticketid; ?>" name="ticket_type[]" id="ticket" class="form-control ticket_type">
                              <?php foreach ($ticket_types as $ticket_type) { ?>
                              <option value="<?php echo $ticket_type->id; ?>" <?php if ($ticket->ticket_type == $ticket_type->id) { ?> selected="selected" <?php } ?>><?php echo $ticket_type->tickettype; ?></option>
                              <?php } ?>
                           </select>
                        </td>
                        <td data-label="Section" class="select">
                           <select name="ticket_category[]" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-category-<?php echo $ticket->ticketid; ?>" data-match="<?php echo $ticket->match_id; ?>" class="ticket_category form-control">
                              <?php foreach ($list_ticket->tkt_category as $tktkey => $tkt_category) {
                                 ?>
                              <option value="<?php echo $tktkey; ?>" <?php if ($ticket->ticket_category == $tktkey) { ?> selected="selected" <?php } ?>><?php echo $tkt_category; ?></option>
                              <?php } ?>
                           </select>
                        </td>
                        <td data-label="Block" class="select">
                           <select name="ticket_block[]" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-block-<?php echo $ticket->ticketid; ?>" class="ticket_block form-control">
                              <option value="0" <?php if ($ticket->ticket_block=='') { ?> selected="selected" <?php } ?>>Any</option>
                              <?php foreach ($blocks_data as $blkkey => $block_data) {
                                 $block = explode('-',$block_data->block_id);
                                 ?>
                              <option value="<?php echo $block_data->id; ?>" <?php if ($block_data->id == $ticket->ticket_block) { ?> selected="selected" <?php } ?>><?php echo $block[1]; ?></option>
                              <?php } ?>
                           </select>
                        </td>
                        <td data-label="Home/Away" class="select">
                           <select name="home_town[]" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-home-down-<?php echo $ticket->ticketid; ?>" class="ticket_home_down form-control">
                              <option value="0" <?php if ($ticket->home_town == 0) { ?> selected="selected" <?php } ?>>Any</option>
                              <option value="1" <?php if ($ticket->home_town == 1) { ?> selected="selected" <?php } ?>>Home</option>
                              <option value="2" <?php if ($ticket->home_town == 2) { ?> selected="selected" <?php } ?>>Away</option>
                              <option value="<?php echo $teams[0];?>" <?php if ($ticket->home_town == $teams[0]) { ?> selected="selected" <?php } ?>><?php echo $teams[0];?></option>
                              <option value="<?php echo $teams[1];?>" <?php if ($ticket->home_town == $teams[1]) { ?> selected="selected" <?php } ?>><?php echo $teams[1];?></option>
                           </select>
                        </td>
                        <td data-label="Row">
                           <input type="text" name="row[]" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-row-<?php echo $ticket->ticketid; ?>" class="ticket_row row form-control1" value="<?php echo $ticket->row; ?>">
                        </td>
                        <!-- <td data-label="Seats">
                           <input type="text" name="seat" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-seat-<?php echo $ticket->ticketid; ?>" class="ticket_seat form-control1" value="<?php echo $ticket->seat; ?>">
                           </td> -->
                        <td data-label="QTY">
                           <input type="text" name="quantity[]" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-quantity-<?php echo $ticket->ticketid; ?>" class="ticket_quantity form-control1" value="<?php echo $ticket->quantity; ?>">
                        </td>
                        <td data-label="Split type" class="select">
                           <select name="split[]" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-split-<?php echo $ticket->ticketid; ?>" class="ticket_split form-control">
                              <?php foreach ($split_types as $split_type) { ?>
                              <option value="<?php echo $split_type->id; ?>" <?php if ($ticket->split == $split_type->id) { ?> selected="selected" <?php } ?>><?php echo $split_type->name; ?></option>
                              <?php } ?>
                           </select>
                        </td>
                        <td data-label="Price" class="price_form_ctrl fontuser">
                           <input type="text" name="price[]" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-price-<?php echo $ticket->ticketid; ?>" class="ticket_price form-control" value="<?php echo $ticket->price; ?>">
                           


                <?php if (strtoupper($ticket->price_type) == "GBP") { ?>
             <i> £</i>
               <?php } ?>
               <?php if (strtoupper($ticket->price_type) == "EUR") { ?>
              <i> €</i>
               <?php } ?>

                        </td>
                        <td data-label="Plus">
                              <a style="cursor:pointer;" class="clone_duplicate"><i class="fas fa-plus"></i></a>
                              </td>
                     </tr>
                     <?php $i++;} ?>
                 
         <?php } ?>

                <?php } ?>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
<script type="text/javascript">
  $(".clone_duplicate").on("click",function(){

    /*var trLast = $(this).find("tr:last");
    $("#main_tr").clone().appendTo("ticket_body");*/
   /*$(this).closest('tr.tr_clone')
   .clone()
   .insertAfter(".tr_clone")*/
   var tr_clone = $(this).closest('tr.tr_clone')
   .clone()
   .removeClass('tr_clone');

   var clonerow = $(this).closest('tr.tr_clone')
            .clone().find("a").remove().end().removeClass('tr_clone');
           // .wrap("<a style='cursor:pointer;' class=''><i class='fas fa-trash'></i></a>");
      clonerow.find('td:last').html("<a style='cursor:pointer;' class='remove_clone'><i class='fas fa-trash'></i></a>");

   clonerow.insertBefore(".tr_clone");

   $(".remove_clone").on("click",function(){
     $(this).parent().parent().remove();
   });

  })

   
</script>