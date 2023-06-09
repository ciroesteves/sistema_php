<?php
if (!empty($_POST['vacina'])) {
    $dados = array(
        "animal_fk" => $_GET['id'],
        "vacina_fk" => $_POST['vacina'],
        "data" => $_POST['data'],
        "descricao" => $_POST['descricao']
    );

    $objDB->create('tb_vacinacao', $dados);
    $queryString = $_SERVER['QUERY_STRING'];
    $redirectUrl = $_SERVER['PHP_SELF'] . '?' . $queryString;

    echo "<script>";
    echo "setTimeout(function() { window.location.href = '{$redirectUrl}'; }, 2000);"; // Redireciona após 2 segundos
    echo "</script>";
}
?>
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