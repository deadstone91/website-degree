<?php
require_once '../model/database.php';

$db = new databaseCon();
$connection = $db->connection();
if(!$connection){
    echo "Lost Connection";
}

function getCommentsByItemId($i_id)
{
    global $connection;

    $sql = 'SELECT * FROM comments WHERE item_id = ?';
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $i_id);
    $result = $stmt->execute();

    while($r = mysqli_fetch_assoc($result))
    {
        $rows[] = $r;
    }
    return json_encode($rows);

}


function getCommentsByItemId2($i_id)
{
    global $connection;

    $sql = "SELECT * FROM comments WHERE item_id = $i_id ";


    $result = mysqli_query($connection,$sql);
    $rows = null;
    if(empty($result)){


    }else{
        while($r = mysqli_fetch_assoc($result))
        {

            $rows[] = $r;
        }
        //var_dump(json_encode($rows));
        return json_encode($rows);
         }

}


function setComment($ct,$c,$u,$i){
    global $connection;

    $sql = "INSERT INTO comments(commentName,theComment,user_id,item_id,dateStamp) values(?,?,?,?,?)";

    $stmt = $connection->prepare($sql);
    $date = date("Y-m-d H:i:s");
    //var_dump($date);
    $stmt->bind_param("ssiis",$ct,$c,$u,$i,$date);
    If($stmt->execute())
    {
        echo '<script>alert("Comment Created! ")</script>';
    }
}
?>;