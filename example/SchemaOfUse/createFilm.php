<?php
require "vendor/autoload.php";
use App\Entity\Film;


$film = new Film();
$film->title = "The Room";
$film->duration = 150;
$film->release_date = "2010-05-20";

$film->save();
// save() also update the database if your precise his ID