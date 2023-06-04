<?php
require_once '../lib/php/DB.class.php';
include_once 'navegador.php';
$objDB = new DB();
$objDB->connect();

if ($_POST) {
	$dados = array(
		"animal_fk" => $_POST['numero'],
        "peso" => $_POST['peso'],
        "data" => $_POST['data']
	);
    $numero = $_POST['numero'];
    $filtro = " numero = {$numero} and status = 1 ";
    $result = $objDB->readWhere('tb_animal', $filtro);
    if(!empty($result)){
        $objDB->create('tb_pesagem', $dados);
    } else {
        echo "<script>
                alert('Não existe o animal determinado, número {$numero}')
            </script>";
    }
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
      <h1 class="col-md-4">Cadastro de Raças</h1>
    </div>
        <form method="POST">
            <div class="form-group">
                <label for="numero">Número animal:</label>
                <input type="text" id="numero" name="numero" required>
            </div>
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
    </div>
    <script>
        const form = document.querySelector('form');

        form.addEventListener('submit', (event) => {
            var scriptVersion = 1;
            event.preventDefault();
            const numero = form.numero.value.trim();
            const peso = form.peso.value.trim();
            const data = form.numero.value.trim();

            if (numero === '') {
                alert('Por favor, preencha o campo numero.');
                return;
            }
            if (peso === '') {
                alert('Por favor, preencha o campo peso.');
                return;
            }
            if (data === '') {
                alert('Por favor, preencha o campo data.');
                return;
            }

            form.submit();
        });
    </script>
</body>
</html>