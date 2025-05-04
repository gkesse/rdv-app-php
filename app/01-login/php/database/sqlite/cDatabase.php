<?php

declare(strict_types=1);

namespace php\database\sqlite;

use libs\logger\Logger;

class cDatabase
{
    const DEF_DATABASE_PATH = "db/sqlite/db/database.dat";

    private $m_dbPath;

    public function __construct(string $_dbPath = "")
    {
        if (empty($_dbPath)) {
            $this->m_dbPath = $this->dbPath();
        } else {
            $this->m_dbPath = $_dbPath;
        }
    }

    public function execQuery(string $_sql, array $_params = array()): bool
    {
        try {
            $oPDO = null;
            if (!$this->open($oPDO)) {
                return false;
            }
            $oSTMT = $oPDO->prepare($_sql);
            if (!$oSTMT) {
                Logger::error(sprintf("La préparation de la requête SQL a échoué.|dbPath=%s", $this->m_dbPath));
                return false;
            }
            if (!$oSTMT->execute($_params)) {
                Logger::error(sprintf("L'exécution de la requête SQL a échoué.|dbPath=%s", $this->m_dbPath));
                return false;
            }
            return true;
        } catch (\Exception $e) {
            Logger::error(sprintf("L'exécution de la requête SQL a échoué.|dbPath=%s|error=%s", $this->m_dbPath, $e->getMessage()));
        }
        return false;
    }

    public function transactionQuery(string $_sql, callable $_callback, array $_params = array()): bool
    {
        try {
            $oPDO = null;
            if (!$this->open($oPDO)) {
                return false;
            }
            $dbPDO = new cDatabasePDO($oPDO, $this->m_dbPath);
            $dbPDO->beginTransaction();
            if (!$_callback($dbPDO, $_sql, $_params)) {
                Logger::error(sprintf("L'exécution du callback sur la transaction SQL a échoué.|dbPath=%s", $this->m_dbPath));
                $dbPDO->rollbackTransaction();
                return false;
            }
            $dbPDO->commitTransaction();
            return true;
        } catch (\Exception $e) {
            Logger::error(sprintf("L'exécution de la transaction SQL a échoué.|dbPath=%s|error=%s", $this->m_dbPath, $e->getMessage()));
        }
        return false;
    }

    public function loopQuery(string $_sql, callable $_callback, array $_params = array()): bool
    {
        try {
            $oPDO = null;
            if (!$this->open($oPDO)) {
                return false;
            }
            $oSTMT = $oPDO->prepare($_sql);
            if (!$oSTMT) {
                Logger::error(sprintf("La préparation de la requête SQL a échoué.|dbPath=%s", $this->m_dbPath));
                return false;
            }
            $dbSTMT = new cDatabaseSTMT($oPDO, $oSTMT, $this->m_dbPath);
            if (!$_callback($dbSTMT, $this->m_dbPath, $_params)) {
                Logger::error(sprintf("L'exécution du callback sur la requête SQL a échoué.|dbPath=%s", $this->m_dbPath));
                return false;
            }
            return true;
        } catch (\Exception $e) {
            Logger::error(sprintf("L'exécution de la requête SQL a échoué.|dbPath=%s|error=%s", $this->m_dbPath, $e->getMessage()));
        }
        return false;
    }

    public function readData(string $_sql, string &$_data, array $_params = array()): bool
    {
        try {
            $oPDO = null;
            if (!$this->open($oPDO)) {
                return false;
            }
            $oSTMT = $oPDO->prepare($_sql);
            if (!$oSTMT) {
                Logger::error(sprintf("La préparation de la requête SQL a échoué.|dbPath=%s", $this->m_dbPath));
                return false;
            }
            if (!$oSTMT->execute($_params)) {
                Logger::error(sprintf("L'exécution de la requête SQL a échoué.|dbPath=%s", $this->m_dbPath));
                return false;
            }
            $oResult = $oSTMT->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($oResult as $oRow) {
                foreach ($oRow as $oValue) {
                    $_data = $oValue;
                    break;
                }
            }
            return true;
        } catch (\Exception $e) {
            Logger::error(sprintf("L'exécution de la requête SQL a échoué.|dbPath=%s|error=%s", $this->m_dbPath, $e->getMessage()));
        }
        return false;
    }

    public function readMap(string $_sql, array &$_dataMap, array $_params = array()): bool
    {
        try {
            $oPDO = null;
            if (!$this->open($oPDO)) {
                return false;
            }
            $oSTMT = $oPDO->prepare($_sql);
            if (!$oSTMT) {
                Logger::error(sprintf("La préparation de la requête SQL a échoué.|dbPath=%s", $this->m_dbPath));
                return false;
            }
            if (!$oSTMT->execute($_params)) {
                Logger::error(sprintf("L'exécution de la requête SQL a échoué.|dbPath=%s", $this->m_dbPath));
                return false;
            }
            $oResult = $oSTMT->fetchAll(\PDO::FETCH_ASSOC);
            $_dataMap = array();
            foreach ($oResult as $oRow) {
                $oDataRow = array();
                foreach ($oRow as $oValue) {
                    $oDataRow[] = $oValue;
                }
                $_dataMap[] = $oDataRow;
            }
            return true;
        } catch (\Exception $e) {
            Logger::error(sprintf("L'exécution de la requête SQL a échoué.|dbPath=%s|error=%s", $this->m_dbPath, $e->getMessage()));
        }
        return false;
    }

    private function open(\PDO|null &$_PDO): bool
    {
        try {
            $dbPath = sprintf("sqlite:%s", $this->m_dbPath);
            $_PDO = new \PDO($dbPath);
            $_PDO->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $_PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (\Exception $e) {
            Logger::error(sprintf("L'initialisation du module PDO a échoué.|dbPath=%s|error=%s", $dbPath, $e->getMessage()));
        }
        return false;
    }

    private function dbPath(): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . self::DEF_DATABASE_PATH;
    }
}
