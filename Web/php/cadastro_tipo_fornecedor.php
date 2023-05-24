<?php
require_once '../lib/php/DB.class.php';
$objDB = new DB();
$objDB->connect();

if ($_POST) {
	// Recebe os dados do formulário
	$dados = array(
		"tipo" => $_POST['tipo']
	);

	// Query de inserção
	$objDB->create('tb_tipo_fornecedor', $dados);
	header('Location: tabelas_padrao.php');
    exit;
}
?>
<html>
<head>
    <meta charset="UTF=8" />
    <title>Fazenda</title>
    <link rel="stylesheet" type="text/css" href="../../Style/formulario_cadastro.css">
</head>
<body>
    <div class="container">
	<div class="row">
      <div class="col-md-2 text-right"> 
        <a onclick="location.href ='tabelas_padrao.php';">Voltar</a>
      </div>
      <h1 class="col-md-6">Cadastro de Tipo Fornecedor</h1>
    </div>
        <form method="POST">
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <input type="text" id="tipo" name="tipo" required>
            </div>
            <input type="submit" value="Cadastrar">
        </form>
    </div>
    <script>
        const form = document.querySelector('form');

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const tipo = form.tipo.value.trim();

            if (tipo === '') {
                alert('Por favor, preencha o campo tipo.');
                return;
            }

            form.submit();
        });
    </script>
</body>
</html>