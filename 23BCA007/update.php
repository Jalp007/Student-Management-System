<html>
<head>
    <title>Update Student Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }
        
        table {
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        td {
            padding: 10px;
        }

        td:first-child {
            text-align: right;
            font-weight: bold;
            padding-right: 15px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            width: auto;
        }

        .submit-button {
            background-color: #38a2d0;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
        }

        .submit-button:hover {
            background-color: #338eb6;
        }

        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <?php
    session_start();
        $cn=mysqli_connect("localhost","root","","student");
        
        if($cn)
        {
            $user=$_SESSION['username'];
            $check_query="select role from user where username='$user'";
            $role=mysqli_query($cn,$check_query);
            $row=mysqli_fetch_assoc($role);
        
            if($row['role']=="student")
            {
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
                            .top-left, .buttons
                            {
                                position: absolute;
                                top: 10px;
                                left: 10px;
                            }
                            </style>';
                echo "<div class='top-left' style='color: red; font-weight: bold;'>You can't insert the student data by your own.</div>";
                echo "<form action='index.htm'>";
                echo "<input type='submit' class='buttons' value='Go Back to Login' style='padding: 10; margin-top: 30px;'>";
                echo "</form>";
                die();
            }
            else
            {


            if(isset($_GET['enrollment']))
            {
                
                $enroll=$_GET['enrollment'];
                $select_record_update="select * from student_data_management where enrollment_no='$enroll'";
                $resulted_record=mysqli_query($cn,$select_record_update);
                $num_row_result=mysqli_num_rows($resulted_record);

                if($num_row_result>0)
                {
                    $resulted_record_in_rows=mysqli_fetch_row($resulted_record);
                    $_SESSION['id']=$resulted_record_in_rows[0];
                    $_SESSION['name']=$resulted_record_in_rows[2];
                    $_SESSION['division']=$resulted_record_in_rows[3];
                    $_SESSION['gender']=$resulted_record_in_rows[4];
                    $_SESSION['branch']=$resulted_record_in_rows[5];
                    $_SESSION['cgpa']=$resulted_record_in_rows[6];
                    $_SESSION['dob']=$resulted_record_in_rows[7];
                    $_SESSION['semester']=$resulted_record_in_rows[8];
                    $_SESSION['year']=$resulted_record_in_rows[9];
                    $execute_update_query="YES";
                }
                else
                {
                    echo "<div style='color: red; font-weight: bold; position: absolute; top: 20px; left: 20px;'>There is an error with this enrollment no. $enroll<br>Please check if it exists or not in database table!!!</div>";
                    echo "<form action='update.htm' style='position: absolute; top: 40px; left: 20px;'>";
                    echo '<style>
                    .buttons
                    {
                        background-color: #38a2d0;
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
                    echo "<br><input type='submit' value='Go Back to Update Page' class='buttons'>";
                    echo "</form>";



                    die();
                }

            }
            }
        }
        else 
        {
            echo "<div style='color: red; font-weight: bold;'>Connection to student management database failed!!!.</div>";
        }

        if(isset($_GET['submit']))
        {
            if($execute_update_query=="YES")
            {
                $name=$_GET['name'];
                $div=$_GET['division'];
                $gen=$_GET['gender'];
                $branch=$_GET['branch'];
                $cgpa=$_GET['cgpa'];
                $dob=$_GET['dob'];
                $sem=$_GET['semester'];
                $year=$_GET['year'];
                $update_query="update student_data_management set name='$name', division='$div', gender='$gen', branch='$branch', cgpa='$cgpa', dob='$dob', semester='$sem', year='$year' where enrollment_no='$enroll'";
                if(mysqli_query($cn,$update_query))
                {
                    unset($_SESSION['id']);
                    unset($_SESSION['name']);
                    unset($_SESSION['division']);
                    unset($_SESSION['gender']);
                    unset($_SESSION['branch']);
                    unset($_SESSION['cgpa']);
                    unset($_SESSION['password']);
                    unset($_SESSION['dob']);
                    unset($_SESSION['semester']);
                    unset($_SESSION['year']);
                    $_SESSION['value']="update";
                    header("Location: http://localhost/execution_of_query.php");
                    exit();
                }
                }
            }

        mysqli_close($cn);

        ?>




    <form action="http://localhost/update.php" method="GET">
        <table>
            <tr>
                <td colspan="2">
                    <h2>Update Student Data</h2>
                </td>
            </tr>
            <tr>
                <td>Enrollment No.</td>
                <td><input type="text" id="enrollment" name="enrollment" value="<?php echo $enroll; ?>" placeholder="Enter Enrollment No." readonly></td>
            </tr>
    
            <tr>
                <td>Name</td>
                <td><input type="text" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" placeholder="Enter Student Name" required></td>
            </tr>
    
            <tr>
                <td>Division</td>
                <td><input type="text" id="division" name="division" value="<?php echo $_SESSION['division']; ?>" placeholder="Enter Division" required></td>
            </tr>
    
            <tr>
                <td>Gender</td>
                <td>
                    <label><input type="radio" name="gender" value="Male" <?php if($_SESSION['gender']=='Male') echo 'checked'?> required> Male</label>
                    <label><input type="radio" name="gender" value="Female" <?php if($_SESSION['gender']=='Female') echo 'checked'?> required> Female</label>
                </td>
            </tr>
    
            <tr>
                <td>Branch</td>
                <td>
                    <select id="branch" name="branch" required>
                        <option value="" disabled selected>Select Branch</option>
                        <option value="Computer Science" <?php if($_SESSION['branch']=='Computer Science') echo 'selected'?>>Computer Science</option>
                        <option value="Computer Applications" <?php if($_SESSION['branch']=='Computer Applications') echo 'selected'?>>Computer Applications</option>
                        <option value="Chemicals" <?php if($_SESSION['branch']=='Chemicals') echo 'selected'?>>Chemicals</option>
                        <option value="Fire and Safety" <?php if($_SESSION['branch']=='Fire and Safety') echo 'selected'?>>Fire and Safety</option>
                        <option value="Business Analytics" <?php if($_SESSION['branch']=='Business Analytics') echo 'selected'?>>Business Analytics</option>
                    </select>
                </td>
            </tr>
    
            <tr>
                <td>CGPA</td>
                <td><input type="text" id="cgpa" name="cgpa" value="<?php echo $_SESSION['cgpa']; ?>" placeholder="Enter CGPA" required></td>
            </tr>
    
            <tr>
                <td>Date of Birth</td>
                <td><input type="date" id="dob" name="dob" value="<?php echo $_SESSION['dob']; ?>" required></td>
            </tr>
    
            <tr>
                <td>Semester</td>
                <td>
                    <select id="semester" name="semester" required>
                        <option value="" disabled selected>Select Semester</option>
                        <option value="1" <?php if($_SESSION['semester']=='1') echo 'selected'?>>1st</option>
                        <option value="2" <?php if($_SESSION['semester']=='2') echo 'selected'?>>2nd</option>
                        <option value="3" <?php if($_SESSION['semester']=='3') echo 'selected'?>>3rd</option>
                        <option value="4" <?php if($_SESSION['semester']=='4') echo 'selected'?>>4th</option>
                        <option value="5" <?php if($_SESSION['semester']=='5') echo 'selected'?>>5th</option>
                        <option value="6" <?php if($_SESSION['semester']=='6') echo 'selected'?>>6th</option>
                        <option value="7" <?php if($_SESSION['semester']=='7') echo 'selected'?>>7th</option>
                        <option value="8" <?php if($_SESSION['semester']=='8') echo 'selected'?>>8th</option>
                    </select>    
                </td>
            </tr>
    
            <tr>
                <td>Year</td>
                <td>
                    <select id="year" name="year" required>
                        <option value="" disabled selected>Select Year</option>
                        <option value="1" <?php if($_SESSION['year']=='1') echo 'selected'?>>1st Year</option>
                        <option value="2" <?php if($_SESSION['year']=='2') echo 'selected'?>>2nd Year</option>
                        <option value="3" <?php if($_SESSION['year']=='3') echo 'selected'?>>3rd Year</option>
                        <option value="4" <?php if($_SESSION['year']=='4') echo 'selected'?>>4th Year</option>
                    </select>
                </td>
            </tr>
    
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Submit" class="submit-button">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
