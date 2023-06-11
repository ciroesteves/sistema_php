<?php
if (!empty($_POST['peso'])) {
    $dados = array(
        "animal_fk" => $_GET['id'],
        "peso" => $_POST['peso'],
        "data" => $_POST['data']
    );

    $objDB->create('tb_pesagem', $dados);
    $queryString = $_SERVER['QUERY_STRING'];
    $redirectUrl = $_SERVER['PHP_SELF'] . '?' . $queryString;

    echo "<script>";
    echo "setTimeout(function() { window.location.href = '{$redirectUrl}'; }, 2000);"; // Redireciona após 2 segundos
    echo "</script>";
}
?>
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
    <div class="form-group">
        <button type="submit">Cadastrar</button>
    </div>
</form>