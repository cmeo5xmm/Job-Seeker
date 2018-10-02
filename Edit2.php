<?php
$db_host= "dbhome.cs.nctu.edu.tw";
$db_name= "chiangmj0306_cs";
$db_user= "chiangmj0306_cs";
$db_password= "asd12345";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);

$edit_id=$_POST['edit_id'];
$occupation=$_POST['occupation'];
$location=$_POST['location'];
$WorkTime=$_POST['WorkTime'];
$EducationRequired=$_POST['EducationRequired'];
$Experience=$_POST['Experience'];
$salary=$_POST['salary'];

$sql= "UPDATE `chiangmj0306_cs`.`recruit` 
				SET `occupation_id` = '$occupation' ,
					`location_id` = '$location' , 
					`working_time` = '$WorkTime' ,
					`education` = '$EducationRequired' ,
					`experience` = '$Experience' ,
					`salary` = '$salary'
				WHERE `id` = '$edit_id' ";
		$sth= $db->prepare($sql);
		$sth->execute();

echo '<meta http-equiv="refresh" content="0;url=EmployerLogin.php">';
?>