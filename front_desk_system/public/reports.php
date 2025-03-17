<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reports & Analytics</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
    <h2>Revenue Reports</h2>

    <form id="filter-form">
        <label>Start Date:</label>
        <input type="date" id="start_date" name="start_date" value="<?= date("Y-m-01") ?>">
        <label>End Date:</label>
        <input type="date" id="end_date" name="end_date" value="<?= date("Y-m-t") ?>">
        <button type="submit">Filter</button>
    </form>

    <h3>Total Revenue: ₱<span id="total-revenue">0.00</span></h3>
    <canvas id="revenueChart"></canvas>

    <script>
        function fetchRevenue(start_date, end_date) {
            $.get("../modules/reports/fetch_revenue.php", { start_date, end_date }, function(data) {
                $("#total-revenue").text(data.total_revenue);

                revenueChart.data.datasets[0].data = [data.total_revenue];
                revenueChart.update();
            }, "json");
        }

        document.getElementById("filter-form").addEventListener("submit", function(event) {
            event.preventDefault();
            fetchRevenue($("#start_date").val(), $("#end_date").val());
        });

        var ctx = document.getElementById("revenueChart").getContext("2d");
        var revenueChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Total Revenue"],
                datasets: [{ label: "Revenue (PHP)", backgroundColor: "#ffcc00", data: [0] }]
            }
        });

        fetchRevenue("<?= date("Y-m-01") ?>", "<?= date("Y-m-t") ?>");
        
        <h3>Revenue Breakdown</h3>
<canvas id="salesBreakdownChart"></canvas>

<script>
function fetchSalesBreakdown(start_date, end_date) {
    $.get("../modules/reports/fetch_sales_breakdown.php", { start_date, end_date }, function(data) {
        salesBreakdownChart.data.datasets[0].data = [
            data.Room || 0,
            data.Catering || 0
        ];
        salesBreakdownChart.update();
    }, "json");
}

var salesCtx = document.getElementById("salesBreakdownChart").getContext("2d");
var salesBreakdownChart = new Chart(salesCtx, {
    type: "pie",
    data: {
        labels: ["Room Bookings", "Catering"],
        datasets: [{
            backgroundColor: ["#ffcc00", "#66cc66"],
            data: [0, 0]
        }]
    }
});

fetchSalesBreakdown("<?= date("Y-m-01") ?>", "<?= date("Y-m-t") ?>");
</script>

    </script>
</body>
</html>
<form action="../modules/reports/export_pdf.php" method="GET">
    <input type="hidden" name="start_date" value="<?= date("Y-m-01") ?>">
    <input type="hidden" name="end_date" value="<?= date("Y-m-t") ?>">
    <button type="submit">Export as PDF</button>
</form>

<form action="../modules/reports/export_excel.php" method="GET">
    <input type="hidden" name="start_date" value="<?= date("Y-m-01") ?>">
    <input type="hidden" name="end_date" value="<?= date("Y-m-t") ?>">
    <button type="submit">Export as Excel</button>
</form>
