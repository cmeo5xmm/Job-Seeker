<?php session_save_path("session_tmp"); session_start(); ?>
Hello !!<?php echo $_SESSION['Account'];?> <p>
<form action="Logout.php"method="POST">
<button type="submit"><span style="font-family:fantasy;">Log out</span></button>
</form>
<div>
<CENTER><h1>Job Vacancy</h1><BR></CENTER>

<table "border:3px #FFD382 dashed;" cellpadding="10" border='1' width="1200">
<tr>
<td>ID</td>
<td>Name</td>
<td>Gender</td>
<td>Age</td>
<td>Education</td>
<td>Expected Salary</td>
<td>Phone Number</td>
<td>Email</td>
<td>Specialty</td>
</tr>

<?php 
$db_host= "dbhome.cs.nctu.edu.tw";
$db_name= "chiangmj0306_cs";
$db_user= "chiangmj0306_cs";
$db_password= "asd12345";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);

$sql= "SELECT * FROM `user`";
$sth= $db->prepare($sql);
$sth->execute();

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
echo "<tr>";
echo "<td>" . $result->id . "</td>";
echo "<td>" . $result->account . "</td>";
echo "<td>" . $result->gender . "</td>";
echo "<td>" . $result->age . "</td>";
echo "<td>" . $result->education . "</td>";
echo "<td>" . $result->expected_salary . "</td>";
echo "<td>" . $result->phone . "</td>";
echo "<td>" . $result->email . "</td>";

$sql1= "SELECT * FROM `user_specialty`";
$sth1= $db->prepare($sql1);
$sth1->execute();
echo "<td>";
while($result1= $sth1->fetchObject()) {
	if($result->id==$result1->user_id){
		specialty_specialty($result1->specialty_id,$db);
	}
}
echo "</td>";
echo "</tr>";
}
?>
</table>
</div><p>

<form action="EmployerLogin.php"method="POST">
<button type="submit">Back to Job Vacancy</button>
</form>