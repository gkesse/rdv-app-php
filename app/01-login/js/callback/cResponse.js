"use strict";

var callback = callback || {};

callback.cResponse = class {
    static DEF_KEY_STATUS = "status";
    static DEF_KEY_STATUS_CODE = "code";
    static DEF_KEY_STATUS_MSG = "msg";
    static DEF_STATUS_CODE_ERROR = "error";
    static DEF_STATUS_MSG_ERROR = "Un problème a été rencontré.";
    static DEF_KEY_DATA = "data";

    #m_statusCode;
    #m_statusMsg;
    #m_respData;

    constructor(_response) {
        this.#initResponse();
        this.#loadResponse(_response);
    }

    #initResponse() {
        this.#m_statusCode = callback.cResponse.DEF_STATUS_CODE_ERROR;
        this.#m_statusMsg = callback.cResponse.DEF_STATUS_MSG_ERROR;
        this.#m_respData = {};
    }

    #loadResponse(_response) {
        try {
            const oResponse = JSON.parse(_response);
            const oStatus = oResponse[callback.cResponse.DEF_KEY_STATUS];
            this.#m_statusCode = oStatus[callback.cResponse.DEF_KEY_STATUS_CODE];
            this.#m_statusMsg = oStatus[callback.cResponse.DEF_KEY_STATUS_MSG];
            this.#m_respData = oResponse[callback.cResponse.DEF_KEY_DATA];
        } catch (error) {
            console.error("L'analyse de la réponse a échoué.|error=%s", error);
        }
    }

    hasErrors() { return (this.#m_statusCode == callback.cResponse.DEF_STATUS_CODE_ERROR); }
    statusCode() { return this.#m_statusCode; }
    statusMsg() { return this.#m_statusMsg; }
    respData() { return this.#m_respData; }
}
