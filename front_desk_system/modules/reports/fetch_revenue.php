<?php
include "../../config/config.php";

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date("Y-m-01");
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date("Y-m-t");

$sql = "SELECT SUM(amount) AS total_revenue FROM payments WHERE date_paid BETWEEN ? AND ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

echo json_encode(["total_revenue" => $result["total_revenue"] ?? 0]);
?>
