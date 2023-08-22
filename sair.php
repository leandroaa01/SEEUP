<?php
session_start(); // Inicia a sessão

// Verifica se a sessão está ativa
if (isset($_SESSION['chave'])) {
    // Encerra a sessão
    session_regenerate_id(true);
    session_destroy();
    // Redireciona para a página de saída
    echo '<script>
    window.location.href = "index.php";
    </script>';
}
?>