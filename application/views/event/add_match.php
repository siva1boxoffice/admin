<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="match-form" method="post" class="validate_event_form login-wrapper" action="<?php echo base_url();?>event/matches/save_matches" duplicate-check="<?php echo base_url();?>event/matches/duplicateCheck">
                            <input type="hidden" name="matchId" value="<?php echo $matches->m_id;?>">
                         <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">Matches</h2>
                                </div>
                            </div>
                            <?php //echo "<pre>";print_r($matches);?>
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Add Or Edit Match</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <?php if (isset($matches->m_id)) { ?>
                                                <a target="_blank" href="<?php echo FRONT_END_URL; ?>/en/<?php echo $matches->slug; ?>" class="button h-button is-light is-dark-outlined">
                                                <span class="icon">
                                                <i class='fa fa-eye'></i>
                                                </span>
                                                </a>
                                                <?php } ?>
                                                <a href="<?php echo base_url();?>event/matches/upcoming" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Matches</span>
                                                </a>
                                                <button type="submit" id="branch-form-btn" class="button h-button is-primary is-raised">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body has-loader">

                                      <!--Loader-->
                                            <div class="h-loader-wrapper">
                                                <div class="loader is-small is-loading"></div>
                                            </div>
                                     <!--Fieldset-->
                                    <div class="form-fieldset" style="max-width: 580px;">
                                         <div class="fieldset-heading">
                                            <h4>Team Info</h4>
                                            <p>Fill the following Team information</p>
                                        </div>
                                        <div class="columns is-multiline">
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Team 1</label>
                                                    <div class="control">
                                                        <select class="form-control select2" id="team1" name="team1" required onchange="display_match();">
                                                            <option value="">-Select Team 1-</option>
                                                            <?php foreach($teams as $team){ ?>
                                                            <option value="<?php echo $team->team_id;?>" <?php if($matches->team_1 == $team->team_id){?> selected <?php } ?>><?php echo $team->team_name;?></option>
                                                            <?php } ?>
                                                        </select> 
                                                            </div>
                                                </div>
                                            </div>
                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>Team 2</label>
                                                    <div class="control">
                                                        <select class="form-control select2" id="team2" name="team2" required onchange="display_match();">
                                                            <option value="">-Select Team 2-</option>
                                                           <?php foreach($teams as $team){ ?>
                                                            <option value="<?php echo $team->team_id;?>" <?php if($matches->team_2 == $team->team_id){?> selected <?php } ?>><?php echo $team->team_name;?></option>
                                                            <?php } ?>
                                                        </select> 
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Match Name</label>
                                                    <div class="control">
                                                        <input type="text" id="matchname" name="matchname" class="input" placeholder="Enter Match Name" required value="<?php echo $matches->match_name;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php //echo "<pre>";print_r($tournments);?>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Tournament</label>
                                                    <div class="control">
                                                        <select class="form-control select2" id="tournament" name="tournament" required>
                                                            <option value="">-Select Tournament-</option>
                                                            <?php foreach($tournments as $tournment){ ?>
                                                            <option value="<?php echo $tournment->t_id;?>" <?php if($matches->tournament == $tournment->t_id){?> selected <?php } ?>><?php echo $tournment->tournament_name;?></option>
                                                            <?php } ?>
                                                        </select> 
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Home Team</label>
                                                     <div class="control">
                                                        <select class="form-control select2" id="hometown" name="hometown" required>
                                                            <option value="">-Select Home Team-</option>
                                                            <?php foreach($teams as $team){ ?>
                                                            <option value="<?php echo $team->team_id;?>" <?php if($matches->hometown == $team->team_id){?> selected <?php } ?>><?php echo $team->team_name;?></option>
                                                            <?php } ?>
                                                        </select> 
                                                            </div>
                                                </div>
                                            </div>
                                              <div class="column is-6">
                                                <div class="field">
                                                    <label>Total Tickets *</label>
                                                    <div class="control">
                                                        <input type="text" id="matchticket" name="matchticket" class="input" placeholder="Enter No. Of tickets" required value="<?php echo $matches->matchticket;?>">
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>Match Label *</label>
                                                    <div class="control">
                                                        <input type="text" id="match_label" name="match_label" class="input" placeholder="Enter Match Label"  value="<?php echo $matches->match_label;?>">
                                                    </div>
                                                </div>
                                            </div>

                                         <!--    <div class="column is-6">
                                                <div class="field">
                                                    <label>Days remaining *</label>
                                                    <div class="control">
                                                        <input type="text" id="daysremaining" name="daysremaining" class="input" placeholder="No. Of Days remaining" required value="<?php echo $matches->daysremaining;?>">
                                                    </div>
                                                </div>
                                            </div> -->
                                           <!--  <div class="column is-6">
                                               &nbsp;
                                            </div> -->
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Match Status *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
<input type="checkbox" class="is-switch" name="is_active" value="1" 
<?php if($matches->match_status == '1'){?> checked <?php } ?>>
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Disable/Enable</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>TixStock</label>
                                                     <div class="control has-icon">
                                                        <div class="switch-block no-padding-all">
                                                            <label class="form-switch is-primary">
                                                                <input type="checkbox" class="is-switch" name="tixstock_status" <?php if($matches->tixstock_status == '1'){?> checked <?php } ?> value="1">
                                                                <i></i>
                                                            </label>
                                                            <div class="text">
                                                                <span>Enable / disable Tixstock Api</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Popular Events *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
                                                                        <input type="checkbox" class="is-switch" name="upcomingevents" <?php if($matches->upcoming_events == '1'){?> checked <?php } ?> value="1">
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Disable/Enable</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Availability *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
                                                                        <input type="checkbox" class="is-switch" name="availability" value="1" <?php if($matches->availability == '1'){?> checked <?php } ?>>
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Disable/Enable</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                            
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Ignore auto24off *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
                                                                        <input type="checkbox" class="is-switch" name="ignoreautoswitch" value="1" <?php if($matches->ignoreautoswitch == '1'){?> checked <?php } ?> >
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Disable/Enable</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>

                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Top Game *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
                                                                        <input type="checkbox" class="is-switch" name="top_games" value="1" <?php if($matches->top_games == '1'){?> checked <?php } ?> >
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Disable/Enable</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>High Demand Ticket ? *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
                                                                        <input type="checkbox" class="is-switch" name="high_demand" value="1" <?php if($matches->high_demand == '1'){?> checked <?php } ?> >
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Disable/Enable</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Almost Sold Ticket ? *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
                                                                        <input type="checkbox" class="is-switch" name="almost_sold" value="1" <?php if($matches->almost_sold == '1'){?> checked <?php } ?> >
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Disable/Enable</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>

                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Feature  Game ? *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
                                                                        <input type="checkbox" class="is-switch" name="feature_games" value="1" <?php if($matches->feature_games == '1'){?> checked <?php } ?> >
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Disable/Enable</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>

                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>TBC ? *</label>
                                                     <div class="control has-icon">
                                                                <div class="switch-block no-padding-all">
                                                                    <label class="form-switch is-primary">
                                                                        <input type="checkbox" class="is-switch tbc_status" name="tbc_status" value="1" <?php if($matches->tbc_status == '1'){?> checked <?php } ?> >
                                                                        <i></i>
                                                                    </label>
                                                                    <div class="text">
                                                                        <span>Disable/Enable</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>



                                        </div>

                                        <?php if (empty($matches->m_id)) { ?>
                                        <div class="columns">
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Send Seller Email Notification </label>
                                                     <div class="control has-icon">
                                                        <div class="switch-block no-padding-all">
                                                            <label class="form-switch is-primary">
                                                                <input type="checkbox" class="is-switch" name="new_match_status" checked value="1">
                                                                <i></i>
                                                            </label>
                                                            <div class="text">
                                                                <span>Enable / disable </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                <?php } ?>
                                    </div>
                                    <!--Fieldset-->
                                   <!--  <div class="form-fieldset" style="max-width: 580px;">
                                        <div class="fieldset-heading">
                                            <h4>Match Content Info</h4>
                                            <p>Fill the Match Content Information</p>
                                        </div>

                                        <div class="columns is-multiline">
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Meta Title *</label>
                                                    <div class="control">
                                                        <textarea class="textarea" rows="4" placeholder="Meta Title" name="metatitle" required><?php echo $matches->meta_title;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Meta Description *</label>
                                                    <div class="control">
                                                        <textarea class="textarea" rows="4" placeholder="Meta Description" name="metadescription" required><?php echo $matches->meta_description;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Match Description </label>
                                                    <div class="control">
                                                         <textarea id="match_description" name="description"><?php echo $matches->description;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!--Fieldset-->
                                    <div class="form-fieldset" style="max-width: 580px;">
                                        <div class="fieldset-heading">
                                            <h4>Match Info</h4>
                                            <p>Fill the following Match information</p>
                                        </div>

                                        <div class="columns is-multiline">
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Match Date *</label>
                                                     <div class="control">
                                                         <input name="matchdate" id="bulma-datepicker-1" class="input" type="date" placeholder="dd/mm/yyy" required  value="">
                                                    </div>
                                                </div>
                                                <p class="match_date_change" style="display: none;">
                                                 <input type="checkbox" name="send_email" value="1" sty> Send a EMail to customer change date?
                                             </p>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Match Time *</label>
                                                     <div class="control">
                                                         <input class="input" type="time" name="matchtime" placeholder="hh:mm" required value="<?php echo date('H:i', strtotime($matches->match_date));?>" <?php if($matches->m_id == ''){?> id="bulma-datepicker-5" <?php } ?>>

                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Country *</label>
                                                    <div class="control">
                                                        <select class="form-control select2" id="country" name="country" onchange="get_state_city(this.value);" required>
                                                            <option value="">-Select Country-</option>
                                                              <?php foreach($countries as $country){ ?>
                                                            <option <?php if($matches->country == $country->id){?> selected <?php } ?> value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                                            <?php } ?>
                                                        </select> 
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>City *</label>
                                                    <?php $cityArray = $this->General_Model->get_state_cities($matches->country);
                                                    ?>
                                                    <div class="control">
                                                        <select class="form-control select2" id="city" name="city" required>
                                                            <option value="">-Select City-</option>
                                                            <?php

                                                                
                                                                foreach ($cityArray as $cityArr) {
                                                                    ?>
                                                                    <option value="<?= $cityArr->id; ?>" <?php
                                                                    if ($matches->city): if ($matches->city == $cityArr->id) {
                                                                            echo 'selected';
                                                                        } endif;
                                                                    ?>><?= $cityArr->name; ?></option>
                                                                            <?php
                                                                        }
                                                                ?>
                                                        </select> 
                                                            </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="state" id="state" value="">
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Venue (Stadium Name) *</label>
                                                    <div class="control">
                                                       <select class="form-control select2" id="venue" name="venue" required>
                                                            <option value="">-Select Venue-</option>
                                                             <?php foreach($stadiums as $stadium){
                                                                $stadium_name = $stadium->stadium_name;
                                                                if($stadium->stadium_variant != ''){
                                                                    $stadium_name = $stadium->stadium_name.'-'.$stadium->stadium_variant;
                                                                }
                                                              ?>
                                                            <option <?php if($matches->venue == $stadium->s_id){?> selected <?php } ?> value="<?php echo $stadium->s_id;?>"><?php echo $stadium_name;?></option>
                                                            <?php } ?>
                                                        </select>  
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>URL Key </label>
                                                    <div class="control">
                                                        <input type="text" required class="input" placeholder="Enter Match URL" name="event_url" id="event_url" value="<?php echo $matches->slug;?>" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Currency *</label>
                                                    <div class="control">
                                                        <select class="form-control" id="price_type" name="price_type" required>
                                                            <option value="">-Select Currency-</option>
                                                              <?php foreach($currencies as $currency){ ?>
                                                            <option value="<?php echo trim($currency->currency_code);?>" <?php if($matches->price_type == trim($currency->currency_code)){?> selected <?php } ?>><?php echo $currency->currency_code;?> (<?php echo $currency->symbol;?>)</option>
                                                            <?php } ?>
                                                        </select> 
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Countries that are denied access </label>
                                                    <div class="control">
                                                        <select class="form-control select2" multiple id="bcountry" name="bcountry[]" >
                                                            <option value="">-Select denied Countries-</option>
                                                            <?php foreach($countries as $country){ ?>
                                                            <option <?php 
                                                            if(isset($ban_arr)){
                                                            if(in_array($country->id, $ban_arr)){
                                                                 echo 'selected="selected"';
                                                                            } }
                                                                ?> value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                                            <?php } ?>
                                                        </select> 
                                                            </div>
                                                </div>
                                            </div>
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Search Keywords </label>
                                                    <div class="control">
                                                        <input type="text" required class="input" placeholder="Enter Search Keywords" name="search_keywords" id="search_keywords" value="<?php echo $matches->search_keywords;?>" >

                                                    </div>
                                                </div>
                                            </div>

                                         
                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Blog Image </label>
                                                    <div class="control">
                                                        <input type="file"  class="input" placeholder="Enter Search Keywords" name="blog_image" id="blog_image" value="" >

                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <!--Fieldset-->
                                    
                                </div>
                            </div>
                        </div>

                      
                    </form>
                    </div>

                <?php $this->load->view('common/footer');?>
                <script type="text/javascript">

                      $('#match_description').summernote({
          placeholder: 'Match Description',
          tabsize: 2,
          height: 250,                 // set editor height
          minHeight: null,             // set minimum height of editor
          maxHeight: null,             // set maximum height of editor
          focus: true, 
          toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'video']],
              ['view', ['codeview', 'help']]
          ]
      });

                    var match_date =  "<?php echo date('m/d/Y', strtotime($matches->match_date));?>";

                    <?php if (strtotime($matches->match_date)){ ?>

                         bulmaCalendar.attach("#bulma-datepicker-1", {startDate: new Date('<?php echo date('m/d/Y', strtotime($matches->match_date));?>'), color: themeColors.primary, lang: "en",showHeader: false,
                        showButtons: false,
                        showFooter: false });

                             var element = document.querySelector('#bulma-datepicker-1');
                        if (element) {
                            // bulmaCalendar instance is available as element.bulmaCalendar
                            element.bulmaCalendar.on('select', function(datepicker) {
                                // console.log(datepicker.data.value());
                                // console.log(datepicker.data.value() +"--"+ match_date);

                                if(datepicker.data.value() !=  match_date){
                                    $(".match_date_change").show();
                                }
                                else{
                                    $(".match_date_change").hide();
                                    $(".match_date_change input").prop('checked',false);
                                }
                            });
                        }

                    <?php } else {?>

                        bulmaCalendar.attach("#bulma-datepicker-1", {startDate: new Date('<?php echo date('m/d/Y');?>'), color: themeColors.primary, lang: "en",showHeader: false,
                    showButtons: false,
                    showFooter: false });

                    


                    <?php } ?>  

                      <?php if (strtotime($matches->match_time)){ ?>
                        var now = new Date()
                        console.log(moment(now).format('HH:mm'))
                         bulmaCalendar.attach("#bulma-datepicker-5", {startTime: moment(now).format('HH:mm'), color: themeColors.primary, lang: "en" });

                    <?php } else {?>

                        bulmaCalendar.attach("#bulma-datepicker-5", {startTime: '<?php echo date('h:m');?>', color: themeColors.primary, lang: "en" });

                    <?php } ?>    

                    <?php if (isset($matches->m_id)) {?>
                        $(".tbc_status").change(function(){
                             $(".match_date_change").show();
                         })
                    <?php } ?>   
                </script>
                
<?php exit;?>
