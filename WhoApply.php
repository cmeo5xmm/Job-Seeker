<?php session_save_path("session_tmp"); session_start(); ?>
<?php if($_SESSION['Account'] == null || $_SESSION['check']=="user"){
		echo '<meta http-equiv="refresh" content="0;url=Homepage.php">';
	}
?>
Hello !!<?php echo $_SESSION['Account'];?> <p>
<form action="Logout.php"method="POST">
<button type="submit"><span style="font-family:fantasy;">Log out</span></button>
</form>
<div>
<CENTER><h1>Who Applies for Your Job</h1><BR></CENTER>
<table "border:3px #FFD382 dashed;" cellpadding="10" border='1' width="1200">
<?php 
$db_host= "dbhome.cs.nctu.edu.tw";
$db_name= "chiangmj0306_cs";
$db_user= "chiangmj0306_cs";
$db_password= "asd12345";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);

$sql= "SELECT * FROM `recruit` ORDER BY id ASC";
$sth= $db->prepare($sql);
$sth->execute();

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

function occupation_id($a,$b)
{
	$sql= "SELECT * FROM `occupation`" . "WHERE `id` = ?";
	$sth= $b->prepare($sql);
	$sth->execute(array($a));
	while ($result= $sth->fetchObject()){
	echo "<td>" . $result->occupation . "</td>";
	}
}

function location_id($a,$b)
{
	$sql= "SELECT * FROM `location`" . "WHERE `id` = ?";
	$sth= $b->prepare($sql);
	$sth->execute(array($a));
	while ($result= $sth->fetchObject()){
	echo "<td>" . $result->location . "</td>";
	}
}

function specialty_specialty($a,$b)
{
	$sql= "SELECT * FROM `specialty`" . "WHERE `id` = ?";
	$sth= $b->prepare($sql);
	$sth->execute(array($a));
	while ($result= $sth->fetchObject()){
	echo $result->specialty . "/";
	}
}

while($result= $sth->fetchObject()) {
	if(find_id($_SESSION['Account'],$db)==$result->employer_id){
		echo "<tr>";
		occupation_id($result->occupation_id,$db);
		location_id($result->location_id,$db);
		echo "<td>" . $result->working_time . "</td>";
		echo "<td>" . $result->education . "</td>";
		echo "<td>" . $result->experience . "</td>";
		echo "<td>" . $result->salary . "</td>";
		echo "<td>&nbsp</td>";
		echo "<td>&nbsp</td>";
		echo "<td>&nbsp</td>";
		echo "</tr>";
		$sql1= "SELECT * FROM `user`,`application` "."WHERE application.user_id=user.id";
		$sth1= $db->prepare($sql1);
		$sth1->execute();
		while ($result1= $sth1->fetchObject()){
			if($result1->recruit_id == $result->id){
				echo "<tr>";
				echo "<td>" . $result1->account . "</td>";
				echo "<td>" . $result1->gender . "</td>";
				echo "<td>" . $result1->age . "</td>";
				echo "<td>" . $result1->education . "</td>";
				echo "<td>" . $result1->expected_salary . "</td>";
				echo "<td>" . $result1->phone . "</td>";
				echo "<td>" . $result1->email . "</td>";
				echo "<td>";
				$sql2= "SELECT * FROM `user_specialty`";
				$sth2= $db->prepare($sql2);
				$sth2->execute();
				while($result2= $sth2->fetchObject()) {
					if($result1->id==$result2->user_id){
					specialty_specialty($result2->specialty_id,$db);
					}
				}
				echo "</td>";
				echo '
				<td><form action="Hire.php"method="POST">
				<button name="Hire_id" value=' .$result->id.' type="submit">Hire</button>
				</form></td>';
				echo "</tr>";
			}
		}
	}
}
?>
</table>
</div><p>

<form action="EmployerLogin.php"method="POST">
<button type="submit">Back to Job Vacancy</button>
</form>