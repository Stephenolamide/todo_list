<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../config/database.php';
require '../controllers/taskController.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$tasks = getTasksByUser($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../public/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?></h2>
        <a href="../logout.php" class="logout-btn">Logout</a>

        <div class="task-section">
            <form method="POST" action="../controllers/taskController.php" class="task-form">
                <input type="text" name="task" placeholder="Enter your task" required>
                <input type="date" name="date" required>
                <button type="submit" name="add_task" class="btn">Add Task</button>
            </form>
        </div>

        <div class="task-list-container">
            <h3>Task List</h3>
            <ul class="task-list">
                <?php foreach ($tasks as $task): ?>
                    <li class="task-item">
                        <span><?php echo htmlspecialchars($task['task']); ?> (<?php echo $task['date']; ?>)</span>
                        <div class="task-actions">
                            <button class="edit-btn" onclick="openEditModal(<?php echo $task['id']; ?>, '<?php echo htmlspecialchars($task['task']); ?>', '<?php echo $task['date']; ?>')">Edit</button>
                            <a href="../controllers/taskController.php?delete_task=<?php echo $task['id']; ?>" class="delete-btn">Delete</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <!-- Edit Task Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3>Edit Task</h3>
            <form method="POST" action="../controllers/taskController.php" class="task-form">
                <input type="hidden" name="task_id" id="editTaskId">
                <input type="text" name="task" id="editTaskInput" required>
                <input type="date" name="date" id="editDateInput" required>
                <button type="submit" name="edit_task" class="btn">Update Task</button>
                <button type="button" class="cancel-btn" onclick="closeEditModal()">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, task, date) {
            document.getElementById('editTaskId').value = id;
            document.getElementById('editTaskInput').value = task;
            document.getElementById('editDateInput').value = date;
            document.getElementById('editModal').style.display = 'flex';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html>
