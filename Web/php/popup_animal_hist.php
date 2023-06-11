<?php
if (!empty($_POST['titulo'])) {
    $dados = array(
        "data" => $_POST['data'],
        "tipo_historico_fk" => $_POST['titulo'],
        "descricao" => $_POST['descricao'],
        "animal_fk" => $_GET['id']
    );
    var_dump($_POST['titulo']);
    unset($_POST['titulo']);

    $objDB->create('tb_historico', $dados);
    $queryString = $_SERVER['QUERY_STRING'];
    $redirectUrl = $_SERVER['PHP_SELF'] . '?' . $queryString;

    echo "<script>";
    echo "setTimeout(function() { window.location.href = '{$redirectUrl}'; }, 2000);"; // Redireciona após 2 segundos
    echo "</script>";
}
?>
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