<?php   session_start();

if (!isset($_SESSION['chave'])) {
  // Redireciona para a página de índice (index.html)
  echo '<script>
        window.location.href = "index.php";
        </script>';
}
if (!isset($_SESSION['tipoVinculo']) || ($_SESSION['tipoVinculo'] !== "Servidor" && $_SESSION['matricula'] !== "40104317841")) {
  echo '<script>
      window.location.href = "index.php";
  </script>';
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="imgs/iconSEEUP.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:ital,wght@0,100;0,300;0,400;0,700;1,100&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Pacifico&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rokkitt:ital,wght@0,100;0,200;0,400;1,200&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link rel="icon" href="imgs/iconSEEUP.png">
  <title>SEE UP - Agendamento de Sala</title>
  <style>
    body {
      font-family: 'Anton', sans-serif;
      font-family: 'Roboto', sans-serif;
      margin: 0;
    padding: 0;
    background-image: url(imgs/blocoA.jpg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    }
    h1 {
      color: #020202;
      text-transform: uppercase;
      text-align: center;
      font-family: 'Anton', sans-serif;
      font-family: 'Roboto', sans-serif;
    }
    label {
      color: #45a049;
    }
    form {
      width: 60%;
      margin-left: auto;
      margin-right: auto;
      background-color:white;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
      
    }
    input[type="text"],
    select {
      width: 98%;
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #dbdbdb;
      box-sizing: border-box;
      background: #0000000e;
      font-family: 'Rokkitt', serif;
      text-size-adjust: 10px;
    }
    button[type="submit"] {
      height: 50px;
      background-color: #04a104d8;
      border: none;
      border-radius: 10px;
      text-transform: none;
      color: #fff;
      font-size: 13px;
      font-weight: 900;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
      box-shadow: 0px 0px 10px rgba(66, 66, 66, 0.589);
      width:95%;
      margin-left: 10px;
    }
    button[type="submit"]:hover {
      background-color: #45a049;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-family: 'Rokkitt', serif;
    }
    .form-group input[type="date"] {
      width: 95%;
      padding: 10px;
      font-size: 20px;
      border-radius: 5px;
      color: #00000075;
      background: #0000000e;
      border: 1px solid #ccc;
      font-family: 'Anton', sans-serif;
      font-family: 'Pacifico', cursive;
      font-size: medium;
      margin-bottom: 8px;
    
    }
    label,
    p {
      font-family: 'Rokkitt', serif;
      font-size: 20px;
      background-color: #009400d8;
      border-radius: 10px;
      color: #ffffff;
      padding: 3px 3px;
      width: 97%;
      margin-bottom: 3px;
      margin-top: 2px;
    }
    .checkbox-group {
      display: none;
      flex-wrap: wrap;
      padding-left: 20px;
    }
    .checkbox-group label, .dias label{
      flex-basis: 15%;
    }
    .v2{
      padding-left: 90px;
      
    }
    .v1{
      padding-left: 20%;
    }
    img {
      margin: 2px;
      padding: 10px;
      max-width:50px;
      height: auto;
      width: auto;
      filter: brightness(0%);
    }
    .dias{
      display: flex;
      flex-wrap: wrap;
      padding-left: 25px;
      margin-left: 10px;
      margin-top: 10px;
    }
    select{
      font-size: medium;
      color: #a5a5a5;
      margin-bottom: 8px;
      font-family: 'Anton', sans-serif;
       font-family: 'Pacifico', cursive;
    }
    .select-wrapper {
      display: none;
    }
    .selsel{
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  appearance: none;
  color: rgb(48, 146, 2);
  background: #cccccc4b;
  text-transform: uppercase;
  font-family: 'Rokkitt', serif;
  }
  /* Estilos para telas pequenas (smartphones) */
@media screen and (max-width: 600px) {
    h1 {
        font-size: 18px;
    }

    label {
        font-size: 14px;
    }

    input[type="text"],
    select {
        font-size: 14px;
    }

    button[type="submit"] {
        font-size: 16px;
        height: 36px;
    }

    .form-group input[type="date"] {
        font-size: 16px;
    }

    label,
    p {
        font-size: 16px;
    }

    .checkbox-group label,
    .dias label {
        font-size: 14px;
    }

    .v2,
    .v1 {
        padding-left: 10px;
    }

    .img-container img {
        max-width: 40px;
    }

    .dias {
        padding-left: 10px;
        margin-left: 0;
        margin-top: 5px;
    }

    .selsel {
        font-size: 14px;
    }
}

.blocos{
background-color: rgba(128, 255, 0, 0);
color: black;
width: 120px;
padding: 15px;
border-radius: 15px;
font-weight: bold;
font-size: medium;
font-family:Arial, Helvetica, sans-serif;
border:  0.9px solid rgba(0, 0, 0, 0.678);
box-shadow: 0px 0px 5px rgba(104, 104, 104, 0.755);
margin-left: 90%;
position: relative;
top: -70px;
text-align: center;
cursor: pointer;
}
  </style>
</head>
<body>
  <img src="imgs/logoSEEUP.png"> 
  <h1>Agendamento de Sala</h1>  <button class="blocos" onclick="voltar()">Voltar</button>
  <form action="cadastroSala.php" method="POST" autocomplete="off">
    <div class="form-group">
      <label for="nome-sala"required>Nome da Sala:</label>
      <input type="text" id="nome-sala" name="nome-sala" class="buscarInfo">
      <div class="select-wrapper">
        <select class="selsel" id="nSala" name="nSala"></select>
      </div>
    </div>
    <div class="form-group">
      <label for="professor" required>Professor:</label>
      <input type="text" id="professor" name="professor" class="buscarInfo">
      <div class="select-wrapper">
        <select class="selsel" id="nProf" name="nProf"></select>
      </div>
    </div>
    <div class="form-group">
      <label for="turma" required>Turma:</label>
      <input type="text" id="turma" name="turma" class="buscarInfo">
      <div class="select-wrapper">
        <select class="selsel" id="nTurma" name="nTurma"></select>
        <input type="hidden" name="salaDado">
        <input type="hidden" name="profDado">
        <input type="hidden" name="discDado">
        <input type="hidden" name="trumaDado">
      </div>
    </div>
    <div class="form-group">
      <label for="disciplina" required>Disciplina:</label>
      <input type="text" id="disciplina" name="disciplina" class="buscarInfo">
      <div class="select-wrapper">
        <select class="selsel" id="nDisciplina" name="nDisciplina"></select>
      </div>
    </div>
    <div class="form-group">
      <label>Tipo do Agendamento:</label>
      <select name="evento" id="evento">
        <option value="unico">Evento único</option>
        <option value="semanal">Evento Semanal</option>
        <option value="trimestral">Evento Trimestral</option>
      </select>
      <label id="data1" for="data" required> Data Inicial: </label>
      <input type="date" name="data1" id="data1">
      <label id="data2" for="data"> Data de Final: </label>
      <input type="date" name="data2" id="data2">
    </div>
    <div class="form-group">
      <label for="turno">Turno:</label>
      <select id="turnos">
        <option value="todos">Todos os Turnos</option>
        <option value="matutino">Turno Matutino</option>
        <option value="vespertino">Turno Vespertino</option>
      </select>
    </div>
    <div class="checkbox-group">
      <div class="v1">
        <label>Horário Matutino:</label>
        <label><input type="checkbox" name="horario[]" id="horario1" value="07:00 - 07:45" >07:00 - 07:45</label>
        <label><input type="checkbox" name="horario[]" id="horario2" value="07:45 - 08:30">07:45 - 08:30</label>
        <label>Intervalo</label>
        <label><input type="checkbox" name="horario[]" id="horario3" value="08:50 - 09:35">08:50 - 09:35</label>
        <label><input type="checkbox" name="horario[]" id="horario4" value="09:35 - 10:20">09:35 - 10:20</label>
        <label>Intervalo</label>
        <label><input type="checkbox" name="horario[]" id="horario5" value="10:30 - 11:15">10:30 - 11:15</label>
        <label><input type="checkbox" name="horario[]" id="horario6" value="11:15 - 12:00">11:15 - 12:00</label>
      </div>
      <div class="v2">
        <label>Horário Vespertino:</label>
        <label><input type="checkbox" name="horario[]" id="horario7" value="13:00 - 13:45">13:00 - 13:45</label>
        <label><input type="checkbox" name="horario[]" id="horario8" value="13:45 - 14:30">13:45 - 14:30</label>
        <label>Intervalo</label>
        <label><input type="checkbox" name="horario[]" id="horario9" value="14:50 - 15:35">14:50 - 15:35</label>
        <label><input type="checkbox" name="horario[]" id="horario10" value="15:35 - 16:20">15:35 - 16:20</label>
        <label>Intervalo</label>
        <label><input type="checkbox" name="horario[]" id="horario11" value="16:30 - 17:15">16:30 - 17:15</label>
        <label><input type="checkbox" name="horario[]" id="horario12" value="17:15 - 18:00">17:15 - 18:00</label><br>
      </div>
    </div>
    <div class="form-group">
      <div style="display: flex; justify-content: center; align-items: center;">
        <button class="submit" type="submit">Agendar Sala</button>
    </div>
  </form>
      </div>
  <script>
function voltar() {
    // Obtém o valor da origem da URL
    var urlParams = new URLSearchParams(window.location.search);
    var origem = urlParams.get('origem');
    
    if (origem === 'blocoA') {
        window.location.href = "blocoA.php?origem=blocoA";
    } else if (origem === 'blocoB') {
        window.location.href = "blocoB.php?origem=blocoB";
    } else {
        // Redireciona para a página inicial (ou faz outra ação)
        window.location.href = "index.php";
    }
}
</script>
  <script>
$(document).ready(function() {
  $(".buscarInfo").on("input", function() {
    var $input = $(this);
    var $selectWrapper = $input.next(".select-wrapper");
    var $select = $selectWrapper.find("select");

    if ($input.val().length > 0) {
      $.ajax({
        url: 'modal.php',
        type: 'POST',
        data: { buscarInfo: true, id: $input.attr("id"), val: $input.val() },
        success: function(svRetorno) {
          if (svRetorno !== '') {
            var resultado = svRetorno.split(";");
            $select.empty();
            for (var i = 0; i < resultado.length - 1; i++) {
              var info = resultado[i].split("-");
              var texto = info[1];
              $select.append('<option value="' + texto + '">' + texto + '</option>');
            }
            $selectWrapper.show();
          } else {
            $selectWrapper.hide();
          }
        }
      });
    } else {
      $selectWrapper.hide();
      $select.empty();
    }
  });

  $(".select-wrapper select").change(function() {
    var $select = $(this);
    var $input = $select.closest(".select-wrapper").prev(".buscarInfo");
    var selectedValue = $select.val();
    $input.val(selectedValue);
  });








      $("#turnos").change(function() {
        if ($(this).val() == "todos") {
          $(".checkbox-group").css("display", "flex");
          $(".v1, .v2").show();
        } else if ($(this).val() == "matutino") {
          $(".v2").hide();
          $(".checkbox-group").css("display", "flex");
          $(".v1").show();
        } else if ($(this).val() == "vespertino") {
          $(".v1").hide();
          $(".checkbox-group").css("display", "flex");
          $(".v2").show();
        }
      }).trigger('change');

      $("#evento").change(function() {
        if ($(this).val() == "unico") {
          $("#data1").css("display", "flex");
          $("#data1, #data2").show();
          $("#data2, #data2").hide();
        } else if ($(this).val() == "semanal" || $(this).val() == "trimestral") {
          $("#data1, #data2").css("display", "flex");
          $("#data1, #data2").show();
        }
      }).trigger('change');

      $(".submit").click(function() {
        msg();
      });

     
    });
  </script>
</body>
</html>
