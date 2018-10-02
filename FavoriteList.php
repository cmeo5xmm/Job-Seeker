<?php session_save_path("session_tmp"); session_start(); ?>
<?php if($_SESSION['Account'] == null || $_SESSION['check']=="Employer"){
		echo '<meta http-equiv="refresh" content="0;url=Homepage.php">';
	}
?>
Hello !!<?php echo $_SESSION['Account'];?> <p>
<form action="Logout.php"method="POST">
<button type="submit"><span style="font-family:fantasy;">Log out</span></button>
</form>
<div>
<CENTER><h1>Favorite List</h1><BR></CENTER>
<table "border:3px #FFD382 dashed;" cellpadding="10" border='1' width="1200">
<tr>
<td>ID</td>
<td>Occupation</td>
<td>Location</td>
<td>Work Time</td>
<td>Education Required</td>
<td>Minimum of Working Experience</td>
<td>Salary Per Month</td>
<td>Operation</td>
</tr>

<?php 
$db_host= "dbhome.cs.nctu.edu.tw";
$db_name= "chiangmj0306_cs";
$db_user= "chiangmj0306_cs";
$db_password= "asd12345";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);

$sql= "SELECT * FROM `favorite` "."WHERE `user_id`=?";
$sth= $db->prepare($sql);
$sth->execute(array($_SESSION['id']));

while($result= $sth->fetchObject()){
$sql1= "SELECT * FROM `recruit`,`favorite` "."WHERE favorite.recruit_id=recruit.id ";
$sth1= $db->prepare($sql1);
$sth1->execute();

if (!function_exists('o')){
function o($a,$b)
{
	$sql= "SELECT * FROM `occupation`" . "WHERE `id` = ?";
	$sth= $b->prepare($sql);
	$sth->execute(array($a));
	while ($result= $sth->fetchObject()){
	echo "<td>" . $result->occupation . "</td>";
	}
}
}

if (!function_exists('l')){
function l($a,$b)
{
	$sql= "SELECT * FROM `location`" . "WHERE `id` = ?";
	$sth= $b->prepare($sql);
	$sth->execute(array($a));
	while ($result= $sth->fetchObject()){
	echo "<td>" . $result->location . "</td>";
	}
}
}

while($result1= $sth1->fetchObject()) {
if($result->user_id == $result1->user_id && $result->recruit_id == $result1->recruit_id){
echo "<tr>";
echo "<td>" . $result1->id . "</td>";
o($result1->occupation_id,$db);
l($result1->location_id,$db);
echo "<td>" . $result1->working_time . "</td>";
echo "<td>" . $result1->education . "</td>";
echo "<td>" . $result1->experience . "</td>";
echo "<td>" . $result1->salary . "</td>";

echo '
<td><form action="DeleteFavorite.php"method="POST">
<button name="Delete_id" value=' .$result1->id.' type="submit">Delete</button>
</form></td>';

echo "<tr>";
}
}
}
?>
</table>
</div><p>

<form action="UserLogin.php"method="POST">
<button type="submit">Back to Job Vacancy</button>
</form>