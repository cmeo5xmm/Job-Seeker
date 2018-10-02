<?php session_save_path("session_tmp"); session_start(); 

$account=$_POST['account'];
$password=$_POST['password'];
$education=$_POST['education'];
$expected_salary=$_POST['salary'];
$phone=$_POST['phone'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$email=$_POST['email'];
$Specialty=$_POST['Specialty'];
$id=NULL;
$num=0;
$repeat=0;
$_SESSION['Account']=$account;

$db_host= "dbhome.cs.nctu.edu.tw";
$db_name= "chiangmj0306_cs";
$db_user= "chiangmj0306_cs";
$db_password= "asd12345";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);

if($account==NULL || $password==NULL || $account==' ' || $password==' '){
	echo "Please Enter Account or Password";
	echo '<meta http-equiv="refresh" content="1;url=UserSignUp1.php">';
}else{
	$sql= "SELECT *FROM`user`"."WHERE`account`=?";
	$sth= $db->prepare($sql);
	$sth->execute(array($account));
	while($result= $sth->fetchObject()){
		$repeat=1;
	}
if($repeat==1){
	echo "Account is repeated.";
	echo '<meta http-equiv="refresh" content="1;url=UserSignUp1.php">';
}else{
	$password=crypt($_POST['password'],'$1$ahsdfjqwe');
	$sql1= "INSERT INTO `user` (id, account, password, education, expected_salary, phone, gender, age, email)". " VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$sth1= $db->prepare($sql1);
	$sth1->execute(array($id, $account, $password, $education, $expected_salary, $phone, $gender, $age, $email));
	
	$sql= "SELECT *FROM`user`"."WHERE`account`=?";
	$sth= $db->prepare($sql);
	$sth->execute(array($account));
	while($result= $sth->fetchObject()){
		$temp=$result->id;
	}
	
	foreach ($Specialty as $value ){
	$sql2= "INSERT INTO `user_specialty` (id,user_id,specialty_id)". " VALUES(?,?,?)";
	$sth2= $db->prepare($sql2);
	$sth2->execute(array($id,$temp,$Specialty[$num]));
	$num=$num+1;
	}
	
	$_SESSION['check']="user";
	echo '<meta http-equiv="refresh" content="0;url=Homepage.php">';

}
}
?>