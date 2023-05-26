<?php
require_once '../lib/php/DB.class.php';
$objDB = new DB();
$objDB->connect();

$result = $objDB->read('tb_lote', $_GET['id']);

if (!empty($_POST['nome'])) {
    $dados = array(
        "nome" => $_POST['nome']
    );
    $filtro = "id={$result['id']}";
    $objDB->update('tb_lote', $dados, $filtro);
    header('Location: tabelas_padrao.php');
    exit;
}

if (!empty($_POST['excluir'])) {
    $result = $objDB->delete('tb_lote', $_POST['id']);
    header('Location: tabelas_padrao.php');
    exit;
}

?>

<html>

<head>
    <meta charset="UTF=8" />
    <title>Fazenda</title>
    <link rel="stylesheet" type="text/css" href="../../Style/formulario_cadastro.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2 text-right">
                <a onclick="location.href ='tabelas_padrao.php';">Voltar</a>
            </div>
            <h1 class="col-md-6">Edição de Lote</h1>
        </div>
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $result['nome']; ?>" required>
            </div>
            <input type="submit" value="Editar">
        </form>
        <form method="POST" style="display: none;">
            <input hidden type="text" id="id" name="id" value="<?php echo $result['id']; ?>">
            <input hidden type="text" id="excluir" name="excluir" value="1">
            <input id="excluir" type="submit" value="Excluir">
        </form>
    </div>
    <script>
        const form = document.querySelector('form');

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const nome = form.nome.value.trim();

            if (nome === '') {
                alert('Por favor, preencha o campo nome.');
                return;
            }

            form.submit();
        });
    </script>
</body>

</html>