<div class="modal fade" id="remove-admin-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-warning"></span>&nbsp;CONFIRM!</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="admin-id"/>
					Are you sure you want to this admin/staff?
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>
			
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">No</button>
				<button class="btn btn-success" id="remove-admin" onclick="removeAdmin()">Yes</button>
			</div>

		</div>
	</div>
</div>