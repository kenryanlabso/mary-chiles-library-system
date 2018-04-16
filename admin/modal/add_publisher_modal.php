<div class="modal fade" id="add-publisher-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add New Publisher</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<label for="publisher-name">Publisher Name:</label>
					<input type="text" id="publisher-name" name="publisher-name" class="form-control" maxlength="100" autofocus required/>
					<label for="publisher-address">Address:</label>
					<textarea id="publisher-address" name="publisher-address" class="form-control" maxlength="150"></textarea>
					<label for="publisher-contact">Contact Number:</label>
					<input type="text" id="publisher-contact" name="publisher-contact" class="form-control" maxlength="15"/>
					<label for="publisher-email">E-mail Address:</label>
					<input type="text" id="publisher-email" name="publisher-email" class="form-control" maxlength="50"/>
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-publisher-response">
				<span class="fa fa-check"></span>&nbsp;Publisher Successfully Added!
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button class="btn btn-success" id="add-new-publisher" onclick="addPublisher()">Save</button>
			</div>

		</div>
	</div>
</div>