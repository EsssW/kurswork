<?php
session_start(); 
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="css/authstyle.css">
</head>
<body style="font-family: Comic Sans MS, Comic Sans, cursive;background-color:#262F34; color: #fff">
<div >
        <a href="create-glem.php" style="border: 1px double  #000000; padding: 10px 10px 10px 10px">Создать форму</a>
        <a href="glem.php?id=4" style="border: 1px double  #000000; padding: 10px 10px 10px 10px">Открыть  форму 1</a>
        <a href="profile.php" style="border: 1px double  #000000; padding: 10px 10px 10px 10px">лк</a>
        <a href="get_winers.php" style="border: 1px double  #000000; padding: 10px 10px 10px 10px">Подвести итоги</a>
        <a href="inc/logout.php" style="background-color: white; text-align:center; color:red" >Выход</a>
        

</div>
<!-- Форма авторизации -->
    <div class="form1">
    <form action="inc/signin.php" method="post">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <button type="submit">Войти</button>
        <p>
            У вас нет аккаунта? - <a href="register.php">Зарегистрируйтесь</a>!
        </p>
        <?php
            if (!empty($_SESSION['message'])) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
    </form>
    </div>
    
   
</body>
</html>