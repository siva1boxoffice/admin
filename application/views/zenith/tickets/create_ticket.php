<?php 
   $this->load->view(THEME.'common/header');
   //echo isset($event->m_id) ? $event->m_id : 'ddddddd'; 
   ?>
<div id="overlay" style="display: none;">
   <div id="loader">
      <!-- Add your loading spinner HTML or image here -->
      <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
   </div>
</div>
<style type="text/css">
   label.error{
      color: RED !important;
         font-weight: normal !important;
   }
</style>

<!-- Beginegin main content -->
<div class="main-content">
   <!-- content -->
   <div class="page-content">
        <!-- page header -->
        <div class="page-title-box">
          <div class="container-fluid">
            <!-- <div class="page-title dflex-between-center">
              <h3 class="mb-1 font-weight-bold">Seller Page</h3>
            </div> -->
          </div>
        </div>
        <!-- page content -->
        <div class="page-content-wrapper mt--45">
          <div class="container-fluid">
            <form id="create_ticket" novalidate action="<?php echo base_url(); ?>tickets/create_ticket" class="name validate_form_v1" method="post">
            <div class="row">
               <div class="col-sm-12 col-md-12">
                  <div class="card rounded-0">
                     <div class="card-header align_centers">
                       <h5 class="">Search for the events you want to sell tickets for</h5>
                     </div>
                     <div class="card-body align_center">
                       <div class="row">
                         <div class="col-md-12">
                           <div class="search_for_event">
                              <input type="hidden" name="event_flag" value="<?php echo $event_flag ? $event_flag : "E" ;?>" id="event_flag" >
                              <select required name=" add_eventname_addlist[]" id="add_event_name" class="input sell_select select2" data-error="#errNm0">
                              <option value="">-Choose Match Event-</option>
                              <?php foreach ($matches as $matche) { ?>
                              <option value="<?php echo $matche->m_id; ?>"><?php echo $matche->match_name; ?> - <?php echo $matche->match_date_format; ?> - <?php echo $matche->tournament_name; ?></option>
                              <?php } ?>
                           </select>
                           <label id="add_event_name-error" class="error" for="add_event_name"></label>
                           </div>
                         </div> <!-- end col -->
                       </div> <!-- end row -->
                     </div> <!-- end card-body-->
                   </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-9">
                  <div class="create_ticket_page">
                     <div class="seller_page sell_ticket_new">
                        <div class="choose_ticket list_ticket_type">
                           <h2>Choose ticket type </h2>
                           <div class="row">

                              <?php
                                 $ticket_key = 0;
                                 foreach ($ticket_types as $ticket_type) { ?>


                              <div class="col-md-3 pl-1 full_widd_50">
                                 <div class="radio">
                                    <a class="project-grid-item">
                                       <div class="radio-toolbar">
                                          <label for="radio_ticket_<?php echo $ticket_key; ?><?php echo $ticket_key; ?>" class=""><input required="" type="radio" class="tdcheckbox" id="radio_ticket_<?php echo $ticket_key; ?><?php echo $ticket_key; ?>" name="ticket_types[]" value="<?php echo $ticket_type->id; ?>" data-error="#errNm1">
                                             <h3><?php echo $ticket_type->tickettype; ?></h3>
                                          <p><?php echo $ticket_type->t_description; ?></p>
                                             <?php if($ticket_type->id == 1 || $ticket_type->id == 3){
                                 ?>
                                <select name="ticket_type_category[<?php echo $ticket_type->id; ?>]" class="custom-select rt-select delivery_options">
                                  <option value="">-Select Delivery type-</option>
                                  <?php foreach($ticket_deliveries as $categories){ ?>
                                  <option value="<?php echo $categories->ticket_cat_id;?>"><?php echo $categories->category;?></option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                                          </label>
                                       </div>
                                    </a>
                                 </div>
                              </div><?php $ticket_key++;
                                 } ?>
                             
                              
                           </div>
                           <label id="ticket_types[]-error" class="error" for="ticket_types[]"></label>
                        </div>
                        <div class="number_ticket list_ticket_type">
                           <h2>Number of Tickets</h2>
                           <div class="number_ticket_list">
                              <div class="row">

                                 <?php for ($i = 1; $i <= $ticket_max - 1; $i++) { ?>

                                 <div class="col-md-2">
                                    <a href="javascript:void(0);" onclick="getticketQty(<?php echo $i; ?>);">
                                         <div class="radio-toolbar1">
                                            <input required="" type="radio" id="getticketQty_<?php echo $i; ?>" name="add_qty_addlist[]" value="<?php echo $i; ?>" data-error="#errNm2" class="getticketQty">
                                       <label for="radioOne" style="cursor: pointer;"><?php echo $i; ?></label>
                                         </div>
                                      </a>
                                 </div>
                                  <?php } ?>

                                    <div class="col-md-2">
                                 <a href="javascript:void(0);" onclick="getticketQty_v1(10);">
                                    <div class="radio-toolbar1">
                                       <!-- <input required="" type="radio" id="getticketQty_1" name="add_qty_addlist[]" value="1" data-error="#errNm2"> -->
                                       <!-- <label for="radioOne" style="cursor: pointer;">10+</label> -->
                                       <input id="showmenu" name="add_qty_addlist[]" required="" type="radio" value="10" data-error="#errNm2" class="">
                                       <label for="showmenu">10+</label>

                                        <div class="form-group menu" style="display: none;">
                                             <select class="form-control" id="slct" onchange="getticketQty(this.value);">
                                                 <option>-Quantity-</option>
                                                 <?php for ($i = 10; $i <= 100; $i++) { ?>
                                                 <option value="<?php echo $i;?>" <?php if($i == 10){?> selected <?php } ?>><?php echo $i;?></option>
                                              <?php } ?>
                                             </select>
                                       </div>
                                    </div>
                                    
                                 </a>
                                 
                              </div>

                           

                              </div>
                           </div>
                              <label id="add_qty_addlist[]-error" class="error" for="add_qty_addlist[]"></label>
                        </div>
                        <div class="split_type list_ticket_type">
                           <h2>Choose Split Type</h2>
                           <div class="row">
                              <?php
                                 $split_key = 0;
                                 foreach ($split_types as $split_type) { ?>
                              <div class="col-md-3 full_widd_50">
                                 <div class="">
                                    <a class="project-grid-item">
                                       <div class="radio-toolbar">
                                            <label for="radio_split_<?php echo $split_key; ?>" class="<?php if($split_type->id == '5'){?> yellowBackground <?php } ?>">
                                          <input required type="radio" id="radio_split_<?php echo $split_key; ?>" name="split_type[]" value="<?php echo $split_type->id; ?>" data-error="#errNm3" class="tdcheckbox <?php if($split_type->id == '5'){?> yellowBackground <?php } ?>  " <?php if($split_type->id == '5'){?> checked <?php } ?> style="display: none;">
                                          <h3 class="fs-15"><?php echo $split_type->splittype; ?></h3>
                                         <!--  <p><?php echo $split_type->s_description; ?></p> -->
                                       </label>
                                       </div>
                                    </a>
                                 </div>
                              </div>
                              <?php $split_key++;
                                 } ?>

                               <span id="errNm3"></span>
                           </div>
                            <label id="split_type[]-error" class="error" for="split_type[]"></label>
                        </div>
                        <div class="price">
                           <h2>Price</h2>
                           <div class="row">
                              <div class="col-md-4 col-sm-6 col-xs-12 full_widd_50">
                                 <div class="price_type">
                                    <label>My Price</label>
                                    <div class="input-group">
                                        <input class="form-control" placeholder="My Price" type="text" name="add_price_addlist[]" id="add_price_addlist" placeholder="0.00" required aria-label="Available Tickets" aria-describedby="basic-addon2" data-error="#errNm4">
                                    </div>
                                    <label id="add_price_addlist-error" class="error" for="add_price_addlist"></label>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="">
                                    <label>Web Price</label>
                                    <div class="input-group">
                                      <input type="text"  name="add_web_price_addlist[]" class="form-control" placeholder="Web price" aria-label="Available Tickets" aria-describedby="basic-addon2">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6 col-xs-12 full_widd_50">
                                 <div class="price_type">
                                    <div class="select_details">
                                       <label>Currency</label>
                                        <select class="custom-select" id="add_pricetype_addlist" name="add_pricetype_addlist[]" data-error="#errNm41">
                                    </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="seat_detail">
                           <h2>Seat details</h2>
                           <div class="row">
                              <div class="col-md-3 col-sm-6 col-xs-12 full_widd_50">
                                 <div class="seat_detail_list">
                                    <label>Category</label>
                                   <select required class="custom-select" id="ticket_category" name="ticket_category[]"  data-error="#errNm5">
                               <option value="">-Ticket Category-</option>
                               </select>
                                 </div>
                              </div>
                              <div class="col-md-3 col-sm-6 col-xs-12 full_widd_50">
                                 <div class="seat_detail_list">
                                    <label>Block</label>
                                    <select class="custom-select" id="ticket_block" name="ticket_block">
                                       <option value="">-Ticket Block-</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-3 col-sm-6 col-xs-12 full_widd_50">
                                 <div class="seat_detail_list">
                                    <label>Row</label>
                                    <div class="input-group">
                                       <input type="text" name="row" class="form-control" placeholder="Type here" aria-label="Available Tickets" aria-describedby="basic-addon2">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-3 col-sm-6 col-xs-12 full_widd_50">
                                 <div class="seat_detail_list">
                                    <div class="select_details">
                                       <label>Ticket Type</label>
                                       <select required class="custom-select" id="home_town" name="home_town" data-error="#errNm6">
                                       <option value="0">Any</option>
                                       <option value="1">Home</option>
                                       <option value="2">Away</option>
                                    </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="ticket_details ticket_details_list_all">
                           <h2>Select Ticket Details</h2>
                           <div class="restrictions">
                              <div class="row">
                                 <div class="col-md-12">
                                    <label>Select Restrictions on Use <span>*</span></label>
                                    <p>If any of the following conditions apply to your tickets, please select them from the list below. If there is a restriction on the use of your ticket not shown here, please stop listing and contact us</p>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="select_option ticket_chk_box">
                                       <div class="sel_detail_lft">
                                          <ul class="select_detail_chk">

                                              <?php 
                                  $ticket_key = 0;
                                  foreach ($restriction_left as $ticket_detail) { 
                                  ?>
                                   <li class="ticket_label_class">
                                 
                                   <input class="tdcheckbox ticket_label" type="checkbox" name="ticket_details[]" value="<?php echo $ticket_detail->id; ?>"><span><?php echo $ticket_detail->ticket_det_name; ?></span>
                                  </li>
                                  <?php
                                  } ?>

                                            
                                          </ul>
                                       </div>
                                       <div class="sel_detail_rig">
                                       <ul class="select_detail_chk">
                                       <?php 
                                  $ticket_key = 0;
                                  foreach ($restriction_right as $ticket_detail) { 
                                  ?>
                               <li class="ticket_label_class">
                              
                                   <input class="tdcheckbox ticket_label" type="checkbox" name="ticket_details[]" value="<?php echo $ticket_detail->id; ?>" ><span><?php echo $ticket_detail->ticket_det_name; ?></span>
                                  </li>
                                  <?php
                                  } ?>
                                       </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="select_option_notes">
                                       <h6>Listing Notes</h6>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="select_option">
                                       <div class="sel_detail_lft">
                                          <ul class="select_detail_chk">
                                              <?php 
                                  $ticket_key = 0;
                                  foreach ($notes_left as $ticket_detail) { 
                                  ?>
                                 <li class="ticket_label_class">
                                  
                                   <input class="tdcheckbox ticket_label" type="checkbox" name="ticket_details[]" value="<?php echo $ticket_detail->id; ?>"><span>
                                  <?php echo $ticket_detail->ticket_det_name; ?></span>
                                  </li>
                                  <?php
                                  } ?>
  
                                          </ul>
                                       </div>
                                       <div class="sel_detail_rig">
                                          <ul class="select_detail_chk">
                                              <?php 
                                  $ticket_key = 0;
                                  foreach ($notes_right as $ticket_detail) { 
                                  ?>
                                 <li class="ticket_label_class">
                                  
                                   <input class="tdcheckbox ticket_label" type="checkbox" name="ticket_details[]" value="<?php echo $ticket_detail->id; ?>" ><span>
                                  <?php echo $ticket_detail->ticket_det_name; ?></span>
                                  </li>
                                  <?php
                                  } ?>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="select_option_notes">
                                       <h6>Seating <span class="one_opt">Please Select One Option</span></h6>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="select_option select_option_seating">
                                       <div class="sel_detail_lft">
                                          <ul class="select_detail_chk_1">
                                             <?php 
                                        $ticket_key = 0;
                                        foreach ($split_details_left as $ticket_detail) { 
                                        ?>
                                       <li class="">
                                       
                                         <input required class="tdcheckbox  seat_type" type="checkbox" name="ticket_details_others[]" value="<?php echo $ticket_detail->id; ?>"><span>
                                        <?php echo $ticket_detail->ticket_det_name; ?></span>
                                        </li>
                                        <?php
                                        } ?>
                                          </ul>
                                       </div>
                                       <div class="sel_detail_rig">
                                          <ul class="select_detail_chk_1">
                                            <?php 
                                  $ticket_key = 0;
                                  foreach ($split_details_right as $ticket_detail) { 
                                  ?>
                                 <li class="">
                                 
                                   <input  required class="tdcheckbox  seat_type" type="checkbox" name="ticket_details_others[]" value="<?php echo $ticket_detail->id; ?>" ><span>
                                  <?php echo $ticket_detail->ticket_det_name; ?></span>
                                  </li>
                                  <?php
                                  } ?>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <label id="ticket_details_others[]-error" class="error" for="ticket_details_others[]"></label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="upcoming-match-btn-view-all mt-3">
                           <button type="submit" style="cursor: pointer;" class="onebox-btn" fdprocessedid="kya0s4">List Now</button>
                        </div>
                     </div>
                  </div>    
               </div>
               <div class="col-lg-3">  
                  <div class="create_ticket_page">
                     <div class="select_resti_event header sticky" id="myHeader">
                        <div class="selec_head">
                           <h4>Event Information</h4>
                        </div>
                        <div class="selec_img" id="selec_img" style="display: none;">
                           <img class="img1" id="team1_image" src="">
                           <img class="img2" id="team2_image" src="">
                        </div>

                        <div class="selec_img" id="selec_img2" style="display: none;">
                           <img class="img1" id="event_image" width="50px" src="">
                           
                        </div>



                        <div class="details">
                           <h5 id="res-match-name">Please select an event to start listing tickets</h5></h5>
                           <p><span id="res-match-place"></span></p>
                           <div class="event_img">
                                    <img id="res-stadium-image" src="" style="display:none">
                                 </div>
                           <p><span class="tr_date"><b id="res-match-date"></b></span><span class="tr_time"><b id="res-match-time"></b></span></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div> 
            </form>  
          </div>
        </div>
      </div>
      <!-- main content End -->
</div>

<?php  $this->load->view(THEME.'common/footer'); ?>
<script>
  $(document).ready(function() {


    var index = 0;
   function getticketQty_v1(direction){
      $('.getticketQty').each(function(i, obj) {
      $(this).prop('checked', false); 
      });
       $('#showmenu').prop("checked", true);
       $('#showmenu').val($('#slct').val());
   }
   getticketQty = function(direction) { 
      $('.getticketQty').each(function(i, obj) {
      $(this).prop('checked', false); 
      });
      if(direction >= 10){ 
         $('#showmenu').prop("checked", true);
         $('#showmenu').val(direction);
         $('#errNm2').text("");
      }
      else{

         $('#getticketQty_' + direction).prop("checked", true);
         $('#errNm2').text("");
      }
      
   
   };
   

   $(document).ready(function() {
   
     $(document).ready(function() {
        $('#showmenu').click(function() {
                $('.menu').slideToggle("fast");
        });
    });
     });

    $('body').on("click",".list_ticket_type label",function() {
      //alert();
        // $('list_ticket_type').removeClass('yellowBackground');
         $(this).parents(".list_ticket_type").find("label").removeClass("yellowBackground");
        $(this).addClass('yellowBackground');

    });


    $('body').on("click",".rt-select",function() {
       $(".rt-radio").prop('checked', false);
       $(this).parents(".project-grid-item").find(".rt-radio").prop('checked', true);
    });

  $('body').on("click",".ticket_label_class span",function() { 
  
       var that = $(this);
          $(this).parent('li').addClass('yellowBackground_1');
         var ischecked=  $(this).parent('li').find('input').is(':checked');;

       
         if(!ischecked){
      //alert('not');
         $(this).parent('li').find('input').prop('checked', true);
            that.parent('li').addClass('yellowBackground_1');
         }else{ 
         $(this).parent('li').find('input').prop('checked', false);
          that.parent('li').removeClass("yellowBackground_1");
           
         }

    });


   $('body').on("click",".select_detail_chk_1 input",function() { 

         $(".select_option_seating").find("li").removeClass("yellowBackground_1");
        $(".seat_type").each(function() {
            $(".seat_type").prop('checked', false);
        });
        $(this).parent('li').find('input').prop('checked', true);
   });

   $('body').on("click",".select_detail_chk_1 li span",function() { 
    

       $(".select_option_seating").find("li").removeClass("yellowBackground_1");
        $(".seat_type").each(function() {
            $(".seat_type").prop('checked', false);
        });
        $(this).parent('li').find('input').prop('checked', true);

    });




    $(document).on('change', "#add_event_name", function() { 
         events( $("#add_event_name").val());
      });

        $(document).ready(function() {
          //   $('.js-example-basic-single').select2().on('change', function(e){

              
          // });;
            var  URL  = "<?php echo base_url(); ?>tickets/index/get_match_names";



            $('.js-example-basic-single').select2({
                ajax: {
                  url: URL,
                  placeholder: "Choose Match Event",
                   dataType: 'json',
                  data: function (params) {
                    var query = {
                      search: params.term,
                      type: 'public'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                  },
                  processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'

                    return {
                      results: data
                    };
                  }
                }
              });


          /*  $('.js-example-basic-single').on('select2:selecting', function(e) {
              events(e.params.args.data.id);
          });
*/

        });

          function events(id){ 

             var event_flag = $("#event_flag").val();
            
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>tickets/get_tktcat_by_stadium_id',
            data: {
               'match_id':id
            },
            dataType: "json",
            success: function(data) {
                
                console.log(data);
               $("#ticket_category").empty().html('<option value="" selected>--Ticket Category--</option>');
               if (data.block_data) {
   
                  $.each(data.block_data, function(index, item) {
   
                     //$("#ticket_category").append('<option value="' + index + '">' + item + '</option>');
                     
                     $("#ticket_category").append('<option value="' + index + '">' + item + '</option>');
   
                  })
                  var bdc = "<ul>";
                  $.each(data.block_data_color, function(index, item) {
   
                  bdc += "<li><span style='background:" +index +"'></span>"  + item +"</li>";
   
                  });
                  bdc +="</ul>";
                   $("#ticket_category_block").html(bdc);
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
   
    var full_block_data = {};
    var stadium_block_details = {};
    var stadium_cat_details = {} ;
    var stadium_with_cat_name = {} ;
    var ticket_price_info_with_cat = {} ;
    var current_category = 0;
        $("#map_html").html("<p class='text-center'>Loading...</p>");
         $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>tickets/getMatchDetails',
            data: {
               'match_id': id
            },
            dataType: "json",
            success: function(data) { 
               let html = '';
               
               if (data.stadium_name != null) {
                  html += data.stadium_name + ', ';
               }
               if (data.city_name != null) {
                  html += data.city_name + ', ';
               }
               if (data.state_name != null) {
                  html += data.state_name + ', ';
               }
               if (data.country_name != null) {
                  html += data.country_name;
               }
               var ticket_type_option = '<option value="0">Any</option>'+
                                        '<option value="1">Home</option>'+
                                        '<option value="2">Away</option>';
               if(event_flag  == "E"){
                     if (data.team1_name != null && data.team2_name != null) {
                        ticket_type_option += '<option value="'+data.team1_name+'">'+data.team1_name+'</option>';
                        ticket_type_option += '<option value="'+data.team2_name+'">'+data.team2_name+'</option>';
                        $("#selec_img").css("display", "block");
                     }
                     
               }
               else{
                        $("#selec_img2").css("display", "block");
                     }
               
               $('#home_town').html(ticket_type_option);
   
               $('#res-match-place').html(html);
               $('#matchticket').html(data.matchticket);
               $('#res-stadium-image').show();
               $('#res-stadium-image').attr('src', data.stadium_image);
                if(data.event_type == 'other'){
                $('#event_hidden').val('OE');
                $('#event_image').attr('src', data.event_image);
                }
                else{
                $('#event_hidden').val('E');
                $('#team1_image').attr('src', data.team1_image);
                $('#team2_image').attr('src', data.team2_image);
               
                }
              /* $('#team1_image').attr('src', data.team1_image);
               $('#team2_image').attr('src', data.team2_image);*/
               
               $("#map_html").html(data.stadium_html);
               $(".zoom_map").show();
               $(".map_stadium_name").html(data.stadium_name);
                


            }
         });
      

        // function a(stadiumValue){

        //    jQuery(".mapsvg").mapSvg(stadiumValue);
        // }
   
         $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>tickets/getCurrency_event',
            data: {
               'match_id': id
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
       }

       $(document).on('change', "#ticket_category", function() {
   
         $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>' + 'tickets/get_block_by_stadium_id',
            data: {
               'match_id': $("#add_event_name").val(),
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