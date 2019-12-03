<?php  
$this->load->view('header'); 
?>

<title>Update</title>
</head>
<body>
	<?php //print_r($users);die; ?>
	<div class="container">
		<div class="container-fluid">
			<div style="margin-left: 200px; margin-right: 200px;">
				<?php foreach ($users as $data) : ?>
					<form method="post" class="form" action="">
						<h1 style="margin: 50px;" class="text-center">Update</h1>

						<div class="form-group">
							<label>First Name :</label>
							<input class="form-control" type="text" name="fname" value="<?php echo $data['f_name']; ?>">
						</div>
						<div class="form-group">
							<label>Last Name :</label>
							<input class="form-control" type="text" name="lname" value="<?php echo $data['l_name']; ?>">
						</div>
						<div class="form-group">
							<label>Gender :</label>
							<?php if($data['gender']=='male') :?>
								<select name="gender" class="form-control">
									<option value="male" selected>Male</option>
									<option value="female">Female</option>
								</select>
							<?php endif; ?>
							<?php if($data['gender']=='female') :?>
								<select name="gender" class="form-control">
									<option value="male">Male</option>
									<option value="female" selected>Female</option>
								</select>
							<?php endif; ?>

						</div>
						<input type="date" name="date" id="date" value="<?php echo date('Y-m-d h:i:s') ?>" style="display: none">
						<div class="form-group text-center">
							<input class="btn btn-info" type="submit" name="update" value="Update">
						</div>
					</form>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</body>
</html>