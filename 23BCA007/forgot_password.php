<?php
session_start();
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
                    text-decoration: none;
                }
                .buttons:hover 
                {
                    background-color: #2c8fb0;
                }
                </style>';

$cn =mysqli_connect('localhost','root','','student');

if(isset($_POST['submit'])) // Checks the login form is submitted not from.
{	
    if(isset($_POST['username']) && isset($_POST['current_password']) && isset($_POST['new_password']))
    {
        $usr=$_POST['username'];
        $curr_pwd=$_POST['current_password'];
        $new_pwd=$_POST['new_password'];

        $check_query="select * from user where username='$usr'";
        $record=mysqli_query($cn,$check_query);

        if(mysqli_num_rows($record)>0)
        {
            $_SESSION['username']=$usr;
            $_SESSION['current_password']=$curr_pwd;
            $_SESSION['new_password']=$new_pwd;

            $update_pwd="update user set password='$new_pwd' where username='$usr'";
            if(mysqli_query($cn,$update_pwd))
            {
                echo "
                    <div class='container'>
                        <div>";
                        echo "<div style='color: green; padding: 5px; font-weight: bold; position: absolute; top: 20px; left: 20px;'>Password changed successfully!!!</div>";        
                        echo "</div>
                    <br><br><br>
                    <a href='index.htm' class='buttons'>Go to Login Page</a>
                </div>";
            }
        }
        else 
        {
                echo "<div style='color: red; font-weight: bold; position: absolute; top: 20px; left: 20px;'>Invalid username or password!</div>";
                echo "<form action='index.htm' style='position: absolute; top: 40px; left: 20px;'>";

                echo "<input type='submit' value='Go Back to Login' style='padding: 10px 20px; margin-top: 10px;' class='buttons'>";
                echo "</form>";
        }
    }   
    else 
    {
        echo "<div style='color: red; font-weight: bold; position: absolute; top: 20px; left: 20px;'>Inputs are not completly filled!!!</div>";
        echo "<form action='forgot_password.htm' style='position: absolute; top: 40px; left: 20px;'>";
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
        echo "<input type='submit' value='Go Back to Change Password' style='padding: 10px 20px; margin-top: 10px;' class='buttons'>";
        echo "</form>";
    }
    mysqli_close($cn);
}

?>