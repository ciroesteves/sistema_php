<?php
require_once '../lib/php/DB.class.php';
$objDB = new DB();
$objDB->connect();

if ($_POST) {
    // Recebe os dados do formulário
    $dados = array(
        "nome" => $_POST['nome'],
        "numero" => $_POST['numero'],
        "lote_fk" => $_POST['lote_fk'],
        "raca_fk" => $_POST['raca_fk'],
        "fornecedor_fk" => $_POST['fornecedor_fk'],
        "pai" => $_POST['pai'],
        "mae" => $_POST['mae'],
        "sexo" => $_POST['sexo'],
        "status" => $_POST['status'],
        "foto" => $_POST['foto'],
        "descricao" => $_POST['descricao'],
        "tem_nota" => $_POST['tem_nota']
    );

    // Query de inserção
    $objDB->create('tb_animal', $dados);
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
        <div class="row">
            <div class="col-md-2 text-right">
                <a onclick="location.href ='lista_animal.php';">Voltar</a>
            </div>
            <h1 class="col-md-6">Cadastro de Animal</h1>
        </div>
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="numero">Número:</label>
                <input type="number" id="numero" name="numero" required>
            </div>

            <div class="form-group">
                <label for="lote_fk">Lote:</label>
                <select name="lote_fk" id="lote_fk">
                    <?php
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
                    $racas = $objDB->readAll('tb_raca');
                    foreach ($racas as $raca) {
                        echo '<option value="' . $raca['id'] . '" >' . $raca['raca'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="fornecedor_fk">Raça:</label>
                <select name="fornecedor_fk" id="fornecedor_fk">
                    <?php
                    $fornecedores = $objDB->readAll('tb_fornecedor');
                    foreach ($fornecedores as $fornecedor) {
                        echo '<option value="' . $fornecedor['id'] . '" >' . $fornecedor['nome'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="pai">Pai:</label>
                <input type="text" id="pai" name="pai">
            </div>

            <div class="form-group">
                <label for="mae">Mãe:</label>
                <input type="text" id="mae" name="mae">
            </div>


            <div>
                <label for="macho">Macho</label>
                <input type="radio" id="macho" name="macho" value="2" checked>

                <label for="femea">Fêmea</label>
                <input type="radio" id="femea" name="femea" value="1">
            </div>

            <div>
                <label for="tem_nota">Tem nota?</label>
                <input type="checkbox" id="tem_nota" name="tem_nota" checked>
            </div>


            <input type="submit" value="Cadastrar">
        </form>
    </div>
    <script>
        const form = document.querySelector('form');

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const nome = form.nome.value.trim();

            if (nome === '') {
                alert('Por favor, preencha o campo nome.');
                return;
            }

            form.submit();
        });
    </script>
</body>

</html>