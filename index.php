<?php
    session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Database practice</title>

		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.0/css/bulma.min.css"
		/>
		<link rel="stylesheet" href="assets/css/styles.css" />
		<script
			defer
			src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"
		></script>
		<!-- <link rel="stylesheet" href="styles/debug.css"> -->
	</head>
	<body>
		<div>
			<?php
				$logged_in = 0;

				// echo "<pre>";
				// print_r($_SESSION);
				//exit();
				if(isset($_SESSION['active'])){
					if(!empty($_SESSION['active'])){
						if($_SESSION['active'] == '1'){
							$logged_in = 1;
						}
					}
				}

				//if the user is not logged in
				if($logged_in == 0){
					?>
					<!-- //print error message if already logged in -->
					<?php
						if(isset($_SESSION['status_message'])){
							if(!empty($_SESSION['status_message'])){
								?>
								<div class="centerme">
								<div class="notification is-danger">
  									<?php
									  echo $_SESSION['status_message']. "</div></div>";
									  $_SESSION['status_message'] = '';
							}
						}
					?>
					<form class="centerme" method="post" action="login_verify.php">
						<br />
						<div class="field">
							<p class="control has-icons-left has-icons-right">
								<input class="input" type="email" placeholder="Email" name="email"/>
								<span class="icon is-small is-left">
									<i class="fas fa-envelope"></i>
								</span>
								<span class="icon is-small is-right">
									<i class="fas fa-check"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<p class="control has-icons-left">
								<input
									class="input"
									type="password"
									name="password"
									placeholder="Password"
								/>
								<span class="icon is-small is-left">
									<i class="fas fa-lock"></i>
								</span>
							</p>
						</div>
						<div class="register_btn">
							<a href="register.php">Register</a>
						</div>
						<div class="field">
							<p class="control">
								<button class="button is-success" type="submit">Login</button>
							</p>
						</div>
					</form>
				<?php }else { ?>
					<h5>You are already logged in <?php echo $_SESSION['userfullname']; ?></h5>
					<a href="logout.php">Logout</a>
				<?php } ?>
			</div>
	</body>
</html>
