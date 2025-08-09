<?php
// DB connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "kumanayaka_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get item ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = null;

// If form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = $conn->real_escape_string($_POST['item_name']);
    $quantity = (int)$_POST['quantity'];

    $update = "UPDATE inventory SET item_name='$item_name', quantity=$quantity WHERE id=$id";
    if ($conn->query($update)) {
        header("Location: inventory_dashboard.php"); // Redirect after update
        exit;
    } else {
        $error = "Error updating record: " . $conn->error;
    }
}

// Fetch current data
$sql = "SELECT * FROM inventory WHERE id = $id";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $item = $result->fetch_assoc();
} else {
    die("Item not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Inventory Item</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">✏️ Edit Inventory Item</h2>

        <?php if (isset($error)): ?>
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Item Name</label>
                <input type="text" name="item_name" value="<?php echo htmlspecialchars($item['item_name']); ?>" 
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-indigo-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" 
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-indigo-200">
            </div>

            <div class="flex justify-between items-center">
                <a href="inventory_dashboard.php" class="text-indigo-600 hover:underline">← Back to Dashboard</a>
                <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700">Update</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
