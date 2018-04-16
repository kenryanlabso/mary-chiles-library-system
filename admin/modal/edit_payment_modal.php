<div class="modal fade" id="edit-payment-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button class="close" data-dismiss="modal" title="Close this form">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Payment Information</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="edit-penalty-id"/>
					<label for="edit-receipt-number">Receipt No:</label>
					<input type="text" id="edit-receipt-number" name="edit-receipt-number" class="form-control" maxlength="10"/>
					<label for="edit-date-paid">Date Paid:</label>
					<input type="date" id="edit-date-paid" name="edit-date-paid" class="form-control"/>
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-penalty-response">
				<span class="fa fa-check"></span>&nbsp;Penalty Updated!
			</div>
			
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">No</button>
				<button class="btn btn-success" id="update-payment" onclick="updatePaymentInfo()">Yes</button>
			</div>

		</div>
	</div>
</div>