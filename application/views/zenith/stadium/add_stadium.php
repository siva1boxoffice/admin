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

                <div class="col-lg-6">
                   
                     
                                    <div class="event_img"  >
                                             <div id="mobile-zoom-svg-1"> 
                                             <div id="map-stadium">
                                               <?php  $map = $_GET['map'] ;

                           if($map){
                              ?>
                               <img src="<?php  echo ($map) ;?>" id="map_svg">

                            <?php 
                           }
                    ?>
                                             </div>
                                          </div>
                                    </div>

             
               </div>

                  <div class="col-lg-6">
                     
                     <form method="post" class="validate_form_v1" action="<?php echo base_url('stadium/save_stadium');?>" id='stadium_edit' >
                        
                                 

                                    <script id="entry-template" type="text/x-handlebars-template">
                                           {{#each regions as | region |}}
                                            <input type="hidden" name="block_ids[]" value="{{main_category}}">
                                          
                                       {{/each}}
                                     
                                          </script>

                                  <div class="row column_modified">
                                    <div id="blocks_data">
                                       
                                    </div>
                                    

                                    <input type="hidden" name="stadium_image" value="<?php echo end(explode("/", $_GET['map']));?>">
                                    <div class="col-lg-12">
                                    <div class="form-group">
                                       <label class="col-md-12 control-label">Event Category</label>
                               
                                          <select class="custom-select" id="category" name="category" required data-live="change">
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
   </div>
</div>
<?php $this->load->view(THEME.'common/footer'); ?>
<?php $v=1.3;?>
<script src="<?php echo base_url() ?>assets/js/handlebars-v4.7.7.js?v=<?php echo $v;?>"></script>

<script>
   
   $(document).ready(()=>{
      $('#photo').change(function(){
        const file = this.files[0];
        console.log(file);
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
           
            console.log(event.target.result);
            $('#imgPreview').attr('src', event.target.result);
             $(".holder").show();
          }
          reader.readAsDataURL(file);
        }
      });
    });


    const cache = {};

(function wrapJquery($) {
    $.fn.inlineSvg = function fnInlineSvg() {
        this.each(imgToSvg);

        return this;
    };

    function imgToSvg() {
        const $img = $(this);
        const src = $img.attr('src');

        // fill cache by src with promise
        if (!cache[src]) {
            const d = $.Deferred();
            $.get(src, (data) => {
                d.resolve($(data).find('svg'));
            });
            cache[src] = d.promise();
        }

        // replace img with svg when cached promise resolves
        cache[src].then((svg) => {
            const $svg = $(svg).clone();

            if ($img.attr('id')) $svg.attr('id', $img.attr('id'));
            if ($img.attr('class')) $svg.attr('class', $img.attr('class'));
            if ($img.attr('style')) $svg.attr('style', $img.attr('style'));

            if ($img.attr('width')) {
                $svg.attr('width', $img.attr('width'));
                if (!$img.attr('height')) $svg.removeAttr('height');
            }
            if ($img.attr('height')) {
                $svg.attr('height', $img.attr('height'));
                if (!$img.attr('width')) $svg.removeAttr('width');
            }

            $svg.insertAfter($img);
            $img.trigger('svgInlined', $svg[0]);
            $img.remove();
        });
    }
}(jQuery));
    
$('#map_svg').inlineSvg();


  setTimeout(function () {
   var erro = 0;
      // BLOCK LIST ON TABLE ( EDIT MAP TAB)
   var blocks_list = {};
     $('#map-stadium [data-section]').each(function(e,val){

      $(this).find(".block").css("fill","#CCC");

      if($(this).find(".block").hasClass("block")){
          var seatMatch = $(this).attr("data-section");
          if(seatMatch){
     
           
            var data_section = $(this).parents("g").attr("data-category");
            var new_json =  { "main_category" : seatMatch }
            blocks_list[seatMatch] =  new_json;
            //  console.log(seatMatch);
          }
       }
       else{
         console.log("error");
         erro =1;
       }
    
    });

    if(erro == 1){
      alert("Invalid SVG Format");
      $("form").css("pointer-events","none");
      $("form").css("cursor","default");
    }
   var output =  { "regions"  : blocks_list } 
   var template  = Handlebars.compile($("#entry-template").html());
   var filled =  template(output);
   $("#blocks_data").html(filled);

},400);



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