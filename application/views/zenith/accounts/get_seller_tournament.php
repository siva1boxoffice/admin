<select  id="tournaments_<?php echo $seller;?>"  class="form-control tournaments" name="tournaments" onchange="get_tournament_matches(this.value);">
<option value="">Select Tournament</option>
<?php foreach ($tournaments as $row) { ?>
<option value="<?php echo $row->value;?>" <?php echo @$default == $row->value  ? "selected" :"" ;?> ><?php echo $row->label;?></option>
<?php } ?> 
</select>