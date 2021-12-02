<?php
    session_start();

    unset($_SESSION['status_message']);
    unset($_SESSION['active']);

    session_destroy();

    $url = "http://localhost:8080/html/DatabasePractice/";
    header('Location: '. $url);
?>