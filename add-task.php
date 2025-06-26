<?php
include("includes/auth.php");
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["description"])) {
    $desc = $_POST["description"];
    $user_id = $_SESSION["user_id"];
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, description) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $desc);
    $stmt->execute();
    header("Location: pages/dashboard.php");
}
?>