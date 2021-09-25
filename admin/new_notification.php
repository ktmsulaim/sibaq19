<?php
	session_start();
	include '../db.php'; 
	
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$sel_sql = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]'";
		if($run_sql = mysqli_query($connect, $sel_sql)){
			if(mysqli_num_rows($run_sql) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'media'){
                    
                }else{
                    header('Location: login.php?login=nopermission');
                }
			}else{
				header('Location: login.php');
			}
		}
		}else{
			header('Location: login.php');
		}
date_default_timezone_get('Asia/Kolkata');
$msg = '';
if(isset($_POST['add'])){
	$date = date("Y-m-d");
	date_default_timezone_get('Asia/Kolkata');
	$sql_insert = "INSERT INTO notifications (noti_item, noti_status, noti_date) VALUES('$_POST[notification]', '$_POST[status]', '$date')";
	$run_insert = mysqli_query($connect, $sql_insert);
	if($run_insert){
		$msg = '<div class="alert alert-success">Added successfully!</div>';
	}else{
		$msg = '<div class="alert alert-danger">Failed to add!</div>';
	}
}
mysqli_close($connect);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>New notifications</title>
		<link rel="stylesheet" href="css/style.css" media="all">
		<link rel="stylesheet" href="../css/fontawsome/fontawesome-all.css" media="all">
		<link rel="stylesheet" href="../css/fontawsome/css/fontawesome-all.min.css" media="all">
		<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css" media="all">
		<script src="../js/jquery-3.3.1.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="js/main.js"></script>
	</head>
	<body>
		<?php include 'theme/header.php'; ?>
		
		<div class="row">
		<?php include 'theme/side.php'; ?>
			<div class="col-lg-10 mt-5 pt-3">
				<div class="row">
					<div class="col-lg-12">
						<?php echo $msg; ?>
						<div class="display-4">
							<h3>New Notification</h3>
							<hr>
						</div>
						<form class="form-horizontal" role="form" method="post" action="new_notification.php">
							<div class="form-group">
								<label for="notification" class="control-label col-md-2">Notification</label>
								<div class="col-md-8">
									<input type="text" name="notification" id="notification" placeholder="Insert Notification" class="form-control" maxlength="100" required>
								</div>
							</div>
							<div class="form-group">
								<label for="status" class="control-label col-md-2">Status</label>
								<div class="col-md-8">
									<select name="status" id="status" class="form-control input">
										<option value="draft">Draft</option>
										<option value="publish">Publish</option>
									</select>
								</div>
							</div>
								<div class="form-group p-3">
									<input type="submit" name="add" value="Add Notification" id="add_category" class="btn btn-info">
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
	</body>
</html>