<style>
/*--Main Style---*/
body
{
	font-size:14px;
	margin-left: 20px;
	margin-right: 20px;
}
.home-body
{
	padding:20px;
	background-color:#f2f2f2;
	display:inline-block;
}
.college-info
{
	font-size: 16px;
	padding:0px;
	width:50%;
	float:right;
}
#myCarousel
{
	width:45%;
}
#myCarousel img
{
	border-radius:8px;
	border:2px groove #eeeeee;
}
#school-name
{
	font-size: 30px;
	font-weight: bolder;
}
.action-buttons
{
	width:85px;
	padding:0px 7px;
}
.current-date
{
	padding:3px;
	font-size:15px;
	float:right;
}
.select2
{
	width:100%;
}
.filter-navbar
{
	margin:auto;
	width:205px;
	margin-bottom: 10px;
}
.filter-menu
{
	padding:10px;
	width:255px;
	border:1px dotted gray;
	position:absolute;
	margin-left:35%;
}
.filter-menu button 
{
	font-size:16px;
	border-radius:0px;
}
.form-body
{
	padding:15px;
}
.form-buttons
{
	margin-top:25px;
	float:right;
}
.form-closer
{
	margin-top:10px;
	margin-right:15px;
}
.transaction-loader
{
	margin-top:5px;
	font-size:17px;
	position:absolute;	
	color:green;
	margin-left:25%;
	display:none;
}
.form-loader
{
	color:green;
	font-size: 30px;
	margin-top:20px;
	margin-left:10%;
	position:absolute;
	display:none;
}
.header-success
{
	padding:10px;
	font-size:18px;
	margin-bottom:0px;
	background-color:lightblue;
}
.modal-content
{
	border-radius:0px;
	margin:auto;
}
.modal-header
{
	padding:10px 20px;
	background-color:#4CAF50;
	color:white;
}
.btn 
{
	border-radius:0px;
}
.modal-loader
{
	margin-top:10px;
	font-size: 30px;
	margin-left: 46%;
	position:absolute;
	color:green;
	display:none;
}
.modal-image-loader
{
	margin-top:10px;
	font-size: 30px;
	margin-left:35%;
	position:absolute;
	color:green;
	display:none;
}
.modal-image-response
{
	margin-top:15px;
	font-size: 18px;
	margin-left:5%;
	position:absolute;
	color:green;
	display:none;
}
.modal-image
{
	margin-left:23px;
	width:250px;
	height:250px;
	padding:5px; 
	border:2px groove #CCCCCC;
	border-radius:0px;
}
#modal-dialog-image
{
	width:335px;
}
.page-header
{
	background-color:#4CAF50;
	padding:10px 20px;
	color:white;
	font-size:18px;
	border:none;	
	margin-top:0px;
	margin-bottom:10px;
}
.page-body
{
	padding:30px;
	margin-top:0px;
	width:100%;
 	background-color:#5f5f5f;
 	display:inline-block;
}
.page-footer
{
	font-size:15px;
	padding:10px;
	color:white;
	background-color:#4CAF50;
}
.login-head
{
	font-size:25px;
	padding:2px 20px;
	color:white;
	background-color:#4CAF50;
}
.login-header
{
	background-color:#4CAF50;
	padding:10px 20px;
	color:white;
	font-size:18px;
	border:none;	
}
.table-loader
{
	position:absolute;
	font-size: 30px;
	color:green;
	margin-left:24%;
	display:none;
}
.table-checkbox
{
	display:none;
}
.table-images
{
	width:75px;
	height:95px;
	padding:2px; 
	border:2px groove #CCCCCC;
	border-radius:0px;
}
.span-error
{
	color:red;
	padding:2px;
	background-color:#c8f7c8;
	font-size:14px;
	position:absolute;
	display:none;
}
.sub-menu
{
	font-size:18px;
}
.sub-menu ul 
{
	width:20%;
	padding:0px;
	margin:0px;
	list-style:none;	
	background-color:white;
}
.sub-menu li 
{
	padding:5px;
	border:1px solid gray;
}
.sub-menu a 
{
	display:block;
	text-decoration:none;
}
.barcode-image
{
	border:1px solid black;
	width:75%;
	padding:15px;
}
#close-form
{
	font-size:25px;
	padding:0px 5px;
	margin:5px;
	float:right;
	border:1px solid black;
}
/*--/Main Style--*/

/*--/DASH BOARD--*/
.dashboard
{
	width:100%;
	padding:10px;
	background-color:#eeeeee;
	margin-top:10px;
	display: inline-block;
}
.dash-row-1,
.dash-row-2,
.dash-row-3
{
	width: 55%;
	float:right;
}
.dash-users
{
	border-radius:5px;
	height:150px;
	width:29%;
	padding:10px;
	font-size:22px;
	text-align:center;
	color:white;
	background:radial-gradient(#ffe066, #e6b800);
	float:right;
	margin:5px;
}
.dash-online-users
{
	border-radius:5px;
	height:150px;
	width:29%;
	padding:10px;
	font-size:22px;
	text-align:center;
	color:white;
	background:radial-gradient(#ff944d, #ff6600);
	float:right;
	margin:5px;
}
.dash-guests
{
	border-radius:5px;
	height:150px;
	width:29%;
	padding:10px;
	font-size:22px;
	text-align:center;
	color:white;
	background:radial-gradient(#d98c8c, #ac3939);
	float:right;
	margin:5px;
}
.dash-holdings
{
	border-radius:5px;
	height:150px;
	width:29%;
	padding:10px;
	font-size:22px;
	text-align:center;
	color:white;
	background:radial-gradient(#6699ff, #0055ff);
	float:right;
	margin:5px;
}
.dash-borrowed
{
	border-radius:5px;
	height:150px;
	width:29%;
	padding:10px;
	font-size:22px;
	text-align:center;
	color:white;
	background:radial-gradient(#aad4ab, #56a958);
	float:right;
	margin:5px;
}
.dash-reservations
{
	border-radius:5px;
	height:150px;
	width:29%;
	padding:10px;
	font-size:22px;
	text-align:center;
	color:white;
	background:radial-gradient(#ff8080, #ff4d4d);
	float:right;
	margin:5px;
}
.dash-admin
{
	border-radius:5px;
	height:150px;
	width:29%;
	padding:10px;
	font-size:22px;
	text-align:center;
	color:white;
	background:radial-gradient(#99ffe6, #00e6ac);
	float:right;
	margin:5px;
}
.dash-staff
{
	border-radius:5px;
	height:150px;
	width:29%;
	padding:10px;
	font-size:22px;
	text-align:center;
	color:white;
	background:radial-gradient(#ccb3ff, #9966ff);
	float:right;
	margin:5px;
}
.dash-unpaids
{
	border-radius:5px;
	height:150px;
	width:29%;
	padding:10px;
	font-size:22px;
	text-align:center;
	color:white;
	background:radial-gradient(#ff80ff, #b300b3);
	float:right;
	margin:5px;
}
.dash-users:hover,
.dash-admin:hover,
.dash-staff:hover,
.dash-borrowed:hover,
.dash-guests:hover,
.dash-holdings:hover,
.dash-reservations:hover,
.dash-unpaids:hover,
.dash-online-users:hover
{
	opacity:0.6;
}
.total-count
{
	font-size:30px;
	font-weight:bold;
	margin:15px;
}
/*--/DASH BOARD--*/

/*--MAINTENANCE--*/
.maintenance-submenu
{
	margin-left: 10px;
	background-color:#4CAF50;
	width:15.7%;
	float:right;
	padding:10px;
}
.maintenance-submenu nav
{
	list-style:none;
	background-color: white;
}
.maintenance-submenu li a
{
	border-radius: 0px;
	display:inline-block;
	padding:5px 15px;
	font-size: 17px;
	display: block;
	text-decoration:none;
}
/*--/MAINTENANCE--*/

/*--Author's Style--*/
.author-add
{
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size: 16px;
	height:295px;
	float:right;
	width:29%;	
	display:none;
}
.author-form
{
	padding:20px;
	margin:0px;
}
.authors-view
{
	padding:20px;
	width:83.5%;
	background:linear-gradient(to right, #99ff99, #f0f0f0);
}
.modal-author-response
{
	margin-top:10px;
	font-size: 18px;
	margin-left:25%;
	position:absolute;
	color:green;
	display:none;
}
.form-maintenance-response
{
	margin-top:20px;
	font-size: 16px;
	position:absolute;
	color:green;
	display:none;
}
.sub-authors-class
{
	display:none;
}
#sub-authors
{
	background-color:#f2f2f2;
}
#show-add
{
	font-size:16px;
	border:0px;
	float:right;
}
#show-add:hover
{
	color:darkblue;
}
#sub-authors-label
{
	display:none;
}
/*--Author's Style--*/
/*--Holidays's Style--*/
.holidays-add
{
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size: 16px;
	height:370px;
	float:right;
	width:29%;	
	display:none;
}
.holiday-form
{
	padding:15px 20px;
}
.holidays-view
{
	background:linear-gradient(to right, #99ff99, #f0f0f0);
	padding:20px;
	width:83.5%;
}
.modal-holiday-response
{
	margin-top:10px;
	font-size: 18px;
	margin-left:23%;
	position:absolute;
	color:green;
	display:none;
}
/*--/Holidays's Style--*/

/*--Book's Style--*/
.add-book-column-1
{
	width:49%;
	float:left;
	margin-bottom:20px;
}
.add-book-column-2
{
	width:49%;
	float:right;
}
.add-book-copy
{
	height:275px;
	width:34%;
	background:radial-gradient(#f0f0f0, #99ff99);
	float:right;
	display:none;
}
.add-book-copy form
{
	padding:15px;
}
.book-add
{
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size: 16px;
	width:100%;
	display:inline-block;
}
.book-add form
{
	padding:20px;
}
.books-view,
.archives-view,
.reserve-view,
.reservations-view,
.penalties-paid-view,
.penalties-unpaid-view,
.borrowed-view,
.logs-view
{
	background:linear-gradient(to right, #99ff99, #f0f0f0);
	padding:10px;
	margin-top:10px;
}
.book-infos
{
	background:linear-gradient(to left, #99ff99, #f0f0f0);
	padding:10px;
	width:54.2%;
	float:right;
	display:none;
}
.book-information
{
	width:65%;
}
.book-image
{
	width:35%;
	float:right;
}
#barcode-range-error
{
	font-size:15px;
	margin:20px;
	color:red;
	position:absolute;
	display:none;
}
.book-image img 
{
	width:225px;
	height:285px;
	padding:5px; 
	background-color:white;
	border:3px groove #CCCCCC;
}
.book-authors-table
{
	width:100%;
	padding:5px;
}
#return-page-book
{
	border-radius:20px;
}
.modal-book-response
{
	margin-top:10px;
	font-size: 18px;
	margin-left:25%;
	position:absolute;
	color:green;
	display:none;
}
.book-form-response
{
	margin-top:30px;
	margin-left:10px;
	font-size: 18px;
	color:green;
	display:none;
}
#add-copy-response
{
	margin-top:25px;
	margin-left:10px;
	font-size: 16px;
	float:left;
	color:green;
	display:none;
}
/*--/Book's Style--*/

/*--Category's Maintenance--*/
.category-add
{
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size: 16px;
	height:165px;
	float:right;
	width:29%;	
	display:none;
}
.categories-view
{
	padding:20px;
	width:83.5%;
	background:linear-gradient(to right, #99ff99, #f0f0f0);
}
.modal-category-response
{
	margin-top:10px;
	font-size: 18px;
	margin-left:23%;
	position:absolute;
	color:green;
	display:none;
}
/*--/Category's Maintenance--*/

/*--Course's Maintenance--*/
.course-add
{
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size: 16px;
	height:245px;
	float:right;
	width:29%;	
	display:none;
}
.courses-view
{
	padding:20px;
	width:83.5%;
	background:linear-gradient(to right, #99ff99, #f0f0f0);
}
.course-form
{
	padding:15px 20px;
}
.modal-course-response
{
	margin-top:10px;
	font-size: 18px;
	margin-left:23%;
	position:absolute;
	color:green;
	display:none;
}
/*--/Course's Maintenance--*/

/*--Department's Maintenance--*/
.department-add
{
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size: 16px;
	height:245px;
	float:right;
	width:29%;	
	display:none;
}
.department-add form
{
	padding:15px 20px;
}
.departments-view
{
	padding:20px;
	width:83.5%;
	background:linear-gradient(to right, #99ff99, #f0f0f0);
}
.modal-department-response
{
	margin-top:10px;
	font-size: 18px;
	margin-left:23%;
	position:absolute;
	color:green;
	display:none;
}
/*--/Department's Maintenance--*/


/*--Publisher's Style--*/
.publisher-add
{
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size: 16px;
	height:375px;
	float:right;
	width:29%;
	display:none;
}
.publisher-form
{
	padding:20px;
	margin:0px;
}
.publishers-view
{
	background:linear-gradient(to right, #99ff99, #f0f0f0);
	padding:20px;
	width:83.5%;
}
.modal-publisher-response
{
	margin-top:10px;
	font-size: 18px;
	margin-left:23%;
	position:absolute;
	color:green;
	display:none;
}
/*--/Publisher's Style--*/

/*--Guest's Maintenance--*/
.guest-add
{
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size: 16px;
	height:370px;
	float:right;
	width:29%;	
	display:none;
}
.guests-view
{
	padding:20px;
	width:100%;
	background:linear-gradient(to right, #99ff99, #f0f0f0);
}
.modal-guest-response
{
	margin-top:10px;
	font-size: 18px;
	margin-left:23%;
	position:absolute;
	color:green;
	display:none;
}
.guest-action-buttons
{
	width:105px;
}
/*--Guest's Style--*/

/*--User's Style--*/
.admin-form
{
	width:29%;
	height:220px;
	float:right;
	background:radial-gradient(#f0f0f0, #99ff99);
	display:none;
}
.admin-form-body
{
	padding:15px 20px;
}
.login-body
{
	padding:30px;
	margin-top:0px;
	height:550px;
 	background-image:url('images/background.jpg');
    background-position:left top;
    background-attachment:fixed;
    background-size:1319px 610px;
   	background-repeat:no-repeat;
}
.login-page form
{
	margin-top:10px;
	padding:5px 20px;
}
.login-page
{
	margin:auto;
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size: 16px;
	height:260px;
	width:400px;	
}
.account-settings
{
	margin:auto;
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size: 16px;
	height:345px;
	width:700px;	
}
.password-change form,
.account-settings form
{
	padding:20px;
}
.password-change
{
	margin:auto;
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size: 16px;
	height:335px;
	width:500px;	
}
.admin-form-response,
.login-response
{
	margin-top:20px;
	font-size: 16px;
	position:absolute;
	color:green;
	display:none;
}
#login-first
{
	color:white;
	padding:1px 10px;
	font-size:14px;
	background-color:orange;
}
.user-form-response
{
	margin-top:25px;
	font-size:18px;
	position:absolute;
	color:green;
	display:none;
}
.user-add
{
	width:30%;
	font-size: 16px;
	height:585px;
	background:radial-gradient(#f0f0f0, #99ff99);
	float:right;
	display:none;
}
.user-form
{
	padding:15px;
}
.users-view,
.administrators-view,
.inactives-view
{
	padding:10px;
	margin-top:10px;
	background:linear-gradient(to right, #99ff99, #f0f0f0);
}
.student-number-class,
.employee-number-class,
.department-id-class,
.course-id-class
{
	display:none;
}
.modal-user-response
{
	margin-top:10px;
	font-size: 18px;
	margin-left:25%;
	position:absolute;
	color:green;
	display:none;
}
#password-matched-error
{
	position:absolute;
	margin-top:5px;
	font-size:16px;
	color:red;
	display:none;
}
#show-add-admin
{
	font-size:16px;
	float:right;
	margin:10px; 
	margin-bottom:20px;
}
#saved-response
{
	color:green;
	display:none;
	position:absolute;
	margin-top:30px;
}
/*--/User's Style--*/

/*--Transactions--*/
.borrow-form
{
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size:16px;
	height:220px;
	width:35%;
	padding:20px 15px;
	margin:0px;
}
.return-form
{
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size:16px;
	height:160px;
	width:35%;
	padding:20px 15px;
	margin:0px;
}
.renew-form
{
	background:radial-gradient(#f0f0f0, #99ff99);
	font-size:16px;
	height:160px;
	width:35%;
	padding:20px 15px;
	margin:0px;
}
.borrow-cart
{
	background:radial-gradient(#f0f0f0, #99ff99);
	padding:15px;
	float:right;
	width:64%;
	display:none;
}
.return-cart
{
	background:radial-gradient(#f0f0f0, #99ff99);
	padding:15px;
	float:right;
	width:64%;
	display:none;
}
.renew-cart
{
	background:radial-gradient(#f0f0f0, #99ff99);
	padding:15px;
	float:right;
	width:64%;
	display:none;
}
.borrower-info
{
	margin-bottom:15px;
}
.borrow-table,
.return-table
{
	background-color:white;
}
.book-details
{
	background:radial-gradient(#f0f0f0, #99ff99);
	margin-top:10px;
	padding:1px 15px;
	width:35%;
	display:none;
}
.book-details strong
{
	margin-left:10px;
}
.borrow-receipt
{
	padding:3px 5px;
	font-size:9px;
	width:200px;
	border:1px solid black;
}
.receipt-header
{
	font-size:9.5px;
	margin-bottom:5px;
}
.receipt-footer
{
	font-style:italic;
	font-size:9.5px;
	margin:5px;	
}
.transaction-table
{
	margin-top:5px;
	margin-bottom:5px;
	width:100%;
}
#transaction-error
{
	margin-top:15px;
	position:absolute;
	color:red;
	display:none;
}
/*--/Transactions--*/

.form-password-response
{
	margin-top:20px;
	font-size: 17px;
	position:absolute;
	color:green;
	display:none;
}
</style>
<style>
.settings-form
{
	width:290px;
	background-color:white;
	margin-left:10px;
	margin-bottom:10px;
	float:right;
}
.settings-header
{
	padding:7px 15px;
	font-size:17px;
	color:white;
	background-color:#4CAF50;
}
.settings-footer
{
	padding:7px 0px;
	font-size:18px;
	color:white;
	border-top:0.5px solid #e5e5e5;
	text-align:center;
}
.settings-footer button
{
	margin:0px;
	width:95%;
}
.settings-fields
{
	padding:10px;
}
.settings-fields button
{
	margin-top:25px;
	margin-left:5px;
}
#form-loader,
#penalty-loader,
#button-loader,
#borrow-loader,
#reserve-loader,
#quantity-loader
{
	margin:auto;
	font-size:18px;
	line-height:20px;
	display:none;
}
.modal-penalty-response
{
	margin-top:10px;
	font-size: 18px;
	margin-left:25%;
	position:absolute;
	color:green;
	display:none;
}
.reports-form
{
	width:100%;
	padding:15px 30px;
	display:block;
	margin:auto;
	background-color: white;
}
.reports-form input
{
	margin-right: 5px;
}
.reports-preview
{
	padding:15px;
	background-color:#e6e6e6;
	display:none;
}
.reports-preview table
{
	background-color:white;
}
.report-label
{
	font-size:25px;
	margin-bottom:5px;
}
.button-submit
{
	width:100px;
}
</style>