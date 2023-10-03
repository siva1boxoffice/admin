<style type="text/css">
a {
  color: inherit; /* blue colors for links too */
  text-decoration: inherit; /* no underline */
}
</style>
<?php 

if(!empty($match_data)){ ?>
<h3><?php echo count($match_data);?> Events Found</h3>
<table class="toptable res_table_new table-responsive">
<tbody>
<tr class="accordion ui-accordion ui-widget ui-helper-reset">
<th>Select</th>
<th>Event Name</th>
<th>Event Date</th>
<th>Tournament Name</th>
</tr>
<?php foreach ($match_data as $peky => $match) { ?>
<tr>
<td data-label="SELECT:">
    <div class="flex-table-cell is-checkbox">
        <label class="checkbox">
            <input class="payable_order" type="checkbox" checked="checked" name="tixstock_id[]" value="<?php echo $match->tixstock_id;?>">
            <span></span>
        </label>
    </div>
</td>
<td data-label="Event Name:"><?php echo $match->match_name;?></td>
<td data-label="Event Date:"><?php echo $match->match_date;?> <?php echo $match->match_time;?></td>
<td data-label="Tickets:"><?php echo $match->tournament_name;?></td>
</tr>

<?php } ?>
</tbody>
</table>
<?php } else{ ?>
    <h3>0 Events Found</h3>
<?php } ?>