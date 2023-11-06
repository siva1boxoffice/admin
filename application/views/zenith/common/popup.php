<div class="modal fade" id="<?php echo $modal_target; ?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content confirm_delivery">
			<div class="modal-header">
				<h4 class="modal-title" id="myCenterModalLabel"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<h5>
					<?php echo $modal_title; ?>
				</h5>
				<p>
					<?php echo $modal_sub_title; ?>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-dismiss="modal">
					<?php echo $modal_cancel; ?>
				</button>
				<button type="button" class="btn btn-primary" id="<?php echo $modal_btn_id; ?>"
					data-close-modal="<?php echo $modal_target; ?>" data-bg-id="<?php echo $data_bg_id; ?>" data-form="<?php echo $data_form; ?>"
					data-status="<?php echo $status; ?>" data-ticket-status="<?php echo $data_status; ?>" data-ticket-type="<?php echo $data_ticket_type; ?>" >
					<?php echo $modal_yes; ?>
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->