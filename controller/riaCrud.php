<?php
require_once '../model/database.php';

$db = new databaseCon();
$connection = $db->connection();
if (!$connection) {
    echo "Lost Connection";
}

$theId =  $_GET['id'];
//var_dump($theId);
//die();
getBlogById($theId);







function getBlogById($id){
    global $connection;

    $sql = "SELECT * FROM rich WHERE blog_id =".$id;

    $result = mysqli_query($connection,$sql);
    //var_dump($sql);
    while ($r = mysqli_fetch_assoc($result))
    {
        $rows[] = $r;
    }
    echo json_encode($rows);
}

function getTotalWeeks(){
    global $connection;

    $sql = 'SELECT COUNT(blog_id) FROM rich';

    $result = mysqli_query($connection,$sql);

    return $result;
}