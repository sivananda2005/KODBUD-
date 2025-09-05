<?php
$host = 'localhost';
$db = 'portfolio';
$user = 'root';
$pass = ''; // change according to your setup

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name     = $_POST['name'] ?? '';
$email    = $_POST['email'] ?? '';
$gender   = $_POST['gender'] ?? '';
$interest = is_array($_POST['interest']) ? implode(",", $_POST['interest']) : $_POST['interest'] ?? '';
$bio      = $_POST['bio'] ?? '';

$sql = "INSERT INTO contacts (name, email, gender, interest, bio) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $email, $gender, $interest, $bio);

if ($stmt->execute()) {
    echo "Thank you! Your data has been saved.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
