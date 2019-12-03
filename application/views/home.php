<?php  
$this->load->view('header'); 
?>

<title>Home</title>
<style type="text/css">
	.switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 34px;
	}

	.switch input { 
		opacity: 0;
		width: 0;
		height: 0;
	}

	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 26px;
		width: 26px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}

	input:checked + .slider {
		background-color: #2196F3;
	}

	input:focus + .slider {
		box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
		border-radius: 34px;
	}

	.slider.round:before {
		border-radius: 50%;
	}
</style>
</head>
<body>
	<div class="container">
		<div class="container-fluid">



			<h1 class="text-center" style="margin: 50px;">List</h1>




			<!-- Flashadata -->
			<div id="addmsg">
			</div>
			
			<?php 






			if ($this->session->flashdata('update_msg')) {
				?>
				<div class="alert alert-success alert-dismissible">
					<span class="close" data-dismiss="alert" aria-label="close">&times;</span>
					<?php echo $this->session->flashdata('update_msg'); ?>
				</div>
			<?php }


			if ($this->session->flashdata('delete_msg')) {
				?>
				<div class="alert alert-danger alert-dismissible">
					<span class="close" data-dismiss="alert" aria-label="close">&times;</span>
					<?php echo $this->session->flashdata('delete_msg'); ?>
				</div>
			<?php }
			?>

			<!-- End of flashdata -->


			<a href="#" class="btn btn-info" style="margin-bottom: 10px" data-toggle="modal" data-target="#addusermodal">Add User</a>
			<div class="modal fade" id="addusermodal"  aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Add User</h4>
						</div>
						<form action="javascript:;" method="post" class="form" >
							<div class="modal-body">
								<!--    -->

								


<!-- <div class="alert alert-danger alert-dismissible"><span class="close" data-dismiss="alert" aria-label="close">&times;</span></div> -->

								
								<div class="form-group">
									<input class="form-control" type="text" id="fname" name="fname" placeholder="Enter your First Name">
								</div>
								<div class="error">
									<?php echo form_error('fname'); ?>
								</div>
								<div class="form-group">
									<input class="form-control" type="text" id="lname" name="lname" placeholder="Enter your Last Name">
								</div>

								<div class="form-group">
									<select name="gender" class="form-control" id="gender">
										<option hidden>Choose your Gender</option>
										<option value="male">Male</option>
										<option value="female">Female</option>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								<button type="submit" id="confirm" class="btn btn-info" name="adduser">Add User</button>
							</div>
						</form>
					</div>
				</div>
			</div>


			<button class="btn btn-info" style="float: right;" onclick="window.location.reload();">Refresh</button>








			<!-- Page Content -->

			<table class="table">
				<thead class="text-center">
					<tr>
						<th scope="col">Sr.No.</th>
						<th scope="col">Name</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody class="text-center">
					<?php
					$i=1;

					foreach ($users as $rows){
						?>
						<tr>

						 <?php  $id=$rows['id']; ?>

							
							<td><?php echo $i; ?> </td>
							
							<td><?php echo $rows['f_name']." ".$rows['l_name']; ?></td>	
							<td id="sw">
								<label class="switch">
									<input type="checkbox"<?php if ($rows['status']=='active') {echo "checked";} ?> id="status_<?=$rows['id'];?>" name="status" data-status="<?=$rows['status'];?>" data-key="<?=$rows['id'];?>">
									<span class="slider round"></span>
								</label>
							</td>
							<td>
								<a href="update?id=<?=$id?>"><button class="btn btn-info">Update</button></a>
								<button class="btn btn-danger" data-toggle="modal" data-target="#confmDelete_<?=$rows['id'];?>">Delete</button>




								<div class="modal fade" id="confmDelete_<?=$rows['id'];?>" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Delete User</h4>
											</div>
											<div class="modal-body">
												<p>Are you Sure to Delete User ?</p>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
												<a href="delUser?id=<?=$rows['id'];?>"><button type="button" class="btn btn-info" id="confirm">Yes</button></a>
											</div>
										</div>
									</div>
								</div>

							</td>
						</tr>

						<?php 	 
						$i++;
					} 

					?>	

				</tbody>

			</table>
			<!-- End Page Content -->

		</div>
	</div>
</body>
<script type="text/javascript">
	$(function(){



		$("#confirm").click(function(){
			var fname = $('#fname').val();
			var lname = $('#lname').val();
			var gender = $('#gender').val();

			$.ajax({
				type: 'POST',
				url: 'adduser',
				async : false,
				data: {fname:fname,lname:lname,gender:gender},
				success: function(data)
				{
					console.log(data);
					$("#addmsg").text('');
					$("#addmsg").append('<div class="alert alert-success alert-dismissible">'+
						'<span class="close" data-dismiss="alert" aria-label="close">&times;</span>'+
						'User Added Successfully...!!!'+
						'</div>');
					//$('tr').append();
				},
			});
			
			$('#addusermodal').modal('hide');

		});
	});



	$('input:checkbox').click(function(){
		var checked = $(this).is(':checked');
		var status = $(this).attr("data-status");
		var id = $(this).attr("data-key");
		if(checked) {
			if(confirm('Are you sure to Enable the Status of this User ?')){         
				$(this).attr("checked", "checked");
				var newStatus = "active";
				$.ajax({
					url:"status?data="+newStatus+"&id="+id,
					method:"get",
					success:function (){
						//console.log('done');
					}
				});

			}
			else {         
				return false;
			}
		} 
		else if(!checked){
			var conf = confirm('Are you sure to Disable the Status of this User ?');

			if (conf ==  true) {

				$(this).removeAttr('checked');
				var newStatus = "inactive";

				$.ajax({
					url:"status?data="+newStatus+"&id="+id,
					method:"get",
					success:function (){
						//console.log('done');
					}
				});
			}
			else{
				return false;
			}
		}
		

	});

</script>

</html>