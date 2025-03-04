
 <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../config/database.php';

// Handle Task Creation
if (isset($_POST['add_task'])) {
    $task = trim($_POST['task']);
    $date = $_POST['date'];
    $user_id = $_SESSION['user_id']; // Store user_id in session
    
    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, task, date) VALUES (?, ?, ?)");
    if ($stmt->execute([$user_id, $task, $date])) {
        header("Location: ../views/dashboard.php");
    } else {
        echo "Task creation failed";
    }
}

// Handle Task Deletion
if (isset($_GET['delete_task'])) {
    $task_id = $_GET['delete_task'];
    
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    if ($stmt->execute([$task_id])) {
        header("Location: ../views/dashboard.php");
    } else {
        echo "Task deletion failed";
    }
}

// Handle Task Editing
if (isset($_POST['edit_task'])) {
    $task_id = $_POST['task_id'];
    $task = trim($_POST['task']);
    $date = $_POST['date'];
    
    $stmt = $pdo->prepare("UPDATE tasks SET task = ?, date = ? WHERE id = ?");
    if ($stmt->execute([$task, $date, $task_id])) {
        header("Location: ../views/dashboard.php");
    } else {
        echo "Task update failed";
    }
}

// Fetch Tasks for Logged-in User
function getTasksByUser($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}
?>
