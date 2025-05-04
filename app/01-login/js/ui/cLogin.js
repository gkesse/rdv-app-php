"use strict";

var ui = ui || {};

ui.cLogin = class {
    static DEF_DEFAULT_PAGE = "login-page";

    static m_instance = null;

    constructor() {}

    static Instance() {
        if (this.m_instance == null) {
            this.m_instance = new ui.cLogin();
        }
        return this.m_instance;
    }

    openTab(_name = ui.cLogin.DEF_DEFAULT_PAGE) {
        const idBodyTabs = document.querySelectorAll(".idBodyTab");
        for (const idBodyTab of idBodyTabs) {
            if (idBodyTab.dataset.name == _name) {
                idBodyTab.style.display = "block";
                continue;
            }
            idBodyTab.style.display = "none";
        }
    }
};

ui.cLogin.Instance().openTab();
