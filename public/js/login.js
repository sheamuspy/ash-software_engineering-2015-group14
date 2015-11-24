/*global $, divContent, validatePassword, loginUsername, loginPassword, */

/**
 * Make a request to the server.
 * @param {String} requestURL
 * @return {String}
 */
function sendRequest(requestURL) {
    'use strict';
    var obj, response;
    obj = $.ajax({
        url: requestURL,
        async: false
    });
    response = $.parseJSON(obj.responseText);
    return response;
}

/**
 * Login to the system.
 * @param {String} username
 * @param {String} password
 * @return {String}
 */
function login(username, password) {
    'use strict';
    var response = sendRequest("user_methods.php?cmd=1&username=" + username + "&password=" + password);
    divContent.innerHTML = response.message;
}

/**
 * Check if credentials are correct and login
 */
function validate() {
    'use strict';
    var valid, response;
    valid = validatePassword();
    if (valid) {
        response = login(loginUsername.value, loginPassword.value);
    }
}

/**
 * Check if password username combination is correct
 * @return {Boolean}
 */
function validatePassword() {
    'use strict';
    var password, username, pErr, uErr;
    password = loginPassword.value;
    username = loginUsername.value;
    pErr = false;
    uErr = false;
    if (password.length < 1) {
        loginPassword.style.backgroundColor = "red";
        pErr = true;
    }
    if (username.length < 1) {
        loginUsername.style.backgroundColor = "red";
        uErr = true;
    }
    if (pErr === false && uErr === false) {
        return true;
    }
    return false;
}
