<?php
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $role = $_POST["role"];  // admin or staff

    $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute(['username' => $username, 'password' => $password, 'role' => $role])) {
        echo "User registered successfully!";
    } else {
        echo "Error registering user.";
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="role">
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
    </select>
    <button type="submit">Register</button>
</form>
