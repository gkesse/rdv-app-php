<?php

declare(strict_types=1);

session_start();

function onAutoload($_classname)
{
    $classname = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $_classname . ".php";
    //echo sprintf("[Info]:autoload...|classname=%s\n", $classname);
    require $classname;
}

spl_autoload_register('onAutoload');
