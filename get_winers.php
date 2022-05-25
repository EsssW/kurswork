<?php
session_start();
require('inc/connect.php');
if(!$_SESSION){
    $_SESSION['message'] = 'Войдите в акканут!';
     header('Location: ../index.php');
}
$user_id= $_SESSION['user']['id'];

// ПРОВЕРКА НА is_creator
$sql1=mysqli_query($connect,"SELECT * FROM users where id='$user_id'  " );
$row=mysqli_fetch_assoc($sql1);
if($row['is_creator']!=1){
    $_SESSION['message'] = 'Вы не являетесь создателем розыгрышей!';
    header('Location: ../index.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Подвести итоги розыгрыша</title>
    <style>
        th{
            background-color: #884EA0;
            font-size: 25px;
            color: #DCDCDC	;
        }
        td{
            font-size: 18px;
            background-color: #E6B1FA;
        }
    </style>

</head>
<body style="background-color:#262F34; color: #fff;font-family: Comic Sans MS, Comic Sans, cursive">
<h1 align="center">Созданные вами розыгрыши</h1>
    <table style="width:100% ;border:1px solid #fff">
    <tr>
        <th >Название розыгрыша</th>
        <th>Ссылка на розыгрыш</th>
        <th>Дата начала розыгрыша</th>
        <th>Дата окончания розыгрыша</th>
        <th>Колиичесвто участников</th>
        <th>Мин количестов баллов для участия</th>
    </tr>
    <? $sql=mysqli_query($connect,"SELECT * FROM lotery WHERE creater_id='$user_id' ");
        while($row=mysqli_fetch_assoc($sql)){
            $start_time =date("Y-m-d H:i:s", strtotime($row['start_date'])) ;
            $end_time =date("Y-m-d H:i:s", strtotime($row['end_date'])) ;
            $time_now=date("Y-m-d H:i:s");
            $lotery_id=$row['id'];
            $min_points=$row['min_points'];
            $count=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM participants WHERE lotery_id='$lotery_id' "));
        ?>
        <tr>
			<td style="width:200px;"><?print($row['Title'])?></td>
            <td style="width:150px; text-align: center;"><a href="glem.php?id=<?print($row['id'])?>">LINK</a></td>
			<td style="width:100px;"><?print($row['start_date'])?></td>
            <td style="width:100px; "><?print($row['end_date'])?></td>
            <td style="width:200px; text-align: center;"><?print($count)?></td>
            <td style="width:200px; text-align: center;"><?print($min_points)?></td>
            <?if($start_time > $time_now || $end_time>$time_now){?>
                <td style="width:200px; text-align: center; background:#884EA0;"><a href="winner_list.php?id=<?echo($lotery_id)?>" >Подвести Итог</a></td>
            <?} else{?>
                <td style="width:200px; text-align: center; background:#884EA0; color: #E60042	">Ещё нельзя подвести Итог</td>
		</tr>
        <?}}
    
    ?>
    </table>
<?php
    if (!empty($_SESSION['message'])) {
        echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
    }
    unset($_SESSION['message']);
?>
</body>
</html>