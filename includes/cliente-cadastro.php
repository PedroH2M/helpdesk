<?php

include_once "admin/config.inc.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){


    if(isset($_POST['form_tipo']) && $_POST['form_tipo'] == 'cliente'){
    $nome = trim($_REQUEST['nome'] ?? '');
    $cpf = $_REQUEST['cpf'] ?? '';
    $email = $_REQUEST['email'] ?? '';
    $telefone = $_REQUEST['telefone'] ??'';

    if(empty($nome) || empty($cpf) || empty($email) || empty($telefone)){
        echo "Erro";
    }else{
        $sql = "INSERT INTO clientes (nome, email, cpf, telefone) VALUES ('$nome', '$cpf', '$email', '$telefone')";
        $inserir = mysqli_query($conexao, $sql);
    }

    if($inserir){

    }
    mysqli_close($conexao);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="modal" id="formCliente">
    <div class="form-box">
        <form action="" method="POST">
            <h2>Cadastrar Cliente</h2>
            
            <input type="hidden" name="form_tipo" value="cliente">

            <label>Nome do Cliente:</label>
            <input type="text" name="nome" required>

            <label>CNPJ / CPF:</label>
            <input type="text" name="cpf" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Telefone:</label>
            <input type="text" name="telefone" required>

            <div class="btn-group">
                <button type="submit" class="btn-salvar">Salvar</button>
                <button type="button" class="btn-cancel" onclick="fecharFormularioCliente()">Cancelar</button>
            </div>
        </form>
    </div>
</div>
    
</body>
</html>
