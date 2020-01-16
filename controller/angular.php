<?php
    require_once '../model/database.php';

    $db = new databaseCon();
$connection = $db->connection();
if(!$connection){
    echo "Lost Connection";
}
getData();

function getData(){
    global $connection;

    $sql = "SELECT * FROM ang";
       $result = mysqli_query($connection,$sql);
        $rows = null;
        while($r = mysqli_fetch_assoc($result))
        {
            $rows[] = $r;
        }

        
        echo json_encode($rows);
}

?>;