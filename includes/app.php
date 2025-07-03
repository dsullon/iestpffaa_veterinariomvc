<?php
use Models\ActiveRecord;
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
require_once 'funciones.php';
require_once 'database.php';

ActiveRecord::setDB($db);
?>