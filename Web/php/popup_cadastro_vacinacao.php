<?php
if (!empty($_POST['vacina_fk'])) {
    $dados = array(
        "animal_fk" => $_GET['id'],
        "vacina_fk" => $_POST['vacina'],
        "data" => $_POST['data'],
        "descricao" => $_POST['descricao']
    );

    $objDB->create('tb_vacinacao', $dados);
    sleep(5);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

<head>
    <meta charset="UTF=8" />
    <link rel="stylesheet" type="text/css" href="../../public/assets/styles/formularios.css">
</head>
<h1>Cadastro Vacinação</h1>
<form method="POST">
    <div class="form-group">
        <label for="vacina">Controle sanitário:</label>
        <select name="vacina" id="vacina">
            <?php
            echo '<option value="" checked>Selecione</option>';
            $lotes = $objDB->readAll('tb_vacina');
            foreach ($lotes as $lote) {
                echo '<option value="' . $lote['id'] . '" >' . $lote['vacina'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>
    </div>
    <div class="form-group">
        <label for="descricao">Observação:</label>
        <textarea id="descricao" name="descricao"></textarea>
    </div>
    <div class="form-group">
        <button type="submit">Cadastrar</button>
    </div>
</form>