<?php
require_once '../lib/php/DB.class.php';
require_once './navegador.php';

$objDB = new DB();
$objDB->connect();

$totalFornecedores = $objDB->readCount('tb_fornecedor');
$totalFornecedores = $totalFornecedores['COUNT(*)'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Adicionando o Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../Style/dashboard.css">
    <script src="../lib/js/node_modules/chart.js/dist/chart.js"></script>
    <script src="grafico.js"></script>
</head>

<body>
    <div id="content" class="container">
        <div id="totals" class="row">
            <div class="card-group">
                <h2 class="w-100">Total Rebanho</h2>
                <p><?php echo $totalFornecedores . " un." ?></p>
            </div>
            <div class="card-group">
                <h2>Total Peso Vivo</h2>
                <p>Conteúdo do card 2.</p>
            </div>
            <div class="card-group">
                <h2>Balanço do Ano</h2>
                <p>Conteúdo do card 3.</p>
            </div>
        </div>
        <div>
            <div class="card-group row h-75">
                <h2>Dashboard</h2>
                <canvas id="charts"></canvas>
            </div>
        </div>
    </div>
</body>

</html>
