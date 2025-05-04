<?php

declare(strict_types=1);

namespace db\sqlite\maj\php;

use php\database\sqlite\cDatabase;
use php\database\sqlite\cDatabasePDO;

class sConfig
{
    public $inputDir;
}

class cMaj
{
    const DEF_SEP_SEMI_COLON = ";";
    const DEF_SEP_DASH = "-";
    const DEF_SEP_SCRIPT = "--[SEP]--";
    const DEF_SCRIPT_CODE_SIZE = 6;
    const DEF_SCRIPT_SQL_PATH = "db/sqlite/maj/sql";

    public function __construct() {}

    public function run()
    {
        $oConfig = new sConfig();
        $this->initConfig($oConfig);
        $this->loadFiles($oConfig);
    }

    private function initConfig(sConfig &$_config): void
    {
        $_config->inputDir = getenv("DEF_ROOT_PATH") . DIRECTORY_SEPARATOR . self::DEF_SCRIPT_SQL_PATH;
    }

    private function loadFiles(sConfig $_config): void
    {
        $oInputDir = sprintf("%s/*.{sql}", $_config->inputDir);
        $oFiles = glob($oInputDir, GLOB_BRACE);

        if (empty($oFiles)) {
            echo sprintf("[Error]:Aucun script SQL n'a été trouvé.|inputDir=%s\n", $_config->inputDir);
            return;
        }

        foreach ($oFiles as $oFile) {
            $oContent = file_get_contents($oFile);
            if (empty($oContent)) {
                echo sprintf("[Error]:Le fichier est vide.|script=%s\n", $oFile);
                continue;
            }
            $oFilename = basename($oFile);
            $oCodeStart = 0;
            $oCodeEnd = strpos($oFilename, self::DEF_SEP_DASH, $oCodeStart);
            if (!$oCodeEnd) {
                echo sprintf("[Error]:Le code du script est obligatoire.|script=%s\n", $oFile);
                continue;
            }
            $oCode = substr($oFilename, $oCodeStart, $oCodeEnd - $oCodeStart);
            if (strlen($oCode) != self::DEF_SCRIPT_CODE_SIZE) {
                echo sprintf("[Error]:Le code du script a une taille de (%d).|script=%s\n", self::DEF_SCRIPT_CODE_SIZE, $oFile);
                continue;
            }
            if (!is_numeric($oCode)) {
                echo sprintf("[Error]:Le code du script est numérique.|script=%s\n", $oFile);
                continue;
            }

            $dbSQL = new cDatabase($this->dbPath());

            if ($this->existScript($dbSQL, $oCode)) {
                echo sprintf("[Error]:Le script SQL a déjà été exécuté.|script=%s\n", $oFile);
                continue;
            }

            if (!$this->executeScript($dbSQL, $oContent)) {
                echo sprintf("[Error]:L'exécution du script SQL a échoué.|script=%s\n", $oFile);
                continue;
            }

            if (!$this->saveScript($dbSQL, $oCode, $oFilename)) {
                echo sprintf("[Error]:L'enregistrement du script SQL a échoué.|script=%s\n", $oFile);
                continue;
            }

            echo sprintf("[Info]:L'exécution du script SQL a réussi.|script=%s\n", $oFile);
        }
    }

    private function dbPath(): string
    {
        return getenv("DEF_ROOT_PATH") . DIRECTORY_SEPARATOR . cDatabase::DEF_DATABASE_PATH;
    }

    private function existScript(cDatabase $_dbSQL, string $_code): bool
    {
        $oSQL = sprintf("select count(*) from _maj
        where _code = :code");
        $oParams = array(
            ":code" => $_code
        );
        $oCount = "";
        if (!$_dbSQL->readData($oSQL, $oCount, $oParams)) {
            return false;
        }
        $iCount = intval($oCount);
        return ($iCount > 0);
    }

    private function executeScript(cDatabase $_dbSQL, string $_content): bool
    {
        return $_dbSQL->transactionQuery($_content, $this->onExecuteScript(...));
    }

    private function onExecuteScript(cDatabasePDO $_dbPDO, string $_content, $_params): bool
    {
        $oScriptSQLs = explode(self::DEF_SEP_SCRIPT, $_content);
        foreach ($oScriptSQLs as $oScriptSQL) {
            if (!$_dbPDO->execQuery($oScriptSQL)) {
                return false;
            }
        }
        return true;
    }

    private function saveScript(cDatabase $_dbSQL, string $_code, string $_filename): bool
    {
        $oSQL = sprintf("
        insert into _maj (_code, _script)
        values ('%s', '%s')", $_code, $_filename);
        return $_dbSQL->execQuery($oSQL);
    }
}
