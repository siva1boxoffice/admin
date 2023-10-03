<div class="field">
<label>Choose Orders you want to Pay *</label>
<div class="control" id="afiliates_div">
<select class="roleuser form-control" name="orders[]" id="orders" multiple required>
   <?php foreach ($payable_orders as $payable_order) { ?>
            <option value="<?php echo $payable_order->bg_id;?>" selected><?php echo $payable_order->booking_no;?></option>
  <?php } ?>
</select>
</div>
</div>
<script type="text/javascript">
     var multipleCancelButton = new Choices('#orders', {
                        removeItemButton: !0 ,
            });

    var firstElement = document.getElementById('orders');
                    firstElement.addEventListener(
  'change',
  function(event) { 
      re_arrange_fee();
  },
  false,
);
function re_arrange_fee() {
 
                    var seller_id   = $('#sellers').val();
                    var order_from  = $('#pickaday-datepicker-one').val();
                    var order_to    = $('#pickaday-datepicker-two').val();
                    var orders  = $('#orders').val();
                    var action = "<?php echo base_url();?>accounts/re_arrange_fee";
                    $.ajax({
                    type: "POST",
                    url: action,
                    data: {"orders" : orders},
                    cache: false,
                    dataType: "json",

                    success: function(data) {

                    //$('#order_element').html(data.response.list_orders);
                    $('#payable_amount').text(data.response.base_currency+' '+ data.response.payable_amount);


                    }
                    })
}
</script>