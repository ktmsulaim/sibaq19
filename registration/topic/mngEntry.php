<?php
	session_start();
	include '../../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]'";
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
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 | Manage Entries</title>
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/fontawesome-all.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/css/fontawesome-all.min.css" rel="stylesheet" media="all">
		<link href="../css/regdash.css" rel="stylesheet" media="all">
		<link rel="icon" href="../../img/logo.ico">
		
		<style>
			
		</style>
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
									<li><a href="newEntry.php"><i class="fas fa-plus"></i> New Entry</a></li>
									<li class="active"><a href="mngEntry.php"><i class="fas fa-wrench"></i> Manage Entries</a></li>
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
								<h5>Manage entries</h5>
							</div>
							<div class="count">
								<div class="container-fluid">
									<div class="row">
										<div class="col-lg-3 col-md-3">
											<section class="tile text-center">
												<span id="total">
												Total Entries:<br>
												<h1>
												<?php
													if($_SESSION['role'] == 'admin'){
														$sel_sql = "SELECT * FROM final_topics WHERE date > '2019-01-15'";
														$run_sql = mysqli_query($connect, $sel_sql);
														$total = mysqli_num_rows($run_sql);
														echo $total;
													}elseif($_SESSION['role'] == 'natadmin'){
														$sel_sql = "SELECT * FROM regnational";
														$run_sql = mysqli_query($connect, $sel_sql);
														$total = mysqli_num_rows($run_sql);
														echo $total;
													}
													
												?>
												</h1>
											</span>
											</section>
											
										</div>
										<div class="col-lg-3 col-md-3">
											<section class="tile text-center">
												<span id="pending">
												Pending Entries:<br>
												<h1>
												<?php
													if($_SESSION['role'] == 'admin'){
														$sel_sql = "SELECT * FROM final_topics WHERE date > '2019-01-15' AND status = 'pending' AND category IN('bidaya', 'uoola', 'thaniya', 'thanawiya')";
														$run_sql = mysqli_query($connect, $sel_sql);
														echo mysqli_num_rows($run_sql);
													}elseif($_SESSION['role'] == 'natadmin'){
														$sel_sql = "SELECT * FROM regnational WHERE status = 'pending'";
														$run_sql = mysqli_query($connect, $sel_sql);
														echo mysqli_num_rows($run_sql);
													}
												?>
												</h1>
											</span>
											</section>
										</div>
										<div class="col-lg-3 col-md-3">
											<section class="tile text-center">
												<span id="accpted">
												Accepted Entries:<br>
												<h1>
												<?php
													if($_SESSION['role'] == 'admin'){
														$sel_sql = "SELECT * FROM final_topics WHERE date > '2019-01-15' AND status = 'accepted'";
														$run_sql = mysqli_query($connect, $sel_sql);
														echo mysqli_num_rows($run_sql);
													}elseif($_SESSION['role'] == 'natadmin'){
														$sel_sql = "SELECT * FROM regnational WHERE status = 'accepted'";
														$run_sql = mysqli_query($connect, $sel_sql);
														echo mysqli_num_rows($run_sql);
													}
												?>
												</h1>
											</span>
											</section>
										</div>
										<div class="col-lg-3 col-md-3">
											<section class="tile text-center">
												<span id="rejected">
												Rejected Entries:<br>
												<h1>
												<?php
													if($_SESSION['role'] == 'admin'){
														$sel_sql = "SELECT * FROM final_topics WHERE date > '2019-01-15' AND status = 'rejected'";
														$run_sql = mysqli_query($connect, $sel_sql);
														echo mysqli_num_rows($run_sql);
													}elseif($_SESSION['role'] == 'natadmin'){
														$sel_sql = "SELECT * FROM regnational WHERE status = 'rejected'";
														$run_sql = mysqli_query($connect, $sel_sql);
														echo mysqli_num_rows($run_sql);
													}
												?>
												</h1>
											</span>
											</section>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							
                <!--			ug entries tabs go here				-->
        
							<div id="dh" class="ugList">
								<ul id="myTab" class="nav nav-tabs">
									<li class="nav-item" id="bidayaTab"><a class="nav-link active" href="#bidaya" data-toggle="tab">Bidaya <?php
													if($_SESSION['role'] == 'admin'){
														$sel_sql = "SELECT * FROM final_topics WHERE date > '2019-01-15' AND status = 'pending' AND category = 'bidaya'";
														$run_sql = mysqli_query($connect, $sel_sql);
														$pending = mysqli_num_rows($run_sql);

														if($pending !== 0){
															echo '<span class="badge badge-default">'.$pending.' New</span>';
														}
													}elseif($_SESSION['role'] == 'natadmin'){
														$sel_sql = "SELECT * FROM regnational WHERE status = 'pending' AND category = 'bidaya'";
														$run_sql = mysqli_query($connect, $sel_sql);
														$pending = mysqli_num_rows($run_sql);

														if($pending !== 0){
															echo '<span class="badge badge-default">'.$pending.' New</span>';
														}
													}
													
													
												?></a></li>
									<li class="nav-item" id="uoolaTab"><a class="nav-link" href="#uoola" data-toggle="tab">Uoola <?php
													if($_SESSION['role'] == 'admin'){
														$sel_sql = "SELECT * FROM final_topics WHERE date > '2019-01-15' AND status = 'pending' AND category = 'uoola'";
														$run_sql = mysqli_query($connect, $sel_sql);
														$pending = mysqli_num_rows($run_sql);

														if($pending !== 0){
															echo '<span class="badge badge-default">'.$pending.' New</span>';
														}
													}elseif($_SESSION['role'] == 'natadmin'){
														$sel_sql = "SELECT * FROM regnational WHERE category = 'uoola'";
														$run_sql = mysqli_query($connect, $sel_sql);
														$pending = mysqli_num_rows($run_sql);

														if($pending !== 0){
															echo '<span class="badge badge-default">'.$pending.' New</span>';
														}
													}
													
													
												?></a></li>
									<li class="nav-item" id="thaniyaTab"><a class="nav-link" href="#thaniya" data-toggle="tab">Thaniya <?php
													if($_SESSION['role'] == 'admin'){
														$sel_sql = "SELECT * FROM final_topics WHERE date > '2019-01-15' AND status = 'pending' AND category = 'thaniya'";
														$run_sql = mysqli_query($connect, $sel_sql);
														$pending = mysqli_num_rows($run_sql);

														if($pending !== 0){
															echo '<span class="badge badge-default">'.$pending.' New</span>';
														}
													}elseif($_SESSION['role'] == 'natadmin'){
														$sel_sql = "SELECT * FROM regnational WHERE status = 'pending' AND category = 'thaniya'";
														$run_sql = mysqli_query($connect, $sel_sql);
														$pending = mysqli_num_rows($run_sql);

														if($pending !== 0){
															echo '<span class="badge badge-default">'.$pending.' New</span>';
														}
													}
													
													
												?></a></li>
									<li class="nav-item" id="thanawiyaTab"><a class="nav-link" href="#thanawiya" data-toggle="tab">Thanawiya <?php
													if($_SESSION['role'] == 'admin'){
														$sel_sql = "SELECT * FROM final_topics WHERE date > '2019-01-15' AND category = 'thanawiya' AND status = 'pending'";
														$run_sql = mysqli_query($connect, $sel_sql);
														$pending = mysqli_num_rows($run_sql);

														if($pending !== 0){
															echo '<span class="badge badge-default">'.$pending.' New</span>';
														}
													}else{}
													
													
												?></a></li>
								</ul>
							
			<!--		Ug entries contents					-->
						
							<div class="tab-content">
							
							<!----------------------- BIDAYA ----------------------------->
							
								<div class="tab-pane active" id="bidaya">
									<div class="table-list">
									<table class="table table-striped">
										<thead>
											<tr>
                                                <th>Sl.No</th>
                                                <th>Item</th>
                                                <th>Candidate</th>
                                                <th style="width:200px;">Title</th>
                                                <th>Institution</th>
                                                <th>Date &amp; Time</th>
                                                <th>Status</th>
                                                <th>Link</th>
                                                <th></th>
                                                <th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($_SESSION['role'] == 'admin'){
												$sel_sql = "SELECT DISTINCT * FROM final_topics WHERE date > '2019-01-15' AND category = 'bidaya' ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												$i = 1;
												date_default_timezone_get();
												
												while($row = mysqli_fetch_assoc($run_sql)){
													$link = '';

													if(!empty($row['link'])){
														$link = '<a href="'.$row['link'].'" target="_blank"><i class="fas fa-external-link-alt"></i></a>';
													}else{
														$link = '';
													}

													echo'<tr>
													<td>'.$i.'</td>
													<td>'.$row['programme'].'</td>
													<td>'.ucwords($row['candidate']).'</td>
													<td>'.ucwords($row['title']).'</td>
													<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
													<td>'.$row['date'].'</td>
													<td class="'.$row['status'].'">'.ucfirst($row['status']).'</td>
													<td class="text-center">'.$link.'</td>
													<td><a class="btn btn-success btn-sm" href="mngEntry.php?status=accepted&id='.$row['id'].'"><i class="fas fa-check"></i></a></td>
													<td><a class="btn btn-danger btn-sm" href="mngEntry.php?status=rejected&id='.$row['id'].'"><i class="fas fa-times"></i></a></td>
												</tr>';
												$i++;
												}
											}elseif($_SESSION['role'] == 'natadmin'){
												$sel_sql = "SELECT * FROM regnational WHERE category = 'bidaya niics' ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												$i = 1;
												date_default_timezone_set('Asia/Kolkata');
												
												while($row = mysqli_fetch_assoc($run_sql)){
													$link = '';

													if(!empty($row['link'])){
														$link = '<a href="'.$row['link'].'" target="_blank"><i class="fas fa-external-link-alt"></i></a>';
													}else{
														$link = '';
													}

													echo'<tr>
													<td>'.$i.'</td>
													<td>'.strtoupper(str_replace('_', ' ',$row['item'])).'</td>
													<td>'.ucwords($row['candidate']).'</td>
													<td>'.ucwords($row['title']).'</td>
													<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
													<td>'.$row['date'].'</td>
													<td class="'.$row['status'].'">'.ucfirst($row['status']).'</td>
													<td class="text-center">'.$link.'</td>
													<td><a class="btn btn-success btn-sm" href="mngEntry.php?status=accepted&id='.$row['id'].'"><i class="fas fa-check"></i></a></td>
													<td><a class="btn btn-danger btn-sm" href="mngEntry.php?status=rejected&id='.$row['id'].'"><i class="fas fa-times"></i></a></td>
												</tr>';
												$i++;
												}
											}
										
									?>
										</tbody>
									</table>
								</div>
								</div>	
								
								<!----------------------- UOOLA ----------------------------->
								
								<div class="tab-pane fade" id="uoola">
									<div class="table-list">
									<table class="table table-striped">
										<thead>
											<tr>
                                                <th>Sl.No</th>
                                                <th>Item</th>
                                                <th>Candidate</th>
                                                <th style="width:200px;">Title</th>
                                                <th>Institution</th>
                                                <th>Date &amp; Time</th>
                                                <th>Status</th>
                                                <th>Link</th>
                                                <th></th>
                                                <th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($_SESSION['role'] == 'admin'){
												$sel_sql = "SELECT * FROM final_topics WHERE date > '2019-01-15' AND category = 'uoola' ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												$i = 1;
												date_default_timezone_set('Asia/Kolkata');
												
												while($row = mysqli_fetch_assoc($run_sql)){
													$link = '';

													if(!empty($row['link'])){
														$link = '<a href="'.$row['link'].'" target="_blank"><i class="fas fa-external-link-alt"></i></a>';
													}else{
														$link = '';
													}


													echo'<tr>
													<td>'.$i.'</td>
													<td>'.$row['programme'].'</td>
													<td>'.ucwords($row['candidate']).'</td>
													<td>'.ucwords($row['title']).'</td>
													<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
													<td>'.$row['date'].'</td>
													<td class="'.$row['status'].'">'.ucfirst($row['status']).'</td>
													<td class="text-center">'.$link.'</td>
													<td><a class="btn btn-success btn-sm" href="mngEntry.php?status=accepted&id='.$row['id'].'"><i class="fas fa-check"></i></a></td>
													<td><a class="btn btn-danger btn-sm" href="mngEntry.php?status=rejected&id='.$row['id'].'"><i class="fas fa-times"></i></a></td>
												</tr>';
												$i++;
												}
											}elseif($_SESSION['role'] == 'natadmin'){
												$sel_sql = "SELECT * FROM regnational WHERE category = 'uoola niics' ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												$i = 1;
												date_default_timezone_set('Asia/Kolkata');
												
												while($row = mysqli_fetch_assoc($run_sql)){
													$link = '';

													if(!empty($row['link'])){
														$link = '<a href="'.$row['link'].'" target="_blank"><i class="fas fa-external-link-alt"></i></a>';
													}else{
														$link = '';
													}

													echo'<tr>
													<td>'.$i.'</td>
													<td>'.strtoupper(str_replace('_', ' ',$row['item'])).'</td>
													<td>'.ucwords($row['candidate']).'</td>
													<td>'.ucwords($row['title']).'</td>
													<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
													<td>'.$row['date'].'</td>
													<td class="'.$row['status'].'">'.ucfirst($row['status']).'</td>
													<td class="text-center">'.$link.'</td>
													<td><a class="btn btn-success btn-sm" href="mngEntry.php?status=accepted&id='.$row['id'].'"><i class="fas fa-check"></i></a></td>
													<td><a class="btn btn-danger btn-sm" href="mngEntry.php?status=rejected&id='.$row['id'].'"><i class="fas fa-times"></i></a></td>
												</tr>';
												$i++;
												}
											}
										
									?>
										</tbody>
									</table>
								</div>
								</div>	
								
								<!----------------------- THANIYA ----------------------------->
								
								<div class="tab-pane fade" id="thaniya">
									<div class="table-list">
									<table class="table table-striped">
										<thead>
											<tr>
                                                <th>Sl.No</th>
                                                <th>Item</th>
                                                <th>Candidate</th>
                                                <th style="width:200px;">Title</th>
                                                <th>Institution</th>
                                                <th>Date &amp; Time</th>
                                                <th>Status</th>
                                                <th>Link</th>
                                                <th></th>
                                                <th></th>
											</tr>
										</thead>
										<tbody>
											<?php
										if($_SESSION['role'] == 'admin'){
											$sel_sql = "SELECT * FROM final_topics WHERE date > '2019-01-15' AND category = 'thaniya' ORDER BY id DESC";
											$run_sql = mysqli_query($connect, $sel_sql);
											$i = 1;
											date_default_timezone_set('Asia/Kolkata');
											
											while($row = mysqli_fetch_assoc($run_sql)){
												$link = '';

												if(!empty($row['link'])){
													$link = '<a href="'.$row['link'].'" target="_blank"><i class="fas fa-external-link-alt"></i></a>';
												}else{
													$link = '';
												}

												echo'<tr>
												<td>'.$i.'</td>
												<td>'.$row['programme'].'</td>
												<td>'.ucwords($row['candidate']).'</td>
												<td>'.ucwords($row['title']).'</td>
												<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
												<td>'.$row['date'].'</td>
												<td class="'.$row['status'].'">'.ucfirst($row['status']).'</td>
												<td class="text-center">'.$link.'</td>
												<td><a class="btn btn-success btn-sm" href="mngEntry.php?status=accepted&id='.$row['id'].'"><i class="fas fa-check"></i></a></td>
												<td><a class="btn btn-danger btn-sm" href="mngEntry.php?status=rejected&id='.$row['id'].'"><i class="fas fa-times"></i></a></td>
											</tr>';
											$i++;
											}
										}elseif($_SESSION['role'] == 'natadmin'){
											$sel_sql = "SELECT * FROM regnational WHERE category = 'thaniya niics' ORDER BY id DESC";
											$run_sql = mysqli_query($connect, $sel_sql);
											$i = 1;
											date_default_timezone_set('Asia/Kolkata');
											
											while($row = mysqli_fetch_assoc($run_sql)){
												$link = '';

												if(!empty($row['link'])){
													$link = '<a href="'.$row['link'].'" target="_blank"><i class="fas fa-external-link-alt"></i></a>';
												}else{
													$link = '';
												}

												echo'<tr>
												<td>'.$i.'</td>
												<td>'.strtoupper(str_replace('_', ' ',$row['item'])).'</td>
												<td>'.ucwords($row['candidate']).'</td>
												<td>'.ucwords($row['title']).'</td>
												<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
												<td>'.$row['date'].'</td>
												<td class="'.$row['status'].'">'.ucfirst($row['status']).'</td>
												<td class="text-center">'.$link.'</td>
												<td><a class="btn btn-success btn-sm" href="mngEntry.php?status=accepted&id='.$row['id'].'"><i class="fas fa-check"></i></a></td>
												<td><a class="btn btn-danger btn-sm" href="mngEntry.php?status=rejected&id='.$row['id'].'"><i class="fas fa-times"></i></a></td>
											</tr>';
											$i++;
											}
										}
									?>
										</tbody>
									</table>
								</div>
								</div>	
								
								<!----------------------- THANAWIYA ----------------------------->
								
								<div class="tab-pane fade" id="thanawiya">
									<div class="table-list">
									<table class="table table-striped">
										<thead>
											<tr>
                                                <th>Sl.No</th>
                                                <th>Item</th>
                                                <th>Candidate</th>
                                                <th style="width:200px;">Title</th>
                                                <th>Institution</th>
                                                <th>Date &amp; Time</th>
                                                <th>Status</th>
                                                <th>Link</th>
                                                <th></th>
                                                <th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($_SESSION['role'] == 'admin'){
												$sel_sql = "SELECT * FROM final_topics WHERE date > '2019-01-15' AND category = 'thanawiya' ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												$i = 1;
												date_default_timezone_set('Asia/Kolkata');
												while($row = mysqli_fetch_assoc($run_sql)){
													$link = '';
													$file = '';

													if(!empty($row['link'])){
														$link = '<a href="'.$row['link'].'" target="_blank"><i class="fas fa-external-link-alt"></i></a>';
													}else{
														$link = '';
													}


													echo'<tr>
													<td>'.$i.'</td>
													<td>'.$row['programme'].'</td>
													<td>'.ucwords($row['candidate']).'</td>
													<td>'.ucwords($row['title']).'</td>
													<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
													<td>'.$row['date'].'</td>
													<td class="'.$row['status'].'">'.ucfirst($row['status']).'</td>
													<td class="text-center">'.$link.'</td>
													<td><a class="btn btn-success btn-sm" href="mngEntry.php?status=accepted&id='.$row['id'].'"><i class="fas fa-check"></i></a></td>
													<td><a class="btn btn-danger btn-sm" href="mngEntry.php?status=rejected&id='.$row['id'].'"><i class="fas fa-times"></i></a></td>
												</tr>';
												$i++;
												}
											}elseif($_SESSION['role'] == 'natadmin'){
												$sel_sql = "SELECT * FROM final_topics WHERE category = 'thanawiya' UNION ALL SELECT * FROM regnational WHERE category = 'thanawiya' ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												$i = 1;
												date_default_timezone_set('Asia/Kolkata');
												while($row = mysqli_fetch_assoc($run_sql)){
													$link = '';
													$file = '';

													if(!empty($row['link'])){
														$link = '<a href="'.$row['link'].'" target="_blank"><i class="fas fa-external-link-alt"></i></a>';
													}else{
														$link = '';
													}

													echo'<tr>
													<td>'.$i.'</td>
													<td>'.strtoupper(str_replace('_', ' ',$row['item'])).'</td>
													<td>'.ucwords($row['candidate']).'</td>
													<td>'.ucwords($row['title']).'</td>
													<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
													<td>'.$row['date'].'</td>
													<td class="'.$row['status'].'">'.ucfirst($row['status']).'</td>
													<td class="text-center">'.$link.'</td>
													<td><a class="btn btn-success btn-sm" href="mngEntry.php?status=accepted&id='.$row['id'].'"><i class="fas fa-check"></i></a></td>
													<td><a class="btn btn-danger btn-sm" href="mngEntry.php?status=rejected&id='.$row['id'].'"><i class="fas fa-times"></i></a></td>
												</tr>';
												$i++;
												}
											}
										
									?>
										</tbody>
									</table>
							
								<!--				Update status function					-->
								
									<?php
										if(isset($_GET['status'])){
											$status = $_GET['status'];
											if($_SESSION['role'] == 'admin'){
												$edit_sql = "UPDATE final_topics SET status = '$status' WHERE id = '$_GET[id]'";
												$run_sql = mysqli_query($connect, $edit_sql);
											}elseif($_SESSION['role'] == 'natadmin'){
												$edit_sql = "UPDATE regnational SET status = '$status' WHERE id = '$_GET[id]'";
												$run_sql = mysqli_query($connect, $edit_sql);
											}
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
		<script src="../../js/popper.min.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.min.js"></script>
		<script>
			$(function(){
				$('.table').tablesorter();
			});
			
		</script>
		<script src="../js/reg.js"></script>
		<script src="../js/regDash.js"></script>
	</body>
</html>