<?php

declare(strict_types=1);

namespace php\database\sqlite;

use libs\logger\Logger;

class cDatabasePDO
{
    private $m_PDO;
    private $m_dbPath;

    public function __construct(\PDO &$_PDO, string $_dbPath)
    {
        $this->m_PDO = &$_PDO;
        $this->m_dbPath = $_dbPath;
    }

    public function beginTransaction(): bool
    {
        try {
            return $this->m_PDO->beginTransaction();
        } catch (\Exception $e) {
            Logger::error(sprintf("Le démarrage de la transaction SQL a échoué.|dbPath=%s|error=%s", $this->m_dbPath, $e->getMessage()));
        }
        return false;
    }

    public function commitTransaction(): bool
    {
        try {
            return $this->m_PDO->commit();
        } catch (\Exception $e) {
            Logger::error(sprintf("Le commit de la transaction SQL a échoué.|dbPath=%s|error=%s", $this->m_dbPath, $e->getMessage()));
        }
        return false;
    }

    public function rollbackTransaction(): bool
    {
        try {
            return $this->m_PDO->rollback();
        } catch (\Exception $e) {
            Logger::error(sprintf("Le rollback de la transaction SQL a échoué.|dbPath=%s|error=%s", $this->m_dbPath, $e->getMessage()));
        }
        return false;
    }

    public function execQuery(string $_sql, array $_params = array()): bool
    {
        try {
            $oSTMT = $this->m_PDO->prepare($_sql);
            if (!$oSTMT) {
                Logger::error(sprintf("La préparation de la transaction SQL a échoué.|dbPath=%s", $this->m_dbPath));
                return false;
            }
            if (!$oSTMT->execute($_params)) {
                Logger::error(sprintf("L'exécution de la transaction SQL a échoué.|dbPath=%s", $this->m_dbPath));
                return false;
            }
            return true;
        } catch (\Exception $e) {
            Logger::error(sprintf("L'exécution de la transaction SQL a échoué.|dbPath=%s|error=%s", $this->m_dbPath, $e->getMessage()));
        }
        return false;
    }
}
