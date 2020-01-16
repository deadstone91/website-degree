<?php
    require '../controller/user-crud.php';


    $fname = $_POST['modal-firstname'];
    $sname = $_POST['modal-surname'];
    $uname = $_POST['modal-username'];
    $email = $_POST['modal-email'];
    $mobile  = $_POST['modal-mobile'];
    $password1  = $_POST['modal-password1'];

    if(getUserByUsername($uname) == true){
        echo "<script type='text/javascript'>
                    alert('Username Already exists, please use another');
                   
              </script>";
        header('location: ../view/1234.php');
    }


       $salt1 = "dfjt43sp";
       $salt2 = "hku56jce";

       $secure = hash('sha512',$salt1.$password1.$salt2);


     $created  = createUser($fname,$sname,$uname,$email,$mobile,$secure);


     if($created == true){
         header("location: ../view/1234.php?er=4072");
     }else{
          header("location: ../view/1234.php");
     }


?>;
