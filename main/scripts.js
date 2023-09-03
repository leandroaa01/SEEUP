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

if (resultado[0].trim() === "Disponíveis" || resultado[0].trim() === "Local Fechado no Horario Atual") {
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
