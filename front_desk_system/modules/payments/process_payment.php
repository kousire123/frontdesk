<?php
include "../../config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservation_id = $_POST["reservation_id"];
    $amount = $_POST["amount"];
    $method = $_POST["method"];

    $sql = "INSERT INTO payments (reservation_id, amount, method) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $reservation_id, $amount, $method);

    if ($stmt->execute()) {
        echo "Payment successful!";
    } else {
        echo "Payment failed!";
    }
}
?>
