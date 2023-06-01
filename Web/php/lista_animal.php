<?php
require_once './navegador.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Fazenda</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <h2>Formulário de Consulta</h2>
    <form action="processar.php" method="POST">
      <div class="form-group">
        <label for="parametro1">Parâmetro 1:</label>
        <input type="text" id="parametro1" name="parametro1" placeholder="Digite o parâmetro 1" required>
      </div>
      <div class="form-group">
        <label for="parametro1">Parâmetro 1:</label>
        <input type="text" id="parametro1" name="parametro1" placeholder="Digite o parâmetro 1" required>
      </div>
      <div class="form-group">
        <label for="parametro1">Parâmetro 1:</label>
        <input type="text" id="parametro1" name="parametro1" placeholder="Digite o parâmetro 1" required>
      </div>
      <div class="form-group">
        <label for="parametro1">Parâmetro 1:</label>
        <input type="text" id="parametro1" name="parametro1" placeholder="Digite o parâmetro 1" required>
      </div>
      <div class="form-group">
        <label for="parametro1">Parâmetro 1:</label>
        <input type="text" id="parametro1" name="parametro1" placeholder="Digite o parâmetro 1" required>
      </div>
      <div class="form-group">
        <label for="parametro2">Parâmetro 2:</label>
        <input type="text" id="parametro2" name="parametro2" placeholder="Digite o parâmetro 2" required>
      </div>
      <div class="form-group">
        <button type="submit">Consultar</button>
      </div>
    </form>
  </div>

  <div class="container mt-5 col-10" style="width: auto;">
    <div class="row">
      <h1 class="col-md-6">Relatório</h1>  
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Número</th>
          <th>Nome</th>
          <th>Sexo</th>
          <th>Idade</th>
          <th>Lote</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        include_once '../lib/php/DB.class.php';
        
        $objDB = new DB();
        $objDB->connect();
        
        $results = $objDB->readAll('tb_animal');
        $dataAtual = date('Y-m-d');

        foreach ($results as $row) {
          $idade = (date('Y', strtotime($dataAtual)) - date('Y', strtotime($row['nascimento']))) * 12;
          $idade += date('m', strtotime($dataAtual)) - date('m', strtotime($row['nascimento']));
          $sexo = $row['sexo'] == 1 ? 'Fêmea' : 'Macho';
          $lote = $objDB->read('tb_lote', $row['lote_fk']);
          echo "<tr>";
          echo "<td>{$row['numero']}</td>";
          echo "<td>{$row['nome']}</td>";
          echo "<td>{$sexo}</td>";
          echo "<td>{$idade} Meses</td>";
          echo "<td>{$lote['lote']}</td>";
          echo "<td><a href='ficha_animal.php?id=" . $row['id'] . "'><button type='button' class='btn btn-primary'><i class='fa fa-pencil'></i>Perfil</button></a></td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>

<style>
    body {
      background-color: #f5f5f5;
    }

    .container {
      max-width: 1100px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form-group input {
      width: 30%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-group button {
      padding: 8px 12px;
      background-color: #4CAF50;
      border: none;
      color: #fff;
      border-radius: 4px;
      cursor: pointer;
    }

    .form-group button:hover {
      background-color: #45a049;
    }
  </style>