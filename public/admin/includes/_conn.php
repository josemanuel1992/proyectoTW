<?php
/**
 * Created by PhpStorm.
 * User: iKabot
 * Date: 4/3/18
 * Time: 7:24 PM
 */

require_once __DIR__  . '/../../../class/Medoo.php';

use Medoo\Medoo;

$db = new Medoo();

$db = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'tecnol43_principal',
    'server' => 'tecnologiawebunid.com',
    'username' => 'tecnol43_principal',
    'password' => 'Principal.2018!'
]);