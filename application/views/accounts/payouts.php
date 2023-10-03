<?php $this
	->load
	->view('common/header'); ?>

<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
	 <div class="banking-dashboard banking-dashboard-v2">

                            <!--Panel-->
                            <div class="dashboard-card is-card-panel">
                                <div class="columns is-gapless">
                                   
                                    <div class="column is-6">
                                        <!--Box-->
                                        <div class="inner-box">
                                            <div class="box-title">
                                                <h3>Balance</h3>
                                            </div>

                                            <!--Balance-->
                                            <div class="card-balance-wrap">
                                                  <?php if($pending_total_orders > 0){?>
                                                <div class="card-balance">
                                                    <span><i class="fas fa-pound-sign"></i> <?php echo $pending_amount;?></span>
                                                 <!--    <span>Your Next Payout between (29.04.2022 to 28.05.2022)</span> -->
                                                </div>
                                                <div class="card-balance-stats">
                                                    <div class="card-balance-stat">
                                                        <div class="stat-title">
                                                            <span>No.Of Payable Orders</span>
                                                        </div>
                                                        <div class="stat-block">
                                                            <div class="stat-icon is-up">
                                                                <i data-feather="arrow-right"></i>
                                                            </div>
                                                            <div class="stat-text">
                                                                <span>+ <?php echo $pending_total_orders;?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                  <?php } else{ ?>
                                                <h3>No Payable Orders.</h3>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                  
                                    <div class="column is-6">
                                        <!--Box-->
                                        <div class="inner-box">
                                            <div class="box-title">
                                                <h3>Last Paid</h3>
                                            </div>

                                            <!--Balance-->
                                            <div class="card-balance-wrap">
                                                  <?php if(isset($payout_histories[0])){?>
                                                <div class="card-balance">
                                                    <span>
                                                    <?php if($payout_histories[0]->currency == 'GBP'){?>
                                                    <i class="fas fa-pound-sign"></i> 
                                                    <?php } ?>
                                                    <?php if($payout_histories[0]->currency == 'EUR'){?>
                                                    <i class="fas fa-euro-sign"></i> 
                                                    <?php } ?>
                                                    <?php echo $payout_histories[0]->total_payable;?>
                                                    </span>
                                                   <span>Paid On <!-- ( --><?php echo date('d-m-Y',strtotime($payout_histories[0]->payout_date_from));?> <!-- to <?php echo date('d-m-Y',strtotime($payout_histories[0]->payout_date_to));?>) --></span>
                                                </div>
                                                <div class="card-balance-stats">
                                                    <div class="card-balance-stat">
                                                        <div class="stat-title">
                                                            <span>Total Payout</span>
                                                        </div>
                                                        <div class="stat-block">
                                                            <div class="stat-icon is-down">
                                                                <i data-feather="arrow-right"></i>
                                                            </div>
                                                            <div class="stat-text">
                                                                <span>+  <?php echo $payout_histories[0]->total_orders;?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else{ ?>
                                                <h3>No Previous Payout History.</h3>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
	<div class="page-content-wrapper">
		<div class="page-content is-relative business-dashboard course-dashboard">
			<div class="page-content-inner">
				 <div class="tab_sec all_pay" id="no-more-tables">
        <?php if(isset($payout_histories)){?>
        <table class="toptable res_table_new table-responsive">
          <tbody>
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
            <?php foreach($payout_histories as $payout_history){?>
            <tr>
              <td data-label="Transaction date:"><span class="tr_date"><i class="fas fa-calendar-week"></i><?php echo date('d-m-Y',strtotime($payout_history->paid_date_time));?> </span><span class="tr_date"><i class="fas fa-clock"></i><?php echo date('h:i',strtotime($payout_history->paid_date_time));?></span> </td>
              <?php if ($this->session->userdata('role') == 6) { ?>
               <td data-label="Tournament:"><?php echo $payout_history->admin_name;?> <?php echo $payout_history->admin_last_name;?></td>
           <?php } ?>
               <td data-label="Tournament:"><?php echo $payout_history->total_orders;?></td>
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
                <?php echo $payout_history->total_payable;?></td>
              <td data-label="Tournament:"><a target="_self" href="<?php echo base_url();?>accounts/payout_details/<?php echo $payout_history->payout_id;?>"><?php echo $payout_history->payout_no;?></a></td>
              <td data-label="Stadium:"><a target="_blank" href="<?php echo UPLOAD_PATH;?>uploads/payout_receipt/<?php echo $payout_history->receipt;?>"><?php echo $payout_history->receipt;?></a></td>
              <td data-label="City:">Payout #<?php echo $payout_history->payout_id;?> </td>
            <!--   <td data-label="City:"><i class="fas fa-angle-double-right"></i></td> -->
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

			<?php $this->load->view('common/footer'); ?>