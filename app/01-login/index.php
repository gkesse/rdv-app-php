<?php

declare(strict_types=1);
require $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "/php/autoload.php";
require $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "/libs/logger/logger.php";
require $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "/libs/uuid/uuid.php";

$oHtml = new php\ui\cHtml();
$oPageHTML = "";
$oHtml->run($oPageHTML);
echo $oPageHTML;
