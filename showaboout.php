<?php require_once('Include/Sessions.php'); ?>
<?php require_once('Include/functions.php') ?>
<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	<script src="jquery-3.2.1.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Assets/style.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="blog">
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-header">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="Blog.php" class="navbar-brand">
					JOY CHEGE
				</a>
			</div>
			<div class="collapse navbar-collapse" id="nav-header">
				<ul class="nav navbar-nav">
					<li class><a href="Blog.php" >HOME</a></li>

					<li class="active"><a href="showabout.php">ABOUT ME</a></li>
					<li class><a href="Contact.php">CONTACTS</a></li>
				</ul>
				<form action="Blog.php" method="GET" class="navbar-form navbar-right">
					<div class="input-group">
						<input type="text" name="search" class="form-control" placeholder="Search post">
						<span class="input-group-btn">
							<button class="btn btn-default"><span class="glyphicon glyphicon-search"></button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</nav> <!--END OF NAVBAR  -->
	<div class="container">
		<div class="blog-title">
			<div class="row">
				<div class="col-md-8 ">
					<h1 class="text-warning">JOY'S DELECTABLE SERVINGS! </h1>
					<p class="lead">My Honeyed Table</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<?php
					$page = 1;
					$query = "";
					if ( isset($_GET['search'])) {
						if ( empty($_GET['search'])) {
							Redirect_To('blog.php');
						}else {
							$search = $_GET['search'];
							$query = "SELECT * FROM cms_post WHERE post_date_time LIKE '%$search%' OR title LIKE '%$search%' OR category LIKE '$search%' ";
						}
					}else if ( isset($_GET['category'])) {
						$query = "SELECT * FROM cms_post WHERE category = '$_GET[category]'";
					}else if ( isset($_GET['page'])){
						$page = $_GET['page'];
						$showPost = ($page * 5) - 5;
						if ($page <= 0) {
							$showPost = 0;
						}
						$query = "SELECT * FROM aboutme ORDER BY publish_date_time DESC LIMIT $showPost,5	";

					}else{

						$query = "SELECT * FROM aboutme ORDER BY publish_date_time DESC LIMIT 0,5	";						
					}

					$exec = Query($query) or die(mysqli_error($con));
					if( $exec ) {
						if (mysqli_num_rows($exec) > 0) {
							while ( $post = mysqli_fetch_assoc($exec) ) {
								$pg_id = $post['pg_id'];
								$post_date = $post['publish_date_time'];
								$blogger_name = $post['my_name'];
								$career = $post['carrer'];
								$post_image = $post['image'];
								$post_content = substr($post['post'], 0,150) . '...'; 
							?>
							<div class="post">
								<div class="post-title"><h1><?php echo htmlentities($blogger_name); ?></h1></div>
								<div class="thumbnail">
									<img class="img-responsive img-rounded" src="Upload/Image/<?php echo $post_image; ?>">
								</div>
								<div class="post-info">
									<p class="lead">
									Last Updated: <?php echo htmlentities($post_date); ?> | Qualification: <?php echo htmlentities($career);?>
									</p>
								</div>
								<div class="post-content">
								<p class="lead"><?php echo htmlentities($post_content); ?></p>
								</div>
								<p>
									<a href="showabout.php?id=<?php echo $pg_id;?>">
										<button class="btn btn-info btn-lg" id="read_more_btn">Read More</button>
									</a>
									<div class="clearfix"></div>
								</p>
							</div>
							<?php
							}

						}else {
							echo "<span class='lead'>No result<span>";
						}
					}else {

					}

				?>
				
				
			</div><!--END OF COL-MD-8  -->
			<div class="col-md-3 col-md-offset-1 post-side-menu">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">About Me</h2>
					</div>
					<div class="panel-body">
						<nav>
							<ul class="nav-left-list">
						<?php 
							$sql = "SELECT * FROM aboutme ORDER BY publish_date_time ";
							$exec = Query($query) or die(mysqli_error($con));
					if( $exec ) {
						if (mysqli_num_rows($exec) > 0) {
							while ( $post = mysqli_fetch_assoc($exec) ) {
								$pg_id = $post['pg_id'];
								$post_date = $post['publish_date_time'];
								$blogger_name = $post['my_name'];
								$career = $post['carrer'];
								$post_image = $post['image'];
								$post_content = substr($post['post'], 0,150) . '...'; 
							?>
							<div class="post">
								<div class="post-title"><h1><?php echo htmlentities($blogger_name); ?></h1></div>
								<div class="thumbnail">
									<img class="img-responsive img-rounded" src="Upload/Image/<?php echo $post_image; ?>">
								</div>
								<div class="post-info">
									<p class="lead">
									Last Updated: <?php echo htmlentities($post_date); ?> | Qualification: <?php echo htmlentities($career);?>
									</p>
								</div>
								<div class="post-content">
								<p class="lead"><?php echo htmlentities($post_content); ?></p>
								</div>
								<p>
									<a href="showabout.php?id=<?php echo $pg_id;?>">
										<button class="btn btn-info btn-lg" id="read_more_btn">Read More</button>
									</a>
									<div class="clearfix"></div>
								</p>
							</div>
							<?php
							}

						}else {
							echo "<span class='lead'>No result<span>";
						}
					}else {

					}

				?>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">Recent Post</h2>
					</div>
					<div class="panel-body">
						<?php
							$sql = "SELECT * FROM cms_post ORDER BY post_date_time LIMIT 5";
							$exec = Query($sql);
							while ($recentPost = mysqli_fetch_assoc($exec)) {
								$postID = $recentPost['post_id'];
								?>
								<nav>
									<ul class="nav-left-list">
										<li class="nav-left"><a href="Post.php?id=<?php echo $postID; ?>"><?php echo $recentPost['title'] ?></a></li>
									</ul>
								</nav>
								<?php
							}
						?>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">Categories</h2>
					</div>
					<div class="panel-body">
						<nav>
							<ul class="nav-left-list">
						<?php 
							$sql = "SELECT cat_name FROM cms_category ";
							$exec = Query($sql);
							if (mysqli_num_rows($exec) > 0) {
								while ($category = mysqli_fetch_assoc($exec)) {
									?>
									<li class='nav-left'><a href="Blog.php?category=<?php echo $category['cat_name'] ?>"><?php echo $category['cat_name'] ?></a></li>
									<?php
								}
							}	
						?>
							
								
							</ul>
						</nav>
					</div>
				</div>

			</div> <!--END OF COL-MD-4  -->
		</div> <!--END OF ROW  -->
	</div>
</div>
<div class="row navbar-inverse" id="blog-footer">
	<div class="footer-wrapper">
		<p>All Rights Reserved 2018 | Designed By :  Binary Solutions</p>
	</div>
</div>
</body>
</html>
