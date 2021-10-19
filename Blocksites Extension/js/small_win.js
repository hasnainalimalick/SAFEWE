window.onload=function() {
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




}



