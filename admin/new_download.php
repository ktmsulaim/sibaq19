<?php
	session_start();
	include '../db.php'; 
	date_default_timezone_set("Asia/Kolkata");

	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$sel_sql = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]'";
		if($run_sql = mysqli_query($connect, $sel_sql)){
			if(mysqli_num_rows($run_sql) == 1){
				if($_SESSION['role'] == 'admin'){
                    
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

$error = '';
	if(isset($_POST['add_item'])){
			$caption = strip_tags($_POST['caption']);
			$status = $_POST['status'];
			date_default_timezone_set("Asia/Kolkata");
			$date = date("Y-m-d h:i:s");
		
		if(isset($_FILES['dl'])){
			$file_name = $_FILES['dl']['name'];
			$file_tmp_name = $_FILES['dl']['tmp_name'];
			$file_size = $_FILES['dl']['size'];
			$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
			$file_path = '../files/'.$file_name;
			$file_db_path = 'files/'.$file_name;
			if($file_size < 10000000){
					if(move_uploaded_file($file_tmp_name, $file_path)){
						$ins_sql = "INSERT INTO downloads(item, path, status, date) VALUES ('$caption', '$file_db_path', '$status', '$date')";
						if(mysqli_query($connect, $ins_sql)){
							header('Location: view_download.php?added');
						}else{
							$error = '<div class="alert alert-danger">Query error! try again later!</div>';
						}
					}else{
						$error = '<div class="alert alert-danger">Unfortunately file was not uploaded!</div>';
					}
				
			}else{
				$error = '<div class="alert alert-danger">File size is too large to upload!</div>';
			}
		}
	}
mysqli_close($connect);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>New download</title>
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
		<?php echo $error; ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="display-4">
						<h3>New Download</h3>
						<hr>
					</div>
					<form class="form-horizontal" role="form" method="post" action="new_download.php" enctype="multipart/form-data">
						<div class="form-group">
							<label for="image" class="control-label col-md-2">File</label>
							<div class="col-md-8">
								<input type="file" id="dl" name="dl" placeholder="Insert an item" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="caption" class="control-label col-md-2">File name</label>
							<div class="col-md-8">
								<input type="text" name="caption" placeholder="Write short name of file" maxlength="50" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="status" class="control-label col-md-2">Status</label>
							<div class="col-md-3">
								<select name="status" id="status" class="form-control">
									<option value="draft">Draft</option>
									<option value="publish">Publish</option>
								</select>
							</div>
							<div class="form-group p-3">
								<input type="submit" name="add_item" value="Add Item" id="item" class="btn btn-info">
							</div>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		
	</body>
</html>