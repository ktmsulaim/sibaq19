<?php
	session_start();
	include '../../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
                    
                }else{
                    header('Location: ../profile.php?expired');
                }
			}else{
				header('Location: login.php');
			}
		}
	}else{
		header('Location: login.php');
	}

// find candidate
$chestno = '';
$error = '';
$real_chest = '';
$cand_name = '';
$cand_cat = '';
$category = '';
$category_name = '';
$cand_ug = '';
$proglist = '';

if(isset($_POST['find'])){
	$chestno = $_POST['chestno'];
	$sel_cand_detail_sql = "SELECT * FROM student_reg s JOIN users u ON s.std_ug = u.username WHERE BINARY std_chest = '$chestno'";
	if($run_cdtl = mysqli_query($connect, $sel_cand_detail_sql)){
		while($canddtls = mysqli_fetch_array($run_cdtl)){
			$real_chest = $canddtls['std_chest'];
			$cand_name = $canddtls['std_name'];
			$cand_cat = $canddtls['std_cat'];
			$cand_ug = $canddtls['ug_name'];
		}
		if($chestno === $real_chest){
			$_SESSION['chestno'] = $real_chest;
			$_SESSION['cand_name'] = $cand_name;
			$_SESSION['cand_cat'] = $cand_cat;
			
			// get category name
			$sel_cat_sql = "SELECT cat_name FROM category WHERE cat_code = '$_SESSION[cand_cat]'";
			$run_cat_name = mysqli_query($connect, $sel_cat_sql);
			while($cat_row = mysqli_fetch_assoc($run_cat_name)){
				$category = $cat_row['cat_name'];
			}
			$_SESSION['category'] = $category;
			$error = '<div class="alert alert-primary small text-center">Candidate found!</div>';
		}else{
			$error = '<div class="alert alert-danger small text-center">No candidate found!</div>';
		}
	}else{
			$error = '<div class="alert alert-danger small text-center">No candidate found!</div>';
		}
	
}

// programme list
	if($category == 'bidaya'){
		$proglist = '<option value="D9">Kadhakadhanam</option>
		<option value="D11">Song MLM</option>
		<option value="D12">Song ARB</option>
		<option value="D13">Song URD</option>
		<option value="D33">Group song</option>
		<option value="D32">Speech and song</option>';
	}elseif($category == 'bidaya niics'){
		$proglist = '
		<option value="song_arb">Song ARB</option>
		<option value="song_urd">Song URD</option>
		<option value="song_eng">Song ENG</option>
		<option value="group_song">Group song</option>
		<option value="speech_and_song">Speech and song</option>';
	}elseif($category == 'uoola'){
		$proglist = '<option value="L10">Kadhakadhanam</option>
									<option value="L12">Song MLM</option>
									<option value="L13">Song ARB</option>
									<option value="L14">Song URD</option>
									<option value="L15">Song ENG</option>
									<option value="L16">Padhyaparayanam</option>
									<option value="L37">Group song</option>
									<option value="L36">Speech and song</option>';
	}elseif($category == 'uoola niics'){
		$proglist = '
		<option value="song_arb">Song ARB</option>
		<option value="song_urd">Song URD</option>
		<option value="song_eng">Song ENG</option>
		<option value="group_song">Group song</option>
		<option value="speech_and_song">Speech and song</option>';
	}elseif($category == 'thaniya'){
		$proglist = '<option value="N8">Song MLM</option>
									<option value="N9">Song ARB</option>
									<option value="N10">Song URD</option>
									<option value="N11">Song ENG</option>
									<option value="N35">Group song</option>
									<option value="N12">Padhyaparayanam</option>
									<option value="N36">Speech and song</option>';
	}elseif($category == 'thaniya niics'){
		$proglist = '<option value="song_arb">Song ARB</option>
									<option value="ghazal">Ghazal</option>
									<option value="song_eng">Song ENG</option>
									<option value="action_play">Action Play</option>
									<option value="speech_and_song">Speech and song</option>';
	}elseif($category == 'thanawiya'){
		$proglist = '<option value="W37">Speech and song</option>
									<option value="W7">Teaching (Kerala Padavali)</option>
									<option value="W9">Nasheed ARB</option>';
	}
if(isset($_GET['empty'])){
	$error = '<div class="alert alert-danger small text-center">Empty feald! Find candidate first!</div>';
}
mysqli_close($connect);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 | Register Topics</title>
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/fontawesome-all.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/css/fontawesome-all.min.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="../candidate/css/candidate.css">
		<link rel="stylesheet" href="../candidate/css/jquery-ui.min.css">
		<link href="../css/regdash.css" rel="stylesheet" media="all">
		<link rel="icon" href="../../img/logo.ico">
	</head>
	<body>
		<main>
			<div class="container-fluid">
				<div class="row">
					<?php
						$class = '';
						
						if($_SESSION['role'] == 'admin'){
							$class = 'admin';
						}else{
							$class = '';
						}
					echo '<div class="col-lg-3 col-md-3 '.$class.'" id="sidebar">';
						?>
						<div class="wrapper">
							<div class="head">
								<h2><a href="../profile.php">Sibaq '19</a></h2>
								<span class="brand-sub">Topic registration</span>
							</div>
							<?php
									include 'includes/picName.php';
								?>
							<div class="opts">
								<?php
									$list ='';
									
								if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
									$list = '<ul class="text-left" id="menu">
									<li><a href="index.php"><i class="fas fa-eye"></i> Overview</a></li>
									<li><a href="stati.php"><i class="fas fa-chart-bar"></i> Statistics</a></li>
									<li class="active"><a href="newEntry.php"><i class="fas fa-plus"></i> New Entry</a></li>
									<li><a href="mngEntry.php"><i class="fas fa-wrench"></i> Manage Entries</a></li>
									<li class="dropDown"><a><i class="fas fa-user"></i> Users</a>
										<ul class="dropMenu">
											<li><a href="addUser.php"><i class="fas fa-user-plus"></i> Add User</a></li>
											<li><a href="usersMgmt.php"><i class="fas fa-user"></i> Manage Users</a></li>
										</ul>
									</li>
									</ul>';
								}else{
									$list = '<ul class="text-left" id="menu">
									<li><a href="index.php"><i class="fas fa-eye"></i> Overview</a></li>
									<li class="active"><a href="newEntry.php"><i class="fas fa-plus"></i> New Entry</a></li>
									<li><a href="editEntry.php"><i class="fas fa-wrench"></i> Edit Entries</a></li>
									<li><a href="entryStatus.php"><i class="fas fa-clock"></i> Status</a></li>
									</ul>';
								}
									echo $list;
								?>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-9">
						<?php include 'includes/topbar.php'; ?>
						<div class="wrapper p-3">
						<?php echo $error; ?>
							<div class="head1">
								<h5>Register new topic</h5>
							</div>
							<div class="regForm pt-3">
								<form action="newEntry.php" class="form-horizontal" method="post" role="button">
										<div class="form-group">
											<div class="col-md-12">
												<label for="chestno" class="control-form">Chest No</label>
													<div class="input-group mb-6">
														<div class="input-group-prepend">
															<span class="input-group-text" id="chestnolabel">Eg.5114</span>
														</div>
														<?php
															echo '<input type="number" name="chestno" id="chestno" class="form-control" autocomplete="off" aria-label="Chest No" aria-describedby="chestnolabel" value="'.$real_chest.'" required>';
														?>
														<button id="find" class="btn btn-primary" name="find" value="Find" title="Find candidate"><i class="fa fa-search"></i></button>
													</div>
											</div>
											
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<label for="name" class="control-form">Candidate Name</label>
												<?php
													echo '<input type="text" name="name" class="input1" id="name" placeholder="Candidate name" value="'.$cand_name.'" readonly>';
												?>
											</div>
											
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<label for="name" class="control-form">UG</label>
												<?php
													echo '<input type="text" name="name" class="input1" id="name" placeholder="Candidate name" value="'.$cand_ug.'" readonly>';
												?>
											</div>
											
										</div>
										<div class="form-group">
										<div class="col-md-12">
											<label for="category" class="control-form">Category</label>
										</div>
										<div>
											<div class="col-md-6 float-left">
												<?php
												echo '<input type="text" name="category" class="input1" placeholder="Category Code" value="'.$cand_cat.'" readonly>';
												?>
											</div>
											<div class="col-md-6 float-left">
												<?php
												echo '<input type="text" name="category" class="input1" placeholder="Category Name" value="'.ucfirst($category).'" readonly>';
												
											?>
											</div>
											<div class="clearfix"></div>
										</div>
										</div>
									</form>
									<form action="regform.php" class="form-horizontal" role="form" method="post">
										<div class="col-md-12">
											<div class="form-group">
												<label for="category" class="control-form">Programme</label>
												<select name="item" class="select" required>
													<option value="">Select programme</option>
													<?php
													echo $proglist;
												?>
												</select>	
											</div>
											<div class="form-group">
												<label for="title" class="control-form">Title</label>
												<input type="text" name="title" class="input1" placeholder="Item title here" required>
											</div>
											<div class="form-group">
												<label for="link" class="control-form">Link</label>
												<input type="url" name="link" class="input1" placeholder="Insert correct link here" required>
											</div>
											<div class="form-group">
												<input type="submit" name="register" value="Register" class="btn btn-info input">
											</div>
										</div>
										
									</form>
							</div>
						</div>
					</div>
				</div>
		</main>
		<script src="../../js/jquery-3.3.1.js"></script>
		<script src="../../js/popper.min.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		  <script>
		  $( function() {
			$('.help').click(function(){
				$('#getLink').modal();
			});
			$('.select').selectmenu();
		  } );
		  </script>
		<script src="../js/reg.js"></script>
		<script src="../js/regDash.js"></script>
	</body>
</html>