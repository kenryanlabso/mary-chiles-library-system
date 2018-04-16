<div class="modal fade" id="edit-holiday-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Holiday Information</h4>
			</div>

			<div class="modal-body">
				<div class="form-group">

					<input type="hidden" id="holiday-id"/>

					<label for="edit-holiday-type">Event-type:</label>
					<select id="edit-holiday-type" name="edit-holiday-type" class="form-control">
						<option value="regular">Regular Holiday</option>
						<option value="special">Special Holiday</option>
						<option value="suspension">Class Suspension</option>
						<option value="school-event">School Event</option>
						<option value="emergency">Emergency</option>
					</select>

					<label for="edit-event-date">Date of Event:</label>
					<input type="date" id="edit-holiday-date" name="edit-holiday-date" class="form-control"/>

					<label for="edit-holiday-name">Event Name:</label>
					<input type="text" id="edit-holiday-name" name="edit-holiday-name" class="form-control" maxlength="100" autofocus required/>

					<label for="edit-holiday-description">Description:</label>
					<textarea id="edit-holiday-description" name="edit-holiday-description" class="form-control" maxlength="150"></textarea>
					
				</div>
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-holiday-response">
				<span class="fa fa-check"></span>&nbsp;Holiday Successfully Updated!
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button class="btn btn-success" id="update-holiday" onclick="updateHoliday()">Update</button>
			</div>

		</div>
	</div>
</div>