<?php

// Dados de conexão com o banco de dados
$host = 'localhost'; // Endereço do servidor MySQL
$dbname = 'aula'; // Nome do banco de dados
$username = 'root'; // Seu nome de usuário MySQL
$password = ''; // Sua senha do MySQL

// Conexão com banco de dados
try {

    $parametros = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($parametros, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Landing Page Legal</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header>
        <h1>Bem-vindo à Minha Landing Page</h1>
        <p>Uma descrição curta e impactante do seu produto ou serviço.</p>
        <a href="#conteudo" class="botao">Saiba Mais</a>
    </header>
<main>
    <section id="conteudo">
        <h2>O que oferecemos</h2>
        <div class="cards">
            <?php
            // Consulta ao banco
            $sql = "SELECT titulo, descricao FROM produtos";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // Loop pelos produtos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="card">';
                echo '<h3>' . htmlspecialchars($row['titulo']) . '</h3>';
                echo '<p>' . htmlspecialchars($row['descricao']) . '</p>';
                echo '</div>';
            }
            ?>
        </div>

        <form action="processar_formulario.php" method="post" class="formulario-contato">
            <div class="form-grupo">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="Seu nome" required>
            </div>
            <div class="form-grupo">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="Seu e-mail" required>
            </div>
            <div class="form-grupo">
                <label for="mensagem">Mensagem:</label>
                <textarea name="mensagem" id="mensagem" placeholder="Sua mensagem" required></textarea>
            </div>
            <button type="submit" class="botao-enviar">Enviar</button>
        </form>
    </section>
</main>
    <footer>
        <p>&copy; 2024 Minha Landing Page. Todos os direitos reservados.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>