<h1>Fill in your resume</h1><p>
<form action="UserSignUp2.php"method="POST">
<b>Account:<input type="text" name="account">&nbsp;&nbsp;&nbsp;
Password:<input type="password" name="password">&nbsp;&nbsp;&nbsp;
Phone:<input type="text" name="phone">&nbsp;&nbsp;&nbsp;
Gender:<select name="gender">
	<option value="male" selected>Male</option>
	<option value="female">Female</option>
</select><br>
Age:<input type="number" min="1" max="100" step="1" value="22" name="age">&nbsp;&nbsp;&nbsp;
Email Address:<input type="text" name="email">&nbsp;&nbsp;&nbsp;
Expected Salary:<input type="number" min="0" max="1000000" step="1000" value="28000" name="salary">&nbsp;&nbsp;&nbsp;
Major Education:<select name="education">
	<option value="Graduate School" selected>Graduate School</option>
	<option value="Undergraduate School">Undergraduate School</option>
	<option value="Senior High School">Senior High School</option>
	<option value="Junior High School">Junior High School</option>
	<option value="Elementary School">Elementary School</option>
</select><br>
<font size="4">What is your specialty?</font><br></b>
<input type="checkbox" value="1" name="Specialty[]"> Accounting&nbsp;&nbsp;&nbsp;
<input type="checkbox" value="2" name="Specialty[]"> Beauty&nbsp;&nbsp;&nbsp;
<input type="checkbox" value="3" name="Specialty[]"> Building & Construction&nbsp;&nbsp;&nbsp;
<input type="checkbox" value="4" name="Specialty[]"> Design&nbsp;&nbsp;&nbsp;
<input type="checkbox" value="5" name="Specialty[]"> Education<br>
<input type="checkbox" value="6" name="Specialty[]"> Finance/Investment&nbsp;&nbsp;&nbsp;
<input type="checkbox" value="7" name="Specialty[]"> Information Technology&nbsp;&nbsp;&nbsp;
<input type="checkbox" value="8" name="Specialty[]"> Insurance&nbsp;&nbsp;&nbsp;
<input type="checkbox" value="9" name="Specialty[]"> Legal Service&nbsp;&nbsp;&nbsp;
<input type="checkbox" value="10" name="Specialty[]"> Medical<br>
<input type="checkbox" value="11" name="Specialty[]"> Shipping&nbsp;&nbsp;&nbsp;
<input type="checkbox" value="12" name="Specialty[]"> Catering
<input type="checkbox" value="13" name="Specialty[]"> None<br>
<button type="submit"><span style="font-family:fantasy;">Submit</span></button>

</form>
