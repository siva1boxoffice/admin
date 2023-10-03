<h5><?php echo count($api_matches);?> Events Found</h5>
<table class="table">
   <thead>
      <tr >
         <th style="width:150px"><a href="javascript:void(0)" class="select_all">Select All</a> <a href="javascript:void(0)" class="unselect_all" style="display: none;">Unselect All</a></th>
         <th>Event Name</th>
         <th>Event Date</th>
         <th>Ticket Listed</th>
      </tr>
   </thead>
   <tbody>
      <?php foreach ($api_matches as  $key => $list) { //echo "<pre>";print_r($role); 
         ?>
      <tr>
         <td><input type="checkbox" class="input-check" name="match_id[<?php echo $list->m_id;?>]" value="1" data-id="<?php echo $list->m_id;?>" <?php echo $list->events_count  > 0 ? "checked" : "" ?> ></td>
         <td><?php echo $list->match_name; ?></td>
         <td><?php echo date('d-M-Y H:i', strtotime($list->match_date)); ?></td>
         <td><?php echo $list->ticket_status >0 ? '<span class="badge badge-success is-rounded">Yes</span>'  : '<span class="badge badge-danger is-rounded">No</span>' ; ?></td>
      </tr>
      <?php } ?>
   </tbody>
</table>