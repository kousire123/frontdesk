<?php
session_start();
include "../config/config.php";

$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inventory</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h2>Inventory Management</h2>
    <table border="1">
        <tr>
            <th>Item Name</th>
            <th>Stock</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row["item_name"] ?></td>
            <td><?= $row["stock"] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
