<?php

declare(strict_types=1);

namespace php\callback\json;

use libs\logger\Logger;

class cCallback
{
    const DEF_REQUEST_SIZE_MAX = 1 * 1024 * 1024; // 1 Mo
    const DEF_KEY_MODULE = "module";
    const DEF_KEY_METHOD = "method";
    const DEF_MODULE_LOGIN = "login";

    public function __construct() {}

    public function run(): void
    {
        $oRequest = file_get_contents("php://input");
        $oResponse = new cResponse();
        $oRequestSize = $_SERVER['CONTENT_LENGTH'];

        if ($oRequestSize < self::DEF_REQUEST_SIZE_MAX) {
            $oJSON = \json_decode($oRequest, true);

            if (\json_last_error() === JSON_ERROR_NONE) {
                $this->runJSON($oJSON, $oResponse);
            }
        }

        $oResponse->sendResponse();
    }

    private function runJSON($_reqJSON, cResponse &$_response): void
    {
        if (!isset($_reqJSON[self::DEF_KEY_MODULE])) {
            Logger::error("Le module n'est pas défini.");
            return;
        }
        if (!isset($_reqJSON[self::DEF_KEY_METHOD])) {
            Logger::error("Le method n'est pas définie.");
            return;
        }

        $oModule = $_reqJSON[self::DEF_KEY_MODULE];
        $oMethod = $_reqJSON[self::DEF_KEY_METHOD];

        if (empty($oModule)) {
            Logger::error("Le module est obligatoire.");
            return;
        }
        if (empty($oMethod)) {
            Logger::error("Le method est obligatoire.");
            return;
        }

        $this->runCallback($oModule, $oMethod, $_reqJSON, $_response);
    }

    private function runCallback(string $_module, string $_method, array $_reqJSON, cResponse &$_response): void
    {
        if ($_module == self::DEF_MODULE_LOGIN) {
            $this->onLogin($_module, $_method, $_reqJSON, $_response);
        } else {
            Logger::error(sprintf("Le module est inconnu.|module=%s|method=%s", $_module, $_method));
        }
    }

    private function onLogin(string $_module, string $_method, array $_reqJSON, cResponse &$_response): void
    {
        $oLogin = new cLogin();
        $oLogin->run($_module, $_method, $_reqJSON, $_response);
    }
}
