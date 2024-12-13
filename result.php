<?php
session_start(); // Start the session

$status = $_GET['status'] ?? 'error'; // Default to 'error' if no status is provided

// Retrieve form data from session
$formData = $_SESSION['formData'] ?? null;
if (!$formData) {
    header("Location: registration.html");  // If no form data is available, redirect to the form
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status</title>
    <script>
        // Redirect after 10 seconds
        setTimeout(function() {
            window.location.href = "registration.html";  // Redirect to the registration form
        }, 10000);
    </script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            text-align: center;
            width: 100%;
        }

        h2 {
            color: #2d3e50;
            margin-bottom: 20px;
            font-size: 24px;
        }

        h3 {
            color: #3c4a5a;
            margin-top: 20px;
            font-size: 20px;
        }

        p {
            font-size: 16px;
            color: #666;
            margin-top: 10px;
            line-height: 1.6;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
            text-align: left;
        }

        ul li {
            font-size: 16px;
            color: #333;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        ul li strong {
            color: #2d3e50;
        }

        .status-message {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .status-message.success {
            border-left: 5px solid #28a745;
            color: #28a745;
        }

        .status-message.error {
            border-left: 5px solid #dc3545;
            color: #dc3545;
        }

        .status-message h3 {
            margin: 0;
            font-size: 18px;
        }

        .status-message p {
            margin: 10px 0 0;
        }

        .redirect {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }

        .redirect a {
            color: #4CAF50;
            text-decoration: none;
        }

        .redirect a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="container">
    <?php if ($status == 'success'): ?>
        <div class="status-message success">
            <h3>Registration Successful!</h3>
            <p>Your registration was successful. You will be redirected back to the registration form in 10 seconds.</p>
        </div>
    <?php else: ?>
        <div class="status-message error">
            <h3>Registration Failed!</h3>
            <p>There was an issue with your registration. You will be redirected back to the form in 10 seconds.</p>
        </div>
    <?php endif; ?>

    <h3>Entered Details:</h3>
    <ul>
        <li><strong>Full Name:</strong> <?= htmlspecialchars($formData['fullName']) ?></li>
        <li><strong>Email:</strong> <?= htmlspecialchars($formData['email']) ?></li>
        <li><strong>Mobile:</strong> <?= htmlspecialchars($formData['mobile']) ?></li>
        <li><strong>Date of Birth:</strong> <?= htmlspecialchars($formData['dob']) ?></li>
        <li><strong>Gender:</strong> <?= htmlspecialchars($formData['gender']) ?></li>
        <li><strong>Address:</strong> <?= nl2br(htmlspecialchars($formData['address'])) ?></li>
    </ul>

    <div class="redirect">
        <p>If you are not redirected automatically, click <a href="registration.html">here</a>.</p>
    </div>
</div>

</body>
</html>

<?php
// Clear the session after displaying the data
unset($_SESSION['formData']);
?>
