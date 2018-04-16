<div class="modal fade" id="edit-book-byid-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Book Information</h4>
			</div>

			<div class="modal-body">

				<label for="accession-id">Accession Number:</label>
				<input type="text" id="accession-id" name="accession-id" class="form-control" readonly/>

				<label for="call-no">Call Number:</label>
				<input type="text" id="call-no" name="call-no" class="form-control" disabled/>

				<label for="book-title">Book Title:</label>
				<input type="text" id="book-title" name="book-title" class="form-control" disabled/>

				<label for="fund-source">Source of Funds:</label><br/>
				<select id="fund-source" name="fund-source" class="form-control" required>
					<option value="Purchased">Purchased</option>
					<option value="Complementary">Complementary</option>
					<option value="Donated">Donated</option>
				</select>

				<div class="book-form-response">
					<span class="fa fa-check"></span>&nbsp;Successfully Added!
				</div>			
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-book-response">
				<span class="fa fa-check"></span>&nbsp;Book Successfully Updated!
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button class="btn btn-success" id="update-book-byid" onclick="updateBookById()">Update</button>
			</div>

		</div>
	</div>
</div>