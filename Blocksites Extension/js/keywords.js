chrome.storage.sync.get(['login'], function(result) {
    if (result.hasOwnProperty('login')) {
        console.log(result.login);
        window.location.replace("/notallowed.html");

    }
});

function addDomain(){

    value=document.getElementById("ark_domainUrl").value;


    chrome.storage.sync.get(['keywordsList'], function(result) {
        if (result.hasOwnProperty('keywordsList')) {
            newValue = result.keywordsList + "," + value;
        }else{
            newValue=value;
        }

            chrome.storage.sync.set({"keywordsList": newValue}, function () {

                listDomains();
                $("#ark_domainUrl").val("");
                $(".msghere").css("display","block");
                setTimeout(function() {
                    $(".msghere").css("display","none");
                }, 3000);


            });


    });




}


function listDomains(){
    websitesListHtml="";
    chrome.storage.sync.get(['keywordsList'], function(result) {
        if (result.hasOwnProperty('keywordsList')) {
            var listsWeb = result.keywordsList.split(',');

            for (var i = listsWeb.length - 1; i >= 0; i--) {

                websitesListHtml = websitesListHtml + '<div class="row" id="domain' + i + '" data-href="' + listsWeb[i] + '"><div class="col-10">' + listsWeb[i] + '</div><div class="col-2 text-right"><img class="deletedomain" id="delete' + i + '" src="images/del.png"></div></div>';

                if (i == 0) {
                    document.getElementById("websiteslistark").innerHTML = websitesListHtml;
                }
            }
            $(".deletedomain").on('click', function (event) {

                id = event.target.id;


                id = id.split('delete')[1];
                domainName = $("#domain" + id).attr("data-href");
                $("#domain" + id).css("display", "none");
                chrome.storage.sync.get(['keywordsList'], function (result) {

                    websiteslist = result.keywordsList;


                    if (websiteslist.includes(",") == false) {
                        websiteslist = websiteslist.replace(domainName);
                    }
                    websiteslist = websiteslist.replace("," + domainName, '');

                    websiteslist = websiteslist.replace(domainName + ",", '');

                    chrome.storage.sync.set({"keywordsList": websiteslist}, function () {


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
    chrome.storage.sync.get(['keywordsList'], function(result) {
        if (result.hasOwnProperty('keywordsList')) {
            var listsWeb = result.keywordsList.split(',');


            for (var i = listsWeb.length - 1; i >= 0; i--) {
                websitesListHtml = websitesListHtml + '<div class="row" id="domain' + i + '" data-href="' + listsWeb[i] + '"><div class="col-10">' + listsWeb[i] + '</div><div class="col-2 text-right"><img class="deletedomain" id="delete' + i + '" src="images/del.png"></div></div>';

            }

            document.getElementById("websiteslistark").innerHTML = websitesListHtml;

            $(".deletedomain").on('click', function (event) {
                id = event.target.id;


                id = id.split('delete')[1];
                domainName = $("#domain" + id).attr("data-href");
                //keyword name here domainName
                var newBlockedPages = "";
                chrome.storage.sync.get(['blockedPages'], function (result1) {
                    if (result1.hasOwnProperty('blockedPages')) {
                        var listsWeb = result1.blockedPages.split(',');
                        for (var i = listsWeb.length - 1; i >= 0; i--) {
                            if (listsWeb[i] != "undefined") {
                                var skeyword = listsWeb[i].split('=>')[0];
                                var slink = listsWeb[i].split('=>')[1];
                                if (domainName != skeyword) {
                                    newBlockedPages = newBlockedPages + "," + skeyword + "=>" + slink;
                                }

                            }

                        }
                        //Set now
                        console.log(newBlockedPages+"ok");
                        chrome.storage.sync.set({"blockedPages": newBlockedPages}, function () {
                            chrome.runtime.sendMessage({msg: "startFunc"});


                        });

                    }
                });

                $("#domain" + id).css("display", "none");
                chrome.storage.sync.get(['keywordsList'], function (result) {

                    websiteslist = result.keywordsList;


                    if (websiteslist.includes(",") == false) {
                        websiteslist = websiteslist.replace(domainName);
                    }
                    websiteslist = websiteslist.replace("," + domainName, '');

                    websiteslist = websiteslist.replace(domainName + ",", '');

                    chrome.storage.sync.set({"keywordsList": websiteslist}, function () {


                    });

                });
            });
        }
    });
};