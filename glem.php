<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>glem</title>
    <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
    <?php
        require('inc/connect.php');
        $lotery_id=$_GET['id'];
        $this_lottery_arr=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `lotery` WHERE id = '$lotery_id'  "));
        $count_participants=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM participants WHERE lotery_id='$lotery_id' "));

    ?>
</head>
<body style="background-color:#262F34; display: flex; justify-content: center; height: 100%; font-family: Comic Sans MS, Comic Sans, cursive">
    <div class="main" style="width: 500px; height: 1500px ">
        <div class="top_box">
            <div class="timer1">
                <font style="font-size:23px">Start Date</font>
                <?print($this_lottery_arr['start_date'])?>
            </div>
            <div class="timer1" style="font-size:23px ;">
                <font style="font-size:15px">Всего участников</font>
                <br>
                <?print($count_participants)?>
            </div>
            <div class="timer1" >
                <font style="font-size:23px">End Date</font>
                <?print($this_lottery_arr['end_date'])?>
            </div>
        </div>
        
        <div style="width: 100%; height: 100px; text-align: center; ">
            <span>
                <font style="font-size:23px; color: #F34A4A;font-family: Comic Sans MS, Comic Sans, cursive; " >
                <strong><?print("<p>".$this_lottery_arr['Title']." </p>")?></strong></font>
            </span>
        </div>
        <br><br>
        <div class="image_box" style="background-image: url('<?print($this_lottery_arr['image_path'])?>')">
            
        </div>
        <div style="width: 100%; text-align: center; padding-bottom: 10px; ">
            <p style=" padding: 10px; text-align: left; font-size: 11pt;vertical-align: baseline;  overflow: hidden; max-width: 100%;">
            <?print("<p>".$this_lottery_arr['About']." </p>")?>
            </p>
            <h3>Ссылки</h3>
            <ul>
                <?
                $links_arr = explode(" ", $this_lottery_arr['Links']);
                foreach($links_arr as $link){ ?>
                <li><a href="<?$link?>"> <?print($link)?> </a></li>
                <?}?>
              </ul>
        </div>
        <div style="width: 100%; height: 100px">
        
            <div  ><!--IMAGEBOX-->
            <?
                $sql = mysqli_query($connect, "SELECT * FROM `tasks` where `lotery_id`=$lotery_id ") or die("ОШИБКА ПРИ ВЫВОДЕ ЗАДАНИЙ");
                while ($result = mysqli_fetch_array($sql)){
                    $index= $result['service_type_id'];
                    $logo_path=mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `task_type` WHERE `id`= '$index'  "));
            ?>
                <span style="float: left; height: 70px; width: 70px; background-color:#e0e0e0; ">
                    <p style="width: 100%; height: 100%;;background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center center; background-image: url(<?echo($logo_path['logo_img_path'])?>)"></p>
                </span>
                <!--ABOUT TASK-->
                <span style="float: left; height: 70px; width: 370px;  background-color: #e0e0e0">
                    <a href="<?echo($result['link'])?>" target="_blank">  <?echo($result["Title"])?></a>
                </span>
                <!--COMPLITE BTN-->
                <span style="float: left; height: 70px; width: 55px; background-color: #F1D3BC;">
                <form  action='inc/complite_participation.php' method="post" style="width: 100%; height: 100%;">
                    <input type="hidden" name="lotery_id" value="<?echo($lotery_id)?>">
                    <input type="hidden" name="points" value="<?echo($result['points'])?>">
                    <input name="submit" type="submit" href="#"  class="btn btn-primary" style="width: 100%; height: 100%; font-size: 10px;" value="DONE" ></input>
                </form>
                </span>
            <?}?>
            </div>
        </div>
    </div>


</div>

</body>
</html>