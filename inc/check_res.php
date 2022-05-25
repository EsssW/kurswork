<?php
    require 'connect.php';
    $lotery_id=1;
    $lotery_winner_count=0;
    
    $lotery_winner_count=mysqli_query($connect,"SELECT num_winners FROM lotery WHERE id='$lotery_id' LIMIT 1 ");

    $partic_arr=mysqli_fetch_array( mysqli_query($connect,"SELECT * FROM participants WHERE lotery_id='$lotery_id' "));
    $participants_count=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM participants WHERE lotery_id='$lotery_id' "));

    // если кол-во победитлей меньше 1 или кол-во участинов меньше кол-ва победителей 
    if($lotery_winner_count<1 || $partic_arr< $lotery_winner_count){
        #вывести ошибку
    }
    else{
        $winners_id_arr=[]; // массив id победителей
        
        for($i = 1; $i <= $lotery_winner_count; $i++){
            // запись в массив победителей тех, кто в выборке находится под рандомным id
            $winner_id=$partic_arr[array_keys($partic_arr)[rand(0,$participants_count)]]['id'];
            mysqli_query($connect, "INSERT INTO winners (lotery_id, user_id ) VALUES ($lotery_id,$winner_id) ");
        }
        foreach($winners_id_arr as $row){
            echo($row);
        }
    }

?>