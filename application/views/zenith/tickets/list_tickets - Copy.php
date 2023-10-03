<?php $this->load->view('common/header');?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/template_style.css" />
<div id="app-lists" class="view-wrapper is-webapp" data-page-title="List View" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative tabs-wrapper is-slider is-squared is-inverted">

                    <div class="page-title has-text-centered is-webapp">

                        <div class="title-wrap">
                            <h1 class="title is-4">List View</h1>
                        </div>

                        <div class="toolbar ml-auto">

                            <div class="toolbar-link">
                                <label class="dark-mode ml-auto">
                                    <input type="checkbox" checked="">
                                    <span></span>
                                </label>
                            </div>

                            <a class="toolbar-link right-panel-trigger" data-panel="languages-panel">
                                <img src="assets/img/icons/flags/united-states-of-america.svg" alt="">
                            </a>

                            <div class="toolbar-notifications is-hidden-mobile">
                                <div class="dropdown is-spaced is-dots is-right dropdown-trigger">
                                    <div class="is-trigger" aria-haspopup="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                        <span class="new-indicator pulsate"></span>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <div class="heading">
                                                <div class="heading-left">
                                                    <h6 class="heading-title">Notifications</h6>
                                                </div>
                                                <div class="heading-right">
                                                    <a class="notification-link" href="/admin-profile-notifications.html">See all</a>
                                                </div>
                                            </div>
                                            <ul class="notification-list">
                                                <li>
                                                    <a class="notification-item">
                                                        <div class="img-left">
                                                            <img class="user-photo" alt="" src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/photos/7.jpg">
                                                        </div>
                                                        <div class="user-content">
                                                            <p class="user-info"><span class="name">Alice C.</span> left a comment.</p>
                                                            <p class="time">1 hour ago</p>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="notification-item">
                                                        <div class="img-left">
                                                            <img class="user-photo" alt="" src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/photos/12.jpg">
                                                        </div>
                                                        <div class="user-content">
                                                            <p class="user-info"><span class="name">Joshua S.</span> uploaded a file.</p>
                                                            <p class="time">2 hours ago</p>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="notification-item">
                                                        <div class="img-left">
                                                            <img class="user-photo" alt="" src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/photos/13.jpg">
                                                        </div>
                                                        <div class="user-content">
                                                            <p class="user-info"><span class="name">Tara S.</span> sent you a message.</p>
                                                            <p class="time">2 hours ago</p>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="notification-item">
                                                        <div class="img-left">
                                                            <img class="user-photo" alt="" src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/photos/25.jpg">
                                                        </div>
                                                        <div class="user-content">
                                                            <p class="user-info"><span class="name">Melany W.</span> left a comment.</p>
                                                            <p class="time">3 hours ago</p>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <a class="toolbar-link right-panel-trigger" data-panel="activity-panel">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                            </a>
                        </div>
                    </div>

                    <div class="list-view-toolbar is-reversed">
                        <div class="control has-icon">
                            <input class="input custom-text-filter" placeholder="Search..." data-filter-target=".list-view-item">
                            <div class="form-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            </div>
                        </div>
                    </div>

                    <div class="page-content-inner">

                        <!--List-->
                        <div class="list-view list-view-v3">

                            <!--List Empty Search Placeholder -->
                            <div class="page-placeholder custom-text-filter-placeholder is-hidden">
                                <div class="placeholder-content">
                                    <img class="light-image" src="assets/img/illustrations/placeholders/search-3.svg" alt="">
                                    <img class="dark-image" src="assets/img/illustrations/placeholders/search-3-dark.svg" alt="">
                                    <h3>We couldn't find any matching results.</h3>
                                    <p class="is-larger">Too bad. Looks like we couldn't find any matching results for the
                                        search terms you've entered. Please try different search terms or criteria.</p>
                                </div>
                            </div>

                            <!--Active Tab-->
                            <div id="active-items-tab" class="tab-content is-active">
                                <div class="list-view-inner">

                                    <div class="tab_sec orders" id="no-more-tables">
                                      <table class="toptable res_table_new table-responsive">
                                        <tbody>
                                          <tr class="accordion ui-accordion ui-widget ui-helper-reset">
                                            <th>Date</th>
                                            <th>Event</th>
                                            <th>Tournament</th>
                                            <th>Stadium</th>
                                            <th>City</th>
                                            <th>Country</th>
                                            <th>Tickets Qty</th>
                                            <th>Price Range</th>
                                            <th>&nbsp;</th>
                                          </tr>
                                          <?php foreach($TicketList as $tl_key => $tl_val) { 
                                                if($tl_val->match_id != ""){
                                                $tot_list=$this->General_Model->getid('sell_tickets',array('match_id'=>$tl_val->match_id))->result();
                                                $tot_tickets=0;
                                                $sell_tckt1=0;
                                                $total_price = 0;

                                                //echo "<pre>"; print_r($tot_list);die;
                                              $ticketMinPrice = min(array_column($tot_list, 'price'));
                                              
                                              
                                              $total_sold_tickets = $this->db->query("SELECT sum(no_tickets) as total_sold_tickets FROM `purchase` LEFT JOIN `sell_tickets` ON purchase.sell_id=sell_tickets.s_no WHERE purchase.sell_id IN(select s_no from sell_tickets where purchase.match_id = '". $tl_val->match_id."') order by purchase.id desc")->result();
                                          
                                              
                                          
                                              if($tot_list){
                                                  foreach($tot_list as $tot_lst){

                                                      $total_price+=(int)$tot_lst->price;
                                                      $tot_tickets+=(int)$tot_lst->quantity;
                                                      $sold_info=$this->db->query("SELECT * from purchase where sell_id ='".$tot_lst->s_no."' and payment_date >= '".date('Y-m-d', strtotime('-7 days'))."' ")->result();
                                                      if($sold_info){ 
                                                          foreach($sold_info as $sld_inf){ 
                                                                  $sell_tckt1=(int)$sell_tckt1 + (int)$sld_inf->no_tickets;
                                                          
                                                          }
                                                      }
                                                      
                                                      $pending_fullfillment=$this->db->query("SELECT * from purchase where sell_id ='".$tot_lst->s_no."' and status in ('1','2') ")->result();            
                                                      $total_pf = 0;
                                                      if($pending_fullfillment){ 
                                                                      foreach($pending_fullfillment as $pf){ 
                                                                              $total_pf += 1;
                                                                      }
                                                                  }
                                                              }
                                                          }

                                              
                                                      if(($tl_val->match_date > date("Y-m-d")) || ($tl_val->match_date < date("Y-m-d") && $total_pf > 0)){
                                                          // echo "t - " . $match_info[0]->id . "<br />";
                                                          $match_additional_info = $this->Tickets_Model->getMatchAdditionalInfo($tl_val->m_id) ;   

                                                          // echo '<pre>'; print_r($match_additional_info); echo '</pre>';
                                                          $curncy = "";
                                                          if($match_additional_info->price_type=="GBP") $curncy="&#163; ";
                                                          if($match_additional_info->price_type=="EUR") $curncy="&euro; ";
                                                          if($match_additional_info->price_type=="USD") $curncy="&#36; ";
                                                          if($match_additional_info->price_type=="INR") $curncy="&#8377;";
                                              


                                          ?>

                                          <tr>
                                            <td data-label="Transaction date:"><b><?=date("d/m/Y H:i",strtotime($tl_val->match_date))?></b> <br><?=date("l",strtotime($tl_val->match_date))?> </td>
                                            <td data-label="Event:"><?=$tl_val->match_name?> </td>
                                            <td data-label="Tournament:"><?=$match_additional_info->tournament_name?></td>
                                            <td data-label="Stadium:"><?=str_replace("-"," ",$tl_val->stadium_name)?></td>
                                            <td data-label="City:"><b><?=$match_additional_info->city_name?></b> </td>
                                            <td data-label="Country:"><?=$match_additional_info->country_name?></td>
                                            <td data-label="Tickets Qty:"><b><?=(int)$tot_tickets+(int)$sell_tckt1?></b></td>
                                            <td data-label="Price Range:"><b><?=$curncy?></b><?=$total_price?></td>
                                            <td class="showHide"><i class="fas fa-chevron-down"></i></td>
                                          </tr>
                                          <?php if($tot_list){ ?>
                                          <tr class="nested" style="display: none;">
                                            <td colspan="12">
                                              <table class="nest_tab" id="">
                                                <thead>
                                                  <tr id="row_<?php echo $l_key;?>">
                                                    <th>Active</th>
                                                    <th>ID</th>
                                                    <th>Ticket Type</th>
                                                    <th>Section</th>
                                                    <th>Home / Away</th>
                                                    <th>Row</th>
                                                    <th>Seats</th>
                                                    <th>QTY</th>
                                                    <th>Split Type</th>
                                                    <th>Price</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <?php 
                                                          foreach($tot_list as $t_lst){
//echo "<pre>"; print_r($t_lst);die;
                                $get_mtch=$this->General_Model->getid('match_info',array('m_id'=>$t_lst->match_id))->result();
                               
                                 // $stadium_seat_category = $this->db->query("SELECT stadium_details.category,stadium_seats_lang.seat_category FROM `stadium_details`,`stadium_seats_lang` WHERE stadium_details.category = stadium_seats_lang.stadium_seat_id and stadium_id = '".$get_mtch[0]->venue."' and language = '".$this->lang->lang()."' group by stadium_details.category")->result_array();
         
                            
                                $categ=$this->General_Model->getid("stadium_seats",array("stadium_seats.id"=>$t_lst->ticket_category))->result();
                                $ticket_type=$this->General_Model->getid("ticket_types",array("ticket_types.id"=>$t_lst->ticket_type))->result();
                            
                            
                                $stadium_blocks=$this->General_Model->getid("stadium_details",array("category" => $categ[0]->stadium_seat_id,"stadium_id"=>$get_mtch[0]->venue))->result();
                                
                                // echo '<pre>'; print_r($t_lst); echo '</pre>';
                                
                                $sell_tckt=0;
                                $sold_info=$this->General_Model->getid("purchase",array("sell_id"=>$t_lst->s_no))->result();
                                if($sold_info){ foreach($sold_info as $sld_inf){
                                    $sell_tckt=(int)$sell_tckt + (int)$sld_inf->no_tickets;
                                }}
                                //var_dump($stadium_price);
//echo "<pre>"; print_r($ticket_split_info);die;

                                $split="-";
                                if($ticket_split_info){ foreach($ticket_split_info as $tckt_splt){
                                    if($tckt_splt->id==$t_lst->split){
                                        $split=$tckt_splt->title; break;
                                    }
                                }}
                                $tooltip_seller_notes=array();
                                $sel_nt=explode(",",$t_lst->listing_note);
                                if($seller_notes){ foreach($seller_notes as $slr_nt){
                                    //echo "<pre>-_-_-_-_-_".$slr_nt->title."-_-_-_-_-_</pre>";
                                    if(in_array($slr_nt->id,$sel_nt)){
                                        $tooltip_seller_notes[]=$slr_nt->title;
                                    }
                                }}
                                
                                
                                
                                if($t_lst->price_type=="GBP") $curncy="&#163; ";
                                if($t_lst->price_type=="EUR") $curncy="&euro; ";
                                if($t_lst->price_type=="USD") $curncy="&#36; ";
                                if($t_lst->price_type=="INR") $curncy="&#8377;";
                                
                                $list_data_info = array(
                                'list_id' => $t_lst->s_no,
                                'category' => $t_lst->ticket_category,
                                'block' => $t_lst->ticket_block,
                                'row' => $t_lst->row,
                                'quantity' => $t_lst->quantity,
                                'price' => $t_lst->price,
                                'match_id' => $t_lst->match_id,
                                'ticket_type' => $t_lst->ticket_type,
                                'listing_note' => $t_lst->listing_note,
                                'split' => $t_lst->split,
                                'collection' => $t_lst->collection,
                                'delivery_courier' => $t_lst->delivery_courier,
                                'price_type' => $t_lst->price_type,
                                'match_id' => $t_lst->match_id
                                );
                            ?>
                    <tr>
                      <td data-label="Active">
                        <div class="content">
                          <!-- <label class="switchSmall2 m5">
                            <input type="checkbox" checked="">
                            <small></small>
                            <br> Log </label> -->
                        <label class="switch">
                        <input type="checkbox" <?= $t_lst->status == 1 ? 'checked="checked"' : ''?> class="change_listing_status"  data-match_id="<?=$t_lst->match_id?>" id="lst_<?=$t_lst->s_no?>" data-status="<?=$t_lst->status?>" attr-status="<?=$t_lst->status?>" data-id="<?=$t_lst->s_no?>" data-toggle="tooltip" title="<?=($t_lst->status==1)?'Disable':'Active'?>">
                        <span class="slider round"> </span></label>
                                </div></span>
                        </label>
                        </div>
                      </td>
                      <td data-label="ID"><?=$t_lst->s_no?></td>
                      <td data-label="Ticket type">
                        <select name="e-tickets" id="ticket" class="form-control">
                          <?php if($ticket_types){ foreach($ticket_types as $tck_typ){ ?>
                                    <option value="<?=$tck_typ->id?>" <?php if($tck_typ->id==$ticket_type[0]->id){ ?> selected <?php } ?>><?=$tck_typ->ticket_type_name?></option>
                                <?php }} ?>
                        </select>
                      </td>
                      <td data-label="Section">
                        <select name="single-ticket" id="single-ticket" class="form-control">
                          <?php if($stadium_seat_category){ foreach($stadium_seat_category as $std_cat){ ?>
                                        <option value="<?=$std_cat['category']; ?>" <?php if($std_cat['category']==$t_lst->ticket_category){ ?> selected <?php } ?>><?=$std_cat['seat_category']; ?></option>
                                    <?php }} ?>
                        </select>
                      </td>
                      <td data-label="Home/Away">
                        <select name="manchester" id="Manchester" class="form-control">
                         <option value="0" <?php if(0 ==$t_lst->home_town){ ?> selected <?php } ?>>Any</option>
                                <option value="1" <?php if(1 ==$t_lst->home_town){ ?> selected <?php } ?>>Home</option>
                                <option value="2" <?php if(2 ==$t_lst->home_town){ ?> selected <?php } ?>>Away</option>
                        </select>
                      </td>
                      <td data-label="Row">
                        <input type="text" name="row" class="form-control1 allow_decimal" class="sell_number cls_row allow_decimal" data-id="<?=$t_lst->s_no?>" value="<?=$t_lst->row?>" >
                      </td>
                      <td data-label="Seats">
                        <input type="text" name="ticket_seat" class="form-control1 allow_decimal" value="<?=$t_lst->seat?>" placeholder="0">
                      </td>
                      <td data-label="QTY">
                        <input type="text" name="quantity" class="form-control1 allow_decimal" value="<?=$t_lst->quantity?>" placeholder="0" required>
                        <!-- <select name="seats" id="seats" class="form-control1">
                          <option value="seats">20</option>
                          <option value="seats">20</option>
                          <option value="seats">20</option>
                          <option value="seats">20</option>
                        </select> -->
                      </td>
                      <td data-label="Split type">
                        <select name="split-type" id="split-type" class="form-control">
                          <?php if($ticket_split_info){ foreach($ticket_split_info as $tckt_splt){ ?>
                                        <option value="<?=$tckt_splt->id?>" <?php if($tckt_splt->id==$t_lst->split){ ?> selected <?php } ?>><?=$tckt_splt->title?></option>
                                    <?php }} ?>
                        </select>
                      </td>
                      <td data-label="Price">
                        <input type="text" class="form-control allow_decimal_length" name="price" value="<?=$curncy.'  '.$t_lst->price?>" placeholder="0.00" required>
                      </tr>
                    <tr>
                      <td colspan="2" data-label="Selling type">
                        <label>Selling Type *</label>
                        <br>
                        <select name="selling-type" id="selling-type" class="form-control">
                          <option value="buy">Buy now</option>
                          <option value="buy">Buy now</option>
                          <option value="buy">Buy now</option>
                          <option value="buy">Buy now</option>
                        </select>
                      </td>
                      <td colspan="5"> <p><input type="checkbox" id="" name="" value="" class="chk_box"><label class="chk_box_lbl" for="tickets"> Track prices for this tickets</label><br></p></td>
                      <td><a href="">Compare</a></td>
                      <td colspan="5">
                          <div class="icons">
                              <!-- <a href=""><i class="far fa-file"></i></a> -->
                              <a href="">save</a>
                              <a href=""><i class="fas fa-copy"></i></a>
                              <a href=""><i class="fas fa-trash-alt"></i></a>
                          </div>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </td>
            </tr>
            <?php } } } }?>
          </tbody>
        </table>
      </div>

                                </div>

                                <!--Infinite Loader-->
                                <div class="infinite-scroll-loader" data-filter-hide="">
                                    <div class="infinite-scroll-loader-inner">
                                        <div class="loader is-loading"></div>
                                        <div class="loader-end is-hidden">
                                            <span>No more items to load</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Inactive Tab-->
                            <div id="inactive-items-tab" class="tab-content">
                                
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
<!--Huro Scripts-->
       <?php $this->load->view('common/footer');?>
       <script>
    $(document).ready(function() {
      $(".toptable tr.nested").hide();
      $(".toptable td.showHide").on('click', function() {
        if ($(this).html() == '<i class="fas fa-chevron-down"></i>') {
          $(this).html('<i class="fas fa-chevron-up"></i>');
          $(this).parent('tr').next('tr.nested').show();
        } else {
          $(this).html('<i class="fas fa-chevron-down"></i>');
          $(this).parent('tr').next('tr.nested').hide();
        }
      });
    });
  </script>
