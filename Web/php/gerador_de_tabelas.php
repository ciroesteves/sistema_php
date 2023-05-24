<?php

function gerar_tabela($tabela, $coluna, $titulo)
{
    include_once '../lib/php/DB.class.php';

    $objDB = new DB();
    $objDB->connect();

    echo "
        <div class='container mt-5' style='width:400px;'>
            <div class='row'>
            <h3 class='col-md-6'>{$titulo}</h3>
            <div class='col-md-6 text-right'> 
                <button class='btn btn-success' onclick='location.href ='#';'>Novo fornecedor</button>
            </div>
            </div>
            <table class='table table-striped'>
            <thead>
                <tr>
                <th>Tipo</th>
                <th></th>
                </tr>
            </thead>
            <tbody>";
    $results = $objDB->readAll($tabela);

    foreach ($results as $row) {

        echo "<tr>
                    <td>{$row[$coluna]}</td>
                    <td>
                        <a href='editar_fornecedor.php?id=" . $row['id'] . "'>
                            <button type='button' class='btn btn-primary'>
                                <i class='fa fa-pencil'></i>
                                Editar
                            </button>
                        </a>
                    </td>
                </tr>";
    }

    echo "  </tbody>
        </table>
    </div>";
}
