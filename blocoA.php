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
    <link rel="stylesheet" href="style.css" />
    <title> SEE UP - BLOCO PRICINPAL</title>

<body>
  <Style>
  img {
  position: relative;
  float: left; /* Adiciona o alinhamento à esquerda */
  margin-left: 28px;
  max-width:50px;
  height: auto;
  width: auto;
  filter: brightness(0%);
}
* {
  margin: 0;
  padding: 0;
}

a {
  font-family: sans-serif;
  text-decoration: none;
}

.nav {
  max-width: 1280px;
  height: 70px;
  margin-inline: auto;

  display: flex;
  justify-content: space-between;
  align-items: center;
}


.nav-list {
  display: flex;
  gap: 32px;
  list-style: none;
}

.nav-list a {
  font-size: 30px;
  color: #020202;
  padding-block: 16px;
  font-weight: 700;
  font-family: 'Lilita One', cursive;
font-family: 'Press Start 2P', cursive;
font-family: 'Staatliches', cursive;
}



.hamburger {
  display: none;
  border: none;
  background: none;
  border-top: 3px solid #000000;
  cursor: pointer;
}

.hamburger::after,
.hamburger::before {
  content: " ";
  display: block;
  width: 30px;
  height: 3px;
  background: #272727;
  margin-top: 5px;
  position: relative;
  transition: 0.3s;
}

@media (max-width: 750px) {
  .hamburger {
    display: block;
    z-index: 1;
  }

  .nav-list {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(31, 30, 30, 0.74);
    clip-path: circle(100px at 90% -15%);
    transition: 1s ease-out;

    flex-direction: column;
    justify-content: space-around;
    align-items: center;
    gap: 0;

    pointer-events: none;
  }

  .nav-list a {
    font-size: 24px;
    opacity: 0;
    color: #fff;
  }

  .nav-list li:nth-child(1) a {
    transition: 0.5s 0.2s;
  }

  .nav-list li:nth-child(2) a {
    transition: 0.5s 0.4s;
  }

  .nav-list li:nth-child(3) a {
    transition: 0.5s 0.6s;
  }

  /* Estilos ativos */

  .nav.active .nav-list {
    clip-path: circle(1500px at 90% -15%);
    pointer-events: all;
  }

  .nav.active .nav-list a {
    opacity: 1;
  }

  .nav.active .hamburger {
    position: fixed;
    top: 26px;
    right: 16px;
    border-top-color: transparent;
  }

  .nav.active .hamburger::before {
    transform: rotate(135deg);
  }

  .nav.active .hamburger::after {
    transform: rotate(-135deg);
    top: -7px;
  }
}
    .corpoModal {
    width: 70%;
    height: 95%;
    padding: 20px;
    background-color: #000000;
    border-radius: 5px;
    text-transform: uppercase;
    color: #ffffff;
    margin-bottom: 25px;
    margin-top: 50px;
    font-family: 'Kanit', sans-serif;
    font-family: 'Anton', sans-serif;
    font-weight: 900;
    margin-left: auto;
    margin-right: auto;
    
    }
    #labLabel {
    color: rgb(226, 225, 223);
    height: 20px;
    background-color: rgba(255, 153, 0, 0.836);
    padding: 5px 17px; /* Ajusta o espaçamento interno */
    border-radius: 10px;
    font-weight: 700;
    margin-bottom: 10px;
    display: inline-block; /* Torna o elemento ocupar apenas o espaço do conteúdo */
    vertical-align: middle;
}


#statusLabel {
  color: rgb(226, 225, 223);
  height: 20px;
  background-color: rgba(60, 255, 0, 0.836);
  padding: 5px 16px; /* Ajusta o espaçamento interno */
  border-radius: 10px;
  font-weight: 700;
  display: inline-block; /* Torna o elemento ocupar apenas o espaço do conteúdo */
  font-weight: 700;
  margin-bottom: 10px;
  vertical-align: middle;
  
}
#tipoLabel {
  color: rgb(226, 225, 223);
  height: 20px;
  margin-right: 20px;
  display: inline-block; /* Torna o elemento ocupar apenas o espaço do conteúdo */
  background-color: rgba(255, 0, 157, 0.836);
  padding: 5px 17px; /* Ajusta o espaçamento interno */
  border-radius: 10px;
 top: 3px;
 font-weight: 700;
 margin-bottom: 15px;
 vertical-align: middle;
 
}

#ocupadoLabel {
  color: rgb(226, 225, 223);
  height: 20px;
  margin-right: 20px;
  display: inline-block; /* Torna o elemento ocupar apenas o espaço do conteúdo */
  background-color: rgba(0, 119, 255, 0.836);
  padding: 5px 17px; /* Ajusta o espaçamento interno */
  border-radius: 10px;
 top: 2px;
 font-weight: 700;
 margin-bottom: 15px;
 vertical-align: middle;

}

#horarioLabel {
  color: rgb(226, 225, 223);
  height: 20px;
  margin-right: 20px;
  display: inline-block; /* Torna o elemento ocupar apenas o espaço do conteúdo */
  background-color: rgba(212, 0, 255, 0.836);
  padding: 5px 17px; /* Ajusta o espaçamento interno */
  border-radius: 10px;
 top: 3px;
 font-weight: 700;
 margin-bottom: 20px;
 vertical-align: middle;

}

#turmaLabel {
  color: rgb(226, 225, 223);
  height: 20px;
  margin-right: 20px;
  display: inline-block; /* Torna o elemento ocupar apenas o espaço do conteúdo */
  background-color: rgba(0, 247, 255, 0.836);
  padding: 5px 17px; /* Ajusta o espaçamento interno */
  border-radius: 10px;
 top: 2px;
 font-weight: 700;
 margin-bottom: 10px;
 vertical-align: middle;

}

#disciplinaLabel {
  color: rgb(226, 225, 223);
  height: 20px;
  margin-right: 20px;
  display: inline-block; /* Torna o elemento ocupar apenas o espaço do conteúdo */
  background-color: rgba(255, 238, 0, 0.836);
  padding: 5px 17px; /* Ajusta o espaçamento interno */
  border-radius: 10px;
 top: 2px;
 font-weight: 700;
 margin-bottom: 10px;
 vertical-align: middle;

}
     /* Estilos para telas pequenas (smartphones) */
  @media screen and (max-width: 600px) {
    body{
      background: #ffffffd3;
    }
     img {
  position: relative;
  float: left; /* Adiciona o alinhamento à esquerda */
  margin-left: 28px;
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
       padding-bottom: 10px;
       padding: 25px;
        width: 90%;
        margin-left: 0;
        margin-right: 0;
        text-align: center;
        align-items: center;
    }

    .cofig .sala {
      padding-bottom: 10px;
      padding: 25px;
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
        margin-top: 10px;
    }
    .modal{
      position:absolute;
      width:90%;
      height:500%;
      background-color: rgba(0, 0, 0, 0);
      display: none;
      align-items: center;
      top: 100px
    }

    .corpoModal {
      width: 120%;
      height:1000%; /* Ajuste conforme necessário */
      padding: 10px;
      margin: 10px auto;
      font-family: 'Kanit', sans-serif;
      font-weight: 900;
  }
   

    .fecharModal,
    .resevar {
        width: 100%;
        margin-left: 0;
        margin-right: 0;
    }

    .infos {
      list-style: none;
      padding: 0;
      top: 0; /* Ajuste conforme necessário */
  }
  
  .infos li {
      padding: 5px;
      top: 0; /* Ajuste conforme necessário */
  }

  ul {
      list-style: none;
      padding: 0;
      font-size: 10px;
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

  </Style>
<header class="header">
      <nav class="nav">
        <a href="/" class="logo"> <img src="imgs/logoSEEUP.png"> </a>
        <button class="hamburger"></button>
        <ul class="nav-list">
          <li>  <?php if (isset($_SESSION['tipoVinculo']) && $_SESSION['tipoVinculo'] === "Servidor" || !isset($_SESSION['matricula']) || $_SESSION['matricula'] === "40104317841"){
            ?><a href="caSala.php?origem=blocoA">Agendar Sala</a> <?php }?> 
          <li><a href="blocoB.php">Bloco B</a></li>
          <li><a href="sair.php">Sair</a></li>
        </ul>
      </nav>
    </header>
    <script>
const hamburger = document.querySelector(".hamburger");
const nav = document.querySelector(".nav");

hamburger.addEventListener("click", () => nav.classList.toggle("active"));
  </script>
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
     ?><a href="caSala.php?origem=blocoA"><button class="resevar">Resevar</button></a> <?php }?> 
        </div>
    </div>
    <div class="blocoA">
      
    <h1>Bem-Vindo ao Bloco A, <?php echo $_SESSION['nomeUsuario']; ?>&#128522;</h1>
    
    </div>
    <div class="piso1">
        <?php
        require_once "conexao.php";
        $sql = "SELECT * FROM Salas  WHERE bloco = 'Bloco A' ORDER BY num_chave ASC";
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
    <Script>
        $(document).ready(function() //Abre modal
        {
            $(".sala").click(function()
            {
                $(".modal").show();
                carregaModal($(this).attr('id'));
                
            });
        });

        $(document).ready(function() //Fecha modal
        {
            $(".fecharModal").click(function()
            {
            $(".modal").hide();
            });
        });

        function carregaModal(id) //Carrega as informações dentro do modal
{
  $.ajax({
    url: 'modal.php',
    type: 'POST',
    data: { carregaModal: '', id: id },
    success: function(svRetorno) {
        resultado = svRetorno.split(";");
    $("#sala").text(resultado[0]);
    $("#prof").text(resultado[1]);
    $("#turma").text(resultado[3]);
    $("#disciplina").text(resultado[2]);
    sit(id, resultado[0]);
    hrrs(id, resultado[0]);
    agdt(id, resultado[0]);
    }
  });
}

function sit(id) {
  $.ajax({
    url: 'modal.php',
    type: 'POST',
    data: { sit: '', id: id },
    success: function(svRetorno) {
      resultado = svRetorno.split(";");
      $("#Situacao").text(resultado[0]);

      if (resultado[0].trim() === "Disponíveis" || resultado[0].trim() === "Laboratório Fechado  no Horario Atual.") {
        // Se o status for "Disponíveis" ou "Intervalo", ocultar os campos extras
        $("#tipoLabel").hide();
        $("#ocupadoLabel").hide();
        $("#turmaLabel").hide();
        $("#disciplinaLabel").hide();
      } else {
        // Se o status for "Ocupado", exibir os campos extras
        $("#tipoLabel").show();
        $("#ocupadoLabel").show();
        $("#turmaLabel").show();
        $("#disciplinaLabel").show();
      }
    
      var resultado = svRetorno.trim();
     atualizarCoresDasDivs(id, resultado);
     $("#situacao-" + id).text(resultado);
    
      // Mantenha os campos `#horarioLabel` e `#horario` visíveis
      $("#horarioLabel").show();
      $("#horario").show();
    }
  });
}

// Função para atualizar as cores das divs
function atualizarCoresDasDivs(salaId, situacao) {
    var divSala = $("#" + salaId);
    var infoModal = $("#statusLabel");
    if (situacao === "Ocupado") {
      divSala.css("background", "rgba(247, 0, 0, 0.596)");
      infoModal.css("background", "rgba(247, 0, 0, 0.596)");
    } else if (situacao === "Disponíveis") {
      divSala.css("background", "rgba(4, 245, 24, 0.836)");
      infoModal.css("background", "rgba(4, 245, 24, 0.836)"); // Cor de sala disponível
    } else {
      divSala.css("background", "rgba(0, 99, 247, 0.596)"); // Limpar o estilo de fundo
      infoModal.css("background", "rgba(247, 0, 0, 0.596)");
    }
  }

  $(".sala").each(function() {
    var idSala = $(this).attr("id");
    sit(idSala);

    
    setInterval(function() {
      sit(idSala);
    }, 45 * 60 * 1000); 
  });

   function hrrs(id) 
  {
  $.ajax({
    url: 'modal.php',
    type: 'POST',
    data: { hrrs: '', id: id },
    success: function(svRetorno) {
      resultado = svRetorno.split(";");
      $("#horario").text(svRetorno);
    }
  });
}
function hrrs(id) {
  $.ajax({
    url: 'modal.php',
    type: 'POST',
    data: { hrrs: '', id: id },
    success: function(svRetorno) {
      resultado = svRetorno.split(";");
      $("#horario").text(svRetorno);
    }
  });
}

function agdt(id) {
  $.ajax({
    url: 'modal.php',
    type: 'POST',
    data: { agdt: '', id: id },
    success: function(svRetorno) {
      resultado = svRetorno.split(";");
      $("#tipoAgentamento").text(svRetorno);
    }
  });
}

</script>
</body>

</html>
