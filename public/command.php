<?php
require_once "../vendor/autoload.php";

use August\Migration\Migration;

$createTAble = new Migration();
$createTAble->createTable();
