<?php

session_start();

$SESSION = [];
date_default_timezone_set('Europe/Moscow');
$startTime = microtime(true);


if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    http_response_code(405);
    return;
}


$x = isset($_GET["x"]) ? $_GET["x"] : null;
$y = isset($_GET["y"]) ? str_replace(",", ".", $_GET["y"]) : null;
$r = isset($_GET["r"]) ? $_GET["r"] : null;


include "check.php";

    
    if (validate($x,$y,$r)) {
    
    $hit = hit($x, $y, $r);
    if(!isset($_SESSION["dataHistory"])){
        $_SESSION["dataHistory"] = [];
    }
    
    $currentTime = date("Y-m-d H:i:s");
    $endTime = microtime(true);
    $executionTime = $endTime - $startTime;
    $time = number_format($executionTime, 6);
    $result = array($x, $y, $r, $hit,  $currentTime, $time);
    array_push($_SESSION["dataHistory"], $result);
    

    include "insert.php";
    }
    
    else {
        http_response_code(422);}

?>