<?php

    session_start();
    require_once 'connect.php';

    $full_name = $_POST['full_name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password == $password_confirm) {
        // ПРОВЕРКА ОШИБОК
        // проверка уникальности email
        $check_email= mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");
        if (mysqli_num_rows($check_email) > 0)
        {
            $_SESSION['message'] = 'Такой Логин уже есть в системе!';
            header('Location: ../register.php');
            die;
        }
        
        // проверка уникальности login
        $check_login= mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
        if (mysqli_num_rows($check_login) > 0)
        {
            $_SESSION['message'] = 'Такой Логин уже есть в системе!';
            header('Location: ../register.php');
            die;
        }
        

        $password = md5($password);
        if(!empty($_POST['checkbox']))
            mysqli_query($connect, "INSERT INTO `users` ( `full_name`, `login`, `email`, `password`, `is_creator`) VALUES ('$full_name', '$login', '$email', '$password', 1)");
        else
            mysqli_query($connect, "INSERT INTO `users` ( `full_name`, `login`, `email`, `password`, `is_creator`) VALUES ('$full_name', '$login', '$email', '$password', 0)");

        $_SESSION['message'] = 'Регистрация прошла успешно!';
        header('Location: ../index.php');


    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: ../register.php');
    }

?>
