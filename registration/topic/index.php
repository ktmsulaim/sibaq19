<?php
	session_start();
	include '../../db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$select = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]' AND ug_name = '$_SESSION[ugname]'";
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
//select all from db state

$sel_bid_sql = "SELECT * FROM final_topics WHERE category = 'bidaya' AND status = 'accepted'";
$run_bid_sel = mysqli_query($connect, $sel_bid_sql);

$sel_uoola_sql = "SELECT * FROM final_topics WHERE category = 'uoola' AND status = 'accepted'";
$run_uoola_sel = mysqli_query($connect, $sel_uoola_sql);

$sel_thaniya_sql = "SELECT * FROM final_topics WHERE category = 'thaniya' AND status = 'accepted'";
$run_thaniya_sel = mysqli_query($connect, $sel_thaniya_sql);

$sel_thanawiya_sql = "SELECT * FROM final_topics WHERE category = 'thanawiya' AND status = 'accepted'";
$run_thanawiya_sel = mysqli_query($connect, $sel_thanawiya_sql);


$bidaya = mysqli_num_rows($run_bid_sel);
$uoola = mysqli_num_rows($run_uoola_sel);
$thaniya = mysqli_num_rows($run_thaniya_sel);
$thanawiya = mysqli_num_rows($run_thanawiya_sel);

//select all from db national
$sel_ugphotosql = "SELECT photo FROM users WHERE username = '$_SESSION[user]'";
$run_ugphoto = mysqli_query($connect, $sel_ugphotosql);
while($ugrow = mysqli_fetch_assoc($run_ugphoto)){
	$ugphoto = $ugrow['photo'];
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 | Topic Registration</title>
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/fontawesome-all.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/css/fontawesome-all.min.css" rel="stylesheet" media="all">
		<link href="../css/regdash.css" rel="stylesheet" media="all">
		<link rel="icon" href="../../img/logo.ico">
		<link href="https://fonts.googleapis.com/css?family=Poppins|Raleway|Roboto+Slab" rel="stylesheet"> 
		<script src="../../js/jquery-3.3.1.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
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
									
								if($_SESSION['user'] == 'admin' || $_SESSION['user'] == 'natadmin'){
									$list = '<ul class="text-left" id="menu">
									<li class="active"><a href="index.php"><i class="fas fa-eye"></i> Overview</a></li>
									<li><a href="stati.php"><i class="fas fa-chart-bar"></i> Statistics</a></li>
									<li><a href="newEntry.php"><i class="fas fa-plus"></i> New Entry</a></li>
									<li><a href="mngEntry.php"><i class="fas fa-wrench"></i> Manage Entries</a></li>
									</ul>';
								}else{
									$list = '<ul class="text-left" id="menu">
									<li class="active"><a href="index.php"><i class="fas fa-eye"></i> Overview</a></li>
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
						     <?php
                               if(isset($_GET['access'])){
                                if($_GET['access'] == 'nopermission'){
                                    $noac = '<div class="alert alert-danger">No permission! acces denied!</div>';
                                    echo $noac;
                                }
                            }
                            ?>
							<div id="dh" class="ugList">
								<ul id="myTab" class="nav nav-tabs">
									<li class="nav-item" id="bidayaTab"><a class="nav-link active" href="#bidaya" data-toggle="tab">Bidaya</a></li>
									<li class="nav-item" id="uoolaTab"><a class="nav-link" href="#uoola" data-toggle="tab">Uoola</a></li>
									<li class="nav-item" id="thaniyaTab"><a class="nav-link" href="#thaniya" data-toggle="tab">Thaniya</a></li>
									<li class="nav-item" id="thanawiyaTab"><a class="nav-link" href="#thanawiya" data-toggle="tab">Thanawiya</a></li>
								</ul>
								
						<!----------------------- BIDAYA ----------------------------->
						
							<div class="tab-content">
								<div class="tab-pane active" id="bidaya">
									<div class="table-list">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Item</th>
												<th>Candidate</th>
												<th style="width:200px;">Title</th>
												<th>Date</th>
												<th>Status</th>
												<th>Institution</th>
												<th>Link</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if($_SESSION['role'] == 'ug' || $_SESSION['role'] == 'admin'){
												$sel_sql = "SELECT * FROM final_topics WHERE category = 'bidaya' AND status IN ('pending', 'accepted') ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												$i = 1;
												while($row = mysqli_fetch_assoc($run_sql)){
													echo'<tr>
													<td>'.$i.'</td>
													<td>'.$row['programme'].'</td>
													<td>'.ucwords($row['candidate']).'</td>
													<td>'.ucwords($row['title']).'</td>
													<td>'.$row['date'].'</td>
													<td>'.ucfirst($row['status']).'</td>
													<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
													<td>'.'<a href="'.$row['link'].'"><i class="fa fa-external-link-alt"></i></a>'.'</td>
												</tr>';
												$i++;
												}
											}else{
													$sel_sql = "SELECT * FROM regnational WHERE category = 'bidaya niics' AND status IN ('pending', 'accepted') ORDER BY id DESC";
													$run_sql = mysqli_query($connect, $sel_sql);
														$i = 1;
													while($row = mysqli_fetch_assoc($run_sql)){
														echo'<tr>
														<td>'.$i.'</td>
														<td>'.$row['programme'].'</td>
														<td>'.ucwords($row['candidate']).'</td>
														<td>'.ucwords($row['title']).'</td>
														<td>'.$row['date'].'</td>
														<td>'.ucfirst($row['status']).'</td>
														<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
														<td>'.'<a href="'.$row['link'].'"><i class="fa fa-external-link-alt"></i></a>'.'</td>
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
												<th>No</th>
												<th>Item</th>
												<th>Candidate</th>
												<th style="width:200px;">Title</th>
												<th>Date</th>
												<th>Status</th>
												<th>Institution</th>
												<th>Link</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($_SESSION['role'] == 'ug' || $_SESSION['role'] == 'admin'){
												$sel_sql = "SELECT * FROM final_topics WHERE category = 'uoola' AND status IN ('pending', 'accepted') ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												$i = 1;
												while($row = mysqli_fetch_assoc($run_sql)){
													echo'<tr>
													<td>'.$i.'</td>
													<td>'.$row['programme'].'</td>
													<td>'.ucwords($row['candidate']).'</td>
													<td>'.ucwords($row['title']).'</td>
													<td>'.$row['date'].'</td>
													<td>'.ucfirst($row['status']).'</td>
													<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
													<td>'.'<a href="'.$row['link'].'"><i class="fa fa-external-link-alt"></i></a>'.'</td>
												</tr>';
												$i++;
												}	
											}else{
												$sel_sql = "SELECT * FROM regnational WHERE category = 'uoola niics' AND status IN ('pending', 'accepted') ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												$i = 1;
												while($row = mysqli_fetch_assoc($run_sql)){
													echo'<tr>
													<td>'.$i.'</td>
													<td>'.strtoupper(str_replace('_', ' ',$row['item'])).'</td>
													<td>'.ucwords($row['candidate']).'</td>
													<td>'.ucwords($row['title']).'</td>
													<td>'.$row['date'].'</td>
													<td>'.ucfirst($row['status']).'</td>
													<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
													<td>'.'<a href="'.$row['link'].'"><i class="fa fa-external-link-alt"></i></a>'.'</td>
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
												<th>No</th>
												<th>Item</th>
												<th>Candidate</th>
												<th style="width:200px;">Title</th>
												<th>Date</th>
												<th>Status</th>
												<th>Institution</th>
												<th>Link</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($_SESSION['role'] == 'ug' || $_SESSION['role'] == 'admin'){
												$sel_sql = "SELECT * FROM final_topics WHERE category = 'thaniya' AND status IN ('pending', 'accepted') ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												$i = 1;
												while($row = mysqli_fetch_assoc($run_sql)){
													echo'<tr>
													<td>'.$i.'</td>
													<td>'.$row['programme'].'</td>
													<td>'.ucwords($row['candidate']).'</td>
													<td>'.ucwords($row['title']).'</td>
													<td>'.$row['date'].'</td>
													<td>'.ucfirst($row['status']).'</td>
													<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
													<td>'.'<a href="'.$row['link'].'"><i class="fa fa-external-link-alt"></i></a>'.'</td>
												</tr>';
												$i++;
												}
											}else{
												$sel_sql = "SELECT * FROM regnational WHERE category = 'thaniya niics' AND status IN ('pending', 'accepted') ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												$i = 1;
												while($row = mysqli_fetch_assoc($run_sql)){
													echo'<tr>
													<td>'.$i.'</td>
													<td>'.strtoupper(str_replace('_', ' ',$row['item'])).'</td>
													<td>'.ucwords($row['candidate']).'</td>
													<td>'.ucwords($row['title']).'</td>
													<td>'.$row['date'].'</td>
													<td>'.ucfirst($row['status']).'</td>
													<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
													<td>'.'<a href="'.$row['link'].'"><i class="fa fa-external-link-alt"></i></a>'.'</td>
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
												<th>No</th>
												<th>Item</th>
												<th>Candidate</th>
												<th style="width:200px;">Title</th>
												<th>Date</th>
												<th>Status</th>
												<th>Institution</th>
												<th>Link</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$sel_sql = "SELECT * FROM final_topics WHERE category = 'thanawiya' AND status IN ('accepted', 'pending') ORDER BY id DESC";
												$run_sql = mysqli_query($connect, $sel_sql);
												$i = 1;
												while($row = mysqli_fetch_assoc($run_sql)){
													echo'<tr>
													<td>'.$i.'</td>
													<td>'.$row['programme'].'</td>
													<td>'.ucwords($row['candidate']).'</td>
													<td>'.ucwords($row['title']).'</td>
													<td>'.$row['date'].'</td>
													<td>'.ucfirst($row['status']).'</td>
													<td>'.strtoupper(preg_replace('/@.*/', '', $row['author'])).'</td>
													<td>'.'<a href="'.$row['link'].'"><i class="fa fa-external-link-alt"></i></a>'.'</td>
												</tr>';
												$i++;
												}
											 mysql_close($connect);
											?>
										</tbody>
									</table>
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
		<script>
			$(function(){
				$('.table').tablesorter();
			});
			
		</script>
		<script src="../js/regDash.js"></script>
	</body>
</html>