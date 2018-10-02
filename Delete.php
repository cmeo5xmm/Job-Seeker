<?php
$db_host= "dbhome.cs.nctu.edu.tw";
$db_name= "chiangmj0306_cs";
$db_user= "chiangmj0306_cs";
$db_password= "asd12345";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);

$delete_id=$_POST['delete_id'];
$sql="DELETE FROM `chiangmj0306_cs`.`recruit`"."WHERE `id` = '$delete_id'";
$sth= $db->prepare($sql);
$sth->execute();



echo '<meta http-equiv="refresh" content="0;url=EmployerLogin.php">';
?>