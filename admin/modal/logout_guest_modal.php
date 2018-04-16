<div class="modal fade" id="logout-guest-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-warning"></span>&nbsp;WARNING!</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="guest-id-logout"/>
					Are you sure the visitor wants to sign-out?
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-guest-response">
				<span class="fa fa-check"></span>&nbsp;Guest signed-out.
			</div>
			
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">No</button>
				<button class="btn btn-success" id="logout-guest" onclick="logoutGuest()">Yes</button>
			</div>

		</div>
	</div>
</div>