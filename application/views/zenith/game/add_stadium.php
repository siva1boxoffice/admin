 <?php  $this->load->view(THEME.'common/header'); 



?>
<div id="overlay" style="display: none;">
   <div id="loader">
      <!-- Add your loading spinner HTML or image here -->
      <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
   </div>
</div>
<style type="text/css">
   /*.selbox{
   padding: 0;
   background:none;
   border: 0;
   margin: 0;
   line-height: unset;
   height: auto;
   -webkit-appearance: none;
   -moz-appearance: none;
   }*/
   .ds-none{  display:none !important; }
   #overlay {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background-color: rgba(0, 0, 0, 0.5);
   z-index: 9999;
   }
   .colorpicker-element .input-group-addon i, .colorpicker-element .add-on i{
   width: 25px !important;
   height: 25px !important;
   }
   .mapsvg-region-link{
    
   }

   .block_color{ height:25px ;width : 25px}
</style>
<!-- Begin main content -->
<div class="main-content">
<!-- content -->
<div class="page-content">
<!-- page header -->
<div class="page-title-box tick_details">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-8">
            <h5 class="card-title"><?php   echo $getStadium->stadium_name;?> </h5>
         </div>
         <!--   <div class="col-sm-4">
            <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
               <a href="#" data-toggle="modal" data-target="#add-board-modal" class="btn btn-primary mb-2">BACK</a>
                  <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2 ml-2">SAVE</a>
            </div>
            </div> -->
      </div>
   </div>
</div>
<!-- page content -->
<div class="page-content-wrapper mt--45 box-details">
   <div class="container-fluid">
      <div class="card">
         <div class="card-body">
            <div class="row">
               <div class="col-lg-12" >
                <div class="">
                          <h5 class="card-title">Add Stadium </h5>
                          <p>Fill the following Stadium information</p>
                        </div>
                  <ul class="nav nav-tabs nav-bordered" id="myTab" style="display:none">
                     <li class="nav-item active"><a class="active" href="#tab_settings">Add Stadium</a></li>
                     <!--   <li><a href="#tab_colors">Colors</a></li> -->
                    
                  </ul>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12" >
                  <!-- Content Wrapper -->
                  <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Add Stadium" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
                     <div class="page-content-wrapper">
                        <div class="page-content is-relative business-dashboard course-dashboard">
                           <div class="page-content-inner">
                              <div class="flex-list-wrapper">
                                 <div id="mapsvg-modal-code" class="modal fade" tabindex="-1" role="dialog">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                             <h4 class="modal-title">The Code</h4>
                                          </div>
                                          <div class="modal-body">
                                             <h5>Add links to files into &lt;head&gt;&lt;/head&gt;:</h5>
                                             <textarea id="mapsvg-result-code-dep"></textarea>
                                             <br><br>
                                             <h5>Add this code to the container where you want to show your map:</h5>
                                             <textarea id="mapsvg-result-code"></textarea>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                             <!--            <button type="button" class="btn btn-primary">Save changes</button>-->
                                          </div>
                                       </div>
                                       <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                 </div>
                                 <!-- /.modal -->
                                 <iframe src="about:blank" class="stretch" id="stretchIframe" scrolling="no" style="width: 100%;height:100%;z-index: -1;"></iframe>
                                 <div class="mapsvg-dashboard" id="mapsvg-admin">
                                    <!-- <div id="mapsvg-nav-header">
                                       <h2>
                                           1BoxOffice <span id="map-page-title"></span>
                                       
                                           <button id="new_block_click" class="btn btn-sm btn-danger"  >Reset</button>
                                       </h2>
                                       
                                       <div class="pull-right">
                                       
                                       
                                       
                                       
                                           <button id="mapsvg-save" class="btn btn-sm btn-primary" data-loading-text="Saving..." >Save</button>
                                       </div>
                                       </div> -->
                                    <!--TEMPLATE INDEX-->
                                    <div id="mapsvg-edit-choose">
                                       <form action="<?= base_url('game/stadium/check_stadium'); ?>" enctype="multipart/form-data" method="POST" >
                                          <div id="mapsvg-php-functions" class="">
                                             <!--                            <div class="row">
                                                <div class="form-group row col-lg-6">
                                                    <label class="col-xs-12" for="category">Select Cuntry</label>
                                                    <div class="col-sm-12 form-material">
                                                        <select name="country" class="form-control countries" id="country">
                                                            <option value="">Select Country</option>
                                                <?php foreach ($allCountries as $allCount) { ?>
                                                                                                    <option value="<?= $allCount->id; ?>"><?= $allCount->name; ?></option>
                                                <?php }
                                                   ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row col-lg-6">
                                                    <label class="col-xs-12" for="state">Select State</label>
                                                    <div class="col-sm-12 form-material">
                                                        <select name="state" class="form-control" id="state">
                                                            <option value="">Select country first</option>
                                                        </select>
                                                    </div></div>
                                                </div>-->
                                             <div class="row">
                                                <!--                                <div class="form-group row col-lg-6">
                                                   <label class="col-xs-12" for="city">Select City</label>
                                                   <div class="col-sm-12 form-material">
                                                       <select name="city" class="form-control cities" id="city">
                                                           <option value="">Select state first</option>
                                                       </select>
                                                   </div></div>-->
                                                <div class="form-group row col-sm-6">
                                                   </br>
                                                   <label class="control-label col-xs-6">Upload SVG file</label>
                                                   <div class="col-sm-6 form-material text-right">
                                                      <!-- <input type="file"  name="svg_file" id="svg_file_uploader"/>-->
                                                      <span class="btn btn-primary btn-sm btn-file" data-loading-text="Uploading...">
                                                      Browse... <input type="file" name="svg_file" id="svg_file_uploader" />
                                                      </span>
                                                      <input type="hidden" name="upload_svg" />
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </form>
                                       <iframe src="" id="remote-iframe" style="display: none;"></iframe>
                                       <form id="mapsvg-new-map" method="POST" style="display: none;">
                                          <textarea id="mapsvg-remote-options" name="mapsvg_remote_options"></textarea>
                                       </form>
                                    </div>
                                    <!--END TEMPLATE INDEX-->
                                    <!--TEMPLATE EDIT-->
                                    <div id="mapsvg-panels" class="stretch">
                                       <div class="stretch mapsvg-panel-left" id="mapsvg-container">
                                          <div class="btn-group" data-toggle="buttons" id="mapsvg-map-mode">
                                             <label class="btn btn-default btn-xs active">
                                             <input type="radio" name="mapsvg_map_mode" value="preview" autocomplete="off" checked> Preview
                                             </label>
                                             <label class="btn btn-default btn-xs">
                                             <input type="radio" name="mapsvg_map_mode" value="editRegions" autocomplete="off"> Edit regions
                                             </label>
                                          </div>
                                          <div id="mapsvg" class="stretch"></div>
                                          <div class="button-list preview_details mb-3">
                                             <button type="button" class="preview_style btn btn-primary waves-effect waves-light" data-effect="wave" data-val="preview">Preview</button>
                                             <button type="button" class="preview_style btn btn-light waves-effect waves-light" data-effect="wave" data-val="editRegions">Edit Regions</button>
                                          </div>
                                       </div>
                                       <div class="stretch mapsvg-panel-right">
                                          <div id="mapsvg-mapform-container" class="stretch mapsvg-scrollable-content nano">
                                             <div id="mapsvg-search-placeholder">
                                                <div class="row">
                                                   <div class="col-lg-5 edit_map ">
                                                      <div id="mapsvg-regions-search">
                                                         <input  onClick="this.select();" type="text" class="form-control" placeholder="Search regions by ID/Title" aria-describedby="basic-addon1" autocomplete="off"/>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-4 edit_map ">
                                                      <select class="form-control" id="default_category">
                                                         <option value="">Select Category</option>
                                                         <?php
                                                            if ($getSeatCategory): foreach ($getSeatCategory as $getSeatCat) {
                                                                    ;
                                                                    ?>
                                                         <option  value="<?= $getSeatCat->stadium_seat_id ?>"><?= $getSeatCat->seat_category ?></option>
                                                         <?php } endif; ?>
                                                      </select>
                                                   </div>
                                                   <div class="col-lg-3 edit_map ">
                                                      <div class="map_details_view">
                                                         <a href="javascript:void(0)"  class="btn btn-success mb-0 ml-0 save_ticket_btn mt-0">Save Category</a>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div id="mapsvg-markers-search">
                                                   <div class="input-group" style="margin-bottom: 10px;">
                                                      <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search"></i></span>
                                                      <input id="mapsvg-markers-search-1" onClick="this.select();" type="text" class="form-control" placeholder="Search markers by ID" aria-describedby="basic-addon2" autocomplete="off"/>
                                                   </div>
                                                   <div id="mapsvg-geocode">
                                                      <input type="text" class="form-control typeahead" placeholder="New marker: enter address or coordinates"/>
                                                   </div>
                                                </div>
                                                <input type="hidden" value="<?= $getStadium->s_id ?>" id="hiddenStadiumId">
                                                <input type="hidden" value="" id="current_language">
                                                <form id="stadiumForm" action="<?= base_url('game/stadium/save_stadium/' . $getStadium->s_id) ?>" method="post">
                                                   <input type="hidden" name="stadiumViewName" id="stadiumViewName">
                                                   <input type="hidden" name="stadiumViewName_ar" id="stadiumViewName_ar">
                                                   <input type="hidden" name="stadiumname" id="stadiumName">
                                                   <input type="hidden" name="stadiumimage" id="stadiumImagePath">
                                                   <input type="hidden" name="stadiumwidth" id="stadiumWidth">
                                                   <input type="hidden" name="stadiumheight" id="stadiumHeight">
                                                   <input type="hidden" name="stadiumcode" id="stadiumCode">
                                                   <input type="hidden" name="splitcode" id="splitCode">
                                                   <input type="hidden" value="" id="blockId" name="blockid">
                                                   <!--<input type="hidden" value="" id="price" name="price">-->
                                                   <input type="hidden" value="" id="fillColor" name="fillcolor">
                                                   <!-- <input type="hidden" value="" id="noTickets" name="notickets"> -->
                                                   <!--<input type="hidden" value="" id="noBlocks" name="noblocks">-->
                                                   <input type="hidden" value="" id="inpt_gamecategory" name="inpt_gamecategory">
                                                   <input type="hidden" value="" id="inpt_country" name="inpt_country">
                                                   <input type="hidden" value="" id="inpt_city" name="inpt_city">
                                                </form>
                                             </div>
                                             <div class="nano-content">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!--END TEMPLATE EDIT-->
                                    <!--HANDLEBARS-->
                                    <script type="text/x-handlebars-template" id="mapsvg-control-panel">
                                       <form id="mapform" action="" method="post" class="form-horizontal" autocomplete="off">
                                       
                                       <input type="hidden" name="save_mapsvg" value="1"/>
                                       <input type="hidden" id="default_width" value="{{default.width}}"/>
                                       <input type="hidden" id="default_height" value="{{default.height}}"/>
                                       <input type="hidden" id="default_viewbox_width" value="{{default.viewBox.[2]}}"/>
                                       <input type="hidden" id="default_viewbox_height" value="{{default.viewBox.[3]}}"/>
                                       <input type="hidden" name="map_id" value="{{map_id}}"/>
                                      <input type="hidden" value="" id="inpt_gamecategory" name="inpt_gamecategory">
                                      <input type="hidden" value="" id="inpt_country" name="inpt_country">
                                      <input type="hidden" value="" id="inpt_city" name="inpt_city">
                                       <div class="tab-content" id="mapsvg-tabs">
                                       <!-- TAB 1 -->
                                       <div class="tab-pane active" id="tab_settings">
                                       
                                           <div class="team_info_details mt-0 ">
                                       <h5 class="">Stadium Info</h5>
                                       <p>Fill the Stadium Information</p>
                                       </div>
                                       <div class="row column_modified">
                                       <div class="col-md-12">
                                       <!-- MAIN SETTINGS -->

                                       <div class="form-group row">
                                       <label class="col-md-12 control-label">Event Category</label>
                                       <div class="col-md-12">
                                       <select class="custom-select" id="gamecategory" name="gamecategory" required data-live="change">
                                                      <option value="">Select Category</option>
                                                      <?php foreach ($gcategory as $category) { ?>
                                                            <option value="<?php echo $category->id; ?>" <?php if (isset($getStadium->category)) {
                                                               if ($getStadium->category == $category->id) {
                                                                  echo ' selected  ';
                                                               }
                                                               } ?>><?php echo $category->category_name; ?></option>
                                                      <?php } ?>                                                        
                                                 </select>
                                       </div>
                                       </div>
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">File</label>
                                       <div class="col-md-12">
                                       <input type="hidden" name="mapfile" value="{{svgFilename}}"/>
                                       <input class="form-control" type="text" autocomplete="off" disabled="true" value="{{svgFilename}}"/>
                                       </div>
                                       </div>
                                       
                                       
                                       <div class="form-group row ">
                                       <label class="col-md-12" control-label">Stadium Name (English)</label>
                                       <div class="col-md-12">
                                       <input class="form-control" type="text" autocomplete="off" id="stadium_name" name="stadium_name" value="<?php 
                                          //echo str_replace("-"," ",$getStadium->stadium_name); 
                                          echo $getStadium->stadium_name;
                                          
                                          ?>" data-live="keyup" />
                                       </div>
                                       </div>
                                       
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">Stadium Name (Arabic)</label>
                                       <div class="col-md-12">
                                       <input class="form-control" type="text" autocomplete="off" id="stadium_name_ar" name="stadium_name_ar" value="<?php 
                                          //echo str_replace("-"," ",$getStadium->stadium_name); 
                                          echo $getStadium->stadium_name_ar;
                                          
                                          ?>" data-live="keyup" />
                                       </div>
                                       </div>

                                       

                                        <div class="form-group row">
                                       <label class="col-md-12" control-label">Seach Keyword</label>
                                       <div class="col-md-12">
                                       <input class="form-control" type="text" autocomplete="off" id="search_keywords" name="search_keywords" value="<?php 
                                          //echo str_replace("-"," ",$getStadium->stadium_name); 
                                          echo $getStadium->search_keywords;
                                          
                                          ?>" data-live="keyup" />
                                       <p>Use Comma Separated Key.For Ex.Lord stadium,london..</p>
                                       </div>
                                       
                                       </div>
                                       
                                         <div class="form-group row">
                                       <label class="col-md-12" control-label">Stadium variant</label>
                                       <div class="col-md-12">
                                       <input class="form-control" type="text" autocomplete="off" id="stadium_variant" name="stadium_variant" value="<?php 
                                          //echo str_replace("-"," ",$getStadium->stadium_name); 
                                          echo $getStadium->stadium_variant;
                                          
                                          ?>" data-live="keyup" />
                                       </div></div>
                                        <div class="form-group row">
                                          <div class="col-md-6">
                                             <div class="row">
                                       <label class="col-md-12 control-label">Stadium Country</label>
                                       <div class="col-md-12">
                                       <select class="custom-select" id="stadium_country" name="stadium_country" required data-live="change" onchange="get_state_city(this.value);">
                                                      <option value="">Select Stadium Country</option>
                                                      <?php foreach ($countries as $country) { ?>
                                                            <option value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                                                      <?php } ?>                                                        
                                                 </select>
                                       </div>
                                       </div>
                                     </div>
                                    
                                        <div class="col-md-6">
                                          <div class="row">
                                       <label class="col-md-12 control-label">Stadium City</label>
                                       <div class="col-md-12">
                                       <select class="custom-select" id="stadium_city" name="stadium_city" required data-live="change">
                                                      <option value="">Select Stadium City</option>
                                                                                                         
                                                 </select>
                                       </div>
                                       </div>
                                       </div>
                                       </div>
                                       
                                       <div class="row">
                                       <div class="col-sm-12">
                                       <div class="tick_details border-top">
                                       <div class="row">
                                       <div class="col-sm-4">
                                       
                                       </div>
                                       <div class="col-sm-8">
                                       <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                       <a href="<?php echo base_url('game/stadium/list_stadium');?>" class="btn btn-primary mb-2 mt-3">Back</a>
                                       <button  type="button" id="mapsvg-save" class="btn btn-success mt-2 ml-2" data-loading-text="Saving...">Save</button>
                                       </div>
                                       </div>
                                       </div>
                                       </div></div>
                                       </div>  
                                       </div>
                                       
                                       <div class="form-group row" style="display:none;">
                                       <label class="col-md-12" control-label">Title</label>
                                       <div class="col-md-12">
                                       <input class="form-control" type="text" autocomplete="off" name="title" value="{{title}}" data-live="keyup" />
                                       </div>
                                       </div>
                                       
                                       <div class="form-group row" style="display:none;">
                                       <label class="col-md-12" control-label">Width</label>
                                       <div class="col-md-12">
                                       <input class="form-control" id="mapsvg-controls-width" type="text" autocomplete="off" name="width" value="{{width}}" autocomplete="off" />
                                       </div>
                                       </div>
                                       
                                       <div class="form-group row" style="display:none;">
                                       <label class="col-md-12" control-label">Height</label>
                                       <div class="col-md-12">
                                       <input  class="form-control" id="mapsvg-controls-height" type="text" autocomplete="off" name="height" value="{{height}}"  autocomplete="off" />
                                       </div>
                                       </div>
                                       
                                       
                                       <div class="form-group row" style="display:none;">
                                       <div class="col-sm-3"></div>
                                       <div class="col-md-12">
                                       <div class="btn-group" data-toggle="buttons">
                                       <label class="btn btn-default active">
                                       <input name="lockAspectRatio" data-live="change" type="checkbox" id="mapsvg-controls-ratio" autocomplete="off" {{#if lockAspectRatio}}checked{{/if}} /> <i class="fa fa-lock"></i> Lock aspect ratio
                                       </label>
                                       </div>
                                       </div>
                                       </div>
                                       
                                       
                                       <div class="form-group row" style="display:none;">
                                       <label class="col-md-12" control-label">Start position</label>
                                       <div class="col-md-12">
                                       <div class="input-group">
                                       <input data-live="change" name="initialViewBox" class="form-control" type="text" autocomplete="off" disabled="" id="mapsvg-controls-viewbox" value="{{#each viewBox}}{{this}} {{/each}}"/>
                                       <span class="input-group-btn">
                                       <button class="btn btn-default" id="mapsvg-controls-set-viewbox">Set current</button>
                                       <button class="btn btn-default" id="mapsvg-controls-reset-viewbox">Reset</button>
                                       </span></div>
                                       </div>
                                       </div>
                                       </div>
                                       
                                       
                                       
                                       <div id="mapsvg-controls-zoom-options" {{#unless zoom.on}}style="display:none"{{/unless}}>
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">Zoom by mousewheel</label>
                                       <div class="col-md-12">
                                       <div class="btn-group" data-toggle="buttons" id="mapsvg-controls-zoom-2">
                                       <label class="btn btn-default {{#if zoom.mousewheel}}active{{/if}}">
                                       <input type="radio" name="zoom[mousewheel]" value="1" {{#if zoom.mousewheel}}checked{{/if}} data-live="change"/>
                                       On
                                       </label>
                                       <label class="btn btn-default {{#unless zoom.mousewheel}}active{{/unless}}">
                                       <input type="radio" name="zoom[mousewheel]" value="0" {{#unless zoom.mousewheel}}checked{{/unless}} data-live="change"/>
                                       Off
                                       </label>
                                       </div>
                                       </div>
                                       </div>
                                       
                                       
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">Zoom Buttons</label>
                                       <div class="col-md-12">
                                       <div class="btn-group" data-toggle="buttons" id="mapsvg-controls-zoom-buttons">
                                       <label class="btn btn-default {{#ifeq zoom.buttons.location 'hide'}}active{{/ifeq}}">
                                       <input type="radio" name="zoom[buttons][location]" value="hide" {{#ifeq zoom.buttons.location 'hide'}}checked{{/ifeq}} data-live="change"/>
                                       Hide
                                       </label>
                                       <label class="btn btn-default {{#ifeq zoom.buttons.location 'left'}}active{{/ifeq}}">
                                       <input type="radio" name="zoom[buttons][location]" value="left" {{#ifeq zoom.buttons.location 'left'}}checked{{/ifeq}} data-live="change"/>
                                       Left
                                       </label>
                                       <label class="btn btn-default {{#ifeq zoom.buttons.location 'right'}}active{{/ifeq}}">
                                       <input type="radio" name="zoom[buttons][location]" value="right" {{#ifeq zoom.buttons.location 'right'}}checked{{/ifeq}} data-live="change"/>
                                       Right
                                       </label>
                                       </div>
                                       </div>
                                       </div>
                                       
                                       <!--
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">Zoom Step</label>
                                       <div class="col-md-12">
                                       <input class="form-control" id="mapsvg-controls-zoom-step" type="text" autocomplete="off" name="zoomDelta]" id="zoom-delta" value="{{zoomDelta}}"/>
                                       <p class="help-block">From 1  to 5. Small step (1.05, 1.1, 1.2 ...) gives more smooth zooming.<br />
                                       </div>
                                       </div>
                                       -->
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">Zoom Limits</label>
                                       <div class="col-md-12">
                                       <input id="mapsvg-controls-zoomlimit" type="text" autocomplete="off" autocomplete="off" name="zoom[limit]" value="{{zoom.limit.[0]}};{{zoom.limit.[1]}}" data-live="change"/>
                                       </div>
                                       </div>
                                       </div>
                                       
                                       
                                       
                                       
                                       <div class="form-group row" id="mapsvg-global-popovers" style="display:none;">
                                       <label class="col-md-12" control-label">Global popovers</label>
                                       <div class="col-md-12">
                                       <div class="btn-group" data-toggle="buttons" id="mapsvg-popovers-mode">
                                       <label class="btn btn-default {{#ifeq popovers.mode 'off'}}active{{/ifeq}}">
                                       <input type="radio" name="popovers[mode]" value="off" {{#ifeq popovers.mode 'off'}}checked{{/ifeq}} data-live="change"/>
                                       Off
                                       </label>
                                       <label class="btn btn-default {{#if_function popovers.mode}}active{{/if_function}}">
                                       <input type="radio" class="mapsvg-function-radio" name="popovers[mode]" {{#if_function popovers.mode}}checked{{/if_function}}/>
                                       Function
                                       </label>
                                       </div>
                                       <textarea  rows="5" data-live="change" name="popovers[mode]" data-event="popovers" id="mapsvg-global-popover-function" class="mapsvg-function-radio-extra mapsvg-function-textarea form-control" data-validate="function">{{#if_function popovers.mode}}{{{toString popovers.mode}}}{{/if_function}}</textarea>
                                       </div>
                                       </div>
                                       
                                       
                                       
                                       
                                       <div class="form-group row" id="mapsvg-global-tooltips" style="display:none;">
                                       <label class="col-md-12" control-label">Global tooltips</label>
                                       <div class="col-md-12">
                                       <div class="btn-group" data-toggle="buttons" id="mapsvg-tooltips-mode">
                                       <label class="btn btn-default {{#ifeq tooltips.mode 'off'}}active{{/ifeq}}">
                                       <input type="radio" name="tooltips[mode]" value="off"  {{#ifeq tooltips.mode 'off'}}checked{{/ifeq}} data-live="change"/>
                                       Off
                                       </label>
                                       <label class="btn btn-default  {{#ifeq tooltips.mode 'id'}}active{{/ifeq}}">
                                       <input type="radio" name="tooltips[mode]" value="id"  {{#ifeq tooltips.mode 'id'}}checked{{/ifeq}} data-live="change"/>
                                       SVG id
                                       </label>
                                       <label class="btn btn-default {{#ifeq tooltips.mode 'title'}}active{{/ifeq}}">
                                       <input type="radio" name="tooltips[mode]" value="title"  {{#ifeq tooltips.mode 'title'}}checked{{/ifeq}} data-live="change"/>
                                       SVG title
                                       </label>
                                       <label class="btn btn-default {{#if_function tooltips.mode}}active{{/if_function}}">
                                       <input type="radio" class="mapsvg-function-radio" name="tooltips[mode]" {{#if_function tooltips.mode}}checked{{/if_function}} />
                                       Function
                                       </label>
                                       </div>
                                       <textarea rows="5" name="tooltips[mode]" data-live="change" data-event="tooltips" id="mapsvg-global-tooltip-function" class="mapsvg-function-radio-extra mapsvg-function-textarea form-control" data-validate="function">{{#if_function tooltips.mode}}{{{toString tooltips.mode}}}{{/if_function}}</textarea>
                                       
                                       </div>
                                       </div>
                                       
                                       
                                       
                                       
                                       
                                       
                                       <div id="mapsvg-gauge-options" {{#unless gauge.on}}style="display:none"{{/unless}}>
                                       
                                       </div>
                                       
                                       
                                       
                                       <div id="mapsvg-menu-group"{{#unless menu.on}}style="display:none"{{/unless}}>
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">Menu (Regions) container</label>
                                       <div class="col-md-12">
                                       <div class="input-group">
                                       <span class="input-group-addon">#</span>
                                       <input type="text" onkeyup="jQuery(this).closest('.form-group row').find('#menu-container-id-live').text(this.value)" onpaste="jQuery(this).parent().find('#menu-container-id-live').text(this.value)" class="form-control" autocomplete="off" name="menu[containerId]" value="{{menu.containerId}}" data-live="keyup" />
                                       </div>
                                       <p class="help-block">Add &lt;ul id="<span id="menu-container-id-live">{{menu.containerId}}</span>"&gt;&lt;/ul&gt; anywhere on a page with your map to show clickable list of regions</p>
                                       
                                       </div>
                                       </div>
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">Menu (Regions) item template</label>
                                       <div class="col-md-12">
                                       <textarea rows="5" name="menu[template]" data-live="change" id="mapsvg-menu-template" class="mapsvg-function-textarea form-control" data-validate="function">{{#if_function menu.template}}{{{toString menu.template}}}{{/if_function}}</textarea>
                                       </div>
                                       </div>
                                       </div>
                                       
                                       
                                       
                                       <div id="mapsvg-menu-markers-group"{{#unless menuMarkers.on}}style="display:none"{{/unless}}>
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">Menu (Markers) container</label>
                                       <div class="col-md-12">
                                       <div class="input-group">
                                       <span class="input-group-addon">#</span>
                                       <input type="text" onkeyup="jQuery(this).closest('.form-group row').find('#menu-container-2-id-live').text(this.value)" onpaste="jQuery(this).parent().find('#menu-container-2-id-live').text(this.value)" class="form-control" autocomplete="off" name="menuMarkers[containerId]" value="{{menuMarkers.containerId}}" data-live="keyup" />
                                       </div>
                                       <p class="help-block">Add &lt;ul id="<span id="menu-container-2-id-live">{{menuMarkers.containerId}}</span>"&gt;&lt;/ul&gt; anywhere on a page with your map to show clickable list of regions</p>
                                       
                                       </div>
                                       </div>
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">Menu (Markers) item template</label>
                                       <div class="col-md-12">
                                       <textarea rows="5" name="menuMarkers[template]" data-live="change" id="mapsvg-menu-markers-template" class="mapsvg-function-textarea form-control" data-validate="function">{{#if_function menuMarkers.template}}{{{toString menuMarkers.template}}}{{/if_function}}</textarea>
                                       </div>
                                       </div>
                                       </div>
                                       
                                       
                                       <div class="form-group row" style="display:none;">
                                       <label class="col-md-12" control-label">Preloader text</label>
                                       <div class="col-md-12">
                                       <input type="text" autocomplete="off" class="form-control" id="mapsvg-controls-preloader-text" name="loadingText" value="{{loadingText}}" data-live="keyup"/>
                                       </div>
                                       </div>
                                       </div>
                                       
                                       <!-- TAB 2 -->
                                       <!-- COLORS -->
                                       
                                       <div class="tab-pane " id="tab_colors">
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">Background</label>
                                       <div class="col-md-12">
                                       <div class="input-group cpicker" data-color-name="background">
                                       <span class="input-group-addon"><i></i></span>
                                       <input type="text" autocomplete="off" class=" form-control" name="colors[background]" value="{{colors.background}}"  data-live="change"/>
                                       </div>
                                       <!--<p class="help-block">Enter "transparent" for transparent background.</p>-->
                                       </div>
                                       </div>
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">Base</label>
                                       <div class="col-md-12">
                                       <div class="input-group cpicker" data-color-name="base">
                                       <span class="input-group-addon"><i></i></span>
                                       <input type="text" autocomplete="off" class=" form-control" name="colors[base]" value="{{colors.base}}"  data-live="change"/>
                                       </div>
                                       </div>
                                       </div>
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">Disabled</label>
                                       <div class="col-md-12">
                                       <div class="input-group cpicker" data-color-name="disabled">
                                       <span class="input-group-addon"><i></i></span>
                                       <input class=" form-control" type="text" autocomplete="off" name="colors[disabled]" value="{{colors.disabled}}"  data-live="change"/>
                                       </div>
                                       </div>
                                       </div>
                                       
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">Strokes</label>
                                       <div class="col-md-12">
                                       
                                       <div class="input-group cpicker" data-color-name="stroke">
                                       <span class="input-group-addon"><i></i></span>
                                       <input class=" form-control" type="text" autocomplete="off" name="colors[stroke]" value="{{colors.stroke}}"  data-live="change"/>
                                       </div>
                                       </div>
                                       </div>
                                       
                                       
                                       
                                       <!--SPACER FOR COLOR PICKER-->
                                       <div style="height: 100px;"></div>
                                       
                                       
                                       </div>
                                       
                                       <!-- TAB 3 -->
                                       <!-- REGIONS -->
                                       <div class="tab-pane " id="tab_regions">
                                       
                                       <form>
                                       {{#each regions}}
                                           <input type="hidden" class="GenralData" name="{{id_no_spaces}}" value="{{fill}}">
                                           {{/each}}
                                        </form>
                                       
                                       <div id="mapsvg-search-regions-no-matches" class="well well-sm" style="display: none;">No matches</div>
                                       <table class="table  table-hover table-nowrap mb-0 vertical-middle {{#if gauge.on}}mapsvg-gauge-on{{/if}}" id="table-regions">
                                       <thead class="thead-light">
                                       <th><input type="checkbox" class="all_checkbox" name="" value=""></th>
                                       <th>Block</th>
                                       <th>Category</th>
                                       <th>Colour</th>
                                       </thead>
                                       <tbody>
                                       {{#each regions}}
                                       <tr id="mapsvg-region-{{id_no_spaces}}" data-region-id="{{id}}" data-href="{{href}}"  class="mapsvg-region-row-1">
                                       <td><input type="checkbox" class="region_block_id" name="block_id" value="{{id_no_spaces}}"></td>
                                       <td>{{regions}}
                                       <div class="mapsvg-region-names">
                                       <div class="mapsvg-region-id">{{block_title}}</div>
                                       <div class="mapsvg-region-title">{{title}}</div>
                                       </div>
                                       </td>
                                       <td><div class="column_modified"><select class="form-control mapsvg-region-link selbox"  type="text" autocomplete="off"  name="regions[{{id}}][href]" value="{{href}}" data-live="change">
                                       <option value="">Select Category</option>
                                       <?php
                                          if ($getSeatCategory): foreach ($getSeatCategory as $getSeatCat) {
                                                  ;
                                                  ?>
                                       <option  value="<?= $getSeatCat->stadium_seat_id ?>"><?= $getSeatCat->seat_category ?></option>
                                       <?php } endif; ?>
                                       </select>
                                       </div>
                                       </td>
                                       <td><div class="cpicker input-group"><div class="input-group-prepend">
                                       <span class="input-group-addon"><i id="picker_{{id}}"></i></span></div> 
                                       <input class=" input-small form-control mapsvg-region-color ds-none" type="text" autocomplete="off"  class="input-small" name="regions[{{id}}][fill]" value="{{fill}}"/>
                                       </div>
                                       </tr>
                                       {{/each}}
                                       </tbody>
                                       </table>
                                       </div>
                                       
                                       <!-- TAB 4 -->
                                       <!-- MARKERS -->
                                       <div class="tab-pane tab-markers" id="tab_markers">
                                       
                                       <!--{{#if isGeo}}-->
                                       <!--<p class="help-block bold"><i class="fa fa-map-marker"></i> This map supports geo-coordinates.</p>-->
                                       <!--{{/if}}-->
                                       <!--<p class="help-block">Adding a marker: select <span class="label label-default">Edit markers</span> mode and click on the map.-->
                                       
                                       <div id="mapsvg-search-markers-no-matches" class="well well-sm" style="display: none;">No matches</div>
                                       <table class="table table-striped" id="table-markers">
                                       <tbody>
                                       {{#each markers}}
                                       {{> markerPartial  isSafari=../isSafari markerImages=../markerImages}}
                                       {{/each}}
                                       </tbody>
                                       </table>
                                       
                                       </div>
                                       
                                       <div class="tab-pane" id="tab_events">
                                       <!-- EVENTS -->
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">onClick</label>
                                       <div class="col-md-12">
                                       <textarea id="mapsvg-event-onclick" class="mapsvg-event-field form-control" data-event="onClick" rows="8" name="onClick" data-live="change" data-delay="1000" data-validate="function">{{toString onClick}}</textarea>
                                       </div>
                                       </div>
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">mouseOver</label>
                                       <div class="col-md-12">
                                       <textarea id="mapsvg-event-mouseover" class="mapsvg-event-field form-control" data-event="mouseOver" rows="8" name="mouseOver" data-live="change" data-delay="1000" data-validate="function">{{toString mouseOver}}</textarea>
                                       </div>
                                       </div>
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">mouseOut</label>
                                       <div class="col-md-12">
                                       <textarea id="mapsvg-event-mouseout" class="mapsvg-event-field form-control" data-event="mouseOut" rows="8" name="mouseOut" data-live="change" data-delay="1000" data-validate="function">{{toString mouseOut}}</textarea>
                                       </div>
                                       </div>
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">beforeLoad</label>
                                       <div class="col-md-12">
                                       <textarea id="mapsvg-event-beforeload" class="mapsvg-event-field form-control" data-event="beforeLoad" rows="8" name="beforeLoad" data-live="change" data-delay="1000" data-validate="function">{{toString beforeLoad}}</textarea>
                                       </div>
                                       </div>
                                       
                                       <div class="form-group row">
                                       <label class="col-md-12" control-label">afterLoad</label>
                                       <div class="col-md-12">
                                       <textarea id="mapsvg-event-afterload" class="form-control mapsvg-event-field" data-event="afterLoad" placeholder="" rows="8" class="input-xxlarge" name="afterLoad" data-live="change" data-delay="1000" data-validate="function">{{toString afterLoad}}</textarea>
                                       </div>
                                       </div>
                                       </div>
                                       
                                       
                                       <div class="tab-pane " id="tab_color_group">
                                       
                                               <table id="basic-datatable" class="table  table-hover table-nowrap mb-0 vertical-middle">
                                                      <thead class="thead-light">
                                                         <tr>
                                                            <th>Category</th>
                                                            <th>Colour Code</th>
                                                            <th>Colour</th>
                                                            <!-- <th>Action</th> -->
                                                         </tr>
                                                      </thead>
                                                      <tbody>
                                                        
                                                            <?php if($colorGroup){
                                          foreach($colorGroup as $c) {?>
                                                                    <tr>
                                                            <td>
                                                               <div class="grp_clrs">
                                                                
                                       
                                                                   <select class="custom-select  stadium_category_by_color " name="<?php echo $c->block_color ;?>"  >
                                                           <option value="">Select Category</option>
                                                           <?php
                                          if ($getSeatCategory): foreach ($getSeatCategory as $getSeatCat) {
                                                  ;
                                                  ?>
                                                                   <option value="<?= $getSeatCat->stadium_seat_id ?>" <?php  echo $getSeatCat->stadium_seat_id ==  $c->category ? "selected"   : "" ?> > <?= $getSeatCat->seat_category ?></option>
                                                               <?php } endif; ?>
                                                           </select>
                                                               </div>
                                                            </td>
                                                            <td>
                                                               <div class="grp_clrs">
                                                                     <input class="form-control" type="text" autocomplete="off" name="stadium_color[<?php echo $c->block_color ;?>]" value="<?php echo  $c->block_color ;?>" readonly />
                                                               </div>
                                                            </td>
                                                            <td>
                                                               <div class="clr_select">
                                                                  <div class="block_color"  style="background: <?php echo  $c->block_color ;?>"></div>
                                                                 </div>
                                                            </td>
                                                            <!-- <td>
                                                               <div class="add_delete_icon tick_details">
                                                              <a href="javascript:void(0)" class="btn btn-success save_"><i class="fas fa-check"></i>Save</a>
                                                              <a href=""><i class="fas fa-trash-alt"></i></a>
                                                                  <a href=""><i class="fas fa-plus-circle"></i></a> 
                                                                  
                                                               </div>
                                                            </td> -->
                                                         </tr>
                                                        
                                                           <?php } } ?>
                                                  </table>
                                          </div>
                                       </div>
                                       </form>
                                    </script>
                                    <script type="text/x-handlebars-template" id="mapsvg-handlebars-region-list">
                                       {{#each regions}}
                                       {{> regionPartial}}
                                       {{/each}}
                                    </script>
                                    <script type="text/x-handlebars-template" id="mapsvg-handlebars-region">
                                       <div class="mapsvg-region-fields">
                                       <div class="form-group row">
                                       <div class="btn-group" data-toggle="buttons">
                                       <!-- <label class="btn btn-default btn-sm {{#if disabled}}active{{/if}}" >
                                       <input type="checkbox" class="region_disable  mapsvg-region-disabled" name="regions[{{id}}][disabled]" {{#if disabled}}checked{{/if}} data-live="change"/><i class="fa fa-ban"></i> Disable
                                       </label> -->
                                       <!--<label class="btn btn-default btn-sm {{#if selected}}active{{/if}}">-->
                                       <!--<input type="checkbox" value="1" class="region_select  mapsvg-region-selected" name="regions[{{id}}][selected]"  {{#if selected}}checked{{/if}}/><i class="fa fa-mouse-pointer"></i> Selected-->
                                       <!--</label>-->
                                       </div>
                                       </div>
                                       
                                       <div class="form-group row">
                                       <form>
                                       <label class="control-label">Color</label>
                                       <div class="cpicker input-group">
                                       <span class="input-group-addon"><i id="picker_{{id}}"></i></span>
                                       <input class=" input-small form-control mapsvg-region-color" type="text" autocomplete="off"  class="input-small" name="regions[{{id}}][fill]" value="{{fill}}"/>
                                       </div>
                                       </form>
                                       </div>
                                       
                                       <div class="form-group row">
                                       <form>
                                       <label class="control-label">Category</label>
                                       <select class="form-control mapsvg-region-link" type="text" autocomplete="off"  name="regions[{{id}}][href]" value="{{href}}" data-live="change">
                                       <option value="">Select Category</option>
                                       <?php
                                          if ($getSeatCategory): foreach ($getSeatCategory as $getSeatCat) {
                                                  ;
                                                  ?>
                                               <option value="<?= $getSeatCat->stadium_seat_id ?>"><?= $getSeatCat->seat_category ?></option>
                                           <?php } endif; ?>
                                       </select>
                                       </form>
                                       
                                       <!-- <div class="form-group row">
                                       <label class="control-label">No Tickets</label>
                                       <input class="form-control mapsvg-region-tooltip" Placeholder="Enter No Tickets" type="number" autocomplete="off" name="regions[{{id}}][tooltip]" value="{{tooltip}}" data-live="keyup" data-validate="number"/>
                                       </div> -->
                                       <form>
                                       <div class="form-group row">
                                       <div class="mapsvg-region-gauge-container">
                                       <label class="control-label">Gauge Value</label>
                                       <input class="form-control mapsvg-region-gauge" type="text" autocomplete="off" name="regions[{{id}}][gaugeValue]" value="{{gaugeValue}}" data-live="keyup" data-validate="number"/>
                                       </div>
                                       </div>
                                       </form>
                                       
                                       <!--                    <div class="form-group row">
                                       <label class="control-label">Data</label>
                                       <textarea class="form-control mapsvg-region-data" name="regions[{{id}}][data]" data-live="keyup">{{toString data}}</textarea>
                                       </div>
                                       </div>-->
                                    </script>
                                    <script type="text/x-handlebars-template" id="mapsvg-handlebars-marker">
                                       <tr id="mapsvg-marker-{{id}}" class="mapsvg-marker-row" data-marker-id="{{id}}">
                                       <td>
                                       <div class="mapsvg-region-id">{{id}}</div>
                                       <button type="button" class="btn btn-xs btn-default mapsvg-marker-delete">Delete</button>
                                       </td>
                                       <td>
                                       <div class="form-group row">
                                       <label class="control-label">ID</label>
                                       <div class="input-group">
                                       <input type="text" autocomplete="off" class="form-control mapsvg-marker-id" value="{{id}}">
                                       <span class="input-group-btn mapsvg-marker-id-save-container" data-toggle="tooltip" data-placement="left" title="You can hit Enter&#9166; to set ID" >
                                       <button type="button" class="btn btn-default mapsvg-marker-id-save"  type="button" >Set</button>
                                       </span>
                                       </div>
                                       </div>
                                       
                                       {{#if geoCoords}}
                                       <div class="form-group row">
                                       <label class="control-label">Lat/Lon coordinates</label>
                                       <input type="text" autocomplete="off" class="form-control mapsvg-marker-geocoords" name="markers[{{id}}][geoCoords]" value="{{#if geoCoords}}{{geoCoords.[0]}}, {{geoCoords.[1]}}{{/if}}"  placeholder="lat,lon" data-live="keyup"/>
                                       </div>
                                       {{/if}}
                                       
                                       <div class="form-group row">
                                       <label class="control-label">Image</label>
                                       <select name="markers[{{id}}][src]" class="form-control mapsvg-marker-src" data-live="change">
                                       {{#each markerImages}}
                                       <option value="{{url}}" {{#ifeq ../src url}}selected{{/ifeq}}>{{file}}</option>
                                       {{/each}}
                                       </select>
                                       </div>
                                       
                                       <div class="form-group row">
                                       <label class="control-label">Tooltip</label>
                                       <textarea class="form-control mapsvg-marker-tooltip" name="markers[{{id}}][tooltip]" placeholder="Text/HTML" data-live="keyup">{{tooltip}}</textarea>
                                       </div>
                                       
                                       <div class="form-group row">
                                       <label class="control-label">Popover</label>
                                       <textarea class="form-control mapsvg-marker-popover" name="markers[{{id}}][popover]" placeholder="Text/HTML" data-live="keyup">{{popover}}</textarea>
                                       </div>
                                       
                                       {{#if isSafari}}<form>{{/if}}
                                       <div class="form-group row">
                                       <label class="control-label">Link</label>
                                       <div class="input-group">
                                       <input class="form-control mapsvg-marker-link" type="text" autocomplete="off" placeholder="http://" name="markers[{{id}}][href]" value="{{href}}" data-live="keyup"/>
                                       <span class="input-group-addon">
                                       <div class="checkbox"  style="padding-top: 4px;min-height: 0;">
                                       <label>
                                       <input type="checkbox" class="mapsvg-marker-target"  name="markers[{{id}}][target]" value="blank" {{#ifeq target "blank"}}checked{{/ifeq}}  data-live="change"/> New tab
                                       </label>
                                       </div>
                                       </span>
                                       </div>
                                       </div>
                                       {{#if isSafari}}</form>{{/if}}
                                       
                                       <div class="form-group row">
                                       <label class="control-label">Data</label>
                                       <textarea class="form-control mapsvg-marker-data" name="markers[{{id}}][data]" data-live="keyup">{{toString data}}</textarea>
                                       </div>
                                       </td>
                                       </tr>
                                    </script>
                                    <script type="text/x-handlebars-template" id="mapsvg-maps-list-template">
                                       <option>...</option>
                                       {{#each maps}}
                                       <option value="{{url}}">{{file}}</option>
                                       {{/each}}
                                    </script>
                                    <!--END HANDLEBARS-->
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
   </div>
</div>
<?php $this->load->view(THEME.'common/footer'); ?>
<?php $v=1.3;?>
<script src="<?php echo base_url() ?>assets/js/svg/settings.js?v=<?php echo $v;?>"></script>
<script src="<?php echo base_url() ?>assets/js/svg/jquery.mousewheel.min.js?v=<?php echo $v;?>"></script>
<?php if (isset($getStadium->s_id)) : ?>
<script src="<?php echo base_url() ?>assets/js/svg/edit_mapsvg.js?v=<?php echo $v;?>"></script>
<script src="<?php echo base_url() ?>assets/js/svg/edit_admin.js?v=<?php echo $v;?>"></script>
<script type="text/javascript">console.log("edit_admin");</script>
<?php else : ?>
<script src="<?php echo base_url() ?>assets/js/svg/mapsvg.js?v=<?php echo $v;?>"></script>
<script src="<?php echo base_url() ?>assets/js/svg/add_admin.js?v=<?php echo $v;?>"></script>
<?php endif; ?>
<script type="text/javascript">console.log("stadium");</script>
<script src="<?php echo base_url() ?>assets/js/svg/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/svg/jquery.message.js"></script>
<script src="<?php echo base_url() ?>assets/js/svg/ion.rangeSlider.min.js?ver=2.1.2"></script> <script type="text/javascript">console.log("stadium center");</script>
<script src="<?php echo base_url() ?>assets/js/svg/handlebars.js?ver=4.0.2"></script>
<script src="<?php echo base_url() ?>assets/js/svg/jquery.nanoscroller.min.js?ver=0.8.7"></script>
<script src="<?php echo base_url() ?>assets/js/svg/codemirror.js?ver=1.0"></script>
<script src="<?php echo base_url() ?>assets/js/svg/codemirror.javascript.js?ver=1.0"></script>
<script src="<?php echo base_url() ?>assets/js/svg/htmlmixed.js?ver=1.0"></script>
<script type='text/javascript' src='<?php echo base_url() ?>assets/js/svg/xml.js?ver=1.0'></script>
<script src="<?php echo base_url() ?>assets/js/svg/css.js?ver=1.1"></script>
<script src="<?php echo base_url() ?>assets/js/svg/formatting.js?ver=1.0"></script>
<script src="<?php echo base_url() ?>assets/js/svg/typeahead.bundle.min.js?ver=1.0"></script>
<script src="<?php echo base_url() ?>assets/js/svg/select2.min.js?ver=4.0"></script>
<script type="text/javascript">console.log("stadium end");</script>
<script type="text/javascript">
   $( document ).ready(function() {
   console.log( "document ready!" );
    $tableRegion = $('#table-regions');
     var madmin = jQuery().mapsvgadmin('init', {});
   });
   jQuery(document).ready(function() {
       /*$tableRegion = $('#table-regions');
       var madmin = jQuery().mapsvgadmin('init', {});*/
       <?php if (isset($getStadium->s_id)) : ?>
           var stadiumId = '<?= $getStadium->s_id ?>';
           $.ajax({
               type: 'POST',
               url: '<?= base_url('game/getStadiumByid') ?>',
               data: {
                   'stadiumid': stadiumId
               },
               success: function(response) {
                   var jsonObject = $.parseJSON(response);
                   var status = jsonObject['Status'];
                   var getJsonArray = jsonObject['Json'];
                   var object = getJsonArray[0];
                   var mapcode = $.parseJSON(object['map_code']);
                   if (mapcode != '') {
                       if (mapcode.colors) {
                           $('input[name="colors[base]"]').val(mapcode.colors.base);
                           $(".mapsvg-region").each(function() {
                               $(this).css({
                                   fill: mapcode.colors.base
                               });
                           });
                       }
   
                       $.each(mapcode.regions, function(key, value) {
                           $(".mapsvg-region").each(function() {
                               $('#' + key).css({
                                   fill: value.fill
                               });
                           });
                       });
                   }
                   existing_json_data = mapcode;
               }
           });
       <?php endif; ?>
   });
</script>
<script type="text/javascript">
   var obj = {} ;
   
   //     function hexToRgb(hex) {
   //   var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
   //   return result ? "rgba (" + 
   //    parseInt(result[1], 16) + "," +parseInt(result[2], 16) + "," + parseInt(result[3], 16,1) + "," + " 1"  +  ")" : null;
   // }
   
   
   
   function hexToRgbA2(hex) {
   var c;
   if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
       c = hex.substring(1).split('');
       if (c.length == 3) {
           c = [c[0], c[0], c[1], c[1], c[2], c[2]];
       }
       c = '0x' + c.join('');
       return 'rgba(' + [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(',') + ',1)';
   }
   throw new Error('Bad Hex');
   }
   
   $("body").on("click",".edit_ticket_btn ",function(){
       var selected_val  =$("#default_category").val();
       if(selected_val){
          var checked_val = $(".region_block_id:checked").length ;
           if(checked_val > 0){
   
               var block_ids = new Array();
   
               $('.region_block_id:checked').each(function() {
                  block_ids.push($(this).val());
               });
               console.log(block_ids);
   
               var category = selected_val;
               var staduim_id  = $("#hiddenStadiumId").val();
               var block_id  = block_ids;
               var color_name =  "";
   
                   
               $.ajax({
                   type: "POST",
                   url: base_url + '/game/update_multiple_category' ,
                   data: { "staduim_id"  : staduim_id, "color_name": color_name, "category" : category, "block_id" : block_ids  },
                   success: function(msg){
                       $('.region_block_id:checked').each(function() {
                  var rid = $(this).val();
              
                       $('select[name="regions[' + rid + '][href]"]').val(category)
                   });
   
                       //window.location.reload();
                   }
               });
           }
           else{
   
               alert("Choose Block");
           }
   
       }
       else{
   
           alert("Choose Category");
       }
   
   });
   
   $("body").on("click","#new_block_click",function(){
   
   
   if (confirm("Are you sure?.")) {
       $('.GenralData').each(function(key,value) {
               obj[$(this).attr("name")] = hexToRgbA2($(this).val()) ;
           });
   
       
       $.ajax({
           type: "POST",
           url: base_url + '/game/reset_satdium' ,
         
           data: { "staduim_id"  : $("#hiddenStadiumId").val() , "colors": JSON.stringify(obj)  },
           success: function(msg){
               window.location.reload();
           }
       });
        console.log("obj");
   
   } else 
   {
       return false;
   }
   
   
   
   
   
   });
   
   $("body").on("change",".stadium_category_by_color",function(){
   
   var category = $(this).val();
   var staduim_id  = $("#hiddenStadiumId").val();
   var color_name =  $(this).attr('name');
   
   
   if (confirm("Are you sure?.")) {
       $('.GenralData').each(function(key,value) {
               obj[$(this).attr("name")] = hexToRgbA2($(this).val()) ;
           });
   
       
       $.ajax({
           type: "POST",
           url: base_url + '/game/update_category_by_color' ,
           data: { "staduim_id"  : $("#hiddenStadiumId").val() , "color_name": color_name, "category" : category  },
           success: function(msg){
               //window.location.reload();
           }
       });
       // console.log("obj");
   
   } else 
   {
       return false;
   }
   
   });
   
   function get_state_city(country_id,city_id="") { 
        if(country_id != ''){ 
          $('#city').html('');
          $.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + 'event/matches/get_city',
            data: {'country_id' : country_id},
            success: function(res_data) {
      
                var state_city = JSON.parse(JSON.stringify(res_data));
               
      
              $('#stadium_city').html(state_city.city);
              $('#state').val(state_city.state);
              if(city_id != "'"){
                   $('#stadium_city').val(city_id);
                }
            }
          })
      
        }
      }
</script>
<?php exit;?>