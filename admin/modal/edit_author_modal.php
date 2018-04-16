<div class="modal fade" id="edit-author-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Author Name</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="author-id"/>
					<label for="edit-firstname">First Name:</label>
					<input type="text" id="edit-firstname" name="edit-firstname" class="form-control" maxlength="50" required/>
					<label for="edit-middle-initial">Middle Initial:</label>
					<input type="text" id="edit-middle-initial" name="edit-middle-initial" class="form-control" maxlength="1" required/>
					<label for="edit-lastname">Last Name:</label>
					<input type="text" id="edit-lastname" name="edit-lastname" class="form-control" maxlength="50" required/>
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-author-response">
				<span class="fa fa-check"></span>&nbsp;Author Successfully Updated!
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button class="btn btn-success" id="update-author" onclick="updateAuthor()">Update</button>
			</div>

		</div>
	</div>
</div>