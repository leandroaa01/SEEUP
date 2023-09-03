<?php
header('Content-Type: text/html; charset=UTF-8');
if (isset($_POST["entrar"])) {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $ch = curl_init();
 echo curl_setopt_array($ch, [
    CURLOPT_URL => 'https://suap.ifrn.edu.br/api/v2/autenticacao/token/',
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'x-li-format: json'
    ],
    CURLOPT_POSTFIELDS => json_encode([
        'username' => $usuario,
        'password' => $senha 
    ]),
    CURLOPT_RETURNTRANSFER => true,
        CURLOPT_PROTOCOLS => CURLPROTO_HTTPS
]);
$resultado = curl_exec($ch);
 $data = json_decode($resultado);
 curl_close($ch);
 if ($data->access != null) {
    $acesso = $data->access;

    // Inicializa a sessão
    session_start();

    // Armazena o token de acesso na sessão
    $_SESSION['chave'] = $acesso;

    // Agora, você precisa fazer uma nova requisição para obter informações do usuário usando o token
    $ch2 = curl_init();
    curl_setopt_array($ch2, [
        CURLOPT_URL => 'https://suap.ifrn.edu.br/api/v2/minhas-informacoes/meus-dados/',
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $acesso,
            'x-li-format: json'
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_PROTOCOLS => CURLPROTO_HTTPS
    ]);
    $resultado2 = curl_exec($ch2);
    curl_close($ch2);
    // Decodifica os dados da segunda requisição
    $data2 = json_decode($resultado2);

   // Agora, você pode acessar o nome do usuário a partir dos dados da segunda requisição
   $nomeUsuario = $data2->nome_usual;
   $matricula = $data2->matricula;

    // Armazena o nome do usuário na sessão
    $_SESSION['nomeUsuario'] = $nomeUsuario;
    $_SESSION['matricula']= $matricula;
    // Agora você pode acessar a informação "tipo_vinculo"
    $tipoVinculo = $data2->tipo_vinculo;

    // Armazena o valor de "tipo_vinculo" na sessão
    $_SESSION['tipoVinculo'] = $tipoVinculo;

    // Verifica o valor de "tipo_vinculo"
    if ($tipoVinculo === "Prestador de Serviço"  || $tipoVinculo === "Aluno" || $tipoVinculo === "Servidor") {
        // O usuário é um aluno ou servidor, faça o redirecionamento ou execute ações apropriadas
        echo '<script>
        alert("Olá seja Bem-vindo a SEE UP!!! &#128522; ");
        window.location.href = "blocoA.php";
        </script>';
    } else {
        // O usuário não é um aluno e nem um servidor, redirecione para a página inicial
        echo '<script>
        alert("Usuario ou Senha incorreta!");
        window.location.href = "index.html";
        </script>';
    }
} else {
    // Tratamento para caso o acesso não tenha sido obtido
    echo '<script>
    window.location.href = "index.html";
    </script>';
}



}  
?>