<div class="modal fade" id="delete-category-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-warning"></span>&nbsp;WARNING!</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="category-id"/>
					Are you sure you want to delete this category?
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-category-response">
				<span class="fa fa-check"></span>&nbsp;Category Deleted!
			</div>
			
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">No</button>
				<button class="btn btn-success" id="delete-category" onclick="deleteCategory()">Yes</button>
			</div>

		</div>
	</div>
</div>