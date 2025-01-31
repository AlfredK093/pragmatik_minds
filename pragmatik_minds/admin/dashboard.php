<?php
session_start();
require_once '../includes/db.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$role = $_SESSION['role'];
?>

<!-- Role-Based Dashboard -->
<div class="container my-5">
    <h1 class="text-center mb-4">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <div class="row">
        <?php if ($role === 'admin' || $role === 'editor'): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Services</h5>
                        <p class="card-text">Add, edit, or delete services.</p>
                        <a href="manage_services.php" class="btn btn-primary">Go to Services</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($role === 'admin'): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Messages</h5>
                        <p class="card-text">View messages from the contact form.</p>
                        <a href="view_messages.php" class="btn btn-primary">View Messages</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Logout</h5>
                    <p class="card-text">Logout from the admin panel.</p>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Services</h5>
                        <p class="card-text">Add, edit, or delete services.</p>
                        <a href="manage_services.php" class="btn btn-primary">Go to Services</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Messages</h5>
                        <p class="card-text">View messages from the contact form.</p>
                        <a href="view_messages.php" class="btn btn-primary">View Messages</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Logout</h5>
                        <p class="card-text">Logout from the admin panel.</p>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>