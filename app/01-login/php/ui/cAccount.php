<?php

declare(strict_types=1);

namespace php\ui;

class cAccount
{
    public function __construct() {}

    public function run(string &$_html): void
    {
        $_html .= sprintf("<div class='account-page-01'>\n");
        $_html .= sprintf("<div class='account-page-02'>Création d'un compte utilisateur</div>\n");
        $_html .= sprintf("<div class='account-page-03'>\n");

        $this->drawVerticalSpacer($_html);
        $this->drawUsername($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawPassword($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawConfirmPassword($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawAccountButton($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawConnexionLink($_html);
        $this->drawVerticalSpacer($_html);

        $_html .= sprintf("</div>\n");
        $_html .= sprintf("</div>\n");
    }

    private function drawVerticalSpacer(string &$_html): void
    {
        $_html .= sprintf("<div class='account-page-07'></div>\n");
    }

    private function drawUsername(string &$_html): void
    {
        $_html .= sprintf("<div class='account-page-04'>\n");
        $_html .= sprintf("<label for='idAccountUsername' class='account-page-05'>Nom d'utilisateur :</label>\n");
        $_html .= sprintf("<input type='text' id='idAccountUsername' class='account-page-06' placeholder='Entrez le nom d&apos;utilisateur...'/>\n");
        $_html .= sprintf("</div>\n");
    }

    private function drawPassword(string &$_html): void
    {
        $_html .= sprintf("<div class='account-page-04'>\n");
        $_html .= sprintf("<label for='idAccountPassword' class='account-page-05'>Mot de passe :</label>\n");
        $_html .= sprintf("<input type='password' id='idAccountPassword' class='account-page-06' placeholder='Entrez le mot de passe...'/>\n");
        $_html .= sprintf("</div>\n");
    }

    private function drawConfirmPassword(string &$_html): void
    {
        $_html .= sprintf("<div class='account-page-04'>\n");
        $_html .= sprintf("<label for='idAccountConfirmPassword' class='account-page-05'>Confirmation :</label>\n");
        $_html .= sprintf("<input type='password' id='idAccountConfirmPassword' class='account-page-06' placeholder='Entrez le mot de passe...'/>\n");
        $_html .= sprintf("</div>\n");
    }

    private function drawAccountButton(string &$_html): void
    {
        $_html .= sprintf("<div class='account-page-08'>\n");
        $_html .= sprintf("<button type='button'
        onclick='onCallback(\"login\", \"on-create-account-user\", this)'>Créer votre compte</button>\n");
        $_html .= sprintf("</div>\n");
    }

    private function drawConnexionLink(string &$_html): void
    {
        $_html .= sprintf("<div class='login-page-09'>\n");
        $_html .= sprintf("<div>Vous avez déjà un compte ? <strong class='login-page-10'
        onclick='onCallback(\"login\", \"on-login-page\", this, \"login-page\")'>Se connecter</strong></div>\n");
        $_html .= sprintf("</div>\n");
    }
}
