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
  <div class="container mt-5">
    <div class="row">
      <h1 class="col-md-6">Fornecedores</h1>
      <div class="col-md-6 text-right"> 
        <button class='btn btn-success' onclick="location.href ='cadastro_fornecedor.php';">Novo fornecedor</button>
      </div>
      
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nome</th>
          <th>CPF/CNPJ</th>
          <th>Tipo</th>
          <th>E-mail</th>
          <th>Telefone</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        // inclui a classe de banco de dados
        include_once '../lib/php/DB.class.php';
        
        // instancia um objeto da classe Database
        $objDB = new DB();
        $objDB->connect();

        // seleciona todos os registros da tabela funcionarios
        $results = $objDB->readAll('tb_fornecedor');

        foreach ($results as $row) {

          $tipo = $objDB->read('tb_tipo_fornecedor', $row['tipo_fornecedor_fk']);
          echo "<tr>";
          echo "<td>{$row['nome']}</td>";
          echo "<td>{$row['cpf_cnpj']}</td>";
          echo "<td>{$tipo['tipo']}</td>";
          echo "<td>{$row['email']}</td>";
          echo "<td>{$row['telefone']}</td>";
          echo "<td><a href='editar_fornecedor.php?id=" . $row['id'] . "'><button type='button' class='btn btn-primary'><i class='fa fa-pencil'></i>Editar</button></a></td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>
<script src="../lib/js/mascaras.js">
  mascaraTelefone();
</script>