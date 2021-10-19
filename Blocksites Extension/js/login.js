chrome.storage.sync.get(['login'], function(result) {
    if (result.hasOwnProperty('login')) {
        console.log(result.login);
        window.location.replace("/notallowed.html");

    }
});

window.onload=function() {
    $("#loginhere").click(function () {
        uname=$("#uname").val();
        password=$("#password").val();
        if(uname=="" || password==""){
            alert("Require Name and Password");
        }else {

            $.ajax({
                type: "POST",
                url: "http://localhost/block/index.php",
                data: {
                    uname: uname,password:password
                }
            }).done(function (result) {
             if(result==1){

                 chrome.storage.sync.set({"login": uname }, function () {

                     alert("Successfully Logged In!");
                     location.reload();


                 });

             }else{
                 alert("Login Error: Username or password did not match!")
             }

            });
        }
    });



}
