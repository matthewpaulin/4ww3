<?php
session_start();
if (isset($_POST["register"])){
    // user accessed this page through the registration form
    require_once 'db.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fname = $_POST['first-name'];
        $lname = $_POST['last-name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        $bday = $_POST['birthdate'];
        $gender = $_POST['gender'];

        // check that all necessary fields are filled in
        if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($confirm_password)){
            // empty fields => redirect back to signup (js is validating anyway so shouldn't happen)
            $_SESSION['register_message'] = "Empty field(s)";
            header("location: ../register.php");
            exit();
        }

        // check for valid names
        if (!preg_match("/^[a-zA-Z]*$/", $fname)){
            $_SESSION['register_message'] = "Invalid first name";
            header("location: ../register.php");
            exit();
        }
        if (!preg_match("/^[a-zA-Z]*$/", $lname)){
            $_SESSION['register_message'] = "Invalid last name";
            header("location: ../register.php");
            exit();
        }

        // validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['register_message'] = "Invalid email";
            header("location: ../register.php");
            exit();
        }

        // validate password
        if ($password !== $confirm_password){
            $_SESSION['register_message'] = "Passwords do not match";
            header("location: ../register.php");
            exit();
        }

        // ensure that email doesn't already exist
        try{
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->execute([ 'email' => $email ]);
        } catch(PDOException $e) {
            $_SESSION['register_message'] = "Server error";
            header("location: ../register.php");
            exit();
        }
        
        $res= $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res){
            // close statement
            $stmt->closeCursor();
            $_SESSION['register_message'] = "User with this email already exists";
            header("location: ../register.php");
            exit();
        }
        // close statement
        $stmt->closeCursor();

        // insert new user
        try{
            $query = "INSERT INTO users (fname, lname, email, pword, bday, gender) VALUES (:fname, :lname, :email, :pword, :bday, :gender)";
            $stmt = $conn->prepare($query);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute(array( 
                'fname' => $fname, 
                'lname' => $lname, 
                'email' => $email, 
                'pword' => $hashed_password, 
                'bday' => !empty($bday) ? $bday : null,
                'gender' => !empty($gender) ? $gender : null, 
            ));
        } catch(PDOException $e) {
            $_SESSION['register_message'] = "Server error";
            header("location: ../register.php");
            exit();
        }

        $id = $conn->lastInsertId();
        $stmt->closeCursor();
        $_SESSION['user'] = $id;
        $_SESSION['register_message'] = "";
        header("location: /");
        exit();
    } else {
        //Invalid method
        header("location: ../register.php");
        exit();
    }
} else {
    // invalid access of this file, redirect to signup page
    header("location: ../register.php");
    exit();
}
