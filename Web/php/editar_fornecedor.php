<?php
require_once '../lib/php/DB.class.php';
include_once 'navegador.php';
$objDB = new DB();
$objDB->connect();

$result = $objDB->read('tb_fornecedor', $_GET['id']);

if ($_POST) {
    $dados = array(
        "nome" => $_POST['nome'],
        "cpf_cnpj" => $_POST['cpf_cnpj'],
        "tipo_fornecedor_fk" => $_POST['tipo'],
        "email" => $_POST['email'],
        "telefone" => $_POST['telefone']
    );
    $filtro = "id={$result['id']}";
    $objDB->update('tb_fornecedor', $dados, $filtro);
    header('Location: lista_fornecedor.php');
    exit;
}
?>

<html>

<head>
    <meta charset="UTF=8" />
    <title>Fazenda</title>
    <link rel="stylesheet" type="text/css" href="../../Style/formularios.css">
</head>

<body class="corpo">
    <div class="container-small">
    <div class="row">
      <div class="col-md-2 text-right"> 
        <a onclick="location.href ='lista_fornecedor.php';">Voltar</a>
      </div>
      <h1 class="col-md-6">Edição de Fornecedor</h1>
    </div>
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $result['nome']; ?>" required>
            </div>

            <div class="form-group">
                <label for="cpf_cnpj">CPF/CNPJ:</label>
                <input type="text" id="cpf_cnpj" name="cpf_cnpj" value="<?php echo $result['cpf_cnpj']; ?>" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo">
                    <?php
                    $fornecedores = $objDB->readAll('tb_tipo_fornecedor');
                    foreach ($fornecedores as $fornecedor) {
                        $selected = ($fornecedor['id'] == $result['tipo']) ? 'selected' : '';
                        echo '<option value="' . $fornecedor['id'] . '"' . $selected . ' >' . $fornecedor['tipo'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $result['email']; ?>">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="<?php echo $result['telefone']; ?>">
            </div>

            <div class="form-group">
                <button type="submit">Editar</button>
            </div>
        </form>
        <form method="POST" action="excluir_fornecedor.php" style="display:none">
            <input hidden type="text" id="id" name="id" value="<?php echo $result['id']; ?>">
            <input id="excluir" type="submit" value="Excluir">
        </form>
    </div>
    <script>
        const form = document.querySelector('form');

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const nome = form.nome.value.trim();
            const cpf_cnpj = form.cpf_cnpj.value.trim();

            if (nome === '') {
                alert('Por favor, preencha o campo nome.');
                return;
            }

            if (cpf_cnpj === '') {
                alert('Por favor, preencha o campo CPF/CNPJ.');
                return;
            }

            form.submit();
        });
    </script>
</body>

</html>