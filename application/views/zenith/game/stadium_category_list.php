
<?php 
    $stadium_category = $this->General_Model->get_seat_category_by_limit('', '1000000', '', '', '',array())->result();
    
    
    $only = @$_GET['only'] ;
    $only_url =   @$_GET['only'] ? "?only=".@$_GET['only']  : "" ;
?>
<?php  $this->load->view(THEME.'common/header'); ?>


<div id="overlay">
  <div id="loader">
    <!-- Add your loading spinner HTML or image here -->
    <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
  </div>
</div>
    
    <style>
        
        .check_box{
            max-height: 250px;
            overflow-y: auto;
        }

           .ticket_sold_checkbox {
            padding: 0 15px;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .ticket_sold_checkbox, {
            max-height: 250px;
            overflow-y: auto;
        }


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
                       <h3 class="mb-1">Stadium Category</h3>
                       <div class="float-sm-right mt-3 mt-sm-0 add_team_s">
                          <a href="<?php echo base_url(); ?>game/stadium_category/add"  class="btn btn-success mb-2">Add New</a>
                        </div>
                    </div>
                 </div>
              </div>
            <!-- page content -->

            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">

                    
          
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
                                             <button class="btn btn-light dropdown-toggle stadium_category_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text_class">  Stadium Category Name  </span>  <span class="selected_class"></span> <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id='stadium_category_search_box'></label></div>
                                             </div>
                                                <div class="check_box">
                                                     <?php if($stadium_category){
                                                        foreach ($stadium_category as $key => $value) {
                                                          ?>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input stadium_category_id" id="stadium_category_id<?php echo $key;?>" name="stadium_category[]" value="<?php echo $value->id;?>">
                                                    <label class="custom-control-label" for="stadium_category_id<?php echo $key;?>"><?php echo $value->seat;?></label>
                                                  </div>
                                              <?php } }  ?>


                                                </div>
                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button class="btn btn-info clear_all_single">Reset</button></div>
                                                   <div class="reset_ok"><button class="btn btn-info ">Search</button></div>
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
                                              <span class="text_class">Status </span>  <span class="selected_class"></span> <i class="mdi mdi-chevron-down"></i>
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

                                                 <!--  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status2" name="status[]" value="2">
                                                    <label class="custom-control-label" for="status2">Trash</label>
                                                  </div> -->

                                                </div>
                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all_single">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info ">Search</button></div>
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
                  
                           <table style="width: 100% !important;" class="table  table-hover table-nowrap mb-0 events_new-1" id="view_project_list">



                              <thead class="thead-light">
                                 <tr>
                     
                                   
                                    <th class="before_none">Seat Position </th>
                                    <th class="before_none">Arabic</th>
                                    <th class="before_none">Event For</th>
                                    <th class="before_none">Status</th>
                                    <th class="before_none">Actions</th>
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
<?php $this->load->view(THEME.'common/footer');?>

 

   <script type="text/javascript">
    $(document).ready(function() {
            var overlay = $('#overlay');
            var Dtable = $('#view_project_list').DataTable({
                "language": {
                    paginate: {
                        previous: "<i class='bx bx-chevron-left'>",
                        next: "<i class='bx bx-chevron-right'>"
                    }
                },
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination ");
                },
                "ordering": false,
                "searching": true,
                'processing': true,
                'serverSide': true,
                'scrollX': !0,
                'serverMethod': 'post',
                "targets": 'no-sort',
                "bSort": false,
                "pageLength": 50,
                //  'info': false,
                'ajax': {
                    'url': '<?php echo base_url("ajax/stadium_category") ;?>',
                    data: function(d) {

                        var stadium_category_ids= '';
                        $('.stadium_category_id').each(function(i,e) {
                          if ($(e).is(':checked')) {
                                    var comma = stadium_category_ids.length===0?'':',';
                                    stadium_category_ids += (comma+e.value);
                          }
                      });

                      var status= '';
                             $('.status').each(function(i,e) {
                                if ($(e).is(':checked')) {
                                         var comma = status.length===0?'':',';
                                         status += (comma+e.value);
                                }
                             });

                      d.stadium_category_ids = stadium_category_ids;
                      d.status = status;

                    },

                    beforeSend: function() {
                        // Show the overlay before the AJAX call

                        overlay.show();
                    },

                    complete: function() {
                        // Hide the overlay after the AJAX call is complete (regardless of success or error)
                        overlay.hide();

                    }
                },
                'columns': [
                    {
                        data: 'seat_position'
                    },
                    {
                        data: 'seat_position_ar'
                    },
                    {
                        data: 'event_for'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    },
                ]
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

       

          $('.reset_ok button').on('click', function (e) {

       var  count =  $(this).parents(".dropdown").find(".custom-checkbox input:checked").length ;
          
         if(count > 0 ){
             $(this).parents(".dropdown").find('.dropdown-toggle').addClass("filter_active");
             $(this).parents(".dropdown").find(".text_class").hide();
             $(this).parents(".dropdown").find(".selected_class").show().html(count + " Selected");
         }
         else{
             $(this).parents(".dropdown").find(".text_class").show();
             $(this).parents(".dropdown").find(".selected_class").hide().html("");
             $(this).parents(".dropdown").find('.dropdown-toggle').removeClass("filter_active");
         }
        
         
         Dtable.ajax.reload();
      });


       $(".clear_all_single").on('click', function(){
           $(this).parents(".dropdown").find(".custom-checkbox input").prop('checked', false); 
           $(this).parents(".dropdown").find(".text_class").show();
           $(this).parents(".dropdown").find(".selected_class").hide().html("");
          $(this).parents(".dropdown").find('.dropdown-toggle').removeClass("filter_active");

          $(this).parents(".dropdown").find(".form-group input:text").val(""); 
            Dtable.ajax.reload();
       });

        $('.stadium_search').on('click', function (e) {
         $('.stadium_search_filter').addClass("filter_active");
         Dtable.ajax.reload();
      });

         $(".clear_all").on('click', function(){
            $(".dropdown").find(".custom-checkbox input").prop('checked', false); 
            $(".dropdown").find(".text_class").show();
            $(".dropdown").find(".selected_class").hide();
            $(".dropdown").find('.dropdown-toggle').removeClass("filter_active");
             $('.search_box').trigger('keyup');
             $('.dropdown-menu-custom').removeClass('show');
             $('.dropdown').removeClass('show');     

             Dtable.ajax.reload();
        });

});


   </script>
<?php exit;?>