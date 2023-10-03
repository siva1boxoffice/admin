<?php //echo "<pre>";print_r($payout_histories);exit;?>
<?php $this->load->view('common/header');?>
<style type="text/css">
    .form-layout_new {
    max-width: 100%;
}
.table_data_payout table td:not([align]),.table_data_payout table th:not([align]) {
    text-align: center;
}
.table_data_payout .toptable tr {
    border-bottom: 1px solid #f1f1f1;
}
.table_data_payout .toptable tr th{font-weight: normal;}
tr.accordion{border-bottom: 1px solid #f1f1f1 !important;}
span.complete {
    background: #f2f2f2;
    font-weight: bold;
    color: #000;
    text-transform: uppercase;
    padding: 3px;
    font-size: 12px;
}
span.success {
    background: #fbbe10;
    font-weight: bold;
    color: #000;
    text-transform: uppercase;
    padding: 3px;
    font-size: 12px;
}
span.cancel {
    background: red;
    font-weight: bold;
    color: #000;
    text-transform: uppercase;
    padding: 3px;
    font-size: 12px;
}
span.confirm {
    background: yellow;
    font-weight: bold;
    color: #000;
    text-transform: uppercase;
    padding: 3px;
    font-size: 12px;
}
.upload_sec {
    padding: 30px 8%;
}
.table_data_payout {
    margin: 0px 0;
    border-bottom: 1px solid #ddd;
    padding: 30px 8%;
}
.choose_option {
    border-bottom: 1px solid #ddd;
    padding: 30px 8%;
}
.upload_sec .buttons {
    float: right;
}
.upload_sec .column.is-3.rit .field {
    float: right;
}
.table_data_payout h3 {
    font-size: 16px;
    margin: 0 0 10px 0px;
}
.upload_sec .buttons .button {
    margin-bottom: 0px;
    margin-top: 5px;
    padding: 10px 10px;
    margin-top: 25px;
    height: 32px;
}
.choose_option .choices[data-type*=select-one] .choices__inner {
    padding-bottom: 0px;
}
.choose_option .choices__inner{padding: 0px;}

.choose_option .control.has-icon .form-icon {
    right: 0 !important;
    height: 32px;
    left: unset;
}
.choose_option .control.has-icon .input {
    padding-left: 10px;
    height: 32px;
}
input[type=checkbox]:checked {
    background-color:#000;
    border-left-color:#06F;
    border-right-color:#06F;
}

.form-fieldset .form-control {
    height: 32px;
    border-radius: 0px;
}
.choices__inner{min-height: 32px;border-radius: 0px !important;}
.choose_option .button.h-button{min-height: 32px;height: 32px;margin-top: 6px;}
.choose_option .button.is-primary{background-color: #00a3ea;}
.table_data_payout .toptable tr th{text-transform: capitalize;text-align: left;}
.table_data_payout table td:not([align]), .table_data_payout table th:not([align]){text-align: left;}
.table_data_payout .toptable th, td{padding: 5px 0;}
.choices__list--single{padding: 0px 16px 0px 4px;}
.radio, .checkbox{padding: 0px;}

.upload_sec .input{height: 32px;}
.radio input+span, .checkbox input+span{width: 15px;height: 15px;}


</style>
        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                       
                         <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">Payout Info</h2>
                                </div>
                            </div>
                           
                              <!--Form Layout 1-->
                        <div class="form-layout form-layout_new">
                            <div class="form-outer">
                                <div class="form-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <div class="fieldset-heading">
                                            <h4>Payment #<?php echo $payout_histories[0]->payout_no;?></h4>
                                        </div>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>accounts/make_payouts_new" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>New Payout</span>
                                                </a>
                                                <!-- <button type="submit" id="branch-form-btn" class="button h-button is-primary is-raised">Confirm Payout</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-body has-loader">

                                      <!--Loader-->
                                            <div class="h-loader-wrapper">
                                                <div class="loader is-small is-loading"></div>
                                            </div>
                                  
                                  
                                    
                                        <div class="table_data_payout" id="payout_orders">
                                           <style type="text/css">
a {
  color: inherit; /* blue colors for links too */
  text-decoration: inherit; /* no underline */
}
</style>
<?php 
$payable_orders = json_decode($payout_histories[0]->payout_orders);

if(!empty($payable_orders)){ ?>
<h3><?php echo count($payable_orders);?> Orders</h3>
<table class="toptable res_table_new table-responsive">
<tbody>
<tr class="accordion ui-accordion ui-widget ui-helper-reset">
<th>Order ID</th>
<th>Event Name</th>
<th>Buyer</th>
<th>Ticket Type</th>
<th>Tickets</th>
<th>Total Ticket(s) Price</th>
<th>Order Status</th>
</tr>
<?php foreach ($payable_orders as $peky => $payable_order) { 
$ci=& get_instance();
$ci->load->model('Accounts_Model');
$payable = $ci->Accounts_Model->get_unpaid_orders_v2(array('bg_id' => $payable_order->bg_id,'payout_status' => 1));
//echo "<pre>";print_r($payable);
    ?>
<tr>
<td data-label="ORDER ID:"><a target="_blank" href="<?php echo base_url();?>game/orders/details/<?php echo md5($payable[0]->booking_no);?>">#<?php echo $payable[0]->booking_no;?></a></td>
<td data-label="Event Name:"><?php echo $payable[0]->match_name;?></td>
<td data-label="Buyer:"><?php echo $payable[0]->first_name;?> <?php echo $payable[0]->last_name;?></td>
<td data-label="Ticket Type:"><?php echo $payable[0]->ticket_type_name;?></td>
<td data-label="Tickets:"><?php echo $payable[0]->quantity;?></td>
<td data-label="Total Ticket(s) Price:">
<?php if($payable[0]->currency_type == "USD"){ ?>
$
<?php } else if($payable[0]->currency_type == "GBP"){ ?>
£
<?php } else if($payable[0]->currency_type == "EUR"){ ?>
€
<?php } ?>
<?php echo number_format($payable[0]->ticket_amount,2);?> </td>
<td data-label="ORDER Status:">
    <?php if($payable[0]->booking_status == '1'){?><span class="success">CONFIRMED</span><?php } ?>
    <?php if($payable[0]->booking_status == '2'){?><span class="cancel">PENDING</span><?php } ?>
    <?php if($payable[0]->booking_status == '3'){?><span class="cancel">CANCELLED</span><?php } ?>
    <?php if($payable[0]->booking_status == '4'){?><span class="success">SHIPPED</span><?php } ?>
    <?php if($payable[0]->booking_status == '5'){?><span class="success">DELIVERED</span><?php } ?>
    <?php if($payable[0]->booking_status == '6'){?><span class="success">DOWNLOADED</span><?php } ?>
</td>
</tr>

<?php } ?>
</tbody>
</table>
<?php } ?>
                                        </div>

                                        <div class="upload_sec">
                                        <div class="columns is-multiline">
                                            <div class="column is-4">
                                                <div class="field">
                                                <label>Payout Or Bank Deposit Receipt </label>
                                                <div class="control has-icon">
                                                    <?php if($payout_histories[0]->receipt != ""){?>
                                                    <a style="text-decoration: underline;" target="_blank" href="<?php echo UPLOAD_PATH;?>uploads/payout_receipt/<?php echo $payout_histories[0]->receipt;?>">View Payment Receipt</a>
                                                <?php }else{ ?>
                                                    No Receipt available.
                                                <?php } ?>
                                                </div>
                                            </div>
                                            </div>
                                          
                                            <div class="column is-3 rit">
                                                <div class="field">
                                                    <label>Total Paid</label>
                                                    <div class="control" id="afiliates_div">
                                                     <span id="payable_amount"><?php if($payout_histories[0]->currency == "USD"){ ?>
$
<?php } else if($payout_histories[0]->currency == "GBP"){ ?>
£
<?php } else if($payout_histories[0]->currency == "EUR"){ ?>
€
<?php } ?> <?php echo number_format($payout_histories[0]->total_payable,2);?></span>
                                                            </div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                               
                                    </div>
                                    <!--Fieldset-->
                                    
                                </div>
                            </div>
                        </div>

                      
                    
                    </div>

                <?php $this->load->view('common/footer');?>
               
<?php exit;?>
