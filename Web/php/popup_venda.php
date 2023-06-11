<?php
if (!empty($_POST['valor'])) {
    $dados = array(
        "animal_fk" => $_GET['id'],
        "valor" => $_POST['valor'],
        "data" => $_POST['data'],
        "fornecedor_fk" => $_POST['fornecedor']
    );

    $success = $objDB->create('tb_venda', $dados);
    if($success) {
        $dados = array(
            "status" => 2
        );
        $objDB->update('tb_animal', $dados, "id = {$_GET['id']}");
    }

    $queryString = $_SERVER['QUERY_STRING'];
    $redirectUrl = $_SERVER['PHP_SELF'] . '?' . $queryString;

    echo "<script>";
    echo "setTimeout(function() { window.location.href = '{$redirectUrl}'; }, 2000);"; // Redireciona após 2 segundos
    echo "</script>";
}
?>
<h1>Venda</h1>
<form method="POST">
    <div class="form-group">
        <label for="fornecedor">Comprador:</label>
        <select name="fornecedor" id="fornecedor">
            <?php
            echo '<option value="" checked>Selecione</option>';
            $fornecedores = $objDB->readAll('tb_fornecedor');
            foreach ($fornecedores as $fornecedor) {
                echo '<option value="' . $fornecedor['id'] . '" >' . $fornecedor['nome'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>
    </div>
    <div class="form-group">
        <label for="valor">Valor:</label>
        <input type="number" step="0.01" id="valor" name="valor" required>
    </div>
    <div class="form-group">
        <button type="submit">Cadastrar</button>
    </div>
</form>