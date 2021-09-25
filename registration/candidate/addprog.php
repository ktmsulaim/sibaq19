<?php
	session_start();
	include '../../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]' AND ug_name = '$_SESSION[ugname]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				
			}else{
				header('Location: login.php');
			}
		}
	}else{
		header('Location: login.php');
	}
//select all from db state

$sel_bid_sql = "SELECT * FROM regstate WHERE category = 'bidaya' AND status = 'accepted'";
$run_bid_sel = mysqli_query($connect, $sel_bid_sql);

$sel_uoola_sql = "SELECT * FROM regstate WHERE category = 'uoola' AND status = 'accepted'";
$run_uoola_sel = mysqli_query($connect, $sel_uoola_sql);

$sel_thaniya_sql = "SELECT * FROM regstate WHERE category = 'thaniya' AND status = 'accepted'";
$run_thaniya_sel = mysqli_query($connect, $sel_thaniya_sql);

$sel_thanawiya_sql = "SELECT * FROM regstate WHERE category = 'thanawiya' AND status = 'accepted'";
$run_thanawiya_sel = mysqli_query($connect, $sel_thanawiya_sql);


$bidaya = mysqli_num_rows($run_bid_sel);
$uoola = mysqli_num_rows($run_uoola_sel);
$thaniya = mysqli_num_rows($run_thaniya_sel);
$thanawiya = mysqli_num_rows($run_thanawiya_sel);

//select all from db national


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sibaq '19 | Add programmes</title>
		<meta http-equiv="content-type">
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/fontawesome-all.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/css/fontawesome-all.min.css" rel="stylesheet" media="all">
		<link href="../css/regdash.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="css/candidate.css" media="all">
		<link rel="stylesheet" href="css/jquery-ui.min.css" media="all">
		
		<link href="https://fonts.googleapis.com/css?family=Poppins|Raleway|Roboto+Slab" rel="stylesheet"> 
	</head>
	<body>
		<main>
			<div class="container-fluid">
				<div class="row">
					<div class="container-fluid bg-dark">
						<div class="topWrapper">
							<div class="col-md-6 float-left">
								<div class="head1">
									<h2>sibaq '19</h2>
									<div class="brand-sub">
										<span>candidate registration</span>
									</div>
								</div>
							</div>
							
							<div class="col-md-6 float-left">
							<nav>
								<div class="userinfo">
									 <!-- Dropdown -->
								   <ul class="navbar-nav">
										<li class="nav-item dropdown">
										  <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<div class="userImage">
												<div class="img-round1">
													<?php echo '<img src="../../img/user.png" alt="'.$_SESSION['user'].' "width="100%">'; ?>
												</div>
											</div>	
										  </a>
										  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="#">Link 1</a>
											<a class="dropdown-item" href="#">Link 2</a>
											<a class="dropdown-item" href="#">Link 3</a>
											</div>
										</li>
								   </ul>
								</div>
							</nav>
								
      
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						
					</div>
					<div class="col-lg-10">
						<div class="wrapper">
						<div class="row">
							<div class="col-md-8">
								<div class="formWrapper">
									<div class="head2">
										<h2>Add programmes</h2>
									</div>
									<form action="addprog.php" class="form-horizontal" method="post" role="form">
										<div class="form-group">
											<label for="category" class="control-form">Category</label>
											<select name="category" id="category" class="input1 select" required>
												<option value="">Select category</option>
												<?php 
													$sel_sql = "SELECT * FROM category";
													$run_cat_sel = mysqli_query($connect, $sel_sql);

													while($cat = mysqli_fetch_assoc($run_cat_sel)){
														echo '<option value="'.$cat['cat_name'].'">'.ucfirst($cat['cat_name']).'</option>';
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="pname" class="control-form">Programme Name</label>
											<input type="text" class="input1" id="pname" name="pname" placeholder="Enter programme name" required>
										</div>
										<div class="form-group">
											<label for="pcode" class="control-form">Programme Code</label>
											<input type="text" class="input1" id="pcode" name="pcode" placeholder="Enter programme code" required>
										</div>
										<div class="form-group">
											<label for="type" class="control-form">Type</label>
											<select name="type" id="type" class="input1 select" required>
												<option value="">Select type</option>
												<option value="non_stage">Non Stage</option>
												<option value="stage">Stage</option>
											</select>
										</div>
										<div class="from-group">
											<label for="kind" class="control-form">Kind</label>
											<select name="kind" id="kind" class="input1 select" required>
												<option value="">Select kind</option>
												<option value="individual">Individual</option>
												<option value="group">Group</option>
											</select>
										</div>
										
										<div class="form-group mt-2">
											<input type="submit" name="add" value="Add" class="input btn btn-info">
										</div>
									</form>
									
									<?php
										if(isset($_POST['add'])){
											$category = $_POST['category'];
											$pname = $_POST['pname'];
											$pcode = $_POST['pcode'];
											$type = $_POST['type'];
											$kind = $_POST['kind'];
											
											$ins_sql = "INSERT INTO programmes (p_name, p_code, p_category, p_type, p_kind) VALUES ('$pname', '$pcode', '$category', '$type', '$kind')";
											$run_ins = mysqli_query($connect, $ins_sql);
										}
									mysqli_close($connect);
									?>
								</div>
							</div>
						</div>
							
						</div>
					</div>
				</div>
			</div>
		</main>
		<script src="../../js/jquery-3.3.1.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="../js/jquery.tablesorter.min.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../../registration/js/bootstrap.bundle.min.js"></script>
		<script src="../../js/popper.min.js"></script>
		<script type="text/javascript">
			$(function(){
				$('.table').tablesorter();
				$('.select').selectmenu();
			});
		</script>
		<script src="regDash.js"></script>
	</body>
</html>