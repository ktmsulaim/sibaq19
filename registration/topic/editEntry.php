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

	if(isset($_GET['del_id'])){
		if($_SESSION['role'] == 'ug' || $_SESSION['role'] == 'admin'){
				$del_sql = "DELETE FROM final_topics WHERE id = '$_GET[del_id]'";
				$run_sql = mysqli_query($connect, $del_sql);
		}else if($_SESSION['role'] == 'ugnat' || $_SESSION['role'] == 'natadmin'){
			$del_sql = "DELETE FROM regnational WHERE id = '$_GET[del_id]'";
			$run_sql = mysqli_query($connect, $del_sql);
		}
		
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 | Edit Entries</title>
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
					<div class="col-lg-3 col-md-3" id="sidebar">
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
									<li class="active"><a href="editEntry.php"><i class="fas fa-wrench"></i> Edit Entries</a></li>
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
							<div class="head1">
								<h5>Edit Entries</h5>
							</div>
							<div class="pt-3">
								<ul id="myTab" class="nav nav-tabs">
									<li class="nav-item" id="bidayaTab"><a class="nav-link active" href="#bidaya" data-toggle="tab">Bidaya</a></li>
									<li class="nav-item" id="uoolaTab"><a class="nav-link" href="#uoola" data-toggle="tab">Uoola</a></li>
									<li class="nav-item" id="thaniyaTab"><a class="nav-link" href="#thaniya" data-toggle="tab">Thaniya</a></li>
									<li class="nav-item" id="thanawiyaTab"><a class="nav-link" href="#thanawiya" data-toggle="tab">Thanawiya</a></li>
								</ul>
							
							<div class="tab-content">
								<div class="tab-pane active" id="bidaya">
									<div class="table-list">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Item</th>
												<th>Candidate</th>
												<th style="width:200px;">Title</th>
												<th>Date &amp; Time</th>
												<th>Status</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($_SESSION['role'] == 'ug' || $_SESSION['role'] == 'admin'){
												$sel_sql = "SELECT * FROM final_topics WHERE category = 'bidaya' AND author = '$_SESSION[user]' ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												date_default_timezone_get();
												
												while($row = mysqli_fetch_assoc($run_sql)){
													$author = $row['author'];
													global $author;
													echo'<tr>
														<td>'.$row['programme'].'</td>
														<td>'.ucwords($row['candidate']).'</td>
														<td>'.ucwords($row['title']).'</td>
														<td>'.$row['date'].'</td>
														<td>'.ucfirst($row['status']).'</td>
														<td><a id="trashbtn" href="editEntry.php?del_id='.$row['id'].'"><i class="fas fa-trash"></i></a></td>
												</tr>';
												}	
											}else{
												$sel_sql = "SELECT * FROM regnational WHERE category = 'bidaya niics' AND author = '$_SESSION[user]' ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												date_default_timezone_get();
												
												while($row = mysqli_fetch_assoc($run_sql)){
													echo'<tr>
														<td>'.$row['programme'].'</td>
														<td>'.ucwords($row['candidate']).'</td>
														<td>'.ucwords($row['title']).'</td>
														<td>'.$row['date'].'</td>
														<td>'.ucfirst($row['status']).'</td>
														<td><a id="trashbtn" href="editEntry.php?del_id='.$row['id'].'"><i class="fas fa-trash"></i></a></td>
												</tr>';
												}
											}
										
										
									?>
										</tbody>
									</table>
								</div>
								</div>	
								<div class="tab-pane fade" id="uoola">
									<div class="table-list">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Item</th>
												<th>Candidate</th>
												<th style="width:200px;">Title</th>
												<th>Date &amp; Time</th>
												<th>Status</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($_SESSION['role'] == 'ug' || $_SESSION['role'] == 'admin'){
												$sel_sql = "SELECT * FROM final_topics WHERE category = 'uoola' AND author = '$_SESSION[user]' ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												date_default_timezone_get();
												
												while($row = mysqli_fetch_assoc($run_sql)){
													echo'<tr>
														<td>'.$row['programme'].'</td>
														<td>'.ucwords($row['candidate']).'</td>
														<td>'.ucwords($row['title']).'</td>
														<td>'.$row['date'].'</td>
														<td>'.ucfirst($row['status']).'</td>
														<td><a id="trashbtn" href="editEntry.php?del_id='.$row['id'].'"><i class="fas fa-trash"></i></a></td>
												</tr>';
												}
											}else{
												$sel_sql = "SELECT * FROM regnational WHERE category = 'uoola niics' AND author = '$_SESSION[user]' ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												date_default_timezone_get();
												
												while($row = mysqli_fetch_assoc($run_sql)){
													echo'<tr>
														<td>'.strtoupper(str_replace('_', ' ',$row['item'])).'</td>
														<td>'.ucwords($row['candidate']).'</td>
														<td>'.ucwords($row['title']).'</td>
														<td>'.$row['date'].'</td>
														<td>'.ucfirst($row['status']).'</td>
														<td><a id="trashbtn" href="editEntry.php?del_id='.$row['id'].'"><i class="fas fa-trash"></i></a></td>
												</tr>';
												}
											}
										
										
									?>
										</tbody>
									</table>
								</div>
								</div>	
								<div class="tab-pane fade" id="thaniya">
									<div class="table-list">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Item</th>
												<th>Candidate</th>
												<th style="width:200px;">Title</th>
												<th>Date &amp; Time</th>
												<th>Status</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($_SESSION['role'] == 'ug' || $_SESSION['role'] == 'admin'){
												$sel_sql = "SELECT * FROM final_topics WHERE category = 'thaniya' AND author = '$_SESSION[user]' ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												date_default_timezone_get();
												
												while($row = mysqli_fetch_assoc($run_sql)){
													echo'<tr>
														<td>'.$row['programme'].'</td>
														<td>'.ucwords($row['candidate']).'</td>
														<td>'.ucwords($row['title']).'</td>
														<td>'.$row['date'].'</td>
														<td>'.ucfirst($row['status']).'</td>
														<td><a id="trashbtn" id="trashbtn" href="editEntry.php?del_id='.$row['id'].'"><i class="fas fa-trash"></i></a></td>
												</tr>';
												}
											}else{
												$sel_sql = "SELECT * FROM regnational WHERE category = 'thaniya niics' AND author = '$_SESSION[user]' ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												date_default_timezone_get();
												
												while($row = mysqli_fetch_assoc($run_sql)){
													echo'<tr>
														<td>'.strtoupper(str_replace('_', ' ',$row['item'])).'</td>
														<td>'.ucwords($row['candidate']).'</td>
														<td>'.ucwords($row['title']).'</td>
														<td>'.$row['date'].'</td>
														<td>'.ucfirst($row['status']).'</td>
														<td><a id="trashbtn" href="editEntry.php?del_id='.$row['id'].'"><i class="fas fa-trash"></i></a></td>
												</tr>';
												}
											}
										
										
									?>
										</tbody>
									</table>
								</div>
								</div>	
								<div class="tab-pane fade" id="thanawiya">
									<div class="table-list">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Item</th>
												<th>Candidate</th>
												<th style="width:200px;">Title</th>
												<th>Date &amp; Time</th>
												<th>Status</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($_SESSION['role'] == 'ug' || $_SESSION['role'] == 'admin'){
												$sel_sql = "SELECT * FROM final_topics WHERE category = 'thanawiya' AND author = '$_SESSION[user]' ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												date_default_timezone_get();
												
												while($row = mysqli_fetch_assoc($run_sql)){
													echo'<tr>
														<td>'.$row['programme'].'</td>
														<td>'.ucwords($row['candidate']).'</td>
														<td>'.ucwords($row['title']).'</td>
														<td>'.$row['date'].'</td>
														<td>'.ucfirst($row['status']).'</td>
														<td><a id="trashbtn" href="editEntry.php?del_id='.$row['id'].'"><i class="fas fa-trash"></i></a></td>
												</tr>';
												}
											}else{
												echo '<tr><div class="alert alert-warning">You cannot register for this category</div></tr>';
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
						<div class="row">
							<div class="col-md-8 m-auto">
								<div class="note">
									<i class="fa fa-exclamation-triangle"></i><b> Note:</b><span>You can delete the entries done by mistake which are not be regarded as an entry. So be careful when delete an entry! deleted entry cannot be recycled.</span>
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
				$('#trashbtn').mouseenter(function(){
					$('.note').fadeIn();
				});
			});
			
		</script>
		<script type="text/javascript">
		$(document).ready(function(){

			$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

				localStorage.setItem('activeTab', $(e.target).attr('href'));

			});

			var activeTab = localStorage.getItem('activeTab');

			if(activeTab){

				$('#myTab a[href="' + activeTab + '"]').tab('show');

			}

		});
		</script>
		<script src="../js/regDash.js"></script>
	</body>
</html>