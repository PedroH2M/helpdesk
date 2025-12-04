<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Área do Técnico - HelpDesk</title>
    <link rel="stylesheet" href="css/area-tecnico.css">
<body>

<?php 
    require_once "admin/config.inc.php";
    if(!isset($_SESSION)) {
    session_start();
    }

    $tecnico = $_SESSION['tecnico']; 

    $sql = "SELECT * FROM ocorrencias WHERE tecnico = '$tecnico'";
    $resultado = mysqli_query($conexao,$sql);
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
        <?php 
        while($dados = mysqli_fetch_array($resultado)) {
        ?>
                <tr>
                    <td><?= $dados['cliente'] ?></td>
                    <td><?= $dados['tecnico'] ?></td>
                    <td><?= $dados['data_inicio'] . " " . $dados['inicio'] ?></td>
                    <td><?= $dados['data_fim'] . " " . $dados['fim'] ?></td>
                    <td><?= $dados['status_ocorrencia'] ?></td>
                </tr>
        <?php 
            }
        ?>
            </thead>
            <tbody id="historico"></tbody>
        </table>
    </div>
</div>

<!-- POPUP -->
 <form action="admin/ocorrencia-cadastro-tecnico.php">
    <div class="popup-bg" id="popupBg">
        <div class="popup">
            <h2>Nova Ocorrência</h2>

            <label>Cliente:</label>
            <input list="listaclientes" id="cliente" name="cliente" placeholder="Digite o nome do cliente...">
            <datalist id="listaclientes">
                <?php 
                    $sql = "SELECT id, nome FROM clientes ORDER BY nome ASC";
                    $result = $conexao->query($sql);

                    while($row = $result->fetch_assoc()){
                        echo '<option value="'.$row['nome'].'">'.$row['id'].'</option>';
                    }
                ?>
            </datalist>

            <label>Técnico:</label>
            <input list="listaTecnicos" id="tecnico" name="tecnico" placeholder="Digite o nome do técnico...">

            <datalist id="listaTecnicos">
                <?php
                    $sql = "SELECT id, usuario FROM usuarios ORDER BY usuario ASC";
                    $result = $conexao->query($sql);

                    while($row = $result->fetch_assoc()){
                        echo '<option value="'.$row['usuario'].'" data-id="'.$row['id'].'"></option>';
                    }
                ?>
            </datalist>

                <label>Início:</label>
                <div style="display:flex; gap:10px;">
                    <input type="date" id="data_inicio" name="data_inicio" />
                    <input type="time" id="hora_inicio" name="hora_inicio" />
                </div>
                <label>Fim:</label>
                <div style="display:flex; gap:10px;">
                    <input type="date" id="data_fim" name="data_fim"/>
                    <input type="time" id="hora_fim" name="hora_fim"/>
                </div>
                <textarea id="motivo" placeholder="Motivo da ocorrência" name="motivo"></textarea>
                <select id="status" name="status">
                    <option>Pendente</option>
                    <option>Em andamento</option>
                    <option>Finalizado</option>
                </select>
                <button type="submit" onclick="salvarOcorrencia()">Salvar</button>
                <button type="button" style="background:#b33" onclick="fecharPopup()">Cancelar</button>
                    </div>
    </div>
</form>

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

    tabela.innerHTML += linha;

    fecharPopup();
}
</script>

    
</tbody>
</body>
</html>
