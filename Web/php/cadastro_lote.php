<?php
require_once '../lib/php/DB.class.php';
$objDB = new DB();
$objDB->connect();

if ($_POST) {
	// Recebe os dados do formulário
	$dados = array(
		"nome" => $_POST['nome']
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
    <link rel="stylesheet" type="text/css" href="../../Style/formulario_cadastro.css">
</head>
<body>
    <div class="container">
	<div class="row">
      <div class="col-md-2 text-right"> 
        <a onclick="location.href ='tabelas_padrao.php';">Voltar</a>
      </div>
      <h1 class="col-md-6">Cadastro de Lotes</h1>
    </div>
        <form method="POST">
            <div class="form-group">
                <label for="nome">Lote:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <input type="submit" value="Cadastrar">
        </form>
    </div>
    <script>
        const form = document.querySelector('form');

        form.addEventListener('submit', (event) => {
            var scriptVersion = 1;
            event.preventDefault();
            const nome = form.nome.value.trim();

            if (nome === '') {
                alert('Por favor, preencha o campo lote.');
                return;
            }

            form.submit();
        });
    </script>
</body>
</html>