<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile = $_POST['mobile'];
    $input_password = $_POST['password'];
    
    $sql = "SELECT * FROM login_system WHERE mobile = '$mobile'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();
        
        if ($user['password'] === $input_password) {

            echo "<p style='color: green;'>Login successful! Welcome " . $user['username'] . ".</p>";
            echo "<p>Your mobile number: " . $user['mobile'] . "</p>";
        } else {

            echo "<p style='color: red;'>Invalid password.</p>";
        }
    } else {

        echo "<p style='color: red;'>No user found with mobile: " . $mobile . "</p>";
    }
    
    echo "<p><a href='index.html'>Try again</a></p>";
}

$conn->close();
?>