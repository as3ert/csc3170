<!DOCTYPE html>
<html>
	<head>
		<title>Home Page</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			html, body, h1, h2, h3, h4, h5, h6 {font-family: "Open Sans", sans-serif}
		</style>
	</head>

	<?php 
		require './config.php';
		$id = $_COOKIE['id'];
		if (empty($id)) {
			// If the cookie is empty, redirect to the login page
			echo "<script>location.href='login.php';</script>";
			exit;
		}
		$sql = "SELECT * FROM employees where EMPLOYEE_ID = {$id}";
		$result = $mysqli->query($sql);
		$adminInfo = $result->fetch_assoc();

		// Get the project list
		$sql =  "SELECT * FROM jobs LEFT JOIN projects on jobs.PROJECT_ID = projects.PROJECT_ID LEFT JOIN managers on projects.PROJECT_ID = managers.PROJECT_ID WHERE EMPLOYEE_ID = {$id}";
		$rs= $mysqli->query($sql);
		$projectList = [];
		foreach ($rs as $k => $item) {
			array_push($projectList,$item);
		}
	?>

	<body class="w3-theme-l5">
		<!-- Navbar -->
		<div class="w3-top">
			<div class="w3-bar w3-theme-d2 w3-left-align w3-large">
				<a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
				<a href="worker.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Home</a>
				<a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
				<img src="https://www.w3schools.com/w3images/avatar2.png" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
				</a>
			</div>
		</div>

		<!-- Page Container -->
		<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
			<!-- The Grid -->
			<div class="w3-row">
				<!-- Left Column -->
				<div class="w3-col m2">
					<div class="w3-card w3-round w3-white">
						<div class="w3-container">
							<h4 class="w3-center">My Profile</h4>
							<p class="w3-center"><img src="https://www.w3schools.com/w3images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
							<hr>
							<div style="display: none"><script>  GetArgsFromHref('http://127.0.0.1:5500/login.html', sArgName)</script></div>
							<p><i class="fa fa-book fa-fw w3-margin-right w3-large w3-text-theme"></i><?php echo $adminInfo['EMPLOYEE_NAME']; ?></p>
							<p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-theme"></i><?php echo $adminInfo['POSITION']; ?></p>
							<p><i class="fa fa-calendar fa-fw w3-margin-right w3-large w3-text-theme"></i><?php echo $adminInfo['ENTRY_DATE']; ?></p>
							<hr>
							<p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-theme"></i>Location</b></p>
							<p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-theme"></i><?php echo $adminInfo['LOCATION']; ?></p>
							<div class="w3-light-grey w3-round-xlarge"></div>
						</div>
					</div><br><br><br><br>
				<!-- End Left Column -->
				</div>
				<!-- Right Column -->
				<div class=" main w3-col m10">

					<!-- Padding -->
					<div class="w3-row-padding">
						<div class="w3-col m12">
							<div class="w3-container w3-padding w3-card w3-round w3-theme-d4"></div>
						</div>
					</div>

					<?php
						foreach ($projectList as $k => $project) {
							echo "<div class='w3-container w3-card w3-white w3-round w3-margin' id='prj1'><br>";
							echo "<h2 class='w3-text-grey w3-padding-10'><i class='fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-theme'></i>{$project['PROJECT_NAME']}</h2>";
							echo "<div class='w3-container'>";
							echo "<h5 class='w3-opacity'><b></b></h5>";
							echo "<h6 class='w3-text-theme'><i class='fa fa-align-right fa-fw w3-margin-right'></i><span class='w3-tag w3-theme w3-round'>{$project['PROJECT_ID']}</span></h6>";
							echo "<hr>";
							echo "</div>";
							echo "<div class='w3-container'>";
							echo "<h5 class='w3-opacity'><b>Manager ID</b></h5>";
							echo "<h6 class='w3-text-theme'><i class='fa fa-star fa-fw w3-margin-right'></i>{$project['MANAGER_ID']}</h6>";
							echo "<hr>";
							echo "</div>";
							echo "<div class='w3-container'>";
							echo "<h5 class='w3-opacity'><b>Project duration</b></h5>";
							echo "<h6 class='w3-text-theme'><i class='fa fa-calendar w3-margin-right'></i>{$project['START_DATE']}---{$project['END_DATE']}</h6><br>";
							echo "</div>";
							echo "</div>";
						}
					?>
				<!-- End Right Column -->
				</div>
			<!-- End Grid -->
			</div>
		<!-- End Page Container -->
		</div>

		<footer class="w3-container w3-theme-d5">
			<p>Powered by <a href="https://github.com/as3ert/csc3170" target="_blank">Group 8</a></p>
		</footer>

	</body>
</html>