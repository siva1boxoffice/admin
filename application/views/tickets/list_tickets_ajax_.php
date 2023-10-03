<style type="text/css">
   .flag_tr{
   background-color : #e0f2f1 !important;
   }
</style>
<style type="text/css">
   input:checked + .newslider {
    background-color: #43a047 !important;
}
</style>
<div class="tab_sec orders" id="no-more-tables">
   <table class="toptable res_table_new table-responsive">
      <tbody>
         <tr class="accordion">
            <th>&nbsp;</th>
            <th>Date</th>
            <th>Event</th>
            <th>Tournament</th>
            <th>Stadium</th>
           <!--  <th>List Until</th> -->
            <!-- <th>City</th> -->
           <!--  <th>Status</th> -->
            <!-- <th>Country</th> -->
            <th>Qty</th>
             <th>Price Range</th>
            <th>&nbsp;</th>
         </tr>
         <?php foreach ($listings as $list_ticket) {
            $tickets = $list_ticket->tickets;
            //echo "<pre>";print_r($tickets);
             $min_price = min(array_column($tickets, 'price'));
             $max_price = max(array_column($tickets, 'price'));
             $total_qty = array_sum(array_column($tickets,'quantity'));
             $teams = explode('vs',$list_ticket->match_name);
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
            <td class="ticket_list_row" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Transaction date:"><b><?php echo date("d/m/Y h:m", strtotime($list_ticket->match_date)); ?></b> <br><?php echo date("F", strtotime($list_ticket->match_date)); ?></td>
            <td class="ticket_list_row" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Event:"> <?php echo $list_ticket->match_name; ?> </td>
            <td class="ticket_list_row" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Tournament:"><?php echo $list_ticket->tournament_name; ?></td>
            <td class="ticket_list_row" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Stadium:"><?php echo $list_ticket->stadium_name; ?><br><b><?php echo $list_ticket->city_name; ?></b>,<br><?php echo $list_ticket->country_name; ?> </td>
            <!-- <td data-label="List Until:">
            <?php if($list_ticket->ignoreautoswitch == 1){?>
            <select match-id="<?php echo $list_ticket->m_id; ?>" class="auto_disable form-control">
                              <?php for ($time = 1;$time <= 24;$time++) { ?>
                              <option value="<?php echo $time; ?>" <?php if ($time == $list_ticket->auto_disable) { ?> selected="selected" <?php } ?>><?php echo $time; ?> Hours</option>
                              <?php } ?>
                           </select>
            <?php } else{ ?>
               24 Hours
            <?php } ?>
            </td> -->
            <!-- <td data-label="City:"><b><?php echo $list_ticket->city_name; ?></b>,<?php echo $list_ticket->country_name; ?> </td> -->
          <!--   <td data-label="Country:"><?php echo $list_ticket->country_name; ?> </td> -->
            <td class="ticket_list_row" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Tickets Qty:"><b><?php echo $total_qty; ?></b></td>
            <td class="ticket_list_row" flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" data-label="Price Range:"><b><b>
               <?php if (strtoupper($list_ticket->price_type) == "GBP") { ?>
               <i class="fas fa-pound-sign"></i>
               <?php } ?>
               <?php if (strtoupper($list_ticket->price_type) == "EUR") { ?>
               <i class="fas fa-euro-sign"></i>
               <?php } ?>
               <?php echo $min_price; ?> - <?php echo $max_price; ?></b>
            </td>
            <td flag-id="ticket_td_<?php echo $list_ticket->m_id; ?>" class="ticket_list_row showHide" id="ticket_td_<?php echo $list_ticket->m_id; ?>">
               <i class="fas fa-chevron-down"></i>
            </td>
         </tr>
         <?php if (!empty($tickets)) { ?>
         <tr class="nested" id="ticket_row_<?php echo $list_ticket->m_id; ?>">
            <td colspan="12">
               <table class="nest_tab" id="">
                  <thead>
                     <tr>
                        <th>Active</th>
                        <th>ID</th>
                        <th>Ticket Type</th>
                        <th>Section</th>
                        <th>Block</th>
                        <th>Home / Away</th>
                        <th>Row</th>
                        <!-- <th>Seats</th> -->
                        <th>QTY</th>
                        <th>Split Type</th>
                        <th>Price</th>
                        <th>&nbsp;</th>
                     </tr>
                  </thead>
                  <tbody id="ticket_body">
                     <?php
                        $CI = &get_instance();
                        //echo "<pre>";print_r($tickets);
                        foreach ($tickets as $ticket) {
                        	$condition['stadium_id'] = $list_ticket->venue;
                        	$condition['category'] = $ticket->ticket_category;
                        	$blocks_data = $CI->General_Model->getAllItemTable('stadium_details', $condition)->result();
                        	$listing_notes = explode(',', $ticket->listing_note);
                           $comaring_tickets = $CI->General_Model->get_tickets_v1($ticket->s_no,$ticket->match_id,$ticket->ticket_category)->result();
                        	//echo "<pre>";print_r($blocks_data);
                        ?>
                     <tr <?php if($ticket->s_no == $last_ticket_id){?> class="flag_tr" <?php } ?>>
                        <td data-label="Active">
                           <div class="content">
                              <label class="switch">
                              <input type="checkbox" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-status-<?php echo $ticket->ticketid; ?>" class="ticket_status" name="status" <?php if ($ticket->status == 1) { ?> checked="checked" <?php } ?> value="1">
                              <span class="slider round"></span>
                              </label>
                           </div>
                        </td>
                        <td data-label="ID"><?php echo $ticket->ticketid; ?> </td>
                        <td data-label="Ticket type" class="select">
                           <select data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-type-<?php echo $ticket->ticketid; ?>" name="ticket_type" id="ticket" class="form-control ticket_type">
                              <?php foreach ($ticket_types as $ticket_type) { ?>
                              <option value="<?php echo $ticket_type->id; ?>" <?php if ($ticket->ticket_type == $ticket_type->id) { ?> selected="selected" <?php } ?>><?php echo $ticket_type->name; ?></option>
                              <?php } ?>
                           </select>
                        </td>
                        <td data-label="Section" class="select">
                           <select name="ticket_category" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-category-<?php echo $ticket->ticketid; ?>" data-match="<?php echo $ticket->match_id; ?>" class="ticket_category form-control">
                              <?php foreach ($list_ticket->tkt_category as $tktkey => $tkt_category) {
                                 ?>
                              <option value="<?php echo $tktkey; ?>" <?php if ($ticket->ticket_category == $tktkey) { ?> selected="selected" <?php } ?>><?php echo $tkt_category; ?></option>
                              <?php } ?>
                           </select>
                        </td>
                        <td data-label="Block" class="select">
                           <select name="ticket_block" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-block-<?php echo $ticket->ticketid; ?>" class="ticket_block form-control">
                              <option value="0" <?php if ($ticket->ticket_block=='') { ?> selected="selected" <?php } ?>>Any</option>
                              <?php foreach ($blocks_data as $blkkey => $block_data) {
                                 $block = explode('-',$block_data->block_id);
                                 ?>
                              <option value="<?php echo $block_data->id; ?>" <?php if ($block_data->id == $ticket->ticket_block) { ?> selected="selected" <?php } ?>><?php echo $block[1]; ?></option>
                              <?php } ?>
                           </select>
                        </td>
                        <td data-label="Home/Away" class="select">
                           <select name="home_town" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-home-down-<?php echo $ticket->ticketid; ?>" class="ticket_home_down form-control">
                              <option value="0" <?php if ($ticket->home_town == 0) { ?> selected="selected" <?php } ?>>Any</option>
                              <option value="1" <?php if ($ticket->home_town == 1) { ?> selected="selected" <?php } ?>>Home</option>
                              <option value="2" <?php if ($ticket->home_town == 2) { ?> selected="selected" <?php } ?>>Away</option>
                              <option value="<?php echo $teams[0];?>" <?php if ($ticket->home_town == $teams[0]) { ?> selected="selected" <?php } ?>><?php echo $teams[0];?></option>
                              <option value="<?php echo $teams[1];?>" <?php if ($ticket->home_town == $teams[1]) { ?> selected="selected" <?php } ?>><?php echo $teams[1];?></option>
                           </select>
                        </td>
                        <td data-label="Row">
                           <input type="text" name="row" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-row-<?php echo $ticket->ticketid; ?>" class="ticket_row row form-control1" value="<?php echo $ticket->row; ?>">
                        </td>
                        <!-- <td data-label="Seats">
                           <input type="text" name="seat" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-seat-<?php echo $ticket->ticketid; ?>" class="ticket_seat form-control1" value="<?php echo $ticket->seat; ?>">
                           </td> -->
                        <td data-label="QTY">
                           <input type="text" name="quantity" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-quantity-<?php echo $ticket->ticketid; ?>" class="ticket_quantity form-control1" value="<?php echo $ticket->quantity; ?>">
                        </td>
                        <td data-label="Split type" class="select">
                           <select name="split" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-split-<?php echo $ticket->ticketid; ?>" class="ticket_split form-control">
                              <?php foreach ($split_types as $split_type) { ?>
                              <option value="<?php echo $split_type->id; ?>" <?php if ($ticket->split == $split_type->id) { ?> selected="selected" <?php } ?>><?php echo $split_type->name; ?></option>
                              <?php } ?>
                           </select>
                        </td>
                        <td data-label="Price" class="fontuser">
                           <input type="text" name="price" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-price-<?php echo $ticket->ticketid; ?>" class="ticket_price form-control" value="<?php echo $ticket->price; ?>">
                           <?php if (strtoupper($ticket->price_type) == "GBP") { ?>
                           <i class="fas fa-pound-sign"></i>
                           <?php } ?>
                           <?php if (strtoupper($ticket->price_type) == "EUR") { ?>
                           <i class="fas fa-euro-sign"></i>
                           <?php } ?>
                        </td>
                        <td>
                           <div class="compare_btn">
                              <div class="dropdown">
                                   <a class="dropbtn is-solid h-modal-trigger">Compare</a>
                                   <div class="dropdown-content">
                                     <table>
                                      <p><span class="compare_price">Ticket Price :  <?php if (strtoupper($ticket->price_type) == "GBP") { ?>
                           <i class="fas fa-pound-sign"></i>
                           <?php } ?>
                           <?php if (strtoupper($ticket->price_type) == "EUR") { ?>
                           <i class="fas fa-euro-sign"></i>
                           <?php } ?> <?php echo $ticket->price; ?></span></p>
                                     
                                 <?php if(isset($comaring_tickets[0])){
                                    foreach($comaring_tickets as $comaring_ticket){
                                 ?>
                                   <tr>
                                          <th><span class="list_head">Other Listed Tickets</span></th>
                                          <th>&nbsp;</th>
                                       </tr>
                                   <tr>
                                     <th><?php echo $comaring_ticket->seat_category;?></th>
                                     <td><span>
                                    <?php if (strtoupper($comaring_ticket->price_type) == "GBP") { ?>
                                    <i class="fas fa-pound-sign"></i>
                                    <?php } ?>
                                    <?php if (strtoupper($comaring_ticket->price_type) == "EUR") { ?>
                                    <i class="fas fa-euro-sign"></i>
                                    <?php } ?>
                                       <?php echo $comaring_ticket->price;?> × <?php echo $comaring_ticket->quantity;?></span></td>
                                     
                                   </tr>
                                   <?php } } else{ ?>
                                    <tr>
                                   <th> <span class="list_head">No List to Compare.</span></th>
                                    </tr>
                                   <?php } ?>
                                 </table>
                                   </div>
                              </div>
                           </div>
                        </td>
                     </tr>
                     <tr>
                       <!--  <td colspan="2" data-label="Selling type">
                           <label>Selling Type *</label>
                           <br>
                           <select name="sell_type" id="sell-type-<?php echo $ticket->ticketid; ?>" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-sell_type-<?php echo $ticket->ticketid; ?>" class="ticket_sell_type form-control">
                           	<option value="buy" <?php if ($ticket->sell_type == "buy") { ?> selected="selected" <?php } ?>>Buy</option>
                           	<option value="request" <?php if ($ticket->sell_type == "request") { ?> selected="selected" <?php } ?>>Request</option>
                           </select>
                           </td> -->
                        <!-- <td colspan="6">
                           <label>&nbsp;</label>
                           <div class="control">
                           	<label class="checkbox">
                           		<input type="checkbox" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-track-<?php echo $ticket->ticketid; ?>" name="track" value="1" <?php if ($ticket->track == '1') { ?> checked="checked" class="ticket_track" <?php } ?> />
                           		<span></span>
                           		Track this ticket ?
                           	</label>
                           </div>
                           </td> -->
                        <td colspan="2" data-label="Selling type">
                        </td>
                        <td colspan="5" data-label="Selling type">
                        </td>
                        <td colspan="6">
                           <div class="icons" style="float: right;">
                              <!-- <a href="javascript:void(0);" data-match="<?php echo $ticket->match_id; ?>" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-compare-<?php echo $ticket->ticketid; ?>" class="ticket_compare is-solid hint--top" data-hint="Compare Price"><span class="fa-fw select-all fas"></span></a>&nbsp; -->
                              <a href="javascript:void(0);" data-match="<?php echo $ticket->match_id; ?>" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-compare-<?php echo $ticket->ticketid; ?>" class="ticket_compare is-solid hint--top h-modal-trigger" data-modal="seller-notes-model-<?php echo $ticket->ticketid; ?>" data-hint="Seller Notes">
                                 <!-- <span class="fa-fw select-all fas"></span> -->Seller Notes
                              </a>
                              &nbsp;
                              <div id="seller-notes-model-<?php echo $ticket->ticketid; ?>" class="modal h-modal is-big">
                                 <div class="modal-background h-modal-close"></div>
                                 <div class="modal-content">
                                    <div class="modal-card">
                                       <header class="modal-card-head">
                                          <h3>Seller Notes</h3>
                                          <button class="h-modal-close ml-auto" aria-label="close">
                                          <i data-feather="x"></i>
                                          </button>
                                       </header>
                                       <form id="save_ticket_details_<?php echo $ticket->ticketid; ?>" action="<?php echo base_url(); ?>tickets/index/save_ticket_details" class="save_ticket_details form-horizontal validate_form_v2" method="post" novalidate="novalidate">
                                          <input type="hidden" id="s_no_<?php echo $ticket->ticketid; ?>" name="s_no" value="<?php echo $ticket->s_no; ?>">
                                          <input type="hidden" id="match_id_<?php echo $ticket->ticketid; ?>" value="<?php echo $ticket->match_id; ?>">
                                          <div class="modal-card-body" style="padding:11px;">
                                             <div class="inner-content">
                                             	<?php
                                                      $ticket_key = 0;
                                                      foreach ($ticket_details as $ticket_detail) { ?>
                                             	<label class="checkbox is-outlined is-primary" style="padding:5px 0px">
                                                    <input type="checkbox" name="ticket_details[]" value="<?php echo $ticket_detail->id; ?>" <?php if (in_array($ticket_detail->id, $listing_notes)) { ?> checked <?php } ?>>
                                                    <span></span>
                                                    <img width="20px" height="20px" src="<?php echo UPLOAD_PATH.'uploads/ticket_details/'.$ticket_detail->ticket_image;?>">
                                                      <?php echo $ticket_detail->ticket_det_name; ?>
                                                </label>
                                            <?php $ticket_key++;} ?>
                                               <!--  <div class="control">
                                                   <?php
                                                      $ticket_key = 0;
                                                      foreach ($ticket_details as $ticket_detail) { ?>
                                                   <div class="field">
                                                      <label class="checkbox">
                                                      <input type="checkbox" name="ticket_details[]" value="<?php echo $ticket_detail->id; ?>" <?php if (in_array($ticket_detail->id, $listing_notes)) { ?> checked <?php } ?>>
                                                      <span></span><img width="20px" height="20px" src="<?php echo base_url().'uploads/ticket_details/'.$ticket_detail->ticket_image;?>">
                                                      <?php echo $ticket_detail->ticket_det_name; ?>
                                                      </label>
                                                   </div>
                                                   <?php $ticket_key++;
                                                      } ?>
                                                </div> -->
                                             </div>
                                          </div>
                                          <div class="modal-card-foot is-centered">
                                             <a class="button notes_cancel h-button is-rounded h-modal-close">Cancel</a>
                                             <button data-url="save_ticket_details_<?php echo $ticket->ticketid; ?>" type="button" class="save_ticket_details_btn button h-button is-primary is-raised is-rounded">Save</button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              <a href="javascript:void(0);" data-match="<?php echo $ticket->match_id; ?>" data-s_no="<?php echo $ticket->s_no; ?>" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-save-<?php echo $ticket->ticketid; ?>" class="ticket_save is-solid hint--top" data-hint="Save Ticket">
                                 <!-- <i class="fas fa-save"></i> -->Save
                              </a>
                              &nbsp;
                              <a href="javascript:void(0);" data-match="<?php echo $ticket->match_id; ?>" data-s_no="<?php echo $ticket->s_no; ?>" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-copy-<?php echo $ticket->ticketid; ?>" class="ticket_copy is-solid hint--top" data-hint="Duplicate Ticket">
                                 <!-- <i class="fas fa-copy"></i> -->Duplicate
                              </a>
                              &nbsp;
                              <!-- <a target="_blank" href="<?php echo base_url(); ?>tickets/index/upload_management/<?php echo $ticket->ticketid; ?>" data-match="<?php echo $ticket->match_id; ?>" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-upload-<?php echo $ticket->ticketid; ?>" class="ticket_upload is-solid hint--top" data-hint="Upload E-Ticket"><i class="fas fa-upload"></i></a>&nbsp; -->
                              <a href="javascript:void(0);" data-match="<?php echo $ticket->match_id; ?>" data-s_no="<?php echo $ticket->s_no; ?>" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-delete-<?php echo $ticket->ticketid; ?>" class="ticket_delete is-solid hint--top" data-hint="Delete Ticket">
                                 <!-- <i class="fas fa-trash-alt"></i> -->Delete
                              </a>
                           </div>
                        </td>
                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </td>
         </tr>
         <?php } else { ?>
         <tr class="nested">
            <td colspan="12">
               <table class="nest_tab" id="">
                  <thead>
                     <tr>
                        <h5 style="text-align: center;">No Tickets Listed</h5>
                     </tr>
                  </thead>
               </table>
            </td>
         </tr>
         <?php  }
            }  ?>
         <script src="<?php echo base_url(); ?>assets/js/validate/jquery.validate.js" async></script>
         <script src="<?php echo base_url(); ?>assets/js/validate/custom.js" async></script>
         <script src="<?php echo base_url(); ?>assets/js/ticket.js"></script>
         <script>
            $(document).ready(function() {
            
            
            	initHModals();
            
            	$(".toptable tr.nested").hide();
            	<?php if ($match_id != "") { ?>
            
            		$("#ticket_row_" + <?php echo $match_id; ?>).show();
            		$("#ticket_td_" + <?php echo $match_id; ?>).html('<i class="fas fa-chevron-up"></i>');
            
            
            	<?php } ?>
            	$('.ticket_list_row').on('click', function() { 
            		var flag_id = $(this).attr('flag-id');
            	if (($('#'+flag_id).html()).trim() == ('<i class="fas fa-chevron-down"></i>').trim()) {
            			$('#'+flag_id).html('<i class="fas fa-chevron-up"></i>');
            			$('#'+flag_id).closest('tr').next('tr.nested').show();
            		} else {
            			$('#'+flag_id).html('<i class="fas fa-chevron-down"></i>');
            			$('#'+flag_id).closest('tr').next('tr.nested').hide();
            		}
            	});
            	/*$(".toptable td.showHide").on('click', function() {
            		if (($(this).html()).trim() == ('<i class="fas fa-chevron-down"></i>').trim()) {
            			$(this).html('<i class="fas fa-chevron-up"></i>');
            			$(this).parent('tr').next('tr.nested').show();
            		} else {
            			$(this).html('<i class="fas fa-chevron-down"></i>');
            			$(this).parent('tr').next('tr.nested').hide();
            		}
            	});*/
            	// Detect pagination click
            	/*$('#pagination').on('click', 'a', function(e) {
            		e.preventDefault();
            		var pageno = $(this).attr('data-ci-pagination-page');
            		load_tickets('', pageno);
            	});*/
            	// Detect pagination click
            	$('#paginationsearch').on('click', 'a', function(e) {
            		e.preventDefault();
            		var pageno = $(this).attr('data-ci-pagination-page');
            		filter_search($('input[name="search_event"]:checked').val(), pageno);
            	});
            	// 	// Detect pagination click
            		/*$('#paginationfilter').on('click', 'a', function(e) {
            		e.preventDefault();
            		var pageno = $(this).attr('data-ci-pagination-page');
            		load_filter(pageno);
            	});*/
            
            });
            

            
            $(".ticket_price").on("change", function(evt) {
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
            
         </script>
      </tbody>
   </table>
</div>
<?php print_r($pagination); ?>