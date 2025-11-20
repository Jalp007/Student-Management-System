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
                text-decoration: none;
			}
			.buttons:hover 
			{
				background-color: #2c8fb0;
			}
			</style>';
$cn=mysqli_connect("localhost","root","","student");
if($cn)
{
    echo "<h2 style='text-align: center; color: #333; font-family: Arial, sans-serif;'>Students Data</h2>";
    
    $selection_query="select * from student_data_management";
    $all_records=mysqli_query($cn,$selection_query);

    echo "<table align='center' border='1' cellspacing='0' cellpadding='5' style='font-family: Arial, sans-serif;'><tr>";
    echo "<td>Enrollment no.</td>";
    echo "<td>Name</td>";
    echo "<td>Division</td>";
    echo "<td>Gender</td>";
    echo "<td>Branch</td>";
    echo "<td>CGPA</td>";
    echo "<td>DOB</td>";
    echo "<td>Semester</td>";
    echo "<td>Year</td></tr>";

    while($rows=mysqli_fetch_row($all_records))
    {
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
    echo "<br><br><div style='text-align: center;'>";

    echo "<a href='reports.htm' class='buttons'>Go to Generate Report</a>";
    echo "<a href='http://localhost/operations.htm' class='buttons' style='margin-left: 20px;'>Go to Dashboard</a>";
    echo "</div>";

    mysqli_close($cn);
}

?>