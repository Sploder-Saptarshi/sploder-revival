if (typeof FM == "undefined") var FM = new Object;
if (typeof FM.Logger == "undefined") { FM.Logger = function (img, baseUrl) { this.img = img; this.baseUrl = baseUrl }; FM.Logger.prototype.reportError = function (errMsg, except, includeRandom) { if (typeof includeRandom == "undefined") includeRandom = true; var msg = "[Ads JS] "; try { msg += errMsg; try { msg += " - " + except.message } catch (e) { } var src = this.baseUrl; var rnd = Math.floor(Math.random() * 99999); if (!includeRandom) rnd = ""; src += "/errors/ads?msg=" + encodeURIComponent(msg) + "&r=" + rnd; this.img.src = src } catch (e) { } } }; var rnd = Math.floor(Math.random() * 999999999 + 1); if (typeof fmDataLayer == "undefined") var fmDataLayer = [{ fmRandom: rnd }]; if (typeof fmDataLayer[0]["fmRandom"] == "undefined") fmDataLayer[0].fmRandom = rnd; if (typeof FM == "undefined") var FM = {};
if (typeof FM.CTBootstrap == "undefined") {
    FM.CTBootstrap = function (containerDataUrl, host, type) {
        this.host = host; if (typeof FM[type] == "undefined") FMVars[type] = false; if (type == "once" && FMVars[type] == false || type == "multi") {
            var resource = document.createElement("script"); resource.type = "text/javascript"; resource.async = true; resource.src = containerDataUrl; var script = document.getElementsByTagName("script")[0]; script.parentNode.insertBefore(resource, script); resource.host = host; if (resource.addEventListener) resource.addEventListener("load",
                FM.CTFire); else if (resource.readyState) { resource.onloadDone = false; resource.onload = function () { resource.onloadDone = true; FM.CTFire() }; resource.onreadystatechange = function () { if (("loaded" === resource.readyState || "complete" === resource.readyState) && !resource.onloadDone) { resource.onloadDone = true; FM.CTFire() } } }
        } FMVars[type] = true
    }; FM.CTFire = function () {
        if (typeof this.host == "undefined") this.host = FMVars.host; var logger = new FM.Logger(this.host); fmDataLayer[0]["fmGeo"] = containerData.geo; fmDataLayer[0]["ljt_reader"] =
            containerData.ljt_reader; var container = new FM.ContainerTag(containerData.tags, logger); container.fire()
    }
}
if (typeof FM.ContainerTag == "undefined") {
    FM.ContainerTag = function (tags, logger) { this.tags = tags; this.logger = logger }; var proto = FM.ContainerTag.prototype; proto.getImage = function (tag) { var img = new Image; try { var src = this.createPath(tag); img.tag = tag; img.onload = function () { }; img.onerror = function (e) { if (typeof this.logger != "undefined") this.logger.reportError(e.target.tag.error, { message: "Error: loading image" }) }; img.src = src } catch (e) { if (typeof this.logger != "undefined") this.logger.reportError(tag.error, e) } }; proto.getScript =
        function (tag) { try { var resource = document.createElement("script"); resource.type = "text/javascript"; resource.text = tag.src; document.body.appendChild(resource) } catch (e) { if (typeof this.logger != "undefined") this.logger.reportError(tag.error, e) } }; proto.fire = function () {
            for (var i = 0; i < this.tags.length; i++)if (this.checkRules(this.tags[i]["rules"]) && this.checkFreq(this.tags[i])) {
                switch (this.tags[i]["type"]) { case "img": this.getImage(this.tags[i]); break; case "script": this.getScript(this.tags[i]); break }this.tags[i]["fired"] =
                    true
            }
        }; proto.checkRules = function (rules) { if (rules == null) return true; for (var i = 0; i < rules.length; i++) { var retval = false; var value_1 = this.getData(rules[i]["var"]); var value_2 = rules[i]["value"]; var operand = rules[i]["operand"]; switch (operand) { case "eq": retval = value_1 == value_2; break; case "gt": retval = value_1 > value_2; break; case "lt": retval = value_1 < value_2; break; default: return false }if (retval == false) return retval } return true }; proto.checkFreq = function (tag) {
            switch (tag.frequency) {
                case "sample": if (Math.random() *
                    100 < tag.percent) return true; return false; case "timed": var cookieName = "fm_tag_" + tag.id + "_called"; var cookieValue = this.getData(cookieName); var date = new Date; if (cookieValue != "" && parseInt(cookieValue) > date.getTime()) return false; date.setSeconds(date.getSeconds() + parseInt(tag.time)); document.cookie = cookieName + "=" + date.getTime() + "; expires=" + date.toUTCString() + "; path=/"; return true; case "users": var modulo = Math.floor(1 / (tag.percent / 100)); var cookieValue = this.getData("ljt_reader"); if (cookieValue.length ==
                        32) { var firstInt = parseInt(cookieValue.substr(0, 8), 16); var secondInt = parseInt(cookieValue.substr(8, 8), 16); var thirdInt = parseInt(cookieValue.substr(16, 8), 16); var fourthInt = parseInt(cookieValue.substr(24, 8), 16); if ((firstInt + secondInt + thirdInt + fourthInt) % modulo == 0) return true } return false; default: return true
            }return true
        }; proto.createPath = function (tag) {
            var q = ""; var symb = "?"; if (tag.src.indexOf("?") > 0) symb = "&"; for (var i = 0; i < tag.params.length; i++) {
                q = q + symb + tag.params[i]["key"] + "=" + this.getData(tag.params[i]["var"]);
                symb = "&"
            } return tag.src + q
        }; proto.getData = function (key) { if (typeof fmDataLayer == "object" && typeof fmDataLayer[0] == "object" && typeof fmDataLayer[0][key] != "undefined") return fmDataLayer[0][key]; var cookieRegEx = new RegExp("(?:(?:^|.*;\\s*)" + key + "\\s*\\=\\s*([^;]*).*$)|^.*$"); var cookieVal = document.cookie.replace(cookieRegEx, "$1"); if (cookieVal) return cookieVal; return "" }
}
if (typeof FM.ContainerTagUI === "undefined") FM.ContainerTagUI = {
    CONTENT_TYPE_IMG: 1, CONTENT_TYPE_SCRIPT: 2, init: function () { this.handleChangeContentType() }, handleChangeContentType: function () { var self = this; var el = document.getElementById("tag_type_id"); el.addEventListener("change", function (jEvent) { self._changeSourceElement(el.value); self._changeURIParams(el.value) }) }, _changeSourceElement: function (content_type) {
        var self = this; var source_el = document.getElementById("option_src"); var target_el = null; if (content_type ==
            self.CONTENT_TYPE_SCRIPT) { target_el = document.createElement("textarea"); target_el.innerHTML = source_el.value } else { target_el = document.createElement("input"); target_el.type = "text"; target_el.value = source_el.innerHTML } target_el.required = "required"; target_el.name = "option_src"; target_el.id = "option_src"; source_el.parentNode.replaceChild(target_el, source_el); return true
    }, _changeURIParams: function (content_type) {
        var self = this; var el = document.getElementById("uri_params_section"); if (content_type == self.CONTENT_TYPE_SCRIPT) el.style.display =
            "none"; else el.style.display = "block"
    }
}; if (typeof FMVars != "undefined" && typeof FMVars.host != "undefined" && typeof FMVars.containerUrl != "undefined" && FMVars.containerType != "undefined") FM.CTBootstrap(FMVars.containerUrl, FMVars.host, FMVars.containerType);