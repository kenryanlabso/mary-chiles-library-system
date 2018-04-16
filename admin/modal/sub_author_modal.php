<div class="modal fade" id="sub-author-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Sub Authors</h4>
			</div>

			<div class="modal-body">
				
				<label>Authors:</label>
				<!--Sub Author Choices-->
				<table width="100%">
					<tr>
						<td>
							<div class="sub-authors-dropdown"></div>
						</td>
						<td width="50">
							<button class="btn btn-success pull-right" id="add-sub-author" title="Add Author">
								<span class="glyphicon glyphicon-ok-sign"></span>
							</button>
						</td>
					</tr>
				</table>
				<!--/Sub Author Choices-->

				<label id="sub-authors-label">Contributors:</label>
				<div class="sub-authors-group"></div>
				
			</div>			

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-author-response">
				<span class="fa fa-check"></span>&nbsp;Sub-author Added!
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>