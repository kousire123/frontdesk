composer require phpoffice/phpspreadsheet

<?php
require "../../vendor/autoload.php";
include "../../config/config.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$start_date = $_GET['start_date'] ?? date("Y-m-01");
$end_date = $_GET['end_date'] ?? date("Y-m-t");

$sql = "SELECT * FROM payments WHERE date_paid BETWEEN ? AND ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue("A1", "Category");
$sheet->setCellValue("B1", "Amount (PHP)");
$sheet->setCellValue("C1", "Payment Method");
$sheet->setCellValue("D1", "Date Paid");

$rowIndex = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue("A" . $rowIndex, $row["category"]);
    $sheet->setCellValue("B" . $rowIndex, $row["amount"]);
    $sheet->setCellValue("C" . $rowIndex, $row["method"]);
    $sheet->setCellValue("D" . $rowIndex, $row["date_paid"]);
    $rowIndex++;
}

$writer = new Xlsx($spreadsheet);
$filename = "Revenue_Report.xlsx";

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=\"$filename\"");
$writer->save("php://output");
?>
