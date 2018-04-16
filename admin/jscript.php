<script type="text/javascript">
/*--Author's Script--*/
$(document).ready(function() 
{ 
	$("#view-add-sub-author").attr("disabled", true);
	$("#add-sub-author").attr("disabled", true);

	/*--Add Author's Script--*/
	$('#add-author').submit(function(e)
	{
		if($('#last-name').val()) 
		{
			e.preventDefault();
			$(this).ajaxSubmit(
			{ 
				beforeSend: function()
				{
					$(".form-loader").show();
				},
				success:function ()
				{
					$(".form-loader").hide();
					$(".table-loader").show();
					formAuthorResponseDisplay();
					$(".authors-view").load("view_authors.php");
				},
				resetForm: true 
			}); 
			return false; 
		}
	});
	/*--/Add Author's Script--*/

	/*--Sub Author's Script--*/
	var sub_author = 1;
	var total_sub = parseInt($("#total-sub-authors").val());
	var sub_auths = new Array();

	$("#add-sub-author").click(function() 
	{
		var sub_author_id = $("#sub-author-id").val();
		$("#add-sub-author").attr("disabled", true);

		if(sub_author_id != "")
		{
			var sub_author_name = ($("#sub-author-id").find("option:selected").text());
			var new_sub_author = $(document.createElement('div')).attr("id", 'sub-author-div-'+sub_author);

			sub_auths.push(sub_author_name);
			
			new_sub_author.after().html('<button id="remove-sub-author-'+sub_author+'" onclick="removeSubAuthor('+sub_author+')" class="btn btn-danger" title="Remove author" style="float:right;"><span class="fa fa-remove"></span></button><input type="text" id="sub-author-'+sub_author+'" name="sub-author-'+sub_author+'" class="form-control" value="'+sub_author_name+'" style="width:92%; margin-top:5px; margin-right:5px;" disabled/><input type="hidden" id="authors-id-'+sub_author+'" name="authors-id-'+sub_author+'" value="'+sub_author_id+'"/>');

			new_sub_author.appendTo(".sub-authors-group");
			sub_author++;
			total_sub++;

			$("#sub-author-id").val("");
			$("#sub-authors").val(sub_auths);
			$("#total-sub-authors").val(total_sub);
			$("#sub-authors-label").show();
			$(".sub-authors-class").show();
			
		}
	});

	/*--/Sub Author's Script--*/
});
function checkSubAuthor()
{
	if($("#sub-author-id").val())
	{
		$("#add-sub-author").attr("disabled", false);
	}
	else
	{
		$("#add-sub-author").attr("disabled", true);
	}
}
function removeSubAuthor(author_row)
{
	var author_div = author_row;
	var total_sub = parseInt($("#total-sub-authors").val());
	var author_name = $('#sub-author-'+author_row).val();
	var author_regex = new RegExp(author_name, "i");
	var	authors_name = $("#sub-authors").val();
	var new_authors_regex = authors_name.replace(author_regex, "");
	var new_authors_comma = new_authors_regex.replace(/,,/i, ",");
		
	if(new_authors_comma.substring(0, 1) == ",")
	{
		var authors_name = new_authors_comma.slice(1);
		$("#sub-authors").val(authors_name);
	}
	else
	{
		$("#sub-authors").val(new_authors_comma);
	}
	
	$('#sub-authors-div-'+author_div).remove();
	$('#sub-author-div-'+author_div).remove();
	total_sub--;
	$("#total-sub-authors").val(total_sub);
}
function addAuthorModal()
{
	$("#edit-book-author-modal").modal("hide");
	$("#add-author-modal").modal("show");
}
function addAuthor()
{
	var last_name = $("#last-name").val();
	var first_name = $("#first-name").val();
	var middle_initial = $("#middle-initial").val();

	if(last_name != "")
	{
		$.ajax(
		{
			url: "action/add_author.php",
			data: 'last-name='+last_name+'&first-name='+first_name+'&middle-initial='+middle_initial,
			type: "POST",
			beforeSend: function()
			{
				$("#add-new-author").attr("disabled", true);
				$(".modal-loader").show();
			},
			success: function(data)
			{
				$(".authors-dropdown").load("dropdown_authors.php");
				$(".sub-authors-dropdown").load("dropdown_sub_authors.php");
				$("#last-name").val("");
				$("#first-name").val("");
				$("#middle-initial").val("");
				$(".modal-loader").hide();
				addAuthorResponseDisplay();
				$("#add-new-author").attr("disabled", false);
				$("#first-name").focus();
			}
		});
	}
}
function addAuthorResponseDisplay()
{
	$(".modal-author-response").show();
	setTimeout('hideAuthorResponse()', 1000);
}
function hideAuthorResponse()
{
	$(".modal-author-response").hide();
	$("#edit-author-modal").modal("hide");
}
function formAuthorResponseDisplay()
{
	$(".form-maintenance-response").show();
	setTimeout('hideFormAuthorResponse()', 1300);
}
function hideFormAuthorResponse()
{
	$(".form-maintenance-response").hide();
}
function showAddAuthor()
{
	$(".authors-view").css("width", "53.5%");
	$(".author-add").show();
}
function closeAddAuthorModal()
{
	$("#add-author-modal").modal("hide");
	$("#edit-book-author-modal").modal("show");
}
function closeAddAuthor()
{
	$(".author-add").hide();
	$(".authors-view").css("width", "83.5%");
}
function deleteAuthorModal(author_id)
{
	$("#author-id").val(author_id);
	$("#delete-author-modal").modal("show");
}
function deleteAuthor()
{
	var author_id = $("#author-id").val();
	$.ajax(
	{
		url: "action/delete_author.php",
		data: 'author_id='+author_id,
		type: "POST",
		beforeSend: function()
		{
			$("#delete-author").attr("disabled", true);
			$(".modal-loader").show();
		},
		success: function(data)
		{
			$(".table-loader").show();
			$(".authors-view").load("view_authors.php");
			$("#delete-author-modal").modal("hide");
			$("#delete-author").attr("disabled", false);
			$(".modal-loader").hide();
		}
	});
}
function editAuthorModal(author_id)
{
	$.post("action/read_author_details.php", 
	{
        author_id: author_id
    },
	    function (data, status)
	    {
	    	var author = JSON.parse(data);
	    	$("#author-id").val(author_id);
	    	$("#edit-firstname").val(author.author_fname);
	    	$("#edit-middle-initial").val(author.author_mi);
	    	$("#edit-lastname").val(author.author_lname);
	    }
    );
    $("#update-author").attr("disabled", false);
	$("#edit-author-modal").modal("show");
}
function updateAuthor()
{
	var author_id = $("#author-id").val();
	var lastname = $("#edit-lastname").val();
	var firstname = $("#edit-firstname").val();
	var mi = $("#edit-middle-initial").val();

	if(lastname != "")
	{
		$.ajax(
		{
			url: "action/edit_author.php",
			data: 'author_id='+author_id+'&lastname='+lastname+'&firstname='+firstname+'&mi='+mi,
			type: "POST",
			beforeSend: function()
			{
				$("#update-author").attr("disabled", true);
				$(".modal-loader").show();
			},
			success: function(data)
			{
				$(".modal-loader").hide();
				addAuthorResponseDisplay();
				$(".table-loader").show();
				$(".authors-view").load("view_authors.php");
				$("#edit-lastname").val("");
				$("#edit-firstname").val("");
				$("#edit-middle-initial").val("");
			}
		});
	}
}
function subAuthorModal()
{
	$("#sub-author-modal").modal("show");
}
function enableSubAuthors()
{
	$('#view-add-sub-author').attr('disabled', false);
}

/*--/Author's Script--*/

/*--Book's Script--*/
$(document).ready(function()
{
	/*--Add Book's Script--*/
	$(".accession-div").load('accession_number.php');

	$("#add-book").submit(function(e)
	{
		if($('#call-number').val()) 
		{
			e.preventDefault();
			$(this).ajaxSubmit(
			{ 
				beforeSend: function()
				{
					$(".form-loader").show();
				},
				success:function ()
				{
					$(".sub-authors-class").hide();
					$(".sub-authors-div").remove();
					$(".form-loader").hide();
					formBookResponseDisplay();
					$(".accession-div").load("accession_number.php");
					$(".categories-dropdown").load("dropdown_categories.php");
					$(".authors-dropdown").load("dropdown_authors.php");
					$(".publishers-dropdown").load("dropdown_publishers.php");
					setTimeout(function()
					{
					    location.reload();
					}, 750); 
				},
				resetForm: true
			}); 
			return false; 
		}
	});
	/*--/Add Book's Script--*/

	/*--Add Book Copy Script--*/
	$("#add-copy-form").submit(function(e)
	{
		e.preventDefault();
		$(this).ajaxSubmit(
		{
			beforeSend: function()
			{
				$("#form-response").hide();
				$("#form-loader").show();
				$("#submit-copy").attr("disabled", true);
			},
			success: function(data, status)
			{
				$("#form-loader").hide();
				$("#form-response").show();
				$("#submit-copy").attr("disabled", false);
				showAddCopyResponse();
				$(".books-view").load("view_books.php?filter=group");
				$("#add-call-number").val("");
				$("#add-copies").val("");
				$("#add-source").val("");

			},
			resetForm: true
		});
		return false;
	});
	/*--/Add Book Copy Script--*/

	/*--Book's Image Script--*/
	$("#book-image-update").submit(function(e)
	{
		e.preventDefault();
		$(this).ajaxSubmit(
		{
			beforeSend: function()
			{
				$(".modal-image-loader").show();
			},
			success: function()
			{
				var book_id = $("#modal-book-id").val();
				$.post("action/read_image.php?page=book", 
				{
			        book_id: book_id
			    },
				    function (data, status)
				    {
				    	var image = JSON.parse(data);
				    	if(image.book_image != "")
				    	{
				    		$("#view-book-image").attr("src", 'uploads/books/'+image.book_image);
				    	}
				    	else
				    	{
				    		$("#view-book-image").attr("src", "uploads/books/default.jpg");	

				    	}
				    }
			    );
				$(".modal-image-loader").hide();
				addImageResponseDisplay();
				$(".books-view").load("view_books.php?filter=group");
				
			},
			resetForm: true
		});
		return false;
	});
	/*--/Books's Image Script--*/
});
function hideCopyResponse()
{
	$("#add-copy-response").hide();
}
function showAddCopyResponse()
{
	$("#add-copy-response").show();
	setTimeout("hideCopyResponse()", 1000);
}
function showAddBookCopy()
{
	$(".books-view").css("width", "65%");
	$(".filter-menu").css("margin-left", "15%");
	$(".add-book-copy").show();
}
function closeAddBookCopy()
{
	$(".add-book-copy").hide();
	$(".books-view").css("width", "100%");
	$(".filter-menu").css("margin-left", "35%");
}
function bookBarcodeModal(accession_no)
{
	$.post("action/read_barcode.php?page=book", 
	{
        accession_no: accession_no
    },
	    function (data, status)
	    {
	    	var barcode = JSON.parse(data);
	    	$("#view-book-barcode").attr("src", 'BCG/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=10&text='+barcode.barcode_id+'&thickness=70&start=NULL&code=BCGcode128');
	    }
    );
    $("#hidden-accession-number").val(accession_no);
	$("#book-barcode-modal").modal("show");
}
function printBarcodesModal()
{
	$("#print-barcodes-modal").modal("show");
}
function checkBarcodes()
{
	var start = parseInt($("#barcode-start").val());
	var end = parseInt($("#barcode-end").val());

	if(start >= end)
	{
		$("#barcode-end").val("").focus();
		$("#print-barcodes").attr("disabled", true);
		showBarcodeRangeError();
	}
	else
	{
		$("#print-barcodes").attr("disabled", false);
	}
}
function printBarcodes()
{
	var start = $("#barcode-start").val();
	var end = $("#barcode-end").val();
	$("#barcode-start").val("");
	$("#barcode-end").val("");
	window.location='print_barcodes.php?type=batch&start='+start+'&end='+end;
}
function printBarcode()
{
	var accession_number = $("#hidden-accession-number").val();
	window.location='print_barcodes.php?type=single&accession-number='+accession_number;
}
function hideBarcodeRangeError()
{
	$("#barcode-range-error").hide();
}
function showBarcodeRangeError()
{
	$("#barcode-range-error").show();	
	setTimeout('hideBarcodeRangeError()', 2000);
}
function viewBookImageModal(book_id)
{
	$.post("action/read_image.php?page=book", 
	{
        book_id: book_id
    },
	    function (data, status)
	    {
	    	var image = JSON.parse(data);
	    	if(image.book_image != "")
	    	{
	    		$("#view-bookimage").attr("src", 'uploads/books/'+image.book_image);
	    	}
	    	else
	    	{
	    		$("#view-bookimage").attr("src", "uploads/books/default.jpg");	

	    	}
	    }
    );
    $("#view-book-image-modal").modal("show");

}
function bookImageModal(book_id)
{
	$.post("action/read_image.php?page=book", 
	{
        book_id: book_id
    },
	    function (data, status)
	    {
	    	var image = JSON.parse(data);
	    	if(image.book_image != "")
	    	{
	    		$("#view-book-image").attr("src", 'uploads/books/'+image.book_image);
	    	}
	    	else
	    	{
	    		$("#view-book-image").attr("src", "uploads/books/default.jpg");	

	    	}
	    }
    );
    $("#modal-book-id").val(book_id);
    $("#book-image-modal").modal("show");
}
function editBookByIdModal(accession_id)
{
	$.post("action/read_acquisition_details.php", 
	{
    	accession_id: accession_id
    },
	    function (data, status)
	    {
	    	var book = JSON.parse(data);

	    	$("#accession-id").val(book.accession_number);
	    	$("#call-no").val(book.call_number);
	    	$("#book-title").val(book.book_title);
	    	$("#fund-source").val(book.fund_source);
	    	$("#book-price").val(book.book_price);
	    }
    );
	$("#edit-book-byid-modal").modal("show");
}
function updateBookById()
{
	var accession_id = $("#accession-id").val();
	var fund_source = $("#fund-source").val();

	$("#update-book-byid").attr("disabled", true);
	$(".modal-loader").show();

	$.post("action/edit_book.php?page=accession-number",
	{
		accession_id: accession_id,
		fund_source: fund_source
	},
	function (data, status)
	{
		$(".modal-loader").hide();
		addBookResponseDisplay();
		$("#update-book-byid").attr("disabled", false);
		$(".table-loader").hide();
		$(".book-infos").hide();
		$(".books-view").load("view_books.php?filter=accession").css("width", "100%");
		$("#accession-id").val("");
	    $("#call-no").val("");
	    $("#book-title").val("");
	    $("#fund-source").val("");
	});
}
function editBookModal(book_id)
{
	$.post("action/read_book_details.php", 
	{
    	book_id: book_id
    },
	    function (data, status)
	    {
	    	var book = JSON.parse(data);
	    	$("#book-id").val(book.book_id);
	    	$("#edit-call-number").val(book.call_number);
	    	$("#edit-book-title").val(book.book_title);
	    	$("#edit-authors").val(book.author_names);
	    	$("#edit-copyright-year").val(book.copyright_year);
	    	$("#edit-edition").val(book.edition);
	    	$("#edit-volume").val(book.volume);
	    	$("#edit-category-id").val(book.category_id);
	    	$("#edit-publisher-id").val(book.publisher_id);
	    	$("#edit-isbn").val(book.isbn);
	    	$("#edit-pages").val(book.pages);
	    	$("#edit-book-price").val(book.book_price);
	    }
    );
	$("#edit-book-modal").modal("show");
}
function updateBook()
{
	var book_id = $("#book-id").val();
	var call_number = $("#edit-call-number").val();
	var book_title = $("#edit-book-title").val();
	var copyright_year = $("#edit-copyright-year").val();
	var edition = $("#edit-edition").val();
	var volume = $("#edit-volume").val();
	var category_id = $("#edit-category-id").val();
	var publisher_id = $("#edit-publisher-id").val();
	var isbn = $("#edit-isbn").val();
	var pages = $("#edit-pages").val();
	var book_price = $("#edit-book-price").val();

	$("#update-book").attr("disabled", true);
	$(".modal-loader").show();

	$.post("action/edit_book.php?page=call-number",
	{
		book_id: book_id,
		call_number: call_number,
		book_title: book_title,
		copyright_year: copyright_year,
		edition: edition,
		volume: volume,
		category_id: category_id,
		publisher_id: publisher_id,
		isbn: isbn,
		pages: pages,
		book_price: book_price
	},
	function (data, status)
	{
		$(".modal-loader").hide();
		addBookResponseDisplay();
		$("#update-book").attr("disabled", false);
		$(".table-loader").hide();
		$(".books-view").load("view_books.php?filter=group");

		$("#book-id").val("");
	    $("#edit-call-number").val("");
	    $("#edit-book-title").val("");
	    $("#edit-copyright-year").val("");
	    $("#edit-edition").val("");
	    $("#edit-volume").val("");
	    $("#edit-category-id").val("");
	    $("#edit-publisher-id").val("");
	    $("#edit-isbn").val("");
	    $("#edit-pages").val("");
	    $("#edit-book-price").val("");
	});
}
function editBookAuthorModal()
{
	var book_id = $("#book-id").val();
	var max_index = $("#max-index").val();
	var book_authors = new Array();
	var author_ids = new Array();

	for(ini=1; ini<=max_index+1; ini++)
	{
		$('#book-author-div-'+ini).remove();
	}
	
	$.post("action/read_book_authors.php?get=id",
	{
		book_id: book_id
	},
		function (data, status)
		{
			var authors = JSON.parse(data);
			var id_split = authors.split(",");
			var total_ids = 0;

			for(id_index in id_split)
			{
				author_ids.push(id_split[id_index]);
				total_ids++;
			}

			$.post("action/read_book_authors.php?get=name",
			{
				book_id: book_id
			},
				function (data, status)
				{
					var author_names = JSON.parse(data);
					var author_split = author_names.split(",");
					var total_authors = 0;

					for(author_index in author_split)
					{
						book_authors.push(author_split[author_index]);
						total_authors++;
					}
					for(c=1;c<=total_authors;c++)
					{
						var i = parseInt(c - 2);
						var new_author = $(document.createElement("tr")).attr("id", 'book-author-div-'+c);
						if(book_authors[i] != undefined)
						{
							new_author.after().html('<td><input type="text" class="form-control" value="'+book_authors[i]+'" disabled/><input id="book-author-id-'+c+'" type="hidden" value="'+author_ids[i]+'"/></td><td width="45">&nbsp;<button class="btn btn-danger" onclick="removeBookAuthor('+c+')" title="Remove Author"><span class="fa fa-remove"></span></button></td>');
							new_author.appendTo(".book-authors-table");
						}
					}
					$("#max-index").val(total_authors-1);
					$("#ids-text").val(authors);
				}
			);
		}
	);
	$("#edit-book-modal").modal("hide");
	$("#edit-book-author-modal").modal("show");
}
function addBookAuthor()
{
	var author_id = $("#author-id").val();
	var author_ids = $("#ids-text").val();
	var author_name = $("#author-id").find('option:selected').text();
	var max_index = parseInt($("#max-index").val());
	var new_index = max_index + 1;
	var array_authors = new Array();
	var new_author = $(document.createElement("tr")).attr("id", 'book-author-div-'+new_index);

	if(author_ids.substring(0) == ",")
	{
		var author_id = ","+author_id;
	}
	
	var author_regex = new RegExp(author_id, "i");
	var author_array = author_ids.toString();
	var result = author_array.match(author_regex);
	var id_split = author_ids.split(",");

	for(id_index in id_split)
	{
		array_authors.push(id_split[id_index]);
	}			

	if(author_id != undefined)
	{
		if(result == null)
		{
			new_author.after().html('<td><input type="text" class="form-control" value="'+author_name+'" disabled/><input id="book-author-id-'+new_index+'" type="hidden" value="'+author_id+'"/></td><td width="45">&nbsp;<button class="btn btn-danger" onclick="removeBookAuthor('+new_index+')" title="Remove Author"><span class="fa fa-remove"></span></button></td>');
			new_author.appendTo(".book-authors-table");
			array_authors.push(author_id);
			$("#ids-text").val(array_authors);
			$("#max-index").val(new_index);
			new_index++;
		}
	}
}
function updateBookAuthors()
{
	var book_id = $("#book-id").val();
	var author_ids = $("#ids-text").val();
	var id_split = author_ids.split(",");
	var author_array = author_ids.toString();
	var result = author_array.match(/[0-9]/);

	if(result != null)
	{
		$.ajax(
		{
			url: "action/update_book_author.php?stage=delete-old",
			data: "book-id="+book_id,
			type: "POST",
			beforeSend: function()
			{
				$(".modal-loader").show();
			},
			success: function(data, status)
			{
				for(id_index in id_split)
				{
					var author_id = id_split[id_index];
					if(author_id != "" && author_id != null && author_id != undefined)
					{
						$.ajax(
						{
							url: "action/update_book_author.php?stage=save-authors",
							data: 'book-id='+book_id+'&author-id='+author_id,
							type: "POST",
							beforeSend: function()
							{
								$(".modal-loader").show();
							},
							success: function(data, status)
							{
								$(".modal-loader").hide();
								addBookResponseDisplay();
								$(".books-view").load("view_books.php?filter=group");
							}
						});
					}
				}
			}
		});
	}
}
function removeBookAuthor(index_id)
{
	var author_id = $('#book-author-id-'+index_id).val();
	var author_ids = $("#ids-text").val();
	var author_regex = new RegExp(author_id, "i");
	var new_authors_regex = author_ids.replace(author_regex, "");

	$("#ids-text").val(new_authors_regex);
	$('#book-author-div-'+index_id).remove();
}
function deleteBookModal(accession_id)
{
	$("#accession-id").val(accession_id);
	$("#delete-book").attr("disabled", false);
	$("#delete-book-modal").modal("show");
}
function deleteBook()
{
	var accession_id = $("#accession-id").val();
	var reason = $("#delete-reason").val();
	var remarks = $("#delete-remarks").val();

	$.ajax(
	{
		url: "action/delete_book.php?quantity=single",
		data: 'accession-id='+accession_id+'&reason='+reason+'&remarks='+remarks,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#delete-book").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			addBookResponseDisplay();
			$(".books-view").load("view_books.php?filter=accession");
		}
	});
}
function restoreBookModal(accession_id)
{
	$("#accession-id").val(accession_id);
	$("#restore-book").attr("disabled", false);
	$("#restore-book-modal").modal("show");
}
function restoreBook()
{
	accession_id = $("#accession-id").val();
	$.ajax(
	{
		url: "action/restore_book.php",
		data: 'accession-id='+accession_id,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#restore-book").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			addBookResponseDisplay();
			$(".archives-view").load("view_archived.php");
		}
	});
}
function addBookResponseDisplay()
{
	$(".modal-book-response").show();
	setTimeout('hideBookResponse()', 1300);
}
function hideBookResponse()
{
	$(".modal-book-response").hide();
	$("#edit-book-byid-modal").modal("hide");
	$("#edit-book-modal").modal("hide");
	$("#delete-book-modal").modal("hide");
	$("#restore-book-modal").modal("hide");
	$("#edit-book-author-modal").modal("hide");
}
function formBookResponseDisplay()
{
	$(".book-form-response").show();
	setTimeout('hideFormBookResponse()', 1300);
}
function hideFormBookResponse()
{
	$(".book-form-response").hide();
}
function filterAccession()
{
	$(".books-view").load("view_books.php?filter=accession");
}
function filterTitle()
{
	$(".books-view").load("view_books.php?filter=group");
}
function filterSpecificBook(book_id)
{
	var book_id = book_id;
	$(".books-view").load('view_books.php?filter=specific&book-id='+book_id).css("width", "45%");
	$(".book-infos").load('view_books.php?filter=specific&book-id='+book_id+'&info').show();
}
function returnPageBook()
{
	$(".book-infos").hide();
	$(".books-view").load("view_books.php?filter=group").css("width", "100%");
}
/*--/Book's Script--*/

/*---MAINTENANCE--*/
function hideMaintenanceResponse()
{
	$(".form-maintenance-response").hide();
}
function showMaintenanceResponse()
{
	$(".form-maintenance-response").show();
	setTimeout('hideMaintenanceResponse()', 1300);
}
/*---/MAINTENANCE--*/

/*--Publisher's Script--*/
$(document).ready(function()
{
 	$("#add-publisher").submit(function(e)
	{
		if($("#publisher-name").val()) 
		{
			e.preventDefault();
			$(this).ajaxSubmit(
			{ 
				beforeSend: function()
				{
					$(".form-loader").show();
				},
				success:function ()
				{
					$(".form-loader").hide();
					showMaintenanceResponse();
					$(".table-loader").show();
				    $(".publishers-view").load("view_publishers.php");
				},
				resetForm: true 
			}); 
			return false; 
		}
	});
});
function addPublisherModal()
{
	$("#add-publisher-modal").modal("show");
}
function addPublisher()
{
	var publisher_name = $("#publisher-name").val();
	var publisher_address = $("#publisher-address").val();
	var publisher_contact = $("#publisher-contact").val();
	var publisher_email = $("#publisher-email").val();

	if(publisher_name != "")
	{
		$.ajax(
		{
			url: "action/add_publisher.php",
			data: 'publisher-name='+publisher_name+'&publisher-address='+publisher_address+'&publisher-contact='+publisher_contact+'&publisher-email='+publisher_email,
			type: "POST",
			beforeSend: function()
			{
				$("#add-new-publisher").attr("disabled", true);
				$(".modal-loader").show();
			},
			success: function(data)
			{
				$(".publishers-dropdown").load("dropdown_publishers.php");
				$("#publisher-name").val("");
				$("#publisher-address").val("");
				$("#publisher-contact").val("");
				$("#publisher-email").val("");
				$(".modal-loader").hide();
				addPublisherResponseDisplay();
				$("#add-new-publisher").attr("disabled", false);
				$("#publisher-name").focus();
			}
		});
	}
}
function addPublisherResponseDisplay()
{
	$(".modal-publisher-response").show();
	setTimeout('hidePublisherResponse()', 1300);
}
function hidePublisherResponse()
{
	$(".modal-publisher-response").hide();
}
function showAddPublisher()
{
	$(".publishers-view").css("width", "53.5%");
	$(".publisher-add").show();
}
function closeAddPublisher()
{
	$(".publisher-add").hide();
	$(".publishers-view").css("width", "83.5%");
}
function deletePublisher()
{
	var publisher_id = $("#publisher-id").val();
	$.ajax(
	{
		url: "action/delete_publisher.php",
		data: 'publisher_id='+publisher_id,
		type: "POST",
		beforeSend: function()
		{
			$("#delete-publisher").attr("disabled", true);
			$(".modal-loader").show();
		},
		success: function(data)
		{
			$(".table-loader").show();
			$(".publishers-view").load("view_publishers.php");
			$("#delete-publisher-modal").modal("hide");
			$("#delete-publisher").attr("disabled", false);
			$(".modal-loader").hide();
		}
	});
}
function editPublisherModal(publisher_id)
{
	$.post("action/read_publisher_details.php", 
	{
    	publisher_id: publisher_id
    },
	    function (data, status)
	    {
	    	var publisher = JSON.parse(data);
	    	$("#publisher-id").val(publisher_id);
	    	$("#edit-publisher-name").val(publisher.publisher_name);
	    	$("#edit-publisher-address").val(publisher.publisher_address);
	    	$("#edit-publisher-contact").val(publisher.publisher_contact);
	    	$("#edit-publisher-email").val(publisher.publisher_email);
	    }
    );
	$("#edit-publisher-modal").modal("show");
}
function updatePublisher()
{
	var publisher_id = $("#publisher-id").val();
	var publisher_name = $("#edit-publisher-name").val();
	var publisher_address = $("#edit-publisher-address").val();
	var publisher_contact = $("#edit-publisher-contact").val();
	var publisher_email = $("#edit-publisher-email").val();
	if(publisher_name != "")
	{
		$.ajax(
		{
			url: "action/edit_publisher.php",
			data: 'publisher_id='+publisher_id+'&publisher_name='+publisher_name+'&publisher_address='+publisher_address+'&publisher_contact='+publisher_contact+'&publisher_email='+publisher_email,
			type: "POST",
			beforeSend: function()
			{
				$("#update-publisher").attr("disabled", true);
				$(".modal-loader").show();
			},
			success: function(data)
			{
				$(".modal-loader").hide();
				addPublisherResponseDisplay();
				$(".table-loader").show();
				$(".publishers-view").load("view_publishers.php");
				$("#edit-publisher-modal").modal("hide");
				$("#update-publisher").attr("disabled", false);
				$("#edit-publisher-name").val("");
		    	$("#edit-publisher-address").val("");
		    	$("#edit-publisher-contact").val("");
		    	$("#edit-publisher-email").val("");
			}
		});
	}
}
function deletePublisherModal(publisher_id)
{
	$("#publisher-id").val(publisher_id);
	$("#delete-publisher-modal").modal("show");
}
/*--/Publisher's Script--*/

/*--Category's Maintenance--*/
$(document).ready(function()
{
	$("#add-category").submit(function(e)
	{
		e.preventDefault();
		$(this).ajaxSubmit(
		{
			beforeSend: function()
			{
				$(".form-loader").show();
				$("#submit-category").attr("disabled", true);
			},
			success: function(data, status)
			{
				$(".form-loader").hide();
				showMaintenanceResponse();
				$(".categories-view").load("view_categories.php");
				$("#submit-category").attr("disabled", false);
			},
			resetForm: true
		});
		return false;
	});
});
function showAddCategory()
{
	$(".categories-view").css("width", "53.5%");
	$(".category-add").show();
}
function closeAddCategory()
{
	$(".category-add").hide();
	$(".categories-view").css("width", "83.5%");
}
function hideModalCategoryResponse()
{
	$(".modal-category-response").hide();
	$("#edit-category-modal").modal("hide");
	$("#delete-category-modal").modal("hide");
}
function showModalCategoryResponse()
{
	$(".modal-category-response").show();
	setTimeout('hideModalCategoryResponse()', 1000);
}
function editCategoryModal(category_id)
{
	$.post("action/read_category_details.php",
	{
		category_id: category_id
	},
		function (data, status)
		{
			var category = JSON.parse(data);

			$("#category-id").val(category_id);
			$("#edit-classname").val(category.classname);
		}
	);
	$("#update-category").attr("disabled", false);
	$("#edit-category-modal").modal("show");
}
function updateCategory()
{
	var category_id = $("#category-id").val();
	var classname = $("#edit-classname").val();

	$.ajax(
	{
		url: "action/edit_category.php",
		data: 'category-id='+category_id+'&classname='+classname,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#update-category").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			showModalCategoryResponse();
			$(".categories-view").load("view_categories.php");
		}
	});
}
function deleteCategoryModal(category_id)
{
	$("#category-id").val(category_id);
	$("#delete-category-modal").modal("show");
	$("#delete-category").attr("disabled", false);
}
function deleteCategory()
{
	var category_id = $("#category-id").val();
	$.ajax(
	{
		url: "action/delete_category.php",
		data: 'category-id='+category_id,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#delete-category").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			showModalCategoryResponse();
			$(".categories-view").load("view_categories.php");
		}
	});
}
/*--/Category's Maintenance--*/
/*--Course's Maintenance--*/
$(document).ready(function()
{
	$("#add-course").submit(function(e)
	{
		e.preventDefault();
		$(this).ajaxSubmit(
		{
			beforeSend: function()
			{
				$(".form-loader").show();
			},
			success: function()
			{
				$(".form-loader").hide();
				showMaintenanceResponse();
				$(".courses-view").load("view_courses.php");
			},
			resetForm: true
		});
		return false;
	});
});
function hideModalCourseResonse()
{
	$(".modal-course-response").hide();
	$("#edit-course-modal").modal("hide");
	$("#delete-course-modal").modal("hide");
}
function showModalCourseResponse()
{
	$(".modal-course-response").show();
	setTimeout('hideModalCourseResonse()', 1000);
}
function showAddCourse()
{
	$(".courses-view").css("width", "53.5%");
	$(".course-add").show();
}
function closeAddCourse()
{
	$(".course-add").hide();	
	$(".courses-view").css("width", "83.5%");
}
function editCourseModal(course_id)
{
	$.post("action/read_course_details.php",
	{
		course_id: course_id
	},
		function (data, status)
		{
			var course = JSON.parse(data);
			$("#course-id").val(course_id);
			$("#edit-course-name").val(course.course_name);
			$("#edit-course-description").val(course.course_description);
		}
	);
	$("#update-course").attr("disabled", false);
	$("#edit-course-modal").modal("show");
}
function updateCourse()
{
	var course_id = $("#course-id").val();
	var course_name = $("#edit-course-name").val();
	var course_description = $("#edit-course-description").val();

	$.ajax(
	{
		url: "action/edit_course.php",
		data: 'course-id='+course_id+'&course-name='+course_name+'&course-description='+course_description,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#update-course").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			showModalCourseResponse();
			$(".courses-view").load("view_courses.php");
		}
	});
}
function deleteCourseModal(course_id)
{
	$("#course-id").val(course_id);
	$(".delete-course").attr("disabled", false);
	$("#delete-course-modal").modal("show");
}
function deleteCourse()
{
	var course_id = $("#course-id").val();
	$.ajax(
	{
		url: "action/delete_course.php",
		data: 'course-id='+course_id,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$(".delete-course").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			showModalCourseResponse();
			$(".courses-view").load("view_courses.php");
		}
	});
}
/*--/Course's Maintenance--*/

/*--Department's Maintenance--*/
$(document).ready(function()
{
	$("#add-department").submit(function(e)
	{
		e.preventDefault();
		$(this).ajaxSubmit(
		{
			beforeSend: function()
			{
				$(".form-loader").show();
				$("#submit-department").attr("disabled", true);
			},
			success: function(data, status)
			{
				$(".form-loader").hide();
				showMaintenanceResponse();
				$(".departments-view").load("view_departments.php");
				$("#submit-department").attr("disabled", false);
			},
			resetForm: true
		});
		return false;
	});
});
function hideModalDepartmentResponse()
{
	$(".modal-department-response").hide();
	$("#edit-department-modal").modal("hide");
	$("#delete-department-modal").modal("hide");
}
function showModalDepartmentResponse()
{	
	$(".modal-department-response").show();
	setTimeout('hideModalDepartmentResponse()', 1000);
}
function showAddDepartment()
{
	$(".departments-view").css("width", "53.5%");
	$(".department-add").show();
}
function closeAddDepartment()
{
	$(".department-add").hide();
	$(".departments-view").css("width", "83.5%");
}
function editDepartmentModal(department_id)
{
	$.post("action/read_department_details.php",
	{
		department_id: department_id
	},
		function (data, status)
		{
			var department = JSON.parse(data);
			$("#department-id").val(department_id);
			$("#edit-department-name").val(department.department_name);
			$("#edit-department-description").val(department.department_description);
		}
	);
	$("#update-department").attr("disabled", false);
	$("#edit-department-modal").modal("show");
}
function updateDepartment()
{
	var department_id = $("#department-id").val();
	var department_name = $("#edit-department-name").val();
	var department_description = $("#edit-department-description").val();
	
	$.ajax(
	{
		url: "action/edit_department.php",
		data: 'department-id='+department_id+'&department-name='+department_name+'&department-description='+department_description,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#update-department").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			showModalDepartmentResponse();
			$(".departments-view").load("view_departments.php");
		}
	});
}
function deleteDepartmentModal(department_id)
{
	$("#department-id").val(department_id);
	$("#delete-department-modal").modal("show");
}
function deleteDepartment()
{
	var department_id = $("#department-id").val();
	$.ajax(
	{
		url: "action/delete_department.php",
		data: 'department-id='+department_id,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#delete-department").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			showModalDepartmentResponse();
			$(".departments-view").load("view_departments.php");
		}
	});
}
/*--/Department's Maintenance--*/

/*--Holidays's Maintenance--*/
$(document).ready(function()
{
	$("#add-holiday").submit(function(e)
	{
		e.preventDefault();
		$(this).ajaxSubmit(
		{
			beforeSend: function()
			{
				$(".form-loader").show();
				$("#submit-holiday").attr("disabled", true);
			},
			success: function(data, status)
			{
				$(".form-loader").hide();
				showMaintenanceResponse();
				$("#submit-holiday").attr("disabled", false);
				$(".holidays-view").load("view_holidays.php");
			},
			resetForm: true
		});
		return false;
	});
});
function hideModalHolidayResponse()
{
	$(".modal-holiday-response").hide();
	$("#edit-holiday-modal").modal("hide");
	$("#delete-holiday-modal").modal("hide");
}
function showModalHolidayResponse()
{
	$(".modal-holiday-response").show();
	setTimeout('hideModalHolidayResponse()', 1000);
}
function showAddHoliday()
{
	$(".holidays-view").css("width", "53.5%");
	$(".holidays-add").show();
}
function closeAddHoliday()
{
	$(".holidays-add").hide();
	$(".holidays-view").css("width", "83.5%");
}
function editHolidayModal(holiday_id)
{
	$.post("action/read_holiday_details.php",
	{
		holiday_id: holiday_id
	},
		function (data, status)
		{
			var holiday = JSON.parse(data);
			$("#holiday-id").val(holiday_id);
			$("#edit-holiday-type").val(holiday.holiday_type);
			$("#edit-holiday-date").val(holiday.holiday_date);
			$("#edit-holiday-name").val(holiday.holiday_name);
			$("#edit-holiday-description").val(holiday.holiday_description);
		}
	);

	$("#edit-holiday-modal").modal("show");
}
function updateHoliday()
{
	var holiday_id = $("#holiday-id").val();
	var holiday_type = $("#edit-holiday-type").val();
	var holiday_date = $("#edit-holiday-date").val();
	var holiday_name = $("#edit-holiday-name").val();
	var holiday_description = $("#edit-holiday-description").val();

	$.ajax(
	{
		url: "action/edit_holiday.php",
		data: 'holiday-id='+holiday_id+'&holiday-type='+holiday_type+'&holiday-date='+holiday_date+'&holiday-name='+holiday_name+'&holiday-description='+holiday_description,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#update-holiday").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			showModalHolidayResponse();
			$(".holidays-view").load("view_holidays.php");
			$("#update-holiday").attr("disabled", false);
		}
	});
}
function deleteHolidayModal(holiday_id)
{
	$("#holiday-id").val(holiday_id);
	$("#delete-holiday-modal").modal("show");
}
function deleteHoliday()
{
	var holiday_id = $("#holiday-id").val();
	$.ajax(
	{
		url: "action/delete_holiday.php",
		data: 'holiday-id='+holiday_id,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#delete-holiday").attr("disabed", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			showModalHolidayResponse();
			$("#delete-holiday").attr("disabed", true);	
			$(".holidays-view").load("view_holidays.php");
		}
	});
}
/*--/Holidays's Maintenance--*/

/*--User's Script--*/
$(document).ready(function()
{
	/*--/Add User--*/
	$("#add-user-form").submit(function(e)
	{
		var account_type = $("#account-class").val();
		
		if(account_type == "Employee")
		{
			var employee_number = $("#employee-number").val();
			var department_id = $("#department-id").val();
			if(employee_number != "")
			{
				e.preventDefault();
				$(this).ajaxSubmit(
				{ 
					beforeSend: function()
					{
						$("#submit-add-user").attr("disabled", true);
						$(".form-loader").show();
					},
					success:function ()
					{
						$(".form-loader").hide();
						$("#submit-add-user").attr("disabled", false);
						formUserResponseDisplay();
						$(".users-view").load("view_users.php?page=borrower&view=all");
						setTimeout(function()
						{
					        location.reload();
					    }, 750); 
					},
					resetForm: true 
				}); 
				return false; 
			}
		}
		else if(account_type == "Student")
		{
			var student_number  = $("#student-number").val();
			var course_id = $("#course-id").val();
			if(student_number != "")
			{
				e.preventDefault();
				$(this).ajaxSubmit(
				{ 
					beforeSend: function()
					{
						$("#submit-add-user").attr("disabled", true);
						$(".form-loader").show();
					},
					success: function()
					{
						$(".form-loader").hide();
						$("#submit-add-user").attr("disabled", false);
						formUserResponseDisplay();
						$(".users-view").load("view_users.php?page=borrower&view=all");
						setTimeout(function()
						{
					        location.reload();
					    }, 750); 
					},
					resetForm: true 
				}); 
				return false; 
			}
		}
	});
	$("#reset-add-user").click(function()
	{
		$(".employee-number-class").hide();
		$(".department-id-class").hide();
		$(".student-number-class").hide();
		$(".course-id-class").hide();
	});
	/*--/Add User--*/
	
	/*--Add Admin's Script--*/
	$('#admin-add').submit(function(e)
	{		
		e.preventDefault();
		$(this).ajaxSubmit(
		{ 
			beforeSend: function()
			{
				$(".form-loader").show();
			},
			success:function ()
			{
				$(".form-loader").hide();
				formAdminResponseDisplay();
				$(".administrators-view").load("view_users.php?page=admin&view=all");
				$(".filter-menu").css("margin-left", "23%");
			},
			resetForm: true 
		}); 
		return false; 
	});
	/*--/Add Admin's Script--*/

	/*--User's Image Script--*/
	$("#user-image-update").submit(function(e)
	{
		e.preventDefault();
		$(this).ajaxSubmit(
		{
			beforeSend: function()
			{
				$(".modal-image-loader").show();
			},
			success: function()
			{
				var account_id = $("#user-id").val();
				$.post("action/read_image.php?page=user", 
				{
			        account_id: account_id
			    },
				    function (data, status)
				    {
				    	var image = JSON.parse(data);
				    	if(image.user_image != "")
				    	{
				    		$("#view-user-image").attr("src", 'uploads/users/'+image.user_image);
				    	}
				    	else
				    	{
				    		$("#view-user-image").attr("src", "uploads/users/default.png");	
				    	}
				    }
			    );
				$(".modal-image-loader").hide();
				addImageResponseDisplay();
				$(".administrators-view").load("view_users.php?page=admin&view=all");
				$(".users-view").load("view_users.php?page=borrower&view=all");
				$(".inactives-view").load("view_users.php?page=inactive&view=all");
			},
			resetForm: true
		});
		return false;
	});
	/*--/User's Image Script--*/

	/*--Edit User Information--*/
	$("#account-update").submit(function(e)
	{
		e.preventDefault();
		$(this).ajaxSubmit(
		{
			beforeSend: function()
			{
				$(".form-loader").show();
				$("#submit-changes").attr("disabled", true);
			},
			success: function(data, status)
			{
				$(".form-loader").hide();
				$("#submit-changes").attr("disabled", false);
				$("#confirm-changes").attr("disabled", false);
				showUserInfoResponse();
			},
			resetForm: false
		});
		return false;
	});
	/*--/Edit User Information--*/

});
function userImageModal(row_number)
{
	var account_id = $('#account-id-'+row_number).val();

	$.post("action/read_image.php?page=user", 
	{
        account_id: account_id
    },
	    function (data, status)
	    {
	    	var image = JSON.parse(data);
	    	if(image.user_image != "")
	    	{
	    		$("#view-user-image").attr("src", 'uploads/users/'+image.user_image);
	    	}
	    	else
	    	{
	    		$("#view-user-image").attr("src", "uploads/users/default.png");	
	    	}
	    }
    );
    $("#user-id").val(account_id);
	$("#user-image-modal").modal("show");
}
function formAdminResponseDisplay()
{
	$(".admin-form-response").show();
	setTimeout('hideFormAdminResponse()', 1300);
}
function hideFormAdminResponse()
{
	$(".admin-form-response").hide();
}
function editStudentModal(row_number)
{
	var account_id = $('#account-id-'+row_number).val();

	$.post("action/read_user_details.php?page=student", 
	{
        account_id: account_id
    },
	    function (data, status)
	    {
	    	var account = JSON.parse(data);

	    	$("#account-number").val(account.account_number);
	    	$("#edit-first-name").val(account.student_fname);
	    	$("#edit-middle-initial").val(account.student_mi);
	    	$("#edit-last-name").val(account.student_lname);
	    	$("#edit-birthday").val(account.student_birthday);
	    	$("#edit-email").val(account.student_email);
	    	$("#edit-contact-number").val(account.student_contact);
	    	$("#edit-course-id").val(account.course_id);
	    }
    );
    $("#account-type").val("student");
    $("#course-div").show();
    $("#department-div").hide();
	$("#edit-user-modal").modal("show");
}
function editEmployeeModal(row_number)
{
	var account_id = $('#account-id-'+row_number).val();

	$.post("action/read_user_details.php?page=employee", 
	{
        account_id: account_id
    },
	    function (data, status)
	    {
	    	var account = JSON.parse(data);

	    	$("#account-number").val(account.account_number);
	    	$("#edit-first-name").val(account.employee_fname);
	    	$("#edit-middle-initial").val(account.employee_mi);
	    	$("#edit-last-name").val(account.employee_lname);
	    	$("#edit-birthday").val(account.employee_birthday);
	    	$("#edit-email").val(account.employee_email);
	    	$("#edit-contact-number").val(account.employee_contact);
	    	$("#edit-department-id").val(account.department_id);
	    }
    );
    $("#account-type").val("employee");
    $("#department-div").show();
    $("#course-div").hide();
	$("#edit-user-modal").modal("show");
}
function updateUser()
{
	var account_number = $("#account-number").val();
	var account_type = $("#account-type").val();
	var firstname = $("#edit-first-name").val();
	var mi = $("#edit-middle-initial").val();
	var lastname = $("#edit-last-name").val();
	var birthday = $("#edit-birthday").val();
	var email = $("#edit-email").val();
	var contact_number = $("#edit-contact-number").val();
	
	if(account_type == "employee")
	{
		var department_id = $("#edit-department-id").val();
		if(department_id != "" && firstname != "" && mi != "" && lastname != "")
		{
			$.ajax(
			{
				url: "action/update_user.php?type=employee",
				data: 'account_number='+account_number+'&firstname='+firstname+'&mi='+mi+'&lastname='+lastname+'&department_id='+department_id+'&email='+email+'&birthday='+birthday+'&contact_number='+contact_number,
				type: "POST",
				beforeSend: function ()
				{
					$("#update-user").attr("disabled", true);
					$(".modal-loader").show();
				},
				success: function(data, status)
				{
					$(".modal-loader").hide();
					addUserResponseDisplay();
					$("#edit-user-modal").modal("hide");
					$("#update-user").attr("disabled", false);
					$(".administrators-view").load("view_users.php?page=admin&view=all");
					$(".users-view").load("view_users.php?page=borrower&view=all");
				}
			});
		}
	}
	else if(account_type == "student")
	{
		var course_id = $("#edit-course-id").val();
		if(course_id != "" && firstname != "" && mi != "" && lastname != "")
		{
			$.ajax(
			{
				url: "action/update_user.php?type=student",
				data: 'account_number='+account_number+'&firstname='+firstname+'&mi='+mi+'&lastname='+lastname+'&course_id='+course_id+'&email='+email+'&birthday='+birthday+'&contact_number='+contact_number,
				type: "POST",
				beforeSend: function ()
				{
					$("#update-user").attr("disabled", true);
					$(".modal-loader").show();
				},
				success: function(data, status)
				{
					$(".modal-loader").hide();
					addUserResponseDisplay();
					$("#edit-user-modal").modal("hide");
					$("#update-user").attr("disabled", false);
					$(".administrators-view").load("view_users.php?page=admin&view=all");
					$(".users-view").load("view_users.php?page=borrower&view=all");
				}
			});
		}
	}
}
function userInfoModal()
{
	$("#user-info-modal").modal("show");
}
function saveUserInfo()
{
	$("#account-update").submit();
	$("#confirm-changes").attr("disabled", true);
	$("#user-info-modal").modal("hide");
}
function hideUserInfoResponse()
{
	$("#saved-response").hide();
}
function showUserInfoResponse()
{
	$("#saved-response").text("User info successfully updated.").show();
	setTimeout('hideUserInfoResponse()', 1400);
}
function hideRemoveAdminModal()
{
	$("#remove-admin-modal").modal("hide");
	$("#remove-admin").attr("disabled", false);
	$(".modal-loader").hide();
}
function removeAdminModal(row_number)
{
	var account_id = $('#account-id-'+row_number).val();
	$("#admin-id").val(account_id);
	$("#remove-admin-modal").modal("show");
}
function removeAdmin()
{
	var account_id = $("#admin-id").val();
	$.ajax(
	{
		url: "action/remove_admin.php",
		data: 'account-number='+account_id,
		method: "POST",
		beforeSend: function()
		{
			$("#remove-admin").attr("disabled", true);
			$(".modal-loader").show();
		},
		success: function(data, status)
		{
			$(".administrators-view").load("view_users.php?page=admin&view=all");
			setTimeout('hideRemoveAdminModal()', 1400);
		}
	});
}
function activateAccountModal(row_number)
{
	var account_id = $('#account-id-'+row_number).val();
	$("#account-id").val(account_id);
	$("#activate-account-modal").modal("show");
}
function activateAccount()
{
	var account_number = $("#account-id").val();
	$.ajax(
	{
		url: "action/activate_account.php",
		data: 'account-number='+account_number,
		type: "POST",
		beforeSend: function()
		{
			$("#activate-account").attr("disabled", true);
			$(".modal-loader").show();
		},
		success: function(data, status)
		{
			$(".inactives-view").load("view_users.php?page=inactive&view=all");
			$("#activate-account-modal").modal("hide");
			$(".modal-loader").hide();
			$("#activate-account").attr("disabled", false);
		}
	});
}
function deactivateAccountModal(row_number)
{
	var account_id = $('#account-id-'+row_number).val();
	$("#account-id").val(account_id);
	$("#deactivate-account-modal").modal("show");
}
function deactivateAccount()
{
	var account_number = $("#account-id").val();
	$.ajax(
	{
		url: "action/deactivate_account.php",
		data: 'account-number='+account_number,
		type: "POST",
		beforeSend: function()
		{
			$("#deactivate-account").attr("disabled", true);
			$(".modal-loader").show();
		},
		success: function(data, status)
		{
			$(".users-view").load("view_users.php?page=borrower&view=all");
			$("#deactivate-account-modal").modal("hide");
			$(".modal-loader").hide();
			$("#deactivate-account").attr("disabled", false);
		}
	});
}
function checkStudentNumber()
{
	var student_number = $("#student-number").val();

	$.post("action/check_user_id.php?type=student", 
	{
        student_number: student_number
    },
	    function (data, status)
	    {
	    	var response = JSON.parse(data);
	    	if(response == "Account already exists")
	    	{
	    		$("#student-number-error").text(response).show();
	    		$("#submit-add-user").attr("disabled", true);
	    	}
	    	else
	    	{
	    		$("#student-number-error").hide();	
	    		$("#submit-add-user").attr("disabled", false);
	    	}
	    }
    );
}
function checkEmployeeNumber()
{
	var employee_number = $("#employee-number").val();

	$.post("action/check_user_id.php?type=employee", 
	{
        employee_number: employee_number
    },
	    function (data, status)
	    {
	    	var response = JSON.parse(data);
	    	if(response == "Account already exists")
	    	{
	    		$("#employee-number-error").text(response).show();
	    		$("#submit-add-user").attr("disabled", true);
	    	}
	    	else
	    	{
	    		$("#employee-number-error").hide();	
	    		$("#submit-add-user").attr("disabled", false);
	    	}
	    }
    );
}
function filterAdminStaff()
{
	$(".administrators-view").load("view_users.php?page=admin&view=all");
}
function filterAdminUser()
{
	$(".administrators-view").load("view_users.php?page=admin&view=admin");
}
function filterStaffUser()
{
	$(".administrators-view").load("view_users.php?page=admin&view=staff");
}
function filterAllBorrower()
{
	$(".users-view").load("view_users.php?page=borrower&view=all");
}
function filterEmployeeBorrower()
{
	$(".users-view").load("view_users.php?page=borrower&view=employee");
}
function filterStudentBorrower()
{
	$(".users-view").load("view_users.php?page=borrower&view=student");
}
function filterAllInactiveBorrower()
{
	$(".inactives-view").load("view_users.php?page=inactive&view=all");
}
function filterInactiveStudents()
{
	$(".inactives-view").load("view_users.php?page=inactive&view=student");
}
function filterInactiveEmployees()
{
	$(".inactives-view").load("view_users.php?page=inactive&view=employee");
}
function addUserResponseDisplay()
{
	$(".modal-user-response").show();
	setTimeout('hideUserResponse()', 1300);
}
function hideUserResponse()
{
	$(".modal-user-response").hide();
}
function formUserResponseDisplay()
{
	$(".user-form-response").show();
	setTimeout('hideFormUserResponse()', 1300);
}
function hideFormUserResponse()
{
	$(".user-form-response").hide();
}
function showAddAdmin()
{
	$(".administrators-view").css("width", "70%");
	$(".filter-menu").css("margin-left", "23%");
	$("#admin-type").attr("autofocus", true);
	$(".admin-form").show();
}
function closeShowAdmin()
{
	$(".admin-form").hide();
	$(".filter-menu").css("margin-left", "34%");	
	$(".administrators-view").css("width", "100%");
}
function showAddUser()
{
	$(".users-view").css("width", "69%");
	$(".user-add").show();
}
function closeAddUser()
{
	$(".user-add").hide();
	$(".users-view").css("width", "100%");
}
function selectAccount()
{
	var account_name = $("#account-id").find("option:selected").text();
	var admin_type = account_name.substr(0, 3);
	if(admin_type == "(S)")
	{
		$("#admin-type").val("Staff");
		$("#account-priviledge").val("Staff");
	}
	else if(admin_type == "(E)")
	{
		$("#admin-type").val("Admin");
		$("#account-priviledge").val("Admin");
	}
}
function userType()
{
	var account_type = $("#account-class").val();	
	if(account_type == "Employee")
	{
		$(".user-add").css("height", "710px");
		$(".student-number-class").hide();
		$(".course-id-class").hide();
		$("#student-number").val("");
		$("#course-id").val("");
		$("#student-number").attr("required", false);
		$("#course-id").attr("required", false);
		$("#employee-number").attr("required", true);
		$("#department-id").attr("required", true);
		$(".employee-number-class").show();
		$(".department-id-class").show();
	}
	else if(account_type == "Student")
	{
		$(".user-add").css("height", "710px");
		$(".employee-number-class").hide();
		$(".department-id-class").hide();
		$("#employee-number").val("");
		$("#department-id").val("");
		$("#employee-number").attr("required", false);
		$("#department-id").attr("required", false);
		$("#student-number").attr("required", true);
		$("#course-id").attr("required", true);
		$(".student-number-class").show();
		$(".course-id-class").show();
	}
	else
	{	
		$(".user-add").css("height", "585px");
		$(".employee-number-class").hide();
		$(".department-id-class").hide();
		$(".student-number-class").hide();
		$(".course-id-class").hide();
		$("#employee-number").val("");
		$("#department-id").val("");
		$("#student-number").val("");
		$("#course-id").val("");
		$("#student-number").attr("required", false);
		$("#course-id").attr("required", false);
		$("#employee-number").attr("required", false);
		$("#department-id").attr("required", false);
	}
}
function hidePasswordResponse()
{
	$("#password-matched-error").hide();
}
function checkPassword()
{
	var new_password = $("#new-password").val();
	var confirm_password = $("#confirm-password").val();

	if(new_password != confirm_password)
	{
		$("#password-matched-error").show();
		setTimeout('hidePasswordResponse()', 2000);
		
		$("#new-password").val("");
		$("#confirm-password").val("");
		$("#new-password").focus();
	}
}
/*--/User's Script--*/

/*--Borrow's Script--*/
$(document).ready(function()
{
	var table_row = 1;
	var book_loans = new Array();
	var book_ids = new Array();

	$("#check-borrow").click(function()
	{
		$("#check-borrow").attr("disabled", true);
		var temporary = 1;
		var barcode_id = $("#barcode-number").val();
		var account_id = $("#account-number").val();
		var account_name = $("#account-number").find("option:selected").text();
		var account_type = account_name.substr(0, 3);
		var barcode_regex = new RegExp(barcode_id, "i");
		var text_array = book_loans.toString();
		var result = text_array.search(barcode_regex);
		
		if(barcode_id != "" & account_id != "")
		{
			if(result == -1)
			{
				/*--Book Details--*/
				$(".form-loader").show();

				$.post("load.php?page=borrow&link=details", 
				{
			        barcode_id: barcode_id,
			        account_id: account_id
			    },
				    function (data, status)
				    {
				    	var borrow = JSON.parse(data);
				    	if(borrow.book_title != null)
				    	{
				    		$("#book-id").val(borrow.book_id);
				    		$("#book-title").text(borrow.book_title);
					    	$("#call-number").text(borrow.call_number);
					    	$("#copyright-year").text(borrow.copyright_year);
					    	$("#edition").text(borrow.edition);
					    	$("#volume").text(borrow.volume);
					    	$("#book-authors").text(borrow.book_authors);
					    	$("#category").text(borrow.classname);
					    	$("#publisher").text(borrow.publisher_name);
					    	$("#isbn").text(borrow.isbn);

				    		//Borrow Cart
					    	var new_row = $(document.createElement("tr")).attr("id", 'borrow-row-'+table_row);
					    	var td_book_id = $("#book-id").val();
					    	var td_call_number = $("#call-number").text();
					    	var td_book_title = $("#book-title").text();
					    	var td_copyright_year = $("#copyright-year").text();
					    	var td_edition = $("#edition").text();
					    	var td_volume = $("#volume").text();
					    	var td_authors = $("#book-authors").text();
					    	var td_category = $("#category").text();
					    	var td_publisher = $("#publisher").text();
					    	var td_isbn = $("#isbn").text();
					    	
							for(initial=0;initial<table_row;initial++)
							{
								var last_iteration = parseInt(initial - 1);
								if(book_ids[initial] != undefined)
								{
									if(borrow.book_id == book_ids[initial])
									{
										if(borrow.book_id == book_ids[initial])
										{
											temporary = 0;
										}
									}
								}
							}

							if(temporary == 1)
							{
								new_row.after().html('<input type="hidden" id="tr-book-id-'+table_row+'" value="'+td_book_id+'"/><input type="hidden" id="tr-barcode-'+table_row+'" value="'+barcode_id+'" /><td>'+td_call_number+'<td>'+td_book_title+'<td>'+td_authors+'<td>'+td_copyright_year+'<td>'+td_edition+'<td><td><td><center><button class="btn btn-danger btn-xs" onclick="removeFromCart('+table_row+')"><span class="fa fa-remove"></span></center></button></td>');
								new_row.appendTo(".borrow-table");

								//Borrow Cart
								$("#account-number").attr("disabled", true);
								$("#barcode-number").val("").focus();
								$(".book-details").show();
								$(".borrow-cart").show();
								$("#sum-rows-borrow").val(table_row);
								book_ids.push(td_book_id);
								book_loans.push(barcode_id);
								table_row++;
							}
							else
							{
								$("#transaction-error").text("Only 1 copy are allowed to each borrower.");
								$("#barcode-number").val("").focus();
					    		showTransactionErrorResponse();
					    	}	
				    	}
				    	else
				    	{
				    		$("#transaction-error").text(borrow);
				    		$("#barcode-number").val("").focus();
				    		showTransactionErrorResponse();
				    	}
				    	$("#check-borrow").attr("disabled", false);
				    	setTimeout('hideFormLoader()', 100);
				    }
			    );
				
				/*--/Book Details--*/

				/*--Borrower Details--*/
				$.post("load.php?page=borrow&link=user", 
				{
			        account_id: account_id
			    },
				    function (data, status)
				    {
				    	var borrower = JSON.parse(data);
				    	if(borrower.account_number != null)
				    	{
				    		$("#borrower-id").text(borrower.account_number);
					    	$("#borrower-name").text(borrower.user_name);

					    	if(account_type == "(S)")
							{
							   $("#borrower-type").text("Student");
							}
							else if(account_type == "(E)")
							{
								$("#borrower-type").text("Employee");
							}
				    	}
				    }
			    );
				/*--/Borrower Details--*/
			}
			else
			{
				$("#transaction-error").text("Book is in the process already.");
				$("#barcode-number").val("").focus();
				showTransactionErrorResponse();
			}
		}
	});
	$("#barcode-number").change(function()
	{
		$("#check-borrow").attr("disabled", false);
		$("#check-return").attr("disabled", false);
		$("#check-renew").attr("disabled", false);
	});
});
function confirmBorrowPrintModal()
{
	$("#confirm-borrow-print-modal").modal("show");
}
function emptyBorrowCartModal()
{
	$("#empty-borrow-cart-modal").modal("show");	
}
function emptyBorrowCart()
{
	location.reload();
}
function confirmReturnPrintModal()
{
	$("#confirm-return-print-modal").modal("show");
}
function emptyReturnCartModal()
{
	$("#empty-return-cart-modal").modal("show");	
}
function emptyReturnCart()
{
	location.reload();
}
function processBorrow(boolean_value)
{
	var total_loads = parseInt($("#sum-rows-borrow").val());
	var account_id = $("#borrower-id").text();
	var account_type = $("#borrower-type").text();

	for(i=1;i<=total_loads;i++)
	{
		var barcode_id = $('#tr-barcode-'+i).val();
		if(barcode_id != undefined)
		{
			$.ajax(
			{
				url: "action/process.php?page=borrow",
				data: 'account-id='+account_id+'&account-type='+account_type+'&barcode-id='+barcode_id,
				type: "POST",
				beforeSend: function ()
				{
					$("#confirm-borrow-print-modal").modal("hide");
					$(".transaction-loader").show();
				},
				success: function(data, status)
				{
					$(".transaction-loader").hide();
					if(boolean_value == 1)
					{
						window.location='transaction.php?page=borrow&print='+account_id;	
					}
					else
					{
						window.location='transaction.php?page=borrow';	
					}	
				}
			});
		}
	}
}
function removeFromCart(row_id)
{
	$("#row-id").val(row_id);
	$("#remove-cart-modal").modal("show");
}
function removeItem()
{
	var row_id = $("#row-id").val();
	$("#borrow-row-"+row_id).remove();
	$("#return-row-"+row_id).remove();
	$("#remove-cart-modal").modal("hide");
}
function hideTransactionErrorReponse()
{
	$("#transaction-error").hide();	
}
function showTransactionErrorResponse()
{
	$("#transaction-error").show();
	setTimeout('hideTransactionErrorReponse()', 3000);
}
/*--/Return Book--*/
$(document).ready(function()
{
	var table_row = 1;
	var book_loans = new Array();
	$("#check-return").click(function()
	{
		$("#check-return").attr("disabled", true);
		var barcode_id = $("#barcode-number").val();
		var barcode_regex = new RegExp(barcode_id, "i");
		var text_array = book_loans.toString();
		var result = text_array.search(barcode_regex);
		
		if(barcode_id != undefined)
		{
			if(result == -1)
			{
				/*--Book Details--*/
				
				$(".form-loader").show();
				$.post("load.php?page=return&link=details", 
				{
			        barcode_id: barcode_id
			    },
				    function (data, status)
				    {
				    	var reTurn = JSON.parse(data);
				    	if(reTurn.book_title != null)
				    	{
				    		$("#call-number").text(reTurn.call_number);
					    	$("#book-title").text(reTurn.book_title);
					    	$("#copyright-year").text(reTurn.copyright_year);
					    	$("#edition").text(reTurn.edition);
					    	$("#volume").text(reTurn.volume);
					    	$("#book-authors").text(reTurn.book_authors);
					    	$("#category").text(reTurn.classname);
					    	$("#publisher").text(reTurn.publisher_name);
					    	$("#isbn").text(reTurn.isbn);
				    		//Return Cart
					    	var new_row = $(document.createElement("tr")).attr("id", 'return-row-'+table_row);
					    	var td_call_number = $("#call-number").text();
					    	var td_book_title = $("#book-title").text();
					    	var td_copyright_year = $("#copyright-year").text();
					    	var td_edition = $("#edition").text();
					    	var td_volume = $("#volume").text();
					    	var td_authors = $("#book-authors").text();
					    	var td_category = $("#category").text();
					    	var td_publisher = $("#publisher").text();
					    	var td_isbn = $("#isbn").text();

					    	new_row.after().html('<input type="hidden" id="tr-barcode-'+table_row+'" value="'+barcode_id+'" /><td>'+td_call_number+'<td>'+td_book_title+'<td>'+td_authors+'<td>'+td_copyright_year+'<td>'+td_edition+'<td><td><td><center><button class="btn btn-danger btn-xs" onclick="removeFromCart('+table_row+')"><span class="fa fa-remove"></span></center></button></td>');
							new_row.appendTo(".return-table");
							//Borrow Cart

							$("#barcode-number").val("").focus();
							$(".book-details").show();
							$(".return-cart").show();
							$("#sum-rows-borrow").val(table_row);
							book_loans.push(barcode_id);
							table_row++;
				    	}
				    	else
				    	{
				    		$("#transaction-error").text(reTurn);
				    		$("#barcode-number").val("");
							$("#barcode-number").focus();
				    		showTransactionErrorResponse();
				    	}
				    	$("#check-return").attr("disabled", false);
						setTimeout('hideFormLoader()', 100);
				    }
			    );
				/*--/Book Details--*/


				/*--Borrower Details--*/
				$.post("load.php?page=return&link=user", 
				{
			        barcode_id: barcode_id
			    },
				    function (data, status)
				    {
				    	var borrower = JSON.parse(data);
				    	if(borrower.account_number)
				    	{
				    		$("#borrowerId").text(borrower.account_number);
				    		$("#borrower-id").text(borrower.account_number);
					    	$("#borrower-name").text(borrower.user_name);
							$("#borrower-type").text(borrower.user_type);
				    	}
				    }
			    );
				/*--/Borrower Details--*/
			}
			else
			{
				if(barcode_id != "")
				{
					$("#transaction-error").text("Book is in the process already.");
					$("#barcode-number").val("").focus();
					showTransactionErrorResponse();
				}
			}
		}
	});
});
function processReturn(boolean_value)
{
	var total_loads = parseInt($("#sum-rows-borrow").val());

	for(i=1;i<=total_loads;i++)
	{
		var barcode_id = $('#tr-barcode-'+i).val();
		var borrower_id = $("#borrower-id").text();
		if(barcode_id != "")
		{
			$.ajax(
			{
				url: "action/process.php?page=return",
				data: 'barcode-id='+barcode_id,
				type: "POST",
				beforeSend: function ()
				{
					$(".transaction-loader").show();
				},
				success: function(data, status)
				{
					$(".transaction-loader").hide();
					if(boolean_value == 1)
					{
						window.location='transaction.php?page=return&print='+borrower_id;
					}
					else
					{
						window.location='transaction.php?page=return';	
					}	
				}
			});
		}
	}
}
/*--/Return Book--*/

/*--/Renew Book--*/
$(document).ready(function()
{
	var table_row = 1;
	var book_loans = new Array();

	$("#check-renew").click(function()
	{
		$("#check-renew").attr("disabled", true);
		var barcode_id = $("#barcode-number").val();
		var barcode_regex = new RegExp(barcode_id, "i");
		var text_array = book_loans.toString();
		var result = text_array.search(barcode_regex);

		if(barcode_id != undefined)
		{
			if(result == -1)
			{
				/*--Book Details--*/
				$(".form-loader").show();
				$.post("load.php?page=renew&link=details", 
				{
			        barcode_id: barcode_id
			    },
				    function (data, status)
				    {
				    	var renew = JSON.parse(data);
				    	if(renew.book_title != null)
				    	{
				    		$("#call-number").text(renew.call_number);
					    	$("#book-title").text(renew.book_title);
					    	$("#copyright-year").text(renew.copyright_year);
					    	$("#edition").text(renew.edition);
					    	$("#volume").text(renew.volume);
					    	$("#book-authors").text(renew.book_authors);
					    	$("#category").text(renew.classname);
					    	$("#publisher").text(renew.publisher_name);
					    	$("#isbn").text(renew.isbn);
				    		//Return Cart
					    	var new_row = $(document.createElement("tr")).attr("id", 'return-row-'+table_row);
					    	var td_call_number = $("#call-number").text();
					    	var td_book_title = $("#book-title").text();
					    	var td_copyright_year = $("#copyright-year").text();
					    	var td_edition = $("#edition").text();
					    	var td_volume = $("#volume").text();
					    	var td_authors = $("#book-authors").text();
					    	var td_category = $("#category").text();
					    	var td_publisher = $("#publisher").text();
					    	var td_isbn = $("#isbn").text();

					    	new_row.after().html('<input type="hidden" id="tr-barcode-'+table_row+'" value="'+barcode_id+'" /><td>'+td_call_number+'<td>'+td_book_title+'<td>'+td_authors+'<td>'+td_copyright_year+'<td>'+td_edition+'<td><td><td><center><button class="btn btn-danger btn-xs" onclick="removeFromCart('+table_row+')"><span class="fa fa-remove"></span></center></button></td>');
							new_row.appendTo(".return-table");
							//Borrow Cart

							$("#barcode-number").val("").focus();
							$(".book-details").show();
							$(".renew-cart").show();
							$("#sum-rows-borrow").val(table_row);
							book_loans.push(barcode_id);
							table_row++;
				    	}
				    	else
				    	{
				    		$("#transaction-error").text(renew);
				    		$("#barcode-number").val("").focus();
				    		showTransactionErrorResponse();
				    	}
				    	$("#check-renew").attr("disabled", false);
						setTimeout('hideFormLoader()', 100);
				    }
			    );
				/*--/Book Details--*/

				/*--Borrower Details--*/
				$.post("load.php?page=renew&link=user", 
				{
			        barcode_id: barcode_id
			    },
				    function (data, status)
				    {
				    	var borrower = JSON.parse(data);
				    	if(borrower.account_number)
				    	{
				    		$("#borrower-id").text(borrower.account_number);
					    	$("#borrower-name").text(borrower.user_name);
							$("#borrower-type").text(borrower.user_type);
				    	}
				    }
			    );
				/*--/Borrower Details--*/
			}
			else
			{
				if(barcode_id != "")
				{
					$("#transaction-error").text("Book is in the process already.");
					$("#barcode-number").val("").focus();
					showTransactionErrorResponse();
				}
			}
		}
	});
});
function processRenew()
{
	var total_loads = parseInt($("#sum-rows-borrow").val());

	for(i=1;i<=total_loads;i++)
	{
		var barcode_id = $('#tr-barcode-'+i).val();
		if(barcode_id != "")
		{
			$.ajax(
			{
				url: "action/process.php?page=renew",
				data: 'barcode-id='+barcode_id,
				type: "POST",
				beforeSend: function ()
				{
					$(".transaction-loader").show();
				},
				success: function(data, status)
				{
					$(".transaction-loader").hide();
					window.location='transaction.php?page=renew&print='+barcode_id;
				}
			});
		}
	}
}
/*--/Renew Book--*/

/*--GUESS--*/
$(document).ready(function()
{
	$("#add-guest").submit(function(e)
	{
		$(this).ajaxSubmit(
		{
			beforeSend: function()
			{
				$("#form-loader").show();
				$("#submit-guest").attr("disabled", true);
			},
			success: function(data, status)
			{
				$("#form-loader").hide();
				showMaintenanceResponse();
				$("#submit-guest").attr("disabled", false);
				$(".guests-view").load("view_guests.php");
				$("#receipt-number").focus();
				
			},
			resetForm: true
		});
		return false;
	});
});
function showAddGuest()
{
	$(".guests-view").css("width", "70%");
	$(".guest-add").show();
}
function closeAddGuest()
{
	$(".guest-add").hide();
	$(".guests-view").css("width", "100%");
}
function hideGuestTransactionResponse()
{
	$(".modal-guest-response").hide();
	$("#logout-guest-modal").modal("hide");
	$("#relog-guest-modal").modal("hide");
}
function showGuestTransactionResponse()
{
	$(".modal-guest-response").show();	
	setTimeout('hideGuestTransactionResponse()', 1000);
}
/*--/GUESS--*/

/*--Guest Borrow--*/
function borrowGuestModal(guest_id)
{
	$("#guest-id-borrow").val(guest_id);
	$("#borrow-guest-modal").modal("show");
}
function borrowGuest()
{
	var guest_id = $("#guest-id-borrow").val();
	var barcode_id = $("#barcode-id").val();

	if(barcode_id != "")
	{
		$.ajax(
		{
			url: "action/process.php?page=guest-borrow",
			data: 'guest-id='+guest_id+'&barcode-id='+barcode_id,
			type: "POST",
			beforeSend: function()
			{
				$(".modal-loader").show();
				$("#borrow-guest").attr("disabled", true);
			},
			success: function(data, status)
			{
				$(".modal-loader").hide();
				showGuestTransactionResponse();

				var guest_response = JSON.parse(data);
				if(guest_response == "Book added!")
				{
					$(".guest-transaction-response").css("color", "green").text(guest_response);
				}
				else
				{
					$(".guest-transaction-response").css("color", "red").text(guest_response);
				}
				$(".guests-view").load("view_guests.php");
				$("#borrow-guest").attr("disabled", false);
				$("#barcode-id").val("").focus();
			}
		});
	}
}
function returnGuestModal(guest_id)
{
	$("#guest-id-return").val(guest_id);
	$("#return-guest-modal").modal("show");
}
function returnGuest()
{
	var guest_id = $("#guest-id-return").val();
	var barcode_id = $("#barcode-id-return").val();	

	if( barcode_id != "")
	{
		$.ajax(
		{
			url: "action/process.php?page=guest-return",
			data: 'guest-id='+guest_id+'&barcode-id='+barcode_id,
			type: "POST",
			beforeSend: function()
			{
				$(".modal-loader").show();
				$("#return-guest").attr("disabled", true);
			},
			success: function(data, status)
			{
				$(".modal-loader").hide();
				showGuestTransactionResponse();
				var return_response = JSON.parse(data);
				if(return_response == "Book returned!")
				{
					$(".guest-transaction-response").css("color", "green").text(return_response);
				}
				else
				{
					$(".guest-transaction-response").css("color", "red").text(return_response);
				}
				$(".guests-view").load("view_guests.php");
				$("#return-guest").attr("disabled", false);
				$("#barcode-id-return").val("").focus();

			}
		});
	}
}
function logoutGuestModal(guest_id)
{
	$("#guest-id-logout").val(guest_id);
	$("#logout-guest-modal").modal("show");
}
function logoutGuest()
{
	var guest_id = $("#guest-id-logout").val();
	$.ajax(
	{
		url: "action/logout_guest.php",
		data: 'guest-id='+guest_id,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#logout-guest").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			showGuestTransactionResponse();
			$("#logout-guest").attr("disabled", false);
			$(".guests-view").load("view_guests.php");
		}
	});
}
function relogGuestModal(guest_id)
{
	$("#guest-id-relog").val(guest_id);
	$("#relog-guest-modal").modal("show");
}
function relogGuest()
{
	var guest_id = $("#guest-id-relog").val();

	$.ajax(
	{
		url: "action/relog_guest.php",
		data: 'guest-id='+guest_id,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#relog-guest").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();	
			showGuestTransactionResponse();
			$("#relog-guest").attr("disabled", false);
			$(".guests-view").load("view_guests.php");
		}
	});
}

/*--/Guest Borrow--*/

/*--Reservation Remove--*/
function hideRemoveResponse()
{
	$(".modal-book-response").hide();
	$("#remove-reserve-modal").modal("hide");
}
function removeReserveResponse()
{
	$(".modal-book-response").show();
	setTimeout('hideRemoveResponse()', 1300);
}
function removeReserveModal(reservation_id)
{
	$("#reservation-id").val(reservation_id);
	$("#remove-reserve").attr("disabled", false);
	$("#remove-reserve-modal").modal("show");
}
function removeReserve()
{
	var reservation_id = $("#reservation-id").val();
	$.ajax(
	{
		url: "action/remove_reserve.php",
		data: 'reservation-id='+reservation_id,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#remove-reserve").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			$(".reservations-view").load("view_reserve.php");
			removeReserveResponse();
		}
	});
}
/*--/Reservation Remove--*/

/*--Password Change--*/
$(document).ready(function()
{
	$("#password-update").submit(function(e)
	{
		e.preventDefault();
		$(this).ajaxSubmit(
		{
			beforeSend:function ()
			{
				$(".form-loader").show();
			},
			success: function (data, status)
			{
				$(".form-loader").hide();
				var response = JSON.parse(data);
				$("#password-response").text(response);
				if(response = "Password successfully updated!")
				{
					$("#password-response").css("color", "green");
					$("#old-password").focus();
					showUpdatePassResponse();
				}
				else
				{
					$("#password-response").css("color", "red");
					$("#old-password").focus();
					showUpdatePassResponse();
				}
			},
			resetForm: true
		});
		return false;
	});

});
function hideUpdatePassResponse()
{
	$(".form-password-response").hide();
}
function showUpdatePassResponse()
{
	$(".form-password-response").show();	
	setTimeout('hideUpdatePassResponse()', 1300);
}
/*--/Password Change--*/

/*--Global Script--*/
function hideFormLoader()
{
	$(".form-loader").hide();	
}
function addImageResponseDisplay()
{
	$(".modal-image-response").show();
	setTimeout('hideImageResponse()', 1300);
}
function hideImageResponse()
{
	$(".modal-image-response").hide();
}
$(document).ready(function() 
{ 
	$(".books-view").load("view_books.php?filter=group");
	$(".archives-view").load("view_archived.php");
	$(".categories-view").load("view_categories.php");
	$(".authors-view").load("view_authors.php");
	$(".holidays-view").load("view_holidays.php");
	$(".publishers-view").load("view_publishers.php");
	$(".courses-view").load("view_courses.php");
	$(".departments-view").load("view_departments.php");
	$(".administrators-view").load("view_users.php?page=admin&view=all");
	$(".users-view").load("view_users.php?page=borrower&view=all");
	$(".inactives-view").load("view_users.php?page=inactive&view=all");
	$(".borrowed-view").load("view_borrow.php");
	$(".reservations-view").load("view_reserve.php");
	$(".guests-view").load("view_guests.php");
	$(".penalties-unpaid-view").load("view_penalties.php?page=unpaid");
	$(".penalties-paid-view").load("view_penalties.php?page=paid");
	$(".logs-view").load("view_userlogs.php");
	$(".authors-dropdown").load("dropdown_authors.php");
	$(".categories-dropdown").load("dropdown_categories.php");
	$(".publishers-dropdown").load("dropdown_publishers.php");
	$(".sub-authors-dropdown").load("dropdown_sub_authors.php");

	
});
/*--Global Script--*/
</script>

<!--SETTINGS-->
<script type="text/javascript">
$(document).ready(function()
{
	$(".settings-penalty").load("settings_penalty.php");
	$(".settings-quantity-books").load("settings_quantity_books.php");
	$(".settings-borrow-days").load("settings_borrow_days.php");
	$(".settings-reserve-days").load("settings_reserve_days.php");
});
function enableQuantityStudent()
{
	$("#quantity-student").attr("readonly", false);
	$("#update-quantity").attr("disabled", false);
	$("#quantity-student").focus();
}
function enableQuantityEmployee()
{
	$("#quantity-employee").attr("readonly", false);
	$("#update-quantity").attr("disabled", false);
	$("#quantity-employee").focus();
}
function enableBorrowDaysStudent()
{
	$("#borrow-student").attr("readonly", false);
	$("#update-borrow-days").attr("disabled", false);
	$("#borrow-student").focus();
}
function enableBorrowDaysEmployee()
{
	$("#borrow-employee").attr("readonly", false);
	$("#update-borrow-days").attr("disabled", false);
	$("#borrow-employee").focus();
}
function enableReserveDaysStudent()
{
	$("#reserve-student").attr("readonly", false);
	$("#update-reserve-days").attr("disabled", false);
	$("#reserve-student").focus();
}
function enableReserveDaysEmployee()
{
	$("#reserve-employee").attr("readonly", false);
	$("#update-reserve-days").attr("disabled", false);
	$("#reserve-employee").focus();
}
function enablePenaltyStudent()
{
	$("#amount-student").attr("readonly", false);
	$("#update-penalty").attr("disabled", false);
	$("#amount-student").focus();
}
function enablePenaltyEmployee()
{	
	$("#amount-employee").attr("readonly", false);
	$("#update-penalty").attr("disabled", false);
	$("#amount-employee").focus();
}
function updateQuantityBooks()
{
	var quantity_student = $("#quantity-student").val();
	var quantity_employee = $("#quantity-employee").val();

	if(quantity_student != "" && quantity_employee != "")
	{
		$.ajax(
		{
			url: "action/save_settings.php?page=quantity-books",
			data: 'quantity-student='+quantity_student+'&quantity-employee='+quantity_employee,
			type: "POST",
			beforeSend: function()
			{
				$("#update-quantity").attr("disabled", true);
				$("#quantity-submit-text").hide();
				$("#quantity-loader").show();
			},
			success: function(data, status)
			{
				$("#update-quantity").attr("disabled", false);
				$("#quantity-loader").hide();
				$("#quantity-submit-text").show();
				$(".settings-quantity-books").load("settings_quantity_books.php");
			}
		});
	}
}
function updateBorrowDays()
{
	var days_student = $("#borrow-student").val();
	var days_employee = $("#borrow-employee").val();
	if(days_student != "" && days_employee != "")
	{
		$.ajax(
		{
			url: "action/save_settings.php?page=allowed-days&type=borrow",
			data: 'days-student='+days_student+'&days-employee='+days_employee,
			type: "POST",
			beforeSend: function()
			{
				$("#update-borrow-days").attr("disabled", true);
				$("#borrow-submit-text").hide();
				$("#borrow-loader").show();
			},
			success: function(data, status)
			{
				$("#update-borrow-days").attr("disabled", false);
				$("#borrow-loader").hide();
				$("#borrow-submit-text").show();
				$(".settings-borrow-days").load("settings_borrow_days.php");
			}
		});
	}
}
function updateReserveDays()
{
	var days_student = $("#reserve-student").val();
	var days_employee = $("#reserve-employee").val();
	if(days_student != "" && days_employee != "")
	{
		$.ajax(
		{
			url: "action/save_settings.php?page=allowed-days&type=reserve",
			data: 'days-student='+days_student+'&days-employee='+days_employee,
			type: "POST",
			beforeSend: function()
			{
				$("#update-reserve-days").attr("disabled", true);
				$("#reserve-submit-text").hide();
				$("#reserve-loader").show();
			},
			success: function(data, status)
			{
				$("#update-reserve-days").attr("disabled", false);
				$("#reserve-loader").hide();
				$("#reserve-submit-text").show();
				$(".settings-reserve-days").load("settings_reserve_days.php");
			}
		});
	}
}
function updatePenalty()
{
	var penalty_student = $("#amount-student").val();
	var penalty_employee = $("#amount-employee").val();
	if(penalty_employee != "" && penalty_student != "")
	{
		$.ajax(
		{
			url: "action/save_settings.php?page=penalty",
			data: 'penalty-student='+penalty_student+'&penalty-employee='+penalty_employee,
			type: "POST",
			beforeSend: function()
			{
				$("#update-penalty").attr("disabled", true);
				$("#penalty-submit-text").hide();
				$("#penalty-loader").show();
			},
			success: function(data, status)
			{
				$("#update-penalty").attr("disabled", false);
				$("#penalty-loader").hide();
				$("#penalty-submit-text").show();
				$(".settings-penalty").load("settings_penalty.php");
			}
		});
	}
}
function disableFields()
{
	$("#amount-student").attr("readonly", true);
	$("#amount-employee").attr("readonly", true);
	$("#update-penalty").attr("disabled", true);
	$("#borrow-student").attr("readonly", true);
	$("#borrow-employee").attr("readonly", true);
	$("#update-borrow-days").attr("disabled", true);
}
</script>
<!--/SETTINGS-->

<!--PENALTY-->
<script type="text/javascript">
function hideClearPenaltyResponse()
{
	$("#modal-penalty-response").hide();
	$("#clear-penalty-modal").modal("hide");
	$("#edit-payment-modal").modal("hide");
}
function showClearPenaltyResponse()
{
	$(".modal-penalty-response").show();
	setTimeout('hideClearPenaltyResponse()', 1000);
}
function clearPenaltyModal(penalty_id)
{
	$("#penalty-id").val(penalty_id);
	$("#clear-penalty").attr("disabled", false);
	$("#clear-penalty-modal").modal("show");
}
function clearPenalty()
{
	var penalty_id = $("#penalty-id").val();
	var receipt_number = $("#receipt-number").val();
	var date_paid = $("#date-paid").val();
	if(receipt_number != "" && date_paid != "")
	{
		$.ajax(
		{
			url: "action/clear_penalty.php",
			data: 'penalty-id='+penalty_id+'&receipt-number='+receipt_number+'&date-paid='+date_paid,
			type: "POST",
			beforeSend: function()
			{
				$(".modal-loader").show();
				$("#clear-penalty").attr("disabled", true);
			},
			success: function(data, status)
			{
				$(".modal-loader").hide();
				showClearPenaltyResponse();
				$(".penalties-unpaid-view").load("view_penalties.php?page=unpaid");
			}
		});
	}
}
function editPaymentModal(penalty_id)
{
	$.post("action/read_payment_info.php",
	{
		penalty_id: penalty_id
	},
		function (data, status)
		{
			var penalty = JSON.parse(data);
			$("#edit-penalty-id").val(penalty_id);
			$("#edit-receipt-number").val(penalty.receipt_number);
			$("#edit-date-paid").val(penalty.date_paid);
		}
	);
	$("#update-payment").attr("disabled", false);
	$("#edit-payment-modal").modal("show");
}
function updatePaymentInfo()
{
	var penalty_id = $("#edit-penalty-id").val();
	var receipt_number = $("#edit-receipt-number").val();
	var date_paid = $("#edit-date-paid").val();

	if(receipt_number != "" && date_paid != "")
	{
		$.ajax(
		{
			url: "action/update_payment_info.php",
			data: 'penalty-id='+penalty_id+'&receipt-number='+receipt_number+'&date-paid='+date_paid,
			type: "POST",
			beforeSend: function()
			{
				$(".modal-loader").show();
				$("#update-payment").attr("disabled", true);
			},
			success: function(data, status)
			{
				$(".modal-loader").hide();
				showClearPenaltyResponse();
				$(".penalties-paid-view").load("view_penalties.php?page=paid");
			}
		});
	}
}
function filterUnpaidPenalty()
{
	window.location='penalty.php?page=unpaid';
}
function filterPaidPenalty()
{
	window.location='penalty.php?page=paid';	
}
</script>
<!--/PENALTY-->