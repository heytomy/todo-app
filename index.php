<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>To-Do List</title>
</head>

<?php
$host = "localhost";
$username = "root";
$password = "hihihi";
$dbname = "todo_list";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {

        $task_id = $_POST['task_id'];
        $sql = "DELETE FROM tasks WHERE id = :task_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':task_id', $task_id);
        $stmt->execute();
        echo "Task deleted successfully";

    } elseif (isset($_POST['done'])) {

        $task_id = $_POST['task_id'];
        $sql = "UPDATE tasks SET status = 1 WHERE id = :task_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':task_id', $task_id);
        $stmt->execute();
        echo "Task marked as done";
    } else {

        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
    
        $sql = "INSERT INTO tasks (task_name, task_description)
                VALUES (:task_name, :task_description)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':task_name', $task_name);
        $stmt->bindParam(':task_description', $task_description);
        $stmt->execute();
        echo "New task added successfully";
    }
}



?>

<body class="container pt-5">
    <h1 class="text-center mb-4">To-Do List</h1>
    <form method="post" class="mb-3">
        <div class="form-group">
            <input type="text" id="task-name" name="task_name" placeholder="Task Name" class="form-control">
        </div>
        <div class="form-group">
            <textarea id="task-description" name="task_description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Task</button>
    </form>

    <?php

$sql = "SELECT * FROM tasks WHERE status = 0";
$stmt = $conn->prepare($sql);
$stmt->execute();
$activeTasks = $stmt->fetchAll();

$sql = "SELECT * FROM tasks WHERE status = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$completedTasks = $stmt->fetchAll();

echo "<h2>Active Tasks</h2>";
echo "<table class='table'>";
echo "<thead class='thead-dark'><tr><th>Task Name</th><th>Task Description</th><th>Actions</th></tr></thead>";
echo "<tbody>";

foreach ($activeTasks as $task) {
    echo "<tr>";
    echo "<td>" . $task['task_name'] . "</td>";
    echo "<td>" . $task['task_description'] . "</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='task_id' value='" . $task['id'] . "'>";
    echo "<button type='submit' name='done' class='btn btn-success'>Done</button>";
    echo "<button type='submit' name='delete' class='btn btn-danger'>Delete</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

echo "<h2>Completed Tasks</h2>";
echo "<table class='table'>";
echo "<thead class='thead-dark'><tr><th>Task Name</th><th>Task Description</th></tr></thead>";
echo "<tbody>";

foreach ($completedTasks as $task) {
    echo "<tr>";
    echo "<td>" . $task['task_name'] . "</td>";
    echo "<td>" . $task['task_description'] . "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn = null;
?>