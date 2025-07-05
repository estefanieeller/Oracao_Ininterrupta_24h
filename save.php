<?php
require_once("conexao.php");

$codigo = $_REQUEST['id'];
$nome = $_REQUEST['name'];

alterar("oracao","nome='{$nome}'","codigo='{$codigo}'");

$consulta = selecionar("oracao","nome","codigo='{$codigo}'");

echo json_encode($consulta);