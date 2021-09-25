<?php
	include 'db.php';
// retrieve news
		$news_title = '';
		$news_image = '';
		$news_desc = '';
		$news_date = '';
		$news_author = '';
if(isset($_GET['news_id'])){
	$sql_getnews = "SELECT * FROM news WHERE news_id = '$_GET[news_id]' AND news_status = 'publish'";
	$run_getnews = mysqli_query($connect, $sql_getnews);
	while($row = mysqli_fetch_assoc($run_getnews)){
		$news_title = $row['news_title'];
		$news_image = $row['news_image'];
		$news_desc = $row['news_desc'];
		$news_date = $row['news_date'];
		$news_author = $row['news_author'];
	}
}elseif(isset($_GET['search'])){
	
}else{
	header('Location: index.php#news');
}
// count of searched news
$number = 5;

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 - Intercollegiate fest | News</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1.0, user-scalabe=no">
		<meta charset="utf-8">
		<meta name="author" content="Darul Huda Islamic University">
		<meta name="keywords" content="sibaq, sibaq'19, darul huda, dsu, arts fest, intercollegiate, dhiu, sbq, sibaq.in">
		<meta name="description" content="In Sibaq'19, more than 3000 candidates are expected to showcase their talents in a number of artistic, literary, cultural, sportive items.">
		
		<!--	og:tags	-->
		<meta property="og:title" content="<?php echo $news_title; ?>"/>
		<meta property="og:image" itemprop="image" content="<?php echo $news_image; ?>"/>
		<meta property="og:url" content="<?php echo $_SERVER['PHP_SELF']; ?>"/>
		<meta property="og:type" content="website"/>
		<meta property="og:site_name" content="Sibaq 2019 Arts festival"/>
		<meta property="og:description" content="<?php echo $news_desc; ?>"/>
		<meta name="twitter:title" content="<?php echo $news_title; ?>" />
		<meta name="twitter:image" itemprop="image" content="<?php echo $news_image; ?>" />
		<meta name="twitter:url" content="<?php echo $_SERVER['PHP_SELF']; ?>" />
		<meta name="twitter:card" content="" />
		<link rel="stylesheet" media="all" href="style.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/secondary.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/fontawsome/fontawesome-all.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/fontawsome/css/fontawesome-all.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/aos.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/animate.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/owl.carousel.min.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/owl.theme.default.min.css" type="text/css">
		<link rel="stylesheet" media="screen and (max-width:568px)" href="css/media.css">
		<link type="text/css" rel="stylesheet" href="css/jssocials.css" />
		<link type="text/css" rel="stylesheet" href="css/jssocials-theme-flat.css" />
		<link rel="icon" href="img/logo.ico">
			<!--	external links go here	-->
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab|Oswald|Poppins|Roboto|Open+Sans|Raleway:700|Handlee" rel="stylesheet"> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" media="all">
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
		
		<?php include 'theme/header.php'; ?>
	
		<main>
			<!--	preloader	-->
	
			<div class="loaderWrapper">
				<div class="intro-banner-vdo-play-btn pinkBg">
						<i class="glyphicon glyphicon-play whiteText" aria-hidden="true"></i>
						<span class="ripple pinkBg"></span>
						<span class="ripple pinkBg"></span>
						<span class="ripple pinkBg"></span>
				</div>
			</div>
			<!--	scroll top	-->
			<div id="scrollTop"></div>
				<a href="#scrollTop"><span class="fa fa-arrow-up" id="scrollTopBtn"></span></a>
				
<!---------------------------------------- main content ---------------------------------------------------------->
			<div class="head-part wrapper1" id="News">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 text-center">
							<div class="head-main">
								<h1>News</h1>
							</div>
							<div class="breadcrumb-modern">
								<ul class="breadcrumb-modern-list">
									<li><a href="index.php">Home</a></li>
									<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">News</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="programme-part1" class="wrapper1">
				<div class="container">
					<div class="row">
						<div class="col-lg-8 col-md-8">
							<div class="boxInner">
									<div class="image">
										<img src="<?php echo $news_image; ?>" alt="" class="img-fluid">
									</div>
								<div class="newsContentBox">
									<div class="news-head text-center">
										<?php 
												echo '<h3>'.$news_title.'</h3>';
										?>
										<?php
											if(isset($_GET['search'])){
												$keyword = $_GET['searchbar'];
												echo '<h4>You have searched for "'.$keyword.'"</h4>';
											}
										?>
									</div>
									<?php
									if(isset($_GET['news_id'])){
										echo '<div class="authDate">
										<span class="float-left"><i class="fa fa-user"></i>'.ucfirst($news_author).'</span>
										<span class="float-right"><i class="fa fa-calendar"></i>'.$news_date.'</span>
										<div class="clearfix"></div>
									</div>';
									}else{}
									
									if(isset($_GET['search'])){
										
										echo '<ul class="searchResult">';
										$sql_search = "SELECT * FROM news WHERE news_status = 'publish' AND news_title LIKE '%$_GET[searchbar]%' OR news_desc LIKE '%$_GET[searchbar]%' LIMIT $number";
										$run_search = mysqli_query($connect, $sql_search);
										while($rows = mysqli_fetch_assoc($run_search)){
											echo '<a href="news.php?news_id='.$rows['news_id'].'&status='.$rows['news_status'].'"><li>
												<div class="img float-left w-25">
													<img class="img-fluid" src="'.$rows['news_image'].'">
												</div>
												<div class="news-cont float-left w-75">
													<div class="news-head text-left"><h6>'.$rows['news_title'].'</h6></div>
													<div class="authDate">
														<span class="float-left"><i class="fa fa-user"></i>'.ucfirst($rows['news_author']).'</span>
														<span class="float-right"><i class="fa fa-calendar"></i>'.$rows['news_date'].'</span>
														<div class="clearfix"></div>
													</div>
													<div class="desc">
														<p>'.substr($rows['news_desc'], 0, 170).'</p>
													</div>
												</div>
												<div class="clearfix"></div>
											</li></a>';
										}
										echo '</ul>';
									}
									?>
									
									<div class="desc">
										<p class="lead"><?php echo $news_desc; ?></p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="mt-3 p-3">
											<div id="share"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="sidebar">
								<div class="searchbar ptb-10">
									<form action="news.php" role="search" method="get" class="form-horizontal">
										<div class="input-group mb-3">
										  <input type="text" class="form-control" placeholder="Search" name="searchbar">
										  <div class="input-group-append">
											<button class="btn btn-secondary" type="submit" name="search"><i class="fa fa-search"></i></button>
										  </div>
										</div>
									</form>
								</div>
								<div class="head1">
									<h4>Recent news</h4>
								</div>
								<?php
									$sql_getrecent = "SELECT * FROM news WHERE news_status = 'publish' ORDER BY news_id DESC LIMIT 5";
									$run_getrecent = mysqli_query($connect, $sql_getrecent);
									while($rows = mysqli_fetch_assoc($run_getrecent)){
										echo '<a href="news.php?news_id='.$rows['news_id'].'"><div class="col news-tile">
												<div class="img-fluid">
													<img src="'.$rows['news_image'].'" alt="" class="img-fluid">
												</div>
												<div class="title">
													<b>'.$rows['news_title'].'</b>
												</div>
												<div class="date">
													<span>'.$rows['news_date'].'</span>
												</div>
											</div></a>';
									}
								mysqli_close($connect);
								?>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</main>
		
		<?php include 'theme/footer.php'; ?>
		
		<script src="js/jquery-3.3.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/owl.carousel.min.js" type="text/javascript"></script>
		<script src="js/aos.js" type="text/javascript"></script>
		<script src="js/jquery.cycleText.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/jssocials.min.js"></script>
		<script src="js/main.js" type="text/javascript"></script>
		<script>
			// social js icons
			$("#share").jsSocials({
				showLabel: false,
				showCount: false,
				shares: ["email", "twitter", "facebook", "googleplus", "whatsapp"]
			});
		</script>
		<script>
			$(function(){
				function showPage(){
					$('.loaderWrapper').fadeOut();
				}
				showPage();
			});
		</script>
	</body>
</html>