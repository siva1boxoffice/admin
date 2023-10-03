<?php $this->load->view('common/header'); ?>
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets_ticket/css/app.css?v=1.2.11" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets_ticket/css/main.css?v=1.3.11" /> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets_ticket/css/style.css?v=3.4.3" />
<?php if($this->session->userdata('role') == 1){ ?>
   <link rel="stylesheet" href="<?php echo base_url();?>assets/css/seller.css?v=3.11" />
 <?php }  ?>
<div id="app-apex-charts" class="view-wrapper is-webapp" data-page-title="Add Details" data-naver-offset="150" data-menu-item="#dashboards-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
   <div class="page-content-wrapper">
      <div class="page-content is-relative">
         <form id="create_ticket" novalidate action="<?php echo base_url(); ?>tickets/create_ticket" class="name validate_form_v3" method="post">
            <div class="page-content-inner">
               <div class="card-grid-toolbar">
                  <div class="search-details">
                     <div class="search_btn">
                        <h3>
                           Search for the events you want to sell tickets for 
                           <!-- <div class="tooltip"><i class="fas fa-info-circle"></i>
                              <span class="tooltiptext">Tooltip text</span>
                           </div> -->
                        </h3>
                        <?php //echo "<pre>";print_r($matches[0]);?>
                        <div class="centDivsearch ">
                           <select required name="add_eventname_addlist[]" id="add_event_name" class="input sell_select" data-error="#errNm0">
                              <option value="">-Choose Match Event-</option>
                              <?php foreach ($matches as $matche) { ?>
                              <option value="<?php echo $matche->m_id; ?>"><?php echo $matche->match_name; ?> - <?php echo $matche->match_date_format; ?> - <?php echo $matche->tournament_name; ?></option>
                              <?php } ?>
                           </select>
                           <button type="button" style="display:none;" class="serchbtn" id="searchmatch"><i class="fas fa-search"></i></button>
                           <span id="errNm0"></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="food-delivery-dashboard">
                  <div class="add_details" id="fcs">
                     <div class="columns is-multiline is-flex-tablet-p column_mobile">
                        <div class="column is-8">
                           <div class="choose_ticket list_ticket_type">
                              <h2>Choose ticket type</h2>

                              <div class="columns is-multiline is-flex-tablet-p m-0">
                              <?php
                                 $ticket_key = 0;
                                 foreach ($ticket_types as $ticket_type) { ?>
                              <div class="column is-3 full_widd_50 p-0">
                                 <a class="project-grid-item">
                                    <div class="radio-toolbar">
                                       <label for="radio_ticket_<?php echo $ticket_key; ?><?php echo $ticket_key; ?>">
                                          <input required type="radio" id="radio_ticket_<?php echo $ticket_key; ?><?php echo $ticket_key; ?>" name="ticket_types[]" value="<?php echo $ticket_type->id; ?>" data-error="#errNm1">
                                          <span></span>
                                          <h3><?php echo $ticket_type->tickettype; ?></h3>
                                          <p><?php echo $ticket_type->ticket_description; ?></p>
                                       </label>
                                    </div>
                                 </a>
                              </div>
                              <?php $ticket_key++;
                                 } ?>
                              <!-- <div class="tooltip"><i class="fas fa-info-circle"></i>
                                 <span class="tooltiptext">Tooltip text</span>
                              </div> -->
                              <span id="errNm1"></span>

                           </div>
                           </div>
                           <div class="clearfix"></div>
                           <div class="number_ticket list_ticket_type">

                              <h2>
                                 Enter Number of Tickets
                                <!--  <div class="tooltip"><i class="fas fa-info-circle"></i>
                                    <span class="tooltiptext">Tooltip text</span>
                                 </div> -->
                              </h2>
                              <!-- <div class="paginations">
                                 <?php for ($i = 1; $i <= $ticket_max; $i++) { ?>
                                 <a href="javascript:void(0);" onclick="getticketQty(<?php echo $i; ?>);" >
                                    <div class="radio-toolbar1" >
                                       <input required type="radio" id="getticketQty_<?php echo $i; ?>" name="add_qty_addlist[]" value="<?php echo $i; ?>" data-error="#errNm2">
                                       <label for="radioOne" style="cursor: pointer;"><?php echo $i; ?></label>
                                    </div>
                                 </a>
                                 <?php } ?>
                              </div> -->
                              



                               <div class="columns is-multiline is-flex-tablet-p">
                               <?php for ($i = 1; $i <= $ticket_max - 1; $i++) { ?>
                              <div class="column is-2">
                                 <a href="javascript:void(0);" onclick="getticketQty(<?php echo $i; ?>);">
                                    <div class="radio-toolbar1">
                                       <input required="" type="radio" id="getticketQty_<?php echo $i; ?>" name="add_qty_addlist[]" value="<?php echo $i; ?>" data-error="#errNm2" class="getticketQty">
                                       <label for="radioOne" style="cursor: pointer;"><?php echo $i; ?></label>
                                    </div>
                                 </a>
                              </div>
                              <?php } ?>
                              <div class="column is-2">
                                 <a href="javascript:void(0);" onclick="getticketQty_v1(10);">
                                    <div class="radio-toolbar1">
                                       <!-- <input required="" type="radio" id="getticketQty_1" name="add_qty_addlist[]" value="1" data-error="#errNm2"> -->
                                       <!-- <label for="radioOne" style="cursor: pointer;">10+</label> -->
                                       <input name="add_qty_addlist[]" required="" type="radio" id="getticketQty_10" value="10" data-error="#errNm2" class="getticketQty">
                                       <label class="value_btn">10+</label>

                                       <div class="select_value">
                                          <div class="select">
                                             <select  id="slct" onchange="getticketQty(this.value);">
                                                 <option>-Quantity-</option>
                                                 <?php for ($i = 10; $i <= 100; $i++) { ?>
                                                 <option value="<?php echo $i;?>" <?php if($i == 10){?> selected <?php } ?>><?php echo $i;?></option>
                                              <?php } ?>
                                             </select>
                                         </div>
                                       </div>
                                    </div>
                                    
                                 </a>
                                 
                              </div>
                              <span id="errNm2"></span>
                           </div>

                           </div>
                           <div class="clearfix"></div>
                           <div class="split_type list_ticket_type">
                              <h2>Choose Split Type</h2>

                              <div class="columns is-multiline is-flex-tablet-p m-0">
                              <?php
                                 $split_key = 0;
                                 foreach ($split_types as $split_type) { ?>
                              <div class="column is-3 full_widd_50 p-0">
                                 <a class="project-grid-item">
                                    <div class="radio-toolbar">
                                       <label for="radio_split_<?php echo $split_key; ?>">
                                          <input required type="radio" id="radio_split_<?php echo $split_key; ?>" name="split_type[]" value="<?php echo $split_type->id; ?>" data-error="#errNm3">
                                          <span></span>
                                          <h3><?php echo $split_type->splittype; ?></h3>
                                          <p><?php echo $split_type->s_description; ?></p>
                                       </label>
                                    </div>
                                 </a>
                              </div>
                              <?php $split_key++;
                                 } ?>
                              <span id="errNm3"></span>

                           </div>
                           </div>
                           <div class="clearfix"></div>
                           <div class="price list_ticket_type">
                              <h2>Price</h2>
                              <div class="columns is-multiline is-flex-tablet-p">
                              <div class="column is-3">
                               <!--   <div class="details fontuser control has-icons-left">
                                    <!-- <label for="row">&nbsp;</label> 
                                    
                                    <span class="icon is-small is-left">
                                       <i class="fas fa-pound-sign"></i>
                                     </span>
                                    
                                 </div>
 -->
                               <div class="field details">
                                    <p class="control has-icons-left">
                                        <input class="input"  type="text" name="add_price_addlist[]" id="add_price_addlist" placeholder="0.00" required data-error="#errNm4">
                                        <span class="icon is-small is-left">
                                           £
                                          <!-- <i class="fas fa-check"></i> -->
                                        </span>
                                      </p>
                                 </div>
                              </div>
                              <div class="column is-3" style="display:none;">
                                 <div class="select details">
                                    <label for="section">Currency:</label>
                                    <select class="form-control" id="add_pricetype_addlist" name="add_pricetype_addlist[]" >
                                    </select>
                                 </div>
                              </div>
                              <div class="column">
                              </div>
                           </div>
                           <span id="errNm4"></span>

                        </div>

                           <div class="clearfix"></div>
                           <div class="seat_detail">
                              <h2>Seat Details</h2>
                              <!-- <p>You are required to provide section, row and seat information if this information is available to you at the time of listing.If you do not have all of this information at present, you may list your tickets,but you must update your listing once you have this information.Listings can be updated using My Account.</p> -->
                              <div class="columns is-multiline is-flex-tablet-p">
                              <div class="column is-3 full_widd_50">
                                 <div class="select details">
                                    <label for="section">Category:</label>
                                    <select required class="form-control" id="ticket_category" name="ticket_category[]" onchange="get_block(this.value);" data-error="#errNm5">
                                       <option value="">-Ticket Category-</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="column is-3 full_widd_50">
                                 <div class="select details">
                                    <label for="row">Block</label>
                                    <select class="form-control" id="ticket_block" name="ticket_block">
                                       <option value="">-Ticket Block-</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="column is-3 full_widd_50">
                                 <div class="details">
                                    <label for="row">Row</label>
                                    <input type="text" placeholder="Row" name="row" value="">
                                 </div>
                              </div>
                              <div class="column is-3 full_widd_50">
                                 <div class="select details">
                                    <label for="section">Home/Away:</label>
                                    <select required class="form-control" id="home_town" name="home_town" data-error="#errNm6">
                                       <option value="0">Any</option>
                                       <option value="1">Home</option>
                                       <option value="2">Away</option>
                                    </select>
                                 </div>
                              </div>
                              <span id="errNm5"></span>
                              <span id="errNm6"></span>
                           </div>
                           </div>
                           <div class="clearfix"></div>
                           <div class="ticket_details ticket_details_list_all">
                              <h2>Select Ticket Details</h2>
                              <div class="sel_detail">
                              <div class="columns is-multiline is-flex-tablet-p">
                              
                                 <div class="column is-6 full_widd_100">
                                    <div class="sel_detail_lft">
                                    <ul class="select_detail_chk">
                                       <?php
                                          $ticket_key = 0;
                                          foreach ($ticket_details as $ticket_detail) { 
                                             //echo "<pre>";print_r($ticket_detail);
                                             if($ticket_key <= 12){
                                             ?>
                                       <li>
                                          <img src="<?php echo UPLOAD_PATH.'uploads/ticket_details/'.$ticket_detail->ticket_image;?>" width="24px" height="24px">
                                          <h5 for="vehicle1"><?php echo $ticket_detail->ticket_det_name; ?></h5>
                                          <label>
                                          <input required type="checkbox" name="ticket_details[]" value="<?php echo $ticket_detail->id; ?>" data-error="#errNm7">
                                          <span></span>
                                          </label>
                                       </li>
                                       <?php $ticket_key++;
                                          }} ?>
                                    </ul>
                                 </div>
                                 </div>
                                 <div class="column is-6 full_widd_100">
                                    <div class="sel_detail_rig">
                                    <ul class="select_detail_chk">
                                       <?php
                                          $ticket_key = 0;
                                          foreach ($ticket_details as $ticket_detail) { 
                                             if($ticket_key > 12){
                                             ?>
                                       <li>
                                         <img src="<?php echo UPLOAD_PATH.'uploads/ticket_details/'.$ticket_detail->ticket_image;?>" width="24px" height="24px">
                                          <h5 for="vehicle1"><?php echo $ticket_detail->ticket_det_name; ?></h5>
                                          <label>
                                          <input required type="checkbox" name="ticket_details[]" value="<?php echo $ticket_detail->id; ?>" data-error="#errNm7">
                                          <span></span>
                                          </label>
                                       </li>
                                       <?php 
                                          } $ticket_key++; } ?>
                                    </ul>
                                 </div>
                                 </div>
                              
                              <span id="errNm7"></span>
                              </div>
                           </div>
                           </div>
                           <div class="upcoming-match-btn-view-all" >
                              <button type="submit" style="cursor: pointer;" class="onebox-btn">List Now</button>
                           </div>
                        </div>
                        <div class="column is-4">
                           <div class="header" id="myHeader">
                              <div class="content">
                                 <div class="select_resti ">
                                    <div class="event_info">
                                          <div class="selec_head">
                                             <h4>Event Information</h4>
                                          </div>

                                          <div class="selec_img" id="selec_img" style="display:none;">
                                             <img id="team1_image" src="" style="width:60px;">
                                             <img id="team2_image" src="" style="width:60px;">
                                         </div>
                                    </div>

                                    <div class="details">
                                       <h5 id="res-match-name">Please select an event to start listing tickets</h5>
                                       <p><span id="res-match-place"></span></p>

                                       <div class="event_img">
                                          <img id="res-stadium-image" src="">
                                       </div>

                                       <div class="event_time">
                                          <span class="res-match-date">
                                          <b><span id="res-match-date"></span> </b>
                                          </span>
                                          <span class="tr_date">
                                          <b><span id="res-match-time"></span></b>
                                          </span>
                                       </div>


                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<!--Huro Scripts-->
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
   var index = 0;
   function getticketQty_v1(direction){
      $('.getticketQty').each(function(i, obj) {
      $(this).prop('checked', false); 
      });
       $('#getticketQty_10').prop("checked", true);
       $('#getticketQty_10').val($('#slct').val());
   }
   getticketQty = function(direction) { //alert(direction);
      $('.getticketQty').each(function(i, obj) {
      $(this).prop('checked', false); 
      });
      if(direction >= 10){ 
         $('#getticketQty_10').prop("checked", true);
         $('#getticketQty_10').val(direction);
         $('#errNm2').text("");
      }
      else{

         $('#getticketQty_' + direction).prop("checked", true);
         $('#errNm2').text("");
      }
      
   
   };
   

   $(document).ready(function() {
   
   $('#add_price_addlist').keyup(function(e)
   {
   var val = $(this).val();
   var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
   var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
   if (re.test(val)) {
   //do something here
   
   } else {
   val = re1.exec(val);
   if (val) {
   $(this).val(val[0]);
   } else {
   $(this).val("");
   }
   }
   });
   
      if ($('#add_event_name').length) new Choices('#add_event_name', {
         removeItemButton: !0
      });
   
      $('#add_event_name').on('change', function() {
         /*if ($(this).val() != '') {
            $("#right_event").css("display", "block");
            $("#left_event").css("display", "block");
         }*/
         $('#searchmatch').trigger('click');
      })
   
   
      $(document).on('click', "#searchmatch", function() {
         $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>tickets/get_tktcat_by_stadium_id',
            data: {
               'match_id': $("#add_event_name").val()
            },
            dataType: "json",
            success: function(data) {
   
               $("#ticket_category").empty().html('<option value="" selected>--Ticket Category--</option>');
               if (data.block_data) {
   
                  $.each(data.block_data, function(index, item) {
   
                     $("#ticket_category").append('<option value="' + index + '">' + item + '</option>');
   
                  })
                  //$("#left_event").show();
   
               }
               if (data.match_data) {
   
                  $('#res-match-name').html(data.match_data.match_name);
                  $('#res-match-date').html(data.match_data.match_date_format);
                  $('#res-match-time').html(data.match_data.match_time);
                  //$('#right_event').show();
   
               }
            }
         });
   
   
         $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>tickets/getMatchDetails',
            data: {
               'match_id': $("#add_event_name").val()
            },
            dataType: "json",
            success: function(data) {
               let html = '';
               if (data.city_name != null) {
                  html += data.city_name + ', ';
               }
               if (data.state_name != null) {
                  html += data.state_name + ', ';
               }
               if (data.country_name != null) {
                  html += data.country_name;
               }
   
               $('#res-match-place').html(html);
               $('#matchticket').html(data.matchticket);
               $('#res-stadium-image').attr('src', data.stadium_image);
               $('#team1_image').attr('src', data.team1_image);
               $('#team2_image').attr('src', data.team2_image);
                $("#selec_img").css("display", "block");
               
            }
         });
   
   
         $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>tickets/getCurrency_event',
            data: {
               'match_id': $("#add_event_name").val()
            },
            dataType: "json",
            success: function(data) {
   
               $("#add_pricetype_addlist").empty();
               if (data) {
                  $.each(data, function(index, item) {
   
                     $("#add_pricetype_addlist").append("<option value='" + item.currency_code + "'>" + item.name + ' (' + item.symbol + ')' + "</option>");
                  })
               }
   
            }
         });
      });
   
   
      $(document).on('change', "#ticket_category", function() {
   
         $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>' + 'tickets/get_block_by_stadium_id',
            data: {
               'match_id': $('#add_event_name').val(),
               'category_id': $('#ticket_category').val()
            },
            dataType: "json",
            success: function(data) {
   
               $("#ticket_block").empty().html('<option value="" selected>--Ticket Block--</option>');
               if (data) {
                  $.each(data, function(index, item) {
   
                     $("#ticket_block").append('<option value="' + item + '">' + index + '</option>');
   
                  })
   
               }
            }
         });
   
      });
   
      $("#add_price_addlist").on("change", function(evt) {
         var self = $(this);
         //$("#add_price_addlist").attr("minlength", "2");
      /* if (self.val().length == 1 || parseInt(self.val()) < 10) {
            self.val('');
            $(this).focus();
            evt.preventDefault();
         }*/
   
         self.val(self.val().replace(/[^0-9\.]/g, ''));
         if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) {
            evt.preventDefault();
         }
      });
   
   });
</script>
<script>
   window.onscroll = function() {myFunction()};
   
   var header = document.getElementById("myHeader");
   var sticky = header.offsetTop;
   
   function myFunction() {
     if (window.pageYOffset > sticky) {
       header.classList.add("sticky");
     } else {
       header.classList.remove("sticky");
     }
   }
</script>


<script>
  $(document).ready(function() {

    $('body').on("click",".list_ticket_type label",function() {
      //alert();
        // $('list_ticket_type').removeClass('yellowBackground');
         $(this).parents(".list_ticket_type").find(".yellowBackground").removeClass();
        $(this).addClass('yellowBackground');

    });


   $('body').on("click",".select_detail_chk li",function() {
     // alert();
         //$(this).parents(".ticket_details_list_all").find(".yellowBackground");
       var that = $(this);
          $(this).addClass('yellowBackground');
         var ischecked= $(this).find("input").is(':checked');
         console.log(ischecked)
         if(!ischecked){
         console.log($(this))
           that.removeClass("yellowBackground");
         }else{
            that.addClass('yellowBackground');
         }

    });


});
</script>



<script type="text/javascript">
  $(document).ready(function(){
      // Toggles paragraphs display
      $(".value_btn").click(function(){
          $(".select_value").toggle();
      });
  });
</script>


<?php exit; ?>