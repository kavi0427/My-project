<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = ""; // Update if your MySQL has a password
$dbname = "kumanayaka_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reservations
$sql = "SELECT * FROM reservations ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation List - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .backdrop {
            background-color: rgba(255, 255, 255, 0.95);
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="backdrop p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">📅 Reservation List</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-800 text-white text-sm">
                        <th class="py-3 px-4 text-left">#</th>
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Phone</th>
                        <th class="py-3 px-4 text-left">Date</th>
                        <th class="py-3 px-4 text-left">Time</th>
                        <th class="py-3 px-4 text-left">Guests</th>
                        <th class="py-3 px-4 text-left">Occasion</th>
                        <th class="py-3 px-4 text-left">Message</th>
                        <th class="py-3 px-4 text-left">Created</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-2 px-4"><?php echo $row['id']; ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td class="py-2 px-4"><?php echo $row['date']; ?></td>
                                <td class="py-2 px-4"><?php echo $row['time']; ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['guests']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['occasion']); ?></td>
                                <td class="py-2 px-4 max-w-xs truncate"><?php echo htmlspecialchars($row['message']); ?></td>
                                <td class="py-2 px-4 text-xs text-gray-500"><?php echo $row['created_at']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="py-4 px-4 text-center text-gray-500">No reservations found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>