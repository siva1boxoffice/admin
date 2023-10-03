<style>
 
</style>

<?php $this->load->view(THEME . 'common/header'); ?>


<!-- Begin main content -->
<div class="main-content">
   <!-- content -->
   <div class="page-content">
      <div class="page-title-box">
               <div class="container-fluid">
                  <div class="page-title dflex-between-center mb-2">
                     <h3 class="mb-1"> <div class="go_back_btn"><a href="<?php echo base_url(); ?>accounts/make_payouts_new/"><i class="fas fa-arrow-left"></i></a></div>Payouts</h3>
                    <!-- //accounts/payouts/ -->
                  </div>
               </div>
            </div>
    
      <!-- page content -->
      <div class="page-content-wrapper mt--45">
         <div class="container-fluid">
           
            <div class="card">
               <div class="card-body">

                

                  <div class="">
                      <?php if(isset($payout_histories)){?>
                     <table style='width:100% !important' id="sales-datatable"
                        class="table table-hover table-nowrap mb-0 sales-summary-class">
                        <thead class="thead-light">
                            <tr class="accordion">
                            <th>Payout Date</th>
                            <?php if ($this->session->userdata('role') == 6) { ?>
                            <th>Seller</th>
                            <?php } ?>
                            <th>Total Orders</th>
                            <th>Amount</th>
                            <th>Payout Txn Id</th>
                            <th>Txn Receipt</th>
                            <th>Description</th>
                            <!--     <th>&nbsp;</th> -->
                            </tr>
                        </thead>
                        <tbody>
                              <?php foreach($payout_histories as $payout_history){?>
                         <tr>
                                    <td><span class="tr_date"> <?php echo date('D j F Y',strtotime($payout_history->paid_date_time));?></span>  <span class="tr_date"><?php echo date('H:i A',strtotime($payout_history->paid_date_time));?></span></td>
                                    <?php if ($this->session->userdata('role') == 6) { ?>
                                    <td data-label="Seller:"><?php echo $payout_history->admin_name;?> <?php echo $payout_history->admin_last_name;?></td>
                                    <?php } ?>                                 
                                     <td data-label="total_orders:"><?php echo $payout_history->total_orders;?></td>
                                    <td data-label="Price:">
                                    <?php if($payout_history->currency == 'GBP'){?>
                                    <i class="fas fa-pound-sign"></i> 
                                    <?php } ?>
                                    <?php if($payout_history->currency == 'EUR'){?>
                                    <i class="fas fa-euro-sign"></i> 
                                    <?php } ?>
                                    <?php if($payout_history->currency == 'USD'){?>
                                    <i class="fas fa-dollar-sign"></i> 
                                    <?php } ?>
                                       <?php if($payout_history->currency == 'AED'){?>
                                    AED
                                    <?php } ?> 
                                    <?php echo $payout_history->total_payable;?></td>
                                    <td data-label="Tournament:"><a target="_blank" href="<?php echo base_url();?>accounts/payout_details/<?php echo $payout_history->payout_id;?>"><?php echo $payout_history->payout_no;?></a></td>
                                    <td data-label="Stadium:"><a href="javascript:void(0);" onclick="popitup('<?php echo UPLOAD_PATH;?>uploads/payout_receipt/<?php echo $payout_history->receipt;?>');"><?php echo $payout_history->receipt;?></a></td>
                                    <td data-label="City:">Payout #<?php echo $payout_history->payout_id;?> </td>
                                 </tr>
                                 <?php } ?>
                        </tbody>
                     </table>
                        <?php } else {?>
                        <h3>No Payout Histories Available.</h3>
                        <?php } ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- main content End -->
<?php $this->load->view(THEME . 'common/footer'); ?>
<script type="text/javascript">
    function popitup(url,temp='')
   {

      newwindow=window.open(url,'name','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,,height=500,width=700');

      if (window.focus) {newwindow.focus()}
      return false;
   }
</script>