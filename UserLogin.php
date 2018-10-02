<?php session_save_path("session_tmp"); session_start(); error_reporting(0); ?>
<?php if($_SESSION['Account'] == null || $_SESSION['check']=="Employer"){
		echo '<meta http-equiv="refresh" content="0;url=Homepage.php">';
	}
?>
Hello !!<?php echo $_SESSION['Account'];?> <p>
<form action="Logout.php"method="POST">
<button type="submit"><span style="font-family:fantasy;">Log out</span></button>
</form>
<div>
<CENTER><h1>Job Vacancy</h1><BR></CENTER>

<div style="float:left;"><form action="Search.php"method="POST">
<input type="text"placeholder="Occupation"name="ooccupation">&nbsp;
<input type="text"placeholder="Location"name="llocation">&nbsp;
<input type="text"placeholder="WorkTime"name="wworktime">&nbsp;
<input type="text"placeholder="EducationRequired"name="eeducationrequired">&nbsp;
<input type="text"placeholder="WorkingExperience"name="wworkingexperience">&nbsp;
<select name="ssalary">
	<option value="0" selected>Salary</option>
	<option value="1" >1~20000</option>
	<option value="2">20001~30000</option>
	<option value="3">30001~40000</option>
	<option value="4">40001~50000</option>
	<option value="5">50001~60000</option>
	<option value="6">>60000</option>
</select></div>
<div style="float:left;"><form action="Search.php"method="POST">
<button type="submit" name=search value=2>Search</button>
</form></div>


<table "border:3px #FFD382 dashed;" cellpadding="10" border='1' width="1200">
<tr>
<td>ID</td>
<td>Occupation</td>
<td>Location</td>
<td>Work Time</td>
<td>Education Required</td>
<td>Minimum of Working Experience</td>
<td>Salary Per Month <br>
	<div style="float:left;"><form action="DSC.php"method="POST">
	<button type="submit"  name=sortpage value=2><span style="font-family:fantasy;">High -> Low</span></button>
	</form></div>
	<div style="float:left;"><form action="ASC.php"method="POST">
	<button type="submit"  name=sortpage value=2><span style="font-family:fantasy;">Low -> High</span></button>
</form></div></td>
<td>Operation</td>
</tr>

<?php 
$db_host= "dbhome.cs.nctu.edu.tw";
$db_name= "chiangmj0306_cs";
$db_user= "chiangmj0306_cs";
$db_password= "asd12345";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);

if( $_SESSION['scheck']=="search"){
	if( $_SESSION['sort']=="DESC"){
	$sql= $_SESSION['search']."ORDER BY salary DESC";
	$sth= $db->prepare($sql);
	$sth->execute();
	}else if( $_SESSION['sort']=="ASC"){
	$sql= $_SESSION['search']."ORDER BY salary ASC";
	$sth= $db->prepare($sql);
	$sth->execute();
	}else{
	$sql= $_SESSION['search']."ORDER BY id ASC";
	$sth= $db->prepare($sql);
	$sth->execute();
	}
	function find_id($a,$b,$c)
{
	$sql= "SELECT * FROM `favorite`" . "WHERE `user_id` = ?";
	$sth= $b->prepare($sql);
	$sth->execute(array($a));
	while($result= $sth->fetchObject()){
		if($result->recruit_id == $c)
			return 1;
	}
	return 0;
	}

	function find_ida($a,$b,$c)
	{
	$sql= "SELECT * FROM `application`" . "WHERE `user_id` = ?";
	$sth= $b->prepare($sql);
	$sth->execute(array($a));
	while($result= $sth->fetchObject()){
		if($result->recruit_id == $c)
			return 1;
	}
	return 0;
	}
while($result= $sth->fetchObject()) {
	echo "<tr>";
	echo "<td>" . $result->id . "</td>";
	echo "<td>" . $result->occupation . "</td>";
	echo "<td>" . $result->location . "</td>";
	echo "<td>" . $result->working_time . "</td>";
	echo "<td>" . $result->education . "</td>";
	echo "<td>" . $result->experience . "</td>";
	echo "<td>" . $result->salary . "</td>";
	
	echo '<td> <div style="float:left;">';
	if(find_ida($_SESSION['id'],$db,$result->id)==1){
	echo 'Waiting&nbspfor&nbspemployer';
	}else{
	echo '<form action="Apply.php"method="POST">
	<button name="Apply_id" value='.$result->id.' type="submit">Apply</button>';
	}
	echo '</form></div>';
	echo '&nbsp&nbsp';
	echo '<div style="float:left;">';

	if(find_id($_SESSION['id'],$db,$result->id)==1){
	echo 'Already&nbspin&nbspfavorite&nbsplist';
	}else{
	echo '<form action="Favorite.php"method="POST">
	<button name="Favorite_id" value='.$result->id.' type="submit">Favorite</button>';
	}
	echo '</form></div> </td>';
	echo "</tr>";
	}

}else{
	if( $_SESSION['sort']=="DESC"){
	$sql= "SELECT * FROM `recruit` ORDER BY salary DESC,id ASC";
	$sth= $db->prepare($sql);
	$sth->execute();
	}else if( $_SESSION['sort']=="ASC"){
	$sql= "SELECT * FROM `recruit` ORDER BY salary ASC,id ASC";
	$sth= $db->prepare($sql);
	$sth->execute();
	}else{
	$sql= "SELECT * FROM `recruit` ORDER BY id ASC";
	$sth= $db->prepare($sql);
	$sth->execute();
}

function find_id($a,$b,$c)
{
	$sql= "SELECT * FROM `favorite`" . "WHERE `user_id` = ?";
	$sth= $b->prepare($sql);
	$sth->execute(array($a));
	while($result= $sth->fetchObject()){
		if($result->recruit_id == $c)
			return 1;
	}
	return 0;
}

function find_ida($a,$b,$c)
{
	$sql= "SELECT * FROM `application`" . "WHERE `user_id` = ?";
	$sth= $b->prepare($sql);
	$sth->execute(array($a));
	while($result= $sth->fetchObject()){
		if($result->recruit_id == $c)
			return 1;
	}
	return 0;
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


while($result= $sth->fetchObject()) {
echo "<tr>";
echo "<td>" . $result->id . "</td>";
occupation_id($result->occupation_id,$db);
location_id($result->location_id,$db);
echo "<td>" . $result->working_time . "</td>";
echo "<td>" . $result->education . "</td>";
echo "<td>" . $result->experience . "</td>";
echo "<td>" . $result->salary . "</td>";

echo '<td> <div style="float:left;">';
if(find_ida($_SESSION['id'],$db,$result->id)==1){
	echo 'Waiting&nbspfor&nbspemployer';
}else{
	echo '<form action="Apply.php"method="POST">
	<button name="Apply_id" value='.$result->id.' type="submit">Apply</button>';
}
echo '</form></div>';
echo '&nbsp&nbsp';
echo '<div style="float:left;">';

if(find_id($_SESSION['id'],$db,$result->id)==1){
	echo 'Already&nbspin&nbspfavorite&nbsplist';
}else{
	echo '<form action="Favorite.php"method="POST">
	<button name="Favorite_id" value='.$result->id.' type="submit">Favorite</button>';
}
echo '</form></div> </td>';

echo "<tr>";
}
}
unset($_SESSION['sort']);
?>

</table>
</div><p>
<form action="FavoriteList.php"method="POST">
<input type="submit" value="Favorite List";" style="font-size:15px; width:120px;height:50px";>
</form>