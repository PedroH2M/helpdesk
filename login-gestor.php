<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Gestor - ZappTech HelpDesk</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-box">
        <img src="img/logo.png" alt="ZappTech Logo" />
        <h2>Login do Gestor</h2>

        <form action="area-gestor.php" method="POST">
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