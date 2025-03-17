<?php
include "../../config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $check_in = $_POST["start"];
    $check_out = date("Y-m-d", strtotime($_POST["end"] . " -1 day"));

    $sql = "UPDATE reservations SET check_in = ?, check_out = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $check_in, $check_out, $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
}
?>
