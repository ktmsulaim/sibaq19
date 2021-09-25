<?php
	session_start();
	include '../db.php'; 
	date_default_timezone_set("Asia/Kolkata");

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

$error = '';
	if(isset($_POST['add_image'])){
			$caption = strip_tags($_POST['caption']);
			$status = $_POST['status'];
			date_default_timezone_set("Asia/Kolkata");
			$date = date("Y-m-d h:i:s");
		
		if(isset($_FILES['image'])){
			$image_name = $_FILES['image']['name'];
			$image_tmp_name = $_FILES['image']['tmp_name'];
			$image_size = $_FILES['image']['size'];
			$image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
			$image_path = 'images/'.$image_name;
			$image_db_path = 'admin/images/'.$image_name;
			$allowed = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
			if($image_size < 10000000){
				if(in_array($image_ext, $allowed)){
					if(move_uploaded_file($image_tmp_name, $image_path)){
						$ins_sql = "INSERT INTO images(image, caption, status, author, db_path, date) VALUES ('$image_db_path', '$caption', '$status', '$_SESSION[user]', '$image_path', '$date')";
						if(mysqli_query($connect, $ins_sql)){
							header('Location: view_image.php?added');
						}else{
							$error = '<div class="alert alert-danger">Query error! try again later!</div>';
						}
					}else{
						$error = '<div class="alert alert-danger">Unfortunately image was not uploaded!</div>';
					}
				}else{
					$error = '<div class="alert alert-danger">Image format not supported!</div>';
				}
			}else{
				$error = '<div class="alert alert-danger">Image size is too large to upload!</div>';
			}
		}
	}
mysqli_close($connect);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>New image</title>
		<link rel="stylesheet" href="css/style.css" media="all">
		<link rel="stylesheet" href="../css/fontawsome/fontawesome-all.css" media="all">
		<link rel="stylesheet" href="../css/fontawsome/css/fontawesome-all.min.css" media="all">
		<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css" media="all">
		<script src="../js/jquery-3.3.1.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="js/main.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.2/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea', mode : "textareas",
      theme : "advanced",
      force_br_newlines : true,
      force_p_newlines : true });</script>
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
						<h3>New Image</h3>
						<hr>
					</div>
					<form class="form-horizontal" role="form" method="post" action="new_image.php" enctype="multipart/form-data">
						<div class="form-group">
							<label for="image" class="control-label col-md-2">Image</label>
							<div class="col-md-8">
								<input type="file" id="image" name="image" placeholder="Insert an image" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="caption" class="control-label col-md-2">Caption</label>
							<div class="col-md-8">
								<input type="text" name="caption" placeholder="Write about photo" maxlength="50" class="form-control">
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
								<input type="submit" name="add_image" value="Add Image" id="add_image" class="btn btn-info">
							</div>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		
	</body>
</html>