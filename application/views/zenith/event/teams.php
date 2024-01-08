<style>
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
<?php $this->load->view(THEME.'common/header'); ?>
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
      <div class="page-title-box">
         <div class="container-fluid">
            <div class="page-title dflex-between-center">
               <h3 class="mb-1"><?php echo ucfirst($segment).'s'; ?></h3>
               <div class="float-sm-right mt-3 mt-sm-0 add_team_s">
                  <a href="<?php echo base_url()."settings/teams/add_team/".$segment;?>"  class="btn btn-success mb-2">Add <?php echo ucfirst($segment); ?></a>
                </div>
            </div>
         </div>
      </div>
      <!-- page content -->
      <div class="page-content-wrapper mt--45 all_orders_page">
         <div class="container-fluid">

                   <!-- <div class="card">
                      <div class="card-body">
                          <div class="row">
                            <div class="col-sm-9 col-md-4">
                                
                            </div>
                            <div class="col-sm-3 col-md-8">
                                <div class="float-sm-right mt-3 mt-sm-0">
                                  <a href="<?php echo base_url();?>settings/teams/add_team"  class="btn btn-success mb-2">Add Team</a>
                                </div>
                            </div>
                          </div>
                      </div>
                    </div> -->

            <div class="card">
               <div class="card-body">

                  <div class="section_all all_orders filter_new">
                     <div class="">
                        <!-- cta -->
                        <div class="row">
                           <div class="col-md-1 nopadds">
                              <div class="sort_by">
                                 <span>Sort By:</span>
                              </div>
                           </div>
                           <div class="col-md-11">
                              <div class="sort_filters">
                              <ul>
                                  <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle teams_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <?php echo ucfirst($segment); ?> Name <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id='teams_search_box'></label></div>
                                             </div>
                                                <div class="check_box">
                                                     <?php if($teams_name){
                                                        foreach ($teams_name as $key => $value) {
                                                          ?>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input teams_id" id="teams_id_<?php echo $key;?>" name="teams[]" value="<?php echo $value->team_id;?>">
                                                    <label class="custom-control-label" for="teams_id_<?php echo $key;?>"><?php echo $value->team_name;?></label>
                                                  </div>
                                              <?php } }  ?>


                                                </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button class="btn btn-info teams_reset">Reset</button></div>
                                                   <div class="reset_ok"><button class="btn btn-info teams_search">Search</button></div>
                                                </div>                                               

                                             </div>
                                          </div>
                                       </div>
                                    </li>

                                    <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle status_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Status <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div class="check_box_status">
                                                 
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status1" name="status[]" value="1">
                                                    <label class="custom-control-label" for="status1">Active</label>
                                                  </div>
                                                  
                                                    <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status0" name="status[]" value="0">
                                                    <label class="custom-control-label" for="status0">InActive</label>
                                                  </div>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status3" name="status[]" value="3">
                                                    <label class="custom-control-label" for="status3">Top Teams</label>
                                                  </div>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status2" name="status[]" value="2">
                                                    <label class="custom-control-label" for="status2">Trashed</label>
                                                  </div>
                                                </div>
                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info status_reset">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info status_search">Search</button></div>
                                                      </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>

                                    <li class="sort_list">
                                       <a class="clear_all" href="javascript:void(0)">Clear All</a>
                                    </li>

                                  </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="table-responsive">
                     <table style='width:100% !important' id="teams-list" class="table table-hover table-nowrap mb-0 tournament">
                        <thead class="thead-light">
                           <tr>
                              <th><?php echo ucfirst($segment); ?> Name</th>
                              <th><?php echo ucfirst($segment); ?> Image</th>
                              <th>Category</th>
                              <th>Ticket Listed</th>
                              <th>Status</th>
                              <th>SEO Status</th>
                              <th>SEO Preview</th>
                              <th>Actions</th>
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
</div>
<!-- main content End -->

<?php $this->load->view(THEME.'common/footer'); ?>
<script>
	 $(document).ready(function () {
    var overlay = $('#overlay');
    var seg='<?php echo $segment;?>';
   var Dtable = $('#teams-list').DataTable({
         'info': false,
         'serverSide': true,
         'serverMethod': 'post',
         "pageLength" : 50,
         "targets": 'no-sort',
         "bSort": false,
         "ajax": {
            url: base_url + 'settings/get_teams/'+seg,
            data: function (d) {

				var teams_ids= '';
                $('.teams_id').each(function(i,e) {
                  if ($(e).is(':checked')) {
                            var comma = teams_ids.length===0?'':',';
                            teams_ids += (comma+e.value);
                  }
              });

              var status= '';
                     $('.status').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = status.length===0?'':',';
                                 status += (comma+e.value);
                        }
                     });

              d.teams_ids = teams_ids;
              d.status = status;
              
            
            },
            beforeSend: function () {
            // Show the loader before the request is sent
            overlay.show();
         },
         complete: function () {
            // Hide the loader after the request is completed
            overlay.hide();
         },
           
         },
         language: {
            paginate: {
               previous: "<i class='mdi mdi-chevron-left'>",
               next: "<i class='mdi mdi-chevron-right'>"
            },
         //   loadingRecords: '&nbsp;',
           // processing: 'Loading...'
         },
         drawCallback: function () {

            $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
         },
         'columns': [
            { data: 'team_name' },
            { data: 'image' },
            { data: 'category_name' },
			{ data: 'ticket_listed' },			
            { data: 'status' },
            { data: 'seo_status' },
            { data: 'seo_preview' },
            { data: 'edit_content' },
         ],
   });

   $(".search_box").on('keyup', function(){
              var value = $(this).val().toLowerCase();
           $(this).parents(".dropdown-menu").find(".custom-checkbox").each(function () {
                 if ($(this).find("label").text().toLowerCase().search(value) > -1) {
                    $(this).show();
                
                 } else {
                    $(this).hide();
                 }
              });
        });

        $('.dropdown-menu-custom .check_box').click(function(e){
            e.stopPropagation();
        });
        $('.dropdown-menu-custom .check_box_status').click(function(e){
            e.stopPropagation();
        });

        $('.teams_search').on('click', function (e) {
         $('.teams_search_filter').addClass("filter_active");
       //  Dtable.ajax.reload();
       applyFilters();
      });


      $(".clear_all").on('click', function(){
         resetFilters();
          $('.teams_search_filter').removeClass("filter_active");
          $('.status_search_filter').removeClass("filter_active");
          $('.teams_search_filter ').text("Teams Name");
          $('.status_search_filter ').text("Status");  
          $(".teams_id").prop('checked', false);
          $(".status").prop('checked', false);
          Dtable.ajax.reload();
    });

    $('.status_search').on('click', function (e) {
         $('.status_search_filter').addClass("filter_active");
        // Dtable.ajax.reload();
         applyFilters();
      });

      $(".check_box").change(function() { 
         var checkedCount = $('.check_box input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.teams_search_filter ').text(checkedCount+" Selected");
         } 
         else 
            $('.teams_search_filter ').text("Seller Name");  
            
         });  

         $(".check_box_status").change(function() { 
         var checkedCount = $('.check_box_status input:checked').length;
       
         if(checkedCount>0) 
         {
            $('.status_search_filter ').text(checkedCount+" Selected");
         } 
         else 
            $('.status_search_filter ').text("Status");  
            
         });  


         function applyFilters() {
         var checkedIds = [];
               $(".check_box input:checked").each(function () {
                  checkedIds.push($(this).attr('id'));
               });

               var seatIds = [];
               $(".check_box_status input:checked").each(function () {
                  seatIds.push( $(this).attr('id'));
               });

            const team=checkedIds;
            const status=seatIds;

            var filters = {                   
               teams_team: team,
               teams_status: status
            // ... Add other filters
            };
            sessionStorage.setItem('teams', JSON.stringify(filters));
          Dtable.draw();        
         
}


         function resetFilters() {
               // Save the filter values in session storage
                     var filters = {
                        teams_team         :     "",
                        teams_status            :     ""
                     // ... Add other filters
                     };
                     sessionStorage.setItem('teams', JSON.stringify(filters));
                  Dtable.draw();        
                  
         }

var storedFilters = sessionStorage.getItem('teams');
   
  if (storedFilters) {
      var filters = JSON.parse(storedFilters);     
      var team =filters.teams_team;
      var status =filters.teams_status;
     // return false;
$(".check_box input[type='checkbox'], .check_box_status input[type='checkbox']").each(function() {
  var ID = $(this).attr('id');
  
  if ($(this).closest('.check_box').length) {
  
    // Checkbox belongs to the seat category group
    if (team.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  } else if ($(this).closest('.check_box_status').length) {
  
    // Checkbox belongs to the seller name group
    if (status.includes(ID)) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  }
});
     
      if (team && team.length > 0) {
         $('.teams_search_filter').addClass("filter_active");
         $('.teams_search_filter').text(team.length + " Selected");
      }
      if (status && status.length > 0) {
         $('.status_search_filter').addClass("filter_active");
         $('.status_search_filter').text(status.length + " Selected");
      }

      Dtable.ajax.reload()
  }


  function updateFilters(argName) {
  // Retrieve filters object from sessionStorage
  var filters = JSON.parse(sessionStorage.getItem('teams'));
  // Check if sales_summary_seller_name has a value
  if (filters["teams_" + argName] && filters["teams_" + argName] !== "") {
   
    // Clear the remaining values while keeping the existing tournaments_seller_name value
    filters["teams_" + argName] = "";
    filters = {
      teams_team: filters.teams_team,
      teams_status: filters.teams_status,
    };
  }
  
  // Update sessionStorage with the modified filters object
  sessionStorage.setItem('teams', JSON.stringify(filters));
  Dtable.ajax.reload();
}

$('.status_reset').click(function () {    
      $('.status_search_filter').removeClass("filter_active");
      $('.status_search_filter').text("Status");
      $('.check_box_status input:checked').prop("checked", false); 
      updateFilters("status");
      });

      $('.teams_reset').click(function () {    
      $('.teams_search_filter').removeClass("filter_active");
      $('.teams_search_filter').text("Team Name");
      $("#teams_search_box").val('');
      $('.check_box input:checked').prop("checked", false);
      $('.search_box').trigger('keyup');
      updateFilters("teams"); 
          
      // 
      });

});
</script>