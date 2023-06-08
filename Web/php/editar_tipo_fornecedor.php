<?php
require_once '../lib/php/DB.class.php';
include_once 'navegador.php';
$objDB = new DB();
$objDB->connect();

$result = $objDB->read('tb_tipo_fornecedor', $_GET['id']);

if (!empty($_POST['tipo'])) {
    $dados = array(
        "tipo" => $_POST['tipo']
    );
    $filtro = "id={$result['id']}";
    $objDB->update('tb_tipo_fornecedor', $dados, $filtro);
    header('Location: tabelas_padrao.php');
    exit;
}

if (!empty($_POST['excluir'])) {
    $result = $objDB->delete('tb_tipo_fornecedor', $_POST['id']);
    header('Location: tabelas_padrao.php');
    exit;
}

?>

<html>

<head>
    <meta charset="UTF=8" />
    <title>Fazenda</title>
    <link rel="stylesheet" type="text/css" href="../../public/assets/styles/formularios.css">
</head>

<body class="corpo">
    <div class="container-small">
        <div class="row">
            <div class="col-md-2 text-right">
                <a onclick="location.href ='tabelas_padrao.php';">Voltar</a>
            </div>
            <h1 class="col-md-6">Edição de Tipo Fornecedor</h1>
        </div>
        <form method="POST">
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <input type="text" id="tipo" name="tipo" value="<?php echo $result['tipo']; ?>" required>
            </div>
            <div class="form-group">
            <button type="submit">Editar</button>
            </div>
        </form>
        <form method="POST" style="display: none;">
            <input hidden type="text" id="id" name="id" value="<?php echo $result['id']; ?>">
            <input hidden type="text" id="excluir" name="excluir" value="1">
            <button id="excluir" type="submit">Excluir</button>
        </form>
    </div>
    <script>
        const form = document.querySelector('form');

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const tipo = form.tipo.value.trim();

            if (tipo === '') {
                alert('Por favor, preencha o campo tipo.');
                return;
            }

            form.submit();
        });
    </script>
</body>

</html>