<?php
// aws code from https://www.tutsmake.com/upload-file-to-aws-s3-bucket-in-php/
session_start();
require_once 'db.php';
require '../vendor/autoload.php';
use Aws\S3\S3Client;
if (isset($_POST["add_gym"])) {
    // Instantiate an Amazon S3 client.
    $s3Client = new S3Client([
        'version' => 'latest',
        'region'  => 'us-east-2',
        'credentials' => [
            'key'    => '',
            'secret' => ''
        ]
    ]);
    // Check if the form was submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // grab form fields
        $name = $_POST['gym-name'];
        $description = $_POST['gym-description'];
        $lat = $_POST['latitude'];
        $lng = $_POST['longitude'];
        $website = $_POST['website'];

        // check that all necessary fields are filled in
        if (empty($name) || empty($description) || empty($lat) || empty($lng)){
            // empty fields => redirect back to submission page
            $_SESSION['upload_message'] = "Empty field(s)";
            header("location: ../submission.php");
            exit();
        }

        // check for valid lat and lng https://stackoverflow.com/questions/7549669/php-validate-latitude-longitude-strings-in-decimal-format
        if (!preg_match("/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/", $lat) || !preg_match("/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/", $lng)){
            $_SESSION['upload_message'] = "Invalid latitude or longitude";
            header("location: ../submission.php");
            exit();
        }

        // Check if file was uploaded without errors
        if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["image"]["name"];
            $filetype = $_FILES["image"]["type"];
            $filesize = $_FILES["image"]["size"];
            // Validate file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
            // Validate file size - 10MB maximum
            $maxsize = 10 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
            // Validate type of the file
            if(in_array($filetype, $allowed)){
                $bucket = '4ww3';
                $key = basename($filename);
                try {
                    $result = $s3Client->putObject([
                    'Bucket' => $bucket,
                    'Key'    => $key,
                    'Body'   => fopen($_FILES["image"]["tmp_name"], 'r'),
                    "ContentType" => $allowed[$filetype]
                    ]);

                    // insert new gym
                    try{
                        $query = "INSERT INTO gyms (title, details, lat, lng, image_url, website, uid) VALUES (:title, :details, :lat, :lng, :image_url, :website, :uid)";
                        $stmt = $conn->prepare($query);
                        $stmt->execute(array( 
                            'title' => $name, 
                            'details' => $description, 
                            'lat' => $lat, 
                            'lng' => $lng, 
                            'image_url' => $result->get('ObjectURL'),
                            'website' => !empty($website) ? $website : null,
                            'uid' => $_SESSION['user'],
                        ));
                        $stmt->closeCursor();
                    } catch(PDOException $e) {
                        $_SESSION['upload_message'] = "Server error";
                        header("location: ../submission.php");
                        exit();
                    }

                } catch (Aws\S3\Exception\S3Exception $e) {
                    $_SESSION['upload_message'] = "File upload error";
                    header("location: ../submission.php");
                    exit();
                }
                $_SESSION['upload_message'] = "success";
                header("location: ../submission.php");
                exit();
            } else{
                $_SESSION['upload_message'] = "Invalid file type";
                header("location: ../submission.php");
                exit();
            }
        } else{
            $_SESSION['upload_message'] = "Please add an image";
            header("location: ../submission.php");
            exit();
        }
    } else {
        //Invalid method
        header("location: ../submission.php");
        exit();
    }
}
else {
    // invalid access of this file, redirect to submission page
    header("location: ../submission.php");
    exit();
}
?>