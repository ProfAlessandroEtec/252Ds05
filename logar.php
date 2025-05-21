<?php
session_start(); // INICIA A SESSÃO

// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
    header("Location: login.html"); 
    exit;
}

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

  // Dados de conexão com o banco de dados
  $host = 'localhost'; // Endereço do servidor MySQL
  $dbname = 'aula'; // Nome do banco de dados
  $username = 'root'; // Seu nome de usuário MySQL
  $password = ''; // Sua senha do MySQL
  $parametros = "mysql:host=$host;dbname=$dbname;charset=utf8";
$pdo = new PDO($parametros, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Busca no banco
$sql = "SELECT idUsuario, nomeUsuario, emailUsuario, senhausuario FROM usuario WHERE nomeUsuario = ?";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $usuario);
$stmt->execute();
$usuarioDB = $stmt->fetch();

if ($usuarioDB && $senha === $usuarioDB['senhausuario']) { // Ideal: usar password_verify()
    $_SESSION['usuario'] = $usuarioDB['nomeUsuario'];
    $_SESSION['id'] = $usuarioDB['idUsuario'];
    header("Location: painelusuario.php");
    exit;
} else {
    echo "<script>alert('Login Inválido'); window.location.href='login.html';</script>";
}

?>