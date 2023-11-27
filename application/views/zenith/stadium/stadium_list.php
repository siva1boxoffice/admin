
<?php  $this->load->view(THEME.'common/header'); ?>

<style>
.check_box_category {
    padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
}
    </style>
<?php 
    $only = @$_GET['only'] ;
    $only_url =   @$_GET['only'] ? "?only=".@$_GET['only']  : "" ;
?>
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
                     <h3 class="mb-1">Stadium List</h3>
                     <div class="float-sm-right mt-3 mt-sm-0 add_team_s">
                        <a href="<?php echo base_url();?>stadium/add_stadium"  class="btn btn-success mb-2">Add Stadium</a>
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
                                                     <button class="btn btn-light dropdown-toggle stadium_search_filter" type="button" id="dropdownMenuButton"
                                                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                       <span class="text_class">Stadium Name </span>  <span class="selected_class"></span> <i class="mdi mdi-chevron-down"></i>
                                                     </button>
                                                     <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                        <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                        <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id='stadium_search_box'></label></div>
                                                     </div>
                                                        <div class="check_box">
                                                             <?php if($stadiums){
                                                                foreach ($stadiums as $key => $value) {
                                                                  ?>
                                                          <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input stadium_id" id="stadium_id<?php echo $key;?>" name="[]" value="<?php echo $value->s_id;?>">
                                                            <label class="custom-control-label" for="stadium_id<?php echo $key;?>"><?php echo $value->stadium_name;?> - <?php echo $value->s_id;?> </label>
                                                          </div>
                                                      <?php } }  ?>


                                                        </div>
                                                        <div class="reset_btn">
                                                           <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
                                                           <div class="reset_ok"><button class="btn btn-info ">Search</button></div>
                                                        </div>                                               

                                                     </div>
                                                  </div>
                                               </div>
                                            </li>

                                            <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle category_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Event Category <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div class="check_box_category">                                               <?php if($gcategory){
                                                        foreach ($gcategory as $key => $value) {
                                                          ?>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input category" id="category_id<?php echo $key;?>" name="category[]" value="<?php echo $value->id;?>">
                                                    <label class="custom-control-label" for="category_id<?php echo $key;?>"><?php echo $value->category_name;?></label>
                                                  </div>
                                              <?php } }  ?>                                                     

                                                </div>
                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info category_search">Search</button></div>
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
                                                     <span class="text_class">Status</span>  <span class="selected_class"></span> <i class="mdi mdi-chevron-down"></i>
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
                                                                 <div class="reset_txt"><button class="btn btn-info clear_all">Reset</button></div>
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
                          <table style="width: 100% !important;" class="table  stad_lists table-hover table-nowrap mb-0 events_new-1" id="view_project_list">


                              <thead class="thead-light">
                                 <tr>
                              
                                    <th class="before_none">Id</th>
                                    <th class="before_none">Stadium Name in English</th>
                                    <th class="before_none">Stadium Name in Arabic</th>
                                    <th class="before_none">Event Category</th>
                                    <th class="before_none">Stadium Variant</th>                                    
                                    <th class="before_none">Matches</th>
                                    <th class="before_none">Status</th>
                                    <th class="before_none">Attendee Status</th>
                                    <th class="before_none">Clone</th>
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

      <!-- Modal -->
        <div class="modal fade" id="cloneModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content confirm_delivery">
              <div class="modal-header">
            
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <h5> Are you sure you want to clone it ?  </h5>
              </div>
              <input type="hidden" name="stadium_modal_id" id="stadium_modal_id" value="">
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">No Cancel</button>
                <button type="button" class="btn btn-primary clone_confirm">Yes Clone</button>
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
                    'url': '<?php echo base_url("stadium/ajax") ;?>',
                    data: function(d) {
                         var stadium_ids= '';
                            $('.stadium_id').each(function(i,e) {
                              if ($(e).is(':checked')) {
                                        var comma = stadium_ids.length===0?'':',';
                                        stadium_ids += (comma+e.value);
                              }
                          });

                          var status= '';
                                 $('.status').each(function(i,e) {
                                    if ($(e).is(':checked')) {
                                             var comma = status.length===0?'':',';
                                             status += (comma+e.value);
                                    }
                                 });

                                 var category= '';
                     $('.category').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = category.length===0?'':',';
                                 category += (comma+e.value);
                        }
                     });

                          d.stadium_ids = stadium_ids;
                          d.status = status;
                          d.category = category;

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
                'columns': [{
                        data: 'id'
                    },
                    {
                        data: 'staduim_name'
                    },
                    {
                        data: 'stadium_name_ar'
                    },
                    {
                        data: 'category_name'
                    },
                    {
                        data: 'stadium_variant'
                    },
                    {
                        data: 'match_count'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'attendee_status'
                    },
                    {
                        data: 'clone'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
    
      $('body').on('click','.clone_stadium', function() {

            $("#cloneModal").modal();
             var stadium_id = $(this).data("id");
             $("#stadium_modal_id").val(stadium_id) ; 

         });


         $('body').on('click','.clone_confirm', function() {
             var stadium_id = $("#stadium_modal_id").val() ; 
             $(".clone_confirm").prop('disabled', true);
             $(".clone_confirm").html("Please Wait...");
             $.ajax({
                    url: '<?=base_url()?>game/stadium/clone_stadium',
                    method: 'post',
                    data: {
                        stadium_id: stadium_id
                    },
                    dataType: 'json',
                    success: function(data) {
                         $(".clone_confirm").prop('disabled', false);

                        if (data.status == 1) {
                            swal('Cloned Successfully !', "", 'success');
                            setTimeout(window.location.reload(), 1000);
                        } else if (data.status == 0) {
                            swal('Cloned Failed', "", 'error');
                             setTimeout(window.location.reload(), 1000);
                        }

                    }
                });
         });

    $('body').on('click','.stadium_status', function() {

        var stadium_id = $(this).attr('data-id');

        if ($(this).is(":checked")) {
            var status = 1;
        } else {
            var status = 0;
        }

        $.ajax({
            url: '<?=base_url()?>stadium/update_stadium_status',
            method: 'post',
            data: {
                status: status,
                stadium_id: stadium_id
            },
            dataType: 'json',
            success: function(data) {

                if (data.status == 1) {

                    notyf.success(data.msg, "Success", {
                        timeOut: "1800"
                    });
                } else if (data.status == 0) {
                    notyf.error(data.msg, "Failed", "Oops!", {
                        timeOut: "1800"
                    });
                }

            }
        });



    });



    $('body').on('click','.attendee_status', function() {

        var stadium_id = $(this).attr('data-id');

        if ($(this).is(":checked")) {
            var attendee_status = 1;
        } else {
            var attendee_status = 0;
        }

        $.ajax({
            url: '<?=base_url()?>stadium/update_stadium_attendee_status',
            method: 'post',
            data: {
                attendee_status: attendee_status,
                stadium_id: stadium_id
            },
            dataType: 'json',
            success: function(data) {

                if (data.status == 1) {

                    notyf.success(data.msg, "Success", {
                        timeOut: "1800"
                    });
                } else if (data.status == 0) {
                    notyf.error(data.msg, "Failed", "Oops!", {
                        timeOut: "1800"
                    });
                }

            }
        });



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

       $('.dropdown-menu-custom .check_box, .dropdown-menu-custom .check_box_status, .check_box_category').click(function(e) {
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