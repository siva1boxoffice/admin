<?php if(!empty($api_categories)){ 

foreach($api_categories as $api_category){
    // echo "<pre>";

    // print_r($tixstock_category);
    // echo "</pre>";
?>
<li><?php echo $api_category->category;?>
<input type="hidden" name="api_category[]" value="<?php echo $api_category->id;?>" >
</li>

<?php } } else{ ?>
   <!--  <div class="category_found">
                                       <p>0 Ticket Categories Found</p>
                                    </div> -->
<?php } ?>

