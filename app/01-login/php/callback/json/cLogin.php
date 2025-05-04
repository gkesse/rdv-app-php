<?php

declare(strict_types=1);

namespace php\callback\json;

use libs\logger\Logger;

class cLogin
{
    const DEF_METHOD_ON_CONNECT_USER = "on-connect-user";
    const DEF_METHOD_ON_CREATE_ACCOUNT_USER = "on-create-account-user";
    const DEF_METHOD_ON_FORGOT_PASSWORD_USER = "on-forgot-password-user";
    const DEF_KEY_USERNAME = "username";
    const DEF_KEY_PASSWORD = "password";
    const DEF_KEY_CONFIRM_PASSWORD = "confirmPassword";

    public function __construct() {}

    public function run(string $_module, string $_method, array $_reqJSON, cResponse &$_response): void
    {
        if ($_method == self::DEF_METHOD_ON_CONNECT_USER) {
            $this->onConnectUser($_reqJSON, $_response);
        } else if ($_method == self::DEF_METHOD_ON_CREATE_ACCOUNT_USER) {
            $this->onCreateAccountUser($_reqJSON, $_response);
        } else if ($_method == self::DEF_METHOD_ON_FORGOT_PASSWORD_USER) {
            $this->onForgotPasswordUser($_reqJSON, $_response);
        } else if ($_method == self::DEF_METHOD_ON_CREATE_ACCOUNT_USER) {
            $this->onCreateAccountUser($_reqJSON, $_response);
        } else {
            Logger::error(sprintf("La méthode est inconnue.|module=%s|method=%s", $_module, $_method));
        }
    }

    private function onConnectUser(array $_reqJSON, cResponse &$_response): void
    {
        if (!isset($_reqJSON[self::DEF_KEY_USERNAME])) {
            Logger::error("Le nom d'utilisateur n'est pas défini.");
            return;
        }
        if (!isset($_reqJSON[self::DEF_KEY_PASSWORD])) {
            Logger::error("Le mot de passe n'est pas défini.");
            return;
        }

        $oUsername = $_reqJSON[self::DEF_KEY_USERNAME];
        $oPassword = $_reqJSON[self::DEF_KEY_PASSWORD];

        if (empty($oUsername)) {
            Logger::error("Le nom d'utilisateur est obligatoire.");
            return;
        }
        if (empty($oPassword)) {
            Logger::error("Le mot de passe est obligatoire.");
            return;
        }

        $oLogin = new \php\database\sqlite\cLogin();
        $oUuid = "";
        if (!$oLogin->connectUser($oUsername, $oPassword, $oUuid)) {
            return;
        }
        $_response->msgOK();
    }

    private function onCreateAccountUser(array $_reqJSON, cResponse &$_response): void
    {
        if (!isset($_reqJSON[self::DEF_KEY_USERNAME])) {
            Logger::error("Le nom d'utilisateur n'est pas défini.");
            return;
        }
        if (!isset($_reqJSON[self::DEF_KEY_PASSWORD])) {
            Logger::error("Le mot de passe n'est pas défini.");
            return;
        }
        if (!isset($_reqJSON[self::DEF_KEY_CONFIRM_PASSWORD])) {
            Logger::error("La confirmation du mot de passe n'est pas défini.");
            return;
        }

        $oUsername = $_reqJSON[self::DEF_KEY_USERNAME];
        $oPassword = $_reqJSON[self::DEF_KEY_PASSWORD];
        $oConfirmPassword = $_reqJSON[self::DEF_KEY_CONFIRM_PASSWORD];

        if (empty($oUsername)) {
            Logger::error("Le nom d'utilisateur est obligatoire.");
            return;
        }
        if (empty($oPassword)) {
            Logger::error("Le mot de passe est obligatoire.");
            return;
        }
        if (empty($oConfirmPassword)) {
            Logger::error("La confirmation du mot de passe est obligatoire.");
            return;
        }

        if ($oPassword != $oConfirmPassword) {
            Logger::error("Le mot de passe et sa confirmation sont différents.");
            return;
        }

        $oLogin = new \php\database\sqlite\cLogin();
        $oUuid = "";
        if (!$oLogin->createAccountUser($oUsername, $oPassword, $oUuid)) {
            return;
        }
        $_response->msgOK();
    }

    private function onForgotPasswordUser(array $_reqJSON, cResponse &$_response): void
    {
        if (!isset($_reqJSON[self::DEF_KEY_USERNAME])) {
            Logger::error("Le nom d'utilisateur n'est pas défini.");
            return;
        }

        $oUsername = $_reqJSON[self::DEF_KEY_USERNAME];

        if (empty($oUsername)) {
            Logger::error("Le nom d'utilisateur est obligatoire.");
            return;
        }

        $oLogin = new \php\database\sqlite\cLogin();
        $oUuid = "";
        if (!$oLogin->forgotPasswordtUser($oUsername, $oUuid)) {
            return;
        }
        $_response->msgOK();
    }
}
