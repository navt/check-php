<?php
header('Content-Type: text/html; charset= utf-8');
error_reporting(E_ALL);
ini_set('display_errors', "1");

chdir(__DIR__);

spl_autoload_register(function (string $class) {
    $path = "library/".$class.".php";
    if (file_exists($path)) {
        include $path;
    }
});

$ch = new CheckPHP();
$ch->checkVersion()->checkFuncs()->checkNeeds()->checkRecoms();

echo H::render("out", ["out"=>H::render("php-out", $ch->info)]);