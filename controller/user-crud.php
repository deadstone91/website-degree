<?php
    require_once '../model/database.php';

$db = new databaseCon();
$connection = $db->connection();
if(!$connection){
    echo "Lost Connection";
}

function loginUser($u,$p){
    global $connection;

    $sql = "SELECT * FROM users WHERE username='$u' and password='$p' ";

    $result = mysqli_query($connection,$sql);
    //var_dump($result);
    //die();
    while($r = mysqli_fetch_assoc($result))
    {
        $count = 0;
        $rows[] = $r;
        $count++;
    }

    if(!empty($rows)){
        return json_encode($rows);
   }
}

function getUserById($id)
{

    global $connection;

    $sql = "SELECT * FROM users WHERE user_id =".$id;

    $result = mysqli_query($connection,$sql);


    while($r = mysqli_fetch_assoc($result))
    {
        $rows[] = $r;
    }
    //var_dump(json_encode($rows));
    return json_encode($rows);


}

function getUserByUsername($username)
{

    global $connection;

    $sql = "SELECT * FROM users WHERE username =".$username;

    $result = mysqli_query($connection,$sql);

    if(empty($result))
    {
        return false;
    }else{
        return true;
    }

    //var_dump(json_encode($rows));



}








function createUser($fname,$sname,$uname,$email,$mobile,$secure){

    global $connection;

    $sql = "INSERT INTO users(first_name, surname, username, password, email, mobile) values (?,?,?,?,?,?)";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssss",$fname,$sname,$uname,$secure,$email,$mobile);

    if($stmt->execute())
    {
        echo '<script type="text/javascript"> alert("User has been Created") </script>';
    }

}

?>;