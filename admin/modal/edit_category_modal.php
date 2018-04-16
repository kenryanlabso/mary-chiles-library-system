<div class="modal fade" id="edit-category-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Category Information</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="category-id"/>
					<label for="edit-classname">Class Name:</label>
					<input type="text" id="edit-classname" name="edit-classname" class="form-control" maxlength="50"/>
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-category-response">
				<span class="fa fa-check"></span>&nbsp;Category Updated!
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button class="btn btn-success" id="update-category" onclick="updateCategory()">Update</button>
			</div>

		</div>
	</div>
</div>