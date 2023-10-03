
<?php if (@$sellTicketList)
                     { 

                        // echo "<pre>";print_r($sellTicketList);
                        // echo "</pre>";

                        foreach ($sellTicketList as $key => $value) {
                          // print_r($value);
                           $quantity = $value['quantity'];
                          $quantity2 = $value['quantity'];
                        ?>
                     
                     <form class="checkoutform" id="checkout-<?php echo $value['s_no'] ;?>" action="<?=base_url('game/orders/checkout'); ?>" method="post">
                                 <input type="hidden" value="<?php echo $value['match_id'] ;?>" name="matcheventid">
                                 <input type="hidden" value="<?php echo $value['s_no'] ;?>" name="sellticketid">
                                 <!-- <input type="hidden" value="<?=$checkSellTicketData->user_id; ?>" name="sellerId"> -->
                                 <input type="hidden" value="" name="nooftick" class="noticketsform">
                                 <input type="hidden" value="<?php echo $value['stadium_id'] ;?>" name="stadiumid">
                                  <input type="hidden" value="<?php echo $value['stadium_id'] ;?>" name="stadiumid">
                                 <input type="hidden" value="<?php @$list['tixstock_id']; ?>" name="tixstock_id"/>
                                 <input type="hidden" value="<?php echo @$list['oneclicket_id'] ;  ?>" name="oneclicket_id">  

                                                 <input type="hidden" value="setsession" name="sessionset">
                              </form>

                               <div  id="seatid-<?php echo $value['s_no'] ;?>" data-ticketcategory="<?php echo $value['ticket_category'] ;?>" data-quantity="<?php echo $value['quantity'] ;?>" data-class="<?php echo $value['ticket_category'] ;?>" map-id="0" color-code="<?php echo $value['block_color'] ;?>" currency-price="<?php echo $value['price_with_symbol'] ;?> tick_sec" class="seat_select_block_items columns is-multiline is-flex-tablet-p seat_select_items field <?php echo $value['ticket_category'] ;?>" data-target="<?php echo $value['ticket_category'] ;?>" data-blockid="0" data-matchid="<?php echo $value['match_id'] ;?>" onmouseover="showMouseOver(this)" onmouseout="hideMouseOver(this)">
                                    <div class="row">
                                       <div class="col-lg-4">
                                          <div class="tick_all_items">
                                             <label class="tick_tier" for="example-select"><?php echo $value['seat_category'] ;?>

                                              <img src="<?php echo $value['ticket_type_image'] ;?>" width="24px"></label>
                                             <div class="tick_text"><img src="<?php echo base_url();?>assets/zenith_assets/img/Group.png">This ticket is below market price</div>
                                          </div> 
                                       </div>
                                       <div class="col-lg-8">
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <div class="form-group mb-2">
                                                   <label class="mb-0" for="example-select">Quantity</label>
                                                                                       
                                          <select class=" custom-select rounded-0 font-weight-600 font-size-15 " name="nooftick<?php echo $value['s_no'] ;?>" id="noofticket<?php echo $value['s_no'] ;?>">
                                            

                                 <?php if($value['split'] == 2) {
                                       $quantity2 = 100 ?>

                                     <option value="<?php echo $quantity?>"><?php echo $quantity?></option>
                                 <?php } elseif($value['split'] == 4) {

                                   for($i=1;$i<=$quantity;$i++){

                                           
                                            if($i == ($quantity - 1)){
                                                continue;
                                            }
                                          
                              ?>
                                                <option value="<?php echo $i ;?>"><?php echo $i ;?></option>
                                       
                                    <?php   
                                    }  
                                    }
                                    elseif($value['split'] ==3)

                                    {  $i = 0; $quantity2 = 0;
                                    for ($i = 1; $i <= $quantity; $i++){
                                        if($i % 2 === 0) {
                                           $quantity2++;?>
                               <option value="<?php echo $i?>"><?php echo $i?></option>
                                        <?php } } }  else {

                                
                                    for($i=1;$i<=$quantity;$i++) {
                                       ?>
                                        <option value="<?php echo $i?>"><?php echo $i?></option>
                                   <?php } } ?>
                                   
                                                </select>
                                                </div> 
                                                <div class="tick_text ">
                                                   <span><?php echo $value['quantity'] ;?>  ticket(s) Remaining</span>
                                                </div>
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group mb-2">
                                                   <label class="mb-0" for="example-select">Price</label>
                                                   <select class="custom-select rounded-0 font-weight-600 font-size-15" id="example-select">
                                                      <option><?php echo $value['price_with_symbol'] ;?></option>
                                                
                                                   </select>
                                                </div> 
                                             </div>
                                             <div class="col-lg-4">
                                                <div class="form-group mb-2">
                                                <label class="mb-0" for="example-select">&nbsp;</label>
                                                <button type="button" class="btn btn_slct btn-info waves-effect waves-light rounded-0" data-effect="wave" data-sellid="<?php echo $value['s_no'] ;?>" onclick="goCheckOut(this)" >Select</button>  
                                                </div>
                                             </div>
                                          </div> 
                                       </div>
                                    </div>
                                 </div>

                        <?php }  ?>
                         <?php }  ?>