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

// Update inventory via POST (AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $item_name = $conn->real_escape_string($_POST['item_name']);
    $quantity = intval($_POST['quantity']);

    $updateSql = "UPDATE inventory SET item_name='$item_name', quantity=$quantity WHERE id=$id";
    if ($conn->query($updateSql)) {
        echo "success";
    } else {
        echo "error";
    }
    exit;
}

// Fetch inventory data
$sql = "SELECT * FROM inventory ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1576866209830-5ddcda7fa4bc');
            background-size: cover;
            background-position: center;
        }
        .backdrop {
            background-color: rgba(255, 255, 255, 0.95);
            min-height: 100vh;
        }
        table {
            border-collapse: collapse;
        }
        .modal {
            display: none;
        }
    </style>
</head>
<body>
<div class="backdrop p-6 flex justify-center items-start min-h-screen">
    <div class="bg-white shadow-lg rounded-xl w-full max-w-5xl p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">📦 Inventory Dashboard</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg">
                <thead class="bg-indigo-600 text-white uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">Inventory ID</th>
                        <th class="px-6 py-3">Item Name</th>
                        <th class="px-6 py-3">Quantity</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr class="bg-white border-b hover:bg-gray-100">
                                <td class="px-6 py-4 font-medium text-gray-900"><?php echo $row['id']; ?></td>
                                <td class="px-6 py-4 item-name"><?php echo htmlspecialchars($row['item_name']); ?></td>
                                <td class="px-6 py-4 quantity"><?php echo $row['quantity']; ?></td>
                                <td class="px-6 py-4">
                                    <button 
                                        class="edit-btn bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700"
                                        data-id="<?= $row['id'] ?>"
                                        data-name="<?= htmlspecialchars($row['item_name']) ?>"
                                        data-qty="<?= $row['quantity'] ?>"
                                    >
                                        Change
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-6">No inventory items found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4 text-center">✏ Edit Inventory</h2>
        <form id="editForm">
            <input type="hidden" name="id" id="editId">
            <div class="mb-4">
                <label class="block text-gray-700">Item Name</label>
                <input type="text" name="item_name" id="editName" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="editQty" class="w-full p-2 border rounded" required>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById("editModal");
    const editForm = document.getElementById("editForm");

    document.querySelectorAll(".edit-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            document.getElementById("editId").value = btn.dataset.id;
            document.getElementById("editName").value = btn.dataset.name;
            document.getElementById("editQty").value = btn.dataset.qty;
            modal.style.display = "flex";
        });
    });

    function closeModal() {
        modal.style.display = "none";
    }

    editForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData(editForm);

        fetch("", {
            method: "POST",
            body: formData
        }).then(res => res.text())
          .then(data => {
              if (data.trim() === "success") {
                  alert("Inventory updated successfully!");
                  window.location.reload();
              } else {
                  alert("Error updating inventory.");
              }
          });
    });
</script>
</body>
</html>

<?php $conn->close(); ?>