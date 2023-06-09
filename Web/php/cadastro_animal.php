<?php
require_once '../lib/php/DB.class.php';
include_once 'navegador.php';
$objDB = new DB();
$objDB->connect();

if ($_POST) {
    $filtro = "numero = " . $_POST['numero'] . " AND status=1";
    $result = $objDB->readWhere("tb_animal", $filtro);
    if ($result) {
        echo "Número já cadastrado.";
        exit;
    }

    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
        $nomeArquivo = $_POST['numero'] . ".jpeg";
        $caminhoTemporario = $_FILES["foto"]["tmp_name"];
        $caminhoDestino = "../../private/photos/" . $nomeArquivo;
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
        "nascimento" => $_POST['nascimento'],
        "pai" => $_POST['pai'],
        "mae" => $_POST['mae'],
        "sexo" => $_POST['sexo'],
        "status" => 1,
        "foto" => $caminhoDestino,
        "descricao" => $_POST['descricao'],
        "tem_nota" => !empty($_POST['tem_nota']) ? $_POST['tem_nota'] : 0
    );

    $objDB->create('tb_animal', $dados);
    header('Location: lista_animal.php');
    exit;
}
?>
<html>

<head>
    <meta charset="UTF=8" />
    <title>Fazenda</title>
    <link rel="stylesheet" type="text/css" href="../../public/assets/styles/formularios.css">
</head>

<body class="corpo">
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
                <input type="text" id="nome" name="nome" required>

                <label for="numero">Número:</label>
                <input type="number" id="numero" name="numero" required>
            </div>

            <div class="form-group">
                <label for="nascimento">Nascimento:</label>
                <input type="date" id="nascimento" name="nascimento" required>

                <label for="lote_fk">Lote:</label>
                <select name="lote_fk" id="lote_fk">
                    <?php
                    echo '<option value="" checked>Selecione</option>';
                    $lotes = $objDB->readAll('tb_lote');
                    foreach ($lotes as $lote) {
                        echo '<option value="' . $lote['id'] . '" >' . $lote['lote'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="raca_fk">Raça:</label>
                <select name="raca_fk" id="raca_fk">
                    <?php
                    echo '<option value="" checked>Selecione</option>';
                    $racas = $objDB->readAll('tb_raca');
                    foreach ($racas as $raca) {
                        echo '<option value="' . $raca['id'] . '" >' . $raca['raca'] . '</option>';
                    }
                    ?>
                </select>

                <label for="fornecedor_fk">Fornecedor:</label>
                <select name="fornecedor_fk" id="fornecedor_fk">
                    <?php
                    echo '<option value="" checked>Selecione</option>';
                    $fornecedores = $objDB->readAll('tb_fornecedor');
                    foreach ($fornecedores as $fornecedor) {
                        echo '<option value="' . $fornecedor['id'] . '" >' . $fornecedor['nome'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="pai">Pai:</label>
                <input type="number" id="pai" name="pai">

                <label for="mae">Mãe:</label>
                <input type="number" id="mae" name="mae">
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao"></textarea>
            </div>

            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <div class="radio-button-container">
                    <input type="radio" id="femea" name="sexo" value="1" checked>
                    <label for="femea">Fêmea</label>
                    <input type="radio" id="macho" name="sexo" value="2">
                    <label for="macho">Macho</label>
                </div>

                <label for="tem_nota">Tem nota?</label>
                <input type="checkbox" id="tem_nota" name="tem_nota" value="1" checked>

                <label>Foto:</label>
                <label for="foto" class="input-file-button">Escolher imagem</label>
                <input type="file" id="foto" name="foto" class="input-file">
                
            </div>

            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
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
            const nascimento = form.nascimento.value.trim();
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

            if (nascimento === '') {
                alert('Por favor, preencha o campo nascimento.');
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