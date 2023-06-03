<?php
require_once '../lib/php/DB.class.php';
$objDB = new DB();
$objDB->connect();

$result = $objDB->read('tb_raca', $_GET['id']);

if (!empty($_POST['raca'])) {
    $dados = array(
        "raca" => $_POST['raca'],
        "descricao" => $_POST['descricao']
    );
    $filtro = "id={$result['id']}";
    $objDB->update('tb_raca', $dados, $filtro);
    header('Location: tabelas_padrao.php');
    exit;
}

if (!empty($_POST['excluir'])) {
    $result = $objDB->delete('tb_raca', $_POST['id']);
    header('Location: tabelas_padrao.php');
    exit;
}

?>

<html>

<head>
    <meta charset="UTF=8" />
    <title>Fazenda</title>
    <link rel="stylesheet" type="text/css" href="../../Style/formularios.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2 text-right">
                <a onclick="location.href ='tabelas_padrao.php';">Voltar</a>
            </div>
            <h1 class="col-md-6">Edição de Raça</h1>
        </div>
        <form method="POST">
            <div class="form-group">
                <label for="raca">Raça:</label>
                <input type="text" id="raca" name="raca" value="<?php echo $result['raca']; ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <input type="text" id="descricao" name="descricao" value="<?php echo $result['descricao']; ?>">
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
            const raca = form.raca.value.trim();

            if (raca === '') {
                alert('Por favor, preencha o campo raca.');
                return;
            }

            form.submit();
        });
    </script>
</body>

</html>