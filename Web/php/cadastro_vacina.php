<?php
require_once '../lib/php/DB.class.php';
$objDB = new DB();
$objDB->connect();

if ($_POST) {
	// Recebe os dados do formulário
	$dados = array(
		"vacina" => $_POST['vacina'],
        "descricao" => $_POST['descricao']
	);

	// Query de inserção
	$objDB->create('tb_vacina', $dados);
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
      <h1 class="col-md-6">Cadastro de Vacinas</h1>
    </div>
        <form method="POST">
            <div class="form-group">
                <label for="vacina">Vacina:</label>
                <input type="text" id="vacina" name="vacina" required>
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
            event.preventDefault();
            const vacina = form.vacina.value.trim();

            if (vacina === '') {
                alert('Por favor, preencha o campo vacina.');
                return;
            }

            form.submit();
        });
    </script>
</body>
</html>