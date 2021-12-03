<?php
session_start();
if (isset($_POST["login"])){
    // user accessed this page through the login form
    require_once 'db.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];

        // check that all necessary fields are filled in
        if (empty($email) || empty($password)){
            // empty fields => redirect back to signup (js is validating anyway so shouldn't happen)
            $_SESSION['login_message'] = "Empty field(s)";
            header("location: ../login.php");
            exit();
        }

        // validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['login_message'] = "Invalid email";
            header("location: ../login.php");
            exit();
        }

        // ensure that email exists
        try{
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->execute([ 'email' => $email ]);
        } catch(PDOException $e) {
            $_SESSION['login_message'] = "Server error";
            header("location: ../login.php");
            exit();
        }
        
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$res){
            // close statement
            $stmt->closeCursor();
            $_SESSION['login_message'] = "Invalid email or password";
            header("location: ../login.php");
            exit();
        }

        // close statement
        $stmt->closeCursor();

        //check that the password is correct
        if(!password_verify($password, $res["pword"])){
            $_SESSION['login_message'] = "Invalid email or password";
            header("location: ../login.php");
            exit();
        } else {
            //login successful
            $_SESSION['user'] = $res["uid"];
            $_SESSION['login_message'] = "";
            header("location: /");
            exit();
        }
    } else {
        //Invalid method
        header("location: ../login.php");
        exit();
    }
} else {
    // invalid access of this file, redirect to signin page
    header("location: ../login.php");
    exit();
}
