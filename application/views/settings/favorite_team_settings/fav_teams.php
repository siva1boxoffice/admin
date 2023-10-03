
<div class="field">
<label>Choose Teams *</label>
<div class="control" id="afiliates_div">
<select class="roleuser form-control" name="teams[]" id="teams" multiple required>
<?php foreach ($fav_teams as $fav_team) { ?>
<option value="<?php echo $fav_team->team_id;?>" <?php if(in_array($fav_team->team_id,$teams)){?> selected <?php }?>><?php echo $fav_team->team_name;?></option>
<?php } ?>
</select>
</div>
</div>
<script type="text/javascript">
     var multipleCancelButton = new Choices('#teams', {
                        removeItemButton: !0 ,
            });
</script>