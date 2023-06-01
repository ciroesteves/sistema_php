<?php
require_once '../lib/php/DB.class.php';
$objDB = new DB();
$objDB->connect();

$result = $objDB->read('tb_animal', $_GET['id']);

if ($_POST) {
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
        $nomeArquivo = $_POST['numero'] . ".jpeg";
        $caminhoTemporario = $_FILES["foto"]["tmp_name"];
        $caminhoDestino = "../../Archives/photos/" . $nomeArquivo;
    
        // Move o arquivo da pasta temporária para o destino final
        if (move_uploaded_file($caminhoTemporario, $caminhoDestino)) {
          echo "Imagem enviada e salva com sucesso.";
        } else {
          echo "Erro ao salvar a imagem.";
        }
      } else {
        echo "Erro no envio da imagem.";
      }

    $dados = array(
        "nome" => $_POST['nome'],
        "numero" => $_POST['numero'],
        "lote_fk" => $_POST['lote_fk'],
        "raca_fk" => $_POST['raca_fk'],
        "fornecedor_fk" => $_POST['fornecedor_fk'],
        "pai" => $_POST['pai'],
        "mae" => $_POST['mae'],
        "sexo" => $_POST['sexo'],
        "status" => 1,
        "foto" => $caminhoDestino,
        "descricao" => $_POST['descricao'],
        "tem_nota" => !empty($_POST['tem_nota']) ? $_POST['tem_nota'] : 0
    );

    $filtro = "id={$result['id']}";
    $objDB->update('tb_animal', $dados, $filtro);
    header('Location: lista_animal.php');
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
        <div class="row container-2">
            <div class="col-md-2 text-right">
                <a onclick="location.href ='lista_animal.php';">Voltar</a>
            </div>
            <h1 class="col-md-6">Cadastro de Animal</h1>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $result['nome']; ?>" required>
            </div>

            <div class="form-group">
                <label for="numero">Número:</label>
                <input type="number" id="numero" name="numero" value="<?php echo $result['numero']; ?>" required>
            </div>

            <div class="form-group">
                <label for="lote_fk">Lote:</label>
                <select name="lote_fk" id="lote_fk">
                    <?php
                    echo '<option value="">Selecione</option>';
                    $lotes = $objDB->readAll('tb_lote');
                    foreach ($lotes as $lote) {
                        $selected = ($lote['id'] == $result['lote_fk']) ? 'selected' : '';
                        echo "<option value='" . $lote['id'] . "' $selected>" . $lote['lote'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="raca_fk">Raça:</label>
                <select name="raca_fk" id="raca_fk">
                    <?php
                    echo '<option value="">Selecione</option>';
                    $racas = $objDB->readAll('tb_raca');
                    foreach ($racas as $raca) {
                        $selected = ($raca['id'] == $result['raca_fk']) ? 'selected' : '';
                        echo "<option value='" . $raca['id'] . "' $selected>" . $raca['raca'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="fornecedor_fk">Fornecedor:</label>
                <select name="fornecedor_fk" id="fornecedor_fk">
                    <?php
                    echo '<option value="">Selecione</option>';
                    $fornecedores = $objDB->readAll('tb_fornecedor');
                    foreach ($fornecedores as $fornecedor) {
                        $selected = ($fornecedor['id'] == $result['fornecedor_fk']) ? 'selected' : '';
                        echo "<option value='" . $fornecedor['id'] . "' $selected>" . $fornecedor['nome'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="pai">Pai: </label>
                <input type="number" id="pai" name="pai" value="<?php echo $result['pai']; ?>">
            </div>

            <div class="form-group">
                <label for="mae">Mãe: </label>
                <input type="number" id="mae" name="mae" value="<?php echo $result['mae']; ?>">
            </div>

            <div class="form-group">
                <label for="descricao">Descrição: </label>
                <input type="text" id="descricao" name="descricao" value="<?php echo $result['descricao']; ?>">
            </div>

            <div class="form-group">
                <label>Sexo: </label>
                <label>
                    <input type="radio" id="sexo" name="sexo" value="2" <?= $selected = ($result['sexo'] == 2) ? 'checked' : ''; ?>>
                    Macho
                </label>
                <label>
                    <input type="radio" id="sexo" name="sexo" value="1" <?= $selected = ($result['sexo'] == 1) ? 'checked' : ''; ?>>
                    Fêmea
                </label>
              
            </div>

            <div class="form-group">
                <label for="tem_nota">Tem nota?</label>
                <input type="checkbox" id="tem_nota" name="tem_nota" value="1" <?= $selected = ($result['tem_nota'] == 1) ? 'checked' : ''; ?>>
            </div>

            <div class="form-group">
                <label for="foto">Foto: </label>
                <input type="file" id="foto" name="foto">
            </div>
                
                </br>


            <input type="submit" value="Editar">
        </form>
    </div>
    <script>
        const form = document.querySelector('form');

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const nome = form.nome.value.trim();
            const raca_fk = form.raca_fk.value.trim();
            const lote_fk = form.lote_fk.value.trim();
            const sexo = form.sexo.value.trim();
            const numero = form.numero.value.trim();
            const tem_nota = form.tem_nota.value.trim();

            if (nome === '') {
                alert('Por favor, preencha o campo nome.');
                return;
            }
            if (raca_fk === '') {
                alert('Por favor, preencha o campo raça.');
                return;
            }
            if (lote_fk === '') {
                alert('Por favor, preencha o campo lote.');
                return;
            }

            if (sexo === '') {
                alert('Por favor, preencha o campo sexo.');
                return;
            }
            if (numero === '') {
                alert('Por favor, preencha o campo numero.');
                return;
            }

            if (tem_nota === '') {
                alert('Por favor, preencha o campo tem_nota.');
                return;
            }

            form.submit();
        });
    </script>
</body>

</html>