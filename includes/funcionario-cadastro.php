<?php
    include "admin/config.inc.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['form_tipo']) && $_POST['form_tipo'] == 'funcionarios'){

        $nome = trim($_REQUEST['nome'] ?? '');
        $login = $_REQUEST['login'] ?? '';
        $senha = $_REQUEST['senha']?? '';
        $funcao = $_REQUEST['funcao']?? '';


        if(empty($nome) || empty($login) || empty($senha) || empty($funcao)){
            echo "Ero" . mysqli_error($conexao);
            exit;
        }else{
            $sql = "INSERT INTO usuarios (usuario, senha, nome, funcao) VALUES ('$login', '$senha', '$nome', '$funcao')";
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
    <div class="modal" id="formFuncionario">
    <div class="form-box">
        <form action="" method="post">
            <h2>Cadastrar Funcionário</h2>

            <input type="hidden" name="form_tipo" value="funcionarios"> 

            <label>Nome do Funcionário:</label>
            <input type="text" name="nome" required>

            <label>Login: </label>
            <input type="text" name="login" required>

            <label>Senha: </label>
            <input type="password" name="senha" required>

            <label>Função: </label>
            <select name="funcao" required>
                <option >Técnico</option>
                <option >Gestor</option>
            </select>

        <div class="btn-group">
            <button class="btn-salvar" type="submit">Salvar</button>
            <button class="btn-cancel" onclick="fecharFormularioFuncionario()">Cancelar</button>
        </div>
        </form>
    </div>
</div>
    
</body>
</html>