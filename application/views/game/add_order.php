
<?php $this
   ->load
   ->view('common/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/svg/svgmap.css" />
<style>
   svg {
   max-width: 640px;
   margin: 0 auto;
   display: block;
   background: #ffffff;
   }
   .ticket-selected {
   background: green !important;
   }
   .tooltip ul {
   padding-left: 0;
   list-style: none;
   }
   .tic_book_details_cont_right .seat_select_items p {
   font-weight: bold;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt {
   float: none !important;
   display: inline-block !important;
   margin: 0 -4px 0 0;
   vertical-align: middle;
   padding: 0 5px;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt1 {
   width: 20%!important;
   font-weight: 700;
   text-align: left;
   position: static!important;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt2 {
   width: 10%!important;
   position: static!important;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt3 {
   width: 23%!important;
   font-weight: normal;
   font-size: 16px;
   position: static!important;
   padding: 0 5px;
   text-align: right;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt4 {
   width: 13%!important;
   position: static!important;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt5 {
   width: 17%!important;
   position: static!important;
   padding: 0 5px;
   margin: 0;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt6 {
   width: 13%!important;
   position: static;
   position: static!important;
   padding: 10px 5px;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt4 label {
   font-weight: normal;
   display: block;
   text-align: center;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt4 select {
   float: none;
   background-position: 28px 16px;
   }
   .tic_book_details_cont_right .seat_select_items .block-row {
   margin-top: 0;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt br {
   display: none;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt3 {
   text-align: left;
   }
   .rtl tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt3 {
   text-align: right;
   }
   @media screen and (max-width:767px) {
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt2 {
   position: static;
   transform: unset;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt6 {
   padding: 8px 6px;
   font-size: 14px;
   background: #00a2e8;
   border: 2pxsolid #00a2e8;
   position: static;
   margin-left: 10px;
   }
   .tic_book_details_cont_right .seat_select_block_items:hover a.ticket_tab_flt.ticket_tab_flt6 {
   color: #fff;
   background: #136090;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt3 {
   text-align: right;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt3 {
   text-align: left;
   }
   .rtl tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt3 {
   text-align: right;
   }
   }
   @media screen and (max-width:480px) {
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt {
   padding: 5px 0;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt1 {
   width: 33%!important;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt2 {
   width: 33%!important;
   text-align: center;
   padding: 0 5px;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt3 {
   width: 33%!important;
   font-size: 12px;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt4 {
   width: 33%!important;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt5 {
   width: 33%!important;
   text-align: center;
   padding: 0 5px;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt6 {
   width: 33%!important;
   margin-left: 0px;
   }
   .tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt3 {
   text-align: left;
   }
   .rtl tic_book_details_cont_right .seat_select_block_items .ticket_tab_flt.ticket_tab_flt3 {
   text-align: right;
   }
   }
</style>
<div class="view-wrapper is-webapp" data-page-title="Dashboard" data-naver-offset="150" data-menu-item="#dashboards-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
   <div class="page-content-wrapper">
      <div class="page-content is-relative">
         <div class="page-content-inner">
            <div class="container_new">
               <!--Lifestyle Dashboard V3-->
               <div class="lifestyle-dashboard lifestyle-dashboard-v3">
                  <?php if ($this
                     ->uri
                     ->segment(3) !== 'checkout')
                     { ?>
                  <div class="columns is-multiline is-flex-tablet-p star_rate">
                     <div class="column is-6">
                        <label>Select Customer </label>
                        <div class="ticket_quantity_select">
                           <select name="customer_id" id="customer_selection_id" class="form-control">
                              <option value="">-- Select Customer --</option>
                              <?php foreach ($customers_list as $customer)
                                 { ?>
                              <option value="<?=$customer->id
                                 ?>" <?=$selected_customer->id == $customer->id ? 'selected' : ''; ?>><?=$customer->first_name . " " . $customer->last_name . " -  " . $customer->email ?></option>
                              <?php
                                 } ?>
                           </select>
                        </div>
                     </div>
                     <div class="column is-6">
                        <label>Select Event</label>
                        <div class="ticket_quantity_select">
                           <select name="event_id" id="event_selection_id" class="form-control">
                              <option value="">-- Select Event --</option>
                              <?php foreach ($events_list as $event)
                                 { ?>
                              <option value="<?=$event->m_id
                                 ?>" <?=$this
                                 ->input
                                 ->get('match_id') == $event->m_id ? 'selected' : ''; ?>><?=$event->match_name ?> - <?=$event->match_date_format ?> -  <?=$event->tournament_name ?></option>
                              <?php
                                 } ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <?php if ($matchInfo)
                     { ?>
                  <div class="columns is-multiline">
                     <div class="column is-5">
                        <div class="ticket_select_img">
                           <div id="mapsvg" style="visibility: hidden;"></div>
                        </div>
                        <div class="select_sec">
                           <h4>Select a section that you like to be seated in</h4>
                           <?php
                              if ($matchInfo):
                                  if ($matchInfo[0]->availability == 1)
                                  {
                                      $checkSellTicketData = $this
                                          ->General_Model
                                          ->getAllItemTable_Array('sell_tickets', array(
                                          'match_id' => $matchInfo[0]->m_id
                                      ))
                                          ->result();
                                      if (count($checkSellTicketData) >= 1)
                                      {
                              ?>
                           <ul>
                              <?php
                                 if ($stadiumImage):
                                     $stadiumId = $stadiumImage[0]->s_id;
                                     $statdiumInformations = $this
                                         ->db
                                         ->query("SELECT stadium_details.*,stadium_seats_lang.seat_category as category,stadium_seats_lang.stadium_seat_id FROM stadium_details,stadium_seats_lang WHERE stadium_details.category = stadium_seats_lang.stadium_seat_id and stadium_seats_lang.language = 'en' and stadium_id = $stadiumId  group by stadium_details.category order by id ASC")->result();
                                     foreach ($statdiumInformations as $statdiumInformation)
                                     {
                                 ?>
                              <li class="<?=preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($statdiumInformation->category)); ?>-button">
                                 <a href="javascript:;" map-id="<?=$statdiumInformation->block_id; ?>" data-target="<?=$statdiumInformation->stadium_seat_id; ?>" data-class="<?=preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($statdiumInformation->category)); ?>" color-code="<?=$this
                                    ->General_Model
                                    ->color_name_to_hex($statdiumInformation->block_color); ?>"   onmouseover="showMouseOver(this)" onmouseout="hideMouseOver(this)" 
                                    onclick="selectCategory('<?=$statdiumInformation->stadium_seat_id; ?>')"><span class="seat_color" style="background:<?=$statdiumInformation->block_color; ?>"></span><?=$statdiumInformation->category; ?></a>
                              </li>
                              <?php
                                 }
                                 endif;
                                 ?>
                           </ul>
                           <?php
                              }
                              }
                              endif;
                              ?>
                        </div>
                        <div class="stadium_para">
                           <p>Buy Manchester United vs Brighton & Hove Albion FC tickets for the Premier League game being played on 15 February 2022 at Old Trafford. 1BoxOffice offers a wide range of Manchester United vs Brighton & Hove Albion FC tickets that suits most football fans budget. Contact 1BoxOffice today for more information on how to buy Manchester United tickets!</p>
                        </div>
                     </div>
                     <div class="column is-7">
                        <div class="columns is-multiline">
                           <div class="column is-12">
                              <div class="onebox-tickets-boook_details">
                                 <div class="tickets_left">
                                    <?php
                                       $ticketQuantityLeft = 0;
                                       $checkSellTicketData = $this
                                           ->db
                                           ->query("SELECT * FROM sell_tickets WHERE match_id = $matchId AND status=1 AND quantity !=0 order by price asc")->result();
                                       if (count($checkSellTicketData) >= 1)
                                       {

                                           foreach ($checkSellTicketData as $checkSellTicketDa)
                                           {
                                               $cart_session_tickets = 0;
                                               $checkCartSessionData = $this
                                                   ->db
                                                   ->query("SELECT * FROM cart_session WHERE sell_id = '" . $checkSellTicketDa->s_no . "' AND cart_session.expriy_datetime > '".date("Y-m-d H:i:s")."' ")
                                                   ->result();
                                               if ($checkCartSessionData)
                                               {
                                                   $cart_session_tickets = $checkCartSessionData[0]->no_ticket;
                                               }
                                       
                                               $ticketQuantityLeft += $checkSellTicketDa->quantity - $cart_session_tickets;
                                           }
                                       }
                                       ?>
                                    <p><span>only <?=$ticketQuantityLeft; ?> tickets</span> left for this event <i class="fas fa-fire"></i></p>
                                 </div>
                              </div>
                              <?php
                                 $get_listing_notes = $this
                                     ->General_Model
                                     ->getAllItemTable('seller_notes_restriction')
                                     ->result();
                                 if ($matchInfo):
                                     $sell_tickets = $this
                                         ->db
                                         ->query("SELECT * FROM sell_tickets WHERE status = '1' and match_id = '" . $matchInfo[0]->m_id . "'")
                                         ->result();
                                     if ($matchInfo[0]->availability == 1 && $sell_tickets)
                                     {
                                         $total_quanity = $this
                                             ->db
                                             ->query("SELECT sell_tickets.*,cart_session.no_ticket as temp_sold FROM sell_tickets LEFT JOIN cart_session ON sell_tickets.s_no = cart_session.sell_id  AND cart_session.expriy_datetime > '".date('Y-m-d H:i:s')."' where sell_tickets.match_id =$matchId" )->result_array();
                                         if ($total_quanity)
                                         {
                                             $max_tickets = array();
                                             foreach ($total_quanity as $key => $tq)
                                             {
                                                 $max_tickets[] = $tq['quantity'] - ($tq['temp_sold']);
                                             }
                                         }
                                 ?>
                              <div class="tickets_dropdown">
                                 <?php
                                    if ($checkSellTicketData):
                                        if (count($checkSellTicketData) >= 1)
                                        {
                                            if ($stadiumImage):
                                                $matchId = $matchInfo[0]->m_id;
                                                $maximumNoTickets = $this
                                                    ->db
                                                    ->query("SELECT Max(quantity ) as `max_ticket` FROM sell_tickets WHERE match_id = $matchId")->result();
                                    ?>
                                 <div class="ticket_quantity">
                                    <select class="form-control" name="nooftick" id="noofticket" onchange="noTickets(this.value)">
                                       <option value="0" selected><?php echo $this
                                          ->lang
                                          ->line('no_of_tickets_filter'); ?></option>
                                       <?php
                                          $i = 0;
                                          for ($i = 1;$i <= max($max_tickets);$i++)
                                          {
                                          ?>
                                       <option value="<?=$i; ?>"><?=$i; ?></option>
                                       <?php
                                          }
                                          ?>
                                    </select>
                                 </div>
                                 <?php
                                    endif;
                                    }
                                    endif;
                                    ?>
                                 <?php
                                    if ($stadiumImage):
                                        $matchId = $matchInfo[0]->m_id;
                                        $stadiumId = $stadiumImage[0]->s_id;
                                    
                                        $tickets_category = $this
                                            ->db
                                            ->query("SELECT ticket_category FROM sell_tickets WHERE match_id = $matchId  group by ticket_category")->result();
                                        if ($tickets_category)
                                        {
                                            foreach ($tickets_category as $tc)
                                            {
                                                $ticket_cat .= "'" . $tc->ticket_category . "',";
                                            }
                                        }
                                    
                                        $sellerDetails = $this
                                            ->db
                                            ->query("SELECT stadium_details.*,stadium_seats_lang.seat_category as category FROM stadium_details,stadium_seats_lang WHERE stadium_details.category = stadium_seats_lang.stadium_seat_id and stadium_seats_lang.language = 'en' and stadium_id = $stadiumId and category IN (" . substr($ticket_cat, 0, -1) . ")  group by stadium_details.category order by id ASC")->result();
                                    endif;
                                    ?>
                                 <div class="ticket_quality">
                                    <select class="form-control" name="allticktype" id="allticktype" onchange="selectType(this.value)">
                                       <option value="0" selected><?php echo $this
                                          ->lang
                                          ->line('all_ticket_types_filter'); ?></option>
                                       <?php
                                          foreach ($sellerDetails as $sellerDe)
                                          {
                                              $getStadiumSeatCategoryData = $this
                                                  ->General_Model
                                                  ->getAllItemTable_Array('stadium_seats_lang', array(
                                                  'seat_category' => $sellerDe->category
                                              ))
                                                  ->result();
                                              foreach ($getStadiumSeatCategoryData as $getStadiumSeatCategoryDa)
                                              {
                                          ?>
                                       <option value ="<?=$getStadiumSeatCategoryDa->stadium_seat_id; ?>"><?=$getStadiumSeatCategoryDa->seat_category; ?></option>
                                       <?php
                                          }
                                          }
                                          ?>
                                    </select>
                                 </div>
                                 <?php if ($matchInfo[0]->status != 0 && $sell_tickets)
                                    { ?>
                                 <div class="ticket_value">
                                    <p><?php echo $this
                                       ->lang
                                       ->line('ticket_prices_are'); ?></p>
                                 </div>
                                 <?php
                                    } ?>
                              </div>
                              <?php
                                 }
                                 endif;
                                 ?>
                              <?php
                                 if ($matchInfo):
                                     if ($matchInfo[0]->status == 1 && $sell_tickets)
                                     {
                                         $matchId = $matchInfo[0]->m_id;
                                         $checkSellTicketData = $this
                                             ->db
                                             ->query("SELECT * FROM sell_tickets WHERE match_id = $matchId AND status=1 AND quantity !=0 order by price asc")->result();
                                         if (count($checkSellTicketData) >= 1)
                                         {
                                             $k = 0;
                                             $full_block_data = [];
                                             if ($checkSellTicketData):
                                                 foreach ($checkSellTicketData as $checkSellTicketDa)
                                                 {
                                                     $categoryId = $checkSellTicketDa->ticket_category;
                                                     $defaultPrice = $checkSellTicketDa->price;
                                 
                                                     $cart_session_tickets = 0;
                                                     $checkCartSessionData = $this
                                                         ->db
                                                         ->query("SELECT * FROM cart_session WHERE sell_id = '" . $checkSellTicketDa->s_no . "'AND cart_session.expriy_datetime > '".date("Y-m-d H:i:s")."' ")
                                                         ->result();
                                                     if ($checkCartSessionData)
                                                     {
                                                         $cart_session_tickets = $checkCartSessionData[0]->no_ticket;
                                                     }
                                 
                                                     $ticketQuantity = $checkSellTicketDa->quantity - ( $cart_session_tickets);
                                                     if ($ticketQuantity != 0)
                                                     {
                                                         $sellerPercentageData = $this
                                                             ->General_Model
                                                             ->getAllItemTable('seller_percentage')
                                                             ->result();
                                                         $stadiumId = $stadiumImage[0]->s_id;
                                                         $totalPrice = $defaultPrice;
                                                         $getTicketCategoryData = $this
                                                             ->General_Model
                                                             ->getAllItemTable_Array('stadium_seats', array(
                                                             'stadium_seats.id' => $categoryId
                                                         ))->result();
                                 
                                                         foreach ($getTicketCategoryData as $getTicketCategoryDa)
                                                         {
                                                             if ($checkSellTicketDa->ticket_block && $checkSellTicketDa->ticket_block != "")
                                                             {
                                                                 $statdiumInformations = $this
                                                                     ->db
                                                                     ->query("SELECT stadium_details.*,stadium_seats_lang.seat_category as catgeory FROM stadium_details,stadium_seats_lang WHERE stadium_details.category = stadium_seats_lang.stadium_seat_id and stadium_seats_lang.language = 'en' and stadium_details.category = '$getTicketCategoryDa->id' AND stadium_id=$stadiumId GROUP BY stadium_details.stadium_id  order by id ASC")->result();
                                                             }
                                                             else
                                                             {
                                                                 $statdiumInformations = $this
                                                                     ->db
                                                                     ->query("SELECT stadium_details.*,stadium_seats_lang.seat_category as catgeory FROM stadium_details,stadium_seats_lang WHERE stadium_details.category = stadium_seats_lang.stadium_seat_id and stadium_seats_lang.language = 'en' and category = '$getTicketCategoryDa->id' AND stadium_id=$stadiumId order by id ASC LIMIT 1")->result();
                                                             }
                                 
                                                             foreach ($statdiumInformations as $statdiumInformation)
                                                             {
                                                                 $full_block_data[$categoryId][] = $checkSellTicketDa->ticket_block;
                                 ?>
                              <form class="checkoutform" id="checkout-<?=$checkSellTicketDa->s_no; ?>" action="<?=base_url('game/orders/checkout'); ?>" method="post">
                                 <input type="hidden" value="<?=$matchId; ?>" name="matcheventid">
                                 
                                 <input type="hidden" value="<?=$checkSellTicketDa->s_no; ?>" name="sellticketid">
                                 <input type="hidden" value="<?=$checkSellTicketDa->user_id; ?>" name="sellerId">
                                 <input type="hidden" value="" name="nooftick" class="noticketsform">
                                 <input type="hidden" value="<?=$statdiumInformation->stadium_id; ?>" name="stadiumid">
                                 <input type="hidden" value="<?=$this
                                    ->input
                                    ->get('customer_id'); ?>" name="customerid">
                                 <input type="hidden" value="setsession" name="sessionset">
                              </form>
                              <div id="seatid-<?php if ($checkSellTicketDa->ticket_block)
                                 {
                                     echo $checkSellTicketDa->ticket_block;
                                 }
                                 else
                                 {
                                     echo $checkSellTicketDa->s_no;
                                 }; ?>" data-ticketcategory="<?=$categoryId ?>" data-quantity="<?=$ticketQuantity ?>" data-class="<?=preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($statdiumInformation->category)); ?>" map-id="<?=$checkSellTicketDa->ticket_block; ?>" color-code="<?=$this
                                 ->General_Model
                                 ->color_name_to_hex($statdiumInformation->block_color); ?>" currency-price="<?=$this
                                 ->General_Model
                                 ->currencyConverterMap($totalPrice, $checkSellTicketDa->price_type, $this
                                 ->session
                                 ->userdata('currency')); ?>" class="seat_select_block_items columns is-multiline is-flex-tablet-p seat_select_items field <?=preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($statdiumInformation->category)); ?>" data-target="<?=$statdiumInformation->category; ?>" data-blockid="<?php if ($checkSellTicketDa->ticket_block && $checkSellTicketDa->ticket_block != "")
                                 {
                                     echo $checkSellTicketDa->ticket_block;
                                 }
                                 else
                                 {
                                     echo "0";
                                 } ?>" data-matchid="<?=$matchId; ?>"   onmouseover="showMouseOver(this)" onmouseout="hideMouseOver(this)" 
                                 >
                                 <div class="bor_left_hov" style="background:<?=$statdiumInformation->block_color; ?>;"></div>
                                 <div class="column is-4 pad_five">
                                    <div class="tick_all_items">
                                       <!-- <div class="tick_head">Location</div> -->
                                       <div class="tick_tier">
                                          <?php
                                             echo $statdiumInformation->catgeory;
                                             /*if ($checkSellTicketDa->listing_note && $checkSellTicketDa->listing_note != "")
                                             {
                                                 $listing_notes = [];
                                                 if ($get_listing_notes)
                                                 {
                                                     $expld_lst = explode(",", $checkSellTicketDa->listing_note);
                                                     foreach ($get_listing_notes as $lst_nt)
                                                     {
                                                         if (in_array($lst_nt->id, $expld_lst)) $listing_notes[] = $lst_nt->title;
                                                     }
                                             ?>
                                          <img src="<?=base_url('files/others/comment.png') ?>" data-toggle="tooltip" data-html="true" data-placement="<?php if ($k == 0)
                                             { ?>bottom<?php
                                             }
                                             else
                                             { ?>top<?php
                                             } ?>"  title="<?=implode(" </br> ", $listing_notes) ?>" >&nbsp;
                                          <?php
                                             }
                                             }*/
                                             
                                             if ($checkSellTicketDa->ticket_type):
                                             $getTicketTypeData = $this
                                                 ->General_Model
                                                 ->getAllItemTable_Array('ticket_types', array(
                                                 'ticket_types.id' => $checkSellTicketDa->ticket_type
                                             ))
                                                 ->result();
                                             foreach ($getTicketTypeData as $getTicketTypeData)
                                             {/*
                                             ?>
                                          <img src="<?=base_url('files/ticket_type/' . $getTicketTypeData->type_image) ?>" data-toggle="tooltip" data-placement="<?php if ($k == 0)
                                             { ?>bottom<?php
                                             }
                                             else
                                             { ?>top<?php
                                             } ?>" title="<?=$getTicketTypeData->ticket_type_name ?>" style="max-height: 20px;">
                                          <?php
                                             */}
                                             endif;
                                             ?>
                                          <!-- <i class="fas fa-file-pdf"></i> -->
                                       </div>
                                       <div class="tick_text"><i class="fas fa-badge-dollar"></i> This ticket is below market price</div>
                                    </div>
                                 </div>
                                 <div class="column is-3 pad_five">
                                    <div class="tick_quan">
                                       <div class="tick_head">Quantity</div>
                                       <div class="quan ticket_tab_flt4">
                                          <?php
                                             $maximumNoTickets = $this
                                                 ->db
                                                 ->query("SELECT Max(quantity ) as `max_ticket` FROM sell_tickets WHERE s_no = '" . $checkSellTicketDa->s_no . "'")
                                                 ->result();
                                             if ($checkSellTicketDa->split == '2')
                                             {
                                                 $noofticket = $checkSellTicketDa->quantity;
                                             ?>
                                          <select class="form-control" name="nooftick<?php echo $checkSellTicketDa->s_no; ?>" id="noofticket<?php echo $checkSellTicketDa->s_no; ?>">
                                             <option value="<?=$checkSellTicketDa->quantity; ?>"><?=$checkSellTicketDa->quantity; ?></option>
                                          </select>
                                          <?php
                                             }
                                             elseif ($checkSellTicketDa->split == '4')
                                             {
                                                 $i = 0;
                                                 for ($i = 1;$i < $maximumNoTickets[0]->max_ticket + 1;$i++)
                                                 {
                                                     if ($i % 2 === 0)
                                                     {
                                                         if ($sessionArray['noTickets'] == $i)
                                                         {
                                                             $noofticket = $i;
                                                         }
                                                     }
                                                 }
                                             ?>                                                        
                                          <select class="form-control" name="nooftick<?php echo $checkSellTicketDa->s_no; ?>" id="noofticket<?php echo $checkSellTicketDa->s_no; ?>">
                                             <?php
                                                $i = 0;
                                                for ($i = 1;$i < $maximumNoTickets[0]->max_ticket + 1;$i++)
                                                {
                                                    if ($i % 2 === 0)
                                                    {
                                                        if ($sessionArray['noTickets'] == $i)
                                                        {
                                                            $noofticket = $i;
                                                        }
                                                ?>
                                             <option value="<?=$i; ?>"><?=$i; ?></option>
                                             <?php
                                                }
                                                }
                                                ?>
                                          </select>
                                          <?php
                                             }
                                             else
                                             {
                                             ?>                                       
                                          <select class="form-control" name="nooftick<?php echo $checkSellTicketDa->s_no; ?>" id="noofticket<?php echo $checkSellTicketDa->s_no; ?>">
                                             <?php
                                                $i = 0;
                                                for ($i = 1;$i < $maximumNoTickets[0]->max_ticket + 1;$i++)
                                                {
                                                    if ($sessionArray['noTickets'] == $i)
                                                    {
                                                        $noofticket = $i;
                                                    }
                                                ?>
                                             <option value="<?=$i; ?>"><?=$i; ?></option>
                                             <?php
                                                }
                                                ?>
                                          </select>
                                          <?php
                                             }
                                             ?>
                                       </div>
                                       <div class="tick_text <?php
                                          if ($ticketQuantity <= 2)
                                          {
                                              echo 'red_notice';
                                          };
                                          ?>">
                                          <span>
                                          <?php
                                             if ($ticketQuantity <= 2)
                                             {
                                                 echo $this
                                                     ->lang
                                                     ->line('only');
                                             };
                                             ?> <?=$ticketQuantity; ?> <?php
                                             if ($ticketQuantity <= 1)
                                             {
                                                 echo $this
                                                     ->lang
                                                     ->line('ticket');
                                             }
                                             else
                                             {
                                                 echo $this
                                                     ->lang
                                                     ->line('ticket_s');
                                             };
                                             ?>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="column is-2 pad_five">
                                    <div class="tick_price">
                                       <div class="tick_head">Price</div>
                                       <div class="tick_price_range"><?=$totalPrice.' '.$checkSellTicketDa->price_type ?></div>
                                    </div>
                                 </div>
                                 <div class="column is-3 pad_five">
                                    <div class="tick_buy">
                                       <!-- <div class="tick_view"><i class="fas fa-eye"></i> 8 Viewing Now</div> -->
                                       <div class="tick_book_btn"><a href="javascript:void(0)" data-sellid="<?=$checkSellTicketDa->s_no; ?>" onclick="goCheckOut(this)">Select</a></div>
                                       <!-- <div class="tick_text"><span>someone just booked a ticket!</span></div> -->
                                    </div>
                                 </div>
                              </div>
                              <?php
                                 }
                                 }
                                 }
                                 $k++;
                                 }
                                 endif;
                                 ?>
                              <p id="ticket-message"></p>
                              <?php
                                 }
                                 else
                                 {
                                 ?>
                              <p><?php echo $this
                                 ->lang
                                 ->line('no_tickets_available'); ?></p>
                              <?php
                                 }
                                 }
                                 elseif ($matchInfo[0]->match_date < date("Y-m-d H:i"))
                                 {
                                 ?>
                              <div class="ticket_request_content">
                                 <br />  
                                 <p> <?php echo $this
                                    ->lang
                                    ->line('sorry_no_tickets_available'); ?> </p>
                                 <br />
                                 <p><?php echo $this
                                    ->lang
                                    ->line('please_send_an_email'); ?> <a href="mailto:sales@1boxoffice.com">Sales@1boxoffice.com</a> <?php echo $this
                                    ->lang
                                    ->line('for_tickets_updates'); ?> </p>
                              </div>
                              <?php
                                 }
                                 elseif ($matchInfo[0]->availability == 0 || !$sell_tickets)
                                 {
                                 ?>
                              <div class="ticket_request_content">
                                 <p><?php echo $this
                                    ->lang
                                    ->line('no_available_tickets'); ?></p>
                                 <a class="ticket_request_link" href="<?=base_url('request-ticket/' . $matchInfo[0]->m_id) ?>">Request Now</a>
                              </div>
                              <?php
                                 }
                                 endif;
                                 ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php if($cid != ''){ ?>
                  <div id="order-checkout-section">
                     <div class="food-delivery-dashboard">
                        <form id="category-form" method="post" class=" login-wrapper form_req_validation" action="<?php echo base_url(); ?>game/orders/save_order">
                           <div class="add_details">
                              <div class="columns is-multiline is-flex-tablet-p">
                                 <div class="column is-8">
                                    <div class="price">
                                       <h2>Billing Details</h2>
                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">First Name</label>
                                             <input type="text" class="input" minlength="2" placeholder="First Name" id="first_name" name="first_name" value="<?=$selected_customer->first_name?>" required />
                                             <input type="hidden" name="process_checkout" value="1">
                                             <input type="hidden" name="matchid" value="<?= $sessionArray['matcheventid']; ?>">
                                             <input type="hidden" name="totalprice" class="totalPayment" value="">
                                             <input type="hidden" name="lastshippingid" class="lastShippingId" value="">
                                             <input type="hidden" name="discountvalue" class="discountvalue">
                                             <input type="hidden" name="coupontype" value="" class="hiddencouponType">
                                             <input type="hidden" name="stadiumblockid" value="<?= $stadiumdetails[0]->ticket_block; ?>">
                                             <input type="hidden" name="sellid" value="<?= $sessionArray['sellticketid']; ?>">
                                             <input type="hidden" name="notickets" class='hiddennoTickets' value="<?php
                                                if (!empty($sessionArray['noTickets'])) {
                                                    echo $sessionArray['noTickets'];
                                                } else {
                                                    echo 1;
                                                };
                                                ?>">
                                             <input type="hidden" name="discount" id="discountvalue">
                                             <?php
                                                $team1 = $this->General_Model->getAllItemTable_Array('teams', array('teams.id' => $matcheventdetails[0]->team_1))->result();
                                                $team2 = $this->General_Model->getAllItemTable_Array('teams', array('teams.id' => $matcheventdetails[0]->team_2))->result();
                                                $tournamentName = $this->General_Model->getAllItemTable_Array('tournament', array('t_id' => $matcheventdetails[0]->tournament))->result();
                                                ?>
                                             <input type="hidden" name="matchname" value="<?= $team1[0]->team_name . '-' . $team2[0]->team_name; ?>">
                                             <input type='hidden' name="tournamentname" value="<?= $tournamentName[0]->tournament_name; ?>">
                                             <input type="hidden" id="userId" name="userId" value="<?= $selected_customer->id ?>">
                                          </div>
                                       </div>
                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Last Name</label>
                                             <input type="text" class="input" minlength="2" placeholder="Last Name" id="last_name" name="last_name" value="<?=$selected_customer->last_name?>" required />
                                          </div>
                                       </div>
                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Address</label>
                                             <input type="text" class="input" minlength="2" placeholder="Address" id="address" name="address" value="<?=$selected_customer->address?>" required />
                                          </div>
                                       </div>
                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Postcode</label>
                                             <input type="text" class="input" minlength="2" placeholder="Postcode" id="postcode" name="postcode" required value="<?=$selected_customer->code?>" />
                                          </div>
                                       </div>
                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="section">Select Country </label>
                                             <select name="country" class="countries form-control" id="country" required>
                                                <option value="">Select Country</option>
                                                <?php foreach ($allCountries as $allCount) { ?>
                                                <option value="<?= $allCount->id; ?>" <?php if ($getRegisterDataByid){ if ($getRegisterDataByid[0]->country == $allCount->id) { echo 'selected'; } } else { if($allCount->id == '230'){ echo 'selected'; } }?>><?= $allCount->name; ?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="section">Select City</label>
                                             <select name="city" class="form-control" id="cityAd" required>
                                                <option value="">Select City</option>
                                                <?php
                                                   $stateValue = $this->General_Model->getAllItemTable_Array('states', array('country_id' => $getRegisterDataByid[0]->country))->result();
                                                   foreach ($stateValue as $getMatch) {
                                                   ?>
                                                <option value="<?= $getMatch->id; ?>" <?php if ($stateValue): if ($getRegisterDataByid[0]->city == $getMatch->id) { echo 'selected'; } endif;?>><?= $getMatch->name; ?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                        <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Phone Code</label>
                                             <input type="text" id="phoneCode" placeholder="e.g. +1 702 123 4567" name="phoneCode" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->phonecode; endif; ?>" required>
                                          </div>
                                       </div>
                                        <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Phone</label>
                                             <input type="text" placeholder="" name="billingphonenumber" id="billingPhonenumber" class="input-box" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->mobile; endif; ?>" required>                                                        
                                             <input type="hidden" id="stadiumblockid" name="stadiumblockid" value="<?= $stadiumdetails[0]->ticket_block; ?>">
                                          </div>
                                       </div>
                                       <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Email</label>
                                             <input type="text" id="email" placeholder="Email" name="email" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->email; endif; ?>" required>
                                          </div>
                                       </div>
                                      <!--  <div class="column is-one-three">
                                          <div class="details">
                                             <label for="row">Phone</label>
                                             <input type="text" id="phoneCode" placeholder="e.g. +1 702 123 4567" name="phonecode" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->phonecode; endif; ?>" readonly>
                                             <input type="text" placeholder="" name="billingphonenumber" id="billingPhonenumber" class="input-box" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->mobile; endif; ?>">                                                        
                                             <input type="hidden" id="stadiumblockid" name="stadiumblockid" value="<?= $stadiumdetails[0]->ticket_block; ?>">
                                          </div>
                                       </div> -->
                                       <div class="column is-one-three">
                                          <?php if($stadiumdetails[0]->ticket_type != 2) { ?>
                                          <div class="field check_box_coll button_container">
                                             <?php if(count($addresses) >= 0) { ?>
                                             <label><input type="checkbox" checked id="notSameaddress">Billing Address Same<i></i></label>
                                             <label><input type="checkbox" value="" id="notLater">Shipping Address<i></i></label>
                                             <?php } ?>
                                          </div>
                                          <?php } ?>
                                       </div>
                                       <div class="shipping_address_new" style="display: none;">
                                          <div class="column is-one-three">
                                             <div class="details shipfirstname"> 
                                                <label>First Name *</label>
                                                <input type="text" placeholder="" name="shipfirstname" id="shipfirstname" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->first_name; endif; ?>">
                                             </div>
                                          </div>
                                          <div class="column is-one-three">
                                             <div class="details shiplastname"> 
                                                <label>Last Name *</label>
                                                <input type="text" placeholder="" name="shiplastname" id="shiplastname" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->last_name; endif; ?>">
                                             </div>
                                          </div>
                                          <div class="column is-one-three">
                                             <div class="details shipAddress"> 
                                                <label>Address *</label>
                                                <input type="text" placeholder="" name="shipaddress" id="shipAddress" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->address; endif; ?>">
                                             </div>
                                          </div>
                                          <div class="column is-one-three">
                                             <div class="details shipPostalcode"> 
                                                <label>Postal Code *</label>
                                                <input type="text" placeholder="" name="shippostalcode" id="shipPostalcode" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->code; endif; ?>">
                                             </div>
                                          </div>
                                          <div class="column is-one-three">
                                             <div class="details shipCity">
                                                <label>Select City *</label>
                                                <select name="shipCity" class="form-control" id="shipCity">
                                                   <option value="">Select City</option>
                                                   <?php 
                                                      $stateValue = $this->General_Model->getAllItemTable_Array('states', array('country_id' => $getRegisterDataByid[0]->country))->result();
                                                      foreach ($stateValue as $getMatch) {
                                                      ?>
                                                   <option value="<?= $getMatch->id; ?>" <?php if ($stateValue): if ($getRegisterDataByid[0]->city == $getMatch->id) { echo 'selected'; } endif; ?>><?= $getMatch->name; ?></option>
                                                   <?php } ?>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="column is-one-three">
                                             <div class="details shipCountry">
                                                <label>Select Country *</label>
                                                <select name="shipCountry" class="form-control countries" id="shipCountry">
                                                   <option value="">Select Country</option>
                                                   <?php foreach ($allCountries as $allCount) { ?>
                                                   <option value="<?= $allCount->id; ?>" <?php if ($getRegisterDataByid){ if ($getRegisterDataByid[0]->country == $allCount->id) { echo 'selected'; } } else { if($allCount->id == '230'){ echo 'selected'; } } ?>><?= $allCount->name; ?></option>
                                                   <?php } ?>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="column is-one-three">
                                             <div class="ship_country country_phone details">
                                                <input type="text" id="shipPhonecode" placeholder="" name="shipphonecode" value="<?php if ($getRegisterDataByid): echo $allCount->phonecode; endif; ?>" readonly>
                                                <input type="text" placeholder="" name="shipphonenumber"  id="shipPhonenumber" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->phone; endif; ?>">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="column is-4">
                                    <div class="select_resti">
                                       <div class="selec_head">
                                          <h4>Event Information</h4>
                                       </div>
                                       <div class="details">
                                          <?php
                                             if ($matcheventdetails):
                                                 if($matcheventdetails[0]->event_type == 'match'){
                                                     $team1 = $this->General_Model->getAllItemTable_Array('teams', array('teams.id' => $matcheventdetails[0]->team_1))->result();
                                                     $team2 = $this->General_Model->getAllItemTable_Array('teams', array('teams.id' => $matcheventdetails[0]->team_2))->result();
                                                     $stadiumName = $this->General_Model->getAllItemTable_Array('stadium', array('s_id' => $matcheventdetails[0]->venue))->result();
                                                     $tournamentname = $this->General_Model->getAllItemTable_Array('tournament', array('tournament.t_id' => $matcheventdetails[0]->tournament))->result();
                                                     echo '<h5>' . $team1[0]->team_name . ' v ' . $team2[0]->team_name . '</h5>';
                                                 } else {
                                                     echo $matcheventdetails[0]->match_name;
                                                 }
                                             endif;
                                             ?>
                                          <p>
                                             <?php
                                                if ($matcheventdetails){ 
                                                    echo str_replace("-"," ",$tournamentname[0]->tournament_name);
                                                }
                                                ?>
                                          </p>
                                          <p>
                                             <?php
                                                if ($matcheventdetails){ 
                                                    echo str_replace("-"," ",$stadiumName[0]->stadium_name);
                                                }
                                                ?>
                                          </p>
                                          <br />
                                          <h4>Date & Time</h4>
                                          <p>
                                             <span class="tr_date">
                                             <strong>
                                             <?php
                                                if ($matcheventdetails): echo date("D jS F Y", strtotime($matcheventdetails[0]->match_date)) . ': ' . $matcheventdetails[0]->match_time; endif
                                                ?>
                                             </strong>
                                             </span>
                                          </p>
                                          <p>
                                             <?php
                                                // echo "<pre>";print_r($stadiumdetails);
                                                     $seatCategoryData = $this->General_Model->getAllItemTable_Array('stadium_seats', array('stadium_seats.id' => $stadiumdetails[0]->ticket_category))->result();
                                                     if ($stadiumdetails): 
                                                         echo $seatCategoryData[0]->seat_category;
                                                     endif;
                                                     
                                                 ?>
                                          </p>
                                          <h4>Ticket Type</h4>
                                          <span class="span_ltr" style="direction:ltr;">                                                    
                                          <?php 
                                             if ($stadiumdetails[0]->ticket_type): 
                                                           if($stadiumdetails[0]->ticket_type == 1){
                                                            echo "Season cards";
                                                           }
                                                           else if($stadiumdetails[0]->ticket_type == 2){
                                                            echo "E-Tickets";
                                                           }
                                                           else if($stadiumdetails[0]->ticket_type == 3){
                                                            echo "Paper";
                                                           }
                                                           else if($stadiumdetails[0]->ticket_type == 4){
                                                            echo "Mobile";
                                                           }
                                                        endif;
                                             ?>
                                          </span> 
                                          <?php if($stadiumdetails[0]->row){ ?>
                                          <h4>Ticket Row</h4>
                                          <span class="span_ltr" style="direction:ltr;">                                                    
                                          <?php 
                                             echo $stadiumdetails[0]->row;
                                             ?>
                                          </span> 
                                          <?php } ?>
                                          <?php if($stadiumdetails[0]->ticket_block){ ?>
                                          <h4>Ticket Block</h4>
                                          <span class="span_ltr" style="direction:ltr;">                                                    
                                          <?php 
                                             echo $stadiumdetails[0]->ticket_block;
                                             ?>
                                          </span> 
                                          <?php } ?>
                                          <input type="hidden" id="maximumTickets" value="<?= $stadiumdetails[0]->quantity ?>">
                                          <br />
                                          <h4>Price</h4>
                                          <?php 
                                             $matchId = $sessionArray['matcheventid'];
                                             $sellticketId = $sessionArray['sellticketid'];
                                             $maximumNoTickets = $this->db->query("SELECT Max(quantity ) as `max_ticket` FROM sell_tickets WHERE s_no = $sellticketId")->result();
                                             ?>
                                          <?php 
                                             if($stadiumdetails[0]->split == '2') {
                                                 $noofticket = $stadiumdetails[0]->quantity;
                                             } elseif($stadiumdetails[0]->split == '4') {
                                                 $i = 0;
                                                 for ($i = 1; $i < $maximumNoTickets[0]->max_ticket + 1; $i++) {                                                                 
                                                     if($i % 2 === 0) {                                                            
                                                         if ($sessionArray['noTickets'] == $i) {
                                                             $noofticket =  $i;
                                                         }
                                                     }
                                                 
                                                 }
                                             } else {
                                                 $i = 0;
                                                 for ($i = 1; $i < $maximumNoTickets[0]->max_ticket + 1; $i++) {                                                         
                                                     if ($sessionArray['noTickets'] == $i) {
                                                         $noofticket =  $i;
                                                     }
                                                 }
                                             } 
                                             
                                             echo $noofticket; 
                                             ?>
                                          <input type="hidden" name="nooftick" id="noofticket" class="ticketnumber" value="<?php echo $noofticket; ?>" />
                                          <?php  
                                             $sellerPercentageData = $this->General_Model->getAllItemTable('seller_percentage')->result();   
                                             ?>
                                          <input type="hidden" value="<?= $sellerPercentageData[0]->arrangement_fee / 100 ?>" id="sellerArragementPercentage">
                                          Tickets at
                                          <span class="span_ltr" style="direction:ltr;">                                                    
                                          <?php 
                                             echo $totalCartPrice." ".$priceType;
                                             ?>
                                          </span> 
                                          Each                                                            
                                          <input type="hidden" value="<?php echo $this->General_Model->currencyConverterMap2($totalPrice,$stadiumdetails[0]->price_type,$this->session->userdata('currency')); ?>" id="hiddenprice">
                                          <input type="hidden" value="<?= $sellerPercentageData[0]->arrangement_fee / 100 ?>" id="sellerArragementPercentage">
                                          <p id="arrangementFee_detail"></p>
                                          <p id="discount-area" style="display:none"><span>Discount </span> <strong id="discountprice"></strong>
                                          </h5>
                                          <input type="hidden" value="" class="discountvalue">
                                          <input type="hidden" value="" id="hiddenTotalPrice">
                                          <input type="hidden" value="" class="hiddencouponType">
                                          <h2>Total <?php echo $noofticket * $totalCartPrice.' '.$priceType;?></h2>
                                          <?php if(strtoupper($priceType) == 'EUR'){ ?>                                                    
                                          <p style="font-size:12px;">Total Approx<span class="span_ltr" style="direction:ltr;"><?php echo $seller_currency; ?><span id="totalPrice_approxi"></span></span></p>
                                          <?php } ?>
                                       </div>
                                       <div class="upcoming-match-btn-view-all">
                                          <button style="cursor: pointer;" class="onebox-btn">Confirm Order</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <?php
                     } ?>
                  <?php
                     } ?>
                  <?php
                     }
                     else
                     { ?>
                  <?php
                     } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $this
   ->load
   ->view('common/footer'); ?>
<script>
   $('#event_selection_id').change(function(e) {
       let customer_id = $('#customer_selection_id').val();
       if(customer_id == "") return;
   
       var uri = window.location.toString();
       if (uri.indexOf("?") > 0) {
           var clean_uri = uri.substring(0, uri.indexOf("?"));
           window.history.replaceState({}, document.title, clean_uri);
       }
   
       window.location.href = '?match_id=' + $(this).val() + "&customer_id="+customer_id;
   });
</script>
<?php if ($this
   ->uri
   ->segment(3) != 'checkout')
   { ?>

<script type="text/javascript">
   var full_block_data =<?=json_encode($full_block_data) ?>;
   var stadium_block_details =<?=$set_stadium_blocks ?>;
   var stadium_cat_details =<?=$set_stadium_blocks_with_cat ?>;
   var stadium_with_cat_name =<?=$set_stadium_cat_name ?>;
   var ticket_price_info =<?=$ticket_price_info ?>;
   var ticket_price_info_with_cat =<?=$ticket_price_info_with_cat ?>;
   var current_category = 0;
</script>
<script type="text/javascript">

   //console.log(full_block_data);
   jQuery(document).ready(function () {

if ($('#customer_selection_id').length) new Choices('#customer_selection_id', {
               removeItemButton: !0
            });
if ($('#event_selection_id').length) new Choices('#event_selection_id', {
               removeItemButton: !0
            });
$('#category-form').validate({

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



       var stadiumId = '<?php if ($stadiumImage):
      echo $stadiumImage[0]->s_id;
      endif; ?>';
       $.ajax({
           type: "POST",
           url: "<?=base_url('game/getStadiumByid') ?>",
           data: {'stadiumid': stadiumId},
           success: function (response)
           {
               // console.log(response);
               var jsonObject = $.parseJSON(response);
               var status = jsonObject['Status'];
               var getJsonArray = jsonObject['Json'];
               var object = getJsonArray[0];
               var stadiumCode = object['map_code'];
               var stadiumValue = $.parseJSON(stadiumCode);
               if (status == 'OK') {
   
                   jQuery("#mapsvg").mapSvg(stadiumValue);
   
                   setTimeout(function () {
                       var svg_data = stadiumValue;
                       $.each(svg_data.regions, function (svg_itm, svg_val) {
                           if ($("#" + svg_val.id).attr("class")) {
                               var exist_class = $("#" + svg_val.id).attr("class");
                           } else {
                               var exist_class = "";
                           }
   
                           $("#" + svg_val.id).attr("class", exist_class + " " + svg_val.href.replace(/[^a-zA-Z0-9]/g, '').toLowerCase());
                           $("#" + svg_val.id).attr("data-cat", stadium_with_cat_name[svg_val.href][0]);
                           //$('.mapsvg-region').css('pointer-events', 'none');
   
                       });
                       $(".mapsvg-region").each(function () {
                           $(this).css('opacity', '0.5');
                           // console.log('full_block_data', full_block_data)
                           if (full_block_data == null) {
                               /* $(".mapsvg-region").each(function () {
                                $(this).css('opacity', '0.5');
                                }); */
   
                           } else {
                               $('.mapsvg-region').css('pointer-events', '');
                               $.each(full_block_data, function (indx, itm) {
                                   if (itm != '') {
                                       $.each(itm, function (indx2, itm2) {
                                           if(itm2 != "") {
                                               $('#' + itm2).css('opacity', '1');
                                               $('#' + itm2).css('cursor', 'pointer');
                                           }
                                       })
                                   }
                               });
                           }
   
                       });
   
   <?php if ($checkSellTicketData):
      if (count($checkSellTicketData) >= 1)
      {
      ?>
                               //$('#content-l').css({'height': $('#Layer_1').innerHeight()});
                               var heightValue = parseInt($('#Layer_1').innerHeight() - 46);
                               //$('#content-l').css({'height': heightValue});
   
   <?php
      }
      endif;
      ?>
                       $(".statium_select_seat").removeAttr("style");
                       $("#mapsvg").css("visibility", "visible");
                   }, 2000);
               }
           }
       });
   
   });
   
   
</script>
<script type="text/javascript">
   function noTickets(value) {
       $('.noticketsform').each(function () {
           $(this).val(value);
       });
   
       var matchId = '<?=$matchInfo[0]->m_id ?>';
       var ticketType = $('#allticktype').val();
       if (ticketType != 0) {
           var ticketcategory = stadium_with_cat_name[ticketType][0];
           data = {'matchid': matchId, 'notickets': value, 'ticketcategory': ticketcategory};
       } else {
           data = {'matchid': matchId, 'notickets': value};
       }
       $.ajax({
           type: 'POST',
           url: '<?=base_url('game/getSellTicketsById') ?>',
           data: data,
           success: function (response) {
               var jsonObject = $.parseJSON(response);
               var status = jsonObject['Status'];
               var getJsonArray = jsonObject['Json'];
               // console.log(getJsonArray.length);
               /*$("#allticktype").val("0");
                $("#allticktype").trigger("change");*/
               if (getJsonArray != '') {
                   $.each(getJsonArray, function (index, item) {
                       // console.log("#seatid-" + item.s_no);
                       if (item.ticket_block != '') {
                           //  $('#text-message').text('Ticket prices are set by sellers and may be below or above face value.');
                           $("#seatid-" + item.ticket_block).each(function (i) {
                               $(this).hide().delay(i * 1).fadeIn(1).siblings(".seat_select_items").hide();
                           });
                       } else {
                           $('#ticket-message').text('');
                           $("#seatid-" + item.s_no).each(function (i) {
                               $(this).hide().delay(i * 1).fadeIn(1).siblings(".seat_select_items").hide();
                               
                           });
                       }
                   });
                   
                   $('.ticket_tab_flt4 select').val(value);
                   
               } else {
                   $('#ticket-message').text('there are no tickets matching your criteria');
                   $(".seat_select_items").hide();
               }
   
           }
       })
   }
   
   function goCheckOut(obj) {
       var sellticid = obj.getAttribute('data-sellid');
       
       $("#checkout-" + sellticid + " input[name=nooftick]").val($('#noofticket'+sellticid).val());
   
       $('.tick_book_btn > a').html('select').removeClass('ticket-selected');
   
       $(obj).html('selected').addClass('ticket-selected');
       
       // $('#checkout-' + sellticid).submit();
   
       $.ajax({
           type: 'POST',
           url: $('#checkout-' + sellticid).attr('action'),
           data: $('#checkout-' + sellticid).serialize(),
           success: function(response) {
               var jsonObject = $.parseJSON(response);
               if(jsonObject.status == 1){
                   window.location.href = "<?php echo base_url();?>game/orders/add_order?match_id="+jsonObject.match_id+"&customer_id="+jsonObject.customer_id+"&cid="+jsonObject.cid;
               }
               else{
                   alert(jsonObject.msg);
               }
               
              // $('#order-checkout-section').html(response);
           }
       });
   }
   
   
   function selectType(value) {
       // console.log('value', value)
       if (value != 0) {
           $(".seat_select_items").hide();
       } else {
           $(".seat_select_items").show();
       }
       selectCategory(value);
   }
   
   
   $(document).ready(function () {
     /*  $('[data-toggle="tooltip"]').tooltip();*/
       $('.chng_cur').on('click', function () {
           var selected = $(this).data('currency');
           $.ajax({
               type: "POST",
               url: "<?php echo base_url('home/setcurrency'); ?>",
               data: {'currency': selected},
               success: function (response)
               {
                   location.reload();
               }
           });
       });
   
       //Dhana Moorthi
       /*          setTimeout(function () {
        var stickyNavTop = jQuery('.ticket_sold_notice').offset().top;
        
        var stickyNav = function () {
        var scrollTop = jQuery(window).scrollTop();
        
        if (scrollTop > stickyNavTop) {
        jQuery('.ticket_sold_notice').addClass('sticky');
        } else {
        jQuery('.ticket_sold_notice').removeClass('sticky');
        }

        };
        
        stickyNav();
        jQuery(window).scroll(function () {
        stickyNav();
        });
        }, 1000); */
   
   });
   function selectCategory(value) { 
       // console.log('value - tt', value);
       $("#allticktype").val(value);
       if (value == 0) {
           current_category = 0;
           $(".seat_select_items").each(function (i) {
               $(this).show();
           });
           $.each(stadium_cat_details, function (indx, itm) {
               $.each(itm, function (indx2, itm2) {
                   //$('#'+itm2).css('opacity', '1');
                   $('#' + itm2).css({fill: stadium_block_details[itm2]});
                   var sn_exst = 0;
                   $.each(full_block_data, function (indx_s, itm_s) {
                       if ($.inArray(itm2, itm_s) !== -1) {
                           sn_exst++;
                           //break;
                       }
                   });
   
                   if (sn_exst > 0) {
                       $('#' + itm2).css('opacity', '1');
                   } else {
                       $('#' + itm2).css('opacity', '0.5');
                   }
               });
           });
           //$('.mapsvg-region').css('pointer-events', '');
       } else {
           var selectCategory = value.replace(/[^a-zA-Z0-9]/g, '').toLowerCase();
           //console.log(selectCategory);
           var categoryId = stadium_with_cat_name[value][0];
           current_category = categoryId;
           $(".mapsvg-region").css({fill: 'rgb(221, 221, 221)'});
           //$(".mapsvg-region").css('pointer-events', 'none');
           $.each(stadium_cat_details, function (indx, itm) {
               if (parseInt(indx) == parseInt(categoryId)) {
                   $.each(itm, function (indx2, itm2) {
                       $('#' + itm2).css({fill: stadium_block_details[itm2]});
                       //$('#'+itm2).css('pointer-events', '');
                       var sn_exst = 0;
                       $.each(full_block_data, function (indx_s, itm_s) {
                           if ($.inArray(itm2, itm_s) !== -1) {
                               sn_exst++;
                               //break;
                           }
                       });
   
                       if (sn_exst > 0) {
                           $('#' + itm2).css('opacity', '1');
                       } else {
                           $('#' + itm2).css('opacity', '0.5');
                       }
   
                   });
               }
           });
       } 
   
       var no_tckt = $("#noofticket").val();
       if (no_tckt != '') {
           var matchId = '<?=$matchInfo[0]->m_id ?>';
           var ticketType = $('#allticktype').val();
           if (ticketType != 0 && ticketType != null) {
               var ticketcategory = stadium_with_cat_name[ticketType][0];
               data = {'matchid': matchId, 'notickets': no_tckt, 'ticketcategory': ticketcategory};
           } else {
               data = {'matchid': matchId, 'notickets': no_tckt};
           }
   
           $.ajax({
               type: 'POST',
               url: '<?=base_url('game/getSellTicketsById') ?>',
               data: data,
               success: function (response) {
                   // console.log(response);
                   var jsonObject = $.parseJSON(response);
                   var status = jsonObject['Status'];
                   var getJsonArray = jsonObject['Json'];
                   if (getJsonArray.length != 0) {
                       $.each(getJsonArray, function (index, item) {
                           if (item.ticket_block != '') {
   
                               $('#ticket-message').text('');
                               $("#seatid-" + item.ticket_block).each(function (i) {
                                   $(this).hide().delay(i * 1).fadeIn(1).siblings(".seat_select_items").hide();
                               });
   
                           } else if (item.s_no != '') {
                               $('#ticket-message').text('');
                               $("#seatid-" + item.s_no).each(function (i) {
                                   $(this).hide().delay(i * 1).fadeIn(1).siblings(".seat_select_items").hide();
                               });
   
                           } else {
                               $('#ticket-message').text('there are no tickets matching your criteria');
                               $(".seat_select_items").hide();
   
                           }
                       });
                   } else {
                       $('#ticket-message').text('there are no tickets matching your criteria');
                       $(".seat_select_items").hide();
                   }
               }
           });
       } else {
           $("." + selectCategory).each(function (i) {
               $(this).hide().delay(i * 1).fadeIn(1).siblings(".seat_select_items").hide();
           });
       }
   }
   
   function showMouseOver(obj) {
       var mouseHover = obj.getAttribute('data-target');
       var categoryId = obj.getAttribute('data-ticketcategory');
       var matchId = obj.getAttribute('data-matchid');
       var blockColor = obj.getAttribute('color-code');
       var ticketsCount = obj.getAttribute('tickets');
       var mapId = obj.getAttribute('map-id');
       var blockId = obj.getAttribute('data-blockid');
       var dataClass = obj.getAttribute('data-class');
       var mouseHoverValue = mouseHover.replace(/[^a-zA-Z0-9]/g, '').toLowerCase();
       if (ticketsCount == 0) {
           return false;
       } else {
           //$(".mapsvg-region").css('opacity', '0.5');
           $(".mapsvg-region").css({fill: 'rgb(221, 221, 221)'});
           if (blockId != "0") {
               $('#' + blockId).css('opacity', '1');
               $('#' + blockId).css({fill: stadium_block_details[blockId]});
           } else {
   
               $.each(stadium_cat_details, function (indx, itm) {
                   if (parseInt(indx) == parseInt(categoryId)) {
                       $.each(itm, function (indx2, itm2) {
                           var sn_exst = 0;
                           $('#' + itm2).css({fill: stadium_block_details[itm2]});
                           $.each(full_block_data, function (indx_s, itm_s) {
                               if ($.inArray(itm2, itm_s) !== -1) {
                                   sn_exst++;
                                   //break;
                               }
                           });
   
                           if (sn_exst > 0) {
                               $('#' + itm2).css('opacity', '1');
                           } else {
                               $('#' + itm2).css('opacity', '0.5');
                           }
                       });
                   }
               });
               /*$.each(full_block_data,function(indx, itm){
                if(parseInt(indx)==parseInt(categoryId)){
                $.each(itm,function(indx2, itm2){
                $('#'+itm2).css('opacity', '1');
                $('#'+itm2).css({fill: stadium_block_details[itm2]});
                });

                }
                });*/
           }
           if (mapId) {
               //$('#seatid-'+mapId).css('background', 'linear-gradient(to right, ' + convertHex(blockColor) + ' 0%, #fff 70%)');
   
             //  $('.seat_select_items[data-blockid="' + mapId + '"]').css('background', 'linear-gradient(to right, ' + convertHex(blockColor) + ' 0%, #fff 70%)');
           } else {
               $('.' + mouseHoverValue).css('background', 'linear-gradient(to right, ' + convertHex(blockColor) + ' 0%, #fff 70%)');
           }
           $('.' + mouseHoverValue + '-button').children().css('background', '#d9d9d9');
       }
   
   }
   
   function hideMouseOver(obj) {
       var mouseHover = obj.getAttribute('data-target');
       var blockColor = obj.getAttribute('color-code');
       var areaid = obj.getAttribute('map-id');
       var ticketsCount = obj.getAttribute('tickets');
       var dataClass = obj.getAttribute('data-class');
       if (ticketsCount == 0) {
       } else {
           var mouseHoverValue = mouseHover.replace(/[^a-zA-Z0-9]/g, '').toLowerCase();
           /*$(".mapsvg-region").each(function () {
            $(this).css('opacity', '1');
            });*/
           if (parseInt(current_category) != 0) {
               $.each(stadium_cat_details, function (indx, itm) {
                   if (parseInt(indx) == parseInt(current_category)) {
                       $.each(itm, function (indx2, itm2) {
                           if(itm2 != "") {
                               $('#' + itm2).css('opacity', '1');
                               $('#' + itm2).css({fill: stadium_block_details[itm2]});
                           }
                       });
                   }
               });
           } else {
               $.each(stadium_cat_details, function (indx, itm) {
                   $.each(itm, function (indx2, itm2) {
                       if(itm2 != "") {
                           $('#' + itm2).css('opacity', '1');
                           $('#' + itm2).css({fill: stadium_block_details[itm2]});
                       }
                   });
               });
           }
   
           $(".mapsvg-region").each(function () {
               $(this).css('opacity', '0.5');
               if (full_block_data == null) {
                   $(".mapsvg-region").each(function () {
                       $(this).css('opacity', '0.5');
                   });
               } else {
                   $.each(full_block_data, function (indx, itm) {
                       $.each(itm, function (indx2, itm2) {
                           if (itm2 != '') {
                               $('#' + itm2).css('opacity', '1');
                           }
                       })
                   });
               }
   
           });
           $('.' + mouseHoverValue).css('background', '');
           $('.' + mouseHoverValue + '-button').children().css('background', '#fff');
       }
   }
   
   
   function convertHex(hex, opacity) {
       hex = hex.replace('#', '');
       rgb = hex.replace(/[^\d,]/g, '').split(',');
       r = parseInt(rgb[0]);
       g = parseInt(rgb[1]);
       b = parseInt(rgb[2]);
       result = 'rgba(' + r + ',' + g + ',' + b + ',' + 0.25 + ')';
       return result;
   }
   function convertHexMap(hex, opacity) {
       hex = hex.replace('#', '');
       rgb = hex.replace(/[^\d,]/g, '').split(',');
       r = parseInt(rgb[0]);
       g = parseInt(rgb[1]);
       b = parseInt(rgb[2]);
       result = 'rgba(' + r + ',' + g + ',' + b + ')';
       return result;
   }
</script>
<script type="text/javascript">
   $(document).ready(function () {
       $("#read_more").click(function () {
           if ($("#me_top .entry-content").hasClass("active")) {
               $("#me_top .entry-content").removeClass("active");
           } else if (!$("#me_top .entry-content").hasClass("active")) {
               $("#me_top .entry-content").addClass("active");
           }
           if ($(this).hasClass("active")) {
               $(this).removeClass("active");
           } else if (!$(this).hasClass("active")) {
               $(this).addClass("active");
           }
       });
   });
   
   $(document).on('click', 'a[href^="#"]', function (event) {
       event.preventDefault();
   
       $('html, body').animate({
           scrollTop: $($.attr(this, 'href')).offset().top - 60
       }, 500);
   });
   
</script>
<?php
   } ?>

   <script type="text/javascript">
       
       $(document).ready(function () {
    var countryID = $('#country').val();
    ///alert(countryID);
    $.ajax({
        type: 'POST',
        url: '<?= base_url('game/getPostalCode') ?>',
        data: 'country_id=' + countryID,
        success: function (html) {
            $('select[name^="phonecode"] option[value="'+html+'"]').attr("selected","selected");
        }
    });


    var currencyFormat = 'EUR';
    if (currencyFormat == 'EUR') {
        var code = '&euro;';
    } else {
        var code = '&#163;';
    }
    $('#discountprice').append(code + ' ' + 0);
    $('#discountvalue').val(0);
    $('.discountvalue').val(0);

    var price = $('#hiddenprice').val();
    var noTickets = $('.ticketnumber').val();
    var sellerarrangementFee = $('#sellerArragementPercentage').val();
    var totalAmount = (price * noTickets).toFixed(2);


    var single_arrangement_fee = (price * 1).toFixed(2);


    $('#arrangementFee_detail').html(' '  + ' <?php echo $this->lang->line('fees_taxes'); ?>  <span class="span_ltr" style="direction:ltr;">' + code + ' ' + (single_arrangement_fee * sellerarrangementFee ).toFixed(2)+ '</span> <?php  echo $this->lang->line('each'); ?>');

    $('.arrangement_fee').val((totalAmount * sellerarrangementFee).toFixed(2));

    $('#arrangementFee').append(code + ' ' + (totalAmount * sellerarrangementFee).toFixed(2));
    var arrangementFeeValue = (totalAmount * sellerarrangementFee).toFixed(2);
    var totalSumValue = (parseFloat(arrangementFeeValue) + parseFloat(totalAmount)).toFixed(2);
    $('#approxPrice').append(code + ' ' + totalSumValue);


    $('#totalPrice').append(' ' + totalSumValue);

    $('.totalPayment').val(totalSumValue);
    $('#hiddenTotalPrice').val(totalSumValue);

    $('#country').on('change', function () {
        var countryID = $(this).val();
        // $('#cityAd').selectize()[0].selectize.destroy();
        console.log('countryID', countryID)
        if (countryID) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('game/getAddressDropdown') ?>',
                data: 'country_id=' + countryID,
                success: function (html) {
                    $('#cityAd').html(html);
                    
                    <?php if($getRegisterDataByid[0]->city != ''){ ?>
                    $('select[id^="cityAd"] option[value="'+<?php echo $getRegisterDataByid[0]->city; ?>+'"]').attr("selected","selected");
                    <?php } ?>
                    //$('#cityAd').selectize();
                }
            });
            $.ajax({
                type: 'POST',

                url: '<?= base_url('game/getPostalCode') ?>',
                data: 'country_id=' + countryID,
                success: function (html) {
                    var phonecode_sortname = html.split("||");
                    $('#phoneCode').val(phonecode_sortname[0]);
                    $(".bill_country .selected-flag div").first().removeClass();
                    $(".bill_country .selected-flag div").first().toggleClass("flag "+phonecode_sortname[1]);
                    
                }
            });
        } else {
            $('#cityAd').html('<option value=""><?php echo $this->lang->line('select_city'); ?></option>');
        }

    }).change();

    $('#shipCountry').on('change', function () {
        var countryID = $(this).val();
        //$('#shipCity').selectize()[0].selectize.destroy();
        if (countryID) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('game/getAddressDropdown') ?>',
                data: 'country_id=' + countryID,
                success: function (html) {
                    $('#shipCity').html(html);
                   // $('#shipCity').selectize();

                }
            });

            $.ajax({
                type: 'POST',
                url: '<?= base_url('game/getPostalCode') ?>',
                data: 'country_id=' + countryID,
                success: function (html) {
                    var ship_phonecode_sortname = html.split("||");
                    $('#shipPhonecode').val(ship_phonecode_sortname[0]);
                    $(".ship_country .selected-flag div").first().removeClass();
                    $(".ship_country .selected-flag div").first().toggleClass("flag "+ship_phonecode_sortname[1]);
                    
                }
            });
        } else {
            $('#shipCity').html('<option value=""><?php echo $this->lang->line('select_city'); ?></option>');
        }
    }).change();
});

   </script>
