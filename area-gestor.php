<<<<<<< HEAD
<?php
include_once "admin/config.inc.php";

if(!isset($_SESSION)) session_start();


$sql = "SELECT * FROM ocorrencias";
$listar = mysqli_query($conexao,$sql);

if($listar == false){
    echo "Erro ao Listar" . mysqli_error($conexao);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área do Gestor - HelpDesk</title>
    <link rel="stylesheet" href="css/area-gestor.css">
</head>

<body>

<div class="header">
    Área do Gestor - HelpDesk
    <button onclick="window.location.href='login-gestor.php'" class="btn-sair">Sair</button>
</div>

<div class="main-container">
    <div class="section">
        <h2>Abertura de Ocorrência</h2>
        <div class="btn-group-top">
            <button class="btn-nova" onclick="abrirFormulario()">Nova Ocorrência</button>
            <button class="btn-nova" onclick="abrirFormularioCliente()">Cadastrar Cliente</button>
            <button class="btn-nova" onclick="abrirFormularioFuncionario()">Cadastrar Funcionário</button>
        </div>
    </div>

    <div class="section">
        <h2>Histórico de Ocorrências</h2>
        <table>
            <thead>
                <th>Cliente</th>
                <th>Técnico</th>
                <th>Inicio</th>
                <th>Status</th>
                <th>Ações</th>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($listar) > 0): ?>
                    <?php while($linha = mysqli_fetch_assoc($listar)): ?>
                        <tr>
                            <td><?php echo $linha['cliente'] ?></td>
                            <td><?php echo $linha['tecnico'] ?></td>
                            <td><?php echo $linha['inicio'] ?></td>
                            <td><?php echo $linha['status_ocorrencia'] ?></td>
                            <td> <a href="editar-gestor.php"><button class="btn-salvar">Editar</button></a> 
                            <a href="editar-gestor.php"><button class="btn-cancel">Excluir</button></a></td>
                        </tr>
                    <?php endwhile;?>
                    <?php endif;?>
            </tbody>
        </table>
    </div>
</div>

<?php include "includes/cliente-cadastro.php"?>

<?php include "includes/ocorrencia-cadastro.php"?>

<?php include "includes/funcionario-cadastro.php" ?>

<script>
function abrirFormulario(){document.getElementById("formModal").style.display="flex";}
function fecharFormulario(){document.getElementById("formModal").style.display="none";}
function abrirFormularioCliente(){document.getElementById("formCliente").style.display="flex";}
function fecharFormularioCliente(){document.getElementById("formCliente").style.display="none";}
function abrirFormularioFuncionario(){document.getElementById("formFuncionario").style.display="flex";}
function fecharFormularioFuncionario(){document.getElementById("formFuncionario").style.display="none";}
</script>

</body>
=======
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área do Gestor - HelpDesk</title>
    <link rel="stylesheet" href="css/area-gestor.css">
</head>

<body>

<div class="header">
    Área do Gestor - HelpDesk
    <button onclick="window.location.href='login-gestor.php'" 
        style="position:absolute; top:15px; right:20px; padding:8px 16px; 
        background:#b33; color:#fff; border:none; border-radius:6px; cursor:pointer;">
    Sair
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
>>>>>>> fbe4ea070410005f4dd9106281c65f8bdbab6a82
</html>