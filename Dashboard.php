<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Restaurant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1541544741938-0af808871cc0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Inter', sans-serif;
        }
        .backdrop {
            background-color: rgba(255, 255, 255, 0.85);
            min-height: 100vh;
        }
        .sidebar {
            background-color: #1f2937; /* dark gray */
        }
        .sidebar a {
            color: #d1d5db;
            transition: 0.2s;
        }
        .sidebar a:hover {
            background-color: #374151;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="flex flex-col md:flex-row backdrop">
    <!-- Sidebar -->
    <div class="w-full md:w-64 sidebar text-white flex flex-col">
        <div class="p-6 text-2xl font-bold text-center border-b border-gray-700">🍽 Admin Panel</div>
        <nav class="flex-grow px-4 py-6 space-y-2">
            <a href="view_reservations.php" class="block px-4 py-2 rounded hover:bg-gray-700">📅 Reservations</a>
            <a href="view_inventory.php" class="block px-4 py-2 rounded hover:bg-gray-700">📦 Inventory</a>
            <a href="add_inventory.php" class="block px-4 py-2 rounded hover:bg-gray-700">📦 Inventory Add</a>
            <a href="customer_list.php" class="block px-4 py-2 rounded hover:bg-gray-700">👤 Users</a>
        </nav>
        <div class="p-4 border-t border-gray-700 text-sm text-center">
            &copy; <?php echo date("Y"); ?> Restaurant Management
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Welcome, Admin 👋</h1>

        <!-- Reservation Section -->
        <section id="reservations" class="mb-10">
            <h2 class="text-xl font-semibold text-gray-700 mb-3">📅 Reservation Details</h2>
            <div class="bg-white shadow rounded-lg p-4">
                <p>This section will show upcoming reservations, customer details, and table allocations.</p>
            </div>
        </section>

        <!-- Inventory Section -->
        <section id="inventory" class="mb-10">
            <h2 class="text-xl font-semibold text-gray-700 mb-3">📦 Inventory Status</h2>
            <div class="bg-white shadow rounded-lg p-4">
                <p>This section will show ingredients, stock levels, and reorder alerts.</p>
            </div>
        </section>

        <!-- Users Section -->
        <section id="users">
            <h2 class="text-xl font-semibold text-gray-700 mb-3">👤 Manage Users</h2>
            <div class="bg-white shadow rounded-lg p-4">
                <p>This section will manage staff, roles, and access control.</p>
            </div>
        </section>
    </div>
</div>
</body>
</html>