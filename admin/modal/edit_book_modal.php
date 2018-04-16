<div class="modal fade" id="edit-book-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Book Information</h4>
			</div>

			<div class="modal-body">

				<input type="hidden" id="book-id" name="book-id"/>

				<label for="call-number">Call Number:</label>
				<input type="text" id="edit-call-number" name="edit-call-number" class="form-control" maxlength="15" autofocus required/>

				<label for="edit-book-title">Book Title:</label>
					<input type="text" id="edit-book-title" name="edit-book-title" class="form-control" maxlength="100" required/>

				<a id="edit-book-author-modal" class="btn btn-danger btn-xs pull-right" title="Click here to edit authors" onclick="editBookAuthorModal()" style="margin-left:5px;">
					<span class="fa fa-group"></span>
				</a>

				<label for="edit-authors">Authors:</label><br/>
				<textarea id="edit-authors" name="edit-authors" class="form-control" readonly></textarea>
					
				<label for="edit-copyright-year">Copyright Year:</label>
				<input type="text" id="edit-copyright-year" name="edit-copyright-year" class="form-control" maxlength="4" required/>
						
				<label for="edit-edition">Edition:</label>
				<input type="text" id="edit-edition" name="edit-edition" class="form-control" maxlength="20"/>

				<label for="edit-volume">Volume:</label>
				<input type="text" id="edit-volume" name="edit-volume" class="form-control" maxlength="3"/>

				<label for="edit-category-id">Category:</label><br/>
				<select id="edit-category-id" name="edit-category-id" class="form-control">
					<?php
						$query_category = "SELECT * FROM category_tbl";
						$result_category = $con->query($query_category);
						while($row_category = $result_category->fetch_assoc())
						{
							$category_id = $row_category['category_id'];
							$class_name = $row_category['classname'];
							?>
							<option value="<?php echo $category_id ?>">
								<?php echo $class_name; ?>
							</option>
							<?php
						}

					?>
				</select>

				<a class="btn btn-primary btn-xs pull-right" title="Click here to add new publisher" onclick="addPublisherModal()">
					<span class="fa fa-plus"></span>
				</a>
				<label for="edit-publisher-id">Publisher:</label><br/>
				<select id="edit-publisher-id" name="edit-publisher-id" class="form-control">
					<?php
						$query_publisher = "SELECT * FROM publisher_tbl WHERE publisher_delete = 0";
						$result_publisher = $con->query($query_publisher);
						while($row_publisher = $result_publisher->fetch_assoc())
						{
							$publisher_id = $row_publisher['publisher_id'];
							$publisher_name = $row_publisher['publisher_name'];
							?>
							<option value="<?php echo $publisher_id; ?>">
								<?php echo $publisher_name; ?>
							</option>
							<?php
						}
					?>
				</select>

				<label for="edit-isbn">ISBN:</label>
				<input type="text" id="edit-isbn" name="edit-isbn" class="form-control" maxlength="20"/>

				<label for="edit-pages">Pages:</label>
				<input type="number" id="edit-pages" name="edit-pages" class="form-control"/>

				<label for="edit-book-price">Price:</label>
				<input type="text" id="edit-book-price" name="edit-book-price" class="form-control" min="1" max="8"/>

				<div class="book-form-response">
					<span class="fa fa-check"></span>&nbsp;Successfully Added!
				</div>			
			</div>

			<div class="modal-loader">
				<span class="fa fa-spinner fa-spin"></span>
			</div>

			<div class="modal-book-response">
				<span class="fa fa-check"></span>&nbsp;Book Successfully Updated!
			</div>

			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button class="btn btn-success" id="update-book" onclick="updateBook()">Update</button>
			</div>

		</div>
	</div>
</div>