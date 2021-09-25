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
	if(isset($_POST['add_post'])){
			$title = strip_tags($_POST['title']);
			$description = strip_tags($_POST['description']);
			$status = $_POST['status'];
			date_default_timezone_set("Asia/Kolkata");
			$date = date("M j, Y");
		
		if(isset($_FILES['image'])){
			$image_name = $_FILES['image']['name'];
			$image_tmp_name = $_FILES['image']['tmp_name'];
			$image_size = $_FILES['image']['size'];
			$image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
			$image_path = '../img/news/'.$image_name;
			$image_db_path = 'img/news/'.$image_name;
			$allowed = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
			if($image_size < 10000000){
				if(in_array($image_ext, $allowed)){
					if(move_uploaded_file($image_tmp_name, $image_path)){
						$ins_sql = "INSERT INTO news(news_title, news_image, news_desc, news_date, news_author, news_status) VALUES ('$title', '$image_db_path', '$description', '$date', '$_SESSION[user]', '$status')";
						if(mysqli_query($connect, $ins_sql)){
							header('Location: view_post.php?added');
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
		<title>New post</title>
		<link rel="stylesheet" href="css/style.css" media="all">
		<link rel="stylesheet" href="../css/fontawsome/fontawesome-all.css" media="all">
		<link rel="stylesheet" href="../css/fontawsome/css/fontawesome-all.min.css" media="all">
		<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css" media="all">
		<script src="../js/jquery-3.3.1.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="js/main.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.2/tinymce.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.2/jquery.tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea'});</script>
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
						<h3>New Post</h3>
						<hr>
					</div>
					<form class="form-horizontal" role="form" method="post" action="new_post.php" enctype="multipart/form-data">
						<div class="form-group">
							<label for="image" class="control-label col-md-2">Image</label>
							<div class="col-md-8">
								<input type="file" id="image" name="image" placeholder="Insert an image" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="control-label col-md-2">Title</label>
							<div class="col-md-8">
								<input type="text" id="title" placeholder="Insert title" class="form-control" name="title" required>
							</div>
						</div>
						<div class="form-group">
							<label for="description" class="control-label col-md-2">Description</label>
							<div class="col-md-8">
								<textarea class="form-control" id="description" rows="5" name="description"></textarea>
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
								<input type="submit" name="add_post" value="Add Post" id="add_post" class="btn btn-info">
							</div>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		
	</body>
</html>