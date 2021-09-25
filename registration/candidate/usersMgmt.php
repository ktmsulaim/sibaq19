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

	// delete users
	$msg = '';
	if(isset($_GET['del_id'])){
		$sql_del = "DELETE FROM users WHERE user_id = '$_GET[del_id]'";
		if(mysqli_query($connect, $sql_del)){
			header('Location: usersMgmt.php?success');
		}
	}elseif(isset($_GET['success'])){
		$msg = '<div class="alert alert-success text-center small col-md-4">Deleted successfully!</div>';
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 | Manage User</title>
		<meta http-equiv="content-type">
		<link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
		<link href="../../css/fontawsome/fontawesome-all.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="css/candidate.css" media="all">
		<link href="../css/regdash.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="../css/jquery-ui.min.css" media="all">
		<link rel="stylesheet" href="../css/tableexport.min.css">
		<link rel="icon" href="../../img/logo.ico">
		<link href="https://fonts.googleapis.com/css?family=Poppins|Raleway|Roboto+Slab" rel="stylesheet"> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">		
	</head>
	<body>
		<main>
			<?php print $msg; ?>
			<div class="container-fluid">
				<div class="row">
				<?php include 'topbar.php'; ?>
							<div class="col-lg-3 col-md-3 bg-dark" id="profileSide">
							<ul class="navbar-nav" id="menu">
								<?php include 'include/nav.php'; ?>
							</ul>
						</div>
					<div class="col-lg-9 col-md-9">
						<div class="wrapper p-3">
							<div class="head1">
								<h5>Manage Users</h5>
							</div>
							<div class="mngent pt-3">
							    <div class="title">
							        <h4>Admin</h4>
							    </div>
								<table class="table table-hover table-responsive">
									<thead>
										<tr>
											<th>Sl.No</th>
											<th>Ug name</th>
											<th>Username</th>
											<th>Role</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sel_sql = "SELECT * FROM users WHERE role = 'admin' OR role = 'natadmin'";
											$user_run = mysqli_query($connect, $sel_sql);
											$i=1;
											while($row = mysqli_fetch_assoc($user_run)){
											
												
												echo '<tr><td>'.$i.'</td>
														<td>'.ucwords($row['ug_name']).'</td>
														<td>'.$row['username'].'</td>
														<td>'.$row['role'].'</td>
														<td><a class="btn btn-danger btn-sm" href="usersMgmt.php?del_id='.$row['user_id'].'"><i class="fa fa-trash"></i></a></td>
														
												</tr>';
											     $i++;
											}
										?>
									</tbody>
								</table>
							</div>
						    
						<!--		mark entry users				    -->
						    
						    <div class="mngent pt-3">
							    <div class="title">
							        <h4>Mark entry</h4>
							    </div>
								<table class="table table-hover table-responsive">
									<thead>
										<tr>
											<th>Sl.No</th>
											<th>Ug name</th>
											<th>Username</th>
											<th>Role</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sel_sql = "SELECT * FROM users WHERE role = 'markentry'";
											$user_run = mysqli_query($connect, $sel_sql);
											$i=1;
											while($row = mysqli_fetch_assoc($user_run)){
											
												
												echo '<tr><td>'.$i.'</td>
														<td>'.ucwords($row['ug_name']).'</td>
														<td>'.$row['username'].'</td>
														<td>'.$row['role'].'</td>
														<td><a class="btn btn-danger btn-sm" href="usersMgmt.php?del_id='.$row['user_id'].'"><i class="fa fa-trash"></i></a></td>
														
												</tr>';
											     $i++;
											}
										?>
									</tbody>
								</table>
							</div>
					<!--		Media wings					-->
					   <div class="mngent pt-3">
										<div class="title">
											<h4>Media</h4>
										</div>
										<table class="table table-hover table-responsive">
											<thead>
												<tr>
													<th>Sl.No</th>
													<th>Ug name</th>
													<th>Username</th>
													<th>Role</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_sql = "SELECT * FROM users WHERE role = 'media'";
													$user_run = mysqli_query($connect, $sel_sql);
													$i=1;
													while($row = mysqli_fetch_assoc($user_run)){


														echo '<tr><td>'.$i.'</td>
																<td>'.ucwords($row['ug_name']).'</td>
																<td>'.$row['username'].'</td>
																<td>'.$row['role'].'</td>
																<td><a class="btn btn-danger btn-sm" href="usersMgmt.php?del_id='.$row['user_id'].'"><i class="fa fa-trash"></i></a></td>

														</tr>';
														 $i++;
													}
												?>
											</tbody>
										</table>
									</div>
				<!--		Media wings					-->
					   <div class="mngent pt-3">
										<div class="title">
											<h4>Venue</h4>
										</div>
										<table class="table table-hover table-responsive">
											<thead>
												<tr>
													<th>Sl.No</th>
													<th>Venue name</th>
													<th>Username</th>
													<th>Role</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_sql = "SELECT * FROM users WHERE role = 'venue'";
													$user_run = mysqli_query($connect, $sel_sql);
													$i=1;
													while($row = mysqli_fetch_assoc($user_run)){


														echo '<tr><td>'.$i.'</td>
																<td>'.ucwords($row['ug_name']).'</td>
																<td>'.$row['username'].'</td>
																<td>'.$row['role'].'</td>
																<td><a class="btn btn-danger btn-sm" href="usersMgmt.php?del_id='.$row['user_id'].'"><i class="fa fa-trash"></i></a></td>

														</tr>';
														 $i++;
													}
												?>
											</tbody>
										</table>
									</div>

                <!--           Ug state users go here                 -->
                           
                            <div class="mngent pt-3">
							    <div class="title">
							        <h4>Ug state</h4>
							    </div>
								<table class="table table-hover table-responsive">
									<thead>
										<tr>
											<th>Sl.No</th>
											<th>Ug name</th>
											<th>Username</th>
											<th>Role</th>
											<th>Sibaq Id</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sel_sql = "SELECT * FROM users WHERE role = 'ug'";
											$user_run = mysqli_query($connect, $sel_sql);
											$i=1;
											while($row = mysqli_fetch_assoc($user_run)){
											
												
												echo '<tr><td>'.$i.'</td>
														<td>'.ucwords($row['ug_name']).'</td>
														<td>'.$row['username'].'</td>
														<td>'.$row['role'].'</td>
														<td>'.$row['sibaq_id'].'</td>
														<td><a class="btn btn-danger btn-sm" href="usersMgmt.php?del_id='.$row['user_id'].'"><i class="fa fa-trash"></i></a></td>
														
												</tr>';
											     $i++;
											}
										?>
									</tbody>
								</table>
							</div>
                <!--          UG National go here                  -->
                            
                            <div class="mngent pt-3">
							    <div class="title">
							        <h4>Ug National</h4>
							    </div>
								<table class="table table-hover table-responsive">
									<thead>
										<tr>
											<th>Sl.No</th>
											<th>Ug name</th>
											<th>Username</th>
											<th>Role</th>
											<th>Sibaq Id</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sel_sql = "SELECT * FROM users WHERE role = 'ugnat'";
											$user_run = mysqli_query($connect, $sel_sql);
											$i =1;
											while($row = mysqli_fetch_assoc($user_run)){
											
												
												echo '<tr><td>'.$i.'</td>
														<td>'.ucwords($row['ug_name']).'</td>
														<td>'.$row['username'].'</td>
														<td>'.$row['role'].'</td>
														<td>'.$row['sibaq_id'].'</td>
														<td><a class="btn btn-danger btn-sm" href="usersMgmt.php?del_id='.$row['user_id'].'"><i class="fa fa-trash"></i></a></td>
														
												</tr>';
											$i++;
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<script src="../../js/jquery-3.3.1.js"></script>
	  	<script src="../../js/popper.min.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="../js/jquery.tablesorter.min.js"></script>
		
<!--	old browser support	-->
		<script src="../js/Blob.js"></script>
		<script src="../js/xlsx.core.min.js"></script>
		<script src="../js/export.js"></script>
		
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../js/regDash.js"></script>
	</body>
</html>