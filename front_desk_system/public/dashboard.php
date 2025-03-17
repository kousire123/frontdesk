<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Welcome to the Front Desk System</h1>
    <nav>
        <a href="reservations.php">Reservations</a>
        <a href="inventory.php">Inventory</a>
        <a href="catering.php">Catering</a>
        <a href="logout.php">Logout</a>
    </nav>
</body>
</html>
