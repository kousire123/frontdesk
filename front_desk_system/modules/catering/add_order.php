<?php
include "../../config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservation_id = $_POST["reservation_id"];
    $food_item = $_POST["food_item"];
    $quantity = $_POST["quantity"];

    $sql = "INSERT INTO catering_orders (reservation_id, food_item, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $reservation_id, $food_item, $quantity);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
}
?>
