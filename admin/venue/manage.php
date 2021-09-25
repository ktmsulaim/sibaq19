<?php
	session_start();
	include '../../db.php'; 
	
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$sel_sql = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]'";
		if($run_sql = mysqli_query($connect, $sel_sql)){
			if(mysqli_num_rows($run_sql) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'venue'){
                    
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

//update programme status
if(isset($_GET['status'])){
	$status = $_GET['status'];
	
	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d H:i:s');
	
	$update = mysqli_query($connect, "UPDATE final_schedule SET status = '$status' WHERE sd_id = '$_GET[id]'");
	
	// set time
	if($status == 'running'){
		$update_start = mysqli_query($connect, "UPDATE final_schedule SET started = '$date' WHERE sd_id = '$_GET[id]'");
	}elseif($status == 'over'){
		$update_start = mysqli_query($connect, "UPDATE final_schedule SET ended = '$date' WHERE sd_id = '$_GET[id]'");
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq'19 | Manage venue</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style.css" media="all">
		<link rel="stylesheet" href="../../css/fontawsome/fontawesome-all.css" media="all">
		<link rel="stylesheet" href="../../css/fontawsome/css/fontawesome.min.css" media="all">
		<link rel="stylesheet" href="../../css/bootstrap/css/bootstrap.min.css" media="all">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 
		<link rel="icon" href="../../img/logo.ico">
	</head>
	<body>
		<main>
			<?php include 'theme/header.php'; ?>
			<div class="container-fluid">
				<div class="row">
					<?php include 'theme/side.php'; ?>
					<div class="col-lg-9" id="dashContent">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<div class="wrapper1">
										<div class="head1">
											<h4>Manage venue</h4>
										</div>
										<div class="table-content">
											<table class="table table-modern table-style1">
												<thead>
													<tr>
														<th></th>
														<th>Programme</th>
														<th>P.Code</th>
														<th>Category</th>
														<th>From</th>
														<th>To</th>
														<th>Status</th>
														<th>Start</th>
														<th>End</th>
														<th></th>
														<th></th>
														<th></th>
													</tr>
												</thead>
												<tbody>
												<?php
													$get_progs = mysqli_query($connect, "SELECT f.* FROM final_schedule f INNER JOIN venues v ON f.venue = v.id WHERE v.user = '$_SESSION[user]'");
													$i = 1;
													while($row = mysqli_fetch_assoc($get_progs)){
														$start = $row['started'];
														$new_start = date('Y-m-d g:i A', strtotime($start));
														
														$end = $row['ended'];
														$new_end= date('Y-m-d g:i A', strtotime($end));
														echo '<tr class="'.$row['status'].'">
														<td>'.$i.'</td>
														<td>'.$row['programme'].'</td>
														<td>'.$row['p_code'].'</td>
														<td>'.ucfirst($row['category']).'</td>
														<td>'.$row['sd_date'].'<br>'.$row['sd_from'].'</td>
														<td>'.$row['sd_date'].'<br>'.$row['sd_to'].'</td>
														<td>'.$row['status'].'</td>
														<td>'.$new_start.'</td>
														<td>'.$new_end.'</td>
														<td><a href="manage.php?status=running&id='.$row['sd_id'].'"><i class="fas fa-play"></i></a></td>
														<td><a href="manage.php?status=paused&id='.$row['sd_id'].'"><i class="fas fa-pause"></i></a></td>
														<td><a href="manage.php?status=over&id='.$row['sd_id'].'"><i class="fas fa-stop"></i></a></td>
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
			</div>
		</main>
		<script src="../../js/jquery-3.3.1.js"></script>
		<script src="../../js/popper.min.js"></script>
		<script src="../../js/bootstrap.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>