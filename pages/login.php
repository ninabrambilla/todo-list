<?php
session_start();
include("../includes/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - To-Do List</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        <input type="email" name="email" required placeholder="E-mail"><br>
        <input type="password" name="password" required placeholder="Senha"><br>
        <button type="submit">Entrar</button>
    </form>
    <p>Não tem conta? <a href="register.php">Cadastre-se</a></p>
    <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
</body>
</html>