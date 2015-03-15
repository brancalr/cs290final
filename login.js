
function printLogin(results) {
    if (results.response == 1) {
        document.getElementById('statusUpdate').innerHTML = "Login Successful";
        window.location.assign("http://web.engr.oregonstate.edu/~brancalr/ptForm.php");
    } 
    else if (results.response == 0) {
        document.getElementById('statusUpdate').innerHTML = "Failed to login";
    } 
    else {
        document.getElementById('statusUpdate').innerHTML = results.response;
    }
    return false;
}

function printNewUser(results) {
    if (results.response == 1) {
        document.getElementById('statusUpdate').innerHTML = "New user created";
    } 
    else if (results.response == 0) {
        document.getElementById('statusUpdate').innerHTML = "User already exists";
    } 
    else {
        document.getElementById('statusUpdate').innerHTML = results.response;
    }
}

function login(type) {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var parameters = {
        username: username,
        password: password
    };
    if (type == "login") {
        var url = 'login.php';
        document.getElementById('statusUpdate').innerHTML = "Logging in....";
        ajaxRequest(url,'POST',parameters, printLogin);
    }
    if (type == "new") {
        var url = 'newuser.php';
        document.getElementById('statusUpdate').innerHTML = "Creating user....";
        ajaxRequest(url,'POST', parameters, printNewUser);
    }
    return false;
}

