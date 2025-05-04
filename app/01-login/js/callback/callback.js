"use strict";

function onCallback(_module, _method, _obj = null, _data = "") {
  const oCallback = new callback.cCallback();
  oCallback.run(_module, _method, _obj, _data);
}
