<div class="bartop">
	<div class="barInner">
		<ul class="navbar-nav navbar-expand">
								   		<li class="nav-item">
								   		<section class="user">
								   			Hi, <?php $ug = $_SESSION['user']; echo strtoupper(preg_replace('/@.*/', '', $ug)); ?>
								   		</section>
								   			
								   		</li>
										<li class="nav-item dropdown">
										  <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="">
											<div class="userImage">
												<div class="img-round1">
													<?php 
													if($_SESSION['role'] == 'admin'){
														echo '<img src="../../img/user.png" alt="'.$_SESSION['user'].' "width="100%">';
													}else{
														echo '<span class="ugPicName1">'.ucfirst(substr($_SESSION['user'],0,1)).'</span>';}
													 ?>
													
												</div>
											</div>	
										  </a>
										  	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
												<a class="dropdown-item" href="../profile.php"><i class="fa fa-home"></i> Home</a>
												<a class="dropdown-item" href="../changePass.php"><i class="fa fa-lock"></i> Change password</a>
												<hr>
												<a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
											</div>
										</li>
								   </ul>
	</div>
</div>