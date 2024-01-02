
<?php 

    $only = @$_GET['only'] ;
    $only_url =   @$_GET['only'] ? "?only=".@$_GET['only']  : "" ;
?>
<?php  $this->load->view(THEME.'common/header'); ?>

<style>
   .ticket_sold_checkbox {
    padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;
}
.ticket_sold_checkbox, {
    max-height: 250px;
    overflow-y: auto;
}
</style>
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
    </style>
    <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-sm-4 col-xl-4">
                        <div class="page-title">
                           <h3 class="mb-1 font-weight-bold">Blog</h3>
                        </div>
                     </div>
                     <div class="col-sm-8 col-xl-8 text-sm-right mt-2 mt-sm-0">
                        <div class="float-sm-right mt-3 mt-sm-0 team_lists_bttn">
                        
                           <a href="<?php echo base_url();?>blog/index/add/"  class="btn btn-success mb-2 ">Add Blog</a>
                        </div>
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
                                 <span>Filter By:</span>
                              </div>
                           </div>
                           <div class="col-md-11">
                              <div class="sort_filters">
                                <input type="hidden" class="flag" name="flag" id="flag" value="<?php echo $this->uri->segment(3);?>">
                                 <input type="hidden" class="only" name="only" id="only" value="<?php echo @$_GET['only'];?>">
                                 <ul>
                                    

                                     <li class="sort_list">
                                       <div class="btn-group">
                                          <div class="dropdown">
                                             <button class="btn btn-light dropdown-toggle afiliates_search_filter" type="button" id="dropdownMenuButton"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <span class="text_class">Blog Category</span>  <span class="selected_class"></span> <i class="mdi mdi-chevron-down"></i>
                                             </button>
                                             <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm search_box" placeholder="Search in Filters..." aria-controls="view_project_list" id='afiliates_search_box'></label></div>
                                             </div>
                                                <!-- <a class="dropdown-item" href="#">Supercopa De Italia</a>
                                                <a class="dropdown-item" href="#">Super Lig</a>
                                                <a class="dropdown-item" href="#">Test Tournament English2</a> -->
                                                <div class="check_box">
                                                     <?php if($blog_category){

                                        foreach (@$blog_category as $key => $value) {
                                                          ?>
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input category_id" id="category_name<?php echo $key;?>" name="category_name[]" value="<?php echo $value->id;?>">
                                                    <label class="custom-control-label" for="category_name<?php echo $key;?>"><?php echo $value->category_name;?> </label>
                                                  </div>
                                              <?php } }  ?>


                                                </div>


                                                <div class="reset_btn">
                                                   <div class="reset_txt"><button class="btn btn-info clear_all_single">Reset</button></div>
                                                   <div class="reset_ok"><button class="btn btn-info search_box_single">Search</button></div>
                                                </div>                                               

                                             </div>
                                          </div>
                                       </div>
                                    </li>

                                  <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle event_name_filter" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <span class="text_class">Blog Name</span>  <span class="selected_class"></span> <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" id="blog_name" name="blog_name" class="form-control form-control-sm blog_name" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info match_id_rest">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info event_search_ok">Search</button></div>
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
                                                <div class="check_box">
                                                 
                                                  <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status1" name="status[]" value="1">
                                                    <label class="custom-control-label" for="status1">Active</label>
                                                  </div>
                                                  
                                                    <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input status" id="status0" name="status[]" value="0">
                                                    <label class="custom-control-label" for="status0">InActive</label>
                                                  </div>


                                                </div>

                                         

                                                <div class="reset_btn">
                                                         <div class="reset_txt"><button class="btn btn-info clear_all_single">Reset</button></div>
                                                         <div class="reset_ok"><button class="btn btn-info  search_box_single">Search</button></div>
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
                                    <th class="before_none">Blog Type</th>
                                    <th class="before_none">Category</th>
                                    <th class="before_none">Blog Title</th>
                                   
                                    <th class="before_none">Status</th>
                                    <th class="before_none">Created Date</th>
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

//     $('#view_project_list').dataTable( {
//           "ajax": {
//             "url": "<?php echo base_url('') ;?>",
//             "data": function ( d ) {
//                 d.extra_search = $('#extra').val();
//             }
//           }
// } );




     $(document).ready(function(){


      $('.report_sts').click(function(event) {
    event.preventDefault();

    var baseUrl = '<?php echo base_url(); ?>';
    var eventStartDate = encodeURIComponent($('input[name="MyTextbox"]').val());
    var eventEndDate = encodeURIComponent($('input[name="MyTextbox1"]').val());
    var event_name = encodeURIComponent($('input[name="event_name"]').val() || '');
   //  var users = encodeURIComponent($('input[name="users"]').val() || '');
   //  var tournaments = encodeURIComponent($('input[name="tournaments"]').val() || '');
   //  var matchId = encodeURIComponent($('input[name="match_id"]').val() || '');
   //  var nominee = encodeURIComponent($('input[name="nominee"]').val() || '');
   var stadiumIds = [];
   var tournamentIds = [];
   var status= [];
   $('.stadium_id:checked').each(function() {
      stadiumIds.push(encodeURIComponent($(this).val()));
    });

    $('.tournament_id:checked').each(function() {
      tournamentIds.push(encodeURIComponent($(this).val()));
    }); 
    
    $('.status:checked').each(function() {
      status.push(encodeURIComponent($(this).val()));
    }); 

    //console.log(stadiumIds);

    var url = baseUrl + 'event/event_reports?' + 'event_start_date=' + eventStartDate + '&event_end_date=' + eventEndDate + '&event_name=' +event_name + '&stadium_ids=' + stadiumIds.join(',') + '&tournament_ids=' + tournamentIds.join(',')+ '&status=' + status.join(',');
    window.location.href = url;
  });

      $("body").on('click','.ticket_sold_checkbox',function(e){
            e.stopPropagation();
         });

      $('.active_event').click(function() {
       var status=$(this).html();
    // Find all the checkboxes that are checked
    var checkedCheckboxes = $('.dt-checkboxes:checked');

    // Get the data-order-id value of each checked checkbox
    var orderIds = [];
    checkedCheckboxes.each(function() {
      var orderId = $(this).data('org-order-id');
      orderIds.push(orderId);
    });

    // Make an AJAX request to process the data
   if(orderIds=="")
   {
      swal('Error!', "Choose any one of the checkbox.", 'error');
      return;
   }
      $.ajax({
        url: base_url + 'event/change_match_info_status',
        type: "POST",
        data: { orderIds: orderIds , status:status}, // Pass the search text to the PHP script
        success: function(response) {
                      if(response.status==0)
                        {
                           swal('Updation Failed !', response.msg, 'error');
                        }
                        else
                        {
                           swal('Updated !', response.msg, 'success');
                        }
                        setTimeout(window.location.reload(),900);
        }
      }); 
  });

      $("#check-all").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });

  // Add an onchange event to the checkbox
  $('#view_project_list').on('change', 'input[type="checkbox"]', function() {

  var allChecked = true;
    $('table tbody input[type="checkbox"]').each(function() {
      if(!$(this).is(":checked")) {
        allChecked = false;
      }
    });
    $("#check-all").prop('checked', allChecked);

  });
  var overlay = $('#overlay');
       var Dtable =  $('#view_project_list').DataTable(
{
                "language": {
                    paginate:{
                        previous:"<i class='bx bx-chevron-left'>",
                        next:"<i class='bx bx-chevron-right'>"
                    }
                },
                drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
        },
         'info': false,
         // scrollX: !0,
        "ordering": false,
         'processing': true,
          'serverSide': true,
          // 'scrollX': !0,
          'serverMethod': 'post',
          "targets": 'no-sort',
          "bSort": false,
          "pageLength" : 50,
         //  'info': false,
          'ajax': {
             'url':'<?php echo base_url('blog/ajax') ;?>',
              data: function (d) {
                var blog_name = $("#blog_name").val();
             //   var stadium = $(".stadium").val();



                     var category_ids= '';
                     $('.category_id').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = category_ids.length===0?'':',';
                                 category_ids += (comma+e.value);
                        }
                     });


                     var statuss= '';
                     $('.status').each(function(i,e) {
                        if ($(e).is(':checked')) {
                                 var comma = statuss.length===0?'':',';

                              //   if(e.value == 0 ) e.value = 2
                                 statuss += (comma+e.value);
                        }
                     }
                     
                     );

         

                d.blog_title = blog_name;
                d.category_ids = category_ids;
                d.statuss = statuss;

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
             { data: 'blog_type' },
             { data: 'category' },
             { data: 'blog_title' },
             { data: 'status' },
             { data: 'date' },
             { data: 'action' },
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
  

       $('.search_box_single').on('click', function (e) {
       var  count =  $(this).parents(".dropdown").find(".check_box  .custom-checkbox input:checked").length ;
         
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
           $(this).parents(".dropdown").find(".check_box .custom-checkbox input").prop('checked', false); 
           $(this).parents(".dropdown").find(".text_class").show();
           $(this).parents(".dropdown").find(".selected_class").hide().html("");
          $(this).parents(".dropdown").find('.dropdown-toggle').removeClass("filter_active");

          $(this).parents(".dropdown").find(".form-group input:text").val(""); 
            Dtable.ajax.reload();
       });

        $(".clear_all").on('click', function(){

            $(".dropdown").find(".check_box .custom-checkbox input").prop('checked', false); 
            $(".dropdown").find(".text_class").show();
            $(".dropdown").find(".selected_class").hide();
            $(".dropdown").find('.dropdown-toggle').removeClass("filter_active");
   

            $('.date_search_filter').removeClass("filter_active");
            $("#blog_name").val("");
            
             $('.dropdown-menu-custom').removeClass('show');
             $('.dropdown').removeClass('show');     

             Dtable.ajax.reload();
        });


       
       $("body").on("click",".match_id_rest",function(){
         $('.event_name_filter').removeClass("filter_active");
       // alert("rest");
        $(".match_id").prop('checked', false);
          $("#blog_name").val('');
        
            Dtable.ajax.reload();

         });


       $('.event_search_ok').on('click', function (e) {
         
         var event_name_filter_len = $("#blog_name").val();
         if(event_name_filter_len.length > 0) {
         	$('.event_name_filter').addClass("filter_active");
         }
         else{
         	$('.event_name_filter').removeClass("filter_active");
         }
         Dtable.ajax.reload();
      });



              $('.dropdown-menu-custom .check_box').click(function(e){
            e.stopPropagation();
        });
     });
   </script>
<?php exit;?>