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
$GLOBALS['query_criteria']="select * from student_data_management where 1=1";
if($cn)
{
    $records_exist=0;
    $GLOBALS['heading']="Student Data By Criteria : ";
    if(isset($_POST['submit']))
    {
        if(isset($_POST['gender']) && $_POST['gender']!="")
        {
            $gender=$_POST['gender'];
            $GLOBALS['query_criteria']=$GLOBALS['query_criteria']." and gender='$gender'";   
            $records_exist+=1;
            $GLOBALS['heading']=$GLOBALS['heading']."Gender:$gender ";
        }

        if(isset($_POST['grade']) && $_POST['grade']!="")
        {
                $grade=$_POST['grade'];

                if($grade=='A')
                {
                    $GLOBALS['query_criteria']=$GLOBALS['query_criteria']." and cgpa>=8";
                }
                elseif($grade=='B')
                {
                    $GLOBALS['query_criteria']=$GLOBALS['query_criteria']." and cgpa>=6 and cgpa<8";
                }
                elseif($grade=='C')
                {
                    $GLOBALS['query_criteria']=$GLOBALS['query_criteria']." and cgpa>=4 and cgpa<6";
                }
                else
                {
                    $GLOBALS['query_criteria']=$GLOBALS['query_criteria']." and cgpa<4";
                }
                $records_exist+=1;
                $GLOBALS['heading']=$GLOBALS['heading']."Grade:$grade ";
        }
        
        if(isset($_POST['internship']) && $_POST['internship']!="")
        { 
                $intern=$_POST['internship'];
                
                for($i=1;$i<7;$i++)
                {
                    if($intern==$i)
                    {
                        $GLOBALS['query_criteria']=$GLOBALS['query_criteria']." and semester=($i+1)";
                    }
                }
                $records_exist+=1;
                $GLOBALS['heading']=$GLOBALS['heading']."Internships:$intern ";
        }

        $records_criteria=mysqli_query($cn,$GLOBALS['query_criteria']);
        $records_exist2=mysqli_num_rows($records_criteria);
        echo "<h2 style='text-align: center; color: #333; font-family: Arial, sans-serif;'>".$GLOBALS['heading']."</h2>";
        echo "<table align='center' border='1' cellspacing='0' cellpadding='5' style='font-family: Arial, sans-serif;'>";
        echo "<tr><td>Enrollment no.</td>";
        echo "<td>Name</td>";
        echo "<td>Division</td>";
        echo "<td>Gender</td>";
        echo "<td>Branch</td>";
        echo "<td>CGPA</td>";
        echo "<td>DOB</td>";
        echo "<td>Semester</td>";
        echo "<td>Year</td></tr>";
        if($records_exist>0)
        {
            while($rows_criteria=mysqli_fetch_row($records_criteria))
            {
                echo "<tr><td>$rows_criteria[1]</td>";
                echo "<td>$rows_criteria[2]</td>";
                echo "<td>$rows_criteria[3]</td>";
                echo "<td>$rows_criteria[4]</td>";
                echo "<td>$rows_criteria[5]</td>";
                echo "<td>$rows_criteria[6]</td>";
                echo "<td>$rows_criteria[7]</td>";
                echo "<td>$rows_criteria[8]</td>";
                echo "<td>$rows_criteria[9]</td></tr>";
            }
        }  
        if($records_exist==0 || $records_exist2==0)
        {
            echo "<tr><td colspan='9' align='center'>There are no records in this cirteria...</td></tr>";
        }  
        echo "</table>";
        echo "<br><br><div style='text-align: center;'>";
        

        echo "<a href='reports.htm' class='buttons'>Go to Generate Report</a>";
        echo "<a href='http://localhost/operations.htm' class='buttons' style='margin-left: 20px;'>Go to Dashboard</a>";
        echo "</div>";
    }
    elseif(isset($_POST['submit2']))
    {
        if(isset($_POST['branch']) && $_POST['branch']!="")
        {
            $branch=$_POST['branch'];
            $GLOBALS['query_criteria']=$GLOBALS['query_criteria']." and branch='$branch'";
            $records_exist+=1;
            $GLOBALS['heading']=$GLOBALS['heading']."Branch:$branch ";
        }

        if(isset($_POST['order']) && $_POST['order']!="")
        {
            $order=$_POST['order'];
            $GLOBALS['query_criteria']=$GLOBALS['query_criteria']." order by name $order";
            $records_exist+=1;
            $GLOBALS['heading']=$GLOBALS['heading']."In Alphabet Order";
        }

        
        $record=mysqli_query($cn,$GLOBALS['query_criteria']);
        $records_exist2 =mysqli_num_rows($record);
        echo "<h2 style='text-align: center; color: #333; font-family: Arial, sans-serif;'>".$GLOBALS['heading']."</h2>";
        echo "<table align='center' border='1' cellspacing='0' cellpadding='5' style='font-family: Arial, sans-serif;'>";
        echo "<tr><td>Enrollment no.</td>";
        echo "<td>Name</td>";
        echo "<td>Division</td>";
        echo "<td>Gender</td>";
        echo "<td>Branch</td>";
        echo "<td>CGPA</td>";
        echo "<td>DOB</td>";
        echo "<td>Semester</td>";
        echo "<td>Year</td></tr>";

        if($records_exist>0)
        {
            while($row=mysqli_fetch_row($record))
            {
                echo "<tr><td>$row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "<td>$row[3]</td>";
                echo "<td>$row[4]</td>";
                echo "<td>$row[5]</td>";
                echo "<td>$row[6]</td>";
                echo "<td>$row[7]</td>";
                echo "<td>$row[8]</td>";
                echo "<td>$row[9]</td></tr>";
            }
        }  
        if($records_exist==0 || $records_exist2==0)
        {
            echo "<tr><td colspan='9' align='center'>There are no records in this cirteria...</td></tr>";
        }  
        echo "</table>";
        echo "<br><br><div style='text-align: center;'>";
        

        echo "<a href='reports.htm' class='buttons'>Go to Generate Report</a>";
        echo "<a href='http://localhost/operations.htm' class='buttons' style='margin-left: 20px;'>Go to Dashboard</a>";
        echo "</div>";

    }
    else
    {
        echo "<div style='color: red; font-weight: bold;'>Please relogin for the further process!!!</div>";
        echo "<form action='index.php'>";
        echo "<input type='submit' value='Go Back to Login' style='padding: 10px 20px; margin-top: 10px;' class='buttons'>";
        echo "</form>";
    }
    
mysqli_close($cn);
}
?>