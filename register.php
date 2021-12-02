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

        <?php
            if(isset($_SESSION['register_message'])){
                if(!empty($_SESSION['register_message'])){
                    ?>
                    <div class="centerme">
                    <div class="notification is-danger">
                        <?php
                            echo $_SESSION['register_message']. "</div></div>";
                            $_SESSION['register_message'] = '';
                }
            }
        ?>
        <form class="centerme" method="post" action="register_verify.php">
            <br />
            <div class="field">
                <label for="email">Email</label>
                <p class="control">
                    <input class="input" type="email" placeholder="Email" name="email"/>
                </p>
            </div>
            <label for="password">Password</label>
            <div class="field">
                <p class="control">
                    <input class="input" type="password" name="password" placeholder="Password"/>
                </p>
            </div>
            <label for="password">Confirm password</label>
            <div class="field">
                <p class="control">
                    <input class="input" type="password" name="confirm_password" placeholder="Password"/>
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <button class="button is-success" type="submit">Register</button>
                </p>
            </div>
        </form>
    </body>
</html>
