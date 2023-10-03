<style>
   .dataTables_scroll {
      overflow: auto !important;
   }
</style>
<?php $this->load->view(THEME . 'common/header'); ?>

<div class="main-content">
   <div class="page-content">
      <div class="page-title-box">
         <div class="container-fluid">

            <div class="page-title dflex-between-center">
               <h3 class="mb-1 font-weight-bold">Other Event Listing Details</h3>
               <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2 lis_details">
                  <a href="<?php echo base_url(); ?>tickets/index/create_oe_ticket" class="btn btn-primary mb-2"><i
                        class="fa fa-plus fa-sm"></i>&nbsp; New Listing</a>
               </div>
            </div>
         </div>
      </div>
      <div class="page-content-wrapper mt--45 listing_details_view ">
         <div class="container-fluid">
            <div class="card rounded-0">
               <div class="card-body">
                  <div class="row column_modified">
                     <div class="col-md-12">
                        <div class="list_tables_edit ">
                           <table style='width:100% !important' id="list_body"
                              class="table  mb-0 tournament list_tables_edit">
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
                           <div class="edit_modal_popup modal fade" id="clone-listing-modal" tabindex="-1" role="dialog"
                              aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                 <div class="modal-content" id="">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal"
                                          aria-hidden="true">×</button>
                                    </div>
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
<?php $this->load->view(THEME . 'common/footer'); ?>
<script type="text/javascript">
   $(document).ready(function () {
      $.ajax({
         url: base_url + 'tickets/get_ajax_ticket_details',
         dataType: 'html',
         type: 'POST',
         data: { match_id: <?php echo $match_id; ?> },
         success: function (data) {
            $('#list_body tbody').html(data);
         },
         error: function () {
            alert('Failed to load AJAX content.');
         }
      });

   });
</script>