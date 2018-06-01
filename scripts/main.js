/**
 * Created by admin on 3/9/17.
 */
$(document).ready(function() {
    $("#MyModal").modal();
});


var error = false;

function buttonCheck(){
if (!error){
    $("signupSubmit").prop("disabled",false);
    $("form").unbind("submit");

}else if(error) {
    $("signupSubmit").prop("disabled", true);
    $("form").bind("submit", function (e) {
        e.preventDefault();
    });
    }
}

    function validateFName() {
        var text = document.getElementById("fName").value;
        var length = text.length;
        if (length < 40 && length > 0) {
            document.getElementById("fNameError").innerHTML = ("");
            $("#fName").removeClass("errorBox");
            error = true;
            buttonCheck();
                }

        else {
            document.getElementById("fNameError").innerHTML = ("Your first name must be between 1 and 40 characters.");
            $("#fName").addClass("errorBox");
        }
    }

$("lName").on("onkeyup",validateLName());
function validateLName() {
    var text = document.getElementById("lName").value;
    var length = text.length;
    if (length < 40 && length > 0) {
        document.getElementById("lNameError").innerHTML = ("");
        $("#fName").removeClass("errorBox");
        lNameBool=0;

    }
    else {
        document.getElementById("lNameError").innerHTML = ("Your last name must be between 1 and 40 characters.");
        $("#fName").addClass("errorBox");
        lNameBool=1;

    }
}

function validateEmail(){
    var text = document.getElementById("signupEmail").value;
    var re = /^[^ ,@]+\@([a-z0-9-]+\.)+[a-z]+$/i;
    var result = re.exec(text);
    if( result === null) {
        document.getElementById("signupEmailError").innerHTML = ("Enter a valid email address.");
        $("#signupEmail").addClass("errorBox");
        signupEmailBool=0;
    }
    else{
        document.getElementById("signupEmailError").innerHTML = ("");
        $("#signupEmail").removeClass("errorBox");
        signupEmailBool = 1;
    }
}

function validatePassword() {
    var text = document.getElementById("signupPassword").value;
    var length = text.length;
    if (length > 8) {
        document.getElementById("signupPasswordError").innerHTML = ("");
        $("#signupPassword").removeClass("errorBox");
        signupPasswordBool = 1;
    }
    else {
        document.getElementById("signupPasswordError").innerHTML = ("Password must be greater than 8 characters.");
        $("#signupPassword").addClass("errorBox");
        signupPasswordBool = 0;
    }
}
function validatePasswordConfirm() {
    var password = document.getElementById("signupPassword").value;
    var text = document.getElementById("signupPasswordConfirm").value;
    if (password === text) {
        document.getElementById("signupPasswordConfirmError").innerHTML = ("");
        $("#signupPasswordConfirm").removeClass("errorBox");
        signupPasswordBool = 1;
    }
    else {
        document.getElementById("signupPasswordConfirmError").innerHTML = ("The passwords do not match.");
        $("#signupPassword").addClass("errorBox");
        signupPasswordBool = 0;
    }
}



function validateMilesTraveled() {
    var text = document.getElementById("milesTraveled").value;
    if(text > 0 && text < 99 && text.match(/^\d+$/ )){
        document.getElementById("milesTraveledError").innerHTML=("");
        milesTraveledBool=1;
    }
    else{
        document.getElementById("milesTraveledError").innerHTML=("Enter a commute distance between 1 and 99 miles.");
        milesTraveledBool = 0;

    }
}
/*
$('#rememberCommute').change(function(){
    if($('#rememberCommute').is(':checked')==true) {
        $("#commuteName").prop("disabled",false);
    }else{
        $("#commuteName").prop("disabled",true);

    }
});
    */

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});