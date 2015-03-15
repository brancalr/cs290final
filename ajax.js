function ajaxRequest(url, type, param, callback) {
    var returnObj = {
        success: false
    };
    var req = new XMLHttpRequest();
    if (!req) {
        throw 'Unable to create HttpRequest.';
    }
    req.onreadystatechange = function() {
        if (this.readyState == 4) {
            returnObj.code = this.status;
            returnObj.codeDetail = this.statusText;
            returnObj.response = this.responseText;
            if (callback != 0) {
                callback(returnObj);
            }
        }
        if (this.status == 200) {
            returnObj.success = true;
        } 
        else {
            returnObj.success = false;
        }
    };
    if (type == 'POST') {
        req.open('POST', url, true);
        req.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        req.send(urlStringify(param));
    }
    if (type == 'GET') {
        url += '?' + urlStringify(param);
        req.open('GET', url, false);
        req.send();
    }
}

function urlStringify(obj) {
    var str = [];
    for (var prop in obj) {
        var s = encodeURIComponent(prop) + '=' + encodeURIComponent(obj[
            prop]);
        str.push(s);
    }
    return str.join('&');
}