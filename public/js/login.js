function sendRequest(requestURL) {
            var obj = $.ajax({
                url: requestURL,
                async: false
            });
            var response = $.parseJSON(obj.responseText);
            return response;
        }

        function login(username, password) {
            var response = sendRequest("user_methods.php?cmd=1&username=" + username + "&password=" + password);
            divContent.innerHTML = response.message;
        }

        function validate() {
            var valid = validatePassword();
            if (valid) {
                var response = login(loginUsername.value, loginPassword.value);
            }
        }

        function validatePassword() {
            var password = loginPassword.value;
            var username = loginUsername.value;
            var pErr = false;
            var uErr = false;
            if (password.length < 1) {
                loginPassword.style.backgroundColor = "red";
                pErr = true;
            }
            if (username.length < 1) {
                loginUsername.style.backgroundColor = "red";
                uErr = true;
            }
            if (pErr == false && uErr == false) {
                return true;
            }
            return false;
        }
