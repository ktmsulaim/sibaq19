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


// update function
if(isset($_POST['update'])){
	$link = $_POST['link'];
	$update = mysqli_query($connect, "UPDATE live_link SET live = '$link'");
	
	if($update){
		header('Location: livecntrl.php?updated');
	}else{
		header('Location: livecntrl.php?failed');
	}
}

$msg = '';
if(isset($_GET['status'])){
	$sql_updatestat = "UPDATE downloads SET status = '$_GET[status]' WHERE id = '$_GET[id]'";
	$run_updatestat = mysqli_query($connect, $sql_updatestat);
}elseif(isset($_GET['del_id'])){
	$sql_delete = "DELETE FROM downloads WHERE id = '$_GET[del_id]'";
	$run_delete = mysqli_query($connect, $sql_delete);
}
	
if(isset($_GET['updated'])){
	$msg = '<div class="col-md-4 text-center small m-auto alert alert-success">Updated successfully!</div>';
}elseif(isset($_GET['failed'])){
	$msg = '<div class="col-md-4 text-center small m-auto alert alert-danger">Updation failed!</div>';
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Live control</title>
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
						<h4>Live Control</h4>
						<hr>
					</div>
					<div class="container-fluid">
						<div class="row mb-2">
							<a href="../live.php">Go to Live page</a>
						</div>
						<div class="row">
							<form action="livecntrl.php" class="form-horizontal" method="post" role="form">
								<div class="form-group">
									<label for="link" class="control-form">Link</label>
									<input type="text" class="form-control input" name="link" placeholder="Insert end part of link">
								
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-primary input" name="update" value="Update" >
								</div>
							</form>
						</div>
						<div class="row">
							<div class="col-md-11">
								<div class="p-3">
									<div class="livevideo">
										<?php
										$get_link = mysqli_query($connect, "SELECT live FROM live_link");
										$linkr = mysqli_fetch_assoc($get_link);
										$link = $linkr['live'];
										echo '<div class="wrapper1">
												<div class="container d-flex justify-content-center">
													<div class="col-md-8 m-auto">
														<div class="subhead1 text-center"><h2>Venue 1</h2></div>
														<iframe width="100%" height="315" src="https://www.youtube.com/embed/'.$link.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
													</div>
												</div>
											</div>';
										
										mysqli_close($connect);
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				
			
				
			</div>
		</div>
		
	</body>
</html>