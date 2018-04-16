<div class="modal fade" id="edit-book-author-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Authors</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">
					
					<table class="book-authors-table">
						<tr>
							<td></td>
							<td>
								<button class="btn btn-success btn-xs pull-right" onclick="addAuthorModal()" title="Add new author" style="margin-bottom:10px;"><span class="fa fa-plus"></span></button>
							</td>
						</tr>
						<tr>
							<td>
								<div class="authors-dropdown"></div>
							</td>
							<td>
								&nbsp;<button class="btn btn-success" onclick="addBookAuthor()" title="Select Author"><span class="fa fa-check"></span></button>
							</td>
						</tr>
						<tr>
							<td colspan="2"><label>Authors:</label></td>
						</tr>
					</table>
					<input type="hidden" id="max-index" name="max-index"/>
					<input type="hidden" id="ids-text" name="ids-text"/>
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-book-response">
				<span class="fa fa-check"></span>&nbsp;Authors Successfully Updated!
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button class="btn btn-primary" id="update-publisher" onclick="updateBookAuthors()">Update</button>
			</div>

		</div>
	</div>
</div>