<?php
    session_start();
    if($_SESSION){
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
<body style="font-family: Comic Sans MS, Comic Sans, cursive;background-color:#262F34; color: #fff">
<div class="form1">
    <!-- Форма регистрации -->
    
    <form action="inc/signup.php" method="post" enctype="multipart/form-data">
        <h1 style="align-items: center;">Регистрация</h1>
        <p style="font-size: large; color:red"><input  type="checkbox" name="checkbox" > Зарегистрироваться как создатель розыгрышей?</p>
        <br>
        <label>ФИО</label>
        <input type="text" name="full_name" placeholder="Введите свое полное имя">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Почта</label>
        <input type="email" name="email" placeholder="Введите адрес своей почты">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <label>Подтверждение пароля</label>
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
        <button type="submit">Зарегистрироваться</button>
        <p>
            У вас уже есть аккаунт? - <a href="/">авторизируйтесь</a>!
        </p>
        <?php
            //  если сессия существует то выводим инофрмацию
            if (!empty($_SESSION['message'])) {
                // сообщаем о несовпоении паролей 
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            // иначе сессия заканчивается 
            unset($_SESSION['message']);
        ?>
    </form>
    </div>
</body>
</html>