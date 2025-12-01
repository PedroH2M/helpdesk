<?php 
include  "admin/config.inc.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['form_tipo']) && $_POST['form_tipo'] ==  'ocorrencias'){
    $id = $_REQUEST['id'] ??'';
    $nomeCLiente = trim($_REQUEST['cliente']) ?? '';
    $nomeTecnico = trim($_REQUEST['tecnico']) ?? '';
    $status = $_REQUEST['status_ocorrencia'] ?? '';

    if(empty($nomeCLiente) || empty($nomeTecnico) || empty($status)){
        echo "invalido" . mysqli_errno($conexao);
    }
    $sql = "UPDATE ocorrencias SET cliente = '$nomeCLiente', tecnico = '$nomeTecnico', status_ocorrencia = '$status' WHERE id = '$id'";
    $update = mysqli_query($conexao, $sql);

    if($update){
        echo "<script> window.location.href = 'area-gestor.php'; </script>";
    }
}
    mysqli_close($conexao);

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
    <div id="formEditar" class="modal" style="display:none;">
    <div class="form-box">

        <h2>Editar Ocorrência</h2>

        <form action="" method="POST">

            <input type="hidden" name="form_tipo" value="ocorrencias">

            <input type="hidden" id="id" name="id">

            <label>Cliente</label>
            <input type="text" name="cliente" id ="cliente"placeholder="Nome do cliente" required>

            <label>Técnico</label>
            <input type="text" name="tecnico" id = "tecnico"placeholder="Nome do tecnico" required>

            <label>Status</label>
            <select name="status_ocorrencia" id = "status"required>
                <option >Aberta</option>
                <option >Em andamento</option>
                <option >Finalizada</option>
            </select>

            <div class="btn-group">
                <button type="submit" class="btn-salvar">Salvar</button>
                <button type="button" class="btn-cancel" onclick="fecharFormularioEditar()">Cancelar</button>
            </div>

        </form>
    </div>
    
</body>
</html>
