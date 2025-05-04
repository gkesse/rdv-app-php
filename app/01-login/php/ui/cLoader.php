<?php

declare(strict_types=1);

namespace php\ui;

class cLoader
{
    public function __construct() {}

    public function run(string &$_html): void
    {
        $_html .= sprintf("<div class='loader-page-01' id='idLoader'>\n");
        $_html .= sprintf("<div class='loader-page-02' id='idLoaderForm'>\n");
        $_html .= sprintf("<div class='loader-page-03'>\n");
        $_html .= sprintf("<div class='loader-page-04'>\n");

        $_html .= sprintf("<div class='loader-page-05'></div>\n");
        $_html .= sprintf("<span class='loader-page-06'>Loading...</span>\n");

        $_html .= sprintf("</div>\n");
        $_html .= sprintf("</div>\n");
        $_html .= sprintf("</div>\n");
        $_html .= sprintf("</div>\n");
    }
}
