<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Área do Técnico - HelpDesk</title>
    <link rel="stylesheet" href="css/area-tecnico.css">
<body>
    
<?php 
    if(!isset($_SESSION)) {
    session_start();
}
?>


<header>Área do Técnico - HelpDesk</header>


<div class="container">
    <div class="card">
        <h2>Abertura de Ocorrência</h2>
        <button onclick="abrirPopup()">Nova Ocorrência</button>
        <button onclick="window.location.href='login-tecnico.php'" 
        style="position:absolute; top:15px; right:20px; padding:8px 16px; 
        background:#b33; color:#fff; border:none; border-radius:6px; cursor:pointer;">
    Sair
</button>

    </div>

    <div class="card">
        <h2>Histórico de Ocorrências</h2>
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Técnico</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="historico"></tbody>
        </table>
    </div>
</div>

<div class="popup-bg" id="popupBg">
    <div class="popup">
        <h2>Nova Ocorrência</h2>

        <label>Cliente:</label>
        <select id="cliente">
            <option value="">Selecione o cliente...</option>
            <option>Empresa Alpha</option>
            <option>Loja XPTO</option>
            <option>Clínica Vida+</option>
            <option>Construtora Real</option>
        </select>
        <input type="text" id="tecnico" placeholder="Nome do Técnico" />

        <label>Início:</label>
        <div style="display:flex; gap:10px;">
            <input type="date" id="data_inicio" />
            <input type="time" id="hora_inicio" />
        </div>

        <label>Fim:</label>
        <div style="display:flex; gap:10px;">
            <input type="date" id="data_fim" />
            <input type="time" id="hora_fim" />
        </div>

        <textarea id="motivo" placeholder="Motivo da ocorrência"></textarea>

        <select id="status">
            <option>Pendente</option>
            <option>Em andamento</option>
            <option>Finalizado</option>
        </select>

        <button onclick="salvarOcorrencia()">Salvar</button>
        <button style="background:#b33" onclick="fecharPopup()">Cancelar</button>
    </div>
</div>

<script>
function abrirPopup() {
    document.getElementById("popupBg").style.display = "flex";
}

function fecharPopup() {
    document.getElementById("popupBg").style.display = "none";
}

function salvarOcorrencia() {
    const cliente = document.getElementById("cliente").value;
    const tecnico = document.getElementById("tecnico").value;
    const inicio = document.getElementById("data_inicio").value + " " + document.getElementById("hora_inicio").value;
    const fim = document.getElementById("data_fim").value + " " + document.getElementById("hora_fim").value;
    const motivo = document.getElementById("motivo").value;
    const status = document.getElementById("status").value;

    const tabela = document.getElementById("historico");

    const linha = `
        <tr>
            <td>${cliente}</td>
            <td>${tecnico}</td>
            <td>${inicio}</td>
            <td>${fim}</td>
            <td>${status}</td>
        </tr>
    `;

    tabela.innerHTML += linha;

    fecharPopup();
}
</script>

</body>
</html>
