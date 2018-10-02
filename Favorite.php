<?php session_save_path("session_tmp"); session_start(); ?>
<?php if($_SESSION['Account'] == null || $_SESSION['check']=="Employer"){
		echo '<meta http-equiv="refresh" content="0;url=Homepage.php">';
	}
?>
<?php
$db_host= "dbhome.cs.nctu.edu.tw";
$db_name= "chiangmj0306_cs";
$db_user= "chiangmj0306_cs";
$db_password= "asd12345";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);

$recruit_id=$_POST['Favorite_id'];

$sql= "SELECT * FROM `user`"." WHERE `account`=? ";
$sth= $db->prepare($sql);
$sth->execute(array($_SESSION['Account']));
while($result= $sth->fetchObject()){
	$user_id=$result->id;
}

$sql1 = "INSERT INTO `favorite`(user_id ,recruit_id)"."VALUES(?, ?)";
$sth1 = $db->prepare($sql1);
$sth1->execute(array($user_id,$recruit_id));
?>
<?php
echo '<meta http-equiv="refresh" content="0;url=UserLogin.php">';
?>
