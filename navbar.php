<!-- Navbar -->
<nav aria-label="main navigation">
	<div class="nav-content">
		<img
			class="nav-logo"
			src="/assets/images/logo-light.png"
			alt="website logo"
		/>

		<!-- Hamburger icon -->
		<input type="checkbox" id="nav-check" />
		<div id="hamburger">
			<label for="nav-check">
				<span></span>
				<span></span>
				<span></span>
			</label>
		</div>

		<!-- navbar links -->
		<ul class="nav-links">
		<?php
			// Define each name associated with an URL
			$urls = array(
				'Home' => '/',
				'Sample Results' => '/results_sample.php',
				'Sample Gym' => '/individual_sample.php',
				'Add Gym' => '/submission.php',
			);

			foreach ($urls as $name => $url) {
				print '<li '.(($currentPage === $name) ? ' class="nav-link active" ': 'class="nav-link not-active"').
					'><a href="'.$url.'">'.$name.'</a></li>';
			}

			// show different buttons if user logged in
			if(isset($_SESSION['user'])){
				?>
					<li class="nav-buttons">
						<a class="nav-button" href="/includes/logout.php">Sign out</a>
					</li>	
				<?php
			} 
			else {
				?>
					<li class="nav-buttons">
						<a class="nav-button" href="/register.php">Sign up</a>
						<a class="nav-button" href="/login.php">Sign in</a>
					</li>
				<?php
			}
			?>
		</ul>
	</div>
</nav>