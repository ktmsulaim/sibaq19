<?php
	session_start();
	include '../../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
                    
                }else{
                    header('Location: index.php?access=nopermission');
                }
			}else{
				header('Location: login.php');
			}
		}
	}else{
		header('Location: login.php');
	}

	if(isset($_POST['add'])){
		if($_POST['password'] == $_POST['password2']){
			$ins_sql = "INSERT INTO users (ug_name, username, password, role, sibaq_id, place, email, contact_no, address, coordinator, photo, zone) VALUES('$_POST[ugname]', '$_POST[username]', '$_POST[password]', '$_POST[role]', '$_POST[sibaqid]', '','','','','','','')";
			$run_sql = mysqli_query($connect, $ins_sql);
				if($run_sql){
					header('Location: addUser.php?register=true');
				}else{
					header('Location: addUser.php?register=false');
				}
		}
	}
mysqli_close($connect);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 | Add User</title>
		<meta http-equiv="content-type">
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/fontawesome-all.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="css/candidate.css" media="all">
		<link href="../css/regdash.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="../css/jquery-ui.min.css" media="all">
		<link rel="stylesheet" href="../css/tableexport.min.css">
		<link rel="icon" href="../../img/logo.ico">
		<link href="https://fonts.googleapis.com/css?family=Poppins|Raleway|Roboto+Slab" rel="stylesheet"> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">		
	</head>
	<body>
		<main>
			<div class="container-fluid">
				<div class="row">
				<?php include 'topbar.php'; ?>
							<div class="col-lg-3 col-md-3 bg-dark" id="profileSide">
							<ul class="navbar-nav" id="menu">
								<?php include 'include/nav.php'; ?>
							</ul>
						</div>
					<div class="col-lg-9 col-md-9">
						<div class="wrapper p-3">
							<div class="head1">
								<h5>New user</h5>
							</div>
							<?php
								$regstat ='';
								
									if(isset($_GET['register'])){
										if($_GET['register'] == 'true'){
										$regstat = '<div class="alert alert-success">Added User successfully!</div>';
									}else{
										$regstat = '<div class="alert alert-danger">Some thing went wrong!</div>';
									}
								}
								
								echo $regstat;
							?>
							<script>
								$(function(){
									$('.alert').delay(3000).fadeOut();
								});
							</script>
							<div class="regForm pt-3">
								<form class="form-horizontal" role="form" method="post" action="addUser.php">
									
									<div class="form-group">
										<div class="form-group">
											<label for="usrname" class="contrl-label col-md-2">Username</label>
											<div class="col-md-5">
												<input type="text" id="username" name="username" placeholder="Choose a name" required class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label for="password" class="contrl-label col-md-2">Password</label>
											<div class="col-md-5">
												<input type="password" id="password" name="password" placeholder="Choose a Password" required class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label for="password2" class="contrl-label col-md-4">Confirm Password</label>
											<div class="col-md-5">
												<input type="password" id="password2" name="password2" placeholder="Re-type the Password" required class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label for="ugname" class="contrl-label col-md-2">Ug Name</label>
											<div class="col-md-5">
												<input type="text" id="ugname" name="ugname" placeholder="Enter ugname" required class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label for="sibaqid" class="contrl-label col-md-2">Sibaq Id</label>
											<div class="col-md-5">
												<input type="text" id="sibaqid" name="sibaqid" placeholder="Enter Sibaq Id" required class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label for="role" class="contrl-label col-md-2">Role</label>
											<div class="col-md-4">
												<select name="role" id="role" class="form-control">
													<option value="admin">Admin</option>
													<option value="natadmin">National Admin</option>
													<option value="ug">Ug</option>
													<option value="ugnat">Ug National</option>
													<option value="markentry">Mark Entry</option>
													<option value="media">Media</option>
													<option value="venue">Venue</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<input type="submit" name="add" value="Add" class="btn btn-info" id="add">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<script src="../../js/jquery-3.3.1.js"></script>
	  	<script src="../../js/popper.min.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="../js/jquery.tablesorter.min.js"></script>
		<!--	Export to excel sheet jquery	-->
	
		<script src="../js/FileSaver.js"></script>
		<script src="../js/tableexport.min.js"></script>
		
<!--	old browser support	-->
		<script src="../js/Blob.js"></script>
		<script src="../js/xlsx.core.min.js"></script>
		<script src="../js/export.js"></script>
		
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../js/regDash.js"></script>
	</body>
</html>