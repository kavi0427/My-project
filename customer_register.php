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

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO customers (first_name, last_name, email, phone, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $password);

    if ($stmt->execute()) {
        $success = "Customer registered successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('https://wallpapers.com/images/hd/food-4k-3gsi5u6kjma5zkj0.jpg');
            background-size: cover;
            background-position: center;
        }
        .form-bg {
            background-color: rgba(242, 239, 236, 0.95);
            border-radius: 2rem;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="form-bg w-full max-w-2xl p-8 shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">🍽️ Customer Registration</h2>

        <?php if ($success): ?>
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-center">
                <?php echo $success; ?>
            </div>
        <?php elseif ($error): ?>
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" required class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" required class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" required class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300">
            </div>
            <div class="pt-4">
                <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-lg hover:bg-indigo-700 transition">Register</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>