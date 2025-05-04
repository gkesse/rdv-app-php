"use strict";

var callback = callback || {};

callback.cCallback = class  {
    static DEF_MODULE_LOGIN = "login";
    static DEF_MODULE_LOGGER = "logger";

    constructor() {}

    run(_module, _method, _obj, _data) {
        if (_module == callback.cCallback.DEF_MODULE_LOGIN) {
            this.#onLogin(_module, _method, _obj, _data);
        } else if (_module == callback.cCallback.DEF_MODULE_LOGGER) {
            this.#onLogger(_module, _method, _obj, _data);
        } else {
            console.log("[Error]:Le module est inconnu.|module=%s|method=%s",_module, _method);
        }
    }

    #onLogin(_module, _method, _obj, _data) {
        const oLogin = new callback.cLogin();
        oLogin.run(_module, _method, _obj, _data);
    }

    #onLogger(_module, _method, _obj, _data) {
        const oLogger = new callback.cLogger();
        oLogger.run(_module, _method, _obj, _data);
    }
}
