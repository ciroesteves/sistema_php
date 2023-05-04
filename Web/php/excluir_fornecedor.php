<?php
require_once '../lib/php/DB.class.php';
$objDB = new DB();
$objDB->connect();

$result = $objDB->delete('tb_fornecedor', $_POST['id']);
header('Location: lista_fornecedor.php');
exit;
