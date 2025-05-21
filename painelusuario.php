<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/painelusuario.css">
   
</head>
<body>
    <div class="painel">
        <h2>Bem-vindo, <?php echo htmlspecialchars($usuario); ?>!</h2>
        <p>Você acessou com sucesso o painel do usuário.</p>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>