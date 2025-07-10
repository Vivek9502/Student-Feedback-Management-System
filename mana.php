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
            text-align: center;
        }
        th {
            background-color: #333;
            color:#fff;
        }
        button{
            background-color: #333;
            color:#fff;
            border-radius: 30px;
            padding: 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: #000;
        }
    </style>
</head>
<body>
</body>
</html>
<?php
// Create connection
$conn = new mysqli('localhost','root','','project');

session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT faculty,rating_count FROM management WHERE rating_count>=10";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Faculty</th><th>Rating Count</th><th>Average Ratings (out of 5)</th><th>Most Common Feedback</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["faculty"]. "</td><td>" . $row["rating_count"]. "</td>";
        $column = "rating";
        $faculty=$row['faculty'];
        $avg="SELECT AVG($column) AS 'average_value' FROM feedback WHERE fal='$faculty'";
        $abc = $conn->query($avg);
        $rat = $abc->fetch_assoc();
        $averageValue = $rat['average_value'];
        echo "<td>".number_format($averageValue,2)."</td>";
        $sqll = "SELECT sugg FROM feedback where fal='$faculty'";
        $resultt = $conn->query($sqll);
        $stringCounts = array();
        while ($sug = $resultt->fetch_assoc()) {
        $string = $sug['sugg'];
        if (isset($stringCounts[$string])) {
                $stringCounts[$string]++;
            } 
        else{
                $stringCounts[$string] = 1;
            }
        }
        arsort($stringCounts);
        $mostCommonString = key($stringCounts);
        echo "<td>".$mostCommonString."</td></tr>";
    }


    echo "</table>";
    echo "<script> 
    function result(){
        window.location='result.php';
    }
    </script>";
    } else {
    echo "<h3>Keep Going...</h3> No Feedback Recorded";
}
$conn->close();
?>



