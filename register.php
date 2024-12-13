<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";  // Your database username
$password = "";      // Your database password
$dbname = "registration_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password']; // You should hash this password before storing it
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    // Store form data in session
    $_SESSION['formData'] = [
        'fullName' => $fullName,
        'email' => $email,
        'mobile' => $mobile,
        'dob' => $dob,
        'gender' => $gender,
        'address' => $address,
    ];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, mobile, password, dob, gender, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fullName, $email, $mobile, $password, $dob, $gender, $address);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the result page with success status
        header("Location: result.php?status=success");
        exit();
    } else {
        // Handle errors
        header("Location: result.php?status=error");
        exit();
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
