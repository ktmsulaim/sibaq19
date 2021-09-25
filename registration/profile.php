<?php
	session_start();
	include '../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]' AND ug_name = '$_SESSION[ugname]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				if($_SESSION['role'] !== 'media' || $_SESSION['role'] !== 'venue'){
					
				}else{
					header('Lcoation: logout.php');
				}
			}else{
				header('Location: login.php');
			}
		}
	}else{
		header('Location: login.php');
	}

$sel_ugdt_sql = "SELECT * FROM users WHERE username = '$_SESSION[user]'";
$run_ugdt = mysqli_query($connect, $sel_ugdt_sql);
while($users = mysqli_fetch_assoc($run_ugdt)){
				if($_SESSION['role'] == 'ug' || $_SESSION['role'] == 'ugnat'){
					$ugname = $users['ug_name'];
				}elseif($_SESSION['role'] == 'markentry'){
					$ugname = $users['place'];
				}
				$sibaq_id = $users['sibaq_id'];
				$email = $users['email'];
				$contact = $users['contact_no'];
				$coordinator = $users['coordinator'];
				$address = $users['address'];
}
$ugname = '';
$ugcode = '';
$bidaya = '';
$uoola = '';
$thaniya = '';
$thanawiya = 'W';
$aliya = 'A';

// select ug code
if($_SESSION['role'] == 'admin'){
	$ugcode = 'ug';
}elseif($_SESSION['role'] == 'natadmin'){
	$ugcode = 'ugnat';
}
if($_SESSION['role'] == 'ug' || $_SESSION['role'] == 'admin'){
	$bidaya = 'D';
	$uoola = 'L';
	$thaniya = 'N';
	
}elseif($_SESSION['role'] == 'ugnat' || $_SESSION['role'] == 'natadmin'){
	$bidaya = 'B';
	$uoola = 'U';
	$thaniya = 'T';
}
// Get registered count
if($_SESSION['role'] == 'natadmin' || $_SESSION['role'] == 'admin'){
	$sel_bid_count_sql = "SELECT * FROM student_reg s JOIN users u WHERE s.std_ug = u.username AND u.role = '$ugcode' AND s.std_cat = '$bidaya'";
	$run_bid_sel = mysqli_query($connect, $sel_bid_count_sql);
	$count_bidaya = mysqli_num_rows($run_bid_sel);
}elseif($_SESSION['user'] == 'bidaya'){
	$sel_bid_count_sql = "SELECT * FROM student_reg s INNER JOIN category c ON s.std_cat = c.cat_code WHERE c.cat_name = '$_SESSION[user]'";
	$run_bid_sel = mysqli_query($connect, $sel_bid_count_sql);
	$count_bidaya = mysqli_num_rows($run_bid_sel);
}else{
	$sel_bid_count_sql = "SELECT * FROM student_reg WHERE std_ug = '$_SESSION[user]' AND std_cat = '$bidaya'";
	$run_bid_sel = mysqli_query($connect, $sel_bid_count_sql);
	$count_bidaya = mysqli_num_rows($run_bid_sel);
}

if($_SESSION['role'] == 'natadmin' || $_SESSION['role'] == 'admin'){
	$sel_uoola_count_sql = "SELECT * FROM student_reg s JOIN users u WHERE s.std_ug = u.username AND u.role = '$ugcode' AND s.std_cat = '$uoola'";
	$run_uoola_sel = mysqli_query($connect, $sel_uoola_count_sql);
	$count_uoola = mysqli_num_rows($run_uoola_sel);
}elseif($_SESSION['user'] == 'uoola'){
	$sel_uoola_count_sql = "SELECT * FROM student_reg s INNER JOIN category c ON s.std_cat = c.cat_code WHERE c.cat_name = '$_SESSION[user]'";
	$run_uoola_sel = mysqli_query($connect, $sel_uoola_count_sql);
	$count_uoola = mysqli_num_rows($run_uoola_sel);
}else{
	$sel_uoola_count_sql = "SELECT * FROM student_reg WHERE std_ug = '$_SESSION[user]' AND std_cat = '$uoola'";
	$run_uoola_sel = mysqli_query($connect, $sel_uoola_count_sql);
	$count_uoola = mysqli_num_rows($run_uoola_sel);
}

if($_SESSION['role'] == 'natadmin' || $_SESSION['role'] == 'admin'){
	$sel_thaniya_count_sql = "SELECT * FROM student_reg s JOIN users u WHERE s.std_ug = u.username AND u.role = '$ugcode' AND s.std_cat = '$thaniya'";
	$run_thaniya_sel = mysqli_query($connect, $sel_thaniya_count_sql);
	$count_thaniya = mysqli_num_rows($run_thaniya_sel);
}elseif($_SESSION['user'] == 'thaniya'){
	$sel_thaniya_count_sql = "SELECT * FROM student_reg s INNER JOIN category c ON s.std_cat = c.cat_code WHERE c.cat_name = '$_SESSION[user]'";
	$run_thaniya_sel = mysqli_query($connect, $sel_thaniya_count_sql);
	$count_thaniya = mysqli_num_rows($run_thaniya_sel);
}else{
	$sel_thaniya_count_sql = "SELECT * FROM student_reg WHERE std_ug = '$_SESSION[user]' AND std_cat = '$thaniya'";
	$run_thaniya_sel = mysqli_query($connect, $sel_thaniya_count_sql);
	$count_thaniya = mysqli_num_rows($run_thaniya_sel);
}

if($_SESSION['role'] == 'natadmin' || $_SESSION['role'] == 'admin'){
	$sel_thanawiya_count_sql = "SELECT * FROM student_reg s JOIN users u WHERE s.std_ug = u.username AND u.role = '$ugcode' AND s.std_cat = '$thanawiya'";
	$run_thanawiya_sel = mysqli_query($connect, $sel_thaniya_count_sql);
	$count_thanawiya = mysqli_num_rows($run_thaniya_sel);
}elseif($_SESSION['user'] == 'thanawiya'){
	$sel_thanawiya_count_sql = "SELECT * FROM student_reg s INNER JOIN category c ON s.std_cat = c.cat_code WHERE c.cat_name = '$_SESSION[user]'";
	$run_thanawiya_sel = mysqli_query($connect, $sel_thanawiya_count_sql);
	$count_thanawiya = mysqli_num_rows($run_thanawiya_sel);
}else{
	$sel_thanawiya_count_sql = "SELECT * FROM student_reg WHERE std_ug = '$_SESSION[user]' AND std_cat = '$thanawiya'";
	$run_thanawiya_sel = mysqli_query($connect, $sel_thanawiya_count_sql);
	$count_thanawiya = mysqli_num_rows($run_thanawiya_sel);
}

if($_SESSION['role'] == 'natadmin' || $_SESSION['role'] == 'admin'){
	$sel_aliya_count_sql = "SELECT * FROM student_reg s JOIN users u WHERE s.std_ug = u.username AND u.role = '$ugcode' AND s.std_cat = '$aliya'";
	$run_aliya_sel = mysqli_query($connect, $sel_aliya_count_sql);
	$count_aliya = mysqli_num_rows($run_aliya_sel);
}elseif($_SESSION['user'] == 'aliya'){
	$sel_aliya_count_sql = "SELECT * FROM student_reg s INNER JOIN category c ON s.std_cat = c.cat_code WHERE c.cat_name = '$_SESSION[user]'";
	$run_aliya_sel = mysqli_query($connect, $sel_aliya_count_sql);
	$count_aliya = mysqli_num_rows($run_aliya_sel);
}else{
	$sel_aliya_count_sql = "SELECT * FROM student_reg WHERE std_ug = '$_SESSION[user]' AND std_cat = '$aliya'";
	$run_aliya_sel = mysqli_query($connect, $sel_aliya_count_sql);
	$count_aliya = mysqli_num_rows($run_aliya_sel);
}
$count_total = ($count_bidaya + $count_uoola + $count_thaniya + $count_thanawiya + $count_aliya);

// get programme register group items




//alert no expiry
$error = '';
if(isset($_GET['expired'])){
	$error = '<div class="small col-md-4 m-auto alert alert-danger text-center animated fadeInDown">Link expired</div>';
}elseif(isset($_GET['comingsoon'])){
	$error = '<div class="small col-md-4 m-auto alert alert-warning text-center animated fadeInDown">Coming soon! Please be tuned!</div>';
}elseif(isset($_GET['success'])){
	$error = '<div class="small col-md-4 m-auto alert alert-success text-center animated fadeInDown">Profile photo changed!</div>';
}elseif(isset($_GET['willstart'])){
	$error = '<div class="small col-md-4 m-auto alert alert-warning text-center animated fadeInDown">Topic registration will be starting on 7:00 PM!</div>';
}elseif(isset($_GET['tempblocked'])){
	$error = '<div class="small col-md-4 m-auto alert alert-primary text-center animated fadeInDown">Registered programmes are unavailable temporarily! Please Try again later.</div>';
}

// update ug photo
if(isset($_POST['upload'])){
	if(isset($_FILES['image'])){
		$image_name = $_FILES['image']['name'];
		$image_tmp_name = $_FILES['image']['tmp_name'];
		$image_size = $_FILES['image']['size'];
		$image_ext = explode('.', $image_name);
		$image_real_ext = strtolower(end($image_ext));
		$image_error = $_FILES['image']['error'];
		$image_path = 'ugphoto/'.$image_name;
		$allowed = array('jpg', 'jpeg', 'png');

		if(in_array($image_real_ext, $allowed)){
			if($image_error === 0){
				if($image_size < 250000){
						if(move_uploaded_file($image_tmp_name, $image_path)){
							$ins_sql = "UPDATE users SET photo = '$image_path' WHERE username = '$_SESSION[user]'";
								$run_ins = mysqli_query($connect, $ins_sql);
								if($run_ins){
									header('Location: profile.php?success');
								}else{
									die('Unable to upload now, pls try later!');
								}
							}else{
							$error = '<div class="alert alert-danger small">Sorry there was a problem with uploading image!</div>';
						}
					}else{
						$error = '<div class="alert alert-danger small">Image size is too big to upload! only allowed 250kb!	</div>';
					}
				}else{
					$error = '<div class="alert alert-danger small">File format does not support!</div>';
				}
			}
		}
}

// result count_char ///////////////////////////////////////////////////////////////////////////////////////
$countD = '';
$countL = '';
$countN = '';
$countW = '';
$countA = '';
if($_SESSION['role'] == 'admin'){
		$sql_selresultD = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'Bidaya'";
		$run_selresultD = mysqli_query($connect, $sql_selresultD);
		$countD = mysqli_num_rows($run_selresultD);

	}elseif($_SESSION['user'] == 'bidaya'){
		$sql_selresultD = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'bidaya'";
		$run_selresultD = mysqli_query($connect, $sql_selresultD);
		$countD = mysqli_num_rows($run_selresultD);

	}else{
		$sql_selresultD = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'Bidaya' AND c.author = '$_SESSION[user]'";
		$run_selresultD = mysqli_query($connect, $sql_selresultD);
	
		$countrunD = mysqli_query($connect, "SELECT COUNT(DISTINCT c.prog_code) AS count FROM candidate_reg c INNER JOIN programmes AS p ON p.p_code = c.prog_code WHERE p.status = 'publish' AND c.status = 'Selected' AND c.author = '$_SESSION[user]' AND c.category = 'bidaya'");
		$run_selresultD = mysqli_query($connect, $sql_selresultD);

	}
// uoola
if($_SESSION['role'] == 'admin'){
		$sql_selresultL = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'Uoola'";
		$run_selresultL = mysqli_query($connect, $sql_selresultL);
		$countL = mysqli_num_rows($run_selresultL);

	}elseif($_SESSION['user'] == 'uoola'){
		$sql_selresultL = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'Uoola'";
		$run_selresultL = mysqli_query($connect, $sql_selresultL);
		$countL = mysqli_num_rows($run_selresultL);

	}else{
		$sql_selresultL = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'Uoola' AND c.author = '$_SESSION[user]'";
		$run_selresultL = mysqli_query($connect, $sql_selresultL);
		$countL = mysqli_num_rows($run_selresultL);

	}

// thaniya
if($_SESSION['role'] == 'admin'){
		$sql_selresultN = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'thaniya'";
		$run_selresultN = mysqli_query($connect, $sql_selresultN);
		$countN = mysqli_num_rows($run_selresultN);

	}elseif($_SESSION['user'] == 'thaniya'){
		$sql_selresultN = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'thaniya'";
		$run_selresultN = mysqli_query($connect, $sql_selresultN);
		$countN = mysqli_num_rows($run_selresultN);

	}else{
		$sql_selresultN = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'thaniya' AND c.author = '$_SESSION[user]'";
		$run_selresultN = mysqli_query($connect, $sql_selresultN);
		$countN = mysqli_num_rows($run_selresultN);

	}

// thanawiya
if($_SESSION['role'] == 'admin'){
		$sql_selresultW = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'Thanawiya'";
		$run_selresultW = mysqli_query($connect, $sql_selresultW);
		$countW = mysqli_num_rows($run_selresultW);

	}elseif($_SESSION['user'] == 'thaniya'){
		$sql_selresultW = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'Thanawiya'";
		$run_selresultW = mysqli_query($connect, $sql_selresultW);
		$countW = mysqli_num_rows($run_selresultW);

	}else{
		$sql_selresultW = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'Thanawiya' AND c.author = '$_SESSION[user]'";
		$run_selresultW = mysqli_query($connect, $sql_selresultW);
		$countW = mysqli_num_rows($run_selresultW);

	}

// aliya
if($_SESSION['role'] == 'admin'){
		$sql_selresultA = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'Aliya'";
		$run_selresultA = mysqli_query($connect, $sql_selresultA);
		$countA = mysqli_num_rows($run_selresultA);

	}elseif($_SESSION['user'] == 'thaniya'){
		$sql_selresultA = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'Aliya'";
		$run_selresultA = mysqli_query($connect, $sql_selresultA);
		$countA = mysqli_num_rows($run_selresultA);

	}else{
		$sql_selresultA = "SELECT s.photo_path, c.candidate_name, c.candidate_code, c.prog_code, p.p_name FROM candidate_reg  AS c INNER JOIN programmes AS p ON c.prog_code = p.p_code INNER JOIN student_reg AS s ON s.std_chest = c.candidate_code WHERE c.status = 'Selected' AND p.status = 'publish' AND c.category = 'Aliya' AND c.author = '$_SESSION[user]'";
		$run_selresultA = mysqli_query($connect, $sql_selresultA);
		$countA = mysqli_num_rows($run_selresultA);

	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sibaq '19 | Profile</title>
		<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css" media="all">
		<link href="../css/animate.css" rel="stylesheet" media="all">
		<link href="../css/fontawsome/fontawesome-all.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="candidate/css/candidate.css" media="all">
		<link href="css/regdash.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="css/jquery-ui.min.css" media="all">
		<link rel="stylesheet" href="css/owl.carousel.min.css" media="all">
		<link rel="stylesheet" href="css/owl.theme.default.min.css" media="all">
		<link rel="icon" href="../img/logo.ico">
		<link href="https://fonts.googleapis.com/css?family=Poppins:400,600|Raleway|Roboto+Slab" rel="stylesheet"> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131139181-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-131139181-1');
		</script>

	</head>
	<body>
		<main>
			<div class="container-fluid">
				<div class="row">
					<div class="container-fluid bgdark">
						<div class="topWrapper">
							<div class="col-md-6 float-left">
								<div class="head2">
									<h2>sibaq '19</h2>
									<div class="brand-sub">
										<span>User Interface</span>
									</div>
								</div>
							</div>
							
							<div class="col-md-6 float-left">
							<nav>
								<div class="userinfo">
									 <!-- Dropdown -->
								   <ul class="navbar-nav navbar-expand">
								   		<li class="nav-item">
								   		<section class="user">
								   			Hi, <?php $ug = $_SESSION['user']; echo strtoupper(preg_replace('/@.*/', '', $ug)); ?>
								   		</section>
								   			
								   		</li>
										<li class="nav-item dropdown">
										  <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo strtoupper($ugname); ?>">
											<div class="userImage">
												<div class="img-round1">
													<?php 
													if($_SESSION['role'] == 'admin'){
														echo '<img src="../img/user.png" alt="'.$_SESSION['user'].' "width="100%">';
													}else{
														echo '<span class="ugPicName1">'.ucfirst(substr($_SESSION['user'],0,1)).'</span>';}
													 ?>
													
												</div>
											</div>	
										  </a>
										  	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
												<a class="dropdown-item" href="profile.php"><i class="fa fa-home"></i> Home</a>
												<a class="dropdown-item" href="changePass.php"><i class="fa fa-lock"></i> Change password</a>
												<hr>
												<a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
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
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-md-3 bg-dark" id="profileSide">
						<ul class="navbar-nav" id="menu">
							<?php
								if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
									echo'<li class="active"><a href="profile.php"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="candidate/index.php"><i class="fa fa-edit"></i> Candidate registration</a></li>
							<li><a href="candidate/regForm.php"><i class="fa fa-edit"></i> Programme registration</a></li>
							<li><a href="topic/index.php"><i class="fa fa-edit"></i> Topic registration</a></li>
							<li><a href="candidate/candidates.php"><i class="fa fa-users"></i> Rgtd. Candidates</a></li>
							<li><a href="candidate/proglist.php"><i class="fa fa-list"></i> Rgtd. Programmes</a></li>
							<li id="result"><a><i class="fa fa-trophy"></i> Results</a>
							</li>
								<ul id="resultmenu" class="collapse">
										<li><a href="candidate/markentry.php"><i class="fa fa-pencil"></i> Mark entry</a></li>
										<li><a href="candidate/result.php"><i class="fa fa-pencil"></i> View entries</a></li>
										<li><a href="candidate/published.php"><i class="fa fa-pencil"></i> Published Programs</a></li>
										<li><a href="candidate/codeentry.php"><i class="fa fa-pencil"></i> Code entry</a></li>
									</ul>
							<li id="final"><a><i class="fa fa-trophy"></i> Final Results</a>
							</li>
								<ul id="final" class="collapse">
										<li><a href="candidate/finalmarkentry.php"><i class="fa fa-pencil"></i> Mark entry</a></li>
										<li><a href="candidate/finalresult.php"><i class="fa fa-pencil"></i> View entries</a></li>
									</ul>
							<li id="tools"><a><i class="fa fa-wrench"></i> Tools</a></li>
								<ul class="collapse" id="toolsmenu">
									<li><a href="candidate/statics.php"><i class="fa fa-print"></i> Print programmes</a></li>
									<li><a href="candidate/ugwise.php"><i class="fa fa-print"></i> Ug wise programmes</a></li>
									<li><a href="candidate/primary.php"><i class="fa fa-print"></i> Primary Round</a></li>
									<li><a href="candidate/ycat.php"><i class="fa fa-print"></i> Zone based</a></li>
									<li><a href="candidate/checkcand.php"><i class="fa fa-print"></i> Check duplicate</a></li>
								</ul>
							<li id="users"><a><i class="fa fa-user"></i> Users</a></li>
								<ul class="collapse" id="usersmenu">
									<li><a href="candidate/addUser.php"><i class="fa fa-user-plus"></i> Add User</a></li>
									<li><a href="candidate/usersMgmt.php"><i class="fa fa-user"></i> Manage Users</a></li>
								</ul>
							';
								}elseif($_SESSION['role'] == 'markentry'){
									echo'<li class="active"><a href="../profile.php"><i class="fa fa-home"></i> Home</a></li>
										<li><a href="candidate/candidates.php"><i class="fa fa-users"></i> Rgtd. Candidates</a></li>
										<li><a href="candidate/proglist.php"><i class="fa fa-list"></i> Rgtd. Programmes</a></li>
										<li id="result"><a><i class="fa fa-trophy"></i> Results</a>
										</li>
											<ul id="resultmenu" class="collapse">
													<li><a href="candidate/markentry.php"><i class="fa fa-print"></i> Mark entry</a></li>
													<li><a href="candidate/result.php"><i class="fa fa-print"></i> View entries</a></li>
													<li><a href="candidate/published.php"><i class="fa fa-print"></i> Published Programs</a></li>
													<li><a href="candidate/statics.php"><i class="fa fa-print"></i> Print programmes</a></li>
													<li><a href="candidate/codeentry.php"><i class="fa fa-print"></i> Code entry</a></li>
												</ul>
										';
								}else{
									echo'<li class="active"><a href="profile.php"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="candidate/index.php"><i class="fa fa-edit"></i> Candidate registration</a></li>
							<li><a href="candidate/regForm.php"><i class="fa fa-edit"></i> Programme registration</a></li>
							<li><a href="topic/index.php"><i class="fa fa-edit"></i> Topic registration</a></li>
							<li><a href="candidate/candidates.php"><i class="fa fa-users"></i> Rgtd. Candidates</a></li>
							<li><a href="candidate/proglist.php"><i class="fa fa-list"></i> Rgtd. Programmes</a></li>
							<li><a href="candidate/manage.php"><i class="fa fa-user-circle-o"></i> Manager mode</a></li>
							';
								}
							?>
						</ul>
					</div>
					<?php echo $error; ?>
					<div class="col-lg-9 col-md-9">
						<div id="ugdetails" class="tile3">
									<div class="row">
									<div class="col-md-3">
										<div class="ugImage">	
											<div class="imgDemo">
												<?php
												$get_photosql = "SELECT photo FROM users WHERE username = '$_SESSION[user]'";
												$run_photosel = mysqli_query($connect, $get_photosql);
												while($photo = mysqli_fetch_assoc($run_photosel)){
													$ugphoto = $photo['photo'];
												}
													if(!empty($ugphoto)){
														echo '<img src="'.$ugphoto.'" alt="" width="100%">';
													}else{
														echo '<img src="ugphoto/insti-icon.png" alt="" width="100%">';
													}
												?>
												<div class="changePhoto">
													<section class="button">
														<button type="button" class="btn input1" data-toggle="modal" data-target="#changephModal">
													 Change
													</button>
													</section>
													
													<!-- Button trigger modal -->
													

													<!-- Modal -->
													<div class="modal fade" id="changephModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													  <div class="modal-dialog" role="document">
														<div class="modal-content">
														  <div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">Change UG photo</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															  <span aria-hidden="true">&times;</span>
															</button>
														  </div>
														  <div class="modal-body">
														  	<div class="container-fluid">
														  		<div class="row">
																	<div class="col-md-4 float-left">
																	<img src="../img/camera.png" alt="" width="100%">
																	</div>
																	<div class="col-md-8 float-left">
																		<section>
																			<form action="profile.php" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
																				<input type="file" name="image" class="input1" style="padding: 0px 15px;" required>
																				<hr>
																				<input type="submit" class="btn btn-primary input2" value="Upload" name="upload">
																			</form>
																			
																		</section>
																	</div>	
																	<div class="clearfix"></div>
														  		</div>
														  		<div class="row">
														  			<div class="col-md-12">
														  				<b>Note: </b><p>The image should be sized under 250kb and the file format should one of allowed (JPG, PNG, JPEG).</p>
														  			</div>
														  		</div>
														  	</div>
														  	
														  </div>
														  <div class="modal-footer">
														  </div>
														</div>
													  </div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-9">
										<div class="ugName">
											<h2><?php echo strtoupper($ugname); ?></h2>
										</div>
										<div class="dt sibaqId">
											<section class="hddetails"><i class="fa fa-id-card"></i><b> Sibaq ID :</b></section>
											<section class="details"><span><?php echo $sibaq_id; ?></span></section>
										</div>
										<div class="dt coordinator">
										<section class="hddetails">
											<i class="fa fa-male"></i><b> Coordinator :</b></section>
											<section class="details"><span><?php echo ucwords($coordinator); ?></span></section>
										</div>
										<div class="dt contact">
											<section class="hddetails">
												<i class="fa fa-phone"></i><b> Contact No :</b></section>
											<section class="details"><span><?php echo $contact; ?></span></section>
										</div>
										<div class="dt contact">
										<section class="hddetails">
											<i class="fa fa-envelope"></i><b> Email :</b></section>
											<section class="details"><span><?php echo $email; ?></span></section>
										</div>
										<div class="dt contact">
										<section class="hddetails">
											<i class="fa fa-map-marker"></i><b> Address :</b></section>
											<section class="details"><span><?php echo ucwords($address); ?></span></section>
										</div>
										<div class="dt contact">
										<section class="hddetails">
											<i class="fa fa-lock"></i><b> Password :</b></section>
											<section class="details"><span> *****</span></section><section class="text-right" id="changePass"> <a href="changePass.php">Change Password</a></section>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								</div>
						<div class="wrapper">
							<div class="uginfo">
<!--
								<div class="notice">
									<section class="alert alert-warning alert-dismissible" id="notice">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<i class="fa fa-exclamation-triangle"></i> You may find some missings in your uploaded photos, be in regard that only the photos with correct format are accepted, else it will be deleted automatically!</section>
								</div>
--> 							
<!------------------------------------------------ results -------------------------------------------------------------->
								<div id="results" class="mt-3">
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-12 wrapperInner">
												<div class="headline text-center">
													<h2>Final results</h2>
												</div>
											</div>
										</div>
										<div class="row">
											<?php
												$run_getcat = mysqli_query($connect, "SELECT DISTINCT p.p_category FROM final_candidates c LEFT JOIN final_group g ON c.p_code = g.p_code INNER JOIN programmes p ON c.p_code = p.p_code WHERE c.author = '$_SESSION[user]' ORDER BY p.p_id");
												while($row = mysqli_fetch_assoc($run_getcat)){
													$category = array();
													$category[] = $row['p_category'];
													
													foreach($category as $cindex=>$cat){
														$ind_sql = mysqli_query($connect, "SELECT SUM(c.grade_point + c.position_point) as total FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code WHERE p.status = 'publish' AND c.author = '$_SESSION[user]' AND c.category = '$cat'");
														
														$grp_sql = mysqli_query($connect, "SELECT SUM(g.grade_point + g.position_point) as total FROM final_group g LEFT JOIN programmes c ON g.p_code = c.p_code WHERE c.status = 'publish' AND g.ug = '$_SESSION[user]' AND c.p_category = '$cat'");

														$ind_mark = mysqli_fetch_array($ind_sql);
														$grp_mark = mysqli_fetch_array($grp_sql);
														$ind = $ind_mark['total'];
														$grp = $grp_mark['total'];
														$mark = ($ind + $grp);
														
														echo '<div class="col-md-2 text-center"><section class="display-4">'.$mark.'</section>
														'.ucfirst($cat).'</div>';
													}
													
												}
											?>
											<div class="clearfix"></div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-4 m-auto text-center">
												<?php
													// total marks
													$ind_sql = mysqli_query($connect, "SELECT SUM(c.grade_point + c.position_point) as total FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code WHERE p.status = 'publish' AND c.author = '$_SESSION[user]'");
													$grp_sql = mysqli_query($connect, "SELECT SUM(g.grade_point + g.position_point) as total FROM final_group g LEFT JOIN programmes p ON g.p_code = p.p_code WHERE  p.status = 'publish' AND g.ug = '$_SESSION[user]'");
													
													$ind_mark = mysqli_fetch_array($ind_sql);
													$grp_mark = mysqli_fetch_array($grp_sql);
													$ind = $ind_mark['total'];
													$grp = $grp_mark['total'];
													$total = ($ind + $grp);
													
													echo '<section class="display-2">'.$total.'</section>';
												?>
												
												<span class="total"><b>Total</b></span>
											</div>
										</div>
									</div>
								</div>

<!------------------------------			registered details	---------------------------------------->
								<div id="registered">
									<div class="wrapperInner">
										<div class="head1">
												<h4>Candidates <?php 
													if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
														$count_photosql = "SELECT * FROM student_reg s INNER JOIN users u ON s.std_ug = u.username WHERE u.role = '$ugcode' AND s.photo_path LIKE '%jpg%'";
														$run_count = mysqli_query($connect, $count_photosql);
														$photo_count = mysqli_num_rows($run_count);
														echo '<span class="badge badge-secondary">'.$photo_count.'</span>';
													}elseif($_SESSION['role'] == 'markentry'){
														$count_photosql = "SELECT * FROM student_reg s INNER JOIN users u ON s.std_ug = u.username INNER JOIN category c ON s.std_cat = c.cat_code WHERE c.cat_name = '$_SESSION[user]' AND s.photo_path LIKE '%jpg%'";
														$run_count = mysqli_query($connect, $count_photosql);
														$photo_count = mysqli_num_rows($run_count);
														echo '<span class="badge badge-secondary">'.$photo_count.'</span>';
													}else{
														$count_photosql = "SELECT * FROM student_reg s INNER JOIN users u ON s.std_ug = u.username WHERE u.username = '$_SESSION[user]' AND s.photo_path LIKE '%jpg%'";
														$run_count = mysqli_query($connect, $count_photosql);
														$photo_count = mysqli_num_rows($run_count);
														echo '<span class="badge badge-secondary">'.$photo_count.'</span>';
													}
													?></h4>
											</div>
										<div class="row pb-3 pt-3">
											<div class="col-md-12">
												<div class="owl-carousel" id="candilatest">
													<?php
														if($_SESSION['role'] == 'admin'|| $_SESSION['role'] == 'natadmin'){
															$sel_lastcand_sql = "SELECT * FROM student_reg s INNER JOIN users u ON s.std_ug = u.username WHERE u.role = '$ugcode' AND s.photo_path LIKE '%jpg%' ORDER BY s.std_id DESC LIMIT 20";
															$run_lastcand = mysqli_query($connect, $sel_lastcand_sql);
															while($lastcand = mysqli_fetch_assoc($run_lastcand)){
																$cphoto = $lastcand['photo_path'];
																if(empty($cphoto)){
																	$cphoto = '../img/guy.png';
																}else{
																	$cphoto = 'candidate/'.$lastcand['photo_path'];
																}
																echo '<div class="item">
																		<div class="tile1 col-12 col-md-6">
																			<div class="equal-height">
																				<span class="catcode">'.$lastcand['std_cat'].'</span>
																				<span class="text-right">'.strtoupper(preg_replace('/@.*/', '', $lastcand['std_ug'])).'</span>
																			<div class="imgrounded" style="background-image: url('.$cphoto.');"></div>
																			<div class="candinfo">
																				<section class="name1">'.$lastcand['std_name'].'</section>
																				<section class="chestno">'.$lastcand['std_chest'].'</section>
																			</div>
																			</div>
																		</div>
																	</div>';
															}
														}elseif($_SESSION['role'] == 'markentry'){
															$sel_lastcand_sql = "SELECT * FROM student_reg s INNER JOIN category c ON s.std_cat = c.cat_code WHERE c.cat_name = '$_SESSION[user]' AND photo_path LIKE '%jpg%' ORDER BY std_id DESC";
															$run_lastcand = mysqli_query($connect, $sel_lastcand_sql);
															while($lastcand = mysqli_fetch_array($run_lastcand)){
																$cphoto = $lastcand['photo_path'];
																if(empty($cphoto)){
																	$cphoto = 'candidate/cphotos/guy.png';
																}else{
																	$cphoto = 'candidate/'.$lastcand['photo_path'];
																}
																echo '<div class="item">
																		<div class="tile1">
																			<div class="equal-height">
																				<span class="catcode">'.$lastcand['std_cat'].'</span>
																			
																			<div class="imgrounded" style="background-image: url('.$cphoto.');">
																			</div>
																			<div class="candinfo">
																				<section class="name1">'.$lastcand['std_name'].'</section>
																				<section class="chestno">'.$lastcand['std_chest'].'</section>
																				</div>
																			</div>
																		</div>
																	</div>';
															}
														}else{
															$sel_lastcand_sql = "SELECT * FROM student_reg WHERE std_ug = '$_SESSION[user]' AND photo_path LIKE '%jpg%' ORDER BY std_id DESC";
															$run_lastcand = mysqli_query($connect, $sel_lastcand_sql);
															while($lastcand = mysqli_fetch_array($run_lastcand)){
																$cphoto = $lastcand['photo_path'];
																if(empty($cphoto)){
																	$cphoto = 'candidate/cphotos/guy.png';
																}else{
																	$cphoto = 'candidate/'.$lastcand['photo_path'];
																}
																echo '<div class="item">
																		<div class="tile1">
																			<div class="equal-height">
																				<span class="catcode">'.$lastcand['std_cat'].'</span>
																			
																			<div class="imgrounded" style="background-image: url('.$cphoto.');">
																			</div>
																			<div class="candinfo">
																				<section class="name1">'.$lastcand['std_name'].'</section>
																				<section class="chestno">'.$lastcand['std_chest'].'</section>
																				</div>
																			</div>
																		</div>
																	</div>';
															}
														}
													mysqli_close($connect);
													?>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="candiBox d-flex justify-content-center text-center">
												<div class="col-md-2 col-sm-6">
													<div class="tile">
														<h5>Bidaya</h5>
														<section class="display-4"><?php echo $count_bidaya; ?></section>
														<section></section>
													</div>
												</div>
												<div class="col-md-2 col-sm-6">
													<div class="tile">
														<h5>Uoola</h5>
														<section class="display-4"><?php echo $count_uoola; ?></section>
														<section></section>
													</div>
												</div>
												<div class="col-md-2 col-sm-6">
													<div class="tile">
														<h5>Thaniya</h5>
														<section class="display-4"><?php echo $count_thaniya; ?></section>
														<section></section>
													</div>
												</div>
												<div class="col-md-2 col-sm-6">
													<div class="tile">
														<h5>Thanawiya</h5>
														<section class="display-4"><?php echo $count_thanawiya; ?></section>
														<section></section>
													</div>
												</div>
												<div class="col-md-2 col-sm-6">
													<div class="tile">
														<h5>Aliya</h5>
														<section class="display-4"><?php echo $count_aliya; ?></section>
														<section></section>
													</div>
												</div>
												<div class="col-md-2 col-sm-6">
													<div class="tile">
														<h5>Total</h5>
														<section class="display-4"><?php echo $count_total; ?></section>
														<section></section>
													</div>
													<div class="clearfix"></div>
												</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</main>
		<script src="../js/jquery-3.3.1.js"></script>
	  	<script src="../js/popper.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<script src="js/jquery.tablesorter.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/owl.carousel.min.js"></script>
		<script src="js/regDash.js"></script>
	</body>
</html>