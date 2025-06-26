<?php
include("../includes/db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $query->bind_param("sss", $name, $email, $password);

    if ($query->execute()) {
        header("Location: login.php");
    } else {
        $erro = "Erro ao cadastrar. Tente outro e-mail.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - To-Do List</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Cadastro</h2>
    <form method="post">
        <input type="text" name="name" required placeholder="Nome"><br>
        <input type="email" name="email" required placeholder="E-mail"><br>
        <input type="password" name="password" required placeholder="Senha"><br>
        <button type="submit">Cadastrar</button>
    </form>
    <p>Já tem conta? <a href="login.php">Entrar</a></p>
    <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
</body>
</html>