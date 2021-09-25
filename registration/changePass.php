<?php
	session_start();
	include '../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]' AND ug_name = '$_SESSION[ugname]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				
			}else{
				header('Location: login.php');
			}
			while($users = mysqli_fetch_assoc($result)){
				$ugname = $users['ug_name'];
				$sibaq_id = $users['sibaq_id'];
				$email = $users['email'];
				$contact = $users['contact_no'];
				$coordinator = $users['coordinator'];
				$address = $users['address'];
			}
		}
	}else{
		header('Location: login.php');
	}

// change password function
$error = '';
if(isset($_POST['change'])){
	if($_POST['cpass'] === $_SESSION['password']){
		if($_POST['newp'] === $_POST['newp1']){
			$changep_sql = "UPDATE users SET password = '$_POST[newp]' WHERE username = '$_SESSION[user]'";
			if(mysqli_query($connect, $changep_sql)){
				session_destroy();
				header('Location: login.php?changed');
			}else{
				$error = '<div class="alert alert-danger">Sorry! there was an error, try again later</div>';
			}
		}else{
			$error = '<div class="alert alert-danger">Passwords are not matching!</div>';
		}
	}else{
		$error = '<div class="alert alert-danger">Current password is not correct!</div>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sibaq '19 | Change Password</title>
		<meta http-equiv="content-type">
		<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
		<link href="../css/fontawsome/fontawesome-all.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="candidate/css/candidate.css" media="all">
		<link href="css/regdash.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="css/jquery-ui.min.css" media="all">
		<link rel="icon" href="../img/logo.ico">
		<link href="https://fonts.googleapis.com/css?family=Poppins|Raleway|Roboto+Slab" rel="stylesheet"> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<main>
			<div class="container-fluid">
				<div class="row">
					<div class="container-fluid bgdark">
						<div class="topWrapper">
							<div class="col-md-6 float-left">
								<div class="head2">
									<h2>sibaq '19</h2>
									<div class="brand-sub">
										<span>User Interface</span>
									</div>
								</div>
							</div>
							
							<div class="col-md-6 float-left">
							<nav>
								<div class="userinfo">
									 <!-- Dropdown -->
								   <ul class="navbar-nav navbar-expand">
								   		<li class="nav-item">
								   		<section class="user">
								   			Hi, <?php $ug = $_SESSION['user']; echo strtoupper(preg_replace('/@.*/', '', $ug)); ?>
								   		</section>
								   			
								   		</li>
										<li class="nav-item dropdown">
										  <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo strtoupper($ugname); ?>">
											<div class="userImage">
												<div class="img-round1">
													<?php 
													if($_SESSION['role'] == 'admin'){
														echo '<img src="../img/user.png" alt="'.$_SESSION['user'].' "width="100%">';
													}else{
														echo '<span class="ugPicName1">'.ucfirst(substr($_SESSION['user'],0,1)).'</span>';}
													 ?>
													
												</div>
											</div>	
										  </a>
										  	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
												<a class="dropdown-item" href="profile.php"><i class="fa fa-home"></i> Home</a>
												<a class="dropdown-item" href="changePass.php"><i class="fa fa-lock"></i> Change password</a>
												<hr>
												<a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
											</div>
										</li>
								   </ul>
								</div>
							</nav>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-2">
						
					</div>
					<div class="col-lg-10 col-md-10">
						<div class="wrapper">
							<div class="row">
								<div class="col-md-8">
									<div class="formWrapper">
										<div class="head3">
											<h2>Change password</h2>
										</div>
										<?php echo $error; ?>
										<form action="changePass.php" class="form-horizontal" role="form" method="post">
											<div class="form-group">
												<div class="col-md-12">
													<label for="current" class="control-form">Current Password</label>
													<input type="password" name="cpass" id="current" class="input1" required> 
												</div>
											</div>
											<hr>
											<div class="form-group">
												<div class="col-md-12">
													<label for="new" class="control-form">New Password</label>
													<input type="password" name="newp" id="new" class="input1" required> 
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-12">
													<label for="crpass" class="control-form">Confirm Password</label>
													<input type="password" name="newp1" id="crpass" class="input1" required> 
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-12">	
													<input type="submit" name="change" class="btn btn-info input2" value="Change">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<script src="../js/jquery-3.3.1.js"></script>
	  	<script src="../js/popper.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<script src="js/jquery.tablesorter.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="js/regDash.js"></script>
	</body>
</html>