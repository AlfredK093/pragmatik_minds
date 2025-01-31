<?php
session_start();
require_once '../includes/db.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Add Service
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_service'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO services (title, description) VALUES ('$title', '$description')";
    if ($conn->query($sql) === TRUE) {
        $success = "Service added successfully!";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Edit Service
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_service'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "UPDATE services SET title = '$title', description = '$description' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $success = "Service updated successfully!";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete Service
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM services WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $success = "Service deleted successfully!";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch Services
$sql = "SELECT * FROM services";
$result = $conn->query($sql);
?>

<?php
// Pagination Logic
$limit = 5; // Number of items per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch Total Services
$sql = "SELECT COUNT(*) as total FROM services";
$result = $conn->query($sql);
$total = $result->fetch_assoc()['total'];
$totalPages = ceil($total / $limit);

// Fetch Services with Pagination
$sql = "SELECT * FROM services LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!-- Add Pagination Links -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Manage Services</h1>
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Add Service Form -->
        <form method="POST" action="" class="mb-4">
            <div class="mb-3">
                <label for="title" class="form-label">Service Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Service Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <button type="submit" name="add_service" class="btn btn-primary">Add Service</button>
        </form>

        <!-- Services Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>
                            <a href="?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id']): ?>
                        <tr>
                            <td colspan="4">
                                <form method="POST" action="">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Service Title</label>
                                        <input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Service Description</label>
                                        <textarea class="form-control" name="description" rows="3" required><?php echo $row['description']; ?></textarea>
                                    </div>
                                    <button type="submit" name="edit_service" class="btn btn-success">Update Service</button>
                                    <a href="manage_services.php" class="btn btn-secondary">Cancel</a>
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>