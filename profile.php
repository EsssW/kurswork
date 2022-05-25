<?php
require('inc/connect.php');
session_start();
if(!$_SESSION['user']){
    $_SESSION['message'] = 'Войдите в акканут!';
    header('Location: ../index.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="css/authstyle.css">
</head>
<body style="background-color:#262F34;color:white; display: flex; justify-content: center; height: 100%; font-family: Comic Sans MS, Comic Sans, cursive">

    <!-- Профиль -->
    <form action="inc/editProfile.php" method="post" >
        <h1 style="margin: 10px 0;  font-size:30px; text-align:center">Личный Кабинет</h1>
        <h1 style="margin: 10px 0;  font-size:20px; text-align:center">Вы можете изменить все поля</h1>
        ФИО
        <input type="text" name="full_name" placeholder="ФИО" value="<?= $_SESSION['user']['full_name'] ?>"/> 
        EMAIL
        <input type="text" name="email" placeholder="email addres" value="<?= $_SESSION['user']['email'] ?>"/> 
        Twitter
        <input type="text" name="twitter" placeholder="Twitter account url" value="<?= $_SESSION['user']['twitter'] ?>"/>
        VK 
        <input type="text" name="vk" placeholder="VK account url" value="<?= $_SESSION['user']['vk'] ?>" />
        FaceBook
        <input type="text" name="facebook" placeholder="FaceBook account url" value="<?= $_SESSION['user']['facebook'] ?>"/>
        Instagram
        <input type="text" name="instagram" placeholder="Instagram account url" value="<?= $_SESSION['user']['instagram'] ?>"/>
        GitHub
        <input type="text" name="GitHub" placeholder="GitHub account url" value="<?= $_SESSION['user']['GitHub'] ?>"/>
        Wallet addres
        <input type="text" name="wallet_addres" placeholder="0x..." value="<?= $_SESSION['user']['wallet_addres'] ?>"/>
        Пароль
        <input type="password" name="password" />
        Пароль еще раз
        <input type="password" name="password_confirm" />
        <?php
            if (!empty($_SESSION['message'])) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
        <input  type="submit"  value="Сохранить изменения" >
        <a href="inc/logout.php" style="background-color: white; text-align:center; color:red" >Выход</a>
        
    </form>

</body>
</html>