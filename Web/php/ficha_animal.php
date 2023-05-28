<?php
require_once './navegador.php';
require_once '../lib/php/DB.class.php';


$objDB = new DB();
$objDB->connect();

$id = $_GET['id'];
$sql = "SELECT * FROM tb_animal animal JOIN tb_raca raca ON animal.raca_fk = raca.id JOIN tb_lote lote ON animal.lote_fk = lote.id WHERE animal.id = $id";
$result = $objDB->conn->query($sql);
$animal = $result->fetch();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Fazenda</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .card {
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 20px;
      padding: 0;
    }

    .card img {
      width: 100%;
      height: auto;
      border-radius: 5px;
    }

    .card h2 {
      margin-top: 0;
    }

    .card p {
      margin: 0;
    }

    .teste {
      display: flex;
      justify-content: space-around;

    }

    table {
      border-collapse: collapse;
    }

    table,
    th,
    td {
      border: 1px solid black;
    }

    th,
    td {
      padding: 5px;
      width: 200px;
    }

    th {
      background-color: lightgray;
    }
  </style>
</head>

<body>
  <div class="row teste">
    <div class="card col-md-2">
      <img src="../../Archives/imagem.jpeg" alt="Foto do Usuário">
    </div>
    <div class="card col-md-3">

      <h2><?= $animal['numero'] ?> - <?= $animal['nome'] ?></h2>
      <p><strong>Nascimento:</strong>
        <?php
        $data = DateTime::createFromFormat('Y-m-d', $animal['nascimento']);
        echo date_format($data, "d/m/Y");
        ?>
      </p>
      <p><strong>Peso: </strong> 320 kg / 10,8@</p>
      <p><strong>Sexo: </strong><?php echo $sexo = $animal['sexo'] == 1 ? 'Fêmea' : 'Macho'; ?></p>
      <p><strong>Raça: </strong><?= $animal['raca'] ?></p>
      <p><strong>Lote: </strong><?= $animal['lote'] ?></p>
      <p><strong>Tem Nota: </strong><?php echo $vacina = $animal['tem_nota'] == 1 ? 'Sim' : 'Não'; ?></p>
      <p><strong>Pai: </strong><?= $animal['pai'] ?></p>
      <p><strong>Mãe: </strong><?= $animal['mae'] ?></p>
    </div>
  </div>


  <div class="card">
    <h2>Descrição</h2>
    <p>Bezerra adquirida do Marcão, anelorada, teve um bom ganho de peso em pouco tempo e possivelmente pode estar cruzada</p>
  </div>

  <div class="card">
    <h2>Pesagem</h2>
    <table>
      <thead>
        <tr>
          <th>15/04/22</th>
          <th>15/06/23</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>320 kg</td>
          <td>450 kg</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="card">
    <h2>Vacinação</h2>
    <table>
      <thead>
        <tr>
          <th>Vacina</th>
          <th>Data</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Brucelose</td>
          <td>14/05/23</td>
        </tr>
        <tr>
          <td>Raiva</td>
          <td>14/05/23</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="card">
    <h2>Histórico</h2>
    <p><strong>10/02/2023</strong> - <strong>Cruzamento:</strong> Foi avistado cruzamento com o touro X.</p>
    <p><strong>05/02/2023</strong> - <strong>Alerta:</strong> Fugiu do pasto e foi encontrada em Quirino.</p>
  </div>
</body>

</html>