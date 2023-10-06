
<?php
$i = 0;
foreach($api_categories as $api_category){ //echo "<pre>";print_r($boxoffice_categories);exit;
    ?>
<div class="form-group">
    <?php if($i == 0){?>
<input type="hidden" name="stadium_id" value="<?php echo $api_category->stadium_id;?>">
<label for="example-select">1BoxOffice Ticket Category</label>
<?php } ?>
<select class="custom-select" id="example-select" name="boxoffice_category[]" >
<option>Choose Category</option>
<?php if(!empty($boxoffice_categories)){ 

foreach($boxoffice_categories as $boxoffice_category){
   $exists = $this->General_Model->get_stadium_category($api_category->id,$boxoffice_category->boxoffice_category,$api_source,$boxoffice_category->stadium_id)->num_rows();
?>
<option title="<?php echo $exists;?><?php echo $api_category->id;?>- <?php echo $boxoffice_category->api_category;?>" value="<?php echo $boxoffice_category->stadium_seat_id;?>" <?php  if(($exists == 1)){?> selected="selected" <?php } ?>><?php echo $boxoffice_category->seat_category;?></option>
<?php } } ?>

</select>
</div>
<?php $i++;} ?>
                                    