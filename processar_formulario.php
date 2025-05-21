<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

  // Dados de conexão com o banco de dados
  $host = 'localhost'; // Endereço do servidor MySQL
  $dbname = 'aula'; // Nome do banco de dados
  $username = 'root'; // Seu nome de usuário MySQL
  $password = ''; // Sua senha do MySQL

  try {
      // Criando a conexão com o banco de dados usando PDO
      $parametros = "mysql:host=$host;dbname=$dbname;charset=utf8";
      $pdo = new PDO($parametros, $username, $password);
      
      // Definindo o modo de erro do PDO para exceções
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      // Preparando o comando SQL para inserir os dados no banco
      $sql = "INSERT INTO cliente (nome, email,mensagem) VALUES (:nome, :email, :mensagem)";
      $stmt = $pdo->prepare($sql);

      // Bind dos parâmetros para evitar SQL Injection
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':mensagem', $mensagem);

      // Executando o comando SQL
      $stmt->execute();

      // Mensagem de sucesso
      //echo "Obrigado por entrar em contato, $nome! Sua mensagem foi enviada.";


       echo "<script>
      alert('Obrigado por entrar em contato, $nome! Sua mensagem foi enviada.');
      window.location.href = 'index.php';
    </script>"; 


  } catch (PDOException $e) {
      // Em caso de erro, exibe uma mensagem
    //  echo "Erro ao enviar a mensagem: " . $e->getMessage();

      
        echo "<script>
                alert('Erro ao enviar a mensagem: " . $e->getMessage() . "');
                window.location.href = 'index.php';
              </script>";
      
  }


    // Aqui você pode enviar um e-mail ou salvar os dados em um banco de dados
    //echo "Obrigado por entrar em contato, $nome! Sua mensagem foi enviada.";
}
?>