 <style>
   .widd_50{width: 5%;}
   .widd_100{width: 8%;}
   .widd_150{width: 15%;}
   .widd_10{width: 0%;}

.nested  tbody tr:nth-child(2n) td, .nested  tbody tr:nth-child(2n-1) td {
    background:#fff;
}
.nested  tbody tr:nth-child(4n-2) td, .nested  tbody tr:nth-child(4n-3) td{
    background: #DDE0F2;
}
</style>

<div class="tab_sec orders list_odd list_padd" id="no-more-tables">
   <table class="toptable res_table_new table-responsive">
      <tbody>
         <tr class="accordion">
            <th class="widd_50">&nbsp;</th>
            <th class="widd_150">Date</th>
            <th class="widd_100">Event</th>
            <th class="widd_150">Tournament</th>
            <th class="widd_150">Stadium</th>
           <!--  <th class="widd_50">List Until</th> -->
            <th class="widd_100">City</th>
           <!--  <th>Status</th> -->
            <th class="widd_100">Country</th>
            <th class="widd_50">Qty</th>
            <th class="widd_50">SOLD</th>
             <th class="widd_150">Price Range</th>
            <th class="widd_10">&nbsp;</th>
         </tr>
         <?php foreach ($listings as $list_ticket) {
            $tickets = $list_ticket->tickets;
            //echo "<pre>";print_r($tickets);
             $min_price = min(array_column($tickets, 'price'));
             $max_price = max(array_column($tickets, 'price'));
             $total_qty = array_sum(array_column($tickets,'quantity'));
             $total_sold = array_sum(array_column($tickets,'sold'));
             $teams = explode('vs',$list_ticket->match_name);
             if($teams[1] == ''){
               $teams = explode('Vs',$list_ticket->match_name);
             }
             $final_status = array_sum(array_column($tickets,'status'));
            // $tkt_category = $list_ticket->tkt_category
            //echo "<pre>";print_r($list_ticket);//exit;
            ?>
         <tr style="cursor: pointer;" >
              <td><div class="content">
                              <label class="switch">
                              <input type="checkbox" match-id="<?php echo $list_ticket->m_id; ?>" class="all_ticket_status" name="all_ticket_status" <?php if ($final_status >= 1) { ?> checked="checked" <?php } ?> value="1">
                              <span class="slider round newslider" style=""></span>
                              </label>
                           </div></td>
            <td class="ticket_list_row" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Event date:"><span class="tr_date"><i class="fas fa-calendar"></i><b><?php echo date("d/m/Y h:m", strtotime($list_ticket->match_date)); ?></b></span> <br><span class="tr_date"><i class="fas fa-clock"></i><?php echo date("l", strtotime($list_ticket->match_date)); ?></span></td>
            <td class="ticket_list_row" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Event:"> <?php echo $list_ticket->match_name; ?></td>
            <td class="ticket_list_row class_mob" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Tournament:"><?php echo $list_ticket->category_name; ?></td>
            <td class="ticket_list_row class_mob" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Stadium:"><?php echo $list_ticket->stadium_name; ?> </td>
           <td class="ticket_list_row class_mob" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="City:"><b><?php echo $list_ticket->city_name; ?></b></td> 
             <td class="ticket_list_row class_mob" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Country:"><?php echo $list_ticket->country_name; ?> </td> 
            <td class="ticket_list_row" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Tickets Qty:"><b><?php echo $total_qty; ?></b></td>
            <td class="ticket_list_row" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Tickets Sold:"><b><?php echo $total_sold; ?></b></td>
            <td class="ticket_list_row" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Price Range:"><b>
               <?php if (strtoupper($list_ticket->price_type) == "GBP") { ?>
              £
               <?php } ?>
               <?php if (strtoupper($list_ticket->price_type) == "EUR") { ?>
               €
               <?php } ?>
               <?php echo $min_price; ?> - <?php echo $max_price; ?></b>
            </td>
            <td flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" class="ticket_list_row showHide" id="ticket_td_<?php echo $list_ticket->m_id; ?>">
               <a href="<?php echo base_url();?>tickets/index/oe_listing_details/<?php echo $list_ticket->m_id; ?>">
             <img style="max-width:20px !important;" src="<?php echo base_url();?>assets/img/icons/arrow-right-circle.svg?v=1">
          </a>
            </td>
         </tr>
       
         <?php  
            }  ?>
      </tbody>
   </table>
</div>
<?php print_r($pagination); ?>