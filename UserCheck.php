<?php session_save_path("session_tmp"); session_start();

$account=$_POST['account'];
$password=crypt($_POST['password'],'$1$ahsdfjqwe');
$repeat=0;
$db_host= "dbhome.cs.nctu.edu.tw";
$db_name= "chiangmj0306_cs";
$db_user= "chiangmj0306_cs";
$db_password= "asd12345";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);
	
	if($account==NULL || $password==NULL){
		echo "Wrong!";
		echo '<meta http-equiv="refresh" content="1;url=Homepage.php">';
	}else{
	$sql= "SELECT *FROM`user`"."WHERE`account`=?AND`password`=?";
	$sth= $db->prepare($sql);
	$sth->execute(array($account, $password));
	
	while($result= $sth->fetchObject()){
		$repeat=1;
		$_SESSION['id']=$result->id;
	}
	if($repeat==1){
		$_SESSION['Account']=$account;
		$_SESSION['check']="user";
		unset($_SESSION['scheck']);
		echo '<meta http-equiv="refresh" content="0;url=UserLogin.php">';
	}else{
		echo "Wrong!";
		echo '<meta http-equiv="refresh" content="1;url=Homepage.php">';
	}
	}
?>