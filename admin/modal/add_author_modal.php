<div class="modal fade" id="add-author-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" onclick="closeAddAuthorModal()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add New Author</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<label for="first-name">First Name:</label>
					<input type="text" id="first-name" name="first-name" class="form-control" maxlength="50" autofocus required/>
					<label for="middle-initial">Middle Initial:</label>
					<input type="text" id="middle-initial" name="middle-initial" class="form-control" maxlength="1" required/>
					<label for="last-name">Last Name:</label>
					<input type="text" id="last-name" name="last-name" class="form-control" maxlength="50" required/>
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-author-response">
				<span class="fa fa-check"></span>&nbsp;Author Successfully Added!
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" onclick="closeAddAuthorModal()">Close</button>
				<button class="btn btn-success" id="add-new-author" onclick="addAuthor()">Save</button>
			</div>

		</div>
	</div>
</div>