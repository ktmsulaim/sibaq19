<header id="header">
			<nav id="nav">
				<div class="container-fluid">
				<div class="row pt-3 pb-3" id="navWrapper">
					<div class="col-lg-6 col-md-6" id="logo">
						<a href="index.php"><img src="img/logo_low.png" width="250" /></a>
					</div>
					<div class="col-lg-6 col-md-6" id="navigation">
						<?php
							if($_SERVER['PHP_SELF'] == '/index.php'){
								$link = '#prelogin';
							}else{
								$link = 'registration/index.php';
							}
						?>
						<span id="login"><a href="<?php echo $link; ?>"><i class="fa fa-user fa-1x"></i> Login</a></span>
						<span id="navicon"><i class="fas fa-bars fa-2x"></i></span>
					</div>
						<div id="navItems">
							<div class="row">
								<div class="col-md-12">
									<span id="button_close">
										<i class="fas fa-arrow-right"></i>
									</span>
								</div>
							</div>
							<div class="row pt-3 pb-3">
								<div class="col-md-12">
									<section class="search">
										<form action="candidates.php">
											<input type="search" name="chest" id="search" class="input1" placeholder="Find candidate">
											<button class="button1"><i class="fas fa-search"></i></button>
										</form>
									</section>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<ul class="navbar-nav" id="navlist">
										<li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
										<li><a href="programmes.php"><i class="fas fa-tasks"></i> Programmes</a></li>
										<li><a href="results.php"><i class="fas fa-bullhorn"></i> Results</a></li>
										<li><a href="live.php"><i class="fas fa-video"></i> Live</a></li>
										<li><a href="schedule.php"><i class="fas fa-calendar"></i> Schedule</a></li>
										<li><a href="news.php"><i class="fas fa-newspaper"></i> News</a></li>
										<li><a href="contact.php"><i class="fas fa-phone"></i> Contact</a></li>
										<li><a href="aboutus.php"><i class="fas fa-info-circle"></i> About Us</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</nav>
		</header>