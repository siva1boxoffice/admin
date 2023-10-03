<style>
    .check_box,.seat_category_check_box {
    max-height: 250px;
    overflow-y: auto;
}

</style>

<style type="text/css">
    
    #overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 9999;
    }


</style>
<?php $this->load->view(THEME . 'common/header'); ?>

<div id="overlay">
  <div id="loader">
    <!-- Add your loading spinner HTML or image here -->
    <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
  </div>
</div>
  <!-- Begin main content -->
    <div class="main-content">
      <!-- content -->
      <div class="page-content">
        <!-- page header -->
         <form id="merge-content" method="post" enctype='multipart/form-data' class="login-wrapper" action="<?php echo base_url();?>game/merge_stadium_category_v1">
        <div class="page-title-box tick_details">
          <div class="container-fluid">
            <div class="row">
               <div class="col-sm-8">
                  <h5 class="card-title">Merge Ticket Categories From API</h5>
               </div>
               <div class="col-sm-4">
                  <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                      <a href="<?php echo base_url();?>"  class="btn btn-primary mb-2 mt-3">Back</a>
                                             <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Merge</button>
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
                     
                              <div class="team_info_details mt-3">
                                <h5 class="card-title">Category Info</h5>
                              </div>
                              
                              <div class="row column_modified ">
                              	<div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="example-select">Select API</label>
                                        <select class="custom-select" id="api" name="api" required>
                                                   <option value="">Select API</option>
                                                   <?php foreach($apis as $api){ ?>
                                                   <option value="<?php echo $api->api_value;?>"><?php echo $api->api_name;?></option>
                                               		<?php } ?>
                                                 </select>
                                    </div> 
                                 </div> 
                                 <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="example-select">Select Stadium Name</label>
                                        <select class="custom-select roleuser" required name="stadium" id="stadium">
                                            <option value="">-Choose Stadium-</option>
                                            <?php foreach($stadiums as $stadium){ ?>
                                            <option  value="<?php echo $stadium->s_id;?>"><?php echo $stadium->stadium_name;?> - <?php echo $stadium->s_id;?> </option>
                                            <?php } ?>
                                            </select>
                                    </div> 
                                 </div> 
                                 <div class="col-lg-4">
                                    <div class="tick_details_view show_map_option">
                                      <a href="javascript:void(0)" class="btn btn-success mb-0 ml-2 edit_ticket_btn mt-4">View Map</a>
                                    </div>
                                 </div> 
                                 
                              </div> 

                              <div class="row column_modified">
                                 <div class="col-lg-12">
                                    <div class="category_found">
                                       <p><span id="category_found">0</span> Ticket Categories Found</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <hr>

                              <div class="team_info_details mt-4 mb-3">
                                <h5 class="card-title">Merge With 1BoxOffice Ticket Category</h5>
                              </div>
                              <div class="row column_modified">
                                 <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="example-select">Api Ticket Category</label>
                                       <div class="category_tier">
                                          <ul id="category_blocks">
                                          </ul>
                                       </div>
                                    </div>
                                 </div> 
                                 <div class="col-lg-4" id="stadium_category">
                                    
                                 </div>
                              </div>
                              <hr>
                              <!-- end row -->
                              <div class="tick_details">
                                 <div class="row">
                                    <div class="col-sm-8">
                                       <!-- <h5 class="card-title">Matches</h5> -->
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                            <a href="<?php echo base_url();?>"  class="btn btn-primary mb-2 mt-3">Back</a>
                                             <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Merge</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="edit_modal_popup_new">
                                  <div class="modal fade" id="bs-example-modal-lg" tabindex="-1"    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                     <div class="modal-dialog modal-lg">
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <h4 class="modal-title stadium_name" id="myLargeModalLabel"></h4>
                                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                         </div>
                                         <div class="modal-body show">
                                            <div class="row">
                                              <div class="col-md-12">
                                                 <div class="map_view img-show">
                                                    <img id="map_img" src="">
                                                 </div>
                                                 <div class="category_blockk">
                                                      <ul>

                                                      </ul>
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
            </div>
          </div>
        </div>
    </form>
      </div>
<?php $this->load->view(THEME . 'common/footer'); ?>
<script type="text/javascript">
    
$(document).ready(function(){


    $('#merge-content').validate({

  submitHandler: function(form) {
    
    var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
  

    var formData = new FormData(myform);


    $('#search').addClass("is-loading no-click");

    $('.has-loader').addClass('has-loader-active');

     var dataString = $('#'+$(form).attr('id')).serialize();
    
    var action = $(form).attr('action');
    $.ajax({
      type: "POST",
     // enctype: 'multipart/form-data',
      url: action,
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      dataType: "json",
       beforeSend: function() {
        // setting a timeout
        $("#overlay").show();
    	},
      success: function(data) {
      	$("#overlay").hide();

            if(data.status == 1) {

         swal('Success !', data.msg, 'success');
        }else if(data.status == 0) {
           swal('Failed !', data.msg, 'error');
          
        }

      }
    })
    return false;
  }
});


 $(".edit_ticket_btn").click(function(){
 			  var map_src = $("#map_img").attr("src");
 			  if(map_src != ""){
 			  	$('#bs-example-modal-lg').modal();
				$("#content_1").mCustomScrollbar({
				scrollButtons:{
				enable:true
				}
				});
 			  }
              

      });

         var choicesJsonh = {};
                    var textRemove = {};
$(".show_map_option  a").click(function(){
    var action = "<?php echo base_url();?>game/get_stadium_details";
    var stadium = $("#stadium").val();
    $.ajax({
      type: "POST",
      url: action,
      data: {'stadium' : stadium},
      dataType: "json",
      success: function(data) {
        if(data.status == 1){
          //  console.log(data.stadium.stadium_image);
            $(".img-show img").attr("src", data.stadium.stadium_image);
            var category_block = "<ul>";

            $(data.category).each(function( index ,value) {
             // console.log( value.seat_category);

              category_block += '<li><span style="background:'+value.block_color+'"></span>'+value.seat_category+'</li>';
            });
            category_block += "</ul>";

           // '<ul><li><span style="background:rgba(127,127,127,1)"></span>Away</li><li>'
             $(".stadium_name").html(data.stadium.stadium_name);
            $(".category_blockk").html(category_block);
            // $("#stadium_category").html(data.stadium_category);
            // $("#stadium_category_input").html(data.stadium_category_input);
            
            
        }
      }
    })
});

function removeItemOnce(arr, value) {
  var index = arr.indexOf(value);
  if (index > -1) {
    arr.splice(index, 1);
  }
  return arr;
}

$("body").on("click",".input_tags  li a",function(){
        var id  = $(this).parent("li").data('id'); 
        var text_Catgory  = $(this).parent("li").find("span").text(); 
        var category_id  = $(this).parents("ul").data('id');
       // alert(text_Catgory);
      

        var ids = $("#category_input_" + category_id).val();
        var ids_text = $("#category_input_text_" + category_id).val();
        
      


        if(ids){
             var selectItems = ids.split(',');
             var selectText = ids_text.split(',');
             console.log(selectText);
             console.log(selectItems);
             console.log(id);
               // selectItems.splice( $.inArray(id, selectItems), 1 );

               var new_id = removeItemOnce(selectItems, id.toString());


                //alert(selectItems);
                 $("#category_input_" + category_id).val(new_id);
                 console.log(new_id);

                  selectText.splice( $.inArray(text_Catgory, selectText), 1 );
                //alert(selectItems);
                 $("#category_input_" + category_id).val(selectItems);
                 $("#category_input_text_" + category_id).val(selectText);


                $("#"+ id ).prop("disabled", false).prop('checked', false);
                $(this).parent("li").remove();
        }


});

$("input[name='category_block']").click(function(){
    var section_type            = $(this).val();
    get_stadium(section_type);
});

$("#stadium").change(function(){
     var section_type            = "category";
     get_stadium(section_type);

});

    function get_stadium(section_type){
    var stadium                 = $('#stadium').val();
    var api                     = $('#api').val();
    if(stadium == ""){
        alert("Please Choose the stadium.");
        return false; 
    }

    var action = "<?php echo base_url();?>game/get_category_or_block_v1";
    $.ajax({
      type: "POST",
      url: action,
      data: {'api' : api,'stadium' : stadium,'section_type' : section_type},
      cache: false,
      dataType: "json",

      success: function(data) {

        if(data.status == 1){

            $("#category_blocks").html(data.section);
            $("#stadium_category").html(data.stadium_category);
            $("#category_found").html(data.category_count);

            // var  a = 1;
   
            //   $(".category_input").each(function(e,val) {
            //       //  $(this).find("input").select2();
            //     var ids = $(this).attr("id");
            //     var data_id = $(this).attr("data-id");

            //       textRemove[data_id] = new Choices(
            //       document.getElementById(ids),
            //       {
            //         allowHTML: true,
            //         delimiter: ',',
            //         editItems: true,
            //         maxItemCount: 5,
            //         removeItemButton: true,
            //         choices: choicesJsonh[data_id],
            //       });  


            //       $("#"+ ids).on('change', function(){ 

            //         $('.search-choice-close').on('click', function () { 
            //             alert('hiiii'); 
            //         }); 
            //     }); 


            

              //    a++;

              // });


            
            
        }
      }
    })
}






$('body').on('click', '.1box_category', function() {
   
   var chosenCategory = $('.choose_stadium_section:checked').not(":disabled").length;

   if(chosenCategory > 0){

   var selectedCatId  = $(this).attr("data-flag-id");
   var existvaltext   = $('#category_input_text_'+selectedCatId).val();
   var existval       = $('#category_input_'+selectedCatId).val();

   
   if(existvaltext != ""){
    var selectItemsTxt = existvaltext.split(',');
   // var selectItemsTags  = existvaltext.split(',');
   }
   else{
     var selectItemsTxt = [];
   //  var selectItemsTags = [];
   }
   
   if(existval != ""){
    var selectItems = existval.split(',');
   }
   else{
     var selectItems = [];
   }



   

    var selectItemsTags  ="";

       
      $(selectItemsTxt).each(function( index ,value) {
             console.log( value);

              selectItemsTags += '<li class="" data-id="'+selectItems[index]+'"  ><span>'+value +'</span> <a href="javascript:void(0)" class=""  title="Close">x</a>';
            });
  
  
   $('.choose_stadium_section:checked').not(":disabled").each(function() {

     //var myObject = [{ value: $(this).attr('data-label'), label : $(this).attr('data-label'), selected: true }];
       // choicesJsonh[selectedCatId] = myObject;
       
        // console.log(choicesJsonh[selectedCatId]);

        //textRemove[selectedCatId].setValue(choicesJsonh[selectedCatId]);
       
 
         selectItems.push($(this).val());
        selectItemsTxt.push($(this).attr('data-label'));

       selectItemsTags +=  '<li class="" data-id="'+$(this).val()+'"  ><span>'+$(this).attr('data-label')+'</span>  <a href="javascript:void(0)" class=""  title="Close">x</a>';

         $(this ).attr('disabled', 'disabled');
});
    console.log(selectItemsTags);
     $('#category_tags_text_'+selectedCatId).html(selectItemsTags);

   $('#category_input_text_'+selectedCatId).val(selectItemsTxt);

  $('#category_input_text_'+selectedCatId).val(selectItemsTxt);

  $('#category_input_'+selectedCatId).val(selectItems);
   console.log("chosenCategory = "+chosenCategory);

   }
   else{
    alert("Please Choose Category or Block..");
    return false;
   }
  

});


});

</script>

<script>

$(function () {
    "use strict";
    
    $(".show_map_option a").click(function () {
        var $src = $(this).attr("src");
        $(".show").fadeIn();
        $(".img-show img").attr("src", $src);
    });
    
    $("span, .overlay").click(function () {
        $(".show").fadeOut();
    });
    
});


</script>
<?php exit;?>
