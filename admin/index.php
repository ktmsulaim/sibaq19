<?php
	session_start();
	include '../db.php'; 
	
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$sel_sql = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]'";
		if($run_sql = mysqli_query($connect, $sel_sql)){
			if(mysqli_num_rows($run_sql) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'media'){
                    
                }elseif($_SESSION['role'] == 'venue'){
                    header('Location: venue/index.php');
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

// count news
$sql_newscount = "SELECT * FROM news";
$run_newscount = mysqli_query($connect, $sql_newscount);
$news_count = mysqli_num_rows($run_newscount);
// count notifications
$sql_notification = "SELECT * FROM notifications";
$run_notification = mysqli_query($connect, $sql_notification);
$notification_count = mysqli_num_rows($run_notification);
// count comments
$run_countcmt = mysqli_query($connect, "SELECT COUNT(*) AS count FROM comments");
while($cmtrow = mysqli_fetch_assoc($run_countcmt)){
	$cmt_count = $cmtrow['count'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq'19 | Dashboard</title>
		<link rel="stylesheet" href="css/style.css" media="all">
		<link rel="stylesheet" href="../css/fontawsome/fontawesome-all.css" media="all">
		<link rel="stylesheet" href="../css/fontawsome/css/fontawesome-all.min.css" media="all">
		<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css" media="all">
		<script src="../js/jquery-3.3.1.js"></script>
		<script src="../js/popper.min.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="js/main.js"></script>
	</head>
	<body>
		<?php include 'theme/header.php'; ?>
		
		<div class="row">
		<?php include 'theme/side.php'; ?>
		<div class="col-lg-10 pt-5 float-right" id="dashContent">
			<?php 
			date_default_timezone_set("Asia/Kolkata");
			echo date("M j, Y, g:i:s A");
			?>
			<div class="row">
				<div class="col-lg-12">
					<div class="col-lg-3 float-left">
					<div class="wrapper panel bg-light">
						<div class="row">
							<div class="col-md-3">
								<i class="fa fa-newspaper fa-4x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="display-4"><?php echo $news_count; ?></div>
								<div>News</div>
							</div>
						</div>
						<div class="row">
							<a href="view_post.php" class="col-md-12 p-2">
								<div class="col-md-10 float-left">View posts</div>
								<div class="col-md-2 float-left text-right"><i class="fas fa-chevron-circle-right"></i></div>
								<div class="clearfix"></div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 float-left">
					<div class="wrapper panel bg-light">
						<div class="row">
							<div class="col-md-3">
								<i class="fas fa-list fa-4x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="display-4"><?php echo $notification_count; ?></div>
								<div>Notifications</div>
							</div>
						</div>
						<div class="row">
							<a href="view_notification.php" class="col-md-12 p-2">
								<div class="col-md-10 float-left">View notifications</div>
								<div class="col-md-2 float-left text-right"><i class="fas fa-chevron-circle-right"></i></div>
								<div class="clearfix"></div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 float-left">
					<div class="wrapper panel bg-light">
						<div class="row">
							<div class="col-md-3">
								<i class="fas fa-user fa-4x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="display-4">2</div>
								<div>Users</div>
							</div>
						</div>
						<div class="row">
							<a href="#" class="col-md-12 p-2">
								<div class="col-md-10 float-left">View users</div>
								<div class="col-md-2 float-left text-right"><i class="fas fa-chevron-circle-right"></i></div>
								<div class="clearfix"></div>
							</a>
						</div>
					</div>
				</div>
					
				<div class="col-lg-3 float-left">
					<div class="wrapper panel bg-light">
						<div class="row">
							<div class="col-md-3">
								<i class="fas fa-comment fa-4x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="display-4"><?php echo $cmt_count; ?></div>
								<div>Comments</div>
							</div>
						</div>
						<div class="row">
							<a href="view_comment.php" class="col-md-12 p-2">
								<div class="col-md-10 float-left">View comments</div>
								<div class="col-md-2 float-left text-right"><i class="fas fa-chevron-circle-right"></i></div>
								<div class="clearfix"></div>
							</a>
						</div>
					</div>
				</div>
			<div class="clearfix"></div>
				</div>
				
			</div>
				
			<div class="row pt-5">
				<div class="col-lg-12">
					<div class="col-lg-12">
						<div class="p-2" id="users">
							<h4>Latest News</h4>
						</div>
						<div class="wrapper  colum">
							<table class="table">
								<thead>
									<tr>
										<th>SL.no</th>
										<th>Title</th>
										<th>Description</th>
										<th>Image</th>
										<th>Date</th>
										<th>Author</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
								<?php
										$sql_selnews = "SELECT * FROM news ORDER BY news_id DESC LIMIT 5";
										$run_selnews = mysqli_query($connect, $sql_selnews);
										$i = 1;
										while($row = mysqli_fetch_assoc($run_selnews)){
											echo '<tr>
												<td>'.$i.'</td>
												<td>'.$row['news_title'].'</td>
												<td>'.substr($row['news_desc'], 0 ,100).'</td>
												<td><img class="img-fluid" src="../'.$row['news_image'].'"></td>
												<td>'.$row['news_date'].'</td>
												<td>'.$row['news_author'].'</td>
												<td>'.ucfirst($row['news_status']).'</td>
											</tr>';
											$i++;
										}
									
									?>
									
								</tbody>
							</table>
						</div>
					</div>
				<div class="clearfix"></div>
				</div>
			</div>
				<div class="row pt-5">
					<div class="col-md-12">
						<div class="col-md-6 float-left">
							<div class="p-2">
								<h4>Notifications</h4>
							</div>
							<div  class="wrapper colum p-3">
								<table class="table table-striped">
									<thead>
										<tr>
											<td>Sl.no</td>
											<td>Notification</td>
											<td>Status</td>
											<td>Date</td>
										</tr>
									</thead>
									<tbody>
										<?php
									$sql_getnotifi = "SELECT * FROM notifications ORDER BY noti_id DESC LIMIT 5";
									$run_getnotifi = mysqli_query($connect, $sql_getnotifi);
									$i = 1;
									while($row = mysqli_fetch_assoc($run_getnotifi)){
										echo '<tr>
											<td>'.$i.'</td>
											<td>'.$row['noti_item'].'</td>
											<td>'.$row['noti_status'].'</td>
											<td>'.$row['noti_date'].'</td>
										</tr>';
										$i++;
									}
									?>
									</tbody>
									
								</table>
							</div>
						</div>
						<div class="col-md-6 float-left">
							<div class="p-2">
								<h4>Comments</h4>
							</div>
							<div  class="wrapper colum p-3">
								<table class="table table-responsive">
									<thead>
										<tr>
											<th>Sl.no</th>
											<th>Name</th>
											<th>Contact.no</th>
											<th>Email</th>
											<th>Message</th>
											<th>Date</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql_selnews = "SELECT * FROM comments ORDER BY id DESC LIMIT 5";
										$run_selnews = mysqli_query($connect, $sql_selnews);
										$i = 1;
										while($row = mysqli_fetch_assoc($run_selnews)){
											echo '<tr>
											<td>'.$i.'</td>
											<td>'.$row['name'].'</td>
											<td>'.$row['number'].'</td>
											<td>'.$row['email'].'</td>
											<td>'.$row['message'].'</td>
											<td>'.$row['date'].'</td>
										</tr>' ;
											
										$i++;
										}
										mysqli_close($connect);
										?>
									</tbody>
									
								</table>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		
	</body>
</html>
