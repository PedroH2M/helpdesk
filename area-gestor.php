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

<?php include "cliente-cadastro.php"?>

<div class="modal" id="formCliente">
    <div class="form-box">
        <form action="" method="POST">
            <h2>Cadastrar Cliente</h2>

            <label>Nome do Cliente:</label>
            <input type="text">

            <label>CNPJ / CPF:</label>
            <input type="text">

            <label>Email:</label>
            <input type="email">

            <label>Telefone:</label>
            <input type="text">

            <div class="btn-group">
                <button class="btn-salvar">Salvar</button>
                <button class="btn-cancel" onclick="fecharFormularioCliente()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="formFuncionario">
    <div class="form-box">
        <h2>Cadastrar Funcionário</h2>

        <label>Nome do Funcionário:</label>
        <input type="text">

        <label>Usuário:</label>
        <input type="text">

        <label>Senha:</label>
        <input type="password">

        <label>Função:</label>
        <select>
            <option>Técnico</option>
            <option>Gestor</option>
            <option>Administrador</option>
        </select>

        <div class="btn-group">
            <button class="btn-salvar">Salvar</button>
            <button class="btn-cancel" onclick="fecharFormularioFuncionario()">Cancelar</button>
        </div>
    </div>
</div>

<script>
function abrirFormulario(){document.getElementById("formModal").style.display="flex";}
function fecharFormulario(){document.getElementById("formModal").style.display="none";}
function abrirFormularioCliente(){document.getElementById("formCliente").style.display="flex";}
function fecharFormularioCliente(){document.getElementById("formCliente").style.display="none";}
function abrirFormularioFuncionario(){document.getElementById("formFuncionario").style.display="flex";}
function fecharFormularioFuncionario(){document.getElementById("formFuncionario").style.display="none";}
</script>

</body>
</html>