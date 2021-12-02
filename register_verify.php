<?php
    echo "<pre>";
    print_r($_POST);

    session_start();
    $login = "http://localhost:8080/html/DatabasePractice/";
    $register = "http://localhost:8080/html/DatabasePractice/register.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])){
                    if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
                        
                        //connect to database
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "users";
            
                        //Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname); 
                        //Check connection
                        if($conn->connect_error){
                            die("Connection failed while accessing data: " . $conn->connect_error);
                        }
                        //Check if email is in database
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $sql = "SELECT * FROM `login` WHERE email LIKE '$email'"; //
                        if($result = $conn->query($sql)){
                            if($result->num_rows == 0){
                                //register
                                $cols = 'email, password';
                                $sql = "INSERT INTO login ($cols) 
                                        VALUES ('$email', '$password')";

                                    if($conn->query($sql)){//executing and verifying query
                                        $_SESSION['status_message'] = "Account Created";
                                        header('Location: '. $login);
                                    }else{
                                        echo "<br><br>Error: " . $sql . "<br>" . $conne->error;
                                    }
                            }else{
                                //email already exists
                                $_SESSION['status_message'] = $email . " already has an account";
                                header('Location: '. $login);
                            }
                        }else {
                            echo "".$conn->error;
                        }
                        $conn->close();
                    }else {
                        $_SESSION['register_message'] = 'Must provide username and password';
                        header('Location: '. $register);
                    }
                }else {
                    $_SESSION['register_message'] = 'Must provide username and password';
                    header('Location: '. $register);
                }
    }else {
        echo 'invalid_method';
    }
?>