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

// Fetch all bookings
$sql = "SELECT * FROM book_form";
$result = $conn->query($sql);
$bookings = [];
$currentDate = date('Y-m-d');

while ($row = $result->fetch_assoc()) {
    if ($row['arrivals'] === $currentDate && $row['status'] === 'Confirmed') {
        $row['status'] = 'Arrived';
        // Update status in the database
        $updateSql = "UPDATE book_form SET status='Arrived' WHERE id=" . $row['id'];
        $conn->query($updateSql);
    } elseif ($row['arrivals'] === date('Y-m-d', strtotime($currentDate . ' +1 day')) && $row['status'] === 'Confirmed') {
        $row['status'] = 'Arriving Soon';
        // Update status in the database
        $updateSql = "UPDATE book_form SET status='Arriving Soon' WHERE id=" . $row['id'];
        $conn->query($updateSql);

        // Insert notification for Arriving Soon status
        $notificationSql = "INSERT INTO notifications (booking_id, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($notificationSql);
        $message = "Booking ID " . $row['id'] . " is arriving soon.";
        $stmt->bind_param("iss", $row['id'], $row['email'], $message);
        $stmt->execute();
    } elseif ($row['arrivals'] === $currentDate && $row['status'] === 'Pending') {
        // Cancel booking and add notification
        $updateSql = "UPDATE book_form SET status='Cancelled' WHERE id=" . $row['id'];
        $conn->query($updateSql);

        $notificationSql = "INSERT INTO notifications (booking_id, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($notificationSql);
        $message = "Booking ID " . $row['id'] . " has been automatically cancelled.";
        $stmt->bind_param("iss", $row['id'], $row['email'], $message);
        $stmt->execute();
    } elseif (is_null($row['status']) || $row['status'] === '') {
        $row['status'] = 'Pending';
    }
    $bookings[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .search-bar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .search-bar {
            position: relative;
            width: 100%;
            max-width: 400px;
        }
        .search-bar input {
            width: 100%;
            padding: 10px 40px 10px 10px;
            border-radius: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .search-bar i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        .rows-per-page {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .rows-per-page select {
            margin-left: 10px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .table-wrapper {
            position: relative;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
            white-space: nowrap; /* Ensure single line display */
        }
        th {
            background-color: #f2f2f2;
        }
        th:first-child, td:first-child,
        th:last-child, td:last-child {
            position: sticky;
            background: #f2f2f2;
            z-index: 2;
        }
        th:first-child, td:first-child {
            left: 0;
        }
        th:last-child, td:last-child {
            right: 0;
        }
        .status-tag {
            padding: 5px 10px;
            border-radius: 3px;
            color: white;
            text-align: center;
            white-space: nowrap; /* Ensure single line display */
        }
        .Pending { background-color: #f0ad4e; }
        .Confirmed { background-color: #5bc0de; }
        .Cancelled { background-color: #d9534f; }
        .Arriving-Soon { background-color: #5cb85c; }
        .Arrived { background-color: #0275d8; }
        .Completed { background-color: #5cb85c; }
        .form-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .pagination {
            display: flex;
            justify-content: center;
        }
        .pagination button {
            margin: 0 5px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            background-color: #fff;
            cursor: pointer;
        }
        .pagination button.active {
            background-color: #6a11cb;
            color: #fff;
        }
    </style>
</head>
<body>

<?php include 'admin_navbar.php'; ?>

<div class="container">
    <div class="dashboard-header">
        <h1>Bookings</h1>
        <p>Manage all bookings from here.</p>
    </div>
    <div class="search-bar-container">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search bookings...">
            <i class="fas fa-search"></i>
        </div>
        <div class="rows-per-page">
            <label for="rowsPerPage">Rows per page:</label>
            <select id="rowsPerPage" class="form-control">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select>
        </div>
    </div>
    <div class="table-wrapper">
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Rows will be generated by JavaScript -->
            </tbody>
        </table>
    </div>
    <div class="pagination" id="pagination"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rowsPerPageSelect = document.getElementById('rowsPerPage');
        const table = document.getElementById('bookingsTable').getElementsByTagName('tbody')[0];
        const pagination = document.getElementById('pagination');
        const searchInput = document.getElementById('searchInput');

        let currentPage = 1;
        let rowsPerPage = parseInt(rowsPerPageSelect.value);
        let filteredBookings = <?php echo json_encode($bookings); ?>;

        function displayTable(page) {
            table.innerHTML = '';
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedBookings = filteredBookings.slice(start, end);

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
                    <td><span class="status-tag ${booking.status.replace(' ', '-')}">${booking.status}</span></td>
                    <td>
                        <form action="update_booking.php" method="post" class="form-container">
                            <input type="hidden" name="booking_id" value="${booking.id}">
                            <select name="status" class="form-control" ${['Arriving Soon', 'Arrived'].includes(booking.status) ? 'disabled' : ''}>
                                ${getStatusOptions(booking.status)}
                            </select>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </td>
                `;
            }

            updatePagination();
        }

        function getStatusOptions(status) {
            switch(status) {
                case 'Pending':
                    return `
                        <option value="Pending" selected>Pending</option>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Cancelled">Cancelled</option>
                    `;
                case 'Confirmed':
                    return `
                        <option value="Completed">Completed</option>
                    `;
                case 'Arriving Soon':
                case 'Arrived':
                    return `
                        <option value="Completed">Completed</option>
                    `;
                case 'Completed':
                    return `
                        <option value="Completed" selected>Completed</option>
                    `;
                default:
                    return `
                        <option value="Pending">Pending</option>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Completed">Completed</option>
                    `;
            }
        }

        function updatePagination() {
            pagination.innerHTML = '';
            const pageCount = Math.ceil(filteredBookings.length / rowsPerPage);

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

        rowsPerPageSelect.addEventListener('change', function() {
            rowsPerPage = parseInt(this.value);
            currentPage = 1;
            displayTable(currentPage);
        });

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            filteredBookings = <?php echo json_encode($bookings); ?>.filter(booking => 
                booking.name.toLowerCase().includes(query) ||
                booking.email.toLowerCase().includes(query) ||
                booking.phone.toLowerCase().includes(query) ||
                booking.address.toLowerCase().includes(query) ||
                booking.location.toLowerCase().includes(query)
            );
            currentPage = 1;
            displayTable(currentPage);
        });

        displayTable(currentPage);
    });
</script>

</body>
</html>
