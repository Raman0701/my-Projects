<?php  
$this->load->view('header'); 
?>

<title>login</title>
</head>
<body>

	<div class="container">
		<div class="container-fluid">
			<div style="margin-left: 200px; margin-right: 200px;">
				<form method="post" class="form" action="">
				<h1 style="margin: 50px;" class="text-center">Sign In</h1>
				
				<div class="form-group">
					<input class="form-control" type="email" name="email" placeholder="Enter your E-Mail">
				</div>
				<div class="form-group">
					<input class="form-control" type="password" name="password" placeholder="Enter Password">
				</div>
		
				<div class="form-group text-center">
					<input class="btn btn-info" type="submit" name="login" value="Log In">
				</div>
			</form>
			</div>
		</div>
	</div>
</body>
</html>