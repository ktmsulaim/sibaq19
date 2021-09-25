<header class="navbar navbar-dark" id="main-header">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php">Dashboard</a>
				<ul class="nav nav-inline" id="navbar">
					
					<li class="nav-link" style="color:#fff;">Hi, <?php echo $_SESSION['user']; ?></li>
					<li class="nav-link"><a href="logout.php">Log out</a></li>
				</ul>
			</div>
		</header>