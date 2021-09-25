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
	$sql_updatestat = "UPDATE news SET news_status = '$_GET[status]' WHERE news_id = '$_GET[id]'";
	$run_updatestat = mysqli_query($connect, $sql_updatestat);
}elseif(isset($_GET['del_id'])){
	$sql_delete = "DELETE FROM news WHERE news_id = '$_GET[del_id]'";
	$run_delete = mysqli_query($connect, $sql_delete);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>View posts</title>
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
						<h4>News</h4>
						<hr>
					</div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-11">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Sl.no</th>
											<th>Date</th>
											<th>Image</th>
											<th>Title</th>
											<th>Description</th>
											<th>Author</th>
											<th>Status</th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql_selnews = "SELECT * FROM news ORDER BY news_id DESC";
										$run_selnews = mysqli_query($connect, $sql_selnews);
										$i = 1;
										while($row = mysqli_fetch_assoc($run_selnews)){
											echo '<tr>
											<td>'.$i.'</td>
											<td>'.$row['news_date'].'</td>
											<td><img src="../'.$row['news_image'].'" width="100%"></td>
											<td>'.$row['news_title'].'</td>
											<td class="small">'.substr($row['news_desc'], 0, 30).'</td>
											<td>'.$row['news_author'].'</td>
											<td>'.$row['news_status'].'</td>
											<td>'.($row['news_status'] == 'publish' ? '<a href="view_post.php?status=draft&id='.$row['news_id'].'" class="btn btn-warning btn-sm navbar-btn">Draft</a>' : '<a href="view_post.php?status=publish&id='.$row['news_id'].'" class="btn btn-info btn-sm navbar-btn">Publish</a>').'</td>
											<td><a href="../news.php?news_id='.$row['news_id'].'" class="btn btn-success btn-sm navbar-btn">View</a></td>
											<td><a href="view_post.php?del_id='.$row['news_id'].'" class="btn btn-danger btn-sm navbar-btn">Delete</a></td>
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