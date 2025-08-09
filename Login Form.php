<?php
$error = "";

// Check if the form was submitted
if (isset($_POST['login_submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        // Simple hardcoded login
        if ($username == "admin" && $password == "admin123") {
            header("Location: Dashboard.php"); // Replace with actual dashboard
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .backdrop {
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .input-field {
            padding-left: 2.75rem;
            border-radius: 0.5rem;
            transition: 0.3s;
        }
        .input-field:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.4);
        }
        .btn-custom {
            background-color: #f59e0b;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #d97706;
            transform: translateY(-2px);
        }
        .icon-field {
            left: 1rem;
            color: #9ca3af;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4">
    <div class="backdrop max-w-md w-full p-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Restaurant Admin Login</h2>
        <?php if (!empty($error)): ?>
            <p class="text-red-500 text-sm text-center mb-4"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="" class="space-y-6">
            <div class="relative">
                <input id="username" name="username" type="text" required placeholder="Username"
                       class="w-full border border-gray-300 py-2 input-field text-gray-800 placeholder-gray-400 <?php echo (!empty($error)) ? 'border-red-500' : ''; ?>">
                <span class="absolute inset-y-0 flex items-center icon-field">
                    <i class="fas fa-user ml-3"></i>
                </span>
            </div>
            <div class="relative">
                <input id="password" name="password" type="password" required placeholder="Password"
                       class="w-full border border-gray-300 py-2 input-field text-gray-800 placeholder-gray-400 <?php echo (!empty($error)) ? 'border-red-500' : ''; ?>">
                <span class="absolute inset-y-0 flex items-center icon-field">
                    <i class="fas fa-lock ml-3"></i>
                </span>
            </div>
            <button type="submit" name="login_submit"
                    class="w-full text-white font-semibold py-3 rounded-md btn-custom">
                Log In
            </button>
        </form>
    </div>
</body>
</html>