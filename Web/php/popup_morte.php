<?php
if (!empty($_POST['motivo'])) {
    $dados = array(
        "animal_fk" => $_GET['id'],
        "data" => $_POST['data'],
        "motivo" => $_POST['motivo']
    );

    $success = $objDB->create('tb_morte', $dados);
    if($success) {
        $dados = array(
            "status" => 3
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
<h1>Informar Morte</h1>
<form method="POST">
    <div class="form-group">
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>
    </div>
    <div class="form-group">
        <label for="motivo">Motivo:</label>
        <textarea id="motivo" name="motivo" required></textarea>
    </div>
    <div class="form-group">
        <button type="submit">Concluir</button>
    </div>
</form>