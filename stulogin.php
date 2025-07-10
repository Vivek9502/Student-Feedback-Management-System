<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Rating</title>
    <link rel="stylesheet" href="stulogin.css">
</head>
<body>
    <div class="container">
        <h2>Faculty Rating</h2>
        <form id="rating-form" action="stulogin.php" method="post">
            <div class="input-group">
                <label for="dept">Enter your Department :</label>
                <select name="dept" id="dept" onchange="updateDropdown()">
                    <option value="IT">IT</option>
                    <option value="CSE">CSE</option>
                    <option value="ECE">ECE</option>
                    <option value="EEE">EEE</option>
                    <br><br>
                </select>
                <label for="output">Select Faculty:</label>
                <select id="output" name="fal"></select>
                <script>
                    function updateDropdown(){
                        const selection = document.getElementById('dept');
                        const output = document.getElementById("output");
                        
                        output.innerHTML = "";
                        const Value = selection.value;

                        if (Value == "IT") {
                            output.innerHTML += '<option value="faculty1">Faculty 1</option>';
                            output.innerHTML += '<option value="faculty2">Faculty 2</option>';
                            }
                        else if (Value == "CSE") {
                            output.innerHTML += '<option value="faculty3">Faculty 3</option>';
                            output.innerHTML += '<option value="faculty4">Faculty 4</option>';
                        } 
                        else if (Value == "ECE") {
                            output.innerHTML += '<option value="faculty5">Faculty 5</option>';
                            }
                            else if (Value == "EEE") {
                            output.innerHTML += '<option value="faculty6">Faculty 6</option>';
                            }
                            
                    }
                    window.onload = updateDropdown;
                    

                </script>
            </div>
            <div class="input-group">
                <label for="rating">Rating (out of 5):</label>
                <input type="number" id="rating" name="rating" min="1" max="5" required>
            </div>
            <div id="message"></div>
    <label for="sugg">Enter Suggestion:</label>
    <input type="textbox" id="sugg" name="sugg">
    
 <br>
 <br>
            <button type="submit" name="sub" >Submit Rating</button>
            
            </div>   
        </form>
    </div>
    
</body>
</html>

<?php
$conn = mysqli_connect("localhost","root","");
if(isset($_POST["sub"])){
    session_start();
    $rollno=$_SESSION['rollno'];
    $dept=$_POST['dept'];
    $fal=$_POST['fal'];
    $rating=$_POST['rating'];
    $sugg=$_POST['sugg'];
    $insertQuery="INSERT INTO project.feedback(rollno,dept,fal,rating,sugg) VALUES ('$rollno','$dept','$fal','$rating','$sugg')";
    if($rating<=3){
        $search="SELECT * from project.management where faculty='$fal'";
        $result=$conn->query($search);
        if($result->num_rows==0){
            $insert="INSERT INTO project.management(faculty,rating_count) VALUES ('$fal',1)";
            $conn->query($insert);
        }
        else{
            $previous="SELECT * FROM project.management WHERE faculty='$fal'";
            $result=mysqli_query($conn,$previous);
            while($row=mysqli_fetch_assoc($result)){
                $resultPassword=$row['rating_count'];
            $res="UPDATE project.management SET project.management.rating_count=$resultPassword+1 where faculty='$fal'";
            $conn->query($res);
        }
    }

    }
    if($conn->query($insertQuery)==TRUE){
        echo "<script>
        alert('Feedback Submitted!')
        window.location.href='index.html';
        </script>";
    }
    session_destroy();
}   
?>