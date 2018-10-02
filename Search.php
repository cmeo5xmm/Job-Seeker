<?php session_save_path("session_tmp"); session_start(); ?>
<?php 
$db_host= "dbhome.cs.nctu.edu.tw";
$db_name= "chiangmj0306_cs";
$db_user= "chiangmj0306_cs";
$db_password= "asd12345";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);

unset($_SESSION['scheck']);
$occupation=$_POST['ooccupation'];
$location=$_POST['llocation'];
$worktime=$_POST['wworktime'];
$educationrequired=$_POST['eeducationrequired'];
$workingexperience=$_POST['wworkingexperience'];
$salary=$_POST['ssalary'];

if($occupation==NULL && $location==NULL && $worktime==NULL && $educationrequired==NULL && $workingexperience==NULL && $salary==0 ){
	if($_POST['search']==0){
		echo '<meta http-equiv="refresh" content="0;url=Homepage.php">';
	}else if($_POST['search']==1){
		echo '<meta http-equiv="refresh" content="0;url=EmployerLogin.php">';
	}else if($_POST['search']==2){
		echo '<meta http-equiv="refresh" content="0;url=UserLogin.php">';
	}
}else{
	$sql= "SELECT recruit.employer_id,recruit.id,occupation.occupation,location.location,recruit.working_time,recruit.education,recruit.experience,recruit.salary FROM recruit
	INNER JOIN occupation INNER JOIN location WHERE recruit.occupation_id=occupation.id AND recruit.location_id=location.id ";
	if($occupation!=NULL)  $sql=$sql."AND occupation LIKE '%". $occupation."%' ";
	if($location!=NULL)  $sql=$sql."AND location LIKE '%". $location."%' ";
	if($worktime!=NULL)  $sql=$sql."AND working_time LIKE '%". $worktime."%' ";
	if($educationrequired!=NULL)  $sql=$sql."AND education LIKE '%". $educationrequired."%' ";
	if($workingexperience!=NULL)  $sql=$sql."AND experience LIKE '%". $workingexperience."%' ";
	if($salary==1)  $sql=$sql."AND salary<='20000'";
	if($salary==2)  $sql=$sql."AND salary BETWEEN '20001' AND '30000'";
	if($salary==3)  $sql=$sql."AND salary BETWEEN '30001' AND '40000'";
	if($salary==4)  $sql=$sql."AND salary BETWEEN '40001' AND '50000'";
	if($salary==5)  $sql=$sql."AND salary BETWEEN '50001' AND '60000'";
	if($salary==6)  $sql=$sql."AND salary>'60001'";
	
	$_SESSION['search']=$sql;
	$_SESSION['scheck']="search";
	if($_POST['search']==0){
		echo '<meta http-equiv="refresh" content="0;url=Homepage.php">';
	}else if($_POST['search']==1){
		echo '<meta http-equiv="refresh" content="0;url=EmployerLogin.php">';
	}else if($_POST['search']==2){
		echo '<meta http-equiv="refresh" content="0;url=UserLogin.php">';
	}
}
?>