<?php

declare(strict_types=1);

namespace db\sqlite\delete\php\php;

use php\database\sqlite\cDatabase;

class cDelete
{
    const DEF_ANSWER_DELETE_YES = "yes";
    const DEF_SEP_DROP_TABLE = "\n";

    public function __construct() {}

    public function run(): void
    {
        echo sprintf("[Info]:Voulez-vous supprimez toutes les tables ? (yes/[no]) : ");
        $oAnswer = rtrim(fgets(STDIN));
        if ($oAnswer != self::DEF_ANSWER_DELETE_YES) {
            echo sprintf("[Warning]:La suppression toutes les tables a été annulée.|dbPath=%s", cDatabase::DEF_DATABASE_PATH);
            return;
        }

        $dbSQL = new cDatabase($this->dbPath());
        $oTables = array();

        if (!$this->loadTables($dbSQL,  $oTables)) {
            echo sprintf("[Error]:Le chargement de toutes les tables a échoué.|dbPath=%s", cDatabase::DEF_DATABASE_PATH);
            return;
        }

        if (empty($oTables)) {
            echo sprintf("[Warning]:Aucune table n'a été trouve.|dbPath=%s", cDatabase::DEF_DATABASE_PATH);
            return;
        }

        if (!$this->deleteTables($dbSQL, $oTables)) {
            echo sprintf("[Error]:La suppression de toutes les tables a échoué.|dbPath=%s", cDatabase::DEF_DATABASE_PATH);
            return;
        }

        echo sprintf("[Info]:La suppression de toutes les tables a réussi.|dbPath=%s", cDatabase::DEF_DATABASE_PATH);
    }

    private function loadTables(cDatabase &$_dbSQL, array &$_tables): bool
    {
        $oSQL = sprintf("
        select 'drop table ' || name from sqlite_master
        where type = 'table' and name not like 'sqlite_%%'");
        if (!$_dbSQL->readMap($oSQL, $_tables)) {
            return false;
        }
        return true;
    }

    private function deleteTables(cDatabase &$_dbSQL, array $_dropTables): bool
    {
        foreach ($_dropTables as $oDropTable) {
            $oSQL = $oDropTable[0];
            echo sprintf("[Info]%s\n", $oSQL);
            if (!$_dbSQL->execQuery($oSQL)) {
                return false;
            }
        }
        return true;
    }

    private function dbPath(): string
    {
        return getenv("DEF_ROOT_PATH") . DIRECTORY_SEPARATOR . cDatabase::DEF_DATABASE_PATH;
    }
}
