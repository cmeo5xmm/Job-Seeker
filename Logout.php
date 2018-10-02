<?php session_save_path("session_tmp"); session_start();
session_destroy();
echo '<meta http-equiv="refresh" content="0;url=Homepage.php">'; 
?>
