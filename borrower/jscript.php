<script>
$(document).ready(function()
{
	$(".books-view").load("view_books.php");
	$(".reserve-view").load("view_reserve.php");

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
					$("old-password").focus();
					showUpdatePassResponse();
				}
			},
			resetForm: true
		});
		return false;
	});

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
function hideUpdatePassResponse()
{
	$(".form-password-response").hide();
}
function showUpdatePassResponse()
{
	$(".form-password-response").show();	
	setTimeout('hideUpdatePassResponse()', 1300);
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
function hideReserveResponse()
{
	$(".modal-book-response").hide();
	$("#reserve-book-modal").modal("hide");
}
function showReseveResponse()
{
	$(".modal-book-response").show();
	setTimeout('hideReserveResponse()', 1300);
}
function reserveBookModal(book_id)
{
	$("#book-id").val(book_id);
	$("#reserve-book").attr("disabled", false);
	$("#reserve-book-modal").modal("show");
}
function reserveBook()
{
	var book_id = $("#book-id").val();
	$.ajax(
	{
		url: "action/reserve_book.php",
		data: 'book-id='+book_id,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#reserve-book").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			showReseveResponse();
			$('#call-modal-'+book_id).attr("disabled", true);
			$(".books-view").load("view_books.php");
		}
	});
}
function hideRemoveResponse()
{
	$(".modal-book-response").hide();
	$("#remove-reserve-modal").modal("hide");
}
function showRemoveResponse()
{
	$(".modal-book-response").show();
	setTimeout('hideRemoveResponse()', 1300);
}
function removeReserveModal(book_id)
{
	$("#book-id").val(book_id);	
	$("#remove-reserve-modal").modal("show");
	$("#remove-reserve").attr("disabled", false);
}
function removeReserve()
{
	var book_id = $("#book-id").val();

	$.ajax(
	{
		url: "action/remove_reserve.php",
		data: 'book-id='+book_id,
		type: "POST",
		beforeSend: function()
		{
			$(".modal-loader").show();
			$("#remove-reserve").attr("disabled", true);
		},
		success: function(data, status)
		{
			$(".modal-loader").hide();
			showRemoveResponse();
			$(".reserve-view").load("view_reserve.php");
		}
	});
}
function bookImageModal(book_id)
{

	$.post("action/read_book_image.php",
	{
		book_id: book_id
	},
		function (data, status)
		{
			var image = JSON.parse(data);
			$("#image-book-title").text(image.book_title);
			if(image.book_image != "")
	    	{
	    		$("#view-book-image").attr("src", '../admin/uploads/books/'+image.book_image);
	    	}
	    	else
	    	{
	    		$("#view-book-image").attr("src", "../admin/uploads/books/default.jpg");	
	    	}
		}
	);
	$("#book-image-modal").modal("show");
}
</script>