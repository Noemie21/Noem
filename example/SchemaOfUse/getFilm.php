<?php
require "vendor/autoload.php";

use App\Entity\Film;

$film = new Film();
$film->getAll();
var_dump($film);