<?php

    require_once '../model/database.php';

    $db = new databaseCon();
    $connection = $db->connection();
    if(!$connection){
        echo "Lost Connection";
    }

    function getAllItems()
    {
       global $connection;


       $sql = "SELECT * FROM items ORDER BY item_id DESC ";
       $result = mysqli_query($connection,$sql);
       //var_dump($result);

        while($r = mysqli_fetch_assoc($result))
        {
            $count = 0;
            $rows[] = $r;
            $count++;
        }

        //var_dump(json_encode($rows));
        return json_encode($rows);

    }

    function getItemById($id)
    {
        global $connection;

        $sql = "SELECT * FROM items WHERE item_id=".$id;

        $result = mysqli_query($connection,$sql);


        while($r = mysqli_fetch_assoc($result))
        {

            $rows[] = $r;
            return json_encode($rows);
        }
        //var_dump(json_encode($rows));

    }

    function setItem($title,$description,$article,$image)
    {
        global $connection;

        $sql = "INSERT INTO items(headline,image,description,article)values(?,?,?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssss",$title,$image,$description,$article);
        //var_dump($stmt);
        if($stmt->execute())
        {
            echo "<script>alert('Article has been uploaded')</script>";
            header("location: ../view/news.php");
        }else{
            header("location: ../view/news.php?er=5682");

        }
    }
