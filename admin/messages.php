<?php
// Include config file
require_once '../includes/config.php';

// Check if user is logged in
if (!isLoggedIn()) {
    redirect('index.php');
}

// Set page title
$page_title = 'Contact Messages';

// Get all messages
$stmt = $db->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Include admin header
include 'includes/header.php';
?>

<div class="content-container">
    <div class="content-header">
        <h1><?php echo $page_title; ?></h1>
    </div>
    
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h2>All Messages</h2>
            </div>
            <div class="card-body">
                <?php if (count($messages) > 0): ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($messages as $message): ?>
                                    <tr class="<?php echo $message['is_read'] ? '' : 'table-warning'; ?>">
                                        <td><?php echo $message['id']; ?></td>
                                        <td><?php echo $message['name']; ?></td>
                                        <td><?php echo $message['email']; ?></td>
                                        <td><?php echo $message['subject']; ?></td>
                                        <td><?php echo formatDate($message['created_at'], 'M d, Y h:i A'); ?></td>
                                        <td>
                                            <span class="badge <?php echo $message['is_read'] ? 'badge-secondary' : 'badge-warning'; ?>">
                                                <?php echo $message['is_read'] ? 'Read' : 'Unread'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="message-view.php?id=<?php echo $message['id']; ?>" class="btn-link"><i class="fas fa-eye"></i> View</a>
                                            <a href="message-delete.php?id=<?php echo $message['id']; ?>" class="btn-link text-danger" onclick="return confirm('Are you sure you want to delete this message?');"><i class="fas fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="no-data">No messages found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
// Include admin footer
include 'includes/footer.php';
?> 