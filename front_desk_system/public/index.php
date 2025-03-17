<?php
include "../config/auth.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = login($_POST["username"], $_POST["password"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="login-container">
        <form method="POST">
            <h2>Front Desk Login</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <?php if (isset($message)) echo "<p>$message</p>"; ?>
        </form>
    </div>
</body>
</html>
