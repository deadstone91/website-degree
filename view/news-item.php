<?php
session_start();
global $get;
$get = $_GET['id'];

require_once '../controller/items-crud.php';

$data = getItemById($get);
$result = json_decode($data, 1);

//var_dump($result);
$id = null;
$headline = null;
$image = null;
$article = null;


foreach ($result as $row) {
    $id = $row['item_id'];
    $headline = $row['headline'];
    $image = $row['image'];
    $article = $row['article'];
}

?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo $headline ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

<body>
<header>
    <div class="row">
        <div class="jumbotron bg-warning col-sm-5">

            <a href="news.php">
                <img src="../model/media/news.png" class="img-fluid">
            </a>
        </div>
        <div class="col-sm-5">
            <?php
            if (isset($_SESSION['id'])) {
                echo '<h5>' . $_SESSION['firstName'] . ' is logged in</h5>';
            } else {
                echo '<h5> no user logged in</h5>';
            }
            ?>
        </div>
    </div>

</header>

<h1 class="text-center"><?php echo $headline ?></h1>
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <img src="../model/media/<?php echo $image ?>" class="img-fluid">
        <p> <?php require $article; ?></p>
    </div>
    <div class="col-sm-3"></div>
</div>
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-7">
        <hr>
        <h2 class="text-center">Comments</h2>
        <?php

        require_once "../controller/comments-crud.php";
        require_once "../controller/user-crud.php";


        if (!empty($return = json_decode(getCommentsByItemId2($get), 1))) {
            $return = json_decode(getCommentsByItemId2($get), 1);
            foreach ($return as $row) {
                $return2 = json_decode(getUserById(($row['user_id'])), 1);
                //var_dump($return2);
                //die();


                foreach ($return2 as $row2) {
                    echo "<h6>" . $row['commentName'] . "</h6>";
                    echo "<P>" . $row['theComment'] . "</P>";
                    echo "<p><strong>Written by " . $row2['username'] . "</strong> on " . $row['dateStamp'] . "</p>";
                }
            }
        } else {
            echo "<p class='text-center'>Opinions seem to be lacking</p>";
        }


        //this is where comments will be displayed
        ?>

        <?php
        if (isset($_SESSION['id'])) {
            $userId = $_SESSION['id'];
            echo '<form action=\'../controller/comment.php?userid=' . $userId . '&itemid=' . $get . '\' method="post">';
            ?>
            <label for="commentName"> Comment Title:</label><br>
            <input name="commentName" id="commentName" type="text" width=""><br>
            <label for="comment">Comment:</label>
            <textarea class="form-control" rows="5" id="comment" name="comment" maxlength="1000"
                      placeholder="Write comment here"></textarea>


            <div class="row">
                <div class="col-sm-3 ">


                    <button type="submit" class="btn btn-warning float-right text-center" id="commentSubmit">add comment
                    </button>
                    </form>
                </div>
                <div class="col-sm-4">
                    <div class="form-check">
                        
                    </div>
                </div>
                <div class="col-sm-5"></div>
            </div>
            <?php
        } else {
            echo '<br><h4 class="text-sm-center">need to be a member to write comments</h4>';
        }


        ?>


    </div>

</div>

</body>


</html>

