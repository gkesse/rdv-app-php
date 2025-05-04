<?php

declare(strict_types=1);

namespace php\ui;

class cLogger
{
    public function __construct() {}

    public function run(string &$_html): void
    {
        $_html .= sprintf("<div class='logger-page-01' id='idLogger'>\n");
        $_html .= sprintf("<div class='logger-page-02' id='idLoggerForm'>\n");
        $_html .= sprintf("<div class='logger-page-03'>\n");
        $_html .= sprintf("<span id='idLoggerTitle'>Messages d'erreurs</span>\n");
        $_html .= sprintf("<span class='logger-page-05'
        onclick='onCallback(\"logger\", \"on-close-logger\", this)'><i class='fa fa-times'></i></span>\n");
        $_html .= sprintf("</div>\n");
        $_html .= sprintf("<div class='logger-page-04' id='idLoggerMsg'>Bonjour tout le monde.\n");
        $_html .= sprintf("</div>\n");
        $_html .= sprintf("</div>\n");
        $_html .= sprintf("</div>\n");
    }
}
