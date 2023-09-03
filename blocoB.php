<?php   session_start();
// Verifica se a variável de sessão 'chave' não está definida
if (!isset($_SESSION['chave'])) {
  // Redireciona para a página de índice (index.html)
  echo '<script>
        window.location.href = "index.php";
        </script>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="icon" href="imgs/iconSEEUP.png">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/blcB.css">
    <title> SEE UP - BLOCO ANEXO</title>

<style>
 body
   {
    margin: 0;
    padding: 0;
    background-image: url(imgs/blocoB.jpg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 100vh;
    background-attachment: fixed;
   }
   .cofig
   {
    min-width:270px;
    width: 14%;
    display: flex;
    margin-right: 1%;
    }

  .cofig .sala
   {
    min-width: 250px;
    width: 290px;
    padding: 45px;
    box-sizing: border-box;
    height: 210px;
    color: rgb(234, 234, 241);
    text-transform: uppercase;
    border: 2px solid rgba(133, 133, 133, 0.808);
    border-radius: 10px;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    text-align: center;
    cursor: pointer;
    margin-left: 40%;
    margin-bottom: 1%;
    }
  
    /* Estilos para telas pequenas (smartphones) */
@media screen and (max-width: 600px) {
  body{
    background: #ffffff;
  }

   img {
position: relative;
float: left; /* Adiciona o alinhamento à esquerda */
margin-left: -10px;
max-width:50px;
height: auto;
width: auto;
filter: brightness(0%);
}

  .blocoA {
    margin-bottom: 14px;
   padding-left: 2%;
   margin-top: 5px;
   color:rgb(0, 0, 0);
   font-family: 'Lilita One', cursive;
  font-family: 'Press Start 2P', cursive;
  font-family: 'Staatliches', cursive;
  font-size: 9px;
  }
      .cofig {
      width: 90%;
      margin-left: 0;
      margin-right: 0;
      text-align: center;
      align-items: center;
  }

  .cofig .sala {
    position: relative;
    height: 210px;
    padding-bottom: 10px;
      width: 90%;
      margin-left: 0;
      margin-right: 0;
      text-align: center;
      align-items: center;
  }

  .i {
      width: 100%;
      margin-left: 0;
      text-align: center;
      align-items: center;
      margin-top: 2px;
      font-size: 12px;
      font-weight: 800;
    
  }

  .modal{
    position:absolute;
    width:99%;
    height:150%;
    background-color: rgba(0, 0, 0, 0);
    display: none;
    align-items: center;
    top: 100px
  }

  .corpoModal {
    width: 140%;
    height:150%; /* Ajuste conforme necessário */
    padding: 10px;
    margin: 10px auto;
    font-family: 'Kanit', sans-serif;
    font-weight: 900;
    font-size: 10px;
}
 

  .fecharModal,
  .resevar {
      position: absolute;
      width: 95%;
      margin-left: 0;
      margin-right: 0;
      margin-bottom: 10px;
  }
  .fecharModal{
      margin-top:-11%;
     margin-left: 2%;
     margin-bottom: 20px;
  
  }

  .infos {
    list-style: none;
    padding: 0;
    top: 12px; /* Ajuste conforme necessário */
}

.infos li {
    padding: 5px;
    top: 0; /* Ajuste conforme necessário */
}

ul {
    list-style: none;
    padding: 0;
    font-size: 10px;
    top: 10px;
}

li {
    color: aliceblue;
    text-transform: uppercase;
    padding: 3px;
    font-size: 10px;
    font-weight: 900;
    top: 0; /* Ajuste conforme necessário */
}
}
    </style>
<body>
<header class="header">
      <nav class="nav">
        <a href="/" class="logo"> <img src="imgs/logoSEEUP.png">  </a>
        <button class="hamburger"></button>
        <ul class="nav-list">
          <li>  <?php if (isset($_SESSION['tipoVinculo']) && $_SESSION['tipoVinculo'] === "Servidor" || !isset($_SESSION['matricula']) || $_SESSION['matricula'] === "40104317841"){
            ?><a href="caSala.php?origem=blocoA">Agendar Sala</a> <?php }?> 
          <li><a href="blocoA.php">Bloco A</a></li>
          <li><a href="sair.php">Sair</a></li>
        </ul>
      </nav>
    <script>
      const hamburger = document.querySelector(".hamburger");
      const nav = document.querySelector(".nav");
      hamburger.addEventListener("click", () => nav.classList.toggle("active"));
  </script>
    </header>
    <div class="blocoA">
    <h1>Bem-Vindo ao Bloco B, <?php echo $_SESSION['nomeUsuario']; ?>&#128522;</h1>
    </div>
    <div class="piso1">
        <?php
        require_once "conexao.php";
        $sql = "SELECT * FROM Salas  WHERE bloco = 'Bloco B'ORDER BY num_chave ASC";
        $res = mysqli_query($conn, $sql);
        while ($dados = mysqli_fetch_array($res)) :
        ?>
       <div class="cofig" > <div id="<?php echo $dados["id"]; ?>" class="sala"
        style="<?php //if($dados['situacao'] =='Disponível'){ echo "background:rgba(4, 245, 24, 0.836)";} 
        // else if($dados['situacao'] =='Ocupado'){ echo "background: #bd0606";} ?>">
                <div class="i">
                    <?php echo $dados['num_chave']; ?>
                </div>
                <div class="i">
                    <strong><?php echo $dados['descricao_chave']; ?></strong>
                </div>
                <div class="i situacao">
                <span id="situacao-<?php echo $dados['id']; ?>"></span>
                </div>
            </div> 
        </div>
        <?php endwhile; ?>
    </div> 
    <div class = "modal" id="modal">
        <div class="corpoModal" id="corpoMadal">
        <ul>
              <ul class="infos">
              <li id="labLabel">Laboratório: <span id="sala"></span></li>
              <li id="statusLabel">Status: <span id="Situacao"></span></li>
              <li id="tipoLabel" style="display:none;">Tipo do Agendamento: <span id="tipoAgentamento"></span></li>
              <li id="ocupadoLabel" style="display:none;">Atual Ocupante: <span id="prof"></span></li>
              <li id="horarioLabel" style="display:none;">Horário da Ocupação: <span id="horario"></span></li>
              <li id="turmaLabel" style="display:none;">Com A Turma: <span id="turma"></span></li>
              <li id="disciplinaLabel" style="display:none;">Na Disciplina: <span id="disciplina"></span></li>
        </ul>
     <button class="fecharModal">Fechar Sala</button> 
     <?php
     if (isset($_SESSION['tipoVinculo']) && $_SESSION['tipoVinculo'] === "Servidor"|| !isset($_SESSION['matricula']) || $_SESSION['matricula'] === "40104317841" ) {
      ?><a href="caSala.php?origem=blocoB"><button class="resevar">Resevar</button></a> <?php }?> 
        </div>
    </div>
  

  <script src="main/scripts.js"></script>
</body>
</html>
