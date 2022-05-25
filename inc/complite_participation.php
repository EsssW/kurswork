<?php
    require 'connect.php';
    session_start();
    // проверка что сессия есть иначе выход на окно входа
    if(!$_SESSION['user']){
		$_SESSION['message'] = 'Войдите в акканут!';
        header('Location: ../index.php');
	}
    require_once 'connect.php';
    $user_id = (int) $_SESSION['user']['id'];
    
    $ADD_points = (int)$_POST['points']; // КОЛИЧЕСТВО БАЛЛОВ КОТОРЫЕ НУЖНО ДОБАВИТЬ
    $lotery_id=(int)$_POST['lotery_id'];
    $max_points=0;

    // ПОЛУЧАЕМ МАКСИМАЛЬНОЕ КОЛ-ВО БАЛЛОВ В ДАННОМ РОЗЫГЫРШЕ
    $sql_getmaxpoint=mysqli_query($connect,"SELECT * FROM `tasks` WHERE `lotery_id`='$lotery_id'  ");
    while($row = mysqli_fetch_array($sql_getmaxpoint)){
        $max_points+=(int)$row['points'];
    }
    
    // получаем количество записей в таблице участинов 
    $sql2=mysqli_query($connect,"SELECT COUNT(1) FROM participants Where `lotery_id`='$lotery_id' and `user_id` ='$user_id' ");
    $count=mysqli_fetch_array($sql2);

    // если нет запись с участием пользователя
    if($count[0]<1){
        mysqli_query($connect," INSERT INTO `participants` (`lotery_id`, `user_id`, `points`) VALUES ('$lotery_id', '$user_id', '$points')");
    }
    else{
        // получаем текущее колиечество баллов у пользователя в текущем роызыгрыше
        $sql_get_pointsNow=mysqli_query($connect,"SELECT sum(points) FROM participants WHERE `lotery_id`='$lotery_id' and `user_id`='$user_id' ");
        $points=mysqli_fetch_array($sql_get_pointsNow);
        $points_now=(int)$points[0];

        $sum_points=$points_now+$ADD_points; // В ДАННОЙ ПЕРЕМЕННОЙ ХРАНИТСЯ СУММА ПОИНТОВ КОТОРАЯ БУДЕТ У ПОЛЬЗОВТАЛЕЯ
        // если число баллов пользоватлетя в рамка максимума 
        if($sum_points <= $max_points){
            mysqli_query($connect, "UPDATE `participants` SET `points` = '$sum_points' WHERE `user_id` = '$user_id' and `lotery_id`='$lotery_id' ");
        }
        // иначе максимум
        else{
            mysqli_query($connect, "UPDATE `participants` SET `points` = '$max_points' WHERE `user_id` = '$user_id' and `lotery_id`='$lotery_id' ");
        }
    }
    
    
?>
