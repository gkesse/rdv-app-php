<?php

declare(strict_types=1);

namespace php\ui;

class cForgotPassword
{
    public function __construct() {}

    public function run(string &$_html): void
    {
        $_html .= sprintf("<div class='forgot-password-page-01'>\n");
        $_html .= sprintf("<div class='forgot-password-page-02'>Récupération d'un mot de passe utilisateur</div>\n");
        $_html .= sprintf("<div class='forgot-password-page-03'>\n");

        $this->drawVerticalSpacer($_html);
        $this->drawUsername($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawForgotPasswordButton($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawConnexionLink($_html);
        $this->drawVerticalSpacer($_html);

        $_html .= sprintf("</div>\n");
        $_html .= sprintf("</div>\n");
    }

    private function drawVerticalSpacer(string &$_html): void
    {
        $_html .= sprintf("<div class='forgot-password-page-07'></div>\n");
    }

    private function drawUsername(string &$_html): void
    {
        $_html .= sprintf("<div class='forgot-password-page-04'>\n");
        $_html .= sprintf("<label for='idForgotPasswordUser' class='forgot-password-page-05'>Nom d'utilisateur :</label>\n");
        $_html .= sprintf("<input type='text' id='idForgotPasswordUser' class='forgot-password-page-06' placeholder='Entrez le nom d&apos;utilisateur...'/>\n");
        $_html .= sprintf("</div>\n");
    }

    private function drawForgotPasswordButton(string &$_html): void
    {
        $_html .= sprintf("<div class='forgot-password-page-08'>\n");
        $_html .= sprintf("<button type='button'
        onclick='onCallback(\"login\", \"on-forgot-password-user\", this)'>Envoyer</button>\n");
        $_html .= sprintf("</div>\n");
    }

    private function drawConnexionLink(string &$_html): void
    {
        $_html .= sprintf("<div class='forgot-password-page-09'>\n");
        $_html .= sprintf("<div>Vous avez déjà un compte ? <strong class='forgot-password-page-10'
        onclick='onCallback(\"login\", \"on-login-page\", this, \"login-page\")'>Se connecter</strong></div>\n");
        $_html .= sprintf("</div>\n");
    }
}
