<?php 
require_once 'Medoo.php';
use Medoo\Medoo;
global $db;
$db = new Medoo([
	'database_type' => 'mysql',
	'database_name' => 'tecnol43_principal',
	'server' => 'tecnologiawebunid.com',
	'username' => 'tecnol43_principal',
	'password' => 'Principal.2018!'
]);
?>