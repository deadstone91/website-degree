<!Doctype html>
<head>
<title>RIA (BLOG)</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="/controller/ajax.js"></script>
<style>

.pic {
    display: none;
    position: ;
   max-width: 100%;
   height: auto; 
}


</style>

</head>
<body>
<div class="jumbotron text-center"><h1>Rich Internet applications</h1><br><h4>The Blog</h4></div>


<div class="container bg-light parent">
    <div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link">Menu</a>
                </li>

                <?php
                for($i = 1; $i <= 12; $i++){
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link navBtn' href='#' onclick ='loadBlog(".$i.")' id='week".$i."'>Week ".$i."</a>";
                    echo "</li>";
                }
                ?>
                
            </ul>
        </nav>
    </div >
<p id="test"></p>
    <p class="" id="blogText"></p>
<div id="content" >
    
</div>


</div>
    

</body>