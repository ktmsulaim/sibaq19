<?php
	session_start();
	include '../../db.php';
	if(isset($_POST['login'])){
		if(!empty($_POST['username']) && !empty($_POST['password'])){
			$get_username = mysqli_real_escape_string($connect, $_POST['username']);
			$get_password = mysqli_real_escape_string($connect, $_POST['password']);
			$sel_sql = "SELECT * FROM users WHERE username = '$_POST[username]' AND password = '$_POST[password]'";
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
		<link href="../css/login.css" rel="stylesheet" media="all">
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
					<div class="col-lg-4 col-md-4 bg-light" id="formWrapper">
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
									}
									
								}
									echo $error; 
							?>
							<div class="form-group pt-3 pb-3">
								<!--<label class="control-label" for="username"></label>-->
								<div class="col-md-12">
									<input type="text" id="username" class="input1" placeholder="Username" name="username" required  autofocus>
								</div>
							</div>
							<div class="form-group  pt-3 pb-3">
								<!--<label class="control-label" for="pwd"></label>-->
								<div class="col-md-12">
									<input type="password" id="pwd" class="input1" placeholder="Password" name="password" required>
									<section id="togglePwd" class="text-right pt-2"><i class="fas fa-eye"></i></section>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4">
									<input type="submit" value="Login" class="btn button1" name="login">
								</div>
							</div>
							
						</form>
					</div>
				</div>
			</div>
			<div class="contact">
				<section>
					<i class="fas fa-info"></i>
				</section>
			</div>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" id="modalTitle">
							<h4 class="modal-title" id="myModalLabel">Instructions</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body picIcon">
							<div class="col-md-12">
								<ol>
									<li>The candidate registration is scheduled between 7:00 PM and 11:00 PM.</li>
									<li>You may change your password regarding the security reason.</li>
									<li>Username and passwords are case-sensitive.</li>
									<li>The website is best diplayed in desktop view.</li>
								</ol>
							</div>
						</div>
						<div class="modal-footer"></div>
					</div>
				</div>
			</div>
			<div class="info">
				<span>Login Instructions</span>
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

				$('.contact').mouseenter(function(){
					$('.contact').addClass('roundfx');
			});
				$('.contact').mouseleave(function(){
					$('.contact').removeClass('roundfx');
			});
				
				$('.info').hide();
				$('.info').fadeIn(2000).delay(3000).fadeOut(2000);
				
				/*---------------- show password ---------------------------*/
				$('#togglePwd').click(function(){
					var pwdInput = $('#pwd');
					var icon = $('#togglePwd i');
					
					if((icon).hasClass('fa-eye')){
						pwdInput.attr({'type':'text'});
						$('#togglePwd i').removeClass('fa-eye').addClass('fa-eye-slash');
						
					} else{
						$('#pwd').attr({'type':'password'});
						$('#togglePwd i').removeClass('fa-eye-slash').addClass('fa-eye');
					}
				});
			});
			
			$('.contact').click(function(){
				$('#myModal').modal();
			});
			
			
		</script>
		
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../../js/prism.js"></script>
	</body>
</html>