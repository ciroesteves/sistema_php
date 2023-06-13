<?php
require_once '../lib/php/DB.class.php';
include_once 'navegador.php';
$objDB = new DB();
$objDB->connect();

if ($_POST) {
    $numero = $_POST['numero'];
    $filtro = " numero = {$numero} and status = 1 ";
    $result = $objDB->readWhere('tb_animal', $filtro);
    foreach ($result as $row) {
        $id = $row['id'];
    }

    $dados = array(
        "animal_fk" => $id,
        "vacina_fk" => $_POST['vacina'],
        "data" => $_POST['data'],
        "descricao" => $_POST['descricao']
    );

    if (!empty($result)) {
        $objDB->create('tb_vacinacao', $dados);
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
    <link rel="stylesheet" type="text/css" href="../../public/assets/styles/formularios.css">
</head>

<body class="corpo">
    <div class="container-small">
        <div class="row">
            <div class="col-md-2 text-right">
                <a onclick="location.href ='tabelas_padrao.php';">Voltar</a>
            </div>
            <h1 class="col-md-8">Cadastro de Vacinação</h1>
        </div>
        <form method="POST">
            <div class="form-group">
                <label for="numero">Número animal:</label>
                <input type="number" id="numero" name="numero" required>
            </div>
            <div class="form-group">
                <label for="vacina">Controle sanitário:</label>
                <select name="vacina" id="vacina">
                    <?php
                    echo '<option value="" checked>Selecione</option>';
                    $lotes = $objDB->readAll('tb_vacina');
                    foreach ($lotes as $lote) {
                        echo '<option value="' . $lote['id'] . '" >' . $lote['vacina'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="data">Data:</label>
                <input type="date" id="data" name="data" required>
            </div>
            <div class="form-group">
                <label for="descricao">Observação:</label>
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
            const numero = form.numero.value.trim();
            const vacina = form.vacina.value.trim();
            const data = form.numero.value.trim();

            if (numero === '') {
                alert('Por favor, preencha o campo numero.');
                return;
            }
            if (vacina === '') {
                alert('Por favor, preencha o campo vacina.');
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