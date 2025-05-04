<?php

declare(strict_types=1);
function onAutoload($_classname)
{
    $classname = getenv("DEF_ROOT_PATH") . DIRECTORY_SEPARATOR . $_classname . ".php";
    //echo sprintf("[Info]:autoload...|classname=%s\n", $classname);
    require $classname;
}

spl_autoload_register('onAutoload');
