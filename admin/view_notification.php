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
if(isset($_GET['status'])){
	$sql_updatestat = "UPDATE notifications SET noti_status = '$_GET[status]' WHERE noti_id = '$_GET[id]'";
	$run_updatestat = mysqli_query($connect, $sql_updatestat);
}elseif(isset($_GET['del_id'])){
	$sql_delete = "DELETE FROM notifications WHERE noti_id = '$_GET[del_id]'";
	$run_delete = mysqli_query($connect, $sql_delete);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>View notifications</title>
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
				<div class="col-md-12">
					<div class="display-3">
						<h4>Notifications</h4>
						<hr>
					</div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-8">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Sl.no</th>
											<th>Notification</th>
											<th>Status</th>
											<th>Date</th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									<?php
									$sql_getnotifi = "SELECT * FROM notifications";
									$run_getnotifi = mysqli_query($connect, $sql_getnotifi);
									$i = 1;
									while($row = mysqli_fetch_assoc($run_getnotifi)){
										echo '<tr>
											<td>'.$i.'</td>
											<td>'.$row['noti_item'].'</td>
											<td>'.$row['noti_status'].'</td>
											<td>'.$row['noti_date'].'</td>
											<td>'.($row['noti_status'] == 'publish' ? '<a href="view_notification.php?status=draft&id='.$row['noti_id'].'" class="btn btn-warning btn-sm navbar-btn">Draft</a>' : '<a href="view_notification.php?status=publish&id='.$row['noti_id'].'" class="btn btn-info btn-sm navbar-btn">Publish</a>').'</td>
											<td><a href="view_notification.php?del_id='.$row['noti_id'].'" class="btn btn-danger btn-sm navbar-btn">Delete</a></td>
										</tr>';
										$i++;
									}
										mysqli_close($connect);
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
				
			
				
			</div>
		</div>
		
	</body>
</html>