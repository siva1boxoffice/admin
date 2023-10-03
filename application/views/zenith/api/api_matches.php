<?php $this->load->view(THEME.'common/header');?>
<div id="overlay">
   <div id="loader">
      <!-- Add your loading spinner HTML or image here -->
      <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
   </div>
</div>
<style>
   /*.dataTables_length, .dataTables_filter{
   display: block;
   }*/
   .imgTbl {
   max-width: 40px;
   }
   img {
   height: auto;
   max-width: 100%;
   }
   .check_box_status {
   padding: 0 15px;
   margin-top: 15px;
   margin-bottom: 15px;
   }
</style>
<div class="main-content">
   <!-- content -->
   <div class="page-content">
      <!-- page header -->
      <div class="page-title-box">
         <div class="container-fluid">
            <div class="page-title dflex-between-center">
               <h3 class="mb-1">Partner Events Assign</h3>
               <div class="float-sm-right mt-3 mt-sm-0 add_team_s">
                  <!-- <a href="<?php echo base_url();?>game/stadium/add_stadium"  class="btn btn-success mb-2">Add Stadium</a> -->
               </div>
            </div>
         </div>
      </div>
      <!-- page content -->
      <div class="page-content-wrapper mt--45">
         <div class="container-fluid">
            <div class="card">
               <div class="card-body">
                  <div class="team_info_details mt-3">
                     <h5 class="card-title">Partner Events Assign</h5>
                     <p>Choose the following information</p>
                     <div class="row">
                        <div class="col-12">
                           <form id="search-form" method="post" enctype='multipart/form-data' class="login-wrapper" action="<?php echo base_url();?>api/ajax_api_matches">
                              <div class="row column_modified">
                                 <div class="col-lg-4">
                                    <div class="form-group">
                                       <label for="tournament">Choose Tournaments <span class="text-danger">*</span></label>
                                       <select class="custom-select"  name="tournament" id="tournament">
                                          <option value="">Select Tournament</option>
                                          <?php foreach($tournaments as $tournament){ ?>
                                          <option  value="<?php echo $tournament->t_id;?>"><?php echo $tournament->tournament_name;?></option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-lg-4">
                                    <div class="form-group">
                                       <label for="partner_id">Choose Partner  <span class="text-danger">*</span></label>
                                       <select class=" custom-select" required id="partner_id" name="partner_id" id="">
                                          <option value="">-Choose Partner-</option>
                                          <?php foreach($partners as $partner){ ?>
                                          <option  value="<?php echo $partner->admin_id;?>"><?php echo $partner->admin_name;?></option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 tick_details ">
                                    <div class="form-group">
                                       <label for="example-select">&nbsp;</label><br>
                                       <button id="search" type="submit" class="btn btn-success">Search</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-body">
                  <form id="match-form" method="post" enctype='multipart/form-data' class="" action="<?php echo base_url();?>api/api_matches_post">
                     <input type="hidden" id="match_tournament_id" name="tournament_id" value="">
                     <input type="hidden" id="match_partner_id" name="partner_id" value="">
                     <div id="match_list">
                        <h5>0 Events Found <button type="submit" id="match-form-btn" class="button h-button is-primary is-raised" style="display: none;">Update Events</button> </h5>
                        <table class="table">
                           <thead>
                              <tr >
                                 <th style="width:150px"><a href="javascript:void(0)" class="select_all">Select All</a> <a href="javascript:void(0)" class="unselect_all" style="display: none;">Unselect All</a></th>
                                 <th>Event Name</th>
                                 <th>Event Date</th>
                                 <th>Ticket Listed</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                     <div class="upload_sec">
                        <div class="columns is-multiline">
                           <div class="column is-2">
                              <div class="tick_details ">                                            
                                 <label>&nbsp;</label>
                                 <button type="submit" id="match-form-btn" class="btn btn-success" style="display: none;">Update Events</button>
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
<?php $this->load->view(THEME.'common/footer');?>
<script type="text/javascript">
   $('#match-form').validate({
   
            submitHandler: function(form) {
                       var tournament_id   = $("#match_tournament_id").val();
                       var partner_id   = $("#match_partner_id").val();
                       var data_from = { 'active' : [],'inactive' : [],'partner_id' : partner_id , "tournament_id" : tournament_id};
                   $('.input-check').each(function () {
                       var id = $(this).attr('data-id');
                       if ($(this).prop('checked')) {
                          data_from['active'].push(id);
                       }
                       else{
                            data_from['inactive'].push(id);
                       }
                   });
               
               //   console.log(data_from);
                   // return false;
                       var myform = $('#'+$(form).attr('id'))[0];
                       //is-loading no-click
                      // branch-form-btn
               
                       var formData = new FormData(myform);
                      
                       var action = $(form).attr('action');
                       $.ajax({
                         type: "POST",
                        // enctype: 'multipart/form-data',
                         url: action,
                         data : data_from  ,
                     
                         dataType: "json",
               
                         success: function(data) {
                           //alert(data.msg);
                           $('#search').removeClass("is-loading no-click");
               
                           $('.has-loader').removeClass('has-loader-active');
                           window.location.reload();
                         }
                       })
                       return false;
                     }
       });
   
   
   $('#search-form').validate({
   
         submitHandler: function(form) {
           
           var myform = $('#'+$(form).attr('id'))[0];
           //is-loading no-click
          // branch-form-btn
         
   
          var formData = new FormData(myform);
          var tournament   = $("#tournament").val();
           $('#search').addClass("is-loading no-click");
           $('.has-loader').addClass('has-loader-active');
           $('#search').html("Please Wait..");
            $("#match-form-btn").hide();
           $('#match_list').html("<h5 class='text-center'>Loading....</h5>");
           $('#search').prop('disabled', true);;
           var tournament   = $("#tournament").val();
           var page         = $("#page").val();
   
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
   
             success: function(data) {
   
               $('#search').removeClass("is-loading no-click");
   
               $('.has-loader').removeClass('has-loader-active');
                $('#search').html("Submit");
                $('#search').prop('disabled', false);;
   
            if(data.status == 1){
                       $('#match_list').html(data.match_list);
                   }
                   $("#match-form-btn").show();
             }
           })
           return false;
         }
       });
   
   
   $("#tournament").change(function(){
        $("#match_tournament_id").val($(this).val());
   });
   $("#partner_id").change(function(){
        $("#match_partner_id").val($(this).val());
   });
   
   
   
   $("body").on("click",".select_all",function(){
       $(".unselect_all").show();
       $(".select_all").hide();
       $('.input-check').prop('checked',true);     
   });
   
   $("body").on("click",".unselect_all",function(){
       $(".select_all").show();
       $(".unselect_all").hide();
       $('.input-check').prop('checked',false);
         
   });
   
</script>
<?php exit;?>