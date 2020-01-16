<?php

require_once '../controller/comments-crud.php';

$commentTitle = $_POST['commentName'];
$comment = $_POST['comment'];
$userId = $_GET['userid'];
$itemId = $_GET['itemid'];


    $commentCreated = setComment($commentTitle,$comment,$userId,$itemId);

    if($commentCreated == false){
        header("location: ../view/news-item.php?id=".$itemId."");
    }

    ?>;