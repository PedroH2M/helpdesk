<?php
include "admin/config.inc.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['form_tipo']) && $_POST['form_tipo'] == 'ocorrencias'){

        $cliente = $_POST['cliente'] ?? '';
        $nomeTecnico = $_POST['nome'] ?? '';
        $data_inicio = $_POST['data_inicio']?? '';
        $tempo_inicio = $_POST['tempo_inicio'] ?? '';
        $data_fim = $_POST['data_fim'] ?? '';
        $tempo_fim = $_POST['tempo_fim'] ?? '';
        $motivo = $_POST['motivo'] ?? '';
        $status = $_POST['status'] ?? '';

        if(empty($cliente) || empty($nomeTecnico) || empty($data_inicio) || empty($data_fim) ||
         empty($motivo) ||empty($status) || empty($tempo_inicio) || empty($tempo_fim)){

            $erro = "erro";
        }else{
            $sql = "INSERT INTO ocorrencias (cliente, tecnico, data_inicio, inicio, data_fim, fim, motivo, status_ocorrencia) VALUES
             ('$cliente', '$nomeTecnico','$data_inicio', '$tempo_inicio', '$data_fim', '$tempo_fim', '$motivo', '$status')";
            
            $inserir = mysqli_query($conexao, $sql);

            if($inserir){
                header("Location: " . $_SERVER['PHP_SELF'] . "?sucesso=1");
                exit;
                //echo "foi";
            }
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
    <div class="modal" id="formModal">
    <div class="form-box">
        <form action="" method="post">
            <h2>Nova Ocorrência</h2>

            <input type="hidden" name="form_tipo" value="ocorrencias">

            <label>Cliente:</label>
            <input type="text" name="cliente" required>

            <label>Nome do Técnico:</label>
            <input type="text" name="nome" required>

            <label>Início:</label>
            <div class="date-time">
                <input type="date" name="data_inicio" required>
                <input type="time" name="tempo_inicio" required>
            </div>

            <label>Fim:</label>
            <div class="date-time">
                <input type="date" name="data_fim" required>
                <input type="time" name="tempo_fim" required>
            </div>

            <label>Motivo da ocorrência:</label>
            <textarea name="motivo" required></textarea>

            <label>Status:</label>
            <select name="status" required>
                <option>Pendente</option>
                <option>Em andamento</option>
                <option>Concluída</option>
            </select>

            <div class="btn-group">
                <button class="btn-salvar" type="submit">Salvar</button>
                <button class="btn-cancel" onclick="fecharFormulario()">Cancelar</button>
            </div>
        </form>
    </div>
</div>
    
</body>
</html>