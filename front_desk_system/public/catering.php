<?php
session_start();
include "../config/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT catering_orders.id, reservations.guest_name, catering_orders.food_item, catering_orders.quantity, catering_orders.status 
        FROM catering_orders 
        JOIN reservations ON catering_orders.reservation_id = reservations.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Catering Orders</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h2>Catering Orders</h2>
    <table border="1">
        <tr>
            <th>Guest Name</th>
            <th>Food Item</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row["guest_name"] ?></td>
            <td><?= $row["food_item"] ?></td>
            <td><?= $row["quantity"] ?></td>
            <td><?= $row["status"] ?></td>
            <td>
                <form method="POST" action="../modules/catering/update_order.php">
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    <select name="status">
                        <option value="Pending" <?= $row["status"] == "Pending" ? "selected" : "" ?>>Pending</option>
                        <option value="In Progress" <?= $row["status"] == "In Progress" ? "selected" : "" ?>>In Progress</option>
                        <option value="Completed" <?= $row["status"] == "Completed" ? "selected" : "" ?>>Completed</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
