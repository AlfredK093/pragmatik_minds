<?php
require_once 'includes/db.php';
require_once 'includes/header.php';
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Welcome to The Pragmatik Minds Plc</h1>
    <p class="lead text-center">We specialize in creating innovative and user-friendly mobile applications, web development, and custom software solutions.</p>

    <h2 class="mt-5">Our Services</h2>
    <div class="row">
        <?php
        $sql = "SELECT * FROM services";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()):
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['title']; ?></h5>
                        <p class="card-text"><?php echo $row['description']; ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>