<?php  $this->load->view(THEME.'common/header'); ?>

<?php $tab = @$_GET['tab'] ?  $_GET['tab'] :"home-tab"; ?>
<div id="overlay" style="display: none;">
   <div id="loader">
      <!-- Add your loading spinner HTML or image here -->
      <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
   </div>
</div>
<style type="text/css">
   .event_img {
   margin: 30px 0;
   }
   .event_img img {
   width: 100%;
   height: auto;
   }
   .std_info  .custom-file-label {
   background-color: #E8EAEF;
   border-radius: 0px;
   color: #4C5271;
   height: 40px;
   text-align: left;
   font-weight: 700;
   border: 1px solid #E8EAEF;
   }
   .std_info  .custom-file-input:lang(en) ~ .custom-file-label::after{display: none;}
   .edit_map .form-control {
   color: #1A1919;
   height: 40px;
   border-radius: 0px;
   }
   .clr_select .form-control {
   width: 25px;
   height: 25px;
   border: none;
   margin: 5px auto;
   padding: 0px;
   }
   input[type="color"] {
   -webkit-appearance: none;
   border: none;
   width: 25px;
   height: 25px;
   }
   input[type="color"]::-webkit-color-swatch-wrapper {
   padding: 0;
   }
   input[type="color"]::-webkit-color-swatch {
   border: none;
   }
   .preview_details {
   margin: 0 auto;
   text-align: center;
   }
   .preview_details .btn-primary {
   padding: 10px 20px;
   border-radius: 0px;
   margin-right: 0px;
   margin-bottom: 0px;
   }
   .preview_details .btn-success {
   padding: 5px 20px;
   border-radius: 0px;
   margin-right: 0px;
   margin-bottom: 0px;
   }
   .grp_clrs .form-control {
   color: #1A1919;
   height: 40px;
   }
   .vertical-middle td {
   font-size: 14px;
   vertical-align: middle;
   }
   .add_delete_icon .fa-plus-circle {
   color: #43D39E;
   font-size: 20px;
   }
   .add_delete_icon .fa-trash-alt {
   color: #FF5C75;
   font-size: 20px;
   margin: 0px 10px;
   }
   .map_details_view .btn-success {
   padding: 8px 0px;
   border-radius: 0px;
   width: 100%;
   }
   .preview_details .btn-light {
   padding: 10px 20px;
   border-radius: 0px;
   margin-right: 0px;
   margin-bottom: 0px;
   }
   svg{
      cursor: pointer;
   }

   .st3{
      font-family: "Nunito Sans", sans-serif !important;
   }
   .zoom-control{position: absolute; right: 0}
  // .block{ fill:#FFF ;     stroke: #f8f8f8;  }

   .block {
      fill:#FFF ;
    stroke: #CCC ;
    opacity: 0.3;
}

   .custom-select{ height:35px }
   .form-control-map-2{ height:35px }
   .input-group-append{
          position: absolute;
    right: 3px;
    top: 5px;
   }


</style>
<div class="main-content">
<!-- content -->
<div class="page-content">
   <input type="hidden" id="hiddenStadiumId" value="<?php echo $getStadium->s_id;?>">
   <!--  <prE> <?php 
      print_r($getStadium) ; 
      
      $stadium_img = explode("/", $getStadium->stadium_image);
      echo end($stadium_img);
      ?> </prE> -->
   <?php 
      $stadium_img = explode("/", $getStadium->stadium_image);
      $stadium_img  = end($stadium_img);
      ?>
   <!-- page header -->
   <div class="page-title-box tick_details">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-8">
               <h5 class="card-title"><?php echo $getStadium->stadium_name ;?></h5>
            </div>
             <div class="col-sm-4">
               <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                  <!-- <a href="#" data-toggle="modal" data-target="#add-board-modal" class="btn btn-primary mb-2">Back</a> -->
                  <a href="#" id="reset" class="btn btn-danger mb-2 ml-2">Reset</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- page content -->
   <div class="page-content-wrapper mt--45 box-details">
      <div class="container-fluid">
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-lg-12">
                     <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                           <a href="#home-tab"  data-id="home-tab"  data-toggle="tab" aria-expanded="false" class="nav-link <?php echo $tab=="home" ? "active" : ""  ;?>" >
                           Settings
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#map-tab" data-id="map-tab"  data-toggle="tab" aria-expanded="true" class="nav-link <?php echo $tab=="map-tab" ? "active" : ""  ;?>">
                           Edit Map
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#color-tab" data-id="color-tab"  data-toggle="tab" aria-expanded="false" class="nav-link <?php echo $tab=="color-tab" ? "active" : ""  ;?>">
                           Group Colors
                           </a>
                        </li>
                     </ul>

                      <div class="row">
                           <div class="col-6">
                              <div class="zoom-control">
                              <div id="zoom-out" class="map-zoom-out zoom-decrement1 btn "><i class="fa fa-minus"></i></div>
                                <div id="zoom-in" class="map-zoom-in zoom-increment1 btn "><i class="fa fa-plus"></i></div>
                                <div id="zoom-reset" class="map-zoom-out zoom-reset1 btn "><i class=" fas fa-sync"></i></div>
                           </div>


                              <div class="event_img"  >
                                       <div id="mobile-zoom-svg-1"> 
                                       <div id="map-stadium">

                                          <img src="<?php echo UPLOAD_PATH.$getStadium->stadium_image ;?>" id="map_svg">
                                       
                                       </div>
                                    </div>
                              </div>
                           </div>
                           <div class="col-6">

                               <div class="tab-content">
                        <div class="tab-pane   <?php echo $tab =="home-tab" ? "show active" : ""  ;?>" id="home-tab">
                           <div class="row">
                         
                              <div class="col-12">
                                 <div class="card">
                                    <div class="team_info_details mt-0">
                                       <h5 class="">Stadium Info</h5>
                                       <p>Fill the Stadium Information</p>
                                    </div>
                                    <form method="post" action="<?php echo base_url('stadium/save_stadium');?>" class="validate_form_edit" id="save_stadium" >

                                        <input type="hidden"  name="satdiumId" id="s_id" value="<?php echo $getStadium->s_id;?>">


                                       <div class="row column_modified">
                                          <div class="col-lg-12">
                                             <div class="std_info">
                                                <div class="form-group">
                                                   <label for="simpleinput">File</label>
                                                   <div class="input-group">
                                                      <div class="custom-file">
                                                         <input type="file" class="custom-file-input" id="photo" name="photo" accept="image/svg+xml"  >
                                                         <label class="custom-file-label" for="inputGroupFile04" ><?php echo $stadium_img;?></label>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="simpleinput">Stadium Category</label>
                                                <select class="custom-select" id="category" name="category" required >
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
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="stadium_name">Stadium Name (English)</label>
                                                <input type="text" name="stadium_name" id="stadium_name" class="form-control valid" placeholder="Stadium Name (English)" value="<?php echo $getStadium->stadium_name;?>" required="" aria-invalid="false">
                                             </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="stadium_name_ar">Stadium Name (Arabic)</label>
                                                <input type="text" name="stadium_name_ar" id="stadium_name_ar" class="form-control valid" placeholder="Stadium Name (Arabic)" value="<?php echo $getStadium->stadium_name_ar;?>" required="" aria-invalid="false">
                                             </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="search_keywords">Search Keywords</label>
                                                <input type="text" name="search_keywords" id="search_keywords" class="form-control valid" placeholder="Enter keyword here" value="<?php  echo $getStadium->search_keywords;?>" required="" aria-invalid="false">
                                             </div>
                                             <p>Use comma separated key. For ex. Lord Stadium, London.</p>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label for="simpleinput">Stadium Variant</label>
                                                <input type="text" name="stadium_variant" id="stadium_variant" class="form-control valid" placeholder="Enter stadium variant here" value="<?php  echo $getStadium->stadium_variant;?>"  aria-invalid="false">
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="row">
                                                <label class="col-md-12 control-label" for="stadium_country">Stadium Country</label>
                                                <div class="col-md-12">
                                                   <select class="custom-select" id="stadium_country" name="stadium_country" required  onchange="get_state_city(this.value);">
                                                      <option value="">Select Stadium Country</option>
                                                      <?php foreach ($countries as $country) { ?>
                                                      <option value="<?php echo $country->id; ?>" <?php if (isset($getStadium->country)) {
                                                         if ($getStadium->country == $country->id) {
                                                            echo ' selected  ';
                                                         }
                                                         } ?>><?php echo $country->name; ?></option>
                                                      <?php } ?>                                                        
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="row">
                                                <label class="col-md-12 control-label" for="stadium_city">Stadium City</label>
                                                <div class="col-md-12">
                                                   <select class="custom-select" id="stadium_city" name="stadium_city" required data-live="change">
                                                      <option value="">Select Stadium City</option>
                                                      <?php foreach ($cities as $city) { ?>
                                                      <option value="<?php echo $city->id; ?>" <?php if (isset($getStadium->city)) {
                                                         if ($getStadium->city == $city->id) {
                                                            echo ' selected  ';
                                                         }
                                                         } ?>><?php echo $city->name; ?></option>
                                                      <?php } ?>                                                          
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class=" mt-3"></div>

                                        <div class="tick_details border-top">
                              <div class="row">
                               
                                 <div class="col-sm-12">
                                    <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                       <a href="" class="btn btn-primary mb-2 mt-3">Back</a>
                                       <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Save</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane   <?php echo $tab =="map-tab" ? "show active" : ""  ;?>" id="map-tab">
                           <div class="row">
                              <div class="col-12">
                                 <div class="card">
                                    <div class="row">
                                       <div class="col-lg-5">
                                          <div class="edit_map">
                                             <div class="form-group">
                                                <input type="text" id="mapsvg-regions-search" class="form-control" placeholder="Search regions by ID/Title">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="edit_map">
                                             <div class="form-group">
                                                <select class="custom-select  " id="default_category">
                                                         <option value="">Select Category</option>
                                                         <?php
                                                            if ($stadium_category): foreach ($stadium_category as $getSeatCat) {
                                                                    ;
                                                                    ?>
                                                         <option data-color="<?php echo $getSeatCat->color_code ;?>" data-name="<?php echo $getSeatCat->seat_category ;?>" value="<?= $getSeatCat->stadium_seat_id ?>"><?= $getSeatCat->seat_category ?></option>
                                                         <?php } endif; ?>
                                                      </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-3 ">
                                          <div class="map_details_view">
                                             <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success edit_ticket_btn mt-0">Save Category</a>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="section_left_scroll" id="content_1">
                                       <div class="">

                                         <script id="entry-template" type="text/x-handlebars-template">
                                           {{#each regions as | region |}}
                                               <tr id="mapsvg-region-{{main_category}}" data-region-id="{{id}}" data-region-explode="{{main_explode}}"  data-region-name="{{main_category}}" >
                                              <td class="dt-checkboxes-cell" tabindex="0">
                                                  <div class="custom-checkbox form-check"><input class="dt-checkboxes form-check-input checkboxinput region_block_id" type="checkbox" value="{{main_category}}" /><label class="form-check-label"></label></div>
                                              </td>
                                              <td>{{main_block_category}}</td>
                                              <td><select class="custom-select custom-select-2 mapsvg-region-link " type="text" autocomplete="off"  name="regions[{{main_category}}][href]" >
                                              <option value="">Select Category</option>
                                                         <?php
                                                            if ($stadium_category): foreach ($stadium_category as $getSeatCat) {
                                                                    ;
                                                                    ?>
                                                         <option data-color="<?php echo $getSeatCat->color_code ;?>" data-name="<?php echo $getSeatCat->seat_category ;?>" value="<?= $getSeatCat->stadium_seat_id ?>"><?= $getSeatCat->seat_category ?></option>
                                                         <?php } endif; ?>
                                                      </select></td>
                                              <td>
                                                  <div class="clr_select"><input  name="regions[{{main_category}}][fill]" type="color" class="myjscolor mapsvg-region-color"  value="" id="aa-{{id}}" data-color-id="{{id}}"></div>
                                              </td>
                                          </tr>
                                          
                                       {{/each}}
                                       <tr id="mapsvg-search-regions-no-matches"  style="display"><td colspan="4" align="center" style="display:none">No Block Found</td></tr>
                                          </script>

                          
                                          <div class="compiled_template"></div>

                                          <table id="blocks_data" class="table  table-hover table-nowrap mb-0 vertical-middle">
                                             <thead class="thead-light">
                                                <tr >
                                                   <th tabindex="0" class="dt-checkboxes-cell" style="">
                                                      <div class="form-check custom-checkbox"><input type="checkbox" class="form-check-input dt-checkboxes" id="checkAll"><label class="form-check-label">&nbsp;</label></div>
                                                   </th>
                                                   <th>Block</th>
                                                   <th>Category</th>
                                                   <th>Colour </th>
                                                </tr>
                                             </thead>
                                            <tbody>
                                               
                                            </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane  <?php echo $tab =="color-tab" ? "show active" : ""  ;?>" id="color-tab">
                           <div class="row">
                                       <div class="col-lg-9">
                                          <div class="edit_map">
                                             <div class="form-group">
                                               <select class="custom-select all_category  " name="<?php echo $c->block_color ;?>"  >
                                                   <option value="">Select Category</option>
                                                    <?php
                                                      if ($getSeatCategory): foreach ($getSeatCategory as $getSeatCat) {
                                                              ;
                                                              ?>
                                                          <option value="<?= $getSeatCat->stadium_seat_id ?>" <?php  echo $getSeatCat->stadium_seat_id ==  $c->category ? "selected"   : "" ?> > <?= $getSeatCat->seat_category ?></option>
                                                      <?php } endif; ?>
                                                           </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-3">
                                          <div class="map_details_view">
                                             <a href="javascript:void(0)" class="btn btn-success save_category mt-0">Add Category</a>
                                          </div>
                                       </div>
                                    </div>
                                               <table id="color_category" class="table  table-hover table-nowrap mb-0 vertical-middle">
                                                      <thead class="thead-light">
                                                         <tr>
                                                            <th>Category</th>
                                                            <th>Colour Code</th>
                                                            <th>Colour</th>
                                                         <th>Action</th> 
                                                         </tr>
                                                      </thead>
                                                   <tbody>
                                                   </tbody>
                                                  </table>
                                          </div>
                                       </div>
                                       </form>
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
<pre>
<?php 
$json =  array();
if($stadium_details){
   foreach($stadium_details  as $sd){
      $json[] = array(
               'block_name'  => $sd->full_block_name,
               'block_color'  => $sd->block_color,
               'category'  => $sd->category,
      );
   }
}

?>
</pre>
<!-- main content End -->
<?php $this->load->view(THEME.'common/footer'); ?>

<?php $v="1.17";?>
<script type="text/javascript">
      var stadium_active = <?php echo  json_encode($json); ?>;
</script>
<script src="<?php echo base_url() ?>assets/js/svg_convert.js?v=<?php echo $v;?>"></script>
<script src="<?php echo base_url() ?>assets/js/handlebars-v4.7.7.js?v=<?php echo $v;?>"></script>
<script src="<?php echo base_url() ?>assets/js/stadium-map.js?v=<?php echo $v;?>"></script>
<script src="<?php echo base_url() ?>assets/js/panzoom.min.js?v=<?php echo $v;?>"></script>
<script src="<?php echo base_url() ?>assets/js/panzoom.js?v=<?php echo $v;?>"></script>
<script src="<?php echo base_url() ?>assets/js/map-zoom.js?v=<?php echo $v;?>"></script>
<script src="<?php echo base_url() ?>assets/js/category-color.js?v=<?php echo $v;?>"></script>
<script type="text/javascript">
  
   

   startup();
   var colorWell;
               
   function startup() {
      var elements = document.getElementsByClassName("myjscolor");
      for (var i = 0; i < elements.length; i++) {
          elements[i].addEventListener('input', updateAll, false);
      }
      function updateAll(event) {
         var color_name = event.target.value ?  hexToRgbA2(event.target.value) : "";
          var rid = $(this).parents("tr").attr('data-region-name');
          $('.preloader_full').css('display', 'none');

          var stadiumId = $('#hiddenStadiumId').val();
          var getUrl = window.location;
          // var base_url = getUrl.origin + '/' + getUrl.pathname.split('/')[1]; // + '/' + getUrl.pathname.split('/')[1]
          if (stadiumId != '') {
              $.ajax({
                  type: 'POST',
                  url: base_url + 'stadium/update_statdium_block',
                  data: {'stadiumid': stadiumId, 'block_id': rid, 'color': color_name , 'href': $('select[name="regions[' + rid + '][href]"]').val()},
                  success: function (response) {

                  }
              });
          }
         $('[data-section="'+rid+'"] .block').css("fill" , color_name);
      }
   }

   
   $('body').on('change', '.mapsvg-region-link', function (e) {
     $('.preloader_full').css('display', 'none');
      // var dataname = $("#default_category").find(':selected').data('name');
     var datacolor = $(this).find(':selected').data('color');
     var rid = $(this).parents("tr").attr('data-region-name');
     var region_name = $(this).parents("tr").attr('data-region-name');
  
     // alert($('select[name="regions[' + rid + '][href]"]').val());
     var stadiumId = $('#hiddenStadiumId').val();
     // var getUrl = window.location;
     if (stadiumId != '') {
       
          var color_id = datacolor;
          var old_category  = $(this).parents("tr").attr('data-category');
            
         
          $('input[name="regions[' + rid + '][fill]"]').val( rgb2hex(datacolor));
          $('[data-color-id="'+rid +'"]').css("background",datacolor);
          $('[data-section="'+region_name+'"] .block').css("fill" , rgb2hex(datacolor ));
          //$('path#'+ rid).addClass("map-"+$(this).val()).removeClass("map-"+old_category);
          $('[data-section="'+region_name+'"]').addClass("cc-"+$(this).val()).removeClass("cc-"+old_category).attr('data-category',$(this).val());;
         //var color_id = $('input[name="regions[' + rid + '][fill]"]').val();
       
         $.ajax({
             type: 'POST',
             url: base_url + 'stadium/update_statdium_block',
             data: {'stadiumid': stadiumId, 'block_id': rid, 'color': datacolor, 'href': $(this).val()},
             success: function (response) {
             }
         });
     }

     return;
   });

      $("body").on("change",".region_block_id",function(){
         var seval = $(this).val();
         //alert("data-section["+ seval+"]");
         if (!$(this).is(':checked')) {
                 $('[data-section="'+ seval+'"]  .block').css({"stroke": "RED", "stroke-width": "1" }); 
         }else{
           $('[data-section="'+ seval+'"]  .block').css({"stroke": "RED", "stroke-width": "3" });
         } 
      });


    $("body").on("click",".edit_ticket_btn ",function(){
       var selected_val  =$("#default_category").val();
       var dataname = $("#default_category").find(':selected').data('name');
       var datacolor = $("#default_category").find(':selected').data('color');
       if(selected_val){
          var checked_val = $(".region_block_id:checked").length ;
           if(checked_val > 0){
   
               var block_ids = new Array();
   
               $('.region_block_id:checked').each(function() {
                  var sel_val = $(this).val();
                  var old_category  = $(this).parents("tr").attr('data-category');

                  
                  $('[data-region-id="'+ sel_val +'"]').attr("data-category",selected_val );

                  //$("#mapsvg-region-" + sel_val).attr("data-category",selected_val ) ; 
                  var region_name = $(this).parents("tr").attr('data-region-name');

                  $(this).parents("tr.cc-"+ old_category ).addClass("cc-"+ selected_val).removeClass("cc-"+ old_category); 

                  //$("#category_name_"+ sel_val).html(dataname);


                  $('input[name="regions[' + sel_val + '][fill]"]').val( rgb2hex(datacolor));
                  //$('#picker_' + sel_val).css("background",datacolor);

                  $('[data-section="'+region_name+'"] .block').css("fill" , rgb2hex(datacolor));
                   $('[data-section="'+ region_name+'"]  .block').css({"stroke": "#000", "stroke-width": "1" });

                   console.log(sel_val);
                  //$('#' + sel_val).css("background",datacolor);
                  //$('#' + sel_val).addClass("map-" + selected_val ).removeClass("map-"+ old_category);;
                  block_ids.push(sel_val);
                  // $("#"+sel_val).css("fill" , datacolor);
                  $('select[name="regions[' + sel_val + '][href]"]').val(selected_val);
                   //$("#"+ sel_val).css("opacity","1");
               });
              // console.log(block_ids);
   
               var category = selected_val;
               var staduim_id  = $("#hiddenStadiumId").val();
               var block_id  = block_ids;
               //var color_name = hexToRgbA2(datacolor);
               var color_name = datacolor;
   
               $.ajax({
                   type: "POST",
                   url: base_url + '/stadium/update_multiple_category' ,
                   data: { "staduim_id"  : staduim_id, "color_name": color_name, "category" : category, "block_id" : block_ids  },
                   success: function(msg){
                       $('.region_block_id:checked').each(function() {
                        var rid = $(this).val();
              
                       $('select[name="regions[' + rid + '][href]"]').val(category);
                       $(".region_block_id.checkboxinput").prop("checked",false);
                       $("#checkAll").prop("checked",false);
                       $("#default_category").val("");
                   });
   
                       //window.location.reload();
                   }
               });
           }
           else{
                swal({
                 title: 'Please Choose Block',
                 type: 'warning',
            
             });
           }
       }
       else{
          swal({
                 title: 'Please Choose Category',
                 type: 'warning',
             });

       }
   
   });


     $(".nav-tabs a[data-toggle=tab]").on("click", function(e) {
        var href =  $(this).data("id");
 
         // Get current URL parts
         const path = window.location.pathname;
         const params = new URLSearchParams(window.location.search);
         const hash = window.location.hash;
         // Update query string values
         params.set('tab', href);
         window.history.replaceState({}, '', `${path}?${params.toString()}${hash}`);

   });


   


   $("#content_1").mCustomScrollbar({
      mouseWheelPixels: 100 ,
      scrollButtons:{
        enable:true
      }

    });
   $("#content_2").mCustomScrollbar({
        mouseWheelPixels: 100 ,
      scrollButtons:{
        enable:true
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

   $("#reset").on("click",function(){
         var block_ids = [];
         $('[data-region-name]').each(function() {
                block_ids.push($(this).attr("data-region-name"));
         });
       //  console.log(block_ids);
          var stadiumId = $('#hiddenStadiumId').val();
          var getUrl = window.location;
          // var base_url = getUrl.origin + '/' + getUrl.pathname.split('/')[1]; // + '/' + getUrl.pathname.split('/')[1]
          if (stadiumId != '') {
              $.ajax({
                  type: 'POST',
                  url: base_url + 'stadium/reset_stadium',
                  data: {'stadiumId': stadiumId, 'block_ids': block_ids  },
                  success: function (response) {
                    window.location.reload();
                  }
              });
          }


   });

    function call_color_text(){

      if($(".stadium_color").length  >0){

            $('.stadium_color').each(function(key,value) {
                 var color_code =  $(this).val();
                // console.log(color_code);
                 $(this).parents("tr").find(".mapsvg-region-color").val(rgb2hex(color_code))       ;                    });

             var elements = document.getElementsByClassName("pandi_color");
            for (var i = 0; i < elements.length; i++) {
                elements[i].addEventListener('input', call_color, false);
               // console.log(elements[i].value);

            }

         }
   }

   $("body").on("click",".delete_category",function(){
      var that = $(this);
      var id  =  $(this).parents("tr").attr('data-id');
      var category_id = $(this).parents("tr").attr('data-category');

                  //alert(category_id);

                     $(".cc-" + category_id ).find("select").val("");
                     $(".cc-" + category_id ).find(".mapsvg-region-color").val("");
                     $(".cc-" + category_id).find("data-category","");
                     $(".cc-" + category_id ).find(".cpicker i").css("background" ,"#FFFFFF");
                     $(".map-" + category_id ).css({ 'fill' : '' });

                        $(".cc-" + category_id).find("select option[value="+category_id+"]").remove();

                     
                    
                     
                     $.ajax({
                    type: "POST",
                    url: base_url + '/stadium/stadium_color_category/delete' ,
                    data: { "stadium_id"  : $("#hiddenStadiumId").val() , "id": id , category_id :  category_id},
                    dataType: 'json',
                    success: function(data){

                   

                        $("#color_category tbody").html(data.html);
                            var option_s ="<option value=''>Select Category</option>";


                            
                           if(data.stadium_category){
                              $.each(data.stadium_category, function(key,val) {
                                  option_s += "<option data-color='"+val.color_code+"' data-name='"+val.seat_category+"' value='"+val.stadium_seat_id+"' >"+val.seat_category+"</option>"
                              });
                              $("#default_category").html(option_s);
                           }
                        call_color_text();

                    }
                });
               

   });

   $("body").on("click",".clone_category",function(){
      var that = $(this);
     var id  =  $(this).parents("tr").attr('data-id');
     
                      $.ajax({
                          type: "POST",
                          url: base_url + '/stadium/stadium_color_category/clone' ,
                          data: { "stadium_id"  : $("#hiddenStadiumId").val() , "id": id },
                          dataType: 'json',
                          success: function(data){
                              $("#color_category tbody").html(data.html);
                                 var option_s ="<option value=''>Select Category</option>";
                                 if(data.stadium_category){
                                    $.each(data.stadium_category, function(key,val) {
                                        option_s += "<option data-color='"+val.color_code+"' data-name='"+val.seat_category+"' value='"+val.stadium_seat_id+"' >"+val.seat_category+"</option>"
                                    });
                                    $("#default_category").html(option_s);
                                 }
                              call_color_text();

                              //window.location.reload();
                          }
                      });
               

   });
</script>