<?php
	session_start();
	include '../../db.php';
	if(isset($_POST['login'])){
		if(!empty($_POST['username']) && !empty($_POST['password'])){
			$get_username = mysqli_real_escape_string($connect, $_POST['username']);
			$get_password = mysqli_real_escape_string($connect, $_POST['password']);
			$sel_sql = "SELECT * FROM users WHERE BINARY username = '$_POST[username]' AND BINARY password = '$_POST[password]'";
				if($login = mysqli_query($connect, $sel_sql)){
					if(mysqli_num_rows($login) === 1){
						while($row = mysqli_fetch_assoc($login)){
							
						$_SESSION['user'] = $get_username;
						$_SESSION['password'] = $get_password;
						$_SESSION['role'] = $row['role'];
						$_SESSION['ugname'] = $row['ug_name'];
						header("Location: index.php?user=$_SESSION[user]&role=$_SESSION[role]");
						}
				}else{
					header('Location: login.php?login=wrong');
				}
			}else{
					header('Location: login.php?login=query_error');
				}
			}else{
				header('Location: login.php?login=empty');
		}
	}
mysqli_close($connect);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1.0, user-scalabe=no">
		<title>Sibaq '19 | Login</title>
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/fontawesome-all.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/css/fontawesome-all.min.css" rel="stylesheet" media="all">
		<link href="css/login.css" rel="stylesheet" media="all">
		<link rel="icon" href="../../img/logo.ico">
		<!-- Script goes here -------------->
		<script src="../../js/jquery-3.3.1.js"></script>
	</head>
	<body>
		<div class="bg">
			<div id="particles-background" class="vertical-centered-box"></div>
			<div id="particles-foreground" class="vertical-centered-box"></div>
		</div>

		<main>
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 bg-light candiRegForm" id="formWrapper">
						<form class="form-horizontal" action="login.php" method="post" role="form">
							<div class="logo">
								<img src="../../img/logo_low.png" width="75%">
							</div>
							<?php 
								$error ='';
								if(isset($_GET['login'])){
									if($_GET['login'] == 'wrong'){
										$error = '<div class="small"><div class="alert alert-danger">Enter a valid Username and Password!</div></div>';
									}else if($_GET['login'] == 'query_error'){			
										$error = '<div class="alert alert-danger">Sorry! There is a query error!</div>';
									}else if($_GET['login'] == 'empty'){
										$error = '<div class="alert alert-danger">Username and Password cannot be empty</div>';
									}else if($_GET['login'] == 'nopermission'){
										$error = '<div class="alert alert-danger">You have no permission</div>';
									}
									
								}else if(isset($_GET['changed'])){
									$error = '<div class="alert alert-success">Password changed! login again!</div>';
								}
									echo $error; 
							?>
							<div class="form-group pt-3 pb-3">
								<!--<label class="control-label" for="username"></label>-->
								<div class="col-md-12 inputHolder">
									<input type="text" id="username" class="input1" placeholder="Username" name="username" required autofocus>
								</div>
							</div>
							<div class="form-group  pt-3 pb-3">
								<!--<label class="control-label" for="pwd"></label>-->
								<div class="col-md-12 inputHolder">
									<input type="password" id="pwd" class="input1" placeholder="Password" name="password" required>
									<section id="togglePwd" class="text-right pt-2"><i class="fas fa-eye"></i></section>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4">
									<input type="submit" value="Login" class="btn button2" name="login">
								</div>
							</div>
							
						</form>
					</div>
				</div>
			</div>
		</main>
		<script>
			$(function(){
					/* --------------- change theme by time --------------*/
					var date = new Date();
					var hourNow = date.getHours();


					if (hourNow >= 6 && hourNow < 18){
						$('body').css({'background':'#f1f1f1'});
						$('#particles-background, #particles-foreground').hide();
						$('#formWrapper').addClass('shadowBox');
					}else if(hourNow > 18 && hourNow < 6){
						$('body').css({'background':'#111'});
						$('#particles-background, #particles-foreground').fadeIn();
						$('#formWrapper').removeClass('shadowBox');
					}
				/*------------------ ends here ---------------*/
		</script>
		
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../../js/prism.js"></script>
	</body>
</html>