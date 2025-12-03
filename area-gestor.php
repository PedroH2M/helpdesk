<?php
include_once "admin/config.inc.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = intval($_POST['delete_id']);
    mysqli_query($conexao, "DELETE FROM ocorrencias WHERE id = $id");
}


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
                            <td>
                                <button class="btn-salvar" onclick="abrirFormularioEditar('<?= $linha['id'] ?>',
                                '<?= $linha['cliente'] ?>',
                                '<?= $linha['tecnico'] ?>',
                                '<?= $linha['status_ocorrencia'] ?>'
                                )">Editar</button>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="delete_id" value="<?= $linha['id'] ?>">
                                    <button class="btn-cancel" type="submit">Excluir</button>
                                </form>
                            </td>
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

<?php include "includes/ocorrencias-editar.php" ?>

<script>
function abrirFormulario(){document.getElementById("formModal").style.display = "flex";}
function fecharFormulario(){document.getElementById("formModal").style.display = "none";}
function abrirFormularioCliente(){document.getElementById("formCliente").style.display = "flex";}
function fecharFormularioCliente(){document.getElementById("formCliente").style.display = "none";}
function abrirFormularioFuncionario(){document.getElementById("formFuncionario").style.display = "flex";}
function fecharFormularioFuncionario(){document.getElementById("formFuncionario").style.display = "none";}

function abrirFormularioEditar(id,cliente, tecnico, status){
    document.getElementById("formEditar").style.display = "flex";
    document.getElementById("id").value = id;
    document.getElementById("cliente").value = cliente;
    document.getElementById("tecnico").value = tecnico;
    document.getElementById("status").value = status;
}
function fecharFormularioEditar() {
    document.getElementById("formEditar").style.display = "none";
}
</script>

</body>
</html>
