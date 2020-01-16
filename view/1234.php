<!DOCTYPE HTML>

<?php
$cookie_name = 'theUser';
$cookie_val =  null;
setcookie($cookie_name,$cookie_val,time() + (86400),"/");
?>

<html>
<head>
    <title>Newsite Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="../controller/loginValidation.js"></script>
    <script src="../controller/reg.js"></script>
</head>
<body>

<div class="modal fade" id="register">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">

            <div class="modal-header">
                <h4 class="modal-title">Register As User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <form name="modal-register" id="modal-register" action="../controller/register.php" onsubmit="return accountValidation()" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="modal-firstname">First name:</label>
                                <input type="text" class="form-control" id="modal-firstname" name="modal-firstname">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="modal-surname">Surname:</label>
                                <input type="text" class="form-control" id="modal-surname" name="modal-surname">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="modal-username">Username (If left empty will be your email):</label>
                        <input type="text" class="form-control" id="modal-username" name="modal-username">
                    </div>
                    <div class="form-group">
                        <label for="modal-email">Email:</label>
                        <input type="email" class="form-control" id="modal-email" name="modal-email">
                    </div>
                    <div class="form-group">
                        <label for="modal-mobile">Mobile:</label>
                        <input type="text" class="form-control" id="modal-mobile" name="modal-mobile">
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="modal-password1">password:</label>
                                <input type="password" class="form-control" id="modal-password1" name="modal-password1">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="modal-password2">password (again):</label>
                                <input type="password" class="form-control" id="modal-password2" name="modal-password2">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Create Account</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>

            <?php
            if (isset($_GET['er'])) {
                if ($_GET['er'] == '4072') {
                    echo "<script type='text/javascript'>
                alert('Account Creation failed');
                
            </script>\";";


                }
            }
            ?>
                </form>

        </div>
    </div>
</div>





<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <div class="jumbotron bg-warning"><img class="img-fluid" src="../model/media/news.png"></div>
        </div>
        <div class="col-sm-7">
        </div>
        <div class="col-sm-1">
            <button class="btn btn-success text-center" data-toggle="modal" data-target="#register">Not Registered?<br>register now</button>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 bg-warning">
            <h1 class="text.centre">Welcome to gaming news</h1>
            <form name="login" action="../controller/login.php" onsubmit="return validateLogin()" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="1234pass" name="password" required>
                    <input type="checkbox" onclick="show()">reveal password
                    <script> function show() {
                        var show = document.getElementById("1234pass");
                        if(show.type === "password"){
                            show.type = "text";
                        }else{
                            show.type = "password";
                        }
                        }</script>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <?php
                if (isset($_GET['er'])) {
                    if ($_GET['er'] == '9001') {
                        echo "Invalid Details";
                    }else{
                    }
                }
                ?>
            </form>


        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
</body>
</html>