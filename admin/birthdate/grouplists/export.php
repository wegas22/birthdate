<?php
require_once '../src/Models/Exportst/Exportst.php'; // модель выгрузки
$member2 = new Birthdate\Unload();
//$member3->studentid = $_GET['studentid'];
$member2->unloadsave();
