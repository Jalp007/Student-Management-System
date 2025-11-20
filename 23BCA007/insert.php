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
$cn1=mysqli_connect("localhost","root","","student");

if($cn1)
{
    if(isset($_SESSION['username']))
    {
    $user=$_SESSION['username'];
    $check_query="select role from user where username='$user'";
    $role=mysqli_query($cn1,$check_query);
    $row=mysqli_fetch_assoc($role);

        if($row['role']!='teacher')
        {
            echo "<div style='color: red; font-weight: bold;'>You can't insert the student data by your own.</div>";
            echo "<form action='index.htm'>";
            echo "<input type='submit' class='buttons' value='Go Back to Login' style='padding: 10px 20px; margin-top: 10px;'>";
            echo "</form>";
        }
        else
        {
            $enrol=$_GET['enrollment'];
            $name=$_GET['name'];
            $div=$_GET['division'];
            $gen=$_GET['gender'];
            $branch=$_GET['branch'];
            $cgpa=$_GET['cgpa'];
            $dob=$_GET['dob'];
            $sem=$_GET['semester'];
            $year=$_GET['year'];

            $check_same_record="select * from student_data_management where enrollment_no='$enrol'";
            $result_of_same_record=mysqli_query($cn1,$check_same_record);
            $num_row_result=mysqli_num_rows($result_of_same_record);
            if($num_row_result>0)
            {
                echo "<div style='color: red; font-weight: bold;'>There is the same record with this enrollment no. $enrol.<br>Please go back to the insert page!!!</div>";
                echo "<form action='insert.htm'>";
                
                echo "<input type='submit' value='Go Back to Insert Page' class='buttons'>";
                echo "</form>";
            }
            else
            {
                $enrol=strtoupper($enrol);
                
                $insert_query="insert into student_data_management (enrollment_no,name,division,gender,branch,cgpa,dob,semester,year) values ('$enrol','$name','$div','$gen','$branch','$cgpa','$dob','$sem','$year')";
                if(mysqli_query($cn1,$insert_query))
                {        
                    header("Location: http://localhost/execution_of_query.php");
                    $_SESSION['value']="insert";
                }
            }
            
        }
    }
    else
    {
        echo "<div style='color: red; font-weight: bold;'>You should to loginn for inserting the data!!!</div>";
        echo "<form action='index.htm'>";
        echo "<input type='submit' class='buttons' value='Go Back to Login' style='padding: 10px 20px; margin-top: 10px;'>";
        echo "</form>";
    }     
}
else 
{
    echo "<div style='color: red; font-weight: bold;'>Connection to student management database failed!!!.</div>";
}
mysqli_close($cn1);
?>