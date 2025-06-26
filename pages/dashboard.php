<?php
include("../includes/auth.php");
include("../includes/db.php");

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['description'])) {
    $desc = $_POST['description'];
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, description) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $desc);
    $stmt->execute();
}

$tasks = $conn->query("SELECT * FROM tasks WHERE user_id = $user_id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - To-Do List</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Sua Lista de Tarefas</h2>
    <form method="post">
        <input type="text" name="description" required placeholder="Nova tarefa...">
        <button type="submit">Adicionar</button>
    </form>

    <ul>
        <?php while ($task = $tasks->fetch_assoc()): ?>
            <li>
                <?php echo htmlspecialchars($task['description']); ?>
                <a href="../delete-task.php?id=<?php echo $task['id']; ?>">🗑️</a>
            </li>
        <?php endwhile; ?>
    </ul>

    <p><a href="../logout.php">Sair</a></p>
</body>
</html>