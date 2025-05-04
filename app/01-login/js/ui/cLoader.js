"use strict";

var ui = ui || {};

ui.cLoader = class {
    static m_instance = null;

    constructor() {}

    static Instance() {
        if (this.m_instance == null) {
            this.m_instance = new ui.cLoader();
        }
        return this.m_instance;
    }

    close() {
        const idLoader = document.querySelector("#idLoader");
        const idLoaderForm = document.querySelector("#idLoaderForm");

        idLoaderForm.classList.remove("idAnimateShow");
        idLoaderForm.classList.add("idAnimateHide");

        setTimeout(function() {
            idLoader.style.display = "none";
        }, 400);
    }

    show() {
        const idLoader = document.querySelector("#idLoader");
        const idLoaderForm = document.querySelector("#idLoaderForm");
        idLoaderForm.classList.remove("idAnimateHide");
        idLoaderForm.classList.add("idAnimateShow");
        idLoader.style.display = "block";
    }
};
