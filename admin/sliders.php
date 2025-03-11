<?php
// Include config file
require_once '../includes/config.php';

// Check if user is logged in
if (!isLoggedIn()) {
    redirect('index.php');
}

// Set page title
$page_title = 'Manage Sliders';

// Get all sliders
$stmt = $db->query("SELECT * FROM sliders ORDER BY display_order");
$sliders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Include admin header
include 'includes/header.php';
?>

<div class="content-container">
    <div class="content-header">
        <h1><?php echo $page_title; ?></h1>
        <div class="content-actions">
            <a href="slider-add.php" class="btn"><i class="fas fa-plus"></i> Add New Slider</a>
        </div>
    </div>
    
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h2>All Sliders</h2>
            </div>
            <div class="card-body">
                <?php if (count($sliders) > 0): ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sliders as $slider): ?>
                                    <tr>
                                        <td><?php echo $slider['id']; ?></td>
                                        <td>
                                            <img src="<?php echo '../' . $slider['image_path']; ?>" alt="<?php echo $slider['title']; ?>" width="100">
                                        </td>
                                        <td><?php echo $slider['title']; ?></td>
                                        <td><?php echo $slider['display_order']; ?></td>
                                        <td>
                                            <span class="badge <?php echo $slider['is_active'] ? 'badge-success' : 'badge-danger'; ?>">
                                                <?php echo $slider['is_active'] ? 'Active' : 'Inactive'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="slider-edit.php?id=<?php echo $slider['id']; ?>" class="btn-link"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="slider-delete.php?id=<?php echo $slider['id']; ?>" class="btn-link text-danger" onclick="return confirm('Are you sure you want to delete this slider?');"><i class="fas fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="no-data">No sliders found. <a href="slider-add.php">Add a new slider</a>.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
// Include admin footer
include 'includes/footer.php';
?> 