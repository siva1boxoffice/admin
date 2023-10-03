<?php if($stadium_category){
   foreach($stadium_category as $c) {?>
<tr data-id="<?php echo $c->id;?>" data-category="<?php echo $c->category_id;?>">
   <td>
      <div class="grp_clrs">
         <select class="custom-select custom-select-2  stadium_category_by_color " name="<?php echo $c->block_color ;?>"  >
            <option value="">Select Category</option>
            <?php
               if ($getSeatCategory): foreach ($getSeatCategory as $getSeatCat) {
                       ;
                       ?>
            <option value="<?= $getSeatCat->stadium_seat_id ?>" <?php  echo $getSeatCat->stadium_seat_id ==  $c->category_id ? "selected"   : "" ?> > <?= $getSeatCat->seat_category ?></option>
            <?php } endif; ?>
         </select>
      </div>
   </td>
   <td colspan="2">

 <div class="input-group">
  <input class="form-control form-control-map-2 stadium_color" type="text" autocomplete="off" name="stadium_color" value="<?php echo  $c->color_code ;?>"    />
  <div class="input-group-append">
   <input type="color" name="" class="pandi_color mapsvg-region-color" id="">
  </div>
</div>


   </td>
   <!-- <td>
      <input type="color" name="" class="pandi_color mapsvg-region-color" id="">
    <div class="category_picker input-group">
         <span class="input-group-addon"><i id="" style="background:<?php echo $c->color_code ;?>" ></i></span>
         <input type="hidden" class=" input-small form-control mapsvg-region-color" type="text" autocomplete="off"  class="input-small" name="" value="<?php echo $c->color_code ;?>"/>
      </div> -->
   </td> -->
   <td>
      <div class="add_delete_icon">
         <a href="javascript:void(0)" class="delete_category mr-1"><img src="<?php echo base_url('assets/zenith_assets/img/icon_trash.svg');?>" /></a>
         <a href="javascript:void(0)" class="clone_category"><img src="<?php echo base_url('assets/zenith_assets/img/icon_add_circle.svg');?>" /></a>
      </div>
   </td>
</tr>
<?php } } else{ ?>
<tr><td class="text-center" colspan="4">No Records</td></tr>
<?php }?>