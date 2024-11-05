<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit;
}

if (time() > $_SESSION['expire']) {
    session_destroy();
    header("Location: admin_login.php?timeout=1");
    exit;
}

include 'db.php';

$bookings = [];
$filter = false;
$currentDate = date('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql = "SELECT * FROM book_form WHERE arrivals >= ? AND leaving <= ? AND (status = 'Arriving Soon' OR status = 'Completed' OR status = 'Arrived' OR status = 'Canceled' OR status IS NULL OR status = '')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $bookings = $result->fetch_all(MYSQLI_ASSOC);
    $filter = true;
} else {
    $sql = "SELECT * FROM book_form WHERE status = 'Arriving Soon' OR status = 'Completed' OR status = 'Arrived' OR status = 'Canceled' OR status IS NULL OR status = ''";
    $result = $conn->query($sql);
    $bookings = $result->fetch_all(MYSQLI_ASSOC);
}

foreach ($bookings as &$booking) {
    if (is_null($booking['status']) || $booking['status'] === '') {
        $booking['status'] = 'Pending';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Reports</title>
    <link rel="icon" type="image/png" sizes="32x32" href="assets/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .reports-container {
            padding: 20px;
        }
        .reports-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .reports-form {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        .reports-form input[type="date"] {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .reports-form button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: white;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination button {
            padding: 10px;
            margin: 0 5px;
            border: 1px solid #ddd;
            background-color: #fff;
            cursor: pointer;
        }
        .pagination button.active {
            background-color: #333;
            color: #fff;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            .printableArea, .printableArea * {
                visibility: visible;
            }
            .printableArea {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>
<body>

<?php include 'admin_navbar.php'; ?>

<div class="reports-container">
    <div class="reports-header">
        <h1>Booking Reports</h1>
    </div>
    <div class="reports-form">
        <form action="reports.php" method="post">
            <input type="date" name="start_date" required>
            <input type="date" name="end_date" required>
            <button type="submit">Filter</button>
        </form>
        <button onclick="printTable()" style="margin-left: 20px;">Print</button>
    </div>
    <div>
        <label for="rowsPerPage">Rows per page:</label>
        <select id="rowsPerPage" onchange="updateTable()">
            <option value="5">5</option>
            <option value="10" selected>10</option>
            <option value="15">15</option>
            <option value="20">20</option>
        </select>
    </div>
    <div class="printableArea">
        <table id="bookingsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Location</th>
                    <th>Guests</th>
                    <th>Arrivals</th>
                    <th>Leaving</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Rows will be generated by JavaScript -->
            </tbody>
        </table>
    </div>
    <div class="pagination" id="pagination"></div>
    <?php if (empty($bookings) && $filter): ?>
        <p>No bookings found for the selected dates.</p>
    <?php endif; ?>
</div>

<script>
    function printTable() {
        window.print();
    }

    const bookings = <?php echo json_encode($bookings); ?>;
    let currentPage = 1;
    const rowsPerPageSelect = document.getElementById('rowsPerPage');
    let rowsPerPage = parseInt(rowsPerPageSelect.value);

    function displayTable(page) {
        const table = document.getElementById('bookingsTable').getElementsByTagName('tbody')[0];
        table.innerHTML = '';
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const paginatedBookings = bookings.slice(start, end);

        for (const booking of paginatedBookings) {
            const row = table.insertRow();
            row.innerHTML = `
                <td>${booking.id}</td>
                <td>${booking.name}</td>
                <td>${booking.email}</td>
                <td>${booking.phone}</td>
                <td>${booking.address}</td>
                <td>${booking.location}</td>
                <td>${booking.guests}</td>
                <td>${booking.arrivals}</td>
                <td>${booking.leaving}</td>
                <td>${booking.status}</td>
            `;
        }

        updatePagination();
    }

    function updatePagination() {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';
        const pageCount = Math.ceil(bookings.length / rowsPerPage);

        for (let i = 1; i <= pageCount; i++) {
            const button = document.createElement('button');
            button.textContent = i;
            button.className = i === currentPage ? 'active' : '';
            button.addEventListener('click', () => {
                currentPage = i;
                displayTable(currentPage);
            });
            pagination.appendChild(button);
        }
    }

    function updateTable() {
        rowsPerPage = parseInt(rowsPerPageSelect.value);
        currentPage = 1;
        displayTable(currentPage);
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateTable();
    });
</script>

</body>
</html>
