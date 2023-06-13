<?php
require_once '../lib/php/DB.class.php';
include_once 'navegador.php';
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
    <link rel="stylesheet" type="text/css" href="../../public/assets/styles/formularios.css">
</head>
<body class="corpo">
    <div class="container-small">
	<div class="row">
      <div class="col-md-2 text-right"> 
        <a onclick="location.href ='tabelas_padrao.php';">Voltar</a>
      </div>
      <h1 class="col-md-8">Cadastro de Raças</h1>
    </div>
        <form method="POST">
            <div class="form-group">
                <label for="raca">Raça:</label>
                <input type="text" id="raca" name="raca" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao"></textarea>
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