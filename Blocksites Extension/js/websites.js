chrome.storage.sync.get(['login'], function(result) {
    if (result.hasOwnProperty('login')) {
        console.log(result.login);
        window.location.replace("/notallowed.html");

    }
});

function addDomain(){

   value=document.getElementById("ark_domainUrl").value;


    chrome.storage.sync.get(['websitesList'], function(result) {
if(validURL(value)) {
    if (result.hasOwnProperty('websitesList')) {
        newValue = result.websitesList + "," + value;
    }else{
        newValue = value;
    }

    chrome.storage.sync.set({"websitesList": newValue}, function () {

        listDomains();
        $("#ark_domainUrl").val("");
      $(".msghere").css("display","block");
        setTimeout(function() {
            $(".msghere").css("display","none");
        }, 3000);
        chrome.runtime.sendMessage({ msg: "startFunc" });



    });
}else{
    alert("Domain Name is not valid");
}

    });






}


function listDomains(){
    websitesListHtml="";
    chrome.storage.sync.get(['websitesList'], function(result) {
        if (result.hasOwnProperty('websitesList')) {
            var listsWeb = result.websitesList.split(',');

            for (var i = listsWeb.length - 1; i >= 0; i--) {

                websitesListHtml = websitesListHtml + '<div class="row" id="domain' + i + '" data-href="' + listsWeb[i] + '"><div class="col-10"><a href="' + listsWeb[i] + '">' + listsWeb[i] + '</a></div><div class="col-2 text-right"><img class="deletedomain" id="delete' + i + '" src="images/del.png"></div></div>';

                if (i == 0) {
                    document.getElementById("websiteslistark").innerHTML = websitesListHtml;
                }
            }

            $(".deletedomain").on('click', function (event) {

                id = event.target.id;


                id = id.split('delete')[1];
                domainName = $("#domain" + id).attr("data-href");
                $("#domain" + id).css("display", "none");
                chrome.storage.sync.get(['websitesList'], function (result) {

                    websiteslist = result.websitesList;


                    if (websiteslist.includes(",") == false) {
                        websiteslist = websiteslist.replace(domainName);
                    }

                    websiteslist = websiteslist.replace("," + domainName, '');

                    websiteslist = websiteslist.replace(domainName + ",", '');

                    chrome.storage.sync.set({"websitesList": websiteslist}, function () {


                        chrome.runtime.sendMessage({msg: "startFunc"});


                    });

                });
            });
        }
    });

}

function validURL(str) {
    var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return !!pattern.test(str);
}


document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('ark_addwebsite').addEventListener('click', addDomain);
});


window.onload=function() {
    websitesListHtml="";
    chrome.storage.sync.get(['websitesList'], function(result) {
        if (result.hasOwnProperty('websitesList')) {
            var listsWeb = result.websitesList.split(',');

            for (var i = listsWeb.length - 1; i >= 0; i--) {
                websitesListHtml = websitesListHtml + '<div class="row" id="domain' + i + '" data-href="' + listsWeb[i] + '"><div class="col-10"><a href="' + listsWeb[i] + '">' + listsWeb[i] + '</a></div><div class="col-2 text-right"><img class="deletedomain" id="delete' + i + '" src="images/del.png"></div></div>';

            }

            document.getElementById("websiteslistark").innerHTML = websitesListHtml;

            $(".deletedomain").on('click', function (event) {


                id = event.target.id;


                id = id.split('delete')[1];
                domainName = $("#domain" + id).attr("data-href");
                $("#domain" + id).css("display", "none");
                chrome.storage.sync.get(['websitesList'], function (result) {

                    websiteslist = result.websitesList;


                    if (websiteslist.includes(",") == false) {
                        websiteslist = websiteslist.replace(domainName);
                    }

                    websiteslist = websiteslist.replace("," + domainName, '');

                    websiteslist = websiteslist.replace(domainName + ",", '');

                    chrome.storage.sync.set({"websitesList": websiteslist}, function () {


                        chrome.runtime.sendMessage({msg: "startFunc"});


                    });


                });
            });
        }
    });
};