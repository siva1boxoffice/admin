<style>
   .highlighted {
color: #00a3ed !important;
}
 .tooltip_texts .fa-copy {
    font-size: 16px;
}
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

                

                  <div class="table-responsive">
                      <?php if(isset($payout_histories)){?>
                     <table style='width:100% !important' id="sales-datatable"
                        class="table table-hover table-nowrap mb-0 sales-summary-class">
                        <thead class="thead-light">
                            <tr class="accordion">
                            <th>Payout Date</th>
                            <?php if ($this->session->userdata('role') == 6) { ?>
                            <th>Seller/Partner/Affiliate</th>
                            <?php } ?>
                            <th>Total Orders</th>
                            <th>Amount</th>
                            <th>Payout Txn Id</th>
                            <th>Payout Acc.</th>
                            <th>Txn Receipt</th>
                            <th>Description</th>
                            <!--     <th>&nbsp;</th> -->
                            </tr>
                        </thead>
                        <tbody>
                              <?php foreach($payout_histories as $payout_history){?>
                         <tr>
                                    <td><span class=""> <?php echo date('D j F Y',strtotime($payout_history->paid_date_time));?></span>  <span class=""><?php echo date('H:i A',strtotime($payout_history->paid_date_time));?></span></td>
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
                                    <td data-label="Acc:" style="text-align:center;" >


<?php 
                                      if($payout_history->beneficiary_name != ""){ ?>

                                     <a class="tooltip_texts" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php 
                                      if($payout_history->beneficiary_name != ""){
                                        echo 'Beneficiary name :'.@$payout_history->beneficiary_name;echo "<br>";
                                        echo 'Account No :'.@$payout_history->account_number;
                                        echo "<br>";
                                        echo 'Bank :'.@$payout_history->bank_name.','.@  $payout_history->bank_address;
                                        echo "<br>";
                                        echo 'Currency :'.@$payout_history->currency;
                                      }
                                      ?>" data-html="true" id="copy_order_id"  ><i class="far fa-copy" onclick="copy_data('copy_order_id',this)" ></i></a>
<?php } ?>

                                       </td>
                                    <td data-label="Stadium:"><a href="javascript:void(0);" onclick="popitup('<?php echo UPLOAD_PATH;?>uploads/payout_receipt/<?php echo $payout_history->receipt;?>');"><?php if($payout_history->receipt!="") echo "View";?> </a></td>
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

    $(document).ready(function() {


         $("#content_1").mCustomScrollbar({
            scrollButtons:{
            enable:true
            }
         });

       

    });

    function copy_data(id, element){
      
  element.classList.add('highlighted');
  var copyText = document.getElementById(id);
  var originalTitle = copyText.getAttribute('data-original-title');
  var textArea = document.createElement("textarea");
  textArea.value = originalTitle.replace(/<br>/g, '\n');
  document.body.appendChild(textArea);
  textArea.select();
  document.execCommand("Copy");
  textArea.remove();
	}

</script>