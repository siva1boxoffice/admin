<style>
   .dataTables_scroll
{
    overflow:auto !important;
}
</style>
<?php $this->load->view(THEME.'common/header'); ?>
      <!-- Begin main content -->
      <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">

                  <div class="page-title dflex-between-center">
                     <h3 class="mb-1 font-weight-bold">Listing Details</h3>
                     <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2 lis_details">
                           <a href="<?php echo base_url();?>tickets/index/create_ticket"  class="btn btn-primary mb-2"><i class="fa fa-plus fa-sm"></i>&nbsp; New Listing</a>
                        </div>
                  </div>
               </div>
            </div>
            <!-- page content -->
            <div class="page-content-wrapper mt--45 listing_details_view ">
               <div class="container-fluid">
                  <div class="card rounded-0">
                     <div class="card-body">
                        <!-- <div class="section_all all_orders filter_new">
                           <div class="">
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
                                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Date <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                  
                                                <form class="px-3 py-2">
                                                   <div class="row">
                                                      <div class="col-md-6">
                                                         <div class="form-group datemark">
                                                            <input class="form-control" id="MyTextbox3" type="text" name="MyTextbox" placeholder="From">
                                                         </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                         <div class="form-group datemark_to">
                                                            <input class="form-control" id="MyTextbox2" type="text" name="MyTextbox1" placeholder="To">
                                                         </div>
                                                      </div>
                                                   </div>
                                                 </form>
                         
                                                   <div class="reset_btn">
                                                      <div class="reset_txt"><button class="btn btn-info">Save</button></div>
                                                      <div class="reset_ok"><button class="btn btn-info">Search</button></div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </li>
                                          <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Seller <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
                                                      <div class="check_box">
                                                        <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                          <label class="custom-control-label" for="customCheck1">Arnab Gupta</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                          <label class="custom-control-label" for="customCheck2">Ali Wikilins</label>
                                                        </div>
                                                      </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt">Reset</div>
                                                         <div class="reset_ok"><button>Ok</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                          <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   Tournament <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
                                                      <div class="check_box">
                                                        <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                          <label class="custom-control-label" for="customCheck1">Arnab Gupta</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                          <label class="custom-control-label" for="customCheck2">Ali Wikilins</label>
                                                        </div>
                                                      </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt">Reset</div>
                                                         <div class="reset_ok"><button>Ok</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                          <li class="sort_list">
                                             <div class="btn-group">
                                                <div class="dropdown">
                                                   <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   City <i class="mdi mdi-chevron-down"></i>
                                                   </button>
                                                   <div class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                                                      <div id="view_project_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                      <div id="view_project_list_filter" class="dataTables_filter"><label class="search-box d-inline-flex position-relative">Search:<input type="search" class="form-control form-control-sm" placeholder="Search in Filters..." aria-controls="view_project_list"></label></div>
                                                   </div>
                                                      <div class="check_box">
                                                        <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                          <label class="custom-control-label" for="customCheck1">Arnab Gupta</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                          <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                          <label class="custom-control-label" for="customCheck2">Ali Wikilins</label>
                                                        </div>
                                                      </div>
                                                      <div class="reset_btn">
                                                         <div class="reset_txt">Reset</div>
                                                         <div class="reset_ok"><button>Ok</button></div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                          <li class="sort_list">
                                             <a class="clear_all" href="">Clear All</a>
                                          </li>
                                          <li class="sort_list">
                                             <a href="" class="button h-button is-primary download_orders report_sts">Search</a>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div> -->
                        <div class="row column_modified" >
                           <div class="col-md-12">
                              <div class="list_tables_edit ">
                                 <table style='width:100% !important' id="list_body" class="table  mb-0 tournament list_tables_edit">
                                    <thead class="thead-light">
                                       <tr class="">
                                          <th>&nbsp;</th>
                                          <th>Date</th>
                                          <th>Event</th>
                                          <th>Tournament</th>
                                          <th>Stadium</th>
                                          <th>City</th>
                                          <th>Country</th>
                                          <th>Qty</th>
                                          <th>SOLD</th>
                                          <th>Price Range</th>
                                          <th>&nbsp;</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                 </table>
                                 <div class="edit_modal_popup modal fade" id="clone-listing-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="">
        <div class="modal-header">
                            <!-- <h4 class="modal-title" id="myLargeModalLabel">Clone</h4> -->
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          </div>
        <!-- <p class="text-right"><button type="button" class="modal-close close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><img src="<?php echo base_url();?>assets/img/close.svg" ></span></span>
        </button></p> -->

        <div class="modal-body clone-listing" id="ticket_clone_body">

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
      <!-- main content End -->
<?php $this->load->view(THEME.'common/footer'); ?>
<script type="text/javascript">
    $(document).ready(function () {
      //$('#list_body').DataTable(); 
      //    initHModals();
      //   load_tickets_details('<?php //echo $match_id; ?>', 0);

   /*$('#list_body').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: base_url + 'tickets/get_ajax_ticket_details',
                    "type": "POST"
                    ,
                }
            });*/

     // $('#list_body').DataTable({
     //     'info': false,
     //    // 'scrollX': !0,
     //     "targets": 'no-sort',
     //     "bSort": false,
     //     "bPaginate": false,
     //     "bAutoWidth": false
 
     //  });

            $.ajax({
               url: base_url + 'tickets/get_ajax_ticket_details', // Replace with the actual URL of your HTML content
      dataType: 'html',
      type: 'POST',
        data: { match_id: <?php echo $match_id; ?>} ,
      success: function(data) {
        // On successful AJAX call, populate the DataTable
        $('#list_body tbody').html(data);
      //  $('#list_body').DataTable(); // Initialize DataTable
      },
      error: function() { 
        // Handle the error if the AJAX request fails
        alert('Failed to load AJAX content.');
      }
   });

    });
</script>