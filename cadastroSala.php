<?php
require_once "conexao.php";

// Função para verificar a disponibilidade dos horários selecionados
function verificarDisponibilidade($conn, $horarios, $data, $sala) {
  $horariosOcupados = array();

  foreach ($horarios as $horario) {
      $sqlVerificarHorario = "SELECT * FROM ResevaSala WHERE sala = '$sala' AND DataDaReseva = '$data' AND (Horario1 = '$horario' OR Horario2 = '$horario' OR Horario3 = '$horario' OR Horario4 = '$horario' OR Horario5 = '$horario' OR Horario6 = '$horario' OR Horario7 = '$horario' OR Horario8 = '$horario' OR Horario9 = '$horario' OR Horario10 = '$horario' OR Horario11 = '$horario' OR Horario12 = '$horario')";
      $resultVerificarHorario = mysqli_query($conn, $sqlVerificarHorario);

      if (mysqli_num_rows($resultVerificarHorario) > 0) {
          // Horário está ocupado
          $horariosOcupados[] = $horario;
      }
  }

  return $horariosOcupados;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Verifica se os campos do formulário foram enviados
  if (isset($_POST["nome-sala"], $_POST["professor"], $_POST["turma"], $_POST["disciplina"], $_POST["evento"], $_POST["data1"], $_POST["data2"], $_POST["horario"])) {
    $nomeSala =  strtoupper($_POST["nome-sala"]);
    $professor = strtoupper($_POST["professor"]);
    $turma = strtoupper($_POST["turma"]);
    $disciplina = strtoupper($_POST["disciplina"]);
    $evento = $_POST["evento"];
    $dataInicio = $_POST["data1"];
    $dataFim = $_POST["data2"];
    $horarios = $_POST["horario"];



    $sql = "SELECT id FROM Salas WHERE descricao_chave = '$nomeSala'";
    $result = mysqli_query($conn, $sql);
    $dados  = mysqli_fetch_array($result);
    $nomeSala = $dados["id"];
    //echo ($nomeSala);

    $sql = "SELECT matricula FROM Sevidores WHERE nome_prof = '$professor'";
    $result = mysqli_query($conn, $sql);
    $dados  = mysqli_fetch_array($result);
    $professor = $dados["matricula"];
    //echo ($professor);

    $sql = "SELECT cod_dici FROM Disciplinas WHERE nome_dici = '$disciplina'";
    $result = mysqli_query($conn, $sql);
    $dados  = mysqli_fetch_array($result);
    $disciplina = $dados["cod_dici"];
    

    $sql = "SELECT cod_tma FROM Turmas WHERE nome_tma = '$turma'";
    $result = mysqli_query($conn, $sql);
    $dados  = mysqli_fetch_array($result);
    $turma = $dados["cod_tma"];
    //echo ($turma);

    // Variáveis para os horários selecionados
    $h1 = NULL;
    $h2 = NULL;
    $h3 = NULL;
    $h4 = NULL;
    $h5 = NULL;
    $h6 = NULL;
    $h7 = NULL;
    $h8 = NULL;
    $h9 = NULL;
    $h10 = NULL;
    $h11 = NULL;
    $h12 = NULL;

    foreach ($horarios as $horario) //Analisa os horários selecionados pelo usuário
    {
      if     ($horario == "07:00 - 07:45") {$h1 = "07:00 - 07:45 ";}
      elseif ($horario == "07:45 - 08:30") {$h2 = "07:45 - 08:30";} 
      elseif ($horario == "08:50 - 09:35") {$h3 = "08:50 - 09:35";}
      elseif ($horario == "09:35 - 10:20") {$h4 = "09:35 - 10:20";}
      elseif ($horario == "10:30 - 11:15") {$h5 = "10:30 - 11:15";}
      elseif ($horario == "11:15 - 12:00") {$h6 = "11:15 - 12:00";}
      elseif ($horario == "13:00 - 13:45") {$h7 = "13:00 - 13:45";}
      elseif ($horario == "13:45 - 14:30") {$h8 = "13:45 - 14:30";}
      elseif ($horario == "14:50 - 15:35") {$h9 = "14:50 - 15:35";}
      elseif ($horario == "15:35 - 16:20") {$h10= "15:35 - 16:20";}
      elseif ($horario == "16:30 - 17:15") {$h11= "16:30 - 17:15";}
      elseif ($horario == "17:15 - 18:00") {$h12= "17:15 - 18:00";}
    }

    if ($evento == "unico") {
      $dataFim = $dataInicio;

      $horariosOcupados = verificarDisponibilidade($conn, $horarios, $dataInicio, $nomeSala);
      


    if (!empty($horariosOcupados) && is_array($horariosOcupados)) {
      // Mostrar mensagem de erro com os horários ocupados
      $horariosOcupadosStr = implode(", ", $horariosOcupados);
      echo '<script>
            alert("Os horários (' . $horariosOcupadosStr . ') estão ocupados para a data selecionada. Por favor, escolha outros horários.");
            window.location.href = "caSala.php";
            </script>';
      //exit;
    }
      // Consulta SQL de inserção
  $sql = "INSERT INTO ResevaSala (prof, sala, turma, diciplina, DataDaReseva, DataFim, Horario1, Horario2, Horario3, Horario4, Horario5, Horario6, Horario7, Horario8, Horario9, Horario10, Horario11, Horario12) VALUES ('$professor', '$nomeSala', '$turma', '$disciplina', '$dataInicio', '$dataFim', '$h1', '$h2', '$h3', '$h4','$h5','$h6','$h7','$h8','$h9','$h10','$h11','$h12')";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    // Cadastro realizado com sucesso

    // Atualizar a situacao da sala para "Indisponível"
    $sqlUpdateSituacao = "UPDATE Salas SET situacao = 'Ocupado' WHERE id = '$nomeSala'";
    $resultUpdateSituacao = mysqli_query($conn, $sqlUpdateSituacao);

    if ($resultUpdateSituacao)
     {
      echo '<script>
            alert("Agendamento realizado com sucesso!");
            window.location.href = "blocoA.php";
            </script>';
    }
     else 
    {
      echo "Erro ao atualizar a situação da sala: " . mysqli_error($conn);
    }
  }
   else
   {
    // Ocorreu um erro ao inserir no banco de dados
    echo "Erro ao inserir no banco de dados: " . mysqli_error($conn);
  }
    

  $horariosOcupados = verificarDisponibilidade($conn, $horarios, $dataInicio, $nomeSala);



    if (!empty($horariosOcupados) && is_array($horariosOcupados))
   {
      // Mostrar mensagem de erro com os horários ocupados
      $horariosOcupadosStr = implode(", ", $horariosOcupados);
      echo '<script>
            alert("Os horários (' . $horariosOcupadosStr . ') estão ocupados para a data selecionada. Por favor, escolha outros horários.");
            window.location.href = "caSala.php";
            </script>';
      //exit;
    }
      // Consulta SQL de inserção
  $sql = "INSERT INTO ResevaSala (prof, sala, turma, diciplina, DataDaReseva, DataFim, Horario1, Horario2, Horario3, Horario4, Horario5, Horario6, Horario7, Horario8, Horario9, Horario10, Horario11, Horario12) VALUES ('$professor', '$nomeSala', '$turma', '$disciplina', '$dataInicio', '$dataFim', '$h1', '$h2', '$h3', '$h4','$h5','$h6','$h7','$h8','$h9','$h10','$h11','$h12')";
  $result = mysqli_query($conn, $sql);

  if ($result) 
  {
    // Cadastro realizado com sucesso

    // Atualizar a situacao da sala para "Indisponível"
    $sqlUpdateSituacao = "UPDATE Salas SET situacao = 'Ocupado' WHERE id = '$nomeSala'";
    $resultUpdateSituacao = mysqli_query($conn, $sqlUpdateSituacao);

    if ($resultUpdateSituacao)
 {
  echo '<script>
  alert("Agendamento realizado com sucesso!");
  window.location.href = "blocoA.php";
  </script>';
  }
     else 
    {
      echo "Erro ao atualizar a situação da sala: " . mysqli_error($conn);
    }
  }
   else 
  {
    // Ocorreu um erro ao inserir no banco de dados
    echo "Erro ao inserir no banco de dados: " . mysqli_error($conn);
  }
  } else
  {

    $horariosOcupados = verificarDisponibilidade($conn, $horarios, $dataInicio, $nomeSala);



    if (!empty($horariosOcupados) && is_array($horariosOcupados)) {
      // Mostrar mensagem de erro com os horários ocupados
      $horariosOcupadosStr = implode(", ", $horariosOcupados);
      echo '<script>
            alert("Os horários (' . $horariosOcupadosStr . ') estão ocupados para a data selecionada. Por favor, escolha outros horários.");
            window.location.href = "caSala.php";
            </script>';
      //exit;
    }
    
while ($dataInicio <= $dataFim) {
  $sql = "INSERT INTO ResevaSala (prof, sala, turma, diciplina, DataDaReseva, DataFim, Horario1, Horario2, Horario3, Horario4, Horario5, Horario6, Horario7, Horario8, Horario9, Horario10, Horario11, Horario12) VALUES ('$professor', '$nomeSala', '$turma', '$disciplina', '$dataInicio', '$dataInicio', '$h1', '$h2', '$h3', '$h4','$h5','$h6','$h7','$h8','$h9','$h10','$h11','$h12')";
  $result1 = mysqli_query($conn, $sql);
  
  // Incrementa a data de início em 7 dias
  $dataInicio = date('Y-m-d', strtotime($dataInicio . ' +7 days'));
 
}
    
    if ($result1) 
  {
    // Cadastro realizado com sucesso

    // Atualizar a situacao da sala para "Indisponível"
    $sqlUpdateSituacao = "UPDATE Salas SET situacao = 'Ocupado' WHERE id = '$nomeSala'";
    $resultUpdateSituacao = mysqli_query($conn, $sqlUpdateSituacao);

    if ($resultUpdateSituacao)
 {
  echo '<script>
  alert("Agendamento realizado com sucesso!");
  window.location.href = "blocoA.php";
  </script>';
  }
     else 
    {
      echo "Erro ao atualizar a situação da sala: " . mysqli_error($conn);
    }
  }
  }

  }
}

?>