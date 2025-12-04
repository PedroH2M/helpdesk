<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Área do Gestor - HelpDesk</title>
    <link rel="stylesheet" href="css/area-gestor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php 
    require_once "admin/config.inc.php";
    if(!isset($_SESSION)) {
        session_start();
    }

    $sql = "SELECT * FROM ocorrencias";
    $resultado = mysqli_query($conexao,$sql);
?>

<button onclick="window.location.href='login-gestor.php'" class="botao-sair">Sair</button>

<header>Área do Gestor - HelpDesk</header>

<div class="container">
    <div class="card">
        <h2>Opções de Gestão</h2>

        <div style="display:flex; gap:10px;">
            <button onclick="abrirPopupOcorrencia()">Nova Ocorrência</button>
            <button onclick="abrirPopupCliente()">Cadastrar Cliente</button>
            <button onclick="abrirPopupFuncionario()">Cadastrar Funcionário</button>
        </div>

    </div>

    <!-- NOVO CARD COM AS 3 OPÇÕES -->
<div class="card">
    <h2>Consultas</h2>
    <div class="consultas-header">
        <button onclick="mostrarSecao('secao_ocorrencias')">Histórico de Ocorrências</button>
        <button onclick="mostrarSecao('secao_clientes')">Lista de Clientes</button>
        <button onclick="mostrarSecao('secao_funcionarios')">Lista de Funcionários</button>
    </div>

    <!-- SEÇÃO 1 – HISTÓRICO DE OCORRÊNCIAS -->
    <div id="secao_ocorrencias" class="secao" style="display:none;">
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Técnico</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT * FROM ocorrencias";
                $resultado = mysqli_query($conexao,$sql);

                while($dados = mysqli_fetch_array($resultado)) {
                ?>
                    <tr>
                        <td><?= $dados['cliente'] ?></td>
                        <td><?= $dados['tecnico'] ?></td>
                        <td><?= $dados['data_inicio'] . " " . $dados['inicio'] ?></td>
                        <td><?= $dados['data_fim'] . " " . $dados['fim'] ?></td>
                        <td><?= $dados['status_ocorrencia'] ?></td>
                        <td>
                            <button class="btn-edit" onclick="editarOcorrencia(<?= $dados['id'] ?>)">✏️</button>
                            <button class="btn-delete" onclick="excluirOcorrencia(<?= $dados['id'] ?>)">🗑️</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- SEÇÃO 2 – LISTA DE CLIENTES -->
    <div id="secao_clientes" class="secao" style="display:none;">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM clientes ORDER BY nome ASC";
                $res = mysqli_query($conexao, $sql);
                while($cli = mysqli_fetch_assoc($res)){
            ?>
                <tr>
                    <td><?= $cli['nome'] ?></td>
                    <td><?= $cli['documento'] ?></td>
                    <td><?= $cli['email'] ?></td>
                    <td><?= $cli['telefone'] ?></td>
                    <td>
                        <button class="btn-edit" onclick="editarCliente(<?= $cli['id'] ?>)">✏️</button>
                        <button class="btn-delete" onclick="excluirCliente(<?= $cli['id'] ?>)">🗑️</button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- SEÇÃO 3 – LISTA DE FUNCIONÁRIOS -->
    <div id="secao_funcionarios" class="secao" style="display:none;">
        <table>
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Função</th>
                    <th>Usuário</th>
                    <th>Senha</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM usuarios ORDER BY nome ASC";
                $res = mysqli_query($conexao, $sql);
                while($f = mysqli_fetch_assoc($res)){
                    $id = $f['id'];
            ?>
                <tr>
                    <td><?= $f['matricula'] ?></td>
                    <td><?= $f['nome'] ?></td>
                    <td><?= $f['email'] ?></td>
                    <td><?= $f['funcao'] ?></td>
                    <td><?= $f['usuario'] ?></td>

                    <!-- SENHA OCULTA -->
                    <td class="td-senha">
                        <span id="senha_oculta_<?= $id ?>">******</span>
                        <span id="senha_real_<?= $id ?>" style="display:none;"><?= $f['senha_usuario'] ?></span>

                        <button onclick="toggleSenha(<?= $id ?>)" id="btnSenha_<?= $id ?>" class="btn-eye"><i class="fa-solid fa-eye"></i></button>
                    </td>

                    <td>
                        <button class="btn-edit" onclick="editarFuncionario(<?= $f['id'] ?>)">✏️</button>
                        <button class="btn-delete" onclick="excluirFuncionario(<?= $f['id'] ?>)">🗑️</button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ======================= POPUP 1 – NOVA OCORRÊNCIA ======================= -->
<form action="admin/ocorrencia-cadastro-gestor.php" method="POST">
    <div class="popup-bg" id="popupOcorrencia">
        <div class="popup">
            <h2>Nova Ocorrência</h2>

            <label>Cliente:</label>
            <input list="listaclientes" id="cliente" name="cliente_edit" placeholder="Digite o nome do cliente...">
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
            <input list="listaTecnicos" id="tecnico" name="tecnico_edit">

            <datalist id="listaTecnicos">
                <?php
                    $sql = "SELECT id, usuario FROM usuarios ORDER BY usuario ASC";
                    $result = $conexao->query($sql);

                    while($row = $result->fetch_assoc()){
                        echo '<option value="'.$row['usuario'].'"></option>';
                    }
                ?>
            </datalist>

            <label>Início:</label>
            <div style="display:flex; gap:10px;">
                <input type="date" id="data_inicio" name="data_inicio_edit" />
                <input type="time" id="hora_inicio" name="hora_inicio_edit" />
            </div>

            <label>Fim:</label>
            <div style="display:flex; gap:10px;">
                <input type="date" id="data_fim" name="data_fim_edit"/>
                <input type="time" id="hora_fim" name="hora_fim_edit"/>
            </div>

            <textarea id="motivo" placeholder="Motivo da ocorrência" name="motivo_edit"></textarea>

            <select id="status" name="status_edit">
                <option>Pendente</option>
                <option>Em andamento</option>
                <option>Finalizado</option>
            </select><br><br><br>

            <button type="submit">Salvar</button>
            <button type="button" style="background:#b33" onclick="fecharPopupOcorrencia()">Cancelar</button>
        </div>
    </div>
</form>


<!-- ======================= POPUP 2 – CADASTRAR CLIENTE=======================-->
<form action="admin/cliente-cadastro.php" method="POST">
    <div class="popup-bg" id="popupCliente">
        <div class="popup">
            <h2>Cadastrar Cliente</h2>

            <label>Nome:</label>
            <input type="text" name="nome" required>

            <label>CPF / CNPJ:</label>
            <input type="text" name="documento" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Telefone:</label>
            <input type="text" name="telefone" required><br><br><br>

            <button type="submit">Salvar</button>
            <button type="button" style="background:#b33" onclick="fecharPopupCliente()">Cancelar</button>
        </div>
    </div>
</form>


<!-- ======================= POPUP 3 – CADASTRAR FUNCIONÁRIO ======================= -->
<form action="admin/funcionario-cadastro.php" method="POST">
    <div class="popup-bg" id="popupFuncionario">
        <div class="popup">
            <h2>Cadastrar Funcionário</h2>

            <label>Matrícula:</label>
            <input type="text" name="matricula" required>

            <label>Nome:</label>
            <input type="text" name="nome" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Função:</label>
            <select name="funcao" required>
                <option>Técnico</option>
                <option>Gestor</option>
            </select>

            <label>Usuário:</label>
            <input type="text" name="usuario" required>

            <label>Senha:</label>
            <input type="text" name="senha" required><br><br><br>

            <button type="submit">Salvar</button>
            <button type="button" style="background:#b33" onclick="fecharPopupFuncionario()">Cancelar</button>
        </div>
    </div>
</form>

<!-- ======================= POPUP 4 – EDITAR OCORRÊNCIA ======================= -->
<form action="admin/ocorrencia-editar.php" method="POST">
    <div class="popup-bg" id="popupEditarOcorrencia">
        <div class="popup">
            <h2>Editar Ocorrência</h2>

            <input type="hidden" id="edit_id" name="id">

            <label>Cliente:</label>
            <input list="listaclientes" id="edit_cliente" name="cliente">

            <label>Técnico:</label>
            <input list="listaTecnicos" id="edit_tecnico" name="tecnico">

            <label>Início:</label>
            <div style="display:flex; gap:10px;">
                <input type="date" id="edit_data_inicio" name="data_inicio" />
                <input type="time" id="edit_hora_inicio" name="hora_inicio" />
            </div>

            <label>Fim:</label>
            <div style="display:flex; gap:10px;">
                <input type="date" id="edit_data_fim" name="data_fim"/>
                <input type="time" id="edit_hora_fim" name="hora_fim"/>
            </div>

            <textarea id="edit_motivo" name="motivo" placeholder="Motivo da ocorrência"></textarea>

            <label>Status:</label>
            <select id="edit_status" name="status">
                <option>Pendente</option>
                <option>Em andamento</option>
                <option>Finalizado</option>
            </select>

            <button type="submit">Salvar</button>
            <button type="button" style="background:#b33" onclick="fecharPopupEditarOcorrencia()">Cancelar</button>
        </div>
    </div>
</form>

<!-- ======================= POPUP 5 – EDITAR CLIENTE ======================= -->

<form action="admin/cliente-editar.php" method="POST">
    <div class="popup-bg" id="popupEditarCliente">
        <div class="popup">
            <h2>Editar Cliente</h2>

            <input type="hidden" id="edit_cliente_id" name="id">

            <label>Nome:</label>
            <input type="text" id="edit_cliente_nome" name="nome">

            <label>CPF/CNPJ:</label>
            <input type="text" id="edit_cliente_documento" name="documento">

            <label>Email:</label>
            <input type="email" id="edit_cliente_email" name="email">

            <label>Telefone:</label>
            <input type="text" id="edit_cliente_telefone" name="telefone">

            <button type="submit">Salvar</button>
            <button type="button" style="background:#b33" onclick="fecharPopupEditarCliente()">Cancelar</button>
        </div>
    </div>
</form>

<!-- ======================= POPUP 6 – EDITAR FUNCIONÁRIO ======================= -->

<form action="admin/funcionario-editar.php" method="POST">
    <div class="popup-bg" id="popupEditarFuncionario">
        <div class="popup">
            <h2>Editar Funcionário</h2>

            <input type="hidden" id="edit_func_id" name="id">

            <label>Matrícula:</label>
            <input type="text" id="edit_func_matricula" name="matricula">

            <label>Nome:</label>
            <input type="text" id="edit_func_nome" name="nome">

            <label>Email:</label>
            <input type="email" id="edit_func_email" name="email">

            <label>Função:</label>
            <select id="edit_func_funcao" name="funcao">
                <option>Técnico</option>
                <option>Gestor</option>
            </select>

            <label>Usuário:</label>
            <input type="text" id="edit_func_usuario" name="usuario">

            <label>Senha:</label>
            <input type="text" id="edit_func_senha" name="senha_usuario">

            <button type="submit">Salvar</button>
            <button type="button" style="background:#b33" onclick="fecharPopupEditarFuncionario()">Cancelar</button>
        </div>
    </div>
</form>

<!-- ======================= JAVASCRIPT ======================= -->
<script>
function mostrarSecao(secao) {
    document.getElementById("secao_ocorrencias").style.display = "none";
    document.getElementById("secao_clientes").style.display = "none";
    document.getElementById("secao_funcionarios").style.display = "none";

    document.getElementById(secao).style.display = "block";
}

function abrirPopupOcorrencia() {
    document.getElementById("popupOcorrencia").style.display = "flex";
}
function fecharPopupOcorrencia() {
    document.getElementById("popupOcorrencia").style.display = "none";
}

function abrirPopupCliente() {
    document.getElementById("popupCliente").style.display = "flex";
}
function fecharPopupCliente() {
    document.getElementById("popupCliente").style.display = "none";
}

function abrirPopupFuncionario() {
    document.getElementById("popupFuncionario").style.display = "flex";
}
function fecharPopupFuncionario() {
    document.getElementById("popupFuncionario").style.display = "none";
}

function abrirPopupEditarOcorrencia() {
    document.getElementById("popupEditarOcorrencia").style.display = "flex";
}
function editarOcorrencia(id){
    fetch("admin/ocorrencia-buscar.php?id=" + id)
    .then(res => res.json())
    .then(dados => {

        document.getElementById("edit_id").value = dados.id;
        document.getElementById("edit_cliente").value = dados.cliente;
        document.getElementById("edit_tecnico").value = dados.tecnico;
        document.getElementById("edit_data_inicio").value = dados.data_inicio;
        document.getElementById("edit_hora_inicio").value = dados.inicio;
        document.getElementById("edit_data_fim").value = dados.data_fim;
        document.getElementById("edit_hora_fim").value = dados.fim;
        document.getElementById("edit_motivo").value = dados.motivo;
        document.getElementById("edit_status").value = dados.status_ocorrencia;

        abrirPopupEditarOcorrencia();
    })
    .catch(err => alert("Erro ao carregar dados da ocorrência."));
}
function fecharPopupEditarOcorrencia() {
    document.getElementById("popupEditarOcorrencia").style.display = "none";
}
function excluirOcorrencia(id){
    if(confirm("Tem certeza que deseja excluir esta ocorrência?")){
        window.location.href = "admin/ocorrencia-excluir.php?id=" + id;
    }
}

function abrirPopupEditarCliente() {
    document.getElementById("popupEditarCliente").style.display = "flex";
}
function editarCliente(id){
    fetch("admin/cliente-buscar.php?id=" + id)
    .then(res => res.json())
    .then(dados => {

        document.getElementById("edit_cliente_id").value = dados.id;
        document.getElementById("edit_cliente_nome").value = dados.nome;
        document.getElementById("edit_cliente_documento").value = dados.documento;
        document.getElementById("edit_cliente_email").value = dados.email;
        document.getElementById("edit_cliente_telefone").value = dados.telefone;

        abrirPopupEditarCliente();
    })
    .catch(err => alert("Erro ao carregar dados do cliente da ocorrência."));
}
function fecharPopupEditarCliente() {
    document.getElementById("popupEditarCliente").style.display = "none";
}
function excluirCliente(id){
    if(confirm("Excluir cliente? Esta ação é irreversível!")){
        window.location.href = "admin/cliente-excluir.php?id=" + id;
    }
}

function abrirPopupEditarFuncionario() {
    document.getElementById("popupEditarFuncionario").style.display = "flex";
}
function editarFuncionario(id){
    fetch("admin/funcionario-buscar.php?id=" + id)
    .then(res => res.json())
    .then(dados => {

        document.getElementById("edit_func_id").value = dados.id;
        document.getElementById("edit_func_matricula").value = dados.matricula;
        document.getElementById("edit_func_nome").value = dados.nome;
        document.getElementById("edit_func_email").value = dados.email;
        document.getElementById("edit_func_funcao").value = dados.funcao;
        document.getElementById("edit_func_usuario").value = dados.usuario;
        document.getElementById("edit_func_senha").value = dados.senha_usuario;

        abrirPopupEditarFuncionario();
    })
    .catch(err => alert("Erro ao carregar dados do cliente da ocorrência."));
}
function fecharPopupEditarFuncionario() {
    document.getElementById("popupEditarFuncionario").style.display = "none";
}
function excluirFuncionario(id){
    if(confirm("Excluir funcionário?")){
        window.location.href = "admin/funcionario-excluir.php?id=" + id;
    }
}
function toggleSenha(id) {
    const oculta = document.getElementById("senha_oculta_" + id);
    const real = document.getElementById("senha_real_" + id);
    const btn = document.getElementById("btnSenha_" + id);

    const icon = btn.querySelector("i");

    if (real.style.display === "none") {
        real.style.display = "inline";
        oculta.style.display = "none";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash"); // ícone de ocultar
    } else {
        real.style.display = "none";
        oculta.style.display = "inline";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye"); // ícone de mostrar
    }
}
</script>

</body>
</html>