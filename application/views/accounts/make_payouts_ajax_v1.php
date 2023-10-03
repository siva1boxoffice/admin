<style type="text/css">
a {
  color: inherit; /* blue colors for links too */
  text-decoration: inherit; /* no underline */
}
</style>
<?php if(!empty($payable_orders)){ ?>
<h3><?php echo count($payable_orders);?> Orders Found</h3>
<table class="toptable res_table_new table-responsive">
<tbody>
<tr class="accordion ui-accordion ui-widget ui-helper-reset">
<th>Select</th>
<th>Order ID</th>
<th>Event Name</th>
<th>Buyer</th>
<th>Ticket Type</th>
<th>Tickets</th>
<th>Total Ticket(s) Price</th>
<th>Order Status</th>
</tr>
<?php foreach ($payable_orders as $peky => $payable_order) { ?>
<tr>
<?php if($peky == 0){?>
<input type="hidden" name="payable_seller" value="<?php echo $payable_order->seller_id;?>">
<?php } ?>
<td data-label="SELECT:">
    <div class="flex-table-cell is-checkbox">
        <label class="checkbox">
            <input class="payable_order" type="checkbox" checked="checked" name="payable_order[]" value="<?php echo $payable_order->bg_id;?>">
            <span></span>
        </label>
    </div>
</td>
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
    <?php if($payable_order->booking_status == '1'){?><span class="success">CONFIRMED</span><?php } ?>
    <?php if($payable_order->booking_status == '2'){?><span class="cancel">PENDING</span><?php } ?>
    <?php if($payable_order->booking_status == '3'){?><span class="cancel">CANCELLED</span><?php } ?>
    <?php if($payable_order->booking_status == '4'){?><span class="success">SHIPPED</span><?php } ?>
    <?php if($payable_order->booking_status == '5'){?><span class="success">DELIVERED</span><?php } ?>
    <?php if($payable_order->booking_status == '6'){?><span class="success">DOWNLOADED</span><?php } ?>
</td>
</tr>

<?php } ?>
</tbody>
</table>
<?php } else{ ?>
    <h3>0 Orders Found</h3>
<?php } ?>