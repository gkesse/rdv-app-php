<?php

declare(strict_types=1);

namespace php\ui;

class sHtml
{
    public $title = "";
    public $encoding = "";
    public $lang = "";
    public $logo = "";
    public $mimeType = "";
}

class cHtml
{
    public function __construct() {}

    public function run(string &$_html): void
    {
        $oHtml = new sHtml();
        $this->initHtml($oHtml);

        $oBodyHTML = "";
        $oBody = new cBody();
        $oBody->run($oBodyHTML);

        $_html .= sprintf("<!DOCTYPE html>\n");
        $_html .= sprintf("<html lang='%s'>\n", $oHtml->lang);
        $_html .= sprintf("<head>\n");
        $_html .= sprintf("<title>%s</title>\n", $oHtml->title);
        $_html .= sprintf("<meta charset='%s'/>\n", $oHtml->encoding);
        $_html .= sprintf("<link rel='shortcut icon' type='%s' href='%s'/>\n", $oHtml->mimeType, $oHtml->logo);
        $_html .= sprintf("<meta name='viewport' content='width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0, user-scalable=no'/>\n");
        $_html .= sprintf("<link rel='stylesheet' href='/libs/font-awesome/css/font-awesome.min.css'/>");
        $_html .= sprintf("<link rel='stylesheet' href='/css/styles.css'/>\n");
        $_html .= sprintf("</head>\n");
        $_html .= sprintf("<body>\n");
        $_html .= sprintf("%s", $oBodyHTML);
        $_html .= sprintf("<script src='/js/client/json/cAjax.js'></script>\n");
        $_html .= sprintf("<script src='/js/ui/cLogger.js'></script>\n");
        $_html .= sprintf("<script src='/js/ui/cLoader.js'></script>\n");
        $_html .= sprintf("<script src='/js/ui/cLogin.js'></script>\n");
        $_html .= sprintf("<script src='/js/callback/cResponse.js'></script>\n");
        $_html .= sprintf("<script src='/js/callback/cLogger.js'></script>\n");
        $_html .= sprintf("<script src='/js/callback/cLogin.js'></script>\n");
        $_html .= sprintf("<script src='/js/callback/cCallback.js'></script>\n");
        $_html .= sprintf("<script src='/js/callback/callback.js'></script>\n");
        $_html .= sprintf("</body>\n");
        $_html .= sprintf("</html>\n");
    }

    private function initHtml(sHtml &$_sHtml): void
    {
        $_sHtml->title = "ReadyPHP | Connexion d'un utilisateur";
        $_sHtml->encoding = "UTF-8";
        $_sHtml->lang = "fr";
        $_sHtml->logo = "/data/img/logo.png";
        $_sHtml->mimeType = "image/png";
    }
}
