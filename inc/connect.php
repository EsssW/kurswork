<?php

    $connect=mysqli_connect( hostname:'localhost', username:'root', password:'', database:'kurswork');
    
    if (!$connect) {
        die('Error connect to DataBase');
    }
?>