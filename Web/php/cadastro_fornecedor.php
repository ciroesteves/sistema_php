<?php
require_once '../lib/php/DB.class.php';
$objDB = new DB();
$objDB->connect();

if ($_POST) {
	// Recebe os dados do formulário
	$dados = array(
		"nome" => $_POST['nome'],
		"cpf_cnpj" => $_POST['cpf_cnpj'],
		"tipo_fornecedor_fk" => $_POST['tipo'],
		"email" => $_POST['email'],
		"telefone" => $_POST['telefone']
	);

	// Query de inserção
	$objDB->create('tb_fornecedor', $dados);
	header('Location: lista_fornecedor.php');
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
        <a onclick="location.href ='lista_fornecedor.php';">Voltar</a>
      </div>
      <h1 class="col-md-6">Cadastro de Fornecedor</h1>
    </div>
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="cpf_cnpj">CPF/CNPJ:</label>
                <input type="text" id="cpf_cnpj" name="cpf_cnpj" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo">
    			<?php
					// Chama a função que retorna a lista de funcionários do banco de dados
					$fornecedores = $objDB->readAll('tb_tipo_fornecedor');
					foreach ($fornecedores as $fornecedor) {
						echo '<option value="' . $fornecedor['id'] . '" >' . $fornecedor['tipo'] . '</option>';
					}
				?>
				</select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone">
            </div>

            <input type="submit" value="Cadastrar">
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
