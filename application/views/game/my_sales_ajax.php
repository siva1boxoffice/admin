
					
					<div class="tab_sec" id="no-more-tables">
						<table class="toptable res_table_new table-responsive">
							<tbody>
								<tr class="accordion bor_der">
									<th>Event</th>
									<?php if ($segment == 'upcoming') { ?> <th>Remaining <br>Time</th> <?php } ?>
									<?php if ($segment == 'expired') { ?> <th>Completed <br>Time</th> <?php } ?>
									<th>Tickets <br>Qty</th>
									<th>Orders <br>QTY</th>
									<th class="bg_clr">Not sent / <br>not uploaded</th>
									<th class="bg_clr1">Sent / <br>Uploaded</th>
									<th class="bg_clr2">Delivered / <br>Downloaded</th>
								</tr>
								<?php if (isset($getMySalesData)) {
									foreach ($getMySalesData as $getMySales) {

										$future = strtotime($getMySales->match_date);
										$now = time();
										$timeleft = $future - $now;
										$daysleft = round((($timeleft / 24) / 60) / 60);

										$dateDiff = intval(($future - $now) / 60);
										$hours = intval($dateDiff / 60);
										$minutes = $dateDiff % 60;

										$userTimezone = "Europe/London";
										$timezone = new DateTimeZone($userTimezone);

										$crrentSysDate = new DateTime(date('m/d/y h:i:s a'), $timezone);
										$userDefineDate = $crrentSysDate->format('m/d/y h:i:s a');

										$start = date_create($userDefineDate, $timezone);
										$end = date_create(date('m/d/y h:i:s a', $future), $timezone);

										$diff = date_diff($start, $end);

										/*echo "Year: ".$diff->y."</br>";
				echo "Month: ".$diff->m."</br>";
				echo "Days: ".$diff->d."</br>";
				echo "Hours: ".$diff->h."</br>"; 
				echo "Minutes: ".$diff->i."</br>"; 
				echo "Seconds: ".$diff->s;*/
								?>
										<tr class="bor_der" style="cursor:pointer;" onclick="open_info(<?php echo $getMySales->match_id; ?>);">
											<td data-label="Event:"><?php echo $getMySales->match_name; ?><p><?php echo $getMySales->stadium_name; ?>, <?php echo $getMySales->city_name; ?>, <?php echo $getMySales->country_name; ?></p><span class="tr_date">
													<i class="fa fa-calendar"></i> <?php echo date("d-m-Y", strtotime($getMySales->match_date)); ?> </span><span class="tr_date"><i class="fas fa-clock"></i> <?php echo $getMySales->match_time; ?></span> </td>
											<td data-label="Remaining Time:">

												<span class="bg_clr1"><strong>
														<i class="fa fa-calendar"></i>
														<?php if ($diff->d <= 0) {
															echo str_replace("-", "", $diff->d) . ' Days';
														} else {
															echo $diff->d . ' Days';;
														}
														?></strong></span>

												<span class="bg_clr1"><strong>
														<i class="fas fa-clock"></i>
														<?php echo $diff->h . ':' . $diff->i;
														?></strong></span>

												<!-- <span class="chkdate2"> 
                  		<?php if ($daysleft <= 0) {
											echo 'Expired ' . str_replace("-", "", $daysleft) . ' Days Before';
										} else {
											echo $daysleft . ' days ago';
										} ?>  </span> -->
											</td>
											<td data-label="Tickets Qty:"><strong>
													<?php if ($getMySales->ticket_quantity > 0) {
														echo $getMySales->ticket_quantity;
													} else {
														echo 0;
													} ?></strong></td>
											<td data-label="Orders QTY:">
												<?php if ($getMySales->sold_quantity > 0) {
													echo $getMySales->sold_quantity;
												} else {
													echo 0;
												} ?>
											</td>
											<td data-label="Not sent / not uploaded:" class="bg_clr"><strong><?php echo $getMySales->pending_quantity; ?>(<?php echo $getMySales->sold_quantity; ?>)</strong></td>
											<td data-label="Not sent / not uploaded:" class="bg_clr1"><strong><?php echo $getMySales->available_tickets; ?>(<?php echo $getMySales->sold_quantity; ?>)</strong></td>
											<td data-label="Not sent / not uploaded:" class="bg_clr2"><strong><?php echo $getMySales->download_tickets; ?>(<?php echo $getMySales->available_tickets; ?>)</strong></td>
										</tr>
								<?php  }
								} ?>
							</tbody>
						</table>
					</div>
				