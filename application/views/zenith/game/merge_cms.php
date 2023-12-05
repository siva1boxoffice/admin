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

.choices__inner {
    padding: 3px 5px;
     height: auto !important; 
    border-radius: 0px;
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
        <form id="merge-content" method="post" enctype='multipart/form-data' class="login-wrapper" action="<?php echo base_url();?>tixstockcms/mergecontent/true">
        <div class="page-title-box tick_details">
          <div class="container-fluid">
            <div class="row">
               <div class="col-sm-8">
                  <h5 class="card-title">Merge Event Categories From API</h5>
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
                                <h5 class="card-title">Merge Data</h5>
                              </div>
                              <div class="row column_modified">
                                          <div class="col-lg-4">
                                             <div class="form-group">
                                                 <label for="example-select">Select API</label>
                                                 <select class="custom-select" id="api" name="api" required>
                                                   <option value="">Select API</option>
                                                   <?php foreach($apis as $api){ ?>
                                                   <option  value="<?php echo $api->api_value;?>"><?php echo $api->api_name;?></option>
                                                    <?php } ?>
                                                 </select>
                                             </div> 
                                          </div>
                                          <div class="col-lg-4">
                                             <div class="form-group">
                                                 <label for="example-select">Select Category</label>
                                                 <select class="custom-select" id="category" name="category" required>
                                                   <option value="">Select Category</option>
                                                      <?php foreach ($gcategory as $category) { ?>
                                                            <option value="<?php echo $category->id; ?>"><?php echo $category->category_name; ?></option>
                                                            <?php
                                                               } ?>   
                                                 </select>
                                             </div> 
                                          </div>
                                       </div>
                                       <div class="row column_modified ">
                                          <div class="col-lg-4">
                                             <div class="form-group">
                                                 <label for="example-select"> Select Tournament Name</label>
                                                 <select class="custom-select" id="api_tournament" name="api_tournament" onchange="get_default_selection(this.value,'tournament');">
                                                   <option value="">Select Tournament</option>
                                                </select>
                                             </div> 
                                          </div> 
                                          <!-- <div class="col-lg-4">
                                             <div class="form-group">
                                                 <label for="example-select">Select Team Name</label>
                                                  <select class="custom-select" id="api_team" name="api_team" onchange="get_default_selection(this.value,'team');">
                                                   <option value="">Select Team</option>
                                                </select>
                                             </div> 
                                          </div> -->
                                           <div class="col-lg-4">
                                             <div class="form-group">
                                                 <label for="example-select">Select Team Name</label>
                                                 <select multiple class="custom-select" id="api_team" 
                                                 name="api_team[]"  onchange="get_default_selection(this.value,'team');">
                                                  <option value="">Select Team</option>
                                                </select>
                                             </div> 
                                          </div> 
                                          <div class="col-lg-4">
                                             <div class="form-group">
                                                 <label for="example-select">Select Stadium Name</label>
                                                 <select class="custom-select" id="api_stadium" name="api_stadium" onchange="get_default_selection(this.value,'stadium');">
                                                   <option value="">Select stadium</option>
                                                </select>
                                             </div> 
                                          </div> 
                                       </div> 
                              <div class="clearfix"></div>
                              <hr>

                              <div class="team_info_details mt-3">
                                <h5 class="card-title">Merge With 1BoxOffice Data</h5>
                              </div>
                              <div class="row column_modified">
                                          <div class="col-lg-4">
                                             <div class="form-group">
                                                 <label for="example-select">Select Tournament Name</label>
                                                 <select class="custom-select" id="tournament" name="tournament" onchange="get_default_selection(this.value,'tournament',1);">
                                                   <option value="">Select Tournament</option>
                                                   <?php foreach($tournaments as $tournament){?>
                                                    <option value="<?php echo $tournament->tournament_id;?>"><?php echo $tournament->tournament_name;?></option>
                                                   <?php } ?>
                                                </select>
                                             </div> 
                                          </div> 
                                          <div class="col-lg-4">
                                             <div class="form-group">
                                                 <label for="example-select">Select Team Name</label>
                                                <select class="custom-select" id="team" name="team"  onchange="get_default_selection(this.value,'team',1);">
                                                   <option value="">Select Team</option>
                                                    <?php foreach($teams as $team){?>
                                                    <option value="<?php echo $team->team_id;?>"><?php echo $team->team_name;?></option>
                                                   <?php } ?>
                                                </select>
                                             </div> 
                                          </div>
                                          <div class="col-lg-4">
                                             <div class="form-group">
                                                 <label for="example-select">Select Stadium Name</label>
                                                 <select multiple class="custom-select" id="stadium" name="stadium[]"  onchange="get_default_selection(this.value,'stadium',1);">
                                                   <option value="">Select Stadium</option>
                                                   <?php foreach($stadiums as $stadium){?>
                                                    <option value="<?php echo $stadium->s_id;?>"><?php echo $stadium->stadium_name;?></option>
                                                   <?php } ?>
                                                </select>
                                             </div> 
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
                          
                        </div>
                     </div> 
                  </div>
               </div>
            </div>
           
          </div>
      </form>
        </div>
      </div>
      <!-- main content End -->
<?php $this->load->view(THEME . 'common/footer'); ?>
<script type="text/javascript">

const choices     = new Choices('#stadium', { removeItemButton: !0,   searchFields: ['label', 'value'] ,allowSearch: true});
const teamChoices = new Choices('#api_team', { removeItemButton: !0,   searchFields: ['label', 'value'] ,allowSearch: true});
    function get_default_selection(val,content_type,flag=0){
        var api = $("#api").val();
        var action = "<?php echo base_url();?>tixstockcms/get_default_selection";
         $.ajax({
      type: "POST",
     // enctype: 'multipart/form-data',
      url: action,
      data: {"api":api,"val" : val,"content_type" : content_type,"flag" : flag},
      dataType: "json",
       beforeSend: function() {
        // setting a timeout
       // $("#overlay").show();
        },
      success: function(data) {
      //    $("#overlay").hide();

        if(data.data != null){

            if(data.flag == 1){

                if(data.data.content_type == "tournament"){
                    $('#api_tournament').val(data.data.api_content_id);
                }
                else if(data.data.content_type == "team"){
                  //teamChoices.removeActiveItems();
                  //  $('#api_team').val(data.data.api_content_id);
                }
                else if(data.data.content_type == "stadium"){
                    $('#api_stadium').val(data.data.api_content_id);
                }

            }
            else{ 
                
                if(data.data.content_type == "tournament"){
                    $('#tournament').val(data.data.content_id);
                }
                else if(data.data.content_type == "team"){
                    $('#team').val(data.data.content_id);

                }
                else if(data.content_type == "stadium"){ 
                 
                 choices.removeActiveItems();
                  if ($('#stadium').length) choices.setChoiceByValue(data.stadium_data);
                  
                  //  $('#stadium').val(data.data.content_id);
                }
               

            }
            
            

        }
        else{
          if(data.flag == 0){
          if(data.content_type == "stadium"){
            $('#stadium').val("");
          }
          if(data.content_type == "tournament"){
            $('#tournament').val("");
          }
          if(data.content_type == "team"){
            $('#team').val("");
          }
          } 
           else{/*
                   if(data.content_type == "stadium"){ 
            $('#api_stadium').val("");
          }
          if(data.content_type == "tournament"){
            $('#api_tournament').val("");
          }
          if(data.content_type == "team"){
            $('#api_team').val("");
          }
          */}
          
        }


           

      }
    })

    }
    $(document).ready(function() {
    
    $('#merge-content').validate({

  submitHandler: function(form) {
    
    var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
  

    var formData = new FormData(myform);


    $('#search').addClass("is-loading no-click");

    $('.has-loader').addClass('has-loader-active');

     var dataString = $('#'+$(form).attr('id')).serialize();
     console.log(dataString);
    
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
              console.log("DONE");
              teamChoices.removeActiveItems();
              choices.removeActiveItems();
              $('#team').val($('#team').prop('defaultSelected'));
              $('#api_stadium').val($('#api_stadium').prop('defaultSelected'));
              $('#stadium').val($('#stadium').prop('defaultSelected'));
              $('#tournament').val($('#tournament').prop('defaultSelected'));
              $('#api_tournament').val($('#api_tournament').prop('defaultSelected'));
         swal('Success !', data.msg, 'success');
        }else if(data.status == 0) {
           swal('Failed !', data.msg, 'error');
          
        }

      }
    })
    return false;
  }
});


  $('body').on('change',"#api, #category", function(e) { 
      var category = $('#category').val();
      var api      = $('#api').val();
      e.stopPropagation();
      //var api = $(this).val();
            if(api != ""){
                    $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '<?= base_url('game/getapidata') ?>',
                    data: {
                        'api': api,
                        'category' : category
                    },
                    success: function(response) {
                        
                        $("#api_tournament").html("<option value=''>Select Tournament</option>");
                        $("#api_team").html("<option value=''>Select Team</option>");
                        $("#api_stadium").html("<option value=''>Select Stadium</option>");

                        $("#tournament").html("<option value=''>Select Tournament</option>");
                        $("#team").html("<option value=''>Select Team</option>");
                      //  $("#stadium").html("<option value=''>Select Stadium</option>");

                        $.each(response.tournaments,function(key, value)
                { 
                    var merged = "Not Sync";
                    var merge_status = value.merge_status;
                    if(merge_status == 1){
                        merged = "Sync";
                    }
                    $("#api_tournament").append('<option value=' + value.tournament_id + '>' + value.tournament_name +' - '+merged +'</option>');
                });
                         var api_stadium_json = [];
                        $.each(response.teams,function(key, value)
                {
                  
                    
                    var merged = "Not Sync";
                    var merge_status = value.merge_status;
                    if(merge_status == 1){
                        merged = "Sync";
                    }
                    var obj = { value: value.team_id, label: value.team_name+' - '+merged};
                    api_stadium_json.push(obj);
                    console.log(obj);
                  //  $("#api_team").append('<option value=' + value.team_id + '>' + value.team_name+' - '+merged + '</option>');
                  teamChoices.clearChoices();
                  teamChoices.setChoices(api_stadium_json)
                });

                        $.each(response.stadiums,function(key, value)
                {
                    var merged = "Not Sync";
                    var merge_status = value.merge_status;
                    if(merge_status == 1){
                        merged = "Sync";
                    }
                    $("#api_stadium").append('<option value=' + value.stadium_id + '>' + value.stadium_name+' - '+merged + '</option>');
                });


                         $.each(response.bx_tournaments,function(key, value)
                { 
                    
                    $("#tournament").append('<option value=' + value.tournament_id + '>' + value.tournament_name+'</option>');
                });

                         $.each(response.bx_teams,function(key, value)
                { 
                    
                    $("#team").append('<option value=' + value.team_id + '>' + value.team_name+'</option>');
                });

                        
                         var bx_stadium_json = [];
                          $.each(response.bx_stadiums,function(key, value)
                { 
                  var obj = { value: value.s_id, label: value.stadium_name+' - '+value.s_id};
                    bx_stadium_json.push(obj);
                  //  $("#stadium").append('<option value=' + value.s_id + '>' + value.stadium_name+' - '+value.s_id+'</option>');
                });
                           choices.clearChoices();
                           choices.setChoices(bx_stadium_json)
                         //  if ($('#stadium').length) new Choices('#stadium', { removeItemButton: !0,   searchFields: ['label', 'value'] ,allowSearch: true});


                    }
                });
                }
      }); 

});

</script>