<div class="modal fade" id="borrow-guest-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Borrow Book</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="guest-id-borrow"/>
					<label for="barcode-id">BarcodeID:</label>
					<table width="100%">
						<tr>
							<td>
								<input type="text" id="barcode-id" name="barcode-id" class="form-control" maxlength="50"/>
							</td>
							<td width="25">
								<button class="btn btn-success" id="borrow-guest" onclick="borrowGuest()">
									<span class="fa fa-check"></span>
								</button>
							</td>
						</tr>
					</table>
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-guest-response">
				<p class="guest-transaction-response"></p>
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>