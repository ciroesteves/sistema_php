<?php
if (!empty($_POST['titulo'])) {
    $dados = array(
        "data" => $_POST['data'],
        "tipo_historico_fk" => $_POST['titulo'],
        "descricao" => $_POST['descricao'],
        "animal_fk" => $_GET['id']
    );

    $objDB->create('tb_historico', $dados);
    sleep(5);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

<head>
    <meta charset="UTF=8" />
    <link rel="stylesheet" type="text/css" href="../../public/assets/styles/formularios.css">
</head>
<h1>Cadastro Histórico</h1>
<form method="POST">
    <div class="form-group">
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>
    </div>
    <div class="form-group">
        <label for="titulo">Título:</label>
        <select name="titulo" id="titulo">
            <?php
            // Chama a função que retorna a lista de funcionários do banco de dados
            $historicos = $objDB->readAll('tb_tipo_historico');
            foreach ($historicos as $historico) {
                echo '<option value="' . $historico['id'] . '" >' . $historico['nome'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea>
    </div>
    <div class="form-group">
        <button type="submit">Cadastrar</button>
    </div>
</form>