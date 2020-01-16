<!DOCTYPE HTML>
<?php
require '../controller/user-crud.php';
Session_start();
if (isset($_SESSION['id'])) {

    $userInfo = json_decode(getUserById($_SESSION['id']), true);
    //var_dump($userInfo);
    // var_dump($userInfo['first_name']);

    $_SESSION['firstName'] = $userInfo[0]['first_name'];


}
$cookie_name = 'theUser';
$cookie_val = null;
setcookie($cookie_name, $cookie_val, time() + (86400), "/");

?>
<html>
<head>
    <title>GAMING NEWS</title>
    <meta charset="utf-8">
    <link href="../model/media/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="../controller/upload.js"></script>
    <!--<style>
    .news-card {
        
        box-shadow: 0 2px 2px 0 grey
    }
    
    </style>-->
</head>


<body>
<header>
    <div class="row">
        <div class="jumbotron bg-warning col-sm-5">
            <a href="news.php">
                <img src="../model/media/news.png" class="img-fluid">
            </a>
        </div>
        <div class="col-sm-6">

            <?php if (isset($_SESSION['id'])) {
                echo "<h5>" . $_SESSION['firstName'] . ' logged in' . "</h5>";
                echo '<a href="../controller/log-out.php">';
                echo '<button  class="btn-outline-danger float-right">Log Out</button>';
                echo '</a>';
                echo "<a href='#articleModal'>";
                echo '<button class="btn-outline-primary float-right" data-toggle="modal" data-target="#newsModal">Upload Article</button>';
                echo "</a>";
                ?>
                <a href="weather.php">
                    <button class="btn-outline-warning float-right">Weather Api</button>
                </a>
                <?php
            } else {
                echo '<a href="1234.php">';
                echo '<button class="btn-outline-primary float-right">Login</button>';
                echo '</a>';
                ?>
                 <a href="weather.php">
                <button class="btn-outline-warning float-right">Weather Api</button>
            </a>
            <?php
            }
            ?>


        </div>
    </div>
</header>


<?php
include '../controller/items-crud.php';

$data = getAllItems();
$result = json_decode($data, $assoc = true);

//var_dump($result);
echo "<div class=\"row\">";

foreach ($result as $row) {
    echo "<div class=\"col-sm-4 bg-light news-card\" >";
    echo "<h5>" . $row['headline'] . "</h5>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<a href= \"../view/news-item.php?id=" . $row['item_id'] . "\">";
    echo "<img src= \"../model/media/" . $row['image'] . "\"class=\"img-fluid\">";
    echo "</a>";
    echo "</div>";
}
?>
<footer class="jumbotron">

    <a href="../model/rssFeed.xml">
        <img src="../model/media/rss.png" width="50px" height="50px">
    </a>
    <link href="">


</footer>

<div class="modal" id="newsModal" name="newsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload An Article</h4>
                <button type="button" class="close" data-dismiss="modal">&times</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="../controller/articleUpload.php" method="post" enctype="multipart/form-data"
                      onsubmit="validateArticle()" name="articleForm" id="articleForm">
                    <label for="Title">Article Headline</label>
                    <input type="text" class="form-control" id="Title" name="title">
                    <label for="description">Article Description</label>
                    <input type="text" class="form-control" id="description" name="description">
                    <label for="text">Article</label>
                    <textarea id="text" placeholder="Article contents go here" class="form-control"
                              name="text"></textarea>
                    <label for="imageUpload">Image</label>
                    <input type="file" id="imageUpload" accept="image/*" class="form-control" name="imageUpload">

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit Article</button>
                    </div>


                </form>
            </div>



        </div>
    </div>
</div>


</body>

</html>

<?php
if (isset($_GET['er'])) {
    if ($_GET['er'] === "5682") {
        echo "<script>alert('Article has NOT been uploaded')</script>";
    }
}
?>