<?php $title = 'Rock Review | Add Gym'; ?>
<?php $currentPage = 'Add Gym'; ?>
<?php include('header.php'); ?>
<body>
<?php include('navbar.php'); ?>
<?php
    // redirect if user not loggged in
	if(!isset($_SESSION['user'])){
    	header("location: ../login.php");
	}
?>

	<main class="mountain-bg">
		<h1 class="page-title primary-transparent-bg container">Add New Gym</h1>
		<!-- Form which will send a POST request to add a location -->
		<form class="submission-form" action="/includes/upload.php" method="post" enctype="multipart/form-data">
			<?php
				if(isset($_SESSION['upload_message']) && !empty($_SESSION['upload_message'])){
					if($_SESSION['upload_message']!=="success"){
						?>
						<div id="errors">
							<?php
								echo $_SESSION['upload_message']. "</div>";
								$_SESSION['upload_message'] = '';
					} else {
						?>
						<div id="success">
							<?php
								echo "Gym added successfully". "</div>";
								$_SESSION['upload_message'] = '';
					}
				}
            ?>
			<div class="form-input">
				<label>Name of Gym</label>
				<input class="block-input" type="text" name="gym-name" maxlength=256 aria-required="true"/>
			</div>

			<div class="form-input">
				<label>Website (optional)</label>
				<input class="block-input" type="text" name="website" maxlength=2048/>
			</div>

			<div class="form-input gym-description">
				<label>Description of Gym</label>
				<textarea name="gym-description" aria-required="true" maxlength=2048></textarea>
			</div>

			<div class="form-input">
				<label>Latitude</label>
				<input id="latitude" class="block-input" type="number" name="latitude" value="" step=".00000001" aria-required="true"/>
			</div>

			<div class="form-input">
				<label>Longitude</label>
				<input id="longitude" class="block-input" type="number" name="longitude" value="" step=".00000001" aria-required="true"/>
				<label id="current-location" onclick="useMyLocation()">Use my current location</label>
			</div>
			<h2>Upload Image</h2>
			<p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</p>
			<div class="file-uploads">
				<label for="image-upload" class="content-upload-label">
					<i class="fas fa-file-image fa-4x"></i>
				</label>
				<input id="image-upload" type="file" name="image" onchange="setFileName()" aria-required="true"/>
			</div>
			<input type="submit" name="add_gym" value="Add Gym" />
		</form>
	</main>

<script src="index.js"></script>
<?php include('footer.php'); ?>
</body>
</html>

