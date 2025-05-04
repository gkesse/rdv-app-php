"use strict";

var callback = callback || {};

callback.cLogger = class  {
    static DEF_METHOD_ON_CLOSE_LOGGER = "on-close-logger";

    constructor() {}

    run(_module, _method, _obj, _data) {
        if (_method == callback.cLogger.DEF_METHOD_ON_CLOSE_LOGGER) {
            this.#onCloseLogger(_obj, _data);
        } else {
            console.log("[Error]:La méthode est inconnue.|module=%s|method=%s|data=%s", _module, _method, _data);
        }
    }

    #onCloseLogger(_obj, _data) {
        ui.cLogger.Instance().close();
    }
}
