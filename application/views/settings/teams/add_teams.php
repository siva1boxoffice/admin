<?php $this->load->view('common/header'); ?>
<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Add Top League" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
<div class="page-content-wrapper">
<div class="page-content is-relative business-dashboard course-dashboard">
<div class="page-content-inner">
   <div class="flex-list-wrapper has-loader">
      <div class="h-loader-wrapper">
         <div class="loader is-small is-loading"></div>
      </div>
      <!--Form Layout 1-->
      <div class="form-layout">
         <div class="form-outer">
            <form id="top-league-form" method="post" class="validate_form_v1 login-wrapper validate_form_v1" action="<?php echo base_url(); ?>settings/home_top_teams/save">
               <input type="hidden" name="match_type" value="team">
               <input type="hidden" name="top_league_id" value="<?php if (isset($top_league->id)) {
                  echo $top_league->id;
                  } ?>">
               <div class="form-header stuck-header">
                  <div class="form-header-inner">
                     <div class="left">
                        <h3>Add New Top Team</h3>
                     </div>
                     <div class="right">
                        <div class="buttons">
                           <a href="<?php echo base_url(); ?>settings/home_top_teams" class="button h-button is-light is-dark-outlined">
                           <span class="icon">
                           <i class="lnir lnir-arrow-left rem-100"></i>
                           </span>
                           <span>Cancel</span>
                           </a>
                           <button id="save-button" class="button h-button is-primary is-raised">Save</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-body">
                  <!--Fieldset-->
                  <div class="form-fieldset">
                     <div class="fieldset-heading">
                        <h4>Top Team Info</h4>
                     </div>
                     <div class="columns is-multiline">
                        <div class="column is-6">
                           <div class="field">
                              <label>Team </label>
                              <div class="control has-icon">
                                 <select class="form-control select2" id="team" name="team" required>
                                    <option value="">-Select Team -</option>
                                    <?php foreach ($teams as $team) { ?>
                                    <option value="<?php echo $team->team_id; ?>" <?php if (isset($top_league->tournament_id)) {
                                       if ($team->team_id == $top_league->tournament_id) {
                                       	echo ' selected  ';
                                       }
                                       } ?>><?php echo $team->team_name; ?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="column is-6">
                           <div class="field">
                              <label>Sort by *</label>
                              <div class="control has-icon">
                               <input type="text" required class="input" placeholder="Sort by" id="sorting_order" name="sorting_order" value="<?php echo $top_league->sorting_order;?>">
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
                  <!--Fieldset-->
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view('common/footer'); ?>
<?php exit; ?>