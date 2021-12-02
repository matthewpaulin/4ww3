<?php
    echo "<pre>";
    print_r($_POST);

    session_start();
    $url = "http://localhost:8080/html/DatabasePractice/";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_POST['email']) && isset($_POST['password'])){
                    if(!empty($_POST['email']) && !empty($_POST['password'])){
                        
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
                                $_SESSION['status_message'] = 'No account accociated to that email';
                                header('Location: '. $url);
                            }else{
                                if($result->fetch_assoc()['password'] === $password){
                                    $_SESSION['active'] = true;
                                    header('Location: '. $url);
                                }else {
                                    $_SESSION['status_message'] = 'Incorrect Password';
                                    header('Location: '. $url);
                                }
                            }
                        }else {
                            echo "".$conn->error;
                        }
                        $conn->close();
                    }else {
                        $_SESSION['status_message'] = 'Must provide username and password';
                        header('Location: '. $url);
                    }
                }else {
                    $_SESSION['status_message'] = 'Must provide username and password';
                    header('Location: '. $url);
                }
    }else {
        echo 'invalid_method';
    }
?>