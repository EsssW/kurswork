<?php
    session_start();
    require_once 'connect.php';

    $creater_id=$_SESSION['user']['id'];
    $strart_date = date("Y-m-d H:i:s", strtotime($_POST['strart_date'])) ;
    $end_date = date("Y-m-d H:i:s", strtotime($_POST['end_date']));
    (string)$title = (string)$_POST['title'];
    $path = (int)$_POST['image_path'];
    $About = $_POST['About'];
    $links = (int)$_POST['links'];
    $min_points=(int)$_POST['min_points'];

    
    
    if($title=="" || $path=="" || $About==""  || $links=="" ){
        $_SESSION['message'] = 'Заполните все поля';
    }
    else{
        //записываем в бд описание розыгрыша
        mysqli_query($connect, 
        "INSERT INTO `lotery` (`creater_id`, `start_date`, `end_date`, `image_path`, `Title`, `About`, `Links`) 
        VALUES ('$creater_id','$strart_date', '$end_date', '$path', '$title', '$About', '$links')") or die("Ошибка запроса 1") ;
        
        // получения id последенего записанного розыгрыша в таблице 
        // для записи в бд заданий для этого розыгрыша
        $sql_count = mysqli_query($connect, "SELECT * FROM `lotery` ");
        $id = (int)mysqli_num_rows($sql_count);

        foreach($_POST['title1'] as $row ) 
        {
            $row_serv_id=$row['service_type_id'];
            $row_link=$row['link'];
            $row_title=$row['desc_name'];
            $row_type=$row['type'];
            $row_points=$row['points'];
            mysqli_query($connect, "INSERT INTO `tasks` (`lotery_id`, `service_type_id`, `link`, `Title`, `Type`, `points`) 
                                                 VALUES ('$id', '$row_serv_id', '$row_link', '$row_title', '$row_type', '$row_points' )");
                                                  
        }
    }
?> 