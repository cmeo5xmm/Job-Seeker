<?php session_save_path("session_tmp"); session_start(); ?>
Hello !!<?php echo $_SESSION['Account'];?> <p>
<tr></tr>
<div>
<CENTER><h1>Edit Job Vacancy</h1><BR></CENTER>
<table "border:3px #FFD382 dashed;" cellpadding="10" border='1' width="1200">
<tr>
<td>ID</td>
<td>Occupation</td>
<td>Location</td>
<td>Work Time</td>
<td>Education Required</td>
<td>Minimum of Working Experience(years)</td>
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

$edit_id=$_POST['edit_id'];

$sql= "SELECT * FROM `recruit`";
$sth= $db->prepare($sql);
$sth->execute();

/*function find_id($a,$b)
{
	$sql= "SELECT * FROM `employer`" . "WHERE `account` = ?";
	$sth= $b->prepare($sql);
	$sth->execute(array($a));
	while($result= $sth->fetchObject()){
		$employer_id= $result->id;
		return "$result->id";
	}
}
*/
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
	if($edit_id==$result->id)
	{
		echo '
		<form action="Edit2.php"method="POST">
		<tr>
		<td></td>';
		echo '<td><select name="occupation">';
					$sql_occu= "SELECT * FROM `occupation`";
					$sth_occu= $db->prepare($sql_occu);
					$sth_occu->execute();
					while($result_occu=$sth_occu->fetchObject()){
						echo '<option value='.$result_occu->id.'>'.$result_occu->occupation.'</option>';
					}
					echo '</select></td>';
		echo '<td><select name="location">';
					$sql_loca= "SELECT * FROM `location`";
					$sth_loca= $db->prepare($sql_loca);
					$sth_loca->execute();
					while($result_loca=$sth_loca->fetchObject()){
						echo '<option value='.$result_loca->id.'>'.$result_loca->location.'</option>';
					}
					echo '</select></td>';
		echo '
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
		<td>
		<div style="float:left;">

		<button name="edit_id" value='.$result->id.' type="submit">Save</button>
		</form>';
		?>
		</div>
		<div style="float:left;">

		<form action="EmployerLogin.php"method="POST">
		<button type="submit">Cancel</button>
		</form>

		</div>
		</td>
		</tr>
		<?php
	}
	else
	{
		echo "<tr>";
		echo "<td>" . $result->id . "</td>";
		occupation_id($result->occupation_id,$db);
		location_id($result->location_id,$db);
		echo "<td>" . $result->working_time . "</td>";
		echo "<td>" . $result->education . "</td>";
		echo "<td>" . $result->experience . "</td>";
		echo "<td>" . $result->salary . "</td>";
		echo "<td>&nbsp</td>";
		echo "<tr>";
	}

}
?>
</table>
</div><p>
