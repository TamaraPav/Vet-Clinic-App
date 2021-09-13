jQuery(document).ready(function($) {
    $("#login").click(checkLog);
    $("#register").click(checkReg);
    $("#submitMessage").click(checkContact);

});
function checkReg(){

    var firstName = document.querySelector("#tbFirstName");
    var lastName = document.querySelector("#tbLastName");
    var address = document.querySelector("#tbAddress");
    var phone = document.querySelector("#tbPhone");
    var email = document.querySelector("#tbEmailReg");
    var pass = document.querySelector("#tbPassReg");
    var againPass = document.querySelector("#tbPassAgain");
    var displayErrors = document.querySelector("#err");

    var reName = /^[A-Z][a-z]{2,20}$/;
    var reAddress = /^[a-zA-Z0-9\s,.]{3,}$/;
    var reEmail = /^([a-z0-9]+\.*)+@(gmail|hotmail|yahoo|ict\.edu)\.(com|rs)$/;
    var rePhone = /^[0-9]+$/;

    var errors = [];

    if(!reName.test(firstName.value)){
        $("#tbFirstName").addClass("error");
        errors.push("First name is not valid, try again. Example: Jeffrey");
    }
    else{
        $("#tbFirstName").removeClass("error");
    }

    if(!reName.test(lastName.value)){
        $("#tbLastName").addClass("error");
        errors.push("Last name is not valid, try again. Example: Smith");
    }
    else{
        $("#tbLastName").removeClass("error");
    }

    if(!rePhone.test(phone.value)){
        $("#tbPhone").addClass("error");
        errors.push("Phone is not valid, try again. Example: 0601234567");
    }
    else{
        $("#tbPhone").removeClass("error");
    }

    if(!reAddress.test(address.value)){
        $("#tbAddress").addClass("error");
        errors.push("Address is not valid, try again. Example: That street 2");
    }
    else{
        $("#tbAddress").removeClass("error");
    }


    if(!reEmail.test(email.value)){
        $("#tbEmailReg").addClass("error");
        errors.push("Email is not valid, try again. Example: anna@gmail.com");
    }
    else{
        $("#tbEmailReg").removeClass("error");
    }

    if(!rePass.test(pass.value)){
        $("#tbPassReg").addClass("error");
        errors.push("Password has to be at least 6 characters long!");

    }
    else{
        $("#tbPassReg").removeClass("error");
    }

    if(pass.value != againPass.value){
        $("#tbPassAgain").addClass("error");
        errors.push("Passwords do not match!");
    }
    else{
        $("#tbPassAgain").removeClass("error");
    }
    if (errors.length !=0) {
        var x = "";
        for (i=0; i<errors.length; i++) {
            x +=  errors[i] + "<br>";
        }
        displayErrors.innerHTML = x;
        return false
    }
    else {
        return true
    }

}
function checkLog(){

    var email = document.querySelector("#tbEmail");
    var pass = document.querySelector("#tbPass");
    var displayErrors = document.querySelector("#err");

    var reEmail = /^([a-z0-9]+\.*)+@(gmail|hotmail|yahoo|ict\.edu)\.(com|rs)$/;
    var rePass = /^[a-z0-9]{6,20}$/;

    var errors = [];

    if(!reEmail.test(email.value)){
        $("#tbEmail").addClass("error");
        errors.push("Email is not correct!");
    }
    else{
        $("#tbEmail").removeClass("error");
    }
    if(!rePass.test(pass.value)){
        $("#tbPass").addClass("error");
        errors.push("Password is not correct!");
    }
    else{
        $("#tbPass").removeClass("error");
    }

    if (errors.length !=0) {
        var x = "";
        for (i=0; i<errors.length; i++) {
            x +=  errors[i] + "<br>";
        }
        displayErrors.innerHTML = x;
        return false
    }
    else {
        return true
    }

}

function checkContact(){
    var poljeName = document.querySelector("#cf-name");
    var poljeEmail = document.querySelector("#cf-email");
    var poljeMessage = document.querySelector("#cf-message");
    var poljeSubj = document.querySelector("#cf-subject");
    var displayErrors = document.querySelector("#err");


    var reName, reEmail, reText;

    reName = /^[A-Z][a-z]{1,12}(\s[A-Z][a-z]{1,19})*$/;
    reEmail = /^\w+([.-]?[\w\d]+)*@\w+([.-]?[\w]+)*(\.\w{2,4})+$/;
    reText = /^[a-z]/;
    var errors = [];


    if(poljeName.value == ""){
        poljeName.classList.add("error");
        errors.push("Name field cannot be empty!");
    }
    else{
        if(!reName.test(poljeName.value)){
            poljeName.classList.add("error");
            errors.push("Name is not valid, try again. Example: Jeffrey");
        }else{
            poljeName.classList.remove("error");
        }
    }


    if(poljeEmail.value == ""){
        poljeEmail.classList.add("error");
        errors.push("Email field cannot be empty!");

    }
    else{
        if(!reEmail.test(poljeEmail.value)){
            poljeEmail.classList.add("error");
            errors.push("Email is not valid, try again. Example: anna@gmail.com");
        }else{
            poljeEmail.classList.remove("error");
        }
    }

    if(poljeSubj.value == ""){
        poljeSubj.classList.add("error");
        errors.push("Email field cannot be empty!");

    }
    else{
        if(!reText.test(poljeSubj.value)){
            poljeSubj.classList.add("error");
            errors.push("Email is not valid, try again. Example: anna@gmail.com");
        }else{
            poljeSubj.classList.remove("error");
        }
    }


    if(poljeMessage.value == ""){
        poljeMessage.classList.add("error");
        errors.push("Message field cannot be empty!");
    }
    else{
        if(!reText.test(poljeMessage.value)){
            poljeMessage.classList.add("error");
            errors.push("Email is not valid, try again. Example: anna@gmail.com");
        }else{
            poljeMessage.classList.remove("error");
        }
    }

    console.log(errors);

    if (errors.length !=0) {
        var x = "";
        for (i=0; i<errors.length; i++) {
            x +=  errors[i] + "<br>";
        }
        displayErrors.innerHTML = x;
    }
    else {
        displayErrors.innerHTML = "";
    }
}
