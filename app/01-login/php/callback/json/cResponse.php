<?php

declare(strict_types=1);

namespace php\callback\json;

class cResponse
{
    const DEF_KEY_STATUS = "status";
    const DEF_KEY_STATUS_CODE = "code";
    const DEF_KEY_STATUS_MSG = "msg";
    const DEF_KEY_DATA = "data";

    const DEF_STATUS_CODE_OK = "ok";
    const DEF_STATUS_CODE_ERROR = "error";
    const DEF_DEFAULT_MSG_ERROR = "Un problème a été rencontré.";
    const DEF_DEFAULT_MSG_OK = "La requête a bien été traitée.";

    private $m_statusCode;
    private $m_statusMsg;
    private $m_responseData;

    public function __construct()
    {
        $this->m_statusCode = self::DEF_STATUS_CODE_ERROR;
        $this->m_statusMsg = self::DEF_DEFAULT_MSG_ERROR;
        $this->m_responseData = array();
    }

    public function msgError($_msgError = self::DEF_DEFAULT_MSG_ERROR): void
    {
        $this->m_statusCode = self::DEF_STATUS_CODE_ERROR;
        $this->m_statusMsg = $_msgError;
    }

    public function msgOK($_msgOK = self::DEF_DEFAULT_MSG_OK): void
    {
        $this->m_statusCode = self::DEF_STATUS_CODE_OK;
        $this->m_statusMsg = $_msgOK;
    }

    public function responseData($_responseData): void
    {
        $this->m_responseData = $_responseData;
    }

    public function hasErrors(): bool
    {
        return ($this->m_statusCode == self::DEF_STATUS_CODE_ERROR);
    }

    public function sendResponse(): void
    {
        $oResponse = array();
        $oResponse[self::DEF_KEY_STATUS] = array();
        $oResponse[self::DEF_KEY_STATUS][self::DEF_KEY_STATUS_CODE] = $this->m_statusCode;
        $oResponse[self::DEF_KEY_STATUS][self::DEF_KEY_STATUS_MSG] = $this->m_statusMsg;
        $oResponse[self::DEF_KEY_DATA] = $this->m_responseData;
        //$oResponseText = \json_encode($oResponse, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $oResponseText = \json_encode($oResponse, JSON_UNESCAPED_UNICODE);
        echo $oResponseText;
    }
}
