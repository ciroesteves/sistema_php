<?php
require_once './navegador.php';
include_once '../lib/php/DB.class.php';

$objDB = new DB();
$objDB->connect();

$filtro = " status = 1 ";
if (!empty($_POST['idade_ini'])) {
  $filtro .= " and DATEDIFF(CURDATE(), nascimento) / 30 >= {$_POST['idade_ini']} ";
}
if (!empty($_POST['idade_fim'])) {
  $filtro .= " and DATEDIFF(CURDATE(), nascimento) / 30 <= {$_POST['idade_fim']} ";
}
if (!empty($_POST['lote'])) {
  $filtro .= " and lote_fk >= {$_POST['lote']} ";
}
if (!empty($_POST['sexo'])) {
  $filtro .= " and sexo = {$_POST['sexo']} ";
}

$relatorio = $objDB->readWhere('tb_animal', $filtro);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Fazenda</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../Style/formulario_cadastro.css">
</head>

<body>
  <div class="container">
    <h2>Formulário de Consulta</h2>
    <form action="lista_animal.php" method="POST">
      <div class="form-group">
        <label for="idade_ini">Idade (meses): </label>
        <input type="number" id="idade_ini" name="idade_ini" placeholder="Idade inicial">
        a
        <input type="number" id="idade_fim" name="idade_fim" placeholder="Idade final">
      </div>
      <div class="form-group">
        <label for="lote">Lote: </label>
        <select id="lote" name="lote">
          <option value="" selected>Selecione</option>
          <?php
          $lotes = $objDB->readAll('tb_lote');
          foreach ($lotes as $lote) {
            echo '<option value="' . $lote['id'] . '" >' . $lote['lote'] . '</option>';
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="sexo">Sexo: </label>
        <select id="sexo" name="sexo">
          <option value="" selected>Selecione</option>
          <option value="1">Fêmea</option>
          <option value="2">Macho</option>
        </select>
      </div>
      <div class="form-group">
        <button type="submit">Consultar</button>
      </div>
    </form>
  </div>

  <?php
  if(!empty($_POST)) {
  ?>
  <div class="container mt-5 col-10" style="width: auto;">
    <div class="row">
      <h2 class="col-md-6">Relatório</h2>
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
        $dataAtual = date('Y-m-d');

        foreach ($relatorio as $row) {
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
  <?php
  }
  ?>
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