<?php

declare(strict_types=1);

namespace php\ui;

class cBody
{
    public function __construct() {}

    public function run(string &$_html): void
    {
        $_html .= sprintf("<div>\n");

        $this->drawLoggerPage($_html);
        $this->drawLoaderPage($_html);
        $this->drawLoginPage($_html);
        $this->drawAccountPage($_html);
        $this->drawForgotPasswordPage($_html);

        $_html .= sprintf("</div>\n");
    }

    private function drawLoggerPage(string &$_html): void
    {
        $oLoggerHTML = "";
        $oLogger = new cLogger();
        $oLogger->run($oLoggerHTML);
        $_html .= sprintf("%s", $oLoggerHTML);
    }

    private function drawLoaderPage(string &$_html): void
    {
        $oLoaderHTML = "";
        $oLoader = new cLoader();
        $oLoader->run($oLoaderHTML);
        $_html .= sprintf("%s", $oLoaderHTML);
    }

    private function drawLoginPage(string &$_html): void
    {
        $oLoginHTML = "";
        $oLogin = new cLogin();
        $oLogin->run($oLoginHTML);

        $_html .= sprintf("<div class='idBodyTab' data-name='login-page'>\n");
        $_html .= sprintf("%s", $oLoginHTML);
        $_html .= sprintf("</div>\n");
    }

    private function drawAccountPage(string &$_html): void
    {
        $oAccountHTML = "";
        $oAccount = new cAccount();
        $oAccount->run($oAccountHTML);

        $_html .= sprintf("<div class='idBodyTab' data-name='account-page'>\n");
        $_html .= sprintf("%s", $oAccountHTML);
        $_html .= sprintf("</div>\n");
    }

    private function drawForgotPasswordPage(string &$_html): void
    {
        $oForgotPasswordHTML = "";
        $oForgotPassword = new cForgotPassword();
        $oForgotPassword->run($oForgotPasswordHTML);

        $_html .= sprintf("<div class='idBodyTab' data-name='forgot-password-page'>\n");
        $_html .= sprintf("%s", $oForgotPasswordHTML);
        $_html .= sprintf("</div>\n");
    }
}
