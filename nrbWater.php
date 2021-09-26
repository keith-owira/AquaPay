<?php

include_once 'functions/db.php';
include_once 'functions/auth.php';
?>

<html>
	<head>
		<title>Nairobi Water</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<style>
			body
			{
				margin:0;
				padding:0;
				background-color:#f1f1f1;
			}
			.box
			{
				width:1270px;
				padding:20px;
				background-color:#fff;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>
	</head>
	<body>
		<div class="container box">
			<h1 align="center">Water Payment Table</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="20%">First Name</th>
							<th width="20%">Last Name</th>
							<th width="20%">Account</th>
							<th width="15%">Bill</th>
							<th width="15%">Status</th>
							<th width="10%">Date From</th>
							<th width="20%">Date to</th>
							<th width="10%">Edit</th>
							<th width="10%">Delete</th>
						</tr>
					</thead>
				</table>
				
			</div>
		</div>
	</body>
</html>

<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add User</h4>
				</div>
				<div class="modal-body">
					<select class="form-select form-control" aria-label="Default select example" name="accno" id="accno" readonly>
					  <option selected>Open this select menu</option>
					  	<?php echo getUsers($connect); ?>
					</select>
					<br/>
					<label>Enter Bill</label>
					<input type="text" name="bill" id="bill" class="form-control" />
					<br />
					<label>Enter Date From</label>
					<input type="date" name="datefrom" id="datefrom" class="form-control" />
					<br />
					<label>Enter Date to</label>
					<input type="date" name="dateto" id="dateto" class="form-control" />
					<br />
				</div>
				<input type="text" name="addBill" id="addB" hidden>
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Add User");
		$('#action').val("Add");
		$('#operation').val("Add");
		$('#user_uploaded_image').html('');
	});
	
	var dataTable = $('#user_data').DataTable({
		
		"ajax":{
			url:"login_action.php?fetch_bill"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":false,
			},
		],

	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		
			$.ajax({
				url:"login_action.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
			
		
	});
	
	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		var editaction ="Sent";
		$.ajax({
			url:"login_action.php",
			method:"POST",
			data:{user_id:user_id,editaction:editaction},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#bill').val(data.bill);
				$('#datefrom').val(data.datefrom);
				$('.modal-title').text("Edit User");
				$('#user_id').val(user_id);
				$('#accno').val(data.accno);
				$('#dateto').val(data.dateto);
				$('#addB').attr('name','updateaction');
				
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		var deleteaction ="Sent";
		if(confirm("Are you sure you want to delete this?"))
		{
			$.ajax({
				url:"login_action.php",
				method:"POST",
				data:{user_id:user_id,deleteaction:deleteaction},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});
</script>