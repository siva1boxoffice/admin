        <?php $this->load->view('common/header'); ?>
        
        <script type="text/javascript">var full_block_data  = [];
    var stadium_with_cat_name = [] ;</script>
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
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->



                            <iframe src="about:blank" class="stretch" id="stretchIframe" scrolling="no" style="width: 100%;height:100%;z-index: -1;"></iframe>

                            <div class="mapsvg-dashboard" id="mapsvg-admin">

                                <div id="mapsvg-nav-header">
                                    <h2>
                                        1BoxOffice <span id="map-page-title"></span>
                                    </h2>

                                    <div class="pull-right">
                                        <button id="mapsvg-save" class="btn btn-sm btn-primary" data-loading-text="Saving..." >Save</button>
                                    </div>
                                </div>

                                <div id="mapsvg-edit-choose">
                                    <form action="<?= base_url('game/stadium/check_stadium'); ?>" enctype="multipart/form-data" method="POST">

                                        <div id="mapsvg-php-functions" class="row">

                                            <div class="row">

                                                <div class="form-group col-sm-6">
                                                    </br>
                                                    <label class="control-label col-xs-6">Upload SVG file</label>
                                                    <div class="col-sm-6 form-material text-right">
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
                                    </div>
                                    <div class="stretch mapsvg-panel-right">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <li class="active"><a href="#tab_settings">Settings</a></li>
                                            <li><a href="#tab_colors">Colors</a></li>
                                            <li><a href="#tab_regions">Regions</a></li>
                                        </ul>
                                        <div id="mapsvg-mapform-container" class="stretch mapsvg-scrollable-content nano">
                                            <div id="mapsvg-search-placeholder">
                                                <div id="mapsvg-regions-search">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>
                                                        <input  onClick="this.select();" type="text" class="form-control" placeholder="Search regions by ID/Title" aria-describedby="basic-addon1" autocomplete="off"/>
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
                                                <form id="stadiumForm" action="<?= base_url('game/stadium/save_stadium') ?>" method="post">
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
                                                    <input type="hidden" value="" id="categoryName" name="categoryname">
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
                                    
                                    <div class="tab-content" id="mapsvg-tabs">
                                    <!-- TAB 1 -->
                                    <div class="tab-pane active" id="tab_settings">
                                    <!-- MAIN SETTINGS -->
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">File</label>
                                    <div class="col-sm-9">
                                    <input type="hidden" name="mapfile" value="{{svgFilename}}"/>
                                    <input class="form-control" type="text" autocomplete="off" disabled="true" value="{{svgFilename}}"/>
                                    </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Title</label>
                                    <div class="col-sm-9">
                                    <input class="form-control" type="text" autocomplete="off" name="title" value="{{title}}" data-live="keyup" />
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Width</label>
                                    <div class="col-sm-9">
                                    <input class="form-control" id="mapsvg-controls-width" type="text" autocomplete="off" name="width" value="{{width}}" autocomplete="off" />
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Height</label>
                                    <div class="col-sm-9">
                                    <input  class="form-control" id="mapsvg-controls-height" type="text" autocomplete="off" name="height" value="{{height}}"  autocomplete="off" />
                                    </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                    <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                    <input name="lockAspectRatio" data-live="change" type="checkbox" id="mapsvg-controls-ratio" autocomplete="off" {{#if lockAspectRatio}}checked{{/if}} /> <i class="fa fa-lock"></i> Lock aspect ratio
                                    </label>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Start position</label>
                                    <div class="col-sm-9">
                                    <div class="input-group">
                                    <input data-live="change" name="initialViewBox" class="form-control" type="text" autocomplete="off" disabled="" id="mapsvg-controls-viewbox" value="{{#each viewBox}}{{this}} {{/each}}"/>
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" id="mapsvg-controls-set-viewbox">Set current</button>
                                    <button class="btn btn-default" id="mapsvg-controls-reset-viewbox">Reset</button>
                                    </span>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    
                                    
                                    <div id="mapsvg-controls-zoom-options" {{#unless zoom.on}}style="display:none"{{/unless}}>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Zoom by mousewheel</label>
                                    <div class="col-sm-9">
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
                                    
                                    
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Zoom Buttons</label>
                                    <div class="col-sm-9">
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
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Zoom Step</label>
                                    <div class="col-sm-9">
                                    <input class="form-control" id="mapsvg-controls-zoom-step" type="text" autocomplete="off" name="zoomDelta]" id="zoom-delta" value="{{zoomDelta}}"/>
                                    <p class="help-block">From 1  to 5. Small step (1.05, 1.1, 1.2 ...) gives more smooth zooming.<br />
                                    </div>
                                    </div>
                                    -->
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Zoom Limits</label>
                                    <div class="col-sm-9">
                                    <input id="mapsvg-controls-zoomlimit" type="text" autocomplete="off" autocomplete="off" name="zoom[limit]" value="{{zoom.limit.[0]}};{{zoom.limit.[1]}}" data-live="change"/>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="form-group" id="mapsvg-global-popovers">
                                    <label class="col-sm-3 control-label">Global popovers</label>
                                    <div class="col-sm-9">
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
                                    
                                    
                                    
                                    
                                    <div class="form-group" id="mapsvg-global-tooltips">
                                    <label class="col-sm-3 control-label">Global tooltips</label>
                                    <div class="col-sm-9">
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
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Menu (Regions) container</label>
                                    <div class="col-sm-9">
                                    <div class="input-group">
                                    <span class="input-group-addon">#</span>
                                    <input type="text" onkeyup="jQuery(this).closest('.form-group').find('#menu-container-id-live').text(this.value)" onpaste="jQuery(this).parent().find('#menu-container-id-live').text(this.value)" class="form-control" autocomplete="off" name="menu[containerId]" value="{{menu.containerId}}" data-live="keyup" />
                                    </div>
                                    <p class="help-block">Add &lt;ul id="<span id="menu-container-id-live">{{menu.containerId}}</span>"&gt;&lt;/ul&gt; anywhere on a page with your map to show clickable list of regions</p>
                                    
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Menu (Regions) item template</label>
                                    <div class="col-sm-9">
                                    <textarea rows="5" name="menu[template]" data-live="change" id="mapsvg-menu-template" class="mapsvg-function-textarea form-control" data-validate="function">{{#if_function menu.template}}{{{toString menu.template}}}{{/if_function}}</textarea>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    
                                    
                                    <div id="mapsvg-menu-markers-group"{{#unless menuMarkers.on}}style="display:none"{{/unless}}>
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Menu (Markers) container</label>
                                    <div class="col-sm-9">
                                    <div class="input-group">
                                    <span class="input-group-addon">#</span>
                                    <input type="text" onkeyup="jQuery(this).closest('.form-group').find('#menu-container-2-id-live').text(this.value)" onpaste="jQuery(this).parent().find('#menu-container-2-id-live').text(this.value)" class="form-control" autocomplete="off" name="menuMarkers[containerId]" value="{{menuMarkers.containerId}}" data-live="keyup" />
                                    </div>
                                    <p class="help-block">Add &lt;ul id="<span id="menu-container-2-id-live">{{menuMarkers.containerId}}</span>"&gt;&lt;/ul&gt; anywhere on a page with your map to show clickable list of regions</p>
                                    
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Menu (Markers) item template</label>
                                    <div class="col-sm-9">
                                    <textarea rows="5" name="menuMarkers[template]" data-live="change" id="mapsvg-menu-markers-template" class="mapsvg-function-textarea form-control" data-validate="function">{{#if_function menuMarkers.template}}{{{toString menuMarkers.template}}}{{/if_function}}</textarea>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Preloader text</label>
                                    <div class="col-sm-9">
                                    <input type="text" autocomplete="off" class="form-control" id="mapsvg-controls-preloader-text" name="loadingText" value="{{loadingText}}" data-live="keyup"/>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    <!-- TAB 2 -->
                                    <!-- COLORS -->
                                    
                                    <div class="tab-pane" id="tab_colors">
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Background</label>
                                    <div class="col-sm-9">
                                    <div class="input-group cpicker" data-color-name="background">
                                    <span class="input-group-addon"><i></i></span>
                                    <input type="text" autocomplete="off" class=" form-control" name="colors[background]" value="{{colors.background}}"  data-live="change"/>
                                    </div>
                                    <!--<p class="help-block">Enter "transparent" for transparent background.</p>-->
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Base</label>
                                    <div class="col-sm-9">
                                    <div class="input-group cpicker" data-color-name="base">
                                    <span class="input-group-addon"><i></i></span>
                                    <input type="text" autocomplete="off" class=" form-control" name="colors[base]" value="{{colors.base}}"  data-live="change"/>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Disabled</label>
                                    <div class="col-sm-9">
                                    <div class="input-group cpicker" data-color-name="disabled">
                                    <span class="input-group-addon"><i></i></span>
                                    <input class=" form-control" type="text" autocomplete="off" name="colors[disabled]" value="{{colors.disabled}}"  data-live="change"/>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">Strokes</label>
                                    <div class="col-sm-9">
                                    
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
                                    <div class="tab-pane" id="tab_regions">
                                    
                                    <div id="mapsvg-search-regions-no-matches" class="well well-sm" style="display: none;">No matches</div>
                                    <table class="table table-striped {{#if gauge.on}}mapsvg-gauge-on{{/if}}" id="table-regions">
                                    <tbody>
                                    {{#each regions}}
                                    <tr id="mapsvg-region-{{id_no_spaces}}" data-region-id="{{id}}" class="mapsvg-region-row">
                                    <td>
                                    <div class="mapsvg-region-names">
                                    <div class="mapsvg-region-id">{{block_title}}</div>
                                    <div class="mapsvg-region-title">{{title}}</div>
                                    </div>
                                    </td>
                                    </tr>
                                    {{/each}}
                                    </tbody>
                                    </table>
                                    </div>
                                    
                                    <div class="tab-pane" id="tab_events">
                                    <!-- EVENTS -->
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">onClick</label>
                                    <div class="col-sm-9">
                                    <textarea id="mapsvg-event-onclick" class="mapsvg-event-field form-control" data-event="onClick" rows="8" name="onClick" data-live="change" data-delay="1000" data-validate="function">{{toString onClick}}</textarea>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">mouseOver</label>
                                    <div class="col-sm-9">
                                    <textarea id="mapsvg-event-mouseover" class="mapsvg-event-field form-control" data-event="mouseOver" rows="8" name="mouseOver" data-live="change" data-delay="1000" data-validate="function">{{toString mouseOver}}</textarea>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">mouseOut</label>
                                    <div class="col-sm-9">
                                    <textarea id="mapsvg-event-mouseout" class="mapsvg-event-field form-control" data-event="mouseOut" rows="8" name="mouseOut" data-live="change" data-delay="1000" data-validate="function">{{toString mouseOut}}</textarea>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">beforeLoad</label>
                                    <div class="col-sm-9">
                                    <textarea id="mapsvg-event-beforeload" class="mapsvg-event-field form-control" data-event="beforeLoad" rows="8" name="beforeLoad" data-live="change" data-delay="1000" data-validate="function">{{toString beforeLoad}}</textarea>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">afterLoad</label>
                                    <div class="col-sm-9">
                                    <textarea id="mapsvg-event-afterload" class="form-control mapsvg-event-field" data-event="afterLoad" placeholder="" rows="8" class="input-xxlarge" name="afterLoad" data-live="change" data-delay="1000" data-validate="function">{{toString afterLoad}}</textarea>
                                    </div>
                                    </div>
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
                                    <div class="form-group">
                                    <div class="btn-group" data-toggle="buttons">
                                    <!-- <label class="btn btn-default btn-sm {{#if disabled}}active{{/if}}" >
                                    <input type="checkbox" class="region_disable  mapsvg-region-disabled" name="regions[{{id}}][disabled]" {{#if disabled}}checked{{/if}} data-live="change"/><i class="fa fa-ban"></i> Disable
                                    </label> -->
                                    <!--<label class="btn btn-default btn-sm {{#if selected}}active{{/if}}">-->
                                    <!--<input type="checkbox" value="1" class="region_select  mapsvg-region-selected" name="regions[{{id}}][selected]"  {{#if selected}}checked{{/if}}/><i class="fa fa-mouse-pointer"></i> Selected-->
                                    <!--</label>-->
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <form>
                                    <label class="control-label">Color</label>
                                    <div class="cpicker input-group">
                                    <span class="input-group-addon"><i></i></span>
                                    <input class=" input-small form-control mapsvg-region-color" type="text" autocomplete="off"  class="input-small" name="regions[{{id}}][fill]" value="{{fill}}"/>
                                    </div>
                                    </form>
                                    </div>
                                    
                                    <div class="form-group">
                                    <form>
                                    <label class="control-label">Category</label>
                                    <select class="form-control mapsvg-region-link" type="text" autocomplete="off"  name="regions[{{id}}][href]" value="{{href}}" data-live="change">
                                    <option value="">Select Category</option>
                                    <?php if ($getSeatCategory): foreach ($getSeatCategory as $getSeatCat) {
                                        ; ?>
                                            <option value="<?= $getSeatCat->stadium_seat_id ?>"><?= $getSeatCat->seat_category ?></option>
                                    <?php } endif; ?>
                                    </select>
                                    </form>
                                    
                                    <!-- <div class="form-group">
                                    <label class="control-label">No Tickets</label>
                                    <input class="form-control mapsvg-region-tooltip" Placeholder="Enter No Tickets" type="number" autocomplete="off" name="regions[{{id}}][tooltip]" value="{{tooltip}}" data-live="keyup" data-validate="number"/>
                                    </div> -->
                                    <form>
                                    <div class="form-group">
                                    <div class="mapsvg-region-gauge-container">
                                    <label class="control-label">Gauge Value</label>
                                    <input class="form-control mapsvg-region-gauge" type="text" autocomplete="off" name="regions[{{id}}][gaugeValue]" value="{{gaugeValue}}" data-live="keyup" data-validate="number"/>
                                    </div>
                                    </div>
                                    </form>
                                    
                                    <!--                    <div class="form-group">
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
                                    <div class="form-group">
                                    <label class="control-label">ID</label>
                                    <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control mapsvg-marker-id" value="{{id}}">
                                    <span class="input-group-btn mapsvg-marker-id-save-container" data-toggle="tooltip" data-placement="left" title="You can hit Enter&#9166; to set ID" >
                                    <button type="button" class="btn btn-default mapsvg-marker-id-save"  type="button" >Set</button>
                                    </span>
                                    </div>
                                    </div>
                                    
                                    {{#if geoCoords}}
                                    <div class="form-group">
                                    <label class="control-label">Lat/Lon coordinates</label>
                                    <input type="text" autocomplete="off" class="form-control mapsvg-marker-geocoords" name="markers[{{id}}][geoCoords]" value="{{#if geoCoords}}{{geoCoords.[0]}}, {{geoCoords.[1]}}{{/if}}"  placeholder="lat,lon" data-live="keyup"/>
                                    </div>
                                    {{/if}}
                                    
                                    <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <select name="markers[{{id}}][src]" class="form-control mapsvg-marker-src" data-live="change">
                                    {{#each markerImages}}
                                    <option value="{{url}}" {{#ifeq ../src url}}selected{{/ifeq}}>{{file}}</option>
                                    {{/each}}
                                    </select>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="control-label">Tooltip</label>
                                    <textarea class="form-control mapsvg-marker-tooltip" name="markers[{{id}}][tooltip]" placeholder="Text/HTML" data-live="keyup">{{tooltip}}</textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="control-label">Popover</label>
                                    <textarea class="form-control mapsvg-marker-popover" name="markers[{{id}}][popover]" placeholder="Text/HTML" data-live="keyup">{{popover}}</textarea>
                                    </div>
                                    
                                    {{#if isSafari}}<form>{{/if}}
                                    <div class="form-group">
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
                                    
                                    <div class="form-group">
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
        <?php $this->load->view('common/footer'); ?>
        <?php exit;?>