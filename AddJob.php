<?php session_save_path("session_tmp"); session_start();
$db_host= "dbhome.cs.nctu.edu.tw";
$db_name= "chiangmj0306_cs";
$db_user= "chiangmj0306_cs";
$db_password= "asd12345";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);

function find_id($a,$b)
{
	$sql= "SELECT * FROM `employer`" . "WHERE `account` = ?";
	$sth= $b->prepare($sql);
	$sth->execute(array($a));
	while($result= $sth->fetchObject()){
		$employer_id= $result->id;
		return "$result->id";
	}
}
$employer_id=find_id($_SESSION['Account'],$db);
$occupation=$_POST['occupation'];
$location=$_POST['location'];
$WorkTime=$_POST['WorkTime'];
$EducationRequired=$_POST['EducationRequired'];
$Experience=$_POST['Experience'];
$salary=$_POST['salary'];
$id=NULL;

$sql1= "INSERT INTO `recruit` (id, employer_id, occupation_id, location_id, working_time, education, experience, salary)". " VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
$sth1= $db->prepare($sql1);
$sth1->execute(array($id, $employer_id, $occupation,$location,$WorkTime, $EducationRequired, $Experience,$salary));

echo '<meta http-equiv="refresh" content="0;url=EmployerLogin.php">';

?>