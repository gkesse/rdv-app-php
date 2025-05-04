<?php

declare(strict_types=1);

namespace php\database\sqlite;

use libs\logger\Logger;

class cDatabaseSTMT
{
    private $m_PDO;
    private $m_STMT;
    private $m_dbPath;

    public function __construct(\PDO &$_PDO, \PDOStatement &$_STMT, $_dbPath)
    {
        $this->m_PDO = &$_PDO;
        $this->m_STMT = &$_STMT;
        $this->m_dbPath = $_dbPath;
    }
}
