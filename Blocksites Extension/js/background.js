
websitesListark();
pagesList();
function websitesListark() {
       var websitesLista = [];

        chrome.storage.sync.get(['websitesList'], function (result) {
            if (result.hasOwnProperty('websitesList')) {
                var listsWeb = result.websitesList.split(',');
                k = 0;
                for (var i = listsWeb.length - 1; i >= 0; i--) {
                    if (listsWeb[i] != "undefined") {
                        websitesLista[k] = listsWeb[i] + "/*";

                        k++;
                    }
                }


                blockedwebsites(websitesLista);
            }


        });

}

function pagesList() {
        var websitesLista = [];
        chrome.storage.sync.get(['blockedPages'], function (result) {




            if (result.hasOwnProperty('blockedPages')) {

        var listsWeb = result.blockedPages.split(',');
        k = 0;
        for (var i = listsWeb.length - 1; i >= 0; i--) {
                //Again Get Only the Keyword Part
if(listsWeb[i]!="undefined") {
    if(listsWeb[i]!="") {
        websitesLista[k] = listsWeb[i].split('=>')[1];
        console.log(listsWeb[i]);


        k++;
    }
}
        }
      if(websitesLista.length==1 && typeof websitesLista[0]=="undefined"){

      }else{

          console.log(websitesLista);
          blockedwebsitesPages(websitesLista);
      }



}


        });

}
function blockedwebsitesPages(websitesLista){
    console.log(websitesLista);
    chrome.webRequest.onBeforeRequest.addListener(
        blockfunPages,
        {urls: websitesLista},
        ["blocking"]
    );

}

function blockfunPages(details){
    return {cancel: true};
}
function blockfun(details){

        return {cancel: true};
}

function blockedwebsites(websitesLista){

        chrome.webRequest.onBeforeRequest.addListener(
            blockfun,
            {urls: websitesLista},
            ["blocking"]
        );
}

chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse){
            if(request.msg == "startFunc") {
                    chrome.webRequest.onBeforeRequest.removeListener(blockfun);
                    chrome.webRequest.onBeforeRequest.removeListener(blockfunPages);

                    websitesListark();
                    pagesList();

            }
    }
);

chrome.storage.sync.set({"refreshTime": 0}, function () {

});





