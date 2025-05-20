<?php
require_once 'database.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Models\ActiveRecord;


ActiveRecord::setDB($db);
?>