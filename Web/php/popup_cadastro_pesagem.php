<?php
if (!empty($_POST['peso'])) {
    $dados = array(
        "animal_fk" => $_GET['id'],
        "peso" => $_POST['peso'],
        "data" => $_POST['data']
    );

    $objDB->create('tb_pesagem', $dados);
    sleep(5);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

<head>
    <meta charset="UTF=8" />
    <link rel="stylesheet" type="text/css" href="../../public/assets/styles/formularios.css">
</head>
<h1>Cadastro Pesagem</h1>
<form method="POST">
    <div class="form-group">
        <label for="peso">Peso:</label>
        <input type="number" id="peso" name="peso" required>
    </div>
    <div class="form-group">
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>
    </div>
    <input type="text" id="id" name="id" hidden value="<?= $_GET['id'] ?>" required>
    <div class="form-group">
        <button type="submit">Cadastrar</button>
    </div>
</form>