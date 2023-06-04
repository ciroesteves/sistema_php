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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../Style/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 200px;
        }

        .card i {
            font-size: 40px;
            color: #333;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 14px;
        }

        .chart-container {
            width: 80%;
            max-width: 800px;
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="corpo">
    <div class="container">
        <div class="cards">
            <div class="card">
                <i class="fas fa-users"></i>
                <h3>Indicador 1</h3>
                <p>Valor: <span id="indicador1"></span></p>
            </div>
            <div class="card">
                <i class="fas fa-chart-line"></i>
                <h3>Indicador 2</h3>
                <p>Valor: <span id="indicador2"></span></p>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <script>
        // Simulação de dados para os indicadores
        var valorIndicador1 = 75;
        var valorIndicador2 = 50;

        // Atualiza os valores dos indicadores
        document.getElementById('indicador1').textContent = valorIndicador1;
        document.getElementById('indicador2').textContent = valorIndicador2;

        // Configuração dos dados para o gráfico
        var data = {
            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'],
            datasets: [{
                label: 'Teste',
                data: [120, 80, 150, 100, 200],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Configuração do gráfico
        var options = {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Criação do gráfico
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>
</body>

</html>