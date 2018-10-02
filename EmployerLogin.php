<?php session_save_path("session_tmp"); session_start();  ?>
<?php if($_SESSION['Account'] == null || $_SESSION['check']=="user"){
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
<button type="submit" name=search value=1>Search</button>
</form></div>

<table "border:3px #FFD382 dashed;" cellpadding="10" border='1' width="1200">
<tr>
<td>ID</td>
<td>Occupation</td>
<td>Location</td>
<td>Work Time</td>
<td>Education Required</td>
<td>Minimum of Working Experience(years)</td>
<td>Salary Per Month <br>
	<div style="float:left;"><form action="DSC.php"method="POST">
	<button type="submit"  name=sortpage value=1><span style="font-family:fantasy;">High -> Low</span></button>
	</form></div>
	<div style="float:left;"><form action="ASC.php"method="POST">
	<button type="submit"  name=sortpage value=1><span style="font-family:fantasy;">Low -> High</span></button>
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

while($result= $sth->fetchObject()) {
	echo "<tr>";
	echo "<td>" . $result->id . "</td>";
	echo "<td>" . $result->occupation . "</td>";
	echo "<td>" . $result->location . "</td>";
	echo "<td>" . $result->working_time . "</td>";
	echo "<td>" . $result->education . "</td>";
	echo "<td>" . $result->experience . "</td>";
	echo "<td>" . $result->salary . "</td>";
	
	if(find_id($_SESSION['Account'],$db)==$result->employer_id){
	?>
	<td>
	<div style="float:left;">
	<?php
	echo '
	<form action="Edit1.php"method="POST">
	<button name="edit_id" value='.$result->id.' type="submit">Edit</button>

	</form>';?></div>
	<div style="float:left;">
	<?php
	echo '
	<form action="Delete.php"method="POST">
	<button name="delete_id" value='.$result->id.' type="submit">Delete</button>
	
	</form>';?></div>
	</td>
	<?php
	}else{
	echo "<td>&nbsp</td>";
	}
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
	
if (!function_exists('find_id')){
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
if(find_id($_SESSION['Account'],$db)==$result->employer_id){
?>
<td>
<div style="float:left;">
<?php
echo '
<form action="Edit1.php"method="POST">
<button name="edit_id" value='.$result->id.' type="submit">Edit</button>

</form>';?></div>
<div style="float:left;">
<?php
echo '
<form action="Delete.php"method="POST">
<button name="delete_id" value='.$result->id.' type="submit">Delete</button>

</form>';?></div>
</td>
<?php
}else{
echo "<td>&nbsp</td>";
}
echo "</tr>";
}
}
unset($_SESSION['sort']);
?>
<form action="AddJob.php"method="POST">
<tr>
<td></td>
<td><select name="occupation">
	<option value="1" selected>teacher</option>
	<option value="2">sailor</option>
	<option value="3">translator</option>
	<option value="4">tailor</option>
	<option value="5">actor/actress</option></td>
<td><select name="location">
	<option value="1" selected>Taipei</option>
	<option value="2">Taoyuan</option>
	<option value="3">Taichung</option>
	<option value="4">Tainan</option>
	<option value="5">Kaohsiung</option></td>
<td><select name="WorkTime">
	<option value="morning" selected>morning</option>
	<option value="afternoon">afternoon</option>
	<option value="night">night</option></td>
<td><select name="EducationRequired">
	<option value="Graduate School" selected>Graduate School</option>
	<option value="Undergraduate School">Undergraduate School</option>
	<option value="Senior High School">Senior High School</option>
	<option value="Junior High School">Junior High School</option>
	<option value="Elementary School">Elementary School</option></td>
<td><select name="Experience">
	<option value="0" selected>No Experience</option>
	<option value="1">1 years</option>
	<option value="2">2 years</option>
	<option value="3">3 years</option>
	<option value="5">5 years</option>
	<option value="10">10 years</option></td>
<td><input type="number" min="0" max="1000000" step="1000" value="28000" name="salary"></td>
<td><button type="submit">Add a New Job</button></td>
</tr>
</form>
</table>
</div><p>
<div style="float:left;"><form action="UserList.php"method="POST">
<input type="submit" value="Job Seeker List";" style="font-size:15px; width:120px;height:50px";>
</form></div>
<div style="float:left;"><form action="WhoApply.php"method="POST">
<input type="submit" value="Who Applies Your Job";" style="font-size:15px; width:200px;height:50px";>
</form></div>