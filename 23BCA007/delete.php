<?php
session_start();
echo '<style>
        .buttons
        {
            background-color: #38a2d0;
            font-family: Arial, sans-serif;
            color: white;
            padding: 15px 20px;
            width: 15%; 
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


$cn=mysqli_connect("localhost","root","","student");

if($cn)
{
    $user=$_SESSION['username'];
    $check_query="select role from user where username='$user'";
    $role=mysqli_query($cn,$check_query);
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
        echo "<h2 style='text-align: center; color: #333; font-family: Arial, sans-serif;'>Delete Student Data</h2>";
        if(isset($_POST['delete']) && isset($_POST['selected_id']))
        {
            $all_id=$_POST['selected_id'];

            $end=count($all_id);
            for($i=0;$i<$end;$i++)
            {
                $each_id=$all_id[$i];
                $delete_query="delete from student_data_management where id='$each_id'";
                mysqli_query($cn,$delete_query);
            }
            echo "<div style='color: green; text-align: center;'>Selected records deleted successfully!</div>";
        }
        if(isset($_POST['dashboard']))
        {
            header("location: operations.htm");
            exit();
        }

        $query1="select * from student_data_management";
        $result=mysqli_query($cn,$query1);

        echo "<form method='post' action=''>";
        echo "<table align='center' border='1' cellspacing='0' cellpadding='5' style='font-family: Arial, sans-serif;'><tr>";
        echo "<td>Select</td>";
        echo "<td>ID</td>";
        echo "<td>Enrollment no.</td>";
        echo "<td>Name</td>";
        echo "<td>Division</td>";
        echo "<td>Gender</td>";
        echo "<td>Branch</td>";
        echo "<td>CGPA</td>";
        echo "<td>DOB</td>";
        echo "<td>Semester</td>";
        echo "<td>Year</td></tr>";
        while($rows=mysqli_fetch_row($result))
        {
            echo "<tr><td><input type='checkbox' name='selected_id[]' value='$rows[0]'></td>";
            echo "<td>$rows[0]</td>";
            echo "<td>$rows[1]</td>";
            echo "<td>$rows[2]</td>";
            echo "<td>$rows[3]</td>";
            echo "<td>$rows[4]</td>";
            echo "<td>$rows[5]</td>";
            echo "<td>$rows[6]</td>";
            echo "<td>$rows[7]</td>";
            echo "<td>$rows[8]</td>";
            echo "<td>$rows[9]</td></tr>";
        }
        echo "</table>";
        echo "<br><div style='text-align: center;'>";

        echo "<input type='submit' name='delete' value='Delete Selected Records' class='buttons'>";
        echo "<input type='submit' name='dashboard' value='Go to Dashboard' class='buttons' style='margin-left: 20px;'>";
        echo "</div>";
    }
}
else 
{
    echo "<div style='color: red; font-weight: bold;'>Connection to student management database failed!!!.</div>";
}
mysqli_close($cn);
?>