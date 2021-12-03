<?php $title = 'Rock Review | Sign In'; ?>
<?php $currentPage = 'Sign In'; ?>
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
        <h1 class="page-title primary-transparent-bg container">Login</h1>
        <!-- Form which will send a POST request to login -->
        <form class="submission-form" action="/includes/login_verify.php" method="post">
            <?php
                if(isset($_SESSION['login_message'])){
                    if(!empty($_SESSION['login_message'])){
                        ?>
                        <div id="errors">
                            <?php
                                echo $_SESSION['login_message']. "</div>";
                                $_SESSION['login_message'] = '';
                    }
                }
            ?>
            <div class="form-input">
                <label>Email</label>
                <input class="block-input" type="email" name="email" autocomplete="email">
            </div>
            <div class="form-input">
                <label>Password</label>
                <input class="block-input" type="password" name="password" autocomplete="new-password">
            </div>
            <input type="submit" name="login" value="Login">
        </form>
    </main>

<?php include('footer.php'); ?>
</body>
</html>
