<?php
	session_start();
	include '../../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]' AND ug_name = '$_SESSION[ugname]'";
		if($result = mysqli_query($connect, $select)){
			if(mysqli_num_rows($result) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'natadmin'){
                    
                }else{
                    header('Location: index.php?access=nopermission');
                }
			}else{
				header('Location: login.php');
			}
		}
	}else{
		header('Location: login.php');
	}

//select all from db state
$sel_sql = "SELECT * FROM regstate";
$run_sel = mysqli_query($connect, $sel_sql);

$sel_bid_sql = "SELECT * FROM regstate WHERE category = 'bidaya'";
$run_bid_sel = mysqli_query($connect, $sel_bid_sql);

$sel_uoola_sql = "SELECT * FROM regstate WHERE category = 'uoola'";
$run_uoola_sel = mysqli_query($connect, $sel_uoola_sql);

$sel_thaniya_sql = "SELECT * FROM regstate WHERE category = 'thaniya'";
$run_thaniya_sel = mysqli_query($connect, $sel_thaniya_sql);

$sel_thanawiya_sql = "SELECT * FROM regstate WHERE category = 'thanawiya'";
$run_thanawiya_sel = mysqli_query($connect, $sel_thanawiya_sql);

// select all from db national
$seln_sql = "SELECT * FROM regnational";
$run_seln = mysqli_query($connect, $seln_sql);
while($row = mysqli_fetch_assoc($run_seln)){
	if($row['category'] == 'thanawiya'){
		continue;
	}
	$totalEntriesn = mysqli_num_rows($run_seln);
}

$sel_bidn_sql = "SELECT * FROM regnational WHERE category = 'bidaya'";
$run_bidn_sel = mysqli_query($connect, $sel_bidn_sql);

$sel_uoolan_sql = "SELECT * FROM regnational WHERE category = 'uoola'";
$run_uoolan_sel = mysqli_query($connect, $sel_uoolan_sql);

$sel_thaniyan_sql = "SELECT * FROM regnational WHERE category = 'thaniya'";
$run_thaniyan_sel = mysqli_query($connect, $sel_thaniyan_sql);

$sel_thanawiyan_sql = "SELECT * FROM regnational WHERE category = 'thanawiya'";
$run_thanawiyan_sel = mysqli_query($connect, $sel_thanawiyan_sql);


$bidaya = mysqli_num_rows($run_bid_sel);
$uoola = mysqli_num_rows($run_uoola_sel);
$thaniya = mysqli_num_rows($run_thaniya_sel);
$thanawiya = mysqli_num_rows($run_thanawiya_sel);
$totalEntries = mysqli_num_rows($run_sel);


$bidayan = mysqli_num_rows($run_bidn_sel);
$uoolan = mysqli_num_rows($run_uoolan_sel);
$thaniyan = mysqli_num_rows($run_thaniyan_sel);
$thanawiyan = mysqli_num_rows($run_thanawiyan_sel);
$totalEntriesn = mysqli_num_rows($run_seln);

mysqli_close($connect);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 | Statistics</title>
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/fontawesome-all.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/css/fontawesome-all.min.css" rel="stylesheet" media="all">
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
									<li class="active"><a href="stati.php"><i class="fas fa-chart-bar"></i> Statistics</a></li>
									<li><a href="newEntry.php"><i class="fas fa-plus"></i> New Entry</a></li>
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
									<li><a href="newEntry.php"><i class="fas fa-plus"></i> New Entry</a></li>
									<li><a href="editEntry.php"><i class="fas fa-wrench"></i> Edit Entries</a></li>
									<li class="active"><a href="entryStatus.php"><i class="fas fa-clock"></i> Status</a></li>
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
							<div id="dh" class="ugList">
								<div class="head1">
									<h5>Statistics</h5>	
								</div>
								<div class="table-list">
								<div class="container">
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<table class="table">
												<tr>
													<th>Bidaya</th>
													<td><?php
														if($_SESSION['role'] == 'admin'){
															echo $bidaya;
														}else{
															echo $bidayan;
														}
														 ?></td>
													<td><?php
														if($_SESSION['role'] == 'admin'){
															echo (144 - $bidaya) . ' left'; 
														}else{
															echo (46 - $bidayan) . ' left'; 
														}
														?></td>
												</tr>
												<tr>
													<th>Uoola</th>
													<td><?php
														if($_SESSION['role'] == 'admin'){
															echo $uoola;
														}else{
															echo $uoolan;
														}
														 ?></td>
													<td><?php
														if($_SESSION['role'] == 'admin'){
															echo (192 - $uoola) . ' left'; 
														}else{
															echo (46 - $uoolan) . ' left'; 
														}
														?></td>
												</tr>
												<tr>
													<th>Thaniya</th>
													<td><?php
														if($_SESSION['role'] == 'admin'){
															echo $thaniya;
														}else{
															echo $thaniyan;
														}
														 ?></td>
													<td><?php
														if($_SESSION['role'] == 'admin'){
															echo (147 - $thaniya) . ' left'; 
														}else{
															echo (54 - $thaniyan) . ' left'; 
														}
														?></td>
												</tr>
												<tr>
													<th>Thanawiya</th>
													<td><?php
														if($_SESSION['role'] == 'admin'){
															echo $thanawiya;
														}else{}
														 ?></td>
													<td><?php
														if($_SESSION['role'] == 'admin'){
															echo (63 - $thanawiya) . ' left'; 
														}else{}
														?></td>
												</tr>
												<tr>
													<th>Total Entries</th>
													<td><?php
														if($_SESSION['role'] == 'admin'){
															echo $totalEntries;
														}else{
															echo $totalEntriesn;
														}
														 ?></td>
													<td><?php
														if($_SESSION['role'] == 'admin'){
															echo (546 - $totalEntries) . ' left'; 
														}else{
															echo (146 - $totalEntriesn) . ' left';
														}
														?></td>
												</tr>
												<tr>
													<th>Percentage</th>
													<td>
														<?php
														if($_SESSION['role'] == 'admin'){
															$percentage = ($totalEntries * 100) / 546;
															echo number_format($percentage, 2).'%';
														}else{
															$percentage = ($totalEntriesn * 100) / 146;
															echo number_format($percentage, 2).'%';
														}
													
													?>
													</td>
													<td></td>
												</tr>
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
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../js/jquery.tablesorter.min.js"></script>
		<script>
			$(function(){
				$('.table').tablesorter();
			});
			
		</script>
		<script src="../js/regDash.js"></script>
	</body>
</html>