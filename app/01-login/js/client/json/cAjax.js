"use strict";

var client = client || {};
client.json = client.json || {};

client.json.cAjax = class {
    constructor() {}

    callServer(_data, _callback = null) {
        const oXHR = new XMLHttpRequest();
        oXHR.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                ui.cLoader.Instance().close();
                if (_callback) _callback(this.responseText);
                console.log("[Info]:Request=%s", _data);
                console.log("[Info]:Response=%s", this.responseText);
            }
        };

        const oMethod = "POST";
        const oUrl = "/php/callback/json/callback.php";
        const isAsync = true;
        const oUser = null;
        const oPassword = null;
        const oContentType = "application/json; charset=UTF-8";

        oXHR.open(oMethod, oUrl, isAsync, oUser, oPassword);
        oXHR.setRequestHeader("Content-Type", oContentType);
        oXHR.send(_data);
        ui.cLoader.Instance().show();
    }
};
