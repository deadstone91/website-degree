function validateLogin() {

    if(validateUsername() === false || !validatePassword() === false){
        alert("Somethin's no right, check yer sign-in");
        return false;
    }
}

function validateUsername() {
    var form = document.forms["login"]["username"].value;
    if (form === "") {
        return false;
    }
}

function validatePassword() {
    var form = document.forms["login"]["password"].value;
    if(form === ""){

        return false;
    }
}

