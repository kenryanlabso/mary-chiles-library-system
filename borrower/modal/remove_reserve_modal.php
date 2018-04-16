<style>
.modal-dialog
{
	width:30%;
}
</style>
<div class="modal fade" id="remove-reserve-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">CONFIRM</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">						
					<input type="hidden" id="book-id"/>
					<p style="font-size:18px;">Are you sure you want to cancel your reservation of this book?</p>
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-book-response">
				<span class="fa fa-check"></span>&nbsp;Removed!
			</div>
			
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">No</button>
				<button class="btn btn-success" id="remove-reserve" onclick="removeReserve()">Yes</button>
			</div>

		</div>
	</div>
</div>