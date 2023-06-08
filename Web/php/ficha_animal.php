<?php
require_once './navegador.php';
require_once '../lib/php/DB.class.php';
$objDB = new DB();
$objDB->connect();

$id = $_GET['id'];
$sql = "SELECT animal.*, lote.*, raca.raca, raca.descricao as raca_descricao FROM tb_animal animal JOIN tb_raca raca ON animal.raca_fk = raca.id JOIN tb_lote lote ON animal.lote_fk = lote.id WHERE animal.id = $id";
$result = $objDB->conn->query($sql);
$animal = $result->fetch();

$resultPai = $objDB->read('tb_animal', $animal['pai']);
$resultMae = $objDB->read('tb_animal', $animal['mae']);

$filtro = " animal_fk = {$id} ORDER BY data desc";
$resultPesagem = $objDB->readWhere('tb_pesagem', $filtro);
$resultVacinacao = $objDB->readWhere('tb_vacinacao', $filtro);

$tabelaPesagem = "";
foreach($resultPesagem as $pesagem) {
  $data =  date("d/m/Y", strtotime($pesagem['data']));
  $tabelaPesagem .= "<tr>
                      <td>{$data}</td>
                      <td>{$pesagem['peso']} Kg</td>
                    </tr>";
}
$tabelaVacinacao = "";
foreach($resultVacinacao as $vacinacao) {
  $nomeVacina = $objDB->read('tb_vacina', $vacinacao['vacina_fk']);
  $data = date("d/m/Y", strtotime($vacinacao['data']));
  $tabelaVacinacao .= "<tr>
                        <td>{$nomeVacina['vacina']}</td>
                        <td>{$data}</td>
                      </tr>";
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Fazenda</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../public/assets/styles/perfil.css">
</head>

<body class="corpo">
  <div class="profile-container">
    <div class="header">
      <div class="picture">
        <img class="imagem-perfil" src="<?= !empty($animal['foto']) ? $animal['foto'] : '../../public/assets/imgs/imagem_aux.jpeg' ?>" alt="Foto do animal">
      </div>

      <div class="info">
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
        <p><strong>Pai: </strong><?= $result = $resultPai ? $resultPai['nome'] : ''; ?></p>
        <p><strong>Mãe: </strong><?= $result = $resultMae ? $resultMae['nome'] : ''; ?></p>
      </div>

    </div>

    <div class="content">
      <div class="section">
        <h2>Descrição</h2>
        <p><?= $animal['descricao'] ?></p>
      </div>
    </div>
    <div class="content">
      <div class="section">
        <h2>Pesagem</h2>
        <table>
          <thead>
            <tr>
              <th>Data</th>
              <th>Peso</th>
            </tr>
          </thead>
          <tbody>
            <?= $tabelaPesagem ?>
          </tbody>
        </table>
      </div>

      <div class="section">
        <h2>Vacinação</h2>
        <table>
          <thead>
            <tr>
              <th>Vacina</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
            <?= $tabelaVacinacao ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="content">
      <div class="section">
        <h2>Histórico</h2>
        <ul>
          <li><strong>10/02/2023 - Cruzamento:</strong><span>Foi avistado cruzamento com o touro X.</span></li>
          <li><strong>05/02/2023 - Alerta:</strong></span>Fugiu do pasto e foi encontrada em Quirino.</span></li>
        </ul>

      </div>
    </div>

  </div>
</body>

</html>