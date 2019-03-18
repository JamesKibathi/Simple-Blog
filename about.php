	<?php require_once('Include/Sessions.php'); ?>
<?php require_once('Include/functions.php') ?>
<?php ConfirmLogin(); ?>
<?php

date_default_timezone_set('Asia/Manila');
$time = time();
if ( isset( $_POST['page_submit'])) {
	$myname = mysqli_real_escape_string($con, $_POST['my_name']);
	$career = mysqli_real_escape_string($con, $_POST['carrer']);
	$content = mysqli_real_escape_string($con, $_POST['my_content']);
	$image = $_FILES['my_image']['name'];
	$dateTime = strftime('%Y-%m-%d',$time);
	$name_length = strlen($myname);
	$content_lenght = strlen($content);
	$imageDirectory = "Upload/Image/" . basename($_FILES['my_image']['name']);
	if ( empty($myname)) {
		$_SESSION['errorMessage'] = "Name Is Emtpy";
		Redirect_To('about.php');
	}else if ( $myname_length > 50) {
		$_SESSION['errorMessage'] = "Name Is Too Long";
		Redirect_To('about.php');
	}else if ( empty($content)) {
		$_SESSION['errorMessage'] = "Content Is Empty";
		Redirect_To('about.php');
	}else if ( $content_lenght > 4000) {
		$_SESSION['errorMessage'] = "Content Is Too Long";
		Redirect_To('NewPost.php');
	}else {
		$query = "INSERT INTO aboutme (publish_date_time, my_name, carrer,image, post) 
		VALUES ('$dateTime', '$myname', '$career', '$image', '$content')";
		$exec = Query($query);
		if ($exec) {
			move_uploaded_file($_FILES['my_image']['tmp_name'], $imageDirectory);
			$_SESSION['successMessage'] = "Page Info Added Successfully";
		}else {
			$_SESSION['errorMessage'] = "Something Went Wrong Please Try Again";

		}

	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>New About Info</title>
	<script src="jquery-3.2.1.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Assets/style.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="heading">
	<a href="Blog.php"><p>Visit Blog</p></a>
</div>
<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-sm-2">
				<ul id="side-menu" class="nav nav-pills nav-stacked">
					<li class=""><a href="Dashboard.php">
					<span = class="glyphicon glyphicon-th"></span>
					 &nbsp;Dashboard</a></li>
					<li class="active"><a href="NewPost.php">
					<span = class="glyphicon glyphicon-list"></span>
					&nbsp;New Post</a></li>
					<li class=""><a href="Categories.php">
					<span = class="glyphicon glyphicon-tags"></span>
					&nbsp;Categories</a></li>
					<li><a href="Categories.php">
					<span = class="glyphicon glyphicon-user"></span>
					&nbsp;Manage Admin</a></li>
					<li><a href="Admin.php">
					<span = class="glyphicon glyphicon-comment"></span>
					&nbsp;Comments</a></li>
					<li><a href="Blog.php">
					<span = class="glyphicon glyphicon-equalizer"></span>
					&nbsp;Live Blog</a></li>
					<li><a href="Lagout.php">
					<span = class="glyphicon glyphicon-log-out"></span>
					&nbsp;Lagout</a></li>
				</ul>
			</div>
			<div class="col-xs-10">
				<div class="page-title"><h1>Add Your New Info</h1></div>
					<?php echo Message(); ?>
					<?php echo SuccessMessage(); ?>
					<form action="about.php" method="POST" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<labal for="post-title">Your Name</labal>
								<input type="text" name="my_name" class="form-control" id="my_name">
							</div>
							<div class="form-group">
								<labal for="post-category">Profession/Specialty</labal>
								<input type="text" name="carrer" class="form-control" id="carrer">
							</div>
							<div class="form-group">
								<labal for="my_image">Upload Photo</labal>
								<input type="File" name="my_image" class="form-control">
							</div>
							<div class="form-group">
								<labal for="my_content">Content</labal>
								<textarea rows="10" class="form-control" name="my_content" id="my_content">
									
								</textarea>
							</div>
							<div class="form-group">
								<button name="page_submit" class="btn btn-primary form-control">Update</button>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="footer">
		<div class="col-sm-12">
		<hr>
			<p>All Rights Reserved 2018 | Designed By : Binary Solutions</p>
		<hr>
		</div>
	</div>
</div>
<script type="text/javascript" src="jquery.js"></script>
</body>
</html>
