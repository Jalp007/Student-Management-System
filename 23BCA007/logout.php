<?php
session_start();
if(isset($_SESSION['username']))
	unset($_SESSION['username']);
if(isset($_SESSION['password']))
	unset($_SESSION['password']);
session_destroy();
header("location: index.htm");
exit();
?>