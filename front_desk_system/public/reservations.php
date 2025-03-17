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
    <title>Reservations</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
    <h2>Room Reservations</h2>
    <div id="calendar"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var calendarEl = document.getElementById("calendar");
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "dayGridMonth",
                editable: true,
                eventSources: [{
                    url: "../modules/reservations/fetch_events.php",
                    method: "GET",
                    failure: function() {
                        alert("Failed to load events.");
                    }
                }],
                selectable: true,
                select: function(info) {
                    var guestName = prompt("Guest Name:");
                    if (guestName) {
                        $.post("../modules/reservations/add_booking.php", {
                            guest_name: guestName,
                            room_id: 1,
                            check_in: info.startStr,
                            check_out: info.endStr
                        }, function(response) {
                            location.reload();
                        }, "json");
                    }
                },
                eventDrop: function(info) {
                    $.post("../modules/reservations/update_event.php", {
                        id: info.event.id,
                        start: info.event.startStr,
                        end: info.event.endStr
                    }, function(response) {
                        location.reload();
                    }, "json");
                },
                eventClick: function(info) {
                    if (confirm("Delete this reservation?")) {
                        $.post("../modules/reservations/delete_booking.php", {
                            id: info.event.id
                        }, function(response) {
                            location.reload();
                        }, "json");
                    }
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>
