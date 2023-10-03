<?php $this->load->view('common/header'); ?>
<style type="text/css">
	.order_inf a.active {
    background: #272357 !important;
    color: #fff !important;
}
</style>
<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Order List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
	<div class="page-content-wrapper">
		<div class="page-content is-relative business-dashboard course-dashboard">
			   <div class="my_listings" >
        <div class="container_new">
          <div class="tab_head">
            <h2>My Sales</h2>
                <div class="list_button order_inf">
                  <a href="<?php echo base_url();?>game/orders/my_sales/upcoming" class="user_buts <?php if($segment == 'upcoming'){?> active <?php } ?>">Future Events</a>
                  <a href="<?php echo base_url();?>game/orders/my_sales/expired" class="user_buts <?php if($segment == 'expired'){?> active <?php } ?>">Past Events</a>
                  <a data-panel="activity-panel" class="user_buts  right-panel-trigger">
								<i class="far fa-filter"></i>Advanced Filter </a>
                </div>
          </div>
          <div class="tab_sec" id="no-more-tables">
            <table class="toptable res_table_new table-responsive">
              <tbody>
                <tr class="accordion bor_der">
                  <th>Event</th>
                  <?php if($segment == 'upcoming'){?> <th>Remaining <br>Time</th> <?php } ?>
                  <?php if($segment == 'expired'){?> <th>Completed <br>Time</th> <?php } ?>
                  <th>Tickets <br>Qty</th>
                  <th>Orders <br>QTY</th>
                  <th class="bg_clr">Not sent / <br>not uploaded</th>
                  <th class="bg_clr1">Sent / <br>Uploaded</th>
                  <th class="bg_clr2">Delivered / <br>Downloaded</th>
                </tr>
				<?php if(isset($getMySalesData)){
				foreach($getMySalesData as $getMySales){

				$future = strtotime($getMySales->match_date);
				$now = time();
				$timeleft = $future-$now;
				$daysleft = round((($timeleft/24)/60)/60); 

				$dateDiff = intval(($future-$now)/60);
				$hours = intval($dateDiff/60);
				$minutes = $dateDiff%60;

				$userTimezone = "Europe/London";
				$timezone = new DateTimeZone( $userTimezone );

				$crrentSysDate = new DateTime(date('m/d/y h:i:s a'),$timezone);
				$userDefineDate = $crrentSysDate->format('m/d/y h:i:s a');

				$start = date_create($userDefineDate,$timezone);
				$end = date_create(date('m/d/y h:i:s a', $future),$timezone);

				$diff=date_diff($start,$end);

				/*echo "Year: ".$diff->y."</br>";
				echo "Month: ".$diff->m."</br>";
				echo "Days: ".$diff->d."</br>";
				echo "Hours: ".$diff->h."</br>"; 
				echo "Minutes: ".$diff->i."</br>"; 
				echo "Seconds: ".$diff->s;*/
				?>
                <tr class="bor_der" style="cursor:pointer;" onclick="open_info(<?php echo $getMySales->match_id;?>);">
                  <td data-label="Event:"><?php echo $getMySales->match_name;?><p><?php echo $getMySales->stadium_name;?>, <?php echo $getMySales->city_name;?>, <?php echo $getMySales->country_name;?></p><span class="tr_date">
                  	<i class="fa fa-calendar"></i> <?php echo date("d-m-Y",strtotime($getMySales->match_date));?> </span><span class="tr_date"><i class="fas fa-clock"></i> <?php echo $getMySales->match_time;?></span> </td>
                  <td data-label="Remaining Time:">

                  	<span class="bg_clr1"><strong>
                  		<i class="fa fa-calendar"></i>
                  		<?php if($diff->d <= 0){ 
                  			echo str_replace("-","",$diff->d).' Days';
                  			}
                  			else{ echo $diff->d.' Days';;}
                  		?></strong></span>

                  		<span class="bg_clr1"><strong>
                  			<i class="fas fa-clock"></i>
                  		<?php echo $diff->h.':'.$diff->i;
                  		?></strong></span>

                  	<!-- <span class="chkdate2"> 
                  		<?php  if($daysleft <= 0){ echo 'Expired '.str_replace("-","",$daysleft).' Days Before';} else{ echo $daysleft.' days ago';} ?>  </span> --> </td>
                  <td data-label="Tickets Qty:"><strong> 
                  	<?php  if($getMySales->ticket_quantity > 0){ 
                  		echo $getMySales->ticket_quantity;
                  	} else { echo 0;}?></strong></td>
                  <td data-label="Orders QTY:">
                  	<?php  if($getMySales->sold_quantity > 0){ 
                  		echo $getMySales->sold_quantity;
                  	} else { echo 0;}?>
                  	</td>
                  <td data-label="Not sent / not uploaded:" class="bg_clr"><strong><?php echo $getMySales->pending_quantity;?>(<?php echo $getMySales->sold_quantity;?>)</strong></td>
                  <td data-label="Not sent / not uploaded:" class="bg_clr1"><strong><?php echo $getMySales->available_tickets;?>(<?php echo $getMySales->sold_quantity;?>)</strong></td>
                  <td data-label="Not sent / not uploaded:" class="bg_clr2"><strong><?php echo $getMySales->download_tickets;?>(<?php echo $getMySales->available_tickets;?>)</strong></td>
                </tr>
                <?php  } } ?>
              </tbody>
            </table>
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
						<p>Filter Your Tickets</p>
					</div>
					<form id="filter-formsales" method="post" class="login-wrapper" action="<?php echo base_url(); ?>game/orders/my_sales/upcoming/filter_sales">
						<div class="columns is-multiline">
							<div class="column is-12">
								<div class="field">
									<label>Search Event</label>
									<div class="control">
										<input type="text" name="event" class="input" placeholder="Event">
									</div>
								</div>
							</div>
							<div class="column is-12">
								<div class="field">
									<label>Ticket Category Or Code</label>
									<div class="control">
										<input type="text" name="ticket_category" class="input" placeholder="Ticket Category">
									</div>
								</div>
							</div>
							<div class="column is-12">
								<div class="field">
									<label>Arena Or Stadium</label>
									<div class="control">
										<input type="text" name="stadium" class="input" placeholder="Stadium">
									</div>
								</div>
							</div>


						</div>
						<div class="columns is-multiline">
							<div class="column is-6">
								<div class="field">
									<label>Event Start Date</label>
									<div class="control has-icon">
										<input type="date" name="event_start_date" id="event-start" class="input" placeholder="Select a date" value="<?php echo date("d-m-Y"); ?>">
										<div class="form-icon">
											<i data-feather="calendar"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="column is-6">
								<div class="field">
									<label>Event End Date</label>
									<div class="control has-icon">
										<input type="date" name="event_end_date" id="event-end" class="input" placeholder="Select a date" value="<?php echo date('d-m-Y', strtotime(date("d-m-Y") . ' +1 day')) ?> ">
										<div class="form-icon">
											<i data-feather="calendar"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="column is-12">
								<div class="field">
									<div class="control subcontrol">
										<label class="checkbox">
											<input name="ignore_end_date" type="checkbox" value="1" checked>
											<span></span>
											Ignore Event End Date.
										</label>
									</div>
								</div>
							</div>



							<div class="columns is-multiline">
								<div class="column is-6">
									<div class="field">
										<label>&nbsp;</label>
										<div class="control has-icon">
											<button type="button" id="reset-button" class="reset-button button h-button is-primary is-bold">Reset Search</button>
										</div>
									</div>
								</div>
								<div class="column is-6">
									<div class="field">
										<label>&nbsp;</label>
										<div class="control has-icon">
											<button type="submit" id="salesfilter" class="button h-button is-primary is-bold">Search</button>
										</div>
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
<script type="text/javascript">
	function open_info(match) {

		window.location.href = "<?php echo base_url() . "game/orders/my_sales_details"; ?>/" + match;
	}
</script>

<script>
	$(document).ready(function() {


		bulmaCalendar.attach("#event-start", {
			startDate: new Date('<?php echo date('m/d/Y'); ?>'),
			color: themeColors.primary,
			lang: "en",
			showHeader: false,
			showButtons: false,
			showFooter: false
		});

		bulmaCalendar.attach("#event-end", {
			startDate: new Date('<?php echo date('m/d/Y', strtotime(date("m/d/Y") . ' +1 day')) ?>'),
			color: themeColors.primary,
			lang: "en",
			showHeader: false,
			showButtons: false,
			showFooter: false
		});

		$('.reset-button').on('click', function() {
			$('#filter-formsales').trigger("reset");
			$('.close-panel').trigger("click");
				load_sales('',0);
		})


		load_sales('',0);

	});
</script>
<script src="<?php echo base_url(); ?>assets/js/sales.js"></script>
