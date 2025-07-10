<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
            margin-left: auto;
            margin-right: auto;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #333;
            color:#fff;
        }
    </style>
</head>
<body>
<?php
session_start();
$name=$_SESSION['username'];
echo "<h1> Welcome $name!</h1>";

session_destroy();
?>
<?php
// Create connection
$conn = new mysqli('localhost','root','','project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT rating,sugg,dept FROM feedback WHERE fal='$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Department</th><th>Rating</th><th>Suggestion</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["dept"]. "</td><td>" . $row["rating"]. "</td><td>" . $row["sugg"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<h3>Keep Going...</h3> No Feedback Recorded";
}

$conn->close();
?>


</body>
</html>
