<?php
include "../../config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST["room_id"];
    $guest_name = $_POST["guest_name"];
    $check_in = $_POST["check_in"];
    $check_out = $_POST["check_out"];

    $sql = "INSERT INTO reservations (room_id, guest_name, check_in, check_out) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $room_id, $guest_name, $check_in, $check_out);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
}
?>
