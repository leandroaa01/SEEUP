<?php
require_once "conexao.php";

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
//infos do modal
if (isset($_POST["carregaModal"])) {
  $id = $_POST["id"];
  $dataAtual = date("Y-m-d");
  $horarioAtual = date('H:i:s');
  //$horarioAtual = "07:00:00";

  function verificaHorario($horario, $inicio, $fim)
  {
    $horarioFormatado = DateTime::createFromFormat('H:i:s', $horario);
    $inicioFormatado = DateTime::createFromFormat('H:i:s', $inicio);
    $fimFormatado = DateTime::createFromFormat('H:i:s', $fim);

    return $horarioFormatado >= $inicioFormatado && $horarioFormatado <= $fimFormatado;
  }

  $array = array(
    "07:00:00", "07:45:00", "07:45:01", "08:30:00", "08:50:00", "09:35:00",
    "09:35:01", "10:20:00", "10:30:00", "11:15:00", "11:15:01", "12:00:00",
    "13:00:00", "13:45:00", "13:45:01", "14:30:00", "14:50:00", "15:35:00",
    "15:35:01", "16:20:00", "16:30:00", "17:15:00", "17:15:01", "18:00:00"
  );

  $horabdd = "";
  $colH = "";

  for ($i = 0; $i < count($array); $i += 2) {
    $c = $i + 1;
    if (verificaHorario($horarioAtual, $array[$i], $array[$c])) {
      $horabdd = substr($array[$i], 0, 5) . " - " . substr($array[$c], 0, 5);
      $colH = "Horario" . ($i / 2 + 1); // Incrementar o valor de $i para o próximo horário
      break;
    }
  }

  if (!empty($horabdd) && !empty($colH)) {
    $sql = "SELECT * FROM ResevaSala WHERE DataDaReseva = '$dataAtual' AND $colH = '$horabdd' AND sala = '$id'";
    $resultado1 = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado1) > 0) {
    $dados1  = mysqli_fetch_array($resultado1);
    $sql     = "SELECT * FROM  Sevidores WHERE matricula = '".$dados1['prof']."'";
    $result3 = mysqli_query($conn, $sql);
    $dados2  = mysqli_fetch_array($result3);
    $sql     = "SELECT * FROM  Salas WHERE id = '".$dados1['sala']."'";
    $result3 = mysqli_query($conn, $sql);
    $dados3 = mysqli_fetch_array($result3);
    $sql     = "SELECT * FROM Disciplinas WHERE cod_dici = '".$dados1['diciplina']."'";
    $result4 = mysqli_query($conn, $sql);
    $dados4 = mysqli_fetch_array($result4);
    $sql     = "SELECT * FROM Turmas WHERE  cod_tma = '".$dados1['turma']."'";
    $result5 = mysqli_query($conn, $sql);
    $dados5 = mysqli_fetch_array($result5);
    echo $dados3['descricao_chave'].';';
    echo $dados2['nome_prof'].';';
    echo $dados4['nome_dici'].';';
    echo $dados5['nome_tma'].';';
  }else {
    // Não há agendamento para a sala, exibir apenas o nome da sala
    $sql     = "SELECT * FROM  Salas WHERE id ='$id' ";
    $result3 = mysqli_query($conn, $sql);
    $dados3 = mysqli_fetch_array($result3);
    echo $dados3['descricao_chave'].';;;';
  }
}
}

// funão autocomplete 
if (isset($_POST["buscarInfo"])) {
  $id  = $_POST["id"];
  $val = $_POST["val"];

  if ($id == "nome-sala") {
    $tabela = "Salas";
    $campo = "descricao_chave";
    $chave = "id";
  } else if ($id == "professor") {
    $tabela = "Sevidores";
    $campo = "nome_prof";
    $chave = "matricula";
  } else if ($id == "turma") {
    $tabela = "Turmas";
    $campo = "nome_tma";
    $chave = "cod_tma";
  } else if ($id == "disciplina") {
    $tabela = "Disciplinas";
    $campo = "nome_dici";
    $chave = "cod_dici";
  }

  $sql = "SELECT $chave, $campo FROM $tabela WHERE $campo LIKE '%$val%'";
  $result = mysqli_query($conn, $sql);

  $response = "";

  while ($dados = mysqli_fetch_array($result)) {
    $response .= $dados[$chave] . '-' . $dados[$campo] . ';';
  }

  echo $response;
}
// função Status 
if (isset($_POST["sit"])) {
  $id = $_POST["id"];
  $dataAtual = date("Y-m-d");
  $horarioAtual = date('H:i:s');
  //$horarioAtual = "08:31:00";

  function verificaHorario($horario, $inicio, $fim)
  {
    $horarioFormatado = DateTime::createFromFormat('H:i:s', $horario);
    $inicioFormatado = DateTime::createFromFormat('H:i:s', $inicio);
    $fimFormatado = DateTime::createFromFormat('H:i:s', $fim);

    return $horarioFormatado >= $inicioFormatado && $horarioFormatado <= $fimFormatado;
  }

  $array = array(
    "07:00:00", "07:45:00", "07:45:01", "08:30:00", "08:50:00", "09:35:00",
    "09:35:01", "10:20:00", "10:30:00", "11:15:00", "11:15:01", "12:00:00",
    "13:00:00", "13:45:00", "13:45:01", "14:30:00", "14:50:00", "15:35:00",
    "15:35:01", "16:20:00", "16:30:00", "17:15:00", "17:15:01", "18:00:00"
  );

  $horabdd = "";
  $colH = "";

  for ($i = 0; $i < count($array); $i += 2) {
    $c = $i + 1;
    if (verificaHorario($horarioAtual, $array[$i], $array[$c])) {
      $horabdd = substr($array[$i], 0, 5) . " - " . substr($array[$c], 0, 5);
      $colH = "Horario" . ($i / 2 + 1); // Incrementar o valor de $i para o próximo horário
      break;
    }
  }

  if (!empty($horabdd) && !empty($colH)) {
    $sql = "SELECT * FROM ResevaSala WHERE DataDaReseva = '$dataAtual' AND $colH = '$horabdd' AND sala = '$id'";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
      echo "Ocupado";
    } else {
      // Verificar se está dentro dos intervalos
      if ((verificaHorario($horarioAtual, "08:30:01", "08:49:59") ||
           verificaHorario($horarioAtual, "10:20:01", "10:29:59") ||
           verificaHorario($horarioAtual, "14:30:01", "14:49:59") ||
           verificaHorario($horarioAtual, "16:20:01", "16:29:59"))) {
        echo "Intervalo";
      } else {
        echo "Disponíveis";
      }
    }
  } else {
    echo "Local Fechado no Horario Atual";
  }
}





if (isset($_POST["hrrs"])) {
  $id = $_POST["id"];
  $dataAtual = date("Y-m-d");
  $horarioAtual = date('H:i:s');

  $horarioInicio = array(
      "07:00 - 07:45",
      "07:45 - 08:30",
      "08:50 - 09:35",
      "09:35 - 10:20",
      "10:30 - 11:15",
      "11:15 - 12:00",
      "13:00 - 13:45",
      "13:45 - 14:30",
      "14:50 - 15:35",
      "15:35 - 16:20",
      "16:30 - 17:15",
      "17:15 - 18:00"
  );

  $horarioInicioAgendado = array();
  $horarioFimAgendado = array();

  // Obtém os horários agendados para a sala e data atual
  $sql = "SELECT * FROM ResevaSala WHERE DataDaReseva = '$dataAtual' AND sala = '$id'";
  $resultado = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($resultado)) {
      for ($i = 1; $i <= 12; $i++) {
          $colH = "Horario" . $i;
          if (!empty($row[$colH])) {
              $horarioInicioAgendado[] = substr($horarioInicio[$i - 1], 0, 5);
              $horarioFimAgendado[] = substr($horarioInicio[$i - 1], 8, 5);
          }
      }
  }

  $horarioInicioExibicao = '';
  $horarioFimExibicao = '';

  // Encontra o primeiro horário agendado que é maior ou igual ao horário atual
  for ($i = 0; $i < count($horarioInicioAgendado); $i++) {
      if ($horarioInicioAgendado[$i] <= $horarioAtual && $horarioFimAgendado[$i] >= $horarioAtual) {
          $horarioInicioExibicao = $horarioInicioAgendado[$i];
          $horarioFimExibicao = $horarioFimAgendado[count($horarioFimAgendado) - 1];
          break;
      }
  }

  if (!empty($horarioInicioExibicao) && !empty($horarioFimExibicao)) {
      echo "De $horarioInicioExibicao até as $horarioFimExibicao.";
  } else {
      echo "Não há agendamento no horario Atual.";
  }
}





//função tipo de agendamento
if (isset($_POST["agdt"])) {
  // Obtém o ID da sala selecionada
  $id = $_POST["id"];
  $dataAtual = date("Y-m-d");
  $horarioAtual = date('H:i:s');
  
  function verificaHorario($horario, $inicio, $fim)
  {
    $horarioFormatado = DateTime::createFromFormat('H:i:s', $horario);
    $inicioFormatado = DateTime::createFromFormat('H:i:s', $inicio);
    $fimFormatado = DateTime::createFromFormat('H:i:s', $fim);

    return $horarioFormatado >= $inicioFormatado && $horarioFormatado <= $fimFormatado;
  }

  $array = array(
    "07:00:00", "07:45:00", "07:45:01", "08:30:00", "08:50:00", "09:35:00",
    "09:35:01", "10:20:00", "10:30:00", "11:15:00", "11:15:01", "12:00:00",
    "13:00:00", "13:45:00", "13:45:01", "14:30:00", "14:50:00", "15:35:00",
    "15:35:01", "16:20:00", "16:30:00", "17:15:00", "17:15:01", "18:00:00"
  );

  $horabdd = "";
  $colH = "";

  for ($i = 0; $i < count($array); $i += 2) {
    $c = $i + 1;
    if (verificaHorario($horarioAtual, $array[$i], $array[$c])) {
      $horabdd = substr($array[$i], 0, 5) . " - " . substr($array[$c], 0, 5);
      $colH = "Horario" . ($i / 2 + 1); // Incrementar o valor de $i para o próximo horário
      break;
    }
  }

  if (!empty($horabdd) && !empty($colH)) {
    $sql = "SELECT * FROM ResevaSala WHERE DataDaReseva = '$dataAtual' AND $colH = '$horabdd' AND sala = '$id'";
    $resultado1 = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado1) > 0) {
      $row2= $resultado1->fetch_assoc();
        $dataInicial = new DateTime($row2["DataDaReseva"]);
          $dataFim = new DateTime($row2["Datafim"]);

          //echo $diferenca_dias;

      // Calcula a diferença entre as datas de início e fim em dias
      $diferencaDias = $dataFim->diff($dataInicial)->days;

      // Verifica se a reserva é única, semanal ou trimestral
      if ($dataFim == $dataInicial) {
        echo "único";
      } else if ($diferencaDias >= 90) {
        echo "trimestral";
      } else {
        echo "Semanal";
      }
    }
  }
}

?>







