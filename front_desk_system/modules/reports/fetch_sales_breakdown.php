<?php
include "../../config/config.php";

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date("Y-m-01");
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date("Y-m-t");

$sql = "SELECT category, SUM(amount) AS total FROM payments WHERE date_paid BETWEEN ? AND ? GROUP BY category";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[$row["category"]] = $row["total"];
}
echo json_encode($data);
?>
