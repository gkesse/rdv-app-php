"use strict";

var ui = ui || {};

ui.cLogger = class {
    static DEF_TITLE_MSG_ERROR = "Messages d'erreurs";
    static DEF_TITLE_MSG_INFO = "Messages d'informations";

    static m_instance = null;

    constructor() {}

    static Instance() {
        if (this.m_instance == null) {
            this.m_instance = new ui.cLogger();
        }
        return this.m_instance;
    }

    close() {
        const idLogger = document.querySelector("#idLogger");
        const idLoggerForm = document.querySelector("#idLoggerForm");

        idLoggerForm.classList.remove("idAnimateShow");
        idLoggerForm.classList.add("idAnimateHide");

        setTimeout(function() {
            idLogger.style.display = "none";
        }, 400);
    }

    showInfo(_msg) {
        const idLogger = document.querySelector("#idLogger");
        const idLoggerTitle = document.querySelector("#idLoggerTitle");
        const idLoggerMsg = document.querySelector("#idLoggerMsg");
        idLoggerTitle.innerHTML = ui.cLogger.DEF_TITLE_MSG_INFO;
        idLoggerMsg.innerHTML = _msg;

        const idLoggerForm = document.querySelector("#idLoggerForm");
        idLoggerForm.classList.remove("idAnimateHide");
        idLoggerForm.classList.add("idAnimateShow");
        idLogger.style.display = "block";
    }

    showError(_msg) {
        const idLogger = document.querySelector("#idLogger");
        const idLoggerTitle = document.querySelector("#idLoggerTitle");
        const idLoggerMsg = document.querySelector("#idLoggerMsg");
        idLoggerTitle.innerHTML = ui.cLogger.DEF_TITLE_MSG_ERROR;
        idLoggerMsg.innerHTML = _msg;

        const idLoggerForm = document.querySelector("#idLoggerForm");
        idLoggerForm.classList.remove("idAnimateHide");
        idLoggerForm.classList.add("idAnimateShow");
        idLogger.style.display = "block";
    }
};
