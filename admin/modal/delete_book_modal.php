<div class="modal fade" id="delete-book-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-warning"></span>&nbsp;WARNING: Delete Book</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="accession-id"/>
					<label for="delete-reason">Reason:</label>
					<select id="delete-reason" name="delete-reason" class="form-control">
						<option></option>
						<option value="Damaged">Damaged</option>
						<option value="Lost">Lost</option>
						<option value="Old">Old</option>
					</select>
					<label for="delete-remarks">Remarks:</label>
					<textarea id="delete-remarks" name="delete-remarks" class="form-control" maxlength="100"></textarea>
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-book-response">
				<span class="fa fa-check"></span>&nbsp;Book Deleted!
			</div>
			
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">No</button>
				<button class="btn btn-success" id="delete-book" onclick="deleteBook()">Yes</button>
			</div>

		</div>
	</div>
</div>