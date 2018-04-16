<div class="modal fade" id="clear-penalty-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button class="close" data-dismiss="modal" title="Close this form">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Payment Information</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="penalty-id"/>
					<label for="receipt-number">Receipt No:</label>
					<input type="text" id="receipt-number" name="receipt-number" class="form-control" maxlength="10"/>
					<label for="date-paid">Date Paid:</label>
					<input type="date" id="date-paid" name="date-paid" class="form-control"/>
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
				<button class="btn btn-success" id="clear-penalty" onclick="clearPenalty()">Yes</button>
			</div>

		</div>
	</div>
</div>