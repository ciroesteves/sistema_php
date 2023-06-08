<?php
require_once '../lib/php/DB.class.php';
include_once 'navegador.php';
$objDB = new DB();
$objDB->connect();

$result = $objDB->read('tb_vacina', $_GET['id']);

if (!empty($_POST['vacina'])) {
    $dados = array(
        "vacina" => $_POST['vacina'],
        "descricao" => $_POST['descricao']
    );
    $filtro = "id={$result['id']}";
    $objDB->update('tb_vacina', $dados, $filtro);
    header('Location: tabelas_padrao.php');
    exit;
}

if (!empty($_POST['excluir'])) {
    $result = $objDB->delete('tb_vacina', $_POST['id']);
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
            <h1 class="col-md-6">Edição de Vacina</h1>
        </div>
        <form method="POST">
            <div class="form-group">
                <label for="vacina">Vacina:</label>
                <input type="text" id="vacina" name="vacina" value="<?php echo $result['vacina']; ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao"><?php echo $result['descricao']; ?></textarea>
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
            const vacina = form.vacina.value.trim();

            if (vacina === '') {
                alert('Por favor, preencha o campo vacina.');
                return;
            }

            form.submit();
        });
    </script>
</body>

</html>