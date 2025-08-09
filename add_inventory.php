<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = ""; // Change this if your MySQL has a password
$dbname = "kumanayaka_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";
$error = "";

// Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = trim($_POST["item_name"]);
    $quantity = intval($_POST["quantity"]);

    if (!empty($item_name) && $quantity >= 0) {
        $stmt = $conn->prepare("INSERT INTO inventory (item_name, quantity) VALUES (?, ?)");
        $stmt->bind_param("si", $item_name, $quantity);
        if ($stmt->execute()) {
            $success = "Item added successfully!";
        } else {
            $error = "Error adding item.";
        }
        $stmt->close();
    } else {
        $error = "Please fill all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Inventory Item</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092');
            background-size: cover;
            background-position: center;
        }
        .backdrop {
            background-color: rgba(255, 255, 255, 0.95);
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="backdrop flex items-center justify-center p-6">
        <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">🧾 Add Inventory Item</h2>

            <?php if (!empty($success)): ?>
                <p class="text-green-600 text-sm mb-4 text-center"><?php echo $success; ?></p>
            <?php endif; ?>
            <?php if (!empty($error)): ?>
                <p class="text-red-600 text-sm mb-4 text-center"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="" method="POST" class="space-y-4">
                <div>
                    <label class="block text-gray-700 mb-1" for="item_name">Item Name</label>
                    <input type="text" id="item_name" name="item_name" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-300">
                </div>
                <div>
                    <label class="block text-gray-700 mb-1" for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" min="0" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-300">
                </div>
                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">
                    ➕ Add Item
                </button>
            </form>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>