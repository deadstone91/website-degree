<?php

    require '../controller/user-crud.php';
    session_start();

    $user = $_POST['username'];
    $pass = $_POST['password'];
    $salt1 = 'dfjt43sp';
    $salt2 = 'hku56jce';

    $secure = hash('sha512',$salt1.$pass.$salt2);

    //var_dump($user, $pass);
    //die();

    $data = loginUser($user,$secure);
    $result = json_decode($data, $assoc = true);

    //var_dump($result);
    //die();

    if(!empty($result)){
        echo "true";
        $_SESSION['id'] = $result[0]['user_id'];



        header('location: ../view/news.php');

    }else{
        header('location: ../view/1234.php?er=9001');
    }
        die();


    //var_dump($result);
    //var_dump($user,$pass);
    //die();




?>;