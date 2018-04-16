<div class="modal fade" id="book-barcode-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog-image" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Book Barcode</h4>
			</div>

			<div class="modal-body">
				<center>
					<div class="barcode-image">
						<img id="view-book-barcode"/>
					</div>
				</center>
			</div>

			<div class="modal-footer">
				<input type="hidden" id="hidden-accession-number"/>
				<button class="btn btn-default" data-dismiss="modal">Close</button>
				<button class="btn btn-success" onclick="printBarcode()">Submit</button>

			</div>

		</div>
	</div>
</div>
</form>