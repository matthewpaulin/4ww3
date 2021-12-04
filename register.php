<?php $title = 'Rock Review | Sign Up'; ?>
<?php $currentPage = 'Sign Up'; ?>
<?php include('header.php'); ?>
<?php
    // redirect if user already loggged in
    if(isset($_SESSION['user'])){
        header("location: /");
    }
?>
<body>
<?php include('navbar.php'); ?>
    <main class="mountain-bg">
        <h1 class="page-title primary-transparent-bg container">Register for an Account</h1>

        <!-- required svg (referenced by required form fields) -->
        <svg id="required-definition" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <symbol id="required" viewbox="0 0 128 128">
                    <g>
                        <path
                            d="M110.1,16.4L75.8,56.8l0.3,1l50.6-10.2v32.2l-50.9-8.9l-0.3,1l34.7,39.1l-28.3,16.5L63.7,78.2L63,78.5   l-18.5,49L17.2,111l34.1-39.8v-0.6l-50,9.2V47.6l49.3,9.9l0.3-0.6L17.2,16.7L45.5,0.5l17.8,48.7H64L82.1,0.5L110.1,16.4z">
                        </path>
                    </g>
                </symbol>
            </defs>
        </svg>

        <!-- Form which will send a POST request to sign up -->
        <form name="registration" class="submission-form" onsubmit="return validateRegistration()" action="/includes/register_verify.php" method="post">
            <?php
                if(isset($_SESSION['register_message'])){
                    if(!empty($_SESSION['register_message'])){
                        ?>
                        <div id="errors">
                            <?php
                                echo $_SESSION['register_message']. "</div>";
                                $_SESSION['register_message'] = '';
                    }
                }
            ?>
            <div class="form-input">
                <label>First Name <svg class="required-icon" focusable="false">
                        <use xlink:href="#required"></use>
                    </svg></label>
                <input class="block-input" type="text" name="first-name" autocomplete="given-name"
                    oninput="removeErrorState(this)" aria-required="true">
            </div>

            <div class="form-input">
                <label>Last Name <svg class="required-icon" focusable="false">
                        <use xlink:href="#required"></use>
                    </svg></label>
                <input class="block-input" type="text" name="last-name" autocomplete="family-name"
                    oninput="removeErrorState(this)" aria-required="true">
            </div>

            <div class="form-input">
                <label>Email <svg class="required-icon" focusable="false">
                        <use xlink:href="#required"></use>
                    </svg></label>
                <input class="block-input" type="email" name="email" autocomplete="email"
                    oninput="removeErrorState(this)" aria-required="true">
            </div>

            <div class="form-input">
                <label>Password <svg class="required-icon" focusable="false">
                        <use xlink:href="#required"></use>
                    </svg></label>
                <input class="block-input" type="password" name="password" autocomplete="new-password"
                    oninput="removeErrorState(this)" aria-required="true">
            </div>

            <div class="form-input">
                <label>Confirm Password <svg class="required-icon" focusable="false">
                        <use xlink:href="#required"></use>
                    </svg></label>
                <input class="block-input" type="password" name="confirm-password" autocomplete="new-password"
                    oninput="removeErrorState(this)" aria-required="true">
            </div>

            <div>
                <label class="block-label mb-05">Birthdate</label>
                <input class="date-input" type="date" name="birthdate" autocomplete="bday">
            </div>

            <div>
                <label class="block-label mb-05">Gender</label>

                <input type="radio" name="gender" value="Male" id="male">
                <label class="radio-label" for="male">Male</label>

                <input type="radio" name="gender" value="Female" id="female">
                <label class="radio-label" for="female">Female</label>

                <input type="radio" name="gender" value="Other" id="other">
                <label class="radio-label" for="other">Other</label>
            </div>

            <div class="form-checkbox">
                <input type="checkbox" name="consent" aria-required="true" oninput="removeErrorState(this)">
                I agree to the <a class="form-link" href="/terms.php">terms and conditions</a> <svg
                    class="required-icon" focusable="false">
                    <use xlink:href="#required"></use>
                </svg>
            </div>
            <input type="submit" name="register" value="Register">
        </form>
    </main>

<?php include('footer.php'); ?>
<script src="index.js"></script>
</body>
</html>
		
