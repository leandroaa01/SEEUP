<?php
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Verifica se os campos do formulário foram enviados
  if (isset($_POST["usuario"], $_POST["chaveacesso"], $_POST["email"], $_POST["p1"], $_POST["p2"], $_POST["p3"], $_POST["senha"])) {
    $usuario = $_POST["usuario"];
    $chaveacesso = $_POST["chaveacesso"];
    $email = $_POST["email"];
    $p1 = $_POST["p1"];
    $p2 = $_POST["p2"];
    $p3 = $_POST["p3"];
    $senha = $_POST["senha"];

    // Verifica se todos os campos estão preenchidos
    if (empty($usuario) || empty($chaveacesso) || empty($email) || empty($p1) || empty($p2) || empty($p3) || empty($senha)) {
      // Campos do formulário não foram preenchidos
      echo '<script>
      alert("Por favor, preencha todos os campos.");
      window.location.href = "clogin.html";
      </script>';
      exit;
    }

    // Verifica se o usuário já está cadastrado
    $sqlVerificar = "SELECT * FROM Alunos WHERE cpf = '$chaveacesso'";
    $resultVerificar = mysqli_query($conn, $sqlVerificar);

    if (mysqli_num_rows($resultVerificar) > 0) {
      // O usuário já está cadastrado
      echo '<script>
      alert("Erro ao cadastrar: Usuário já cadastrado. Por favor, escolha outro CPF ou matrícula.");
      window.location.href = "clogin.html";
      </script>';
      exit;
    }

    // Insere os dados no banco de dados
    $sql = "INSERT INTO Alunos (nome, cpf, email, senha, filme, serie, musica) VALUES ('$usuario', '$chaveacesso', '$email', '$senha', '$p1', '$p2', '$p3')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      // Cadastro realizado com sucesso
      echo '<script>
      alert("Cadastro realizado com sucesso!");
      window.location.href = "index.html";
      </script>';
      exit;
    } else {
      // Erro ao cadastrar
      echo '<script>
      alert("Erro ao cadastrar. Por favor, tente novamente.");
      window.location.href = "clogin.html";
      </script>';
      exit;
    }
  } 
}
?>
