/* json2.js
 * 2008-01-17
 * Public Domain
 * No warranty expressed or implied. Use at your own risk.
 * See http://www.JSON.org/js.html
*/
if (!this.JSON) {
    JSON = function () {
        function f(n) {
            return n < 10 ? '0' + n : n;
        }
        Date.prototype.toJSON = function () {
            return this.getUTCFullYear() + '-' +
                f(this.getUTCMonth() + 1) + '-' +
                f(this.getUTCDate()) + 'T' +
                f(this.getUTCHours()) + ':' +
                f(this.getUTCMinutes()) + ':' +
                f(this.getUTCSeconds()) + 'Z';
        }; var m = { '\b': '\\b', '\t': '\\t', '\n': '\\n', '\f': '\\f', '\r': '\\r', '"': '\\"', '\\': '\\\\' }; function stringify(value, whitelist) {
            var a, i, k, l, r = /["\\\x00-\x1f\x7f-\x9f]/g, v; switch (typeof value) {
                case 'string': return r.test(value) ? '"' + value.replace(r, function (a) {
                    var c = m[a]; if (c) {
                        return c;
                    }
                    c = a.charCodeAt(); return '\\u00' + Math.floor(c / 16).toString(16) +
                        (c % 16).toString(16);
                }) + '"' : '"' + value + '"'; case 'number': return isFinite(value) ? String(value) : 'null'; case 'boolean': case 'null': return String(value); case 'object': if (!value) {
                    return 'null';
                }
                    if (typeof value.toJSON === 'function') {
                        return stringify(value.toJSON());
                    }
                    a = []; if (typeof value.length === 'number' && !(value.propertyIsEnumerable('length'))) {
                        l = value.length; for (i = 0; i < l; i += 1) {
                            a.push(stringify(value[i], whitelist) || 'null');
                        }
                        return '[' + a.join(',') + ']';
                    }
                    if (whitelist) {
                        l = whitelist.length; for (i = 0; i < l; i += 1) {
                            k = whitelist[i]; if (typeof k === 'string') {
                                v = stringify(value[k], whitelist); if (v) {
                                    a.push(stringify(k) + ':' + v);
                                }
                            }
                        }
                    } else {
                        for (k in value) {
                            if (typeof k === 'string') {
                                v = stringify(value[k], whitelist); if (v) {
                                    a.push(stringify(k) + ':' + v);
                                }
                            }
                        }
                    }
                    return '{' + a.join(',') + '}';
            }
        }
        return {
            stringify: stringify, parse: function (text, filter) {
                var j; function walk(k, v) {
                    var i, n; if (v && typeof v === 'object') {
                        for (i in v) {
                            if (Object.prototype.hasOwnProperty.apply(v, [i])) {
                                n = walk(i, v[i]); if (n !== undefined) {
                                    v[i] = n;
                                }
                            }
                        }
                    }
                    return filter(k, v);
                }
                if (/^[\],:{}\s]*$/.test(text.replace(/\\./g, '@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
                    j = eval('(' + text + ')'); return typeof filter === 'function' ? walk('', j) : j;
                }
                throw new SyntaxError('parseJSON');
            }
        };
    }();
}

// END JSON

//if (window.location.href.indexOf('sploder') == -1) {
//    window.location.href = 'https://sploder.xyz';
//}

function us_getPathToSelf() {
    var myName = /(^|[\/\\])dashboard6\.js(\?|$)/;
    var scripts = document.getElementsByTagName("script");
    for (var i = 0; i < scripts.length; i++) {
        var src = scripts[i].getAttribute("src");
        if (src != undefined) {
            if (src.match(myName)) {
                return src.split("dashboard6.js").join("");
            }
        }
    }
    return "/";
}

// END LIBRARY

function us_animate(obj, prop, startval, endval, duration) {
    if (window.us_tweens == undefined) {
        window.us_tweens = 0;
    }
    window.us_tweens++;
    var tween = window["tween_" + window.us_tweens] = {};
    tween.interval = setInterval(us_anim, 10, tween);
    tween.obj = obj;
    tween.prop = prop;
    tween.startval = startval;
    tween.endval = endval;
    tween.total = Math.floor(duration / 30);
    tween.count = 0;
}
function us_anim(tween) {
    tween.count++;
    var amt = tween.count / tween.total;
    if (amt >= 1) {
        amt = 1;
    }
    var val = tween.startval + (tween.endval - tween.startval) * amt;
    if (tween.prop == "scrollY") {
        tween.obj.scrollTo(0, val);
    } else if (tween.prop == "opacity") {
        if (tween.obj.filters) {
            tween.obj.filters.alpha.opacity = val;
        } else if (tween.obj.style) {
            tween.obj.style.MozOpacity = val;
        }
    } else {
        tween.obj[tween.prop] = val;
    }
    if (amt == 1 || val == tween.endval) {
        clearInterval(tween.interval);
    }
}

var $us_icons = [
    "[:)]", "[=D]", "[:&amp;]", "[:D]", "[:(]", "[80]", "[:9]", "[;)]", "[:P]", "[=O]"
    , "[:/]", "[:|]", "[d:-)]", "[:X]", "[O:-)]", "[:&#039;(]", "[:*]", "[^o)]", "[&gt;:)]", "[B)]"
    , "[&gt;:(]", "[:8)]", "[//_-]", "[-_-]", "[q.p]", "[^-^]", "[x_x]", "[8-)]", "[|-)]", "[:^)]"
    , "[Y]", "[N]", "[V]", "[NV]", "[pi]", "[|%|]", "[T]", "[G]", "[(x^x)]", "[@]"
];

function us_bbcode(body) {

    for (var i = 0; i < $us_icons.length; i++) {
        body = body.split($us_icons[i]).join(' <span class="us_icon us_icon_' + i + '">&nbsp;&nbsp;</span>');
    }

    return body;

}

function us_bbcode_buttons(narrow) {

    var h;

    if (narrow) {
        h = '<div class="emoticons" style="width: 100%">';
    } else {
        h = '<div class="emoticons">';
    }

    for (var i = 0; i < $us_icons.length; i++) {
        h += '<a href="#" onclick="us_bbcode_add(\'' + $us_icons[i].split("&#039;").join("\\'") + '\'); return false;"><span class="us_icon us_icon_' + i + '"  />&nbsp;</span></a> ';
    }

    h += '</div>';

    return h;

}

function us_bbcode_add(value) {

    document.forms["us_form_postmessage"][$us_namespace + "messagebody"].value += value;

}


// TRANSPORT LOGIC
// -----------------------

var $us_docroot = us_getPathToSelf();
var $us_namespace = "us_";
var $us_gateway = $us_docroot;

var $us_content_communicator = null;
var $us_venue_content = null;
var $us_content_status = null;
var $us_content_messages = null;
var $us_content_pagination1 = null;
var $us_content_pagination2 = null;
var $us_content_post = null;

var $us_venue_id = 0;
var $us_venue_vote = 0;
var $us_venue_report = 0;
var $us_venue_favorite = 0;
var $us_data = null;
var $us_messages = null;
var $us_total_messages = 0;
var $us_current_page = 1;
var $us_posts_per_page = 10;
var $us_total_pages = 1;
var $us_first_load = true;
var $us_post_visible = false;
var $us_is_warned = false;

// Create the XHR object.
function createCORSRequest(method, url) {
    var xhr = new XMLHttpRequest();
    if ("withCredentials" in xhr) {
        xhr.open(method, url, true);
    } else {
        xhr = null;
    }
    return xhr;
}

function us_doRequest_swf(url, postdata) {

    try {
        var method = (postdata) ? 'POST' : 'GET';
        var shr = createCORSRequest(method, url);

        if (shr === null) {
            shr = new SWFHttpRequest();
            shr.open(method, url);
        }

        shr.onreadystatechange = function () {
            if (this.readyState != 4) {
                return;
            }
            if (this.status == 200) {
                us_onResult(this.responseText);
            } else {
                us_onError(this.status, this.responseText);
            }
        };
        if (postdata) {
            postdata += "&a=" + us_config['auth'];
            postdata += "&t=" + us_config['timestamp'];
            postdata += "&ip=" + us_config['ip_address'];

            shr.send(postdata);
        } else {
            shr.send();
        }
    } catch (err) {
        setTimeout('us_doRequest_swf(\'' + url + '\',\'' + postdata + '\')', 2000);
        return;
    }

}

function us_venueGateway(action) {
    if (action == undefined) {
        action = "read";
    }
    var am = "";
    if (us_config['owner'] == us_config['username']) {
        am = "&am=1";
    }
    return $us_gateway + "?v=" + escape(us_config['venue']) + "&o=" + escape(us_config['owner']) + "&p=" + $us_current_page + "&a=" + action + am;
}

function us_div() {
    return document.getElementById(us_config['container']);
}

function us_venue_div() {
    return document.getElementById(us_config['venue_container']);
}

function us_setVenue() {

    var h = '<a name="us_venue_top"></a><div id="us_venue">';

    if ($us_venue_id > 0) {
        $us_venue_vote = us_getCookie("vv" + $us_venue_id);
        $us_venue_report = us_getCookie("vr" + $us_venue_id);
        $us_venue_favorite = us_getCookie("vf" + $us_venue_id);
    }

    h += '<div class="us_controls">';


    if (us_config['username'] != "" && us_config['username'] != us_config['owner']) {
        h += ' |';

        if ($us_venue_vote != 1) {
            h += ' <a class="us_button" href="#" onclick="us_vote(' + $us_venue_id + ', 1, \'venue\'); return false;">[+]</a>';
        } else {
            h += ' [+]';
        }
        if ($us_venue_vote != -1) {
            h += ' <a class="us_button" href="#" onclick="us_vote(' + $us_venue_id + ', -1, \'venue\'); return false;">[-]</a>';
        } else {
            h += ' [-]';
        }

        if ($us_venue_favorite == 1) {
            h += ' <a class="us_button us_symbol us_favorited" href="#" onclick="us_favorite(' + $us_venue_id + ', -1, \'venue\'); return false;">[&hearts;]</a>';
        } else {
            h += ' <a class="us_button us_symbol" href="#" onclick="us_favorite(' + $us_venue_id + ', 1, \'venue\'); return false;">[&hearts;]</a>';
        }
    }

    if (us_config['venue_anchor_link'] == true && us_config['show_messages'] != false) {
        var total_disp = ($us_total_messages > 0) ? ' <strong>[' + $us_total_messages + ']</strong>' : '';
        if (us_config['username'] != us_config['owner']) {
            h += '';
        }
        
    }

    h += '</div>';

    us_venue_div().innerHTML = h;

}

function us_renderMessages(messages) {

    var h = '';

    if (messages.length > 0) {
        for (var i = 0; i < messages.length; i++) {
            h += us_renderMessage(messages[i]);
        }
    } else {
        h += '<div class="us_message"><blockquote>';
        h += 'There are no posts on your pages yet. :(';
        h += '</blockquote></div>';
    }

    return h;

}

function determinePage(venue) {
    // If venue **starts with** "game"
    if (venue.indexOf("game") == 0) {
        url = "/?s=";
        const match = venue.match(/-(\d+_\d+)-/);
        if (match) {
            url += match[1];
        }
    } else if (venue.indexOf("messages") == 0) {
        url = "/members/index.php?u=" + venue.split("messages-")[1];
    } else if (venue.indexOf("staff-page") == 0) {
        url = "/staff.php";
    }
    window.location.href = url;
}

function us_renderMessage(m, inner) {

    var h = "";

    m.vote = us_getCookie("mv" + m.id);
    m.report = us_getCookie("mr" + m.id);
    m.favorite = us_getCookie("mf" + m.id);

    if (m.visible == 0) {
        m.mute = 1;
    }

    if (!inner) {
        var new_message = (us_config['last_login'] != "" && parseInt(us_config['last_login']) < parseInt(m.timestamp)) ? ' us_message_new' : '';
        var my_message = (us_config['username'] == m.creator_name) ? ' us_message_mine' : '';
        var is_reply = (m.id != m.thread_id) ? ' us_message_reply' : '';
        h += '<a name="us_message_' + m.id + '_top"></a><div class="us_message' + my_message + is_reply + new_message + '" id="us_message_' + m.id + '">';
    }

    if (m.mute != 1) {
        h += '<div class="us_controls">';
        if (us_config['username'] != m.creator_name) {
        }

       

        if (us_config['username'] == us_config['owner'] || us_config['username'] == m.creator_name) {
            h += '<a class="us_button" onclick="determinePage(\'' + m.venue + '\')" style="cursor: pointer">go to page &raquo;</a>';
        }

        h += '</div>';
    }

    h += '<cite>';
    if (us_config['use_avatar']) {
        h += '<span class="us_author">';
        // Check if on publishpage.php
        if (window.location.href.indexOf('publish.php') == -1) {
            h += '<a href="/members/index.php?u=' + m.creator_name + '">';
        }
        h += '<img src="/php/avatarproxy.php' + '?u=' + m.creator_name + '&size=24" width="24" height="24" border="0" />' + m.creator_name;
        if (window.location.href.indexOf('publish.php') == -1) {
            h += '</a >';
        }
        h += '</span > ';
    } else {
        h += '<span class="us_author">' + m.creator_name + '</span>';
    }
    h += '<span class="us_date">' + m.date + '</span>';

    if (us_config['username'] == us_config['owner'] && us_config['username'] != m.creator_name) {
    }

    h += '</cite>';

    if (m.mute != 1) {
        h += '<blockquote>' + us_bbcode(unescape(m.body)) + '</blockquote>';
    }
    if (!inner) {
        h += '</div>';
    }

    return h;

}

function us_updateMessage(id) {

    var m = $us_messages[id];
    var m_div = document.getElementById("us_message_" + id);

    if (m && m_div) {
        m_div.innerHTML = us_renderMessage(m, true);
    }

}

function us_removeDeletedMessage(id) {

    var m = $us_messages[id];
    var m_div = document.getElementById("us_message_" + id);

    if (m && m_div) {
        m_div.innerHTML = "";
    }

}

//
//
function us_renderMessagePostForm(parent_id, username) {



    return "";

}

function us_renderButton(txt, onclk, active) {
    if (active) {
        return '<a class="us_button" href="#" onclick="' + onclk + ' return false;">' + txt + '</a>';
    } else {
        return '<span class="us_button">' + txt + '</span>';
    }
}


function us_renderPagination() {

    var button = us_renderButton;

    var h = '<a name="us_pagination_top"></a>';

    if ($us_total_pages > 1) {
        h += '<div class="us_h">';
        h += button('&laquo;', 'us_gotoPage(0);', ($us_current_page > 0));

        var pa = Math.max(0, $us_current_page - 3);
        var pb = Math.min($us_current_page + 3, $us_total_pages - 1);
        for (var i = pa; i <= pb; i++) {
            h += button(i + 1, 'us_gotoPage(' + i + ');', !(i == $us_current_page));
        }

        h += button('&raquo;', 'us_gotoPage(' + ($us_total_pages - 1) + ');', ($us_current_page < $us_total_pages - 1));
        h += '</div>';
    }

    return h;

}

function us_setStatus(msg, show_icon) {
    var icon = (show_icon) ? '<img src="/chrome/loading_icon.gif" width="24" height="12" /> ' : '';
    if (msg && msg.length > 0) {
        $us_content_status.innerHTML = '<p class="us_prompt">' + icon + msg + '</p>';
    } else {
        $us_content_status.innerHTML = '';
    }
}

function us_setMessages(html) {
    $us_content_messages.innerHTML = html;
}

function us_setPagination() {
    $us_content_pagination1.innerHTML = us_renderPagination();
    $us_content_pagination2.innerHTML = us_renderPagination();
}

function us_setPost(parent_id, username) {



}

//
//
//
function us_showPost() {
    $us_post_visible = true;
    us_setPost();
}

//
//
function us_gotoPage(pagenum) {
    $us_current_page = pagenum;
    us_doRequest_swf(us_venueGateway());
}

//
//
function us_postMessage(btn) {

    $us_post_visible = false;
    $us_last_action = "post";

    var msg = btn.form[$us_namespace + "messagebody"].value.split("<").join("&lt;").split(">").join("&gt;");
    var tid = btn.form[$us_namespace + "thread_id"].value;

    var url = us_venueGateway("post");

    var question = "";
    var answer = "";

    if (msg.length > 8) {
        document.getElementById($us_namespace + "messagepost").innerHTML = "Posting message...";
        us_doRequest_swf(url, "m=" + escape(msg) + "&u=" + us_config['username'] + "&tid=" + tid + "&ques=" + escape(question) + "&ans=" + escape(answer));
    } else {
        alert("Your message must be longer than that!");
    }

    return false;

}

function us_reply(id, username) {

    $us_post_visible = true;
    us_setPost(id, username);
    window.location.hash = "us_postform_top";

}

function us_vote(id, vote, type) {
}

function us_favorite(id, vote, type) {
    if (type == undefined) {
        type = "message";
    }
    us_setCookie(type.charAt(0) + "f" + id, vote);
    if (type == "message") {
        $us_messages[id].favorite = vote;
    } else {
        $us_venue_favorite = vote;
    }
    var url = us_venueGateway((vote == 1) ? "favorite" : "unfavorite");
    us_doRequest_swf(url, "id=" + id + "&type=" + type + "&u=" + us_config['username']);
    if (type == "message") {
        us_updateMessage(id);
    } else {
        us_setVenue();
    }
}

function us_mute(user, unmute) {
    if (unmute || confirm("Do you really want to mute " + user + "?")) {
        var url = us_venueGateway((unmute == true) ? "unmute" : "mute");
        us_doRequest_swf(url, "id=" + user + "&type=username&u=" + us_config['username']);
        us_muteMessagesBy(user, unmute);
    }
}

function us_muteMessagesBy(user, unmute) {
    if (user) {
        for (var id in $us_messages) {
            var m = $us_messages[id];
            if (m.creator_name == user) {
                m.mute = (!unmute) ? 1 : 0;
                us_updateMessage(m.id);
            }
        }
    }
}

function us_delete(id) {
    if (confirm('Do you really want to delete this post?')) {
        var url = us_venueGateway("delete", id);
        us_doRequest_swf(url, "id=" + id + "&u=" + us_config['username']);
    }
}

function supports_html5_storage() {
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}

function us_getCookie(paramName) {
    if (supports_html5_storage()) {
        return localStorage.getItem(paramName);
    } else if (window.SWFHttpRequest) {
        return window.SWFHttpRequest.engine.getCookie(us_config['username'], paramName);
    }
    return null;
}

function us_setCookie(paramName, value) {
    if (supports_html5_storage()) {
        localStorage.setItem(paramName, value);
    } else if (window.SWFHttpRequest) {
        window.SWFHttpRequest.engine.setCookie(us_config['username'], paramName, value);
    }
}

function us_onResult(responseText) {

    us_setStatus('');

    try {
        var res = JSON.parse(responseText);

        if (res[0] != undefined && res[0]["action"] != undefined) {
            switch (res[0]["action"]) {
                case "delete":

                    if (res[0]["status"] == "1" && parseInt(res[0]["id"]) > 0) {
                        us_removeDeletedMessage(parseInt(res[0]["id"]));
                    } else {
                        us_setStatus("Unable to delete message.");
                        break;
                    }

                case "unmute":

                    us_setMessages(us_renderMessages($us_data));
                    break;

                case "read":

                    if ($us_venue_id == 0 &&
                        res[0]["id"] != undefined &&
                        parseInt(res[0]["id"]) > 0) {
                        $us_venue_id = parseInt(res[0]["id"]);
                        us_setVenue();
                    }

                case "post":

                    if (res[0]["total"] != undefined && parseInt(res[0]["total"]) > 0) {
                        $us_total_pages = Math.ceil(parseInt(res[0]["total"]) / $us_posts_per_page);
                        if ($us_current_page == -1) {
                            $us_current_page = $us_total_pages - 1;
                        }

                        if ($us_first_load) {
                            $us_total_messages = parseInt(res[0]["total"]);
                            us_setVenue();
                        }
                    } else {
                        $us_total_pages = 0;
                        $us_current_page = 0;
                    }

                    var messages = $us_data = res[0]["data"];
                    $us_messages = {};
                    for (var i = 0; i < messages.length; i++) {
                        $us_messages[messages[i].id] = messages[i];
                    }
                    us_setMessages(us_renderMessages(messages));

                    if (res[0]["action"] == "post" && res[0]["page"] != undefined) {
                        $us_current_page = parseInt(res[0]["page"]);
                    }

                    $us_current_page = Math.min($us_current_page, $us_total_pages - 1);

                    us_setPagination();
                    us_setPost();

                    if (!$us_first_load) {
                        var wa;
                        var wb;

                        if (res[0]["action"] == "post" && res[0]["id"] &&
                            document.getElementById("us_message_" + res[0]["id"])) {
                            wa = window.scrollY;
                            wb = document.getElementById("us_message_" + res[0]["id"]).offsetTop - 60;

                            if (!isNaN(wa) && !isNaN(wb)) {
                                us_animate(window, "scrollY", wa, wb, 500);
                                var mm = document.getElementById("us_message_" + res[0]["id"]);
                                us_animate(mm, "opacity", 0, 1, 2000);
                            } else {
                                window.location.hash = "us_message_" + res[0]["id"] + "_top";
                            }
                        } else {
                            wa = window.scrollY;
                            wb = document.getElementById("us_content_messages").offsetTop - 60;

                            if (!isNaN(wa) && !isNaN(wb)) {
                                us_animate(window, "scrollY", wa, wb, 500);
                            } else {
                                window.location.hash = "us_messages_top";
                            }
                        }
                    }

                    $us_first_load = false;

                    break;
            }
        }
    } catch (err) {
        us_setStatus(err);
        us_setPost();
    }

}

function us_onError(statusCode, responseText) {

    us_setStatus("Oops! There was an error " + statusCode + "! Message from server: " + responseText);

}

function us_main() {

    us_div().innerHTML = '<div id="us_content"><a name="us_messages_top"></a><div id="us_content_pagination1"></div><div id="us_content_messages"></div><div id="us_content_pagination2"></div><div id="us_content_status"></div><div id="us_content_post"></div></div>';

    $us_content_status = document.getElementById("us_content_status");
    $us_content_messages = document.getElementById("us_content_messages");
    $us_content_pagination1 = document.getElementById("us_content_pagination1");
    $us_content_pagination2 = document.getElementById("us_content_pagination2");
    $us_content_post = document.getElementById("us_content_post");

    if (us_config['show_messages'] != false) {
        us_setStatus("Loading messages...", true);
    }

    if (us_config['venue'] == undefined) {
        us_config['venue'] = location.href.split("?")[0].split("#")[0];
    }

    if (us_config['venue_type'] == undefined) {
        us_config['venue_type'] = 'page';
    }

    if (us_config['show_messages'] != false) {
        us_doRequest_swf(us_venueGateway());
    }

    us_setVenue();
    $us_is_warned = (us_getCookie('warn') == 'y');



    return false;

}

us_main();