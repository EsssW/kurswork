<?php
    require_once 'connect.php';
    session_start();

    if($_SESSION['user']){
        $_SESSION['message'] = 'Войдите в акканут!';
        header('Location: ../index.php');
    }
    
    $id=$_SESSION['user']['id'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $full_name = $_POST['full_name'];
    $email =$_POST['email'] ;
    $twitter = $_POST['twitter'];
    $vk =$_POST['vk'] ;
    $facebook = $_POST['facebook'] ;
    $instagram =$_POST['instagram'] ;
    $GitHub = $_POST['GitHub'];
    $wallet_addres = $_POST['wallet_addres'];

    if($password!="" || $password_confirm!="" || $full_name!="" || $email!="" || $twitter!="" || $vk!="" || $facebook!="" || $instagram!="" || $GitHub!="" || $wallet_addres!="")
    {
        if ($password == $password_confirm)
        {
            
            $password = md5(1);
            mysqli_query($connect,"UPDATE users SET `password`='$twitter' WHERE id='$id' ");
            
            if(mysqli_query($connect, "UPDATE users SET full_name = '$full_name', email = '$email', twitter = '$twitter',
                                                            instagram='$instagram', facebook = '$facebook', vk = '$vk', 
                                                            wallet_addres = '$wallet_addres', GitHub = '$GitHub' 
                                                            WHERE id = '$id'"))
            {
                
                $_SESSION['message'] = 'Данные успешно обновлены! echo($full_name)';
                header('Location: ../profile.php');
            }
            else{
                $_SESSION['message'] = 'Не удалось обновить данные!';
                header('Location: ../profile.php');
            }
        }
        else {
            $_SESSION['message'] = 'Пароли не совпадают';
            header('Location: ../profile.php');
        }
    }
    else {
        $_SESSION['message'] = 'Не должно быть пустых полей!';
        header('Location: ../profile.php');
    }

    
?>
