<?php

declare(strict_types=1);

namespace php\callback\json;

require $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "php/autoload.php";
require $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "libs/logger/logger.php";
require $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "/libs/uuid/uuid.php";

$oCallback = new cCallback();
$oCallback->run();
