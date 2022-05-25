<?php
    session_start();
    require_once 'connect.php';
    $login = $_POST['login'];
    $password = md5($_POST['password']);
    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    
    if (mysqli_num_rows($check_user) > 0) {

        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user'] = [
            "id" => $user['id'],
            "full_name" => $user['full_name'],
            "email" => $user['email'],
            "is_creator"=>  $user['is_creator'],
            "twitter"=>  $user['twitter'],
            "facebook"=>  $user['facebook'],
            "instagram"=>  $user['instagram'],
            "vk"=>  $user['vk'],
            "wallet_addres"=>  $user['wallet_addres'],
            "GitHub"=>  $user['GitHub']
        ];
        $_SESSION['message'] = 'Успешный вход в систему';
        header('Location: ../index.php');

    } else {
        $_SESSION['message'] = 'Не верный логин или пароль';
        header('Location: ../index.php');
    }
?>
