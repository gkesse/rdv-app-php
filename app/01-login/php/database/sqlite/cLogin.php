<?php

declare(strict_types=1);

namespace php\database\sqlite;

use libs\logger\Logger;

use function libs\uuid\uuid;

class cLogin
{
    public function __construct() {}

    public function connectUser(string $_username, string $_password, string &$_uuid): bool
    {
        if (!$this->loadUserUuid($_username, $_password, $_uuid)) {
            return false;
        }
        return true;
    }

    public function createAccountUser(string $_username, string $_password, &$_uuid): bool
    {
        if ($this->loadUserUuid($_username, $_password, $_uuid)) {
            Logger::warning(sprintf("L'utilisateur existe déjà.|username=%s", $_username));
            return false;
        }
        if (!$this->createUser($_username, $_password, $_uuid)) {
            return false;
        }
        return true;
    }

    public function forgotPasswordtUser(string $_username, string &$_uuid): bool
    {
        if (!$this->loadUnsernameUuid($_username, $_uuid)) {
            Logger::warning(sprintf("L'utilisateur n'existe pas encore.|username=%s", $_username));
            return false;
        }
        return true;
    }

    private function loadUserUuid(string $_username, string $_password, string &$_uuid): bool
    {
        $dbSQL = new cDatabase();
        $oSQL = "select _uuid from _user
        where _username = :username and _password = :password";
        $oParams = array(
            ":username" => $_username,
            ":password" => $_password
        );
        $oUuid = array();
        if (!$dbSQL->readMap($oSQL, $oUuid, $oParams)) {
            return false;
        }
        if (empty($oUuid)) {
            Logger::warning(sprintf("L'utilisateur n'existe pas encore.|username=%s", $_username));
            return false;
        }
        if (count(($oUuid)) > 1) {
            Logger::error(sprintf("Plusieurs utilisateurs possèdent le même nom d'utilisateur.|username=%s", $_username));
            return false;
        }
        $_uuid = $oUuid[0][0];
        return true;
    }

    private function loadUnsernameUuid(string $_username, string &$_uuid): bool
    {
        $dbSQL = new cDatabase();
        $oSQL = "select _uuid from _user
        where _username = :username";
        $oParams = array(
            ":username" => $_username
        );
        $oUuid = array();
        if (!$dbSQL->readMap($oSQL, $oUuid, $oParams)) {
            return false;
        }
        if (empty($oUuid)) {
            Logger::warning(sprintf("L'utilisateur n'existe pas encore.|username=%s", $_username));
            return false;
        }
        if (count(($oUuid)) > 1) {
            Logger::error(sprintf("Plusieurs utilisateurs possèdent le même nom d'utilisateur.|username=%s", $_username));
            return false;
        }
        $_uuid = $oUuid[0][0];
        return true;
    }

    private function createUser(string $_username, string $_password, string &$_uuid): bool
    {
        $_uuid = uuid();
        $dbSQL = new cDatabase();
        $oSQL = "insert into _user (_uuid, _username, _password)
        values (:uuid, :username, :password)";
        $oParams = array(
            ":uuid" => $_uuid,
            ":username" => $_username,
            ":password" => $_password
        );
        if (!$dbSQL->execQuery($oSQL, $oParams)) {
            return false;
        }
        return true;
    }
}
