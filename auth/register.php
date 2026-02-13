<?php
session_start();
require_once "../config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // check if email exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        $message = "Email already exists!";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO users (full_name, email, password_hash)
             VALUES (?, ?, ?)"
        );

        if ($stmt->execute([$full_name, $email, $password_hash])) {
            $message = "Registration successful! <a href='login.php'>Login</a>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
<h2>Register</h2>

<form method="POST">
<input type="text" name="full_name" placeholder="Full Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>

<button type="submit">Register</button>
</form>

<p class="message"><?php echo $message; ?></p>

<p>Already have account? <a href="login.php">Login</a></p>
</div>

</body>
</html>
