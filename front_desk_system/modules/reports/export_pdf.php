<?php
require "../../libs/fpdf.php";
include "../../config/config.php";

$start_date = $_GET['start_date'] ?? date("Y-m-01");
$end_date = $_GET['end_date'] ?? date("Y-m-t");

$sql = "SELECT * FROM payments WHERE date_paid BETWEEN ? AND ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial", "B", 16);
$pdf->Cell(190, 10, "Revenue Report ($start_date - $end_date)", 1, 1, "C");

$pdf->SetFont("Arial", "", 12);
$pdf->Cell(50, 10, "Category", 1);
$pdf->Cell(50, 10, "Amount (PHP)", 1);
$pdf->Cell(50, 10, "Payment Method", 1);
$pdf->Cell(40, 10, "Date Paid", 1);
$pdf->Ln();

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(50, 10, $row["category"], 1);
    $pdf->Cell(50, 10, "₱" . number_format($row["amount"], 2), 1);
    $pdf->Cell(50, 10, $row["method"], 1);
    $pdf->Cell(40, 10, $row["date_paid"], 1);
    $pdf->Ln();
}

$pdf->Output();
?>
