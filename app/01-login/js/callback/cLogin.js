"use strict";

var callback = callback || {};

callback.cLogin = class  {
    static DEF_METHOD_ON_LOGIN_PAGE = "on-login-page";
    static DEF_METHOD_ON_CONNECT_USER = "on-connect-user";
    static DEF_METHOD_ON_CREATE_ACCOUNT_USER = "on-create-account-user";
    static DEF_METHOD_ON_FORGOT_PASSWORD_USER = "on-forgot-password-user";

    constructor() {}

    run(_module, _method, _obj, _data) {
        if (_method == callback.cLogin.DEF_METHOD_ON_LOGIN_PAGE) {
            this.#onLoginPage(_module, _method, _obj, _data);
        } else if (_method == callback.cLogin.DEF_METHOD_ON_CONNECT_USER) {
            this.#onConnectUser(_module, _method, _obj, _data);
        } else if (_method == callback.cLogin.DEF_METHOD_ON_CREATE_ACCOUNT_USER) {
            this.#onCreateAccountUser(_module, _method, _obj, _data);
        } else if (_method == callback.cLogin.DEF_METHOD_ON_FORGOT_PASSWORD_USER) {
            this.#onForgotPasswordUser(_module, _method, _obj, _data);
        } else {
            console.log("[Error]:La méthode est inconnue.|module=%s|method=%s|data=%s", _module, _method, _data);
        }
    }

    #onLoginPage(_module, _method, _obj, _data) {
        ui.cLogin.Instance().openTab(_data);
    }

    #onConnectUser(_module, _method, _obj, _data) {
        const oUsername = document.querySelector("#login-username").value;
        const oPassword = document.querySelector("#login-password").value;
        const oParams = {
            module: _module,
            method: _method,
            username: oUsername,
            password: oPassword
        };

        const oAjax = new client.json.cAjax();
        oAjax.callServer(JSON.stringify(oParams), this.#onConnectUserCallback);
    }

    #onConnectUserCallback(_response) {
        const oResponse = new callback.cResponse(_response);
        if (oResponse.hasErrors())
        {
            ui.cLogger.Instance().showError(oResponse.statusMsg());
        }
        else {
            ui.cLogger.Instance().showInfo(oResponse.statusMsg());
        }
    }

    #onCreateAccountUser(_module, _method, _obj, _data) {
        const oUsername = document.querySelector("#idAccountUsername").value;
        const oPassword = document.querySelector("#idAccountPassword").value;
        const oConfirmPassword = document.querySelector("#idAccountConfirmPassword").value;
        const oParams = {
            module: _module,
            method: _method,
            username: oUsername,
            password: oPassword,
            confirmPassword: oConfirmPassword
        };

        const oAjax = new client.json.cAjax();
        oAjax.callServer(JSON.stringify(oParams), this.#onCreateAccountUserCallback);
    }

    #onCreateAccountUserCallback(_response) {
        const oResponse = new callback.cResponse(_response);
        if (oResponse.hasErrors())
        {
            ui.cLogger.Instance().showError(oResponse.statusMsg());
        }
        else {
            ui.cLogger.Instance().showInfo(oResponse.statusMsg());
        }
    }

    #onForgotPasswordUser(_module, _method, _obj, _data) {
        const oUsername = document.querySelector("#idForgotPasswordUser").value;
        const oParams = {
            module: _module,
            method: _method,
            username: oUsername,
        };

        const oAjax = new client.json.cAjax();
        oAjax.callServer(JSON.stringify(oParams), this.#onForgotPasswordUserCallback);
    }

    #onForgotPasswordUserCallback(_response) {
        const oResponse = new callback.cResponse(_response);
        if (oResponse.hasErrors())
        {
            ui.cLogger.Instance().showError(oResponse.statusMsg());
        }
        else {
            ui.cLogger.Instance().showInfo(oResponse.statusMsg());
        }
    }
}
