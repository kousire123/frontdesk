<?php
include "../../config/config.php";

$sql = "SELECT reservations.id, rooms.room_number, reservations.guest_name, reservations.check_in, reservations.check_out
        FROM reservations
        JOIN rooms ON reservations.room_id = rooms.id";
$result = $conn->query($sql);

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = [
        "id" => $row["id"],
        "title" => $row["guest_name"] . " - Room " . $row["room_number"],
        "start" => $row["check_in"],
        "end" => date("Y-m-d", strtotime($row["check_out"] . " +1 day"))
    ];
}

echo json_encode($events);
?>
