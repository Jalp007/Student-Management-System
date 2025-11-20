<?php
session_start();

$cn =mysqli_connect('localhost','root','','student');

if(isset($_POST['submit'])) // Checks the login form is submitted not from.
{	
	$usr=$_POST['username'];
	$pwd=$_POST['password'];

	$check_query="select * from user where username='$usr' and password='$pwd'";
	$record=mysqli_query($cn,$check_query);

	if(mysqli_num_rows($record)>0)
	{
		$_SESSION['username'] = $usr;
		$_SESSION['password'] = $pwd;
		header("Location: http://localhost/operations.php");
		exit();
	}
	else 
	{
        	echo "<div style='color: red; font-weight: bold; position: absolute; top: 20px; left: 20px;'>Invalid username or password!</div>";
        	echo "<form action='index.htm' style='position: absolute; top: 40px; left: 20px;'>";
			echo '<style>
			.buttons
			{
				background-color: #38a2d0;
				font-family: Arial, sans-serif;
				color: white;
				padding: 15px 20px;
				width: 100%; 
				border: none;
				border-radius: 5px;
				font-size: 16px;
				margin: 10px 0;
			}
			.buttons:hover 
			{
				background-color: #2c8fb0;
			}
			</style>';
        	echo "<input type='submit' value='Go Back to Login' style='padding: 10px 20px; margin-top: 10px;' class='buttons'>";
        	echo "</form>";
	}   
}

?>