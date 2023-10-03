<style>
	.view_bg{
	color: #ffffff !important;
	}
</style>
<?php $this->load->view(THEME.'common/header');

?>
  <!-- Begin main content -->
  <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="page-title dflex-between-center mb-2">
                     <h3 class="mb-1"> <div class="go_back_btn"><a href="<?php echo base_url(); ?>accounts/payouts/"><i class="fas fa-arrow-left"></i></a></div> Payout Info</h3>
                    <!-- //accounts/payouts/ -->
                  </div>
               </div>
            </div>
            <!-- page content -->
            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">
                  <div class="card">
                     <div class="card-body">
                        <div class="pay_head">
                           <h4 class="">Payment #<?php echo $payout_histories[0]->payout_no;?></h4>
                        </div>
                        <div class="table-responsive">
                           <table id="payable-table" class="table  table-hover table-nowrap mb-0">
                              <thead class="thead-light">
                                 <tr>
                                    <th>Order ID</th>
                                    <th>Event Name</th>
                                    <th>Buyer</th>
                                    <th>Ticket Type</th>
                                    <th>Tickets</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <?php 
                            
                                 $payable_orders = json_decode($payout_histories[0]->payout_orders);
                                 if(!empty($payable_orders)){  ?>
                                 <?php foreach($payable_orders as $peky => $payable_order) {
                                   
                                    $ci=& get_instance();
                                    $ci->load->model('Accounts_Model');
                                    $payable = $ci->Accounts_Model->get_unpaid_orders_v2(array('bg_id' => $payable_order->bg_id,'payout_status' => 1));
                                   
                                     ?>
                                 <tr>
                                    <td>#<?php echo $payable[0]->booking_no;?></td>
                                    <td><?php 

                                       $match_name_inpt= $payable[0]->match_name;
                                       $match_name_array = explode(" Vs ", $match_name_inpt);
                                       $match_name=$match_name_array[0]." Vs <br/>".$match_name_array[1];
                                       echo $match_name;
                                    
                                    ?></td>
                                    <td><?php echo ucfirst($payable[0]->first_name);?> <?php echo $payable[0]->last_name;?></td>                                 
                                    <td><?php echo $payable[0]->ticket_type_name;?></td>
                                    <td><?php echo $payable[0]->quantity;?></td>
                                    <td><?php if($payable[0]->currency_type == "USD"){ ?>
                                             $
                                             <?php } else if($payable[0]->currency_type == "GBP"){ ?>
                                             £
                                             <?php } else if($payable[0]->currency_type == "EUR"){ ?>
                                             €
                                             <?php } ?> <?php echo number_format($payable[0]->ticket_amount,2);?></td>
                                    <td>
                                       <div class="bttns">
                                       <?php if($payable[0]->booking_status == '1'){?><span class="badge badge-success">Confirmed</span><?php } ?>
                                     
                                          <?php if($payable[0]->booking_status == '2'){?><span class="badge badge-cancel">Pending</span><?php } ?>
                                          <?php if($payable[0]->booking_status == '3'){?><span class="badge badge-cancel">Cancelled</span><?php } ?>
                                          <?php if($payable[0]->booking_status == '4'){?><span class="badge badge-success">Shipped</span><?php } ?>
                                          <?php if($payable[0]->booking_status == '5'){?><span class="badge badge-success">Delivered</span><?php } ?>
                                          <?php if($payable[0]->booking_status == '6'){?><span class="badge badge-success">Downloaded</span><?php } ?>   
                                          <?php if($payable[0]->booking_status == '7'){?><span class="badge badge-warning">Pending Confirmed</span><?php } ?>                                      
                                       </div>
                                    </td>
                                 </tr>
                               <?php } ?>
                               <?php } ?>
                              </tbody>
                           </table>
                        </div>

                        <div class="row">
                           <div class="col-lg-8">
                              <div class="file_uplo mt-3">
                                 <p class="mb-2">Upload Payout or Bank Deposit Receipt</p>
                                 <div class="form-group mb-0">
                                    <div class="input-group">
                                    
                                       <?php if($payout_histories[0]->receipt != ""){?>
                                          <div class="upload_inst mb-0 mr-3">
                                          <p><span><?php echo $payout_histories[0]->receipt;?></span></p>
                                          <ul>										
										               <li><div class="remove_ico"><i class=" far fa-trash-alt delete_payout_file" data-delete-id='<?php echo $payout_histories[0]->payout_id; ?>' ></i></div></li>  
                          
                          				         <li><div class="view_ico"><a target="_blank" href="javascript:void(0);" onclick="return popitup('<?php echo TICKET_UPLOAD_PATH.'uploads/payout_receipt/'.$payout_histories[0]->receipt;?>')" class="view_bg"><i class=" far fa-eye"></i></a></div></li>
										            </ul> 

                                           <!-- <a style="text-decoration: underline;" target="_blank" href="<?php //echo TICKET_UPLOAD_PATH;?>uploads/payout_receipt/<?php //echo $payout_histories[0]->receipt;?>">View Payment Receipt</a> -->

                                           </div>

                                       <?php }else{ ?>
                                       <p class="mb-0 mr-3">No Receipt Available</p>
                                       <?php } ?>                                       
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input payout-upload" id="inputGroupFile04" data-id="<?php echo $payout_histories[0]->payout_id;?>">
                                         <label class="custom-file-label" for="inputGroupFile04">Upload Receipt</label>
                                      </div>
                                    </div>
                                 </div>
                                 
                              </div>
                           </div>
                            <!--<div class="col-lg-4">
                              <div class="form-group mt-3 mb-0">
                                  <label for="simpleinput">Payment Receipt</label>
                                  <input type="text" id="simpleinput" class="form-control" placeholder="Reference#">
                              </div>
                           </div> -->
                           <div class="col-lg-3">
                              <div class="total_amt mt-3 ml-5">
                                 <p class="mb-3">Total Payable</p>
                                 <h5><?php if($payout_histories[0]->currency == "USD"){ ?>
                                                   $
                                                   <?php } else if($payout_histories[0]->currency == "GBP"){ ?>
                                                   £
                                                   <?php } else if($payout_histories[0]->currency == "EUR"){ ?>
                                                   €
                                                   <?php } ?> <?php echo number_format($payout_histories[0]->total_payable,2);?></h5>
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <!-- <div class="confirm_payout mt-3">
                                 <p class="mb-1">&nbsp;</p>
                                 <button type="button" class="btn btn-primary waves-effect waves-light" data-effect="wave">Confirm Payout</button>
                              </div> -->
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
<?php $this->load->view(THEME.'common/footer');?>
<script>
   $(document).ready(function() {

      //$('body').scrollspy({ target: '#payable-table' });

   $('.payout-upload').on('change', function() {
    var file_data = $('.payout-upload').prop('files')[0];
    var allowed_types = ['application/pdf', 'image/jpeg', 'image/png'];
    if (allowed_types.indexOf(file_data.type) === -1) {
      alert('File type not allowed. Please select a PDF, JPEG, or PNG file.');
      return;
    }
	
	
	var payout_id = $(this).attr('data-id');
	
    var form_data = new FormData();
    form_data.append('file', file_data);
	form_data.append('payout_id', payout_id);

    $.ajax({
	  url: '<?php echo base_url();?>accounts/payout_file',
      type: 'POST',
	  async: false,
	  cache: false,
	  contentType: false,
	  enctype: 'multipart/form-data',
	  dataType: "json",           
      data: form_data,
      contentType: false,
      processData: false,
      success: function(response) {
        // Handle the response from the server
        console.log(response);
		swal('Updated !', response.msg, 'success');
                      setTimeout(window.location.reload(),200);
      },
      error: function(xhr, status, error) {
        // Handle the error
        console.log(error);
      }
    });
  });


  $(".delete_payout_file").click(function () {
var data_id = $(this).attr('data-delete-id');
   swal({
			title: 'Are you sure you want to delete this Payout or Bank Deposit Receipt?',
		    text: "Yes or No",
		    type: 'warning',
		    showCancelButton: true,
		    confirmButtonColor: '#0CC27E',
		    cancelButtonColor: '#FF586B',
		    confirmButtonText: 'Yes',
		    cancelButtonText: 'No',
		    confirmButtonClass: 'button h-button is-primary btn btn-primary ',
            cancelButtonClass: 'button h-button is-danger btn btn-danger',
		    buttonsStyling: false
		  }).then(function (res) {


    if (res.value == true) {    
		$.ajax({
         url: '<?php echo base_url();?>accounts/delete_uploaded_instructions',
         type: 'POST',
         dataType: "json",
         data: {  payout_id: data_id   },
         success: function (response) {               
               swal('Updated !', response.msg, 'success');
               setTimeout(window.location.reload(),300);
         },
         error: function () {
         console.log('Failed');
         }
      });
    }   
  }, function (dismiss) {

  });
   });

});

function popitup(url,temp='')
   {
      if(temp!="")
            var url='<?php echo base_url()."/uploads/e_tickets/temp/";?>'+url; 

      newwindow=window.open(url,'name','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,,height=500,width=700');

      if (window.focus) {newwindow.focus()}
      return false;
   }

   
   </script>
