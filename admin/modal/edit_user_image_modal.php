<form id="user-image-update" method="POST" enctype="multipart/form-data"action="action/update_image.php?page=user">

	<div class="modal fade" id="user-image-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" id="modal-dialog-image" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Update User Image</h4>
				</div>

				<div class="modal-body">
					<img id="view-user-image" src="uploads/users/default.png" class="modal-image"/>
					<input type="file" id="user-image" name="user-image" class="form-control" required/>
					<input type="hidden" id="user-id" name="user-id"/>
				</div>

				<div class="modal-image-loader">
					<span class="fa fa-spinner fa-spin"></span>
				</div>

				<div class="modal-image-response">
					<span class="fa fa-check"></span>&nbsp;Photo Updated!
				</div>

				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success" id="update-image">Upload</button>
				</div>

			</div>
		</div>
	</div>
</form>