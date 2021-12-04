<?php
session_start();
require_once 'db.php';
if (isset($_SESSION["user"]) && isset($_POST["review"])) {
    // Check if the form was submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // grab form fields
        $review = $_POST['rating'];
        $details = $_POST['review-text'];
        
        // check that all necessary fields are filled in
        if (empty($review) || empty($details)){
            // empty fields => redirect back to review submission page
            if (isset($_SESSION["gym_title"]) && isset($_SESSION["gym_id"])){
                $_SESSION['review_message'] = "Empty field(s)";
                header("location: ../gym.php?id=".$_SESSION["gym_id"]."&name=".$_SESSION["gym_title"]);
                exit();
            } else {
                header("location: /");
                exit();
            }
        }
        // ensure that user isn't reviewing same gym more than once
         try{
            $query = "SELECT * FROM reviews WHERE uid = :uid AND gym_id = :gym_id";
            $stmt = $conn->prepare($query);
            $stmt->execute(array( 
                'gym_id' => $_SESSION['gym_id'],
                'uid' => $_SESSION['user'],
            ));
            $res= $stmt->fetch(PDO::FETCH_ASSOC);
            if ($res){
                // close statement
                $stmt->closeCursor();
                $_SESSION['review_message'] = "You have already reviewed this gym";
                header("location: ../gym.php?id=".$_SESSION["gym_id"]."&name=".$_SESSION["gym_title"]);
                exit();
            }
            $stmt->closeCursor();
        } catch(PDOException $e) {
            $_SESSION['review_message'] = "Server error";
            header("location: ../gym.php?id=".$_SESSION["gym_id"]."&name=".$_SESSION["gym_title"]);
            exit();
        }

        // insert new review
        try{
            $query = "INSERT INTO reviews (review, details, gym_id, uid) VALUES (:review, :details, :gym_id, :uid)";
            $stmt = $conn->prepare($query);
            $stmt->execute(array( 
                'review' => $review, 
                'details' => $details, 
                'gym_id' => $_SESSION['gym_id'],
                'uid' => $_SESSION['user'],
            ));
            $stmt->closeCursor();
        } catch(PDOException $e) {
            $_SESSION['review_message'] = "Server error";
            header("location: ../gym.php?id=".$_SESSION["gym_id"]."&name=".$_SESSION["gym_title"]);
            exit();
        }

        $_SESSION['review_message'] = "success";
        header("location: ../gym.php?id=".$_SESSION["gym_id"]."&name=".$_SESSION["gym_title"]);
        exit();
    }
        else {
        //Invalid method
        header("location: /");
        exit();
    }
}
else {
    // invalid access of this file, redirect to submission page
    header("location: /");
    exit();
}
?>

