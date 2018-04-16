<div class="modal fade" id="edit-publisher-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Publisher Information</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="publisher-id"/>
					<label for="edit-publisher-name">Publisher Name:</label>
					<input type="text" id="edit-publisher-name" name="edit-publisher-name" class="form-control" maxlength="100" autofocus required/>
					<label for="edit-publisher-address">Address:</label>
					<textarea id="edit-publisher-address" name="edit-publisher-address" class="form-control" maxlength="150"></textarea>
					<label for="edit-publisher-contact">Contact Number:</label>
					<input type="text" id="edit-publisher-contact" name="edit-publisher-contact" class="form-control" maxlength="15"/>
					<label for="edit-publisher-email">E-mail Address:</label>
					<input type="text" id="edit-publisher-email" name="edit-publisher-email" class="form-control" maxlength="50"/>
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-publisher-response">
				<span class="fa fa-check"></span>&nbsp;Publisher Successfully Updated!
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button class="btn btn-success" id="update-publisher" onclick="updatePublisher()">Update</button>
			</div>

		</div>
	</div>
</div>