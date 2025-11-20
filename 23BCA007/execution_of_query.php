<?php
session_start();
$cn = mysqli_connect("localhost", "root", "", "student");

if (!$cn) {
    die("Connection failed!!!");
}
if(isset($_SESSION['value']))
{
    $value=$_SESSION['value'];
}
if($value=="insert")
    $value="Insertion is successfully!!";
elseif($value=="update")
    $value="Updation is successfully!!";
else
    $value="Error in the process!!";
?>

<html>
<head>
    <title>Operation Success</title>
    <style>
        body 
        {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }
        .container 
        {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }
        .message1 
        {
            color: green;
            font-size: 20px;
            margin-bottom: 20px;
        }
        .message2 
        {
            color: red;
            font-size: 20px;
            margin-bottom: 20px;
        }
        .button 
        {
            background-color: #38a2d0;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin: 5px;
            width: calc(100% - 12px);
        }
        .button:hover 
        {
            background-color: #338eb6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Operation Status</h2>
            <div>
                <?php 
                    if($value=="Error in the process!!")
                    {
                        echo "<div class='message2'>$value</div>";
                    }
                    else
                    {
                        echo "<div class='message1'>$value</div>";
                    }
                ?>
            </div>
        

        <a href="http://localhost/operations.htm" class="button">Go to Dashboard</a>
        <a href="http://localhost/generate_report_IandU.php" class="button">Generate Report</a>
    </div>
</body>
</html>

<?php
mysqli_close($cn);
?>
