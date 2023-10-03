<?php $this
	->load
	->view('common/header'); ?>

<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
    <div class="page-content-wrapper">

	 <div class="banking-dashboard banking-dashboard-v2">
                        <p style="text-align: right;margin-bottom: 20px;">
                       <!--  <a href="<?php echo base_url(); ?>accounts/download_orders?sale_start_date=<?php echo $_GET['sale_start_date'];?>&sale_end_date=<?php echo $_GET['sale_end_date'];?>&sellers=<?php echo $_GET['sellers'] ? implode(",",$_GET['sellers']) : "";?>&users=<?php echo  $_GET['users'] ?  implode(",", $_GET['users'])  :"" ;?>&tournaments=<?php echo  $_GET['tournaments'] ?  $_GET['tournaments']  :"" ;?>&match_id=<?php echo  $_GET['match_id'] ?   $_GET['match_id']  :"" ;?>"class="button h-button is-primary download_orders"><img src="<?php echo base_url();?>assets/img/icon_excel.svg">&nbsp;&nbsp;Download</a> -->
                        <a data-panel="activity-panel" class="button h-button is-primary is-raised is-bold right-panel-trigger">
                        <i class="fas fa-sliders-h"></i>&nbsp;Advance Filter 
                        </a>
                    </p>

                            <!--Panel-->
                            <div class="dashboard-card is-card-panel">

                                <div class="columns is-gapless">
                                   
                                   

                                    <div class="column is-3">
                                        <!--Box-->
                                        <div class="inner-box">
                                            <div class="box-title">
                                                <h3>Total Sales in USD</h3>
                                            </div>

                                             <!--Balance-->
                                            <div class="card-balance-wrap">
                                                  <?php if(count($getMySalesData) > 0){?>
                                                <div class="card-balance">
                                                    <span><i class="fas fa-usd"></i> 
                                                        <?php echo $total_base_amount = array_sum(array_column($getMySalesData_usd,'total_amount'));?></span>
                                                 <!--    <span>Your Next Payout between (29.04.2022 to 28.05.2022)</span> -->
                                                </div>
                                               <!--  <div class="card-balance-stats">
                                                    <div class="card-balance-stat">
                                                        <div class="stat-title">
                                                            <span>No.Of Orders</span>
                                                        </div>
                                                        <div class="stat-block">
                                                            <div class="stat-icon is-up">
                                                                <i data-feather="arrow-right"></i>
                                                            </div>
                                                            <div class="stat-text">
                                                                <span>+ <?php echo count($getMySalesData_usd);?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                  <?php } else{ ?>
                                                <h3>No Orders.</h3>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="column is-3">
                                        <!--Box-->
                                        <div class="inner-box">
                                            <div class="box-title">
                                                <h3>Total Orders</h3>
                                            </div>

                                             <!--Balance-->
                                            <div class="card-balance-wrap">
                                                  <?php if(count($getMySalesData) > 0){?>
                                                <div class="card-balance">
                                                    <span><i class="fas fa-shopping-cart"></i> 
                                                        <?php echo count($getMySalesData_usd);?></span>
                                                </div>
                                            
                                                  <?php } else{ ?>
                                                <h3>No Orders.</h3>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                  <!--   <div class="column is-3">
                                        <div class="inner-box">
                                            <div class="box-title">
                                                <h3>Total Sales</h3>
                                            </div>
                                            <div class="card-balance-wrap">
                                                  <?php if(count($getMySalesData_usd) > 0){?>
                                                <div class="card-balance">
                                                    <span><i class="fas fa-pound-sign"></i> 
                                                        <?php echo $total_base_amount = array_sum(array_column($getMySalesData_usd,'total_base_amount'));?></span>
                                            
                                                </div>
                                                <div class="card-balance-stats">
                                                    <div class="card-balance-stat">
                                                        <div class="stat-title">
                                                            <span>No.Of Orders</span>
                                                        </div>
                                                        <div class="stat-block">
                                                            <div class="stat-icon is-up">
                                                                <i data-feather="arrow-right"></i>
                                                            </div>
                                                            <div class="stat-text">
                                                                <span>+ <?php echo count($getMySalesData_usd);?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                  <?php } else{ ?>
                                                <h3>No Orders.</h3>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div> -->
                                     <div class="column is-3">
                                        <!--Box-->
                                        <div class="inner-box">
                                            <div class="box-title">
                                                <h3>Total Ticket Sold</h3>
                                            </div>

                                             <!--Balance-->
                                            <div class="card-balance-wrap">
                                                  <?php if(count($getMySalesData_usd) > 0){?>
                                                <div class="card-balance">
                                                    <span><i class="fas fa-bookmark"></i>
                                                        <?php echo $total_base_amount = array_sum(array_column($getMySalesData_usd,'total_quantity'));?></span>
                                                 <!--    <span>Your Next Payout between (29.04.2022 to 28.05.2022)</span> -->
                                                </div>
                                                <div class="card-balance-stats">
                                                    <div class="card-balance-stat">
                                                        <!-- <div class="stat-title">
                                                            <span>Total Ticket</span> -->
                                                        </div>
                                                       <!--  <div class="stat-block">
                                                            <div class="stat-icon is-up">
                                                                <i data-feather="arrow-right"></i>
                                                            </div>
                                                            <div class="stat-text">
                                                                <span> </span>
                                                            </div>
                                                        </div> -->
                                                    <!-- </div> -->
                                                </div>
                                                  <?php } else{ ?>
                                                <h3>0</h3>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="column is-3">
                                        <!--Box-->
                                        <div class="inner-box">
                                            <div class="box-title">
                                                <h3>Total Ticket Pending</h3>
                                            </div>

                                             <!--Balance-->
                                            <div class="card-balance-wrap">
                                                  <?php if(count($getMySalesData_usd) > 0){?>
                                                <div class="card-balance">
                                                    <span><i class="fas fa-bookmark"></i>
                                                        <?php echo $all_total_ticket ;?></span>
                                                 <!--    <span>Your Next Payout between (29.04.2022 to 28.05.2022)</span> -->
                                                </div>
                                                <div class="card-balance-stats">
                                                    <div class="card-balance-stat">
                                                        <!-- <div class="stat-title">
                                                            <span>Total Ticket</span> -->
                                                        </div>
                                                       <!--  <div class="stat-block">
                                                            <div class="stat-icon is-up">
                                                                <i data-feather="arrow-right"></i>
                                                            </div>
                                                            <div class="stat-text">
                                                                <span> </span>
                                                            </div>
                                                        </div> -->
                                                    <!-- </div> -->
                                                </div>
                                                  <?php } else{ ?>
                                                <h3>0</h3>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
	
		<div class="page-content is-relative business-dashboard course-dashboard">
			<div class="page-content-inner">
				 <div class="tab_sec all_pay" id="no-more-tables">
        <?php if(isset($getMySalesData)){  ?>
        <table class="toptable res_table_new table-responsive">
          <tbody>
            <tr class="accordion">
             <th>Tournament Name</th>
              <th>Match Name</th>
              <th>Tickets listed </th>
              <th>Tickets sold </th>
              <th>Remaining </th>
              <th>Total amount</th>
              <th>&nbsp;</th>
            </tr>
            <?php
                $total_ticket = 0;
                $total_sell_ticket = 0;
                $total_reaming_ticket = 0;
             foreach($getMySalesData as $getMySales){

                $ticket_total_quality = $this->General_Model->get_total_ticket($getMySales->match_id)->total;

                $total_ticket += $ticket_total_quality + $getMySales->total_quantity ;
                $total_sell_ticket +=  $getMySales->total_quantity;
                $total_reaming_ticket +=  $ticket_total_quality ;
                ?>
            <tr>
                <td data-label="Tournament:"><?php echo $getMySales->tournament_name; ?><br></td>
                 <td data-label="Match Name:"><?php echo $getMySales->match_name; ?><br>
                    <p><?php echo $getMySales->country_name . ', ' . $getMySales->city_name; ?></p>
                 
                    <span class="tr_date"><i class="fas fa-calendar"></i> <?php echo $getMySales->match_date; ?></span> <span class="tr_date"><i class="fas fa-clock"></i><?php echo $getMySales->match_time; ?></span>
                </td>
            
            <td data-label="Tickets listed:"><?php echo $ticket_total_quality  + $getMySales->total_quantity ?></td>
              <td data-label="Tickets sold:"><?php echo $getMySales->total_quantity;?></td>
              <td data-label="Remaining:"><?php echo ($ticket_total_quality  ) ?>  </td>
         

                            <td data-label="Total Price:">
                <?php if($getMySales->currency_type == 'GBP'){?>
                <i class="fas fa-pound-sign"></i> 
                <?php } ?>
                <?php if($getMySales->currency_type == 'EUR'){?>
                <i class="fas fa-euro-sign"></i> 
                <?php } ?>
                 <?php if($getMySales->currency_type == 'USD'){?>
                <i class="fas fa-usd"></i> 
                <?php } ?>
               <?= number_format($getMySales->summary_amount,2) ?> </td>
              <td data-label="ORDER DETAILS:"><a target="_blank" href="<?php echo base_url();?>accounts/sales_summary?match_id=<?php echo $getMySales->match_id;?>"><i class="fas fa-angle-double-right"></i></a></td>
            <!--   <td data-label="City:"><i class="fas fa-angle-double-right"></i></td> -->
            </tr>
        <?php } ?>
        <tr>
              <td></td>
            <td></td>
            <td ><?php echo $total_ticket;?></td>
            <td ><?php echo $total_sell_ticket;?></td>
            <td ><?php echo $total_reaming_ticket;?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
          </tbody>
        </table>
    <?php } else {?>
        <h3>No Sales Histories Available.</h3>
    <?php } ?>
        <div class="pagination datatable-pagination pagination-datatables flex-column">
        <?php echo $pagination; ?>
        </div>
      </div>
			</div>
		</div>
	</div>
</div>

<div id="activity-panel" class="right-panel-wrapper is-activity">
    <div class="panel-overlay"></div>
    <input type="hidden" name="search_flag" id="search_flag" value="listing">
    <div class="right-panel">
        <div class="right-panel-head">
            <h3>Advance Sales Filter</h3>
            <a class="close-panel">
                <i data-feather="chevron-right"></i>
            </a>
        </div>
        <div class="right-panel-body has-slimscroll">
            <div class="languages-boxes">
                <div class="form-fieldset">
                    <div class="fieldset-heading">
                        <h4>Filter</h4>
                        <p>Filter Your Sales</p>
                    </div>
                    <form id="order-form" method="get" class="login-wrapper" action="<?php echo base_url(); ?>accounts/tournament_sales_summary">
                        <div class="columns is-multiline">
                            <div class="column is-6">
                                <div class="field">
                                    <label>Search Event</label>
                                    <div class="control">
                                         <input type="date" name="sale_start_date" id="sale-start" class="input" placeholder="Select a date" value="<?php echo $_GET['sale_start_date'];?>">
                                    </div>
                                </div>
                            </div>
                           <div class="column is-6">
                                <div class="field">
                                    <label>Search Event</label>
                                    <div class="control">
                                        <input type="date" name="sale_end_date" id="sale-start" class="input" placeholder="Select a date" value="<?php echo $_GET['sale_end_date'];?>">
                                    </div>
                                </div>
                            </div>

                            <div class="column is-12">
                                <div class="field">
                                    <label>Customer</label>
                                    <div class="control">
                                        <select name="users[]" multiple class="form-control "  id="demo-2">
                                            <option  value="">Select Customer</option>
                                              <?php foreach ($customers as $value) { ?>
                                                 <option value="<?php echo $value->id;?>"><?php echo $value->first_name;?> <?php echo $value->last_name;?> (<?php echo $value->email;?> )</option>
                                              <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                             <div class="column is-12">
                                <div class="field">
                                    <label>Seller</label>
                                    <div class="control">
                                         <select  id="demo-3" multiple class="form-control sellers3" name="sellers[]">
                                                 <option value="">Select Seller</option>
                                                 <?php foreach ($sellers as $seller) { ?>
                                                 <option value="<?php echo $seller->admin_id;?>"><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?></option>
                                              <?php } ?>
                                             </select>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="column is-12">
                                <div class="field">
                                    <label>Tournament</label>
                                    <div class="control">
                                         <select  id="tournaments"  class="form-control tournaments" name="tournaments">
                                                 <option value="">Select Tournament</option>
                                                 <?php foreach ($tournaments as $row) { ?>
                                                 <option value="<?php echo $row->id;?>"><?php echo $row->tournament_name;?></option>
                                              <?php } ?>
                                             </select>
                                    </div>
                                </div>
                            </div> -->

                           <!--  <div class="column is-12">
                                <div class="field">
                                    <label>Matches</label>
                                    <div class="control">
                                         <select  id="match_id"  class="form-control match_id" name="match_id">
                                                 <option value="">Please Select First Tournament</option>
                                                
                                             </select>
                                    </div>
                                </div>
                            </div> -->

                        </div>
                        <div class="columns is-multiline">
                           
                          
                            
                            <div class="column is-12">
                                    <div class="field srch_btn">
                                        <label>&nbsp;</label>
                                        <div class="control has-icon">
                                            <button type="submit" id="next-button" class="button h-button is-primary is-bold">Search</button>
                                        </div>
                                    </div>
                                </div>



                           
                    </form>
                </div>

            </div>

        </div>
    </div>

 </div>

			<?php $this->load->view('common/footer'); ?>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
            <script type="text/javascript">
                 $(document).ready(function() {
                    // $("#users").select2({ tags: true,
                    //     placeholder: "Select an Option",
                    //     allowClear: true,
                    //     width: '100%'});


                    var secondElement = new Choices('#demo-2', { allowSearch: true });

                     var secondElement2 = new Choices('#demo-3', { allowSearch: true });

                     var secondElement2 = new Choices('#tournaments', { allowSearch: true });
                });
                //  $(".sellers3").select2();

                var baseURL = "<?php echo base_url();?>";
 
                  $(document).ready(function(){
                 
                    // City change
                    $('.tournaments').change(function(){
                      var tournament = $(this).val();

                      // AJAX request
                      $.ajax({
                        url:'<?=base_url()?>accounts/get_matches',
                        method: 'post',
                        data: {tournament: tournament},
                        dataType: 'json',
                        success: function(response){

                         $(".match_id").empty();
                          $.each(response,function(index,data){
                             $('.match_id').append('<option value="'+data['id']+'">'+data['match_name']+'</option>');
                          });
                        }
                     });
                   });
                        });
                 

            </script>