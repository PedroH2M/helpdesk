<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área do Gestor - HelpDesk</title>
    <link rel="stylesheet" href="css/area-gestor.css">
</head>

<?php

include_once "admin/config.inc.php";

    if(!isset($_SESSION)) {
    session_start();
}
?>
<body>

<div class="header">
    Área do Gestor - HelpDesk
    <button class="btn-sair">Sair</button>
</div>

<div class="main-container">
    <div class="section">
        <h2>Abertura de Ocorrência</h2>
        <button class="btn-nova" onclick="abrirFormulario()">Nova Ocorrência</button>
    </div>

    <div class="section">
        <h2>Histórico de Ocorrências</h2>

        <table>
            <tr>
                <th>Cliente</th>
                <th>Técnico</th>
                <th>Início</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            <tr>
                <td>Empresa X</td>
                <td>João</td>
                <td>01/11/2025 14:00</td>
                <td>Pendente</td>
                <td>
                    <button class="btn-editar">Editar</button>
                    <button class="btn-excluir">Excluir</button>
                </td>
            </tr>
            <tr>
                <td>Empresa Y</td>
                <td>Maria</td>
                <td>02/11/2025 10:30</td>
                <td>Concluída</td>
                <td>
                    <button class="btn-editar">Editar</button>
                    <button class="btn-excluir">Excluir</button>
                </td>
            </tr>
        </table>
    </div>

</div>

<div class="modal" id="formModal">
    <div class="form-box">
        <h2>Nova Ocorrência</h2>

        <label>Cliente:</label>
        <select>
            <option>Selecione o cliente...</option>
        </select>

        <label>Nome do Técnico:</label>
        <input type="text">

        <label>Início:</label>
        <div class="date-time">
            <input type="date">
            <input type="time">
        </div>

        <label>Fim:</label>
        <div class="date-time">
            <input type="date">
            <input type="time">
        </div>

        <label>Motivo da ocorrência:</label>
        <textarea></textarea>

        <label>Status:</label>
        <select>
            <option>Pendente</option>
            <option>Em andamento</option>
            <option>Concluída</option>
        </select>

        <div class="btn-group">
            <button class="btn-salvar">Salvar</button>
            <button class="btn-cancel" onclick="fecharFormulario()">Cancelar</button>
        </div>
    </div>
</div>

<script>
    function abrirFormulario() {
        document.getElementById("formModal").style.display = "flex";
    }
    function fecharFormulario() {
        document.getElementById("formModal").style.display = "none";
    }
</script>

</body>
</html>