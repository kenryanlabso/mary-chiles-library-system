<div class="modal fade" id="edit-course-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Course Information</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="course-id"/>
					<label for="edit-course-name">Course Name:</label>
					<input type="text" id="edit-course-name" name="edit-course-name" class="form-control" maxlength="50"/>
					<label for="edit-course-description">Course Description:</label>
					<textarea id="edit-course-description" name="edit-course-description" class="form-control"></textarea>
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-course-response">
				<span class="fa fa-check"></span>&nbsp;Course Successfully Updated!
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button class="btn btn-success" id="update-course" onclick="updateCourse()">Update</button>
			</div>

		</div>
	</div>
</div>