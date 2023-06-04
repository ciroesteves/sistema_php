<?php
require_once '../lib/php/DB.class.php';
include_once 'navegador.php';
$objDB = new DB();
$objDB->connect();

if ($_POST) {
	// Recebe os dados do formulário
	$dados = array(
		"lote" => $_POST['lote']
	);

	// Query de inserção
	$objDB->create('tb_lote', $dados);
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
<body class="corpo">
    <div class="container-small">
	<div class="row">
      <div class="col-md-2 text-right"> 
        <a onclick="location.href ='tabelas_padrao.php';">Voltar</a>
      </div>
      <h1 class="col-md-6">Cadastro de Lotes</h1>
    </div>
        <form method="POST">
            <div class="form-group">
                <label for="lote">Lote:</label>
                <input type="text" id="lote" name="lote" required>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
    <script>
        const form = document.querySelector('form');

        form.addEventListener('submit', (event) => {
            var scriptVersion = 1;
            event.preventDefault();
            const lote = form.lote.value.trim();

            if (lote === '') {
                alert('Por favor, preencha o campo lote.');
                return;
            }

            form.submit();
        });
    </script>
</body>
</html>