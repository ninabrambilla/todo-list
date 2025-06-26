<?php
include("includes/auth.php");
include("includes/db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $user_id = $_SESSION["user_id"];
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
}
header("Location: pages/dashboard.php");
?>