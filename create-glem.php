<?php
	// проверка существоания сессии
	session_start();
	if(!$_SESSION['user']){
		$_SESSION['message'] = 'Войдите в акканут!';
        header('Location: ../index.php');
	}
    require('inc/connect.php') ;
	$this_user_id=$_SESSION['user']['id'];
	
	// ПРОВЕРКА НА is_creator
	$sql1=mysqli_query($connect,"SELECT * FROM users where id='$this_user_id'  " );
	$row=mysqli_fetch_assoc($sql1);
	if((int)$row['is_creator']!=1){
		$_SESSION['message'] = 'Вы не являетесь создателем розыгрышей!';
    	  header('Location: ../index.php');
	}

    $sql=mysqli_query($connect, "SELECT * FROM `task_type` ");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="css/style.css">
	<style>
		.button-add {
			margin-left: 35px;
		}
		.table{
        width: 100%;
        height: 75px;
        margin-bottom: 15px;
     	}

		.table tr{
			margin-bottom: 15px;
		}

		.mediaTD{
			height: 75px;
			width: 12%;
			background-color: gray;
			padding-top: 30px;
			
		}
		.typeSelector{
			width: 100%;
			height: 100%;
			font-size: 20;
		}
	</style>
</head>
<body style="font-family: Comic Sans MS, Comic Sans, cursive;background-color:#262F34; color: #fff">
<form  action='inc/createform.php' method="POST">
<script>
	const id=0; // переменная для индексирвоания массива заданий
</script>
<div >
	<div  style=" padding: 20px 20px 20px 20px">
		<div  style="width: 550px;"> <h3>Выберете дату начала конкурса</h3> </div>
		<div  style=" padding: 20px 20px 20px 20px">  <input type="datetime-local" name="strart_date" style="margin-left: 50px" value="2022-05-01T00:00" > </div>
	</div>
	<div  style=" padding: 20px 20px 20px 20px">
		<div  style="width: 550px;">  <h3>Выберете дату окнончания конкурса</h3> </div>
		<div  style=" padding: 20px 20px 20px 20px"><input type="datetime-local" name="end_date" style="margin-left: 50px;" value="2022-05-30T23:59" ></div>
	</div>
	<div  style=" padding: 20px 20px 20px 20px">
		<div  style="width: 550px;"> <h3>Введите заголовок розыгрыша</h3></div>
		<div  style=" padding: 20px 20px 20px 20px"><input type="text" name="title"  style="margin-left: 50px; width:800px;height:30px " value="Розыгырш 1"  ></div>
	</div>
	<div  style=" padding: 20px 20px 20px 20px">
		<div  style="width: 550px;"><h3>Введите ссылку на главное  Изображение конкурса </h3></div>
		<div  style=" padding: 20px 20px 20px 20px"> <input type="text" name="image_path" id="image_path" style="margin-left: 50px; width:800px;height:30px" ></div>
	</div>
    <div  style=" padding: 20px 20px 20px 20px">
		<div  style="width: 550px;"> <h3>Введите описание розыгрыша</h3></div>
		<div  style=" padding: 20px 20px 20px 20px"> <input type="text" name="About"  style="margin-left: 50px; width:800px;height:300px "  > </div>
	</div>
    <div  style=" padding: 20px 20px 20px 20px">
		<div  style="width: 550px;"><h3>Введите ссылки розыгрыша через пробел</h3></div>
		<div  style=" padding: 20px 20px 20px 20px"><input type="text" name="links"  style="margin-left: 50px; width:800px;height:50px "  ></div>
	</div>
	<div  style=" padding: 20px 20px 20px 20px">
		<div  style="width: 550px;"><h3>Введите количество минимальных баллов для участия в розыгрыше</h3></div>
		<div  style=" padding: 20px 20px 20px 20px"><input type="text" name="min_points"  style="margin-left: 50px; width:800px;height:50px "  ></div>
	</div>
    <div  style=" padding: 20px 20px 20px 20px">
		<div  style="width: 550px;"><h3>Создайте задания для розыгрыша</h3></div>
	</div>
</div>

	<button  onclick="addTask(); return false;" >+Добавить задание</button>
	<div id="id_task">
	<div  class="task" id="div_id">
	<table class="table">
	    <tr>
            <!-- выбор соцсети задания задания -->
			<td class="mediaTD" >
            <select class="typeSelector select1" name="title1[1][service_type_id]" >
                <?while($row=mysqli_fetch_array($sql)){?>
                    <option value="<?print($row['id'])?>"  ><?print($row['title'])?></option>
                    <?}?>
            </select>

            </td>
            <!-- описание задания -->
			<td style="width: 25%; height: 75px; background-color:aquamarine">
             Описанание задания кратко
                <input  class="title_class" type="text"  name="title1[1][desc_name]" width="100%" height="100px" style="font-size: 25px; ">
            </td>
            <!-- ссылка задания -->
			<td style="width: 25%; height: 75px; background-color:aquamarine">
            Введите ссылку на задание
                <input type="url" class="url_class" name="title1[1][link]" width="100%" height="100px"  placeholder="https://vk.com" style="font-size: 25px;  ">
            </td>
            <!-- тип задания -->
			<td style="width: 100px">
                <select class="typeSelector select2" name="title1[1][type]" >
                    <option value="1">Подписка</option>
                    <option value="2">Репост</option>
                    <option value="3">Лайк</option>
                    <option value="4">Указать данные</option>
                </select>
            </td>
            <!-- количество баллов за задание задания -->
			<td style="width: 100px">
            Укажите число баллов
                <input type="text" class="point_class"  name="title1[1][points]" placeholder="0" style="font-size: 20px;">
            </td>

		</tr>
    </table>
	</div>
	</div>
	<button type="submit">done</button>

<script >
	
	function addTask(event ){
		var div = document.getElementById('div_id'),
		clone = div.cloneNode(true); 
		var id=Date.now();
		clone.id = id;
		document.getElementById("id_task").appendChild(clone);

		clone.querySelector('.title_class').setAttribute('name', 'title1['+id+'][desc_name]');
		clone.querySelector('.select1').setAttribute('name', 'title1['+id+'][service_type_id]');
		clone.querySelector('.url_class').setAttribute('name', 'title1['+id+'][link]');
		clone.querySelector('.select2').setAttribute('name', 'title1['+id+'][type]');
		clone.querySelector('.point_class').setAttribute('name', 'title1['+id+'][points]');
	}
	
 </script>
</form>
</body>
</html>

