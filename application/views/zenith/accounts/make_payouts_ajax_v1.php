<style type="text/css">
a {
  color: inherit; /* blue colors for links too */
  text-decoration: inherit; /* no underline */
}
</style>
<?php if(!empty($payable_orders)){ ?>
<h3><?php echo count($payable_orders);?> Orders Found</h3>
<table id="basic-datatable" class="table  table-hover table-nowrap mb-0">
<thead class="thead-light">
<tr>
<th>Select</th>
<th>Order ID</th>
<th>Event Name</th>
<th>Buyer</th>
<th>Ticket Type</th>
<th>Tickets</th>
<th>Total Price</th>
<th>Order Status</th>
</tr>
</thead>
<tbody>
<?php foreach ($payable_orders as $peky => $payable_order) { ?>
<tr>
<?php if($peky == 0){?>
<input type="hidden" name="payable_seller" value="<?php echo $payable_order->seller_id;?>">
<?php } ?>
<td tabindex="0" class="dt-checkboxes-cell" style=""><div class="form-check custom-checkbox"><input type="checkbox" class="payable_order form-check-input dt-checkboxes" name="payable_order[]" checked="checked" value="<?php echo $payable_order->bg_id;?>"><label class="form-check-label">&nbsp;</label></div></td>

<td data-label="ORDER ID:"><a target="_blank" href="<?php echo base_url();?>game/orders/details/<?php echo md5($payable_order->booking_no);?>">#<?php echo $payable_order->booking_no;?></a></td>
<td data-label="Event Name:"><?php echo $payable_order->match_name;?></td>
<td data-label="Buyer:"><?php echo $payable_order->first_name;?> <?php echo $payable_order->last_name;?></td>
<td data-label="Ticket Type:"><?php echo $payable_order->ticket_type_name;?></td>
<td data-label="Tickets:"><?php echo $payable_order->quantity;?></td>
<td data-label="Total Ticket(s) Price:">
<?php if($payable_order->currency_type == "USD"){ ?>
$
<?php } else if($payable_order->currency_type == "GBP"){ ?>
£
<?php } else if($payable_order->currency_type == "EUR"){ ?>
€
<?php } ?>
<?php echo number_format($payable_order->ticket_amount,2);?> </td>
<td data-label="ORDER Status:">
     <div class="bttns">
    <?php if($payable_order->booking_status == '1'){?><span class="badge badge-success">CONFIRMED</span><?php } ?>
    <?php if($payable_order->booking_status == '2'){?><span class="badge badge-danger">PENDING</span><?php } ?>
    <?php if($payable_order->booking_status == '3'){?><span class="badge badge-danger">CANCELLED</span><?php } ?>
    <?php if($payable_order->booking_status == '4'){?><span class="badge badge-success">SHIPPED</span><?php } ?>
    <?php if($payable_order->booking_status == '5'){?><span class="badge badge-success">DELIVERED</span><?php } ?>
    <?php if($payable_order->booking_status == '6'){?><span class="badge badge-success">DOWNLOADED</span><?php } ?>
</div>
</td>
</tr>

<?php } ?>
</tbody>
</table>
<?php } else{ ?>
    <h3>0 Orders Found</h3>
<?php } ?>