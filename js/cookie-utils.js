
// Get cookie value by name
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) {
        return parts.pop().split(';').shift();
    }
}

function isCookieEqual(name, value) {
    return getCookie(name) === value;
}

function isCookieTrue(name) {
    return getCookie(name) === 'true';
}

function inverseCookie(name) {
    setCookie(name, !isCookieTrue(name));
}

function isCookieUndefined(name) {
    return typeof(getCookie(name)) === 'undefined';
}

function isCookieDefined(name) {
    return typeof(getCookie(name)) !== 'undefined';
}

function eraseCookie(name) {
    document.cookie = name + '=; Max-Age=0'
}

// Set cookie value
function setCookie(name, value) {
    document.cookie = name + '=' + value + '; path=/';
}
