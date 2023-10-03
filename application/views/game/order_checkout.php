<div class="food-delivery-dashboard">
    <form id="category-form" method="post" class=" login-wrapper form_req_validation" action="<?php echo base_url(); ?>game/orders/save_order">
        <div class="add_details">
            <div class="container_new">
                <div class="sec_left">
                    <div class="price">
                        <h2>Billing Details</h2>
                        <div class="column is-one-three">
                            <div class="details">
                                <label for="row">First Name</label>
                                <input type="text" class="input" minlength="2" placeholder="First Name" id="first_name" name="first_name" value="<?=$selected_customer->first_name?>" />
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
                                <input type="text" class="input" minlength="2" placeholder="Last Name" id="last_name" name="last_name" value="<?=$selected_customer->last_name?>" />
                            </div>
                        </div>
                        <div class="column is-one-three">
                            <div class="details">
                                <label for="row">Address</label>
                                <input type="text" class="input" minlength="2" placeholder="Address" id="address" name="address" value="<?=$selected_customer->address?>" />
                            </div>
                        </div>
                        <div class="column is-one-three">
                            <div class="details">
                                <label for="row">Postcode</label>
                                <input type="text" class="input" minlength="2" placeholder="Postcode" id="postcode" name="postcode" value="<?=$selected_customer->code?>" />
                            </div>
                        </div>
                        <div class="column is-one-three">
                            <div class="details">
                                <label for="section"><?php echo $this->lang->line('select_country'); ?></label>
                                <select name="country" class="countries form-control" id="country">
                                    <option value=""><?php echo $this->lang->line('select_country'); ?></option>
                                    <?php foreach ($allCountries as $allCount) { ?>
                                        <option value="<?= $allCount->id; ?>" <?php if ($getRegisterDataByid){ if ($getRegisterDataByid[0]->country == $allCount->id) { echo 'selected'; } } else { if($allCount->id == '230'){ echo 'selected'; } }?>><?= $allCount->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="column is-one-three">
                            <div class="details">
                                <label for="section"><?php echo $this->lang->line('select_city'); ?></label>
                                <select name="city" class="form-control" id="cityAd">
                                    <option value=""><?php echo $this->lang->line('select_city'); ?></option>
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
                                <label for="row">Phone</label>
                                <input type="text" id="phoneCode" placeholder="e.g. +1 702 123 4567" name="phonecode" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->phonecode; endif; ?>" readonly>
                                <input type="text" placeholder="" name="billingphonenumber" id="billingPhonenumber" class="input-box" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->mobile; endif; ?>">                                                        
                                <input type="hidden" id="stadiumblockid" name="stadiumblockid" value="<?= $stadiumdetails[0]->ticket_block; ?>">
                            </div>
                        </div>
                        <div class="column is-one-three">
                            <?php if($stadiumdetails[0]->ticket_type != 2) { ?>
                                <div class="field check_box_coll button_container">
                                    <?php if(count($addresses) >= 0) { ?>
                                        <label><input type="checkbox" checked id="notSameaddress"><?php echo $this->lang->line('billing_address_same'); ?><i></i></label>
                                        <label><input type="checkbox" value="" id="notLater"><?php echo $this->lang->line('shipping_address'); ?><i></i></label>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="shipping_address_new" style="display: none;">
                            <div class="column is-one-three">
                                <div class="details shipfirstname"> 
                                    <label><?php echo $this->lang->line('first_name'); ?></label>
                                    <input type="text" placeholder="" name="shipfirstname" id="shipfirstname" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->first_name; endif; ?>">
                                </div>
                            </div>
                            <div class="column is-one-three">
                                <div class="details shiplastname"> 
                                    <label><?php echo $this->lang->line('last_name'); ?></label>
                                    <input type="text" placeholder="" name="shiplastname" id="shiplastname" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->last_name; endif; ?>">
                                </div>
                            </div>
                            <div class="column is-one-three">
                                <div class="details shipAddress"> 
                                    <label><?php echo $this->lang->line('address'); ?></label>
                                    <input type="text" placeholder="" name="shipaddress" id="shipAddress" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->address; endif; ?>">
                                </div>
                            </div>
                            <div class="column is-one-three">
                                <div class="details shipPostalcode"> 
                                    <label><?php echo $this->lang->line('postcode'); ?></label>
                                    <input type="text" placeholder="" name="shippostalcode" id="shipPostalcode" value="<?php if ($getRegisterDataByid): echo $getRegisterDataByid[0]->code; endif; ?>">
                                </div>
                            </div>
                            <div class="column is-one-three">                                                    
                                <div class="details shipCity">                                                 
                                    <label><?php echo $this->lang->line('select_city'); ?></label>
                                    <select name="shipCity" class="form-control" id="shipCity">
                                        <option value=""><?php echo $this->lang->line('select_city'); ?></option>
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
                                    <label><?php echo $this->lang->line('select_country'); ?></label>
                                    <select name="shipCountry" class="form-control countries" id="shipCountry">
                                        <option value=""><?php echo $this->lang->line('select_country'); ?></option>
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

                <div class="sec_right">
                    <div class="select_resti">
                        <div class="selec_head">
                            <h4>Event Information</h4>
                        </div>
                        <div class="selec_img">
                            <img src="images/flag.png">
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
                            <h4><?php echo $this->lang->line('date_time'); ?></h4>
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
                                    $seatCategoryData = $this->General_Model->getAllItemTable_Array('stadium_seats', array('stadium_seats.id' => $stadiumdetails[0]->ticket_category))->result();
                                    if ($stadiumdetails): 
                                        echo $seatCategoryData[0]->seat_category;
                                    endif;
                                ?>
                            </p>
                            <input type="hidden" id="maximumTickets" value="<?= $stadiumdetails[0]->quantity ?>">

                            <br />
                            <h4><?php echo $this->lang->line('price'); ?></h4>

                            <?php 
                                $matchId = $sessionArray['matcheventid'];
                                $sellticketId =	$sessionArray['sellticketid'];
                                $maximumNoTickets = $this->db->query("SELECT Max(quantity - sold) as `max_ticket` FROM sell_tickets WHERE s_no = $sellticketId")->result();
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

                            <?php echo $this->lang->line('tickets_at'); ?> 
                            
                            <span class="span_ltr" style="direction:ltr;">                                                    
                                <?php
                                    if ($stadiumdetails): 
                                        echo $this->General_Model->currencyConverter($totalPrice,$stadiumdetails[0]->price_type,$this->session->userdata('currency'));
                                    endif;
                                ?>
                            </span> 
                            
                            <?php echo $this->lang->line('each'); ?>                                                            

                            <input type="hidden" value="<?php echo $this->General_Model->currencyConverterMap2($totalPrice,$stadiumdetails[0]->price_type,$this->session->userdata('currency')); ?>" id="hiddenprice">
                            <input type="hidden" value="<?= $sellerPercentageData[0]->arrangement_fee / 100 ?>" id="sellerArragementPercentage">

                            <p id="arrangementFee_detail"></p>
                                
                            <p id="discount-area" style="display:none"><span>Discount </span> <strong id="discountprice"></strong></h5>
                            <input type="hidden" value="" class="discountvalue">
                            <input type="hidden" value="" id="hiddenTotalPrice">
                            <input type="hidden" value="" class="hiddencouponType">
                                                                                        
                            <h2 style="display:none;">                                                    
                                Total 
                                <?php
                                    if(strtoupper($priceType) == 'GBP'){
                                        $seller_currency = '&#163;';
                                    } else {
                                        $seller_currency = '&euro;';
                                    }                                                            
                                    
                                    if($priceType != strtoupper($this->session->userdata('currency'))) {
                                ?>
                                    <?php echo $this->lang->line('approx'); ?> 
                                <?php } ?>
                                
                                <span id="approxPrice"></span>
                            </h2>

                            <h2><?php echo $this->lang->line('total'); ?><span class="span_ltr" style="direction:ltr;"><?php echo $seller_currency; ?><span id="totalPrice"></span></span></h2>
                            
                            <?php if(strtoupper($priceType) == 'EUR'){ ?>                                                    
                                <p style="font-size:12px;"><?php echo $this->lang->line('total_approxi'); ?><span class="span_ltr" style="direction:ltr;"><?php echo $seller_currency; ?><span id="totalPrice_approxi"></span></span></p>                                                        
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

<script>    
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
                    $('#cityAd').selectize();
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
        $('#shipCity').selectize()[0].selectize.destroy();
        if (countryID) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('game/getAddressDropdown') ?>',
                data: 'country_id=' + countryID,
                success: function (html) {
                    $('#shipCity').html(html);
                    $('#shipCity').selectize();
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