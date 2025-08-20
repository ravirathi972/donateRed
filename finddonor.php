<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .btn{
            
            margin-left:47.5%;
           
        }
        table{
            margin-top:2%;
            margin-left:25%;
        }
    </style>
</head>
<body>
    

<?php
session_start();
$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "donatered_db";
$conn = new mysqli($servername, $username, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submit'])) {
    $bloodgroup=$_POST["blood-type"];
    $district=$_POST["city"];
    $sql = "SELECT * FROM registered_users WHERE bloodgroup='$bloodgroup' AND district='$district'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        echo "<h1 style='text-align: center' ><u>Matched Donors</u></h1>";
        echo "<table style='border-collapse: collapse; width: 50%; '>";
        echo "<thead>";
        echo "<tr style='background-color: #343a40; color:white;'>";
        echo "<th style='border: 1px solid black; padding: 18px; text-align: left;'>Name</th>";
        echo "<th style='border: 1px solid black; padding: 18px; text-align: left;'>Blood Group</th>";
        echo "<th style='border: 1px solid black; padding: 18px; text-align: left;'>Gender</th>";
        echo "<th style='border: 1px solid black; padding: 18px; text-align: left;'>Phone</th>";
        echo "<th style='border: 1px solid black; padding: 18px; text-align: left;'>State</th>";
        echo "<th style='border: 1px solid black; padding: 18px; text-align: left;'>Area</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        $count = 0; // initialize count variable
        while($row = mysqli_fetch_assoc($result)) {
            $bg_color = ($count % 2 == 0) ? 'white' : ' #dee2e6';
            echo "<tr style='border: 1px solid black; background-color: $bg_color;'>";
            echo "<td style='border: 1px solid black; padding: 18px;'>" . $row["name"] . "</td>";
            echo "<td style='border: 1px solid black; padding: 18px;'>" . $row["bloodgroup"] . "</td>";
            echo "<td style='border: 1px solid black; padding: 18px;'>" . $row["gender"] . "</td>";
            echo "<td style='border: 1px solid black; padding: 18px;'>" . $row["phone"] . "</td>";
            echo "<td style='border: 1px solid black; padding: 18px;'>" . $row["state"] . "</td>";
            echo "<td style='border: 1px solid black; padding: 18px;'>" . $row["area"] . "</td>";
            //missing row...need to add available or not option
            echo "</tr>";
            $count++; // increment count variable
        }
        echo "</tbody>";
        echo "</table>";
        echo "<br>";
        echo "<br>";
        echo"<h2 style='text-align: center'><u>Note</u></h2><h5 style='text-align: center'>These are the persons who's are willing to Donate Blood. You can contact them directly by the contact informations provided by them.</h5>";
    } else {
        // Handle case where no matching donors were found
        echo '<h1 style="color: red; background-color: black; padding: 400px; border-radius: 5px; text-align: center;">We Are Sorry !!<br>Currently there are no donors available for this blood group</h1>';
    }
}
echo "<br>";

echo '<a href="index.html" >
<button  type="button" class="btn btn-danger">Home</button>
  </a>';

?>
</body>
</html>
