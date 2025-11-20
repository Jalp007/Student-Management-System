<?php
session_start();
echo '<style>
			.buttons
			{
				background-color: #38a2d0;
                font-family: Arial, sans-serif;
				color: white;
				padding: 15px 20px;
				width: 13%; 
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
if(isset($_SESSION['username']) && isset($_SESSION['password']))
{
    $cn=mysqli_connect("localhost","root","","student");
    if($cn)
    {
        $usr=$_SESSION['username'];
        $pwd=$_SESSION['password'];
        $check="select * from user where username='$usr' AND password='$pwd'";
        $result=mysqli_query($cn, $check);
        $n=mysqli_num_rows($result);

        if($n>0) 
        {
            header("Location: operations.htm");
            exit();
        } 
        else
        {
            echo "<div style='color: red; font-weight: bold;'>Please relogin for the further process!!!</div>";
            echo "<form action='index.php'>";
            echo "<input type='submit' value='Go Back to Login' style='padding: 10px 20px; margin-top: 10px;' class='buttons'>";
            echo "</form>";
        }
    }
    else
    {
        echo "<div style='color: red; font-weight: bold;'>Connection to student management database failed!!!</div>";
        echo "<form action='index.php'>";
        echo "<input type='submit' value='Go Back to Login' style='padding: 10px 20px; margin-top: 10px;' class='buttons'>";
        echo "</form>";
    }
}
else
{
    echo "<div style='color: red; font-weight: bold;'>Please relogin for the further process!!!</div>";
    echo "<form action='index.php'>";
    echo "<input type='submit' value='Go Back to Login' style='padding: 10px 20px; margin-top: 10px;' class='buttons'>";
    echo "</form>";
}

?>