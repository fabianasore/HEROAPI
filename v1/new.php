<?php

function __construct()
{
    define("../includes/DbConnect.php");
    define("../includes/DbOperation.php");
    require_once dirname(__FILE__) . 'interface/form.html';

$operacao = new DbOperation();
$db = new DbConnect();


$id = $_POST["id"];
$name = $_POST["name"];
$realname = $_POST["realname"];
$rating = $_POST["rating"];
$teamaffilliation = $_POST["teamaffilliation"];


$operacao ->createHero ($name, $realname, $rating, $teamaffilliation);
$db -> connect();
}




