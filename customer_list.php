<?php
// DB connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "kumanayaka_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch customer data
$sql = "SELECT id, first_name, last_name, email, phone, created_at FROM customers ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092');
            background-size: cover;
            background-position: center;
        }
        .table-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 1rem;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-6xl table-container p-8 shadow-lg">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">👥 Registered Customers</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">First Name</th>
                        <th class="px-4 py-3 text-left">Last Name</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Phone</th>
                        <th class="px-4 py-3 text-left">Registered At</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2"><?php echo $row["id"]; ?></td>
                                <td class="px-4 py-2"><?php echo $row["first_name"]; ?></td>
                                <td class="px-4 py-2"><?php echo $row["last_name"]; ?></td>
                                <td class="px-4 py-2"><?php echo $row["email"]; ?></td>
                                <td class="px-4 py-2"><?php echo $row["phone"]; ?></td>
                                <td class="px-4 py-2"><?php echo $row["created_at"]; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">No customers found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>