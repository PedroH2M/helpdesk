<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Gestor - ZappTech HelpDesk</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <?php
        include('admin/config.inc.php');

        if(isset($_POST['usuario']) || isset($_POST['senha'])) {

        if(strlen($_POST['usuario']) == 0 ){
            echo "Preencha seu usuário";
        } else if (strlen($_POST['senha']) == 0){
            echo "Preencha sua senha";
        } else {
            
            $usuario = $conexao->real_escape_string($_POST['usuario']);
            $senha = $conexao->real_escape_string($_POST['senha']);

            $sql_code = "SELECT * FROM gestores where gestor = '$usuario' AND senha_gestor = '$senha'";
            $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);

            $quantidade  = $sql_query->num_rows;

            if($quantidade == 1) {

                $usuario = $sql_query->fetch_assoc();

                if(!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['id'] = $usuario['id'];

                header("Location: area-gestor.php");

            } else {
                $erro = "<h3>Falha ao logar! Usuário ou senha incorretos<h3>";
            }
        }
    }
    ?>


    <div class="login-box">
        <img src="img/logo.png" alt="ZappTech Logo" />
        <h2>Login do Gestor</h2>

<<<<<<< HEAD
        <form action="area-gestor.php" method="POST">
=======
        <form action="" method="POST">

            <div class="input-group">
                <label>Usuário</label>
                <input type="text" name="usuario" required />
            </div>

            <div class="input-group">
                <label>Senha</label>
                <input type="password" name="senha" required />
            </div>

            <button class="btn-login" type="submit">Entrar</button>
        </form>

        <a href="index.php" class="link">Voltar ao início</a>
    </div>
</body>

</html>
