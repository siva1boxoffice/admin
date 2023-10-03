<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>api/new_api/save_api">
                            <?php
                            $api_id = json_decode(base64_decode($this->uri->segment(4)));
                            ?>
                            <input type="hidden" name="new_apiId" value="<?php echo $api_id;?>">
                         <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">New API</h2>
                                </div>
                            </div>
                           
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Create API</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>settings/match_settings/match_settings" class="button h-button is-light is-dark-outlined">
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
                                        <!-- <div class="fieldset-heading">
                                            <h4>User Info</h4>
                                            <p>Fill the following User information</p>
                                        </div> -->

                                        <div class="columns is-multiline">
                                           
                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Choose Partners *</label>
                                                    <div class="control" id="partners_div">
                                                         <select class="roleuser form-control" name="partners" id="partners" required>
                                                            <?php foreach($partners as $partner){ ?>
                                                            <option <?php if (in_array($partner->admin_id, explode(',',$match_settings->partners)))
                                                                { ?> selected <?php } ?> value="<?php echo $partner->admin_id;?>"><?php echo $partner->admin_name;?> <?php echo $partner->admin_last_name;?> (<?php echo $partner->admin_email;?>)
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Available From Date *</label>
                                                     <div class="control">
                                                         <input name="from_date" id="bulma-datepicker-1" class="input" type="date" placeholder="dd/mm/yyyy" required  value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Available To Date *</label>
                                                     <div class="control">
                                                         <input class="input" type="date" name="to_date" id="bulma-datepicker-1"placeholder="dd/mm/yyyy" required value="">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Choose Tournment *</label>
                                                    <div class="control" id="tournament_div">
                                                     <select class="roleuser form-control" name="tournament" id="tournament" required>
                                                    <?php foreach($tournaments as $tournament){ ?>
                                                    <option <?php if (in_array($tournament->admin_id, explode(',',$match_settings->tournaments)))
                                                        { ?> selected <?php } ?>  value="<?php echo $tournament->t_id;?>"><?php echo $tournament->tournament_name;?></option>
                                                <?php } ?>
                                                </select>
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Choose Event *</label>
                                                    <div class="control" id="events_div">
                                                        <select class="roleuser form-control" name="events[]" id="events" multiple required>
                                                       
                                                            <?php foreach($events as $event){ ?>
                                                            <option <?php if (in_array($event->m_id, explode(',',$match_settings->events)))
                                                                { ?> selected <?php } ?>  value="<?php echo $event->m_id;?>"><?php echo $event->match_name;?> </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Choose Match Category *</label>
                                                    <div class="control" id="category_div">
                                                        <select class="roleuser form-control" name="category" id="category" required>
                                                       
                                                            <?php foreach($categories as $category){ ?>
                                                            <option <?php if (in_array($category->admin_id, explode(',',$match_settings->categories)))
                                                                { ?> selected <?php } ?>  value="<?php echo $category->id;?>"><?php echo $category->category_name;?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Maximum Ticket Per Event *</label>
                                                    <div class="control" id="ticketcount_div">
                                                        <input type="text" class="form-control" name="tickets_per_events" id="ticketcount"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Full fillment type *</label>
                                                    <div class="control" id="fullfillment_div">
                                                         <select class="roleuser form-control" name="fullfillment" id="fullfillment" required>
                                                            <option value="">Choose Storefronts</option>
                                                            <option value="1">1BOXOFFICEHUB</option>
                                                            <option value="2">THIRDPARTY</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-6">
                                                <div class="field">
                                                    <label>Api status *</label>
                                                    <div class="control" id="status_div">
                                                         <select class="roleuser form-control" name="status" id="status" required>
                                                            <option value="1">Active</option>
                                                            <option value="0">In-Active</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Unique Id *</label>
                                                    <div class="control" id="storefronts_div">
                                                         <input type="text" class="form-control">
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
                    $(document).ready(function(){
                        if ($('#sellers').length) new Choices('#sellers', { removeItemButton: !0 });
                        if ($('#partners').length) new Choices('#partners', { removeItemButton: !0 });
                        if ($('#afiliates').length) new Choices('#afiliates', { removeItemButton: !0 });
                        if ($('#storefronts').length) new Choices('#storefronts', { removeItemButton: !0 });
                       /* get_users(1,'sellers');
                        get_users(2,'partners');
                        get_users(3,'afiliates');
                        get_users(4,'storefronts');*/
                    })
                    
                </script>
<?php exit;?>
