chrome.storage.sync.get(['login'], function(result) {
    if (result.hasOwnProperty('login')) {
        console.log(result.login);
        window.location.replace("/notallowed.html");

    }
});

window.onload=function() {
    websitesListHtml="";
    chrome.storage.sync.get(['websitesList'], function(result) {
        var listsWeb=result.websitesList.split(',');

        var count=0;
        for (var i = listsWeb.length-1; i >=0; i--) {
            count++;
            if(count<=5) {
                websitesListHtml = websitesListHtml + '<div class="row" id="domain' + i + '" data-href="' + listsWeb[i] + '"><div class="col-10"><a href="' + listsWeb[i] + '">' + listsWeb[i] + '</a></div><div class="col-2 text-right"></div></div>';
            }
        }

        document.getElementById("websiteslistark").innerHTML = websitesListHtml;


    });


    keywordsListHtml="";
    chrome.storage.sync.get(['keywordsList'], function(result) {
        var listsWeb=result.keywordsList.split(',');
var count=0;
        for (var i = listsWeb.length-1; i >=0; i--) {
            count++;
            if(count<=5) {
                keywordsListHtml = keywordsListHtml + '<div class="row" id="domain' + i + '" data-href="' + listsWeb[i] + '"><div class="col-10"><a href="' + listsWeb[i] + '">' + listsWeb[i] + '</a></div><div class="col-2 text-right"></div></div>';
            }
        }

        document.getElementById("keywordslistark").innerHTML = keywordsListHtml;


    });



    chrome.storage.sync.get(['websitesList'], function(result) {
        if (result.hasOwnProperty('websitesList')) {
            var listsWeb = result.websitesList.split(',');
            $("#totalWebsites").html(listsWeb.length);
        }
    });

    chrome.storage.sync.get(['keywordsList'], function(result) {
        if (result.hasOwnProperty('keywordsList')) {
            var listsWeb = result.keywordsList.split(',');
            $("#totalKeywords").html(listsWeb.length);
        }

    });

};