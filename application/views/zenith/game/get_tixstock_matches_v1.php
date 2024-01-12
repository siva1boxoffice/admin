<?php 

if(!empty($match_data)){ ?>
<table id="basic-datatable" class="table  table-hover table-nowrap mb-0">
<thead class="thead-light">
<tr>
<th>Select</th>
<th>Add to 1boxoffice</th>
<th>Event</th>
<th>Tournament</th>
<th>Stadium</th>
<th>Date & Time</th>
<th>Tickets</th>
<th>Status</th>
<th>Event Found</th>
</tr>
</thead>
<tbody>
<?php foreach ($match_data as $peky => $match) { ?>

    <tr>
                                                <td tabindex="0" class="dt-checkboxes-cell" style=""><div class="form-check custom-checkbox"><input type="checkbox" name="event_id[]" <?php if($match->match_found == 1){ ?>checked <?php }else{?> disabled <?php } ?>class="form-check-input dt-checkboxes" value="<?php echo $match->api_data_id;?>"><label class="form-check-label">&nbsp;</label></div></td>
                                                <td tabindex="0" class="dt-checkboxes-cell" style=""><div class="form-check custom-checkbox"><input type="checkbox" name="add_event_id[]" <?php if($match->match_found == 0){ ?>checked <?php }else{?> disabled <?php } ?>class="form-check-input dt-checkboxes" value="<?php echo $match->api_data_id;?>"><label class="form-check-label">&nbsp;</label></div></td>
                                                <td><?php echo $match->event_name;?>
                                                </td>
                                                <?php if(@$match->tournament_name != "" && $match->category_name == ""){?>
                                                <td><?php echo $match->tournament_name;?></td>
                                                <?php } ?>
                                                 <?php if(@$match->tournament_name == "" && $match->category_name != ""){?>
                                                <td><?php echo $match->category_name;?></td>
                                                <?php } ?>
                                                <td><?php echo $match->stadium_name;?></td>
                                                <td><?php echo $match->match_date_time;?></td>
                                                <td><?php echo $match->tickets;?></td>
                                                <td>
                                                <div class="bttns">
                                                <?php if($match->event_merge_status == 0){ ?>
                                                <span class="badge badge-danger">Not Sync</span>
                                                <?php } else if($match->event_merge_status == 1){ ?>
                                                <span class="badge badge-success">Sync</span>
                                                <?php } ?>
                                                </div>
                                                </td>
                                                <td>
                                                   <div class="bttns">
                                               <?php if($match->match_found == 0){ ?>
                                                <span class="badge badge-danger">Not Found</span>
                                                <?php } else if($match->match_found == 1){ ?>
                                                <span class="badge badge-success">Found</span>
                                                <?php } ?>
                                                </td>
                                             </tr>



<?php } ?>
</tbody>
</table>
<?php } else{ ?>
    <h3>0 Events Found</h3>
<?php } ?>