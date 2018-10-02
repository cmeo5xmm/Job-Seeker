<?php session_save_path("session_tmp"); session_start();

$account=$_POST['account'];
$password=$_POST['password'];
$phone=$_POST['phonenumber'];
$email=$_POST['email'];
$id=NULL;
$repeat=0;
$_SESSION['Account']=$account;

$db_host="dbhome.cs.nctu.edu.tw";
$db_user="chiangmj0306_cs";
$db_password="asd12345";
$db_name="chiangmj0306_cs";
$dsn="mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);

if($account==NULL || $password==NULL || $account==' ' || $password==' '){
	echo "Please Enter Account or Password";
	echo '<meta http-equiv="refresh" content="1;url=EmployerSignUp1.php">';
}else{
	$sql= "SELECT *FROM`employer`"."WHERE`account`=?";
	$sth= $db->prepare($sql);
	$sth->execute(array($account));
	while($result= $sth->fetchObject()){
		$repeat=1;
	}
if($repeat==1){
	echo "Account is repeated.";
	echo '<meta http-equiv="refresh" content="1;url=EmployerSignUp1.php">';
}else{
	$password=crypt($_POST['password'],'$1$ahsdfjqwe');
	$sql1= "INSERT INTO `employer` (id, account, password, phone, mail)". " VALUES(?, ?, ?, ?, ?)";
	$sth1= $db->prepare($sql1);
	$sth1->execute(array($id, $account, $password, $phone, $email));
	
	$_SESSION['check']='Employer';
	echo '<meta http-equiv="refresh" content="0;url=Homepage.php">';
}
}
?>