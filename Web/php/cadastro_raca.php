<?php
require_once '../lib/php/DB.class.php';
$objDB = new DB();
$objDB->connect();

if ($_POST) {
	// Recebe os dados do formulário
	$dados = array(
		"raca" => $_POST['raca'],
        "descricao" => $_POST['descricao']
	);

	// Query de inserção
	$objDB->create('tb_raca', $dados);
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
<body>
    <div class="container">
	<div class="row">
      <div class="col-md-2 text-right"> 
        <a onclick="location.href ='tabelas_padrao.php';">Voltar</a>
      </div>
      <h1 class="col-md-4">Cadastro de Raças</h1>
    </div>
        <form method="POST">
            <div class="form-group">
                <label for="raca">Raça:</label>
                <input type="text" id="raca" name="raca" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <input type="text" id="descricao" name="descricao">
            </div>
            <input type="submit" value="Cadastrar">
        </form>
    </div>
    <script>
        const form = document.querySelector('form');

        form.addEventListener('submit', (event) => {
            var scriptVersion = 1;
            event.preventDefault();
            const raca = form.raca.value.trim();

            if (raca === '') {
                alert('Por favor, preencha o campo raça.');
                return;
            }

            form.submit();
        });
    </script>
</body>
</html>