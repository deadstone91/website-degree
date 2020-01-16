<?php
require_once 'items-crud.php';
//var_dump($_POST);
$title = $_POST['title'];
$description = $_POST['description'];
$image = $_FILES['imageUpload'];
$article = $_POST['text'];
//var_dump($title,$description,$image,$article);

//image upload section

$ext = pathinfo($_FILES['imageUpload']["name"], PATHINFO_EXTENSION);
$newImageName = date("dmy_Hi_") . basename($_FILES['imageUpload']['name']);

$target_dir = "../model/media/";
$target_file = $target_dir . $newImageName;
$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES['imageUpload']["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES['imageUpload']["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES['imageUpload']["tmp_name"], $target_file)) {
        echo "<script> alert('The file " . $newImageName . " has been uploaded.')</script>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// article send to database
$fileName = "../model/media/".random_int(1000,9999)."_article.txt";
$createArticle = fopen($fileName, "w");
fwrite($createArticle,$article);
fclose($createArticle);

if($uploadOk == 1){
    setItem($title,$description,$fileName,$newImageName);
}
