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
$resultHistorico = $objDB->readWhere('tb_historico', $filtro);

$tabelaPesagem = "";
if (!empty($resultPesagem)) {
  foreach ($resultPesagem as $pesagem) {
    $data =  date("d/m/Y", strtotime($pesagem['data']));
    $tabelaPesagem .= "<tr>
                        <td>{$data}</td>
                        <td>{$pesagem['peso']} Kg</td>
                      </tr>";
  }
} else {
  $tabelaPesagem = "<tr>
                      <td>Sem informações.</td>
                    </tr>";;
}

$tabelaVacinacao = "";
if (!empty($resultVacinacao)) {
  foreach ($resultVacinacao as $vacinacao) {
    $nomeVacina = $objDB->read('tb_vacina', $vacinacao['vacina_fk']);
    $data = date("d/m/Y", strtotime($vacinacao['data']));
    $tabelaVacinacao .= "<tr>
                          <td>{$nomeVacina['vacina']}</td>
                          <td>{$data}</td>
                        </tr>";
  }
} else {
  $tabelaVacinacao = "<tr>
                      <td>Sem informações.</td>
                    </tr>";;
}

$listaHistorico = "";
if (!empty($resultHistorico)) {
  foreach ($resultHistorico as $historico) {
    $nomeHistorico = $objDB->read('tb_tipo_historico', $historico['tipo_historico_fk']);
    $data = date("d/m/Y", strtotime($historico['data']));
    $listaHistorico .= "<li><strong>{$data} - {$nomeHistorico['nome']}:</strong><span>{$historico['descricao']}</span></li>";
  }
} else {
  $listaHistorico .= "<li><strong>Sem informações.</strong></li>";
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Fazenda</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../public/assets/styles/perfil.css">
  <link rel="stylesheet" type="text/css" href="../../public/assets/styles/fontawesome/css/all.css">
</head>

<body class="corpo">
  <div class="profile-container">
    <div class="header">
      <div class="picture row">
        <div class="col-md-2">
          <ul>
            <li><i class="fa-solid fa-pen-to-square fa-2xl" onClick="window.open('editar_animal.php?id=<?= $_GET['id'] ?>')"></i></li>
            <li><i class="fa-solid fa-money-bill-trend-up fa-2xl"></i></li>
            <li><i class="fa-solid fa-heading fa-2xl" onclick="openPopupHist()"></i></li>
            <li><i class="fa-solid fa-weight-scale fa-2xl" onclick="openPopupPesagem()"></i></li>
            <li><i class="fa-solid fa-syringe fa-2xl" onclick="openPopupVacinacao()"></i></li>
          </ul>
        </div>
        <div class="col-md-6">
          <img class="imagem-perfil" src="<?= !empty($animal['foto']) ? $animal['foto'] : '../../public/assets/imgs/imagem_aux.jpeg' ?>" alt="Foto do animal">
        </div>
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
        <p><?= $animal['descricao'] ? $animal['descricao'] : 'Sem informações.' ?></p>
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
          <?= $listaHistorico ?>
        </ul>
      </div>
    </div>
  </div>

  <div id="overlayHist" class="overlay" onclick="closePopupHist()"></div>
  <div id="popupHist" class="popup">
    <?php include_once 'popup_animal_hist.php'; ?>
  </div>
  <div id="overlayPesagem" class="overlay" onclick="closePopupPesagem()"></div>
  <div id="popupPesagem" class="popup">
    <?php include_once 'popup_cadastro_pesagem.php'; ?>
  </div>
  <div id="overlayVacinacao" class="overlay" onclick="closePopupVacinacao()"></div>
  <div id="popupVacinacao" class="popup">
    <?php include_once 'popup_cadastro_vacinacao.php'; ?>
  </div>
</body>

</html>

<script>
  function openPopupHist() {
    document.getElementById('overlayHist').style.display = 'block';
    document.getElementById('popupHist').style.display = 'block';
  }

  function closePopupHist() {
    document.getElementById('overlayHist').style.display = 'none';
    document.getElementById('popupHist').style.display = 'none';
  }

  function openPopupPesagem() {
    document.getElementById('overlayPesagem').style.display = 'block';
    document.getElementById('popupPesagem').style.display = 'block';
  }

  function closePopupPesagem() {
    document.getElementById('overlayPesagem').style.display = 'none';
    document.getElementById('popupPesagem').style.display = 'none';
  }

  function openPopupVacinacao() {
    document.getElementById('overlayVacinacao').style.display = 'block';
    document.getElementById('popupVacinacao').style.display = 'block';
  }

  function closePopupVacinacao() {
    document.getElementById('overlayVacinacao').style.display = 'none';
    document.getElementById('popupVacinacao').style.display = 'none';
  }
</script>