<?php session_save_path("session_tmp"); session_start(); ?>
<?php $_SESSION['sort']="ASC"; 
if($_POST['sortpage']==0){
	echo '<meta http-equiv="refresh" content="0;url=Homepage.php">';
}else if($_POST['sortpage']==1){
	echo '<meta http-equiv="refresh" content="0;url=EmployerLogin.php">';
}else if($_POST['sortpage']==2){
	echo '<meta http-equiv="refresh" content="0;url=UserLogin.php">';
}
?>