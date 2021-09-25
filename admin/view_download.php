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
	$sql_updatestat = "UPDATE downloads SET status = '$_GET[status]' WHERE id = '$_GET[id]'";
	$run_updatestat = mysqli_query($connect, $sql_updatestat);
}elseif(isset($_GET['del_id'])){
	$sql_delete = "DELETE FROM downloads WHERE id = '$_GET[del_id]'";
	$run_delete = mysqli_query($connect, $sql_delete);
}elseif(isset($_GET['added'])){
	$msg = '<div class="col-md-4 text-center small m-auto alert alert-success">Added successfully!</div>';
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>View downloads</title>
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
					<?php echo $msg; ?>
					<div class="display-3">
						<h4>Downloads</h4>
						<hr>
					</div>
					<div class="container-fluid">
						<div class="row mb-2">
							<a href="../downloads.php" class="input btn btn-info">Downloads page</a>
						</div>
						<div class="row">
							<div class="col-md-11">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Sl.no</th>
											<th>Item</th>
											<th>Status</th>
											<th>Date</th>
											<th>Status</th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql_selnews = "SELECT * FROM downloads ORDER BY id DESC";
										$run_selnews = mysqli_query($connect, $sql_selnews);
										$i = 1;
										while($row = mysqli_fetch_assoc($run_selnews)){
											echo '<tr>
											<td>'.$i.'</td>
											<td>'.$row['item'].'</td>
											<td>'.$row['status'].'</td>
											<td>'.$row['date'].'</td>
											<td>'.$row['status'].'</td>
											<td>'.($row['status'] == 'publish' ? '<a href="view_download.php?status=draft&id='.$row['id'].'" class="btn btn-warning btn-sm navbar-btn">Draft</a>' : '<a href="view_download.php?status=publish&id='.$row['id'].'" class="btn btn-info btn-sm navbar-btn">Publish</a>').'</td>
											<td><a href="view_download.php?del_id='.$row['id'].'" class="btn btn-danger btn-sm navbar-btn">Delete</a></td>
										</tr>' ;
											
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