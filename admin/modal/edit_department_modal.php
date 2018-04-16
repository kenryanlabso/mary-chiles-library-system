<div class="modal fade" id="edit-department-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Department Information</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="department-id"/>
					<label for="edit-department-name">Department Name:</label>
					<input type="text" id="edit-department-name" name="edit-department-name" class="form-control" maxlength="50"/>
					<label for="edit-department-description">Department Description:</label>
					<textarea id="edit-department-description" name="edit-department-description" class="form-control"></textarea>
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-department-response">
				<span class="fa fa-check"></span>&nbsp;Successfully Updated!
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button class="btn btn-success" id="update-department" onclick="updateDepartment()">Update</button>
			</div>

		</div>
	</div>
</div>