<?php

declare(strict_types=1);

namespace php\ui;

class cLogin
{
    public function __construct() {}

    public function run(string &$_html): void
    {
        $_html .= sprintf("<div class='login-page-01'>\n");
        $_html .= sprintf("<div class='login-page-02'>Connexion d'un utilisateur</div>\n");
        $_html .= sprintf("<div class='login-page-03'>\n");

        $this->drawVerticalSpacer($_html);
        $this->drawUsername($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawPassword($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawForgotPasswordLink($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawConnectionButton($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawVerticalSpacer($_html);
        $this->drawSubscriptionLink($_html);
        $this->drawVerticalSpacer($_html);

        $_html .= sprintf("</div>\n");
        $_html .= sprintf("</div>\n");
    }

    private function drawVerticalSpacer(string &$_html): void
    {
        $_html .= sprintf("<div class='login-page-07'></div>\n");
    }

    private function drawUsername(string &$_html): void
    {
        $_html .= sprintf("<div class='login-page-04'>\n");
        $_html .= sprintf("<label for='login-username' class='login-page-05'>Nom d'utilisateur :</label>\n");
        $_html .= sprintf("<input type='text' id='login-username' class='login-page-06' placeholder='Entrez le nom d&apos;utilisateur...'/>\n");
        $_html .= sprintf("</div>\n");
    }

    private function drawPassword(string &$_html): void
    {
        $_html .= sprintf("<div class='login-page-04'>\n");
        $_html .= sprintf("<label for='login-password' class='login-page-05'>Mot de passe :</label>\n");
        $_html .= sprintf("<input type='password' id='login-password' class='login-page-06' placeholder='Entrez le mot de passe...'/>\n");
        $_html .= sprintf("</div>\n");
    }

    private function drawConnectionButton(string &$_html): void
    {
        $_html .= sprintf("<div class='login-page-08'>\n");
        $_html .= sprintf("<button type='button'
        onclick='onCallback(\"login\", \"on-connect-user\", this)'>Se connecter</button>\n");
        $_html .= sprintf("</div>\n");
    }

    private function drawSubscriptionLink(string &$_html): void
    {
        $_html .= sprintf("<div class='login-page-09'>\n");
        $_html .= sprintf("<div>Vous n'avez pas encore de compte ?
        <strong class='login-page-10' onclick='onCallback(\"login\", \"on-login-page\", this, \"account-page\")'>Créer un compte</strong></div>\n");
        $_html .= sprintf("</div>\n");
    }

    private function drawForgotPasswordLink(string &$_html): void
    {
        $_html .= sprintf("<div class='login-page-11'>\n");
        $_html .= sprintf("<strong class='login-page-12'
        onclick='onCallback(\"login\", \"on-login-page\", this, \"forgot-password-page\")'>Vous avez oublié votre mot de passe ?</strong>\n");
        $_html .= sprintf("</div>\n");
    }
}
