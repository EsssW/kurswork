<?php
    require 'inc/connect.php';
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title></title>
  <style>
	 th{
        background-color: #884EA0;
        font-size: 25px;
        color: #DCDCDC
    }
    td{
		font-size: 18px;
         background-color: #E6B1FA;     
    }

  </style>
</head>
<body style="background-color:#262F34; color:#fff; font-size:20px;text-decoration: none;">
 
<table >
    <?
		$lotery_id=$_GET['id'];
		// ПРОВЕРКА ЧТО В ТАБЛИЦЕ УЖЕ ЕСТЬ ПОБЕДИТЕЛИ ДАННОГО РОЗЫРЫША
		$check_sql=mysqli_query($connect,"SELECT * FROM winners WHERE lotery_id='$lotery_id' ");
		// если в таблице победителей еще нет записей с данного розыгрыша 
		if(mysqli_num_rows($check_sql)<1){
			
			$sql_lotery=mysqli_fetch_assoc (mysqli_query($connect,"SELECT * FROM lotery WHERE id='$lotery_id' LIMIT 1 ")) ;

			$lotery_winner_count=(int)$sql_lotery['num_winners']; // переменная для хранения кол-ва победителей в конкурсе
			$this_lotey_min_points=(int)$sql_lotery['min_points']; // переменная для хранения мин кол-ва баллов для участия 

			$rand_winners= mysqli_query($connect,"SELECT * FROM participants WHERE lotery_id='$lotery_id' and  points>='$this_lotey_min_points'
													 ORDER BY RAND() LIMIT  ");
			
			$arr=[];
			while( $row= mysqli_fetch_array($rand_winners)  ){
				$arr[]=$row['user_id'];
			}
			foreach($arr as $random_user_id){
				mysqli_query($connect,"INSERT INTO winners (`lotery_id`, `user_id`) VALUES ( '$lotery_id', '$random_user_id')");
			}
		}
		$sql_winners=mysqli_query($connect,"SELECT users.* FROM winners,users WHERE  users.id=winners.user_id");
		?>
		<h1 align="center">Победители розыгрыша</h1>
		<table style="width:100% ;border:1px solid #fff">
		<tr>
			<th>ФИО</th>
			<th>email</th>
			<th>twitter</th>
			<th>facebook</th>
			<th>instagram</th>
			<th>vk</th>
			<th>GitHub</th>
			<th>wallet_addres</th>
    	</tr>
		<?while($row = mysqli_fetch_array($sql_winners)){?>
		<tr>
			<td style="width:150px ;"><?echo($row['full_name'])?></td>
			<td style="width:150px ;"><?echo($row['email'])?></td>
			<td style="width:150px ;"><a href="<?echo($row['twitter'])?>">twitter</a></td>
			<td style="width:150px ;"><a href="<?echo($row['facebook'])?>">facebook</a></td>
			<td style="width:150px ;"><a href="<?echo($row['instagram'])?>">instagram</a></td>
			<td style="width:150px ;"><a href="<?echo($row['vk'])?>">vk</a></td>
			<td style="width:150px ;"><a href="<?echo($row['GitHub'])?>">GitHub</a></td>
			<td style="width:150px ;"><a href="https://bscscan.com/address/<?echo($row['wallet_addres'])?>"><?echo($row['wallet_addres'])?></td>	
		</tr>
		<?}?>
	</table>
		
		
</table>

</body>
</html>